<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo form_success('slider');?>
                    <form method="POST" enctype="multipart/form-data">
                        <label>Hình ảnh</label>
                        <div class="uploadFileSlider">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="hidden" name="thumbnail_url" id="thumbnail_url" value=""/>
                            <input type="submit" name="sm_upload_slider" value="Upload" id="sm_upload_slider">
                            <div class="showThumbUpload"></div>
                        </div>
                        <?php echo form_error('thumbnail_url');?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="2" <?php if(isset($_POST['status']) && $_POST['status'] == 2) echo "selected='selected'"?>>Công khai</option>
                            <option value="1" <?php if(isset($_POST['status']) && $_POST['status'] == 1) echo "selected='selected'"?>>Chờ duyệt</option>
                        </select>
                        <?php echo form_error('status');?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>