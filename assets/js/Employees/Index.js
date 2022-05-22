$('#btn-modal-create').on('click', function () {
    $("input[name='id_employee']").val("");
    $("input[name='name']").val("");
    $("input[name='phone_number']").val("");
    $("input[name='email']").val("");
    $("input[name='email_before']").val("");
    $("textarea[name='address']").html("");
    $(".picture_preview").attr('src', window.location.origin + '/stockism/assets/img/avatars/default-avatar.png');
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Employees/GetEmployeeById',
        data: {
            id_employee: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_employee']").val(data.id_employee);
            $("input[name='name']").val(data.name);
            $("input[name='phone_number']").val(data.phone_number);
            $("input[name='email']").val(data.email);
            $("input[name='email_tenant']").val(data.email_tenant);
            $("textarea[name='address']").html(data.address);
            $(".picture_preview").attr('src', window.location.origin + '/stockism/assets/img/avatars/' + data.picture);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$("input[name='picture']").change(function () {
    console.log("masuk");
    if (this.files && this.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('.picture_preview').attr('src', event.target.result);
        };
        fileReader.readAsDataURL(this.files[0]);
    }
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
            $("input[name='id_employee']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});