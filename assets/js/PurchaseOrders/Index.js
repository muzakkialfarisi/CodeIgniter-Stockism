$(".table").DataTable({
    order: [[0, 'desc']],
});

$('.btn-edit-status').on('click', function(){
    $.ajax({
        type: 'POST',
        url: '/stockism/PurchaseOrders/GetPurchaseOrderById',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='delivery_status']").attr("disabled", false);
            $("input[name='payment_status']").attr("disabled", false);
            $("input[name='id_po']").val("");
        },
        success: function (data) {
            $("input[name='id_po']").val(data.id_po);
            
            if(data.delivery_status == "Done"){
                $("input[name='delivery_status']").attr("disabled", true);
                $("input#delivery_status1").attr("checked", true);
            }else{
                $("input#delivery_status0").attr("checked", true);
            }

            if(data.payment_status == "Paid"){
                $("input[name='payment_status']").attr("disabled", true);
                $("input#payment_status1").attr("checked", true);
            }else{
                $("input#payment_status0").attr("checked", true);
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$('.btn-edit-poproduct-quantity').on('click', function(){
    console.log($(this).data('id'));
    $.ajax({
        type: 'POST',
        url: '/stockism/PurchaseOrders/GetPurchaseOrderById',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='delivery_status']").attr("disabled", false);
            $("input[name='payment_status']").attr("disabled", false);
            $("input[name='id_po']").val("");
        },
        success: function (data) {
            console.log(data);
            
            $("input[name='id_po']").val(data.id_po);
            
            
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});


$('.btn-delete').on('click', function(){
    swal({
        title:"Are you sure?",
        text:"You want to cancel this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='id_po']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});