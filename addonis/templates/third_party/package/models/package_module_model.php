<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {pkg_title} module model.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once dirname(__FILE__) .'/{pkg_name_lc}_model.php';

class {pkg_name}_module_model extends {pkg_name}_model {

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
    parent::__construct();
  }


  /**
   * Installs the module.
   *
   * @access  public
   * @param   string    $package_name     The package name.
   * @param   string    $package_version  The package version.
   * @return  bool
   */
  public function install($package_name, $package_version)
  {
    $package_name = ucfirst($package_name);

    $this->_install_register($package_name, $package_version);
    $this->_install_actions($package_name);

    return TRUE;
  }


  /**
   * Uninstalls the module.
   *
   * @access  public
   * @param   string    $package_name     The package name.
   * @return  bool
   */
  public function uninstall($package_name)
  {
    $package_name = ucfirst($package_name);

    $db_module = $this->EE->db
      ->select('module_id')
      ->get_where('modules', array('module_name' => $package_name), 1);

    if ($db_module->num_rows() !== 1)
    {
      return FALSE;
    }

    $this->EE->db->delete('module_member_groups',
      array('module_id' => $db_module->row()->module_id));

    $this->EE->db->delete('modules',
      array('module_name' => $package_name));

    $this->EE->db->delete('actions',
      array('class' => $package_name));

    return TRUE;
  }


  /**
   * Updates the module.
   *
   * @access  public
   * @param   string    $installed_version    The installed version.
   * @param   string    $package_version      The package version.
   * @return  bool
   */
  public function update($installed_version = '', $package_version = '')
  {
    if (version_compare($installed_version, $package_version, '>='))
    {
      return FALSE;
    }

    return TRUE;
  }



  /* --------------------------------------------------------------
   * PRIVATE METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Register the module actions in the database.
   *
   * @access  private
   * @param   string    $package_name     The package name.
   * @return  void
   */
  private function _install_actions($package_name)
  {
    {mod_actions}
    $this->EE->db->insert('actions', array(
      'class'   => $package_name,
      'method'  => '{mod_action_method}'
    ));
    {/mod_actions}
  }


  /**
   * Registers the module in the database.
   *
   * @access  private
   * @param   string    $package_name     The package name.
   * @param   string    $package_version  The package version.
   * @return  void
   */
  private function _install_register($package_name, $package_version)
  {
    $this->EE->db->insert('modules', array(
      'has_cp_backend'      => 'y',
      'has_publish_fields'  => 'n',
      'module_name'         => $package_name,
      'module_version'      => $package_version
    ));
  }


}


/* End of file      : {pkg_name_lc}_module_model.php */
/* File location    : third_party/{pkg_name_lc}/models/{pkg_name_lc}_module_model.php */
