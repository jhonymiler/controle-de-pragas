	   function getFeeds(userId){
		    user = (UserId.typeof == "undefined")?'me':userId;
			FB.api('/'+user+'/feed/', function(f){
				  /*for (var i in f){
					//alert('Campo \''+i+'\': ' + me[i])
					//navego pelas chaves do array como um for
					//document.getElementById('tudo').innerHTML = 'Campo \''+i+'\': ' + me[i] + '<br>';
					$("#feed").append( i + ' : ' + f[i] +'<br>')
				  }*/
				  return f;
			})
	   }
	   
	   function getFeeds(userId){
		    user = (UserId.typeof == "undefined")?'me':userId;
			FB.api('/'+user+'/friends?limit=5000&offset=0', function(amigos){
				 /* am = amigos.data;
				  for (f=0; f < am.length; f++){
					  
					$("#amigos").append( '<div  class="amigos"><img width="52" height="52" onMouseOver="aumenta(this)" onMouseOut="diminui(this)" alt="'+am[f].name+'" title="'+am[f].name+'" src="https://graph.facebook.com/'+am[f].id+'/picture"><div>')
				  }*/
				  return am;
			})
	   }
			
		function sendRequestToRecipients(id) {
		  FB.ui({method: 'apprequests',
			message: 'My Great Request',
			to: id,
			redirect_uri:'http://localhost/teste/ratos/'
		  }, requestCallback);
		}	  
		
		function requestCallback(e){
			alert(e)
		}
		
		function postFoto(imgURL, userId){
		
			var imgURL = imgURL;
			id = (userId == null)?'me':userId;
			
			FB.api('/'+ id +'/photos/', 'post', {
				message:'teste',
				url:imgURL, //caminho da foto
			
			}, function(response){
			
				if (!response || response.error) {
					alert ('Error occured' +response.error);
				} else {
					alert('ok')
					return response.id;// retorna o id do post da foto
			
				}
			}); 
		} 
		
		function aumenta(obj){
			  $(obj).css({
				'position': 'absolute',
				'display':'block',
				'z-index': '99',
				'border': '5px solid white'
			  }).animate({
				'left': '-30px',
				'top': '-30px',
				'width': '150px',
				'height': '150px',
			  })
		}
		
		function diminui(obj){
			 $(obj).css({
				'position': 'relative',
				'z-index': '0',
				'border': '0px'
			  }).stop(true,true).animate({
				'left': '0px',
				'top': '0px',
				'width': '52px',
				'height': '52px',
			  },200)
		}
		
		 
