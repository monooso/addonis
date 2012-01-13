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
    $return = array('acc_sections' => array());
    $post_sections = $this->input->post('acc_sections', TRUE);

    if (is_array($post_sections))
    {
      foreach ($post_sections AS $section)
      {
        $section_name = strtolower($section['name']);

        $return['acc_sections'][] = array(
          'acc_section_name'    => ucfirst($section_name),
          'acc_section_name_lc' => $section_name,
          'acc_section_title'   => $section['title']
        );
      }
    }

    return $return;
  }


  /**
   * Returns an array of template files required by an Accessory.
   *
   * @access  public
   * @return  array
   */
  public function get_accessory_files()
  {
    $files = array(
      array(
        'input' => 'third_party/package/acc.package.php',
        'output' => 'third_party/package/acc.package.php'
      ),
      array(
        'input' => 'third_party/package/models/package_accessory_model.php',
        'output' => 'third_party/package/models/package_accessory_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.acc_package.php',
        'output' => 'third_party/package/tests/test.acc_package.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.package_accessory_model.php',
        'output' => 'third_party/package/tests/test.package_accessory_model.php'
      )
    );

    $post_sections = $this->input->post('acc_sections', TRUE);

    if (is_array($post_sections))
    {
      foreach ($post_sections AS $section)
      {
        $output = 'third_party/package/views/acc_'
          .strtolower($section['name']) .'.php';

        $files[] = array(
          'input' => 'third_party/package/views/acc_section.php',
          'output' => $output
        );
      }
    }

    return $files;
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
      $helpers[] = array(
        'input' => 'third_party/package/helpers/' .$post_helper .'.php',
        'output' => 'third_party/package/helpers/' .$post_helper .'.php'
      );
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
      array(
        'input' => 'third_party/package/mcp.package.php',
        'output' => 'third_party/package/mcp.package.php'
      ),
      array(
        'input' => 'third_party/package/mod.package.php',
        'output' => 'third_party/package/mod.package.php'
      ),
      array(
        'input' => 'third_party/package/upd.package.php',
        'output' => 'third_party/package/upd.package.php'
      ),
      array(
        'input' => 'third_party/package/models/package_module_model.php',
        'output' => 'third_party/package/models/package_module_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.mcp_package.php',
        'output' => 'third_party/package/tests/test.mcp_package.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.mod_package.php',
        'output' => 'third_party/package/tests/test.mod_package.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.package_module_model.php',
        'output' => 'third_party/package/tests/test.package_module_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.upd_package.php',
        'output' => 'third_party/package/tests/test.upd_package.php'
      )
    );

    // @TODO : CP view files.
    // @TODO : Publish Tab files.
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
      array(
        'input' => 'README.md',
        'output' => 'README.md'
      ),
      array(
        'input' => 'third_party/package/language/english/package_lang.php',
        'output' => 'third_party/package/language/english/package_lang.php'
      ),
      array(
        'input' => 'third_party/package/models/package_model.php',
        'output' => 'third_party/package/models/package_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.package_model.php',
        'output' => 'third_party/package/tests/test.package_model.php'
      )
    );

    /**
     * Licenses are a bit trickier, because conditionals aren't supported
     * in the template files themselves (yet). As such, we need to include the
     * appropriate license file from a number of options.
     */

    $post_license = $this->input->post('pkg_license', TRUE);

    if (in_array($post_license, array('client', 'commercial', 'free')))
    {
      $files[] = array(
        'input' => 'LICENSE_' .strtoupper($post_license) .'.txt',
        'output' => 'LICENSE.txt'
      );
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
    // Plugin template tags.
    $return     = array('pi_tags' => array());
    $post_tags  = $this->input->post('pi_tags', TRUE);

    if (is_array($post_tags))
    {
      foreach ($post_tags AS $tag)
      {
        $return['pi_tags'][] = array(
          'pi_tag_description'  => $tag['description'],
          'pi_tag_name'         => $tag['name']
        );
      }
    }

    return $return;
  }


  /**
   * Returns an array of template files required by a Plugin.
   *
   * @access  public
   * @return  array
   */
  public function get_plugin_files()
  {
    return array(
      array(
        'input' => 'third_party/package/pi.package.php',
        'output' => 'third_party/package/pi.package.php'
      ),
      array(
        'input' => 'third_party/package/models/package_plugin_model.php',
        'output' => 'third_party/package/models/package_plugin_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.package_plugin_model.php',
        'output' => 'third_party/package/tests/test.package_plugin_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.pi_package.php',
        'output' => 'third_party/package/tests/test.pi_package.php'
      )
    );
  }


}


/* End of file      : package_model.php */
/* File location    : application/models/package_model.php */
