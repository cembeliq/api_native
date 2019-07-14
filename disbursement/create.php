<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate disbursement object
include_once '../objects/disbursement.php';

// instantiate curl library
include_once '../library/curl.php';

define('BASE_URL_API', "https://nextar.flip.id");

$database = new Database();
$db = $database->getConnection();
 


$curl = new Curl();
 
// get posted data
// $data = json_decode(file_get_contents("php://input"));
// var_dump($data); die(); 
// make sure data is not empty
if(
    !empty($_POST['bank_code']) &&
    !empty($_POST['account_number']) &&
    !empty($_POST['amount']) &&
    !empty($_POST['remark'])
){
    $data = "";
    $data .= "bank_code=".$_POST['bank_code'];
    $data .= "&account_number=".$_POST['account_number'];
    $data .= "&amount=".$_POST['amount'];
    $data .= "&remark=".$_POST['remark'];

    // $data = "bank_code=bni&account_number=12345&amount=1000&remark=test";
    // call Slightly-big Flip API
    $response = json_decode($curl->postHttp(BASE_URL_API."/disburse", $data));

    if (!empty($response)){
        $disbursement = new Disbursement($db);
        $disbursement->id = $response->id;
        $disbursement->amount = $response->amount;
        $disbursement->status = $response->status;
        $disbursement->bank_code = $response->bank_code;
        $disbursement->account_number = $response->account_number;
        $disbursement->beneficiary_name = $response->beneficiary_name;
        $disbursement->remark = $response->remark;
        $disbursement->receipt = $response->receipt;
        $disbursement->time_served = $response->time_served;
        $disbursement->fee = $response->fee;
        $disbursement->created_at = date('Y-m-d H:i:s');
    }

    // var_dump($disbursement); die();
    // set disbursement property values
    
    // create the disbursement
    if($disbursement->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "disbursement was created."));
    }
 
    // if unable to create the disbursement, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create disbursement."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create disbursement. Data is incomplete."));
}
