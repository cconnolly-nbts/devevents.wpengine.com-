<?php
include ('../../plugins/sf-api/soapclient/config.php');
// Pulls Participant Fields 

try {
  $mySforceConnection = new SforceEnterpriseClient();
  $mySoapClient = $mySforceConnection->createConnection('../../plugins/sf-api/soapclient/enterprise.wsdl.xml');
  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

$query = "SELECT Participant_First_Name__c, Participant_Last_Name__c, Participant_Page_URL__c, Participant_Goal__c, Event_Name__c
          FROM NBTS_Registrations__c  
          WHERE Participant_First_Name__c = 'Charlie' AND Participant_Last_Name__c = 'Connolly' ";

$response = $mySforceConnection->query($query);

foreach ($response->records as $record) {
    
    echo '<p><a href="'. $record->Participant_Page_URL__c .' "><strong>' . $record->Participant_First_Name__c . " ". $record->Participant_Last_Name__c . "</strong></a> </p> 
    <p>Event: " . $record->Event_Name__c ."</p>
    <p>Fundraising goal: $" . $record->Participant_Goal__c ."</p>\n";
}    
?>

<?php echo do_shortcode('[gmw form="results"]'); ?>
