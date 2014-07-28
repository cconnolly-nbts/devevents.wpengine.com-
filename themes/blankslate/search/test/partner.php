<pre>
<?php
// SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
// $USERNAME - variable that contains your Salesforce.com username (must be in the form of an email)
// $PASSWORD - variable that contains your Salesforce.ocm password


define("SOAP_CLIENT_BASEDIR", "../soapclient");
$USERNAME='cconnolly@braintumor.org';
$PASSWORD='Acting!@12EoQFU6QK5FecAT05krOd8qolh';
require_once (SOAP_CLIENT_BASEDIR.'/SforcePartnerClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');



$query="Select o.OrganizationType, o.Id From Organization o where id = '00D300000007gjdEAA'";


try {
	$mySforceConnection = new SforcePartnerClient();
	$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/partner.wsdl.xml');
	$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
//print_r($mySforceConnection->getUserInfo());
	//print_r($mylogin->userInfo);
  //echo "***** Get Server Timestamp *****\n";
  //$response = $mySforceConnection->getServerTimestamp();
//	print_r($response);
 //print_r($mySforceConnection->describeSObject('User'));  
  //$result = $mySforceConnection->query($query);
  //print_r($result);
} catch (Exception $e) {
	print_r($e);
}

// Pulls Event Related Fields 
$query = 'SELECT Event_City__c, Event_Date__c, Event_State__c, Event_URL__c, Campaign_Public_Name__c, Event_Zip_Code__c FROM Campaign WHERE available_in_search__c = true ';
$response = $mySforceConnection->query($query);

echo "<strong>Results of Campaigns </strong><br/><br/>\n";

foreach ($response->records as $record) {

    echo '<a href="'. $record->Event_URL__c .' ">' . $record->Campaign_Public_Name__c . "</a><br/> " 
    . $record->Event_City__c . ", " . $record->Event_State__c . " " . $record->Event_Zip_Code__c . " On ". $record->Event_Date__c . "<br/>\n";
}

// Pulls Participant Fields 


?>
</pre>