<?php
// Copy to includes/config.php and fill values. KEEP SECRET.
define('SESSION_NAME', 'hvac_session');
// SMTP for emails (used for email-to-sms via PHPMailer)
define('SMTP_HOST','smtp.gmail.com');
define('SMTP_PORT',587);
define('SMTP_USERNAME','your@gmail.com');
define('SMTP_PASSWORD','your-app-password');
define('ALERT_FROM_EMAIL','alerts@yourdomain.com');
define('ALERT_FROM_NAME','Universal HVAC OS');
// Toggle SMS/email methods
define('USE_EMAIL_TO_SMS', true);
define('USE_TWILIO', false);
// Simple admin password for initial setup (optional)
define('INITIAL_ADMIN_PASSWORD','change_me');
?>