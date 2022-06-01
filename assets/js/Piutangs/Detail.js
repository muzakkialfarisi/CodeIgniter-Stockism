$(".table").DataTable({
    order: [[0, 'desc']],
});

$('.btn-add-payment').on('click', function(){
    $.ajax({
        type: 'POST',
        url: '/stockism/Utangs/GetUtangById',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='id_po']").val("");
            $("input[name='type']").val("");
        },
        success: function (data) {
            $("input[name='id_po']").val(data.id_po);
            $("input[name='type']").val("inside");
            $("input[name='payment_price']").attr("data-max", data.total_utang - data.sum_payment_price);
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

$('.btn-delete-angsuran').on('click', function(){
    swal({
        title:"Are you sure?",
        text:"You want to delete this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='id_angsuran']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});

$('input[name="status_payment"]').on('change', function() {
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
                $("input[name='payment_price']").val(data.total_utang - data.sum_payment_price).change();
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    }
});