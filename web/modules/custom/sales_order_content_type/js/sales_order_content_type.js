(function($, Drupal, drupalSettings) {
    'use strict';
    var initialized;

    function init(settings) {
        if (!initialized) {
            initialized = true;
        }
    }

    Drupal.behaviors.sales_order_content_type = {
        attach: function(context, settings) {
            init(settings);
            $(context).once('sales_order_content_type').on('click', '.to-sell-item-list-by-all', function(e) {
                e.preventDefault();
                alert("test");
                window.open('/admin/sell-items?pid=TPY-003', 'name', 'width=400,height=400,scrollbars=yes');
                return false;
                //window.location.href = "/support/pages" + drupalSettings.destination;
            });
            
        }
    };

})(jQuery, Drupal, drupalSettings);

