(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.midWestThemeCustom = {
      attach: function (context, settings) {
        this.formStylerWithShortPlaceholder();
      },

      completedCallback: function () {
        // Do nothing. But it's here in case other modules/themes want to override it.
      },


      formStylerWithShortPlaceholder: function () {
        $('#edit-submitted-address-2-state-styler .jq-selectbox__select-text.placeholder').html('--');
      }
    }
  }

})(jQuery);

