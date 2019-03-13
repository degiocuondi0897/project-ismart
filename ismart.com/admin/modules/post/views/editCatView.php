<?php
//show_array($list_post_cat);
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa danh mục bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_success('cat'); ?>
                        <?php echo form_error('cat'); ?>
                        <label for="cat_title">Tên danh mục</label>
                        <input type="text" name="cat_title" id="cat_title" value="<?php echo $post['cat_title']; ?>">
                        <?php echo form_error('cat_title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $post['slug']; ?>">
                        <?php echo form_error('slug'); ?>
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty(get_list_post_cat())) {
                                foreach (multi_data_cat(get_list_post_cat()) as $item) {
                                    ?>
                                    <option value="<?php echo $item['cat_id'];?>"><?php echo str_repeat('--', $item['level']) . $item['cat_title'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" name="sm_edit_cat_post" id="sm_edit_cat_post">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>