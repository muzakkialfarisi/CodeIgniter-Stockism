$(".table").DataTable({
    order: [[0, 'desc']],
});

$('.btn-add-payment').on('click', function(){
    $.ajax({
        type: 'POST',
        url: '/stockism/Piutangs/GetPiutangById',
        dataType: 'json',
        data:{
            id_so: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='id_so']").val("");
            $("input[name='type']").val("");
        },
        success: function (data) {
            $("input[name='id_so']").val(data.id_so);
            $("input[name='type']").val("outside");
            $("input[name='payment_price']").attr("data-max", data.total_piutang - data.sum_payment_price);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$("input[name='payment_price']").on('keyup', function(){
    if($(this).val() > $(this).data('max')){
        $(this).val($(this).data('max')).change();
    }
});

$('input[name="status_payment"]').on('change', function() {
    if($(this).val() == "Debt"){
        $("input[name='payment_price']").attr("readonly", false);
        $("input[name='payment_price']").val("").change();
    }

    if($(this).val() == "Paid"){
        $.ajax({
            type: 'POST',
            url: '/stockism/Piutangs/GetPiutangById',
            dataType: 'json',
            data:{
                id_so: $("input[name='id_so']").val(),
            },
            beforeSend: function(){
                $("input[name='payment_price']").attr("readonly", true);
                $("input[name='payment_price']").val("").change();
            },
            success: function (data) {
                $("input[name='payment_price']").val(data.total_piutang - data.sum_payment_price).change();
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    }
});