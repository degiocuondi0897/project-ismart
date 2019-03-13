<html>
    <head>
        <title>Thực hiện đổi mật khẩu mới</title>
        <meta charset="utf-8"/>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp_form_login">
             <?php echo form_success('password'); ?>
            <?php echo form_error('accout'); ?>
            <h1 id="header_login">Đổi mật khẩu mới</h1>
            <form action="" method="POST">
                <input type="password" name="password" id="password" value="" placeholder="password"/>
                <?php echo form_error('password'); ?>
                <input type="submit" name="sm_change" id="sm_change" value="Đổi mật khẩu"/>
            </form>
            <a href="<?php echo base_url('?mod=users&controller=index&action=lost_pass');?>" id="lost_password">Quên mật khẩu?</a>
            <a href="<?php echo base_url('?mod=users&controller=index&action=reg');?>" id="register">Đăng kí tài khoản</a>
        </div>
    </body>
</html>
