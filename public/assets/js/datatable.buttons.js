// this page is to add custom buttons in yajra datatable
// after adding this page update in datatables-buttons.php and product datatable -> parameteres

(function ($, DataTable) {
    "use strict";

    // my custom button

    DataTable.ext.buttons.alert = {
        className: "buttons-alert",

        text: function (dt) {
            return (
                ' <i class="fa fa-download" id="alert"></i>' +
                dt.i18n("buttons.alert", "Alert")
            );
        },

        action: function (e, dt, button, config) {
            dt.draw(false);
        },
    };
})(jQuery, jQuery.fn.dataTable);
