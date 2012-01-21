<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {pkg_title} module.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

class {pkg_name} {

  private $EE;
  private $_mod_model;

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

    $this->EE->load->add_package_path(
      PATH_THIRD .'{pkg_name_lc}/');

    $this->EE->load->model('{pkg_name_lc}_module_model');
    $this->_mod_model = $this->EE->{pkg_name_lc}_module_model;
  }

  {mod_actions}
  /**
   * {mod_action_description}
   *
   * @access  public
   * @return  void
   */
  public function {mod_action_method}()
  {
    error_log('Running the {mod_action_method} action.');
  }

  {/mod_actions}
  {mod_tags}
  /**
   * {mod_tag_description}
   *
   * @access  public
   * @return  string
   */
  public function {mod_tag_name}()
  {
    return $this->return_data = 'exp:{pkg_name_lc}:{mod_tag_name} output';
  }

  {/mod_tags}

}


/* End of file      : mod.{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/mod.{pkg_name_lc}.php */
