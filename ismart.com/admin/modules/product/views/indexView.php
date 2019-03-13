<?php
//show_array($list_product);
get_header();
if (isset($_GET['sm_search_product'])) {
    show_array($_GET['sm_search_product']);
}
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&controller=index&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status product-status fl-left">
                            <li class="all"><a href="<?php echo base_url('?mod=product&controller=index&action=index'); ?>">Tất cả (<span class="count"><?php echo get_num_product(); ?></span>)</a> |</li>
                            <li class="publish status_3"><a href="<?php echo base_url('?mod=product&controller=index&action=product_public'); ?>">Đã đăng (<span class="count"><?php echo get_num_product_by_status(3); ?></span>)</a> |</li>
                            <li class="pending status_2"><a href="<?php echo base_url('?mod=product&controller=index&action=product_pending'); ?>">Chờ xét duyệt(<span class="count"><?php echo get_num_product_by_status(2); ?></span>) |</a></li>
                            <li class="pending status_1"><a href="<?php echo base_url('?mod=product&controller=index&action=product_bin_clean'); ?>">Thùng rác(<span class="count"><?php echo get_num_product_by_status(1); ?></span>)</a></li>
                        </ul>
                        <form method="POST" action="" class="search_product fl-right">
                            <input type="text" name="search_product" id="search_product">
                            <input type="submit" name="sm_search_product" id="sm_search_product" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" action="?mod=product&controller=index" class="form-actions">
                        <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="3">Công khai</option>
                                <option value="2">Chờ duyệt</option>
                                <option value="1">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" id="sm_action" value="Áp dụng">
                            <div class="notification"></div>
                            <?php echo form_error('actions');?>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp product">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã sản phẩm</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($list_product)) {
                                        $i = $start;
                                        foreach ($list_product as $item) {
                                            $i ++;
                                            $item['show_status'] = array(
                                                1 => "<p style='color: #f15959a8;'>Thùng rác<p>",
                                                2 => "<p style='color: #8050f3;'>Chờ duyệt<p>",
                                                3 => "<p style='color: #2196f3;'>Đã đăng<p>",
                                            );
                                            ?>
                                            <tr id="row_product_<?php echo $item['product_id']; ?>">
                                                <td>
                                                    <input type="checkbox" name="checkItem" value="<?php echo $item['product_id']; ?>" class="checkItem">
                                                </td>
                                                <td><span class="tbody-text"><?php echo $i; ?></span>
                                                <td><span class="tbody-text"><?php echo $item['product_code']; ?></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img src="<?php echo $item['product_thumb']; ?>" alt="" title="<?php echo $item['product_title']; ?>">
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['product_title']; ?></a>
                                                    </div>
                                                    <div class="list-operation fl-right">
                                                        <a href="?mod=product&controller=index&action=edit&id=<?php echo $item['product_id']; ?>" title="Sửa" class="edit product"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <button title="Xoá" class="delete product" status="<?php echo $item['status']; ?>" id="<?php echo $item['product_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </div>
                                                </td>
                                                <td><span class="tbody-text"><?php echo currency_format($item['product_price']); ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['cat_title']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['show_status'][$item['status']]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['created_by']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo date('d/m/Y', $item['created_at']); ?></span></td>
                                            </tr>
                                            <?php
                                        }
                                    };
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                        <td><span class="tfoot-text">Giá</span></td>
                                        <td><span class="tfoot-text">Danh mục</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php echo get_pagging($num_page, $page, "?mod=product&controller=index&action=index"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>        