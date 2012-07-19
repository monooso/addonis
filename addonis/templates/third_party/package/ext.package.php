<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {{ pkg_title }} extension.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

class {{ pkg_name }}_ext {

  private $EE;
  private $_model;

  public $description;
  public $docs_url;
  public $name;
  public $settings;
  public $settings_exist;
  public $version;


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   mixed     $settings     Extension settings.
   * @return  void
   */
  public function __construct($settings = '')
  {
    $this->EE =& get_instance();

    $this->EE->load->add_package_path(PATH_THIRD .'{{ pkg_name_lc }}/');

    // Still need to specify the package...
    $this->EE->lang->loadfile('{{ pkg_name_lc }}_ext', '{{ pkg_name_lc }}');

    $this->EE->load->model('{{ pkg_name_lc }}_model');
    $this->_model = $this->EE->{{ pkg_name_lc }}_model;

    // Set the public properties.
    $this->description = $this->EE->lang->line(
      '{{ pkg_name_lc }}_extension_description');

    $this->docs_url = 'http://experienceinternet.co.uk/';
    $this->name     = $this->EE->lang->line('{{ pkg_name_lc }}_extension_name');
    $this->settings = $settings;
    $this->settings_exist = {% if ext_has_cp %}'y'{% else %}'n'{% endif %};
    $this->version  = $this->_model->get_package_version();
  }


  /**
   * Activates the extension.
   *
   * @access  public
   * @return  void
   */
  public function activate_extension()
  {
    $hooks = array({% for hook in ext_hooks %}
      '{{ hook.hook }}'{% if not loop.last %}, {% endif %}{% endfor %}
    );

    $this->_model->install_extension($this->version, $hooks);
  }


  /**
   * Disables the extension.
   *
   * @access  public
   * @return  void
   */
  public function disable_extension()
  {
    $this->_model->uninstall_extension();
  }

{% for hook in ext_hooks %}

  /**
   * Handles the {{ hook.hook }} extension hook.
   *
   * @access  public
   * @return  void
   */
  public function on_{{ hook.hook }}()
  {
    if (($last_call = $this->EE->extensions->last_call) !== FALSE)
    {
      // Retrieve last call data.
    }

    error_log('Handling the {{ hook.hook }} extension hook.');
  }

{% endfor %}

  /**
   * Updates the extension.
   *
   * @access  public
   * @param   string    $installed_version    The installed version.
   * @return  mixed
   */
  public function update_extension($installed_version = '')
  {
    return $this->_model->update_package($installed_version);
  }


}


/* End of file      : ext.{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/ext.{{ pkg_name_lc }}.php */
