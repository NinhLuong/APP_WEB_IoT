# APP_WEB_IoT
1. **Mục tiêu của đề tài hệ thống giám sát nhiệt độ, độ ẩm, ánh sáng và điều khiển thiết bị điện 
trong nhà.**
  + Dùng vi điều khiển ESP32, đọc dữ liệu từ các cảm biến SHT31 (nhiệt độ, độ ẩm) và BH1750 (ánh sáng) và gửi lên server thông qua API postdata.php. Và lấy trạng thái nút bấm từ server thông qua API relay.php để điều khiển một Relay bật 
tắt thiết bị điện trong nhà.
  + Phần app giám sát được viết bằng Android Studio theo dạng webview để hiển thị nhiệt độ, độ ẩm, ánh sáng, biểu đồ và điều khiển thiết bị
2. **Kết quả thực hiện**
 + Khi khởi động app sẽ load trang web https://nckh.assfa.net lên. Trên app sẽ có các chức năng giám sát trạng thái kết nối mạng. Khi mạng bị ngắt kết nối thì trên app sẽ hiển thị
thông báo “Không có kết nối internet”.
![image](https://github.com/NinhLuong/APP_WEB_IoT/assets/90811122/cbf661c8-1907-429a-b4b4-8138442cd3ab)
![ảnh web](https://github.com/NinhLuong/APP_WEB_IoT/assets/90811122/051081bb-bf00-408e-81da-d2ce4c1b4142)
 + Giao diện trên web bao gồm ba khung hiển thị nhiệt độ, độ ẩm, ánh sáng. Một biểu đồ cập nhật theo thời gian thực và một nút bấm để điều khiển bật tắt thiết bị điện.
![image](https://github.com/NinhLuong/APP_WEB_IoT/assets/90811122/dac8de9f-0cee-498e-8f40-1ce7dd838385)




