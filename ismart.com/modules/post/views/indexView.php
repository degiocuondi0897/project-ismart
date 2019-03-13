<?php 
//show_array($list_post);
?>
<?php get_header(); ?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home&controller=index&action=index" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=post&controller=index&action=index" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <?php if (!empty($list_post)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($list_post as $item) {
                                $item['post_url'] = "?mod=post&controller=detail&action=index&id={$item['post_id']}";
                                ?>
                                <li class="clearfix">
                                    <a href="<?php echo $item['post_url'];?>" title="<?php echo $item['post_title'];?>" class="thumb fl-left">
                                        <img src="admin/<?php echo $item['post_thumb'];?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $item['post_url'];?>" title="" class="title"><?php echo $item['post_title'];?></a>
                                        <span class="create-date"><?php echo date('d/m/Y', $item['created_at']);?></span>
                                        <p class="desc"><?php echo $item['post_desc'];?></p>
                                    </div>
                                </li>
                                <?php }
                            ?>
                        </ul>
                    </div>
                <?php }
                ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php echo get_pagging($num_page, $page, "?mod=post&controller=index&action=index");?>
                </div>
            </div>
        </div>
        <?php get_sidebar('post'); ?>
    </div>
</div>
<?php get_footer(); ?>