<?php if ( ! defined('BASEPATH')) {exit('No direct script access allowed');}

class Twig {

	protected $CI;
	protected $_twig;
	protected $_template_dir;
	protected $_cache_dir;

  /**
   * Constructor.
   *
   * @access public
   * @param  boolean $debug Are we debugging?
   * @return void
   */
	public function __construct($debug = false)
	{
    $this->CI =& get_instance();
    $this->CI->config->load('twig');

    ini_set('include_path',
      ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'libraries/Twig');

    require_once (string) "Autoloader" . EXT;
    log_message('debug', "Twig Autoloader Loaded");

    Twig_Autoloader::register();

    $this->_template_dir = $this->CI->config->item('template_dir');
    $this->_cache_dir = $this->CI->config->item('cache_dir');

    $loader = new Twig_Loader_Filesystem($this->_template_dir);

    $this->_twig = new Twig_Environment($loader, array(
      'cache' => $this->_cache_dir,
      'debug' => $debug,
    ));
	}


  /**
   * Parse the specified template, and return the result.
   *
   * @access public
   * @param  string $template The template to parse.
   * @param  Array  $data     The template data.
   * @return string           The parsed template.
   */
	public function render($template, Array $data = array())
  {
    $template = $this->_twig->loadTemplate($template);
    return $template->render($data);
	}


  /**
   * Parse the specified template, and output the result to the browser.
   *
   * @access public
   * @param  string $template The template to parse.
   * @param  Array  $data     The template data.
   * @return void
   */
  public function display($template, Array $data = array())
  {
    $template = $this->_twig->loadTemplate($template);
    $template->display($data);
	}


}


/* End of file    : Twig.php */
/* File location  : /application/libraries/Twig.php */