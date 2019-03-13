<?php get_header();?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <?php get_sidebar('btn-add');?>
            <h3 id="index" class="fl-left">Thay đổi mật khẩu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users');?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_success('accout');?>
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="old-pass" id="pass-old">
                        <?php echo form_error('old-pass');?>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="new-pass" id="pass-new">
                        <?php echo form_error('new-pass');?>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm-pass" id="confirm-pass">
                        <?php echo form_error('confirm-pass');?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>