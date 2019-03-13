<html>
    <head>
        <title>Trang đăng nhập</title>
        <meta charset="utf-8"/>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp_form_login">
            <h1 id="header_login">Đăng nhập hệ thống</h1>
            <form action="" method="POST">
                <?php echo form_error('login'); ?>
                <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="username"/>
                <?php echo form_error('username'); ?>
                <input type="password" name="password" id="password" value="" placeholder="password"/>
                <?php echo form_error('password'); ?>
                <input type="checkbox" name="remember_me"/><span style="color: #5d5de0; font-size: 12px"> Ghi nhớ mật khẩu</span>
                <input type="submit" name="sm_login" id="sm_login" value="Đăng nhập"/>
            </form>
            <a href="<?php echo base_url('?mod=users&controller=index&action=lost_pass');?>" id="lost_password">Quên mật khẩu?</a>
            <a href="<?php echo base_url('?mod=users&controller=index&action=reg');?>" id="register">Đăng kí tài khoản</a>
        </div>
    </body>
</html>