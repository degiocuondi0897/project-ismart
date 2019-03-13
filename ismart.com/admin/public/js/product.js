$(document).ready(function () {
    //1. Xử lí tự động điền slug 
    $('#cat_title').change(function () {
        var cat_title = $(this).val();

        //Đổi chữ hoa thành chữ thường
        slug = cat_title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');

        //In slug ra textbox có id “slug”
        $('#slug').val(slug);
        return false;
    });
    //2. Xoá từng danh mục sản phẩm
    $('form.cat-product .delete').click(function () {
        if (confirm('Bạn muốn xoá danh mục này?')) {
            var id = $(this).attr('id');
            var data = {id: id};
            //alert(id);
            $.ajax({
                url: '?mod=product&controller=cat&action=delete',
                method: 'POST',
                data: data,
                dataType: 'text',
                success: function (data) {
                    $('tr.row_' + id).hide(500);
                }
            });
        } else {
            return false;
        }
    });
});





//Xử lý sản phẩm : indexController.php ==========================>
$(document).ready(function () {
    //1. Xoá từng sản phẩm
    $('.list-operation .delete.product').click(function () {
        if (confirm("Bạn muốn xoá sản phẩm này?")) {
            var id = $(this).attr('id');
            var status = $(this).attr('status');
            var data = {id: id, status: status};
            //console.log(data);
            $.ajax({
                url: '?mod=product&controller=index&action=delete',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    $('tr#row_product_' + id).hide(500);
                    $('.product-status li.status_1 span').text(data.num_status_1);
                    $('.product-status li.status_2 span').text(data.num_status_2);
                    $('.product-status li.status_3 span').text(data.num_status_3);
                    $('.product-status li.all span').text(data.num_total);
                }
            });
        } else {
            return false;
        }
    });
});

$(document).ready(function () {
    //3.Xử lý upload ảnh
    var inputFile = $('#upload-thumb');
    $('#uploadFile #btn-upload-thumb').click(function () {
        var fileToUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('file', fileToUpload);
        //console.log(formData);
        $.ajax({
            url: '?mod=product&controller=index&action=upload',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.success == 'ok') {
                    showThumb(data);
                    $('#uploadFile #thumbnail_url').val(data.file_path);

                } else {
                    alert(data.status);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert('thêm thất bại');
                //alert(xhr.status);
                //alert(thrownError);

            }
        });

        return false;
    });
    //Show ảnh
    function showThumb(data) {
        var items;
        items = '<img src="' + data.file_path + '"/>';
        $('#show_thumb').html(items);
    }


});


$(document).ready(function () {
    $('#sm_action').click(function () {
        var check = $('.checkItem').serializeArray();
        var act = $('.actions select').val();
        var num_check = check.length;
        var data = {check: check, act: act};
        if (num_check == 0) {
            alert('Bạn cần chọn ít nhất một sản phẩm để sửa');
        }
        if (act == 0) {
            $('.notification').text('Chưa chọn hành động cho sản phẩm');
        }
        if (num_check != 0 && act != 0) {
            $.ajax({
                url: '?mod=product&controller=index&action=actions',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    $('.post-status li.status_1 span').text(data.num_status_1);
                    $('.post-status li.status_2 span').text(data.num_status_2);
                    $('.post-status li.status_3 span').text(data.num_status_3);
                    $('.post-status li.all span').text(data.num_total);
                }
            });
        }

        return false;
    });
});


