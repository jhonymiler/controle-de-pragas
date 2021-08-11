<html>
<head>
<title>Evercookie - unforgettable cookies</title>
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="swfobject-2.2.min.js"></script>
<script type="text/javascript" src="evercookie.js"></script>
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
		arr['best'] = best_candidate;
		i = 1;
		for (var item in all_candidates){
			arr[item] = all_candidates[item];
			i++;
		}
		return alert(arr['best']);
	}
	ec.get("id", getCookie); 
	
	// we look for "candidates" based off the number of "cookies" that
	// come back matching since it's possible for mismatching cookies.
	// the best candidate is most likely the correct one
		
 </script>
 <div id="idtag"></div>
 <input name="" type="button" value="reativar" onClick="reativarCookies()">