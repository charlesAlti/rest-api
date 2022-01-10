<?php
header('Content-type:application/json;charset=utf-8');

//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}

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

$jsonString = getTime();
$arr = array('datetime' => $jsonString);

echo json_encode($arr);


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
