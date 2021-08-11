/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
	



$(document).ready(function(){
   
    var monitoramento;
    var tratamento_quimico;
    var visita_gestor;
    var visita_extras;
    var total_hora;
    var total_visita;
    var recursos_materiais;
    var mao_de_obra;
    var deslocamento;
	
    var valor = {};
   
   
   $("#linha_0,#linha3_0,#linha2_0").hide()
   $.ajax({
        type: "GET",
        url: "orcamentos/functions.php",
        async: false,
        data: {valores:'true'},
        dataType: "json",
        success:function(retorno){
            /*
            var valor = {
                refeicao       : VAL_refeicao;
                hora_operador  : VAL_dia_operador;
                dia_hotel      : VAL_hotel;
                hora_gestor    : VAL_dia_gestor;
                km             : VAL_km;
                mat_escritorio : VAL_material_escritorio;
                lucro          : VAL_lucro;
            };
             */
           valor = retorno;
        }
    });

    $("#FOR_tipo_pgto").change(function(){
      val = $(this).val();
      if(val == 'PARCELADO'){
          $('#pagamento').show();
      }else{
          $("#pagamento").hide();
      }
    })
    
    $("#FOR_num_parcelas").blur(function(){
        n_parcelas = $(this).val();
        t_pagamento = $("#FOR_total").val() / n_parcelas;
		tTotal = t_pagamento.toFixed(2);
        $("#FOR_valor_parcela").val(tTotal);
    })
    
    // valores administrativos
    $("#FOR_administracao_valor").val(valor.mat_escritorio);
    
    
    $(".qtd_dias_hotel").hide();
    $("#qtd_dias_hotel").enable(false);
    $("#todos_dias").click(function(){
        if($(this).is(":checked")){
            $(".qtd_dias_hotel").fadeOut();
            $("#qtd_dias_hotel").enable(false);
        }else{
            $(".qtd_dias_hotel").fadeIn();
            $("#qtd_dias_hotel").enable(true);
        }
        formar_preco(valor)
    });
    
    $("#hotel").click(function(){
        
        if($(this).is(":checked")){
            $("#cobra_hotel").fadeIn();
        }else{
            $("#cobra_hotel").fadeOut();
        }
        formar_preco(valor)
    })

   
	var i_list = $('.linha').length;
	$(".addRecurso_tab1").on('click',function(){
                //alert($("#ve").val());
		rec = {

			nAplic : $("#nAplic").val(),
			ambiente: $("#ambiente").val(),
			ep : {id:$("#ep").attr('data-valor'),nome:$("#ep").val()},
			ve : $("#ve").val(),
			ni : $("#ni").val(),
			te : $("#te").val()
		};
		json = JSON.stringify(rec);
		//alert(rec.ve)
		linha = '<tr id="linha_'+i_list+'" class="linha odd">'+
                    '<td class="sorting_1 noBorderB"></td>'+
                    '<td class="noBorderB">'+rec.ambiente+'</td>'+
                    '<td class="noBorderB">'+rec.ep.nome+'</td>'+
                    '<td class="noBorderB">'+rec.ve+'</td>'+
                    '<td class="noBorderB">'+rec.ni+'</td>'+
                    '<td class="noBorderB">'+rec.te+'</td>'+
                    '<td class="noBorderB">'+rec.nAplic+'</td>'+
                    '<td class="noBorderB">'+
                        '<textarea name="orcamento[recursos_materiais][REC_dados_recursos][]" style="display:none;">'+json+'</textarea>'+
                        '<ul class="btn-group toolbar">'+
                                        '<li><a href="#"  onclick="return removeLinha(\'linha_'+i_list+'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon=""></span></a></li>'+
                        '</ul>'+ 
                    '</td>'+
		'</tr>';
		
		$(".recursos_tab1 tbody").append(linha);
		i_list++;
		return false
	})
	
	
	var i_list2 = $('.linha2').length;
	$(".addRecurso_tab2").click(function(){
		
		
		rec = {
			valor: $("#FOR_valor_adicional").val(),
			descricao : $("#FOR_valor_adicional_descricao").val()
		};
		json = JSON.stringify(rec);
		linha = '<tr id="linha2_'+i_list2+'" class="linha2 odd">'+
					'<td class="sorting_1 noBorderB"></td>'+
					'<td class="noBorderB">'+rec.valor+'</td>'+
					'<td class="noBorderB">'+rec.descricao+'</td>'+
					'<td class="noBorderB">'+
							'<textarea name="orcamento[formacao_preco][FOR_valores_adicionais][]" style="display:none;">'+json+'</textarea>'+
							'<ul class="btn-group toolbar">'+
									'<li><a href="#"  onclick="return removeLinha(\'linha2_'+i_list2+'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon=""></span></a></li>'+
							'</ul>'+ 
					'</td>'+
				'</tr>';
		$(".recursos_tab2 tbody").append(linha);
		i_list2++;
		
		formar_preco(valor)
		
		return false
	})
	
	var rec_material = new Array;
	var i_list3 = $('.linha3').length;

	$(".addRecurso_tab3").click(function(){
		
		estoque  =  $('#recursos_materiais_PRO_id').find('option:selected').attr('estoque');
		cliente  =  $('#recursos_materiais_PRO_id').find('option:selected').attr('cliente');
		unid     =  $('#recursos_materiais_PRO_id').find('option:selected').attr('unid');
		valor_material  =  $('#recursos_materiais_PRO_id').find('option:selected').attr('valor');
		rec = {
			id: $('#recursos_materiais_PRO_id').find('option:selected').attr('proId'),
			produto: $("#recursos_materiais_PRO_id").val(),
			qtd : $("#REC_qtd_produto").val(),
			nAplic : $("#REC_nAplic_produto").val(),
			med: (estoque*cliente)+' '+unid,
			valor: valor_material
		};
		json = JSON.stringify(rec);
		
		rec_material.push(rec);
		v = Number(rec.valor);
		vT =(rec.valor*rec.qtd);
		linha = '<tr id="linha3_'+i_list3+'" class="linha3 odd">'+
					'<td class="noBorderB">'+rec.produto+'<input type="hidden" name="id[]" value="'+rec.id+'"/></td>'+
					'<td class="noBorderB" class="rec_qtd">'+rec.qtd+'</td>'+
					'<td class="noBorderB">'+rec.nAplic+'</td>'+
					'<td class="noBorderB">'+rec.med+'</td>'+
					'<td class="noBorderB" class="rec_valor">'+v.toFixed(2)+'</td>'+
					'<td class="noBorderB" class="">'+vT.toFixed(2)+'</td>'+
					'<td class="noBorderB">'+
							'<textarea name="orcamento[recursos_materiais][REC_dados_recursos_produtos][]" style="display:none;">'+json+'</textarea>'+
							'<ul class="btn-group toolbar">'+
									'<li><a href="#"  onclick="return removeLinha(\'linha3_'+i_list3+'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon=""></span></a></li>'+
							'</ul>'+ 
					'</td>'+
				'</tr>';
		$(".recursos_tab3 tbody").append(linha);
		i_list3++;
		//$(document).reload()
		formar_preco(valor)
		
		return false
	})
	
	
      

    $(".frequencia,#FOR_tipo_desconto").chosen().change(function(){
         formar_preco(valor) 
    })
        
    $(".duracao_visita,#FOR_num_operadores,#FOR_distancia,#qtd_dias_hotel,.total-form-preco,#FOR_desconto").blur(function(){
        formar_preco(valor)
    })
    
		
})

