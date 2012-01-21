<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {pkg_title} accessory model.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

require_once dirname(__FILE__) .'/{pkg_name_lc}_model.php';

class {pkg_name}_accessory_model extends {pkg_name}_model {

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
   * Installs the accessory.
   *
   * @access  public
   * @return  void
   */
  public function install()
  {
    // Does nothing.
  }


  /**
   * Uninstalls the accessory.
   *
   * @access  public
   * @return  void
   */
  public function uninstall()
  {
    // Does nothing.
  }


  /**
   * Updates the accessory.
   *
   * @access  public
   * @return  bool
   */
  public function update()
  {
    return TRUE;
  }


}


/* End of file      : {pkg_name_lc}_accessory_model.php */
/* File location    : third_party/{pkg_name_lc}/models/{pkg_name_lc}_accessory_model.php */
