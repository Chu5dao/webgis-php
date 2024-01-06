
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=templates()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$session->get("nm_pengguna")?> [<?=$session->get("level")?>]</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Trực tuyến</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color: #fff;">Thanh điều huớng</li>
        <li>
          <a href="<?=url('homepage')?>">
            <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
          </a>
        </li>
        <?php if ($session->get('level')=='Admin'): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Dữ liệu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('data')?>"><i class="fa fa-circle-o"></i> Danh sách dữ liệu</a></li>
            <li><a href="<?=url('data&add')?>"><i class="fa fa-circle-o"></i> Thêm lớp</a></li>

          </ul>
        </li>
        <?php endif ?>

        <li>
          <a href="<?=url('leaflet-standar')?>"><i class="fa fa-map"></i> <span>Map</span></a>
        </li>
        <li>
          <a href="<?=url('statistical')?>"><i class="fa fa-calculator"></i> <span>Thống kê</span></a>
        </li>
        <li>
          <a href="<?=url('chart')?>"><i class="fa fa-bar-chart"></i> <span>Biểu đồ</span></a>
        </li>
        <li>
          <a href="<?=url('logout')?>">
            <i class="fa fa-sign-out"></i> <span>Đăng xuất</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
