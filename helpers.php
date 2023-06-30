<?php   

	/* 
		Plugin Name: Voucher Tec - Shortcode 
		Plugin URI: https://github.com/TravelTec/TT-Helpers
		GitHub Plugin URI: https://github.com/TravelTec/TT-Helpers  
		Description:  O Plugin Travel Tec - Shortcode é um plugin auxiliar, criado para gerenciar e manter o motor de pesquisa com todos os serviços (aéreo, hotéis e veículos). 
		Version: 1.0.0 
		Author: Travel Tec 
		Author URI: https://traveltec.com.br 
		License: GPLv2  
	*/ 

  	require 'plugin-update-checker-4.10/plugin-update-checker.php';

  	/* VERIFICA ATUALIZAÇÕES NO GITHUB */
	add_action( 'admin_init', 'helpers_update_checker_setting' );  
	function helpers_update_checker_setting() {  
		register_setting( 'vouchertec-helpers', 'serial' );  

	    if ( ! is_admin() || ! class_exists( 'Puc_v4_Factory' ) ) {  
	        return;   
	    }   

	    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(  
	        'https://github.com/TravelTec/TT-Helpers',   
	        __FILE__,   
	        'TT-Helpers'  
	    );   

	    $myUpdateChecker->setBranch('main');   
	}
	/* FIM VERIFICA ATUALIZAÇÕES NO GITHUB */

  	/* ADICIONA SHORTCODE COM TODOS OS SERVIÇOS NO MOTOR DE BUSCA */
  	add_shortcode('TTBOOKING_MOTOR_SERVICES', 'get_all_services'); 
  	function get_all_services(){ 
  		$html = '';
  		if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_FLIGHTS' ) ) {
  			$cor = (empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' ));
        	$cor_botao = (empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' ));
  		}else if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA' ) ) {
  			$cor = (empty(get_option( 'cor_ehtl' )) ? '#000000' : get_option( 'cor_ehtl' ));
        	$cor_botao = (empty(get_option( 'cor_botao_ehtl' )) ? '#000000' : get_option( 'cor_botao_ehtl' ));
  		}else{
  			$cor = (empty(get_option( 'cor_cars' )) ? '#000000' : get_option( 'cor_cars' ));
        	$cor_botao = (empty(get_option( 'cor_botao_cars' )) ? '#000000' : get_option( 'cor_botao_cars' ));
  		} 

  		$html .= '<style>.nav>li>a:focus,.nav>li>a:hover{background:0 0!important}.design-process-section .text-align-center{line-height:25px;margin-bottom:12px}.design-process-content{border:1px solid #e9e9e9;position:relative;padding:16px 34% 30px 30px}.design-process-content img{position:absolute;top:0;right:0;bottom:0;z-index:0;max-height:100%}.design-process-content h3{margin-bottom:16px}.design-process-content p{line-height:26px;margin-bottom:12px}.process-model{list-style:none;padding:0;position:relative;max-width:600px;margin:20px auto 26px;border:none;z-index:0}.process-model li::after{background:'.$cor.';bottom:0;content:"";display:block;height:4px;margin:0 auto;position:absolute;right:73%;top:33px;width:14%;z-index:-1}.process-model li.visited::after{background:'.$cor.'}.process-model li:last-child::after{width:0}.process-model li{display:inline-block;width:18%;text-align:center;float:none}.nav-tabs.process-model>li.active>a,.nav-tabs.process-model>li.active>a:focus,.nav-tabs.process-model>li.active>a:hover,.process-model li a:focus,.process-model li a:hover{border:none;background:0 0}.process-model li a{padding:0;border:none;color:#606060}.process-model li.active,.process-model li.active a,.process-model li.active a:focus,.process-model li.active a:hover,.process-model li.visited,.process-model li.visited a,.process-model li.visited a:focus,.process-model li.visited a:hover{color:'.$cor.'}.process-model li a.active p,.process-model li a.visited p{font-weight:600;color:'.$cor.'}.process-model li i{display:block;height:68px;width:68px;text-align:center;margin:0 auto;background:#fff;color: '.$cor.';border:2px solid '.$cor.';line-height:65px;font-size:30px;border-radius:50%}.process-model li a.active i{background:'.$cor.';border-color:'.$cor.';color:#fff}.process-model li p{font-size:14px;margin-top:11px;margin-bottom:0px;color: '.$cor.';}.process-model.contact-us-tab li.visited a,.process-model.contact-us-tab li.visited p{color:#606060!important;font-weight:400}.process-model.contact-us-tab li::after{display:none}.process-model.contact-us-tab li.visited i{border-color:#e5e5e5}@media screen and (max-width:560px){.more-icon-preocess.process-model li span{font-size:23px;height:50px;line-height:46px;width:50px}.more-icon-preocess.process-model li::after{top:24px}}@media screen and (max-width:380px){.process-model.more-icon-preocess li{width:16%}.more-icon-preocess.process-model li span{font-size:16px;height:35px;line-height:32px;width:35px}.more-icon-preocess.process-model li p{font-size:8px}.more-icon-preocess.process-model li::after{top:18px}.process-model.more-icon-preocess{text-align:center}} .qtyIncFlight, .qtyDecFlight, .qtyIncMulti, .qtyDecMulti, .qtyIncHotel,  .qtyDecHotel{width:28px;height:28px;line-height:22px;font-size:15px;background-color:'.$cor.'bd;-webkit-text-stroke:1px;} .qtyIncFlight:hover,.qtyDecFlight:hover,.qtyIncMulti:hover,.qtyDecMulti:hover, .qtyIncHotel:hover, .qtyDecHotel:hover{background:'.$cor.'bd;} .qtyIncFlight:hover:before, .qtyDecFlight:hover:before, .qtyIncMulti:hover:before, .qtyDecMulti:hover:before, .qtyIncHotel:hover:before, .qtyDecHotel:hover:before{color:#fff} .qtyIncFlight:before, .qtyIncMulti:before, .qtyIncHotel:before, .qtyIncHotel:before{content:"\002B";font-size:19px;font-weight:900;line-height: 29px;} .qtyDecFlight:before, .qtyDecMulti:before, .qtyDecHotel:before, .qtyDecHotel:before{content:"\2212";font-size:19px;font-weight:900;line-height: 29px;} </style>';

  		$html .= '<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  		<link rel="preconnect" href="https://fonts.googleapis.com">
    	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
        <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="'.plugin_dir_url( __FILE__ ) . 'assets/css/motorAllAereo.css?v='.date("YmdHis").'">';
 
        $html .= '<style>
            @media (min-width:992px){.idtrecho{background-color:'.$cor.'!important}}.qtyDecFlight,.qtyDecMulti,.qtyIncFlight,.qtyIncMulti{background-color:'.$cor.'bd}.daterangepicker td.in-range{background-color:'.$cor.'54;cor:'.$cor.'54}.btnApplyRoom,.daterangepicker td.active,.daterangepicker td.active:hover{background-color:'.$cor.'}.daterangepicker td.available:hover,.daterangepicker th.available:hover{background-color:'.$cor.'99}.btnAddRoom,a:hover{color:'.$cor.'}.cancelBtn{color:'.$cor.'bd!important}.applyBtn:hover,.cancelBtn:hover{background-color:'.$cor.'bd!important}.applyBtn{background-color:'.$cor.'!important;border-color:'.$cor.'!important}.btnAddRoom:hover{color:'.$cor.'ee}.btnApplyRoom:hover{background-color:'.$cor.'d4}.ripple{background-color:'.$cor_botao.'!important}.ripple:hover{background-color:'.$cor_botao.'80!important}button.typeFlight.active,button.typeFlight:hover{color:'.$cor.'!important} 

            @media(min-width: 767px){
            	.custom-search-input-2 input{
            		margin-top: 0px !important;
            		height: 42px !important;
            	}
            }
        	</style>'; 

        $html .= '<input type="hidden" id="type_motor" value="3">'; 
        $html .= '<input type="hidden" id="url_ajax" value="'.admin_url('admin-ajax.php').'">';

        $html .= '<div class="container">
            <div class="row">
                <div class="col-xs-12" style="width:100%">
                    <!-- design process steps-->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist" style="margin: 0;border-bottom: 0;">';
                        if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_FLIGHTS' ) ) {
                            $html .= '<li role="presentation" class="active">
                                <a href="#flight" aria-controls="flight" role="tab" data-toggle="tab" onclick="show_tab(0)" class="active show">
                                    <i class="fa fa-plane" aria-hidden="true"></i>
                                    <p style="font-family:\'Montserrat\'">Passagens</p>
                                </a>
                            </li>';
                        }
                        if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA' ) ) {
                            $html .= '<li role="presentation">
                                <a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab" onclick="show_tab(1)">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                    <p style="font-family:\'Montserrat\'">Hospedagem</p>
                                </a>
                            </li>';
                        }
                        if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_CARS' ) ) {
                            $html .= '<li role="presentation">
                                <a href="#cars" aria-controls="cars" role="tab" data-toggle="tab" onclick="show_tab(3)">
                                    <i class="fa fa-car" aria-hidden="true"></i>
                                    <p style="font-family:\'Montserrat\'">Veículos</p>
                                </a>
                            </li>';
                        }
                    $html .= '</ul>
                    <!-- end design process steps-->

                    <div class="tab-content">';

                        if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_FLIGHTS' ) ) { 
                            //$htmlAereo = get_html_aereo();
                            $html .= '<div role="tabpanel" class="tab-pane active" id="flight">';
                            	$html .= getHtmlAereo();
                            $html .= '</div>';
                        }

                        if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA' ) ) {
                            //$htmlAereo = get_html_hotel();
                            $html .= '<div role="tabpanel" class="tab-pane" id="hotels">';
                            	$html .= getHtmlHotel();
                            $html .= '</div>';
                        }

                        if ( shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_CARS' ) ) {
                            //$htmlAereo = get_html_hotel();
                            $html .= '<div role="tabpanel" class="tab-pane" id="cars"> ';
                            	$html .= do_shortcode('[TTBOOKING_MOTOR_RESERVA_CARS]');
                            $html .= '</div>';
                        }


                    $html .= '</div>
                </div>
            </div>
        </div>'; 

      	return $html;
  	}
  	/* FIM SHORTCODE GERAL */

  	/* FUNÇÕES AUXILIARES */
  	function getHtmlAereo(){
  		$html = '';

    	$html .= '<section class="banner" id="searchFlightsBanner">  
	        <div class="search-sec container">
	            <input type="hidden" id="type_motor" value="1"> 

	            <input type="hidden" id="adultos" value="2"> 
	            <input type="hidden" id="criancas" value="">  

	            <input type="hidden" id="type_flight" value="1">  
	            <input type="hidden" id="field_date_checkin_flight" value="">
	            <input type="hidden" id="field_date_checkout_flight" value=""> 

	            <input type="hidden" id="field_date_checkin_flight_trecho1" value=""> 
	            <input type="hidden" id="field_date_checkin_flight_trecho2" value=""> 
	            <input type="hidden" id="field_date_checkin_flight_trecho3" value=""> 
	            <input type="hidden" id="field_date_checkin_flight_trecho4" value=""> 
	            <input type="hidden" id="field_date_checkin_flight_trecho5" value="">  

	            <div class="row">
	                <div class="col-lg-12 col-12">
	                    <h4 style="color: #fff;font-weight: 600;font-size: 19px;margin-bottom: 22px;">Passagens Aéreas <button class="typeFlight flightRoundTrip active" onclick="change_type_flight(1)">Ida e Volta</button> <button class="typeFlight oneWay" onclick="change_type_flight(2)">Somente Ida</button> <button class="typeFlight multiWay" onclick="change_type_flight(3)">Multidestino</button> </h4>
	                    <div class="row no-gutters custom-search-input-2" id="flightsPadron" style="height:40px !important"> 
	                        <div class="col-lg-4">
	                            <div class="form-group fieldFrom">
	                                <div class="custom-select-form">
	                                    <label style="">ORIGEM</label>
	                                    <input type="text" class="form-control" id="field_name_origin_flight" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                    <div class="dadosOrigin">
	                                        <ul style="padding:0;margin: 0;"></ul>
	                                    </div>
	                                </div> 
	                            </div>
	                            <div class="form-group fieldChange"> 
	                                <span class="fas fa-exchange-alt" onclick="change_fields_trip()"></span>
	                            </div>
	                            <div class="form-group fieldTo">
	                                <div class="custom-select-form">
	                                    <label style="">DESTINO</label>
	                                    <input type="text" class="form-control" id="field_name_destin_flight" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                    <div class="dadosDestin">
	                                        <ul style="padding:0;margin: 0;"></ul>
	                                    </div>
	                                </div> 
	                                <i class="fas fa-map-marker-alt" style="padding: 16px 0;line-height: 1 !important;height: auto !important;border: none !important;"></i>
	                            </div>
	                        </div>
	                        <div class="col-lg-4 fieldDates">
	                            <div class="form-group">
	                                <label style="">DATAS</label>
	                                <input class="form-control search-slt" type="text" name="dateGo" placeholder="Informe a partida" autocomplete="off" readonly="readonly" style="margin-top: 10px !important;"> 
	                            </div>
	                            <div class="form-group dateReturn">
	                                    <label style=""> </label>
	                                <input class="form-control search-slt" type="text" name="dateBack" placeholder="Informe o retorno" autocomplete="off" readonly="readonly">
	                                <i class="fa fa-calendar" style="padding: 16px 0;line-height: 1 !important;height: auto !important;border: none !important;"></i>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 fieldPax">
	                            <label class="label" style="">PASSAGEIROS E CLASSE</label>
	                            <div class="panel-dropdown-flights panelDropdownFlights" id="panelDropdownFlights">
	                                <a href="#"><i class="fa fa-user" style="position: unset !important;padding: 0 !important;line-height: 1 !important;height: auto !important;margin-left: 8px;border: none !important;"></i> <span class="qtyTotalFlights">2</span> pessoas, <span class="classeTrip">Econômica</span></a>
	                                <div class="panel-dropdown-content">
	                                    <input type="hidden" id="qtd_room_add" value="1">
	                                    <div class="rooms_add">
	                                        <div id="panelTripFlights" class="panelTripFlights" style="padding:15px 15px 0 15px;">
	                                            <input type="hidden" id="panel1qts" value="1">  
	                                            <div class="qtyButtons qtyAdtFlights">
	                                                <input type="hidden" id="panel1adt" value="2">
	                                                <label>Adultos</label> 
	                                                <div class="qtyDecFlight"></div>
	                                                <input type="text" name="qtyInputFlights" value="2">
	                                                <div class="qtyIncFlight"></div>
	                                            </div>
	                                            <div class="qtyButtons qtyChd">
	                                                <input type="hidden" id="panel1chd" value="0">
	                                                <label style="line-height: 1 !important;">
	                                                    Menor <br> 
	                                                    <small style="font-weight: 500;font-size: 12px;">Até 11 anos</small>
	                                                </label> 
	                                                <div class="qtyDecFlight"></div>
	                                                <input type="text" name="qtyInputFlights" value="0" max="4">
	                                                <div class="qtyIncFlight"></div>
	                                            </div> 
	                                            <div class="idade_chd1" style="display:none">
	                                                <div class="row">
	                                                    <div class="col-lg-7 col-12">
	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                    </div>
	                                                    <div class="col-lg-5 col-12"> 
	                                                        <select class="form-control">
	                                                            <option value="">Selecione...</option>
	                                                            <option value="1">Até 1 ano</option>
	                                                            <option value="2">2 anos</option>
	                                                            <option value="3">3 anos</option>
	                                                            <option value="4">4 anos</option>
	                                                            <option value="5">5 anos</option>
	                                                            <option value="6">6 anos</option>
	                                                            <option value="7">7 anos</option>
	                                                            <option value="8">8 anos</option>
	                                                            <option value="9">9 anos</option>
	                                                            <option value="10">10 anos</option>
	                                                            <option value="11">11 anos</option> 
	                                                        </select>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="idade_chd2" style="display:none">
	                                                <div class="row">
	                                                    <div class="col-lg-7 col-12">
	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                    </div>
	                                                    <div class="col-lg-5 col-12"> 
	                                                        <select class="form-control">
	                                                            <option value="">Selecione...</option>
	                                                            <option value="1">Até 1 ano</option>
	                                                            <option value="2">2 anos</option>
	                                                            <option value="3">3 anos</option>
	                                                            <option value="4">4 anos</option>
	                                                            <option value="5">5 anos</option>
	                                                            <option value="6">6 anos</option>
	                                                            <option value="7">7 anos</option>
	                                                            <option value="8">8 anos</option>
	                                                            <option value="9">9 anos</option>
	                                                            <option value="10">10 anos</option>
	                                                            <option value="11">11 anos</option> 
	                                                        </select>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="idade_chd3" style="display:none">
	                                                <div class="row">
	                                                    <div class="col-lg-7 col-12">
	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                    </div>
	                                                    <div class="col-lg-5 col-12"> 
	                                                        <select class="form-control">
	                                                            <option value="">Selecione...</option>
	                                                            <option value="1">Até 1 ano</option>
	                                                            <option value="2">2 anos</option>
	                                                            <option value="3">3 anos</option>
	                                                            <option value="4">4 anos</option>
	                                                            <option value="5">5 anos</option>
	                                                            <option value="6">6 anos</option>
	                                                            <option value="7">7 anos</option>
	                                                            <option value="8">8 anos</option>
	                                                            <option value="9">9 anos</option>
	                                                            <option value="10">10 anos</option>
	                                                            <option value="11">11 anos</option> 
	                                                        </select>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="idade_chd4" style="display:none">
	                                                <div class="row">
	                                                    <div class="col-lg-7 col-12">
	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                    </div>
	                                                    <div class="col-lg-5 col-12"> 
	                                                        <select class="form-control">
	                                                            <option value="">Selecione...</option>
	                                                            <option value="1">Até 1 ano</option>
	                                                            <option value="2">2 anos</option>
	                                                            <option value="3">3 anos</option>
	                                                            <option value="4">4 anos</option>
	                                                            <option value="5">5 anos</option>
	                                                            <option value="6">6 anos</option>
	                                                            <option value="7">7 anos</option>
	                                                            <option value="8">8 anos</option>
	                                                            <option value="9">9 anos</option>
	                                                            <option value="10">10 anos</option>
	                                                            <option value="11">11 anos</option> 
	                                                        </select>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="classe" style="margin-top:13px;">
	                                                <div class="row">
	                                                    <div class="col-lg-7 col-12">
	                                                        <label style="line-height:1; font-weight: 400;line-height: 36px;padding-right: 15px; color: #626262;font-size: 18px;">Classe</label> 
	                                                    </div>
	                                                    <div class="col-lg-5 col-12"> 
	                                                        <select class="form-control" id="classeTrip" onchange="select_class_trip(\'classeTrip\')">
	                                                            <option value="">Selecione...</option>
	                                                            <option value="1" selected>Econômica</option>
	                                                            <option value="2">Premium Economy</option>
	                                                            <option value="3">Executiva/Business</option>
	                                                            <option value="4">Primeira Classe</option> 
	                                                        </select>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div> 
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-1">
	                            <button type="submit" class="btn_search btn btn-danger wrn-btn ripple" onclick="search_results_flights()"><span>Buscar </span></button>
	                        </div>
	                    </div>
	                    <div class="no-gutters custom-search-input-2" id="multiway" style="display:none"> 
	                        <div class="row" id="trecho1">
	                            <div class="col-lg-1"> 
	                                <h4 class="idtrecho" style="">1</h4>
	                            </div>
	                            <div class="col-lg-4">
	                                <div class="form-group fieldFrom">
	                                    <div class="custom-select-form">
	                                        <label style="">ORIGEM</label>
	                                        <input type="text" class="form-control" id="field_origin_trecho1" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho1" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                </div>
	                                <div class="form-group fieldChange"> 
	                                    <span class="fas fa-exchange-alt" onclick="change_fields_trip(1)"></span>
	                                </div>
	                                <div class="form-group fieldTo">
	                                    <div class="custom-select-form">
	                                        <label style="">DESTINO</label>
	                                        <input type="text" class="form-control" id="field_destin_trecho1" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho_destino1" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                    <i class="fas fa-map-marker-alt"></i>
	                                </div>
	                            </div>
	                            <div class="col-lg-2 fieldDates">
	                                <div class="form-group" style="width: 100% !important; margin-top: 9px !important;">
	                                    <label style="">DATAS</label>
	                                    <input class="form-control search-slt" type="text" id="date_trecho1" name="date_trecho1" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
	                                </div>
	                            </div>
	                            <div class="col-lg-3 fieldPax">
	                                <label class="label" style="">PASSAGEIROS E CLASSE</label>
	                                <div class="panel-dropdown-flights panel-multi" id="panelDropdownMultiFlights">
	                                    <a href="#"><i class="fa fa-user" style="position: unset !important;padding: 0;line-height: 1 !important;height: auto !important;margin-left: 8px;border: none !important;"></i> <span class="qtyTotalMultiFlights">2</span> pessoas, <span class="classeTripMulti">Econômica</span></a>
	                                    <div class="panel-dropdown-content"> 
	                                        <div class="rooms_add">
	                                            <div id="panelTripMultiFlights" class="panelTripMultiFlights" style="padding:15px 15px 0 15px;">
	                                                <input type="hidden" id="panel1qts" value="1">  
	                                                <div class="qtyButtons qtyAdtFlights">
	                                                    <input type="hidden" id="panel1adt" value="2">
	                                                    <label>Adultos</label> 
	                                                    <div class="qtyDecMulti"></div>
	                                                    <input type="text" name="qtyInputMultiFlights" value="2">
	                                                    <div class="qtyIncMulti"></div>
	                                                </div>
	                                                <div class="qtyButtons qtyChd">
	                                                    <input type="hidden" id="panel1chd" value="0">
	                                                    <label style="line-height: 1 !important;">
	                                                        Menor <br> 
	                                                        <small style="font-weight: 500;font-size: 12px;">Até 11 anos</small>
	                                                    </label> 
	                                                    <div class="qtyDecMulti"></div>
	                                                    <input type="text" name="qtyInputMultiFlights" value="0" max="4">
	                                                    <div class="qtyIncMulti"></div>
	                                                </div> 
	                                                <div class="idade_chd1" style="display:none">
	                                                    <div class="row">
	                                                        <div class="col-lg-7 col-12">
	                                                            <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                        </div>
	                                                        <div class="col-lg-5 col-12"> 
	                                                            <select class="form-control">
	                                                                <option value="">Selecione...</option>
	                                                                <option value="1">Até 1 ano</option>
	                                                                <option value="2">2 anos</option>
	                                                                <option value="3">3 anos</option>
	                                                                <option value="4">4 anos</option>
	                                                                <option value="5">5 anos</option>
	                                                                <option value="6">6 anos</option>
	                                                                <option value="7">7 anos</option>
	                                                                <option value="8">8 anos</option>
	                                                                <option value="9">9 anos</option>
	                                                                <option value="10">10 anos</option>
	                                                                <option value="11">11 anos</option> 
	                                                            </select>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                                <div class="idade_chd2" style="display:none">
	                                                    <div class="row">
	                                                        <div class="col-lg-7 col-12">
	                                                            <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                        </div>
	                                                        <div class="col-lg-5 col-12"> 
	                                                            <select class="form-control">
	                                                                <option value="">Selecione...</option>
	                                                                <option value="1">Até 1 ano</option>
	                                                                <option value="2">2 anos</option>
	                                                                <option value="3">3 anos</option>
	                                                                <option value="4">4 anos</option>
	                                                                <option value="5">5 anos</option>
	                                                                <option value="6">6 anos</option>
	                                                                <option value="7">7 anos</option>
	                                                                <option value="8">8 anos</option>
	                                                                <option value="9">9 anos</option>
	                                                                <option value="10">10 anos</option>
	                                                                <option value="11">11 anos</option> 
	                                                            </select>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                                <div class="idade_chd3" style="display:none">
	                                                    <div class="row">
	                                                        <div class="col-lg-7 col-12">
	                                                            <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                        </div>
	                                                        <div class="col-lg-5 col-12"> 
	                                                            <select class="form-control">
	                                                                <option value="">Selecione...</option>
	                                                                <option value="1">Até 1 ano</option>
	                                                                <option value="2">2 anos</option>
	                                                                <option value="3">3 anos</option>
	                                                                <option value="4">4 anos</option>
	                                                                <option value="5">5 anos</option>
	                                                                <option value="6">6 anos</option>
	                                                                <option value="7">7 anos</option>
	                                                                <option value="8">8 anos</option>
	                                                                <option value="9">9 anos</option>
	                                                                <option value="10">10 anos</option>
	                                                                <option value="11">11 anos</option> 
	                                                            </select>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                                <div class="idade_chd4" style="display:none">
	                                                    <div class="row">
	                                                        <div class="col-lg-7 col-12">
	                                                            <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 
	                                                        </div>
	                                                        <div class="col-lg-5 col-12"> 
	                                                            <select class="form-control">
	                                                                <option value="">Selecione...</option>
	                                                                <option value="1">Até 1 ano</option>
	                                                                <option value="2">2 anos</option>
	                                                                <option value="3">3 anos</option>
	                                                                <option value="4">4 anos</option>
	                                                                <option value="5">5 anos</option>
	                                                                <option value="6">6 anos</option>
	                                                                <option value="7">7 anos</option>
	                                                                <option value="8">8 anos</option>
	                                                                <option value="9">9 anos</option>
	                                                                <option value="10">10 anos</option>
	                                                                <option value="11">11 anos</option> 
	                                                            </select>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                                <div class="classeMulti" style="margin-top:13px;">
	                                                    <div class="row">
	                                                        <div class="col-lg-7 col-12">
	                                                            <label style="line-height:1; font-weight: 400;line-height: 36px;padding-right: 15px; color: #626262;font-size: 18px;">Classe</label> 
	                                                        </div>
	                                                        <div class="col-lg-5 col-12"> 
	                                                            <select class="form-control" id="classeTripMulti" onchange="select_class_trip(\'classeTripMulti\')">
	                                                                <option value="">Selecione...</option>
	                                                                <option value="1" selected>Econômica</option>
	                                                                <option value="2">Premium Economy</option>
	                                                                <option value="3">Executiva/Business</option>
	                                                                <option value="4">Primeira Classe</option> 
	                                                            </select>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div> 
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-lg-2">
	                                
	                            </div>
	                        </div>
	                        <div class="row" id="trecho2">
	                            <div class="col-lg-1"> 
	                                <h4 class="idtrecho" style="">2</h4>
	                            </div>
	                            <div class="col-lg-4">
	                                <div class="form-group fieldFrom">
	                                    <div class="custom-select-form">
	                                        <label style="">ORIGEM</label>
	                                        <input type="text" class="form-control" id="field_origin_trecho2" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho2" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                </div>
	                                <div class="form-group fieldChange"> 
	                                    <span class="fas fa-exchange-alt" onclick="change_fields_trip(2)"></span>
	                                </div>
	                                <div class="form-group fieldTo">
	                                    <div class="custom-select-form">
	                                        <label style="">DESTINO</label>
	                                        <input type="text" class="form-control" id="field_destin_trecho2" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho_destino2" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                    <i class="fas fa-map-marker-alt"></i>
	                                </div>
	                            </div>
	                            <div class="col-lg-2 fieldDates">
	                                <div class="form-group" style="width: 100% !important; margin-top: 9px !important;">
	                                    <label style="">DATAS</label>
	                                    <input class="form-control search-slt" type="text" name="date_trecho2" id="date_trecho2" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
	                                </div>
	                            </div>
	                            <div class="col-lg-3 fieldPax hideTrecho2">
	                                 <span></span>
	                            </div>
	                            <div class="col-lg-2 hideTrecho2" style="height: 29px;">
	                                <span style="font-weight: 700;color: #303030;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;" onclick="show_trecho(3, 2)">+ Adicionar novo trecho</span>
	                            </div>
	                        </div>
	                        <div class="row" id="trecho3" style="display:none">
	                            <div class="col-lg-1"> 
	                                <h4 class="idtrecho" style="">3</h4>
	                            </div>
	                            <div class="col-lg-4">
	                                <div class="form-group fieldFrom">
	                                    <div class="custom-select-form">
	                                        <label style="">ORIGEM</label>
	                                        <input type="text" class="form-control" id="field_origin_trecho3" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho3" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                </div>
	                                <div class="form-group fieldChange"> 
	                                    <span class="fas fa-exchange-alt" onclick="change_fields_trip(3)"></span>
	                                </div>
	                                <div class="form-group fieldTo">
	                                    <div class="custom-select-form">
	                                        <label style="">DESTINO</label>
	                                        <input type="text" class="form-control" id="field_destin_trecho3" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho_destino3" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                    <i class="fas fa-map-marker-alt"></i>
	                                </div>
	                            </div>
	                            <div class="col-lg-2 fieldDates">
	                                <div class="form-group" style="width: 100% !important; margin-top: 9px !important;">
	                                    <label style="">DATAS</label>
	                                    <input class="form-control search-slt" type="text" name="date_trecho3" id="date_trecho3" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
	                                </div>
	                            </div>
	                            <div class="col-lg-3 fieldPax hideTrecho3">
	                                <span style="font-weight: 700;color: #e30f0f;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;" onclick="hide_trecho(3)">- Remover trecho</span>
	                            </div>
	                            <div class="col-lg-2 showTrecho3" style="position:relative">
	                                <span style="font-weight: 700;color: #303030;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;" onclick="show_trecho(4, 3)">+ Adicionar novo trecho</span>
	                            </div>
	                        </div>
	                        <div class="row" id="trecho4" style="display:none">
	                            <div class="col-lg-1"> 
	                                <h4 class="idtrecho" style="">4</h4>
	                            </div>
	                            <div class="col-lg-4">
	                                <div class="form-group fieldFrom">
	                                    <div class="custom-select-form">
	                                        <label style="">ORIGEM</label>
	                                        <input type="text" class="form-control" id="field_origin_trecho4" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho4" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                </div>
	                                <div class="form-group fieldChange"> 
	                                    <span class="fas fa-exchange-alt" onclick="change_fields_trip(4)"></span>
	                                </div>
	                                <div class="form-group fieldTo">
	                                    <div class="custom-select-form">
	                                        <label style="">DESTINO</label>
	                                        <input type="text" class="form-control" id="field_destin_trecho4" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho_destino4" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                    <i class="fas fa-map-marker-alt"></i>
	                                </div>
	                            </div>
	                            <div class="col-lg-2 fieldDates">
	                                <div class="form-group" style="width: 100% !important; margin-top: 9px !important;">
	                                    <label style="">DATAS</label>
	                                    <input class="form-control search-slt" type="text" name="date_trecho4" id="date_trecho4" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
	                                </div>
	                            </div>
	                            <div class="col-lg-3 fieldPax hideTrecho4">
	                                <span style="font-weight: 700;color: #e30f0f;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;" onclick="hide_trecho(4)">- Remover trecho</span>
	                            </div>
	                            <div class="col-lg-2 showTrecho4" style="position:relative">
	                                <span style="font-weight: 700;color: #303030;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;" onclick="show_trecho(5, 4)">+ Adicionar novo trecho</span>
	                            </div>
	                        </div>
	                        <div class="row" id="trecho5" style="display:none">
	                            <div class="col-lg-1"> 
	                                <h4 class="idtrecho" style="">5</h4>
	                            </div>
	                            <div class="col-lg-4">
	                                <div class="form-group fieldFrom">
	                                    <div class="custom-select-form">
	                                        <label style="">ORIGEM</label>
	                                        <input type="text" class="form-control" id="field_origin_trecho5" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho5" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                </div>
	                                <div class="form-group fieldChange"> 
	                                    <span class="fas fa-exchange-alt" onclick="change_fields_trip(5)"></span>
	                                </div>
	                                <div class="form-group fieldTo">
	                                    <div class="custom-select-form">
	                                        <label style="">DESTINO</label>
	                                        <input type="text" class="form-control" id="field_destin_trecho5" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
	                                        <div id="dados_trecho_destino5" class="dados">
	                                            <ul style="padding:0;margin: 0;"></ul>
	                                        </div>
	                                    </div> 
	                                    <i class="fas fa-map-marker-alt"></i>
	                                </div>
	                            </div>
	                            <div class="col-lg-2 fieldDates">
	                                <div class="form-group" style="width: 100% !important; margin-top: 9px !important;">
	                                    <label style="">DATAS</label>
	                                    <input class="form-control search-slt" type="text" name="date_trecho5" id="date_trecho5" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
	                                </div>
	                            </div>
	                            <div class="col-lg-3 fieldPax hideTrecho5">
	                                <span style="font-weight: 700;color: #e30f0f;font-size: 12px;cursor: pointer;text-align:center;position: absolute;bottom: 12px;" onclick="hide_trecho(5)">- Remover trecho</span>
	                            </div>
	                            <div class="col-lg-2" style="position:relative">
	                                 
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-12"> 
	                                <button type="submit" class="btn_search btn btn-danger wrn-btn ripple" onclick="search_results_flights()"><span>Buscar </span></button>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>

		<script src="https://raw.githubusercontent.com/TravelTec/TT-Flights/main/includes/assets/js/script-search-flights.js" id="scripts-flights-js"></script>';
	    return $html;
  	}

  	function getHtmlHotel(){
  		$html = '';
	    $html .= '<section class="banner">  

	        <div class="search-sec container" id="searchHotels">



	            <input type="hidden" id="field_date_checkin_ehtl" value="">

	            <input type="hidden" id="field_date_checkout_ehtl" value=""> 

	            <input type="hidden" id="adultos" value="2"> 

	            <input type="hidden" id="criancas" value=""> 

	            <input type="hidden" id="quartos" value="1"> 

	            <div class="row">

	                <form class="col-lg-12 col-12">

	                    <h4 style="color: #fff;font-weight: 600;font-size: 19px;margin-bottom: 22px;">Hospedagens</h4>

	                    <div class="row no-gutters custom-search-input-2" style="height:40px !important"> 

	                        <div class="col-lg-4">

	                            <div class="form-group">

	                                <div class="custom-select-form">

	                                    <input type="text" class="form-control" id="field_name_ehtl" autocomplete="off" placeholder="Informe a cidade ou hotel..." onfocus="this.value=\'\'">

	                                    <div class="dados">

	                                        <ul style="padding:0;margin: 0;"></ul>

	                                    </div>

	                                </div>

	                                <i class="fa fa-map-marker"></i>

	                            </div>

	                        </div>

	                        <div class="col-lg-4">

	                            <div class="form-group" style="margin-top: 7px !important;">

	                                <input class="form-control search-slt" type="text" name="dates" placeholder="Selecione as datas..." autocomplete="off" readonly="readonly">

	                                <i class="fa fa-calendar"></i>

	                            </div>

	                        </div>

	                        <div class="col-lg-2">

	                            <div class="panel-dropdown">

	                                <a href="#"><i class="fa fa-bed" style="position: unset !important;padding: 0;line-height: 1 !important;height: auto !important;border: none !important;padding: 0 !important;"></i> <span class="qtyRoomHotel" style="padding: 0 9px;">1</span> | <i class="fa fa-user" style="position: unset !important;padding: 0;line-height: 1 !important;height: auto !important;border: none !important;padding: 0 !important;"></i> <span class="qtyTotalHotel" style="padding: 0 9px;">2</span></a>

	                                <div class="panel-dropdown-content">

	                                    <input type="hidden" id="qtd_room_add" value="1">

	                                    <div class="rooms_add">

	                                        <div id="panel1" class="panel1" style="padding:15px 15px 0 15px;">

	                                            <input type="hidden" id="panel1qts" value="1">

	                                            <h6>Quarto 1</h6>

	                                            <hr style="margin:16px 0">

	                                            <div class="qtyButtons qtyAdtHotel">

	                                                <input type="hidden" id="panel1adtHotel" value="2">

	                                                <label>Adultos</label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInputHotel" value="2">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="qtyButtons qtyChdHotel">

	                                                <input type="hidden" id="panel1chdHotel" value="0">

	                                                <label style="line-height: 1 !important;">

	                                                    Menor <br> 

	                                                    <small style="font-weight: 500;font-size: 12px;">Até 17 anos</small>

	                                                </label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInputHotel" value="0" max="4">

	                                                <div class="qtyIncHotel"></div>

	                                            </div> 

	                                            <div class="idade_chd1" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd2" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd3" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd4" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                        </div>

	                                        <div id="panel2" class="panel2" style="display:none;padding:15px 15px 0 15px;">

	                                            <input type="hidden" id="panel2qts" value="0">

	                                            <h6>Quarto 2 <span class="btn btnAddRoom btnRemoverQuarto2" onclick="remove_room(2)" style="display:none;">Remover</span></h6>

	                                            <hr style="margin:16px 0">

	                                            <div class="qtyButtons qtyAdtHotel">

	                                                <input type="hidden" id="panel2adtHotel" value="0">

	                                                <label>Adultos</label>

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="qtyButtons qtyChdHotel">

	                                                <input type="hidden" id="panel2chdHotel" value="0">

	                                                <label style="line-height: 1 !important;">Menor <br> <small style="font-weight: 500;font-size: 12px;">Até 17 anos</small></label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="idade_chd1" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd2" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd3" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd4" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                        </div>

	                                        <div id="panel3" class="panel3" style="display:none;padding:15px 15px 0 15px;">

	                                            <input type="hidden" id="panel3qts" value="0">

	                                            <h6>Quarto 3 <span class="btn btnAddRoom btnRemoverQuarto3" onclick="remove_room(3)" style="display:none;">Remover</span></h6>

	                                            <hr style="margin:16px 0">

	                                            <div class="qtyButtons qtyAdtHotel">

	                                                <input type="hidden" id="panel3adtHotel" value="0">

	                                                <label>Adultos</label>

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="qtyButtons qtyChdHotel">

	                                                <input type="hidden" id="panel3chdHotel" value="0">

	                                                <label style="line-height: 1 !important;">Menor <br> <small style="font-weight: 500;font-size: 12px;">Até 17 anos</small></label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="idade_chd1" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd2" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd3" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd4" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                        </div>

	                                        <div id="panel4" class="panel4" style="display:none;padding:15px 15px 0 15px;">

	                                            <input type="hidden" id="panel4qts" value="0">

	                                            <h6>Quarto 4 <span class="btn btnAddRoom btnRemoverQuarto4" onclick="remove_room(4)" style="display:none;">Remover</span></h6>

	                                            <hr style="margin:16px 0">

	                                            <div class="qtyButtons qtyAdtHotel">

	                                                <input type="hidden" id="panel4adtHotel" value="0">

	                                                <label>Adultos</label>

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="qtyButtons qtyChdHotel">

	                                                <input type="hidden" id="panel4chdHotel" value="0">

	                                                <label style="line-height: 1 !important;">Menor <br> <small style="font-weight: 500;font-size: 12px;">Até 17 anos</small></label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="idade_chd1" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd2" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd3" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd4" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                        </div>

	                                        <div id="panel5" class="panel5" style="display:none;padding:15px 15px 0 15px;">

	                                            <input type="hidden" id="panel5qts" value="0">

	                                            <h6>Quarto 5 <span class="btn btnAddRoom btnRemoverQuarto5" onclick="remove_room(5)" style="display:none;">Remover</span></h6>

	                                            <hr style="margin:16px 0">

	                                            <div class="qtyButtons qtyAdtHotel">

	                                                <input type="hidden" id="panel5adtHotel" value="0">

	                                                <label>Adultos</label>

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="qtyButtons qtyChdHotel">

	                                                <input type="hidden" id="panel5chdHotel" value="0">

	                                                <label style="line-height: 1 !important;">Menor <br> <small style="font-weight: 500;font-size: 12px;">Até 17 anos</small></label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="idade_chd1" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd2" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd3" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd4" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                        </div>

	                                        <div id="panel6" class="panel6" style="display:none;padding:15px 15px 0 15px;">

	                                            <input type="hidden" id="panel6qts" value="0">

	                                            <h6>Quarto 6 <span class="btn btnAddRoom btnRemoverQuarto6" onclick="remove_room(6)" style="display:none;">Remover</span></h6>

	                                            <hr style="margin:16px 0">

	                                            <div class="qtyButtons qtyAdtHotel">

	                                                <input type="hidden" id="panel6adtHotel" value="0">

	                                                <label>Adultos</label>

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="qtyButtons qtyChdHotel">

	                                                <input type="hidden" id="panel6chdHotel" value="0">

	                                                <label style="line-height: 1 !important;">Menor <br> <small style="font-weight: 500;font-size: 12px;">Até 17 anos</small></label> 

	                                                <div class="qtyDecHotel"></div>

	                                                <input type="text" name="qtyInput" value="0">

	                                                <div class="qtyIncHotel"></div>

	                                            </div>

	                                            <div class="idade_chd1" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd2" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd3" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="idade_chd4" style="display:none">

	                                                <div class="row">

	                                                    <div class="col-lg-7 col-12">

	                                                        <label style="line-height:1;font-size: 16px;">Idade<br> <small style="font-weight: 500;font-size: 12px;">Ao finalizar a viagem</small></label> 

	                                                    </div>

	                                                    <div class="col-lg-5 col-12"> 

	                                                        <select class="form-control">

	                                                            <option value="">Selecione...</option>

	                                                            <option value="1">Até 1 ano</option>

	                                                            <option value="2">2 anos</option>

	                                                            <option value="3">3 anos</option>

	                                                            <option value="4">4 anos</option>

	                                                            <option value="5">5 anos</option>

	                                                            <option value="6">6 anos</option>

	                                                            <option value="7">7 anos</option>

	                                                            <option value="8">8 anos</option>

	                                                            <option value="9">9 anos</option>

	                                                            <option value="10">10 anos</option>

	                                                            <option value="11">11 anos</option>

	                                                            <option value="12">12 anos</option>

	                                                            <option value="13">13 anos</option>

	                                                            <option value="14">14 anos</option>

	                                                            <option value="15">15 anos</option>

	                                                            <option value="16">16 anos</option>

	                                                            <option value="17">17 anos</option>

	                                                        </select>

	                                                    </div>

	                                                </div>

	                                            </div>

	                                        </div>

	                                    </div>

	                                    <div class="apply" style="border-top: 1px solid #ccc;padding:15px;">

	                                        <div class="row ">

	                                            <div class="col-lg-12 col-12" style="text-align:right;">

	                                                <span class="btn btnAddRoom spanButtonAddRoom" onclick="add_room()">Adicionar quarto</span>

	                                            </div> 

	                                        </div>

	                                    </div>

	                                </div>

	                            </div>

	                        </div>

	                        <div class="col-lg-2">

	                            <button type="submit" class="btn_search btn btn-danger wrn-btn ripple" onclick="search_results_hotel()"><span>Buscar </span></button>

	                        </div>

	                    </div>

	                </form>

	            </div>

	        </div>

	    </section>';
	    return $html;
  	}
  	/* ****************** */
