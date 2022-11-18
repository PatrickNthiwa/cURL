<html>

<body>

 <form method = "POST" action = "" >

  <input  name="first_Name"  type="text">

  <input  name="last_Name"  type="text">

  <input  type="submit"  name="submit"  value="שלח" >

</form>

</body>

</html>

<?php

$handle = curl_init();

$url = "https://localhost/curl/theForm.php";//initializing the target url 

$postData = array(

  'firstName' => 'Lady',

  'lastName'  => 'Gaga',

  'submit'    => 'ok'

); 

curl_setopt_array($handle,

  array(

  CURLOPT_URL => $url,

  // Enable the post response.

CURLOPT_POST   => true,

CURLOPT_POSTFIELDS => $postData,

CURLOPT_RETURNTRANSFER => true,

  )

);

 $data = curl_exec($handle);

curl_close($handle);

echo $data;

?>

