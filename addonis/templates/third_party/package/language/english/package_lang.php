<?php

/**
 * {{ pkg_title }} English language strings.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 */

$lang = array(
  '{{ pkg_name_lc }}_module_name' => '{{ pkg_title }}',
  '{{ pkg_name_lc }}_module_description' => '{{ pkg_description }}',

{% for page in mod_cp_pages %}
  'mod_nav_{{ page.name_lc }}' => '{{ page.title }}',
{% endfor %}

  // All done.
  '' => ''
);


/* End of file      : {{ pkg_name_lc }}_lang.php */
/* File location    : third_party/{{ pkg_name_lc }}/language/english/{{ pkg_name_lc }}_lang.php */