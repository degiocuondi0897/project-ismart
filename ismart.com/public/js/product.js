$(document).ready(function() {
    //Xử lí lọc theo giá
    $('.r-price').change(function() {
        var price = $(this).val();
        var data = {price: price};
        //console.log(data);
        
        $.ajax({
            url: '?mod=product&controller=index&action=filter',
            method: 'POST',
            data: data,
            dataType: 'text',
            success: function(data) {
                //console.log(data);
               $('#filter').html(data);
            }
        });
    });
});

