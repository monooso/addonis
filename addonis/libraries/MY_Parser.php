<?php

/**
 * A slightly less incompetent template parser.
 *
 * @author        Stephen Lewis (http://github.com/experience/)
 * @copyright     Experience Internet
 * @package       Addonis
 */

class MY_Parser extends CI_Parser {

  /**
   * Parses a tag pair. Overrides the 'pair variable' parsing method, and 
   * implement support for multiple identical pair variables within the same 
   * document.
   *
   * @access  protected
   * @param   string    $tag      The tag name.
   * @param   array     $data     The variable data.
   * @param   string    $source   The source string being parsed.
   * @return  string
   */
  public function _parse_pair($tag, Array $data, $source)
  {
    if (($matches = $this->_match_pair($source, $tag)) === FALSE)
    {
      return $source;
    }

    $output = $source;
    $total_matches = count($matches[0]);

    // For each match, loop through all of the data.
    for ($match_count = 0; $match_count < $total_matches; $match_count++)
    {
      $data_count = 0;
      $match_output = '';
      $total_results = count($data);

      // Process each data row.
      foreach ($data AS $data_row)
      {
        $data_source = $matches[1][$match_count];

        $data_row = array_merge($data_row,
          array('count' => $data_count++, 'total_results' => $total_results));

        foreach ($data_row AS $item_key => $item_val)
        {
          $data_source = is_array($item_val)
            ? $this->_parse_pair($item_key, $item_val, $data_source)
            : $this->_parse_single($item_key, $item_val, $data_source);
        }

        $match_output .= $data_source;
      }

      $output = str_replace($matches[0][$match_count], $match_output, $output);
    }

    return $output;
  }


  /**
   * Matches a variable pair. Overrides the parent method, to ensure it performs 
   * a preg_match_all, not just a preg_match.
   *
   * @access  protected
   * @param   string    $source   The source string being parsed.
   * @param   string    $tag      The tag name.
   * @return  mixed
   */
  public function _match_pair($source, $tag)
  {
    $lbrace   = preg_quote($this->l_delim);
    $rbrace   = preg_quote($this->r_delim);
    $pattern  = "/{$lbrace}{$tag}{$rbrace}(.+?){$lbrace}\/{$tag}{$rbrace}/s";

    return preg_match_all($pattern, $source, $matches)
      ? $matches : FALSE;
  }

}


/* End of file    : MY_Parser.php */
/* File location  : libraries/MY_Parser.php */
