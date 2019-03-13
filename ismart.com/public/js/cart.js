$(document).ready(function() {
    $ ('.num-order').change(function() {
        var id = $(this).attr('id');
        var qty = $(this).val();
        var data = {id: id, qty: qty};
        $.ajax({
            url: '?mod=cart&controller=index&action=change_qty',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('.sub_total_' + id).text(data.sub_total);
                $('#total-price span').text(data.total);
                $('#btn-cart span').text(data.num_order);
                $('#dropdown .desc span').text(data.num_order);
                $('.info p.qty_'+id).text('số lượng ' + data.qty);
                $('#dropdown .total-price .price').text(data.total);
            }
        });
    });
});
