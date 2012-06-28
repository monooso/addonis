<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {{ pkg_title }} module.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

class {{ pkg_name }} {

  private $EE;
  private $_model;

  public $return_data = '';


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @return  void
   */
  public function __construct()
  {
    $this->EE =& get_instance();

    $this->EE->load->add_package_path(PATH_THIRD .'{{ pkg_name_lc }}/');

    $this->EE->load->model('{{ pkg_name_lc }}_model');
    $this->_model = $this->EE->{{ pkg_name_lc }}_model;
  }


{% if mod_actions %}
  /* --------------------------------------------------------------
   * ACTIONS
   * ------------------------------------------------------------ */
{% for action in mod_actions %}

  /**
   * {{ action.description }}
   *
   * @access  public
   * @return  void
   */
  public function {{ action.method }}()
  {
    error_log('Running the {{ action.method }} action.');
  }

{% endfor %}
{% endif %}
{% if mod_tags %}
  /* --------------------------------------------------------------
   * TEMPLATE TAGS
   * ------------------------------------------------------------ */
{% for tag in mod_tags %}

  /**
   * {{ tag.description }}
   *
   * @access  public
   * @return  string
   */
  public function {{ tag.name }}()
  {
    return $this->return_data = 'exp:{{ pkg_name_lc }}:{{ tag.name }} output';
  }

{% endfor %}
{% endif %}

}


/* End of file      : mod.{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/mod.{{ pkg_name_lc }}.php */
