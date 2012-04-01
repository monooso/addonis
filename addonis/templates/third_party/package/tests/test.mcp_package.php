<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {{ pkg_title }} module control panel tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once PATH_THIRD .'{{ pkg_name_lc }}/mcp.{{ pkg_name_lc }}.php';
require_once PATH_THIRD .'{{ pkg_name_lc }}/models/{{ pkg_name_lc }}_module_model.php';

class Test_{{ pkg_name_lc }}_mcp extends Testee_unit_test_case {

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
    Mock::generate('{{ pkg_name }}_module_model',
      get_class($this) .'_mock_module_model');

    /**
     * The subject loads the models using $this->EE->load->model().
     * Because the Loader class is mocked, that does nothing, so we
     * can just assign the mock models here.
     */

    $this->EE->{{ pkg_name_lc }}_module_model = $this->_get_mock('module_model');

    $this->_mod_model = $this->EE->{{ pkg_name_lc }}_module_model;
    $this->_subject   = new {{ pkg_name }}_mcp();
  }

{% if mod_cp_pages %}
{% for page in mod_cp_pages %}

  public function test__{{ page.name_lc }}__sets_page_title_and_loads_correct_view()
  {
    $page_title = 'Example Page Title';
    $view_string = '<p>Look at the parking lot, Larry.</p>';

    $this->EE->lang->expect('line', array('mod_nav_{{ page.name_lc }}'));
    $this->EE->lang->setReturnValue('line', $page_title,
      array('mod_nav_{{ page.name_lc }}'));

    $this->EE->cp->expectOnce('set_variable',
      array('cp_page_title', $page_title));

    $this->EE->load->expectOnce('view',
      array('mod_{{ page.name_lc }}', '*', TRUE));

    $this->EE->load->setReturnValue('view', $view_string,
      array('mod_{{ page.name_lc }}', '*', TRUE));

    $this->assertIdentical($view_string,
      $this->_subject->{{ page.name_lc }}());
  }

{% endfor %}
{% endif %}

}


/* End of file      : test.mcp_{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/tests/test.mcp_{{ pkg_name_lc }}.php */