$(".table").DataTable({
    order: [[0, 'desc']],
});

$('.btn-edit-status').on('click', function(){
    $.ajax({
        type: 'POST',
        url: '/stockism/SalesOrders/GetSalesOrderById',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='status_delivery']").attr("disabled", false);
            $("input[name='status_payment']").attr("disabled", false);
            $("input[name='id_so']").val("");
        },
        success: function (data) {
            $("input[name='id_so']").val(data.id_so);
            
            if(data.status_delivery == "Done"){
                $("input[name='status_delivery']").attr("disabled", true);
                $("input#status_deliverys1").attr("checked", true);
            }else{
                $("input#status_delivery0").attr("checked", true);
            }

            if(data.status_payment == "Paid"){
                $("input[name='status_payment']").attr("disabled", true);
                $("input#status_payment1").attr("checked", true);
            }else{
                $("input#status_payment0").attr("checked", true);
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$('.btn-edit-soproduct-quantity').on('click', function(){
    console.log($(this).data('id'));
    $.ajax({
        type: 'POST',
        url: '/stockism/SalesOrders/GetSalesOrderById',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $("input[name='status_delivery']").attr("disabled", false);
            $("input[name='status_payment']").attr("disabled", false);
            $("input[name='id_so']").val("");
        },
        success: function (data) {
            console.log(data);
            
            $("input[name='id_so']").val(data.id_so);
            
            
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
            $("input[name='id_so']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});