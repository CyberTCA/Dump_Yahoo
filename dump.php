<?php
$banner = "\e[36;1m
[#] Facebook Email Dump [#]    
                                   
Coded by : Mr.Tcg Cyber             
Team     : Program Jalanan                   
Github   : https://github.com/CyberTCA\n\n\e[0;1m";
sleep(3);
echo $banner;
sleep(2);
echo "Masukan Token : ";
$toket = trim(fgets(STDIN));


sleep(2);
echo "menghitung jumlah teman\n";
$asu = curl_init();
curl_setopt($asu, CURLOPT_URL, "https://graph.facebook.com/v3.2/me/friends/?fields=name,email&access_token=".$toket."&limit=100");
curl_setopt($asu, CURLOPT_RETURNTRANSFER, 1);
$mek = curl_exec($asu);
curl_close($asu);

$y = json_decode($mek);
$total = $y->summary->total_count;if (empty($total)) {
	echo "Token Salah atau Tidak Valid\n";
	}else{
		$res = "result_email.txt";
		touch($res);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v3.2/me/friends/?fields=name,email&access_token=".$toket."&limit=".$total);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$gas = curl_exec($ch);
curl_close($ch);

$su = json_decode($gas);

sleep(2);
system("clear");
foreach($y->data as $id) {
	echo $id->id;
	system("clear");
	usleep(40000);
	}
echo "total teman => ".$total."\n";
sleep(2);
echo "mencari email\n";
sleep(3);
echo "cek hasil di ".$res."\n\n";
sleep(1);
foreach($su->data as $hasil) {
	preg_match("/(.+)(@yahoo.com)/", $hasil->email, $kntl);
	
	if(!empty($kntl[2])) {
	echo $hasil->name." => ".$kntl[0]."\n";
	usleep(200000);
	$o = fopen($res, 'a');
	fwrite($o, $hasil->name." => ".$kntl[0]."\n");
	fclose($o);
	}
	}
}
?>
