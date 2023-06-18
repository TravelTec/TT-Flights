
function show_tab(type){
     
}

/********** Panel_Dropdown ***********/
function close_panel_dropdown_flights() {
    jQuery("#panelDropdownFlights").removeClass("active")
}
function close_panel_dropdown_multi() {
    jQuery("#panelDropdownMultiFlights").removeClass("active")
}

jQuery("#panelDropdownFlights a").on("click", function (event) {
    if (jQuery("#panelDropdownFlights").hasClass("active")) { 
        close_panel_dropdown_flights()
    } else {  
        jQuery("#panelDropdownFlights").addClass("active")
    };
    event.preventDefault()
});
var mouse_is_inside = false;
jQuery("#panelDropdownFlights").hover(function () {
    mouse_is_inside = true  
}, function () {
    mouse_is_inside = false 
});
jQuery("body").mouseup(function () {
    if (!mouse_is_inside) {
        close_panel_dropdown_flights()
    }
});

jQuery("#panelDropdownMultiFlights a").on("click", function (event) {
    if (jQuery("#panelDropdownMultiFlights").hasClass("active")) { 
        close_panel_dropdown_multi()
    } else {
        jQuery("#panelDropdownMultiFlights").addClass("active")
    };
    event.preventDefault()
});
var mouse_is_inside = false;
jQuery("#panelDropdownMultiFlights").hover(function () {
    mouse_is_inside = true
}, function () {
    mouse_is_inside = false
});
jQuery("body").mouseup(function () {
    if (!mouse_is_inside) {
        close_panel_dropdown_multi()
    }
});


/********** Quality ***********/
function qtySumFlights(){
    var arr = document.getElementsByName('qtyInputFlights');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
        tot += parseInt(arr[i].value);
    }
    var cardQty = document.querySelector(".qtyTotalFlights"); 
    var url_atual = window.location.href;
    cardQty.innerHTML = tot;

    var qtd_adt = parseInt(jQuery("#panelTripFlights .qtyAdtFlights input").val());
    var qtd_chd = parseInt(jQuery("#panelTripFlights .qtyChd input").val());  

    jQuery("#criancas").val(qtd_chd);
    jQuery("#adultos").val(qtd_adt);
} 
qtySumFlights();

function qtySumMulti(){
    var arr = document.getElementsByName('qtyInputMultiFlights');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
        tot += parseInt(arr[i].value);
    }
    var cardQty = document.querySelector(".qtyTotalMultiFlights");
    var url_atual = window.location.href;
    cardQty.innerHTML = tot;

    var qtd_adt = parseInt(jQuery("#panelTripMultiFlights .qtyAdtFlights input").val());
    var qtd_chd = parseInt(jQuery("#panelTripMultiFlights .qtyChd input").val());  

    jQuery("#criancas").val(qtd_chd);
    jQuery("#adultos").val(qtd_adt);
} 
qtySumMulti();

jQuery(function() { 
	if(jQuery("#type_motor").val() == 1){
		localStorage.clear();
	}
   	jQuery(".qtyDecMulti, .qtyIncMulti").on("click", function() { 

        var jQuerybutton = jQuery(this);
        var oldValue = jQuerybutton.parent().find("input").val();  

        if (jQuerybutton.hasClass('qtyIncMulti')) {
            var newVal = parseFloat(oldValue) + 1; 

            if (newVal > 4) {
                newVal = 4;
            } 
            
            if(jQuerybutton.parent().hasClass("qtyAdt")){ 
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className;
                jQuery("#"+currentPanel+"adt").val(newVal);
            }

            if(jQuerybutton.parent().hasClass("qtyChd")){   
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className; 
 
                jQuery("#"+currentPanel+" .idade_chd"+newVal).attr("style", "");
                jQuery("#"+currentPanel+"chd").val(newVal);
            }  
        } else {                   
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
            
            if(jQuerybutton.parent().hasClass("qtyAdt")){ 
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className;
                jQuery("#"+currentPanel+" #"+currentPanel+"adt").val(newVal);
            }

            if(jQuerybutton.parent().hasClass("qtyChd")){  
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className;
 
                jQuery("#"+currentPanel+" .idade_chd"+(oldValue == 0 ? 1 : oldValue)).attr("style", "display:none");
                jQuery("#"+currentPanel+" #"+currentPanel+"adt").val(newVal);
            } 
        } 

        jQuerybutton.parent().find("input").val(newVal);
        qtySumMulti();
        jQuery(".qtyTotalMultiFlights").addClass("rotate-x");
   });

    function removeAnimationMulti() { 
        jQuery(".qtyTotalMultiFlights").removeClass("rotate-x");  
    }
    const counterMulti = document.querySelector(".qtyTotalMultiFlights"); 
    counterMulti.addEventListener("animationend", removeAnimationMulti);

   jQuery(".qtyDecFlight, .qtyIncFlight").on("click", function() {  

        var jQuerybutton = jQuery(this);
        var oldValue = jQuerybutton.parent().find("input").val();  

        if (jQuerybutton.hasClass('qtyIncFlight')) {
            var newVal = parseFloat(oldValue) + 1; 

            if (newVal > 4) {
                newVal = 4;
            } 
            
            if(jQuerybutton.parent().hasClass("qtyAdt")){ 
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className;
                jQuery("#"+currentPanel+"adt").val(newVal);
            }

            if(jQuerybutton.parent().hasClass("qtyChd")){   
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className; 
 
                jQuery("#"+currentPanel+" .idade_chd"+newVal).attr("style", "");
                jQuery("#"+currentPanel+"chd").val(newVal);
            }  
        } else {                   
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
            
            if(jQuerybutton.parent().hasClass("qtyAdt")){ 
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className;
                jQuery("#"+currentPanel+" #"+currentPanel+"adt").val(newVal);
            }

            if(jQuerybutton.parent().hasClass("qtyChd")){  
                var currentPanel = jQuery(this).parents('div[class^="panel"]').eq(0)[0].className;
 
                jQuery("#"+currentPanel+" .idade_chd"+(oldValue == 0 ? 1 : oldValue)).attr("style", "display:none");
                jQuery("#"+currentPanel+" #"+currentPanel+"adt").val(newVal);
            } 
        } 

        jQuerybutton.parent().find("input").val(newVal);
        qtySumFlights();
        jQuery(".qtyTotalFlights").addClass("rotate-x");
   });

    function removeAnimation() { 
        jQuery(".qtyTotalFlights").removeClass("rotate-x");  
    }
    const counter = document.querySelector(".qtyTotalFlights"); 
    counter.addEventListener("animationend", removeAnimation);
});

