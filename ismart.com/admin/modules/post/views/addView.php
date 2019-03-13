<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <?php echo form_success('add_post'); ?>
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" action="?mod=post&controller=index&action=add">
                        <label for="post_title">Tiêu đề</label>
                        <input type="text" name="post_title" id="post_title" value="<?php echo set_value('post_title'); ?>">
                        <?php echo form_error('post_title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug'); ?>">
                        <?php echo form_error('slug'); ?>
                        <label for="post_desc">Mô tả ngắn</label>
                        <textarea name="post_desc" id="post_desc"><?php echo set_value('post_desc'); ?></textarea>
                        <?php echo form_error('post_desc'); ?>
                        <label for="post_content">Chi tiết bài viết</label>
                        <textarea name="post_content" id="post_content" class="ckeditor"><?php echo set_value('post_content'); ?></textarea>
                        <?php echo form_error('post_content'); ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile" class="uploadFilePost">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="hidden" name="thumbnail_url" id="thumbnail_url" value="<?php echo set_value('thumbnail_url'); ?>"/>
                            <input type="submit" name="sm_upload_thumb" value="Upload" id="sm_upload_thumb">
                            <div id="show_thumb_post"></div>
                            <?php echo form_error('thumbnail_url'); ?>
                        </div>
                        <label>Danh mục cha</label>
                        <select name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty(get_list_post_cat())) {
                                foreach (multi_data_cat(get_list_post_cat()) as $item) {
                                    ?>
                                    <option value="<?php echo $item['cat_id']; ?>" <?php if (isset($_POST['cat_id']) && $_POST['cat_id'] == $item['cat_id']) echo "selected='selected';" ?>><?php echo str_repeat('--', $item['level']) . $item['cat_title']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('cat_id'); ?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="2" <?php if (isset($_POST['status']) && $_POST['status'] == 2) echo "selected='selected';" ?>>Chờ duyệt</option>
                            <?php if ($_SESSION['login']['role'] == 3) {
                                ?>
                                <option value="3" <?php if (isset($_POST['status']) && $_POST['status'] == 3) echo "selected='selected';" ?>>Đã đăng</option>
                            <?php }
                            ?>
                        </select>
                        <?php echo form_error('status'); ?>
                        <button type="submit" name="sm_add_post" id="sm_add_post">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>