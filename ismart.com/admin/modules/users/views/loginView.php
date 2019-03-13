<html>
    <head>
        <title>Trang đăng nhập</title>
        <meta charset="utf-8"/>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/import/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp_form_login">
            <h1 id="header_login">Hệ thống ISMART</h1>
            <form action="" method="POST">
                <?php echo form_error('login'); ?>
                <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="username"/>
                <?php echo form_error('username'); ?>
                <input type="password" name="password" id="password" value="" placeholder="password"/>
                <?php echo form_error('password'); ?>
                <input type="checkbox" name="remember_me"/><span style="color: #5d5de0; font-size: 12px"> Ghi nhớ mật khẩu</span>
                <input type="submit" name="sm_login" id="sm_login" value="Đăng nhập"/>
            </form>
        </div>
    </body>
</html>