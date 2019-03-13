<?php
//show_array($list_user);
?>
<html>
    <head>
        <title>Danh sách thành viên</title>
        <meta charset="utf-8"/>
    </head>
    <body>
        <h1>Danh sách thành viên</h1>
        <table border="1px solid gray">
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Họ và tên</td>
                    <td>Email</td>
                    <td>Tuổi</td>
                    <td>Thu nhập</td>
                    <td>Hành động</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list_user)) {
                    $i = 0;
                    foreach ($list_user as $user) {
                        $i ++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $user['fullname'];?></td>
                            <td><?php echo $user['email'];?></td>
                            <td><?php echo $user['age'];?></td>
                            <td><?php echo currency_format($user['earn'], ' $');?></td>
                            <td><a href="">Thêm</a> | <a href="">Sửa</a> | <a href="">Xoá</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
</html>

