jQuery(document).ready(function(){ 

	moment.locale('pt-br');

	var url_atual = window.location.href;

	if(url_atual.indexOf("order-flights") != -1){

		jQuery("#celularTitular").mask("(99) 99999-9999");
		jQuery("#cpfTitular").mask("999.999.999-99");
		jQuery("#cep").mask("99999-999");

		set_details__flights();
		set_pax();

		var adt = JSON.parse(localStorage.getItem("ADULTOS_FLIGHT")); 
		for(var x = 0; x < adt; x++){  
			jQuery("#nasc_adt_"+x).mask("99/99/9999");
		} 
 
		var chd = JSON.parse(localStorage.getItem("CRIANCAS_FLIGHT")); 
		if(chd > 0){
			for(var x = 0; x < chd; x++){  
				jQuery("#nasc_chd_"+x).mask("99/99/9999");
			} 
		}

	}

});

function set_details__flights(){
	var xx = new Intl.NumberFormat('pt-BR', { 
	  	currency: 'BRL',
	  	minimumFractionDigits: 2,
	  	maximumFractionDigits: 2
	});
 
	jQuery(".data_order").html(localStorage.getItem("DESC_PAX"));
	jQuery(".price_without_tax").html('<span class="currency" style="font-size:13px">R$</span> '+localStorage.getItem("PRICE_WITHOUT_TAX"));
	jQuery(".value_without_tax").html("R$ "+localStorage.getItem("TOTAL_PRICE_WITHOUT_TAX"));
	jQuery(".tax").html("R$ "+localStorage.getItem("TOTAL_TAX"));
	jQuery(".value_total").html('<span class="currency">R$</span> '+localStorage.getItem("TOTAL_PRICE"));

	jQuery(".resume-price").removeClass("row-is-loading");

	var data_checkin = JSON.parse(localStorage.getItem("SELECTED_FLIGHT_TRECHO1"));
	jQuery(".checkin").html(data_checkin.checkin);
	jQuery(".hour-flight-ida").html(data_checkin.horaIda);

	var desc_type_trip = '<i class="fa fa-plane"></i> Somente ida';

	if(localStorage.getItem("SELECTED_FLIGHT_TRECHO5") !== null){
		var data_checkout = JSON.parse(localStorage.getItem("SELECTED_FLIGHT_TRECHO5"));
		desc_type_trip = '<i class="fa fa-plane"></i> Multitrecho';
	}else if(localStorage.getItem("SELECTED_FLIGHT_TRECHO4") !== null){
		var data_checkout = JSON.parse(localStorage.getItem("SELECTED_FLIGHT_TRECHO4"));
		desc_type_trip = '<i class="fa fa-plane"></i> Ida e Volta';
	}else if(localStorage.getItem("SELECTED_FLIGHT_TRECHO3") !== null){
		var data_checkout = JSON.parse(localStorage.getItem("SELECTED_FLIGHT_TRECHO3"));
		desc_type_trip = '<i class="fa fa-plane"></i> Ida e Volta';
	}else if(localStorage.getItem("SELECTED_FLIGHT_TRECHO2") !== null){
		var data_checkout = JSON.parse(localStorage.getItem("SELECTED_FLIGHT_TRECHO2"));
		desc_type_trip = '<i class="fa fa-plane"></i> Ida e Volta';
	}

	jQuery(".checkout").html(data_checkout.checkin);
	jQuery(".hour-flight-volta").html(data_checkin.horaVolta);

	if(data_checkin.bagagem == "<i aria-hidden=\"true\" class=\"fas fa-luggage-cart\" style=\"color: #cfcfcf;\"></i>"){
		var desc_bagagem = 'Não possui bagagem';
	}else{
		var desc_bagagem = 'Possui bagagem despachada'; 
	}
	jQuery(".detail_trip").html(data_checkin.paradas+'<br>'+data_checkin.bagagem+' '+desc_bagagem+'<br>'+desc_type_trip+'<br> <img src="'+data_checkin.logoCompanhia+'" style="height:20px;display:inline"> '+data_checkin.companhia);

	jQuery(".detail").removeClass("row-is-loading");

	if(jQuery("#type_reserva_flights").val() == 2){ 
  
		var price = localStorage.getItem("TOTAL_PRICE").replace(".", "").replace(",", ".");

		var installments = "";
		for(var i = 1; i < 12; i++){
			if(i == 1){
				var option_name = 'À vista no valor de R$ '+xx.format(price);
			}else{
				var option_name = 'Em '+i+' vezes no valor de R$ '+xx.format((price/i))+' cada parcela';
			}
			installments += '<option value="'+i+';'+(price/i)+'" '+(i == 1 ? 'selected' : '')+'>'+option_name+'</option>';
		}
		jQuery("#installments").html(installments); 

	}

}



