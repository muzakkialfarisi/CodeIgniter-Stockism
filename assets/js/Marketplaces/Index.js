$('#btn-modal-create').on('click', function () {
    $("input[name='name']").val("");
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Marketplaces/GetMarketplaceById',
        data: {
            id_marketplace: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            $("input[name='id_marketplace']").val(data.id_marketplace);
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
            $("input[name='id_marketplace']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});

$(".table").DataTable({
});