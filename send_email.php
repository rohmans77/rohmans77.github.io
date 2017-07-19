<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "rohmans77@gmail.com";
    $email_subject = "";
 
    function died($error) {
        // your error code can go here
        echo "Maaf, ada kesalahan pada formulir yang anda kirim.";
        echo "kesalahan itu adalah.<br /><br />";
        echo $error."<br /><br />";
        echo "Silahkan kembali dan perbaiki.<br /><br />";
		echo "Terimakasih.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Maaf, ada kesalahan pada formulir yang anda kirim.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Alamat email tidak valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Nama tidak valid.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'Judul tidak valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Isi pesan tidak valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nama: ".clean_string($first_name)."\n";
    $email_message .= "Judul: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telpon: ".clean_string($telephone)."\n";
    $email_message .= "Pesan: ".clean_string($comments)."\n";
 
// create email headers
$email_subject = $last_name;
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Terimakasih sudah menghubungi kami.
 
<?php
 
}
?>