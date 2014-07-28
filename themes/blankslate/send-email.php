<?
$event = $_POST['event'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$event_email = $_POST['event_email'];

if($event == "" || $name == "" || $email == "" || $message == ""){
	$response['error'] = true;
	$response['msg'] = "Please enter all fields";
	echo json_encode($response);
	return false;
}elseif ($event_email == "") {
	$response['error'] = true;
	$response['msg'] = "Something went wrong, please refresh the page.";
	echo json_encode($response);
	return false;
}
 
$to = $event_email;
$subject = 'New Contact Us form submission';
$message = 'FROM: '.$name.' <br />EMAIL: '.$email.' <br />EVENT: '.$event.' <br />MESSAGE: '.$message;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '. $email . "\r\n";
 
if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	$response['error'] = false;
	$response['msg'] = "Thank you, your message has been sent! <a href='/'>Click to return the events homepage.</a>";
	echo json_encode($response);
	return false;
}else{
	$response['error'] = true;
	$response['msg'] = "Invalid Email, please provide an correct email.";
	echo json_encode($response);
	return false;
}
?>