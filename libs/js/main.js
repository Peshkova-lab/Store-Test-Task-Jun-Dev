function deleteMassProducts() {
    var checkboxes = document.getElementsByClassName('delete-checkbox');
    var deleteProducts  = {};
    var i = 0;
   
    for (var index = 0; index < checkboxes.length; index++) {   
        if (checkboxes[index].checked) {
            deleteProducts[i] = checkboxes[index].id; 
            i++;
        }
     }

    console.log(deleteProducts);

    $.post (
        "../../delete_product.php",
        {
            "products": deleteProducts
        },
        function(data){
            location.reload();
        }).fail(function() {
            alert('Delete failed!');
        });  
}

function chooseType() {
    $("#size").removeAttr("required");
    $("#weight").removeAttr("required");
    $("#height").removeAttr("required");
    $("#width").removeAttr("required");
    $("#length").removeAttr("required");

    var type = $('#typeId').val();

   $(".specAttr").hide();

   $("#"+type).show();

    if (type === 'DVD') {
        $("#size").attr('required', '');
    } else if (type === 'Book') {
        $("#weight").attr('required', '');
    } else if (type === 'Furniture') {
        $("#height").attr('required', '');
        $("#length").attr('required', '');
        $("#width").attr('required', '');
    }
}


$(document).ready(function () {
    $('#delete-product-btn').on('click', deleteMassProducts);
    $('#typeId').on('change', chooseType);
});
