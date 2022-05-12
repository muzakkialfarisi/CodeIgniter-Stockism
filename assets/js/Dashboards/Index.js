console.log($("input[name='id_usertype']").val());

if($("input[name='id_usertype']").val() != "Admin"){
    $.ajax({
        type: 'POST',
        url: '/stockism/Warehouses/GetWarehouseByTenant',
        data: {
            email_tenant: $("input[name='user_id']").val(),
        },
        dataType: 'json',
        success: function (data) {
            if(data < 1) {
                $("#btn-modal-create-close").hide();
                $("#ModalCreate").modal("show");
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
}


$("input[name='picture']").change(function () {
    if (this.files && this.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('.picture_preview').attr('src', event.target.result);
        };
        fileReader.readAsDataURL(this.files[0]);
    }
});