<?php
  $title="Dữ liệu Lớp hiện trạng";
  $judul=$title;
  $url='data';
  if ($session->get('level')!='Admin'){
  	redirect(url('homepage'));
  }

if(isset($_POST['save'])){
	$file=upload('geojson_polygon','geojson');

	if($file!=false){
		$data['geojson_polygon']=$file;
		if($_POST['id_polygon']!=''){
			// delete the files in the folder
			$db->where('id_polygon',$_GET['id']);
			$get=$db->ObjectBuilder()->getOne('m_kecamatan');
			$geojson_polygon=$get->geojson_polygon;
			unlink('assets/unggah/geojson/'.$geojson_polygon);
			// end delete files in the folder
		}
	}


	// validation check
	$validation=null;
	// check if the code is already there
	if($_POST['id_polygon']!=""){
		$db->where('id_polygon !='.$_POST['id_polygon']);
	}
	$db->where('year',$_POST['year']);
	$db->get('m_kecamatan');
	// if($db->count>0){
	// 	$validation[]='District Code Already Exists';
	// }
	// cannot be empty
	if($_POST['year']==''){
		$validation[]='Năm không được để trống';
	}
	if($_POST['MaDat']==''){
		$validation[]='Mã Đất không được để trống';
	}

	if($validation!=null){
		$setTemplate=false;
		$session->set('error_validation',$validation);
		$session->set('error_value',$_POST);
		redirect($_SERVER['HTTP_REFERER']);
		return false;
	}
	// validation check



	if($_POST['id_polygon']==""){
		$data['year']=$_POST['year'];
		$data['MaDat']=$_POST['MaDat'];
		$data['color']=$_POST['color'];
		$exec=$db->insert("m_kecamatan",$data);
		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Success!</h4> Added Success Data </div>';
		
	}
	else{
		$data['year']=$_POST['year'];
		$data['MaDat']=$_POST['MaDat'];
		$data['color']=$_POST['color'];
		$db->where('id_polygon',$_POST['id_polygon']);
		$exec=$db->update("m_kecamatan",$data);
		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Success!</h4> Success data changed </div>';
	}

	if($exec){
		$session->set('info',$info);
	}
	else{
      $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> The process failed <br>'.$db->getLastError().'
              </div>');
	}
	redirect(url($url));
}

if(isset($_GET['delete'])){
	$setTemplate=false;
	// delete file in folder
	$db->where('id_polygon',$_GET['id']);
	$get=$db->ObjectBuilder()->getOne('m_kecamatan');
	$geojson_polygon=$get->geojson_polygon;
	unlink('assets/unggah/geojson/'.$geojson_polygon);
	// end delete file in folder
	$db->where("id_polygon",$_GET['id']);
	$exec=$db->delete("m_kecamatan");
	$info='<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Success!</h4> Data Deleted </div>';
	if($exec){
		$session->set('info',$info);
	}
	else{
      $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> The process failed
              </div>');
	}
	redirect(url($url));
}

elseif(isset($_GET['add']) OR isset($_GET['edit'])){
  $id_polygon="";
  $year="";
  $MaDat="";
  $geojson_polygon="";
  $color="";
  if(isset($_GET['edit']) AND isset($_GET['id'])){
  	$id=$_GET['id'];
  	$db->where('id_polygon',$id);
	$row=$db->ObjectBuilder()->getOne('m_kecamatan');
	if($db->count>0){
		$id_polygon=$row->id_polygon;
		$year=$row->year;
		$MaDat=$row->MaDat;
		$geojson_polygon=$row->geojson_polygon;
		$color=$row->color;
	}
  }
  // value ketika validasi
  if($session->get('error_value')){
  	extract($session->pull('error_value'));
  }
?>
<?=content_open('Thêm lớp Hiện trạng sử dụng đất')?>
    <form method="post" enctype="multipart/form-data">
    	<?php
    		// displays a validation error
  			if($session->get('error_validation')){
  				foreach ($session->pull('error_validation') as $key => $value) {
  					echo '<div class="alert alert-danger">'.$value.'</div>';
  				}
  			}
    	?>
    	<?=input_hidden('id_polygon',$id_polygon)?>
    	<div class="form-group">
    		<label>NĂM</label>
    		<div class="row">
	    		<div class="col-md-4">
	    			<?=input_text('year',$year)?>
		    	</div>
	    	</div>
    	</div>
    	<div class="form-group">
    		<label>MÃ ĐẤT</label>
    		<div class="row">
	    		<div class="col-md-6">
	    			<?=input_text('MaDat',$MaDat)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>GeoJSON</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('geojson_polygon',$geojson_polygon)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Màu</label>
    		<div class="row">
	    		<div class="col-md-3">
	    			<?=input_color('color',$color)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="save" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
			<a href="<?=url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Back</a>
    	</div>
    </form>
<?=content_close()?>

<?php  } else { ?>
<?=content_open('Danh sách dữ liệu')?>

<a href="<?=url($url.'&add')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Add</a>
<hr>
<?=$session->pull("info")?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>STT</th>
			<th>Năm</th>
			<th>Mã đất</th>
			<th>GeoJSON</th>
			<th>Màu</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$getdata=$db->ObjectBuilder()->get('m_kecamatan');
			foreach ($getdata as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->year?></td>
						<td><?=$row->MaDat?></td>
						<td><a href="<?=assets('unggah/geojson/'.$row->geojson_polygon)?>" target="_BLANK"><?=$row->geojson_polygon?></a></td>
						<td style="background: <?=$row->color?>"></td>
						<td>
							<a href="<?=url($url.'&edit&id='.$row->id_polygon)?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
							<a href="<?=url($url.'&delete&id='.$row->id_polygon)?>" class="btn btn-danger" onclick="return confirm('Delete data?')"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
<?=content_close()?>
<?php } ?>