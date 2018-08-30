<?php
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
*/

// include database and object files
include_once '../config/database.php';
include_once '../objects/system_user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare system-user object
$system_user = new System_User($db);

// set ID property of system-user to be edited
$system_user->user_id = isset($_POST['user_id']) ? $_POST['user_id'] : die();
$system_user->full_name = isset($_POST['full_name']) ? $_POST['full_name'] : die();
$system_user->password = isset($_POST['password']) ? $_POST['password'] : die();


 try{
    // update the product
    if($system_user->update()){
        $system_user_arr = array(
            "message"=>"User was updated.",
            "flag"=>true
        );
    }

    // if unable to update the product, tell the user
    else{
        throw new Exception("Unable to update user.");
    }
}catch (Exception $v){
    $system_user_arr = array(
        "message"=>$v->getMessage(),
        "flag"=>false
    );
}
// make it json format
print_r(json_encode($system_user_arr));
?>
