<?php

if($_POST['user_name']!="" && $_POST['user_phone']!="" && $_POST['comment']!="")
{
		$name = $_POST['user_name'];
		$phone = $_POST['user_phone'];
		$comment = $_POST['comment'];
}
else{
	header('Location:form.html');
	exit;
}

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$token = "......."; //input your token
$chat_id = "....."; //input your id

$arr = array(
   'User Name: '=> $name,
   'Ip: ' => getIp(),
   'Telephone: '=> $phone,
   'Comment: '=> $comment,
);

foreach ($arr as $key => $value) {
	$txt .= "<i>".$key."</i> ".$value."%0A";
}

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

if($sendToTelegram)
{
   echo '<h1 class="success">Thanks for comments</h1>';
   return true;

}else{
   echo '<h1> Do not send the comments . Try after some minute!</h1>';
}

?>
