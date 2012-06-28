<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {{ pkg_title }} model tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once PATH_THIRD .'{{ pkg_name_lc }}/models/{{ pkg_name_lc }}_model.php';

class Test_{{ pkg_name_lc }}_model extends Testee_unit_test_case {

  private $_extension_class;
  private $_module_class;
  private $_namespace;
  private $_package_name;
  private $_package_title;
  private $_package_version;
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

    $this->_namespace       = 'com.example';
    $this->_package_name    = 'MY_package';
    $this->_package_title   = 'My Package';
    $this->_package_version = '1.0.0';

    $this->_extension_class = 'My_package_ext';
    $this->_module_class    = 'My_package';

    $this->_subject = new {{ pkg_name }}_model($this->_package_name,
      $this->_package_title, $this->_package_version, $this->_namespace);
  }


  /* --------------------------------------------------------------
   * PACKAGE TESTS
   * ------------------------------------------------------------ */
  
  public function test__get_package_theme_url__pre_240_works()
  {
    if (defined('URL_THIRD_THEMES'))
    {
      $this->pass();
      return;
    }

    $package    = strtolower($this->_package_name);
    $theme_url  = 'http://example.com/themes/';
    $full_url   = $theme_url .'third_party/' .$package .'/';

    $this->EE->config->expectOnce('slash_item', array('theme_folder_url'));
    $this->EE->config->setReturnValue('slash_item', $theme_url);

    $this->assertIdentical($full_url, $this->_subject->get_package_theme_url());
  }


  public function test__get_site_id__returns_site_id_as_integer()
  {
    $site_id = '100';

    $this->EE->config->expectOnce('item', array('site_id'));
    $this->EE->config->setReturnValue('item', $site_id);

    $this->assertIdentical((int) $site_id, $this->_subject->get_site_id());
  }


  public function test__update_array_from_input__ignores_unknown_keys_and_updates_known_keys_and_preserves_unaltered_keys()
  {
    $base_array = array(
      'first_name'  => 'John',
      'last_name'   => 'Doe',
      'gender'      => 'Male',
      'occupation'  => 'Unknown'
    );

    $update_array = array(
      'dob'         => '1941-05-24',
      'first_name'  => 'Bob',
      'last_name'   => 'Dylan',
      'occupation'  => 'Writer'
    );

    $expected_result = array(
      'first_name'  => 'Bob',
      'last_name'   => 'Dylan',
      'gender'      => 'Male',
      'occupation'  => 'Writer'
    );

    $this->assertIdentical($expected_result,
      $this->_subject->update_array_from_input($base_array, $update_array));
  }


  
  /* --------------------------------------------------------------
   * EXTENSION TESTS
   * ------------------------------------------------------------ */
  
  public function test__install_extension__installs_extension_hooks()
  {
    $hooks    = array('hook_a', 'hook_b', 'hook_c');
    $version  = '1.2.3';

    $this->EE->db->expectCallCount('insert', count($hooks));

    $default_insert_data = array(
      'class'     => $this->_extension_class,
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

    $this->_subject->install_extension($version, $hooks);
  }


  public function test__install_extension__does_nothing_with_invalid_data()
  {
    $hooks    = array('hook_a', 'hook_b', 'hook_c');
    $version  = '1.2.3';

    $this->EE->db->expectNever('insert');

    // Missing data.
    $this->_subject->install_extension('', $hooks);
    $this->_subject->install_extension($version, array());

    // Invalid data.
    $this->_subject->install_extension(new StdClass(), $hooks);
  }


  public function test__uninstall_extension__deletes_extension_from_database()
  {
    $this->EE->db->expectOnce('delete',
      array('extensions', array('class' => $this->_extension_class)));

    $this->_subject->uninstall_extension();
  }


  /* --------------------------------------------------------------
   * MODULE TESTS
   * ------------------------------------------------------------ */
  
  public function test__install_module__installs_module()
  {
    $package_version  = '1.1.2';

    // Register the module.
    $module_data = array(
      'has_cp_backend'      => 'y',
      'has_publish_fields'  => 'n',
      'module_name'         => $this->_module_class,
      'module_version'      => $package_version
    );

    $this->EE->db->expectOnce('insert', array('modules', $module_data));

{% if mod_actions %}
    $actions_data = array(
{% for action in mod_actions %}
      array(
        'class'   => $this->_module_class,
        'method'  => '{{ action.method }}'
      ){% if not loop.last %},
{% endif %}
{% endfor %}
    );

    $this->EE->db->expectOnce('insert_batch', array('actions', $actions_data));

{% endif %}
    // Run the tests.
    $this->_subject->install_module($package_version);
  }


  public function test__uninstall_module__uninstalls_module_and_returns_true()
  {
    // Retrieve the module information.
    $db_result  = $this->_get_mock('db_query');
    $db_row     = (object) array('module_id' => '123');

    $this->EE->db->expectOnce('select', array('module_id'));
    $this->EE->db->expectOnce('get_where', array('modules',
      array('module_name' => $this->_module_class), 1));

    $this->EE->db->setReturnReference('get_where', $db_result);

    $db_result->setReturnValue('num_rows', 1);
    $db_result->setReturnValue('row', $db_row);

    // Delete the module from the module_member_groups table.
    $this->EE->db->expectAt(0, 'delete', array('module_member_groups',
      array('module_id' => $db_row->module_id)));

    // Delete the module from the modules table.
    $this->EE->db->expectAt(1, 'delete', array('modules',
      array('module_name' => $this->_module_class)));

{% if mod_actions %}
    // Delete the module from the actions table.
    $this->EE->db->expectAt(2, 'delete', array('actions',
      array('class' => $this->_module_class)));
{% endif %}

    // Run the tests.
    $this->assertIdentical(TRUE, $this->_subject->uninstall_module());
  }


  public function test__uninstall_module__returns_false_if_module_not_installed()
  {
    // Retrieve the module information.
    $db_result  = $this->_get_mock('db_query');

    $this->EE->db->expectOnce('select', array('module_id'));
    $this->EE->db->expectOnce('get_where', array('modules',
      array('module_name' => $this->_module_class), 1));

    $this->EE->db->setReturnReference('get_where', $db_result);
    $db_result->setReturnValue('num_rows', 0);

    $this->EE->db->expectNever('delete');

    // Run the tests.
    $this->assertIdentical(FALSE, $this->_subject->uninstall_module());
  }


}


/* End of file      : test.{{ pkg_name_lc }}_model.php */
/* File location    : third_party/{{ pkg_name_lc }}/tests/test.{{ pkg_name_lc }}_model.php */
