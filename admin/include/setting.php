<?php
if($_SERVER['HTTP_HOST'] == 'localhost'){
	error_reporting(E_ALL);
	$baseurl = 'http://localhost/urbnfettch/';
	$_host = "localhost";
	$_username = "root";
	$_password = "";
	$_database = "urbnfettch";
}else{
	error_reporting(0);
	$baseurl = 'https://www.urbnfettch.com/';
	$_host = "localhost";
	$_username = "urbnfettch_ufusr";
	$_password = "Y%NSBDrRh7WdQi[n";
	$_database = "urbnfettch_uf";

}
// mailer-config.php
// Fill these in with the real mailbox credentials for this hosting account
// (e.g. cPanel-created mailbox, or the host's SMTP relay).

$smtpHost     = "mail.urbnfettch.com";   // e.g. mail.yourdomain.com or smtp.gmail.com
$smtpPort     = 465;                     // 587 (TLS) or 465 (SSL)
$smtpSecure   = "ssl";                   // "tls" or "ssl"
$smtpUsername = "admin@urbnfettch.com";
$smtpPassword = "Lwkmh4)Ph17qPn@T";

// From / Reply-To shown on the outgoing mail
$fromAddress = "info@urbnfettch.com";
$fromName    = "URBNFETTCH";

// Who receives the contact form notification
$toAddress = "rwpttech@gmail.com";
$toName    = "URBNFETTCH";

// Branding used in the email template
$companyWebsite = "https://www.urbnfettch.com";
$logoUrl        = $companyWebsite."/assets/images/urban/logo.png";
$companyName    = "URBNFETTCH";
$companyAddress = "Plot No. 126, Shankara Industrial Area, Bal Kalan, Amritsar, Punjab – 143001, India";
$companyPhone   = "+91 8753003200";
$companyEmail   = "info@urbnfettch.com";

?>




