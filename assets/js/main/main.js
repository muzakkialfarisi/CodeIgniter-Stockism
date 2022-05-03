$(function(){ 
    $(".table").DataTable({
    });

    $('input').attr('autocomplete','off');
});

$('input.number-sapartor').keyup(function(event) {
    if (event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value
            .replace(/[^\d.]/g, "")
            .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
            .replace(/\.(\d{2})\d+/, '.$1')
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    });
});

$("input.number-only").keypress(function(event) {
    return /\d/.test(String.fromCharCode(event.keyCode));
});

