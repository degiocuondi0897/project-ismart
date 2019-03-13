<?php get_header(); ?>
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách người quản trị bị chờ xoá</h3>
        </div>
    </div>
    <?php echo form_error('accout'); ?>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all_user"><a href="?mod=users&controller=team&action=index">Tất cả (<span class="count"><?php echo count(get_list_user()); ?></span>)</a> |</li>
                            <li class="public"><a href="?mod=users&controller=team&action=admin">Người quản trị (<span class="count"><?php echo get_num_user_by_role(3); ?></span>)</a> |</li>
                            <li class="helper"><a href="?mod=users&controller=team&action=helper">Cộng tác viên(<span class="count"><?php echo get_num_user_by_role(2); ?></span>)</a></li>
                            <li class="trash"><a href="?mod=users&controller=team&action=trash">Thùng rác (<span class="count"><?php echo get_num_user_by_role(1); ?></span>)</a></li>
                        </ul>
                        <form method="POST" action="?mod=users&controller=team&action=search" class="form-s fl-right">
                            <input type="text" name="search_user" id="search_user">
                            <input type="submit" name="sm_search_user" id="sm_search_user" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <select name="actions">
                            <option value="0">Tác vụ</option>
                            <option value="1">Chỉnh sửa</option>
                            <option value="2">Bỏ vào thủng rác</option>
                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <div id="result_search"></div>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên hiển thị</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Quyền hạn</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (!empty($list_user_trash)) {
                                    $i = $start;
                                    foreach ($list_user_trash as $user) {
                                        $i ++;
                                        $user['show_role'] = array(
                                            3 => "<p style='color: #03a9f4; font-style: italic'>Người quản trị</p>",
                                            2 => "<p style='color: #009688; font-style: italic'>Công tác viên</p>",
                                            1 => "<p style='color: red; font-style: italic'>Không quyền</p>",
                                        );
                                        ?>
                                    <div class="edit_show_<?php echo $user['user_id']; ?>" id="form_edit">
                                        <h1>Cập nhập thông tin</h1>
                                        <form action="?mod=users&controller=team&action=edit" method="POST">
                                            <input type="text" name="display_name" value="<?php echo $user['display_name']; ?>" placeholder="Họ và tên"/>
                                            <input type="text" name="email" value="<?php echo $user['email']; ?>" placeholder="Địa chỉ email" readonly="readonly"/>
                                            <input type="text" name="tel" value="<?php echo $user['tel']; ?>" placeholder="Số điện thoại"/>
                                            <textarea id="address" name="address" rows="5" placeholder="Địa chỉ"><?php echo $user['address']; ?></textarea>
                                            <input type="submit" name="sm_edit" value="Save"/>
                                        </form>
                                    </div>

                                    <tr class="row_user_<?php echo $user['user_id']; ?>">
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $i; ?></span></td>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $user['display_name']; ?></a>
                                            </div>
                                            <div class="list-operation-user fl-right">
                                                <form action="?mod=users&controller=team" method="POST">
                                                    <button title="Sửa" class="edit" id="<?php echo $user['user_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                    <button title="Xóa" class="delete" role="<?php echo $user['role']; ?>" id="<?php echo $user['user_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $user['email']; ?></span></td>
                                        <td><span class="tbody-text role"><?php echo $user['show_role'][$user['role']]; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $user['tel']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $user['address']; ?></span></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên hiển thị</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Quyền hạn</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php echo get_pagging($num_page, $page, $base_url="?mod=users&controller=team&action=trash");?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>