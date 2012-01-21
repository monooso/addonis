<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} module tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/mod.{pkg_name_lc}.php';
require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_module_model.php';

class Test_{pkg_name_lc} extends Testee_unit_test_case {

  private $_mod_model;
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

    // Generate the mock model.
    Mock::generate('{pkg_name}_module_model',
      get_class($this) .'_mock_module_model');
    
    /**
     * The subject loads the models using $this->EE->load->model().
     * Because the Loader class is mocked, that does nothing, so we
     * can just assign the mock models here.
     */

    $this->EE->{pkg_name_lc}_module_model = $this->_get_mock('module_model');

    $this->_mod_model = $this->EE->{pkg_name_lc}_module_model;
    $this->_subject   = new {pkg_name}();
  }

  {mod_tags}
  public function test__{mod_tag_name}__returns_test_string()
  {
    $this->assertIdentical($this->_subject->{mod_tag_name}(),
      'exp:{pkg_name_lc}:{mod_tag_name} output');
  }

  {/mod_tags}

}


/* End of file      : test.mod_{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.mod_{pkg_name_lc}.php */
