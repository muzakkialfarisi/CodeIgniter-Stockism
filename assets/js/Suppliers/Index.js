$('#btn-modal-create').on('click', function () {
    $("input[name='name']").val("");
    $("input[name='address']").val("");
    $("input[name='phone_number']").val("");
    $("input[name='email']").val("");
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Suppliers/GetSupplierById',
        data: {
            id_supplier: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_supplier']").val(data.id_supplier);
            $("input[name='name']").val(data.name);
            $("input[name='phone_number']").val(data.phone_number);
            $("input[name='address']").val(data.address);
            $("input[name='email']").val(data.email);
            $("input[name='email_tenant']").val(data.email_tenant);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$('.btn-delete').click(function(e){
    swal({
        title:"Are you sure?",
        text:"You want to delete this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='id_supplier']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});

$(".table").DataTable({
});