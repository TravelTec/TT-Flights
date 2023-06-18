jQuery(document).ready(function(){ 
  	jQuery('[data-toggle="tooltip"]').tooltip()

	var url_atual = window.location.href;

	if(url_atual.indexOf("/offers-flights/") != -1){ 
		jQuery(".qtyTotalFlights").html(parseInt(localStorage.getItem("ADULTOS_FLIGHT"))+parseInt(localStorage.getItem("CRIANCAS_FLIGHT")));
		jQuery(".classTrip").html(localStorage.getItem("CLASSE_TRIP")); 
		jQuery("#panel1adt").val(parseInt(localStorage.getItem("ADULTOS_FLIGHT")));
		jQuery(".qtyAdtFlights input").val(parseInt(localStorage.getItem("ADULTOS_FLIGHT")));
		
		jQuery("#panel1chd").val(parseInt(localStorage.getItem("CRIANCAS_FLIGHT")));
		jQuery(".qtyChd input").val(parseInt(localStorage.getItem("CRIANCAS_FLIGHT")));
		jQuery(".qtyTotalMultiFlights").html(parseInt(localStorage.getItem("ADULTOS_FLIGHT"))+parseInt(localStorage.getItem("CRIANCAS_FLIGHT")));
		jQuery(".classeTripMulti").html(localStorage.getItem("CLASSE_TRIP")); 

		list_data_search(); 

		const searchFlights = async () => {

		  	try { 

		    	//await search_results_flights();
		    	await get_data_results_flights();
		    	await get_companhias();
		    	await get_aeroportos();

		  	} catch (err) {

		    	console.error(err);

		  	}

		}



		searchFlights(); 

    }

});

function list_data_search(){

	var type_flight = localStorage.getItem("TYPE_FLIGHT");
	jQuery("#type_flight").val(type_flight);
	jQuery("#adultos").val(localStorage.getItem("ADULTOS_FLIGHT"));
	jQuery("#criancas").val(localStorage.getItem("CRIANCAS_FLIGHT"));

	if(type_flight == 3){
		//multi trecho

		jQuery("#multiWay").attr("checked", "checked");
		jQuery("#multiWay").prop("checked", true);

		jQuery(".qtyTotalMulti").html(parseInt(localStorage.getItem("ADULTOS_FLIGHT"))+parseInt(localStorage.getItem("CRIANCAS_FLIGHT"))); 
		jQuery(".classeTripMulti").html(localStorage.getItem("CLASSE_TRIP"));

		jQuery("#multiway").attr("style", "");
		jQuery("#flightsPadron").attr("style", "display:none");

		for(var i = 1; i < 6; i++){
			if(localStorage.getItem("DESTINO_FLIGHT_TRECHO"+i) !== null){
				jQuery("#field_origin_trecho"+i).val(localStorage.getItem("ORIGEM_FLIGHT_TRECHO"+i)); 
				jQuery("#field_destin_trecho"+i).val(localStorage.getItem("DESTINO_FLIGHT_TRECHO"+i)); 
			}
		}

	}else if(type_flight == 2){
		//somente ida

		jQuery("#oneWay").attr("checked", "checked");
		jQuery("#oneWay").prop("checked", true);

		jQuery("#multiway").attr("style", "display:none");
		jQuery("#flightsPadron").attr("style", "");

		jQuery(".dateReturn").attr("style", "display:none");

		jQuery(".qtyTotal").html(parseInt(localStorage.getItem("ADULTOS_FLIGHT"))+parseInt(localStorage.getItem("CRIANCAS_FLIGHT")));
		jQuery(".classTrip").html(localStorage.getItem("CLASSE_TRIP"));

		jQuery("#field_name_origin_flight").val(localStorage.getItem("ORIGEM_FLIGHT"));
		jQuery("#field_name_destin_flight").val(localStorage.getItem("DESTINO_FLIGHT")); 

	}else{
		//ida e volta

		jQuery("#flightRoundTrip").attr("checked", "checked");
		jQuery("#flightRoundTrip").prop("checked", true);

		jQuery("#multiway").attr("style", "display:none");
		jQuery("#flightsPadron").attr("style", "");

		jQuery(".qtyTotal").html(parseInt(localStorage.getItem("ADULTOS_FLIGHT"))+parseInt(localStorage.getItem("CRIANCAS_FLIGHT")));
		jQuery(".classTrip").html(localStorage.getItem("CLASSE_TRIP"));

		jQuery("#field_name_origin_flight").val(localStorage.getItem("ORIGEM_FLIGHT"));
		jQuery("#field_name_destin_flight").val(localStorage.getItem("DESTINO_FLIGHT")); 

	}

}

/* HELPERS LISTAGEM */ 
	function formatPrice(price){
		var xx = new Intl.NumberFormat('pt-BR', {  
		  	currency: 'BRL', 
		  	minimumFractionDigits: 2, 
		  	maximumFractionDigits: 2 
		});
		return xx.format(price);
	}

	function getTimeFromMins(mins) { 
	    var hours = Math.floor(mins / 60);          
    	var minutes = mins % 60; 
	    return moment.utc().hours(hours).minutes(minutes).format("HH:mm");
	}

	function getTimeFromMinsFormatBoot(mins) { 
	    var hours = Math.floor(mins / 60);          
    	var minutes = mins % 60; 
	    return moment.utc().hours(hours).minutes(minutes).format("HH[h] mm[m]");
	}
/* FIM HELPERS */

function get_data_results_flights(){ 

    var data = {  
        'action': 'search_top_results_flights', 
        'ages': localStorage.getItem("AGES_FLIGHT"),
        'routes': localStorage.getItem("ROUTE_FLIGHT"), 
        'businessClass': localStorage.getItem("CLASS_FLIGHT") 
    };

	jQuery.ajax({

        url : jQuery("#url_ajax").val(), 
        type : 'post', 
        data : data, 
        success : function( resposta ) {

        	localStorage.setItem("RESULT_FLIGHTS", resposta.slice(0, -1)); 
        	storage_json_data();

        }

    });
}

function get_companhias(){ 

    var data = {  
        'action': 'get_companhias',  
    };

	jQuery.ajax({

        url : jQuery("#url_ajax").val(), 
        type : 'post', 
        data : data, 
        success : function( resposta ) {

        	localStorage.setItem("COMPANIES_LOGO", resposta.slice(0, -1)); 

        }

    });
}

function get_aeroportos(){ 

    var data = {  
        'action': 'storage_data_aeroportos',  
    };

	jQuery.ajax({

        url : jQuery("#url_ajax").val(), 
        type : 'post', 
        data : data, 
        success : function( resposta ) {

        	localStorage.setItem("AEROPORTOS", resposta.slice(0, -1)); 

        }

    });
}

