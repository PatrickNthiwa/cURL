<!DOCTYPE html>

<html>

<body>

<?php

//here we're trying to show URL informatio assigned to google.com
$url_name = "https://google.com";// this is the url variable

  $ch_session = curl_init();//the sessio starts with this variable

  curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);//We're telling curl to return the informatio is  we set the value to "0",not output will be returned


  curl_setopt($ch_session, CURLOPT_URL, $url_name);

  $result_url = curl_exec($ch_session);

  echo $result_url;

  ?>

</body>

</html>

