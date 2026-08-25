<?php
/**
 * career-submit.php
 * Handles AJAX submission from career.php's #urbnCareerForm.
 * Validates input server-side (never trust client-side validation alone),
 * stores the resume upload, saves the application with the current Indian
 * Standard Time, and emails a formatted notification via PHPMailer/SMTP.
 */

header('Content-Type: application/json');

// ---- PHPMailer (manual include - no Composer required on shared hosting) ----
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// ---- DB connection --------------------------------------------------
// Adjust this to match your actual connection file / variable name.
// Assumed: admin/include/db.php defines a mysqli connection in $conn
require_once 'admin/include/db.php';

// ---- Response helper --------------------------------------------------
function respond($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond('error', 'Invalid request method.');
}

// ---- Set Indian Standard Time ------------------------------------------
date_default_timezone_set('Asia/Kolkata');
$created_at = date('Y-m-d H:i:s'); // current IST time

// ---- Collect + sanitize input --------------------------------------------
$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$position = trim($_POST['position'] ?? '');
$message  = trim($_POST['message'] ?? '');

// Strip anything that could be used for header injection, just in case
$name     = preg_replace('/[\r\n]+/', ' ', $name);
$position = preg_replace('/[\r\n]+/', ' ', $position);

// ---- Server-side validation --------------------------------------------
$errors = [];

if ($name === '' || mb_strlen($name) < 2) {
    $errors[] = 'Please enter a valid name.';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

if ($phone === '' || !preg_match('/^[0-9]{9,12}$/', $phone)) {
    $errors[] = 'Please enter a valid phone number (9-12 digits).';
}

if ($position === '' || mb_strlen($position) < 2) {
    $errors[] = 'Please enter the position you are applying for.';
}

if ($message === '' || mb_strlen($message) < 10) {
    $errors[] = 'Please enter a message (min 10 characters).';
}

// ---- Resume upload validation --------------------------------------------
$resumePath     = null;
$resumeAbsPath  = null;
$resumeOrigName = null;

if (!isset($_FILES['resume']) || $_FILES['resume']['error'] === UPLOAD_ERR_NO_FILE) {
    $errors[] = 'Please attach your resume.';
} elseif ($_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
    $errors[] = 'There was a problem uploading your resume. Please try again.';
} else {
    $resumeOrigName = $_FILES['resume']['name'];
    $ext = strtolower(pathinfo($resumeOrigName, PATHINFO_EXTENSION));
    $allowedExt = ['pdf', 'doc', 'docx'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!in_array($ext, $allowedExt, true)) {
        $errors[] = 'Resume must be a PDF or Word document.';
    } elseif ($_FILES['resume']['size'] > $maxSize) {
        $errors[] = 'Resume must be under 5MB.';
    }
}

if (!empty($errors)) {
    respond('error', implode(' ', $errors));
}

// ---- Move uploaded resume into place --------------------------------------
$uploadDir = __DIR__ . '/uploads/resumes/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$ext        = strtolower(pathinfo($resumeOrigName, PATHINFO_EXTENSION));
$storedName = bin2hex(random_bytes(16)) . '.' . $ext;
$resumeAbsPath = $uploadDir . $storedName;
$resumePath    = $storedName; // filename only, stored in DB

if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resumeAbsPath)) {
    respond('error', 'Unable to save your resume. Please try again.');
}

// ---- Insert into DB (prepared statement, mysqli) -------------------------
$sql = "INSERT INTO career_applications (name, email, phone, position, message, resume_path, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
   // respond('error', 'Unable to process your request right now. Please try again later.');
}

$stmt->bind_param('sssssss', $name, $email, $phone, $position, $message, $resumePath, $created_at);

