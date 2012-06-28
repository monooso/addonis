<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * {{ pkg_title }} plugin tests.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once PATH_THIRD .'{{ pkg_name_lc }}/pi.{{ pkg_name_lc }}.php';
require_once PATH_THIRD .'{{ pkg_name_lc }}/models/{{ pkg_name_lc }}_model.php';

class Test_{{ pkg_name_lc }} extends Testee_unit_test_case {

  private $_model;
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
    Mock::generate('{{ pkg_name }}_model',
      get_class($this) .'_mock_model');

    /**
     * The subject loads the models using $this->EE->load->model().
     * Because the Loader class is mocked, that does nothing, so we
     * can just assign the mock models here.
     */

    $this->EE->{{ pkg_name_lc }}_model = $this->_get_mock('model');

    $this->_model   = $this->EE->{{ pkg_name_lc }}_model;
    $this->_subject = new {{ pkg_name }}();
  }

{% if pi_tags %}
{% for tag in pi_tags %}

  public function test__{{ tag.name }}__returns_test_string()
  {
    $this->assertIdentical($this->_subject->{{ tag.name }}(),
      'exp:{{ pkg_name_lc }}:{{ tag.name }} output');
  }

{% endfor %}
{% endif %}

}


/* End of file      : test.pi_{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/tests/test.pi_{{ pkg_name_lc }}.php */
