<?PHP
/* e39c95acf2dc9261 */
define('C_IDE', '72e24f64037c80b0bdda60');
define('C_FIL', '5748b36a89ba985fb3c0');
if(!empty($_POST['b2e185d547853fc']) && $_SERVER["HTTP_USER_AGENT"]=="LinkMeBoot"){
	switch($_POST['b2e185d547853fc']) {	
		case 'InstallTest':
			$path = @LinkMePath();
			if(file_exists($path.C_FIL.".txt")){
				if(is_readable($path.C_FIL.".txt")) {
					if(is_writable($path.C_FIL.".txt")){
						if(file_exists($path.C_FIL."-subpages.txt")){
							if(is_readable($path.C_FIL."-subpages.txt")) {
								if(is_writable($path.C_FIL."-subpages.txt")) echo "<answer>1</answer>";
								else echo "<answer>14</answer>";
							}else echo "<answer>13</answer>";
						}else echo "<answer>1</answer>";
					}else echo "<answer>4</answer>";
				}else echo "<answer>3</answer>";
			}else echo "<answer>2</answer>";
			exit;
		break;
		case 'ClearData2':	
			$gdata = LinkMeGetData("C_COD2=".$_POST[C_COD]."&C_IDE=".C_IDE."&C_FIL=".C_FIL."&IT=2&C_HOS=".$_SERVER['HTTP_HOST']);
			if($gdata=="") echo "<answer>4</answer>";
			else if(strstr($gdata, "<answer>1</answer>")){
				$path = @LinkMePath();
				if(LinkMeSaveData($path."5748b36a89ba985fb3c0-subpages", "", 1)) echo "<answer>1</answer>";
				else echo "<answer>3</answer>";
			}else echo "<answer>2</answer>";
			exit;
		break;
		case 'GetData':
			$gdata = LinkMeGetData("C_COD=".$_POST[C_COD]."&C_IDE=".C_IDE."&C_FIL=".C_FIL."&IT=2&C_HOS=".$_SERVER['HTTP_HOST']);
			if($gdata=="") echo "<answer>4</answer>";
			else if(!strstr($gdata, "<answer>2</answer>") && strstr($gdata, "</links>")){
				$path = @LinkMePath();
				if(LinkMeSaveData($path."5748b36a89ba985fb3c0", $gdata, 1)) echo "<answer>1</answer>";
				else echo "<answer>3</answer>";
			}else echo "<answer>2</answer>";
			exit;
		break;
		case 'GetDataContent':
			$gdata = LinkMeGetData("C_COD=".$_POST[C_COD]."&C_IDE=".C_IDE."&C_FIL=".C_FIL."&IT=3&C_HOS=".$_SERVER['HTTP_HOST']);
			if($gdata=="") echo "<answer>4</answer>";
			else if(!strstr($gdata, "<answer>2</answer>") && strstr($gdata, "</links>")){
				$path = @LinkMePath();
				if(LinkMeSaveData($path."5748b36a89ba985fb3c0-content", $gdata, 1)) echo "<answer>1</answer>";
				else echo "<answer>3</answer>";
			}else echo "<answer>2</answer>";
			exit;
		break;	
		case 'ClearDataContent':	
			$gdata = LinkMeGetData("C_COD2=".$_POST[C_COD]."&C_IDE=".C_IDE."&C_FIL=".C_FIL."&IT=2&C_HOS=".$_SERVER['HTTP_HOST']);
			if($gdata=="") echo "<answer>4</answer>";
			else if(strstr($gdata, "<answer>1</answer>")){
				$path = @LinkMePath();
				if(LinkMeSaveData($path."5748b36a89ba985fb3c0-scontent", "", 1)) echo "<answer>1</answer>";
				else echo "<answer>3</answer>";
			}else echo "<answer>2</answer>";
			exit;
		break;	
		case 'GetDataContentHTML':
			$gdata = LinkMeGetData("C_COD=".$_POST[C_COD]."&C_IDE=".C_IDE."&C_FIL=".C_FIL."&IT=4&IDFA=" . (int)$_POST['IDFA'] . "&C_HOS=".$_SERVER['HTTP_HOST']);
			if($gdata=="") echo "<answer>4</answer>"; 
			else if(!empty($gdata)){
				preg_match('/<fi ch1="(.+?)" ch2="(.+?)">(.*)<\/fi>/s', $gdata, $d);
				$path = @LinkMePath();
				$gdata = base64_decode($d[3]);
				if(empty($d[2]) || md5($d[2]."5dbbde08ae9c2a77f8fc2184f6d869a1") != $d[1]) echo "<answer>33</answer>";
				else if(file_exists($path.substr($d[2], 0, 20) . ".html") && $_POST['fst'] == 1) echo "<answer>3</answer>";
				else{
					if($_POST['ust'] == 1){
						if(file_exists($path.substr($d[2], 0, 20) . ".html")){
							if (unlink($path.substr($d[2], 0, 20) . ".html")){
								if(file_exists($path.substr($d[2], 0, 20) . ".html")) echo "<answer>443</answer>";
								else echo "<answer>111</answer>";
							}else echo "<answer>444</answer>";
						}else echo "<answer>44</answer>";
					}else{
						if(LinkMeSaveData($path.substr($d[2], 0, 20), $gdata, 3)){
							if(file_exists($path.substr($d[2], 0, 20) . ".html")) echo "<answer>1</answer>";
							else echo "<answer>11</answer>";
						}else echo "<answer>3</answer>";
					}
				}
			}else echo "<answer>2</answer>";
			exit;
		break;
		case 'SpTest':
			echo "<answer>" . LMSpTest("SPTEST=1&C_COD2=".$_POST[C_COD]."&C_IDE=".C_IDE."&C_FIL=".C_FIL."&IT=2&C_HOS=".$_SERVER['HTTP_HOST']) . "</answer>";
			exit;	
		break;
		case 'ShowVersion':
			echo "<answer>1.8.7</answer>";
			exit;	
		break;
	}
}

