<?php
header('Content-type:application/json;charset=utf-8');

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

$DateTime = new DateTime();

//by default heroku returns time in UTC - can change in dashboard, config vars, only use as needed below
//$DateTime->modify('-6 hours');
$currentTime = $DateTime->format("Y-m-d H:i:s");

$jsonString = $currentTime;

$arr = array('datetime' => $jsonString);

echo json_encode($arr);

?>
