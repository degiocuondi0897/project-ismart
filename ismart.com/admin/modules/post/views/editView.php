<?php 

get_header(); 
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <?php echo form_success('add_post');?>
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label for="post_title">Tiêu đề</label>
                        <input type="text" name="post_title" id="post_title" value="<?php echo $item['post_title'];?>">
                        <?php echo form_error('post_title');?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $item['slug'];?>">
                        <?php echo form_error('slug');?>
                        <label for="desc">Mô tả</label>
                        <textarea name="post_desc" id="post_desc" class="ckeditor"><?php echo $item['post_desc'];?></textarea>
                        <?php echo form_error('post_desc');?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile" class="uploadFilePost">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="sm_upload_thumb" value="Upload" id="sm_upload_thumb">
                            <div class="wp_info_thumb">
                                <div id="show_thumb_post"></div>
                                <div id="url_fileUpload"></div>
                            </div>
                            <?php echo form_error('file');?>
                        </div>
                        <label>Danh mục cha</label>
                        <select name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty(get_list_post_cat())) {
                                foreach (multi_data_cat(get_list_post_cat()) as $v) {
                                    ?>
                                    <option value="<?php echo $v['cat_id']; ?>" <?php if (isset($item['cat_id']) && $item['cat_id'] == $v['cat_id']) echo "selected='selected';"?>><?php echo str_repeat('--', $v['level']) . $v['cat_title']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('cat_id');?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="1" <?php if (isset($item['status']) && $item['status'] == 1) echo "selected='selected';"?>>Chờ duyệt</option>
                            <?php if ($_SESSION['login']['role'] == 3) {
                                ?>
                                <option value="2" <?php if (isset($item['status']) && $item['status'] == 2) echo "selected='selected';"?>>Đã đăng</option>
                                <?php }
                            ?>
                        </select>
                        <?php echo form_error('status');?>
                        <button type="submit" name="sm_edit_post" id="sm_edit_post">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>