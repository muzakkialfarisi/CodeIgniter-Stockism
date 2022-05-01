$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Warehouses/GetWarehouseById/',
        data: {
            id_warehouse: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_warehouse']").val(data.id_warehouse);
            $("input[name='name']").val(data.name);
            $("input[name='address']").val(data.address);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});