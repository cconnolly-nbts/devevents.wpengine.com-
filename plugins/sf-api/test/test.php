<!doctype html>
<html>
<head>
<title>Simple PHP Search Engine - phphunger.com</title>
</head>
<body>

<?php
// SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
// $USERNAME - variable that contains your Salesforce.com username (must be in the form of an email)
// $PASSWORD - variable that contains your Salesforce.com password

define("SOAP_CLIENT_BASEDIR", "../soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');
require_once ('../samples/userAuth.php');

ini_set('soap.wsdl_cache_enabled', '0'); 
ini_set('soap.wsdl_cache_ttl', '0'); 

try {
  $mySforceConnection = new SforceEnterpriseClient();
  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

  echo "<strong>***** Get Server Timestamp *****</strong></br>\n";
  $response = $mySforceConnection->getServerTimestamp();
  print_r($response);

  echo '<br/><br/>';

} catch (Exception $e) {
  print_r($e);
}

    echo 'test';

// Pulls Custom Fields 
$query = 'SELECT Event_City__c, Event_Date__c, Event_State__c, Event_URL__c, Campaign_Public_Name__c, Event_Zip_Code__c FROM Campaign WHERE available_in_search__c = true ';
$response = $mySforceConnection->query($query);

echo "<strong>Results of Campaigns </strong><br/><br/>\n";

foreach ($response->records as $record) {

    echo '<a href="'. $record->Event_URL__c .' ">' . $record->Campaign_Public_Name__c . "</a><br/> " 
    . $record->Event_City__c . ", " . $record->Event_State__c . " " . $record->Event_Zip_Code__c . " On ". $record->Event_Date__c . "<br/>\n";
}
/*
    $query = $_GET['zip']; 
    $min_length = 3;


  if $query >= $min_length)
  { 
  echo "<table border='0' width='300' align='center' cellpadding='1' cellspacing='1'>";
  echo "<tr><h3>You have searched for $query...Please find the details of $query...</h3></tr>";
  echo "<tr align='center' bgcolor='#03acfa' > <td height='35px' width='150px'><b>Mobile Name</b></td> <td><b>Mobile Type</b></td></tr>";     
        $result = 'SELECT Event_City__c, Event_Date__c, Event_State__c, Event_URL__c, Campaign_Public_Name__c, Event_Zip_Code__c FROM Campaign WHERE available_in_search__c = true ' ; 
        if $result > 0)
  {

                echo '<tr><td><a href="'. $record->Event_URL__c .' ">' . $record->Campaign_Public_Name__c . "</a></td></tr> " ;

            }
           
        }
        else{ 
            echo "<tr align='center' bgcolor='#fdee03'><td colspan='2' height='25px'>Sorry..No results for $query</td><tr>"; 
   echo "</table>";  
        }   
    }
    else{ 
        echo "Your search keyword contains letters only ".$min_length;
    }*/
?>
</body>
</html>