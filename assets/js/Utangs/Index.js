$(".table").DataTable({
});

$('.btn-add-payment').on('click', function(){
    console.log($(this).data('id'));
    $.ajax({
        type: 'POST',
        url: '/stockism/Utangs/GetUtangById',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='id_po']").val("");
        },
        success: function (data) {
            $("input[name='id_po']").val(data.id_po);
            console.log($('input[name="status_payment"]:checked').val());
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$('input[name="status_payment"]').on('change', function() {
    console.log($(this).val());
    if($(this).val() == "Debt"){
        $("input[name='payment_price']").attr("readonly", false);
        $("input[name='payment_price']").val("").change();
    }

    if($(this).val() == "Paid"){
        $.ajax({
            type: 'POST',
            url: '/stockism/Utangs/GetUtangById',
            dataType: 'json',
            data:{
                id_po: $("input[name='id_po']").val(),
            },
            beforeSend: function(){
                $("input[name='payment_price']").attr("readonly", true);
                $("input[name='payment_price']").val("").change();
            },
            success: function (data) {
                console.log(data);
                
                $("input[name='payment_price']").val(data.total_utang - data.sum_payment_price).change();
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    }
});