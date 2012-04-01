<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {{ pkg_title }} plugin model tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once PATH_THIRD .'{{ pkg_name_lc }}/models/{{ pkg_name_lc }}_plugin_model.php';

class Test_{{ pkg_name_lc }}_plugin_model extends Testee_unit_test_case {

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

    $this->_namespace       = 'com.google';
    $this->_package_name    = 'Example_package';
    $this->_package_version = '1.0.0';

    $this->_subject = new {{ pkg_name }}_plugin_model($this->_package_name,
      $this->_package_version, $this->_namespace);
  }


}


/* End of file      : test.{{ pkg_name_lc }}_plugin_model.php */
/* File location    : third_party/{{ pkg_name_lc }}/tests/test.{{ pkg_name_lc }}_plugin_model.php */