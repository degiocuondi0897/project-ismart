<?php get_header(); ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=post&controller=index&action=add"  title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all post-all"><a href="">Tất cả (<span class="count"><?php echo get_num_post_all();?></span>)</a> |</li>
                            <li class="public post-public"><a href="">Đã đăng (<span class="count"><?php echo get_num_post_by_status(3);?></span>)</a> |</li>
                            <li class="pending post-pending"><a href="">Chờ xét duyệt (<span class="count"><?php echo get_num_post_by_status(2);?></span>)</a></li>
                            <li class="trash post-trash "><a href="">Thùng rác (<span class="count"><?php echo get_num_post_by_status(1);?></span>)</a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" action="" class="form-actions">
                        <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Chỉnh sửa</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">

                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($list_post)) {
                                        $i = $start;
                                        foreach ($list_post as $item) {
                                            $i++;
                                            $item['show_status'] = array(
                                                1 => "<p style='color: #f15959a8;'>Thùng rác<p>",
                                                2 => "<p style='color: #8050f3;'>Chờ duyệt<p>",
                                                3 => "<p style='color: #2196f3;'>Đã đăng<p>",
                                            );
                                            ?>
                                            <tr class="row_post_<?php echo $item['post_id']; ?>">
                                                <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $i; ?></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title="<?php echo $item['post_title']; ?>"><?php echo $item['post_title']; ?></a>
                                                    </div>
                                                    <div class="list-operation list-operation-post fl-right">
                                                        <a href="?mod=post&controller=index&action=edit&id=<?php echo $item['post_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <button title="Xóa" id="<?php echo $item['post_id']; ?>" class="delete delete_post"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </div>
                                                </td>
                                                <td><span class="tbody-text"><?php echo get_cat_title_by_id($item['cat_id']); ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['show_status'][$item['status']]; ?></span></td>
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
                                        <td><span class="tfoot-text">Tiêu đề</span></td>
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
                    <?php echo get_pagging($num_page, $page, "?mod=post&controller=index&action=index"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>        