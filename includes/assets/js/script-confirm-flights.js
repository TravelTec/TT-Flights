jQuery(document).ready(function(){ 



	moment.locale('pt-br');



	var url_atual = window.location.href;



	if(url_atual.indexOf("confirm-order-flights") != -1){

		list_data_confirmation_flights();

	}



});

function list_data_confirmation_flights(){  
	var selected = JSON.parse(localStorage.getItem("SELECTED_FLIGHT_TRECHO1"));
	var order_accepted = JSON.parse(localStorage.getItem("ORDER_ACCEPTED")); 

	var xx = new Intl.NumberFormat('pt-BR', { 

	  	currency: 'BRL',

	  	minimumFractionDigits: 2,

	  	maximumFractionDigits: 2

	});

	if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 2){
		var destino = localStorage.getItem("DESTINO_FLIGHT").split(",");
		var checkin = localStorage.getItem("DATE_CHECKIN");
		var checkout = localStorage.getItem("DATE_CHECKOUT");
	}else if(localStorage.getItem("DESTINO_FLIGHT_TRECHO2") != null){
		var destino = localStorage.getItem("DESTINO_FLIGHT_TRECHO2").split(",");
		var checkin = localStorage.getItem("DATE_CHECKIN_TRECHO2");
		var checkout = localStorage.getItem("DATE_CHECKOUT_TRECHO2");
	}else if(localStorage.getItem("DESTINO_FLIGHT_TRECHO3") != null){
		var destino = localStorage.getItem("DESTINO_FLIGHT_TRECHO3").split(",");
		var checkin = localStorage.getItem("DATE_CHECKIN_TRECHO3");
		var checkout = localStorage.getItem("DATE_CHECKOUT_TRECHO3");
	}else if(localStorage.getItem("DESTINO_FLIGHT_TRECHO4") != null){
		var destino = localStorage.getItem("DESTINO_FLIGHT_TRECHO4").split(",");
		var checkin = localStorage.getItem("DATE_CHECKIN_TRECHO4");
		var checkout = localStorage.getItem("DATE_CHECKOUT_TRECHO4");
	}else if(localStorage.getItem("DESTINO_FLIGHT_TRECHO5") != null){
		var destino = localStorage.getItem("DESTINO_FLIGHT_TRECHO5").split(",");
		var checkin = localStorage.getItem("DATE_CHECKIN_TRECHO5");
		var checkout = localStorage.getItem("DATE_CHECKOUT_TRECHO5");
	}

	jQuery("#local_reserva").html(destino[0]+', '+destino[1]);  
	jQuery("#checkin_reserva").html(moment(checkin, 'DD-MM-YYYY').format("DD [de] MMMM [de] YYYY")); 

	if(localStorage.getItem("TYPE_FLIGHT") == 2){
		jQuery(".retorno").attr("display: none"); 
	}

	jQuery("#desc_dia_room_reserva").html(localStorage.getItem("DESC_PAX"));
	jQuery("#desc_sua_reserva_para").html(selected.companhia);
	jQuery("#desc_sua_reserva_checkin").html(moment(checkin, 'DD-MM-YYYY').format("DD [de] MMMM [de] YYYY"));
	jQuery("#desc_sua_reserva_checkout").html(moment(checkout, 'DD-MM-YYYY').format("DD [de] MMMM [de] YYYY"));

	jQuery("#desc_room_reserva").html('R$ '+localStorage.getItem("TOTAL_PRICE_WITHOUT_TAX"));
	jQuery("#desc_taxa_reserva").html('Taxa de R$ '+localStorage.getItem("TOTAL_TAX"));
	jQuery("#price_total").html('R$ '+localStorage.getItem("TOTAL_PRICE"));


	if(jQuery("#type_reserva").val() == 2){
		var titular = localStorage.getItem("HOLDER_EHTL");

		var number = localStorage.getItem("NUMBER_EHTL");

		var month = localStorage.getItem("MONTH_EHTL");

		var year = localStorage.getItem("YEAR_EHTL"); 



		jQuery("#desc_titular_card").html(localStorage.getItem("HOLDER_EHTL"));

		jQuery("#desc_number_card").html('**** **** **** '+localStorage.getItem("NUMBER_EHTL").substr(localStorage.getItem("NUMBER_EHTL").length - 4));

		jQuery("#desc_validade_card").html(localStorage.getItem("MONTH_EHTL")+'/'+localStorage.getItem("YEAR_EHTL"));

		if(localStorage.getItem("INSTALLMENT_EHTL") == 1){

			var parcelas = 'À vista';

		}else{

			var parcelas = localStorage.getItem("INSTALLMENT_EHTL")+'x no valor de R$ '+xx.format(localStorage.getItem("PRICE_INSTALLMENT_EHTL"))+' cada parcela';

		}

		jQuery("#desc_parcelas_card").html(parcelas);
	}

	/* SEND MAIL */ 

		var plugin_dir_url = jQuery("#plugin_dir_url").val();
		var color_ehtl = jQuery("#color_ehtl").val();
		var destino = destino[0]+', '+destino[1];
		var hotel_reserva = "";
		var checkin = moment(checkin, 'DD-MM-YYYY').format("DD [de] MMMM [de] YYYY"); 
		var checkout = moment(checkout, 'DD-MM-YYYY').format("DD [de] MMMM [de] YYYY");
		var irrevocableGuarantee = "";
		var cancellationDeadline = "";
		var hotelAdressComplete = "";
		var diaria = "";
		var quartos = selected.companhia;
		var pax = localStorage.getItem("DESC_PAX")
		var tipo_quarto = 'R$ '+localStorage.getItem("TOTAL_PRICE_WITHOUT_TAX");
		var taxa = 'Taxa de R$ '+localStorage.getItem("TOTAL_TAX");
		var total = 'R$ '+localStorage.getItem("TOTAL_PRICE");
		var customer = order_accepted.data.attributes.customerName;
		var type_reserva = jQuery("#type_reserva").val();
		if(jQuery("#type_reserva").val() == 2){
			var holder = localStorage.getItem("HOLDER_EHTL");
			var number = localStorage.getItem("NUMBER_EHTL").substr(localStorage.getItem("NUMBER_EHTL").length - 4);
			var month = localStorage.getItem("MONTH_EHTL")+"/"+localStorage.getItem("YEAR_EHTL"); 

			if(localStorage.getItem("INSTALLMENT_EHTL") == 1){ 
				var parcelas = "À vista"; 
			}else{ 
				var parcelas = localStorage.getItem("INSTALLMENT_EHTL")+"x no valor de R$ "+xx.format(localStorage.getItem("PRICE_INSTALLMENT_EHTL"))+" cada parcela"; 
			} 
		}else{
			var holder = "";
			var number = "";
			var month = "";
			var parcelas = "";
		}
		var order = jQuery("#order").val();
		var img_hotel = ""; 
		var email_order = order_accepted.data.attributes.costumerEmail;
		var tel_order = order_accepted.data.attributes.cutomerPhone;
		var cpf_order = order_accepted.data.attributes.customerIdentity;

	jQuery.ajax({ 
        url : wp_ajax_flights.ajaxurl,

        type : 'post', 

        data : {'action': 'send_mail_confirmation_flights', plugin_dir_url:plugin_dir_url, color_ehtl:color_ehtl, destino:destino, hotel_reserva:hotel_reserva, checkin:checkin, checkout:checkout, irrevocableGuarantee:irrevocableGuarantee, cancellationDeadline:cancellationDeadline, hotelAdressComplete:hotelAdressComplete, diaria:diaria, quartos:quartos, pax:pax, tipo_quarto:tipo_quarto, taxa:taxa, total:total, customer:customer, type_reserva:type_reserva, holder:holder, number:number, month:month, parcelas:parcelas, order:order, img_hotel:img_hotel, email_order:email_order, tel_order:tel_order, cpf_order:cpf_order },

        success : function( resposta ) {

        }

    });
 

} 
