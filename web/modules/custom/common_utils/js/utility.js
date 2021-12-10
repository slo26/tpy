var utility = {
    makeModalDraggable: function () {
        if (jQuery('.ui-dialog').length > 0) {
            jQuery('.ui-dialog').draggable({
                disabled: false
            });
        }
    }
};

