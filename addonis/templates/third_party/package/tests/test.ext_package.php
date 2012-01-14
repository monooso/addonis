<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} extension tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/ext.{pkg_name_lc}.php';
require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_extension_model.php';
require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_model.php';

class Test_{pkg_name_lc}_ext extends Testee_unit_test_case {

  private $_ext_model;
  private $_pkg_model;
  private $_pkg_version;
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
    Mock::generate('{pkg_name}_extension_model',
      get_class($this) .'_mock_ext_model');
    
    Mock::generate('{pkg_name}_model',
      get_class($this) .'_mock_model');

    /**
     * The subject loads the models using $this->EE->load->model().
     * Because the Loader class is mocked, that does nothing, so we
     * can just assign the mock models here.
     */

    $this->EE->{pkg_name_lc}_model = $this->_get_mock('model');
    $this->EE->{pkg_name_lc}_extension_model = $this->_get_mock('ext_model');

    $this->_ext_model = $this->EE->{pkg_name_lc}_extension_model;
    $this->_pkg_model = $this->EE->{pkg_name_lc}_model;

    // Called in the constructor.
    $this->_pkg_version = '2.3.4';
    $this->_pkg_model->setReturnValue('get_package_version',
      $this->_pkg_version);

    $this->_subject = new {pkg_name}_ext();
  }


  public function test__activate_extension__calls_model_install_method_with_correct_arguments()
  {
    $hooks = array({ext_hooks}
      '{ext_hook_hook}',
    {/ext_hooks}
    );

    $this->_ext_model->expectOnce('install',
      array(get_class($this->_subject), $this->_pkg_version, $hooks));
  
    $this->_subject->activate_extension();
  }


  public function test__disable_extension__calls_model_uninstall_method_with_correct_arguments()
  {
    $this->_ext_model->expectOnce('uninstall',
      array(get_class($this->_subject)));

    $this->_subject->disable_extension();
  }


  public function test__update_extension__calls_model_update_method_with_correct_arguments_and_honors_return_value()
  {
    $installed  = '1.2.3';
    $result     = 'Ciao a tutti!';    // Could be anything.

    $this->_ext_model->expectOnce('update',
      array(get_class($this->_subject), $installed, $this->_pkg_version));

    $this->_ext_model->setReturnValue('update', $result);
  
    $this->assertIdentical($result,
      $this->_subject->update_extension($installed));
  }


}


/* End of file      : test.ext_{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.ext_{pkg_name_lc}.php */
