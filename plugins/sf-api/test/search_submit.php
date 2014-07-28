<?php
  if(isset($_POST['submit'])){
  if(isset($_GET['go'])){
  if(preg_match("/[A-Z  | a-z]+/", $_POST['zip'])){
  $zip=$_POST['zip'];
  //connect  to the SalesForce
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
} catch (Exception $e) {
	print_r($e);
}
	 $query = 'SELECT Event_City__c, Event_Date__c, Event_State__c, Event_URL__c, Campaign_Public_Name__c, Event_Zip_Code__c FROM Campaign WHERE available_in_search__c = true LIKE '%" . $name .  "%' OR LastName LIKE '%" . $name ."%'"';
	 $response = $mySforceConnection->query($query);

	 //-create  while loop and loop through result set
	  while($response > 0){
	          $city  =$row['Event_City__c'];
	          $zip=$row['Event_Zip_Code__c'];
	          $even_name=$row['Campaign_Public_Name__c'];

	  //-display the result of the array
	  echo "<ul>\n";
	  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$city . " " . $zip .  "</a></li>\n";
	  echo "</ul>";
	  }
	 }
  else{
  echo  "<p>Please enter a search query</p>";
  }
  }
  }
?>



<?php
  $zip = $_POST["zip"];

  //Connect to SalesForce
  define("SOAP_CLIENT_BASEDIR", "../soapclient");
  require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php'); 
  require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');
  require_once ('../samples/userAuth.php');

try {
	  $mySforceConnection = new SforceEnterpriseClient();
	  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
	  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
} catch (Exception $e) {
	print_r($e);
}
	
	 $search = 'FIND {$zip} IN PHONE FIELDS '.
	        'RETURNING CONTACT(ID, PHONE, FIRSTNAME, LASTNAME), '.
	        'LEAD(ID, PHONE, FIRSTNAME, LASTNAME), '.
	        'ACCOUNT(ID, PHONE, NAME)';
	  $searchResult = $mySforceConnection->search($search);


	if ($searchResult > 0){
		echo $searchResult;
	}
	else {
	    echo "Please first enter your name on the input form.";
	};
?>

