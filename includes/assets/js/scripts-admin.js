jQuery(document).ready(function(){
	jQuery("#profileFlights #submit").attr("onclick", "save_data_flights()");
	jQuery("#contactFlights #submit").attr("onclick", "save_data_licenca_flights()");
});

function save_data_flights(){

	var Gtw_Agency_Id     = jQuery("#Gtw-Agency-Id").val();
	var Gtw_Group_Id      = jQuery("#Gtw-Group-Id").val();
	var Package           = jQuery("#Package").val();
	var cor_flights       = jQuery("#cor_flights").val();
	var cor_botao_flights = jQuery("#cor_botao_flights").val();
	var type_reserva      = jQuery("#type_reserva_flights").val(); 

	var licenca = jQuery("#chave_licenca_flights").val();

	if(jQuery("#chave_licenca_flights").val() == ""){

        swal({
            title: "É necessário informar uma licença para utilizar o plugin.",
            icon: "warning",
        }); 
        return false;

	}else{

		if(Gtw_Agency_Id == ""){

	        swal({
	            title: "É necessário informar a credencial Gtw-Agency-Id.",
	            icon: "warning",
	        }); 
	        return false;

		}else if(Gtw_Group_Id == ""){

	        swal({
	            title: "É necessário informar a credencial Gtw-Group-Id.",
	            icon: "warning",
	        }); 
	        return false;

		}else if(Package == ""){

	        swal({
	            title: "É necessário informar a credencial Package.",
	            icon: "warning",
	        }); 
	        return false;

		}else if(type_reserva == ""){

	        swal({
	            title: "É necessário informar um tipo de reserva.",
	            icon: "warning",
	        }); 
	        return false;

		}else{

			jQuery.ajax({
		        type: "POST",
		        url: wp_ajax.ajaxurl,
		        data: { action: "save_data_flights", Gtw_Agency_Id:Gtw_Agency_Id, Gtw_Group_Id:Gtw_Group_Id, Package:Package, cor_flights:cor_flights, cor_botao_flights:cor_botao_flights, type_reserva:type_reserva, licenca:licenca },
		        success: function( data ) { 
			        swal({
	                    title: "Dados salvos com sucesso!", 
	                    icon: "success"
	                }).then((value) => {
					  	window.location.reload();
					});
		        }
		    });

		}

	}
}

function set_type_reserva_flights(type){
	jQuery("#type_reserva_flights").val(type);
}

function save_data_licenca_flights(){

	var Gtw_Agency_Id     = jQuery("#Gtw-Agency-Id").val();
	var Gtw_Group_Id       = jQuery("#Gtw-Group-Id").val();
	var Package           = jQuery("#Package").val();
	var cor_flights       = jQuery("#cor_flights").val();
	var cor_botao_flights = jQuery("#cor_botao_flights").val();
	var type_reserva      = jQuery("#type_reserva_flights").val(); 

	var licenca = jQuery("#chave_licenca_flights").val();

	if(jQuery("#chave_licenca_flights").val() == ""){

        swal({
            title: "É necessário informar uma licença válida para utilizar o plugin.",
            icon: "warning",
        }); 
        return false;

	}else{
		jQuery("#contactFlights #submit").val("Aguarde...");
		jQuery("#contactFlights #submit").attr("disabled", "disabled");
		jQuery("#contactFlights #submit").prop("disabled", true);

		setTimeout(function(){

	      	jQuery.ajax({
		        type: "POST",
		        url: wp_ajax.ajaxurl,
		        data: { action: "save_data_flights", Gtw_Agency_Id:Gtw_Agency_Id, Gtw_Group_Id:Gtw_Group_Id, Package:Package, cor_flights:cor_flights, cor_botao_flights:cor_botao_flights, type_reserva:type_reserva, licenca:licenca },
		        success: function( data ) { 
			        swal({
	                    title: "Cliente validado!",  
	                    icon: "success"
	                }).then((value) => {
					  	window.location.reload();
					});
		        }
		    });

	   	}, 2200); 

	}
}