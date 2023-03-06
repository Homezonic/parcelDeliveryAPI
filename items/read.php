<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Parcels.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Parcels($db);

$items->trackingcode = (isset($_GET['trackingcode']) && $_GET['trackingcode']) ? $_GET['trackingcode'] : '';

$result = $items->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["parcels"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "parcelname" => $parcelname,
            "sendername" => $sendername,
			"receivername" => $receivername,
            "address" => $address,
            "trackingcode" => $trackingcode,            
			"shippingdate" => $shippingdate,
            "receiverdate" => $receiverdate			
        ); 
       array_push($itemRecords["parcels"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 