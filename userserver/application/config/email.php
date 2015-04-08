<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['mailtype'] = 'html';
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';   //examples: ssl://smtp.googlemail.com, myhost.com
$config['smtp_user'] = 'hopelab@gmail.com';
$config['smtp_pass'] = 'Qingfeng1';
$config['smtp_port'] = '465';
$config['charset']='utf-8';  // Default should be utf-8 (this should be a text field)
$config['newline']="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n"
$config['crlf'] = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n"


/* End of file email.php */
/* Location: ./application/config/email.php */