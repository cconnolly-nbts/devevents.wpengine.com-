<?php

 $first_name = $_POST["first_name"];
 $last_name = $_POST["last_name"];

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

// Pulls Participant Fields 
$query = "SELECT Participant_First_Name__c, Participant_Last_Name__c, Participant_Page_URL__c, Participant_Goal__c, Event_Name__c
          FROM NBTS_Registrations__c  
          WHERE Participant_First_Name__c = '$first_name' OR Participant_Last_Name__c = '$last_name' ";


$response = $mySforceConnection->query($query);

echo '<div id="main_container" class="tr-page-main-content">';
  echo '  <div title="edit_fr_html_container" id="team_list_custom_html" class="custom-wysiwyg-html manageable-editor">';
  echo '    <div id="fr_html_container" class="custom-wysiwyg-text mobile-view-description">';



foreach ($response->records as $record) {

    echo '<p><a href="'. $record->Participant_Page_URL__c .' "><strong>' . $record->Participant_First_Name__c . " ". $record->Participant_Last_Name__c . "</strong></a> </p> 
    <p>Event: " . $record->Event_Name__c ."</p>
    <p>Fundraising goal: $" . $record->Participant_Goal__c ."</p>\n";
    }


  echo '    </div>';
  echo '  </div>';
  echo '</div>';

//  print_r($response);
} catch (Exception $e) {
  print_r($mySforceConnection->getLastRequest());
  echo $e->faultstring;
}
?>