function exibeMsg(tipo,msg){
	
	switch (tipo){
		case 'erro' : 
			tipo = 'nFailure';
		break;
		case 'atencao' : 
			tipo = 'nWarning';
		break;
		case 'info' : 
			tipo = 'nInformation';
		break;
		case 'sucesso' : 
			tipo = 'nSuccess';
		break;
	}
	
	msgHtml = '<div class="nNote '+tipo+'">'+
                '<p>'+msg+'</p>'+
            '</div>';
	$("#content .wrapper").prepend(msgHtml);
}

function seg_em_horas(segs){
    h_ = Math.floor( Number(segs)/3600 );
    m_ = Math.floor( Number(segs)%3600 );
    m_ = (m_ / 60)/60;
    qtd_hora = (h_+m_)
    return qtd_hora;
}


/**
 *
 *
 * FORMAÇÃO DE PREÇO
 *
*/

// CALCULAR TUDO
function formar_preco(valor){
    valor_material = calcula_material_direto();
    $("#FOR_material_direto").val(valor_material);
    
    valor_maoObra = calcula_mao_obra(valor);
    $("#FOR_mao_obra").val(valor_maoObra);
    
    valor_deslocamento = calcula_deslocamento(valor);
    $("#FOR_deslocalmento").val(valor_deslocamento);
    
    valor_extra = calcula_extras()
    $("#FOR_outras_despesas").val(valor_extra)
    
    soma = getSoma();
    
    $("#FOR_total_despesas").val(soma)

    // comissão opoeradores                                         // porcentagem
    comissao_operador = Math.floor($("#FOR_num_operadores").val() * ( soma * (valor.comissao/100)));
    $("#FOR_comissao_valor").val(comissao_operador)
    // LUCRO
    lucro = Math.floor(soma * (valor.lucro / 100));
    $("#FOR_lucro").val(lucro)
    // soma total
    //alert(Number(comissao_operador) +'+'+ Number(lucro) +'+'+ Number(soma));
    total  = Number(comissao_operador)+ Number(lucro)+ Number(soma);
    if( $("#FOR_desconto").val() > 0){
        if($("#FOR_tipo_desconto").val() == 'porcentagem'){
		   des = $("#FOR_desconto").val();
		   if($.isNumeric(des)){
			   desc = des;
		   }else{desc = 0;}
           desconto = total - (total*(desc / 100));
        }else{
           desconto = total - desc;
        }
        $("#FOR_total_negociado").val(desconto.toFixed(2))
    }else{
        desconto = total;
    }
    
	
    
    $("#total>b").text(desconto.toFixed(2))
    $("#FOR_total").val(desconto.toFixed(2))
    $("#FOR_total_sugerido").val(total.toFixed(2))
	
	n_parcelas = $("#FOR_num_parcelas").val();
	t_pagamento = $("#FOR_total").val() / n_parcelas;
	tTotal = t_pagamento.toFixed(2);
    $("#FOR_valor_parcela").val(tTotal);    
}

