<?php if ( ! defined('BASEPATH')) exit('Invalid file request.');

/**
 * {pkg_title} module installer and updater.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

class {pkg_name}_upd {

  private $EE;
  private $_mod_model;
  private $_pkg_model;

  public $version;


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

    $this->version = $this->_pkg_model->get_package_version();
  }


  /**
   * Installs the module.
   *
   * @access  public
   * @return  bool
   */
  public function install()
  {
    return $this->_mod_model->install($this->_pkg_model->get_package_name(),
      $this->version);
  }


  /**
   * Uninstalls the module.
   *
   * @access  public
   * @return  bool
   */
  public function uninstall()
  {
    return $this->_mod_model->uninstall($this->_pkg_model->get_package_name());
  }


  /**
   * Updates the module.
   *
   * @access  public
   * @param   string      $installed_version      The installed version.
   * @return  bool
   */
  public function update($installed_version = '')
  {
    return $this->_mod_model->update($installed_version, $this->version);
  }


}


/* End of file      : upd.{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/upd.{pkg_name_lc}.php */
