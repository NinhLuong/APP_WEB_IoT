<?php
	ob_start();
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');

	if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');
	require ('./Classes/PHPExcel.php');
	require ('connectdb.php');

	$objPHPExcel = new PHPExcel();

	// $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
	// 							 ->setLastModifiedBy("Maarten Balliauw")
	// 							 ->setTitle("Office 2007 XLSX Test Document")
	// 							 ->setSubject("Office 2007 XLSX Test Document")
	// 							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	// 							 ->setKeywords("office 2007 openxml php")
	// 							 ->setCategory("Test result file");
	$rowCount = 1;
	$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A'.$rowCount,'STT')	
	            ->setCellValue('B'.$rowCount,'Nhiet Do(°C)')
	            ->setCellValue('C'.$rowCount,'Do Am(%)')
	            ->setCellValue('D'.$rowCount,'AnhSang (lx)')
	            ->setCellValue('E'.$rowCount,'ThoiGian');

	// $sql = "SELECT co2, co, nd, da, lati, longti, time_act FROM data ORDER BY id";
	$sql = "SELECT * FROM `DataIoTProject` ORDER BY STT";

	if ($result = $conn->query($sql)) {
		$stt = 0;
        while ($row = $result->fetch_assoc()) {    
            $stt++;
            $rowCount++;
            $objPHPExcel->setActiveSheetIndex(0)
	        ->setCellValue('A'.$rowCount,$stt) 
	     	->setCellValue('B'.$rowCount,$row["NhietDo"])
	     	->setCellValue('C'.$rowCount,$row["DoAm"])
	     	->setCellValue('D'.$rowCount,$row["AnhSang"])
	     	// ->setCellValue('E'.$rowCount,$row["da"])
	     	// ->setCellValue('F'.$rowCount,$row["lati"])
	     	// ->setCellValue('G'.$rowCount,$row["longti"])
	     	->setCellValue('E'.$rowCount,$row["ThoiGian"]); 
	           
        }
        $result->free();
    }

	// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
	// $objWriter->setSheetIndex(0);   // Select which sheet.
	// $objWriter->setDelimiter(',');  // Define delimiter
	// $objWriter->save('data.csv');
 


	$objPHPExcel->getActiveSheet()->setTitle('DataASSFC');
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="data.csv"');
	header('Cache-Control: max-age=0');
	header('Cache-Control: max-age=1');
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
	$objWriter->save('php://output');
	exit;
	ob_end_flush();
?>
