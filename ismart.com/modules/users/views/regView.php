
<html>
    <head>
        <title>Trang đăng kí tài khoản</title>
        <meta charset="utf-8"/>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/reg.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp_register">
            <form action="" method="POST" id="register">
                <?php echo form_error('accout');?>
                <h1 class="title">Đăng kí tài khoản</h1>
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname');?>"/>
                <?php echo form_error('fullname');?>
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" id="username" value="<?php echo set_value('username');?>"/>
                <?php echo form_error('username');?>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo set_value('email');?>"/>
                <?php echo form_error('email');?>
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password"/>
                <?php echo form_error('password');?>
                <input type="submit" name="sm_register" id="sm_register" value="Đăng kí"/>
                <a href="?mod=users&controller=index&action=login" id="login">Đăng nhập</a> 
            </form>
        </div>

    </body>
</html>
