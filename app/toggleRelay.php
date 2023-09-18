<?php
	require('connectdb.php');

	$sql = "SELECT * FROM `DataModeIoTProject` WHERE 1";

	if ($result = $conn->query($sql)) {
		while ($row = $result->fetch_assoc()) {
            $Relay = $row["K1"];
            echo '[{"Relay1":' . $Relay . '}]';	

			$Relay = 1 - $Relay;
			//echo '[{"Relay1 Toggle":' . $Relay . '}]';
			$sql1 = "UPDATE `DataModeIoTProject` SET `K1`=" . $Relay . " WHERE 1";
			//$sql = "UPDATE 'DataModeIoTProject' SET 'K1'= " . $Relay . " WHERE 1";
			echo $sql1;
			$conn->query($sql1);  
		}
		$result->free();
	}

	//$conn->close();	


	 

	$conn->close();	

	// $jsonString = file_get_contents("relay.json");
	// $data = json_decode($jsonString, true);

	// echo $data["Relay1"];

	// if($data['Relay1'] == 1){
	// 	echo "ON, switch to off";
	// 	//$data['Relay1'] = 0;
	// }

	// else if($data['Relay1'] == 0){
	// 	echo "OFF, switch to on";
	// 	//$data['Relay1'] = 1;
	// }

	// $newJsonString = json_encode($data);
	// echo $newJsonString;
    //file_put_contents("relay.json", $newJsonString);
	//header("Location: /index.php");
?>