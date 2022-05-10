$('#datetimepicker-view-mode').datetimepicker({
    viewMode: 'years'
});

$("input[name=\"date_created\"]").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true
});

$('.date_due').hide();
$("select[name='payment_status']").change(function(e){
    if($(this).val() == "Paid"){
        $('.date_due').hide();
    }else{
        $('.date_due').show();
    }
});

$("#btn-addproduct").click(function(e){
    $("#btn-addproduct2").attr("class", "nav-link");

    // $("#btn-purchasedetails").attr("aria-selected", "false");
    // $("#btn-purchasedetails").attr("class", "nav-link");

    // $("#btn-addproduct1").attr("aria-selected", "true");
    // $("#btn-addproduct1").attr("class", "nav-link active");
});

$('.table tbody tr').click(function () {
    console.log($(this).data("id"));
    $.ajax({
        type: 'POST',
        url: '/stockism/PurchaseOrders/GetProductById/',
        data: {
            id_product: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});