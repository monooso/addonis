<?php if ( ! defined('BASEPATH')) exit('Invalid file request.');

/**
 * {{ pkg_title }} module control panel.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

class {{ pkg_name }}_mcp {

  private $EE;
  private $_model;
  private $_theme_url;


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

    // Basic stuff required by every view.
    $this->_base_qs = 'C=addons_modules'
      .AMP .'M=show_module_cp'
      .AMP .'module={{ pkg_name_lc }}';

    $this->_base_url  = BASE .AMP .$this->_base_qs;
    $this->_theme_url = $this->_model->get_package_theme_url();

    $this->EE->load->helper('form');
    $this->EE->load->library('table');

    $this->EE->cp->add_to_foot('<script type="text/javascript" src="'
      .$this->_theme_url .'js/common.js"></script>');

    $this->EE->cp->add_to_foot('<script type="text/javascript" src="'
      .$this->_theme_url .'js/mod.js"></script>');

    $this->EE->javascript->compile();

    $this->EE->cp->add_to_head('<link rel="stylesheet" type="text/css" href="'
      .$this->_theme_url .'css/common.css" />');

    $this->EE->cp->add_to_head('<link rel="stylesheet" type="text/css" href="'
      .$this->_theme_url .'css/mod.css" />');

    // Set the base breadcrumb.
    $this->EE->cp->set_breadcrumb(
      $this->_base_url,
      $this->EE->lang->line('{{ pkg_name_lc }}_module_name'));

    // Set the in-module navigation.
    $nav_array = array();
    {% for page in mod_cp_pages %}
    $nav_array['mod_nav_{{ page.name_lc }}'] =
      $this->_base_url .AMP .'method={{ page.name_lc }}';
    {% endfor %}

    $this->EE->cp->set_right_nav($nav_array);
  }


  /**
   * The module control panel 'home' page. Loads the preferred default CP page.
   *
   * @access  public
   * @return  string
   */
  public function index()
  {
    // @TODO : call the 'preferred' CP page method.
  }

{% for page in mod_cp_pages %}

  /**
   * {{ page.title }} control panel page.
   *
   * @access  public
   * @return  string
   */
  public function {{ page.name_lc }}()
  {
    // Set the page title.
    $this->EE->cp->set_variable('cp_page_title',
      $this->EE->lang->line('mod_nav_{{ page.name_lc }}'));

    $vars = array();

    return $this->EE->load->view('mod_{{ page.name_lc }}', $vars, TRUE);
  }

{% endfor %}

  /**
   * Saves the settings.
   *
   * @access  public
   * @return  void
   */
  public function save_settings()
  {
    $lang = $this->EE->lang;
    $sess = $this->EE->session;

    $this->_model->save_module_settings()
      ? $sess->set_flashdata('message_success',
          $lang->line('flashdata__settings_saved'))
      : $sess->set_flashdata('message_failure',
          $lang->line('flashdata__settings_not_saved'));

    $this->EE->functions->redirect($this->_base_url);
  }


}


/* End of file      : mcp.{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/mcp.{{ pkg_name_lc }}.php */
