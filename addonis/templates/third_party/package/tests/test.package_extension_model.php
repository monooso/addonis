<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} extension model tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_extension_model.php';

class Test_{pkg_name_lc}_extension_model extends Testee_unit_test_case {

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
    $this->_subject = new {pkg_name}_extension_model();
  }


  public function test__install__installs_extension_hooks()
  {
    $class    = 'Example_package_ext';
    $hooks    = array('hook_a', 'hook_b', 'hook_c');
    $version  = '1.2.3';

    $this->EE->db->expectCallCount('insert', count($hooks));

    $default_insert_data = array(
      'class'     => $class,
      'enabled'   => 'y',
      'hook'      => '',
      'method'    => '',
      'priority'  => '5',
      'settings'  => '',
      'version'   => $version
    );

    for ($count = 0, $length = count($hooks); $count < $length; $count++)
    {
      $insert_data = array_merge($default_insert_data,
        array('hook' => $hooks[$count], 'method' => 'on_' .$hooks[$count]));

      $this->EE->db->expectAt($count, 'insert',
        array('extensions', $insert_data));
    }

    $this->_subject->install($class, $version, $hooks);
  }


  public function test__install__does_nothing_with_invalid_data()
  {
    $class    = 'Example_package_ext';
    $hooks    = array('hook_a', 'hook_b', 'hook_c');
    $version  = '1.2.3';

    $this->EE->db->expectNever('insert');

    // Missing data.
    $this->_subject->install('', $version, $hooks);
    $this->_subject->install($class, '', $hooks);
    $this->_subject->install($class, $version, array());

    // Invalid data.
    $this->_subject->install(new StdClass(), $version, $hooks);
    $this->_subject->install($class, new StdClass(), $hooks);
  }


  public function test__uninstall__deletes_extension_from_database()
  {
    $class = 'Example_package_ext';

    $this->EE->db->expectOnce('delete',
      array('extensions', array('class' => $class)));
  
    $this->_subject->uninstall($class);
  }


  public function test__uninstall__does_nothing_with_invalid_data()
  {
    $this->EE->db->expectNever('delete');
  
    $this->_subject->uninstall('');
    $this->_subject->uninstall(new StdClass());
  }


  public function test__update__returns_false_if_no_update_is_required()
  {
    $class    = 'Example_package_ext';
    $subject  = $this->_subject;

    $this->EE->db->expectNever('update');

    $this->assertIdentical(FALSE, $subject->update($class, '1.0.0', '1.0.0'));
    $this->assertIdentical(FALSE, $subject->update($class, '1.0.1', '1.0.0'));
    $this->assertIdentical(FALSE, $subject->update($class, '1.0b2', '1.0b1'));
  }


  public function test__update__returns_false_with_invalid_data()
  {
    $subject = $this->_subject;

    $this->EE->db->expectNever('update');

    // Missing data.
    $this->assertIdentical(FALSE, $subject->update('', '1.0.0', '1.0.0'));
    $this->assertIdentical(FALSE, $subject->update('Class', '', '1.0.0'));
    $this->assertIdentical(FALSE, $subject->update('Class', '1.0.0', ''));

    // Invalid data.
    $this->assertIdentical(FALSE,
      $subject->update(new StdClass(), '1.0.0', '1.0.0'));

    $this->assertIdentical(FALSE,
      $subject->update('Class', new StdClass(), '1.0.0'));

    $this->assertIdentical(FALSE,
      $subject->update('Class', '1.0.0', new StdClass()));
  }


  public function test__update__updates_version_number_in_database_and_returns_true_if_update_required()
  {
    $class      = 'Example_package_ext';
    $installed  = '1.0a2';
    $package    = '1.0b1';
    $subject    = $this->_subject;

    $this->EE->db->expectOnce('update', array('extensions',
      array('version' => $package), array('class' => $class)));

    $this->assertIdentical(TRUE,
      $subject->update($class, $installed, $package));
  }


}


/* End of file      : test.{pkg_name_lc}_extension_model.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.{pkg_name_lc}_extension_model.php */
