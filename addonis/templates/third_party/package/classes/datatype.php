<?php

/**
 * {{ dt_title }} datatype.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

require_once dirname(__FILE__) .'/EI_datatype.php';

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
   * Magic 'setter' method.
   *
   * @access  public
   * @param   string    $prop_name    The property to set.
   * @param   mixed     $prop_value   The new property value.
   * @return  void
   */
  public function __set($prop_name, $prop_value)
  {
    if ( ! $this->_is_valid_property($prop_name))
    {
      return;
    }

    $this->_props[$prop_name] = $prop_value;
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
      {% for prop in dt_props %}{{ prop.name }} => {{ prop.default }},{% endfor %}
    );
    { % else %}
    $this->_props = array();
    {% endif %}

    return $this;
  }


}


/* End of file      : {{ dt_name_lc }}.php */
/* File location    : third_party/{{ pkg_name_lc }}/classes/{{ dt_name_lc }}.php */