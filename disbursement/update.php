<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/disbursement.php';

// instantiate curl library
include_once '../library/curl.php';

define('BASE_URL_API', "https://nextar.flip.id");

// get database connection
$database = new Database();
$db = $database->getConnection();
 

// prepare disbursement object
$disbursement = new disbursement($db);

$curl = new Curl();
  
// get id of disbursement to be edited
// $data = json_decode(file_get_contents("php://input"));
// var_dump($data); die(); 
// set ID property of disbursement to be edited
$data = $_GET['transaction_id'];
$response = json_decode($curl->getHttp(BASE_URL_API."/disburse/".$data)); 
// set disbursement property values
// $disbursement->name = $data->name;
// $disbursement->price = $data->price;
// $disbursement->description = $data->description;
// $disbursement->category_id = $data->category_id;
if (!empty($response) && $response->status == 'SUCCESS'){
	$disbursement->id = $response->id;
	$disbursement->status = $response->status;	
	$disbursement->receipt = $response->receipt;	
	$disbursement->time_served = $response->time_served;

	if($disbursement->update()){
 
	    // set response code - 200 ok
	    http_response_code(200);
	 
	    // tell the user
	    echo json_encode(array("message" => "disbursement was updated."));
	}
	 
	// if unable to update the disbursement, tell the user
	else{
	 
	    // set response code - 503 service unavailable
	    http_response_code(503);
	 
	    // tell the user
	    echo json_encode(array("message" => "Unable to update disbursement."));
	}	
}else{
	 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Please try again."));
}	 
