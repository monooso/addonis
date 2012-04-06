<?php

/**
 * {{ pkg_title }} NSM Add-on Updater information.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         {{ pkg_name }}
 * @version         {{ pkg_version }}
 */

if ( ! defined('{{ pkg_name|upper }}_NAME'))
{
  define('{{ pkg_name|upper }}_NAME', '{{ pkg_name }}');
  define('{{ pkg_name|upper }}_TITLE', '{{ pkg_title }}');
  define('{{ pkg_name|upper }}_VERSION', '{{ pkg_version }}');
}

$config['name']     = {{ pkg_name|upper }}_NAME;
$config['version']  = {{ pkg_name|upper }}_VERSION;
$config['nsm_addon_updater']['versions_xml']
  = 'http://experienceinternet.co.uk/software/feeds/{{ pkg_name_lc|replace({'_': '-'}) }}';

/* End of file      : config.php */
/* File location    : third_party/{{ pkg_name_lc }}/config.php */