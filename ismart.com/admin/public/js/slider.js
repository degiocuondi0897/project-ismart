//Upload ảnh
$(document).ready(function () {
    var inputFile = $('.uploadFileSlider #upload-thumb');
    $('.uploadFileSlider #sm_upload_slider').click(function () {
        var fileUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('file', fileUpload);
        //console.log(formData);
        $.ajax({
            url: '?mod=slider&controller=index&action=upload',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.success == 'ok') {
                    //Show ảnh
                    showThumbUpload(data);
                    $('.uploadFileSlider #thumbnail_url').val(data.file_path);
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
        items = '<img src="' + data.file_path + '" style="margin-top: 15px;width: 150px; height: 150px;overflow: hidden;border: 1px solid #ddd;">';
        $('.uploadFileSlider .showThumbUpload').html(items);
    }
});
