function getPVZ() {
    var api_token = $('input[name=api_key_new]').val();
    boxberry.open('setPVZ', api_token, '', '', '', '', '', '', '', '');
}
function setPVZ(result) {
    $('input[name="pvz_id_new"]').val(result.id);
}
$(document).ready(function() {
    $('body').on('change', 'input[name="boxberry_payment_status"]', function() {
        var value;
        
        if($(this).prop('checked') === true) {
            value = 1;
        }
        else value = 0;

        $.ajax({
            mimeType: 'text/html; charset='+locale.charset,
            url: '../modules/boxberrywidget/ajax/ajax.php',
            type: 'post',
            data: {
                operation: 'changePaymentStatus',
                value: value,
                orderId: $('input[name="boxberry_order_id"]').val()
            },
            dataType: "json",
            async: false,
            success: function(json) {
                console.log(json['error']);
            }
        });
    });
});