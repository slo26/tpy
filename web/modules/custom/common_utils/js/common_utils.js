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
            validateField_warehouse_form_type();
            convertSelectOptionTextToChinese();
        }
    }

    Drupal.behaviors.common_utils = {
        attach: function (context, settings) {
            init(settings);
            $('#edit-field-requisition-status').change(function (e) {
                validateField_requisition_status();
            });
            $('#edit-field-warehouse-form-type').change(function (e) {
                validateField_warehouse_form_type();
            });
            $('#edit-create-single-item').on("click", function(e) {
                var len = $('.warehouse-delete').length;
                e.preventDefault();
                e.stopImmediatePropagation();
                var delete_button = '#warehouse-delete-' + len;
                $(context).on("click", delete_button, function(e) {
                    update_taxonomy(len);
                });
            });
            $('#add-expense-modal-submit-buttom').on("click", function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                add_expense_allowance();
                $('.ui-dialog-titlebar-close').click();
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
        //jQuery('#edit-field-temporary-storage-wrapper').css('display', 'block');
        jQuery('#edit-field-client-warehouse-wrapper').css('display', 'block');
    } else {
        //jQuery('#edit-field-temporary-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-client-warehouse-wrapper').css('display', 'none');
        //jQuery('#edit-field-temporary-storage').val('_none');
    }
}

function validateField_warehouse_form_type() {
    if ( jQuery('#edit-field-warehouse-form-type').find("option:selected").val() == "inbound" ) {
        jQuery('#edit-field-from-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-to-storage-wrapper').css('display', 'block');
    } else if ( jQuery('#edit-field-warehouse-form-type').find("option:selected").val() == "outbound" ) {
        jQuery('#edit-field-from-storage-wrapper').css('display', 'block');
        jQuery('#edit-field-to-storage-wrapper').css('display', 'none');
    } else if ( jQuery('#edit-field-warehouse-form-type').find("option:selected").val() == "transfer" ) {
        jQuery('#edit-field-from-storage-wrapper').css('display', 'block');
        jQuery('#edit-field-to-storage-wrapper').css('display', 'block');
    } else if ( jQuery('#edit-field-warehouse-form-type').find("option:selected").val() == "return" ) {
        jQuery('#edit-field-from-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-to-storage-wrapper').css('display', 'block');
    } else {
        jQuery('#edit-field-from-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-to-storage-wrapper').css('display', 'none');
        jQuery('#edit-field-warehouse-form-type').val('_none');
    }
}

function update_taxonomy(del) {
    let object = [];
    jsonData = JSON.parse(jQuery('#edit-field-taxonomy-0-value').val());
    for (var i = 0; i < jsonData.length; i++) {
        if ( del != i ) {
            object.push(jsonData[i]);
        }
    }
    if ( object.length == 0 ) {
        jQuery('#edit-field-taxonomy-0-value').val("");
        jQuery('#edit-field-warehouse-form-type').removeAttr("disabled");
    } else {
        jQuery('#edit-field-taxonomy-0-value').val(JSON.stringify(object));
    }
    outbound_inbound_warehouse_table_generate(object);
}

function outbound_inbound_warehouse_table_generate(object) {
    var table = "";
    if ( object.length == 0 ) {
        table = '<div id="warehouse-inbound-outbound-table"></div>';
    } else {
        table = '<table>-BODY-</table>';
        var table_head = "<thead><tr><td>產品型號/零件或物件媥號</td><td>產品/零件名稱</td><td>數量</td><td>出倉庫</td><td>入倉庫</td><td></td></tr></thead>";
        var table_body_begin = "<tbody>";
        var table_body = '';
        for (var i = 0; i < object.length; i++) {
            var action_button = '<button class="warehouse-delete" id="warehouse-delete-' + i + '" name="' + i + '" type="button">delete</button>';
            if ( i == 0 ) {
                table_body = '<tr><td>' + object[i].ProductsGoods['code'] + '</td><td>' + object[i].ProductsGoods['label'] + '</td><td>' + object[i].Quantity + '</td><td>' + object[i].FromStorage['label'] + '</td><td>' + object[i].ToStorage['label'] + '</td><td>' + action_button + '</td></tr>';
            } else {
                table_body = table_body + '<tr><td>' + object[i].ProductsGoods['code'] + '</td><td>' + object[i].ProductsGoods['label'] + '</td><td>' + object[i].Quantity + '</td><td>' + object[i].FromStorage['label'] + '</td><td>' + object[i].ToStorage['label'] + '</td><td>' + action_button + '</td></tr>';
            }
        }
        table_body_end = '</tbody>';
        table_body = table_head + table_body_begin + table_body + table_body_end;
        table = table.replace('-BODY-', table_body);
    }
    jQuery('#warehouse-inbound-outbound-table').html(table);
}

function add_expense_allowance() {
    var detail = jQuery('#edit-field-detail-expense-0-value').val();
    let jsonData = [];
    if ( detail != "" ) {
        jsonData = JSON.parse(detail);
    }

    var deposite_date = jQuery('#add-expense-modal-deposite-date').val();
    var deposite_employee = jQuery('#edit-deposite-employee').val();
    var new_allowance = jQuery('#add-expense-new-allowance').val();

    let object = new Object;
    object['Transaction Date'] = deposite_date;
    object['Transaction Employee'] = deposite_employee;
    object['Amount'] = new_allowance;
    jsonData.push(object);
    jQuery('#edit-field-detail-expense-0-value').val(JSON.stringify(jsonData));
    jQuery('#edit-field-expense-type').attr('disabled', true);

    expense_for_allowance_table_generator(jsonData);
}

function remove_expense_allowance(del) {
    let object = [];
    jsonData = JSON.parse(jQuery('#edit-field-detail-expense-0-value').val());
    for (var i = 0; i < jsonData.length; i++) {
        if ( del != i ) {
            object.push(jsonData[i]);
        }
    }
    
    if ( object.length == 0 ) {
        jQuery('#edit-field-detail-expense-0-value').val("");
        jQuery('#edit-field-expense-type').attr('disabled', false);
    } else {
        jQuery('#edit-field-detail-expense-0-value').val(JSON.stringify(object));
        jQuery('#edit-field-expense-type').attr('disabled', true);
    }

    expense_for_allowance_table_generator(object);
}

function expense_for_allowance_table_generator(object) {
    var table = "";
    if ( object.length == 0 ) {
        table = '<div id="list-all-expense-table"></div>';
    } else {
        table = '<table>-BODY-</table>';
        var table_head = "<thead><tr><td>排序</td><td>存入日期</td><td>存款人</td><td>儲存零用金</td><td></td></tr></thead>";
        var table_body_begin = "<tbody>";
        var table_body = '';
        for (var i = 0; i < object.length; i++) {
            var action_button = '<button class="expense-delete" id="expense-delete-' + i + '" value="'  + i + '"' + ' type="button" onClick="remove_expense_allowance(' + i + ')">delete</button>';
            if ( i == 0 ) {
                table_body = '<tr><td>' + (i+1) + '</td><td>' + object[i]['Transaction Date'] + '</td><td>' + object[i]['Transaction Employee'] + '</td><td>' + object[i]['Amount'] + '</td><td>' + action_button + '</td></tr>';
            } else {
                table_body = table_body + '<tr><td>' + (i+1) + '</td><td>' + object[i]['Transaction Date'] + '</td><td>' + object[i]['Transaction Employee'] + '</td><td>' + object[i]['Amount'] + '</td><td>' + action_button + '</td></tr>';
            }
        }
        table_body_end = '</tbody>';
        table_body = table_head + table_body_begin + table_body + table_body_end;
        table = table.replace('-BODY-', table_body);
    }
    jQuery('.input-list').html(table);
}

function convertSelectOptionTextToChinese() {
    jQuery("select").find("option:contains(\"Is less than\")").text('小於');
    jQuery("select").find("option:contains(\"Is not equal to\")").text('不等於');
    jQuery("select").find("option:contains(\"Is equal to\")").text('等於');
    jQuery("select").find("option:contains(\"Is greater than\")").text('大於');
    jQuery("select").find("option:contains(\"Contains\")").text('包含');
}



