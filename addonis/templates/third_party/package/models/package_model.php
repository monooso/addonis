<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {{ pkg_title }} 'Package' model.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once dirname(__FILE__) .'/../config.php';

class {{ pkg_name }}_model extends CI_Model {

  protected $EE;
  protected $_namespace;
  protected $_package_name;
  protected $_package_title;
  protected $_package_version;
  protected $_sanitized_extension_class;
  protected $_sanitized_module_class;
  protected $_site_id;


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   string    $package_name       Package name. Used for testing.
   * @param   string    $package_title      Package title. Used for testing.
   * @param   string    $package_version    Package version. Used for testing.
   * @param   string    $namespace          Session namespace. Used for testing.
   * @return  void
   */
  public function __construct($package_name = '', $package_title = '',
    $package_version = '', $namespace = ''
  )
  {
    parent::__construct();

    $this->EE =& get_instance();

    // Load the OmniLogger class.
    if (file_exists(PATH_THIRD .'omnilog/classes/omnilogger.php'))
    {
      include_once PATH_THIRD .'omnilog/classes/omnilogger.php';
    }

    $this->_namespace = $namespace ? strtolower($namespace) : 'experience';

    $this->_package_name = $package_name
      ? $package_name : {{ pkg_name|upper }}_NAME;

    $this->_package_title = $package_title
      ? $package_title : {{ pkg_name|upper}}_TITLE;

    $this->_package_version = $package_version
      ? $package_version : {{ pkg_name|upper }}_VERSION;

    // ExpressionEngine is very picky about capitalisation.
    {% if pkg_include_mod %}$this->_sanitized_module_class = ucfirst(strtolower($this->_package_name));{% endif %}
    {% if pkg_include_ext %}$this->_sanitized_extension_class = $this->_sanitized_module_class .'_ext';{% endif %}

    // Initialise the add-on cache.
    if ( ! array_key_exists($this->_namespace, $this->EE->session->cache))
    {
      $this->EE->session->cache[$this->_namespace] = array();
    }

    if ( ! array_key_exists($this->_package_name,
      $this->EE->session->cache[$this->_namespace]))
    {
      $this->EE->session->cache[$this->_namespace]
        [$this->_package_name] = array();
    }
  }



  /* --------------------------------------------------------------
   * PUBLIC PACKAGE METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Returns the package name.
   *
   * @access  public
   * @return  string
   */
  public function get_package_name()
  {
    return $this->_package_name;
  }


  /**
   * Returns the package theme URL.
   *
   * @access  public
   * @return  string
   */
  public function get_package_theme_url()
  {
    // Much easier as of EE 2.4.0.
    if (defined('URL_THIRD_THEMES'))
    {
      return URL_THIRD_THEMES .$this->get_package_name() .'/';
    }

    return $this->EE->config->slash_item('theme_folder_url')
      .'third_party/' .$this->get_package_name() .'/';
  }


  /**
   * Returns the package title.
   *
   * @access  public
   * @return  string
   */
  public function get_package_title()
  {
    return $this->_package_title;
  }


  /**
   * Returns the package version.
   *
   * @access  public
   * @return  string
   */
  public function get_package_version()
  {
    return $this->_package_version;
  }


  /**
   * Returns the site ID.
   *
   * @access  public
   * @return  int
   */
  public function get_site_id()
  {
    if ( ! $this->_site_id)
    {
      $this->_site_id = (int) $this->EE->config->item('site_id');
    }

    return $this->_site_id;
  }


  /**
   * Logs a message to OmniLog.
   *
   * @access  public
   * @param   string      $message        The log entry message.
   * @param   int         $severity       The log entry 'level'.
   * @return  void
   */
  public function log_message($message, $severity = 1)
  {
    if (class_exists('Omnilog_entry') && class_exists('Omnilogger'))
    {
      switch ($severity)
      {
        case 3:
          $notify = TRUE;
          $type   = Omnilog_entry::ERROR;
          break;

        case 2:
          $notify = FALSE;
          $type   = Omnilog_entry::WARNING;
          break;

        case 1:
        default:
          $notify = FALSE;
          $type   = Omnilog_entry::NOTICE;
          break;
      }

      $omnilog_entry = new Omnilog_entry(array(
        'addon_name'    => '{{ pkg_name }}',
        'date'          => time(),
        'message'       => $message,
        'notify_admin'  => $notify,
        'type'          => $type
      ));

      Omnilogger::log($omnilog_entry);
    }
  }


