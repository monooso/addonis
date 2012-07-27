<?php

/**
 * {{ dt_title }} datatype.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

if ( ! class_exists('EI_datatype'))
{
  require_once dirname(__FILE__) .'/EI_datatype.php';
}

class {{ dt_name }} extends EI_datatype
{

  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   array    $props    Associative array of property names and values.
   * @return  void
   */
  public function __construct(Array $props = array())
  {
    parent::__construct($props);
  }


  /**
   * Resets the instance properties.
   *
   * @access  public
   * @return  {{ dt_name }}
   */
  public function reset()
  {
{% if dt_props %}
    $this->_props = array(
{% for prop in dt_props %}
      '{{ prop.name }}' => {{ prop.default }}{% if not loop.last %},
{% endif %}
{% endfor %}
    );
{% else %}
    $this->_props = array();
{% endif %}

    return $this;
  }


}


/* End of file      : {{ dt_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/classes/{{ dt_name_lc }}.php */
