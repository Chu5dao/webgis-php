<?php
  $title="Biểu đồ";
  $judul=$title;
  $url='chart';
 ?>
<?=content_open($title)?>
  
  <?php

  // Đường dẫn đến thư mục chứa các file JSON
  $folder_path = __DIR__ . '/../assets/unggah/geojson';
  
  // Lấy danh sách các file JSON trong thư mục
  $json_files_2015 = glob($folder_path . '/*_2015.json');
  $json_files_2010 = glob($folder_path . '/*_2010.json');


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
  <center><h3>BIỂU ĐỒ THỐNG KÊ HIỆN TRẠNG SỬ DỤNG ĐẤT NĂM 2015 SO VỚI 2010 (đơn vị: m<sup>2</sup>)</h3></center>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="myChart" width="400" height="200"></canvas>

  <script>
    var data2015 = <?php echo json_encode($sum_2015); ?>;
    // {
    //   // Thêm dữ liệu từ file JSON 2015 của bạn vào đây
    // };

    var data2010 = <?php echo json_encode($sum_2010); ?>;
    // {
    //   'BCS': 123456.789,
    //   'BHK': 987654.321,
    //   // Thêm dữ liệu từ file JSON 2010 của bạn vào đây
    // };

    var labels = Object.keys(data2015);
    var data2015Values = Object.values(data2015);
    var data2010Values = Object.values(data2010);

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: '2015',
            data: data2015Values,
            backgroundColor: 'rgba(54, 162, 235, 0.5)'
          },
          {
            label: '2010',
            data: data2010Values,
            backgroundColor: 'rgba(255, 99, 132, 0.5)'
          }
        ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
  </script>
<?=content_close()?>
