$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/ProductCategories/GetProductCategoryById',
        data: {
            id_productcategory: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_productcategory']").val(data.id_productcategory);
            $("input[name='name']").val(data.name);
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
            $("input[name='id_productcategory']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});