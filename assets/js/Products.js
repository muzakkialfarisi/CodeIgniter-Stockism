$('#datetimepicker-view-mode').datetimepicker({
    viewMode: 'years'
});

$("#sku").on('click', function () {
    if ($(this).is(":checked")){
        $("input[name='sku']").attr('readonly', false);
        $("input[name='sku']").val("");
    }
    else{
        $("input[name='sku']").attr('readonly', true);
        $("input[name='sku']").val("Auto Generated");
    }
});

$("#code").on('click', function () {
    if ($(this).is(":checked")){
        $("input[name='code']").attr('readonly', false);
        $("input[name='code']").val("");
    }
    else{
        $("input[name='code']").attr('readonly', true);
        $("input[name='code']").val("Auto Generated");
    }
});

$(".div-expired_date").hide();
$("#expired_date").on('click', function () {
    if ($(this).is(":checked")){
        $(".div-expired_date").show();
    }
    else{
        $(".div-expired_date").hide();
        $("input[name='expired_date']").val("");
    }
});

