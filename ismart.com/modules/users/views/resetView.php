<html>
    <head>
        <title>Trang gửi yêu cầu đổi mật khẩu</title>
        <meta charset="utf-8"/>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp_form_login">
            <?php echo form_success('email'); ?>
            <h1 id="header_login">Gửi yêu cầu đổi mật khẩu</h1>
            <form action="" method="POST">
                <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="email"/>
                <?php echo form_error('email'); ?>
                <input type="submit" name="sm_reset" id="sm_reset" value="Gửi yêu cầu"/>
            </form>
            <?php echo form_error('accout'); ?>
            <a href="<?php echo base_url('?mod=users&controller=index&action=reg'); ?>" id="register">Đăng kí tài khoản</a>
            <a href="<?php echo base_url('?mod=users&controller=index&action=login'); ?>" id="login">Đăng nhập</a>
        </div>
    </body>
</html>