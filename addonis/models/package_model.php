<?php

/**
 * Package model.
 *
 * @author        Stephen Lewis (http://github.com/experience/)
 * @copyright     Experience Internet
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
    $data = array('ext_hooks' => array());

    if (is_array(($post_hooks = $this->input->post('ext_hooks', TRUE))))
    {
      foreach ($post_hooks AS $hook)
      {
        $data['ext_hooks'][] = array(
          'ext_hook_description'  => $hook['description'],
          'ext_hook_hook'         => strtolower($hook['hook'])
        );
      }
    }

    // Alphabetise by hook name.
    usort($data, function($a, $b) {
      return $a['ext_hook_hook'] <= $b['ext_hook_hook'] ? -1 : 1;});

    return $data;
  }


  /**
   * Returns an array of template files required by an Extension.
   *
   * @access  public
   * @return  array
   */
  public function get_extension_files()
  {
    return array(
      array(
        'input' => 'third_party/package/ext.package.php',
        'output' => 'third_party/package/ext.package.php'
      ),
      array(
        'input' => 'third_party/package/models/package_extension_model.php',
        'output' => 'third_party/package/models/package_extension_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.package_extension_model.php',
        'output' => 'third_party/package/tests/test.package_extension_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.ext_package.php',
        'output' => 'third_party/package/tests/test.ext_package.php'
      )
    );
  }


  /**
   * Returns an array of all the available extension hooks.
   *
   * @access  public
   * @return  array
   */
  public function get_extension_hooks()
  {
    return array(
      'channel_entries_query_result',
      'channel_entries_row',
      'channel_entries_tagdata',
      'channel_entries_tagdata_end',
      'channel_module_calendar_start',
      'channel_module_categories_start',
      'channel_module_category_heading_start',
      'comment_entries_comment_format',
      'comment_entries_tagdata',
      'comment_form_end',
      'comment_form_hidden_fields',
      'comment_form_tagdata',
      'comment_preview_comment_format',
      'comment_preview_tagdata',
      'cp_css_end',
      'cp_js_end',
      'cp_member_login',
      'cp_member_logout',
      'cp_members_member_create',
      'cp_members_member_create',
      'cp_members_member_create_start',
      'cp_members_member_create_start',
      'cp_members_member_delete_end',
      'cp_members_validate_members',
      'cp_menu_array',
      'create_captcha_start',
      'delete_comment_additional',
      'delete_entries_end',
      'delete_entries_loop',
      'delete_entries_start',
      'edit_template_start',
      'email_module_send_email_end',
      'email_module_tellafriend_override',
      'entry_submission_absolute_end',
      'entry_submission_end',
      'entry_submission_ready',
      'entry_submission_redirect',
      'entry_submission_start',
      'files_after_delete',
      'foreign_character_conversion_array',
      'foreign_character_conversion_array',
      'foreign_character_conversion_array',
      'foreign_character_conversion_array',
      'form_declaration_modify_data',
      'form_declaration_return',
      'insert_comment_end',
      'insert_comment_insert_array',
      'insert_comment_preferences_sql',
      'insert_comment_start',
      'login_authenticate_start',
      'member_edit_preferences',
      'member_member_login_multi',
      'member_member_login_single',
      'member_member_login_start',
      'member_member_logout',
      'member_member_register',
      'member_member_register',
      'member_member_register_start',
      'member_member_register_start',
      'member_register_validate_members',
      'member_update_preferences',
      'publish_form_channel_preferences',
      'publish_form_entry_data',
      'safecracker_entry_form_absolute_start',
      'safecracker_entry_form_tagdata_end',
      'safecracker_entry_form_tagdata_start',
      'safecracker_submit_entry_end',
      'safecracker_submit_entry_start',
      'submit_new_entry_start',
      'typography_parse_type_end',
      'typography_parse_type_start',
      'update_comment_additional',
      'update_multi_entries_loop',
      'update_multi_entries_start',
      'update_template_end'
    );
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
    $mod_actions = array();

    if (is_array(($post_actions = $this->input->post('mod_actions', TRUE))))
    {
      foreach ($post_actions AS $action)
      {
        $mod_actions[] = array(
          'mod_action_description'  => $action['description'],
          'mod_action_method'       => $action['method']
        );
      }
    }

    // Alphabetise by action method.
    usort($mod_actions, function($a, $b) {
      return $a['mod_action_method'] <= $b['mod_action_method'] ? -1 : 1;});


    // Module template tags.
    $mod_tags = array();

    if (is_array(($post_tags = $this->input->post('mod_tags', TRUE))))
    {
      foreach ($post_tags AS $tag)
      {
        $mod_tags[] = array(
          'mod_tag_description' => $tag['description'],
          'mod_tag_name'        => $tag['name']
        );
      }
    }

    // Alphabetise by tag name.
    usort($mod_tags, function($a, $b) {
      return $a['mod_tag_name'] <= $b['mod_tag_name'] ? -1 : 1;});


    // Module CP pages.
    $has_cp     = ($this->input->post('mod_has_cp', TRUE) == 'y');
    $mod_pages  = array();

    if ($has_cp
      && is_array(($post_pages = $this->input->post('mod_cp_pages', TRUE)))
    )
    {
      foreach ($post_pages AS $page)
      {
        $page_name = strtolower($page['name']);

        $mod_pages[] = array(
          'mod_cp_page_name'    => ucfirst($page_name),
          'mod_cp_page_name_lc' => $page_name,
          'mod_cp_page_title'   => $page['title']
        );
      }
    }

    // Alphabetise by page name.
    usort($mod_pages, function($a, $b) {
      return $a['mod_cp_page_name'] <= $b['mod_cp_page_name'] ? -1 : 1;});


    // Build the return array.
    return array(
      'mod_actions'   => $mod_actions,
      'mod_cp_pages'  => $mod_pages,
      'mod_has_cp'    => $has_cp,
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
    $files = array(
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

    $has_cp     = ($this->input->post('mod_has_cp', TRUE) == 'y');
    $post_pages = $this->input->post('mod_cp_pages', TRUE);

    if ($has_cp && is_array($post_pages))
    {
      foreach ($post_pages AS $page)
      {
        $page_name = strtolower($page['name']);

        $files[] = array(
          'input' => 'third_party/package/views/mod_cp.php',
          'output' => 'third_party/package/views/mod_' .$page_name .'.php'
        );
      }
    }

    // @TODO : Publish Tab files.

    return $files;
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
    $data = array('pi_tags' => array());

    if (is_array(($post_tags = $this->input->post('pi_tags', TRUE))))
    {
      foreach ($post_tags AS $tag)
      {
        $data['pi_tags'][] = array(
          'pi_tag_description'  => $tag['description'],
          'pi_tag_name'         => strtolower($tag['name'])
        );
      }
    }

    // Alphabetise by tag name.
    usort($return['pi_tags'], function($a, $b) {
      return $a['pi_tag_name'] <= $b['pi_tag_name'] ? -1 : 1;});

    return $data;
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
