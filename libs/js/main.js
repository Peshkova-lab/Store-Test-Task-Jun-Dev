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

    var type = $('#typeId').val();

    document.getElementById('size1').hidden = true;
    document.getElementById('height1').hidden = true;
    document.getElementById('width1').hidden = true;
    document.getElementById('lenght1').hidden = true;
    document.getElementById('weight1').hidden = true;

    if (type == 1) {
        document.getElementById('size1').hidden = false;
    }
    if (type == 2) {
        document.getElementById('weight1').hidden = false; 
    }
    if (type == 3) {
        document.getElementById('height1').hidden = false;
        document.getElementById('width1').hidden = false;
        document.getElementById('lenght1').hidden = false;
    }        
}


$(document).ready(function () {
    $('#delete-product-btn').on('click', deleteMassProducts);
    $('#typeId').on('change', chooseType);
});
