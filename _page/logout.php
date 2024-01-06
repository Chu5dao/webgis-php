<?php
$setTemplate=false;
$session->destroy('_Webgis', true);

$session->set("info",'<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check-circle" style="background-color: unset;"></i> Đăng suất Thành công!</h4> Nhập tài khoản, mật khẩu để đăng nhập lại
      </div>');
redirect(url('login'));
?>