var temporiza;
jQuery("#field_name_origin_flight").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_origem_flight();

   }, 100);

});
 

var temporiza;
jQuery("#field_origin_trecho1").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_origem("field_origin_trecho1", 1);

   }, 100);

}); 
var temporiza;
jQuery("#field_origin_trecho2").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_origem("field_origin_trecho2", 2);

   }, 100);

}); 
var temporiza;
jQuery("#field_origin_trecho3").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_origem("field_origin_trecho3", 3);

   }, 100);

}); 
var temporiza;
jQuery("#field_origin_trecho4").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_origem("field_origin_trecho4", 4);

   }, 100);

}); 
var temporiza;
jQuery("#field_origin_trecho5").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_origem("field_origin_trecho5", 5);

   }, 100);

}); 

var temporiza;
jQuery("#field_destin_trecho1").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_destino("field_destin_trecho1", 1);

   }, 100);

}); 
var temporiza;
jQuery("#field_destin_trecho2").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_destino("field_destin_trecho2", 2);

   }, 100);

}); 
var temporiza;
jQuery("#field_destin_trecho3").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_destino("field_destin_trecho3", 3);

   }, 100);

}); 
var temporiza;
jQuery("#field_destin_trecho4").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_destino("field_destin_trecho4", 4);

   }, 100);

}); 
var temporiza;
jQuery("#field_destin_trecho5").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_destino("field_destin_trecho5", 5);

   }, 100);

}); 

var temporiza;
jQuery("#field_name_destin_flight").on("input", function(){

   clearTimeout(temporiza);

   temporiza = setTimeout(function(){

      pesquisar_destino_flight();

   }, 100);

});

