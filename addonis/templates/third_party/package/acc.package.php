<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {{ pkg_title }} accessory.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

class {{ pkg_name }}_acc {

  private $EE;
  private $_acc_model;

  public $description;
  public $id;
  public $name;
  public $sections;
  public $version;


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
    $this->EE =& get_instance();

    $this->EE->load->add_package_path(
      PATH_THIRD .'{{ pkg_name_lc }}/');

    // Still need to specify the package...
    $this->EE->lang->loadfile('{{ pkg_name_lc }}_acc', '{{ pkg_name_lc }}');

    $this->EE->load->model('{{ pkg_name_lc }}_accessory_model');
    $this->_acc_model = $this->EE->{{ pkg_name_lc }}_accessory_model;

    // Basic accessory information.
    $this->description = $this->EE->lang
      ->line('{{ pkg_name_lc }}_accessory_description');

    $this->name = $this->EE->lang
      ->line('{{ pkg_name_lc }}_accessory_name');

    $this->id       = '{{ pkg_name_lc }}';
    $this->sections = array();
    $this->version  = $this->_acc_model->get_package_version();
  }


  /**
   * Installs the accessory.
   *
   * @access  public
   * @return  void
   */
  public function install()
  {
    $this->_acc_model->install();
  }

{% if acc_sections %}

  /**
   * Defines the accessory sections.
   *
   * @access  public
   * @return  void
   */
  public function set_sections()
  {
{% for section in acc_sections %}
    $this->sections['{{ section.title }}']
      = $this->EE->load->view('acc_{{ section.name_lc }}', array(), TRUE);

{% endfor %}
  }

{% endif %}

  /**
   * Uninstalls the accessory.
   *
   * @access  public
   * @return  void
   */
  public function uninstall()
  {
    $this->_acc_model->uninstall();
  }


  /**
   * Updates the accessory.
   *
   * @access  public
   * @return  bool
   */
  public function update()
  {
    return $this->_acc_model->update();
  }


}


/* End of file      : acc.{{ pkg_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/acc.{{ pkg_name_lc }}.php */