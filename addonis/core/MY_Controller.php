<?php

class MY_Controller extends CI_Controller
{

  /**
   * Remaps controller requests to include the HTTP verb.
   *
   * @access public
   * @param  string $method The controller method being requested.
   * @param  Array  $args   The request arguments.
   * @return void
   */
  public function _remap($method, $args)
  {
    $prefix = strtolower(@$_SERVER['REQUEST_METHOD']) ?: 'get';
    call_user_func_array(array($this, "{$prefix}_{$method}"), $args);
  }

}


/* End of file : MY_Controller.php */