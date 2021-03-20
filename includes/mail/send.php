<?php 
// It return proper info in JSON format
//DEBUG ONLY, remove it after
//ini_set('display,errors',1);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');

//IF THE FORM IS NOT FILLED OUT


$results = [];
$visitor_name = '';
$visitor_email = '';
$visitor_message = '';

// $my_email = array('male' => 'noreply@seishunri.ca', 'female' => 'linhkhanh1127@gmail.com');


//die function is an alias of the exit function
if(empty($_POST['name']))
{
    die(json_encode(['message' => 'I am sorry but the email did not go through. Please try it again!']));
} else {
    if (isset($_POST['name'])) {
        //filter_var - Filters a variable with a specified filter
        
        $visitor_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }
}

if(empty($_POST["email"])) {
    // header('HTTP/1.1 488 You did not include your email');
    die(json_encode(['message' => 'I am sorry but the email did not go through. Please try it again!']));

} else {
    if (isset($_POST['email'])) {
        // if there's a line break in an email (it's very long), strip it out
       $email = str_replace(array("\r", "\n", "%0a", "%0d"),'',$_POST['email']);
        $visitor_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    }
}

if (isset($_POST['message'])) {
    $visitor_message =  filter_var(htmlspecialchars($_POST['message']), FILTER_SANITIZE_STRING);
}


$results['name'] = $visitor_name;
$results['message'] = $visitor_message;

$email_subject = '';
$email_recipient = 'linhkhanh1127@gmail.com';


//sprinf - Return a formatted string
$email_message = sprintf('Name: %s, Email: %s, Message: %s', $visitor_name, $visitor_email, $visitor_message);
// $email_message .="Option Selected:".clean_string($_POST['gender']);

$email_headers = array(
    'From' => 'linhkhanh1127@gmail.com',
    'Reply-To' => $visitor_name.'<'.$vistor_email.'>',
    
    // 'From'=>$visitor_email
);

//Send out the email
//mail() is a PHP function that sends out email
$email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);
if ($email_result) {
    $results['message'] = sprintf('Thank you for contacting us, %s. You will get a reply within 24 hours.', $visitor_name);
    
}else {
    $results['message'] = sprintf('I am sorry but the email did not go through. Please try it again!');
    
}


echo json_encode($results);
