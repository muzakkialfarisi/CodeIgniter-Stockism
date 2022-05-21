$('#btn-modal-create').on('click', function () {
    $("input[name='id_toko']").val("");
    $("input[name='name']").val("");
    $("input[name='phone_number']").val("");
    $("input[name='komisi']").val("");
    $(".picture_preview").attr('src', window.location.origin + '/stockism/assets/img/stores/default-store.png');
});

$('.btn-edit').on('click', function () {
    $.ajax({
        type: 'POST',
        url: '/stockism/Stores/GetStoreById',
        data: {
            id_toko: $(this).data("id"),
        },
        dataType: 'json',
        beforeSend: function () {
          $("select[name='id_marketplace']").empty();  
        },
        success: function (data) {
            console.log(data);
            $("input[name='id_toko']").val(data.id_toko);
            $("input[name='name']").val(data.name);
            $("input[name='phone_number']").val(data.phone_number);
            $("input[name='komisi']").val(data.komisi);
            $("input[name='email_tenant']").val(data.email_tenant);
            $(".picture_preview").attr('src', window.location.origin + '/stockism/assets/img/stores/' + data.picture);

            var id_custtype = data.id_marketplace;
            $.ajax({
                type: 'POST',
                url: '/stockism/Marketplaces/GetMarketplaceById',
                data: {
                    id_marketplace: id_custtype,
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("select[name='id_marketplace']").append('<option selected value="'+ data.id_marketplace +'">'+ data.name +'</option>');
                },
                error: function (response) {
                    console.log(response.responseText);
                }
            });
        },
        
        error: function (response) {
            console.log(response.responseText);
        }
    });

    $.ajax({
        type: 'POST',
        url: '/stockism/Marketplaces/GetAllMarketplace',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            for (let index = 0; index < data.length; index++) {
                $("select[name='id_marketplace']").append('<option selected value="'+ data[index].id_marketplace+'">'+ data[index].name + '</option>');
            }
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
            $("input[name='id_toko']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});