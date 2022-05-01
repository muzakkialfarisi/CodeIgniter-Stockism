$('.btn-edit').on('click', function () {
    console.log('makan');
    $.ajax({
        type: 'POST',
        url: '/stockism/ProductUnits/GetProductUnitById/',
        data: {
            id_productunit: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_productunit']").val(data.id_productunit);
            $("input[name='name']").val(data.name);
            $("input[name='email_tenant']").val(data.email_tenant);
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
            $("input[name='id_productunit']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});