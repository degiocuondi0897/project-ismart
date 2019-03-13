
<?php
$role = get_role_login();
if ($role == 1) {
    ?>
    <a href="?mod=users&controller=team&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
    <?php
} else {
    
}
?>
