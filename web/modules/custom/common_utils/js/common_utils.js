(function ($, Drupal) {
    'use strict';
    var initialized;

    function init(settings) {
        if (!initialized) {
            initialized = true;
            utility.makeModalDraggable();
        }
    }

    Drupal.behaviors.common_utils = {
        attach: function (context, settings) {
            init(settings);
        }
    };

})(jQuery, Drupal);
