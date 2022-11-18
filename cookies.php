<?php

 $handle_session = curl_init();

 $url_name = "https://support.microsoft.com/en-in/whats-new";

 $file_name = __DIR__ . DIRECTORY_SEPARATOR . "cookie.txt";

 curl_setopt_array($handle_session,

  array(

CURLOPT_URL => $url_name,

CURLOPT_COOKIEFILE => $file_name,

   CURLOPT_COOKIEJAR  => $file_name,

CURLOPT_RETURNTRANSFER => true,

  )

);

 $data = curl_exec($handle);

 curl_close($handle);

?>