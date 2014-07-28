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


// Pulls Custom Fields 
$query = 'SELECT Event_City__c, Event_Date__c, Event_State__c, Event_URL__c, Campaign_Public_Name__c, Event_Zip_Code__c FROM Campaign WHERE available_in_search__c = true ';
$response = $mySforceConnection->query($query);

echo "<strong>Results of Campaigns </strong><br/><br/>\n";

foreach ($response->records as $record) {

    echo '<a href="'. $record->Event_URL__c .' ">' . $record->Campaign_Public_Name__c . "</a><br/> " 
    . $record->Event_City__c . ", " . $record->Event_State__c . " " . $record->Event_Zip_Code__c . " On ". $record->Event_Date__c . "<br/>\n";
}

// Pulls Participant Fields 
$query = "SELECT Participant_First_Name__c, Participant_Last_Name__c, Participant_Page_URL__c FROM NBTS_Registrations__c  WHERE Event_Name__c = 'Nashville Brain Tumor Race' ";
$response = $mySforceConnection->query($query);

echo "<strong>Results of participant </strong><br/><br/>\n";

foreach ($response->records as $record) {

    echo '<span style="background-image: -moz-linear-gradient(center top , #ffffff, #e0e0e0); border: 1px solid #d8d8d8; border-radius: 5px;"><a href="'. $record->Participant_Page_URL__c .' ">' . $record->Participant_Last_Name__c . " ". $record->Participant_Last_Name__c . "</a></span><br/>\n";
}

?>

</body>
</html>