(function ($, Drupal) {
    'use strict';
    var initialized;

    function init(settings) {
        if (!initialized) {
            initialized = true;
            utility.makeModalDraggable();
            validateField_requisition_status();
            showGenerateReturnButtom();
            validSellType();
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

function validSellType() {
    if ( jQuery('#edit-field-sell-type').find("option:selected").val() == "return" ) {
        jQuery('#edit-field-requisition-status option[value=packed], #edit-field-requisition-status option[value=transferred]').remove();
    } else {
        jQuery('#edit-field-requisition-status option[value=returned_to_inventory]').remove();
    }
}

function showGenerateReturnButtom() {
    if ( jQuery('#edit-meta-published').text().trim() == "銷售出貨" || jQuery('#edit-meta-published').text().trim() == "銷售完成" ) {
        jQuery('#edit-trigger-return-process').css('display', 'initial');
    } else {
        jQuery('#edit-trigger-return-process').css('display', 'none');
    }
}

function validateField_requisition_status() {
    if ( jQuery('#edit-field-requisition-status').find("option:selected").val() == "transferred" ) {
        jQuery('#edit-field-temporary-storage-wrapper').css('display', 'block');
    } else {
        jQuery('#edit-field-temporary-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-temporary-storage').val('_none');
    }
}
