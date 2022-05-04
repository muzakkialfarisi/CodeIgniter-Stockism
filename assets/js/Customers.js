$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Customers/GetCustomerById',
        data: {
            id_customer: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_customer']").val(data.id_customer);
            $("input[name='name']").val(data.name);
            $("input[name='Id_CustType']").val(data.id_customertype);
            $("input[name='address']").val(data.address);
            $("input[name='phone_number']").val(data.phone_number);
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
            $("input[name='id_customer']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});