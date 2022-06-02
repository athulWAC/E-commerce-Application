// this page is to add custom buttons in yajra datatable
// after adding this page update in datatables-buttons.php and product datatable -> parameteres

(function ($, DataTable) {
    "use strict";

    // my custom button

    DataTable.ext.buttons.delete = {
        className: "buttons-delete",
        // id: "deleteProducts",

        text: function (dt) {
            return (
                ' <i class="fa fa-trash"></i>' +
                dt.i18n("buttons.delete", " Delete")
            );
        },

        action: function (e, dt, button, config) {
            // dt.draw(false);
        },
    };
})(jQuery, jQuery.fn.dataTable);
