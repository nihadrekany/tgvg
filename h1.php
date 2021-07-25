<?php
session_start();
$ch = curl_init('https://hackerone.com/uber/profile_metrics.json');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);                                                                                                                                                                                                                              
$result = curl_exec($ch);
curl_close($ch);
$result=json_decode($result,true);
$new_bounty=$result['total_bounties_paid'];

if(isset($_SESSION['old_bounty']) AND $_SESSION['old_bounty']!=0)
{
	$old_bounty=$_SESSION['old_bounty'];	
}
else
{
	$old_bounty=0;
}


if($new_bounty!=$old_bounty)
{
	$myfile = fopen("h1.txt", "a");
	$txt = $new_bounty;
	fwrite($myfile, $txt."\r\n");
	fclose($myfile);
	$_SESSION['old_bounty']=$new_bounty;
	echo "New record Found !!";
}
else
{
	echo "No , new record Found !!";
}

?>
<body onload="setInterval('window.location.reload()', 10000);">
