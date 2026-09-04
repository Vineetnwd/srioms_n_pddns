<?php

$senderId = "DGSEAL";
$flow_id = '6a9694a6a41a027ac80341c5';
$recipients = array(
    array(
        "mobiles" => "919431426600",
        "VAR1" => "142421"
        )
);

//Prepare you post parameters
$postData = array(
    "sender" => $senderId,
    "flow_id" => $flow_id,
    "recipients" => $recipients
);
$postDataJson = json_encode($postData);

$url="http://textsms.morg.in/api/v5/flow/";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "$url",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $postDataJson,
    CURLOPT_HTTPHEADER => array(
        "authkey: 566499AZ5ZMEDoIEl6a968aa5P1",
        "content-type: application/json"
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
?>
            