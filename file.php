<!DOCTYPE html>

<html>

<body>

<?php

$url_name ="https://support.microsoft.com/en-in/whats-new.html";

$file_name = __DIR__ . DIRECTORY_SEPARATOR . "Microsot_new_launch.html";

$handle_session = curl_init();

$fileHandle_name = fopen($file, "w");

curl_setopt_array($handle_session,

  array(

  CURLOPT_URL       => $url_name,

   CURLOPT_FILE => $fileHandle_name,

  )

);

$data_result = curl_exec($handle_session);

curl_close($handle_session);

fclose($fileHandle_name);

?>

</body>

</html>