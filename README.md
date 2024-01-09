# WEBGIS PHP
Một ứng dụng GIS dựa trên web tiêu chuẩn có thể được phát triển thành một ứng dụng hữu ích hơn trong tương lai.
Dự án này chỉ trong phạm vi nghiên cứu đồ án tốt nghiệp sinh viên vẫn đang được phát triển

# Các thành phần trong dự án WEBGIS PHP
1. Sử dụng ngôn ngữ lập trình PHP >5.5
2. Package được sử dụng:
```
	"joshcam/mysqli-database-class": "dev-master",
	"josantonius/session": "^1.1",
	"verot/class.upload.php": "dev-master"
```
3. Cơ sở dữ liệu từ MariaDB ([XAMPP](https://www.apachefriends.org/index.html)) 
4. Temple frontend sử dụng [Admin LTE](https://github.com/ColorlibHQ/AdminLTE/releases/tag/v2.4.17).
5. Mã nguồn, thư viện và những công nghệ khác: ArcMap, Leaflet, Chart.js.

# Các chức năng trong dự án
## Người dùng
	- Trang chủ
    - Bản đồ:
    	+ Tìm kiếm trên map theo Polygon (đang phát triển)
    	+ Xem bản đồ 
    - Đăng nhập
    - Đăng ký (đang phát triển)
    - Thống kê
    - Biểu đồ
## Admin
	- Trang chủ
	- Bản đồ:
		+ Tìm kiếm trên map theo Polygon (đang phát triển)
		+ Xem bản đồ
		+ Thêm, sửa, xóa polygon
	- Đăng nhập
    - Quản lý người dùng (đang phát triển)
    - Thống kê
    - Biểu đồ

## Thông tin dữ liệu
### Dữ liệu không gian
- Hiện trạng sử dụng đất TP.HCM 2010 và 2015.
Dữ liệu chuẩn hóa đầu ra cuối cùng sử dụng trên dự án GeoJson có dạng:	

```
{
	"type": "FeatureCollection",
	"features": [
		{
			"type": "Feature",
			"geometry":
			{
				"type": "Polygon",
				"coordinates": [
									[
										[lat1,lng1],
										[lat2,lng2],
										........
									],
									[
										[lat1,lng1],
										[lat2,lng2],
										........
									],
									..........
								]
			},
			"properties": {
				"FID": *Object ID*,
				"Layer": *String*,
				"Color": *Short*,
				"MaDat": *String*,
				"Shape_Area": *float*
			}
		},
		{
			"type": "Feature",
			"geometry":
			{
				......
			},
			.......
		},
		......
	]
}
```

### Dữ liệu phi không gian
- CSDL:

	| Số thứ tự     |	Tên Bảng			|			Ghi chú			|
	| :-----------:	|:---------------------:|:-------------------------:|
	| 1      		| Actors				|Bảng tác nhân				|
	| 2				| Polygon		        |Bảng lưu dữ liệu GeoJson	|

	| Tên cột     	|		Kiểu dữ liệu	|	Khóa	|			Ghi chú				|
	| :-----------:	|:---------------------:|:---------:|:-----------------------------:|
	| id_login    	| int(11)				|Khóa chính	|Id người dùng					|
	| name			| Varchar(20)			|			|Tên người dùng					|
	| pass			| Varchar(150)			|			|Tên người dùng					|
	| level			| Enum(‘Admin’,’User’) 	|			|Trường phân cấp khi đăng nhập	|

	| Tên cột     		|	Kiểu dữ liệu	|	Khóa	|				Ghi chú				|
	| :-----------:		|:-----------------:|:---------:|:---------------------------------:|
	| id_polygon   		| int(11)			|Khóa chính	|Mã người dùng						|
	| MaDat				| Varchar(30)		|			|Mã đất								|
	| Geojson_polygon	| Varchar(30)		|			|Trường lưu tên Geojson				|
	| Color				| Varchar(30) 		|			|Mã màu								|
	| Year				| Year(4) 			|			|Năm của dữ liệu Đất được cập nhật	|

# Cài đặt và sử dụng
- Bạn cần tùy biến lại Apache file **php.ini** *memory_limit* >= 1G để bộ nhớ có thể xử lý các file Json và thống kê
- Tùy biến host, server bạn ở file **env.php**
- Tài khoản đăng nhập:

	| Tên Tài khoản |		Pass			| Chức năng		|
	| :-----------:	|:---------------------:|:-------------:|
	| 	admin      	| 	123465				|	Admin		|
	| 	user		| 	123456		      	|	Người dùng	|

# Thông tin người phát triển
* Author: Lê Trần Minh Quang
* Gmail: quang3560396@gmail.com
* Gmail: minhqlee1794@gmail.com
* Github: https://github.com/Chu5dao

