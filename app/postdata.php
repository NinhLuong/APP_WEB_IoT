<?php
	require('connectdb.php');

	$ThietBi = $_GET["ThietBi"];
	$NhietDo = $_GET["NhietDo"];
	$DoAm = $_GET["DoAm"];
	$AnhSang = $_GET["AnhSang"];
	$CO2 = $_GET["CO2"];
	$Mua = $_GET["Mua"];
	$ThoiTiet = $_GET["ThoiTiet"];

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$time_act = date('Y-m-d H:i:s'); // use actual date() format displayed in your table.

	$sql = "INSERT INTO DataIoTProject (ThietBi, NhietDo, DoAm, AnhSang, CO2, Mua, ThoiTiet, ThoiGian)
        	VALUES ('" . $ThietBi . "','" . $NhietDo . "', '" . $DoAm . "' , '" . $AnhSang . "' , '" . $CO2 . "' , '" . $Mua . "', '" . $ThoiTiet . "', '" . $time_act . "')";
	$conn->query($sql);   

	$conn->close();	
?>