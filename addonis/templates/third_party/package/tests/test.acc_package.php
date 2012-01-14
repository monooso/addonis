<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} accessory tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/acc.{pkg_name_lc}.php';
require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_accessory_model.php';
require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_model.php';

class Test_{pkg_name_lc}_acc extends Testee_unit_test_case {

  private $_acc_model;
  private $_pkg_model;
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

    // Generate the mock models.
    Mock::generate('{pkg_name}_accessory_model',
      get_class($this) .'_mock_accessory_model');
    
    Mock::generate('{pkg_name}_model',
      get_class($this) .'_mock_model');

    /**
     * The subject loads the models using $this->EE->load->model().
     * Because the Loader class is mocked, that does nothing, so we
     * can just assign the mock models here.
     */

    $this->EE->{pkg_name_lc}_accessory_model
      = $this->_get_mock('accessory_model');

    $this->EE->{pkg_name_lc}_model = $this->_get_mock('model');

    $this->_acc_model = $this->EE->{pkg_name_lc}_accessory_model;
    $this->_pkg_model = $this->EE->{pkg_name_lc}_model;
    $this->_subject   = new {pkg_name}_acc();
  }


  public function test__install__calls_accessory_model_method()
  {
    $this->_acc_model->expectOnce('install');
    $this->_subject->install();
  }


  public function test__set_sections__loads_a_view_file_for_each_section_and_returns_the_results()
  {
    $expected_data = array();

    {acc_sections}
    $view_name    = 'acc_{acc_section_name_lc}';
    $view_return  = 'Return value of ' .$view_name .' view.';

    $this->EE->load->setReturnValue('view', $view_return,
      array($view_name, array(), TRUE));

    $expected_data['{acc_section_title}'] = $view_return;
    {/acc_sections}
  
    $this->_subject->set_sections();
    $this->assertIdentical($expected_data, $this->_subject->sections);
  }


  public function test__uninstall__calls_accessory_model_method()
  {
    $this->_acc_model->expectOnce('uninstall');
    $this->_subject->uninstall();
  }


  public function test__update__calls_accessory_model_method_and_honors_return_value()
  {
    $return = 'Anything should work.';

    $this->_acc_model->expectOnce('update');
    $this->_acc_model->setReturnValue('update', $return);

    $this->assertIdentical($return, $this->_subject->update());
  }


}


/* End of file      : test.mod_{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.mod_{pkg_name_lc}.php */
