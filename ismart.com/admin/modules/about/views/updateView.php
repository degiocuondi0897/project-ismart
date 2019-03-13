<?php 
get_header(); 
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Trang giới thiệu</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail contact">
                    <form method="POST" action="?mod=about&controller=index&action=index">
                        <?php echo form_success('page'); ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" readonly="readonly" value="GIỚI THIỆU">
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="" readonly="readonly">
                        <label for="content">Mô tả</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo $data_about['content'];?></textarea>
                        <?php echo form_error('content'); ?><br><br>
                        <button type="submit" name="sm_update_page" id="sm_update_page">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>