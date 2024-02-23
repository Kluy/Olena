<?php

$to = 'info@massashka.ru'; // Change your email address


$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$message = $_POST['message'];


// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
 if ( isset($email) && isset($name) && isset($tel) && isset($subject) && isset($message) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {

  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val ) {
    if ( preg_match( $test, $val ) ) {
      exit;
    }
  }

$body = <<<EMAIL
Тема: $subject
  
Меня зовут, $name.

$message

Имя: $name
E-mail: $email
Тел.: $tel

EMAIL;
  
  
$header = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Reply-To: ' . $_POST["email"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  //
 // mb_send_mail( $to , $_POST['subject'], $_POST['message'], $headers );
 mb_send_mail($to, $subject, $body, $header);
  //      ^
  //  Replace with your email 
}
?>