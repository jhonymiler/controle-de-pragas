<?php
session_name("usuario");
session_start();

require_once('../../acesso.php');		

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
 <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--<script type="text/javascript" src="js/files/functions.js"></script>-->

<!-- Top line begins -->
<div id="top">
	<div class="wrapper">
    	<a href="#" title="" class="logo"><img src="../../images/logo.png"  alt="" /></a>
        
        <!-- Right top nav -->
        <div class="clear"></div>
    </div>
</div>
<!-- Top line ends -->


<!-- Login wrapper begins -->
<div class="middleNavA" style="padding-top:50px;">
    <div class="nNote nWarning">
        <p>Verificando. Por favor aguarde o redirecionamento.</p>
    </div> 
</div>

<script type="text/javascript" src="evercookie/swfobject-2.2.min.js"></script>
<script type="text/javascript" src="evercookie/evercookie.js"></script>

<!-- Login wrapper ends -->
<script type="text/javascript">
	var ec = new evercookie(); 
	
	// set a cookie "id" to "12345"
	// usage: ec.set(key, value)
	
	
	// retrieve a cookie called "id" (simply)
	//ec.get("id", function(value) { alert("Cookie value is " + value) }); 
	
	// or use a more advanced callback function for getting our cookie
	// the cookie value is the first param
	// an object containing the different storage methods
	// and returned cookie values is the second parameter
	function getCookie(best_candidate, all_candidates)
	{
		arr = new Array;
		arr['best'] = best_candidate; // melhor candidado para evercookie
		$(".nNote").removeClass('nWarning').addClass('nSuccess').find('p').html('Autenticado!')
        setTimeout(window.location = '../../index.php',200);

	}
	ec.set('TOKEN', '<?=$_SESSION['User']['token']?>');
	ec.get("TOKEN", getCookie);

	
	// we look for "candidates" based off the number of "cookies" that
	// come back matching since it's possible for mismatching cookies.
	// the best candidate is most likely the correct one
		
 </script>

 