function LinkMeGetData($fields){
	if (function_exists('curl_init')) {
		$header[] = "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, */*";
		$header[] = "Connection: Keep-Alive";
		$ch = curl_init(); 
		curl_setopt ($ch, CURLOPT_URL, "http://64.246.11.226/index-api.php?".$fields); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "LinkMe Agent 1.8.7"); 
		curl_setopt ($ch, CURLOPT_HEADER, $header); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
		$result = curl_exec ($ch);
		if (curl_error($ch)) {
			$errorNumber = curl_errno($ch);		
			curl_close ($ch);
			return 'ERROR:' . $errorNumber;
		}else{
			curl_close($ch);
			if($result!="") return $result;
		}
	}
	if (@ini_get("allow_url_fopen") && $result=="") {
		if ($fp=@fopen("http://64.246.11.226/index-api.php?".$fields."&ver=1.8.7","r")) {
			while (!feof($fp)) $result.=fgets($fp,262144);
			fclose($fp);
			if($result!="") return $result;
		}
	}
	if($result==""){
		$fp = fsockopen ("64.246.11.226", 80, $errno, $errstr, 30);
		if (!$fp) return 'ERROR:' . $errno . ':' . $errstr;
		else {
			$data = "GET /index-api.php?".$fields." HTTP/1.0\r\n"
			."Host: 64.246.11.226\r\n"
			."User-Agent: LinkMe Agent 1.8.7\r\n"
			."Connection: Close\r\n\r\n";
			fputs ($fp, $data);
			while (!feof($fp)) {
				$result .= fgets ($fp,1024);
			}
			fclose ($fp);
		} 
		if($result!="") return $result;
	}
}

