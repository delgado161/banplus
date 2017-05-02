	// Global user functions 
	
	var normalize = (function() {
  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
      mapping = {};
 
  for(var i = 0, j = from.length; i < j; i++ )
      mapping[ from.charAt( i ) ] = to.charAt( i );
 
  return function( str ) {
      var ret = [];
      for( var i = 0, j = str.length; i < j; i++ ) {
          var c = str.charAt( i );
          if( mapping.hasOwnProperty( str.charAt( i ) ) )
              ret.push( mapping[ c ] );
          else
              ret.push( c );
      }      
      return ret.join( '' );
  }
 
})();
	
	function valid_passd (el){
		var elm,nmb,apll,valmd5,resmd5;
		var pswdlength = false; var pswdletter = false; var pswduppercase = false; var pswdnumber = false; 
		var pswdsequenc = false; var pswdsequenc2 = false; var paswdbnco = false; var pswdultmpss = false;
		var pswdrept = false; var alphbt = false; var pswdoneuppercase = false;
	
		elm =  document.getElementById('x_llave').value;
		//elm =  elm.toLowerCase();
		if (el==1){
			nmb =  document.getElementById('x_nombre').value;
			nmb =  nmb.toLowerCase();
			apll =  document.getElementById('x_apellido').value;
			apll =  apll.toLowerCase();
		}else {
			nmb =  document.getElementById('u_nombre').value; 
			nmb =  nmb.toLowerCase();
			apll =  document.getElementById('u_apellido').value;
			apll =  apll.toLowerCase();
		}
		
		var passhash = CryptoJS.MD5(elm);
		valmd5 = document.getElementById('u_md5pass').value;
		resmd5 = valmd5.indexOf(passhash);
		
		//validate ultimas 5 contraseñas
		if (resmd5>=0){
			//alert(resmd5);
			$('#ultipass').removeClass('valid').addClass('invalid');  
		}else {
			$('#ultipass').removeClass('invalid').addClass('valid');
			pswdultmpss=true;
		} 
		
		//validate lenght (longitud)
		if ((elm.length >= 8) && (elm.length <= 10)) {
			$('#length').removeClass('invalid').addClass('valid'); pswdlength=true;
		} else {
			$('#length').removeClass('valid').addClass('invalid'); 
		}
		
		//validate password
		//if ( elm.match(/^[a-zA-Z0-9 \!\#\$\%\&\/\(\)\=\?\¡] && ([^á-ú] || [^Á-Ú] || [^à-ù] || [^À-Ù])*$)/)) {
		if ( elm.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])$/)) {
			$('#letter').removeClass('valid').addClass('invalid'); pswdletter=false;
		} else {
			$('#letter').removeClass('invalid').addClass('valid'); pswdletter=true;
		}
		
		
		//validate valores nombre y apellido
		var pnmb, papl,cdn;
		cdn = elm;
		cdn = normalize(cdn.toLowerCase());
		pnmb = cdn.indexOf(normalize(nmb));  
		papl = cdn.indexOf(normalize(apll));
		
		if ((pnmb>=0) || (papl>=0)){
			$('#capital').removeClass('valid').addClass('invalid'); 
		}else {
			$('#capital').removeClass('invalid').addClass('valid'); pswduppercase=true;
		}

		
		//validar consecutivos		
		var sAlphas = "abcdefghijklmnopqrstuvwxyz";
		var sNumerics = "01234567890";
		var nSeqAlpha = 0;
		var nSeqChar = 0;
		var nSeqNumber = 0;
		var nScore = 0;
		var sSeqAlpha, sSeqNumber;
		var nMultSeqAlpha = 3;
		var nMultSeqNumber = 3;
		
		/* verificacion valores repetidos continuos */
		var RegularExpression = /^(([a-zA-Z0-9!#$%&=?¿¡@<>,;.:_+\-*])\2?(?!\2))+$/;
		// alert(elm);
		// alert(elm.search(RegularExpression));
		if (elm.search(RegularExpression)==-1){
			$('#repetidos').removeClass('valid').addClass('invalid');
			pswdrept = false;
		}else{
			$('#repetidos').removeClass('invalid').addClass('valid');
			pswdrept = true;
		} 
		
		//validar info banco
		var val_ca1, val_ca2;
		
		val_ca1 = elm.toLowerCase().indexOf('banco');
		val_ca2 = elm.toLowerCase().indexOf('banplus');
		
		if ((val_ca1>=0) || (val_ca2>=0)){
			$('#bco').removeClass('valid').addClass('invalid');
		} else {
			$('#bco').removeClass('invalid').addClass('valid'); paswdbnco=true;
		}	
		
		//validate number
		if ( elm.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid'); pswdnumber=true;
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		} 

		//Validate one upperCase
		if ( elm.match(/([A-Z])/) ) {
			$('#uppercase').removeClass('invalid').addClass('valid'); pswdoneuppercase=true;
		} else {
			$('#uppercase').removeClass('valid').addClass('invalid');
		} 
		
		/*al menos 1 valor alfabetico*/	 
		var cntLT = 0; var elmLW = ""; elmLW = elm.toLowerCase();
		if(elmLW.indexOf('a') != -1){ cntLT++; }
		if(elmLW.indexOf('b') != -1){ cntLT++; }
		if(elmLW.indexOf('c') != -1){ cntLT++; }
		if(elmLW.indexOf('d') != -1){ cntLT++; }
		if(elmLW.indexOf('e') != -1){ cntLT++; }
		if(elmLW.indexOf('f') != -1){ cntLT++; }
		if(elmLW.indexOf('g') != -1){ cntLT++; }
		if(elmLW.indexOf('h') != -1){ cntLT++; }
		if(elmLW.indexOf('i') != -1){ cntLT++; }
		if(elmLW.indexOf('j') != -1){ cntLT++; }
		if(elmLW.indexOf('k') != -1){ cntLT++; }
		if(elmLW.indexOf('l') != -1){ cntLT++; }
		if(elmLW.indexOf('m') != -1){ cntLT++; }
		if(elmLW.indexOf('n') != -1){ cntLT++; }
		if(elmLW.indexOf('ñ') != -1){ cntLT++; }
		if(elmLW.indexOf('ñ') != -1){ cntLT++; }
		if(elmLW.indexOf('o') != -1){ cntLT++; }
		if(elmLW.indexOf('p') != -1){ cntLT++; }
		if(elmLW.indexOf('q') != -1){ cntLT++; }
		if(elmLW.indexOf('r') != -1){ cntLT++; }
		if(elmLW.indexOf('s') != -1){ cntLT++; }
		if(elmLW.indexOf('t') != -1){ cntLT++; }
		if(elmLW.indexOf('u') != -1){ cntLT++; }
		if(elmLW.indexOf('v') != -1){ cntLT++; }
		if(elmLW.indexOf('w') != -1){ cntLT++; }
		if(elmLW.indexOf('x') != -1){ cntLT++; }
		if(elmLW.indexOf('y') != -1){ cntLT++; }
		if(elmLW.indexOf('z') != -1){ cntLT++; }
		
		if (cntLT==0){
			$('#carach').removeClass('valid').addClass('invalid');  alphbt=false;
		}else {
			$('#carach').removeClass('invalid').addClass('valid');  alphbt=true;
		}
		 
		//alert("pswdlength "+pswdlength + " pswdletter "+ pswdletter + " pswduppercase " + pswduppercase + " pswdnumber " + pswdnumber + " paswdbnco " + paswdbnco + " pswdultmpss " +pswdultmpss + " pswdrept " +pswdrept + " alphbt " +alphbt + " pswdoneuppercase " + pswdoneuppercase);
		if( pswdlength && pswdletter && pswduppercase && pswdnumber && paswdbnco && pswdultmpss && pswdrept && alphbt && pswdoneuppercase){ 
			$('#pswd_info').show();
			if (el==1){
				$('#btnAction').removeAttr('disabled');
				//document.fusuariosadd.btnAction.disabled = false;
			}else {
				$('#btnAction').removeAttr('disabled');
				//document.fusuariosedit.btnAction.disabled = false;
			}
		}else{
			$('#pswd_info').show();
			if (el==1){
				$('#btnAction').attr('disabled','disabled');
				//document.fusuariosadd.btnAction.disabled = true;
			}else {
				$('#btnAction').attr('disabled','disabled');
				//document.fusuariosedit.btnAction.disabled = true;
			}
		}
		
	}