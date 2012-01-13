<?php

/**
 * Main controller.
 *
 * @author        Stephen Lewis
 * @package       Addonis
 */

class Build extends CI_Controller {

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
    $this->load->model('package_model');
  }


  /**
   * Displays a view.
   *
   * @access  public
   * @param   string    $view    The view to display.
   * @return  void
   */
  public function view($view = 'package')
  {
    if ( ! file_exists(APPPATH .'views/build/' .$view .'.php'))
    {
      show_404();
    }

    // Are we building a package?
    if ($this->input->post('build_package') == 'y')
    {
      $this->_build_package();
    }

    // Helpers.
    $this->load->helper('form');

    $view_data = array(
      'form_tag'    => form_open('package', '', array('build_package' => 'y')),
      'meta_title'  => ucfirst($view)
    );

    $this->load->view('_inc/_header', $view_data);
    $this->load->view('build/' .$view, $view_data);
    $this->load->view('_inc/_footer');
  }


  /* --------------------------------------------------------------
   * PRIVATE METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Builds a ZIP containing the add-on package files.
   *
   * @access  private
   * @return  void
   */
  private function _build_package()
  {
    // Retrieve the Package data and files.
    $template_data  = $this->package_model->get_package_data();
    $template_files = $this->package_model->get_package_files();

    // Retrieve the Accessory data.
    if ($this->input->post('pkg_include_acc') == 'y')
    {
      $template_data = array_merge($template_data,
        $this->package_model->get_accessory_data());

      $template_files = array_merge($template_files,
        $this->package_model->get_accessory_files());
    }

    // Retrieve the Extension data.
    if ($this->input->post('pkg_include_ext') == 'y')
    {
      $template_data = array_merge($template_data,
        $this->package_model->get_extension_data());
    }

    // Retrieve the Fieldtype data.
    if ($this->input->post('pkg_include_ft') == 'y')
    {
      $template_data = array_merge($template_data,
        $this->package_model->get_fieldtype_data());
    }

    // Retrieve the Module data.
    if ($this->input->post('pkg_include_mod') == 'y')
    {
      $template_data = array_merge($template_data,
        $this->package_model->get_module_data());

      $template_files = array_merge($template_files,
        $this->package_model->get_module_files());
    }

    // Retrieve the Plugin data.
    if ($this->input->post('pkg_include_pi') == 'y')
    {
      $template_data = array_merge($template_data,
        $this->package_model->get_plugin_data());

      $template_files = array_merge($template_files,
        $this->package_model->get_plugin_files());
    }

    // Retrieve the datatypes.
    $template_files = array_merge($template_files,
      $this->package_model->get_datatype_files());

    // Retrieve the helpers.
    $template_files = array_merge($template_files,
      $this->package_model->get_helper_files());

    // Retrieve the libraries.
    $template_files = array_merge($template_files,
      $this->package_model->get_library_files());

    /**
     * Loop through all of the required template files. Load each file into
     * a string, then process it using CI's standard parser and the 
     * $template_data array.
     *
     * Finally, add the processed file to the ZIP package.
     *
     * NOTE: we can't use $this->load->file, because CI uses `include`.
     */

    $this->load->library('parser');
    $this->load->library('zip');

    $package_name = $template_data['pkg_name_lc'];
    $template_base_path = APPPATH .'templates/';

    foreach ($template_files AS $template_file)
    {
      if ( ! $source = @file_get_contents($template_base_path .$template_file))
      {
        continue;
      }

      $filename = str_replace('package', $package_name, $template_file);
      $source   = $this->parser->parse_string($source, $template_data, TRUE);

      $this->zip->add_data($filename, $source);
    }

    // Download the ZIP.
    $this->zip->download($package_name .'.zip');
  }


  /**
   * Retrieves the data required when building a package containing a module.
   *
   * @access  private
   * @return  array
   */
  private function _get_module_data()
  {
    return array(
      'mod_cp' => $this->input->post('mod_cp') == 'y' ? 'TRUE' : 'FALSE'
    );
  }


}

/* End of file    : build.php */
/* File location  : application/controllers/build.php */