function storage_json_data(){

	var data = JSON.parse(localStorage.getItem("RESULT_FLIGHTS"));  
    var logos = JSON.parse(localStorage.getItem("COMPANIES_LOGO")); 

	var dataJson = []; 

	jQuery(data.flights).each(function(i, item) {
		if(i < 150){
			var innerObj = {};

			innerObj['id'] = i;
			innerObj['adt'] = localStorage.getItem("ADULTOS_FLIGHT");
			innerObj['chd'] = localStorage.getItem("CRIANCAS_FLIGHT");
			innerObj['desc_pax'] = localStorage.getItem("ADULTOS_FLIGHT")+' '+(localStorage.getItem("ADULTOS_FLIGHT") > 1 ? 'adultos' : 'adulto')+''+(localStorage.getItem("CRIANCAS_FLIGHT") > 0 ? ', '+localStorage.getItem("CRIANCAS_FLIGHT")+' '+(localStorage.getItem("CRIANCAS_FLIGHT") > 1 ? 'crianças' : 'criança') : '');
			innerObj['chd'] = localStorage.getItem("CRIANCAS_FLIGHT");
			innerObj['priceWithoutTax'] = formatPrice(item.fareGroup.fares[0].priceWithoutTax);
			innerObj['totalPriceWithoutTax'] = formatPrice(item.fareGroup.priceWithoutTax);
			innerObj['totalTax'] = formatPrice(parseFloat(item.fareGroup.priceWithTax)-parseFloat(item.fareGroup.priceWithoutTax));
			innerObj['totalPrice'] = formatPrice(item.fareGroup.priceWithTax);

			/* PRIMEIRA ROTA */  
				if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 2){
					var aeroDeparture = localStorage.getItem("ID_ORIGEM_FLIGHT");
					var aeroDescDeparture = localStorage.getItem("ORIGEM_FLIGHT").split(",");

					var aeroArrival = localStorage.getItem("ID_DESTINO_FLIGHT");
					var aeroDescArrival = localStorage.getItem("DESTINO_FLIGHT").split(",");

					var checkin = moment(localStorage.getItem("DATE_CHECKIN"), 'DD-MM-YYYY').format("LL");

					var textType = 'IDA';
					var iconType = 'fas fa-plane-departure';
				}else{
					var aeroDeparture = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO1");
					var aeroDescDeparture = localStorage.getItem("ORIGEM_FLIGHT_TRECHO1").split(",");

					var aeroArrival = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO1");
					var aeroDescArrival = localStorage.getItem("DESTINO_FLIGHT_TRECHO1").split(",");

					var checkin = moment(localStorage.getItem("DATE_CHECKIN_TRECHO1"), 'DD-MM-YYYY').format("LL");

					var textType = 'TRECHO 1';
					var iconType = 'fas fa-plane-departure';
				} 

				innerObj["flightsT1"] = []; 
				if(localStorage.getItem("DESTINO_FLIGHT_TRECHO3") != null){
					innerObj["flightsT3"] = [];
				}
				if(localStorage.getItem("DESTINO_FLIGHT_TRECHO4") != null){
					innerObj["flightsT4"] = []; 
				}
				if(localStorage.getItem("DESTINO_FLIGHT_TRECHO5") != null){
					innerObj["flightsT5"] = [];
				}

				jQuery(item.segments).each(function(f, flight) { 

		    		var innerFlightsT1 = {}; 
					if(flight.routeRPH == 0){  
						innerFlightsT1["id"] = f;    
						innerFlightsT1["segment"] = flight;
						innerFlightsT1["aeroDeparture"] = aeroDeparture; 
						innerFlightsT1["aeroDescDeparture"] = aeroDescDeparture[0]; 
						innerFlightsT1["aeroArrival"] = aeroArrival; 
						innerFlightsT1["aeroDescArrival"] = aeroDescArrival[0]; 
						innerFlightsT1["checkin"] = checkin; 
						innerFlightsT1["textType"] = textType; 
						innerFlightsT1["iconType"] = iconType; 
						innerFlightsT1["companhia"] = item.validatingBy.name;
						for(var x = 0; x < logos.length; x++){
							if(item.validatingBy.iata == logos[x]["cod_companhia"]){
								innerFlightsT1["logoCompanhia"] = logos[x]["img_companhia"];   
							}
						} 
						innerFlightsT1["rateToken"] = flight.rateToken;
						innerFlightsT1["leg"] = flight.legs;
						innerFlightsT1["horaIda"] = moment(flight.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
						innerFlightsT1["horaVolta"] = moment(flight.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
						if(flight.numberOfStops == 0){
							var stops = 'Direto';
						}else if(flight.numberOfStops == 1){
							var stops = '1 parada';
						}else if(flight.numberOfStops == 2){
							var stops = '2 paradas';
						}
						innerFlightsT1["paradas"] = stops; 
						innerFlightsT1["duracao"] = getTimeFromMins(flight.duration);
						if(flight.fareProfile.baggage.isIncluded){
							var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
						}else{ 
							var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
						}
						innerFlightsT1["bagagem"] = baggage;

						innerObj["flightsT1"].push(innerFlightsT1); 
					}
				});
			/* FIM PRIMEIRA ROTA */

			/* SEGUNDA ROTA */  
				if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 3){ 
					innerObj["flightsT2"] = [];
				
					if(localStorage.getItem("TYPE_FLIGHT") == 1){
						var aeroDepartureTrecho2 = localStorage.getItem("ID_DESTINO_FLIGHT");
						var aeroDescDepartureTrecho2 = localStorage.getItem("DESTINO_FLIGHT").split(",");

						var aeroArrivalTrecho2 = localStorage.getItem("ID_ORIGEM_FLIGHT");
						var aeroDescArrivalTrecho2 = localStorage.getItem("ORIGEM_FLIGHT").split(",");

						var checkinTrecho2 = moment(localStorage.getItem("DATE_CHECKOUT"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho2  = 'VOLTA';
						var iconTypeTrecho2  = 'fas fa-plane-arrival';
					}else{
						var aeroDepartureTrecho2  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO2");
						var aeroDescDepartureTrecho2  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO2").split(",");

						var aeroArrivalTrecho2  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO2");
						var aeroDescArrivalTrecho2  = localStorage.getItem("DESTINO_FLIGHT_TRECHO2").split(",");

						var checkinTrecho2 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO2"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho2  = 'TRECHO 2';
						var iconTypeTrecho2  = 'fas fa-plane-arrival';
					} 

					jQuery(item.segments).each(function(f2, flight2) { 

			    		var innerFlightsT2 = {}; 
						if(flight2.routeRPH == 1){     
							innerFlightsT2["id"] = f2;    
							innerFlightsT2["segment"] = flight2;
							innerFlightsT2["aeroDeparture"] = aeroDepartureTrecho2; 
							innerFlightsT2["aeroDescDeparture"] = aeroDescDepartureTrecho2[0]; 
							innerFlightsT2["aeroArrival"] = aeroArrivalTrecho2; 
							innerFlightsT2["aeroDescArrival"] = aeroDescArrivalTrecho2[0]; 
							innerFlightsT2["checkin"] = checkinTrecho2; 
							innerFlightsT2["textType"] = textTypeTrecho2; 
							innerFlightsT2["iconType"] = iconTypeTrecho2; 
							innerFlightsT2["companhia"] = item.validatingBy.name;
							for(var x = 0; x < logos.length; x++){
								if(item.validatingBy.iata == logos[x]["cod_companhia"]){
									innerFlightsT2["logoCompanhia"] = logos[x]["img_companhia"];   
								}
							} 
							innerFlightsT2["rateToken"] = flight2.rateToken;
							innerFlightsT2["leg"] = flight2.legs;
							innerFlightsT2["horaIda"] = moment(flight2.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
							innerFlightsT2["horaVolta"] = moment(flight2.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
							if(flight2.numberOfStops == 0){
								var stops = 'Direto';
							}else if(flight2.numberOfStops == 1){
								var stops = '1 parada';
							}else if(flight2.numberOfStops == 2){
								var stops = '2 paradas';
							}
							innerFlightsT2["paradas"] = stops; 
							innerFlightsT2["duracao"] = getTimeFromMins(flight2.duration);
							if(flight2.fareProfile.baggage.isIncluded){
								var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
							}else{ 
								var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
							}
							innerFlightsT2["bagagem"] = baggage;

							innerObj["flightsT2"].push(innerFlightsT2); 
						}
					});

				} 
			/* FIM SEGUNDA ROTA */

			if(localStorage.getItem("TYPE_FLIGHT") == 3){
				/* TERCEIRA ROTA */  
					if(localStorage.getItem("DESTINO_FLIGHT_TRECHO3") != null){ 
						innerObj["flightsT3"] = [];
					 
						var aeroDepartureTrecho3  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO3");
						var aeroDescDepartureTrecho3  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO3").split(",");

						var aeroArrivalTrecho3  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO3");
						var aeroDescArrivalTrecho3  = localStorage.getItem("DESTINO_FLIGHT_TRECHO3").split(",");

						var checkinTrecho3 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO3"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho3  = 'TRECHO 3';
						var iconTypeTrecho3  = 'fas fa-plane-arrival'; 

						jQuery(item.segments).each(function(f3, flight3) { 

				    		var innerFlightsT3 = {}; 
							if(flight3.routeRPH == 2){     
								innerFlightsT3["id"] = f3;    
								innerFlightsT3["segment"] = flight3;
								innerFlightsT3["aeroDeparture"] = aeroDepartureTrecho3; 
								innerFlightsT3["aeroDescDeparture"] = aeroDescDepartureTrecho3[0]; 
								innerFlightsT3["aeroArrival"] = aeroArrivalTrecho3; 
								innerFlightsT3["aeroDescArrival"] = aeroDescArrivalTrecho3[0]; 
								innerFlightsT3["checkin"] = checkinTrecho3; 
								innerFlightsT3["textType"] = textTypeTrecho3; 
								innerFlightsT3["iconType"] = iconTypeTrecho3; 
								innerFlightsT3["companhia"] = item.validatingBy.name;
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT3["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT3["rateToken"] = flight3.rateToken;
								innerFlightsT3["leg"] = flight3.legs;
								innerFlightsT3["horaIda"] = moment(flight3.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT3["horaVolta"] = moment(flight3.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								if(flight3.numberOfStops == 0){
									var stops = 'Direto';
								}else if(flight3.numberOfStops == 1){
									var stops = '1 parada';
								}else if(flight3.numberOfStops == 2){
									var stops = '2 paradas';
								}
								innerFlightsT3["paradas"] = stops; 
								innerFlightsT3["duracao"] = getTimeFromMins(flight3.duration);
								if(flight3.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT3["bagagem"] = baggage;

								innerObj["flightsT3"].push(innerFlightsT3); 
							}
						});

					} 
				/* FIM TERCEIRA ROTA */

				/* QUARTA ROTA */  
					if(localStorage.getItem("DESTINO_FLIGHT_TRECHO4") != null){ 
						innerObj["flightsT4"] = [];
					 
						var aeroDepartureTrecho4  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO4");
						var aeroDescDepartureTrecho4  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO4").split(",");

						var aeroArrivalTrecho4  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO4");
						var aeroDescArrivalTrecho4  = localStorage.getItem("DESTINO_FLIGHT_TRECHO4").split(",");

						var checkinTrecho4 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO4"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho4  = 'TRECHO 4';
						var iconTypeTrecho4  = 'fas fa-plane-departure'; 

						jQuery(item.segments).each(function(f4, flight4) { 

				    		var innerFlightsT4 = {}; 
							if(flight4.routeRPH == 3){     
								innerFlightsT4["id"] = f4;    
								innerFlightsT4["segment"] = flight4;
								innerFlightsT4["aeroDeparture"] = aeroDepartureTrecho4; 
								innerFlightsT4["aeroDescDeparture"] = aeroDescDepartureTrecho4[0]; 
								innerFlightsT4["aeroArrival"] = aeroArrivalTrecho4; 
								innerFlightsT4["aeroDescArrival"] = aeroDescArrivalTrecho4[0]; 
								innerFlightsT4["checkin"] = checkinTrecho4; 
								innerFlightsT4["textType"] = textTypeTrecho4; 
								innerFlightsT4["iconType"] = iconTypeTrecho4; 
								innerFlightsT4["companhia"] = item.validatingBy.name;
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT4["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT4["rateToken"] = flight4.rateToken;
								innerFlightsT4["leg"] = flight4.legs;
								innerFlightsT4["horaIda"] = moment(flight4.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT4["horaVolta"] = moment(flight4.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								if(flight4.numberOfStops == 0){
									var stops = 'Direto';
								}else if(flight4.numberOfStops == 1){
									var stops = '1 parada';
								}else if(flight4.numberOfStops == 2){
									var stops = '2 paradas';
								}
								innerFlightsT4["paradas"] = stops; 
								innerFlightsT4["duracao"] = getTimeFromMins(flight4.duration);
								if(flight4.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT4["bagagem"] = baggage;

								innerObj["flightsT4"].push(innerFlightsT4); 
							}
						});

					} 
				/* FIM QUARTA ROTA */

				/* QUINTA ROTA */  
					if(localStorage.getItem("DESTINO_FLIGHT_TRECHO5") != null){ 
						innerObj["flightsT5"] = [];
					 
						var aeroDepartureTrecho5  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO5");
						var aeroDescDepartureTrecho5  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO5").split(",");

						var aeroArrivalTrecho5  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO5");
						var aeroDescArrivalTrecho5  = localStorage.getItem("DESTINO_FLIGHT_TRECHO5").split(",");

						var checkinTrecho5 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO5"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho5  = 'TRECHO 5';
						var iconTypeTrecho5  = 'fas fa-plane-arrival'; 

						jQuery(item.segments).each(function(f5, flight5) { 

				    		var innerFlightsT5 = {}; 
							if(flight5.routeRPH == 4){ 
								innerFlightsT5["id"] = f5;   
								innerFlightsT5["segment"] = flight5;     
								innerFlightsT5["aeroDeparture"] = aeroDepartureTrecho5; 
								innerFlightsT5["aeroDescDeparture"] = aeroDescDepartureTrecho5[0]; 
								innerFlightsT5["aeroArrival"] = aeroArrivalTrecho5; 
								innerFlightsT5["aeroDescArrival"] = aeroDescArrivalTrecho5[0]; 
								innerFlightsT5["checkin"] = checkinTrecho5; 
								innerFlightsT5["textType"] = textTypeTrecho5; 
								innerFlightsT5["iconType"] = iconTypeTrecho5; 
								innerFlightsT5["companhia"] = item.validatingBy.name;
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT5["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT5["rateToken"] = flight5.rateToken;
								innerFlightsT5["leg"] = flight5.legs;
								innerFlightsT5["horaIda"] = moment(flight5.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT5["horaVolta"] = moment(flight5.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								if(flight5.numberOfStops == 0){
									var stops = 'Direto';
								}else if(flight5.numberOfStops == 1){
									var stops = '1 parada';
								}else if(flight5.numberOfStops == 2){
									var stops = '2 paradas';
								}
								innerFlightsT5["paradas"] = stops; 
								innerFlightsT5["duracao"] = getTimeFromMins(flight5.duration);
								if(flight5.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT5["bagagem"] = baggage;

								innerObj["flightsT5"].push(innerFlightsT5); 
							}
						});

					} 
				/* FIM QUINTA ROTA */
			}

			dataJson.push(innerObj); 
		}
	});
	
	localStorage.setItem("JSON_RESULT_FLIGHTS", JSON.stringify(dataJson)); 
 
	const listFlights = async () => { 
	  	try { 
 
	    	await start_filters_flights();
	    	await list_results_flights(10, 0);

	  	} catch (err) {  
	    	console.error(err); 
	  	} 
	} 
	listFlights(); 

} 

function start_filters_flights(){

	var data = JSON.parse(localStorage.getItem("RESULT_FLIGHTS")); 

	/* FILTER PRICE */
		var retorno_price = "";

		retorno_price += '<input type="hidden" id="min_price_flights" value="'+data.meta.price.minWithoutTax+'">';
		retorno_price += '<input type="hidden" id="max_price_flights" value="'+data.meta.price.maxWithoutTax+'">'; 

		retorno_price += '<div class="accordion accordion-flush" id="accordionFlushPrice">';
			retorno_price += '<div class="accordion-item">';
			    retorno_price += '<h2 class="accordion-header" id="flush-headingPrice">';
			      	retorno_price += '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-price" aria-expanded="true" aria-controls="flush-collapseOne">';
			        	retorno_price += 'Preço';
			      	retorno_price += '</button>';
			    retorno_price += '</h2>';
			    retorno_price += '<div id="flush-price" class="accordion-collapse collapse show" aria-labelledby="flush-headingPrice" data-bs-parent="#accordionFlushPrice">';
			      	retorno_price += '<div class="accordion-body"> ';
			      		retorno_price += '<div class="row">';
			      			retorno_price += '<div class="col-lg-6 col-6">';
			      				retorno_price += '<label class="price-range-left">Mín.</label>';
			      			retorno_price += '</div>';
			      			retorno_price += '<div class="col-lg-6 col-6 text-right">';
			      				retorno_price += '<label class="price-range-right">Máx.</label>';
			      			retorno_price += '</div>';
			      		retorno_price += '</div>';
			      		retorno_price += '<div class="row">';
			      			retorno_price += '<div class="col-lg-12 col-12 range">';
								retorno_price += '<div id="steps-slider-flights" class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">';
								retorno_price += '</div>  ';
							retorno_price += '</div>  ';
						retorno_price += '</div>    ';
			      	retorno_price += '</div>';
			    retorno_price += '</div>';
			retorno_price += '</div>';
		retorno_price += '</div>';

		jQuery(".filter-price-flights").html(retorno_price);

		var stepsSlider = document.getElementById('steps-slider-flights'); 

		noUiSlider.create(stepsSlider, {
		    start: [parseInt(data.meta.price.minWithoutTax), parseInt(data.meta.price.maxWithoutTax)],
		    connect: true,
		    tooltips: [true, wNumb({decimals: 1})],
		    range: {
		        'min': parseInt(data.meta.price.minWithoutTax),
		        'max': parseInt(data.meta.price.maxWithoutTax)
		    }
		});

		stepsSlider.noUiSlider.on('change', function (values, handle) { 
		    if(handle == 0){
		    	jQuery("#min_price_flights").val(values[handle]); 
		    }
		    if(handle == 1){ 
		    	jQuery("#max_price_flights").val(values[handle]);
		    } 

		    filter_flights();
		}); 
	/* ************ */

	/* FILTER PARADAS */
		var retorno_stops = "";

		retorno_stops += '<input type="hidden" id="qtd_paradas_selected" value="all">'; 

		retorno_stops += '<div class="accordion accordion-flush" id="accordionFlushStops">';
			retorno_stops += '<div class="accordion-item">';
			    retorno_stops += '<h2 class="accordion-header" id="flush-headingStops">';
			      	retorno_stops += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-stops" aria-expanded="false" aria-controls="flush-collapseOne">';
			        	retorno_stops += 'Paradas';
			      	retorno_stops += '</button>';
			    retorno_stops += '</h2>';
			    retorno_stops += '<div id="flush-stops" class="accordion-collapse collapse" aria-labelledby="flush-headingStops" data-bs-parent="#accordionFlushStops">';
			      	retorno_stops += '<div class="accordion-body"> ';

			      		retorno_stops += '<div class="row all-stops">';
			      			retorno_stops += '<div class="col-lg-12 col-12">';
			      				retorno_stops += '<div class="form-check form-check-inline">';
								  	retorno_stops += '<input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="all" checked disabled onclick="change_filter_stops_flights(\'all\')">';
								  	retorno_stops += '<label class="form-check-label" for="inlineCheckbox6" style="color:#303030">Todas as paradas</label>';
								retorno_stops += '</div>';
			      			retorno_stops += '</div> ';
			      		retorno_stops += '</div> '; 

			      		retorno_stops += '<div class="row 0-stops">';
			      			retorno_stops += '<div class="col-lg-12 col-12">';
			      				retorno_stops += '<div class="form-check form-check-inline">';
								  	retorno_stops += '<input class="form-check-input" type="checkbox" id="inlineCheckbox0" value="Direto" onclick="change_filter_stops_flights(\'Direto\')">';
								  	retorno_stops += '<label class="form-check-label" for="inlineCheckbox0" style="color:#303030">Direto</label>';
								retorno_stops += '</div>';
			      			retorno_stops += '</div> ';
			      		retorno_stops += '</div>   '; 

			      		retorno_stops += '<div class="row 1-stops">';
			      			retorno_stops += '<div class="col-lg-12 col-12">';
			      				retorno_stops += '<div class="form-check form-check-inline">';
								  	retorno_stops += '<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1 parada" onclick="change_filter_stops_flights(\'1 parada\')">';
								  	retorno_stops += '<label class="form-check-label" for="inlineCheckbox1" style="color:#303030">1 parada</label>';
								retorno_stops += '</div>';
			      			retorno_stops += '</div> ';
			      		retorno_stops += '</div>   '; 

			      		retorno_stops += '<div class="row 2-stops">';
			      			retorno_stops += '<div class="col-lg-12 col-12">';
			      				retorno_stops += '<div class="form-check form-check-inline">';
								  	retorno_stops += '<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="2 paradas" onclick="change_filter_stops_flights(\'2 paradas\')">';
								  	retorno_stops += '<label class="form-check-label" for="inlineCheckbox2" style="color:#303030">2 paradas</label>';
								retorno_stops += '</div>';
			      			retorno_stops += '</div> ';
			      		retorno_stops += '</div>   '; 

			      	retorno_stops += '</div>';
			    retorno_stops += '</div>';
			retorno_stops += '</div>';
		retorno_stops += '</div>'; 

		jQuery(".filter-stops-flights").html(retorno_stops);
	/* ************ */

	/* FILTER BAGAGEM */
		var retorno_luggage = "";

		retorno_luggage += '<input type="hidden" id="qtd_luggage_selected" value="all">'; 

		retorno_luggage += '<div class="accordion accordion-flush" id="accordionFlushLuggage">';
			retorno_luggage += '<div class="accordion-item">';
			    retorno_luggage += '<h2 class="accordion-header" id="flush-headingLuggage">';
			      	retorno_luggage += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-luggage" aria-expanded="false" aria-controls="flush-collapseOne">';
			        	retorno_luggage += 'Bagagem';
			      	retorno_luggage += '</button>';
			    retorno_luggage += '</h2>';
			    retorno_luggage += '<div id="flush-luggage" class="accordion-collapse collapse" aria-labelledby="flush-headingLuggage" data-bs-parent="#accordionFlushLuggage">';
			      	retorno_luggage += '<div class="accordion-body"> ';

			      		retorno_luggage += '<div class="row all-luggage">';
			      			retorno_luggage += '<div class="col-lg-12 col-12">';
			      				retorno_luggage += '<div class="form-check form-check-inline">';
								  	retorno_luggage += '<input class="form-check-input" type="checkbox" id="inlineCheckbox6B" value="all" checked disabled onclick="change_filter_luggage(\'all\')">';
								  	retorno_luggage += '<label class="form-check-label" for="inlineCheckbox6B" style="color:#303030">Todas as opções</label>';
								retorno_luggage += '</div>';
			      			retorno_luggage += '</div> ';
			      		retorno_luggage += '</div> '; 

			      		retorno_luggage += '<div class="row 0-stops">';
			      			retorno_luggage += '<div class="col-lg-12 col-12">';
			      				retorno_luggage += '<div class="form-check form-check-inline">';
								  	retorno_luggage += '<input class="form-check-input" type="checkbox" id="inlineCheckbox0B" value="0" onclick="change_filter_luggage(\'0\')">';
								  	retorno_luggage += '<label class="form-check-label" for="inlineCheckbox0B" style="color:#303030">Bagagem de mão</label>';
								retorno_luggage += '</div>';
			      			retorno_luggage += '</div> ';
			      		retorno_luggage += '</div>   '; 

			      		retorno_luggage += '<div class="row 1-stops">';
			      			retorno_luggage += '<div class="col-lg-12 col-12">';
			      				retorno_luggage += '<div class="form-check form-check-inline">';
								  	retorno_luggage += '<input class="form-check-input" type="checkbox" id="inlineCheckbox1B" value="1" onclick="change_filter_luggage(\'1\')">';
								  	retorno_luggage += '<label class="form-check-label" for="inlineCheckbox1B" style="color:#303030">Bagagem para despachar</label>';
								retorno_luggage += '</div>';
			      			retorno_luggage += '</div> ';
			      		retorno_luggage += '</div>   '; 

			      	retorno_luggage += '</div>';
			    retorno_luggage += '</div>';
			retorno_luggage += '</div>';
		retorno_luggage += '</div>'; 

		jQuery(".filter-luggage-flights").html(retorno_luggage);
	/* ************ */ 

	jQuery("#filter").removeClass("row-is-loading");

}

/* FUNCTIONS HELPERS FILTERS */
function findArrayInArray(array1, array2) {

         

    // Loop for array1

    for(let i = 0; i < array1.length; i++) {

         

        // Loop for array2

        for(let j = 0; j < array2.length; j++) {

             

            // Compare the element of each and

            // every element from both of the

            // arrays

            if(array1[i] === array2[j]) {

             

                // Return if common element found

                return true;

            }

        }

    }

     

    // Return if no common element exist

    return false;

}

function change_filter_stops_flights(qtyStops){

	var val_filter = jQuery("#qtd_paradas_selected").val(); 

	var desc_val_filter = [];

	if(qtyStops !== "all"){

		jQuery("#inlineCheckbox6").removeAttr("disabled"); 
		jQuery("#inlineCheckbox6").removeAttr("checked"); 

		var innerObj = {};

		for(var i = 0; i < 5; i++){ 
			if (jQuery("#inlineCheckbox"+i).is(':checked') == true) { 
				desc_val_filter.push(jQuery("#inlineCheckbox"+i).val()); 
			} 
		} 

		jQuery("#qtd_paradas_selected").val(JSON.stringify(desc_val_filter));

	}else{

		for(var i = 0; i < 5; i++){ 
			jQuery("#inlineCheckbox"+i).removeAttr("checked"); 
		} 

		desc_val_filter.push('Direto'); 
		desc_val_filter.push('1 parada'); 
		desc_val_filter.push('2 paradas'); 

		jQuery("#inlineCheckbox6").attr("disabled", "disabled"); 
		jQuery("#inlineCheckbox6").prop("disabled", true);  

		jQuery("#qtd_paradas_selected").val(JSON.stringify(desc_val_filter));

	} 


	if(jQuery("#inlineCheckbox0").is(':checked') == false && jQuery("#inlineCheckbox1").is(':checked') == false && jQuery("#inlineCheckbox2").is(':checked') == false && jQuery("#inlineCheckbox3").is(':checked') == false && jQuery("#inlineCheckbox4").is(':checked') == false){ 
 
		jQuery("#inlineCheckbox6").attr("disabled", "disabled"); 
		jQuery("#inlineCheckbox6").prop("disabled", true); 

		jQuery("#inlineCheckbox6").attr("checked", "checked"); 
		jQuery("#inlineCheckbox6").prop("checked", true);  

	} 

	filter_flights();

}

function change_filter_luggage(luggage){

	var val_filter = jQuery("#qtd_luggage_selected").val(); 

	var desc_val_filter = [];

	if(luggage !== "all"){

		jQuery("#inlineCheckbox6B").removeAttr("disabled"); 
		jQuery("#inlineCheckbox6B").removeAttr("checked"); 

		var innerObj = {};

		for(var i = 0; i < 5; i++){ 
			if (jQuery("#inlineCheckbox"+i+"B").is(':checked') == true) { 
				desc_val_filter.push(parseInt(jQuery("#inlineCheckbox"+i+"B").val())); 
			} 
		} 

		jQuery("#qtd_luggage_selected").val(JSON.stringify(desc_val_filter));

	}else{

		for(var i = 0; i < 5; i++){ 
			jQuery("#inlineCheckbox"+i+"B").removeAttr("checked"); 
		} 

		desc_val_filter.push(parseInt('0')); 
		desc_val_filter.push(parseInt('1'));  

		jQuery("#inlineCheckbox6B").attr("disabled", "disabled"); 
		jQuery("#inlineCheckbox6B").prop("disabled", true);  

		jQuery("#qtd_luggage_selected").val(JSON.stringify(desc_val_filter));

	} 


	if(jQuery("#inlineCheckbox0B").is(':checked') == false && jQuery("#inlineCheckbox1B").is(':checked') == false){ 
 
		jQuery("#inlineCheckbox6B").attr("disabled", "disabled"); 
		jQuery("#inlineCheckbox6B").prop("disabled", true); 

		jQuery("#inlineCheckbox6B").attr("checked", "checked"); 
		jQuery("#inlineCheckbox6B").prop("checked", true);  

	} 

	filter_flights();

}
/* FIM FUNCTIONS HELPERS FILTERS */

function filter_flights(type = null){ 

	var data = JSON.parse(localStorage.getItem("RESULT_FLIGHTS")); 
    var logos = JSON.parse(localStorage.getItem("COMPANIES_LOGO")); 

	var dataJson = [];
	
	if(type == 1){
		jQuery("#min_price_flights").val(data.meta.price.minWithoutTax);
		jQuery("#max_price_flights").val(data.meta.price.maxWithoutTax);
		
		var filter_min_price = jQuery("#min_price_flights").val();
		var filter_max_price = jQuery("#max_price_flights").val(); 

		var filter_stops = [];  
		filter_stops.push("Direto");
		filter_stops.push("1 parada");
		filter_stops.push("2 paradas");

		filter_stops = JSON.stringify(filter_stops); 
		var desc_filter_stops = JSON.parse(filter_stops); 

		for(var i = 0; i < 5; i++){ 
			jQuery("#inlineCheckbox"+i).removeAttr("checked"); 
		}  

		jQuery("#inlineCheckbox6").attr("disabled", "disabled"); 
		jQuery("#inlineCheckbox6").prop("disabled", true);    

		jQuery("#inlineCheckbox6").attr("checked", "checked"); 
		jQuery("#inlineCheckbox6").prop("checked", true);  

		jQuery("#qtd_paradas_selected").val(JSON.stringify(filter_stops));

		var filter_luggage = []; 
		filter_luggage.push(parseInt(0));
		filter_luggage.push(parseInt(1)); 

		filter_luggage = JSON.stringify(filter_luggage);
		var desc_filter_luggage = JSON.parse(filter_luggage);  

		for(var i = 0; i < 5; i++){ 
			jQuery("#inlineCheckbox"+i+"B").removeAttr("checked"); 
		}  

		jQuery("#inlineCheckbox6B").attr("disabled", "disabled"); 
		jQuery("#inlineCheckbox6B").prop("disabled", true);  

		jQuery("#inlineCheckbox6B").attr("checked", "checked"); 
		jQuery("#inlineCheckbox6B").prop("checked", true);  

		jQuery("#qtd_luggage_selected").val(JSON.stringify(filter_luggage));
	
	}else{

		var filter_min_price = jQuery("#min_price_flights").val();
		var filter_max_price = jQuery("#max_price_flights").val(); 

		var filter_stops = []; 
		if(jQuery("#qtd_paradas_selected").val() == "all"){
			filter_stops.push("Direto");
			filter_stops.push("1 parada");
			filter_stops.push("2 paradas");

			filter_stops = JSON.stringify(filter_stops);
		} else{
			filter_stops = jQuery("#qtd_paradas_selected").val();
		}
		var desc_filter_stops = JSON.parse(filter_stops);  

		var filter_luggage = []; 
		if(jQuery("#qtd_luggage_selected").val() == "all"){
			filter_luggage.push(parseInt(0));
			filter_luggage.push(parseInt(1)); 

			filter_luggage = JSON.stringify(filter_luggage);
		} else{
			filter_luggage = jQuery("#qtd_luggage_selected").val();
		}
		var desc_filter_luggage = JSON.parse(filter_luggage);  
	
	}

	jQuery(data.flights).each(function(i, item) { 

		/* array paradas rota 1 */
			var arrayStopsRota1 = [];
			var arrayLuggageRota1 = [];
			jQuery(item.segments).each(function(f, flight) { 
				if(flight.routeRPH == 0){  
					if(flight.numberOfStops == 0){
						var stops = 'Direto';
					}else if(flight.numberOfStops == 1){
						var stops = '1 parada';
					}else if(flight.numberOfStops == 2){
						var stops = '2 paradas';
					}
					arrayStopsRota1.push(stops);

					if(flight.fareProfile.baggage.isIncluded){
						var baggage = 1;
					}else{ 
						var baggage = 0;
					} 
					arrayLuggageRota1.push(parseInt(baggage));
				}
			}); 
		/* fim array paradas rota 1*/

		/* array paradas rota 2 */
			var arrayStopsRota2 = [];
			var arrayLuggageRota2 = [];
			if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 3){
				jQuery(item.segments).each(function(f, flight) { 
					if(flight.routeRPH == 1){  
						if(flight.numberOfStops == 0){
							var stops = 'Direto';
						}else if(flight.numberOfStops == 1){
							var stops = '1 parada';
						}else if(flight.numberOfStops == 2){
							var stops = '2 paradas';
						}
						arrayStopsRota2.push(stops);

						if(flight.fareProfile.baggage.isIncluded){
							var baggage = 1;
						}else{ 
							var baggage = 0;
						} 
						arrayLuggageRota2.push(parseInt(baggage));
					}
				}); 
			}else{
				arrayStopsRota2.push('Direto');
				arrayStopsRota2.push('1 parada');
				arrayStopsRota2.push('2 paradas');

				arrayLuggageRota2.push(parseInt(0));
				arrayLuggageRota2.push(parseInt(1));
			}
		/* fim array paradas rota 2 */ 

		if((item.fareGroup.fares[0].priceWithoutTax >= filter_min_price && item.fareGroup.fares[0].priceWithoutTax <= filter_max_price) && ((findArrayInArray(desc_filter_stops, arrayStopsRota1)) && (findArrayInArray(desc_filter_stops, arrayStopsRota2))) && ((findArrayInArray(desc_filter_luggage, arrayLuggageRota1)) && (findArrayInArray(desc_filter_luggage, arrayLuggageRota2)))){
			var innerObj = {};

			innerObj['id'] = i;
			innerObj['adt'] = localStorage.getItem("ADULTOS_FLIGHT");
			innerObj['chd'] = localStorage.getItem("CRIANCAS_FLIGHT");
			innerObj['desc_pax'] = localStorage.getItem("ADULTOS_FLIGHT")+' '+(localStorage.getItem("ADULTOS_FLIGHT") > 1 ? 'adultos' : 'adulto')+''+(localStorage.getItem("CRIANCAS_FLIGHT") > 0 ? ', '+localStorage.getItem("CRIANCAS_FLIGHT")+' '+(localStorage.getItem("CRIANCAS_FLIGHT") > 1 ? 'crianças' : 'criança') : '');
			innerObj['chd'] = localStorage.getItem("CRIANCAS_FLIGHT");
			innerObj['priceWithoutTax'] = formatPrice(item.fareGroup.fares[0].priceWithoutTax);
			innerObj['totalPriceWithoutTax'] = formatPrice(item.fareGroup.priceWithoutTax);
			innerObj['totalTax'] = formatPrice(parseFloat(item.fareGroup.priceWithTax)-parseFloat(item.fareGroup.priceWithoutTax));
			innerObj['totalPrice'] = formatPrice(item.fareGroup.priceWithTax);

			/* PRIMEIRA ROTA */  
				if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 2){
					var aeroDeparture = localStorage.getItem("ID_ORIGEM_FLIGHT");
					var aeroDescDeparture = localStorage.getItem("ORIGEM_FLIGHT").split(",");

					var aeroArrival = localStorage.getItem("ID_DESTINO_FLIGHT");
					var aeroDescArrival = localStorage.getItem("DESTINO_FLIGHT").split(",");

					var checkin = moment(localStorage.getItem("DATE_CHECKIN"), 'DD-MM-YYYY').format("LL");

					var textType = 'IDA';
					var iconType = 'fas fa-plane-departure';
				}else{
					var aeroDeparture = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO1");
					var aeroDescDeparture = localStorage.getItem("ORIGEM_FLIGHT_TRECHO1").split(",");

					var aeroArrival = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO1");
					var aeroDescArrival = localStorage.getItem("DESTINO_FLIGHT_TRECHO1").split(",");

					var checkin = moment(localStorage.getItem("DATE_CHECKIN_TRECHO1"), 'DD-MM-YYYY').format("LL");

					var textType = 'TRECHO 1';
					var iconType = 'fas fa-plane-departure';
				} 

				innerObj["flightsT1"] = []; 
				if(localStorage.getItem("DESTINO_FLIGHT_TRECHO3") != null){
					innerObj["flightsT3"] = [];
				}
				if(localStorage.getItem("DESTINO_FLIGHT_TRECHO4") != null){
					innerObj["flightsT4"] = []; 
				}
				if(localStorage.getItem("DESTINO_FLIGHT_TRECHO5") != null){
					innerObj["flightsT5"] = [];
				}

				jQuery(item.segments).each(function(f, flight) { 

		    		var innerFlightsT1 = {}; 
					if(flight.routeRPH == 0){  
						if(flight.numberOfStops == 0){
							var stops = 'Direto';
						}else if(flight.numberOfStops == 1){
							var stops = '1 parada';
						}else if(flight.numberOfStops == 2){
							var stops = '2 paradas';
						} 
						if((jQuery.inArray(stops, desc_filter_stops) !== -1)){
							innerFlightsT1["id"] = f;    
							innerFlightsT1["segment"] = flight;
							innerFlightsT1["aeroDeparture"] = aeroDeparture; 
							innerFlightsT1["aeroDescDeparture"] = aeroDescDeparture[0]; 
							innerFlightsT1["aeroArrival"] = aeroArrival; 
							innerFlightsT1["aeroDescArrival"] = aeroDescArrival[0]; 
							innerFlightsT1["checkin"] = checkin; 
							innerFlightsT1["textType"] = textType; 
							innerFlightsT1["iconType"] = iconType; 
							innerFlightsT1["companhia"] = item.validatingBy.name;
							for(var x = 0; x < logos.length; x++){
								if(item.validatingBy.iata == logos[x]["cod_companhia"]){
									innerFlightsT1["logoCompanhia"] = logos[x]["img_companhia"];   
								}
							} 
							innerFlightsT1["rateToken"] = flight.rateToken;
							innerFlightsT1["leg"] = flight.legs;
							innerFlightsT1["horaIda"] = moment(flight.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
							innerFlightsT1["horaVolta"] = moment(flight.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm"); 
							innerFlightsT1["paradas"] = stops; 
							innerFlightsT1["duracao"] = getTimeFromMins(flight.duration);
							if(flight.fareProfile.baggage.isIncluded){
								var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
							}else{ 
								var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
							}
							innerFlightsT1["bagagem"] = baggage;

							innerObj["flightsT1"].push(innerFlightsT1); 
						}
					}
				});
			/* FIM PRIMEIRA ROTA */

			/* SEGUNDA ROTA */  
				if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 3){ 
					innerObj["flightsT2"] = [];
				
					if(localStorage.getItem("TYPE_FLIGHT") == 1){
						var aeroDepartureTrecho2 = localStorage.getItem("ID_DESTINO_FLIGHT");
						var aeroDescDepartureTrecho2 = localStorage.getItem("DESTINO_FLIGHT").split(",");

						var aeroArrivalTrecho2 = localStorage.getItem("ID_ORIGEM_FLIGHT");
						var aeroDescArrivalTrecho2 = localStorage.getItem("ORIGEM_FLIGHT").split(",");

						var checkinTrecho2 = moment(localStorage.getItem("DATE_CHECKOUT"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho2  = 'VOLTA';
						var iconTypeTrecho2  = 'fas fa-plane-arrival';
					}else{
						var aeroDepartureTrecho2  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO2");
						var aeroDescDepartureTrecho2  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO2").split(",");

						var aeroArrivalTrecho2  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO2");
						var aeroDescArrivalTrecho2  = localStorage.getItem("DESTINO_FLIGHT_TRECHO2").split(",");

						var checkinTrecho2 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO2"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho2  = 'TRECHO 2';
						var iconTypeTrecho2  = 'fas fa-plane-arrival';
					} 

					jQuery(item.segments).each(function(f2, flight2) { 

			    		var innerFlightsT2 = {}; 
						if(flight2.routeRPH == 1){    
							if(flight2.numberOfStops == 0){
								var stops = 'Direto';
							}else if(flight2.numberOfStops == 1){
								var stops = '1 parada';
							}else if(flight2.numberOfStops == 2){
								var stops = '2 paradas';
							} 
							if((jQuery.inArray(stops, desc_filter_stops) !== -1)){
								innerFlightsT2["id"] = f2;    
								innerFlightsT2["segment"] = flight2;
								innerFlightsT2["aeroDeparture"] = aeroDepartureTrecho2; 
								innerFlightsT2["aeroDescDeparture"] = aeroDescDepartureTrecho2[0]; 
								innerFlightsT2["aeroArrival"] = aeroArrivalTrecho2; 
								innerFlightsT2["aeroDescArrival"] = aeroDescArrivalTrecho2[0]; 
								innerFlightsT2["checkin"] = checkinTrecho2; 
								innerFlightsT2["textType"] = textTypeTrecho2; 
								innerFlightsT2["iconType"] = iconTypeTrecho2; 
								innerFlightsT2["companhia"] = item.validatingBy.name;
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT2["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT2["rateToken"] = flight2.rateToken;
								innerFlightsT2["leg"] = flight2.legs;
								innerFlightsT2["horaIda"] = moment(flight2.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT2["horaVolta"] = moment(flight2.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT2["paradas"] = stops; 
								innerFlightsT2["duracao"] = getTimeFromMins(flight2.duration);
								if(flight2.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT2["bagagem"] = baggage;

								innerObj["flightsT2"].push(innerFlightsT2); 
							}
						}
					});

				} 
			/* FIM SEGUNDA ROTA */

			if(localStorage.getItem("TYPE_FLIGHT") == 3){
				/* TERCEIRA ROTA */  
					if(localStorage.getItem("DESTINO_FLIGHT_TRECHO3") != null){ 
						innerObj["flightsT3"] = [];
					 
						var aeroDepartureTrecho3  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO3");
						var aeroDescDepartureTrecho3  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO3").split(",");

						var aeroArrivalTrecho3  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO3");
						var aeroDescArrivalTrecho3  = localStorage.getItem("DESTINO_FLIGHT_TRECHO3").split(",");

						var checkinTrecho3 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO3"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho3  = 'TRECHO 3';
						var iconTypeTrecho3  = 'fas fa-plane-arrival'; 

						jQuery(item.segments).each(function(f3, flight3) { 

				    		var innerFlightsT3 = {}; 
							if(flight3.routeRPH == 2){     
								innerFlightsT3["id"] = f3;    
								innerFlightsT3["segment"] = flight3;
								innerFlightsT3["aeroDeparture"] = aeroDepartureTrecho3; 
								innerFlightsT3["aeroDescDeparture"] = aeroDescDepartureTrecho3[0]; 
								innerFlightsT3["aeroArrival"] = aeroArrivalTrecho3; 
								innerFlightsT3["aeroDescArrival"] = aeroDescArrivalTrecho3[0]; 
								innerFlightsT3["checkin"] = checkinTrecho3; 
								innerFlightsT3["textType"] = textTypeTrecho3; 
								innerFlightsT3["iconType"] = iconTypeTrecho3; 
								innerFlightsT3["companhia"] = item.validatingBy.name;
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT3["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT3["rateToken"] = flight3.rateToken;
								innerFlightsT3["leg"] = flight3.legs;
								innerFlightsT3["horaIda"] = moment(flight3.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT3["horaVolta"] = moment(flight3.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								if(flight3.numberOfStops == 0){
									var stops = 'Direto';
								}else if(flight3.numberOfStops == 1){
									var stops = '1 parada';
								}else if(flight3.numberOfStops == 2){
									var stops = '2 paradas';
								}
								innerFlightsT3["paradas"] = stops; 
								innerFlightsT3["duracao"] = getTimeFromMins(flight3.duration);
								if(flight3.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT3["bagagem"] = baggage;

								innerObj["flightsT3"].push(innerFlightsT3); 
							}
						});

					} 
				/* FIM TERCEIRA ROTA */

				/* QUARTA ROTA */  
					if(localStorage.getItem("DESTINO_FLIGHT_TRECHO4") != null){ 
						innerObj["flightsT4"] = [];
					 
						var aeroDepartureTrecho4  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO4");
						var aeroDescDepartureTrecho4  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO4").split(",");

						var aeroArrivalTrecho4  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO4");
						var aeroDescArrivalTrecho4  = localStorage.getItem("DESTINO_FLIGHT_TRECHO4").split(",");

						var checkinTrecho4 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO4"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho4  = 'TRECHO 4';
						var iconTypeTrecho4  = 'fas fa-plane-departure'; 

						jQuery(item.segments).each(function(f4, flight4) { 

				    		var innerFlightsT4 = {}; 
							if(flight4.routeRPH == 3){     
								innerFlightsT4["id"] = f4;    
								innerFlightsT4["segment"] = flight4;
								innerFlightsT4["aeroDeparture"] = aeroDepartureTrecho4; 
								innerFlightsT4["aeroDescDeparture"] = aeroDescDepartureTrecho4[0]; 
								innerFlightsT4["aeroArrival"] = aeroArrivalTrecho4; 
								innerFlightsT4["aeroDescArrival"] = aeroDescArrivalTrecho4[0]; 
								innerFlightsT4["checkin"] = checkinTrecho4; 
								innerFlightsT4["textType"] = textTypeTrecho4; 
								innerFlightsT4["iconType"] = iconTypeTrecho4; 
								innerFlightsT4["companhia"] = item.validatingBy.name;
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT4["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT4["rateToken"] = flight4.rateToken;
								innerFlightsT4["leg"] = flight4.legs;
								innerFlightsT4["horaIda"] = moment(flight4.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT4["horaVolta"] = moment(flight4.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								if(flight4.numberOfStops == 0){
									var stops = 'Direto';
								}else if(flight4.numberOfStops == 1){
									var stops = '1 parada';
								}else if(flight4.numberOfStops == 2){
									var stops = '2 paradas';
								}
								innerFlightsT4["paradas"] = stops; 
								innerFlightsT4["duracao"] = getTimeFromMins(flight4.duration);
								if(flight4.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT4["bagagem"] = baggage;

								innerObj["flightsT4"].push(innerFlightsT4); 
							}
						});

					} 
				/* FIM QUARTA ROTA */

				/* QUINTA ROTA */  
					if(localStorage.getItem("DESTINO_FLIGHT_TRECHO5") != null){ 
						innerObj["flightsT5"] = [];
					 
						var aeroDepartureTrecho5  = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO5");
						var aeroDescDepartureTrecho5  = localStorage.getItem("ORIGEM_FLIGHT_TRECHO5").split(",");

						var aeroArrivalTrecho5  = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO5");
						var aeroDescArrivalTrecho5  = localStorage.getItem("DESTINO_FLIGHT_TRECHO5").split(",");

						var checkinTrecho5 = moment(localStorage.getItem("DATE_CHECKIN_TRECHO5"), 'DD-MM-YYYY').format("LL");

						var textTypeTrecho5  = 'TRECHO 5';
						var iconTypeTrecho5  = 'fas fa-plane-arrival'; 

						jQuery(item.segments).each(function(f5, flight5) { 

				    		var innerFlightsT5 = {}; 
							if(flight5.routeRPH == 4){ 
								innerFlightsT5["id"] = f5;        
								innerFlightsT5["segment"] = flight5;
								innerFlightsT5["aeroDeparture"] = aeroDepartureTrecho5; 
								innerFlightsT5["aeroDescDeparture"] = aeroDescDepartureTrecho5[0]; 
								innerFlightsT5["aeroArrival"] = aeroArrivalTrecho5; 
								innerFlightsT5["aeroDescArrival"] = aeroDescArrivalTrecho5[0]; 
								innerFlightsT5["checkin"] = checkinTrecho5; 
								innerFlightsT5["textType"] = textTypeTrecho5; 
								innerFlightsT5["iconType"] = iconTypeTrecho5; 
								innerFlightsT5["companhia"] = item.validatingBy.name; 
								for(var x = 0; x < logos.length; x++){
									if(item.validatingBy.iata == logos[x]["cod_companhia"]){
										innerFlightsT5["logoCompanhia"] = logos[x]["img_companhia"];   
									}
								} 
								innerFlightsT5["rateToken"] = flight5.rateToken;
								innerFlightsT5["leg"] = flight5.legs;
								innerFlightsT5["horaIda"] = moment(flight5.departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								innerFlightsT5["horaVolta"] = moment(flight5.arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm");
								if(flight5.numberOfStops == 0){
									var stops = 'Direto';
								}else if(flight5.numberOfStops == 1){
									var stops = '1 parada';
								}else if(flight5.numberOfStops == 2){
									var stops = '2 paradas';
								}
								innerFlightsT5["paradas"] = stops; 
								innerFlightsT5["duracao"] = getTimeFromMins(flight5.duration);
								if(flight5.fareProfile.baggage.isIncluded){
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart"></i>';
								}else{ 
									var baggage = '<i aria-hidden="true" class="fas fa-luggage-cart" style="color: #cfcfcf;"></i>';
								}
								innerFlightsT5["bagagem"] = baggage;

								innerObj["flightsT5"].push(innerFlightsT5); 
							}
						});

					} 
				/* FIM QUINTA ROTA */
			}

			dataJson.push(innerObj); 
		} 
	}); 

	localStorage.setItem("JSON_RESULT_FLIGHTS", JSON.stringify(dataJson)); 

	if(dataJson.length == 0){
		var retorno = "";

		retorno += '<div class="container" style="margin: 0;font-family: \'Montserrat\';background-color: #ffdfbf;border: 1px solid #f2cca5;border-radius: 7px;color: #000;">'; 
			retorno += '<div class="row justify-content-center">'; 
				retorno += '<div class="col-lg-12 col-12" style="padding: 20px;">'; 
					retorno += '<h4>'; 
					retorno += '<i class="fa fa-exclamation"></i> Não encontramos resultados para os filtros selecionados.</h4>'; 
					retorno += '<a onclick="filter_flights(1)" style="color:#000081;cursor:pointer"><strong style="color:#000081;cursor:pointer">Remover os filtros para ver todos os resultados.</strong></a>'; 
				retorno += '</div>'; 
			retorno += '</div>'; 
		retorno += '</div>';

		jQuery(".resultsFlights").html(retorno); 
	}else{ 
		list_results_flights(10, 0);
	}

}

function list_results_flights(contador_prox, contador_prev){  

    var data = JSON.parse(localStorage.getItem("JSON_RESULT_FLIGHTS"));

    var html = "";

    var contador = 0;

    jQuery(data).each(function(i, item) { 
    	contador++;
    	if(i < contador_prox && i >= contador_prev){

	    	html += '<div class="elementor-container elementor-column-gap-default" style="margin-bottom: 20px;display: flex;">';
			    html += '<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-3c1f62c" data-id="3c1f62c" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>';
			        html += '<div class="elementor-widget-wrap elementor-element-populated">';

			    	/* PRIMEIRA ROTA */
			    		html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="bdb8934" data-element_type="section">';
			                html += '<div class="elementor-container elementor-column-gap-default">';
			                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-694ffca" data-id="694ffca" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>';
			                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			                            html += '<div class="elementor-element elementor-element-487a01e elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="487a01e" data-element_type="widget" data-widget_type="icon-box.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css" />';
			                                    html += '<div class="elementor-icon-box-wrapper">';
			                                        html += '<div class="elementor-icon-box-icon">';
			                                            html += '<span class="elementor-icon elementor-animation-"> <i aria-hidden="true" class="'+item.flightsT1[0].iconType+'"></i> </span>';
			                                        html += '</div>';
			                                        html += '<div class="elementor-icon-box-content">';
			                                            html += '<h3 class="elementor-icon-box-title" style="    margin-top: 5px;">';
			                                                html += '<span> '+item.flightsT1[0].textType+' </span>';
			                                            html += '</h3>';
			                                        html += '</div>';
			                                    html += '</div>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-a6937f4 elementor-widget elementor-widget-heading" data-id="a6937f4" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<style>.elementor-heading-title {padding: 0;margin: 0;line-height: 1;}.elementor-widget-heading .elementor-heading-title[class*="elementor-size-"] > a {color: inherit;font-size: inherit;line-height: inherit;}.elementor-widget-heading .elementor-heading-title.elementor-size-small {font-size: 15px;}.elementor-widget-heading .elementor-heading-title.elementor-size-medium {font-size: 19px;}.elementor-widget-heading .elementor-heading-title.elementor-size-large {font-size: 29px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xl {font-size: 39px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl {font-size: 59px;}</style>';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT1[0].checkin+'</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                        html += '</div>';
			                    html += '</div>';
			                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-056e108" data-id="056e108" data-element_type="column">';
			                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			                            html += '<div class="elementor-element elementor-element-ab0e110 elementor-widget elementor-widget-heading" data-id="ab0e110" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT1[0].aeroDeparture+'</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-891ac14 elementor-widget elementor-widget-heading" data-id="891ac14" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT1[0].aeroDescDeparture+'</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                        html += '</div>';
			                    html += '</div>';
			                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-95bdfa3" data-id="95bdfa3" data-element_type="column">';
			                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			                            html += '<div class="elementor-element elementor-element-a06688c elementor-widget elementor-widget-heading" data-id="a06688c" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT1[0].aeroArrival+'</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-6767e1e elementor-widget elementor-widget-heading" data-id="6767e1e" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT1[0].aeroDescArrival+'</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                        html += '</div>';
			                    html += '</div>';
			                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-94783ca elementor-hidden-mobile" data-id="94783ca" data-element_type="column">';
			                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			                            html += '<div class="elementor-element elementor-element-5ae3cb0 elementor-widget elementor-widget-heading" data-id="5ae3cb0" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">Bagagem</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                        html += '</div>';
			                    html += '</div>';
			                html += '</div>';
			            html += '</section>';

			            jQuery(item.flightsT1).each(function(v1, voo1) { 
			            	html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-3eab11e elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="3eab11e" data-element_type="section" >';
				                html += '<div class="elementor-container elementor-column-gap-default">';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-121ea31" data-id="121ea31" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-04fc0e6 elementor-view-default elementor-widget elementor-widget-icon" data-id="04fc0e6" data-element_type="widget" data-widget_type="icon.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<div class="elementor-icon-wrapper">';
				                                        html += '<div class="elementor-icon">';
				                                            html += '<input type="radio" name="flightTrecho1_'+i+'" id="flightTrecho1_'+i+'_'+v1+'" value="'+voo1.id+'" onclick="setDataFlight('+i+', '+v1+', \'flightsT1\', \''+item.priceWithoutTax+'\', \''+item.totalPriceWithoutTax+'\', \''+item.totalTax+'\', \''+item.totalPrice+'\')" style="cursor:pointer">';
				                                        html += '</div>';
				                                    html += '</div>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-145eadd" data-id="145eadd" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-f1d001a elementor-position-left elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="f1d001a" data-element_type="widget" data-widget_type="image-box.default" >';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<style> .elementor-widget-image-box .elementor-image-box-content {width: 100%;}@media (min-width: 768px) {.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper, .elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {display: flex;}.elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {text-align: right;flex-direction: row-reverse;}.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper {text-align: left;flex-direction: row;}.elementor-widget-image-box.elementor-position-top .elementor-image-box-img {margin: auto;}.elementor-widget-image-box.elementor-vertical-align-top .elementor-image-box-wrapper {align-items: flex-start;}.elementor-widget-image-box.elementor-vertical-align-middle .elementor-image-box-wrapper {align-items: center;}.elementor-widget-image-box.elementor-vertical-align-bottom .elementor-image-box-wrapper {align-items: flex-end;}}@media (max-width: 767px) {.elementor-widget-image-box .elementor-image-box-img {margin-left: auto !important;margin-right: auto !important;margin-bottom: 15px;}}.elementor-widget-image-box .elementor-image-box-img {display: inline-block;}.elementor-widget-image-box .elementor-image-box-title a {color: inherit;}.elementor-widget-image-box .elementor-image-box-wrapper {text-align: center;}.elementor-widget-image-box .elementor-image-box-description {margin: 0;}</style>';
				                                    html += '<div class="elementor-image-box-wrapper">';
				                                        html += '<figure class="elementor-image-box-img">';
				                                            html += '<img decoding="async" width="25" height="25" src="'+voo1.logoCompanhia+'" class="attachment-full size-full wp-image-1784" alt="" loading="lazy" />';
				                                        html += '</figure>';
				                                        html += '<div class="elementor-image-box-content"><h3 class="elementor-image-box-title">'+voo1.companhia+'</h3></div>';
				                                    html += '</div>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-f7a6913" data-id="f7a6913" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-d1a8a7a elementor-widget elementor-widget-heading" data-id="d1a8a7a" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo1.horaIda+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-0f05fdb" data-id="0f05fdb" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-98d3060 elementor-widget elementor-widget-heading" data-id="98d3060" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo1.paradas+'</h2>';
				                                html += '</div>';
				                            html += '</div>'; 
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-acb4588" data-id="acb4588" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-50bc46f elementor-widget elementor-widget-heading" data-id="50bc46f" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo1.horaVolta+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9a72b81" data-id="9a72b81" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-087e430 elementor-widget elementor-widget-heading" data-id="087e430" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo1.duracao+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-2d9f7a6" data-id="2d9f7a6" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-e64596c elementor-icon-list--layout-inline elementor-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e64596c" data-element_type="widget"  data-widget_type="icon-list.default" >';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css" />';
				                                    html += '<ul class="elementor-icon-list-items elementor-inline-items">';
				                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
				                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-shopping-bag"></i> </span>';
				                                            html += '<span class="elementor-icon-list-text"></span>';
				                                        html += '</li>';
				                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
				                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-suitcase-rolling"></i> </span>';
				                                            html += '<span class="elementor-icon-list-text"></span>';
				                                        html += '</li>';
				                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
				                                            html += '<span class="elementor-icon-list-icon"> '+voo1.bagagem+' </span>';
				                                            html += '<span class="elementor-icon-list-text"></span>';
				                                        html += '</li>';
				                                    html += '</ul>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-ba41d76" data-id="ba41d76" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-83e1053 elementor-view-default elementor-widget elementor-widget-icon" data-id="83e1053" data-element_type="widget" data-widget_type="icon.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<div class="elementor-icon-wrapper">';
				                                        html += '<div class="elementor-icon">';
				                                            html += '<i aria-hidden="true" class="fas fa-chevron-down" onclick="getDataFlight('+i+', '+v1+', \'flightsT1\')" style="cursor:pointer"></i>';
				                                        html += '</div>';
				                                    html += '</div>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                html += '</div>';
				            html += '</section> ';
			            });

			    	/* FIM PRIMEIRA ROTA */

			    	if(localStorage.getItem("TYPE_FLIGHT") == 1 || localStorage.getItem("TYPE_FLIGHT") == 3){
				    	/* SEGUNDA ROTA */
				    		html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="bdb8934" data-element_type="section">';
				                html += '<div class="elementor-container elementor-column-gap-default">';
				                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-694ffca" data-id="694ffca" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-487a01e elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="487a01e" data-element_type="widget" data-widget_type="icon-box.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css" />';
				                                    html += '<div class="elementor-icon-box-wrapper">';
				                                        html += '<div class="elementor-icon-box-icon">';
				                                            html += '<span class="elementor-icon elementor-animation-"> <i aria-hidden="true" class="'+item.flightsT2[0].iconType+'"></i> </span>';
				                                        html += '</div>';
				                                        html += '<div class="elementor-icon-box-content">';
				                                            html += '<h3 class="elementor-icon-box-title" style="    margin-top: 5px;">';
				                                                html += '<span> '+item.flightsT2[0].textType+' </span>';
				                                            html += '</h3>';
				                                        html += '</div>';
				                                    html += '</div>';
				                                html += '</div>';
				                            html += '</div>';
				                            html += '<div class="elementor-element elementor-element-a6937f4 elementor-widget elementor-widget-heading" data-id="a6937f4" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<style>.elementor-heading-title {padding: 0;margin: 0;line-height: 1;}.elementor-widget-heading .elementor-heading-title[class*="elementor-size-"] > a {color: inherit;font-size: inherit;line-height: inherit;}.elementor-widget-heading .elementor-heading-title.elementor-size-small {font-size: 15px;}.elementor-widget-heading .elementor-heading-title.elementor-size-medium {font-size: 19px;}.elementor-widget-heading .elementor-heading-title.elementor-size-large {font-size: 29px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xl {font-size: 39px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl {font-size: 59px;}</style>';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT2[0].checkin+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-056e108" data-id="056e108" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-ab0e110 elementor-widget elementor-widget-heading" data-id="ab0e110" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT2[0].aeroDeparture+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                            html += '<div class="elementor-element elementor-element-891ac14 elementor-widget elementor-widget-heading" data-id="891ac14" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT2[0].aeroDescDeparture+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-95bdfa3" data-id="95bdfa3" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-a06688c elementor-widget elementor-widget-heading" data-id="a06688c" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT2[0].aeroArrival+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                            html += '<div class="elementor-element elementor-element-6767e1e elementor-widget elementor-widget-heading" data-id="6767e1e" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT2[0].aeroDescArrival+'</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-94783ca elementor-hidden-mobile" data-id="94783ca" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-5ae3cb0 elementor-widget elementor-widget-heading" data-id="5ae3cb0" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">Bagagem</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                html += '</div>';
				            html += '</section>';

				            jQuery(item.flightsT2).each(function(v2, voo2) { 
				            	html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-3eab11e elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="3eab11e" data-element_type="section" >';
					                html += '<div class="elementor-container elementor-column-gap-default">';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-121ea31" data-id="121ea31" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-04fc0e6 elementor-view-default elementor-widget elementor-widget-icon" data-id="04fc0e6" data-element_type="widget" data-widget_type="icon.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<div class="elementor-icon-wrapper">';
					                                        html += '<div class="elementor-icon">';
				                                            	html += '<input type="radio" name="flightTrecho2_'+i+'" id="flightTrecho2" value="'+voo2.id+'" onclick="setDataFlight('+i+', '+v2+', \'flightsT2\', \''+item.priceWithoutTax+'\', \''+item.totalPriceWithoutTax+'\', \''+item.totalTax+'\', \''+item.totalPrice+'\')" style="cursor:pointer">';
					                                        html += '</div>';
					                                    html += '</div>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-145eadd" data-id="145eadd" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-f1d001a elementor-position-left elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="f1d001a" data-element_type="widget" data-widget_type="image-box.default" >';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<style> .elementor-widget-image-box .elementor-image-box-content {width: 100%;}@media (min-width: 768px) {.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper, .elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {display: flex;}.elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {text-align: right;flex-direction: row-reverse;}.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper {text-align: left;flex-direction: row;}.elementor-widget-image-box.elementor-position-top .elementor-image-box-img {margin: auto;}.elementor-widget-image-box.elementor-vertical-align-top .elementor-image-box-wrapper {align-items: flex-start;}.elementor-widget-image-box.elementor-vertical-align-middle .elementor-image-box-wrapper {align-items: center;}.elementor-widget-image-box.elementor-vertical-align-bottom .elementor-image-box-wrapper {align-items: flex-end;}}@media (max-width: 767px) {.elementor-widget-image-box .elementor-image-box-img {margin-left: auto !important;margin-right: auto !important;margin-bottom: 15px;}}.elementor-widget-image-box .elementor-image-box-img {display: inline-block;}.elementor-widget-image-box .elementor-image-box-title a {color: inherit;}.elementor-widget-image-box .elementor-image-box-wrapper {text-align: center;}.elementor-widget-image-box .elementor-image-box-description {margin: 0;}</style>';
					                                    html += '<div class="elementor-image-box-wrapper">';
					                                        html += '<figure class="elementor-image-box-img">';
					                                            html += '<img decoding="async" width="25" height="25" src="'+voo2.logoCompanhia+'" class="attachment-full size-full wp-image-1784" alt="" loading="lazy" />';
					                                        html += '</figure>';
					                                        html += '<div class="elementor-image-box-content"><h3 class="elementor-image-box-title">'+voo2.companhia+'</h3></div>';
					                                    html += '</div>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-f7a6913" data-id="f7a6913" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-d1a8a7a elementor-widget elementor-widget-heading" data-id="d1a8a7a" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo2.horaIda+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-0f05fdb" data-id="0f05fdb" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-98d3060 elementor-widget elementor-widget-heading" data-id="98d3060" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo2.paradas+'</h2>';
					                                html += '</div>';
					                            html += '</div>'; 
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-acb4588" data-id="acb4588" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-50bc46f elementor-widget elementor-widget-heading" data-id="50bc46f" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo2.horaVolta+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9a72b81" data-id="9a72b81" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-087e430 elementor-widget elementor-widget-heading" data-id="087e430" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo2.duracao+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-2d9f7a6" data-id="2d9f7a6" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-e64596c elementor-icon-list--layout-inline elementor-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e64596c" data-element_type="widget"  data-widget_type="icon-list.default" >';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css" />';
					                                    html += '<ul class="elementor-icon-list-items elementor-inline-items">';
					                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
					                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-shopping-bag"></i> </span>';
					                                            html += '<span class="elementor-icon-list-text"></span>';
					                                        html += '</li>';
					                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
					                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-suitcase-rolling"></i> </span>';
					                                            html += '<span class="elementor-icon-list-text"></span>';
					                                        html += '</li>';
					                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
					                                            html += '<span class="elementor-icon-list-icon"> '+voo2.bagagem+' </span>';
					                                            html += '<span class="elementor-icon-list-text"></span>';
					                                        html += '</li>';
					                                    html += '</ul>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-ba41d76" data-id="ba41d76" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-83e1053 elementor-view-default elementor-widget elementor-widget-icon" data-id="83e1053" data-element_type="widget" data-widget_type="icon.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<div class="elementor-icon-wrapper">';
					                                        html += '<div class="elementor-icon">';
					                                            html += '<i aria-hidden="true" class="fas fa-chevron-down" onclick="getDataFlight('+i+', '+v2+', \'flightsT2\')" style="cursor:pointer"></i>';
					                                        html += '</div>';
					                                    html += '</div>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                html += '</div>';
					            html += '</section> ';
				            });

				    	/* FIM SEGUNDA ROTA */
				    } 

					if(localStorage.getItem("TYPE_FLIGHT") == 3){

				    	if(localStorage.getItem("DESTINO_FLIGHT_TRECHO3") != null){
					    	/* TERCEIRA ROTA */
					    		html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="bdb8934" data-element_type="section">';
					                html += '<div class="elementor-container elementor-column-gap-default">';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-694ffca" data-id="694ffca" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-487a01e elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="487a01e" data-element_type="widget" data-widget_type="icon-box.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css" />';
					                                    html += '<div class="elementor-icon-box-wrapper">';
					                                        html += '<div class="elementor-icon-box-icon">';
					                                            html += '<span class="elementor-icon elementor-animation-"> <i aria-hidden="true" class="'+item.flightsT3[0].iconType+'"></i> </span>';
					                                        html += '</div>';
					                                        html += '<div class="elementor-icon-box-content">';
					                                            html += '<h3 class="elementor-icon-box-title" style="    margin-top: 5px;">';
					                                                html += '<span> '+item.flightsT3[0].textType+' </span>';
					                                            html += '</h3>';
					                                        html += '</div>';
					                                    html += '</div>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-a6937f4 elementor-widget elementor-widget-heading" data-id="a6937f4" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<style>.elementor-heading-title {padding: 0;margin: 0;line-height: 1;}.elementor-widget-heading .elementor-heading-title[class*="elementor-size-"] > a {color: inherit;font-size: inherit;line-height: inherit;}.elementor-widget-heading .elementor-heading-title.elementor-size-small {font-size: 15px;}.elementor-widget-heading .elementor-heading-title.elementor-size-medium {font-size: 19px;}.elementor-widget-heading .elementor-heading-title.elementor-size-large {font-size: 29px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xl {font-size: 39px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl {font-size: 59px;}</style>';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT3[0].checkin+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-056e108" data-id="056e108" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-ab0e110 elementor-widget elementor-widget-heading" data-id="ab0e110" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT3[0].aeroDeparture+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-891ac14 elementor-widget elementor-widget-heading" data-id="891ac14" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT3[0].aeroDescDeparture+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-95bdfa3" data-id="95bdfa3" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-a06688c elementor-widget elementor-widget-heading" data-id="a06688c" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT3[0].aeroArrival+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-6767e1e elementor-widget elementor-widget-heading" data-id="6767e1e" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT3[0].aeroDescArrival+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-94783ca elementor-hidden-mobile" data-id="94783ca" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-5ae3cb0 elementor-widget elementor-widget-heading" data-id="5ae3cb0" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">Bagagem</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                html += '</div>';
					            html += '</section>';

					            jQuery(item.flightsT3).each(function(v3, voo3) { 
					            	html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-3eab11e elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="3eab11e" data-element_type="section" >';
						                html += '<div class="elementor-container elementor-column-gap-default">';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-121ea31" data-id="121ea31" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-04fc0e6 elementor-view-default elementor-widget elementor-widget-icon" data-id="04fc0e6" data-element_type="widget" data-widget_type="icon.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<div class="elementor-icon-wrapper">';
						                                        html += '<div class="elementor-icon">';
					                                            	html += '<input type="radio" name="flightTrecho3_'+i+'" id="flightTrecho3" value="'+voo3.id+'" onclick="setDataFlight('+i+', '+v3+', \'flightsT3\', \''+item.priceWithoutTax+'\', \''+item.totalPriceWithoutTax+'\', \''+item.totalTax+'\', \''+item.totalPrice+'\')" style="cursor:pointer">';
						                                        html += '</div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-145eadd" data-id="145eadd" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-f1d001a elementor-position-left elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="f1d001a" data-element_type="widget" data-widget_type="image-box.default" >';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<style> .elementor-widget-image-box .elementor-image-box-content {width: 100%;}@media (min-width: 768px) {.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper, .elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {display: flex;}.elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {text-align: right;flex-direction: row-reverse;}.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper {text-align: left;flex-direction: row;}.elementor-widget-image-box.elementor-position-top .elementor-image-box-img {margin: auto;}.elementor-widget-image-box.elementor-vertical-align-top .elementor-image-box-wrapper {align-items: flex-start;}.elementor-widget-image-box.elementor-vertical-align-middle .elementor-image-box-wrapper {align-items: center;}.elementor-widget-image-box.elementor-vertical-align-bottom .elementor-image-box-wrapper {align-items: flex-end;}}@media (max-width: 767px) {.elementor-widget-image-box .elementor-image-box-img {margin-left: auto !important;margin-right: auto !important;margin-bottom: 15px;}}.elementor-widget-image-box .elementor-image-box-img {display: inline-block;}.elementor-widget-image-box .elementor-image-box-title a {color: inherit;}.elementor-widget-image-box .elementor-image-box-wrapper {text-align: center;}.elementor-widget-image-box .elementor-image-box-description {margin: 0;}</style>';
						                                    html += '<div class="elementor-image-box-wrapper">';
						                                        html += '<figure class="elementor-image-box-img">';
						                                            html += '<img decoding="async" width="25" height="25" src="'+voo3.logoCompanhia+'" class="attachment-full size-full wp-image-1784" alt="" loading="lazy" />';
						                                        html += '</figure>';
						                                        html += '<div class="elementor-image-box-content"><h3 class="elementor-image-box-title">'+voo3.companhia+'</h3></div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-f7a6913" data-id="f7a6913" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-d1a8a7a elementor-widget elementor-widget-heading" data-id="d1a8a7a" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo3.horaIda+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-0f05fdb" data-id="0f05fdb" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-98d3060 elementor-widget elementor-widget-heading" data-id="98d3060" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo3.paradas+'</h2>';
						                                html += '</div>';
						                            html += '</div>'; 
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-acb4588" data-id="acb4588" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-50bc46f elementor-widget elementor-widget-heading" data-id="50bc46f" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo3.horaVolta+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9a72b81" data-id="9a72b81" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-087e430 elementor-widget elementor-widget-heading" data-id="087e430" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo3.duracao+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-2d9f7a6" data-id="2d9f7a6" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-e64596c elementor-icon-list--layout-inline elementor-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e64596c" data-element_type="widget"  data-widget_type="icon-list.default" >';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css" />';
						                                    html += '<ul class="elementor-icon-list-items elementor-inline-items">';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-shopping-bag"></i> </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-suitcase-rolling"></i> </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> '+voo3.bagagem+' </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                    html += '</ul>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-ba41d76" data-id="ba41d76" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-83e1053 elementor-view-default elementor-widget elementor-widget-icon" data-id="83e1053" data-element_type="widget" data-widget_type="icon.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<div class="elementor-icon-wrapper">';
						                                        html += '<div class="elementor-icon">';
						                                            html += '<i aria-hidden="true" class="fas fa-chevron-down" onclick="getDataFlight('+i+', '+v3+', \'flightsT3\')" style="cursor:pointer"></i>';
						                                        html += '</div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                html += '</div>';
						            html += '</section> ';
					            });

					    	/* FIM TERCEIRA ROTA */
					    }

				    	if(localStorage.getItem("DESTINO_FLIGHT_TRECHO4") != null){
					    	/* QUARTA ROTA */
					    		html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="bdb8934" data-element_type="section">';
					                html += '<div class="elementor-container elementor-column-gap-default">';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-694ffca" data-id="694ffca" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-487a01e elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="487a01e" data-element_type="widget" data-widget_type="icon-box.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css" />';
					                                    html += '<div class="elementor-icon-box-wrapper">';
					                                        html += '<div class="elementor-icon-box-icon">';
					                                            html += '<span class="elementor-icon elementor-animation-"> <i aria-hidden="true" class="'+item.flightsT4[0].iconType+'"></i> </span>';
					                                        html += '</div>';
					                                        html += '<div class="elementor-icon-box-content">';
					                                            html += '<h3 class="elementor-icon-box-title" style="    margin-top: 5px;">';
					                                                html += '<span> '+item.flightsT4[0].textType+' </span>';
					                                            html += '</h3>';
					                                        html += '</div>';
					                                    html += '</div>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-a6937f4 elementor-widget elementor-widget-heading" data-id="a6937f4" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<style>.elementor-heading-title {padding: 0;margin: 0;line-height: 1;}.elementor-widget-heading .elementor-heading-title[class*="elementor-size-"] > a {color: inherit;font-size: inherit;line-height: inherit;}.elementor-widget-heading .elementor-heading-title.elementor-size-small {font-size: 15px;}.elementor-widget-heading .elementor-heading-title.elementor-size-medium {font-size: 19px;}.elementor-widget-heading .elementor-heading-title.elementor-size-large {font-size: 29px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xl {font-size: 39px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl {font-size: 59px;}</style>';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT4[0].checkin+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-056e108" data-id="056e108" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-ab0e110 elementor-widget elementor-widget-heading" data-id="ab0e110" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT4[0].aeroDeparture+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-891ac14 elementor-widget elementor-widget-heading" data-id="891ac14" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT4[0].aeroDescDeparture+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-95bdfa3" data-id="95bdfa3" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-a06688c elementor-widget elementor-widget-heading" data-id="a06688c" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT4[0].aeroArrival+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-6767e1e elementor-widget elementor-widget-heading" data-id="6767e1e" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT4[0].aeroDescArrival+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-94783ca elementor-hidden-mobile" data-id="94783ca" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-5ae3cb0 elementor-widget elementor-widget-heading" data-id="5ae3cb0" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">Bagagem</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                html += '</div>';
					            html += '</section>';

					            jQuery(item.flightsT4).each(function(v4, voo4) { 
					            	html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-3eab11e elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="3eab11e" data-element_type="section" >';
						                html += '<div class="elementor-container elementor-column-gap-default">';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-121ea31" data-id="121ea31" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-04fc0e6 elementor-view-default elementor-widget elementor-widget-icon" data-id="04fc0e6" data-element_type="widget" data-widget_type="icon.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<div class="elementor-icon-wrapper">';
						                                        html += '<div class="elementor-icon">';  
					                                            	html += '<input type="radio" name="flightTrecho4_'+i+'" id="flightTrecho4" value="'+voo4.id+'" onclick="setDataFlight('+i+', '+v4+', \'flightsT4\', \''+item.priceWithoutTax+'\', \''+item.totalPriceWithoutTax+'\', \''+item.totalTax+'\', \''+item.totalPrice+'\')" style="cursor:pointer">';
						                                        html += '</div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-145eadd" data-id="145eadd" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-f1d001a elementor-position-left elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="f1d001a" data-element_type="widget" data-widget_type="image-box.default" >';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<style> .elementor-widget-image-box .elementor-image-box-content {width: 100%;}@media (min-width: 768px) {.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper, .elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {display: flex;}.elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {text-align: right;flex-direction: row-reverse;}.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper {text-align: left;flex-direction: row;}.elementor-widget-image-box.elementor-position-top .elementor-image-box-img {margin: auto;}.elementor-widget-image-box.elementor-vertical-align-top .elementor-image-box-wrapper {align-items: flex-start;}.elementor-widget-image-box.elementor-vertical-align-middle .elementor-image-box-wrapper {align-items: center;}.elementor-widget-image-box.elementor-vertical-align-bottom .elementor-image-box-wrapper {align-items: flex-end;}}@media (max-width: 767px) {.elementor-widget-image-box .elementor-image-box-img {margin-left: auto !important;margin-right: auto !important;margin-bottom: 15px;}}.elementor-widget-image-box .elementor-image-box-img {display: inline-block;}.elementor-widget-image-box .elementor-image-box-title a {color: inherit;}.elementor-widget-image-box .elementor-image-box-wrapper {text-align: center;}.elementor-widget-image-box .elementor-image-box-description {margin: 0;}</style>';
						                                    html += '<div class="elementor-image-box-wrapper">';
						                                        html += '<figure class="elementor-image-box-img">';
						                                            html += '<img decoding="async" width="25" height="25" src="'+voo4.logoCompanhia+'" class="attachment-full size-full wp-image-1784" alt="" loading="lazy" />';
						                                        html += '</figure>';
						                                        html += '<div class="elementor-image-box-content"><h3 class="elementor-image-box-title">'+voo4.companhia+'</h3></div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-f7a6913" data-id="f7a6913" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-d1a8a7a elementor-widget elementor-widget-heading" data-id="d1a8a7a" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo4.horaIda+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-0f05fdb" data-id="0f05fdb" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-98d3060 elementor-widget elementor-widget-heading" data-id="98d3060" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo4.paradas+'</h2>';
						                                html += '</div>';
						                            html += '</div>'; 
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-acb4588" data-id="acb4588" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-50bc46f elementor-widget elementor-widget-heading" data-id="50bc46f" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo4.horaVolta+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9a72b81" data-id="9a72b81" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-087e430 elementor-widget elementor-widget-heading" data-id="087e430" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo4.duracao+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-2d9f7a6" data-id="2d9f7a6" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-e64596c elementor-icon-list--layout-inline elementor-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e64596c" data-element_type="widget"  data-widget_type="icon-list.default" >';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css" />';
						                                    html += '<ul class="elementor-icon-list-items elementor-inline-items">';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-shopping-bag"></i> </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-suitcase-rolling"></i> </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> '+voo4.bagagem+' </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                    html += '</ul>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-ba41d76" data-id="ba41d76" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-83e1053 elementor-view-default elementor-widget elementor-widget-icon" data-id="83e1053" data-element_type="widget" data-widget_type="icon.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<div class="elementor-icon-wrapper">';
						                                        html += '<div class="elementor-icon">';
						                                            html += '<i aria-hidden="true" class="fas fa-chevron-down" onclick="getDataFlight('+i+', '+v4+', \'flightsT4\')" style="cursor:pointer"></i>';
						                                        html += '</div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                html += '</div>';
						            html += '</section> ';
					            });

					    	/* FIM QUARTA ROTA */
					    }

				    	if(localStorage.getItem("DESTINO_FLIGHT_TRECHO5") != null){
					    	/* QUINTA ROTA */
					    		html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="bdb8934" data-element_type="section">';
					                html += '<div class="elementor-container elementor-column-gap-default">';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-694ffca" data-id="694ffca" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-487a01e elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="487a01e" data-element_type="widget" data-widget_type="icon-box.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css" />';
					                                    html += '<div class="elementor-icon-box-wrapper">';
					                                        html += '<div class="elementor-icon-box-icon">';
					                                            html += '<span class="elementor-icon elementor-animation-"> <i aria-hidden="true" class="'+item.flightsT5[0].iconType+'"></i> </span>';
					                                        html += '</div>';
					                                        html += '<div class="elementor-icon-box-content">';
					                                            html += '<h3 class="elementor-icon-box-title" style="    margin-top: 5px;">';
					                                                html += '<span> '+item.flightsT5[0].textType+' </span>';
					                                            html += '</h3>';
					                                        html += '</div>';
					                                    html += '</div>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-a6937f4 elementor-widget elementor-widget-heading" data-id="a6937f4" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<style>.elementor-heading-title {padding: 0;margin: 0;line-height: 1;}.elementor-widget-heading .elementor-heading-title[class*="elementor-size-"] > a {color: inherit;font-size: inherit;line-height: inherit;}.elementor-widget-heading .elementor-heading-title.elementor-size-small {font-size: 15px;}.elementor-widget-heading .elementor-heading-title.elementor-size-medium {font-size: 19px;}.elementor-widget-heading .elementor-heading-title.elementor-size-large {font-size: 29px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xl {font-size: 39px;}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl {font-size: 59px;}</style>';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT5[0].checkin+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-056e108" data-id="056e108" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-ab0e110 elementor-widget elementor-widget-heading" data-id="ab0e110" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT5[0].aeroDeparture+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-891ac14 elementor-widget elementor-widget-heading" data-id="891ac14" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT5[0].aeroDescDeparture+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-95bdfa3" data-id="95bdfa3" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-a06688c elementor-widget elementor-widget-heading" data-id="a06688c" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT5[0].aeroArrival+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                            html += '<div class="elementor-element elementor-element-6767e1e elementor-widget elementor-widget-heading" data-id="6767e1e" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+item.flightsT5[0].aeroDescArrival+'</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                    html += '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-94783ca elementor-hidden-mobile" data-id="94783ca" data-element_type="column">';
					                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
					                            html += '<div class="elementor-element elementor-element-5ae3cb0 elementor-widget elementor-widget-heading" data-id="5ae3cb0" data-element_type="widget" data-widget_type="heading.default">';
					                                html += '<div class="elementor-widget-container">';
					                                    html += '<h2 class="elementor-heading-title elementor-size-default">Bagagem</h2>';
					                                html += '</div>';
					                            html += '</div>';
					                        html += '</div>';
					                    html += '</div>';
					                html += '</div>';
					            html += '</section>';

					            jQuery(item.flightsT5).each(function(v5, voo5) { 
					            	html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-3eab11e elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="3eab11e" data-element_type="section" >';
						                html += '<div class="elementor-container elementor-column-gap-default">';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-121ea31" data-id="121ea31" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-04fc0e6 elementor-view-default elementor-widget elementor-widget-icon" data-id="04fc0e6" data-element_type="widget" data-widget_type="icon.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<div class="elementor-icon-wrapper">';
						                                        html += '<div class="elementor-icon">'; 
					                                            	html += '<input type="radio" name="flightTrecho5_'+i+'" id="flightTrecho5" value="'+voo5.id+'" onclick="setDataFlight('+i+', '+v5+', \'flightsT5\', \''+item.priceWithoutTax+'\', \''+item.totalPriceWithoutTax+'\', \''+item.totalTax+'\', \''+item.totalPrice+'\')" style="cursor:pointer">';
						                                        html += '</div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-145eadd" data-id="145eadd" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-f1d001a elementor-position-left elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="f1d001a" data-element_type="widget" data-widget_type="image-box.default" >';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<style> .elementor-widget-image-box .elementor-image-box-content {width: 100%;}@media (min-width: 768px) {.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper, .elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {display: flex;}.elementor-widget-image-box.elementor-position-right .elementor-image-box-wrapper {text-align: right;flex-direction: row-reverse;}.elementor-widget-image-box.elementor-position-left .elementor-image-box-wrapper {text-align: left;flex-direction: row;}.elementor-widget-image-box.elementor-position-top .elementor-image-box-img {margin: auto;}.elementor-widget-image-box.elementor-vertical-align-top .elementor-image-box-wrapper {align-items: flex-start;}.elementor-widget-image-box.elementor-vertical-align-middle .elementor-image-box-wrapper {align-items: center;}.elementor-widget-image-box.elementor-vertical-align-bottom .elementor-image-box-wrapper {align-items: flex-end;}}@media (max-width: 767px) {.elementor-widget-image-box .elementor-image-box-img {margin-left: auto !important;margin-right: auto !important;margin-bottom: 15px;}}.elementor-widget-image-box .elementor-image-box-img {display: inline-block;}.elementor-widget-image-box .elementor-image-box-title a {color: inherit;}.elementor-widget-image-box .elementor-image-box-wrapper {text-align: center;}.elementor-widget-image-box .elementor-image-box-description {margin: 0;}</style>';
						                                    html += '<div class="elementor-image-box-wrapper">';
						                                        html += '<figure class="elementor-image-box-img">';
						                                            html += '<img decoding="async" width="25" height="25" src="'+voo5.logoCompanhia+'" class="attachment-full size-full wp-image-1784" alt="" loading="lazy" />';
						                                        html += '</figure>';
						                                        html += '<div class="elementor-image-box-content"><h3 class="elementor-image-box-title">'+voo5.companhia+'</h3></div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-f7a6913" data-id="f7a6913" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-d1a8a7a elementor-widget elementor-widget-heading" data-id="d1a8a7a" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo5.horaIda+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-0f05fdb" data-id="0f05fdb" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-98d3060 elementor-widget elementor-widget-heading" data-id="98d3060" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo5.paradas+'</h2>';
						                                html += '</div>';
						                            html += '</div>'; 
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-acb4588" data-id="acb4588" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-50bc46f elementor-widget elementor-widget-heading" data-id="50bc46f" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo5.horaVolta+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9a72b81" data-id="9a72b81" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-087e430 elementor-widget elementor-widget-heading" data-id="087e430" data-element_type="widget" data-widget_type="heading.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<h2 class="elementor-heading-title elementor-size-default">'+voo5.duracao+'</h2>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-2d9f7a6" data-id="2d9f7a6" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-e64596c elementor-icon-list--layout-inline elementor-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e64596c" data-element_type="widget"  data-widget_type="icon-list.default" >';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<link rel="stylesheet" href="https://rslvportfolio.com.br/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css" />';
						                                    html += '<ul class="elementor-icon-list-items elementor-inline-items">';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-shopping-bag"></i> </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fas fa-suitcase-rolling"></i> </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                        html += '<li class="elementor-icon-list-item elementor-inline-item">';
						                                            html += '<span class="elementor-icon-list-icon"> '+voo5.bagagem+' </span>';
						                                            html += '<span class="elementor-icon-list-text"></span>';
						                                        html += '</li>';
						                                    html += '</ul>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                    html += '<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-ba41d76" data-id="ba41d76" data-element_type="column">';
						                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
						                            html += '<div class="elementor-element elementor-element-83e1053 elementor-view-default elementor-widget elementor-widget-icon" data-id="83e1053" data-element_type="widget" data-widget_type="icon.default">';
						                                html += '<div class="elementor-widget-container">';
						                                    html += '<div class="elementor-icon-wrapper">';
						                                        html += '<div class="elementor-icon">';
						                                            html += '<i aria-hidden="true" class="fas fa-chevron-down" onclick="getDataFlight('+i+', '+v5+', \'flightsT5\')" style="cursor:pointer"></i>';
						                                        html += '</div>';
						                                    html += '</div>';
						                                html += '</div>';
						                            html += '</div>';
						                        html += '</div>';
						                    html += '</div>';
						                html += '</div>';
						            html += '</section> ';
					            });

					    	/* FIM QUINTA ROTA */
					    }

					}

			        html += '</div>';
			    html += '</div>';

			    html += '<input type="hidden" id="desc_pax" value="'+item.desc_pax+'">';
			    /* PRICE */
			    html += '<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-8a66ad2 rowJur" data-id="8a66ad2" data-element_type="column" data-settings=\'{"background_background":"classic"}\' style="min-height: 220px;">';
			        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			            html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-83cc7be elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="83cc7be" data-element_type="section" >';
			                html += '<div class="elementor-container elementor-column-gap-default">';
			                    html += '<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6fbcd6c" data-id="6fbcd6c" data-element_type="column">';
			                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			                            html += '<div class="elementor-element elementor-element-98ddc32 elementor-widget elementor-widget-heading" data-id="98ddc32" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">Preço por adulto</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-c7d8201 elementor-widget elementor-widget-heading" data-id="c7d8201" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default"><small class="currencyRow">R$</small> '+item.priceWithoutTax+'</h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-962b3b2 elementor-widget elementor-widget-heading" data-id="962b3b2" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default"><span>'+item.desc_pax+'</span> <span style="float: right;">R$ '+item.totalPriceWithoutTax+'</span></h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-b3df4e1 elementor-widget elementor-widget-heading" data-id="b3df4e1" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">Taxas e encargos <span style="float: right;">R$ '+item.totalTax+'</span></h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-e23f9ae elementor-widget elementor-widget-heading" data-id="e23f9ae" data-element_type="widget" data-widget_type="heading.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<h2 class="elementor-heading-title elementor-size-default">Preço final<span style="float: right;">R$ '+item.totalPrice+'</span></h2>';
			                                html += '</div>';
			                            html += '</div>';
			                            html += '<div class="elementor-element elementor-element-2f478da elementor-align-justify elementor-widget elementor-widget-button" data-id="2f478da" data-element_type="widget" data-widget_type="button.default">';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<div class="elementor-button-wrapper">';
			                                        html += '<a onclick="order_flights('+i+')" class="elementor-button-link elementor-button elementor-size-sm" role="button" style="color:#fff">';
			                                            html += '<span class="elementor-button-content-wrapper">';
			                                                html += '<span class="elementor-button-text">'+(jQuery("#type_reserva_flights").val() == 2 ? 'Reservar' : 'Solicitar')+'</span>';
			                                            html += '</span>';
			                                        html += '</a>';
			                                    html += '</div>';
			                                html += '</div>';
			                            html += '</div>';
			                        html += '</div>';
			                    html += '</div>';
			                html += '</div>';
			            html += '</section>';
			            html += '<section class="elementor-section elementor-inner-section elementor-element elementor-element-213edd0 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="213edd0" data-element_type="section" >';
			                html += '<div class="elementor-container elementor-column-gap-default">';
			                    html += '<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7ce04de" data-id="7ce04de" data-element_type="column">';
			                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
			                            html += '<div class="elementor-element elementor-element-f1c10dc elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="f1c10dc" data-element_type="widget" data-widget_type="divider.default" >';
			                                html += '<div class="elementor-widget-container">';
			                                    html += '<div class="elementor-divider">';
			                                        html += '<span class="elementor-divider-separator"> </span>';
			                                    html += '</div>';
			                                html += '</div>';
			                            html += '</div>';
			                        html += '</div>';
			                    html += '</div>';
			                html += '</div>';
			            html += '</section>';
			            if(jQuery("#type_reserva_flights").val() == 2){
				            html += '<section  class="elementor-section elementor-inner-section elementor-element elementor-element-29d3bb9 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no" data-id="29d3bb9" data-element_type="section" >';
				                html += '<div class="elementor-container elementor-column-gap-default">';
				                    html += '<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8ce4cf7" data-id="8ce4cf7" data-element_type="column">';
				                        html += '<div class="elementor-widget-wrap elementor-element-populated">';
				                            html += '<div class="elementor-element elementor-element-2e5e6f2 elementor-widget elementor-widget-heading" data-id="2e5e6f2" data-element_type="widget" data-widget_type="heading.default">';
				                                html += '<div class="elementor-widget-container">';
				                                    html += '<h2 class="elementor-heading-title elementor-size-default">Em até 12x sem juros nos bancos selecionados.</h2>';
				                                html += '</div>';
				                            html += '</div>';
				                        html += '</div>';
				                    html += '</div>';
				                html += '</div>';
				            html += '</section>';
				        }
			        html += '</div>';
			    html += '</div>';
			    /* FIM PRICE */

			html += '</div>';

		}

    });

    /* PAGINATION */
	html += '<div class="container" style="margin: 30px 0px;font-family: \'Montserrat\';">'; 
		html += '<div class="row justify-content-center">'; 
			html += '<div class="col-lg-12 col-12 text-center">'; 
				html += '<div class="">'; 
					html += "<input type='hidden' id='pageActiveFlights' value='1'>"; 

					var total_pages = contador/10; 
					for(var i = 1; i <= total_pages; i++){ 
						if(i == jQuery("#pageActiveFlights").val()){ 
							html += '<span style="padding: 10px;font-size: 17px;font-weight: 800;color: #000000;cursor:pointer" onclick="show_page_flights('+i+')">'+i+'</span>'; 
						}else{ 
							html += '<span style="padding: 10px;font-size: 17px;cursor:pointer" onclick="show_page_flights('+i+')">'+i+'</span>'; 
						} 
					} 

				html += '</div>';  
			html += '</div>'; 
		html += '</div>'; 
	html += '</div>';
    /* FIM PAGINATION */

	jQuery(".resultsFlights").html(html); 

	localStorage.removeItem("SELECTED_FLIGHT_TRECHO1");
	localStorage.removeItem("SELECTED_FLIGHT_TRECHO2");
	localStorage.removeItem("SELECTED_FLIGHT_TRECHO3");
	localStorage.removeItem("SELECTED_FLIGHT_TRECHO4");
	localStorage.removeItem("SELECTED_FLIGHT_TRECHO5");
	localStorage.removeItem("PRICE_WITHOUT_TAX");
	localStorage.removeItem("TOTAL_PRICE_WITHOUT_TAX");
	localStorage.removeItem("TOTAL_TAX");
	localStorage.removeItem("TOTAL_PRICE");
	localStorage.removeItem("DESC_PAX");

}

function order_flights(i){
	console.log(i);
	console.log(jQuery("input[name=flightTrecho1_"+i+"]").is(':checked'));

	if(jQuery("input[name=flightTrecho1_"+i+"]").is(':checked') == false){
		swal({ 
            title: "É necessário selecionar um vôo da mesma tarifa para a compra.", 
            icon: "warning", 
        });  
        return false;
	}else if(localStorage.getItem("TYPE_FLIGHT") == 1 && jQuery("input[name=flightTrecho2_"+i+"]").is(':checked') == false){
		swal({ 
            title: "É necessário selecionar um vôo da mesma tarifa para a compra.", 
            icon: "warning", 
        });  
        return false;
	}else if(localStorage.getItem("TYPE_FLIGHT") == 3){
		if(localStorage.getItem("DATE_CHECKIN_TRECHO3") !== null){
			if(jQuery("input[name=flightTrecho3_"+i+"]").is(':checked') == false){
				swal({ 
		            title: "É necessário selecionar um vôo da mesma tarifa para a compra.", 
		            icon: "warning", 
		        });  
		        return false;
		    }
		}
		if(localStorage.getItem("DATE_CHECKIN_TRECHO4") !== null){
			if(jQuery("input[name=flightTrecho4_"+i+"]").is(':checked') == false){
				swal({ 
		            title: "É necessário selecionar um vôo da mesma tarifa para a compra.", 
		            icon: "warning", 
		        });  
		        return false;
		    }
		}
		if(localStorage.getItem("DATE_CHECKIN_TRECHO5") !== null){
			if(jQuery("input[name=flightTrecho5_"+i+"]").is(':checked') == false){
				swal({ 
		            title: "É necessário selecionar um vôo da mesma tarifa para a compra.", 
		            icon: "warning", 
		        });  
		        return false;
		    }
		}
	}else{
		window.location.href = "/order-flights/";
	}
}

function show_page_flights(page){

	jQuery("#pageActiveFlights").val(page);

	var contador_prox = page*10;

	var contador_prev = contador_prox-10;

	list_results_flights(contador_prox, contador_prev);

	jQuery("html, body").animate({ scrollTop: 0 }, "slow"); 

}

function get_info_aeroporto(aero){
    var aeroportos = JSON.parse(localStorage.getItem("AEROPORTOS"));
    var retorno = "";
	for(var x = 0; x < aeroportos.length; x++){

		if(aeroportos[x]["codigo"] == aero){
			retorno = aeroportos[x]["cidade"];
		}	

	}

	retorno = retorno.split(",");
	return retorno[0]+', '+retorno[2];
}

function setDataFlight(voo, segment, type, priceWithoutTax, totalPriceWithoutTax, totalTax, totalPrice){ 
    var data = JSON.parse(localStorage.getItem("JSON_RESULT_FLIGHTS")); 

    var dadosBootbox = data[voo].flightsT1[segment]; 

    if(type == "flightsT1"){ 
    	localStorage.setItem("SELECTED_FLIGHT_TRECHO1", JSON.stringify(data[voo].flightsT1[segment]));
    }else if(type == "flightsT2"){ 
    	localStorage.setItem("SELECTED_FLIGHT_TRECHO2", JSON.stringify(data[voo].flightsT2[segment]));
    }else if(type == "flightsT3"){ 
    	localStorage.setItem("SELECTED_FLIGHT_TRECHO3", JSON.stringify(data[voo].flightsT3[segment]));
    }else if(type == "flightsT4"){ 
    	localStorage.setItem("SELECTED_FLIGHT_TRECHO4", JSON.stringify(data[voo].flightsT4[segment]));
    }else if(type == "flightsT5"){ 
    	localStorage.setItem("SELECTED_FLIGHT_TRECHO5", JSON.stringify(data[voo].flightsT5[segment]));
    } 

    localStorage.setItem("PRICE_WITHOUT_TAX", priceWithoutTax);
    localStorage.setItem("TOTAL_PRICE_WITHOUT_TAX", totalPriceWithoutTax);
    localStorage.setItem("TOTAL_TAX", totalTax);
    localStorage.setItem("TOTAL_PRICE", totalPrice);
    localStorage.setItem("DESC_PAX", jQuery("#desc_pax").val());

    
}

function getDataFlight(voo, segment, type){ 
    var data = JSON.parse(localStorage.getItem("JSON_RESULT_FLIGHTS")); 

    var dadosBootbox = data[voo].flightsT1[segment]; 

    if(type == "flightsT1"){
    	dadosBootbox = data[voo].flightsT1[segment];
    }else if(type == "flightsT2"){
    	dadosBootbox = data[voo].flightsT2[segment];
    }else if(type == "flightsT3"){
    	dadosBootbox = data[voo].flightsT3[segment];
    }else if(type == "flightsT4"){
    	dadosBootbox = data[voo].flightsT4[segment];
    }else if(type == "flightsT5"){
    	dadosBootbox = data[voo].flightsT5[segment];
    }
    console.log(dadosBootbox); 

    var retorno = "";

    retorno += '<div class="container">';

    	retorno += '<div>';
	    	retorno += '<div class="row" style="margin-bottom:20px">';
	    		retorno += '<div class="col-lg-6">';
	    			retorno += '<img src="'+dadosBootbox.logoCompanhia+'" style="display:inline;height:25px"> <strong>'+dadosBootbox.companhia+'</strong>';
	    		retorno += '</div>';
	    		retorno += '<div class="col-lg-6" style="text-align: right;line-height: 0.9;font-size: 14px;">';
	    			retorno += '<small>Voo Nº: '+dadosBootbox.leg[0].flightNumber+'</small><br>';
	    			retorno += '<small>Classe: '+dadosBootbox.leg[0].seatClass.description+'</small><br>';
	    		retorno += '</div>';
	    	retorno += '</div>'; 

	    	if(dadosBootbox.leg[0].operatedBy.iata !== dadosBootbox.leg[0].managedBy.iata){
			    retorno += '<div>';
			    	retorno += '<div class="row">';
			    		retorno += '<div class="col-lg-12" style="padding: 3px 10px;text-align: center;background-color: #ddd;border-radius: 50px;margin: 16px 0;font-size: 13px;">';
			    			retorno += '<i class="fa fa-info"></i> Trecho operado por '+dadosBootbox.leg[0].managedBy.name; 
			    		retorno += '</div>'; 
			    	retorno += '</div>';
			    retorno += '</div>';
			}

	    	retorno += '<div class="row">';
	    		retorno += '<div class="col-lg-5" style="text-align: center;">';
	    			retorno += '<small>'+moment(moment(dadosBootbox.leg[0].departureDate, 'YYYY-MM-DD HH:mm:ss'), 'DD-MM-YYYY').format("LL")+'</small><br>';
	    			retorno += '<h5 style="font-weight:800;margin-bottom: 0;">'+moment(dadosBootbox.leg[0].departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm")+'</h5>';
	    			retorno += '<strong>'+dadosBootbox.leg[0].departure+'</strong><br>';
	    			retorno += '<strong><small>'+get_info_aeroporto(dadosBootbox.leg[0].departure)+'</small></strong>'; 
	    		retorno += '</div>';
	    		retorno += '<div class="col-lg-2" style="text-align: center;line-height: 1.2;padding: 32px 10px;">';
	    			retorno += '<strong><small style="font-size: 11px;font-weight: 500;">Duração</small></strong><br>'; 
	    			retorno += '<strong style="font-weight:800"><small>'+getTimeFromMinsFormatBoot(dadosBootbox.leg[0].duration)+'</small></strong><br>'; 
	    		retorno += '</div>';
	    		retorno += '<div class="col-lg-5" style="text-align: center;">';
	    			retorno += '<small>'+moment(moment(dadosBootbox.leg[0].arrivalDate, 'YYYY-MM-DD HH:mm:ss'), 'DD-MM-YYYY').format("LL")+'</small><br>';
	    			retorno += '<h5 style="font-weight:800;margin-bottom: 0;">'+moment(dadosBootbox.leg[0].arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm")+'</h5>';
	    			retorno += '<strong>'+dadosBootbox.leg[0].arrival+'</strong><br>';
	    			retorno += '<strong><small>'+get_info_aeroporto(dadosBootbox.leg[0].arrival)+'</small></strong>'; 
	    		retorno += '</div>';
	    	retorno += '</div>';
	    retorno += '</div>';

	    if(dadosBootbox.leg.length >= 2){

	    	var antes = moment(dadosBootbox.leg[0].arrivalDate);
			var depois= moment(dadosBootbox.leg[1].departureDate);

			var horas = depois.diff(antes, 'hours');
			var minutos = depois.diff(antes, 'minutes');

		    retorno += '<div>';
		    	retorno += '<div class="row">';
		    		retorno += '<div class="col-lg-12" style="padding: 3px 10px;text-align: center;background-color: #ddd;border-radius: 50px;margin: 16px 0;font-size: 13px;">';
		    			retorno += '<i class="fa fa-clock"></i>  Espera de <strong>'+horas+'h '+minutos+'m</strong>  em '+get_info_aeroporto(dadosBootbox.leg[0].arrival)+' (Troca de avião)'; 
		    		retorno += '</div>'; 
		    	retorno += '</div>';
		    retorno += '</div>';

	    	/* SEGUNDA PERNA */   
		    	retorno += '<div>';
			    	retorno += '<div class="row" style="margin-bottom:20px">';
			    		retorno += '<div class="col-lg-6">';
			    			retorno += '<img src="'+dadosBootbox.logoCompanhia+'" style="display:inline;height:25px"> <strong>'+dadosBootbox.companhia+'</strong>';
			    		retorno += '</div>';
			    		retorno += '<div class="col-lg-6" style="text-align: right;line-height: 0.9;font-size: 14px;">';
			    			retorno += '<small>Voo Nº: '+dadosBootbox.leg[1].flightNumber+'</small><br>';
			    			retorno += '<small>Classe: '+dadosBootbox.leg[1].seatClass.description+'</small><br>';
			    		retorno += '</div>';
			    	retorno += '</div>'; 

			    	if(dadosBootbox.leg[1].operatedBy.iata !== dadosBootbox.leg[1].managedBy.iata){
					    retorno += '<div>';
					    	retorno += '<div class="row">';
					    		retorno += '<div class="col-lg-12" style="padding: 3px 10px;text-align: center;background-color: #ddd;border-radius: 50px;margin: 16px 0;font-size: 13px;">';
					    			retorno += '<i class="fa fa-info"></i> Trecho operado por '+dadosBootbox.leg[0].managedBy.name; 
					    		retorno += '</div>'; 
					    	retorno += '</div>';
					    retorno += '</div>';
					}

			    	retorno += '<div class="row">';
			    		retorno += '<div class="col-lg-5" style="text-align: center;">';
			    			retorno += '<small>'+moment(moment(dadosBootbox.leg[1].departureDate, 'YYYY-MM-DD HH:mm:ss'), 'DD-MM-YYYY').format("LL")+'</small><br>';
			    			retorno += '<h5 style="font-weight:800;margin-bottom: 0;">'+moment(dadosBootbox.leg[1].departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm")+'</h5>';
			    			retorno += '<strong>'+dadosBootbox.leg[1].departure+'</strong><br>';
			    			retorno += '<strong><small>'+get_info_aeroporto(dadosBootbox.leg[1].departure)+'</small></strong>'; 
			    		retorno += '</div>';
			    		retorno += '<div class="col-lg-2" style="text-align: center;line-height: 1.2;padding: 32px 10px;">';
			    			retorno += '<strong><small style="font-size: 11px;font-weight: 500;">Duração</small></strong><br>'; 
			    			retorno += '<strong style="font-weight:800"><small>'+getTimeFromMinsFormatBoot(dadosBootbox.leg[1].duration)+'</small></strong><br>'; 
			    		retorno += '</div>';
			    		retorno += '<div class="col-lg-5" style="text-align: center;">';
			    			retorno += '<small>'+moment(moment(dadosBootbox.leg[1].arrivalDate, 'YYYY-MM-DD HH:mm:ss'), 'DD-MM-YYYY').format("LL")+'</small><br>';
			    			retorno += '<h5 style="font-weight:800;margin-bottom: 0;">'+moment(dadosBootbox.leg[1].arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm")+'</h5>';
			    			retorno += '<strong>'+dadosBootbox.leg[1].arrival+'</strong><br>';
			    			retorno += '<strong><small>'+get_info_aeroporto(dadosBootbox.leg[1].arrival)+'</small></strong>'; 
			    		retorno += '</div>';
			    	retorno += '</div>';
			    retorno += '</div>';
	    	/* FIM SEGUNDA PERNA */

	    	if(dadosBootbox.leg.length == 3){

		    	var antes = moment(dadosBootbox.leg[1].arrivalDate);
				var depois= moment(dadosBootbox.leg[2].departureDate);

				var horas = depois.diff(antes, 'hours');
				var minutos = depois.diff(antes, 'minutes');

			    retorno += '<div>';
			    	retorno += '<div class="row">';
			    		retorno += '<div class="col-lg-12" style="padding: 3px 10px;text-align: center;background-color: #ddd;border-radius: 50px;margin: 16px 0;font-size: 13px;">';
			    			retorno += '<i class="fa fa-clock"></i>  Espera de <strong>'+horas+'h '+minutos+'m</strong>  em '+get_info_aeroporto(dadosBootbox.leg[1].arrival)+' (Troca de avião)'; 
			    		retorno += '</div>'; 
			    	retorno += '</div>';
			    retorno += '</div>';

		    	/* SEGUNDA PERNA */   
			    	retorno += '<div>';
				    	retorno += '<div class="row" style="margin-bottom:20px">';
				    		retorno += '<div class="col-lg-6">';
				    			retorno += '<img src="'+dadosBootbox.logoCompanhia+'" style="display:inline;height:25px"> <strong>'+dadosBootbox.companhia+'</strong>';
				    		retorno += '</div>';
				    		retorno += '<div class="col-lg-6" style="text-align: right;line-height: 0.9;font-size: 14px;">';
				    			retorno += '<small>Voo Nº: '+dadosBootbox.leg[2].flightNumber+'</small><br>';
				    			retorno += '<small>Classe: '+dadosBootbox.leg[2].seatClass.description+'</small><br>';
				    		retorno += '</div>';
				    	retorno += '</div>'; 

				    	if(dadosBootbox.leg[2].operatedBy.iata !== dadosBootbox.leg[2].managedBy.iata){
						    retorno += '<div>';
						    	retorno += '<div class="row">';
						    		retorno += '<div class="col-lg-12" style="padding: 3px 10px;text-align: center;background-color: #ddd;border-radius: 50px;margin: 16px 0;font-size: 13px;">';
						    			retorno += '<i class="fa fa-info"></i> Trecho operado por '+dadosBootbox.leg[0].managedBy.name; 
						    		retorno += '</div>'; 
						    	retorno += '</div>';
						    retorno += '</div>';
						}

				    	retorno += '<div class="row">';
				    		retorno += '<div class="col-lg-5" style="text-align: center;">';
				    			retorno += '<small>'+moment(moment(dadosBootbox.leg[2].departureDate, 'YYYY-MM-DD HH:mm:ss'), 'DD-MM-YYYY').format("LL")+'</small><br>';
				    			retorno += '<h5 style="font-weight:800;margin-bottom: 0;">'+moment(dadosBootbox.leg[2].departureDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm")+'</h5>';
				    			retorno += '<strong>'+dadosBootbox.leg[2].departure+'</strong><br>';
				    			retorno += '<strong><small>'+get_info_aeroporto(dadosBootbox.leg[2].departure)+'</small></strong>'; 
				    		retorno += '</div>';
				    		retorno += '<div class="col-lg-2" style="text-align: center;line-height: 1.2;padding: 32px 10px;">';
				    			retorno += '<strong><small style="font-size: 11px;font-weight: 500;">Duração</small></strong><br>'; 
				    			retorno += '<strong style="font-weight:800"><small>'+getTimeFromMinsFormatBoot(dadosBootbox.leg[2].duration)+'</small></strong><br>'; 
				    		retorno += '</div>';
				    		retorno += '<div class="col-lg-5" style="text-align: center;">';
				    			retorno += '<small>'+moment(moment(dadosBootbox.leg[2].arrivalDate, 'YYYY-MM-DD HH:mm:ss'), 'DD-MM-YYYY').format("LL")+'</small><br>';
				    			retorno += '<h5 style="font-weight:800;margin-bottom: 0;">'+moment(dadosBootbox.leg[2].arrivalDate, 'YYYY-MM-DD HH:mm:ss').format("HH:mm")+'</h5>';
				    			retorno += '<strong>'+dadosBootbox.leg[2].arrival+'</strong><br>';
				    			retorno += '<strong><small>'+get_info_aeroporto(dadosBootbox.leg[2].arrival)+'</small></strong>'; 
				    		retorno += '</div>';
				    	retorno += '</div>';
				    retorno += '</div>';
		    	/* FIM SEGUNDA PERNA */

	    	}
	    }

	    retorno += '<div>';
	    	retorno += '<div class="row">';
	    		retorno += '<div class="col-lg-12" style="padding: 3px 10px;text-align: center;background-color: #ddd;border-radius: 50px;margin: 16px 0;font-size: 13px;">';
	    			retorno += ' Duração: <strong>'+getTimeFromMinsFormatBoot(dadosBootbox.segment.duration)+'</strong>'; 
	    		retorno += '</div>'; 
	    	retorno += '</div>';
	    retorno += '</div>';

    	/* INFO BAGAGEM */ 
	    	retorno += '<div class="row" style="font-size:14px;">'; 
	    		retorno += '<div class="col-lg-2">';
	    			retorno += 'Bagagem';
	    		retorno += '</div>';
	    		retorno += '<div class="col-lg-10">';
	    			retorno += '<i aria-hidden="true" class="fas fa-shopping-bag" style="color:'+jQuery("#color_flights").val()+'"></i> <span style="color:'+jQuery("#color_flights").val()+'">Inclui uma mochila ou bolsa </span><br>Deve caber embaixo do assento dianteiro.<br><br>';
					retorno += '<i aria-hidden="true" class="fas fa-suitcase-rolling" style="color:'+jQuery("#color_flights").val()+'"></i> <span style="color:'+jQuery("#color_flights").val()+'">Inclui bagagem de mão</span> <br> Deve caber no compartimento superior do avião.<br><br>';
					if(dadosBootbox.segment.fareProfile.baggage.isIncluded){
						var desc_baggage_included = "";
						if(dadosBootbox.segment.fareProfile.baggage.type == "PIECE" || dadosBootbox.segment.fareProfile.baggage.type == "WEIGHT"){
							desc_baggage_included = 'Inlcui '+dadosBootbox.segment.fareProfile.baggage.quantity+' '+(dadosBootbox.segment.fareProfile.baggage.quantity > 1 ? 'peças' : 'peça')+', com peso total de '+dadosBootbox.segment.fareProfile.baggage.weight+''+dadosBootbox.segment.fareProfile.baggage.uom;
						} 
	    				retorno += '<i aria-hidden="true" class="fas fa-luggage-cart" style="color:'+jQuery("#color_flights").val()+'"></i>  <span style="color:'+jQuery("#color_flights").val()+'">Inclui bagagem para despachar</span> <br> '+desc_baggage_included;
	    			}else{
	    				retorno += '<i aria-hidden="true" class="fas fa-luggage-cart"></i> Não inclui bagagem para despachar <br> Você poderá comprar malas online.';
	    			}
	    		retorno += '</div>';
	    	retorno += '</div>'; 
    	/* INFO BAGAGEM */

    retorno += '</div>';

	bootbox.dialog({

      	title: 'Detalhes do vôo',

      	message: retorno

  	});
}