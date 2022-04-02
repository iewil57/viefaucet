<?php
error_reporting(0);
const 
title = "viefaucet",
versi = "1.1",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

function short(){if(!file_exists('Data/Password')){pass:bn();$s    = json_decode(file_get_contents('https://pastebin.com/raw/EiKBhp8U'),1);$ran = rand(0,count($s)-1);$url  = $s[$ran]["url"];$sh  = $s[$ran]["short"];$ul   = file_get_contents($url);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];print h." Link     : ".k.$sh."\n";$pas = readline(h." Password : ".k);if($pas == $p){print h." --- Ok ".n;sleep(5);file_put_contents('Data/Link',$url);file_put_contents('Data/Password',$pas);print " Success save password";}else{print m." --- Error!";sleep(5);goto pass;}}else{$a   = file_get_contents('Data/Link');$ul   = file_get_contents($a);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];if(file_get_contents('Data/Password') == $p){}else{system('rm -r Data');}}}
function server(){$base    = file_get_contents("https://pastebin.com/raw/RZxwy6dr");$data     = explode('#',explode('#'.title.':',$base)[1])[0];$status  = explode('|',$data)[0];$versi    = explode('|',$data)[1];$link      = explode('|',$data)[2];if($status == "off" || $status == null){bn();echo m."Bot Sudah tidak aktif\n";echo k."------------ ".c."@iewil57 \n";exit;}if(!file_exists('Data/Versi')){system('mkdir Data');file_put_contents('Data/Versi',$versi);}if(versi == $versi){}else{bn();print m." Script update!".n;print h." Download : ".c.$link.n;die();}}
function Line(){$l = 50;return b.str_repeat('â”€',$l).n;}
function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}
function Save($namadata){if(file_exists($namadata)){$datauser=file_get_contents($namadata);}else{$datauser=readline(h."Input ".$namadata.p.' â‰½'.n);file_put_contents($namadata,$datauser);}return $datauser;}
function bn(){system('clear');print n.n.h." Author   : ".k."iewil".n.h." Script   : ".k.title." ".p.versi.n.h." Youtube  : ".k."youtube.com/c/iewil".n.line();}

//CLASS MODUL
function Run($u, $h = 0, $p = 0, $m = 0,$x = 0){//url,header,post,proxy
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $u);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
	if($p){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
	}
	if($h){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$r = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($hd,$bd);
	}
}
server();short();

system("https://youtu.be/v9ReNdXvS1A");
cookie:
bn();
$cookie  = Save('Cookie');
$user_agent = Save('User_Agent');
$auto = Save('Authorization');
$em = Save('Email_faucetpay');

bn();
$ua  = ["cookie: ".$cookie,"authorization: ".$auto,"user-agent: ".$user_agent];
function post($user_agent,$cookie,$auto,$data,$reff){
	return  [
	"Host: viefaucet.com",
	"content-length: ".strlen($data),
	"authorization: ".$auto,
	"user-agent: ".$user_agent,
	"content-type: application/json",
	"referer: ".$reff,
	"cookie: ".$cookie
	];
}
function conv($bal){
	$r = $bal/4520000000;
	return sprintf('%.8f',floatval($r));
}
$r = json_decode(Run('https://viefaucet.com/api/user/me',$ua)[1],1);
if(!$r["user"]["balance"]){
	unlink('Cookie');
	unlink('Authorization');
	goto cookie;
}
$bal = $r["user"]["balance"];
$user = $r["user"]["username"];
print h." Username : ".k.$user.n;
print h." Wallet   : ".k.$em.n;
print h." Balance  : ".k.$bal.m."/".k.conv($bal)." BTC ".n;
print line();

menu:
echo m."1 >".p." Faucet\n";
echo m."2 >".p." Withdraw\n";
$pil = readline(h."Input Number ".m."> ");
print line();
if($pil==1){goto faucet;
}elseif($pil==2){goto wd;
}else{echo m."Bad Number\n".n;print l();goto menu;}


faucet:
while(true){
	print "bypass..";
	$r = json_decode(Run('https://viefaucet.com/api/faucet',$ua)[1],1);
	if($r["wait"]){
		tmr($r["wait"]);
	}
	
	$r = json_decode(Run('https://viefaucet.com/api/captcha',$ua)[1],1);
	$id = $r["id"];
	
	$r = json_decode(Run('https://viefaucet.com/api/antibot',$ua)[1],1);
	$cap = $r["antibot"]["answer"];
	
	$data = '{"captcha":{"type":"rocket-captcha","token":"eyJwZXJjZW50WCI6MTAsInBlcmNlbnRZIjo1MH0=","id":"'.$id.'"},"antibot":"'.$cap.'"}';
	$r = json_decode(Run("https://viefaucet.com/api/faucet",post($user_agent,$cookie,$auto,$data,"https://viefaucet.com/app/faucet"),$data)[1],1);
	if($r["reward"]){
		print "\r          \r";
		print h." Success  : ".k.$r["reward"].n;
		$r = json_decode(Run('https://viefaucet.com/api/user/me',$ua)[1],1);
		$bal = $r["user"]["balance"];
		print h." Balance  : ".k.$bal.m."/".k.conv($bal)." BTC ".n;
		print line();
	}else{
		print "\r          \r";
		print m."bypass....";
		sleep(2);
		print "\r          \r";
	}
}

ptc:
print m."Susah bos ðŸ˜­".n;
print line();
goto menu;
$r = json_decode(Run('https://viefaucet.com/api/ptc',$ua)[1],1)["ads"];
foreach($r as $b){
	print c."visit ".$b["url"];
	balik:
	$r = json_decode(Run("https://viefaucet.com/api/ptc/".$b["_id"],$ua)[1],1);
	tmr($b["timer"]);
	$data = '{"token":"2b526951c5127908d32752463266d720","captcha":{"type":"rocket-captcha","token":"eyJwZXJjZW50WCI6ODksInBlcmNlbnRZIjo1Mn0=","id":"6246d94692bdf0ffd4f2359a"}}';
}


wd:
$am = explode('.',$bal)[0];

$r = json_decode(Run('https://viefaucet.com/api/withdraw',$ua)[1],1)["currencies"];

foreach($r as $a => $b){
	$a += 1;
	print m.$a." >".p." ".$b["name"].m."/".k."Web Balance: ".c.$b["balance"].n;
}
$coin = readline(h."Input Number ".m."> ");
print line();
$sel = $r[$coin-1]["_id"];

$data = '{"address":"'.$em.'","amount":'.$am.'}';
$wd = json_decode(Run('https://viefaucet.com/api/withdraw/'.$sel,post($user_agent,$cookie,$auto,$data,"https://viefaucet.com/app/withdraw"),$data)[1],1);
print h.$wd["msg"].n;
print line();
goto menu;