jQuery(function() {
    moment.locale('pt-br');

    var url_atual = window.location.href;

    'use strict'; 

    if(url_atual.indexOf("/offers-flights/") != -1){
		var type_flight = localStorage.getItem("TYPE_FLIGHT"); 

		var start1 = moment();
		if(type_flight == 2){
			jQuery('input[name="dateGo"]').val(localStorage.getItem("DATE_CHECKIN"));  
		    jQuery('#field_date_checkin_flight').val(localStorage.getItem("DATE_CHECKIN")); 

	        if(localStorage.getItem("DATE_CHECKIN") !== null){
	            var checkin = localStorage.getItem("DATE_CHECKIN");
	            var start = moment(checkin, 'DD-MM-YYYY').format('MM/DD/YYYY'); 
	            var past = moment(checkin, 'DD-MM-YYYY').format('YYYY-MM-DD'); 
	        }else{ 
	            var start = moment().format('DD/MM/YYYY');
	            var past = start;
	        } 
		}else if(type_flight == 1){
			jQuery('input[name="dateGo"]').val(localStorage.getItem("DATE_CHECKIN"));  
		    jQuery('#field_date_checkin_flight').val(localStorage.getItem("DATE_CHECKIN")); 

	        if(localStorage.getItem("DATE_CHECKIN") !== null){
	            var checkin = localStorage.getItem("DATE_CHECKIN");
	            var start = moment(checkin, 'DD-MM-YYYY').format('MM/DD/YYYY'); 
	            var past = moment(checkin, 'DD-MM-YYYY').format('YYYY-MM-DD'); 
	        }else{ 
	            var start = moment().format('DD/MM/YYYY');
	            var past = start;
	        } 

			jQuery('input[name="dateBack"]').val(localStorage.getItem("DATE_CHECKOUT"));  
		    jQuery('#field_date_checkout_flight').val(localStorage.getItem("DATE_CHECKOUT")); 

	        if(localStorage.getItem("DATE_CHECKOUT") !== null){
	            var checkout = localStorage.getItem("DATE_CHECKOUT");
	            var end = moment(checkout, 'DD-MM-YYYY').format('MM/DD/YYYY'); 
	            var now = moment(checkout, 'DD-MM-YYYY').format('YYYY-MM-DD'); 
	        }else{ 
	            var end = moment().format('DD/MM/YYYY');
	            var now = end;
	        }
		}else{
			for(var i = 1; i < 6; i++){ 
				if(localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO"+i) !== null){
					var prev = parseInt(i)-1;  
					jQuery("#trecho"+i).attr("style", ""); 
					jQuery(".hideTrecho"+prev+" .hideSpan"+prev).attr("style", "display:none;");
					jQuery(".hideTrecho"+prev+" .showSpan"+prev).attr("style", "display:none");

					jQuery('input[name="date_trecho'+i+'"]').val(localStorage.getItem("DATE_CHECKIN_TRECHO"+i));  
			    	jQuery('#field_date_checkin_flight_trecho'+i).val(localStorage.getItem("DATE_CHECKIN_TRECHO"+i)); 
			    }
		    }

	        if(localStorage.getItem("DATE_CHECKIN_TRECHO1") !== null){
	            var checkin = localStorage.getItem("DATE_CHECKIN_TRECHO1");
	            var start1 = moment(checkin, 'DD-MM-YYYY').format('MM/DD/YYYY'); 
	            var past1 = moment(checkin, 'DD-MM-YYYY').format('YYYY-MM-DD'); 
	        }else{ 
	            var start1 = moment().format('DD/MM/YYYY');
	            var past1 = start1;
	        } 

		}
      
        var endDate = moment(past, 'YYYY-MM-DD');
        var startDate = moment(now, 'YYYY-MM-DD'); 
        var days = startDate.diff(endDate, 'days'); 
    }

    jQuery('input[name="dateGo"]').daterangepicker({
    	singleDatePicker: true,
        autoUpdateInput: false,
        startDate: start,
        endDate: end,
        minDate: moment(),
        format: 'DD/MM/YYYY', 
        autoApply: true,
        separator: ' - ',
        locale: {
            cancelLabel: 'Cancelar',
            applyLabel: 'Aplicar',
            fromLabel: 'De',
            toLabel: 'Até',
            customRangeLabel: 'Opção',
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            firstDay: 1
        }
    });  
    jQuery('input[name="dateGo"]').on('apply.daterangepicker', function(ev, picker) {
        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
        const duration = moment.duration(now.diff(past)); 

        jQuery('input[name="dateGo"]').val(picker.startDate.format('DD/MM/YYYY'));  
	    jQuery('#field_date_checkin_flight').val(picker.startDate.format('DD/MM/YYYY')); 
	    localStorage.setItem("DATE_CHECKIN", picker.startDate.format('DD/MM/YYYY'));

	    var dateGo = jQuery('input[name="dateGo"]').val();
	    jQuery('input[name="dateBack"]').daterangepicker({
	    	singleDatePicker: true,
	        autoUpdateInput: false,
	        startDate: picker.startDate, 
	        minDate: picker.startDate, 
	        format: 'DD/MM/YYYY', 
	        autoApply: true,
	        separator: ' - ',
	        locale: {
	            cancelLabel: 'Cancelar',
	            applyLabel: 'Aplicar',
	            fromLabel: 'De',
	            toLabel: 'Até',
	            customRangeLabel: 'Opção',
	            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
	            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
	            firstDay: 1
	        }
	    }); 
	    jQuery('input[name="dateBack"]').on('apply.daterangepicker', function(ev, picker) {
	        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
	        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
	        const duration = moment.duration(now.diff(past)); 

	        jQuery('input[name="dateBack"]').val(picker.startDate.format('DD/MM/YYYY')); 
	        jQuery('#field_date_checkout_flight').val(picker.startDate.format('DD/MM/YYYY')); 
	   	 	localStorage.setItem("DATE_CHECKOUT", picker.startDate.format('DD/MM/YYYY'));	
	    });
    });
 
    jQuery('input[name="date_trecho1"]').daterangepicker({
    	singleDatePicker: true,
        autoUpdateInput: false,
        startDate: start1, 
        minDate: start1,
        format: 'DD/MM/YYYY', 
        autoApply: true,
        separator: ' - ',
        locale: {
            cancelLabel: 'Cancelar',
            applyLabel: 'Aplicar',
            fromLabel: 'De',
            toLabel: 'Até',
            customRangeLabel: 'Opção',
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            firstDay: 1
        }
    });  
    jQuery('input[name="date_trecho1"]').on('apply.daterangepicker', function(ev, picker) {
        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
        const duration = moment.duration(now.diff(past)); 

        jQuery('input[name="date_trecho1"]').val(picker.startDate.format('DD/MM/YYYY'));  
        jQuery("#field_date_checkin_flight_trecho1").val(picker.startDate.format('DD/MM/YYYY'));
	    localStorage.setItem("DATE_CHECKIN_TRECHO1", picker.startDate.format('DD/MM/YYYY'));

	    var dateGo = jQuery('input[name="date_trecho1"]').val();
	    jQuery('input[name="date_trecho2"]').daterangepicker({
	    	singleDatePicker: true,
	        autoUpdateInput: false,
	        startDate: picker.startDate, 
	        minDate: picker.startDate, 
	        format: 'DD/MM/YYYY', 
	        autoApply: true,
	        separator: ' - ',
	        locale: {
	            cancelLabel: 'Cancelar',
	            applyLabel: 'Aplicar',
	            fromLabel: 'De',
	            toLabel: 'Até',
	            customRangeLabel: 'Opção',
	            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
	            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
	            firstDay: 1
	        }
	    }); 
	    jQuery('input[name="date_trecho2"]').on('apply.daterangepicker', function(ev, picker) {
	        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
	        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
	        const duration = moment.duration(now.diff(past)); 

	        jQuery('input[name="date_trecho2"]').val(picker.startDate.format('DD/MM/YYYY')); 
        	jQuery("#field_date_checkin_flight_trecho2").val(picker.startDate.format('DD/MM/YYYY'));
	    	localStorage.setItem("DATE_CHECKIN_TRECHO2", picker.startDate.format('DD/MM/YYYY'));

	        var dateGo = jQuery('input[name="date_trecho2"]').val();
		    jQuery('input[name="date_trecho3"]').daterangepicker({
		    	singleDatePicker: true,
		        autoUpdateInput: false,
		        startDate: picker.startDate, 
		        minDate: picker.startDate, 
		        format: 'DD/MM/YYYY', 
		        autoApply: true,
		        separator: ' - ',
		        locale: {
		            cancelLabel: 'Cancelar',
		            applyLabel: 'Aplicar',
		            fromLabel: 'De',
		            toLabel: 'Até',
		            customRangeLabel: 'Opção',
		            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
		            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
		            firstDay: 1
		        }
		    }); 
		    jQuery('input[name="date_trecho3"]').on('apply.daterangepicker', function(ev, picker) {
		        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
		        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
		        const duration = moment.duration(now.diff(past)); 

		        jQuery('input[name="date_trecho3"]').val(picker.startDate.format('DD/MM/YYYY')); 
        		jQuery("#field_date_checkin_flight_trecho3").val(picker.startDate.format('DD/MM/YYYY'));
	    		localStorage.setItem("DATE_CHECKIN_TRECHO3", picker.startDate.format('DD/MM/YYYY'));

		        var dateGo = jQuery('input[name="date_trecho3"]').val();
			    jQuery('input[name="date_trecho4"]').daterangepicker({
			    	singleDatePicker: true,
			        autoUpdateInput: false,
			        startDate: picker.startDate, 
			        minDate: picker.startDate, 
			        format: 'DD/MM/YYYY', 
			        autoApply: true,
			        separator: ' - ',
			        locale: {
			            cancelLabel: 'Cancelar',
			            applyLabel: 'Aplicar',
			            fromLabel: 'De',
			            toLabel: 'Até',
			            customRangeLabel: 'Opção',
			            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
			            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			            firstDay: 1
			        }
			    }); 
			    jQuery('input[name="date_trecho4"]').on('apply.daterangepicker', function(ev, picker) {
			        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
			        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
			        const duration = moment.duration(now.diff(past)); 

			        jQuery('input[name="date_trecho4"]').val(picker.startDate.format('DD/MM/YYYY')); 
        			jQuery("#field_date_checkin_flight_trecho4").val(picker.startDate.format('DD/MM/YYYY'));
	    			localStorage.setItem("DATE_CHECKIN_TRECHO4", picker.startDate.format('DD/MM/YYYY'));

			        var dateGo = jQuery('input[name="date_trecho4"]').val();
				    jQuery('input[name="date_trecho5"]').daterangepicker({
				    	singleDatePicker: true,
				        autoUpdateInput: false,
				        startDate: picker.startDate, 
				        minDate: picker.startDate, 
				        format: 'DD/MM/YYYY', 
				        autoApply: true,
				        separator: ' - ',
				        locale: {
				            cancelLabel: 'Cancelar',
				            applyLabel: 'Aplicar',
				            fromLabel: 'De',
				            toLabel: 'Até',
				            customRangeLabel: 'Opção',
				            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
				            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				            firstDay: 1
				        }
				    }); 
				    jQuery('input[name="date_trecho5"]').on('apply.daterangepicker', function(ev, picker) {
				        const now = moment(picker.endDate.format('YYYY-MM-DD')); // Data de hoje
				        const past = moment(picker.startDate.format('YYYY-MM-DD')); // Outra data no passado
				        const duration = moment.duration(now.diff(past)); 

				        jQuery('input[name="date_trecho5"]').val(picker.startDate.format('DD/MM/YYYY')); 
        				jQuery("#field_date_checkin_flight_trecho5").val(picker.startDate.format('DD/MM/YYYY'));
	    				localStorage.setItem("DATE_CHECKIN_TRECHO5", picker.startDate.format('DD/MM/YYYY'));
				    });
			    });
		    });
	    });
    }); 
}); 