if ($stmt->execute()) {
    $stmt->close();

    // ---- Send notification email via PHPMailer/SMTP -----------------------
    // If email sending fails, the application is still saved in the DB above -
    // we log the mail error but don't fail the user-facing response for it.
    $adminMail = new PHPMailer(true);

    try {
        $adminMail->isSMTP();
        $adminMail->Host       = $smtpHost;
        $adminMail->SMTPAuth   = true;
        $adminMail->Username   = $smtpUsername;
        $adminMail->Password   = $smtpPassword;
        $adminMail->SMTPSecure = $smtpSecure;
        $adminMail->Port       = $smtpPort;

        $adminMail->setFrom($fromAddress, $fromName);
        $adminMail->addAddress($toAddress);
       

        if (file_exists($resumeAbsPath)) {
            $adminMail->addAttachment($resumeAbsPath, $resumeOrigName);
        }

        $adminMail->isHTML(true);
        $adminMail->Subject = "New Career Application: $position - $name";

        // ---- HTML email body (inline, no separate template file) ----
        $nameHtml     = htmlspecialchars($name);
        $emailHtml    = htmlspecialchars($email);
        $phoneHtml    = htmlspecialchars($phone);
        $positionHtml = htmlspecialchars($position);
        $messageHtml  = nl2br(htmlspecialchars($message));
        $companyNameHtml = htmlspecialchars($companyName);
        $companyAddrHtml = htmlspecialchars($companyAddress);
        $companyTelHtml  = htmlspecialchars($companyPhone);
        $companyMailHtml = htmlspecialchars($companyEmail);
        $companyWebHtml  = htmlspecialchars($companyWebsite);

        $adminBody = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Career Application</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px 0;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background-color:#ffffff; border-radius:8px; overflow:hidden;">

          <!-- Logo -->
          <tr>
            <td align="center" style="padding:28px 20px; background-color:#0b6e4f;">
              <img src="{$logoUrl}" alt="{$companyNameHtml}" width="160" style="display:block; max-width:160px; height:auto;">
            </td>
          </tr>

          <!-- Title -->
          <tr>
            <td style="padding:26px 32px 6px 32px;">
              <h1 style="margin:0; font-size:20px; color:#111827;">New Career Application</h1>
              <p style="margin:6px 0 0 0; font-size:13px; color:#6b7280;">Submitted on {$created_at} (IST)</p>
            </td>
          </tr>

          <!-- Details -->
          <tr>
            <td style="padding:16px 32px 8px 32px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:13px; color:#6b7280; width:110px;">Name</td>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827;">{$nameHtml}</td>
                </tr>
                <tr>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:13px; color:#6b7280;">Email</td>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:14px;">
                    <a href="mailto:{$emailHtml}" style="color:#0b6e4f; text-decoration:none;">{$emailHtml}</a>
                  </td>
                </tr>
                <tr>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:13px; color:#6b7280;">Phone</td>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827;">
                    <a href="tel:{$phoneHtml}" style="color:#111827; text-decoration:none;">{$phoneHtml}</a>
                  </td>
                </tr>
                <tr>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:13px; color:#6b7280;">Position</td>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827;">{$positionHtml}</td>
                </tr>
                <tr>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:13px; color:#6b7280;">Resume</td>
                  <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827;">Attached to this email</td>
                </tr>
                <tr>
                  <td style="padding:10px 0; font-size:13px; color:#6b7280;">Message</td>
                  <td style="padding:10px 0; font-size:14px; color:#111827; line-height:1.6;">{$messageHtml}</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background-color:#111827; padding:24px 32px; font-size:13px; color:#d1d5db; line-height:1.7;">
              <strong style="color:#ffffff;">{$companyNameHtml}</strong><br>
              {$companyAddrHtml}<br>
              Phone: <a href="tel:{$companyTelHtml}" style="color:#d1d5db; text-decoration:none;">{$companyTelHtml}</a><br>
              Email: <a href="mailto:{$companyMailHtml}" style="color:#d1d5db; text-decoration:none;">{$companyMailHtml}</a><br>
              <a href="{$companyWebHtml}" style="color:#9ca3af; text-decoration:none;">{$companyWebHtml}</a>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

        $adminMail->Body    = $adminBody;
        $adminMail->AltBody = "You have received a new career application.\n\n"
            . "Name: $name\nEmail: $email\nPhone: $phone\nPosition: $position\n\n$message\n\nSubmitted At: $created_at (IST)\n(Resume attached)";

        $adminMailSent = $adminMail->send();
    } catch (Exception $e) {
        $adminMailSent = false;
        error_log('Career form mail failed: ' . $adminMail->ErrorInfo);
    }

    respond('success', 'Thank you! Your application has been submitted successfully.');
} else {
    $stmt->close();
    respond('error', 'Something went wrong while saving your application. Please try again.');
}