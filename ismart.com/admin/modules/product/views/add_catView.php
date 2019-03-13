<?php
$data_cat = multi_data_cat(get_data_cat());
//show_array($data_cat);
?>
<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="cat_title" id="cat_title" value="<?php echo set_value('cat_title');?>">
                        <?php echo form_error('cat_title');?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug');?>">
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty($data_cat)) {
                                foreach ($data_cat as $item) {
                                    ?>
                            <option value="<?php echo $item['cat_id'];?>"><?php echo str_repeat('--', $item['level']).$item['cat_title'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" name="sm_add_cat" id="sm_add_cat">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>