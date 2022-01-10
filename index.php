<?php
    header('Content-type:application/json;charset=utf-8');

    $DateTime = new DateTime();
    $currentTime = $DateTime->format("Y-m-d H:i:s");
    echo json_encode($currentTime);
?>