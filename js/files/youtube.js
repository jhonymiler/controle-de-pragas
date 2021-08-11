// JavaScript Document

			
			
			
(function($){
    $.fn.youtube = function(options) {

        var defaults = {
          'url' : 'http://www.youtube.com/watch?v=08e9k-c91E8',
		  'titulo': 	'ytTitulo',
		  'imagem': 	'img',
		  'descricao':  'p',
		  'views': 	    'span',
		  'autor': 		'.autor',
		  'JSON':		''
        };

        var settings = $.extend( {}, defaults, options );
		
		$.getId = function(){
			filtro = /^(http[s]?:\/\/)?(www\.)?youtu\.be\/([a-zA-Z0-9_-]+)$/;
			//Verifica se o url é aquele url compartilhado ex: http://youtu.be/3dXg0D5takg
			if(filtro.test(settings.url)){
				//se for o url compartilhado seta as variaveis de replace
				regex = /^(http[s]?:\/\/)?(www\.)?youtu\.be\/([a-zA-Z0-9_-]+)$/;
				replacement = "$3";
			}
			else
			{
				// SE NÃO...
				//Trabalha com o url maior ex: http://www.youtube.com/watch?v=3dXg0D5takg&feature=youtu.be
				regex = /^(http[s]?:\/\/)?(www\.)?youtube([\.a-zA-Z]{2,4})+([\.a-zA-Z]{2})?\/?\??watch\?v=([a-zA-Z0-9_-]*)+(.*)?$/;
				replacement = "$5";
			}
			// Troca o endereço para adiquirir o id do video
			//replacement = "http://i2.ytimg.com/vi/$5/default.jpg";
			settings['id'] = settings.url.replace( regex, replacement );
			objeto.id = settings.id;
			return settings.id;
		};
		
		$.dados = function(){
			$.getId();
			$.ajax({
				url: "http://gdata.youtube.com/feeds/api/videos/"+ objeto.id +"?v=2&alt=json",
				dataType: "jsonp",
				success: function (ytjason) {  
					dads = {
						titulo :  ytjason.entry.title.$t,
						imagem : $.getimagem(),
						descricao : ytjason.entry.media$group.media$description.$t
					}
					$.extend( {}, objeto, dads );
//
//					settings['descricao'] =     ytjason.entry.media$group.media$description.$t;
//					settings['views'] =  	    ytjason.entry.yt$statistics.viewCount;
//					settings['autor'] =  		ytjason.entry.author[0].name.$t;
					//var imagem =        $.getImagem();
				}
			});
			alert(objeto.titulo);
		}
		
		$.getimagem = function(){
			return "http://i2.ytimg.com/vi/"+objeto.id+"/default.jpg"
		} 
		
	   return this.each(function() {
		  	$.dados();
			$(this).html(objeto.titulo)
	   })

    }; 
})(jQuery);

