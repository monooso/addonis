<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {{ pkg_title }} fieldtype.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

// Thanks to the  public $info property, we need to load the config here. Bah.
require_once dirname(__FILE__) .'/config.php';

class {{ pkg_name }}_ft extends EE_Fieldtype {

  private $_model;

  /**
   * Stupid EE forces us to do this here, rather than calling the appropriate
   * model methods from the Constructor.
   */

  public $info = array(
    'name'    => OPTIONS_TITLE,
    'version' => OPTIONS_VERSION
  );


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
  public function __construct()
  {
    $this->EE =& get_instance();

    $this->EE->load->add_package_path(PATH_THIRD .'{{ pkg_name_lc }}/');
    $this->EE->lang->loadfile('{{ pkg_name_lc }}_ft', '{{ pkg_name_lc }}');

    // Load the model.
    $this->EE->load->model('{{ pkg_name_lc }}_model');
    $this->_model = $this->EE->{{ pkg_name_lc }}_model;
  }


  /**
   * Tidies up after one or more entries are deleted.
   *
   * @access public
   * @param  array $entry_ids The IDs of the deleted entries.
   * @return void
   */
  public function delete(Array $entry_ids)
  {

  }


  /**
   * Displays the fieldtype on the Publish / Edit page.
   *
   * @access public
   * @param  string $data Previously saved field data.
   * @return string
   */
  public function display_field($data = '')
  {

  }

{% if ft_global_settings %}

  /**
   * Displays the global settings form. The current global settings are
   * available via the $this->settings property.
   *
   * @access public
   * @return string
   */
  public function display_global_settings()
  {

  }

{% endif %}
{% if ft_field_settings %}

  /**
   * Displays the fieldtype settings form.
   *
   * @access public
   * @param  array $settings Previously-saved settings.
   * @return string
   */
  public function display_settings(Array $settings = array())
  {

  }

{% endif %}

  /**
   * Installs the fieldtype, and sets the default values.
   *
   * @access public
   * @return array
   */
  public function install()
  {
    return $this->_model->install_fieldtype();
  }

{% if ft_post_save %}

  /**
   * Performs additional processing after the entry has been saved.
   *
   * @access public
   * @param  string $data The submitted field data.
   * @return void
   */
  public function post_save($data)
  {

  }

{% endif %}
{% if ft_post_save_settings %}

  /**
   * Performs additional processing after a field has been created or modified.
   *
   * @access public
   * @param  string $settings The submitted settings.
   * @return void
   */
  public function post_save_settings($settings)
  {

  }

{% endif %}

  /**
   * Processes the field data in preparation for the "replace tag" method(s).
   * Performing the prep work here minimises the overhead when a template
   * contains multiple fieldtype tags.
   *
   * @access public
   * @param  string $data The fieldtype data.
   * @return mixed  The prepped data.
   */
  public function pre_process($data)
  {

  }


  /**
   * Displays the fieldtype in a template.
   *
   * @access public
   * @param  string $data    The saved field data.
   * @param  array  $params  The tag parameters.
   * @param  string $tagdata The tag data (for tag pairs).
   * @return string The modified tagdata.
   */
  public function replace_tag($data, Array $params = array(), $tagdata = '')
  {

  }

{% if ft_tags %}
{% for tag in ft_tags %}

  /**
   * {{ tag.description }}
   *
   * @access public
   * @param  string $data    The saved field data.
   * @param  array  $params  The tag parameters.
   * @param  string $tagdata The tag data (for tag pairs).
   * @return string The modified tagdata.
   */
  public function replace_{{ tag.name }}($data, Array $params = array(), $tagdata = '')
  {

  }

{% endfor %}
{% endif %}

  /**
   * Prepares the field data for saving to the databasae.
   *
   * @access public
   * @param  string $data The submitted field data.
   * @return string The data to save.
   */
  public function save($data)
  {

  }

{% if ft_global_settings %}

  /**
   * Saves the global fieldtype settings.
   *
   * @access public
   * @return array
   */
  public function save_global_settings()
  {

  }

{% endif %}
{% if ft_field_settings %}

  /**
   * Saves the fieldtype settings.
   *
   * @access public
   * @param  array $settings The submitted settings.
   * @return array
   */
  public function save_settings(Array $settings = array())
  {

  }

{% endif %}
{% if ft_custom_columns %}

  /**
   * Specifies fields to be created, modified or dropped from the
   * `exp_channel_data` table when a field is created, edited, or deleted.
   *
   * @access public
   * @param  array  $settings The field settings, and details of the action
   *                          being performed (`delete`, `add`, or `get_info`).
   * @return array  An array of fields.
   */
  public function settings_modify_column(Array $settings)
  {

  }

{% endif %}

  /**
   * Uninstalls the fieldtype.
   *
   * @access public
   * @return void
   */
  public function uninstall()
  {
    $this->_model->uninstall_fieldtype();
  }


  /**
   * Validates the submitted field data.
   *
   * @access public
   * @param  string $data The submitted field data.
   * @return bool
   */
  public function validate($data)
  {

  }

{% if ft_low_variables %}

  /* --------------------------------------------------------------
   * LOW VARIABLES
   * ------------------------------------------------------------ */

  /**
   * Displays the input field on the Low Variables home page.
   *
   * @access public
   * @param  string $var_data The current variable data.
   * @return string The input field HTML.
   */
  public function display_var_field($var_data)
  {

  }


  /**
   * Displays the Low Variables fieldtype settings form.
   *
   * @access public
   * @param  array  $var_settings Previously saved settings.
   * @return array  An array containing the name / label, and the form elements.
   */
  public function display_var_settings(Array $var_settings = array())
  {

  }


  /**
   * Displays the Low Variable in a template.
   *
   * @access public
   * @param  string $var_data The Low Variable field data.
   * @param  Array  $params   The tag parameters.
   * @param  string $tagdata  The tag data (for tag pairs).
   * @return string The modified tag data.
   */
  public function display_var_tag($var_data, Array $params, $tagdata)
  {

  }


  /**
   * Performs additional processing after the Low Variable has been saved.
   *
   * @access public
   * @param  string $var_data The submitted Low Variable data.
   * @return void
   */
  public function post_save_var($var_data)
  {

  }


  /**
   * Modifies the Low Variables field data before it is saved to the database.
   *
   * @access public
   * @param  string $var_data The submitted Low Variable field data.
   * @return string The field data to save to the database.
   */
  public function save_var_field($var_data)
  {

  }


  /**
   * Modifies the Low Variables settings data before it is saved to the
   * database.
   *
   * @access public
   * @param  array  $var_settings The submitted Low Variable settings.
   * @return array  The settings data to be saved to the database.
   */
  public function save_var_settings(Array $var_settings = array())
  {

  }

{% endif %}
{% if ft_matrix %}

  /* --------------------------------------------------------------
   * MATRIX
   * ------------------------------------------------------------ */

{% endif %}

}


/* End of file      : ft.{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/ft.{{ pkg_name_lc }}.php */
