<?php
// Basic notification caller that uses send via email-to-sms (PHPMailer) or email only.
// Requires includes/config.php, and PHPMailer src placed in includes/PHPMailer/src/
require_once __DIR__ . '/config.php';
function load_techs(){ $f=__DIR__.'/../data/users.json'; return file_exists($f)?json_decode(file_get_contents($f),true):[]; }
function send_email_simple($to_emails, $subject, $body){
    // fallback: PHP mail() (may be blocked on some hosts). Recommend PHPMailer, but keep fallback.
    foreach($to_emails as $e) @mail($e,$subject,$body,"From: ".ALERT_FROM_EMAIL);
    return true;
}
// Wrapper: gathers tech emails and sends
function notify_all($subject,$message){
    $techs = load_techs();
    $emails=[]; $phones=[];
    foreach($techs as $t){ if(!empty($t['email'])) $emails[]=$t['email']; if(!empty($t['phone'])) $phones[]=['phone'=>$t['phone'],'carrier'=>$t['carrier']??'']; }
    // Send emails
    if(!empty($emails)) send_email_simple($emails,$subject,$message);
    // Send email-to-sms if enabled and carriers set
    if(defined('USE_EMAIL_TO_SMS') && USE_EMAIL_TO_SMS){
        $gateway_map = ['vtext.com'=>'vtext.com','txt.att.net'=>'txt.att.net','tmomail.net'=>'tmomail.net','messaging.sprintpcs.com'=>'messaging.sprintpcs.com'];
        $sms_addresses = [];
        foreach($phones as $p){ $clean = preg_replace('/[^0-9]/','',$p['phone']); $c = $p['carrier']; if($c && isset($gateway_map[$c])) $sms_addresses[] = $clean.'@'.$c; }
        if(!empty($sms_addresses)) send_email_simple($sms_addresses,$subject,$message);
    }
    return true;
}
?>