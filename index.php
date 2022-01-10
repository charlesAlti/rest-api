<?php
header('Content-type:application/json;charset=utf-8');

//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
$contentIsJson = strpos($contentType, "application/json");

if ($contentIsJson === false){
    throw new Exception('Content type must be: application/json');
}

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

$app = strtoupper($decoded['API']);
$key = $decoded['APIKEY'];

//verify user key - simple MD5 generator: http://onlinemd5.com/.  will build user management for keys if ever needed
if ( $key == "BEAF1CB722A3F7758C7A7FA43F6BF2D1" )
{   

    switch ($app) {
        case "TIME":
            $jsonString = getTime();
            $arr = array('datetime' => $jsonString);
            break;
        default:
            $arr = array('error' => "Unknown Request On API");
            break;
    }  

    echo json_encode($arr);
}


//return the current time
function getTime ()
{
    $DateTime = new DateTime();

    //by default heroku returns time in UTC - can change in dashboard, config vars, only use as needed below
    //$DateTime->modify('-6 hours');
    $currentTime = $DateTime->format("Y-m-d H:i:s");

    $jsonString = $currentTime;

    return $jsonString;
}
?>