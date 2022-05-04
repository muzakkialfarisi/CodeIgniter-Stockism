$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Stores/GetStoreById',
        data: {
            id_toko: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_toko']").val(data.id_toko);
            $("input[name='name']").val(data.name);
            $("input[name='phone_number']").val(data.phone_number);
            $("input[name='komisi']").val(data.komisi);
            $("input[name='id_marketplace']").val(data.id_marketplace);
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
            $("input[name='id_toko']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});