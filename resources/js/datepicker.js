import $ from "jquery";
import "jquery-ui/ui/widgets/datepicker.js";

window.$ = window.jQuery = $;

/* ;*/
$(document).ready(function() {
    $(document).on("focus", ".form-control.datepicker", function() {
        $(this).datepicker({
            format: "mm/dd/yyyy"
        });
    });
});