function replaceSpecialChars(str) {

    str = str.replace(/[ÀÁÂÃÄÅ]/, "A");

    str = str.replace(/[àáâãäå]/, "a");

    str = str.replace(/[ÈÉÊË]/, "E");

    str = str.replace(/[ÍÌ]/, "I");

    str = str.replace(/[íì]/, "i");

    str = str.replace(/[ÒÓÔÕ]/, "O");

    str = str.replace(/[òóôõ]/, "o");

    str = str.replace(/[Ú]/, "U");

    str = str.replace(/[ú]/, "u");

    str = str.replace(/[Ç]/, "C");

    str = str.replace(/[ç]/, "c");



    // o resto



    return str;

} 

function pesquisar_origem_flight(){ 

	var contador_exibicao = 0;



    var destino = jQuery("#field_name_origin_flight").val().trim();



    var contador = 0;

    if (destino.length >= 3 && contador_exibicao == 0) {  

        jQuery('.dadosOrigin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('.dadosOrigin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\';, sans-serif;cursor:pointer;list-style:none;margin: 0;"><img src="https://media.tenor.com/images/a742721ea2075bc3956a2ff62c9bfeef/tenor.gif" style="height: 22px;margin-right: 5px;position:absolute;"> <span style="margin-left: 34px;">Buscando resultados...</span></li>');
 

        var data = {

            'action': 'get_city_airport',

            'local': jQuery("#field_name_origin_flight").val()

        };

 
        jQuery.ajax({

            url : jQuery("#url_ajax").val(),

            type : 'post',

            data : data,

            success : function( resposta ) {

            	var json = jQuery.parseJSON(resposta.slice(0,-1));
            	var retorno = "";

            	//busca aeroporto
                if(destino.length === 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
            			var codigo_pesquisar = replaceSpecialChars(item.codigo);

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (codigo_pesquisar === valor_pesquisado) { 
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_origem_flight('"+item.cidade+"\',\'"+item.codigo+"\',\'\')\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++;
            			}
                	});
                	jQuery(".dadosOrigin ul").html(retorno);

                //busca cidade	
                }else if(destino.length > 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
		            	var cidade_pesquisar = replaceSpecialChars(item.cidade.toUpperCase());
		            	var codigo_pesquisar = item.codigo;

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (cidade_pesquisar.includes(valor_pesquisado)) {
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_origem_flight('"+item.cidade+"\',\'"+item.codigo+"\',\'\')\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++; 
            			}

		            });
                	jQuery(".dadosOrigin ul").html(retorno);

                //busca nada
                }else if(destino == ""){
            		jQuery('.dadosOrigin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('.dadosOrigin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                //retorna solicitando que digite mais que 3 caracteres
                }else{
            		jQuery('.dadosOrigin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('.dadosOrigin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                }

            }

        }); 

    }else{

		contador_exibicao = 0;

        jQuery('.dadosOrigin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('.dadosOrigin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');

    }

}

function pesquisar_destino_flight(){ 

	var contador_exibicao = 0;



    var destino = jQuery("#field_name_destin_flight").val();



    var contador = 0;

    if (destino.length >= 3 && contador_exibicao == 0) {  

        jQuery('.dadosDestin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('.dadosDestin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\';, sans-serif;cursor:pointer;list-style:none;margin: 0;"><img src="https://media.tenor.com/images/a742721ea2075bc3956a2ff62c9bfeef/tenor.gif" style="height: 22px;margin-right: 5px;position:absolute;"> <span style="margin-left: 34px;">Buscando resultados...</span></li>');
 

        var data = {

            'action': 'get_city_airport',

            'local': jQuery("#field_name_destin_flight").val()

        };



        jQuery.ajax({

            url : jQuery("#url_ajax").val(),

            type : 'post',

            data : data,

            success : function( resposta ) {

            	var json = jQuery.parseJSON(resposta.slice(0,-1));
            	var retorno = "";

            	//busca aeroporto
                if(destino.length === 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
            			var codigo_pesquisar = replaceSpecialChars(item.codigo);

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (codigo_pesquisar === valor_pesquisado) { 
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_destino_flight('"+item.cidade+"\',\'"+item.codigo+"\',\'\')\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++;
            			}
                	});
                	jQuery(".dadosDestin ul").html(retorno);

                //busca cidade	
                }else if(destino.length > 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
		            	var cidade_pesquisar = replaceSpecialChars(item.cidade.toUpperCase());
		            	var codigo_pesquisar = item.codigo;

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (cidade_pesquisar.includes(valor_pesquisado)) {
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_destino_flight('"+item.cidade+"\',\'"+item.codigo+"\',\'\')\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++; 
            			}

		            });
                	jQuery(".dadosDestin ul").html(retorno);

                //busca nada
                }else if(destino == ""){
            		jQuery('.dadosDestin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('.dadosDestin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                //retorna solicitando que digite mais que 3 caracteres
                }else{
            		jQuery('.dadosDestin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('.dadosDestin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                }

            }

        });

    }else{

		contador_exibicao = 0;

        jQuery('.dadosDestin').attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('.dadosDestin ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');

    }

}

function pesquisar_origem(field, x){ 

	var contador_exibicao = 0; 
    var destino = jQuery("#"+field).val();



    var contador = 0;

    if (destino.length >= 3 && contador_exibicao == 0) {  

        jQuery('#dados_trecho'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('#dados_trecho'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\';, sans-serif;cursor:pointer;list-style:none;margin: 0;"><img src="https://media.tenor.com/images/a742721ea2075bc3956a2ff62c9bfeef/tenor.gif" style="height: 22px;margin-right: 5px;position:absolute;"> <span style="margin-left: 34px;">Buscando resultados...</span></li>');
 

        var data = {

            'action': 'get_city_airport',

            'local': jQuery("#"+field).val()

        };



        jQuery.ajax({

            url : jQuery("#url_ajax").val(),

            type : 'post',

            data : data,

            success : function( resposta ) {

            	var json = jQuery.parseJSON(resposta.slice(0,-1));
            	var retorno = "";

            	//busca aeroporto
                if(destino.length === 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
            			var codigo_pesquisar = replaceSpecialChars(item.codigo);

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (codigo_pesquisar === valor_pesquisado) { 
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_origem('"+item.cidade+"\',\'"+item.codigo+"\',\'\',\'"+field+"\', "+x+")\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++;
            			}
                	});
                	jQuery('#dados_trecho'+x+' ul').html(retorno);

                //busca cidade	
                }else if(destino.length > 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
		            	var cidade_pesquisar = replaceSpecialChars(item.cidade.toUpperCase());
		            	var codigo_pesquisar = item.codigo;

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (cidade_pesquisar.includes(valor_pesquisado)) {
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_origem('"+item.cidade+"\',\'"+item.codigo+"\',\'\',\'"+field+"\', "+x+")\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++; 
            			}

		            });
                	jQuery('#dados_trecho'+x+' ul').html(retorno);
                //busca nada
                }else if(destino == ""){
            		jQuery('#dados_trecho'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('#dados_trecho'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                //retorna solicitando que digite mais que 3 caracteres
                }else{
            		jQuery('#dados_trecho'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('#dados_trecho'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                }

            }

        }); 

    }else{

		contador_exibicao = 0;

        jQuery('#dados_trecho'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('#dados_trecho'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');

    }

}
function pesquisar_destino(field, x){ 

	var contador_exibicao = 0; 

    var destino = jQuery("#"+field).val();



    var contador = 0;

    if (destino.length >= 3 && contador_exibicao == 0) {  

        jQuery('#dados_trecho_destino'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('#dados_trecho_destino'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\';, sans-serif;cursor:pointer;list-style:none;margin: 0;"><img src="https://media.tenor.com/images/a742721ea2075bc3956a2ff62c9bfeef/tenor.gif" style="height: 22px;margin-right: 5px;position:absolute;"> <span style="margin-left: 34px;">Buscando resultados...</span></li>');
 

        var data = {

            'action': 'get_city_airport',

            'local': jQuery("#"+field).val()

        };



        jQuery.ajax({

            url : jQuery("#url_ajax").val(),

            type : 'post',

            data : data,

            success : function( resposta ) {

            	var json = jQuery.parseJSON(resposta.slice(0,-1));
            	var retorno = "";

            	//busca aeroporto
                if(destino.length === 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
            			var codigo_pesquisar = replaceSpecialChars(item.codigo);

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (codigo_pesquisar === valor_pesquisado) { 
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_destino('"+item.cidade+"\',\'"+item.codigo+"\',\'\',\'"+field+"\', "+x+")\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++;
            			}
                	});
                	jQuery('#dados_trecho_destino'+x+' ul').html(retorno);

                //busca cidade	
                }else if(destino.length > 3){

                	var contador = 0;
                	jQuery(json).each(function(i, item) { 
		            	var cidade_pesquisar = replaceSpecialChars(item.cidade.toUpperCase());
		            	var codigo_pesquisar = item.codigo;

            			var valor_pesquisado = replaceSpecialChars(destino.toUpperCase());
            			if (cidade_pesquisar.includes(valor_pesquisado)) {
            				retorno += "<li style='border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \"Montserrat\", sans-serif;cursor:pointer;list-style:none;' onclick=\"selecionar_destino('"+item.cidade+"\',\'"+item.codigo+"\',\'\',\'"+field+"\', "+x+")\"  style='line-height: 20px;font-size: 14px;' id='sigla' value='"+item.cidade+"'>"+item.cidade+" ("+item.codigo+") </li>";

            				contador++; 
            			}

		            });
                	jQuery('#dados_trecho_destino'+x+' ul').html(retorno);

                //busca nada
                }else if(destino == ""){
            		jQuery('#dados_trecho_destino'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('#dados_trecho_destino'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                //retorna solicitando que digite mais que 3 caracteres
                }else{
            		jQuery('#dados_trecho_destino'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

    				jQuery('#dados_trecho_destino'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');
                }

            }

        }); 

    }else{

		contador_exibicao = 0;

        jQuery('#dados_trecho_destino'+x).attr('style', 'background-color:#fff;min-height: 25px;position:absolute;width: 100%;z-index: 9999;top: 58px;');  

        jQuery('#dados_trecho_destino'+x+' ul').html('<li style="border-bottom: none;padding: 12px 16px;font-size: 14px;font-family: \'Montserrat\', sans-serif;cursor:pointer;list-style:none;color: #e82121;font-weight: 700;">Digite pelo menos 3 letras.</li>');

    }

}

function selecionar_origem(destino, id, end, field, i){

    jQuery("#"+field).val(destino+' ('+id+')');  

    localStorage.setItem("ORIGEM_FLIGHT_TRECHO"+i, destino); 
    localStorage.setItem("ID_ORIGEM_FLIGHT_TRECHO"+i, id); 

    jQuery('#dados_trecho'+i).attr('style', 'display:none;'); 

}

function selecionar_destino(destino, id, end, field, i){

    jQuery("#"+field).val(destino+' ('+id+')');  

    localStorage.setItem("DESTINO_FLIGHT_TRECHO"+i, destino); 
    localStorage.setItem("ID_DESTINO_FLIGHT_TRECHO"+i, id);

    if(i < 5){ 
	    var next = parseInt(i)+1; 
	    jQuery("#field_origin_trecho"+next).val(destino);
	    localStorage.setItem("ORIGEM_FLIGHT_TRECHO"+next, destino);

	    localStorage.setItem("ID_ORIGEM_FLIGHT_TRECHO"+next, id);
    } 

    jQuery('#dados_trecho_destino'+i).attr('style', 'display:none;');  

}

function selecionar_origem_flight(destino, id, end){

    jQuery("#field_name_origin_flight").val(destino+' ('+id+')'); 

    localStorage.setItem("ORIGEM_FLIGHT", destino); 
    localStorage.setItem("ID_ORIGEM_FLIGHT", id); 

    jQuery('.dadosOrigin').attr('style', 'display:none;');  

}

function selecionar_destino_flight(destino, id, end){

    jQuery("#field_name_destin_flight").val(destino+' ('+id+')'); 

    localStorage.setItem("DESTINO_FLIGHT", destino); 
    localStorage.setItem("ID_DESTINO_FLIGHT", id); 

    jQuery('.dadosDestin').attr('style', 'display:none;');  

}

function change_type_flight(type){
	if(type == 1){
		jQuery("button.oneWay").removeClass("active");
		jQuery("button.flightRoundTrip").addClass("active");
		jQuery("button.multiWay").removeClass("active");

		if(jQuery("#type_motor").val() == 3){
			jQuery("#flightsPadron").attr("style", "height:40px !important");
		}else{ 
			jQuery("#flightsPadron").attr("style", "");
		}
		jQuery("#multiway").attr("style", "display:none !important");

		jQuery(".dateReturn").attr("style", "");
	}else if(type == 2){
		jQuery("button.oneWay").addClass("active");
		jQuery("button.flightRoundTrip").removeClass("active");
		jQuery("button.multiWay").removeClass("active");

		if(jQuery("#type_motor").val() == 3){
			jQuery("#flightsPadron").attr("style", "height:40px !important");
		}else{ 
			jQuery("#flightsPadron").attr("style", "");
		}
		jQuery("#multiway").attr("style", "display:none !important");

		jQuery(".dateReturn").attr("style", "display:none !important");
	}else if(type == 3){
		jQuery("button.oneWay").removeClass("active");
		jQuery("button.flightRoundTrip").removeClass("active");
		jQuery("button.multiWay").addClass("active");

		jQuery("#flightsPadron").attr("style", "display:none !important");
		jQuery("#multiway").attr("style", "");
	}

	jQuery("#type_flight").val(type);
}

function show_trecho(id, hide){
    var url_atual = window.location.href;
	var prev = parseInt(id)-1;
	var prevHide = parseInt(hide)-1;

	jQuery("#trecho"+id).attr("style", "");

	jQuery(".hideTrecho"+prev+" .hideSpan"+prev).attr("style", "display:none;");
	jQuery(".hideTrecho"+prev+" .showSpan"+prev).attr("style", "display:none");

	if(url_atual.indexOf("/offers-flights/") == -1){ 
		jQuery(".hideTrecho"+prev+" span").attr("style", "display:none;");
		jQuery(".showTrecho"+prev+" span").attr("style", "display:none"); 
	}
}

function hide_trecho(id){ 
    var url_atual = window.location.href;
	var prev = parseInt(id)-1;

	jQuery("#trecho"+id).attr("style", "display:none;");
 
	jQuery(".hideTrecho"+prev+" .hideSpan"+prev).attr("style", "font-weight: 700;color: #ffa1a1;font-size: 12px;cursor: pointer;float: right;");
	jQuery(".hideTrecho"+prev+" .showSpan"+prev).attr("style", "font-weight: 700;color: #fff;font-size: 12px;cursor: pointer;float: left;");

	if(url_atual.indexOf("/offers-flights/") == -1){ 
		jQuery(".hideTrecho"+prev+" span").attr("style", "font-weight: 700;color: #e30f0f;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;");
		jQuery(".showTrecho"+prev+" span").attr("style", "font-weight: 700;color: #303030;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;");
	}
}

function select_class_trip(trip){
	var classeTrip = jQuery("#"+trip).val();

	var classeTripDesc = ' Econômica';
	if(classeTrip == 1){
		classeTripDesc = ' Econômica';
	}else if(classeTrip == 2){
		classeTripDesc = ' Premium Economy';
	}else if(classeTrip == 3){
		classeTripDesc = ' Executiva/Business';
	}else if(classeTrip == 4){
		classeTripDesc = ' Primeira Classe';
	}else{
		classeTrip = 1;
		classeTripDesc = ' Econômica';
	}

	jQuery("."+trip).html(classeTripDesc);
    localStorage.setItem("CLASSE_TRIP", classeTripDesc); 
    localStorage.setItem("ID_CLASSE_TRIP", classeTrip);

}

function change_fields_trip(type = 0){
	if(type == 0){
	    var origem = jQuery("#field_name_origin_flight").val(); 
	    var destino = jQuery("#field_name_destin_flight").val(); 

	    jQuery("#field_name_origin_flight").val(destino);
	    jQuery("#field_name_destin_flight").val(origem);

	    var origemStorage = localStorage.getItem("ORIGEM_FLIGHT");
	    var aeroportoOrigemStorage = localStorage.getItem("AEROPORTO_ORIGEM_FLIGHT");
	    
	    var destinoStorage = localStorage.getItem("DESTINO_FLIGHT");
	    var aeroportoDestinoStorage = localStorage.getItem("ID_DESTINO_FLIGHT");

	    localStorage.setItem("ORIGEM_FLIGHT", destinoStorage); 
	    localStorage.setItem("ID_ORIGEM_FLIGHT", aeroportoDestinoStorage);  

	    localStorage.setItem("DESTINO_FLIGHT", origemStorage); 
	    localStorage.setItem("ID_DESTINO_FLIGHT", aeroportoOrigemStorage); 
	}else{

		var prox = parseInt(type)+1;

	    var origem = jQuery("#field_origin_trecho"+type).val(); 
	    var destino = jQuery("#field_destin_trecho"+type).val(); 

	    jQuery("#field_origin_trecho"+type).val(destino);
	    jQuery("#field_destin_trecho"+type).val(origem);

	    var origemStorage = localStorage.getItem("ORIGEM_FLIGHT_TRECHO"+type);
	    var aeroportoOrigemStorage = localStorage.getItem("ID_ORIGEM_FLIGHT"+type);
	    
	    var destinoStorage = localStorage.getItem("DESTINO_FLIGHT_TRECHO"+type);
	    var aeroportoDestinoStorage = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO"+type);

	    localStorage.setItem("ORIGEM_FLIGHT_TRECHO"+type, destinoStorage); 
	    localStorage.setItem("ID_ORIGEM_FLIGHT_TRECHO"+type, aeroportoDestinoStorage);  

	    localStorage.setItem("DESTINO_FLIGHT_TRECHO"+type, origemStorage); 
	    localStorage.setItem("ID_DESTINO_FLIGHT_TRECHO"+type, aeroportoOrigemStorage); 

	    jQuery("#field_origin_trecho"+prox).val(origem); 

	    localStorage.setItem("ORIGEM_FLIGHT_TRECHO"+prox, destinoStorage); 
	    localStorage.setItem("ID_ORIGEM_FLIGHT_TRECHO"+prox, aeroportoDestinoStorage);  


	}

}

function search_results_flights(){

	var type_flight = jQuery("#type_flight").val();

	var adultos = jQuery("#adultos").val();
	var criancas = jQuery("#criancas").val();
	localStorage.setItem("ADULTOS_FLIGHT", adultos);
	localStorage.setItem("CRIANCAS_FLIGHT", criancas);

	if(type_flight == 3){

		var classTrip = "NO";
		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
		localStorage.setItem("ID_CLASSE_TRIP", 1);

		var routes = "";
		for(var i = 1; i < 6; i++){

			if(jQuery("#field_destin_trecho"+i).val() !== ""){
				var origem = localStorage.getItem("ORIGEM_FLIGHT_TRECHO"+i);
				var aero_origem = localStorage.getItem("ID_ORIGEM_FLIGHT_TRECHO"+i);

				var destino = localStorage.getItem("DESTINO_TRECHO"+i);
				var aero_destino = localStorage.getItem("ID_DESTINO_FLIGHT_TRECHO"+i);

				var checkin = jQuery("#field_date_checkin_flight_trecho"+i).val(); 

				routes += aero_origem+","+aero_destino+","+moment(checkin, 'DD-MM-YYYY').format('YYYY-MM-DD')+"+";
			}

		}

		if(jQuery("#classeTripMulti").val() == 1){
			var classTrip = "NO";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 1);
		}else if(jQuery("#classeTripMulti").val() == 2){
			var classTrip = "YES";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica Premium'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 2);
		}else if(jQuery("#classeTripMulti").val() == 3){
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Executiva/Business'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 3);
		}else if(jQuery("#classeTripMulti").val() == 4){
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Primeira Classe'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 4);
		}else{
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Primeira Classe'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 4);
		}

	}else if(type_flight == 2){

		var classTrip = "NO";
		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
		localStorage.setItem("ID_CLASSE_TRIP", 1);

		var origem = localStorage.getItem("ORIGEM_FLIGHT");
		var aero_origem = localStorage.getItem("ID_ORIGEM_FLIGHT");

		var destino = localStorage.getItem("DESTINO_FLIGHT");
		var aero_destino = localStorage.getItem("ID_DESTINO_FLIGHT");

		var checkin = jQuery("#field_date_checkin_flight").val();
		var checkout = jQuery("#field_date_checkout_flight").val();

		var routes = aero_origem+","+aero_destino+","+moment(checkin, 'DD-MM-YYYY').format('YYYY-MM-DD')+"+";

		if(jQuery("#classeTrip").val() == 1){
			var classTrip = "NO";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 1);
		}else if(jQuery("#classeTrip").val() == 2){
			var classTrip = "YES";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica Premium'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 2);
		}else if(jQuery("#classeTrip").val() == 3){
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Executiva/Business'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 3);
		}else if(jQuery("#classeTrip").val() == 4){
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Primeira Classe'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 4);
		}else{
			var classTrip = "NO";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 1);
		}

	}else{

		var classTrip = "NO";
		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
		localStorage.setItem("ID_CLASSE_TRIP", 1);

		var origem = localStorage.getItem("ORIGEM_FLIGHT");
		var aero_origem = localStorage.getItem("ID_ORIGEM_FLIGHT");

		var destino = localStorage.getItem("DESTINO_FLIGHT");
		var aero_destino = localStorage.getItem("ID_DESTINO_FLIGHT");

		var checkin = jQuery("#field_date_checkin_flight").val();
		var checkout = jQuery("#field_date_checkout_flight").val();

		var routes = aero_origem+","+aero_destino+","+moment(checkin, 'DD-MM-YYYY').format('YYYY-MM-DD')+"+"+aero_destino+","+aero_origem+","+moment(checkout, 'DD-MM-YYYY').format('YYYY-MM-DD')+"+";

		if(jQuery("#classeTrip").val() == 1){
			var classTrip = "NO";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 1);
		}else if(jQuery("#classeTrip").val() == 2){
			var classTrip = "YES";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica Premium'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 2);
		}else if(jQuery("#classeTrip").val() == 3){
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Executiva/Business'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 3);
		}else if(jQuery("#classeTrip").val() == 4){
			var classTrip = "ALSO";
    		localStorage.setItem("CLASSE_TRIP", 'Primeira Classe'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 4);
		}else{
			var classTrip = "NO";
    		localStorage.setItem("CLASSE_TRIP", 'Econômica'); 
    		localStorage.setItem("ID_CLASSE_TRIP", 1);
		}

	}

	var agesAdt = "";
	for(var countAdt = 0; countAdt < adultos; countAdt++){
		agesAdt += "22,";
	} 

	var agesChd = "";
	if(criancas > 0){
		for(var countChd = 0; countChd < criancas; countChd++){
			agesChd += "7,";
		} 
	}

	var ages = (agesAdt+''+agesChd).slice(0, -1); 
	routes = routes.slice(0, -1); 

	localStorage.setItem("CLASS_FLIGHT", classTrip);
	localStorage.setItem("AGES_FLIGHT", ages);
	localStorage.setItem("ROUTE_FLIGHT", routes);
	localStorage.setItem("TYPE_FLIGHT", type_flight);
	
	window.location.href = '/offers-flights/';

}