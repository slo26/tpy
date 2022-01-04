(function ($, Drupal) {
    'use strict';
    var initialized;

    function init(settings) {
        if (!initialized) {
            initialized = true;
            utility.makeModalDraggable();
            validateField_requisition_status();
        }
    }

    Drupal.behaviors.common_utils = {
        attach: function (context, settings) {
            init(settings);
            $('#edit-field-requisition-status').change(function (e) {
                validateField_requisition_status();
            });
        }
    };

})(jQuery, Drupal);

function validateField_requisition_status() {
    if ( jQuery('#edit-field-requisition-status').find("option:selected").val() == "transferred" ) {
        jQuery('#edit-field-temporary-storage-wrapper').css('display', 'block');
    } else {
        jQuery('#edit-field-temporary-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-temporary-storage').val('_none');
    }
}
