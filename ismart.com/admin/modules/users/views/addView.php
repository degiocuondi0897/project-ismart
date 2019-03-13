
<?php get_header(); ?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&action=update" title="" id="add-new" class="fl-left">Cập nhập</a>
            <h3 id="index" class="fl-left">Thêm tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_success('accout'); ?>
                        <?php echo form_error('accout'); ?>
                        <label for="display_name">Tên hiển thị</label>
                        <input type="text" name="display_name" id="display_name" value="<?php echo set_value('display_name'); ?>">
                        <?php echo form_error('display_name'); ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
                        <?php echo form_error('username'); ?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email'); ?>
                        <label for="role">Phân quyền</label>
                        <select name="role">
                            <option value="">--Chọn--</option>
                            <option value="3">Người quản trị</option>
                            <option value="2">Công tác viên</option>
                        </select>
                        <?php echo form_error('role'); ?>
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password">
                        <?php echo form_error('password'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới tài khoản</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>