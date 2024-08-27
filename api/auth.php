<?php
require_once '../classes/auth.class.php';
require_once '../classes/responses.class.php';


$_auth = new auth();
$_responses = new responses();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reqbody = file_get_contents("php://input");
    $data = $_auth->signIn($reqbody);
    
    header('Content-Type: application/json');
    if(isset($data["result"]["error_id"])){
        $responseCode = $data["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($data);
} else {
    header('Content-Type: application/json');
    $data = $_responses->error_405();
    http_response_code(405);
    echo json_encode($data);
}
