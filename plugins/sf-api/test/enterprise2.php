<?php

 $zip = $_POST["zip"];

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

$search = 'FIND {76107} IN PHONE FIELDS '.
        'RETURNING CONTACT(ID, PHONE, FIRSTNAME, LASTNAME), '.
        'LEAD(ID, PHONE, FIRSTNAME, LASTNAME), '.
        'ACCOUNT(ID, PHONE, NAME)';
  $response = $mySforceConnection->search($search);

  print_r($response);
} catch (Exception $e) {
  print_r($mySforceConnection->getLastRequest());
  echo $e->faultstring;
}
?>


$search = 'FIND {11793} IN event_zipcode__c FIELDS '.
        'RETURNING CAMPAIGN(campaign_public_name__c, event_state__c, event_city__c, event_zipcode__c)';
$response = $mySforceConnection->search($search);