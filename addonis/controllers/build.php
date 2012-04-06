<?php

/**
 * Main controller.
 *
 * @author        Stephen Lewis
 * @package       Addonis
 */

class Build extends MY_Controller {

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

    // Load our happy helpers.
    $this->load->model('package_model');
    $this->load->library('twig');
  }


  /**
   * Displays the 'build datatype' form.
   *
   * @access public
   * @return void
   */
  public function get_datatype()
  {
    $this->_display_view('datatype');
  }


  /**
   * Displays the 'build package' form.
   *
   * @access public
   * @return void
   */
  public function get_package()
  {
    $this->_display_view('package',
      array('extension_hooks' => $this->package_model->get_extension_hooks()));
  }


  /**
   * Creates the requested datatype, and reloads the 'build datatype' form.
   *
   * @access public
   * @return void
   */
  public function post_datatype()
  {
    $this->_build_datatype();
    $this->get_datatype();
  }


  /**
   * Creates the requested package, and reloads the 'build package' form.
   *
   * @access public
   * @return void
   */
  public function post_package()
  {
    $this->_build_package();
    $this->get_package();
  }


  /* --------------------------------------------------------------
   * PRIVATE METHODS
   * ------------------------------------------------------------ */

  /**
   * Builds a ZIP containing the datatype files.
   *
   * @access  private
   * @return  void
   */
  private function _build_datatype()
  {
    // Retrieve the Datatype data files.
    $template_files = $this->package_model->get_custom_datatype_files();

    // Retrieve the Package and Datatype data.
    $template_data = array_merge(
      $this->package_model->get_package_data(),
      $this->package_model->get_custom_datatype_data()
    );

    // Construct the ZIP filename.
    $zip_filename = $template_data['dt_name_lc'] .'.zip';

    // Build the ZIP.
    $this->_build_zip($zip_filename, $template_files, $template_data);
  }


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

      $template_files = array_merge($template_files,
        $this->package_model->get_extension_files());
    }

    // Retrieve the Fieldtype data.
    if ($this->input->post('pkg_include_ft') == 'y')
    {
      $template_data = array_merge($template_data,
        $this->package_model->get_fieldtype_data());

      $template_files = array_merge($template_files,
        $this->package_model->get_fieldtype_files());
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

    // Retrieve the package Helpers.
    $template_files = array_merge($template_files,
      $this->package_model->get_package_helper_files());

    // Build the ZIP.
    $zip_filename = $template_data['pkg_name_lc'] .'-'
      .$template_data['pkg_version'] .'.zip';

    $this->_build_zip($zip_filename, $template_files, $template_data);
  }


  /**
   * The whipping boy for `_build_datatype` and `_build_package`. Does all the
   * hard work of parsing the templates, and building the ZIP.
   *
   * @access private
   * @param  string $zip_filename   The ZIP filename.
   * @param  Array  $template_files The template files to process.
   * @param  Array  $template_data  The template variable data.
   * @return void
   */
  private function _build_zip($zip_filename, Array $template_files,
    Array $template_data)
  {
    // Load the ZIP library.
    $this->load->library('zip');

    /**
     * Loop through all of the required template files, and parse them with
     * Twig. Add the processed file to the ZIP package.
     */

    $template_basepath = APPPATH .'templates/';
    $template_basepath = '/../templates/';

    foreach ($template_files AS $template_file)
    {
      $input_file   = $template_basepath .$template_file['input'];
      $output_file  = $template_file['output'];

      // Parse the filename.
      foreach ($template_data AS $key => $val)
      {
        if (is_string($val))
        {
          $output_file = str_replace('{' .$key .'}', $val, $output_file);
        }
      }

      // Parse the template.
      $parsed = $this->twig->render($input_file, $template_data);

      // Add the file to the ZIP.
      $this->zip->add_data($output_file, $parsed);
    }

    // Download the ZIP.
    $this->zip->download($zip_filename);
  }


  /**
   * Displays a view.
   *
   * @access  private
   * @param   string  $view       The view to display.
   * @param   Array   $view_data  Additional view data.
   * @return  void
   */
  private function _display_view($view, Array $view_data = array())
  {
    $view_file = APPPATH .'views/' .$view .'.html.twig';

    if ( ! file_exists($view_file))
    {
      show_404();
    }

    // Helpers.
    $this->load->helper('form');
    $this->load->helper('url');

    $view_data = array_merge($view_data, array(
      'form' => array(
        'action'  => site_url($view),
        'charset' => 'utf-8',
        'method'  => 'POST'
      ),
      'nav' => array(
        array(
          'active' => ($view === 'package'),
          'label'  => 'Package Builder',
          'title'  => 'Create a new ExpressionEngine add-on package',
          'url'    => site_url('package')
        ),
        array(
          'active' => ($view === 'datatype'),
          'label'  => 'Datatype Builder',
          'title'  => 'Create a new ExpressionEngine add-on datatype',
          'url'    => site_url('datatype')
        )
      )
    ));

    // Output the view.
    $this->twig->display($view .'.html.twig', $view_data);
  }


}

/* End of file    : build.php */
/* File location  : application/controllers/build.php */