function getSoma(){
    somatoria = 0;
    $(".demostrativo").find('.total-form-preco').each(function() {
        num = $(this).val();
        if(!isNaN(num)){
            //alert(somatoria +'+='+ Number(num));
            somatoria += Number(num);
        }
    });
    return somatoria;
}

// MATERIAL DIRETO
function calcula_material_direto(){
    //recursos_materiais
    
    var valorr = 0;
    $(".recursos_tab3").find('textarea').each(function() {
		arr = $(this).val();
        if(ar = JSON.parse(arr)){
            valorr += (ar.qtd * ar.valor);
        }
    });
    $("#total_recursos>b").text(valorr);
    $("#total_recursos>input").val(valorr);
    return valorr;
}

// MÃO DE OBRA
function calcula_mao_obra(valor){
    
      /*
       * CALCULA MONITORAMENTO
       */
       monitoramento  = {
            f : getFrequencia("#CON_monitoramento"),
            h : getHora("#CON_duracao_visita") * getFrequencia("#CON_monitoramento"),
            valor : 0
       };
       qtd_operadores = $("#FOR_num_operadores").val();
        if(qtd_operadores.length > 0){
            //horas de monitoramento
            qtd_hora_monitoramento = seg_em_horas(monitoramento.h)
            // quantidade de operador X valor da hora do operador X a quantidade de horas de monitoramento
            if(valor.hora_operador > 0){
                valor_operador = (qtd_operadores * valor.hora_operador * qtd_hora_monitoramento);
            }
            if(valor.dia_hotel > 0){
                if($("#hotel").is(":checked")){
                  if($("#todos_dias").is(":checked")){
                    valor_hotel_operador = qtd_operadores * valor.dia_hotel * monitoramento.f
                  }else{
                    valor_hotel_operador = qtd_operadores * valor.dia_hotel * $("#qtd_dias_hotel").val();
                  }
                }else{
                    valor_hotel_operador = 0;
                }
            }
            if(valor.refeicao > 0){
                valor_refeicao = qtd_operadores * valor.refeicao * monitoramento.f
            }   
            
            valTotal_monitoramento = (valor_operador+valor_hotel_operador+valor_refeicao);
            monitoramento.valor = valTotal_monitoramento;
           //alert('monitoramento: '+valor_operador+'+'+valor_hotel_operador+'+'+valor_refeicao+'='+valTotal_monitoramento);
        }
               
        /*
         * CALCULA TRATAMENTO QUÍMICO
         */
        tratamento_quimico  ={
            f : getFrequencia("#CON_tratamento_quimico"),
            h : getHora("#CON_tratamento_quimico_duracao")* getFrequencia("#CON_tratamento_quimico"),
            valor : 0
        };
        //horas de tratamento quimico
        qtd_hora_tratamento_quimico = seg_em_horas(tratamento_quimico.h)
        // valor da hora do operador X a quantidade de horas do tratamento quimico
        tratamento_quimico.valor = valor.hora_operador * qtd_hora_tratamento_quimico;
        
        
        /*
         * CALCULA VISITA DO GESTOR
        */
        visita_gestor      = {
            f : getFrequencia("#CON_visita_gestor"),
            h : getHora("#CON_visita_gestor_duracao") * getFrequencia("#CON_visita_gestor"),
            valor : 0
        };
        //horas de visita gestor
        qtd_hora_visita_gestor = seg_em_horas(visita_gestor.h)
        // valor da hora do GESTOR X a quantidade de horas da visita
        visita_gestor.valor = (valor.hora_gestor * qtd_hora_visita_gestor);    
        //alert('visita do gestor: '+visita_gestor.valor);

        /*
         * CALCULA A QUANTIDADE DE VISITAS EXTRAS
         */
        visita_extras       ={
            f : Number($("#CON_visitas_extras_qtd").val()),
            h : getHora("#CON_visitas_extras_horas") * Number($("#CON_visitas_extras_qtd").val()),
            valor : 0
        };
        //horas de visita gestor
        qtd_hora_visita_extras = seg_em_horas(visita_extras.h)
        // valor da hora do GESTOR X a quantidade de horas da visita
        visita_extras.valor = (valor.hora_operador * qtd_hora_visita_extras);    
        
        //alert(monitoramento.valor +'-'+ tratamento_quimico.valor +'-'+ visita_gestor.valor +'-'+ visita_extras.valor)
        
         total_hora     = Number(monitoramento.h) + Number(tratamento_quimico.h) + Number(visita_gestor.h) + Number(visita_extras.h);
         total_visita   = Number(monitoramento.f) + Number(tratamento_quimico.f) + Number(visita_gestor.f) + Number(visita_extras.f);
         totalHora      = getTotalHora(total_hora);
         
         valor_servico  =  $('.servico').find('option:selected').attr('valor')
		 //alert(Number(valor_servico) +'+'+ Number(monitoramento.valor) +'+'+ Number(tratamento_quimico.valor) +'+'+ Number(visita_gestor.valor) +'+'+ Number(visita_extras.valor));
         mao_de_obra    = (Number(valor_servico) + Number(monitoramento.valor) + Number(tratamento_quimico.valor) + Number(visita_gestor.valor) + Number(visita_extras.valor));

         
         $("#FOR_total_visitas").val(total_visita);
         $("#FOR_total_duracao").val(totalHora);
         
         return mao_de_obra;
     
}

