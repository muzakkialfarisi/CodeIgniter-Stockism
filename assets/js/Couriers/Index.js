$('#btn-modal-create').on('click', function () {
    $("input[name='name']").val("");
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Couriers/GetCourierById',
        data: {
            id_courier: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_courier']").val(data.id_courier);
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
            $("input[name='id_courier']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});