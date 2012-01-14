<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {pkg_title} plugin model.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

class {pkg_name}_plugin_model extends CI_Model {

  private $EE;


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
    $this->EE =& get_instance();
  }


}


/* End of file      : {pkg_name_lc}_plugin_model.php */
/* File location    : third_party/{pkg_name_lc}/models/{pkg_name_lc}_plugin_model.php */
