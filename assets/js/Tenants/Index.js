$('#btn-modal-create').on('click', function () {
    $("input[name='email_tenant']").val("");
    $("input[name='name']").val("");
    $("input[name='phone_number']").val("");
    $("input[name='email']").val("");
    $("textarea[name='address']").html("");
    $(".picture_preview").attr('src', window.location.origin + '/stockism/assets/img/tenant/default-tenant.png');
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Tenants/GetTenantById',
        data: {
            email_tenant: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='email_tenant']").val(data.email_tenant);
            $("input[name='name']").val(data.name);
            $("input[name='phone_number']").val(data.phone_number);
            $("input[name='email']").val(data.email);
            $("textarea[name='address']").html(data.address);
            $(".picture_preview").attr('src', window.location.origin + '/stockism/assets/img/tenant/' + data.picture);
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
            $("input[name='email_tenant']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});