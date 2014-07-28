<?php
/**
 * Artez Library
 *
 */
/** Define the URL * */
 $url = 'https://secure.e2rm.com/api/Registrations';
 $username = 'nbts';
 $password = '88247423acec49b7932ac3493b1e8251';
 $EventID = '148005';
 $headers = 'Authorization: Basic ' . base64_encode($username . ':' . $password);
 
 $args = array(
    'headers' => $headers
);
/*
 $result = wp_remote_get( $url, $headers, 'EventID=' . $EventID );*/

  print $result ['body'];  
  echo 'test'
  
?> 


<body>
</body>