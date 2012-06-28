<?php if ( ! defined('BASEPATH')) exit('Invalid file request.');

/**
 * {{ pkg_title }} module installer and updater.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

class {{ pkg_name }}_upd {

  private $EE;
  private $_model;

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

    $this->EE->load->add_package_path(PATH_THIRD .'{{ pkg_name_lc }}/');

    $this->EE->load->model('{{ pkg_name_lc }}_model');
    $this->_model = $this->EE->{{ pkg_name_lc }}_model;

    $this->version = $this->_model->get_package_version();
  }


  /**
   * Installs the module.
   *
   * @access  public
   * @return  bool
   */
  public function install()
  {
    return $this->_model->install_module($this->version);
  }


  /**
   * Uninstalls the module.
   *
   * @access  public
   * @return  bool
   */
  public function uninstall()
  {
    return $this->_model->uninstall_module();
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
    return $this->_model->update_package($installed_version);
  }


}


/* End of file      : upd.{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/upd.{{ pkg_name_lc }}.php */
