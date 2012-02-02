<?php if ( ! defined('BASEPATH')) exit('Direct script access not allowed');

/**
 * {pkg_title} plugin.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {pkg_name}
 */

$plugin_info = array(
  'pi_author'       => 'Stephen Lewis',
  'pi_author_url'   => 'http://experienceinternet.co.uk/',
  'pi_description'  => '{pkg_description}',
  'pi_name'         => '{pkg_title}',
  'pi_usage'        => {pkg_name}::usage(),
  'pi_version'      => '{pkg_version}'
);

class {pkg_name} {

  private $EE;
  private $_pi_model;

  public $return_data = '';


  /* --------------------------------------------------------------
   * CLASS METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Plugin usage information.
   *
   * @access  public
   * @return  string
   */
  public static function usage()
  {
    return '{pkg_description}';
  }



  /* --------------------------------------------------------------
  * PUBLIC METHODS
  * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   string    $content    Field content if used for field formatting.
   * @return  void
   */
  public function __construct($content = '')
  {
    $this->EE =& get_instance();

    $this->EE->load->add_package_path(
      PATH_THIRD .'{pkg_name_lc}/');

    $this->EE->load->model('{pkg_name_lc}_plugin_model');
    $this->_pi_model  = $this->EE->{pkg_name_lc}_plugin_model;
  }

  {pi_tags}
  /**
   * {pi_tag_description}
   *
   * @access  public
   * @return  string
   */
  public function {pi_tag_name}()
  {
    return $this->return_data = 'exp:{pkg_name_lc}:{pi_tag_name} output';
  }

  {/pi_tags}

}


/* End of file      : pi.{pkg_name_lc}.php */
/* File location    : third_party/{pkg_name_lc}/pi.{pkg_name_lc}.php */
