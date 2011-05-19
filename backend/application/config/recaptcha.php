<?
/*
The reCaptcha server keys and API locations

Obtain your own keys from:
http://www.recaptcha.net
*/
$config['recaptcha'] = array(
  'public'=>'',//your keys here
  'private'=>'',
  'RECAPTCHA_API_SERVER' =>'http://api.recaptcha.net',
  'RECAPTCHA_API_SECURE_SERVER'=>'https://api-secure.recaptcha.net',
  'RECAPTCHA_VERIFY_SERVER' =>'api-verify.recaptcha.net',
  'theme' => 'white'
);
