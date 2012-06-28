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
    $acc_sections   = array();
    $post_sections  = $this->input->post('acc_sections', TRUE);

    if (is_array($post_sections))
    {
      foreach ($post_sections AS $section)
      {
        if ( ! $section['name'] OR ! $section['title'])
        {
          continue;
        }

        $section_name = strtolower($section['name']);

        $acc_sections[] = array(
          'name'    => ucfirst($section_name),
          'name_lc' => $section_name,
          'title'   => $section['title']
        );
      }

      // Alphabetise by section name.
      usort($acc_sections, function($a, $b) {
        return $a['name'] <= $b['name'] ? -1 : 1;});
    }

    return array('acc_sections' => $acc_sections);
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
        'input' => 'themes/third_party/package/css/acc.css',
        'output' => 'themes/third_party/{pkg_name_lc}/css/acc.css'
      ),
      array(
        'input' => 'themes/third_party/package/js/acc.js',
        'output' => 'themes/third_party/{pkg_name_lc}/js/acc.js'
      ),
      array(
        'input' => 'third_party/package/acc.package.php',
        'output' => 'third_party/{pkg_name_lc}/acc.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/language/english/package_acc_lang.php',
        'output' => 'third_party/{pkg_name_lc}/language/english/{pkg_name_lc}_acc_lang.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.acc_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.acc_{pkg_name_lc}.php'
      )
    );

    $post_sections = $this->input->post('acc_sections', TRUE);

    if (is_array($post_sections))
    {
      foreach ($post_sections AS $section)
      {
        $output = 'third_party/{pkg_name_lc}/views/acc_'
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
   * Retrieves the datatype POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_custom_datatype_data()
  {
    $input = $this->input;

    $return = array(
      'copyright_year'  => date('Y'),
      'dt_name'         => ucfirst(strval($input->post('dt_name', TRUE))),
      'dt_name_lc'      => strtolower(strval($input->post('dt_name', TRUE))),
      'dt_props'        => array(),
      'dt_title'        => (string) $input->post('dt_title', TRUE)
    );

    $post_props = $this->input->post('dt_props', TRUE);

    if ( ! is_array($post_props))
    {
      return $return;
    }

    foreach ($post_props AS $post_prop)
    {
      if ( ! is_array($post_prop)
        OR ! isset($post_prop['datatype'])
        OR ! isset($post_prop['name'])
        OR ! isset($post_prop['title'])
      )
      {
        continue;
      }

      // @todo : type hinting.
      // @todo : default values.
      // @todo : convert name to lowercase.

      $return['dt_props'][] = $post_prop;
    }

    // @todo : sort the properties by name.

    return $return;
  }


  /**
   * Returns an array of Datatype files, based on the requested options.
   *
   * @access  public
   * @return  array
   */
  public function get_custom_datatype_files()
  {
    // @todo : tests.

    return array(
      array(
        'input' => 'third_party/package/classes/EI_datatype.php',
        'output' => 'third_party/{pkg_name_lc}/classes/EI_datatype.php'
      ),
      array(
        'input' => 'third_party/package/classes/datatype.php',
        'output' => 'third_party/{pkg_name_lc}/classes/{dt_name_lc}.php'
      )
    );
  }


  /**
   * Retrieves the Extension POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_extension_data()
  {
    $input = $this->input;

    $return = array(
      'ext_has_cp'  => ($input->post('ext_has_cp', TRUE) == 'y'),
      'ext_hooks'   => array()
    );

    $post_hooks = $input->post('ext_hooks', TRUE);

    if ( ! is_array($post_hooks))
    {
      return $return;
    }

    foreach ($post_hooks AS $post_hook)
    {
      if ( ! $post_hook)
      {
        continue;
      }

      // Single array element for now, but will grow over time.
      $return['ext_hooks'][] = array('hook' => strtolower($post_hook['hook']));
    }

    // Alphabetise by hook name.
    usort($return['ext_hooks'], function($a, $b) {
      return $a['hook'] <= $b['hook'] ? -1 : 1;});

    return $return;
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
        'input' => 'themes/third_party/package/css/ext.css',
        'output' => 'themes/third_party/{pkg_name_lc}/css/ext.css'
      ),
      array(
        'input' => 'themes/third_party/package/js/ext.js',
        'output' => 'themes/third_party/{pkg_name_lc}/js/ext.js'
      ),
      array(
        'input' => 'third_party/package/ext.package.php',
        'output' => 'third_party/{pkg_name_lc}/ext.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/language/english/package_ext_lang.php',
        'output' => 'third_party/{pkg_name_lc}/language/english/{pkg_name_lc}_ext_lang.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.ext_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.ext_{pkg_name_lc}.php'
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
      'simple_commerce_evaluate_ipn_response',
      'simple_commerce_evaluate_perform_actions_end',
      'simple_commerce_evaluate_perform_actions_start',
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
    $ft_data = array();

    // Yes / No fields.
    $boolean_fields = array(
      'ft_custom_columns', 'ft_field_settings',
      'ft_global_settings', 'ft_low_variables',
      'ft_matrix', 'ft_post_save',
      'ft_post_save_settings'
    );

    foreach ($boolean_fields AS $field_name)
    {
      $ft_data[$field_name] = ($this->input->post($field_name, TRUE) == 'y');
    }

    // Template tags.
    $ft_data['ft_tags'] = array();

    if (is_array(($post_tags = $this->input->post('ft_tags', TRUE))))
    {
      foreach ($post_tags AS $tag)
      {
        if ( ! $tag['description'] OR ! $tag['name'])
        {
          continue;
        }

        $ft_data['ft_tags'][] = $tag;
      }

      // Alphabetise by tag name.
      usort($ft_data['ft_tags'], function($a, $b) {
        return $a['name'] <= $b['name'] ? -1 : 1;});
    }

    return $ft_data;
  }


  public function get_fieldtype_files()
  {
    return array(
      array(
        'input' => 'themes/third_party/package/css/ft.css',
        'output' => 'themes/third_party/{pkg_name_lc}/css/ft.css'
      ),
      array(
        'input' => 'themes/third_party/package/js/ft.js',
        'output' => 'themes/third_party/{pkg_name_lc}/js/ft.js'
      ),
      array(
        'input' => 'third_party/package/ft.package.php',
        'output' => 'third_party/{pkg_name_lc}/ft.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/language/english/package_ft_lang.php',
        'output' => 'third_party/{pkg_name_lc}/language/english/{pkg_name_lc}_ft_lang.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.ft_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.ft_{pkg_name_lc}.php'
      )
    );
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
        if ( ! $action['description'] OR ! $action['method'])
        {
          continue;
        }

        $mod_actions[] = $action;
      }
    }

    // Alphabetise by action method.
    usort($mod_actions, function($a, $b) {
      return $a['method'] <= $b['method'] ? -1 : 1;});

    // Module template tags.
    $mod_tags = array();

    if (is_array(($post_tags = $this->input->post('mod_tags', TRUE))))
    {
      foreach ($post_tags AS $tag)
      {
        if ( ! $tag['description'] OR ! $tag['name'])
        {
          continue;
        }

        $mod_tags[] = $tag;
      }

      // Alphabetise by tag name.
      usort($mod_tags, function($a, $b) {
        return $a['name'] <= $b['name'] ? -1 : 1;});
    }

    // Module CP pages.
    $has_cp     = ($this->input->post('mod_has_cp', TRUE) == 'y');
    $mod_pages  = array();
    $post_pages = $this->input->post('mod_cp_pages', TRUE);

    if ($has_cp && is_array($post_pages))
    {
      foreach ($post_pages AS $page)
      {
        if ( ! $page['name'] OR ! $page['title'])
        {
          continue;
        }

        $page_name = strtolower($page['name']);

        $mod_pages[] = array(
          'name'    => ucfirst($page_name),
          'name_lc' => $page_name,
          'title'   => $page['title']
        );
      }
    }

    // Alphabetise by page name.
    usort($mod_pages, function($a, $b) {
      return $a['name'] <= $b['name'] ? -1 : 1;});


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
        'input' => 'themes/third_party/package/css/mod.css',
        'output' => 'themes/third_party/{pkg_name_lc}/css/mod.css'
      ),
      array(
        'input' => 'themes/third_party/package/js/mod.js',
        'output' => 'themes/third_party/{pkg_name_lc}/js/mod.js'
      ),
      array(
        'input' => 'third_party/package/mcp.package.php',
        'output' => 'third_party/{pkg_name_lc}/mcp.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/mod.package.php',
        'output' => 'third_party/{pkg_name_lc}/mod.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/upd.package.php',
        'output' => 'third_party/{pkg_name_lc}/upd.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.mcp_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.mcp_{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.mod_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.mod_{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.upd_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.upd_{pkg_name_lc}.php'
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
          'output' => 'third_party/{pkg_name_lc}/views/mod_' .$page_name .'.php'
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
      'pkg_include_acc' => ($input->post('pkg_include_acc', TRUE) == 'y'),
      'pkg_include_ext' => ($input->post('pkg_include_ext', TRUE) == 'y'),
      'pkg_include_ft'  => ($input->post('pkg_include_ft', TRUE) == 'y'),
      'pkg_include_mod' => ($input->post('pkg_include_mod', TRUE) == 'y'),
      'pkg_include_pi'  => ($input->post('pkg_include_pi', TRUE) == 'y'),
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
        'input' => 'themes/third_party/package/css/common.css',
        'output' => 'themes/third_party/{pkg_name_lc}/css/common.css'
      ),
      array(
        'input' => 'themes/third_party/package/js/common.js',
        'output' => 'themes/third_party/{pkg_name_lc}/js/common.js'
      ),
      array(
        'input' => 'third_party/package/config.php',
        'output' => 'third_party/{pkg_name_lc}/config.php'
      ),
      array(
        'input' => 'third_party/package/language/english/package_lang.php',
        'output' => 'third_party/{pkg_name_lc}/language/english/{pkg_name_lc}_lang.php'
      ),
      array(
        'input' => 'third_party/package/models/package_model.php',
        'output' => 'third_party/{pkg_name_lc}/models/{pkg_name_lc}_model.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.package_model.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.{pkg_name_lc}_model.php'
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
   * Returns an array of package "Helper" files, based on the requested options.
   *
   * @access  public
   * @return  array
   */
  public function get_package_helper_files()
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
        'output' => 'third_party/{pkg_name_lc}/helpers/' .$post_helper .'.php'
      );
    }

    return $helpers;
  }


  /**
   * Retrieves the Plugin POST data.
   *
   * @access  public
   * @return  array
   */
  public function get_plugin_data()
  {
    $tags = array();
    $post_tags = $this->input->post('pi_tags', TRUE);

    if (is_array($post_tags))
    {
      foreach ($post_tags AS $post_tag)
      {
        if ( ! $post_tag['description'] OR ! $post_tag['name'])
        {
          continue;
        }

        $post_tag['name'] = strtolower($post_tag['name']);
        $tags[] = $post_tag;
      }

      // Alphabetise by tag name.
      usort($tags, function($a, $b) {
        return $a['name'] <= $b['name'] ? -1 : 1;});
    }

    return array('pi_tags' => $tags);
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
        'output' => 'third_party/{pkg_name_lc}/pi.{pkg_name_lc}.php'
      ),
      array(
        'input' => 'third_party/package/tests/test.pi_package.php',
        'output' => 'third_party/{pkg_name_lc}/tests/test.pi_{pkg_name_lc}.php'
      )
    );
  }


}


/* End of file      : package_model.php */
/* File location    : application/models/package_model.php */
