$('#btn-modal-create').on('click', function () {
    $("input[name='id_customer']").val("");
    $("input[name='name']").val("");
    $("input[name='address']").val("");
    $("input[name='phone_number']").val("");
    $("input[name='email']").val("");
    $("input[name='email_tenant']").val("");
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Customers/GetCustomerById',
        data: {
            id_customer: $(this).data("id"),
        },
        dataType: 'json',
        beforeSend: function(){
            $("select[name='Id_CustType']").empty();
        },
        success: function (data) {
            $("input[name='id_customer']").val(data.id_customer);
            $("input[name='name']").val(data.name);
            $("input[name='address']").val(data.address);
            $("input[name='phone_number']").val(data.phone_number);
            $("input[name='email']").val(data.email);
            $("input[name='email_tenant']").val(data.email_tenant);

            var id_custtype = data.id_customertype;
            $.ajax({
                type: 'POST',
                url: '/stockism/CustomerTypes/GetCustomerTypeById',
                data: {
                    Id_CustomerType: id_custtype,
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("select[name='Id_CustType']").append('<option selected value="'+ data.Id_CustomerType +'">'+ data.name +'</option>');
                },
                error: function (response) {
                    console.log(response.responseText);
                }
            });
            
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });

    $.ajax({
        type: 'POST',
        url: '/stockism/CustomerTypes/GetAllCustomerType',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            for (let index = 0; index < data.length; index++) {
                $("select[name='Id_CustType']").append('<option selected value="'+ data[index].Id_CustomerType +'">'+ data[index].name +'</option>');
            }
            
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