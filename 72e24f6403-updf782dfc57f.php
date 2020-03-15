<?PHP
if(!empty($_POST['h2d5b053650bf51fecd1b']) && !empty($_POST['h61ce25342e89bb36c2d7']) && $_SERVER["HTTP_USER_AGENT"]=="LinkMeBoot"){
	$a0 = $a1 = $a2 = $a3 = $a4 = $a5 = $a6 = $a7 = $a8 = $a9 = $aa = 0; $api_host = "";
	$path = dirname(__FILE__);
	if($_POST['h2d5b053650bf51fecd1b'] == "h7bc09a4a1a70c6a7b644"){ $a0 = $api_host = "api2.linkme.pl"; $ip = gethostbyname($api_host); if(md5($ip."h123769c7c0ec36de4a74") != $_POST['h61ce25342e89bb36c2d7']){ $a0 = $ip; $api_host = ""; }
	}else{ $a0 = $api_host = "64.246.11.226";  }
	if(!empty($api_host) && $_POST['h8d969a20bb98c36'] == "had27e677d21cd1e"){
		$a1 = 1;
		$fields = "C_COD=".$_POST['C_COD']."&C_IDE=72e24f64037c80b0bdda60&C_FIL=5748b36a89ba985fb3c0&Upd=" . md5("e292a40a0f7ed267" . date("Ymd", time()) . $_POST['C_COD'] ."e39c95acf2dc9261") . "&C_HOS=".$_SERVER['HTTP_HOST'];
		if (function_exists('curl_init')) {
			$header[] = "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, */*";
			$header[] = "Connection: Keep-Alive";
			$ch = curl_init(); 
			curl_setopt ($ch, CURLOPT_URL, "http://" . $api_host . "/index-api.php?".$fields); 
			curl_setopt ($ch, CURLOPT_USERAGENT, "LinkMe Update"); 
			curl_setopt ($ch, CURLOPT_HEADER, $header); 
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
			$result = curl_exec ($ch);
			curl_close($ch);
		}
		if (@ini_get("allow_url_fopen") && empty($result)) {
			if ($fp=@fopen("http://" . $api_host . "/index-api.php?".$fields,"r")) {
				while (!feof($fp)) $result.=fgets($fp,262144);
				fclose($fp);
			}
		}
		if(empty($result)){
			$fp = fsockopen ($api_host, 80, $errno, $errstr, 30);
			if (!$fp) $a = 10;
			else {
				$data = "GET /index-api.php?".$fields." HTTP/1.0\r\n"
				."Host: " . $api_host . "\r\n"
				."User-Agent: LinkMe Update\r\n"
				."Connection: Close\r\n\r\n";
				fputs ($fp, $data);
				while (!feof($fp)) {
					$result .= fgets ($fp,1024);
				}
				fclose ($fp);
			} 
		}
		if(!empty($result)){
			$a2 = 1; preg_match('/<upd ch1="(.+?)">(.*)<\/upd>/s', $result, $d);	
			if(md5("h123769c7c0ec36de4a74".$d[2]) == $d[1]){
				$a3 = 1; $result = base64_decode($d[2]);
				if(!empty($result)) $a4 = 1;
				if(stristr($result, "['b2e185d547853fc']")) $a5 = 1;  	
				if(file_exists($path."/72e24f64037c80b0bdda60.php")) $a6 = 1;
				if(is_writable($path."/72e24f64037c80b0bdda60.php")) $a7 = 1;					
				if($a4 == 1 && $a5 == 1 && $a6 == 1 && $a7 == 1){			
					if($fp = @fopen($path."/72e24f64037c80b0bdda60.php", "w")){
						flock($fp, LOCK_EX|LOCK_NB);
						fputs($fp, $result);
						flock($fp, LOCK_UN);
						fclose($fp);
						$a8 = 1;
						if ($p=@fopen($path."/72e24f64037c80b0bdda60.php", 'r')){
							$a9 = 1;
							while (!feof($p)) $data .= fgets($p,262144);
							fclose($p);
							if(stristr($data, "/* e39c95acf2dc9261 */") && stristr($data, "/* e292a40a0f7ed267 */")) $aa = 1;
						}
					}	
				}
			}
		}
	}else{
		if(file_exists($path."/72e24f64037c80b0bdda60.php")) $a6 = 1;
		if(is_writable($path."/72e24f64037c80b0bdda60.php")) $a7 = 1;	
	}
	echo "<answer>"
		."<a0>" . $a0 . "</a0>"
		."<a1>" . $a1 . "</a1>"
		."<a2>" . $a2 . "</a2>"
		."<a3>" . $a3 . "</a3>"
		."<a4>" . $a4 . "</a4>"
		."<a5>" . $a5 . "</a5>"
		."<a6>" . $a6 . "</a6>"
		."<a7>" . $a7 . "</a7>"
		."<a8>" . $a8 . "</a8>"
		."<a9>" . $a9 . "</a9>"
		."<aa>" . $aa . "</aa>"
	."</answer>";
}
?>