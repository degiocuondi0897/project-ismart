$(document).ready(function () {
    
    //2. Xoá từng người dùng
    $('.list-operation-user .delete').click(function () {
        if (confirm("Bạn muốn xoá người dùng này?")) {
            var id = $(this).attr('id');
            var role = $(this).attr('role');
            var data = {id: id, role: role};
            $.ajax({
                url: '?mod=users&controller=team&action=delete',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    $('tr.row_user_' + id).hide(500);
                    $('.filter-wp .all_user span').text(data.num_user_all);
                    $('.filter-wp .public span').text(data.num_user_admin);
                    $('.filter-wp .helper span').text(data.num_user_helper);
                    $('.filter-wp .trash span').text(data.num_user_trash);
                }
            });

        } else {
            return false;
        }
        return false;
    });
    //3. Sửa người dùng
    $('.list-operation-user .edit').click(function () {
        var id = $(this).attr('id');
        var data = {id: id};
        $('.edit_show_' + id).slideToggle();
        $.ajax({
            url: '?mod=users&controller=team&action=edit',
            method: 'POST',
            data: data,
            dataType: 'text',
            success: function (data) {
                //alert(data);
            }
        });
        return false;
    });

});
