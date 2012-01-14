/**
 * Application-specific JavaScript.
 *
 * @author        Stephen Lewis
 * @package       Addonis
 */

(function($) {

  // Initialise the 'include X' drop-downs. All very brittle, but will suffice.
  function iniAddonDetails() {
    $("select[id^='pkg_include_']").change(function() {
      var fieldId = this.id;
      var addonType = fieldId.substring('pkg_include_'.length);
      var $target = $('#' + addonType + '_details');

      $(this).val() == 'y' ? $target.slideDown() : $target.slideUp();
    }).change();
  }


  // Initialise Roland.
  function iniRoland() {
    $('.roland').roland({rowClass : 'roland_row'});
  }


  // Get the ball rolling.
  $(document).ready(function() {
    iniAddonDetails();
    iniRoland();
  });

})(jQuery);

/* End of file    : app.js */
/* File location  : /js/app.js */
