<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} accessory model tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_accessory_model.php';

class Test_{pkg_name_lc}_accessory_model extends Testee_unit_test_case {

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
    $this->_subject = new {pkg_name}_accessory_model();
  }


  public function test__update__returns_true()
  {
    $this->assertIdentical(TRUE, $this->_subject->update());
  }


}


/* End of file      : test.{pkg_name_lc}_accessory_model.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.{pkg_name_lc}_accessory_model.php */
