<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {{ pkg_title }} plugin model.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once dirname(__FILE__) .'/{{ pkg_name_lc }}_model.php';

class {{ pkg_name }}_plugin_model extends {{ pkg_name }}_model {

  /* --------------------------------------------------------------
  * PUBLIC METHODS
  * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   string  $package_name     Package name. Used for testing.
   * @param   string  $package_title    Package title. Used for testing.
   * @param   string  $package_version  Package version. Used for testing.
   * @param   string  $namespace        Session namespace. Used for testing.
   * @return  void
   */
  public function __construct($package_name = '', $package_title = '',
    $package_version = '', $namespace = ''
  )
  {
    parent::__construct($package_name, $package_title, $package_version,
      $namespace);
  }


}


/* End of file      : {{ pkg_name_lc }}_plugin_model.php */
/* File location    : third_party/{{ pkg_name_lc }}/models/{{ pkg_name_lc }}_plugin_model.php */