<html>
	<head>
	</head>
	<body>
		<?php require "_system/autoload.php"; //El contenido de la libreria oauth lo guarde en la carpeta _system
	 
		use Jose\TwitterOAuth\TwitterOAuth;
		 
		$consumer_key = "mhwB5yseg3gbzCBnN81v5TgwA";
		$consumer_secret = "lTC8vDy16BEtEREgt0zAtJ9qGXuvaqNiKCcAF1BvZFgkI7hKNd";
		$token = "181358561-Gs0zJS0HQkCueuaSSGFMXGUSYAIGO9IWIkCOTZY9";
		$token_secret = "Dsl9is6wbmBenuv9lsgC3Ztk8JbaXZvgXyRhpSNBSYi0B";
		 
		$conexion = new TwitterOAuth($consumer_key, $consumer_secret, $token, $token_secret);
		$contenido = $conexion->get("followers/list");
		 
		var_dump($contenido); 
		?>
	</body>
</html>






<!--a class="twitter-timeline" 
	href="https://twitter.com/Guitarist_Jose"
	data-widget-id="664505299282345984">Tweets por el @Guitarist_Jose.</a>








<!--script>window.twttr = (function(d,s,id) {
  var js,fjs=d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js=d.createElement(s);
  js.id=id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js,fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document,"script","twitter-wjs"));</script>






<!--script>!function(d,s,id){
	var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
		if(!d.getElementById(id))
		{
			js=d.createElement(s);
			js.id=id;
			js.src=p+"://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);
		}
	}(document,"script","twitter-wjs");
</script>


<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, "script", "twitter-wjs"));</script>