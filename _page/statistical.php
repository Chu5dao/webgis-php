<?php
  $title="Thống kê";
  $judul=$title;
  $url='statistical';
  $fileJs='statisticalJs';
 ?>
<?=content_open($title)?>
  
  <?php
  // ------------Test trước 2 file json-------------------------------------------

  // $data = json_decode(file_get_contents('D:\XAMPP\htdocs\webgis-php\assets\unggah\geojson\CAN_2010.json'), true);
  // $data2 = json_decode(file_get_contents('D:\XAMPP\htdocs\webgis-php\assets\unggah\geojson\CAN_2015.json'), true);

  // // print_r($data);
  // // print_r($data2);

  // // Kiểm tra nếu quá trình chuyển đổi JSON thành PHP có thành công hay không
  // if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
  //     die('Không thể đọc file JSON');
  // }
  // // echo count($data['features']);
  // // echo '<br>';
  // foreach($data['features'] as $key => $value){
  //   // print_r($value);
  //   // echo $value['properties']['Shape_Area'];
  // }

  // echo '<br>';

  // // Kiểm tra nếu quá trình chuyển đổi JSON thành PHP có thành công hay không
  // if ($data2 === null && json_last_error() !== JSON_ERROR_NONE) {
  //     die('Không thể đọc file JSON');
  // }
  // // echo count($data2['features']);
  // // echo '<br>';
  // foreach($data2['features'] as $key2 => $value2){
  //   // print_r($value2);
  //   // echo $value2['properties']['Shape_Area'];
  // }

  // // Tạo mảng chứa giá trị "Shape_Area" từ mỗi file
  // $shape_areas1 = array_map(function($feature) {
  //     return $feature['properties']['Shape_Area'];
  // }, $data['features']);

  // $shape_areas2 = array_map(function($feature) {
  //   return $feature['properties']['Shape_Area'];
  // }, $data2['features']);

  // // Tính toán sự chênh lệch giữa hai mảng giá trị "Shape_Area"
  // $diff = array_map(function($a, $b) {
  //     return $b - $a;
  // }, $shape_areas1, $shape_areas2);

  // // Hiển thị kết quả
  // // print_r($diff);
  // // Tính tổng của các giá trị sự chênh lệch
  // $total_diff = array_sum($diff);
  // // Hiển thị kết quả
  // // echo 'Tổng của sự chênh lệch giữa các giá trị "Shape_Area": '. $total_diff;

  // ------------------------------------------------------------------------------
  $current_directory = __DIR__;
//   $folder_path = __DIR__ . '/../assets/unggah/geojson';
  // Đường dẫn đến thư mục chứa các file JSON
  $folder_path = str_replace('\\', '/', $current_directory) . '/../assets/unggah/geojson';

  
  // Lấy danh sách các file JSON trong thư mục
  $json_files_2015 = glob($folder_path . '/*_2015.json');
  $json_files_2010 = glob($folder_path . '/*_2010.json');

