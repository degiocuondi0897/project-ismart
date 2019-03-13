<?php 
?>
<?php get_header();?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <?php get_sidebar('btn-add');?>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users');?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_success('accout');?>
                        <label for="display_name">Tên hiển thị</label>
                        <input type="text" name="display_name" id="display_name" value="<?php echo $info_user['display_name'];?>">
                        <?php echo form_error('display_name');?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" value ="<?php echo $info_user['username'];?>" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $info_user['email'];?>" readonly="readonly">
                         <?php echo form_error('email');?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo $info_user['tel'];?>">
                         <?php echo form_error('tel');?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $info_user['address'];?></textarea>
                         <?php echo form_error('address');?>
                        <label for="avatar">Ảnh đại diện</label>
                        <div id="avatar">
                            <input type="file" name="file" id="file"/>
                            <input type="submit" name="sm_upload" value="Upload"/>
                            <div id="thumb">
                                <img src="https://cdn.24h.com.vn/upload/3-2018/images/2018-09-10/1536550720-991-huong-tram-1-1536546563-width600height452.jpg"/>
                            </div>
                        </div>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>