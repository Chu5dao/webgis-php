<?php
 function upload($a='',$b='',$c=''){
    $ex=explode('.',$_FILES[$a]['name']);
    $ext=$ex[(count($ex)-1)];

    // Lấy tên của file đã upload
    $file_name = rand(1,100).date('dmyhis'). $_FILES[$a]['name'];

    // Lấy đường dẫn đến thư mục đích
    $destination = __DIR__ .'/../assets/unggah/geojson/'.$file_name;

    // Di chuyển file từ thư mục tạm lên thư mục đích
    $result = move_uploaded_file($_FILES[$a]['tmp_name'], $destination);
    if ($result) {
        return $file_name;
    } else {
        return 'File upload không thành công!';
    }
}





//   function upload($a='',$b='',$c=''){
//       $handle = new \Verot\Upload\Upload($_FILES[$a]);
//       $ex=explode('.',$_FILES[$a]['name']);
//       $ext=$ex[(count($ex)-1)];
//       if ($handle->uploaded) {
//             $handle->file_new_name_body=rand(1,100).date('dmyhis');
//             $handle->file_new_name_ext=$ext;
//             $handle->file_force_extension=false;
//             $handle->file_overwrite=true;
//             $handle->file_safe_name = true;
//             $handle->jpeg_quality = 50;
//             $handle->process($c.'assets/unggah/'.$b.'/');
//             if ($handle->processed) {
//                 print_r($handle->file_dst_name);
//                 die();
//                 return $handle->file_dst_name;
//             } 
//             else{
//                 return false;
//             }
//       }
//   }