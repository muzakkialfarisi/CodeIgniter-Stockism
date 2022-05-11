$('#btn-modal-create').on('click', function () {
    $("input[name='name']").val("");
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/CustomerTypes/GetCustomerTypeById',
        data: {
            Id_CustomerType: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            $("input[name='Id_CustomerType']").val(data.Id_CustomerType);
            $("input[name='name']").val(data.name);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$('.btn-delete').on('click', function () {
    swal({
        title:"Are you sure?",
        text:"You want to delete this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='Id_CustomerType']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});