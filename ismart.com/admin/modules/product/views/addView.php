<?php
//show_array($_SESSION['login']);
$data = multi_data_cat(get_data_cat());
//show_array($data);
?>
<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" action="?mod=product&controller=index&action=add">
                        <?php echo form_success('product'); ?>
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_title" id="product_title" value="<?php echo set_value('product_title'); ?>">
                        <?php echo form_error('product_title'); ?>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="product_price" id="product_price" value="<?php echo set_value('product_price'); ?>">
                        <?php echo form_error('product_price'); ?>
                        <label for="product_desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="product_desc"><?php echo set_value('product_desc'); ?></textarea>
                        <?php echo form_error('product_desc'); ?>
                        <label for="product_content">Chi tiết</label>
                        <textarea name="product_content" id="product_content" class="ckeditor"><?php echo set_value('product_content'); ?></textarea>
                        <?php echo form_error('product_content'); ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb"  data-uri="<?php echo base_url("public/js/uploads/") ?>">
                            <input type="hidden" name="thumbnail_url" id="thumbnail_url" value=""/>
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb" />
                            <div id="show_thumb"></div>
                        </div>
                        <?php echo form_error('thumbnail_url');?>
                        <?php echo form_error('file'); ?>
                        <label>Sản phẩm nổi bật</label><br>
                        Bình thường: <input type="radio" name="high_light" id="high_light" value="1"/><br>
                        Nổi bật: <input type="radio" name="high_light" id="high_light" value="2"/><br><br><br>
                        <?php echo form_error('high_light');?>
                        <label>Danh mục sản phẩm</label>
                        <select name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty($data)) {
                                foreach ($data as $item) {
                                    ?>
                                    <option value="<?php echo $item['cat_id'];?>" ><?php echo str_repeat('--', $item['level']) . $item['cat_title'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('cat_id'); ?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn danh mục --</option>
                            <option <?php if (isset($_POST['status']) && $_POST['status'] == 2) echo "selected='selected'"; ?> value="2">Chờ duyệt</option>
                            <?php if ($_SESSION['login']['role'] == 3) {
                                ?>
                                <option <?php if (isset($_POST['status']) && $_POST['status'] == 3) echo "selected='selected'"; ?> value="3">Đã đăng</option>
                            <?php }
                            ?>

                        </select>
                        <?php echo form_error('status'); ?>
                        <button type="submit" name="sm_add_product" id="sm_add_product">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>        