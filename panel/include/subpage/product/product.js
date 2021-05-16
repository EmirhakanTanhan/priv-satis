$(function () {
    $("#discount_chk_on").click(function () {
        if ($(this).is(":checked")) {
            $("#discount").show();
        }
    });
    $("#discount_chk_off").click(function () {
        if ($(this).is(":checked")) {
            $("#discount").hide();
        }
    });

    $("#stock_manuel").click(function () {
        if ($(this).is(":checked")) {
            $("#stock_for_pnew").show();
            $("#stock_input_for_pnew").attr('required',true);

            $("#stock_for_pedit").show();
            $("#stock_input_for_pedit").attr('required',true);
            $("#stock_input_for_pedit").removeAttr('readonly',true);

            $("#stock_alert_manuel").show();
            $("#stock_alert_unlimited").hide();
            $("#stock_alert_auto").hide();
        }
    });
    $("#stock_unlimited").click(function () {
        if ($(this).is(":checked")) {
            $("#stock_for_pnew").hide();
            $("#stock_input_for_pnew").removeAttr('required', true);

            $("#stock_for_pedit").hide();
            $("#stock_input_for_pedit").removeAttr('required',true);

            $("#stock_alert_unlimited").show();
            $("#stock_alert_manuel").hide();
            $("#stock_alert_auto").hide();
        }
    });
    $("#stock_auto").click(function () {
        if ($(this).is(":checked")) {
            $("#stock_for_pnew").hide();
            $("#stock_input_for_pnew").removeAttr('required', true);

            $("#stock_for_pedit").show();
            $("#stock_input_for_pedit").removeAttr('required',true);
            $("#stock_input_for_pedit").attr('readonly',true);

            $("#stock_alert_auto").show();
            $("#stock_alert_unlimited").hide();
            $("#stock_alert_manuel").hide();
        }
    });
});

function changeDiscountValue(Value) {
    $("#discount_input").val(Value);
}

function changeStockValue(value) {
    $("#stock_input_for_pedit").val(value);
}

$(document).on("change keyup blur", "#discount_input", function () {
    var main = $('#price').val();
    var disc = $('#discount_input').val();
    var dec = (disc / 100).toFixed(2);
    var mult = main * dec;
    var discont = main - mult;
    $('#discounted_price').html(discont.toFixed(2));
});