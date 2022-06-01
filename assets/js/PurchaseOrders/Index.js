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

var index = 0;
$('.btn-edit-poproduct-quantity').on('click', function(){
    var id_po = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: '/stockism/PurchaseOrderProducts/GetPurchaseOrderProductByIdPo',
        dataType: 'json',
        data:{
            id_po: $(this).data('id'),
        },
        beforeSend: function(){
            $('.rec-element').remove();
            $('#jumlahkolom').val(0);
            $("input[name='id_po']").val("");
        },
        success: function (data) {
            $("input[name='id_po']").val(id_po);
            for (let i = 0; i < data.length; i++) {
                var row =   '<div class="rec-element">'+
                                '<h5 class="text-center">'+ data[i].id_product +'</h5>'+
                                '<div class="row">'+
                                    '<div class="col-12 col-sm-6">'+
                                        '<div class="mt-2">Total: '+ data[i].quantity +'</div>'+
                                        '<div class="mt-1">Ongoing: '+ (data[i].quantity - data[i].quantity_accepted) +'</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-sm-3">'+
                                    '<div class="mb-3 form-group required">'+
                                        '<label class="control-label">Accepted</label>'+
                                        '<input type="text" class="form-control" name="id_poproduct[]" value="'+ data[i].id_poproduct +'" required hidden>'+
                                        '<input type="text" class="form-control" name="quantity_accepted[]" value="'+ data[i].quantity_accepted +'" required readonly>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-sm-3">'+
                                    '<div class="mb-3 form-group required">'+
                                        '<label class="control-label" style="display:hidden"></label>'+
                                        '<input type="number" class="form-control number-only" name="update_quantity_accepted[]" id="'+ data[i].id_poproduct +'" value="0" required onkeyup="update_quantity_accepted(\'' + data[i].id_poproduct + '\',\'' + (data[i].quantity - data[i].quantity_accepted) +'\')">'+
                                    '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<hr>'+
                            '</div>';
                $(row).insertBefore("#nextkolom");
                $('#jumlahkolom').val(index+1);
                index++;
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});


function update_quantity_accepted(id, max){
    if(parseInt($('#'+ id +'').val()) > parseInt(max)){
        $('#'+ id +'').val(max);
    }
}


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