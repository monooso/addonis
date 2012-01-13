<?php if ( ! defined('BASEPATH')) exit('Invalid file request.');

/**
 * {pkg_title} module control panel.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

class {pkg_name}_mcp {

  private $EE;
  private $_mod_model;
  private $_pkg_model;
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

    $this->EE->load->add_package_path(
      PATH_THIRD .'{pkg_name_lc}/');

    $this->EE->load->model('{pkg_name_lc}_model');
    $this->EE->load->model('{pkg_name_lc}_module_model');

    $this->_pkg_model = $this->EE->{pkg_name_lc}_model;
    $this->_mod_model = $this->EE->{pkg_name_lc}_module_model;

    // Basic stuff required by every view.
    $this->_base_qs = 'C=addons_modules'
      .AMP .'M=show_module_cp'
      .AMP .'module={pkg_name_lc}';

    $this->_base_url  = BASE .AMP .$this->_base_qs;
    $this->_theme_url = $this->_pkg_model->get_package_theme_url();

    $this->EE->load->helper('form');
    $this->EE->load->library('table');

    $this->EE->cp->set_breadcrumb(
      $this->_base_url,
      $this->EE->lang->line('{pkg_name_lc}_module_name'));

    $this->EE->cp->add_to_foot('<script type="text/javascript" src="'
      .$this->_theme_url .'js/cp.js"></script>');

    $this->EE->javascript->compile();

    $this->EE->cp->add_to_head('<link rel="stylesheet" type="text/css" href="'
      .$this->_theme_url .'css/cp.css" />');

    $nav_array = array(
      'nav_settings' => $this->_base_url .AMP .'method=settings'
    );

    $this->EE->cp->set_right_nav($nav_array);
  }


  /**
   * Module index page.
   *
   * @access  public
   * @return  string
   */
  public function index()
  {
    return $this->settings();
  }


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
      ? $sess->set_flashdata(
          'message_success',
          $lang->line('flashdata__settings_saved'))
      : $sess->set_flashdata(
          'message_failure',
          $lang->line('flashdata__settings_not_saved'));

    $this->EE->functions->redirect($this->_base_url .AMP .'method=settings');
  }


  /**
   * Settings.
   *
   * @access  public
   * @return  string
   */
  public function settings()
  {
    $vars = array(
      'form_action'   => $this->_base_qs .AMP .'method=save_settings',
      'cp_page_title' => $this->EE->lang->line('hd_settings')
    );

    return $this->EE->load->view('settings', $vars, TRUE);
  }


}


/* End of file      : mcp.{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/mcp.{pkg_name_lc}.php */
