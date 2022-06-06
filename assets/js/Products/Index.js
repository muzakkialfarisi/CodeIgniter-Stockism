$('.btn-delete').on('click', function(){
    swal({
        title:"Are you sure?",
        text:"You want to delete this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='id_product']").val($(this).data("id"));
            $('#DeletePost').submit();
        }
    });
});

$('.btn-activator').click(function(e){
    swal({
        title:"Are you sure?",
        text:"You want to delete this record?",
        icon:"warning",
        buttons:true,
        dangerMode:true
    }).then((confirm) =>{
        if(confirm){
            $("input[name='id_product']").val($(this).data("id"));
            $("input[name='status']").val($(this).data("status"));
            $('#ActivatorPost').submit();
        }
    });
});

$(".table").DataTable({
});