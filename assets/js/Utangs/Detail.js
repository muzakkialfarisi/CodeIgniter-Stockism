$(".table").DataTable({
});

$('.btn-delete-angsuran').on('click', function(){
    console.log($(this).data("id"));
    swal({
        title:"Are you sure?",
        text:"You want to delete this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='id_angsuran']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});