//   echo $folder_path;

  // print_r($json_files);

  // Mảng chứa dữ liệu
  $data_2015 = [];
  $data_2010 = [];

  // Đọc và xử lý dữ liệu từ các file JSON_2015
  foreach ($json_files_2015 as $file) {
      $file_content = file_get_contents($file);
      $array = json_decode($file_content, true);

      // Lặp qua từng phần tử trong mỗi file JSON để kiểm tra giá trị "MaDat"
      foreach ($array['features'] as $feature) {
          $properties = $feature['properties'];

          // Kiểm tra xem key "Shape_Area" có tồn tại trong properties hay không
          if (isset($properties['Shape_Area'])) {
              $maDat = $properties['MaDat'];

              // Kiểm tra xem MaDat đã tồn tại trong $data_2015 hay chưa
              $found = false;
              foreach ($data_2015 as &$item) {
                  if ($item['MaDat'] === $maDat) {
                      $item['Shape_Area'][] = $feature['properties']['Shape_Area'];
                      $found = true;
                      break;
                  }
              }

              // Nếu MaDat chưa tồn tại trong $data_2015, thêm mới nó
              if (!$found) {
                  $data_2015[] = [
                      'MaDat' => $maDat,
                      'Shape_Area' => [$feature['properties']['Shape_Area']]
                  ];
              }

          } else {
              // Nếu không có key "Shape_Area", bạn có thể xử lý tùy ý ở đây
              // Ví dụ: thông báo hoặc bỏ qua file không chứa key này
              echo "File $file không chứa key 'Shape_Area'.<br>";
          }
      }
  }

  // Đọc và xử lý dữ liệu từ các file JSON_2010
  foreach ($json_files_2010 as $file) {
      $file_content = file_get_contents($file);
      $array = json_decode($file_content, true);

      // Lặp qua từng phần tử trong mỗi file JSON để kiểm tra giá trị "MaDat"
      foreach ($array['features'] as $feature) {
          $properties = $feature['properties'];

          // Kiểm tra xem key "Shape_Area" có tồn tại trong properties hay không
          if (isset($properties['Shape_Area'])) {
              $maDat = $properties['MaDat'];              
              // Kiểm tra xem MaDat đã tồn tại trong $data_2010 hay chưa
              $found = false;
              foreach ($data_2010 as &$item) {
                  if ($item['MaDat'] === $maDat) {
                      $item['Shape_Area'][] = $feature['properties']['Shape_Area'];
                      $found = true;
                      break;
                  }
              }

              // Nếu MaDat chưa tồn tại trong $data_2010, thêm mới nó
              if (!$found) {
                  $data_2010[] = [
                      'MaDat' => $maDat,
                      'Shape_Area' => [$feature['properties']['Shape_Area']]
                  ];
              }

          } else {
              // Nếu không có key "Shape_Area", bạn có thể xử lý tùy ý ở đây
              // Ví dụ: thông báo hoặc bỏ qua file không chứa key này
              echo "File $file không chứa key 'Shape_Area'.<br>";
          }
      }
  }

  // Hiển thị kết quả
  // echo '<pre>';
  // print_r($data_2015);
  // print_r($data_2010);
  // echo '</pre>';

  // Tính tổng diện tích mỗi năm theo MaDat
  $sum_2015 = []; // Mảng lưu trữ tổng diện tích từ JSON 2015
  $sum_2010 = []; // Mảng lưu trữ tổng diện tích từ JSON 2010
  
  foreach ($data_2015 as $item) {
      $maDat = $item['MaDat'];
      $shapeArea = $item['Shape_Area'];

      // Tính tổng Shape_Area cho từng MaDat
      $totalShapeArea = array_sum($shapeArea);

      // Lưu tổng Shape_Area vào mảng kết quả
      $sum_2015[$maDat] = $totalShapeArea;
      
  }

  foreach ($data_2010 as $item) {
      $maDat1 = $item['MaDat'];
      $shapeArea1 = $item['Shape_Area'];

      // Tính tổng Shape_Area cho từng MaDat
      $totalShapeArea1 = array_sum($shapeArea1);

      // Lưu tổng Shape_Area vào mảng kết quả
      $sum_2010[$maDat1] = $totalShapeArea1;

  }

        

  // echo '<pre>';
  
  // print_r($sum_2015);
  // print_r('---------------------------------------------------------------------------</br>');
  // print_r($sum_2010);

  // echo '</pre>';


  // echo '<pre>';
  
  // print_r($sum_2010);

  // echo '</pre>';


  


  ?>
  <style>
      th, td {
      padding: 0.5em;
      text-align: left;
      border-bottom: 1px solid #ececec;
      line-height: 1.3;
      font-size: .9em;
  }
  table,
  th,
  td {
      border-collapse: collapse;
      border: 1px solid gainsboro;
      padding: 3px 5px;
  }

  #table-analyst thead {
      text-align: center;
      font-weight: bold;
  }

  .center {
      text-align: center;
  }

  .bold {
      font-weight: bold;
  }

  #table-analyst td:not(:nth-of-type(2)) {
      text-align: center;
  }
  #table-analyst {
    color: #000;
    margin: 0 auto;
  }
  #table-analyst td:not(:nth-of-type(2)) {
    text-align: center;
  }
  </style>
  <center><h3>BẢNG THỐNG KÊ BIẾN ĐỘNG DIỆN TÍCH THEO MỤC ĐÍCH SỬ DỤNG ĐẤT (đơn vị: m<sup>2</sup>)</h3></center>
  <table id="table-analyst" >
      <thead>
    
          <tr>
              <td rowspan="2">Thứ tự</td>
              <td rowspan="2">Mục đích sử dụng</td>
              <td rowspan="2">Mã</td>
              <td rowspan="2">Diện tích năm 2015</td>
              <th colspan="2" scope="colgroup">So với năm 2010</th>
              <th colspan="2" scope="colgroup">So với năm ...</th>
              <td rowspan="2">Ghi chú</td>
          </tr>
          <tr>
              <th scope="col">Diện tích</th>
              <th scope="col">Tăng (+) </br>
                      Giảm (-)</th>
              <th scope="col">Diện tích</th>
              <th scope="col">Tăng (+) </br>
                      Giảm (-)</th>
          </tr>
          <tr class="center">
              <?php
                for( $i = 1; $i <=9 ; $i++){
                   
                    if($i == 6){
                        echo ' <td>('.$i.') = (4) - (5)</td>';   
                    }elseif($i == 8){
                        echo ' <td>('.$i.') = (4) - (7)</td>';   
                    }
                    else{
                        echo ' <td>('.$i.')</td>';
                    }
                }
              ?>
          </tr>
          </col>
          </thead>
          <tbody>
              <tr>
                  <td></td> <!-- (1) -->
                  <td>Tổng diện tích đất của đơn vị hành chính</td> <!-- (2) -->
                  <?php for( $i = 1; $i <=7 ; $i++){
                      
                      echo '<td></td>'; // (3)
                  }?>
              </tr>
              <?php
                  // $arr_general = array();
                  // $arr_2005_new = array();
                  // $arr_merge = array();
                  $n =0;
                  // foreach( $data_array_2015 as $key_2015 => $val_2015) {
                              
                  //         foreach( $data_array_2005 as $key_2005 => $val_2005) {
                             
                  //             if( $key_2005 == $key_2015  ){
                  //                 $arr_2005_new[$key_2015] = [ $val_2005[0],  $val_2005[2], $key_2005];
                  //             }
                  //         }
                          
                  // }

                  // foreach( $data_array_2015 as $key_2015 => $val_2015) {
                              
                  //     foreach( $arr_2005_new as $key_new => $val_new) {
                      
                  //         if( $key_new === $key_2015  ){
                  //             unset($data_array_2015[$key_2015]);
                  //             $arr_general[$key_2015] = [$key_2015, $val_2015[1],  $val_2015[2],  $val_new[1],  $val_new[2]];
                  //         }
                  //     }
                          
                  // }
                  // $arr_merge = array_merge($arr_general, $data_array_2015);
                ?>
                    
                <?php

                // Tính chênh lệch diện tích giữa năm 2015 và 2010
                $diff = []; // Mảng lưu trữ chênh lệch diện tích giữa 2015 và 2010

                // foreach ($sum_2015 as $maDat => $totalArea2015) {
                //     if (isset($sum_2010[$maDat])) {
                //         $diff[$maDat] = $totalArea2015 - $sum_2010[$maDat];
                //         echo '<pre>';
                        
                //         print_r($maDat. '</br>');
                //         print_r($diff[$maDat]);

                //         echo '</pre>';
                //     } else {
                //         // Xử lý khi không có dữ liệu từ JSON 2010 cho cùng MaDat
                //         // $diff[$maDat] = 'Không có dữ liệu 2010 cho MaDat: ' . $maDat;
                //         $diff[$maDat] = $totalArea2015;


                //         echo '<pre>';
                //         print_r('--------------------------------------------</br>');
                //         print_r('MaDat dữ liệu 2010 không có: ' . $maDat .'</br>');
                //         print_r($diff[$maDat]);

                //         echo '</pre>';
                //     }
                // }

                // // Không tồn tại MaDat sum_2015 chỉ có ở sum_2010
                // // KQ: DCS, LMU, LUA, SXN
                // foreach ($sum_2010 as $maDat => $totalArea2010) {
                //     if (isset($sum_2015[$maDat])) {
                //         echo '<pre>';
                        
                //         print_r('MaDat dữ liệu 2015 và 2010 đều có: ' . $maDat .'</br>');

                //         echo '</pre>';
                //     } else {
                //         // Xử lý khi không có dữ liệu từ JSON 2015 cho cùng MaDat
                //         // $diff[$maDat] = 'Không có dữ liệu 2015 cho MaDat: ' . $maDat;
                //         $diff[$maDat] = $totalArea2010;


                //         echo '<pre>';
                //         print_r('--------------------------------------------</br>');
                //         print_r('MaDat dữ liệu chỉ 2010 có: ' . $maDat .'</br>');
                //         print_r($diff[$maDat]);

                //         echo '</pre>';
                //     }
                // }

                foreach ($sum_2015 as $maDat => $totalArea2015) {
                    if (isset($sum_2010[$maDat])) {
                        if (!isset($diff[$maDat])) {
                            $diff[$maDat] = [];
                        }
                        $diff[$maDat]['2015'] = $totalArea2015;
                    } else {
                        if (!isset($diff[$maDat])) {
                            $diff[$maDat] = [];
                        }
                        $diff[$maDat]['2015'] = $totalArea2015;
                    }
                }

                // Vòng lặp từ JSON_2010
                foreach ($sum_2010 as $maDat => $totalArea2010) {
                    if (isset($sum_2015[$maDat])) {
                        if (!isset($diff[$maDat])) {
                            $diff[$maDat] = [];
                        }
                        $diff[$maDat]['2010'] = $totalArea2010;
                    } else {
                        if (!isset($diff[$maDat])) {
                            $diff[$maDat] = [];
                        }
                        $diff[$maDat]['2010'] = $totalArea2010;
                    }
                    // echo '<pre>';
                    // print_r($diff[$maDat]['2010']);
                    // echo '</pre>';
                }

                // In ra mảng $diff sau khi gộp
                // echo '<pre>';
                // print_r($diff);
                // echo '</pre>';

                    foreach( $diff as $maDat => $val) {
                        $n++;
                        echo '<tr>';
                                    echo '<td>'.$n.'</td>';
                                    // echo '<td>Loại đất</td>'; // Loai_sdd
                                    if ($maDat === 'BCS') {
                                        echo '<td>Đất bằng chưa sử dụng</td>';
                                    }

                                    if ($maDat === 'BHK') {
                                        echo '<td>Đất bằng trồng cây hàng năm khác</td>';
                                    }
                                    if ($maDat === 'CAN') {
                                        echo '<td>Đất an ninh</td>';
                                    }
                                    if ($maDat === 'CCC') {
                                        echo '<td>Đất có mục đích công cộng</td>';
                                    }
                                    if ($maDat === 'CDG') {
                                        echo '<td>Đất chuyên dùng</td>';
                                    }  
                                    if ($maDat === 'CLN') {
                                        echo '<td>Đất trồng cây lâu năm</td>';
                                    }  
                                    if ($maDat === 'CQP') {
                                        echo '<td>Đất quốc phòng</td>';
                                    }  
                                    if ($maDat === 'DBV') {
                                        echo '<td>Đất công trình bưu chính viễn thông</td>';
                                    }  
                                    if ($maDat === 'DCH') {
                                        echo '<td>Đất có mục đích công cộng</td>';
                                    }  
                                    if ($maDat === 'DCK') {
                                        echo '<td>Đất công trình công cộng khác</td>';
                                    }
                                    if ($maDat === 'DDL') {
                                        echo '<td>Đất danh lam thắng cảnh</td>';
                                    }
                                    if ($maDat === 'DDT') {
                                        echo '<td>Đất có di tích lịch sử - văn hóa</td>';
                                    }
                                    if ($maDat === 'DGD') {
                                        echo '<td>Đất xây dựng cơ sở giáo dục và đào tạo</td>';
                                    }
                                    if ($maDat === 'DGT') {
                                        echo '<td>Đất giao thông</td>';
                                    }
                                    if ($maDat === 'DKH') {
                                        echo '<td>Đất xây dựng cơ sở khoa học và công nghệ</td>';
                                    }
                                    if ($maDat === 'DKV') {
                                        echo '<td>Đất khu vui chơi, giải trí công cộng</td>';
                                    }
                                    if ($maDat === 'DNG') {
                                        echo '<td>Đất xây dựng cơ sở ngoại giao</td>';
                                    }
                                    if ($maDat === 'DNL') {
                                        echo '<td>Đất công trình năng lượng</td>';
                                    }
                                    if ($maDat === 'DRA') {
                                        echo '<td>Đất bãi thải, xử lý chất thải</td>';
                                    }
                                    if ($maDat === 'DSH') {
                                        echo '<td>Đất sinh hoạt cộng đồng</td>';
                                    }
                                    if ($maDat === 'DSK') {
                                        echo '<td>Đất xây dựng công trình sự nghiệp khác</td>';
                                    }
                                    if ($maDat === 'DSN') {
                                        echo '<td>Đất xây dựng công trình sự nghiệp</td>';
                                    }
                                    if ($maDat === 'DTL') {
                                        echo '<td>Đất thủy lợi</td>';
                                    }
                                    if ($maDat === 'DTS') {
                                        echo '<td>Đất xây dựng trụ sở của tổ chức sự nghiệp</td>';
                                    }
                                    if ($maDat === 'DTT') {
                                        echo '<td>Đất xây dựng cơ sở thể dục thể thao</td>';
                                    }
                                    if ($maDat === 'DVH') {
                                        echo '<td>Đất xây dựng cơ sở văn hóa</td>';
                                    }
                                    if ($maDat === 'DXH') {
                                        echo '<td>Đất xây dựng cơ sở dịch vụ xã hội</td>';
                                    }
                                    if ($maDat === 'DYT') {
                                        echo '<td>Đất xây dựng cơ sở y tế</td>';
                                    }
                                    if ($maDat === 'HNK') {
                                        echo '<td>Đất trồng cây hàng năm khác</td>';
                                    }
                                    if ($maDat === 'LUC') {
                                        echo '<td>Đất chuyên trồng lúa nước</td>';
                                    }
                                    if ($maDat === 'LUK') {
                                        echo '<td>Đất trồng lúa nước còn lại</td>';
                                    }
                                    if ($maDat === 'LUN') {
                                        echo '<td>Đất trồng lúa nương</td>';
                                    }
                                    if ($maDat === 'MNC') {
                                        echo '<td>Đất có mặt nước chuyên dùng</td>';
                                    }
                                    if ($maDat === 'NCS') {
                                        echo '<td>Núi đá không có rừng cây</td>';
                                    }
                                    if ($maDat === 'NHK') {
                                        echo '<td>Đất nương rẫy trồng cây hàng năm khác</td>';
                                    }
                                    if ($maDat === 'NKH') {
                                        echo '<td>Đất nông nghiệp khác</td>';
                                    }
                                    if ($maDat === 'NTD') {
                                        echo '<td>Đất nghĩa trang, nghĩa địa, nhà tang lễ, nhà hỏa táng</td>';
                                    }
                                    if ($maDat === 'NTS') {
                                        echo '<td>Đất nuôi trồng thủy sản</td>';
                                    }
                                    if ($maDat === 'ODT') {
                                        echo '<td>Đất ở tại đô thị</td>';
                                    }
                                    if ($maDat === 'ONT') {
                                        echo '<td>Đất ở tại nông thôn</td>';
                                    }
                                    if ($maDat === 'PNK') {
                                        echo '<td>Đất phi nông nghiệp khác</td>';
                                    }
                                    if ($maDat === 'RDD/RDN/RDT/RDM') {
                                        echo '<td>Đất rừng đặc dụng</td>';
                                    }
                                    if ($maDat === 'RPH/RPN/RPT/RPM') {
                                        echo '<td>Đất rừng phòng hộ</td>';
                                    }
                                    if ($maDat === 'RSX/RSN/RST/RSM') {
                                        echo '<td>Đất rừng sản xuất</td>';
                                    }
                                    if ($maDat === 'SKC') {
                                        echo '<td>Đất cơ sở sản xuất phi nông nghiệp</td>';
                                    }
                                    if ($maDat === 'SKK/SKT') {
                                        echo '<td>Đất khu công nghiệp</td>';
                                    }
                                    if ($maDat === 'SKS') {
                                        echo '<td>Đất sử dụng cho hoạt động khoáng sản</td>';
                                    }
                                    if ($maDat === 'SKX') {
                                        echo '<td>Đất sản xuất vật liệu xây dựng, làm đồ gốm</td>';
                                    }
                                    if ($maDat === 'SON') {
                                        echo '<td>Đất sông, ngòi, kênh, rạch, suối</td>';
                                    }
                                    if ($maDat === 'TIN') {
                                        echo '<td>Đất cơ sở tín ngưỡng</td>';
                                    }
                                    if ($maDat === 'TMD') {
                                        echo '<td>Đất thương mại, dịch vụ</td>';
                                    }
                                    if ($maDat === 'TON') {
                                        echo '<td>Đất cơ sở tôn giáo</td>';
                                    }
                                    if ($maDat === 'TSC') {
                                        echo '<td>Đất xây dựng trụ sở cơ quan</td>';
                                    }
                                    if ($maDat === 'khong xac dinh') {
                                        echo '<td>Đất chưa xác định</td>';
                                    }
                                    if ($maDat === 'DCS') {
                                        echo '<td>Đất đồi núi chưa sử dụng</td>';
                                    }
                                    if ($maDat === 'LMU') {
                                        echo '<td>Đất làm muối</td>';
                                    }
                                    if ($maDat === 'LUA') {
                                        echo '<td>Đất trồng lúa</td>';
                                    }
                                    if ($maDat === 'SXN') {
                                        echo '<td>Đất sản xuất nông nghiệp</td>';
                                    }
                                    

                                    echo '<td>'.$maDat.'</td>'; // Ki_hieu

                                    // echo '<td>'.round($val[2],0).'</td>'; // dien tich 2015
                                    if (isset($val['2015'])) {
                                      if (is_numeric($val['2015'])) {
                                        echo '<td>' .  round($val['2015'],0) . '</td>';
                                      } 
                                    }else {
                                          echo '<td>0</td>'; // Nếu không có dữ liệu
                                    }
                                      

                                    // echo '<td>'.round($val[3],0).'</td>'; // dien tich 2005
                                    
                                    if(isset($val['2010'])){
                                      if (is_numeric($val['2010'])) {
                                        echo '<td>' . round($val['2010'],0) . '</td>';
                                      } 
                                    }else {
                                          echo '<td>0</td>'; // Nếu không có dữ liệu
                                    }
                                    
                                    // echo '<td>'.round(($val[2] - $val[3]),0).'</td>'; // dien tich 2005
                                    if(isset($val['2010'])){
                                      if (is_numeric($val['2010'])) {
                                          // Tính chênh lệch so với năm 2010
                                          $diffFrom2010 = isset($val['2015']) ? $val['2015'] - $val['2010'] : '';
                                          if (is_numeric($diffFrom2010)){
                                            echo '<td>' . round($diffFrom2010,0) . '</td>'; // Tăng/Giảm so với năm 2010
                                          }else {
                                            echo '<td>0</td>'; // Nếu không có dữ liệu
                                          }
                                      } 
                                    }
                                    else {
                                          echo '<td>0</td>'; // Nếu không có dữ liệu
                                    }

                                    echo '<td></td>';
                                    echo '<td></td>';
                                    echo '<td></td>';
                        echo '</tr>';
                    }
                ?>

          </tbody>        
  </table>

  <div class="left-analyst" style="display: block;">
      <a style=" position: absolute; top: 50%; left: 10%; " href="#" id="downloadLink">Click vào đây để tải file Excel</a>
  </div>
  <script type="text/javascript">
    function downloadExcel() {
    var table = document.getElementById('table-analyst');
    var name = 'analyst';

    var uri = 'data:application/vnd.ms-excel;base64,';
    var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>';
    var base64 = function(s) {
      return window.btoa(unescape(encodeURIComponent(s)));
    };
    var format = function(s, c) {
      return s.replace(/{(\w+)}/g, function(m, p) {
        return c[p];
      })
    };

    var ctx = {
      worksheet: name || 'Worksheet',
      table: table.innerHTML
    };

    var link = document.getElementById('downloadLink');
    link.href = uri + base64(format(template, ctx));
    link.download = name + '.xls';
  }

  document.getElementById('downloadLink').addEventListener('click', downloadExcel);
  </script>
<?=content_close()?>
