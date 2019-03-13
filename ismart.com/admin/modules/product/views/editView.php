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
                    <h3 id="index" class="fl-left">Cập nhập sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" action="">
                        <?php echo form_success('product'); ?>
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_title" id="product_title" value="<?php echo $item['product_title']; ?>">
                        <?php echo form_error('product_title'); ?>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product_code" value="<?php echo $item['product_code']; ?>">
                        <?php echo form_error('product_code'); ?>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="product_price" id="product_price" value="<?php echo $item['product_price']; ?>">
                        <?php echo form_error('product_price'); ?>
                        <label for="product_desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="product_desc"><?php echo $item['product_desc']; ?></textarea>
                        <?php echo form_error('product_desc'); ?>
                        <label for="product_content">Chi tiết</label>
                        <textarea name="product_content" id="product_content" class="ckeditor"><?php echo $item['product_content']; ?></textarea>
                        <?php echo form_error('product_content'); ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb"  data-uri="<?php echo base_url("public/js/uploads/")?>">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb" />
                            <div id="show_thumb"></div>
                            <div id="update_url"></div>
                            
                        </div>
                        <?php echo form_error('file'); ?>
                        <label>Danh mục sản phẩm</label>
                        <select name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty($data)) {
                                foreach ($data as $item) {
                                    ?>
                                    <option value="<?php echo $item['cat_id'] ?>" selected="selected"><?php echo str_repeat('--', $item['level']) . $item['cat_title'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('cat_id'); ?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn danh mục --</option>
                            <option <?php if (isset($item['status']) && $item['status'] == 2) echo "selected='selected'"; ?> value="2">Chờ duyệt</option>
                            <?php if ($_SESSION['login']['role'] == 3) {
                                ?>
                                <option <?php if (isset($item['status']) && $item['status'] == 3) echo "selected='selected'"; ?> value="3">Đã đăng</option>
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