function set_pax(){

	var retorno = "";

	var adt = JSON.parse(localStorage.getItem("ADULTOS_FLIGHT")); 
	var contador = 0;
	for(var x = 0; x < adt; x++){  
 
		var count_adt = x+1;

		retorno += '<p class="guest">Adulto '+count_adt+'</p>  '; 
		retorno += '<div class="row"> ';
			retorno += '<div class="col-lg-4 col-12"> ';
				retorno += '<label>Nome</label> ';
				retorno += '<div class="input-group mb-4"> ';
				  	retorno += '<div class="input-group-prepend"> ';
				    	retorno += '<i class="fa fa-user"></i> ';
				  	retorno += '</div> ';
				  	retorno += '<input type="text" id="nome_adt_'+x+'" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1"> ';
				retorno += '</div> ';
			retorno += '</div> ';
			retorno += '<div class="col-lg-4 col-12"> ';
				retorno += '<label>Sobrenome</label> ';
				retorno += '<div class="input-group mb-4"> ';
				  	retorno += '<div class="input-group-prepend"> ';
				    	retorno += '<i class="fa fa-user"></i> ';
				  	retorno += '</div> ';
				  	retorno += '<input type="text" id="sobrenome_adt_'+x+'" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1"> ';
				retorno += '</div> ';
			retorno += '</div> '; 
			retorno += '<div class="col-lg-4 col-12"> ';
				retorno += '<label>Nascimento</label> ';
				retorno += '<div class="input-group mb-4"> ';
				  	retorno += '<div class="input-group-prepend"> ';
				    	retorno += '<i class="fa fa-calendar"></i> ';
				  	retorno += '</div> ';
				  	retorno += '<input type="text" id="nasc_adt_'+x+'" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1"> ';
				retorno += '</div> ';
			retorno += '</div> ';
		retorno += '</div>  '; 

	}
					 

	var chd = JSON.parse(localStorage.getItem("CRIANCAS_FLIGHT")); 
	var contador = 0;
	if(chd > 0){
		for(var x = 0; x < chd; x++){  
 
			var count_chd = x+1;

			retorno += '<p class="guest">Adulto '+count_chd+'</p>  '; 
			retorno += '<div class="row"> ';
				retorno += '<div class="col-lg-4 col-12"> ';
					retorno += '<label>Nome</label> ';
					retorno += '<div class="input-group mb-4"> ';
					  	retorno += '<div class="input-group-prepend"> ';
					    	retorno += '<i class="fa fa-user"></i> ';
					  	retorno += '</div> ';
					  	retorno += '<input type="text" id="nome_adt_'+x+'" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1"> ';
					retorno += '</div> ';
				retorno += '</div> ';
				retorno += '<div class="col-lg-4 col-12"> ';
					retorno += '<label>Sobrenome</label> ';
					retorno += '<div class="input-group mb-4"> ';
					  	retorno += '<div class="input-group-prepend"> ';
					    	retorno += '<i class="fa fa-user"></i> ';
					  	retorno += '</div> ';
					  	retorno += '<input type="text" id="sobrenome_adt_'+x+'" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1"> ';
					retorno += '</div> ';
				retorno += '</div> '; 
				retorno += '<div class="col-lg-4 col-12"> ';
					retorno += '<label>Nascimento</label> ';
					retorno += '<div class="input-group mb-4"> ';
					  	retorno += '<div class="input-group-prepend"> ';
					    	retorno += '<i class="fa fa-calendar"></i> ';
					  	retorno += '</div> ';
					  	retorno += '<input type="text" id="nasc_adt_'+x+'" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1"> ';
					retorno += '</div> ';
				retorno += '</div> ';
			retorno += '</div>  '; 

		}
	}

	jQuery("#set_room").html(retorno);

}



