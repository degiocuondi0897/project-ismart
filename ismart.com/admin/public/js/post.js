
//Xoá từng danh mục post
$(document).ready(function () {
    $('.delete_post_cat').click(function () {
        if (confirm('Bạn muốn xoá danh mục này?')) {
            var id = $(this).attr('id');
            var data = {id: id};
            $.ajax({
                url: '?mod=post&controller=cat&action=delete',
                method: 'POST',
                data: data,
                dataType: 'text',
                success: function (data) {
                    $('.row_post_cat_' + id).hide(500);
                }
            });
        } else {
            return false;
        }
    });
});

//Upload ảnh
$(document).ready(function () {
    var inputFile = $('.uploadFilePost #upload-thumb');
    $('.uploadFilePost #sm_upload_thumb').click(function () {
        var fileUpload = inputFile[0].files[0];
        //console.log(fileUpload);
        var formData = new FormData();
        formData.append('file', fileUpload);
        $.ajax({
            url: '?mod=post&controller=index&action=upload',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                if (data.success == 'add_ok') {
                    showThumbUpload(data);
                    $('.uploadFilePost #thumbnail_url').val(data.fileUpload);
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

    function showThumbUpload(data) {
        var items;
        items = '<img src="' + data.fileUpload + '">';
        $('#show_thumb_post').html(items);
    }
});


$(document).ready(function () {
    //1. Xử lí tự động điền slug 
    $('#post_title').change(function () {
        var post_title = $(this).val();

        //Đổi chữ hoa thành chữ thường
        slug = post_title.toLowerCase();

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
    })
});

//Xoá post
$(document).ready(function () {
    $('.list-operation-post .delete_post').click(function () {
        if (confirm('Bạn muốn xoá bài viết này?')) {
            var id = $(this).attr('id');
            var data = {id: id,};
            $.ajax({
                url: '?mod=post&controller=index&action=delete',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    $('.row_post_' + id).hide(500);
                    $('.post-all span').text(data.num_post_all);
                    $('.post-public span').text(data.num_post_public);
                    $('.post-pending span').text(data.num_post_pending);
                    $('.post-trash span').text(data.num_post_trash);
                },
            });
        } else {
            return false;
        }
    });
});


