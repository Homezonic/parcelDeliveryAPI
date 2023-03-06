<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Parcels.php';
 
$database = new Database();
$db = $database->getConnection();
 
$parcels = new Parcels($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->parcelname) && !empty($data->sendername) &&
!empty($data->receivername) && !empty($data->address) && !empty($data->trackingcode) &&
!empty($data->shippingdate) && !empty($data->receiverdate)){ 
	
	$parcels->parcelname = $data->parcelname;
    $parcels->sendername = $data->sendername;
    $parcels->receivername = $data->receivername;
    $parcels->address = $data->address;	
    $parcels->trackingcode = rand(1000000000,9999999999);
    $parcels->shippingdate = date('Y-m-d H:i:s'); 
    $parcels->receiverdate = date('Y-m-d H:i:s'); 
	
	
	if($parcels->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Item was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update items."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update items. Data is incomplete."));
}
?>