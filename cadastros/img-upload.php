 
 <script type="text/javascript" src="js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/jquery.swfupload.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		opcoes = {
			upload_url: "upload.php",
			file_post_name: 'imagem',
			file_size_limit : "6000",
			file_types : "*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			post_params : {"CON_id" : "12"},
			file_upload_limit : 0,
			flash_url : "js/swfupload/swfupload.swf",
			button_text_style : "color: #000000; font-size: 16pt;float: right;margin: 3px;",
			button_placeholder_id: 'button',
			button_image_url : 'js/swfupload/wdp_buttons_upload_114x29.png',
			button_width : 114,
			button_height : 29,
			//button_placeholder : $('#button')[0],
			debug: false
		};
		var num;
	
		$('#swfupload-control').swfupload(opcoes)
			.bind('fileQueued', function(event, file){
		
		
				var listitem = '<li id="'+file.id+'"><div class="img-nome" placeholder="'+file.name+'"><div></li>';
				$('#imagens').append(listitem);
				
				widthLi   = ($('#imagens').width() - 6 );
				fontSize  = $('#imagens li#'+file.id+' .img-nome').css('fontSize').match(/[0-9]+/);
				caracNome = file.name.length;
				nomeWidth = fontSize * caracNome;
				
				
				if(nomeWidth > widthLi){
					
					widthLi = Math.floor(widthLi/fontSize);
					nome = file.name.substr(0,widthLi)+'...';
				}else{nome = file.name;}
				
				$('#imagens li#'+file.id+' .img-nome').html('<span class="fileError fileName" onclick="Sele(this.id)"></span>'+nome+'<span class="remove"></span><span class="clear"></span>');
				
				//alert('width: '+widthLi+';  Qtd caract: '+caracNome+'; wid Font: '+fontSize+';')
				// cancela
				var swfu = $.swfupload.getInstance('#swfupload-control');

				$('#imagens li#'+file.id+' .remove').bind('click', function(){
					swfu.cancelUpload(file.id);
					$('#imagens li#'+file.id).slideUp('fast');
				});
				// start the upload since it's queued
				swfu.addFileParam(file.id,'id', file.id);
				swfu.addFileParam(file.id,'titulo','xaxaxaxaxaxaxaxaxax');
				swfu.addFileParam(file.id,'Descricao', 'descricao');
				

				$(this).swfupload('startUpload');
	})
	.bind('fileQueueError', function(event, file, errorCode, message){
		alert('O arquivo:'+file.name+'. Excedeu o limete de tamanho de 6000kb.');
	})
	.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
		num = numFilesSelected;
		if( numFilesSelected < opcoes.file_upload_limit ){
			addNota('Você tem direito de selecionar apenas '+opcoes.file_upload_limit+' arquivo(s). Arquivos selecionados: '+numFilesSelected+'.','Falha');
		}else{
			addNota('Arquivos selecionados: '+numFilesSelected+' / Quantidade de arquivos: '+numFilesQueued+' / Max: '+opcoes.file_upload_limit,'Nota');
			$("#imagens").append('<div class="clear"></div>')
		}
	})
	.bind('uploadStart', function(event, file){
		
		$(".currentFile").slideDown();
		$("#imagens li.currentFile").find('strong').text(file.name)
		$("#imagens li.currentFile .fileProcess .fileProgress").html('<span>0 of '+(file.size)+'MB</span> - <span>0KB/sec</span> - <span>0 min</span>');
		
	})
	.bind('uploadProgress', function(event, file, bytesLoaded){
		//Show Progress
		bytesLoaded = Math.round((Number(bytesLoaded)/ 1024));
		file.size = Math.round((Number(file.size)/ 1024));
		var percentage= Math.round((bytesLoaded/file.size)*100);
		percentage = (percentage > 100)?100:percentage;
		var startTime = new Date();
		timeDiff = +new Date() - startTime;
		vel = (bytesLoaded / timeDiff);
		$("#imagens li.currentFile .fileProcess .fileProgress").html('<span>'+(bytesLoaded)+' of '+(file.size)+'Kb</span> <span>'+vel+'KB/sec</span> <br> <span>'+(percentage > 0 ? Math.round(timeDiff / percentage / 1000 * (1 - percentage)) + " seconds remaining." : "Uploading...")+'</span>')
		
		$("#progresso").animate({width: percentage+'%'}).stop(true,true).attr('title',percentage+'%')
		
	})
	.bind('uploadSuccess', function(event, file, serverData){
		var item=$('#imagens li#'+file.id);
		$("#imagens li#"+file.id+" .img-nome").click(function(){
			$(this).next('div').slideToggle()
		})

		$('#imagens li#'+file.id+'>div span.fileName').removeClass('fileError').addClass('fileSuccess');
			
			processed = 
			'<div class="fileProcessed">'+
				'<div class="myPic grid3"><img src="images/user.png" alt="" /></div>'+
				'<div class="myInfo grid8">'+
					
					'<h6>'+
						'<span>Titulo Imagem</span>'+  
						'<a href="#" class="icona" onClick="return editValor(this);" data-icon="&#xe1ac;" style="margin-left:5px;" ></a>'+
						'<input  class="img-valor" name="imagem['+file.id+'][titulo]" value="" style="display:none;" onBlur="return setValor(this)" />'+
					'</h6>'+
					'<div class="myRole ">'+
						'<span>Descricao. Clique para digitar o texto  </span>'+
						'<a href="#" data="img-descricao" class="icona" onClick="return editValor(this);" data-icon="&#xe1ac;" style="margin-left:5px;"></a>'+
						'<textarea class="img-valor" name="imagem['+file.id+'][descricao]" onBlur="return setValor(this)"  style="display:none;"></textarea>'+
				    '</div>'+
					'<span class="followers"><i class="icos-paperclip"></i>'+ Math.round(Number(file.size)/ 1024)+
						' KB</span>'+
				'</div><span class="clear"></span>'+
			'</div>';
		item.append(processed);
		fileProcessed = item.find('.fileProcessed');
		fileProcessed.hide()
		fileProcessed.find('img').attr({src:'upload.php?img='+file.id,width:'90px'});
	})
	.bind('uploadComplete', function(event, file){
		// upload has completed, try the next one in the queue
		qtd_li = $("#imagens").find("li .fileProcessed").size()
		if(num==qtd_li){
			addNota(file.name+' carregado com sucesso!','Sucesso');
			$(".currentFile").slideUp();
			//$("#SWFUpload_0").hide()
			//$("#volt").html('<input name="cancel" type="button" class="bot-gravar" value="Voltar" style="float:right;" onclick="javascript:history.back(1)">')
		}
		else
		{
			$(this).swfupload('startUpload');
		}
	});
	
	$(".currentFile").hide();
});

