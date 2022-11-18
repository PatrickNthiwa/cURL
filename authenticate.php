<?php

curl_setopt_array($handle_session,

  array(

CURLOPT_URL => $url_,

   CURLOPT_HTTPAUTH => CURLAUTH_ANY,

   CURLOPT_USERPWD  => "$user_name:$p_word",

   CURLOPT_RETURNTRANSFER   => true,

  )

);

?>