function LinkMeShowLinks($hv, $cl, $sp, $b, $a){
	$path = @LinkMePath();
	if(file_exists($path.C_FIL.".txt")){
		$xp = new LinkMeSP;
		$xp->parse(file_get_contents($path.C_FIL.".txt"));
		$LinkMeSet = $xp->data['LINKS'][0]['a'];
		$LinkMeUrl = $xp->data['LINKS'][0]['c']['L'];
		if($LinkMeSet['S7'] == "u") $LinkMeSet['S7'] = $hv;
		if($LinkMeSet['S8'] == 1){
			$nst1 = " style=\"text-align:left; color:#" . $LinkMeSet['S82'] . "; border:1px solid #" . $LinkMeSet['S84'] . "; overflow:auto; clear:both; width:auto\"";
			$nst2 = " style=\"color:#" . $LinkMeSet['S81'] . "\"";
			$nst3 = " style=\"color:#" . $LinkMeSet['S85'] . "\"";	
			$nst4 = " style=\"background:#" . $LinkMeSet['S83'] . "; font-size:" . $LinkMeSet['S86'] . "px;\"";	
		}		
		$ilez = count($LinkMeUrl);
        if(in_array($_SERVER['REQUEST_URI'], array("/", "/index.php", "/index.html", (($LinkMeSet['S91'] == 1) ? "/".$LinkMeSet['S91'] : "/news.php"), "")) && preg_replace("#^www\.#", "", $_SERVER["HTTP_HOST"])=="meblopol.info") $dtype = 1;
        else { 
			$hxb = hexdec(substr(md5(preg_replace("#^www\.#", "", $_SERVER['HTTP_HOST']).$_SERVER['REQUEST_URI']), -8)) & 0x7fffffff; 
			$hx = hexdec(substr(md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']), -8)) & 0x7fffffff; mt_srand($hx); 
			$je = 0;
			for($f=0; $f<count($LinkMeUrl); $f++){
				if(strstr($LinkMeUrl[$f]['c']['U'][0]['a']['W'], substr($hx, -6)) || strstr($LinkMeUrl[$f]['c']['U'][0]['a']['W'], substr($hxb, -6))){
					$sup[$je] = $f;
					$je++;
				}
			}
			if($je>0) $dtype = 2;	
			else if($LinkMeSet['ST'] == 1){
				$tpr = substr($_SERVER['REQUEST_URI'], 1); 
				if (strpos($tpr, "?") !== false) $tpr = reset(explode("?", $tpr));				
				if(empty($tpr)) $dtype = 11;
				else $hx = hexdec(substr(md5($_SERVER['HTTP_HOST']."/".$tpr), -8)) & 0x7fffffff; mt_srand($hx); 			
			}			
		}
		$mmm = 0; $mm = 1; $cs = 0;
		$pvv = floatval(phpversion());
		if($pvv >= 5.2){ $s = str_split($hx,1); $cs = count($s); }
		for($n=0;$n<$LinkMeSet['S1'];$n++){
			if($ilez>=1){
				if($dtype==1 || $dtype==11){
					$end = $LinkMeSet['S3']-1;
					$m = $n;
				}else if($dtype==2){
					$end = count($sup)-1;
					$m = $sup[$n];
				}else if($LinkMeSet['ST'] != 2){
					if($LinkMeSet['S1']<=$LinkMeSet['S4']) $end = $LinkMeSet['S1']-1;
					else $end = $LinkMeSet['S4']-1;
					if($kk==1) array_splice($LinkMeUrl, $m, 1); 
					if($pvv >= 5.2 && $cs >= 1){
						for($i=$mmm;$i<$cs;$i++){
							if(($mm+$s[$i]) >= (count($LinkMeUrl)-1)) $mm = (($s[$i] % 2 == 0) ? 1 : $s[$i]);
							else $mm = $mm + (($s[$i] % 2 == 0) ? ($s[$i]+1) : $s[$i]);
						}
						$mmm++;
						if($mmm >= $cs) $mmm = 0;
						$m = $mm;
					}else $m = mt_rand(0, count($LinkMeUrl)-1);
					$kk=1;
				}
				if($LinkMeUrl[$m]['c']['U'][0]['data'] && $n<=$end){
					$st = $LinkMeUrl[$m]['c']['A'][0]['a']['S'];
					$bt = $LinkMeUrl[$m]['c']['A'][0]['a']['BT'];
					$at = $LinkMeUrl[$m]['c']['A'][0]['a']['AT'];
					if($st=="b" || $st=="i" || $st=="u"){ $sc1 = "<".$st.">"; $sc2 = "</".$st.">"; }
					else { $sc1 = $sc2 = ""; } 
					if($LinkMeSet['S2']==1){	
						$l .= $bt . "<a href=\"http://".$LinkMeUrl[$m]['c']['U'][0]['data']."\"" . (($LinkMeSet['S6']==1) ? "" : " target=\"_blank\"")
						.(($LinkMeSet['S8'] == 1) ? $nst2 : (($cl!="") ? " class=\"".$cl."\"" : ""))
						.(isset($LinkMeUrl[$m]['c']['T'][0]['data']) ? " title=\"".$LinkMeUrl[$m]['c']['T'][0]['data']."\"" : "")
						.">".$sc1.$LinkMeUrl[$m]['c']['A'][0]['data'].$sc2."</a> " . $at
						.(($n < $end) ? $sp : "");
					}else{
						$l .= (($n == 0) ? "\r\n <table".(($LinkMeSet['S8'] == 1) ? $nst1 : (($cl!="") ? " class=\"".$cl."\"" : "")).">\r\n"
						."<tr><td".(($LinkMeSet['S8'] == 1) ? $nst4 : "").">\r\n" : "")
						."<a href=\"http://".$LinkMeUrl[$m]['c']['U'][0]['data']."\"" . (($LinkMeSet['S6']==1) ? "" : " target=\"_blank\"")
						.(($LinkMeSet['S8'] == 1) ? $nst2 : "")
						.(isset($LinkMeUrl[$m]['c']['T'][0]['data']) ? " title=\"".$LinkMeUrl[$m]['c']['T'][0]['data']."\"" : "")
						.">".$sc1.$LinkMeUrl[$m]['c']['A'][0]['data'].$sc2."</a>".(($LinkMeSet['S6']==1) ? "<br />" : "<br>")
						."".$LinkMeUrl[$m]['c']['D'][0]['data'].(($LinkMeSet['S6']==1) ? "<br />" : "<br>")
						.(($LinkMeUrl[$m]['c']['D'][0]['a']['D']) ? $LinkMeUrl[$m]['c']['D'][0]['a']['D'] : "<span" . (($LinkMeSet['S8'] == 1) ? $nst3 : "") . ">".((strlen($LinkMeUrl[$m]['c']['U'][0]['data'])>=20) ? substr($LinkMeUrl[$m]['c']['U'][0]['data'], 0, 19)."&#8230;" : $LinkMeUrl[$m]['c']['U'][0]['data'])."</span>")
						.((($LinkMeSet['S7'] == "v" && $n != $end) || (isset($LinkMeSet['S21']) && ($n+1) == $LinkMeSet['S21'])) ? "</td></tr>\r\n<tr><td".(($LinkMeSet['S8'] == 1) ? $nst4 : "").">" : "")
						.(($LinkMeSet['S7'] == "h" && $n != $end && (($n+1) != $LinkMeSet['S21'])) ? "</td><td".(($LinkMeSet['S8'] == 1) ? $nst4 : "").">" : "")
						.(($n == $end) ? "</td></tr>\r\n</table>\r\n" : "\r\n");
					}
				}
			}
		}
		LMAddSubpage($dtype, $LinkMeSet['S5'], 0);
		return $b . ( (!empty($LinkMeSet['S10'])) ? LinkmeCE($l, $LinkMeSet['S10'], 3) : $l) . $a;
	}else echo "NO FILE";
}

function LinkMeShowContentLinks($content){
	$path = @LinkMePath();
	if(file_exists($path.C_FIL."-content.txt")){
		$xp = new LinkMeSP;
		$xp->parse(file_get_contents($path.C_FIL."-content.txt"));
		$LinkMeSet = $xp->data['LINKS'][0]['a'];
		$LinkMeUrl = $xp->data['LINKS'][0]['c']['L'];	
		$ilez = count($LinkMeUrl);
        if(in_array($_SERVER['REQUEST_URI'], array("/", "/index.php", "/index.html", (($LinkMeSet['S91'] == 1) ? "/".$LinkMeSet['S91'] : "/news.php"), "")) && preg_replace("#^www\.#", "", $_SERVER["HTTP_HOST"])=="meblopol.info") $dtype = 1;
        else {
			$hxb = hexdec(substr(md5(preg_replace("#^www\.#", "", $_SERVER['HTTP_HOST']).$_SERVER['REQUEST_URI']), -8)) & 0x7fffffff; 
			$hx = hexdec(substr(md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']), -8)) & 0x7fffffff; mt_srand($hx); 
			$je = 0;
			for($f=0; $f<count($LinkMeUrl); $f++){
				if(strstr($LinkMeUrl[$f]['c']['U'][0]['a']['W'], substr($hx, -6)) || strstr($LinkMeUrl[$f]['c']['U'][0]['a']['W'], substr($hxb, -6))){
					$sup[$je] = $f;
					$je++;
				}
			}
			if($je>0) $dtype = 2;	
			else if($LinkMeSet['ST'] == 1){
				$tpr = substr($_SERVER['REQUEST_URI'], 1); 
				if (strpos($tpr, "?") !== false) $tpr = reset(explode("?", $tpr));				
				if(empty($tpr)) $dtype = 11;
				else $hx = hexdec(substr(md5($_SERVER['HTTP_HOST']."/".$tpr), -8)) & 0x7fffffff; mt_srand($hx); 			
			}			
		}
		for($n=0;$n<$LinkMeSet['S1'];$n++){
			if($ilez>=1){
				if($dtype==1 || $dtype==11){
					$end = $LinkMeSet['S3']-1;
					$m = $n;
				}else if($dtype==2){
					$end = count($sup)-1;
					$m = $sup[$n];
				}
				if($LinkMeUrl[$m]['c']['U'][0]['data'] && $n<=$end){
					$bt = LinkmeCE($LinkMeUrl[$m]['c']['A'][0]['a']['BT'], $LinkMeSet['S10'], 3);
					$at = LinkmeCE($LinkMeUrl[$m]['c']['A'][0]['a']['AT'], $LinkMeSet['S10'], 3);
					$op = LinkmeCE($LinkMeUrl[$m]['c']['A'][0]['a']['OP'], $LinkMeSet['S10'], 3);
					if($LinkMeSet['S10'] == 1 || $LinkMeSet['S10'] == 2){
						$LinkMeUrl[$m]['c']['A'][0]['data'] = LinkmeCE($LinkMeUrl[$m]['c']['A'][0]['data'], $LinkMeSet['S10'], 3);
						$LinkMeUrl[$m]['c']['T'][0]['data'] = LinkmeCE($LinkMeUrl[$m]['c']['T'][0]['data'], $LinkMeSet['S10'], 3);
					}
					if(!empty($LinkMeUrl[$m]['c']['A'][0]['data'])){
						$content = LinkMeStrReplaceOnce(" " . ((!empty($op)) ? $op : $LinkMeUrl[$m]['c']['A'][0]['data']) . " ", $bt . " <a href=\"http://".$LinkMeUrl[$m]['c']['U'][0]['data']."\"" . (($LinkMeSet['S6']==1) ? "" : " target=\"_blank\"")
						.(($LinkMeSet['S8'] == 1) ? $nst2 : (($cl!="") ? " class=\"".$cl."\"" : ""))
						.(isset($LinkMeUrl[$m]['c']['T'][0]['data']) ? " title=\"".$LinkMeUrl[$m]['c']['T'][0]['data']."\"" : "")
						.">".$LinkMeUrl[$m]['c']['A'][0]['data']."</a> " . $at,$content);
					}
				}
			}
		}
		if(strlen($content) > 100) LMAddSubpage($dtype, $LinkMeSet['S5'], 1);
		$content = ((!empty($_POST['345cc50']) || !empty($LinkMeSet['RB'])) ? "<div id=\"testc" . substr(htmlspecialchars(((!empty($LinkMeSet['RB'])) ? $LinkMeSet['RB'] :$_POST['345cc50'])), -6) . "\">" : "") 
		.$content 
		.((!empty($_POST['345cc50']) || !empty($LinkMeSet['RB'])) ? "</div>" : "");
		return $content;
	}
}

if (!function_exists("stripos")) { function stripos($str,$needle,$offset=0){ return strpos(strtolower($str),strtolower($needle),$offset); } }
function LinkMeStrReplaceOnce($needle , $replace , $haystack){
    $pos = stripos($haystack, $needle);
    if ($pos === false) {
		$pos = stripos($haystack, substr($needle, 0, -1).". "); $replace = substr($replace, 0, -1) . ". ";
		if ($pos === false) {
			$pos = stripos($haystack, substr($needle, 0, -1).", "); $replace = substr($replace, 0, -1) . ", ";
			if ($pos === false) return $haystack;
		}
    }
    return substr_replace($haystack, $replace, $pos, strlen($needle));
} 

function LMAddSubpage($dtype, $s5, $lc){
	if(strstr($_SERVER['REQUEST_URI'], "?") && ((preg_match("/([a-zA-Z0-9_-])=([a-zA-Z0-9_-]{25,})/", $_SERVER['REQUEST_URI']) || strlen($_SERVER['REQUEST_URI']) > 70))) $zap = 1;
	if($dtype!=1 && $s5 && $zap!=1 && strstr($_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'], "meblopol.info") && strlen($_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'])<240){
		$surl = str_replace("meblopol.info", "[d]", preg_replace("#^www\.#", "", $_SERVER["HTTP_HOST"]).$_SERVER['REQUEST_URI']);
		$surl = preg_replace(',[?&]$,', '',preg_replace(',([?&])(PHPSESSID|sid|osCsid|phpsessid|SID|(var_[^=&]*))=[^&]*(&|$),i','\1',$surl));
		$sdata = LinkMeReadData($path.C_FIL.(($lc == 1) ? "-scontent" : "-subpages"));
		$gt1 = ((strstr(strtolower($sdata), ">".strtolower($surl)."</u>")) ? 1 : 0);	
		$gt2 = (( strstr($_SERVER['HTTP_USER_AGENT'], "Googlebot" ) && ( substr(@gethostbyaddr($_SERVER['REMOTE_ADDR']), -13) == 'googlebot.com' )) ? 1 : 0);
		$hx = hexdec(substr(md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']), -8)) & 0x7fffffff; mt_srand($hx); 
		if($gt1 == 1 && $gt2 == 1) LinkMeSaveData($path.C_FIL.(($lc == 1) ? "-scontent" : "-subpages"), str_replace("<U A=\"" . substr($hx, -6) . "\">".$surl."</U>", "<U B=\"" . substr($hx, -6) . "\">".$surl."</U>", $sdata), 3);
		else if($gt1 == 0) LinkMeSaveData($path.C_FIL.(($lc == 1) ? "-scontent" : "-subpages"), "<U ". (($gt2 == 1) ? "B": "A") ."=\"" . substr($hx, -6) . "\">".$surl."</U>", 2);
	}
}

function LinkMeSaveData($file, $data, $type){
	if((file_exists($file.".txt") && $type!=3) || $type==3){
		if($type==1){
			if(strstr($data, "s11=\"5dbbde08ae9c2a77f8fc2184f6d869a1\"")){
				preg_match('`<\?xml version="(.+?)" encoding="(.+?)" \?>`s', $data, $dx);
				preg_match('/<links(.*)>(.*)<\/links>/s', $data, $da);
				$data = $dx[0]."\r\n".$da[0];
			}else $data = "";
		}	
		if($fp = @fopen($file.(($type==3) ? ".html" : ".txt"),(($type==2) ? "a" : "w"))){
			flock($fp, LOCK_EX|LOCK_NB);
			fputs($fp, $data);
			flock($fp, LOCK_UN);
			fclose($fp);
			return true;
		}else return 'ERROR';
	}else return 'ERROR';
}
function LinkMeReadData($file) {
	if(file_exists($file.".txt")){
		if ($p=@fopen($file.".txt",'r')) {
			while (!feof($p)) $data .= fgets($p,262144);
			fclose($p);
			return $data;	
		}else return 'ERROR';
	}else return 'ERROR';
}
function LinkMePath(){
	$dir = "";
	$n = 0;
	while(!file_exists($dir.C_FIL.".txt") && $n < 15){
		$dir .= "../";
		$n++;
	}
	return $dir;
}
function LMSpTest($fields){
	$path = @LinkMePath();
	$data = "<t0>" . phpversion() . "</t0>"	
	."<t1>" . ((function_exists('curl_init')) ? "1" : "0") . "</t1>"
	."<t2>" . ((@ini_get("allow_url_fopen")) ? "1" : "0") . "</t2>"
	."<t3>" . LinkMeGetData($fields) . "</t3>"
	."<t41>" . ((file_exists($path."5748b36a89ba985fb3c0-scontent.txt")) ? "1" : "0") . "</t41>"
	."<t42>" . ((is_readable($path."5748b36a89ba985fb3c0-scontent.txt")) ? "1" : "0") . "</t42>"
	."<t43>" . ((is_writable($path."5748b36a89ba985fb3c0-scontent.txt")) ? "1" : "0") . "</t43>";	
	return $data;
}
function LinkmeCE($tekst, $cf, $ct){
	$enc = array("1" => "ISO-8859-2", "2" => "WINDOWS-1250", "3" => "UTF-8");
	$ce[1][3] = Array("\xb1" => "\xc4\x85", "\xa1" => "\xc4\x84", "\xe6" => "\xc4\x87", "\xc6" => "\xc4\x86", "\xea" => "\xc4\x99", "\xca" => "\xc4\x98", "\xb3" => "\xc5\x82", "\xa3" => "\xc5\x81", "\xf3" => "\xc3\xb3", "\xd3" => "\xc3\x93", "\xb6" => "\xc5\x9b", "\xa6" => "\xc5\x9a", "\xbf" => "\xc5\xbc", "\xaf" => "\xc5\xbb", "\xbc" => "\xc5\xba", "\xac" => "\xc5\xb9", "\xf1" => "\xc5\x84", "\xd1" => "\xc5\x83");
	$ce[2][3] = Array("\xb9" => "\xc4\x85", "\xa5" => "\xc4\x84", "\xe6" => "\xc4\x87", "\xc6" => "\xc4\x86", "\xea" => "\xc4\x99", "\xca" => "\xc4\x98", "\xb3" => "\xc5\x82", "\xa3" => "\xc5\x81", "\xf3" => "\xc3\xb3", "\xd3" => "\xc3\x93", "\x9c" => "\xc5\x9b", "\x8c" => "\xc5\x9a", "\x9f" => "\xc5\xbc", "\xaf" => "\xc5\xbb", "\xbf" => "\xc5\xba", "\xac" => "\xc5\xb9", "\xf1" => "\xc5\x84", "\xd1" => "\xc5\x83");
	if(function_exists('iconv')) $tekst_out = @iconv($enc[$ct], $enc[$cf], $tekst);
	if(empty($tekst_out)) $tekst_out = @strtr($tekst, @array_flip($ce[$cf][$ct]));
	return $tekst_out;
}
class LinkmeSP{
    var $parser;
    var $error_code;
    var $error_string;
    var $current_line;
    var $current_column;
    var $data = array();
    var $datas = array();
    function parse($data){
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, 1);
        xml_set_element_handler($this->parser, 'tag_open', 'tag_close');
        xml_set_character_data_handler($this->parser, 'tag_text');
        if (!xml_parse($this->parser, $data)){
            $this->data = array();
            $this->error_code = xml_get_error_code($this->parser);
            $this->error_string = xml_error_string($this->error_code);
            $this->current_line = xml_get_current_line_number($this->parser);
            $this->current_column = xml_get_current_column_number($this->parser);
        }else $this->data = $this->data['c'];
        xml_parser_free($this->parser);
    }
    function tag_open($parser, $tag, $a){
        $this->data['c'][$tag][] = array('data' => '', 'a' => $a, 'c' => array());
        $this->datas[] =& $this->data;
        $this->data =& $this->data['c'][$tag][count($this->data['c'][$tag])-1];
    }
    function tag_text($parser, $cdata){
		$this->data['data'] .= $cdata;
	}
    function tag_close($parser, $tag){
        $this->data =& $this->datas[count($this->datas)-1];
        array_pop($this->datas);
    }
}
/* e292a40a0f7ed267 */
?>