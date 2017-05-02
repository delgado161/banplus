<?php 
	check_attack();

	function check_attack(){
		$ar_checkme = array($_SERVER['HTTP_HOST'],$_SERVER['SERVER_PORT'],$_SERVER['HTTP_USER_AGENT']);
		/*
		echo "<!-- ";
		print_r($_COOKIE);
		echo " -->";
		echo "<!-- ";
		print_r(headers_list());
		echo " -->";
		echo "<!-- ";
		print_r($ar_checkme);
		echo " -->";
		*/
		
		$arrays_to_check = array_merge($_GET,$_POST);
		foreach($arrays_to_check  as $akey => $aval ){
//			echo "<li> key $akey -- " . $aval ." -- ";
			$str = normalizar_attack($aval);
			check_point_str($str);
		}	

		//		$str = normalizar_attack("%73%65%6c%65%63%74%20");// select en HEX
	}
	/*
		me ayuda a colocar el string de una forma el cual yo pueda manejarlo con mayor simplicidad
		normalizando la estructura del string entregado
		coloca el string de forma tal que pueda ser leido por un humano	
	*/
	function normalizar_attack($bad_str){
		
		// html_entity_decode("I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now"); // I'll "walk" the <b>dog</b> now
		// echo rawurldecode('foo%20bar%40baz'); // foo bar@baz
		// echo base64_decode('VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZw=='); //This is an encoded string
		// strip_tags('<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>'); //Test paragraph. Other text
		// stripcslashes('\x48ello') // 'Hello'
		//echo "<li> bad_str -- " . $bad_str ." -- ";
		$str = strtolower($bad_str);
		$str = html_entity_decode($str);
		$str = rawurldecode($str);
		$str_sintags = strip_tags($str);
		if(strlen($str_sintags)< strlen($str)){
			echo "paso2";
			die();
			hay_ataque();
			
		}
		$str = strip_tags($str);
		$str = stripcslashes($str);
		
		$good_str = $str;
		//echo "<li> good_str -- " . $good_str ." -- ";
		return $good_str;
	}
	/*
		convierte un String en arreglo
		ejemplo 
			$str = "first=value&arr[]=foo+bar&arr[]=baz";
				parse_str($str, $output);
				echo $output['first'];  // value
				echo $output['arr'][0]; // foo bar
				echo $output['arr'][1]; // baz
	*/
	function check_point_str($str){
		$output = explode(" ",$str);
		if(is_array($output) ){
			 check_point_array($output);
		}
		
		parse_str($str, $output);
//		print_r($output);
		if(is_array($output) ){
			 check_point_array($output);
		}
	}
	/*
		revisa el arreglo segun los valores que contenga
	
	*/
	function check_point_array($arr){
		if(is_array($arr) ){
			foreach($arr as $key => $value ){
//				echo "<li> check_point_array key -- " . $key ." -- ";
//				echo "<li> check_point_array value -- " . $value ." -- ";

				if(   is_array($value)   ){
					check_point_array($value); //  recursivamente 
				}else{
					check_value_str($value);
				}
			}//foreach
		}// if array
	}
	/*
		aqui validamos los valores del STR segun las amenazas que existen
	*/
	function check_value_str($str){
		$bad_sql = array("select", "insert", "drop", "'", '"', "*", "all", "from", "table", "update"
						 , "set", "values", "char", "int", "concat", "cast", "="
						 , "declare", "exec", "execute", "varchar", "nvarchar", "sysobjects", "get", "null");
		
		$bad_html = array("script", "frame", "iframe", "style", "shockwave", "java", "javascript", "http", "http-equiv", 
						  "src", "expression", 'embed', 'object');
		
		$bad_javascript = array("cookie","alert", "window", "session", "expression",'onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
					
		$bad_values = array_merge($bad_sql, $bad_html, $bad_javascript);
		$existe_ataque = false ; 
		$existe_ataque = in_array($str,$bad_values);
		//echo "<li> check_value_str  -- " . $str ." -- ";
		//print_r($bad_values);
		//echo "<li> existe_ataque  -- " . $existe_ataque ." -- check_value_str  -- " . $str ." --  ";
		if($existe_ataque){
			echo "paso1";
			die();
			hay_ataque();
		}
		
		$special_bad_chars = array("=","'",'"',"%", "http", "0x");
		foreach($special_bad_chars as $skey=>$sval){
			if( strstr($str,$sval) ){
				echo "paso";
				die();
				hay_ataque();
			}
		}	
	}
	
	function hay_ataque(){
		header("HTTP/1.1 404 Not Found");
		//header("Location: error.php");
		die("404 NOT FOUND");
	}
?>