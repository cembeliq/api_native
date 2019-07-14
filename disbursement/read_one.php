<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/disbursement.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare disbursement object
$disbursement = new Disbursement($db);
 
// set ID property of record to read
$disbursement->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of disbursement to be edited
$disbursement->readOne();
 
if($disbursement->name!=null){
    // create array
    $disbursement_arr = array(
        "id" =>  $disbursement->id,
        "name" => $disbursement->name,
        "description" => $disbursement->description,
        "price" => $disbursement->price,
        "category_id" => $disbursement->category_id,
        "category_name" => $disbursement->category_name
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($disbursement_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user disbursement does not exist
    echo json_encode(array("message" => "disbursement does not exist."));
}
