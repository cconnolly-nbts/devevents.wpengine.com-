<?php
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$team_name = $_POST["team_name"];

// SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
// $USERNAME - variable that contains your Salesforce.com username (must be in the form of an email)
// $PASSWORD - variable that contains your Salesforce.com password

define("SOAP_CLIENT_BASEDIR", "search/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');
require_once ('search/samples/userAuth.php');

ini_set('soap.wsdl_cache_enabled', '0'); 
ini_set('soap.wsdl_cache_ttl', '0'); 


    try {
      $mySforceConnection = new SforceEnterpriseClient();
      $mySoapClient = $mySforceConnection->createConnection('/var/www/vhosts/events.braintumor.org/dev-events.braintumor.org/wp-content/themes/blankslate/search/soapclient/enterprise.wsdl.xml');
      $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);


 // Pulls Team Fields 
/*    $query = "SELECT Search_Team_Name__c
              FROM NBTS_Registrations__c  
              WHERE Available_in_Search__c = true 
              ORDER BY Search_Team_Name__c ";*/

    $query = "SELECT Participant_First_Name__c, Participant_Last_Name__c, Participant_Page_URL__c, Participant_Goal__c, Search_Team_Name__c,Event_Name__c
              FROM NBTS_Registrations__c  
              WHERE Available_in_Search__c = true AND Search_Team_Name__c != NULL

              ORDER BY Search_Team_Name__c ";

    $response = $mySforceConnection->query($query);


      foreach ($response->records as $record) {
        echo '<div class="result">';
        echo '<div class="spacer pure-g- ">';
        echo '<div class="pure-u-2-3">';
        //echo '<h3><p><a href="'. $record->Participant_Page_URL__c .' ">' . $record->Participant_First_Name__c . " ". $record->Participant_Last_Name__c . "</a></h3> </p>";
        echo "<p><strong>Event: " . $record->Event_Name__c ."</strong></p>";

         if ($record->Search_Team_Name__c != null) {
          echo '<p style="color:#ff0000;">Team: ' . $record->Search_Team_Name__c .'</p>';
          }
         //if ($record->Participant_Goal__c != null) {
          //echo '<p>Fundraising goal: $' . $record->Participant_Goal__c .'</p>';
          //} 
          //else {
              //echo '<p>Fundraising goal: $0.00</p>';
          //}
        echo '</div>';
        echo '<div class="pure-u-1-3">';
        //echo '<p class="donateLink"><a href="https://secure2.convio.net/bts/site/Donation2?df_id=4081&amp;FR_ID=2210&amp;PROXY_ID=3399798&amp;PROXY_TYPE=20" class="pure-button search-donate-button">Donate to me</a></p>';
        echo '</div>';
        echo '</div>';
        echo "</div>\n";
        }

        if ($record->Search_Team_Name__c == null){
          echo '<div class="spacer"><p>There were no results for your search. Please <a href="/tr-search-results/">try your search again</a>.</p></div>';
        }

    //  print_r($response);
    } catch (Exception $e) {
      print_r($mySforceConnection->getLastRequest());
      echo $e->faultstring;
    }

  ?>