function send_order_flights(type_reserva){ 

	var nomeTitular = jQuery("#nomeTitular").val();
	var emailTitular = jQuery("#emailTitular").val();
	var celularTitular = jQuery("#celularTitular").val().replace("(", "").replace(")", "").replace(" ", "").replace("-", "");
	var cpfTitular = jQuery("#cpfTitular").val().replace(".", "").replace(".", "").replace(".", "").replace("-", ""); 

	var room = []; 
 
	var adt = JSON.parse(localStorage.getItem("ADULTOS_FLIGHT")); 
	for(var i = 0; i < adt; i++){ 
		var innerPax = [];

		var nomepax = jQuery("#nome_adt_"+i).val();
		var sobrenomepax = jQuery("#sobrenome_adt_"+i).val();
		var emailpax = jQuery("#emailTitular").val();
		var nascpax = jQuery("#nasc_adt_"+i).val();

		if(nomepax == ""){
			swal({
	            title: "É necessário preencher o nome do pax.",
	            icon: "warning",
	        }); 
	        return false;
		}else if(sobrenomepax == ""){
			swal({
	            title: "É necessário preencher o sobrenome do pax.",
	            icon: "warning",
	        }); 
	        return false;
		}else if(nascpax == ""){
			swal({
	            title: "É necessário preencher a data de nascimento do pax.",
	            icon: "warning",
	        }); 
	        return false;
		}else{ 
			innerPax.push({
	            name: nomepax, 
	            lastName: sobrenomepax, 
	            email: emailpax, 
	            age: 20, 
	            type: "AD"
	        });
		}
	} 
	room.push({roomsPassenger: innerPax}); 

	var chd = JSON.parse(localStorage.getItem("CRIANCAS_FLIGHT")); 
	if(chd > 0){
		for(var i = 0; i < chd; i++){ 
			var innerPax = [];

			var nomepax = jQuery("#nome_chd_"+i).val();
			var sobrenomepax = jQuery("#sobrenome_chd_"+i).val();
			var emailpax = jQuery("#emailTitular").val();
			var nascpax = jQuery("#nasc_chd_"+i).val();

			if(nomepax == ""){
				swal({
		            title: "É necessário preencher o nome do pax.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(sobrenomepax == ""){
				swal({
		            title: "É necessário preencher o sobrenome do pax.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(nascpax == ""){
				swal({
		            title: "É necessário preencher a data de nascimento do pax.",
		            icon: "warning",
		        }); 
		        return false;
			}else{ 
				innerPax.push({
		            name: nomepax, 
		            lastName: sobrenomepax, 
		            email: emailpax, 
		            age: 4, 
		            type: "CH"
		        });
			}
		} 
		room.push({roomsPassenger: innerPax}); 
	}

	if(type_reserva == 2){
		var cep = jQuery("#cep").val().replace("-", "");
		var endereco = jQuery("#endereco").val();
		var numero = jQuery("#numero").val();
		var complemento = jQuery("#complemento").val();
		var bairro = jQuery("#bairro").val();
		var cidade = jQuery("#cidade").val();
		var estado = jQuery("#estado").val();

		if(cep == ""){
	        swal({
	            title: "É necessário preencher o CEP.",
	            icon: "warning",
	        }); 
	        return false;
	    }else if(endereco == ""){
	        swal({
	            title: "É necessário preencher o endereço.",
	            icon: "warning",
	        }); 
	        return false;
	    }else if(numero == ""){
	        swal({
	            title: "É necessário preencher o número.",
	            icon: "warning",
	        }); 
	        return false;
	    }else if(bairro == ""){
	        swal({
	            title: "É necessário preencher o bairro.",
	            icon: "warning",
	        }); 
	        return false;
	    }else if(cidade == ""){
	        swal({
	            title: "É necessário preencher a cidade.",
	            icon: "warning",
	        }); 
	        return false;
	    }else if(estado == ""){
	        swal({
	            title: "É necessário preencher o estado.",
	            icon: "warning",
	        }); 
	        return false;
	    }
	}

	var nameReserva = nomeTitular.split(" "); 

	if(nomeTitular == ""){
        swal({
            title: "É necessário preencher o nome do titular da reserva.",
            icon: "warning",
        }); 
        return false;
    }else if(emailTitular == ""){
        swal({
            title: "É necessário preencher o e-mail do titular da reserva.",
            icon: "warning",
        }); 
        return false;
    }else if(celularTitular == ""){
        swal({
            title: "É necessário preencher o celular do titular da reserva.",
            icon: "warning",
        }); 
        return false;
    }else if(cpfTitular == ""){
        swal({
            title: "É necessário preencher o CPF do titular da reserva.",
            icon: "warning",
        }); 
        return false;
    }else{ 

    	jQuery(".btnSelect").html('<img src="https://media.tenor.com/images/a742721ea2075bc3956a2ff62c9bfeef/tenor.gif" style="height: 22px;position:absolute;"> Finalizando...');
	    jQuery(".btnSelect").attr("disabled", "disabled");
	    jQuery(".btnSelect").prop("disabled", true);

		var jsonReserva = '{ "data": { "attributes": {"name": "'+nameReserva[0]+'", "lastName": "'+nameReserva[1]+'", "email": "'+emailTitular+'", "phone": '+celularTitular+', "passengers": '+JSON.stringify(room)+', "paymentsTypes": "invoice_only_daily", "customerName": "'+nomeTitular+'", "costumerEmail": "'+emailTitular+'", "customerIdentity": "'+cpfTitular+'", "customerAddress": "'+endereco+'", "customerState": "'+estado+'", "customerCity": "'+cidade+'", "customerPostalCode": "'+cep+'", "cutomerPhone": '+celularTitular+', "customerStreetComplement": "'+complemento+'" } } }'; 
		localStorage.setItem("ORDER_ACCEPTED", jsonReserva);

		if(type_reserva == 2){

	    	var holder = jQuery("#holder-card").val();
			var number = jQuery("#number-card").val();
			var month = jQuery("#mm-card").val();
			var year = jQuery("#year-card").val();
			var cvc = jQuery("#cvc-card").val();

			if(holder == ""){
				swal({
		            title: "É necessário preencher o titular do cartão.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(number == ""){
				swal({
		            title: "É necessário preencher o número do cartão.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(month == ""){
				swal({
		            title: "É necessário preencher o mês.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(year == ""){
				swal({
		            title: "É necessário preencher o ano.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(year < 23){
				swal({
		            title: "É necessário preencher o ano da forma correta.",
		            icon: "warning",
		        }); 
		        return false;
			}else if(cvc == ""){
				swal({
		            title: "É necessário preencher o CVC.",
		            icon: "warning",
		        }); 
		        return false;
			}else{

			}
		}else{ 
			window.location.href = '/confirm-order-flights/';
		}

    }
} 