  /**
   * Updates a 'base' array with data contained in an 'update' array. Both
   * arrays are assumed to be associative.
   *
   * - Elements that exist in both the base array and the update array are
   *   updated to use the 'update' data.
   * - Elements that exist in the update array but not the base array are
   *   ignored.
   * - Elements that exist in the base array but not the update array are
   *   preserved.
   *
   * @access public
   * @param  array  $base   The 'base' array.
   * @param  array  $update The 'update' array.
   * @return array
   */
  public function update_array_from_input(Array $base, Array $update)
  {
    return array_merge($base, array_intersect_key($update, $base));
  }


  /**
   * Updates the package. Called from the 'update' methods of any package 
   * add-ons (module, extension, etc.), to ensure that everything gets updated 
   * at the same time.
   *
   * @access  public
   * @param   string    $installed_version    The installed version.
   * @return  bool
   */
  public function update_package($installed_version = '')
  {
    // Can't do anything without valid data.
    if ( ! is_string($installed_version) OR $installed_version == '')
    {
      return FALSE;
    }

    $package_version = $this->get_package_version();

    // Up to date?
    if (version_compare($installed_version, $package_version, '>='))
    {
      return FALSE;
    }
{% if pkg_include_ext %}
    // Update the extension version number in the database.
    $this->EE->db->update('extensions', array('version' => $package_version),
      array('class' => $this->get_sanitized_extension_class()));

{% endif %}
{% if pkg_include_mod %}
    /**
     * Update the module version number in the database. EE takes care of this 
     * if the module is being updated from the Modules page, but not if this 
     * update has been triggered from the Extensions page. Package updates in EE 
     * are a mess, basically.
     */

    $this->EE->db->update('modules',
      array('module_version' => $package_version),
      array('module_name'    => $this->get_sanitized_module_class()));

{% endif %}
    return TRUE;
  }

{% if pkg_include_ext %}

  /* --------------------------------------------------------------
   * PUBLIC EXTENSION METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Returns the correctly-capitalised 'extension' class.
   *
   * @access  public
   * @return  string
   */
  public function get_sanitized_extension_class()
  {
    return $this->_sanitized_extension_class;
  }


  /**
   * Installs the extension.
   *
   * @access  public
   * @param   string    $version    The extension version.
   * @param   array     $hooks      The extension hooks.
   * @return  void
   */
  public function install_extension($version, Array $hooks)
  {
    // Guard against nonsense.
    if ( ! is_string($version) OR $version == '' OR ! $hooks)
    {
      return;
    }

    $class = $this->get_sanitized_extension_class();

    $default_hook_data = array(
      'class'     => $class,
      'enabled'   => 'y',
      'hook'      => '',
      'method'    => '',
      'priority'  => '5',
      'settings'  => '',
      'version'   => $version
    );

    foreach ($hooks AS $hook)
    {
      if ( ! is_string($hook) OR $hook == '')
      {
        continue;
      }

      $this->EE->db->insert('extensions', array_merge(
        $default_hook_data, array('hook' => $hook, 'method' => 'on_' .$hook)));
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
      array('class' => $this->get_sanitized_extension_class()));
  }

{% endif %}
{% if pkg_include_mod %}

  /* --------------------------------------------------------------
   * PUBLIC MODULE METHODS
   * ------------------------------------------------------------ */

  /**
   * Returns the correctly-capitalised 'module' class.
   *
   * @access  public
   * @return  string
   */
  public function get_sanitized_module_class()
  {
    return $this->_sanitized_module_class;
  }


