<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} module model tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_module_model.php';

class Test_{pkg_name_lc}_module_model extends Testee_unit_test_case {

  private $_subject;


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @return  void
   */
  public function setUp()
  {
    parent::setUp();
    $this->_subject = new {pkg_name}_module_model();
  }


  public function test__install__installs_module_and_actions()
  {
    $package_name     = 'example_package';
    $package_version  = '1.1.2';

    // Register the module.
    $module_data = array(
      'has_cp_backend'      => 'y',
      'has_publish_fields'  => 'n',
      'module_name'         => ucfirst($package_name),
      'module_version'      => $package_version
    );

    $this->EE->db->expectAt(0, 'insert', array('modules', $module_data));

    {mod_actions}
    $this->EE->db->expectAt({count} + 1, 'insert', array('actions', array(
      'class'   => ucfirst($package_name),
      'method'  => '{mod_action_method}'
    )));
    {/mod_actions}

    // Run the tests.
    $this->_subject->install($package_name, $package_version);
  }


  public function test__uninstall__uninstalls_module_and_returns_true()
  {
    $package_name = 'example_package';
  
    // Retrieve the module information.
    $db_result  = $this->_get_mock('db_query');
    $db_row     = (object) array('module_id' => '123');

    $this->EE->db->expectOnce('select', array('module_id'));
    $this->EE->db->expectOnce('get_where', array('modules',
      array('module_name' => ucfirst($package_name)), 1));

    $this->EE->db->setReturnReference('get_where', $db_result);

    $db_result->setReturnValue('num_rows', 1);
    $db_result->setReturnValue('row', $db_row);

    // Delete the module from the module_member_groups table.
    $this->EE->db->expectAt(0, 'delete', array('module_member_groups',
      array('module_id' => $db_row->module_id)));

    // Delete the module from the modules table.
    $this->EE->db->expectAt(1, 'delete', array('modules',
      array('module_name' => ucfirst($package_name))));

    // Delete the module from the actions table.
    $this->EE->db->expectAt(2, 'delete', array('actions',
      array('class' => ucfirst($package_name))));

    // Run the tests.
    $this->assertIdentical(TRUE, $this->_subject->uninstall($package_name));
  }


  public function test__uninstall__returns_false_if_module_not_installed()
  {
    $package_name = 'example_package';
  
    // Retrieve the module information.
    $db_result  = $this->_get_mock('db_query');

    $this->EE->db->expectOnce('select', array('module_id'));
    $this->EE->db->expectOnce('get_where', array('modules',
      array('module_name' => ucfirst($package_name)), 1));

    $this->EE->db->setReturnReference('get_where', $db_result);

    $db_result->setReturnValue('num_rows', 0);

    // Delete the module from the module_member_groups table.
    $this->EE->db->expectNever('delete');

    // Run the tests.
    $this->assertIdentical(FALSE, $this->_subject->uninstall($package_name));
  }


  public function test__update__returns_false_if_no_update_is_required()
  {
    $this->assertIdentical(FALSE, $this->_subject->update('1.0.0', '1.0.0'));
    $this->assertIdentical(FALSE, $this->_subject->update('1.0.1', '1.0.0'));
    $this->assertIdentical(FALSE, $this->_subject->update('1.0b2', '1.0b1'));
  }


  public function test__update__returns_true_if_update_is_required()
  {
    $this->assertIdentical(TRUE, $this->_subject->update('', '1.0.0'));
    $this->assertIdentical(TRUE, $this->_subject->update('1.0.0', '1.0.1'));
    $this->assertIdentical(TRUE, $this->_subject->update('1.0a2', '1.0b1'));
  }


}


/* End of file      : test.{pkg_name_lc}_module_model.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.{pkg_name_lc}_module_model.php */
