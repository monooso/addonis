<?php

/**
 * Package model.
 *
 * @author        Stephen Lewis
 * @package       Addonis
 */

class Package_model extends CI_Model {

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
   * Retrieves the Accessory POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_accessory_data()
  {
    return array();
  }


  /**
   * Returns an array of Datatype files, based on the requested options.
   *
   * @access  public
   * @return  array
   */
  public function get_datatype_files()
  {
    return array();
  }


  /**
   * Retrieves the Extension POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_extension_data()
  {
    return array();
  }


  /**
   * Retrieves the Fieldtype POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_fieldtype_data()
  {
    return array();
  }


  /**
   * Returns an array of Helper files, based on the requested options.
   *
   * @access  public
   * @return  array
   */
  public function get_helper_files()
  {
    $helpers      = array();
    $post_helpers = $this->input->post('helpers', TRUE);

    if ( ! is_array($post_helpers))
    {
      return $helpers;
    }

    foreach ($post_helpers AS $post_helper)
    {
      $helpers[] = 'third_party/package/helpers/' .$post_helper .'.php';
    }

    return $helpers;
  }


  /**
   * Returns an array of Library files, based on the requested options.
   *
   * @access  public
   * @return  array
   */
  public function get_library_files()
  {
    return array();
  }


  /**
   * Retrieves the Module POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_module_data()
  {
    // Module actions.
    $mod_actions  = array();
    $post_actions = $this->input->post('mod_actions', TRUE);

    if (is_array($post_actions))
    {
      foreach ($post_actions AS $action)
      {
        $mod_actions[] = array(
          'mod_action_description'  => $action['description'],
          'mod_action_method'       => $action['method']
        );
      }
    }

    // Module template tags.
    $mod_tags   = array();
    $post_tags  = $this->input->post('mod_tags', TRUE);

    if (is_array($post_tags))
    {
      foreach ($post_tags AS $tag)
      {
        $mod_tags[] = array(
          'mod_tag_description' => $tag['description'],
          'mod_tag_name'        => $tag['name']
        );
      }
    }

    // Build the return array.
    return array(
      'mod_actions'   => $mod_actions,
      'mod_has_cp'    => ($this->input->post('mod_has_cp', TRUE) == 'y'),
      'mod_tags'      => $mod_tags
    );
  }


  /**
   * Returns an array of template files required by a Module.
   *
   * @access  public
   * @return  array
   */
  public function get_module_files()
  {
    return array(
      'third_party/package/mcp.package.php',
      'third_party/package/mod.package.php',
      'third_party/package/upd.package.php',
      'third_party/package/models/package_module_model.php',
      'third_party/package/tests/test.mcp_package.php',
      'third_party/package/tests/test.mod_package.php',
      'third_party/package/tests/test.package_module_model.php',
      'third_party/package/tests/test.upd_package.php'

      /* @TODO : CP view files */
    );
  }


  /**
   * Retrieves the Package POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_package_data()
  {
    $input = $this->input;

    return array(
      'copyright_year'  => date('Y'),
      'pkg_description' => (string) $input->post('pkg_description', TRUE),
      'pkg_license'     => (string) $input->post('pkg_license', TRUE),
      'pkg_name'        => ucfirst(strval($input->post('pkg_name', TRUE))),
      'pkg_name_lc'     => strtolower(strval($input->post('pkg_name', TRUE))),
      'pkg_title'       => (string) $input->post('pkg_title', TRUE),
      'pkg_version'     => (string) $input->post('pkg_version', TRUE)
    );
  }


  /**
   * Returns an array of template files required by every Package.
   *
   * @access  public
   * @return  array
   */
  public function get_package_files()
  {
    $files = array(
      'README.md',
      'third_party/package/language/english/package_lang.php',
      'third_party/package/models/package_model.php',
      'third_party/package/tests/test.package_model.php'
    );

    /**
     * Licenses are a bit trickier, because conditionals aren't supported
     * in the template files themselves (yet). As such, we need to include the
     * appropriate license file from a number of options.
     */

    $post_license = $this->input->post('pkg_license', TRUE);

    if (in_array($post_license, array('client', 'commercial', 'free')))
    {
      $files[] = 'LICENSE_' .strtoupper($post_license) .'.txt';
    }

    return $files;
  }


  /**
   * Retrieves the Plugin POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_plugin_data()
  {
    return array();
  }


}


/* End of file      : package_model.php */
/* File location    : application/models/package_model.php */