  /**
   * Installs the module.
   *
   * @access  public
   * @param   string    $package_version  The package version.
   * @return  bool
   */
  public function install_module($package_version)
  {
    if ( ! is_string($package_version) OR $package_version == '')
    {
      return FALSE;
    }

    $mod_class = $this->get_sanitized_module_class();

    $this->_register_module($mod_class, $package_version);
    {% if mod_actions %}$this->_register_module_actions($mod_class);{% endif %}
    $this->_create_module_tables();

    return TRUE;
  }


  /**
   * Uninstalls the module.
   *
   * @access  public
   * @return  bool
   */
  public function uninstall_module()
  {
    $mod_class = $this->get_sanitized_module_class();

    $db_module = $this->EE->db
      ->select('module_id')
      ->get_where('modules', array('module_name' => $mod_class), 1);

    if ($db_module->num_rows() !== 1)
    {
      return FALSE;
    }

    $this->EE->db->delete('module_member_groups',
      array('module_id' => $db_module->row()->module_id));

    $this->EE->db->delete('modules', array('module_name' => $mod_class));
    {% if mod_actions %}$this->EE->db->delete('actions', array('class' => $mod_class));{% endif %}

    // Drop the module tables.
    $this->EE->load->dbforge();
    $this->EE->dbforge->drop_table('example_table');

    return TRUE;
  }

{% endif %}
  
  /* --------------------------------------------------------------
   * PUBLIC ADD-ON SPECIFIC METHODS
   * ------------------------------------------------------------ */



  /* --------------------------------------------------------------
   * PROTECTED PACKAGE METHODS
   * ------------------------------------------------------------ */

  /**
   * Returns a references to the package cache. Should be called
   * as follows: $cache =& $this->_get_package_cache();
   *
   * @access  protected
   * @return  array
   */
  protected function &_get_package_cache()
  {
    return $this->EE->session->cache[$this->_namespace][$this->_package_name];
  }

{% if pkg_include_mod %}

  /* --------------------------------------------------------------
   * PROTECTED MODULE METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Creates the module database tables.
   *
   * @access  protected
   * @return  void
   */
  protected function _create_module_tables()
  {
    $this->EE->load->dbforge();

    // Notification events.
    $example_schema = array(
      'example_id' => array(
        'auto_increment'  => TRUE,
        'constraint'      => 10,
        'type'            => 'INT',
        'unsigned'        => TRUE
      ),
      'site_id' => array(
        'constraint'  => 5,
        'type'        => 'INT',
        'unsigned'    => TRUE
      )
    );

    // Should ideally have foreign key for site_id.
    $this->EE->dbforge->add_field($example_schema);
    $this->EE->dbforge->add_key('example_id', TRUE);
    $this->EE->dbforge->create_table('example_table', TRUE);
  }


  /**
   * Registers the module in the database.
   *
   * @access  protected
   * @param   string    $module_class     The module class.
   * @param   string    $package_version  The package version.
   * @return  void
   */
  protected function _register_module($module_class, $package_version)
  {
    $this->EE->db->insert('modules', array(
      'has_cp_backend'      => 'y',
      'has_publish_fields'  => 'n',
      'module_name'         => $module_class,
      'module_version'      => $package_version
    ));
  }

{% if mod_actions %}

  /**
   * Register the module actions in the database.
   *
   * @access  protected
   * @param   string    $module_class     The module class.
   * @return  void
   */
  protected function _register_module_actions($module_class)
  {
    $insert_data = array(
{% for action in mod_actions %}
      array(
        'class'   => $module_class,
        'method'  => '{{ action.method }}'
      ){% if not loop.last %},
{% endif %}
{% endfor %}
    );

    $this->EE->db->insert_batch('actions', $insert_data);
  }

{% endif %}
{% endif %}

}


/* End of file      : {{ pkg_name_lc }}_model.php */
/* File location    : third_party/{{ pkg_name_lc }}/models/{{ pkg_name_lc }}_model.php */