function setValor(obj){
	$input = $(obj);
	$span =  $(obj).parent().find('span');
	$link =  $(obj).parent().find('a');
	valor = ($input.val())? $input.val() : $input.text();
	
	$span.text(valor);
	$input.hide();
	$span.fadeIn();
	$link.fadeIn()
	return false;
}

function editValor(obj){
	$link = $(obj);
	$span = $link.parent().find('span');
	$input = $link.parent().find('.img-valor');
	texto = $span.text();
	$span.hide();
	$link.hide();
	
	($input.val(texto))? $input.val(texto) : $input.text(texto);
	$input.fadeIn().focus();

	return false;
}

function addNota(msg,type){
	//Notifications
	/*nNote = {
		erro:   'nWarning',
		nota:   'nInformation',
		sucesso:'nSuccess',
		falha:  'nFailure'
	};
	htm = '<div class="nNote '+nNote[type]+'" style="margin-top:0px">'+
				'<p>'+msg+'</p>'+
			'</div>';
			
	return $("#notificacao").html(htm);*/
	$.jGrowl(msg, { header: type });
	
}
/*
function Sele(id){
	
		$("#"+id).find('div').toggleClass("check");
		check = $("#"+id).find('div input').attr("checked");
		if(check == true){
			$("#"+id).find('div input').attr("checked",false);
			$("#"+id).removeClass('degrade_vermelho');
			$("#"+id).addClass('degrade_preto');
		}
		if(check == false){
			$("#"+id).find('div input').attr("checked",true);
			$("#"+id).removeClass('degrade_preto');
			$("#"+id).addClass('degrade_vermelho');
		}
}*/
</script>
<style type="text/css">
#SWFUpload_0{
	margin:3px;
	float:right;
}
.img-nome{
	cursor:pointer;
}
.currentFile{
	display:none;
}
</style>


<link href="css/styles.css" rel="stylesheet" type="text/css" />
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Fornecedores</span>
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><strong class="blue">5489</strong><span>Visitas realizadas</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>Clientes</span></div>
            </li>
            <li>
                <a href="" class="greenImg"><img src="images/icons/quickstats/money.png" alt="" /></a>
                <div class="floatR"><strong class="blue">1289</strong><span>Produtos</span></div>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="?pg=home">Painel de Controle</a></li>
                <li><a href="?cat=cadastros&pg=fornecedor">Fornecedores</a>
                </li>
            </ul>
        </div>
        
        <div class="breadLinks">
            <ul>
                <!--<li><a href="#" title=""><i class="icos-list"></i><span>Lista clientes</span> <strong>(+58)</strong></a></li>-->
                <li class="has">
                    <a title="">
                        <i class="icos-cog4"></i>
                        <span>Opções</span>
                        <span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
                    </a>
                    <ul>
                        <li><a href="?cat=cadastros&pg=fornecedor&add=true" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="?cat=cadastros&pg=fornecedor&list=true" title=""><span class="icos-archive"></span>Lista</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
        <div class="fluid">
            <div class="grid6">
              <div class="widget" id="swfupload-control">
                    <div class="whead">
                        <h6>Upload de arquivos</h6>
                        <a href="#" id="button" class="buttonH bBlack" title="">Selecionar</a>
                        <div class="clear"></div>
                    </div>
              
                    <ul class="tbar">
                        <li><a href="#" title=""><span class="icos-upload"></span>Salvar</a></li>
                        <li><a href="#" title=""><span class="icos-pacman"></span>Limpar Cache</a></li>
                        <li><a href="#" title=""><span class="icos-archive"></span>Excluir tudo</a></li>
                    </ul>
                    <input id="cod" name="cod" type="hidden" value="12" />
                    <div id="notificacao"></div>
            
                    <ul id="imagens" class="filesDown">
                        <li class="currentFile">
                            <div class="fileProcess">
                                <img src="images/elements/loaders/10s.gif" alt="" class="loader" />
                                <strong>Nome do arquivo</strong>
                                <div class="fileProgress">
                                    <span>0 of 0MB</span> - <span>0KB/sec</span> - <span>0 min</span>
                                </div>
                                
                                <div class="contentProgress"><div id="progresso" class="barG tipN" title="0%"></div></div>
                                <ul class="ruler">
                                    <li>0</li>
                                    <li class="textC">50%</li>
                                    <li class="textR">100%</li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                        </li>
                        <div class="clear"></div>
                    </ul>
            </div>
            </div>
            </div>        
        </div>  
    </div>

    




