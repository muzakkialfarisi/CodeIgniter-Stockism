$('.btn-edit-salesorderproduct').on('click', function(){
    $.ajax({
        type: 'POST',
        url: '/stockism/SalesOrderProducts/GetSalesOrderProductById',
        data: {
            id_poproduct: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_so']").val(data.id_so);
            $("input[name='id_soproduct']").val(data.id_soproduct);
            $("input[name='selling_price']").val(data.purchase_price);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$(".table").DataTable({
    lengthMenu: [
        [5, 10, 25, 50],
        [5, 10, 25, 50],
    ],
    pageLength: 5,
});