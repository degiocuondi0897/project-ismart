<?php //show_array($list_post_cat);    ?>
<?php get_header(); ?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục trang</h3>
                    <a href="?mod=post&controller=cat&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">

                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Id danh mục cha</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_post_cat)) {
                                    $i = $start;
                                    foreach ($list_post_cat as $item) {
                                        $i ++;
                                        ?>
                                        <tr class = "row_post_cat_<?php echo $item['cat_id']; ?>">
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $i; ?></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title="<?php echo $item['cat_title']; ?>"><?php echo str_repeat('--', $item['level']) . $item['cat_title']; ?></a>
                                                </div> 
                                                <div class="list-operation fl-right">
                                                    <form action="" method="POST">
                                                        <a href="?mod=post&controller=cat&action=edit&id=<?php echo $item['cat_id']; ?>" title="Sửa" class="edit edit_post_cat"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <button title="Xóa" id="<?php echo $item['cat_id']; ?>" class="delete delete_post_cat"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['parent_id']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['created_by']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $item['created_at']); ?></span></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Id danh mục cha</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php echo get_pagging($num_page, $page, "?mod=post&controller=cat&action=index"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>