// DESLOCAMENTO
function calcula_deslocamento(valor){
    deslocamento =  $("#FOR_distancia").val() * valor.km;
    return deslocamento;
}

function calcula_extras(){
	
    var v_ext = 0;
    $(".recursos_tab2").find('textarea').each(function() {
        if($(this).val() != 'null'){
            arr = $(this).val()
            ar = JSON.parse(arr);
            v_ext = (Number(ar.valor)+Number(v_ext));
        }
    });

    $("#total_extras>b").text(v_ext)
    $("#total_extras>input").val(v_ext)

    return v_ext;
}

function getTotalHora(totalHora){
    
    qtd_h = Math.floor( Number(totalHora)/3600 );
    qtd_m = Math.floor( Number(totalHora)%3600 );
    qtd_m = qtd_m/60;

    if(qtd_h < 10){qtd_h = '0'+qtd_h;}
    if(qtd_m < 10){qtd_m = '0'+qtd_m;}

   return qtd_h+':'+qtd_m
}

function getHora(hora){
    h = $(hora).val()
    if(h.length > 0){
        dh = h.split(':')
        
        hor = Number(dh[0]) * 3600; // hora em segundos
        min  = Number(dh[1]) * 60; // minutos em segundos
        
        x = Number(hor)+Number(min);
        
    }else{
        x = 0;
    }
    return x
}


function getFrequencia(obj){
    frequencia = $(obj).val();
    if(frequencia.length > 0){
        qtd_meses = $("#duracao").val();

        x = Math.floor( (Number(qtd_meses)*30.41666666666667)/Number(frequencia) );

    }else{
        x = 0;
    }
    return x;
}

