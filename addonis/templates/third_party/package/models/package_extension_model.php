<?php if ( ! defined('EXT')) exit('Invalid file request.');

/**
 * {pkg_title} 'Extension' model.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

class {pkg_name}_extension_model extends CI_Model {


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
   * Installs the extension.
   *
   * @access  public
   * @param   array        $hooks        The extension hooks.
   * @return  bool
   */
  public function install_extension(Array $hooks = array())
  {
    if ( ! $hooks)
    {
      return;
    }

    foreach ($hooks AS $hook)
    {
      if ( ! is_string($hook))
      {
        return;
      }
    }

    $default_hook_data = array(
      'class'     => $this->_extension_class,
      'enabled'   => 'y',
      'hook'      => '',
      'method'    => '',
      'priority'  => '5',
      'settings'  => '',
      'version'   => $this->get_package_version()
    );

    foreach ($hooks AS $hook)
    {
      $this->EE->db->insert('extensions', array_merge(
        $default_hook_data,
        array('hook' => $hook, 'method' => 'on_' .$hook)
      ));
    }
  }


  /**
   * Uninstalls the extension.
   *
   * @access    public
   * @return    void
   */
  public function uninstall_extension()
  {
    $this->EE->db->delete('extensions',
      array('class' => $this->_extension_class));
  }


  /**
   * Updates the extension.
   *
   * @access  public
   * @param   string    $installed_version    The installed version.
   * @param   string    $package_version      The package version.
   * @return  bool
   */
  public function update_extension($installed_version = '',
    $package_version = ''
  )
  {
    if ( ! $installed_version
      OR version_compare($installed_version, $package_version, '>=')
    )
    {
      return FALSE;
    }

    $this->EE->db->update(
      'extensions',
      array('version' => $package_version),
      array('class'   => $this->_extension_class)
    );
  }


}


/* End of file      : {pkg_name_lc}_extension_model.php */
/* File location    : third_party/{pkg_name_lc}/models/{pkg_name_lc}_extension_model.php */
