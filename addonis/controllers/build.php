<?php

/**
 * Main controller.
 *
 * @author        Stephen Lewis
 * @package       Addonis
 */

class Build extends CI_Controller {

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

    $view_data = array(
      'meta_title' => ucfirst($view)
    );

    $this->load->view('_inc/_header', $view_data);
    $this->load->view('build/' .$view);
    $this->load->view('_inc/_footer');
  }

}

/* End of file    : build.php */
/* File location  : application/controllers/build.php */
