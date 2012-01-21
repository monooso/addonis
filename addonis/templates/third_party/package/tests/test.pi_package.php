<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {pkg_title} plugin tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once PATH_THIRD .'{pkg_name_lc}/pi.{pkg_name_lc}.php';
require_once PATH_THIRD .'{pkg_name_lc}/models/{pkg_name_lc}_plugin_model.php';

class Test_{pkg_name_lc} extends Testee_unit_test_case {

  private $_pi_model;
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
    Mock::generate('{pkg_name}_plugin_model',
      get_class($this) .'_mock_plugin_model');
    
    /**
     * The subject loads the models using $this->EE->load->model().
     * Because the Loader class is mocked, that does nothing, so we
     * can just assign the mock models here.
     */

    $this->EE->{pkg_name_lc}_plugin_model = $this->_get_mock('plugin_model');

    $this->_pi_model  = $this->EE->{pkg_name_lc}_plugin_model;
    $this->_subject   = new {pkg_name}();
  }

  {pi_tags}
  public function test__{pi_tag_name}__returns_test_string()
  {
    $this->assertIdentical($this->_subject->{pi_tag_name}(),
      'exp:{pkg_name_lc}:{pi_tag_name} output');
  }

  {/pi_tags}

}


/* End of file      : test.pi_{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/tests/test.pi_{pkg_name_lc}.php */
