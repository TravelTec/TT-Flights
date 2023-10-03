<?php  



/*



Plugin Name: Voucher Tec - Integração Aéreo

Plugin URI: https://github.com/TravelTec/bookinghotels

GitHub Plugin URI: https://github.com/TravelTec/bookinghotels 

Description:  O Plugin Travel Tec - Vôos é um plugin desenvolvido para agências e operadoras de turismo que precisam tratar reserva de passagens aéreas de fornecedores, com integração ao fornecedor Rextur.

Version: 1.1.2

Author: Travel Tec

Author URI: https://traveltec.com.br

License: GPLv2



*/ 
//ini_set("display_errors", 1);
require 'plugin-update-checker-4.10/plugin-update-checker.php';
require 'helpers/mail/Custom_Mailer.php';



add_action( 'admin_init', 'flights_update_checker_setting' );  



function flights_update_checker_setting() { 

	

	register_setting( 'vouchertec-flights', 'serial' ); 



    if ( ! is_admin() || ! class_exists( 'Puc_v4_Factory' ) ) {  

        return;  

    }  



    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker( 

        'https://github.com/TravelTec/TT-Flights',  

        __FILE__,  

        'TT-Flights'  

    );  



    $myUpdateChecker->setBranch('main'); 



}


add_action( 'wp_enqueue_scripts', 'enqueue_scripts_flights' ); 
function enqueue_scripts_flights() {   

    wp_enqueue_script( 'sweetalert-flights', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js'); 

    wp_localize_script( 
        'scripts-flights',
        'wp_ajax_flights',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'dede' => 1234
        )                 
    ); 

} 

add_action( 'admin_enqueue_scripts', 'enqueue_scripts_admin_flights' ); 
function enqueue_scripts_admin_flights() {

    wp_enqueue_script( 'sweetalert-flights', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js');

    wp_enqueue_script( 
        'scripts-admin-flights',
        plugin_dir_url( __FILE__ ) . 'includes/assets/js/scripts-admin.js?v='.date("dmYHis"),
        array( 'jquery' ),
        false,
        true
    );

    wp_localize_script( 
        'scripts-admin-flights',
        'wp_ajax',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'dede' => 1234
        )                 
    );

} 
add_action( 'wp_ajax_storage_data_aeroportos', 'storage_data_aeroportos' );
add_action( 'wp_ajax_nopriv_storage_data_aeroportos', 'storage_data_aeroportos' );
function storage_data_aeroportos(){
    
    echo '[{"cidade":"Aalborg, Dinamarca, Aalborg","codigo":"AAL"},{"cidade":"Aarhus, Dinamarca, Aarhus","codigo":"AAR"},{"cidade":"Abadan, Ir\u00e3, Abadan","codigo":"ABD"},{"cidade":"Abakan, R\u00fassia, Abakan","codigo":"ABA"},{"cidade":"Abbotsford, Canad\u00e1,\u00a0International","codigo":"YXX"},{"cidade":"Aberdeen, Estados Unidos da Am\u00e9rica, Aberdeen","codigo":"ABR"},{"cidade":"Aberdeen, Reino Unido, Dyce","codigo":"ABZ"},{"cidade":"Abha, Ar\u00e1bia Saudita, Abha","codigo":"AHB"},{"cidade":"Abidjan, Costa do Marfim, F. Houphouet Boigny","codigo":"ABJ"},{"cidade":"Abilene, Estados Unidos da Am\u00e9rica, Abilene Regional","codigo":"ABI"},{"cidade":"Abingdon, Austr\u00e1lia","codigo":"ABG"},{"cidade":"Abu Dhabi, Emirados \u00c1rabes Unidos, International","codigo":"AUH"},{"cidade":"Abuja, Nig\u00e9ria, NNamdi Azikiwe","codigo":"ABV"},{"cidade":"Abu Musa Island, Ir\u00e3, Abu Musa","codigo":"AEU"},{"cidade":"Abu Simbel, Egito, Abu Simbel","codigo":"ABS"},{"cidade":"Acapulco, M\u00e9xico, Juan N. Alvarez International","codigo":"ACA"},{"cidade":"Achutupo, Panam\u00e1, Achutupo","codigo":"ACU"},{"cidade":"Acra, Gana, Kotoka International","codigo":"ACC"},{"cidade":"Adado, Som\u00e1lia, Adado","codigo":"AAD"},{"cidade":"Adampur, \u00cdndia, Adampur","codigo":"AIP"},{"cidade":"Adana, Turquia, Sakirpasa","codigo":"ADA"},{"cidade":"Adelaide, Austr\u00e1lia, Adelaide Airport","codigo":"ADL"},{"cidade":"Aden, I\u00eamen, Aden International","codigo":"ADE"},{"cidade":"Adis Abeba, Eti\u00f3pia, Bole","codigo":"ADD"},{"cidade":"Adiyaman, Turquia, Adiyaman","codigo":"ADF"},{"cidade":"Adrar, Arg\u00e9lia, Touat","codigo":"AZR"},{"cidade":"Agades, N\u00edger, Manu Dayak International","codigo":"AJY"},{"cidade":"Agadir, Marrocos, Al Massira","codigo":"AGA"},{"cidade":"Agartala, \u00cdndia, Agartala","codigo":"IXA"},{"cidade":"Agatti Island, \u00cdndia, Agatti Island","codigo":"AGX"},{"cidade":"Agen, Fran\u00e7a, La Garenne","codigo":"AGF"},{"cidade":"Agra, \u00cdndia, Agra","codigo":"AGR"},{"cidade":"Agri, Turquia","codigo":"AJI"},{"cidade":"Aguadilla, Porto Rico, Rafael Hern\u00e1ndez","codigo":"BQN"},{"cidade":"Aguascalientes, M\u00e9xico, Jes\u00fas Teran Peredo International","codigo":"AGU"},{"cidade":"Ahmedabad, \u00cdndia, S. Vallabhbhai Patel","codigo":"AMD"},{"cidade":"Ahwaz, Ir\u00e3, Ahwaz","codigo":"AWZ"},{"cidade":"Aizawl, \u00cdndia, Lengpui","codigo":"AJL"},{"cidade":"Ajaccio, Fran\u00e7a, Napoleon Bonaparte","codigo":"AJA"},{"cidade":"Akita, Jap\u00e3o, Akita","codigo":"AXT"},{"cidade":"Akron Canton, Estados Unidos da Am\u00e9rica, Akron Canton","codigo":"CAK"},{"cidade":"Aksu, China, Aksu","codigo":"AKU"},{"cidade":"Aktau, Cazaquist\u00e3o, Aktau","codigo":"SCO"},{"cidade":"Aktobe, Cazaquist\u00e3o, Aktobe","codigo":"AKX"},{"cidade":"Akulivik, Canad\u00e1, Akulivik","codigo":"AKV"},{"cidade":"Akure, Nig\u00e9ria, Akure","codigo":"AKR"},{"cidade":"Akureyri, Isl\u00e2ndia, Akureyri","codigo":"AEY"},{"cidade":"Al Ain, Emirados \u00c1rabes Unidos","codigo":"AAN"},{"cidade":"Al-Baha, Ar\u00e1bia Saudita, Al Aqiq","codigo":"ABT"},{"cidade":"Albany, Austr\u00e1lia, Albany","codigo":"ALH"},{"cidade":"Albany, Estados Unidos da Am\u00e9rica, Albany","codigo":"ALB"},{"cidade":"Albany, Estados Unidos da Am\u00e9rica, Southwest Ge\u00f3rgia","codigo":"ABY"},{"cidade":"Albenga, It\u00e1lia, Albenda","codigo":"ALL"},{"cidade":"Albuquerque, Estados Unidos da Am\u00e9rica, Internacional Sunport","codigo":"ABQ"},{"cidade":"Albury, Austr\u00e1lia, Albury","codigo":"ABX"},{"cidade":"Aldan, R\u00fassia, Aldan","codigo":"ADH"},{"cidade":"Alderney, Reino Unido, Alderney","codigo":"ACI"},{"cidade":"Alepo, S\u00edria, Aleppo International","codigo":"ALP"},{"cidade":"Alesund, Noruega, Vigra","codigo":"AES"},{"cidade":"Alexandria, Egito, Borg El Arab","codigo":"HBE"},{"cidade":"Alexandria, Estados Unidos da Am\u00e9rica, Alexandria","codigo":"AEX"},{"cidade":"Alexandroupolis, Gr\u00e9cia, Demokritos","codigo":"AXD"},{"cidade":"Al Ghaydah, I\u00eamen, Al GHaydah","codigo":"AAY"},{"cidade":"Alghero, It\u00e1lia, Fertilia","codigo":"AHO"},{"cidade":"Al Hoceima, Marrocos, Cherif Al Idriss","codigo":"AHU"},{"cidade":"Alicante, Espanha, Airport","codigo":"ALC"},{"cidade":"Alice Springs, Austr\u00e1lia, Alice Springs Airport","codigo":"ASP"},{"cidade":"Allahabad, \u00cdndia, Allahabad","codigo":"IXD"},{"cidade":"Allentown,Estados Unidos da Am\u00e9rica, Lehigh Valley International","codigo":"ABE"},{"cidade":"Almaty, Cazaquist\u00e3o, Almaty International","codigo":"ALA"},{"cidade":"Almeria, Espanha, Almeira","codigo":"LEI"},{"cidade":"Al Najaf, Iraque, As Ashraf International","codigo":"NJF"},{"cidade":"Alor, Indon\u00e9sia, Mali","codigo":"ARD"},{"cidade":"Alor Setar, Mal\u00e1sia, Sultan Abdul Halim","codigo":"AOR"},{"cidade":"Alpena, Estados Unidos da Am\u00e9rica, Alpena County","codigo":"APN"},{"cidade":"Alta Floresta, Brasil, Oswaldo Marques Dias","codigo":"AFL"},{"cidade":"Altai, Mong\u00f3lia, Altai","codigo":"LTI"},{"cidade":"Altamira, Brasil, Altamira","codigo":"ATM"},{"cidade":"Alta, Noruega, Alta","codigo":"ALF"},{"cidade":"Altay, China, Altay","codigo":"AAT"},{"cidade":"Altenburg, Alemanha, Nobitz","codigo":"AOC"},{"cidade":"Altenrhein, Su\u00ed\u00e7a, St.Gallen","codigo":"ACH"},{"cidade":"Altoona, Estados Unidos da Am\u00e9rica, Blair County","codigo":"AOO"},{"cidade":"Al Ula, Ar\u00e1bia Saudita, Majed Bin Adulaziz","codigo":"ULH"},{"cidade":"Am\u00e3, Jord\u00e2nia, Amman Queen Alia","codigo":"AMM"},{"cidade":"Amakusa, Jap\u00e3o, Amakusa","codigo":"AXJ"},{"cidade":"Amami, Jap\u00e3o, Amami","codigo":"ASJ"},{"cidade":"Amarillo, Estados Unidos da Am\u00e9rica, Rick Husband International","codigo":"AMA"},{"cidade":"Amasya, Turquia, Merzifon","codigo":"MZH"},{"cidade":"Ambon, Indon\u00e9sia, Pattimura","codigo":"AMQ"},{"cidade":"Amboseli, Qu\u00eania, Amboseli","codigo":"ASV"},{"cidade":"Amesterd\u00e3, Holanda, Amsterdam Schiphol Airport","codigo":"AMS"},{"cidade":"Amgu, R\u00fassia, Amgu","codigo":"AEM"},{"cidade":"Amritsar, \u00cdndia, Sri Guru Ram Dass Jee","codigo":"ATQ"},{"cidade":"Anadyr, R\u00fassia, Ugolny","codigo":"DYR"},{"cidade":"Anahim Lake, Canad\u00e1,\u00a0Anahim Lake","codigo":"YAA"},{"cidade":"Anapa, R\u00fassia, Vityazevo","codigo":"AAQ"},{"cidade":"Ancara, Turquia, Esenboga","codigo":"ESB"},{"cidade":"Anchorage, Estados Unidos da Am\u00e9rica, Ted Stevens","codigo":"ANC"},{"cidade":"Ancona, It\u00e1lia, Falconara","codigo":"AOI"},{"cidade":"Ancud, Chile, Pupelde","codigo":"ZUD"},{"cidade":"Andahuaylas, Peru, Andahuaylas","codigo":"ANS"},{"cidade":"Andenes, Noruega, Andoya","codigo":"ANX"},{"cidade":"Andizhan, Uzbequist\u00e3o, Andizhan","codigo":"AZN"},{"cidade":"Angelholm Helsingborg, Su\u00e9cia, Angelholm Airport","codigo":"AGH"},{"cidade":"Angers, Fran\u00e7a, Marce","codigo":"ANE"},{"cidade":"Anglesey, Reino Unido, Valley","codigo":"VLY"},{"cidade":"Angouleme, Fran\u00e7a, Brie Champniers","codigo":"ANG"},{"cidade":"Aniak, Estados Unidos da Am\u00e9rica, Aniak","codigo":"ANI"},{"cidade":"Anjouan, Comores, Ouani","codigo":"AJN"},{"cidade":"Annaba, Arg\u00e9lia, Rabah Bitat","codigo":"AAE"},{"cidade":"Annecy, Fran\u00e7a, Meythet","codigo":"NCY"},{"cidade":"Ann, Mianmar, Ann","codigo":"VBA"},{"cidade":"Annobon, Guin\u00e9 Equatorial, Annobon","codigo":"NBN"},{"cidade":"Anqing, China, Tianzhushan","codigo":"AQG"},{"cidade":"Anshan, China, Tang Ao","codigo":"AOG"},{"cidade":"Anshun, China, Huangguoshu","codigo":"AVA"},{"cidade":"Antalya, Turquia, Antalya","codigo":"AYT"},{"cidade":"Antananarivo, Madag\u00e1scar, Ivato International","codigo":"TNR"},{"cidade":"Antigua, Antigua e Barbuda, VC Bird International","codigo":"ANU"},{"cidade":"Antique, Filipinas, Evelio Javier","codigo":"EUQ"},{"cidade":"Antofagasta, Chile, Cerro Moreno","codigo":"ANF"},{"cidade":"Antsiranana, Madag\u00e1scar, Arrachart","codigo":"DIE"},{"cidade":"Antu\u00e9rpia, B\u00e9lgica, Antwerp International","codigo":"ANR"},{"cidade":"Aomori, Jap\u00e3o, Aomori","codigo":"AOJ"},{"cidade":"Apartado, Col\u00f4mbia, Carepa Ar Betancourt","codigo":"APO"},{"cidade":"Appleton, Estados Unidos da Am\u00e9rica, Appleton International","codigo":"ATW"},{"cidade":"Aqaba, Jord\u00e2nia, King Hussein International","codigo":"AQJ"},{"cidade":"Aracaju, Brasil, Santa Maria","codigo":"AJU"},{"cidade":"Aracati, Brasil, Dragao do Mar","codigo":"ARX"},{"cidade":"Arad, Rom\u00eania, Arad","codigo":"ARW"},{"cidade":"Arak, Ir\u00e3, Arak","codigo":"AJK"},{"cidade":"Arar, Ar\u00e1bia Saudita, Arar","codigo":"RAE"},{"cidade":"Arathusa Safari Lodge, \u00c1frica do Sul, Arathusa Safari Lodge","codigo":"ASS"},{"cidade":"Arauca, Col\u00f4mbia,Santiago P\u00e9rez","codigo":"AUC"},{"cidade":"Arax\u00e1, Brasil, Arax\u00e1","codigo":"AXX"},{"cidade":"Arba Mintch, Eti\u00f3pia, Arba Minch","codigo":"AMH"},{"cidade":"Arcata\u00a0Eureka, Estados Unidos da Am\u00e9rica, Arcata-Eureka","codigo":"ACV"},{"cidade":"Arctic Bay, Canad\u00e1, Arctic Bay","codigo":"YAB"},{"cidade":"Ardabil, Ir\u00e3, Ardabil","codigo":"ADU"},{"cidade":"Are Ostersund, Su\u00e9cia, Are Ostersund","codigo":"OSD"},{"cidade":"Arequipa, Peru, Rodriguez Ballon","codigo":"AQP"},{"cidade":"Argel, Arg\u00e9lia, Houari Boumediene","codigo":"ALG"},{"cidade":"Argyle, Austr\u00e1lia","codigo":"GYL"},{"cidade":"Arica, Chile, Chacalluta","codigo":"ARI"},{"cidade":"Arkhangelsk, R\u00fassia, Talagi","codigo":"ARH"},{"cidade":"Armenia, Col\u00f4mbia, El Ed\u00e9n","codigo":"AXM"},{"cidade":"Armidale, Austr\u00e1lia, Armidale","codigo":"ARM"},{"cidade":"Arthurs Town, Bahamas, Arthurs Town","codigo":"ATC"},{"cidade":"Arua, Uganda, Arua","codigo":"RUA"},{"cidade":"Arusha, Tanz\u00e2nia, Arusha","codigo":"ARK"},{"cidade":"Arviat, Canad\u00e1, Arviat Eskimo Point","codigo":"YEK"},{"cidade":"Arvidsjaur, Su\u00e9cia, Arvidsjaur","codigo":"AJR"},{"cidade":"Arxan, China, Yiershi Airport","codigo":"YIE"},{"cidade":"Asaba, Nig\u00e9ria, International","codigo":"ABB"},{"cidade":"Asahikawa, Jap\u00e3o, Asahikawa","codigo":"AKJ"},{"cidade":"Asalouyeh, Ir\u00e3, Persian Gulf International","codigo":"PGU"},{"cidade":"Asheville, Estados Unidos da Am\u00e9rica, Asheville","codigo":"AVL"},{"cidade":"Ashgabat, Turcomenist\u00e3o, Ashgabat International","codigo":"ASB"},{"cidade":"Asmara, Eritreia, Asmara","codigo":"ASM"},{"cidade":"Asosa, Eti\u00f3pia, Asosa","codigo":"ASO"},{"cidade":"Aspen, Estados Unidos da Am\u00e9rica, Pitkin-County","codigo":"ASE"},{"cidade":"Assiut, Egito, Asyut","codigo":"ATZ"},{"cidade":"Assu\u00e3o, Egito, Aswan International","codigo":"ASW"},{"cidade":"Assun\u00e7\u00e3o, Paraguai, Silvio Pettirossi","codigo":"ASU"},{"cidade":"Astrakhan, R\u00fassia, Astrakhan","codigo":"ASF"},{"cidade":"Astypalaia Island, Gr\u00e9cia","codigo":"JTY"},{"cidade":"Atambua, Indon\u00e9sia, Haliwen","codigo":"ABU"},{"cidade":"Atar, Maurit\u00e2nia, Mouakchott","codigo":"ATR"},{"cidade":"Atenas, Gr\u00e9cia, Athens Int. E Venizelos","codigo":"ATH"},{"cidade":"Atlanta, Estados Unidos da Am\u00e9rica, Hartsfield-Jackson","codigo":"ATL"},{"cidade":"Atlantic City, Estados Unidos da Am\u00e9rica, Atlantic City International","codigo":"ACY"},{"cidade":"Attawapiskat, , Canad\u00e1, Attawapiskat","codigo":"YAT"},{"cidade":"Atyrau, Cazaquist\u00e3o, Atyrau","codigo":"GUW"},{"cidade":"Auckland, Austr\u00e1lia, Auckland International","codigo":"AKL"},{"cidade":"Augusta, Estados Unidos da Am\u00e9rica, Bush Field","codigo":"AGS"},{"cidade":"Aupaluk, Canad\u00e1, Inukjuak","codigo":"YPJ"},{"cidade":"Aurangabad, \u00cdndia, Aurangabad","codigo":"IXU"},{"cidade":"Aurillac, Fran\u00e7a, Aurillac","codigo":"AUR"},{"cidade":"Aurukun, Austr\u00e1lia","codigo":"AUU"},{"cidade":"Austin, Estados Unidos da Am\u00e9rica, Austin Bergstrom International","codigo":"AUS"},{"cidade":"Avignon, Fran\u00e7a, Caumont","codigo":"AVN"},{"cidade":"Awassa, Eti\u00f3pia, Awasa","codigo":"AWA"},{"cidade":"Axum, Eti\u00f3pia, Axum","codigo":"AXU"},{"cidade":"Ayacucho, Peru, Alfredo M Duarte","codigo":"AYP"},{"cidade":"Ayers Rock, Austr\u00e1lia, Connellan Airport","codigo":"AYQ"},{"cidade":"Babau, Indon\u00e9sia","codigo":"BUW"},{"cidade":"Bacau, Rom\u00eania, Bacau","codigo":"BCM"},{"cidade":"Bacolod, Filipinas, Silay International","codigo":"BCD"},{"cidade":"Badajoz, Espanha, Badajoz","codigo":"BJZ"},{"cidade":"Badu Island, Austr\u00e1lia","codigo":"BDD"},{"cidade":"Bafoussam, Camar\u00f5es, Bafoussam","codigo":"BFX"},{"cidade":"Bagan Nyaung U, Mianmar","codigo":"NYU"},{"cidade":"Bagdogra, \u00cdndia, Bagdogra","codigo":"IXB"},{"cidade":"Bag\u00e9, Brasil, Gustavo Craemer","codigo":"BGX"},{"cidade":"Baghdad, Iraque, Baghdad International","codigo":"BGW"},{"cidade":"Bahar Dar, Eti\u00f3pia, Bahar Dar","codigo":"BJR"},{"cidade":"Bahawalpur, Paquist\u00e3o, Bahawalpur","codigo":"BHV"},{"cidade":"Bahia Blanca, Argentina, Comandante Espora","codigo":"BHI"},{"cidade":"Bahia Pina, Panam\u00e1, Bahia Pina","codigo":"BFQ"},{"cidade":"Bahrain, Bahrain International","codigo":"BAH"},{"cidade":"Baia Mare, Rom\u00eania, Baia Mare","codigo":"BAY"},{"cidade":"Baicheng, China, Changan","codigo":"DBC"},{"cidade":"Baie Comeau, Canad\u00e1, Baie Comeau","codigo":"YBC"},{"cidade":"Baise, China, Youjiang","codigo":"AEB"},{"cidade":"Baishan, China, Changbaishan","codigo":"NBS"},{"cidade":"Bajawa, Indon\u00e9sia, Soa","codigo":"BJW"},{"cidade":"Bakelalan, Mal\u00e1sia, Bakelalan","codigo":"BKM"},{"cidade":"Bakersfield, Estados Unidos da Am\u00e9rica, Meadows Field","codigo":"BFL"},{"cidade":"Baku, Azerbaij\u00e3o, Heydar Aliyev International","codigo":"GYD"},{"cidade":"Baku, Azerbaij\u00e3o , Todos Aeroportos","codigo":"BAK"},{"cidade":"Baku, Azerbaij\u00e3o, Zabrat Airport","codigo":"ZXT"},{"cidade":"Balboa, Panam\u00e1, Panama Pacifico","codigo":"BLB"},{"cidade":"Balikpapan, Indon\u00e9sia, Sepinggan","codigo":"BPN"},{"cidade":"Balkanabat, Turcomenist\u00e3o, Balkanabat","codigo":"BKN"},{"cidade":"Balkhash, Cazaquist\u00e3o, Balkhash","codigo":"BXH"},{"cidade":"Ballina, Austr\u00e1lia, Byron Gateway","codigo":"BNK"},{"cidade":"Balmaceda, Chile, Balmaceda","codigo":"BBA"},{"cidade":"Balti, Mold\u00e1via, Balti International","codigo":"BZY"},{"cidade":"Baltimore, Estados Unidos da Am\u00e9rica, Baltimore, Washington","codigo":"BWI"},{"cidade":"Bamako, Mali, Senou International","codigo":"BKO"},{"cidade":"Bamenda, Camar\u00f5es, Bamenda","codigo":"BPC"},{"cidade":"Bam, Ir\u00e3, Bam","codigo":"BXR"},{"cidade":"Bamyan, Afeganist\u00e3o, Bamyan","codigo":"BIN"},{"cidade":"Banda Aceh, Indon\u00e9sia","codigo":"BTJ"},{"cidade":"Bandar Abbas, Ir\u00e3, Bandar Abbas","codigo":"BND"},{"cidade":"Bandar Lampung, Indon\u00e9sia, Radin Inten II","codigo":"TKG"},{"cidade":"Bandar Lengeh, Ir\u00e3, Bandar Lengeh","codigo":"BDH"},{"cidade":"Bandar Mahshahr, Ir\u00e3, Bandar Mahshahr","codigo":"MRX"},{"cidade":"Bandar Seri Begawan, Brunei, Brunei International","codigo":"BWN"},{"cidade":"Bandung, Indon\u00e9sia","codigo":"BDO"},{"cidade":"Bangalore, \u00cdndia, Kempegowda International","codigo":"BLR"},{"cidade":"Bangkok,Tail\u00e2ndia, Don Mueang International","codigo":"DMK"},{"cidade":"Bangkok, Tail\u00e2ndia, Suvarnabhumi","codigo":"BKK"},{"cidade":"Bangor, Estados Unidos da Am\u00e9rica, Bangor","codigo":"BGR"},{"cidade":"Bangui, Rep\u00fablica Centro Africana, Mpoko International","codigo":"BGF"},{"cidade":"Banja Luka, B\u00f3snia e Herzegovina, Banja Luka International","codigo":"BNX"},{"cidade":"Banjarmasin, Indon\u00e9sia, Syamsudin Noor","codigo":"BDJ"},{"cidade":"Banjul Yundum, G\u00e2mbia, International","codigo":"BJL"},{"cidade":"Banyuwangi, Indon\u00e9sia, Blimbingsari","codigo":"BWX"},{"cidade":"Baoshan, China, Baoshan","codigo":"BSD"},{"cidade":"Baotou, China, Erliban","codigo":"BAV"},{"cidade":"Baracoa, Cuba, Gustavo Rizo","codigo":"BCA"},{"cidade":"Barcaldine, Austr\u00e1lia","codigo":"BCI"},{"cidade":"Barcelona, Espanha, Barcelona","codigo":"BCN"},{"cidade":"Barcelona, Venezuela, J A Anzoategui","codigo":"BLA"},{"cidade":"Bardufoss, Noruega, bardufoss","codigo":"BDU"},{"cidade":"Bar Harbor, Estados Unidos da Am\u00e9rica, Hancock County","codigo":"BHB"},{"cidade":"Bari, It\u00e1lia, Palese","codigo":"BRI"},{"cidade":"Bariloche, Argentina, Bariloche","codigo":"BRC"},{"cidade":"Barinas, Venezuela, Barinas","codigo":"BNS"},{"cidade":"Bario, Mal\u00e1sia, Bario","codigo":"BBN"},{"cidade":"Barisal, Bangladesh, Barisal","codigo":"BZL"},{"cidade":"Barnaul, R\u00fassia, Barnaul","codigo":"BAX"},{"cidade":"Barquisimeto, Venezuela, jacinto Lara","codigo":"BRM"},{"cidade":"Barra do Gar\u00e7as, Brasil, Barra do Gar\u00e7as","codigo":"BPG"},{"cidade":"Barrancabermeja, Col\u00f4mbia, Yariguies","codigo":"EJA"},{"cidade":"Barra North Bay, Reino Unido","codigo":"BRR"},{"cidade":"Barranquilla, Col\u00f4mbia, Ernesto Cortissoz","codigo":"BAQ"},{"cidade":"Barreiras, Brasil, Barreiras","codigo":"BRA"},{"cidade":"Barrow, Estados Unidos da Am\u00e9rica, Memorial Wiley Post-Will Rogers","codigo":"BRW"},{"cidade":"Basco, Filipinas, Basco","codigo":"BSO"},{"cidade":"Basileia, Su\u00ed\u00e7a, Basel Euroairport","codigo":"BSL"},{"cidade":"Basrah, Iraque, Basrah International","codigo":"BSR"},{"cidade":"Basseterre, St Kitts, S\u00e3o Crist\u00f3v\u00e3o e N\u00e9vis, Robert L Bradshaw","codigo":"SKB"},{"cidade":"Batagay, R\u00fassia, Batagay","codigo":"BQJ"},{"cidade":"Bata, Guin\u00e9 Equatorial, Bata","codigo":"BSG"},{"cidade":"Batam, Indon\u00e9sia, Hang Nadim","codigo":"BTH"},{"cidade":"Batavia Downs, Austr\u00e1lia","codigo":"BVW"},{"cidade":"Bathinda, \u00cdndia, Bathinda","codigo":"BUP"},{"cidade":"Bathurst, Austr\u00e1lia","codigo":"BHS"},{"cidade":"Bathurst, Canad\u00e1, Bathurst","codigo":"ZBF"},{"cidade":"Batman, Turquia, Batman","codigo":"BAL"},{"cidade":"Batna, Arg\u00e9lia, Moustepha Ben Boulaid","codigo":"BLJ"},{"cidade":"Baton Rouge, Estados Unidos da Am\u00e9rica, Metropolita Ryan Field","codigo":"BTR"},{"cidade":"Batsfjord, Noruega, Batsfjord","codigo":"BJF"},{"cidade":"Batticaloa, Sri Lanka, Batticaloa Airport","codigo":"BTC"},{"cidade":"Batu Licin, Indon\u00e9sia","codigo":"BTW"},{"cidade":"Batumi, Ge\u00f3rgia, Batumi","codigo":"BUS"},{"cidade":"Bauchi, Nig\u00e9ria, Bauchi","codigo":"BCU"},{"cidade":"Bayamo, Cuba, Carlos M. de Cespedes","codigo":"BYM"},{"cidade":"Bayannur, China, Tianjitai","codigo":"RLK"},{"cidade":"Bazhong, China, Enyang","codigo":"BZX"},{"cidade":"Beaumont\u00a0Port Arthur, Estados Unidos da Am\u00e9rica, Jack Brooks Regional","codigo":"BPT"},{"cidade":"Bechar, Arg\u00e9lia, Boudghene B Ali Loft","codigo":"CBH"},{"cidade":"Bedford, Estados Unidos da Am\u00e9rica, Laurence G.\u00a0Hanscom Field","codigo":"BED"},{"cidade":"Bedourie, Austr\u00e1lia","codigo":"BEU"},{"cidade":"Beida, L\u00edbia, Labraq","codigo":"LAQ"},{"cidade":"Beihai, China, Fucheng","codigo":"BHY"},{"cidade":"Beira, Mo\u00e7ambique, Beira","codigo":"BEW"},{"cidade":"Beirute, L\u00edbano, Rafic Hariri","codigo":"BEY"},{"cidade":"Bejaia, Arg\u00e9lia, Soumman Abane Ramdane","codigo":"BJA"},{"cidade":"Belaya Gora, R\u00fassia, Belaya Gora","codigo":"BGN"},{"cidade":"Bel\u00e9m, Brasil, Val de Cans","codigo":"BEL"},{"cidade":"Beletwene, Som\u00e1lia, Beletwene","codigo":"BLW"},{"cidade":"Belfast, Reino Unido, George Best City","codigo":"BHD"},{"cidade":"Belgau, \u00cdndia, Sambre","codigo":"IXG"},{"cidade":"Belgorod, R\u00fassia, Belgorod","codigo":"EGO"},{"cidade":"Belgrado, S\u00e9rvia, Nikola Tesla","codigo":"BEG"},{"cidade":"Belize City, Belize, Philip S. W. Goldson","codigo":"BZE"},{"cidade":"Bella Bella, Canad\u00e1, Campbell Island","codigo":"ZEL"},{"cidade":"Bella Coola, Canad\u00e1, Bella Coola","codigo":"QBC"},{"cidade":"Bellingham, Estados Unidos da Am\u00e9rica, Bellingham International","codigo":"BLI"},{"cidade":"Belmopan, Belize, Hector Silva","codigo":"BCV"},{"cidade":"Belo Horizonte, Brasil , Todos Aeroportos","codigo":"BHZ"},{"cidade":"Beloyarsky, R\u00fassia, Beloyarsky","codigo":"EYK"},{"cidade":"Bemidji, Estados Unidos da Am\u00e9rica, Bemidji","codigo":"BJI"},{"cidade":"Benbecula, Reino Unido, Benbecula","codigo":"BEB"},{"cidade":"Bendigo, Austr\u00e1lia","codigo":"BXG"},{"cidade":"Benghazi, L\u00edbia, Benina International","codigo":"BEN"},{"cidade":"Bengkulu, Indon\u00e9sia, Fatmawati Soekarno","codigo":"BKS"},{"cidade":"Beni Mellal, Marrocos, Beni Millal Nacional","codigo":"BEM"},{"cidade":"Benin City, Nig\u00e9ria, Benin","codigo":"BNI"},{"cidade":"Beni, Rep\u00fablica Democr\u00e1tica do Congo, Maivi","codigo":"BNC"},{"cidade":"Bentota, Sri Lanka, Bentota, River","codigo":"BJT"},{"cidade":"Bergen, Noruega, Flesland","codigo":"BGO"},{"cidade":"Bergerac, Fran\u00e7a, Roumaniere","codigo":"EGC"},{"cidade":"Berlevag, Noruega, Berlevag","codigo":"BVG"},{"cidade":"Berlim, Alemanha, Schoenefeld","codigo":"SXF"},{"cidade":"Berlim, Alemanha, Tegel","codigo":"TXL"},{"cidade":"Berlim, Alemanha , Todos Aeroportos","codigo":"BER"},{"cidade":"Berna, Su\u00ed\u00e7a, Berm Help","codigo":"BRN"},{"cidade":"Bertoua, Camar\u00f5es, Bertoua","codigo":"BTA"},{"cidade":"Bethel, Estados Unidos da Am\u00e9rica, Bethel","codigo":"BET"},{"cidade":"Beziers, Fran\u00e7a, Vias","codigo":"BZR"},{"cidade":"Bhadrapur, Nepal, Chandragri","codigo":"BDP"},{"cidade":"Bhairawa, Nepal, Gautam Buddha","codigo":"BWA"},{"cidade":"Bhamo, Mianmar, Bhamo","codigo":"BMO"},{"cidade":"Bharatpur, Nepal, Bharatpur","codigo":"BHR"},{"cidade":"Bhavnagar, \u00cdndia, Bhavnagar","codigo":"BHU"},{"cidade":"Bhopal, \u00cdndia, Raja Bhoj","codigo":"BHO"},{"cidade":"Bhubaneswar, \u00cdndia, Biju Patnaik","codigo":"BBI"},{"cidade":"Bhuj, \u00cdndia, Shyamji Krishna Verma","codigo":"BHJ"},{"cidade":"Biak, Indon\u00e9sia, Frans Kasiepo","codigo":"BIK"},{"cidade":"Biarritz, Fran\u00e7a, Pays Basque","codigo":"BIQ"},{"cidade":"Bijie, China, Bijie","codigo":"BFJ"},{"cidade":"Bikaner, \u00cdndia, Nal","codigo":"BKB"},{"cidade":"Bilbao, Espanha, Bilbao Airport","codigo":"BIO"},{"cidade":"Bildudalur, Isl\u00e2ndia, Bildudalur","codigo":"BIU"},{"cidade":"Billings, Estados Unidos da Am\u00e9rica, Logan","codigo":"BIL"},{"cidade":"Billund, Dinamarca, Billund","codigo":"BLL"},{"cidade":"Bima, Indon\u00e9sia","codigo":"BMU"},{"cidade":"Bimini, Bahamas, South Bimini","codigo":"BIM"},{"cidade":"Binghamton, Estados Unidos da Am\u00e9rica, Greater Binghamton","codigo":"BGM"},{"cidade":"Bingol, Turquia, Bingol","codigo":"BGG"},{"cidade":"Bintulu, Mal\u00e1sia, Bintulu Airport","codigo":"BTU"},{"cidade":"Biratnagar, Nepal, Biratnagar","codigo":"BIR"},{"cidade":"Birdsville, Austr\u00e1lia","codigo":"BVI"},{"cidade":"Birjand, Ir\u00e3, Birjand","codigo":"XBJ"},{"cidade":"Birmingham, Estados Unidos da Am\u00e9rica, Shuttlesworth","codigo":"BHM"},{"cidade":"Birmingham, Reino Unido, Birmingham","codigo":"BHX"},{"cidade":"Bisha, Ar\u00e1bia Saudita, Bisha","codigo":"BHH"},{"cidade":"Bishkek, Quirguist\u00e3o, Manas International","codigo":"FRU"},{"cidade":"Biskra, Arg\u00e9lia, Mohamed Khider","codigo":"BSK"},{"cidade":"Bismarck, Estados Unidos da Am\u00e9rica, Bismarck","codigo":"BIS"},{"cidade":"Bissau, Guin\u00e9-Bissau, Osvaldo Vieira","codigo":"OXB"},{"cidade":"Blackall, Austr\u00e1lia","codigo":"BKQ"},{"cidade":"Blagoveschensk, R\u00fassia, Ignatyevo","codigo":"BQS"},{"cidade":"Blanc Sablon, Canad\u00e1, Lourdes de Blancsablon","codigo":"YBX"},{"cidade":"Blantyre, Mal\u00e1ui, Chileka International","codigo":"BLZ"},{"cidade":"Bloemfontein, \u00c1frica do Sul, Bloemfontein International","codigo":"BFN"},{"cidade":"Bloomington\u00a0Normal, Estados Unidos da Am\u00e9rica, Central Illinois Regional","codigo":"BMI"},{"cidade":"Boa Vista, Brasil, Boa Vista","codigo":"BVB"},{"cidade":"Bobo Dioulasso, Burkina Faso, Bobo Dioulasso","codigo":"BOY"},{"cidade":"Bocas Del Toro, Panam\u00e1, Isla Colon","codigo":"BOC"},{"cidade":"Bodaybo, R\u00fassia, Bodaybo","codigo":"ODO"},{"cidade":"Bodo, Noruega, Bodo","codigo":"BOO"},{"cidade":"Bodrum, Turquia, Milas","codigo":"BJV"},{"cidade":"Bogorodskoye, R\u00fassia, Bogorodskoye","codigo":"BQG"},{"cidade":"Bogot\u00e1, Col\u00f4mbia, El Dorado","codigo":"BOG"},{"cidade":"Boigu Island, Austr\u00e1lia","codigo":"GIC"},{"cidade":"Boise, Estados Unidos da Am\u00e9rica, Air Terminal\u00a0Gowen Field","codigo":"BOI"},{"cidade":"Bojnurd, Ir\u00e3, Bojnurd","codigo":"BJB"},{"cidade":"Bokpyin, Mianmar, Bokpyin","codigo":"VBP"},{"cidade":"Bole, China, Alashankou","codigo":"BPL"},{"cidade":"Bolonha, It\u00e1lia, Guglielmo Marconi","codigo":"BLQ"},{"cidade":"Bolzano bozen, It\u00e1lia, Dolomiti","codigo":"BZO"},{"cidade":"Bom Jesus da Lapa, Brasil","codigo":"LZA"},{"cidade":"Bom Jesus da Lapa, Brasil, Bom Jesus da Lapa","codigo":"LAZ"},{"cidade":"Bonaventure, Canad\u00e1, Bonaventure","codigo":"YVB"},{"cidade":"Bordeaux, Fran\u00e7a, M\u00e9rignac","codigo":"BOD"},{"cidade":"Bordj Mokhtar, Arg\u00e9lia, Bordj Mokhtar","codigo":"BMW"},{"cidade":"Borlange Falun, Su\u00e9cia, Dala Airport","codigo":"BLE"},{"cidade":"Bornholm, Dinamarca, Ronne","codigo":"RNN"},{"cidade":"Bor, R\u00fassia, Podkamennaya Tunguska","codigo":"TGP"},{"cidade":"Bosaso, Som\u00e1lia, Bosaso International","codigo":"BSA"},{"cidade":"Boston, Estados Unidos da Am\u00e9rica, Edward L Logan","codigo":"BOS"},{"cidade":"Bouake, Costa do Marfim, Bouake","codigo":"BYK"},{"cidade":"Boulia, Austr\u00e1lia","codigo":"BQL"},{"cidade":"Bournemouth, Reino Unido, Bournemouth International","codigo":"BOH"},{"cidade":"Bovanenkovo, R\u00fassia, Bovanenkovo","codigo":"BVJ"},{"cidade":"Bozeman, Estados Unidos da Am\u00e9rica, Yellowstone","codigo":"BZN"},{"cidade":"Brac, Cro\u00e1cia, Bol","codigo":"BWK"},{"cidade":"Bragan\u00e7a, Portugal, Braganca","codigo":"BGC"},{"cidade":"Brainerd, Estados Unidos da Am\u00e9rica, Brainerd Lakes","codigo":"BRD"},{"cidade":"Bras\u00edlia, Brasil, Juscelino Kubitschek","codigo":"BSB"},{"cidade":"Bratislava, Eslov\u00e1quia, M R Stefanik","codigo":"BTS"},{"cidade":"Bratsk, R\u00fassia, Bratsk","codigo":"BTK"},{"cidade":"Brazzaville, Rep\u00fablica do Congo, Maya Maya","codigo":"BZV"},{"cidade":"Bremen\u00a0, Alemanha, Bremen","codigo":"BRE"},{"cidade":"Brest, Bielor\u00fassia, Brest","codigo":"BQT"},{"cidade":"Brest, Fran\u00e7a, Bretagne","codigo":"BES"},{"cidade":"Bridgetown, Barbados, Grantley Adams","codigo":"BGI"},{"cidade":"Brindisi, It\u00e1lia, Casale","codigo":"BDS"},{"cidade":"Brisbane, Austr\u00e1lia, Brisbane International Airport","codigo":"BNE"},{"cidade":"Bristol, Reino Unido, Bristol","codigo":"BRS"},{"cidade":"Brive La Gaillard, Fran\u00e7a, Vallee de la Dordogne","codigo":"BVE"},{"cidade":"Brize Norton, Reino Unido","codigo":"BZZ"},{"cidade":"Brno, Rep\u00fablica Tcheca, Turany","codigo":"BRQ"},{"cidade":"Broken Hill, Austr\u00e1lia, Broken Hill","codigo":"BHQ"},{"cidade":"Bronnoysund, Noruega, Bronnoy","codigo":"BNN"},{"cidade":"Broome, Austr\u00e1lia, Broome International","codigo":"BME"},{"cidade":"Brownsville, Estados Unidos da Am\u00e9rica, South Padre","codigo":"BRO"},{"cidade":"Brunswick, Estados Unidos da Am\u00e9rica, Golden Isles","codigo":"BQK"},{"cidade":"Bruxelas, B\u00e9gica, Brussels Zaventem","codigo":"BRU"},{"cidade":"Bruxelas Charleroi, B\u00e9lgica, Brussels Charleoi, ","codigo":"CRL"},{"cidade":"Bryansk, R\u00fassia, Bryansk","codigo":"BZK"},{"cidade":"Bucaramanga, Col\u00f4mbia, Palonegro","codigo":"BGA"},{"cidade":"Bucareste, Rom\u00eania, Bucharest Henri Coanda, ","codigo":"OTP"},{"cidade":"Budapeste, Hungria, Liszt Ferenc International","codigo":"BUD"},{"cidade":"Buenos Aires, Argentina, Ezeiza","codigo":"EZE"},{"cidade":"Buenos Aires, Argentina, J. Newbery","codigo":"AEP"},{"cidade":"Buenos Aires, Argentina , Todos aeroportos","codigo":"BUE"},{"cidade":"Buffalo, Estados Unidos da Am\u00e9rica, Buffalo Niagara","codigo":"BUF"},{"cidade":"Bugulma, R\u00fassia, Bugulma","codigo":"UUA"},{"cidade":"Bujumbura, Burundi, Bujumbura International","codigo":"BJM"},{"cidade":"Bukavu, Rep\u00fablica Democr\u00e1tica do Congo, Kavumu","codigo":"BKY"},{"cidade":"Bukhara, Uzbequist\u00e3o, International","codigo":"BHK"},{"cidade":"Bukoba, Tanz\u00e2nia, Bukoka","codigo":"BKZ"},{"cidade":"Bulawayo, Zimb\u00e1bue, Joshua M. Nkomo","codigo":"BUQ"},{"cidade":"Bullhead City, Estados Unidos da Am\u00e9rica, Laughlin Bullhead","codigo":"IFP"},{"cidade":"Bumba, Rep\u00fablica Democr\u00e1tica do Congo, Bumba","codigo":"BMB"},{"cidade":"Bundaberg, Austr\u00e1lia, Bundaberg","codigo":"BDB"},{"cidade":"Bunia, Rep\u00fablica Democr\u00e1tica do Congo, Bunia","codigo":"BUX"},{"cidade":"Buol, Indon\u00e9sia, Pogogul","codigo":"UOL"},{"cidade":"Buon Ma Thuot, Vietn\u00e3, Buon Ma Thuot","codigo":"BMV"},{"cidade":"Burbank, Estados Unidos da Am\u00e9rica, Bob Hope","codigo":"BUR"},{"cidade":"Burgas, Bulg\u00e1ria, Burgas","codigo":"BOJ"},{"cidade":"Burgos, Espanha, Burgos","codigo":"RGS"},{"cidade":"Buriram, Tail\u00e2ndia, Buriram","codigo":"BFV"},{"cidade":"Burketown, Austr\u00e1lia","codigo":"BUC"},{"cidade":"Burlington, Estados Unidos da Am\u00e9rica, Burlington International","codigo":"BTV"},{"cidade":"Burnie, Austr\u00e1lia, Wynyard","codigo":"BWT"},{"cidade":"Burqin, China, Kanas","codigo":"KJI"},{"cidade":"Bursa, Turquia, Yenisehir","codigo":"YEI"},{"cidade":"Busan, Cor\u00e9ia do Sul, Gimhae International","codigo":"PUS"},{"cidade":"Bushehr, Ir\u00e3, Bushehr","codigo":"BUZ"},{"cidade":"Busuanga, Filipinas","codigo":"USU"},{"cidade":"Butte, Estados Unidos da Am\u00e9rica, Bert Mooney","codigo":"BTM"},{"cidade":"Butuan, Filipinas, Bancasi","codigo":"BXU"},{"cidade":"Bydgoszcz, Polonia, Ignacy Jan Paderewski","codigo":"BZG"},{"cidade":"Cabinda, Angola, Cabinda","codigo":"CAB"},{"cidade":"Cacoal, Brasil, Cacoal","codigo":"OAL"},{"cidade":"Caen, Fran\u00e7a, Carpiquet","codigo":"CFR"},{"cidade":"Cagayan De Oro, Filipinas, Laguindingan","codigo":"CGY"},{"cidade":"Cagliari, It\u00e1lia, Elmas","codigo":"CAG"},{"cidade":"Caiena, Guiana Francesa, Felix Eboue","codigo":"CAY"},{"cidade":"Cairns International Airport, Austr\u00e1lia, Cairns International Airport","codigo":"CNS"},{"cidade":"Cairo, Egito, Cairo International","codigo":"CAI"},{"cidade":"Cajamarca, Peru, Armando R Iglesias","codigo":"CJA"},{"cidade":"Calabar, Nig\u00e9ria, Margaret Ekpo","codigo":"CBQ"},{"cidade":"Calama, Chile, El Loa","codigo":"CJC"},{"cidade":"Calamata, Gr\u00e9cia, Kalamata","codigo":"KLX"},{"cidade":"Calbayog, Filipinas, Calbayog","codigo":"CYP"},{"cidade":"Caldas Novas, Brasil, Nelson R. Guimaraes","codigo":"CLV"},{"cidade":"Calgary, Canad\u00e1, Calgary","codigo":"YYC"},{"cidade":"C\u00e1li, Col\u00f4mbia, Alfonso Bonilla Arag\u00f3n","codigo":"CLO"},{"cidade":"Calimnos, Gr\u00e9cia, Kalymnos Island","codigo":"JKL"},{"cidade":"Calvi, Fran\u00e7a, Ste Catherine","codigo":"CLY"},{"cidade":"Camaguey, Cuba, Ignacio Agramonte","codigo":"CMW"},{"cidade":"Ca Mau, Vietn\u00e3, Ca Mau","codigo":"CAH"},{"cidade":"Cambridge Bay, Canad\u00e1, Cambridge Bay","codigo":"YCB"},{"cidade":"Cambridge, Reino Unido, Cambridge","codigo":"CBG"},{"cidade":"Camiguin Island, Filipinas, Mambajao","codigo":"CGM"},{"cidade":"Campbell River, Canad\u00e1, Campbell River","codigo":"YBL"},{"cidade":"Campeche, M\u00e9xico, Alberto Acuna Ongay International","codigo":"CPE"},{"cidade":"Campina Grande, Brasil, Joao Suassuna","codigo":"CPV"},{"cidade":"Campo Grande, Brasil, Campo Grande","codigo":"CGR"},{"cidade":"Canakkale, Turquia, Canakkale","codigo":"CKZ"},{"cidade":"Canberra, Austr\u00e1lia, Canberra","codigo":"CBR"},{"cidade":"Canc\u00fan, M\u00e9xico, Cancun International","codigo":"CUN"},{"cidade":"Cangyuan, China, Washan","codigo":"CWJ"},{"cidade":"Cant\u00e3o, Guangzhou, China, Baiyun International","codigo":"CAN"},{"cidade":"Can Tho, Vietn\u00e3, International","codigo":"VCA"},{"cidade":"Cap Haitien,Haiti, Hugo Chavez","codigo":"CAP"},{"cidade":"Caracas, Venezuela, Simon Bolivar","codigo":"CCS"},{"cidade":"Carcassonne, Fran\u00e7a, Salvaza","codigo":"CCF"},{"cidade":"Cardiff, Reino Unido, Cardiff","codigo":"CWL"},{"cidade":"Carlisle, Reino Unido, Carlisle","codigo":"CAX"},{"cidade":"Carlsbad, Estados Unidos da Am\u00e9rica, McClellan-Palomar","codigo":"CLD"},{"cidade":"Carnarvon, Austr\u00e1lia, Carnarvon","codigo":"CVQ"},{"cidade":"Cartagena das \u00cdndias, Col\u00f4mbia, Rafael Nunez","codigo":"CTG"},{"cidade":"Cartum, Sud\u00e3o, International","codigo":"KRT"},{"cidade":"Casablanca, Marrocos, Mohammed V","codigo":"CMN"},{"cidade":"Cascais, Portugal, Tires","codigo":"CAT"},{"cidade":"Casper, Estados Unidos da Am\u00e9rica, Natrona County International","codigo":"CPR"},{"cidade":"Castellon De La Plana, Espanha, Castellon","codigo":"CDT"},{"cidade":"Castlegar, Canad\u00e1,\u00a0West Kootney Regional","codigo":"YCG"},{"cidade":"Cast\u00f3ria, Gr\u00e9cia, Kastoria Aristoteles","codigo":"KSO"},{"cidade":"Castres, Fran\u00e7a, Mazamet","codigo":"DCM"},{"cidade":"Castro, Chile, Mocopulli","codigo":"MHC"},{"cidade":"Catamarca Choya, Argentina, Catamarca","codigo":"CTC"},{"cidade":"Cat\u00e2nia\u00a0, It\u00e1lia, Fontanarossa","codigo":"CTA"},{"cidade":"Catarman, Filipinas, National","codigo":"CRM"},{"cidade":"Caticlan, Filipinas, Godofredo P Ramos","codigo":"MPH"},{"cidade":"Catmandu, Nepal, Tribhuvan International,","codigo":"KTM"},{"cidade":"Catumbela,\u00a0Angola, Catumbela","codigo":"CBT"},{"cidade":"Cauayan, Filipinas","codigo":"CYZ"},{"cidade":"Caye Caulker, Belize, Caye Caulker","codigo":"CUK"},{"cidade":"Caye Chapel, Belize, Caye Chapel","codigo":"CYC"},{"cidade":"Cayo Coco, Cuba, Jardines Del Rey, ","codigo":"CCC"},{"cidade":"Cayo Largo Del Sur, Cuba, Vilo Acuna","codigo":"CYO"},{"cidade":"Cebu, Filipinas, Mactan International","codigo":"CEB"},{"cidade":"Cedar Rapids, Estados Unidos da Am\u00e9rica, Eastern Iowa","codigo":"CID"},{"cidade":"Ceduna, Austr\u00e1lia, Ceduna","codigo":"CED"},{"cidade":"Celaya, M\u00e9xico, Captain Rogelio Castillo","codigo":"CYW"},{"cidade":"Cerro Sombrero, Chile, Franco Bianco","codigo":"SMB"},{"cidade":"Chabahar, Ir\u00e3, Konark","codigo":"ZBR"},{"cidade":"Chachapoyas, Peru,Chachapoyas","codigo":"CHH"},{"cidade":"Chaghcharan, Afeganist\u00e3o, Chaghcharan","codigo":"CCN"},{"cidade":"Chambery Aix les Bains, Fran\u00e7a, Chambery Aix les Bains","codigo":"CMF"},{"cidade":"Champaign\u00a0Urbana, Estados Unidos da Am\u00e9rica, University of Illinois","codigo":"CMI"},{"cidade":"Chanaral, Chile, Chanaral","codigo":"CNR"},{"cidade":"Chandigarh, \u00cdndia, Chandigarh","codigo":"IXC"},{"cidade":"Changchun, China, Longjia International","codigo":"CGQ"},{"cidade":"Changde, China, Taohuayuan","codigo":"CGD"},{"cidade":"Changsha, China, Huanghua International","codigo":"CSX"},{"cidade":"Changuinola, Panam\u00e1, Manuel Nino","codigo":"CHX"},{"cidade":"Changzhi, China, Wangcun","codigo":"CIH"},{"cidade":"Changzhou, China, Benniu","codigo":"CZX"},{"cidade":"Chania, Gr\u00e9cia, I Daskalogiannis","codigo":"CHQ"},{"cidade":"Chaoyang, China, Chaoyang Airport","codigo":"CHG"},{"cidade":"Charleston, Estados Unidos da Am\u00e9rica, Charleston AFB","codigo":"CHS"},{"cidade":"Charleston, Estados Unidos da Am\u00e9rica, Yeager","codigo":"CRW"},{"cidade":"Charleville, Austr\u00e1lia","codigo":"CTL"},{"cidade":"Charlotte, Estados Unidos da Am\u00e9rica, Charlotte, Douglas","codigo":"CLT"},{"cidade":"Charlottesville, Estados Unidos da Am\u00e9rica, Albemarle","codigo":"CHO"},{"cidade":"Charlottetown, Canad\u00e1, Charlottetown","codigo":"YYG"},{"cidade":"Charlottetown, Canad\u00e1, Charlottetown, Labrador","codigo":"YHG"},{"cidade":"Chateauroux, Fran\u00e7a, Deols","codigo":"CHR"},{"cidade":"Chattanooga, Estados Unidos da Am\u00e9rica, Metropolitan Airport","codigo":"CHA"},{"cidade":"Cheboksary, R\u00fassia, Cheboksary","codigo":"CSY"},{"cidade":"Cheliabinsk, R\u00fassia, Balandino","codigo":"CEK"},{"cidade":"Chengde, China, Puning","codigo":"CDE"},{"cidade":"Chengdu, China","codigo":"CTU"},{"cidade":"Chennai, \u00cdndia, Chennai International","codigo":"MAA"},{"cidade":"Cheongju, Cor\u00e9ia do Sul, Cheongju International","codigo":"CJJ"},{"cidade":"Cherbourg, Fran\u00e7a, Maupertus","codigo":"CER"},{"cidade":"Cherepovets, R\u00fassia, Cherepovts","codigo":"CEE"},{"cidade":"Chernivtsi, Ucr\u00e2nia, Chernivtsi International","codigo":"CWC"},{"cidade":"Chersky, R\u00fassia, Chersky","codigo":"CYX"},{"cidade":"Chesterfield, Canad\u00e1, Chesterfield Inlet","codigo":"YCS"},{"cidade":"Chester, Reino Unido, Harwarden","codigo":"CEG"},{"cidade":"Chetumal, M\u00e9xico, Chetumal International","codigo":"CTM"},{"cidade":"Chevery, Canad\u00e1, Chevery","codigo":"YHR"},{"cidade":"Cheyenne, Estados Unidos da Am\u00e9rica, Cheyenne Regional","codigo":"CYS"},{"cidade":"Chiang Mai, Tail\u00e2ndia, Chiang Mai","codigo":"CNX"},{"cidade":"Chiang Rai, Tail\u00e2ndia, Mae Fah Luang","codigo":"CEI"},{"cidade":"Chibougamau, Canad\u00e1, Chapais","codigo":"YMT"},{"cidade":"Chicago, Estados Unidos da Am\u00e9rica, Midway","codigo":"MDW"},{"cidade":"Chicago, Estados Unidos da Am\u00e9rica, OHare","codigo":"ORD"},{"cidade":"Chicago, Estados Unidos da Am\u00e9rica , Todos Aeroportos","codigo":"CHI"},{"cidade":"Chiclayo, Peru, J A Quinones Gonzales","codigo":"CIX"},{"cidade":"Chifeng, China, Yulong","codigo":"CIF"},{"cidade":"Chihuahua, M\u00e9xico, Roberto Fierro Villalobos","codigo":"CUU"},{"cidade":"Chile Chico, Chile, Chile Chico","codigo":"CCH"},{"cidade":"Chill\u00e1n, Chile, Gen. Bernardo Ohiggins","codigo":"YAI"},{"cidade":"Chimoio, Mo\u00e7ambique, Chimoio","codigo":"VPY"},{"cidade":"Chimore, Bol\u00edvia, Chimore","codigo":"CCA"},{"cidade":"Chinchilla, Austr\u00e1lia","codigo":"CCL"},{"cidade":"Chios, Gr\u00e9cia, Omiros","codigo":"JKH"},{"cidade":"Chisasibi, Canad\u00e1, Chisasibi","codigo":"YKU"},{"cidade":"Chisinau, Mold\u00e1via, Chisinau International","codigo":"KIV"},{"cidade":"Chitral, Paquist\u00e3o, Chitral","codigo":"CJL"},{"cidade":"Chitre, Panam\u00e1, Alonso Valderrama","codigo":"CTD"},{"cidade":"Chittagong, Bangladesh, Shah Amanat","codigo":"CGP"},{"cidade":"Chizhou, China, Jiuhuashan","codigo":"JUH"},{"cidade":"Chlef, Arg\u00e9lia","codigo":"CFK"},{"cidade":"Choibalsan, Mong\u00f3lia, Choibalsan","codigo":"COQ"},{"cidade":"Chokurdakh, R\u00fassia, Chokurdakh","codigo":"CKH"},{"cidade":"Chongqing, China","codigo":"CKG"},{"cidade":"Chu Lai, Vietn\u00e3, International","codigo":"VCL"},{"cidade":"Chumphon, Tail\u00e2ndia, Chumphon","codigo":"CJM"},{"cidade":"Churchill, Canad\u00e1","codigo":"YYQ"},{"cidade":"Churchill Falls, Canad\u00e1, Churchill Falls","codigo":"ZUM"},{"cidade":"Cidade do Cabo, \u00c1frica do Sul, Cape Town International","codigo":"CPT"},{"cidade":"Cidade do M\u00e9xico, M\u00e9xico, Benito Ju\u00e1rez International","codigo":"MEX"},{"cidade":"Cienfuegos, Cuba, Jaime Gonzalez","codigo":"CFG"},{"cidade":"Cilacap, Indon\u00e9sia, Tunggul Wulung","codigo":"CXP"},{"cidade":"Ciudad Bolivar, Venezuela, Tomas de Heres","codigo":"CBL"},{"cidade":"Ciudad del Carmen, M\u00e9xico, Ciudad del Carmen International","codigo":"CME"},{"cidade":"Ciudad del Este, Paraguai, Guarani","codigo":"AGT"},{"cidade":"Ciudad Ju\u00e1rez, M\u00e9xico, Abraham Gonz\u00e1lez International","codigo":"CJS"},{"cidade":"Ciudad Obregon, M\u00e9xico, Ciudad Obregon International","codigo":"CEN"},{"cidade":"Ciudad Victoria, M\u00e9xico, Pedro J. M\u00e9ndez International","codigo":"CVM"},{"cidade":"Clarksburg, Estados Unidos da Am\u00e9rica, North Central West Virginia","codigo":"CKB"},{"cidade":"Clermont Ferrand, Fran\u00e7a, Auvergne","codigo":"CFE"},{"cidade":"Cleveland, Estados Unidos da Am\u00e9rica, Hopkins International","codigo":"CLE"},{"cidade":"Cloncurry, Austr\u00e1lia","codigo":"CNJ"},{"cidade":"Cluj Napoca, Rom\u00eania, Cluj Napoca","codigo":"CLJ"},{"cidade":"Clyde River, Canad\u00e1, Clyde River","codigo":"YCY"},{"cidade":"Cobar, Austr\u00e1lia","codigo":"CAZ"},{"cidade":"Cobija, Bol\u00edvia, Capit\u00e1n An\u00edbal Arab","codigo":"CIJ"},{"cidade":"Coca, Equador, Francisco de Orellana","codigo":"OCC, Equador"},{"cidade":"Cochabamba, Bol\u00edvia, Jorge Wilstermann","codigo":"CBB"},{"cidade":"Cochrane, Chile, Cochrane","codigo":"LGR"},{"cidade":"Cody, Estados Unidos da Am\u00e9rica, Yellowstone regional","codigo":"COD"},{"cidade":"Coen, Austr\u00e1lia","codigo":"CUQ"},{"cidade":"Coffs Harbour, Austr\u00e1lia, Coffs Harbour","codigo":"CFS"},{"cidade":"Coimbatore, \u00cdndia, Iternational","codigo":"CJB"},{"cidade":"Colima, M\u00e9xico, Miguel de la Madrid","codigo":"CLQ"},{"cidade":"College Station, Estados Unidos da Am\u00e9rica, Easterwood ","codigo":"CLL"},{"cidade":"Coll Island, Reino Unido, Coll Island","codigo":"CAL"},{"cidade":"Coll, Reino Unido","codigo":"COL"},{"cidade":"Colmar, Fran\u00e7a, Houssen","codigo":"CMR"},{"cidade":"Colombo, Sri Lanka,Bandaranaike","codigo":"CMB"},{"cidade":"Colonia\u00a0, Alemanha, Cologne Bonn","codigo":"CGN"},{"cidade":"Colon, Panam\u00e1, Enrique Adolfo Jimenez","codigo":"ONX"},{"cidade":"Colonsay, Reino Unido, Colonsay","codigo":"CSA"},{"cidade":"Colorado Springs, Estados Unidos da Am\u00e9rica, Colorado Springs","codigo":"COS"},{"cidade":"Columbia, Estados Unidos da Am\u00e9rica, Columbia","codigo":"COU"},{"cidade":"Col\u00fambia, Estados Unidos da Am\u00e9rica, Col\u00fambia","codigo":"CAE"},{"cidade":"Columbus, Estados Unidos da Am\u00e9rica, Columbus","codigo":"CSG"},{"cidade":"Columbus, Estados Unidos da Am\u00e9rica, Golden Triangle","codigo":"GTR"},{"cidade":"Columbus, Estados Unidos da Am\u00e9rica, John Glenn International","codigo":"CMH"},{"cidade":"Comiso, It\u00e1lia, Vicenzo Maglioco","codigo":"CIY"},{"cidade":"Comodoro Rivadavia, Argentina, General E Mosconi","codigo":"CRD"},{"cidade":"Comox, Canad\u00e1, Comox","codigo":"YQQ"},{"cidade":"Conacri, Guin\u00e9, International","codigo":"CKY"},{"cidade":"Concepcion, Chile, Carriel Sur","codigo":"CCP"},{"cidade":"Con Dao Island, Vietn\u00e3, Co Ong","codigo":"VCS"},{"cidade":"Confins, Brasil, Tancredo Neves","codigo":"CNF"},{"cidade":"Constanta, Rom\u00eania, Mihail Kogalniceanu","codigo":"CND"},{"cidade":"Constantine, Arg\u00e9lia, Mohamed Boudiaf","codigo":"CZL"},{"cidade":"Contadora, Panam\u00e1, Contadora Island","codigo":"OTD"},{"cidade":"Coober Pedy, Austr\u00e1lia, Coober Pedy","codigo":"CPD"},{"cidade":"Cooktown, Austr\u00e1lia, Cooktown","codigo":"CTN"},{"cidade":"Cooma, Austr\u00e1lia, Snowy Mountains","codigo":"OOM"},{"cidade":"Copenhagen, Dinamarca, Kastrup","codigo":"CPH"},{"cidade":"Copiapo, Chile, Desierto de Atacama","codigo":"CPO"},{"cidade":"Corazon de Jesus, Panam\u00e1, Corazon de Jesus","codigo":"CZJ"},{"cidade":"C\u00f3rdoba, Argentina, Pajas Blancas","codigo":"COR"},{"cidade":"Cordova, Estados Unidos da Am\u00e9rica, Merle K., Mudhole","codigo":"CDV"},{"cidade":"Cork, Irlanda, Cork International","codigo":"ORK"},{"cidade":"Corozal, Belize, Corozal","codigo":"CZH"},{"cidade":"Corozal, Col\u00f4mbia, Las Brujas","codigo":"CZU"},{"cidade":"Corpus Christi, Estados Unidos da Am\u00e9rica, Corpus Christi International","codigo":"CRP"},{"cidade":"Corrientes, Argentina, Corrientes","codigo":"CNQ"},{"cidade":"Corumb\u00e1, Brasil, Corumb\u00e1","codigo":"CMG"},{"cidade":"Corunha, Espanha, A Coruna Airport","codigo":"LCG"},{"cidade":"Corvera, Espanha, Corvera International","codigo":"RMU"},{"cidade":"Corvo Island, Portugal, Corvo Island","codigo":"CVU"},{"cidade":"Cotabato, Filipinas, Awang","codigo":"CBO"},{"cidade":"Cotonou, Benin, Cadjehoun","codigo":"COO"},{"cidade":"Coventry - Baginton, Reino Unido","codigo":"CVT"},{"cidade":"Covington, Estados Unidos da Am\u00e9rica, Cincinnati, Northern Kentucky","codigo":"CVG"},{"cidade":"CoxS Bazar, Bangladesh, CoxS Bazar","codigo":"CXB"},{"cidade":"Coyhaique, Chile, Teniente Vidal","codigo":"GXQ"},{"cidade":"Cozumel, M\u00e9xico, Cozumel International","codigo":"CZM"},{"cidade":"Crac\u00f3via, Polonia, John Paul II Balice","codigo":"KRK"},{"cidade":"Craiova, Rom\u00eania, Craiova","codigo":"CRA"},{"cidade":"Cranbrook, Canad\u00e1, Canadian Rockies","codigo":"YXC"},{"cidade":"Crescent City, Estados Unidos da Am\u00e9rica, Jack McNamara Field","codigo":"CEC"},{"cidade":"Crici\u00fama, Brasil, Diomcio Freitas","codigo":"CCM"},{"cidade":"Crooked Island, Bahamas, Colonel Hill","codigo":"CRI"},{"cidade":"Crotone, It\u00e1lia, Crotone","codigo":"CRV"},{"cidade":"Cruzeiro do Sul, Brasil, Cruzeiro do Sul","codigo":"CZS"},{"cidade":"Cucuta, Col\u00f4mbia, Camilo Daza","codigo":"CUC"},{"cidade":"Cuddapah, \u00cdndia, Cuddapah","codigo":"CDP"},{"cidade":"Cuenca, Equador, Mariscal Lamar","codigo":"CUE, Equador"},{"cidade":"Cuernavaca, M\u00e9xico, Mariano Matamoros","codigo":"CVJ"},{"cidade":"Cuiab\u00e1, Brasil, Marechal Rondon","codigo":"CGB"},{"cidade":"Cuito Cuanavale,\u00a0Angola, Cuito Cuanavale","codigo":"CTI"},{"cidade":"Culiac\u00e1n, M\u00e9xico, Federal de Bachigualato","codigo":"CUL"},{"cidade":"Cumana, Venezuela, Antonio Jose de Sucre","codigo":"CUM"},{"cidade":"Cuneo, It\u00e1lia, Levaldigi","codigo":"CUF"},{"cidade":"Cunnamulla, Austr\u00e1lia","codigo":"CMA"},{"cidade":"Curitiba, Brasil, Afonso Pena","codigo":"CWB"},{"cidade":"Cusco, Peru, A Velasco Astete","codigo":"CUZ"},{"cidade":"Cuyo, Filipinas","codigo":"CYU"},{"cidade":"Cyangugu, Ruanda, Kamembe","codigo":"KME"},{"cidade":"Daegu, Cor\u00e9ia do Sul, Daegu International","codigo":"TAE"},{"cidade":"Dakar, Senegal, Blaise Diagne","codigo":"DSS"},{"cidade":"Dakhla, Marrocos, Dakhla","codigo":"VIL"},{"cidade":"Dalaman, Turquia, Dalaman","codigo":"DLM"},{"cidade":"Dalanzadgad, Mong\u00f3lia, Gurvan Saikhan","codigo":"DLZ"},{"cidade":"Da Lat, Vietn\u00e3, Lien Khuong","codigo":"DLI"},{"cidade":"Dalbandin, Paquist\u00e3o, Dalbadin","codigo":"DBA"},{"cidade":"Dalian, China, Zhoushuizi International","codigo":"DLC"},{"cidade":"Dali, China, Dali","codigo":"DLU"},{"cidade":"Dallas , Estados Unidos da Am\u00e9rica, Dallas Fort Worth International","codigo":"DFW"},{"cidade":"Dallas, Estados Unidos da Am\u00e9rica, Love Field","codigo":"DAL"},{"cidade":"Dalnegorsk, R\u00fassia, Dalnegorsk","codigo":"DHG"},{"cidade":"Dalnerechensk, R\u00fassia, Dalnerechensk","codigo":"DLR"},{"cidade":"Damasco, S\u00edria, Damascus International","codigo":"DAM"},{"cidade":"Damazin, Sud\u00e3o, Damazin","codigo":"RSS"},{"cidade":"Dammam, Ar\u00e1bia Saudita, King Fahd","codigo":"DMM"},{"cidade":"Da Nang, Vietn\u00e3, Da Nang","codigo":"DAD"},{"cidade":"Dandong, China, Langtou","codigo":"DDG"},{"cidade":"Dangriga, Belize, Dangriga","codigo":"DGA"},{"cidade":"Daocheng, China, Yading","codigo":"DCY"},{"cidade":"Daqing, China, Sartu","codigo":"DQA"},{"cidade":"Dar es Salaam, Tanz\u00e2nia, Julius Nyerere Intenational","codigo":"DAR"},{"cidade":"Darnley Island, Austr\u00e1lia","codigo":"NLF"},{"cidade":"Darwin, Austr\u00e1lia, Darwin International","codigo":"DRW"},{"cidade":"Dashoguz, Turcomenist\u00e3o, Dashoguz","codigo":"TAZ"},{"cidade":"Datong, China, Beijiazao","codigo":"DAT"},{"cidade":"Davao, Filipinas, Francisco Bangoy","codigo":"DVO"},{"cidade":"David, Panam\u00e1, Enrique Malek","codigo":"DAV"},{"cidade":"Dawadmi, Ar\u00e1bia Saudita, King Salman Abdulaziz","codigo":"DWD"},{"cidade":"Dawei, Mianmar, Dawei","codigo":"TVY"},{"cidade":"Dawson City, Canad\u00e1, Dawson City","codigo":"YDA"},{"cidade":"Dawson Creek, Canad\u00e1, Dawson Creek","codigo":"YDQ"},{"cidade":"Daytona Beach, Estados Unidos da Am\u00e9rica, Daytona Beach","codigo":"DAB"},{"cidade":"Dayton, Estados Unidos da Am\u00e9rica, James M. Cox International","codigo":"DAY"},{"cidade":"Dazhou, China, Heshi Airport","codigo":"DAX"},{"cidade":"Deadhorse, Estados Unidos da Am\u00e9rica, Deadhorse","codigo":"SCC"},{"cidade":"Deadmans Cay, Bahamas, Deadmans Cay","codigo":"LGI"},{"cidade":"Deauville, Fran\u00e7a, St. Gatien","codigo":"DOL"},{"cidade":"Debrecen, Hungria, Debrecen","codigo":"DEB"},{"cidade":"Decatur, Estados Unidos da Am\u00e9rica, Decatur Apt","codigo":"DEC"},{"cidade":"Deer Lake, Canad\u00e1, Regional","codigo":"YDF"},{"cidade":"Dehra dun, \u00cdndia, Jolly Grant Airport","codigo":"DED"},{"cidade":"Del Carmen Siargao, Filipinas, Sauak","codigo":"IAO"},{"cidade":"D\u00e9lhi, \u00cdndia, Indira Gandhi","codigo":"DEL"},{"cidade":"Delingha, China, Delingha","codigo":"HXD"},{"cidade":"Dembidollo, Eti\u00f3pia, Dembi Dolo","codigo":"DEM"},{"cidade":"Dempassar Bali, Indon\u00e9sia, Ngurah rai","codigo":"DPS"},{"cidade":"Denver, Estados Unidos da Am\u00e9rica, Denver","codigo":"DEN"},{"cidade":"Deputatsky, R\u00fassia, Deputatsky","codigo":"DPT"},{"cidade":"Dera Ghazi Khan, Paquist\u00e3o, International","codigo":"DEA"},{"cidade":"Derry, Reino Unido, Eglinton","codigo":"LDY"},{"cidade":"Des Moines, Estados Unidos da Am\u00e9rica, Des Moines","codigo":"DSM"},{"cidade":"Dessie, Eti\u00f3pia, Combolcha","codigo":"DSE"},{"cidade":"Detroit, Estados Unidos da Am\u00e9rica, Metropolitan Wayne County","codigo":"DTW"},{"cidade":"Deutsche Bahn - Ferrovias Alem\u00e3s\u00a0, Alemanha","codigo":"QYG"},{"cidade":"Devonport, Austr\u00e1lia, Devonport","codigo":"DPO"},{"cidade":"Dezful, Ir\u00e3, Dezful","codigo":"DEF"},{"cidade":"Dhaka, Bangladesh, Hazrat Shahjalal","codigo":"DAC"},{"cidade":"Dhangarhi, Nepal, Dhangarhi","codigo":"DHI"},{"cidade":"Dharamsala, \u00cdndia, Kangra","codigo":"DHM"},{"cidade":"Dibrugarh, \u00cdndia, Mohanbari","codigo":"DIB"},{"cidade":"Dien Bien Phu, Vietn\u00e3, Dien Bien Phu","codigo":"DIN"},{"cidade":"Dikson, R\u00fassia, Dikson","codigo":"DKS"},{"cidade":"Dikwella, Sri Lanka, Mawella Lagoon","codigo":"DIW"},{"cidade":"Dillingham, Estados Unidos da Am\u00e9rica, Dillingham","codigo":"DLG"},{"cidade":"Dimapur, \u00cdndia, Dimapur","codigo":"DMU"},{"cidade":"Dinard St Malo, Fran\u00e7a, Pleurtuit","codigo":"DNR"},{"cidade":"Dipolog, Filipinas, Dipolog","codigo":"DPL"},{"cidade":"Diqing Deqen, China, Shangri-La","codigo":"DIG"},{"cidade":"Dire Dawa, Eti\u00f3pia, Dire Dawa","codigo":"DIR"},{"cidade":"Diu, \u00cdndia, Diu","codigo":"DIU"},{"cidade":"Dixie, Austr\u00e1lia","codigo":"DXD"},{"cidade":"Diyarbakir, Turquia, Diyarbakir","codigo":"DIY"},{"cidade":"Djanet, Arg\u00e9lia, Tiska","codigo":"DJG"},{"cidade":"Djbouti, Djbouti, Ambouli","codigo":"JIB"},{"cidade":"Djerba, Tun\u00edsia, Zarzis","codigo":"DJE"},{"cidade":"Dnepropetrovsk, Ucr\u00e2nia, Dnipro International","codigo":"DNK"},{"cidade":"Dobo, Indon\u00e9sia","codigo":"DOB"},{"cidade":"Dodoma, Tanz\u00e2nia, Dodoma","codigo":"DOD"},{"cidade":"Doha, Qatar, Hamad International","codigo":"DOH"},{"cidade":"Dole, Fran\u00e7a, Tavaux","codigo":"DLE"},{"cidade":"Dolpa, Nepal, Dolpa","codigo":"DOP"},{"cidade":"Dominica, Dominica, Canefield","codigo":"DCF"},{"cidade":"Dominica, Dominica, Melville Hall","codigo":"DOM"},{"cidade":"Doncaster, Reino Unido, Robin Hood","codigo":"DSA"},{"cidade":"Donegal, Irlanda, Donegal","codigo":"CFN"},{"cidade":"Donetsk, Ucr\u00e2nia, Donetsk Internationak","codigo":"DOK"},{"cidade":"Dong Hoi, Vietn\u00e3, Dong Hoi","codigo":"VDH"},{"cidade":"Dongying, China, Shengli","codigo":"DOY"},{"cidade":"Dortmund\u00a0, Alemanha, Dortmund","codigo":"DTM"},{"cidade":"Dothan, Estados Unidos da Am\u00e9rica, Dothan","codigo":"DHN"},{"cidade":"Douala, Camar\u00f5es, Douala International","codigo":"DLA"},{"cidade":"Drake Bay, Costa Rica, Drake Bay","codigo":"DRK"},{"cidade":"Dresden, Alemanha, Dresden","codigo":"DRS"},{"cidade":"Drumduff, Austr\u00e1lia","codigo":"DFP"},{"cidade":"Dryden, Canad\u00e1, Regional","codigo":"YHD"},{"cidade":"Dubai, Emirados \u00c1rabes Unidos, Dubai International","codigo":"DXB"},{"cidade":"Dubbo, Austr\u00e1lia, Dubbo City Airport","codigo":"DBO"},{"cidade":"Dublin, Irlanda, Dublin International","codigo":"DUB"},{"cidade":"DuBois, Estados Unidos da Am\u00e9rica, DuBois Regional Airport","codigo":"DUJ"},{"cidade":"Dubrovnik, Cro\u00e1cia, Dubrovnik","codigo":"DBV"},{"cidade":"Dubuque, Estados Unidos da Am\u00e9rica, Dubuque","codigo":"DBQ"},{"cidade":"Duluth, Estados Unidos da Am\u00e9rica, Duluth","codigo":"DLH"},{"cidade":"Dumaguete, Filipinas, Sibulan","codigo":"DGT"},{"cidade":"Dumai, Indon\u00e9sia, Pinang Kam","codigo":"DUM"},{"cidade":"Dunbar, Austr\u00e1lia","codigo":"DNB"},{"cidade":"Dundee, Reino Unido, Dundee","codigo":"DND"},{"cidade":"Dundo,\u00a0Angola, Dundo","codigo":"DUE"},{"cidade":"Dunhuang, China, Dunhuang","codigo":"DNH"},{"cidade":"Duqm, Om\u00e3, Duqm International","codigo":"DQM"},{"cidade":"Durango, Estados Unidos da Am\u00e9rica, La Plata-Durango","codigo":"DRO"},{"cidade":"Durango, M\u00e9xico, Guadalupe Victoria International","codigo":"DGO"},{"cidade":"Durban, \u00c1frica do Sul, King Shaka International","codigo":"DUR"},{"cidade":"Durgapur, \u00cdndia, Kazi Nazrul Islam","codigo":"RDP"},{"cidade":"Durham, Reino Unido, Tees Valley","codigo":"MME"},{"cidade":"Dushanbe, Tajiquist\u00e3o, International","codigo":"DYU"},{"cidade":"Dusseldorf, Alemanha, Dusseldorf","codigo":"DUS"},{"cidade":"Eagle, Estados Unidos da Am\u00e9rica, Eagle","codigo":"EGE"},{"cidade":"East London, \u00c1frica do Sul, East London","codigo":"ELS"},{"cidade":"Eau Claire, Estados Unidos da Am\u00e9rica, Chippewa Valley Regional","codigo":"EAU"},{"cidade":"Ecaterimburgo, R\u00fassia, Yekateringurb Koltsovo","codigo":"SVX"},{"cidade":"Eday, Reino Unido, Eday","codigo":"EOI"},{"cidade":"Edimburgo, Reino Unido, Edinburgh Airport","codigo":"EDI"},{"cidade":"Edmonton, Canad\u00e1, Edmonton","codigo":"YEG"},{"cidade":"Edmonton, Canad\u00e1 , Todos aeroportos","codigo":"YEA"},{"cidade":"Edremit, Turquia, Koca Seyit","codigo":"EDO"},{"cidade":"Egilsstadir, Isl\u00e2ndia, Egilsstadir","codigo":"EGS"},{"cidade":"Eilat, Israel, Ramon International","codigo":"ETM"},{"cidade":"Eindhoven, Holanda, Eindhoven","codigo":"EIN"},{"cidade":"Ejina Banner, China, Taolai","codigo":"EJN"},{"cidade":"Elazig, Turquia, Elazig","codigo":"EZS"},{"cidade":"El Bayadh, Arg\u00e9lia","codigo":"EBH"},{"cidade":"El Calafate, Argentina,\u00a0Coadante A. Tola","codigo":"FTE"},{"cidade":"Eldoret, Qu\u00eania, International","codigo":"EDL"},{"cidade":"El Fasher, Sud\u00e3o, El Fasher","codigo":"ELF"},{"cidade":"El Golea, Arg\u00e9lia, El Golea","codigo":"ELG"},{"cidade":"Elista, R\u00fassia, Elista","codigo":"ESL"},{"cidade":"Elko, Estados Unidos da Am\u00e9rica, Elko","codigo":"EKO"},{"cidade":"Elmira\u00a0Corning, Estados Unidos da Am\u00e9rica, Elmira Corning","codigo":"ELM"},{"cidade":"El Nido, Filipinas","codigo":"ENI"},{"cidade":"El Obeid, Sud\u00e3o, El Obeid","codigo":"EBD"},{"cidade":"El Oued, Arg\u00e9lia, Guemar","codigo":"ELU"},{"cidade":"El Palomar, Argentina, El Palomar","codigo":"EPA"},{"cidade":"El Paso, Estados Unidos da Am\u00e9rica, El Paso International","codigo":"ELP"},{"cidade":"El Vigia, Venezuela, Juan P. Perez Alfonso, ","codigo":"VIG"},{"cidade":"Emden, Alemanha, Emden","codigo":"EME"},{"cidade":"Emerald, Austr\u00e1lia, Emerald","codigo":"EMD"},{"cidade":"Encarnacion, Paraguai, R Amin Ayub Gonzalez","codigo":"ENO"},{"cidade":"Ende, Indon\u00e9sia","codigo":"ENE"},{"cidade":"Enfidha, Tun\u00edsia, Hammamet","codigo":"NBE"},{"cidade":"Enontekio, Finl\u00e2ndia, Enontekio","codigo":"ENF"},{"cidade":"Enshi, China, Xujiaping","codigo":"ENH"},{"cidade":"Entebbe, Uganda, Entebbe International","codigo":"EBB"},{"cidade":"Enugu, Nig\u00e9ria, Akanu Ibiam","codigo":"ENU"},{"cidade":"Epinal, Fran\u00e7a, Mirecourt","codigo":"EPL"},{"cidade":"Erbil, Iraque, Erbil International","codigo":"EBL"},{"cidade":"Erenhot, China, Saiwusu","codigo":"ERL"},{"cidade":"Erevan, Yerevan, Arm\u00eania, Zvartnots International","codigo":"EVN"},{"cidade":"Erfurt, Alemanha, Erfurt Weimar","codigo":"ERF"},{"cidade":"Erie, Estados Unidos da Am\u00e9rica, Erie International","codigo":"ERI"},{"cidade":"Errachidia, Marrocos, Moulay Ali Cherif","codigo":"ERH"},{"cidade":"Erzincan, Turquia, Erzican","codigo":"ERC"},{"cidade":"Erzurum, Turquia, Erzurum","codigo":"ERZ"},{"cidade":"Esbjerg, Dinamarca, Esbjerg.","codigo":"EBJ"},{"cidade":"Esfahan, Ir\u00e3, Shahid Bereshti","codigo":"IFN"},{"cidade":"Esmeraldas, Equador, Concha Torres","codigo":"ESM, Equador"},{"cidade":"Esperance, Austr\u00e1lia, Esperance","codigo":"EPR"},{"cidade":"Esquel, Argentina, Esquel","codigo":"EQS"},{"cidade":"Essaouira, Marrocos, Mogador","codigo":"SEU"},{"cidade":"Essen\u00a0, Alemanha","codigo":"ESS"},{"cidade":"Estocolmo, Su\u00e9cia, Arlanda","codigo":"ARN"},{"cidade":"Estocolmo, Su\u00e9cia, Bromma","codigo":"BMA"},{"cidade":"Estocolmo, Su\u00e9cia, Skavsta International","codigo":"NYO"},{"cidade":"Estocolmo, Su\u00e9cia , Todos Aeroportos","codigo":"STO"},{"cidade":"Estocolmo, Su\u00e9cia, Vasteras","codigo":"VST"},{"cidade":"Estrasburgo, Fran\u00e7a, Entzheim","codigo":"SXB"},{"cidade":"Eugene, Estados Unidos da Am\u00e9rica, Mahlon Sweet Field","codigo":"EUG"},{"cidade":"Evansville, Estados Unidos da Am\u00e9rica, Evansville","codigo":"EVV"},{"cidade":"Evensk, R\u00fassia, Severo Evensk","codigo":"SWV"},{"cidade":"Exeter, Reino Unido,Exeter","codigo":"EXT"},{"cidade":"Fagernes, Noruega, Leirin","codigo":"VDB"},{"cidade":"Fairbanks, Estados Unidos da Am\u00e9rica, Fairbanks","codigo":"FAI"},{"cidade":"Fair Isle, Reino Unido, Fair Isle","codigo":"FIE"},{"cidade":"Faisalabad, Paquist\u00e3o, International","codigo":"LYP"},{"cidade":"Faizabad, Afeganist\u00e3o","codigo":"FBD"},{"cidade":"Fak-Fak, Indon\u00e9sia","codigo":"FKQ"},{"cidade":"Farah, Afeganist\u00e3o, Farah","codigo":"FAH"},{"cidade":"Fargo, Estados Unidos da Am\u00e9rica, Hector","codigo":"FAR"},{"cidade":"Farmington, Estados Unidos da Am\u00e9rica, Four Corners Regional","codigo":"FMN"},{"cidade":"Fayetteville, Estados Unidos da Am\u00e9rica, Grannis Field","codigo":"FAY"},{"cidade":"Fayetteville, Estados Unidos da Am\u00e9rica, Northwest Arkansas","codigo":"XNA"},{"cidade":"Feita de Santanta, Brasil, Joao Durval Carneiro","codigo":"FEC"},{"cidade":"Fergana, Uzbequist\u00e3o, Fergana","codigo":"FEG"},{"cidade":"Fes, Marrocos, Saiss","codigo":"FEZ"},{"cidade":"Figari, Fran\u00e7a, Sud Corse","codigo":"FSC"},{"cidade":"Filad\u00e9lfia, Estados Unidos da Am\u00e9rica, Philadelphia International","codigo":"PHL"},{"cidade":"Fitzroy Crossing, Austr\u00e1lia","codigo":"FIZ"},{"cidade":"Flagstaff, Estados Unidos da Am\u00e9rica, Flagstaff Pulliam","codigo":"FLG"},{"cidade":"Flinders, Austr\u00e1lia","codigo":"FLS"},{"cidade":"Flin Flon, Canad\u00e1, Flin Flon","codigo":"YFO"},{"cidade":"Flint, Estados Unidos da Am\u00e9rica, Bishop","codigo":"FNT"},{"cidade":"Floren\u00e7a, It\u00e1lia, Peretola","codigo":"FLR"},{"cidade":"Florence, Estados Unidos da Am\u00e9rica, Florence","codigo":"FLO"},{"cidade":"Florencia, Col\u00f4mbia, Gustavo A. Paredes","codigo":"FLA"},{"cidade":"Flores, Guatemala, Santa Elena","codigo":"FRS"},{"cidade":"Flores Island, Portugal, Flores Island","codigo":"FLW"},{"cidade":"Florian\u00f3polis, Brasil, Hercilio Luz","codigo":"FLN"},{"cidade":"Floro, Noruega, Floro","codigo":"FRO"},{"cidade":"Foggia, It\u00e1lia, Gino Lisa","codigo":"FOG"},{"cidade":"Forde, Noruega, Bringeland","codigo":"FDE"},{"cidade":"Forli, It\u00e1lia, Luigi Ridolf","codigo":"FRL"},{"cidade":"Formosa, Argentina, Formosa","codigo":"FMA"},{"cidade":"Fort Albany, Canad\u00e1, Fort Abany","codigo":"YFA"},{"cidade":"Fortaleza, Brasil, Pinto Martins","codigo":"FOR"},{"cidade":"Fort Frances, Canad\u00e1, Municipal","codigo":"YAG"},{"cidade":"Fort Good Hope, Canad\u00e1, Fort Good Hope, ","codigo":"YGH"},{"cidade":"Fort Hope, Canad\u00e1, Fort Hope","codigo":"YFH"},{"cidade":"Fort Lauderdale, Estados Unidos da Am\u00e9rica, Fort Lauderdale","codigo":"FLL"},{"cidade":"Fort McMurray, Canad\u00e1, Fort McMurray","codigo":"YMM"},{"cidade":"Fort Myers, Estados Unidos da Am\u00e9rica, Southwest Fl\u00f3rida","codigo":"RSW"},{"cidade":"Fort Severn, Canad\u00e1, Fort Severn","codigo":"YER"},{"cidade":"Fort Simpson, Canad\u00e1, Fort Simpson","codigo":"YFS"},{"cidade":"Fort Smith, Canad\u00e1, Fort Smith","codigo":"YSM"},{"cidade":"Fort Smith, Estados Unidos da Am\u00e9rica, Fort Smith","codigo":"FSM"},{"cidade":"Fort St. John, North Peace","codigo":"YXJ"},{"cidade":"Fortuna, Costa Rica, Arenal","codigo":"FON"},{"cidade":"Fort Wayne, Estados Unidos da Am\u00e9rica, Fort Wayne","codigo":"FWA"},{"cidade":"Foshan, China, Shadi","codigo":"FUO"},{"cidade":"Foula, Reino Unido, Foula","codigo":"FOA"},{"cidade":"Foz do Igua\u00e7u, Brasil, Cataratas","codigo":"IGU"},{"cidade":"Franceville, Gab\u00e3o, Mvengue","codigo":"MVB"},{"cidade":"Francistown, Botsuana, Francistown","codigo":"FRW"},{"cidade":"Frankfurt, Alemanha, Hahn Airport","codigo":"HHN"},{"cidade":"Frankfurt\u00a0, Alemanha, Frankfurt International","codigo":"FRA"},{"cidade":"Fredericton, Canad\u00e1, Frederiction","codigo":"YFC"},{"cidade":"Freeport, Bahamas, Grand Bahama","codigo":"FPO"},{"cidade":"Freetown, Serra Leoa, Lungi Internatinal","codigo":"FNA"},{"cidade":"Fresno, Estados Unidos da Am\u00e9rica, Fresno Yosemite","codigo":"FAT"},{"cidade":"Friedrichshafen, Alemanha, Friedrichshafen","codigo":"FDH"},{"cidade":"Fuerteventura, Espanha, Fuerteventura","codigo":"FUE"},{"cidade":"Fukue, Jap\u00e3o, Goto Fukue","codigo":"FUJ"},{"cidade":"Fukuoka, Jap\u00e3o, Fukuoka","codigo":"FUK"},{"cidade":"Fukushima, Jap\u00e3o, Fukushima","codigo":"FKS"},{"cidade":"Funchal, Portugal, Madeira","codigo":"FNC"},{"cidade":"Fuyang, China, Changle International","codigo":"FUG"},{"cidade":"Fuyuan, China, Fuyuan","codigo":"FYJ"},{"cidade":"Fuyun, China, Fuyun","codigo":"FYN"},{"cidade":"Fuzhou, China, Changle International","codigo":"FOC"},{"cidade":"Gabes, Tun\u00edsia, Matmata","codigo":"GAE"},{"cidade":"Gaborone, Botsuana, Sir Seretse Khama","codigo":"GBE"},{"cidade":"Gachsaran, Ir\u00e3, Gachsaran","codigo":"GCH"},{"cidade":"Gafsa, Tun\u00edsia, Ksar","codigo":"GAF"},{"cidade":"Gainesville, Estados Unidos da Am\u00e9rica, Gainesville","codigo":"GNV"},{"cidade":"Galapagos, Equador, Seymour","codigo":"GPS, Equador"},{"cidade":"Galcaio, Som\u00e1lia, Galcaio","codigo":"GLK"},{"cidade":"Galela, Indon\u00e9sia","codigo":"GLX"},{"cidade":"Galena, Estados Unidos da Am\u00e9rica, Edward G. Pitka Sr.","codigo":"GAL"},{"cidade":"Gallivare, Su\u00e9cia, Gallivare","codigo":"GEV"},{"cidade":"Galway, Irlanda, Galway","codigo":"GWY"},{"cidade":"Gambela, Eti\u00f3pia, Gambela","codigo":"GMB"},{"cidade":"Gamboola, Austr\u00e1lia","codigo":"GBP"},{"cidade":"Gander, Canad\u00e1, Gander","codigo":"YQX"},{"cidade":"Gangtok, \u00cdndia, Pakyong Airport","codigo":"PYG"},{"cidade":"Ganja, Azerbaij\u00e3o, Ganja","codigo":"KVD"},{"cidade":"Ganzhou, China, Huangjin.","codigo":"KOW"},{"cidade":"Ganzi, China, Gesaer","codigo":"GZG"},{"cidade":"Garissa, Qu\u00eania, Garissa","codigo":"GAS"},{"cidade":"Garoe, Som\u00e1lia, Garoe","codigo":"GGR"},{"cidade":"Garoua, Camar\u00f5es, Garoua","codigo":"GOU"},{"cidade":"Gaspe, Canad\u00e1, Michel Pouliot","codigo":"YGP"},{"cidade":"Gassim, Ar\u00e1bia Saudita, Gassim","codigo":"ELQ"},{"cidade":"Gaya, \u00cdndia, Gaya","codigo":"GAY"},{"cidade":"Gaziantep, Turquia, Oguzeli","codigo":"GZT"},{"cidade":"Gazipasa, Turquia, Gazipasa","codigo":"GZP"},{"cidade":"Gdansk, Polonia, Lech Walesa","codigo":"GDN"},{"cidade":"Gelendzhik, R\u00fassia, Gelendzhik","codigo":"GDZ"},{"cidade":"Gelephu, But\u00e3o, Gelephu","codigo":"GLU"},{"cidade":"Gemena, Rep\u00fablica Democr\u00e1tica do Congo, Gemena","codigo":"GMA"},{"cidade":"Genebra, Su\u00ed\u00e7a, Geneva International","codigo":"GVA"},{"cidade":"Geneina, Sud\u00e3o, Geneina","codigo":"EGN"},{"cidade":"General Santos Buayan, Filipinas","codigo":"GES"},{"cidade":"Genova, It\u00e1lia, Cristoforo Colombo","codigo":"GOA"},{"cidade":"George, \u00c1frica do Sul, George","codigo":"GRJ"},{"cidade":"George Town, Bahamas, Exuma International","codigo":"GGT"},{"cidade":"Georgetown, Guiana, Cheddi Jagan","codigo":"GEO"},{"cidade":"Georgetown, Guiana, Ogle","codigo":"OGL"},{"cidade":"Geraldton, Austr\u00e1lia, Geraldton","codigo":"GET"},{"cidade":"Ghardaia, Arg\u00e9lia, Noumetate","codigo":"GHA"},{"cidade":"Ghat, L\u00edbia, Ghat","codigo":"GHT"},{"cidade":"Gilgit, Paquist\u00e3o, Gilgit","codigo":"GIL"},{"cidade":"Gillam, Canad\u00e1, Gillam","codigo":"YGX"},{"cidade":"Gillette, Estados Unidos da Am\u00e9rica, Campbell County","codigo":"GCC"},{"cidade":"Girona, Espanha, Costa Brava","codigo":"GRO"},{"cidade":"Giza, Egito, Sphinx International","codigo":"SPX"},{"cidade":"Gizan, Ar\u00e1bia Saudita, gizan.","codigo":"GIZ"},{"cidade":"Gjoa Haven, Canad\u00e1, Gjoa Haven","codigo":"YHK"},{"cidade":"Gjogur, Isl\u00e2ndia, Gjogur","codigo":"GJR"},{"cidade":"Gladstone, Austr\u00e1lia, Gladstone","codigo":"GLT"},{"cidade":"Glasgow, Reino Unido, Glasgow International","codigo":"GLA"},{"cidade":"Goa, \u00cdndia, Dabolim","codigo":"GOI"},{"cidade":"Goba, Eti\u00f3pia, Robe","codigo":"GOB"},{"cidade":"Gode, Eti\u00f3pia, Gode","codigo":"GDE"},{"cidade":"Gods Lake Narrows, Canad\u00e1, Gods Lake Narrows","codigo":"YGO"},{"cidade":"Goi\u00e2nia, Brasil, Santa Genoveva","codigo":"GYN"},{"cidade":"Gold Coast, Austr\u00e1lia, Coolangatta","codigo":"OOL"},{"cidade":"Golfito, Costa Rica, Golfito","codigo":"GLF"},{"cidade":"Golmud, China, Golmud","codigo":"GOQ"},{"cidade":"Golog, China, Maqin","codigo":"GMQ"},{"cidade":"Goma, Rep\u00fablica Democr\u00e1tica do Congo, Goma","codigo":"GOM"},{"cidade":"Gombe, Nig\u00e9ria, Lawanti","codigo":"GMO"},{"cidade":"Gomel, Bielor\u00fassia, Gomel","codigo":"GME"},{"cidade":"Gondar, Eti\u00f3pia, Azezo","codigo":"GDQ"},{"cidade":"Goose Bay, Canad\u00e1, Goose Bay","codigo":"YYR"},{"cidade":"Gorakhpur, \u00cdndia, Gorakhpur","codigo":"GOP"},{"cidade":"Gorgan, Ir\u00e3, Gorgan Airport","codigo":"GBT"},{"cidade":"Gorno Altaysk, R\u00fassia, Gorno Altaysk","codigo":"RGK"},{"cidade":"Gorontalo, Indon\u00e9sia","codigo":"GTO"},{"cidade":"Gotemburgo, Su\u00e9cia, City Airport","codigo":"GSE"},{"cidade":"Gotemburgo, Su\u00e9cia, Landvetter","codigo":"GOT"},{"cidade":"Governador Valadares, Brasil, A. Machado Oliveira","codigo":"GVR"},{"cidade":"Governors Harbour, Bahamas, Governors Harbour","codigo":"GHB"},{"cidade":"Gr\u00e3 Can\u00e1ria, Espanha, Gran Canaria","codigo":"LPA"},{"cidade":"Graciosa Island, Portugal, Graciosa Island","codigo":"GRW"},{"cidade":"Grafton, Austr\u00e1lia, Clarence Valley","codigo":"GFN"},{"cidade":"Granada, Espanha, Frederico Garcia Lorca","codigo":"GRX"},{"cidade":"Granada, Granada, Maurice Bishop","codigo":"GND"},{"cidade":"Grande Prairie, Canad\u00e1,Grande Praire","codigo":"YQU"},{"cidade":"Grand Forks, Estados Unidos da Am\u00e9rica, Grand Forks","codigo":"GFK"},{"cidade":"Grand Junction, Estados Unidos da Am\u00e9rica, Grand Junction","codigo":"GJT"},{"cidade":"Grand Rapids, Estados Unidos da Am\u00e9rica, . Gerald R Ford","codigo":"GRR"},{"cidade":"Grand Santi, Guiana Francesa, Grand Santi","codigo":"GSI"},{"cidade":"Granites, Austr\u00e1lia","codigo":"GTS"},{"cidade":"Graz, \u00c1ustria, Graz Airport","codigo":"GRZ"},{"cidade":"Great Falls, Estados Unidos da Am\u00e9rica, Great Falls","codigo":"GTF"},{"cidade":"Green Bay, Estados Unidos da Am\u00e9rica, Austin Straubel International","codigo":"GRB"},{"cidade":"Greensboro, Estados Unidos da Am\u00e9rica, Piedmont Triad","codigo":"GSO"},{"cidade":"Greenville, Estados Unidos da Am\u00e9rica, Pitt-Greenville","codigo":"PGV"},{"cidade":"Greer, Estados Unidos da Am\u00e9rica, Greenville-Spartanburg","codigo":"GSP"},{"cidade":"Griffith, Austr\u00e1lia, Griffith","codigo":"GFF"},{"cidade":"Grimsey, Isl\u00e2ndia, Grimsey","codigo":"GRY"},{"cidade":"Grise Fiord, Canad\u00e1, Grise Fiord","codigo":"YGZ"},{"cidade":"Grodno, Bielor\u00fassia. Grodno","codigo":"GNA"},{"cidade":"Groningen, Holanda, Eelde","codigo":"GRQ"},{"cidade":"Groote Eylandt, Austr\u00e1lia, Groote Eylandt","codigo":"GTE"},{"cidade":"Grozny, R\u00fassia, Grozny","codigo":"GRV"},{"cidade":"Grumeti, Tanz\u00e2nia, Kirawira B","codigo":"GTZ"},{"cidade":"Guadalajara, M\u00e9xico, Miguel Hidalgo International","codigo":"GDL"},{"cidade":"Guaiaquil, Equador, Jose Joaquim de Olmedo","codigo":"GYE, Equador"},{"cidade":"Gualaco, Som\u00e1lia, Guriel","codigo":"GUO"},{"cidade":"Guam, Estados Unidos da Am\u00e9rica, Antonio B. Won Pat International","codigo":"GUM"},{"cidade":"Guanaja, Honduras, Guanaja","codigo":"GJA"},{"cidade":"Guangyuan, China, Panlong","codigo":"GYS"},{"cidade":"Guantanamo, Cuba, Guantanamo","codigo":"GAO"},{"cidade":"Guatemala City, Guatemala, La Aurora International","codigo":"GUA"},{"cidade":"Guayaramerin, Bol\u00edvia, Guayaramerin","codigo":"GYA"},{"cidade":"Guaymas, M\u00e9xico, Jose Maria Yanez International","codigo":"GYM"},{"cidade":"Guelmime, Marrocos, Guelmime","codigo":"GLN"},{"cidade":"Guernsey, Reino Unido, Guernsey","codigo":"GCI"},{"cidade":"Guerrero Negro, M\u00e9xico, Guerrero Negro","codigo":"GUB"},{"cidade":"Gueshm Island, Ir\u00e3, Dayrestan","codigo":"GSM"},{"cidade":"Guilin, China, Liangjiang International","codigo":"KWL"},{"cidade":"Guiyang, China, Longdongbao International","codigo":"KWE"},{"cidade":"Gulbarga, \u00cdndia, Kalaburgi","codigo":"GBI"},{"cidade":"Gulfport, Biloxi, Estados Unidos da Am\u00e9rica, Gulfport, Biloxi","codigo":"GPT"},{"cidade":"Gulu, Uganda, Gulu","codigo":"ULU"},{"cidade":"Gunnison, Estados Unidos da Am\u00e9rica, Gunnison-Crested Butte","codigo":"GUC"},{"cidade":"Gunsan, Cor\u00e9ia do Sul, Gunsan","codigo":"KUV"},{"cidade":"Gunungsitoli, Indon\u00e9sia","codigo":"GNS"},{"cidade":"Gurayat, Ar\u00e1bia Saudita, Gurayat","codigo":"URY"},{"cidade":"Guwahati, \u00cdndia, Gopinath Bordoloi","codigo":"GAU"},{"cidade":"Guyuan, China, Liupanshan","codigo":"GYU"},{"cidade":"Gwadar, Paquist\u00e3o, International","codigo":"GWD"},{"cidade":"Gwalior, \u00cdndia, Gwalior","codigo":"GWL"},{"cidade":"Gwangju, Cor\u00e9ia do Sul","codigo":"KWJ"},{"cidade":"Gyumri, Arm\u00eania, Shirak","codigo":"LWN"},{"cidade":"Hachijojima, Jap\u00e3o, Hachijojima","codigo":"HAC"},{"cidade":"Hagerstown, Estados Unidos da Am\u00e9rica, Hagerstown","codigo":"HGR"},{"cidade":"Hagfors, Su\u00e9cia, Hagfors","codigo":"HFS"},{"cidade":"Haifa, Israel, Haifa","codigo":"HFA"},{"cidade":"Haikou, China, Meilan International","codigo":"HAK"},{"cidade":"Hail, Ar\u00e1bia Saudita, Hail","codigo":"HAS"},{"cidade":"Hailar, China, Dongshan","codigo":"HLD"},{"cidade":"Hailey, Estados Unidos da Am\u00e9rica, Sun Valley","codigo":"SUN"},{"cidade":"Hai Phong, Vietn\u00e3, Cat Bi International","codigo":"HPH"},{"cidade":"Hakkari, Turquia, Y\u00fcksekova","codigo":"YKO"},{"cidade":"Hakodate, Jap\u00e3o, Hakodate","codigo":"HKD"},{"cidade":"Halifax, Canad\u00e1, Halifax","codigo":"YHZ"},{"cidade":"Hall Beach, Canad\u00e1, Hall Beach","codigo":"YUX"},{"cidade":"Halls Creek, Austr\u00e1lia","codigo":"HCQ"},{"cidade":"Halmstad, Su\u00e9cia, Halmstad","codigo":"HAD"},{"cidade":"Hamadan, Ir\u00e3, Hamadan","codigo":"HDM"},{"cidade":"Hamar, Noruega, Stafsberg","codigo":"HMR"},{"cidade":"Hambantota, Sri Lanka, Mattala Rajapaksa","codigo":"HRI"},{"cidade":"Hamburgo, Alemanha, Hamburg Internartional","codigo":"HAM"},{"cidade":"Hamburgo, Alemanha, Lubeck Blankensee","codigo":"LBC"},{"cidade":"Hamburgo, Alemanha, Luebeck Blankensee","codigo":"LBC"},{"cidade":"Hami, China, Hami","codigo":"HMI"},{"cidade":"Hamilton, Austr\u00e1lia, Great Barrier Reef Airport","codigo":"HTI"},{"cidade":"Hammerfest, Noruega, Hammerfest","codigo":"HFT"},{"cidade":"Hana, Estados Unidos da Am\u00e9rica, Hana","codigo":"HNM"},{"cidade":"Hancock, Estados Unidos da Am\u00e9rica, Houghton County","codigo":"CMX"},{"cidade":"Handan, China, Handan","codigo":"HDG"},{"cidade":"Hangzhou, China, Xiaoshan International","codigo":"HGH"},{"cidade":"Han\u00f3i, Vietn\u00e3, Noi Bai International","codigo":"HAN"},{"cidade":"Hanover\u00a0, Alemanha, Hannover","codigo":"HAJ"},{"cidade":"Hanzhong, China, Xiguan","codigo":"HZG"},{"cidade":"Harare, Zimb\u00e1bue, RG Mugabe International","codigo":"HRE"},{"cidade":"Harbin, China, Taiping International","codigo":"HRB"},{"cidade":"Hargeisa, Som\u00e1lia, Egal International","codigo":"HGA"},{"cidade":"Harlingen, Estados Unidos da Am\u00e9rica, Valley Intenational","codigo":"HRL"},{"cidade":"Harrisburg , Estados Unidos da Am\u00e9rica, Harrisburg International","codigo":"MDT"},{"cidade":"Harstad Narvik, Noruega, Evenes Apt","codigo":"EVE"},{"cidade":"Hassi Messaoud, Arg\u00e9lia, Oued Irara","codigo":"HME"},{"cidade":"Hassi RMel - Tilrempt, Arg\u00e9lia","codigo":"HRM"},{"cidade":"Hasvik, Noruega, Hasvik","codigo":"HAA"},{"cidade":"Hatay, Turquia, Hatay","codigo":"HTY"},{"cidade":"Hattiesburg\u00a0, \u00a0Laurel, Estados Unidos da Am\u00e9rica, Hattiesburg, Laurel","codigo":"PIB"},{"cidade":"Hatton, Sri Lanka, Castlereagh Reservoir","codigo":"NUF"},{"cidade":"Hat Yai, Tail\u00e2ndia, Hatyai","codigo":"HDY"},{"cidade":"Haugesund, Noruega, karmoy","codigo":"HAU"},{"cidade":"Havana, Cuba, Jos\u00e9 Marti","codigo":"HAV"},{"cidade":"Havre St. Pierre, Canad\u00e1, Havre St. Pierre","codigo":"YGV"},{"cidade":"Hayden, Estados Unidos da Am\u00e9rica, Yampa Valley","codigo":"HDN"},{"cidade":"Hay River, Canad\u00e1, Merlyn Carter","codigo":"YHY"},{"cidade":"Hechi, China, Jin Cheng Jiang","codigo":"HCJ"},{"cidade":"Hefei, China, Xianqiao International","codigo":"HFE"},{"cidade":"Heho, Mianmar, Heho","codigo":"HEH"},{"cidade":"Heide - B\u00fcsum Heide\u00a0, Alemanha","codigo":"HEI"},{"cidade":"Heihe, China, Heihe","codigo":"HEK"},{"cidade":"Helena, Estados Unidos da Am\u00e9rica, Helena","codigo":"HLN"},{"cidade":"Helgoland\u00a0, Alemanha","codigo":"HGL"},{"cidade":"Helsink, Finl\u00e2ndia, Vantaa","codigo":"HEL"},{"cidade":"Hemavan Tarnaby, Su\u00e9cia, Hemavan Tarnaby","codigo":"HMV"},{"cidade":"Hengyang, China, Bajialing","codigo":"HNY"},{"cidade":"Heraklion, Gr\u00e9cia, Nkos Kazantzakis","codigo":"HER"},{"cidade":"Herat, Afeganist\u00e3o, Herat","codigo":"HEA"},{"cidade":"Heringsdorf, Alemanha, Heringsdorf","codigo":"HDF"},{"cidade":"Hermosillo, M\u00e9xico, Ignacio Pesqueira Garcia","codigo":"HMO"},{"cidade":"Hervey Bay, Austr\u00e1lia, Hervey Bay","codigo":"HVB"},{"cidade":"Heviz, Hungria, Balaton","codigo":"SOB"},{"cidade":"Highbury, Austr\u00e1lia","codigo":"HIG"},{"cidade":"High Level, Canad\u00e1, High Level","codigo":"YOJ"},{"cidade":"Hilo, Estados Unidos da Am\u00e9rica, Hino","codigo":"ITO"},{"cidade":"Hilton Head Island, Estados Unidos da Am\u00e9rica, Hilton Head","codigo":"HXD"},{"cidade":"Hingurakgoda, Sri Lanka, Minneriya","codigo":"HIM"},{"cidade":"Hiroshima, Jap\u00e3o, Hiroshima Airport","codigo":"HIJ"},{"cidade":"Hobart, Austr\u00e1lia, Hobart International","codigo":"HBA"},{"cidade":"Ho Chi Minh Vity, Vietn\u00e3, Tan Son Nhat","codigo":"SGN"},{"cidade":"Hodeidah, I\u00eamen, Hodeidah International","codigo":"HOD"},{"cidade":"Hoedspruit, \u00c1frica do Sul, Hoedspruit","codigo":"HDS"},{"cidade":"Hof, Alemanha, Plauen","codigo":"HOQ"},{"cidade":"Hofuf, Ar\u00e1bia Saudita, Al Ahsa","codigo":"HOF"},{"cidade":"Hohhot, China, Baita International","codigo":"HET"},{"cidade":"Holgu\u00edn, Cuba, Frank Pais","codigo":"HOG"},{"cidade":"Homalin, Mianmar, Homalin","codigo":"HOX"},{"cidade":"Homer, Estados Unidos da Am\u00e9rica, Homer","codigo":"HOM"},{"cidade":"Hong Kong International Airport, China","codigo":"HKG"},{"cidade":"Hongyuan, China, Aba Hongyuan","codigo":"AHJ"},{"cidade":"Honningsvag, Noruega, Valan","codigo":"HVG"},{"cidade":"Honolulu, Estados Unidos da Am\u00e9rica, Hickam AFB","codigo":"HNL"},{"cidade":"Hoonah, Estados Unidos da Am\u00e9rica, Hoonah","codigo":"HNH"},{"cidade":"Hopedale, Canad\u00e1, Hopedale","codigo":"YHO"},{"cidade":"Hornafjorur, Isl\u00e2ndia, Hofn","codigo":"HFN"},{"cidade":"Horn Island, Austr\u00e1lia","codigo":"HID"},{"cidade":"Horta, Portugal, Horta","codigo":"HOR"},{"cidade":"Hotan, China, Hotan","codigo":"HTN"},{"cidade":"Houeisay, Laos, Houeisay","codigo":"HOE"},{"cidade":"Houston, Estados Unidos da Am\u00e9rica, George Bush International","codigo":"IAH"},{"cidade":"Houston, Estados Unidos da Am\u00e9rica, William P. Hobby","codigo":"HOU"},{"cidade":"Hua Hin, Tail\u00e2ndia, Hua Hin","codigo":"HHQ"},{"cidade":"Huaian, China, Lianshui","codigo":"HIA"},{"cidade":"Huambo,\u00a0Angola, Albano Machado","codigo":"NOV"},{"cidade":"Huang Ping, China, Kaili","codigo":"KJH"},{"cidade":"Huangshan, China, Tunxi International","codigo":"TXN"},{"cidade":"Huanuco, Peru, Huanuco","codigo":"HUU"},{"cidade":"Huaraz, Peru, German\u00a0Arias Graziani","codigo":"ATA"},{"cidade":"Huatugou, China, Huatugou","codigo":"HTT"},{"cidade":"Huatulco, M\u00e9xico, Bahias de Huatulco","codigo":"HUX"},{"cidade":"Hubli, \u00cdndia, Hubli","codigo":"HBX"},{"cidade":"Hue, Vietn\u00e3, Phu Bai International","codigo":"HUI"},{"cidade":"Hughenden, Austr\u00e1lia","codigo":"HGD"},{"cidade":"Huizhou, China, Huizhou","codigo":"HUZ"},{"cidade":"Humberside, Reino Unido, Humberside","codigo":"HUY"},{"cidade":"Humera, Eti\u00f3pia, Humera","codigo":"HUE"},{"cidade":"Huntington, Estados Unidos da Am\u00e9rica, Tri-State","codigo":"HTS"},{"cidade":"Huntsville, Estados Unidos da Am\u00e9rica, Carl T. Jones Field","codigo":"HSV"},{"cidade":"Huolinguole, China, Huolinhe","codigo":"HUO"},{"cidade":"Hurghada, Egito, Intenational","codigo":"HRG"},{"cidade":"Husavik, Isl\u00e2ndia, Husavik","codigo":"HZK"},{"cidade":"Hyannis, Estados Unidos da Am\u00e9rica, Barnstable","codigo":"HYA"},{"cidade":"Hyderabad, \u00cdndia, Rajiv Ganhi","codigo":"HYD"},{"cidade":"Iasi, Rom\u00eania, Iasi","codigo":"IAS"},{"cidade":"Ibadan, Nig\u00e9ria, Ibadan","codigo":"IBA"},{"cidade":"Ibague, Col\u00f4mbia, Perales","codigo":"IBE"},{"cidade":"Ibaraki, Jap\u00e3o, Ibaraki","codigo":"IBR"},{"cidade":"Ibiza, Espanha, Ibiza","codigo":"IBZ"},{"cidade":"Ic\u00e1ria, Gr\u00e9cia, Ikaria Island","codigo":"JIK"},{"cidade":"Idaho Falls, I Estados Unidos da Am\u00e9rica, \u00a0Idaho Falls","codigo":"IDA"},{"cidade":"Igarka, R\u00fassia, Igarka","codigo":"IAA"},{"cidade":"Igdir, Turquia, Igdir Airport","codigo":"IGD"},{"cidade":"Igloolik, Canad\u00e1, Igloolik","codigo":"YGT"},{"cidade":"Iguazu, Argentina, Cataratas Del Iguazu","codigo":"IGR"},{"cidade":"Iki, Jap\u00e3o, Iki","codigo":"IKI"},{"cidade":"Ilam, Ir\u00e3, Ilam","codigo":"IIL"},{"cidade":"Iles De La Madeleine, Canad\u00e1, Iles De La Madeleine","codigo":"YGR"},{"cidade":"Ilha Coconut, Austr\u00e1lia","codigo":"CNC"},{"cidade":"Ilha de Boa Vista, Cabo Verde, Rabil","codigo":"BVC"},{"cidade":"Ilha de Delma, Emirados \u00c1rabes Unidos, Delma Island","codigo":"ZDY"},{"cidade":"Ilha de Elba, It\u00e1lia, Marina de Campo","codigo":"EBA"},{"cidade":"Ilha de Elcho, Austr\u00e1lia","codigo":"ELC"},{"cidade":"Ilha de Maio, Cabo verde, Maio Island","codigo":"MMO"},{"cidade":"Ilha de Man, Reino Unido, Ronaldsway","codigo":"IOM"},{"cidade":"Ilha de Sao Nicolau, Cabo Verde, Preguica","codigo":"SNE"},{"cidade":"Ilha de Sao Vicente, Cabo Verde, San Pedro","codigo":"VXE"},{"cidade":"Ilha do Sal, Cabo Verde, Amilcar Cabral International, ","codigo":"SID"},{"cidade":"Ilh\u00e9us, Brasil, Jorge Amado","codigo":"IOS"},{"cidade":"Illizi, Arg\u00e9lia","codigo":"VVZ"},{"cidade":"Iloilo, Filipinas","codigo":"ILO"},{"cidade":"Ilo, Peru, Ilo","codigo":"ILQ"},{"cidade":"Ilorin, Nig\u00e9ria, Ilorin International","codigo":"ILR"},{"cidade":"Imperatriz, Brasil, Renato Moreira","codigo":"IMP"},{"cidade":"Imperial, Estados Unidos da Am\u00e9rica, Imperial County","codigo":"IPL"},{"cidade":"Imphal, \u00cdndia, Imphal","codigo":"IMF"},{"cidade":"Inagua, Bahamas, Matthew Town","codigo":"IGA"},{"cidade":"In Amenas, Arg\u00e9lia","codigo":"IAM"},{"cidade":"Indaselassie, Eti\u00f3pia, Shire","codigo":"SHC"},{"cidade":"Independence, Belize, Independence","codigo":"INB"},{"cidade":"Indianapolis, Estados Unidos da Am\u00e9rica, Indianapolis","codigo":"IND"},{"cidade":"Indore, \u00cdndia, Devi Ahilya Bai Holkar","codigo":"IDR"},{"cidade":"Ingolstadt Manching\u00a0, Alemanha","codigo":"IGS"},{"cidade":"In Guezzam, Arg\u00e9lia","codigo":"INF"},{"cidade":"Inhambane, Mo\u00e7ambique, Inhambane","codigo":"INH"},{"cidade":"Inkerman, Austr\u00e1lia","codigo":"IKP"},{"cidade":"Innsbruck, \u00c1ustria, Innsbruck Airport","codigo":"INN"},{"cidade":"In Salah, Arg\u00e9lia","codigo":"INZ"},{"cidade":"Inta, R\u00fassia, Inta","codigo":"INA"},{"cidade":"International Falls, Estados Unidos da Am\u00e9rica, International Falls","codigo":"INL"},{"cidade":"Inukjuak, Canad\u00e1, Inukjuak","codigo":"YPH"},{"cidade":"Inuvik, , Canad\u00e1, Mike Zubko","codigo":"YEV"},{"cidade":"Inverell, Austr\u00e1lia, Inverell","codigo":"IVR"},{"cidade":"Inyokern, Estados Unidos da Am\u00e9rica, Inyokern","codigo":"IYK"},{"cidade":"Ioannina, Gr\u00e9cia, King Pyrros","codigo":"IOA"},{"cidade":"Ipatinga, Brasil, Usiminas","codigo":"IPN"},{"cidade":"Ipoh, Mal\u00e1sia, Sultan Azlan Shah","codigo":"IPH"},{"cidade":"Iqaluit, Canad\u00e1, Iqaluit","codigo":"YFB"},{"cidade":"Iquique, Chile, Diego Aracena","codigo":"IQQ"},{"cidade":"Iquitos, Peru, F Secada Vignetta","codigo":"IQT"},{"cidade":"Iranshahr, Ir\u00e3, Iranshahr Airport","codigo":"IHR"},{"cidade":"Irarutu, Indon\u00e9sia, Babo","codigo":"BXB"},{"cidade":"Iringa, Tanz\u00e2nia, Iringa","codigo":"IRI"},{"cidade":"Irkutsk, R\u00fassia, Irkutsk","codigo":"IKT"},{"cidade":"Isafjordur, Isl\u00e2ndia, Isafjordur","codigo":"IFJ"},{"cidade":"Ishigaki, Jap\u00e3o, New Ishigaki","codigo":"ISG"},{"cidade":"Isiro, Rep\u00fablica Democr\u00e1tica do Congo, Matari","codigo":"IRP"},{"cidade":"Islamabad, Paquist\u00e3o, International","codigo":"ISB"},{"cidade":"Island Lake, Canad\u00e1, Garden Hill","codigo":"YIV"},{"cidade":"Islay, Reino Unido, Islay","codigo":"ILY"},{"cidade":"Islip, Estados Unidos da Am\u00e9rica, Long Island MacArthur","codigo":"ISP"},{"cidade":"Isparta, Turquia, Suleyman Demirel","codigo":"ISE"},{"cidade":"Istambul, Turquia, Ataturk Airport","codigo":"ISL"},{"cidade":"Istambul, Turquia, New Istanbul Airport","codigo":"IST"},{"cidade":"Istambul, Turquia, Sabiha Gokcen","codigo":"SAW"},{"cidade":"Istambul, Turquia , Todos Aeroportos","codigo":"IST"},{"cidade":"Ithaca, Estados Unidos da Am\u00e9rica, Tompkins","codigo":"ITH"},{"cidade":"Iturup Island, R\u00fassia, Iturup","codigo":"ITU"},{"cidade":"Ivalo, Finl\u00e2ndia, Ivalo","codigo":"IVL"},{"cidade":"Ivano Frankivsk, Ucr\u00e2nia, Ivano Frankivsk","codigo":"IFO"},{"cidade":"Ivanovo, R\u00fassia, Yuzhny","codigo":"IWA"},{"cidade":"Ivujivik, Canad\u00e1, Ivujivik","codigo":"YIK"},{"cidade":"Iwakuni, Jap\u00e3o, Iwakuni","codigo":"IWK"},{"cidade":"Ixtapa Zihuatanejo, M\u00e9xico, Ixtapa Zihuatanejo International","codigo":"ZIH"},{"cidade":"Izhevsk, R\u00fassia, Izhevsk","codigo":"IJK"},{"cidade":"Izmir, Turquia, Adnan Menderes","codigo":"ADB"},{"cidade":"Izumo, Jap\u00e3o, Izumo","codigo":"IZO"},{"cidade":"Jabalpur, \u00cdndia, Jabalpur","codigo":"JLR"},{"cidade":"Jacarta, Indon\u00e9sia, Halim Perdanakusama Airport","codigo":"HLP"},{"cidade":"Jacarta, Indon\u00e9sia, Soekarno Hatta International","codigo":"CGK"},{"cidade":"Jacarta, Indon\u00e9sia , Todos Aeroportos","codigo":"JKT"},{"cidade":"Jackson, Estados Unidos da Am\u00e9rica, Jackson Hole","codigo":"JAC"},{"cidade":"Jackson, Estados Unidos da Am\u00e9rica, Medgar W Everst","codigo":"JAN"},{"cidade":"Jacksonville, Estados Unidos da Am\u00e9rica, Albert J. Ellis","codigo":"OAJ"},{"cidade":"Jacksonville, Estados Unidos da Am\u00e9rica, Jacksonville","codigo":"JAX"},{"cidade":"Jaen, Peru, Aeropuerto de Shumba","codigo":"JAE"},{"cidade":"Jagdalpur, \u00cdndia, Jagdalpur","codigo":"JGB"},{"cidade":"Jahrom, Ir\u00e3, Jahrom Airport","codigo":"JAR"},{"cidade":"Jaipur, \u00cdndia, International","codigo":"JAI"},{"cidade":"Jaisalmer, \u00cdndia, Jaisalmer","codigo":"JSA"},{"cidade":"Jakar, But\u00e3o, Bathpalathang","codigo":"BUT"},{"cidade":"Jalalabad, Afeganist\u00e3o Faizabad","codigo":"JAA"},{"cidade":"Jambi, Indon\u00e9sia, Sultan Thaha","codigo":"DJB"},{"cidade":"Jamestown, Estados Unidos da Am\u00e9rica, Chautauqua County","codigo":"JHW"},{"cidade":"Jammu, \u00cdndia, Satwari","codigo":"IXJ"},{"cidade":"Jamnagar, \u00cdndia, Govardhanpur","codigo":"JGA"},{"cidade":"Janakpur, Nepal, Janakpur","codigo":"JKR"},{"cidade":"Jaque, Panam\u00e1, Jaque","codigo":"JQE"},{"cidade":"Jauja, Peru, Jauja","codigo":"JAU"},{"cidade":"Jayapura, Indon\u00e9sia, Sentani","codigo":"DJJ"},{"cidade":"Jeddah\u00a0 Ar\u00e1bia Saudita, King Abdulaziz","codigo":"JED"},{"cidade":"Jeju, Cor\u00e9ia do Sul, Jeju International","codigo":"CJU"},{"cidade":"Jember, Indon\u00e9sia, Noto Hadinegoro","codigo":"JBB"},{"cidade":"Jerez de la Frontera, Espanha, Jerez Airport","codigo":"XRY"},{"cidade":"Jericoacoara, Brasil, Jericoacoara","codigo":"JJD"},{"cidade":"Jersei, Reino Unido, Jersey","codigo":"JER"},{"cidade":"Jessore, Bangladesh, Jessore","codigo":"JSR"},{"cidade":"Jharsuguda, \u00cdndia, Veer Surendra Sai","codigo":"JRG"},{"cidade":"Jiagedaqi, China, Jiagedaqi","codigo":"JGD"},{"cidade":"Jiamusi, China, Dongjiao","codigo":"JMU"},{"cidade":"Ji An, China, Jinggangshan","codigo":"JGS"},{"cidade":"Jiansanjiang, China, Jiansanjiang","codigo":"JSJ"},{"cidade":"Jiayuguan, China, Jiayuguan","codigo":"JGN"},{"cidade":"Jijel, Arg\u00e9lia","codigo":"GJL"},{"cidade":"Jijiga, Eti\u00f3pia, Jijiga","codigo":"JIJ"},{"cidade":"Jimma, Eti\u00f3pia, Aba Segud","codigo":"JIM"},{"cidade":"Jinan, China, Yaoqiang International","codigo":"TNA"},{"cidade":"Jinchang, China, JINCHUAN","codigo":"JIC"},{"cidade":"Jingdezhen, China, Jingdezhen","codigo":"JDZ"},{"cidade":"Jinghong, China, Xishuangbanna","codigo":"JHG"},{"cidade":"Jining, China, Qufu","codigo":"JNG"},{"cidade":"Jinju, Cor\u00e9ia do Sul, Sacheon","codigo":"HIN"},{"cidade":"Jinka, Eti\u00f3pia, Bako","codigo":"BCO"},{"cidade":"Jinzhou, China, Jinzhouwan","codigo":"JNZ"},{"cidade":"Ji Paran\u00e1, Brasil, Jose Coleto","codigo":"JPR"},{"cidade":"Jiroft, Ir\u00e3, Jiroft","codigo":"JYR"},{"cidade":"Jiuzhaigou, China, Jiuzhai Huanglong","codigo":"JZH"},{"cidade":"Jixi, China, Xingkaihu","codigo":"JXA"},{"cidade":"Jo\u00e3o Pessoa, Brasil, Castro Pinto","codigo":"JPA"},{"cidade":"Jodhpur, \u00cdndia, Jodhpur","codigo":"JDH"},{"cidade":"Joensuu, Finl\u00e2ndia, Joensuu","codigo":"JOE"},{"cidade":"Johannesburgo, \u00c1frica do Sul, Oliver Tambo International","codigo":"JNB"},{"cidade":"Johnstown, Estados Unidos da Am\u00e9rica, John Murtha Cambria County","codigo":"JST"},{"cidade":"Johor Bahru, Mal\u00e1sia, Senai International","codigo":"JHB"},{"cidade":"Joinvile, Brasil, Lauro Carneiro Loyola","codigo":"JOI"},{"cidade":"Jomsom, Nepal, Jomsom","codigo":"JMO"},{"cidade":"Jonkoping, Su\u00e9cia, Jonkoping","codigo":"JKG"},{"cidade":"Joplin, Estados Unidos da Am\u00e9rica, Joplin","codigo":"JLN"},{"cidade":"Jorhat, \u00cdndia, Rowriah","codigo":"JRH"},{"cidade":"Jos, Nig\u00e9ria, Yakubu Gowon","codigo":"JOS"},{"cidade":"Jouf, Ar\u00e1bia Saudita, Jouf","codigo":"AJF"},{"cidade":"Juazeiro do Norte, Brasil, O. Bezerra de Menezes","codigo":"JDO"},{"cidade":"Juist\u00a0, Alemanha","codigo":"JUI"},{"cidade":"Juiz de Fora, Brasil, Presidente I. Franco","codigo":"IZA"},{"cidade":"Jujuy, Argentina, Gobernador A. Gusman","codigo":"JUJ"},{"cidade":"Juliaca, Peru, Inco Mnco Capac","codigo":"JUL"},{"cidade":"Julia Creek, Austr\u00e1lia","codigo":"JCK"},{"cidade":"Jumla, Nepal, Jumla","codigo":"JUM"},{"cidade":"Juneau, Estados Unidos da Am\u00e9rica, Juneau","codigo":"JNU"},{"cidade":"Jyvaskyla, Finl\u00e2ndia, Jyvaskyla","codigo":"JYV"},{"cidade":"Kabri Dar, Eti\u00f3pia, Kebri Dehar","codigo":"ABK"},{"cidade":"Kabul, Afeganist\u00e3o, International","codigo":"KBL"},{"cidade":"Kadanwari, Paquist\u00e3o, Thar","codigo":"KCF"},{"cidade":"Kaduna, Nig\u00e9ria, Kaduna","codigo":"KAD"},{"cidade":"Kagoshima, Jap\u00e3o, Kagoshima","codigo":"KOJ"},{"cidade":"Kahama, Tanz\u00e2nia, Buzwagi","codigo":"KBH"},{"cidade":"Kahramanmaras, Turquia, Kahramanmaras","codigo":"KCM"},{"cidade":"Kahului, Estados Unidos da Am\u00e9rica, Kahului ","codigo":"OGG"},{"cidade":"Kajaani, Finl\u00e2ndia, Kajaani","codigo":"KAJ"},{"cidade":"Kakamega, Qu\u00eania, Kakamega","codigo":"GGM"},{"cidade":"Kalabo, Z\u00e2mbia, Kalabo","codigo":"KLB"},{"cidade":"Kalaleh, Ir\u00e3, Kalaleh","codigo":"KLM"},{"cidade":"Kalamazoo, Estados Unidos da Am\u00e9rica, Kalamazoo, Battle Creek","codigo":"AZO"},{"cidade":"Kalbarri, Austr\u00e1lia","codigo":"KAX"},{"cidade":"Kalemie, Rep\u00fablica Democr\u00e1tica do Congo, Kalemie","codigo":"FMI"},{"cidade":"Kalemyo, Mianmar, Kalemyo","codigo":"KMV"},{"cidade":"Kalgoorlie, Austr\u00e1lia, Kalgoorlie Boulder","codigo":"KGI"},{"cidade":"Kalibo, Filipinas, Kalibo International","codigo":"KLO"},{"cidade":"Kaliningrado, R\u00fassia, Krasnoyarsk","codigo":"KGD"},{"cidade":"Kalispell, Estados Unidos da Am\u00e9rica, Glacier Park","codigo":"GPI"},{"cidade":"Kalmar, Su\u00e9cia, Kalmar","codigo":"KLR"},{"cidade":"Kaluga, R\u00fassia, Grabatsevo","codigo":"KLF"},{"cidade":"Kamishly, S\u00edria, Kamishly","codigo":"KAC"},{"cidade":"Kamloops, Canad\u00e1, Kamloops","codigo":"YKA"},{"cidade":"Kananga, Rep\u00fablica Democr\u00e1tica do Congo, Kananga","codigo":"KGA"},{"cidade":"Kandahar, Afeganist\u00e3o, International","codigo":"KDH"},{"cidade":"Kandla, \u00cdndia, Kandla","codigo":"IXY"},{"cidade":"Kandy, Sri Lanka, Polgolla Reservoir","codigo":"KDZ"},{"cidade":"Kandy - Victoria Reservoir, Sri Lanka","codigo":"KDW"},{"cidade":"Kangding, China, Kangding","codigo":"KGT"},{"cidade":"Kangiqsujuaq, Canad\u00e1, Wakeham Bay","codigo":"YWB"},{"cidade":"Kangirsuk, Canad\u00e1, Kangirsuk","codigo":"YKG"},{"cidade":"Kannur, \u00cdndia, International","codigo":"CNN"},{"cidade":"Kano, Nig\u00e9ria, Mallam Aminu Kano","codigo":"KAN"},{"cidade":"Kanpur, \u00cdndia, Kanpur","codigo":"KNU"},{"cidade":"Kansas City, Estados Unidos da Am\u00e9rica, Kansas City","codigo":"MCI"},{"cidade":"Kao, Indon\u00e9sia, Kaubang","codigo":"KAZ"},{"cidade":"Karachi, Paquist\u00e3o, Jinnah International","codigo":"KHI"},{"cidade":"Karaganda, Cazaquist\u00e3o, Sary Arka","codigo":"KGF"},{"cidade":"Karamay, China, Karamay","codigo":"KRY"},{"cidade":"Kardla, Est\u00f4nia, Kardla","codigo":"KDL"},{"cidade":"Karlovy Vary, Rep\u00fablica Tcheca, Karlovy Vary","codigo":"KLV"},{"cidade":"Karlsruhe, Alemanha, Baden Airpark","codigo":"FKB"},{"cidade":"Karlstad, Su\u00e9cia, Karlstad","codigo":"KSD"},{"cidade":"Karpathos, Gr\u00e9cia, karpathos","codigo":"AOK"},{"cidade":"Karratha, Austr\u00e1lia, Karratha","codigo":"KTA"},{"cidade":"Karshi, Uzbequist\u00e3o, Khanabad","codigo":"KSQ"},{"cidade":"Kars, Turquia, Kars","codigo":"KSY"},{"cidade":"Karumba, Austr\u00e1lia, Karumba","codigo":"KRB"},{"cidade":"Karup, Dinamarca, Karup","codigo":"KRP"},{"cidade":"Kasama, Z\u00e2mbia, Kasama","codigo":"KAA"},{"cidade":"Kasane, Botsuana, Kasane","codigo":"BBK"},{"cidade":"Kashan, Ir\u00e3, Kashan","codigo":"KKS"},{"cidade":"Kashechewan, Canad\u00e1, Kashechewan","codigo":"ZKE"},{"cidade":"Kashgar, China, Kashi","codigo":"KHG"},{"cidade":"Kasos Island, Gr\u00e9cia, Kasos Island","codigo":"KSJ"},{"cidade":"Kassala, Sud\u00e3o, Kassala","codigo":"KSL"},{"cidade":"Kassel\u00a0, Alemanha, Calden","codigo":"KSF"},{"cidade":"Kastamonu, Turquia, kastamonu","codigo":"KFS"},{"cidade":"Katherine, Austr\u00e1lia, Raaf Tindal","codigo":"KTR"},{"cidade":"Katima Mulilo, Nam\u00edbia, Mpacha","codigo":"MPA"},{"cidade":"Katowice, Polonia, Pyrzowice","codigo":"KTW"},{"cidade":"Kaunakakai, Estados Unidos da Am\u00e9rica, Molokai","codigo":"MKK"},{"cidade":"Kaunas, Litu\u00e2nia, Kaunas International","codigo":"KUN"},{"cidade":"Kavala, Gr\u00e9cia, Megas Alexandros","codigo":"KVA"},{"cidade":"Kavalerovo, R\u00fassia, Kavalerovo","codigo":"KVR"},{"cidade":"Kawthaung, Mianmar, Kawthaung","codigo":"KAW"},{"cidade":"Kayseri, Turquia, Erkilet","codigo":"ASR"},{"cidade":"Kazan, R\u00fassia, Kazan International","codigo":"KZN"},{"cidade":"Kefallinia, Gr\u00e9cia, Kefallinia","codigo":"EFL"},{"cidade":"Kegaska, Canad\u00e1,\u00a0Kegaska","codigo":"ZKG"},{"cidade":"Kelowna, Canad\u00e1, Kelowna","codigo":"YLW"},{"cidade":"Kemerovo, R\u00fassia, Kemerovo","codigo":"KEJ"},{"cidade":"Kemi Tornio, Finl\u00e2ndia, Kemi Tornio","codigo":"KEM"},{"cidade":"Kenai, Estados Unidos da Am\u00e9rica, Municipal de Kenai","codigo":"ENA"},{"cidade":"Kendari, Indon\u00e9sia","codigo":"KDI"},{"cidade":"Kengtung, Mianmar, Kengtung","codigo":"KET"},{"cidade":"Kenora, Canad\u00e1, Kenora","codigo":"YQK"},{"cidade":"Keperveyem, R\u00fassia, Keperveyem","codigo":"KPW"},{"cidade":"Kerinci, Indon\u00e9sia, Depati Parbo","codigo":"KRC"},{"cidade":"Kerkyra, Gr\u00e9cia, Ioannis Kapodistrias","codigo":"CFU"},{"cidade":"Kerman, Ir\u00e3, Kerman","codigo":"KER"},{"cidade":"Kermanshah, Ir\u00e3, Shahid Ashrafiesfahani","codigo":"KSH"},{"cidade":"Kerry County, Irlanda, Kerry County","codigo":"KIR"},{"cidade":"Kerteh, Mal\u00e1sia, kerteh","codigo":"KTE"},{"cidade":"Keshod, \u00cdndia, Keshod","codigo":"IXK"},{"cidade":"Ketapang, Indon\u00e9sia, Rahadi Osman","codigo":"KTG"},{"cidade":"Ketchikan, Estados Unidos da Am\u00e9rica, Ketchikan","codigo":"KTN"},{"cidade":"Key West, Estados Unidos da Am\u00e9rica, Key West","codigo":"EYW"},{"cidade":"Khabarovsk, R\u00fassia, Novy","codigo":"KHV"},{"cidade":"Khamti, Mianmar, Khamti","codigo":"KHM"},{"cidade":"Khandyga, R\u00fassia, Teply Klyuch","codigo":"KDY"},{"cidade":"Khanty Mansiysk, R\u00fassia, Khanty Mansiysk","codigo":"HMA"},{"cidade":"Khark Island, Ir\u00e3, Khark","codigo":"KHK"},{"cidade":"Kharkov, Ucr\u00e2nia, Kharkiv Osnova International","codigo":"HRK"},{"cidade":"Khasab, Om\u00e3, Khashab","codigo":"KHS"},{"cidade":"Khatanga, R\u00fassia, Khatanga","codigo":"HTG"},{"cidade":"Kherson, Ucr\u00e2nia, Kherson","codigo":"KHE"},{"cidade":"Khon Kaen, Tail\u00e2ndia, Khon Kaen","codigo":"KKC"},{"cidade":"Khonu, R\u00fassia, Moma","codigo":"MQJ"},{"cidade":"Khorramabad, Ir\u00e3, Khorramabad","codigo":"KHD"},{"cidade":"Khost, Afeganist\u00e3o, Chapman","codigo":"KHT"},{"cidade":"Khovd, Mong\u00f3lia, Khovd","codigo":"HVD"},{"cidade":"Khoy, Ir\u00e3, Khoy","codigo":"KHY"},{"cidade":"Kiev, Ucr\u00e2nia, Boryspil Intenational","codigo":"KBP"},{"cidade":"Kigali, Ruanda, International","codigo":"KGL"},{"cidade":"Kigoma, Tanz\u00e2nia, Kigoma","codigo":"TKQ"},{"cidade":"Kilimanjaro, Tanz\u00e2nia, Kilimanjaro International","codigo":"JRO"},{"cidade":"Killeen\u00a0Fort Hood, Estados Unidos da Am\u00e9rica, Killeen-Fort Hood\u00a0Regional","codigo":"GRK"},{"cidade":"Kilwa Masoko, Tanz\u00e2nia, Kilwa Masoko","codigo":"KIY"},{"cidade":"Kimberley, \u00c1frica do Sul, Kimberley","codigo":"KIM"},{"cidade":"Kimmirut, Canad\u00e1, Kimmirut","codigo":"YLC"},{"cidade":"Kindu, Rep\u00fablica Democr\u00e1tica do Congo, Kindu","codigo":"KND"},{"cidade":"King Island, Austr\u00e1lia","codigo":"KNS"},{"cidade":"King Salmon, Estados Unidos da Am\u00e9rica, King Salmon","codigo":"AKN"},{"cidade":"Kingscote, Austr\u00e1lia, Kingscote","codigo":"KGC"},{"cidade":"Kingston, Canad\u00e1, Norman Rogers","codigo":"YGK"},{"cidade":"Kingston, Jamaica, Norman Manley.","codigo":"KIN"},{"cidade":"Kingston, Jamaica, Tinson Pen Aerodrome","codigo":"KTP"},{"cidade":"Kinshasa, Rep\u00fablica Democr\u00e1tica do Congo, Ndjili, ","codigo":"FIH"},{"cidade":"Kirensk, R\u00fassia, Kirensk","codigo":"KCK"},{"cidade":"Kirkenes, Noruega, Hoybuktmoen","codigo":"KKN"},{"cidade":"Kirkwall, Reino Unido, Kirkwall","codigo":"KOI"},{"cidade":"Kirov, R\u00fassia, Pobedilovo","codigo":"KVX"},{"cidade":"Kirovsk Apatity, R\u00fassia, Khibiny","codigo":"KVK"},{"cidade":"Kiruna, Su\u00e9cia, Kiruna","codigo":"KRN"},{"cidade":"Kisangani, Rep\u00fablica Democr\u00e1tica do Congo, Bangoka","codigo":"FKI"},{"cidade":"Kishangarh, \u00cdndia, Ajmer","codigo":"KQH"},{"cidade":"Kish Island, Ir\u00e3, Kish","codigo":"KIH"},{"cidade":"Kismayu, Som\u00e1lia, Kismayu","codigo":"KMU"},{"cidade":"Kisumu, Qu\u00eania, Kisumo","codigo":"KIS"},{"cidade":"Kita-Daito, Jap\u00e3o, Kitadaito","codigo":"KTD"},{"cidade":"KitaKyushu, Jap\u00e3o, Kita Kyushu","codigo":"KKJ"},{"cidade":"Kitale, Qu\u00eania, Kitale","codigo":"KTL"},{"cidade":"Kittila, Finl\u00e2ndia, Kittila","codigo":"KTT"},{"cidade":"Klagenfurt, \u00c1ustria, Klagenfurt","codigo":"KLU"},{"cidade":"Klaipeda Palanga, Litu\u00e2nia,Palanga International","codigo":"PLQ"},{"cidade":"Klamath Falls, Estados Unidos da Am\u00e9rica, Klamath Falls Airport","codigo":"LMT"},{"cidade":"Knock, Irlanda, Ireland West","codigo":"NOC"},{"cidade":"Knoxville, Estados Unidos da Am\u00e9rica, McGhee Tyson","codigo":"TYS"},{"cidade":"Kocaeli, Turquia, Cengiz Topel","codigo":"KCO"},{"cidade":"Kochi, \u00cdndia, International","codigo":"COK"},{"cidade":"Kochi, Jap\u00e3o, Kochi","codigo":"KCZ"},{"cidade":"Kodiak, Estados Unidos da Am\u00e9rica, Kodiak","codigo":"ADQ"},{"cidade":"Kogalym, R\u00fassia, Kogalym","codigo":"KGP"},{"cidade":"Koggala, Sri Lanka, Koggala","codigo":"KCT"},{"cidade":"Kokkola Pietarsaa, Finl\u00e2ndia, Kruunupyy","codigo":"KOK"},{"cidade":"Kokshetau, Cazaquist\u00e3o, Kokshetau","codigo":"KOV"},{"cidade":"Kolaka, Indon\u00e9sia, Pomala","codigo":"PUM"},{"cidade":"Kolda, Seneguel, Kolda","codigo":"KDA"},{"cidade":"Kolhapur, \u00cdndia, Kolhapur","codigo":"KLH"},{"cidade":"Kolkata, \u00cdndia, Subhas Chandra Bose","codigo":"CCU"},{"cidade":"Kolwezi, Rep\u00fablica Democr\u00e1tica do Congo, Kolwezi","codigo":"KWZ"},{"cidade":"Komatsu, Jap\u00e3o, Komatsu","codigo":"KMQ"},{"cidade":"Komsomolsk Na Amure, R\u00fassia","codigo":"KXK"},{"cidade":"Kona, Estados Unidos da Am\u00e9rica, Keahole","codigo":"KOA"},{"cidade":"Konya, Turquia, Konya","codigo":"KYA"},{"cidade":"Korhogo, Costa do Marfim, korhogo","codigo":"HGO"},{"cidade":"Korla, China, Korla","codigo":"KRL"},{"cidade":"Ko Samui, Tail\u00e2ndia, Ko Samui","codigo":"USM"},{"cidade":"kos, Gr\u00e9cia, Ippokratis","codigo":"KGS"},{"cidade":"Kosice, Eslov\u00e1quia, Kosice","codigo":"KSC"},{"cidade":"Kostanay, Cazaquist\u00e3o, Kostanay","codigo":"KSN"},{"cidade":"Kotabaru, Indon\u00e9sia","codigo":"KBU"},{"cidade":"Kota Bharu, Mal\u00e1sia, Sultan Ismail Petra","codigo":"KBR"},{"cidade":"Kota Kinabalu, Mal\u00e1sia Redang","codigo":"BKI"},{"cidade":"Kotlas, R\u00fassia, Kotlas","codigo":"KSZ"},{"cidade":"Kotte, Sri Lanka, Diyawanna Oya SPB","codigo":"DWO"},{"cidade":"Kotzebue, Estados Unidos da Am\u00e9rica, Memorial Ralph Wien","codigo":"OTZ"},{"cidade":"Kowanyama, Austr\u00e1lia, Kowanyama","codigo":"KWM"},{"cidade":"Kozani, Gr\u00e9cia, Filippos","codigo":"KZI"},{"cidade":"Kozhikode, \u00cdndia, International","codigo":"CCJ"},{"cidade":"Krabi, Tail\u00e2ndia, Krabi","codigo":"KBV"},{"cidade":"Kraljevo, S\u00e9rvia, Morava","codigo":"KVO"},{"cidade":"Kramfors Solleftea, Su\u00e9cia, Kramfors","codigo":"KRF"},{"cidade":"Krasnodar, R\u00fassia, Pashkovsky","codigo":"KRR"},{"cidade":"Krasnoyarsk Yemelyanovo, R\u00fassia","codigo":"KJA"},{"cidade":"Kristiansand, Noruega, Kjevik","codigo":"KRS"},{"cidade":"Kristianstad, Su\u00e9cia, Kristianstad","codigo":"KID"},{"cidade":"Kristiansund, Noruega, Kvenberget","codigo":"KSU"},{"cidade":"Krui, Indon\u00e9sia","codigo":"TFY"},{"cidade":"Kuala Lumpur, Mal\u00e1sia, Kuala Lumpur International","codigo":"KUL"},{"cidade":"Kuala Lumpur, Mal\u00e1sia, Sultan Abdul Aziz Shah Airport","codigo":"SZB"},{"cidade":"Kuala Terengganu, Mal\u00e1sia, Sultan Mahmud","codigo":"TGG"},{"cidade":"Kuantan, Mal\u00e1sia, Sultan Haji Ahmad Shah","codigo":"KUA"},{"cidade":"Kubin, Austr\u00e1lia","codigo":"KUG"},{"cidade":"Kuching, Mal\u00e1sia, Kuching International","codigo":"KCH"},{"cidade":"Kudat, Mal\u00e1sia, Kudat","codigo":"KUD"},{"cidade":"Kufra, L\u00edbia, Kufra","codigo":"AKF"},{"cidade":"Kuito,\u00a0Angola, Kuito","codigo":"SVP"},{"cidade":"Kullu, \u00cdndia, Bhuntar","codigo":"KUU"},{"cidade":"Kulob, Tajiquist\u00e3o, Kulob","codigo":"TJU"},{"cidade":"Kumamoto, Jap\u00e3o, Kumamoto","codigo":"KMJ"},{"cidade":"Kumasi, Gana, Kumasi","codigo":"KMS"},{"cidade":"Kumejima, Jap\u00e3o, Kumejima","codigo":"UEO"},{"cidade":"Kunduz, Afeganist\u00e3o, Kunduz","codigo":"UND"},{"cidade":"Kunming Wujiaba, China, Kunming Wujiaba International","codigo":"KMG"},{"cidade":"Kununurra, Austr\u00e1lia, Kununurra","codigo":"KNX"},{"cidade":"Kuopio, Finl\u00e2ndia, Kuopio","codigo":"KUO"},{"cidade":"Kupang, Indon\u00e9sia, Eltari","codigo":"KOE"},{"cidade":"Kuqa, China, Qiuci","codigo":"KCA"},{"cidade":"Kuressaare, Est\u00f4nia, Kuressaare","codigo":"URE"},{"cidade":"Kurgan, R\u00fassia, Kurgan","codigo":"KRO"},{"cidade":"Kursk, R\u00fassia, Vostochny","codigo":"URS"},{"cidade":"Kushiro, Jap\u00e3o, Kushiro","codigo":"KUH"},{"cidade":"Kutahya, Turquia, Zafer Airport","codigo":"KZR"},{"cidade":"Kutaisi, Ge\u00f3rgia, Kutaisi International","codigo":"KUT"},{"cidade":"Kuujjuaq, Canad\u00e1, Kuujjuaq","codigo":"YVP"},{"cidade":"Kuujjuarapik, Canad\u00e1, Kuujjuarapik","codigo":"YGW"},{"cidade":"Kuusamo, Finl\u00e2ndia, Kuusamo","codigo":"KAO"},{"cidade":"Kuwait, Kuwait International","codigo":"KWI"},{"cidade":"Kyaukpyu, Mianmar, Kyaukpyu","codigo":"KYP"},{"cidade":"Kythira, Gr\u00e9cia, Alexandro A. Onassis","codigo":"KIT"},{"cidade":"Kyzylorda, Cazaquist\u00e3o, Kyzylorda","codigo":"KZO"},{"cidade":"Kyzyl, R\u00fassia, Kyzyl","codigo":"KYZ"},{"cidade":"Laayoune, Marrocos, Hassan I","codigo":"EUN"},{"cidade":"Labuan Bajo, Indon\u00e9sia, Komodo","codigo":"LBJ"},{"cidade":"Labuan, Mal\u00e1sia, Labuan","codigo":"LBU"},{"cidade":"Labuha, Indon\u00e9sia, Oesman Sadik","codigo":"LAH"},{"cidade":"Lac Brochet, Canad\u00e1, Lac Brochet","codigo":"XLB"},{"cidade":"La Ceiba, Honduras, Goloson International","codigo":"LCE"},{"cidade":"La Crosse, Estados Unidos da Am\u00e9rica, La Crosse Regional","codigo":"LSE"},{"cidade":"Lafayette, Estados Unidos da Am\u00e9rica, Lafayette","codigo":"LFT"},{"cidade":"Lafayette, Estados Unidos da Am\u00e9rica, Purdue University","codigo":"LAF"},{"cidade":"La Fria, Venezuela, La fria","codigo":"LFR"},{"cidade":"Laghouat LMekrareg, Arg\u00e9lia","codigo":"LOO"},{"cidade":"Lago Agrio, Equador, Lago Agrio","codigo":"LGQ, Equador"},{"cidade":"Lagos, Nig\u00e9ria, Murtala Muhamme","codigo":"LOS"},{"cidade":"La Grande Riviere, Canad\u00e1, La Grande Riviere","codigo":"YGL"},{"cidade":"Lahad Datu, Mal\u00e1sia, Lahad Datu","codigo":"LDU"},{"cidade":"Lahore, Paquist\u00e3o, Allama Iqbal International","codigo":"LHE"},{"cidade":"Lake Charles, Estados Unidos da Am\u00e9rica, Lake Charles","codigo":"LCH"},{"cidade":"Lakefield, Austr\u00e1lia","codigo":"LFP"},{"cidade":"Lake Manyara, Tanz\u00e2nia, Lake Manyara","codigo":"LKY"},{"cidade":"Lakselv, Noruega, Banak","codigo":"LKL"},{"cidade":"Lalibela, Eti\u00f3pia, Lalibela","codigo":"LLI"},{"cidade":"Lamerd, Ir\u00e3, Lamerd Airport","codigo":"LFM"},{"cidade":"Lamezia Terme, It\u00e1lia, Lamezia Terme","codigo":"SUF"},{"cidade":"Lampang, Tail\u00e2ndia, Lampang","codigo":"LPT"},{"cidade":"Lampedusa, It\u00e1lia, Lampedusa","codigo":"LMP"},{"cidade":"Lamu, Qu\u00eania, Manda","codigo":"LAU"},{"cidade":"Lanai City, Estados Unidos da Am\u00e9rica, Lanai","codigo":"LNY"},{"cidade":"Lancang, China, Jingmai","codigo":"JMJ"},{"cidade":"Lancaster, Estados Unidos da Am\u00e9rica, Lancaster","codigo":"LNS"},{"cidade":"Langgur, Indon\u00e9sia, Dumatubun","codigo":"LUV"},{"cidade":"Langkawi, Mal\u00e1sia, Langkawi International","codigo":"LGK"},{"cidade":"Lankaran, Azerbaij\u00e3o, Lankaran","codigo":"LLK"},{"cidade":"Lansdowne House, Canad\u00e1,\u00a0Lansdowne House","codigo":"YLH"},{"cidade":"Lanseria, \u00c1frica do Sul, International","codigo":"HLA"},{"cidade":"Lansing, Estados Unidos da Am\u00e9rica, Capital Region","codigo":"LAN"},{"cidade":"Lanzarote, Espanha, Lanzarote","codigo":"ACE"},{"cidade":"Lanzhou, China, Zhongchuan","codigo":"LHW"},{"cidade":"La Paz, Bol\u00edvia, El Alto","codigo":"LPB"},{"cidade":"La Paz, M\u00e9xico, Manuel M\u00e1rquez de Leon","codigo":"LAP"},{"cidade":"Lappeenranta, Finl\u00e2ndia, Lappeenranta","codigo":"LPP"},{"cidade":"Larantuka, Indon\u00e9sia, Gewayantana","codigo":"LKA"},{"cidade":"Laredo, Estados Unidos da Am\u00e9rica, Laredo International","codigo":"LRD"},{"cidade":"La Rioja, Argentina, Capitan V.A Almonacid","codigo":"IRJ"},{"cidade":"Lar, Ir\u00e3, Lar","codigo":"LRR"},{"cidade":"La Rochelle, Fran\u00e7a, Ile de Re","codigo":"LRH"},{"cidade":"La Romaine, Canad\u00e1, La Romaine","codigo":"ZGS"},{"cidade":"La Romana, Rep\u00fablica Dominicana, Casa de Campo","codigo":"LRM"},{"cidade":"La Ronge, Canad\u00e1, Barber Field","codigo":"YVC"},{"cidade":"La Serena, Chile, La Florida","codigo":"LSC"},{"cidade":"Lashio, Mianmar, Lashio","codigo":"LSH"},{"cidade":"Laskhar Gah, Afeganist\u00e3o, Bost","codigo":"BST"},{"cidade":"Las Piedras, Venezuela, Josefa Camejo","codigo":"LSP"},{"cidade":"Las Vegas, Estados Unidos da Am\u00e9rica, McCarran","codigo":"LAS"},{"cidade":"Las Vegas, Estados Unidos da Am\u00e9rica, North Las Vegas","codigo":"VGT"},{"cidade":"La Tabatiere, Canad\u00e1, La Tabatiere","codigo":"ZLT"},{"cidade":"Latrobe, Estados Unidos da Am\u00e9rica, Arnold Palmer Regional","codigo":"LBE"},{"cidade":"Launceston, Austr\u00e1lia, Launceston","codigo":"LST"},{"cidade":"Laura, Austr\u00e1lia","codigo":"LUU"},{"cidade":"Lavan Island, Ir\u00e3, Lavan","codigo":"LVP"},{"cidade":"Laverton, Austr\u00e1lia, Laverton","codigo":"LVO"},{"cidade":"Lawas, Mal\u00e1sia, Lawas","codigo":"LWY"},{"cidade":"Lawton, Estados Unidos da Am\u00e9rica, Lawton-Fort Sill Regional","codigo":"LAW"},{"cidade":"L\u00e1zaro C\u00e1rdenas, M\u00e9xico, L\u00e1zaro C\u00e1rdenas","codigo":"LZC"},{"cidade":"Learmonth, Austr\u00e1lia, Learmonth","codigo":"LEA"},{"cidade":"Leeds Bradford, Reino Unido, Leeds Bradford","codigo":"LBA"},{"cidade":"Legazpi, Filipinas, Legazpi","codigo":"LGP"},{"cidade":"Leh, \u00cdndia, Kushok Bakula Rimpoche","codigo":"IXL"},{"cidade":"Leinster, Austr\u00e1lia, Leinster","codigo":"LER"},{"cidade":"Leipzig, Halle, Alemanha, Leipzig, Halle","codigo":"LEJ"},{"cidade":"Leknes, Noruega, leknes","codigo":"LKN"},{"cidade":"Lemnos, Gr\u00e9cia, Limnos","codigo":"LXS"},{"cidade":"Len\u00e7\u00f3is, Brasil, Horacio de Matos","codigo":"LEC"},{"cidade":"Lensk, R\u00fassia, Lensk","codigo":"ULK"},{"cidade":"Leon, Espanha, Leon","codigo":"LEN"},{"cidade":"Leon Guanajuato, M\u00e9xico, Del Bajio International","codigo":"BJX"},{"cidade":"Leonora, Austr\u00e1lia, Leonora","codigo":"LNO"},{"cidade":"Le Puy, \u00a0Fran\u00e7a, Loudes","codigo":"LPY"},{"cidade":"Leros, Gr\u00e9cia, leros","codigo":"LRS"},{"cidade":"Lethbridge, Canad\u00e1,Lethbridge County","codigo":"YQL"},{"cidade":"Leticia, Col\u00f4mbia, Alfredo Vasquez Cobo","codigo":"LET"},{"cidade":"Le Touquet\u00a0 Paris Plage, Fran\u00e7a","codigo":"LTQ"},{"cidade":"Lewiston, Estados Unidos da Am\u00e9rica, Nez Perce County","codigo":"LWS"},{"cidade":"Lewoleba, Indon\u00e9sia, Wunopito","codigo":"LWE"},{"cidade":"Lexington, Estados Unidos da Am\u00e9rica, Blue Grass","codigo":"LEX"},{"cidade":"Lhasa, China, Gonggar","codigo":"LXA"},{"cidade":"Lhok seumawe, Indon\u00e9sia, Malikussaleh","codigo":"LSW"},{"cidade":"Liangping, China, Liangping","codigo":"LIA"},{"cidade":"Lianyungang, China, Baitabu","codigo":"LYG"},{"cidade":"Liberia, Costa Rica, Daniel Oduber Quiros","codigo":"LIR"},{"cidade":"Libo, China, Libo","codigo":"LLB"},{"cidade":"Libreville, Gab\u00e3o, Leon M Ba","codigo":"LBV"},{"cidade":"Lichinga, Mo\u00e7ambique, Lichinga","codigo":"VXC"},{"cidade":"Liege, B\u00e9lgica, Liege","codigo":"LGG"},{"cidade":"Liepaja, Let\u00f4nia, Liepaja International","codigo":"LPX"},{"cidade":"Lihue, Estados Unidos da Am\u00e9rica, Lihue","codigo":"LIH"},{"cidade":"Lijiang, China, Sanyi","codigo":"LJG"},{"cidade":"Likoma Island, Mal\u00e1ui, Likoma Island","codigo":"LIX"},{"cidade":"Lilabari, \u00cdndia, Lilabari","codigo":"IXI"},{"cidade":"Lille, Fran\u00e7a, Lesquin","codigo":"LIL"},{"cidade":"Lilongwe, Mal\u00e1ui, Kmuzu International","codigo":"LLWi"},{"cidade":"Lima, Peru, Jorge Chavez","codigo":"LIM"},{"cidade":"Limbang, Mal\u00e1sia, Limbang","codigo":"LMN"},{"cidade":"Limoges, Fran\u00e7a, Bellegarde","codigo":"LIG"},{"cidade":"Lincang, China, Lincang Airport","codigo":"LNJ"},{"cidade":"Lincoln, Estados Unidos da Am\u00e9rica, Lincoln","codigo":"LNK"},{"cidade":"Linfen, China, Qiaoli","codigo":"LFQ"},{"cidade":"Linkoping, Su\u00e9cia, City Airport","codigo":"LPI"},{"cidade":"Linyi, China, Shubuling","codigo":"LYI"},{"cidade":"Linz, \u00c1ustria, Blue Danube","codigo":"LNZ"},{"cidade":"Lipetsk, R\u00fassia, Lipetsk","codigo":"LPK"},{"cidade":"Liping, China, Liping","codigo":"HZH"},{"cidade":"Lisala, Rep\u00fablica Democr\u00e1tica do Congo, Lisala","codigo":"LIQ"},{"cidade":"Lisboa, Portugal, Lisboa","codigo":"LIS"},{"cidade":"Lismore, Austr\u00e1lia, Lismore","codigo":"LSY"},{"cidade":"Little Rock, Estados Unidos da Am\u00e9rica, Little Rock, Adams Field","codigo":"LIT"},{"cidade":"Liupanshui, China, Yue Zhao","codigo":"LPF"},{"cidade":"Liuzhou, China, Bailian","codigo":"LZH"},{"cidade":"Liverpool, Reino Unido, John Lennon","codigo":"LPL"},{"cidade":"Livingstone, Z\u00e2mbia, Livingstone","codigo":"LVI"},{"cidade":"Lizard Island, Austr\u00e1lia","codigo":"LZR"},{"cidade":"Ljubljana, Eslov\u00eania, Joze Pucnik","codigo":"LJU"},{"cidade":"Lleida, Espanha, Alguaire","codigo":"ILD"},{"cidade":"Lloydminster, Canad\u00e1, Lloydminster","codigo":"YLL"},{"cidade":"Lockhart River, Austr\u00e1lia","codigo":"IRG"},{"cidade":"Lodja, Rep\u00fablica Democr\u00e1tica do Congo, Lodja","codigo":"LJA"},{"cidade":"Lodwar, Qu\u00eania, Lodwar","codigo":"LOK"},{"cidade":"Lodz, Polonia, Wladyslaw Reymont","codigo":"LCJ"},{"cidade":"Loei, Tail\u00e2ndia, Loei","codigo":"LOE"},{"cidade":"Logrono, Espanha, Agoncillo","codigo":"RJL"},{"cidade":"Loikaw, Mianmar, Loikaw","codigo":"LIW"},{"cidade":"Loja, Equador, Catamayo","codigo":"LOH, Equador"},{"cidade":"Lom\u00e9, Togo, G. Eyadema International","codigo":"LFW"},{"cidade":"Londolozi, \u00c1frica do Sul, Londolozi","codigo":"LDZ"},{"cidade":"London, Canad\u00e1, International","codigo":"YXU"},{"cidade":"Londres, Reino Unido, City Airport","codigo":"LCY"},{"cidade":"Londres, Reino Unido, Gatwick","codigo":"LGW"},{"cidade":"Londres, Reino Unido, Heathrow","codigo":"LHR"},{"cidade":"Londres, Reino Unido, Luton","codigo":"LTN"},{"cidade":"Londres, Reino Unido, Stansted","codigo":"STN"},{"cidade":"Londres, Reino Unido , Todos Aeroportos","codigo":"LON"},{"cidade":"Londrina, Brasil, Jose Richa","codigo":"LDB"},{"cidade":"Long Akah, Mal\u00e1sia, Long Akah","codigo":"LKH"},{"cidade":"Long Banga, Mal\u00e1sia, Long Banga","codigo":"LBP"},{"cidade":"Long Beach, Estados Unidos da Am\u00e9rica, Daugherty Field","codigo":"LGB"},{"cidade":"Long Lellang, Mal\u00e1sia, Long Lellang","codigo":"LGL"},{"cidade":"Longnan, China, Cheng Xian","codigo":"LNL"},{"cidade":"Longreach, Austr\u00e1lia","codigo":"LRE"},{"cidade":"Long Seridan, Mal\u00e1sia, Long Seridan","codigo":"ODN"},{"cidade":"Longview, Estados Unidos da Am\u00e9rica, East Texas Regional","codigo":"GGG"},{"cidade":"Longyan, China, Guanzhishan","codigo":"LCX"},{"cidade":"Longyearbyen, Noruega, Svalbard","codigo":"LYR"},{"cidade":"Lord Howe Island, Austr\u00e1lia","codigo":"LDH"},{"cidade":"Loreto, M\u00e9xico, Loreto International","codigo":"LTO"},{"cidade":"Lorient, Fran\u00e7a, Lann Bihoue","codigo":"LRT"},{"cidade":"Los Angeles, Estados Unidos da Am\u00e9rica, Los Angeles","codigo":"LAX"},{"cidade":"Los Cabos, M\u00e9xico, Los Cabos International","codigo":"SJD"},{"cidade":"Los Mochis, M\u00e9xico, Federal del Valle del Fuerte","codigo":"LMM"},{"cidade":"Los Roques, Venezuela, Los Roques","codigo":"LRV"},{"cidade":"Louisville, Estados Unidos da Am\u00e9rica, \u00a0Standiford Field","codigo":"SDF"},{"cidade":"Lourdes Tarbes, Fran\u00e7a, Pyrenees","codigo":"LDE"},{"cidade":"Lower Zambezi National Park, Z\u00e2mbia, Jeki Airport","codigo":"JEK"},{"cidade":"Lower Zambezi National Park, Z\u00e2mbia, Royal Airport","codigo":"RYL"},{"cidade":"Luanda, Angola, 4 de Fevereiro","codigo":"LAD"},{"cidade":"Luang Namtha, Laos, Luang Namtha","codigo":"LXG"},{"cidade":"Luang Prabang, Laos, Luang Prabang","codigo":"LPQ"},{"cidade":"Lubango, Angola, Mukanka","codigo":"SDD"},{"cidade":"Lubbock, Estados Unidos da Am\u00e9rica, Preston Smith International","codigo":"LBB"},{"cidade":"Lublin, Polonia, Lublin","codigo":"LUZ"},{"cidade":"Lubuk Linggau, Indon\u00e9sia, Silampari","codigo":"LLJ"},{"cidade":"Lubumbashi, Rep\u00fablica Democr\u00e1tica do Congo, Luano","codigo":"FBM"},{"cidade":"Lucca, It\u00e1lia, Tassignano","codigo":"LCV"},{"cidade":"Lucknow, \u00cdndia, Chaudhary Charan Singh","codigo":"LKO"},{"cidade":"Luderitz, Nam\u00edbia, Luderitz","codigo":"LUD"},{"cidade":"Ludhiana, \u00cdndia, Ludhiana","codigo":"LUH"},{"cidade":"Luena,\u00a0Angola, Luena","codigo":"LUO"},{"cidade":"Lugano, Su\u00ed\u00e7a, Agno","codigo":"LUG"},{"cidade":"Lukla, Nepal, Tenzing Hillary","codigo":"LUA"},{"cidade":"Lulea, Su\u00e9cia, Kallax","codigo":"LLA"},{"cidade":"L\u00fcliang, China, L\u00fcliang","codigo":"LLV"},{"cidade":"Luoyang, China, Beijiao","codigo":"LYA"},{"cidade":"Lusaka, Z\u00e2mbia, Lusaka International","codigo":"LUN"},{"cidade":"Luwuk, Indon\u00e9sia, S. Aminuddin Amir","codigo":"LUW"},{"cidade":"Luxemburgo, Luxembourg","codigo":"LUX"},{"cidade":"Luxor, Egito, International","codigo":"LXR"},{"cidade":"Luzhou, China, Yunlong","codigo":"LZO"},{"cidade":"Luzon, Angeles Mabalact, Filipinas, Clark International","codigo":"CRK"},{"cidade":"Lviv, Ucr\u00e2nia, Lviv International","codigo":"LWO"},{"cidade":"Lycksele, Su\u00e9cia, Lycksele","codigo":"LYC"},{"cidade":"Lydd, Reino Unido, London Ashford","codigo":"LYX"},{"cidade":"Lynchburg, Estados Unidos da Am\u00e9rica, Preston Glenn Field\u00a0","codigo":"LYH"},{"cidade":"Lyon, Fran\u00e7a, Saint Exupery","codigo":"LYS"},{"cidade":"Maastricht, Aachen, Holanda, Maastricht, Aachen, ","codigo":"MST"},{"cidade":"Mabuiag Island, Austr\u00e1lia","codigo":"UBB"},{"cidade":"Macap\u00e1, Brasil, Alberto Al Columbre","codigo":"MCP"},{"cidade":"Mac Arthur River Mine, Austr\u00e1lia","codigo":"MCV"},{"cidade":"Macei\u00f3, Brasil, Zumbi dos Palmares","codigo":"MCZ"},{"cidade":"Mackay, Austr\u00e1lia, Mackay","codigo":"MKY"},{"cidade":"Macon, Estados Unidos da Am\u00e9rica, Middle Georgia","codigo":"MCN"},{"cidade":"Madison, Estados Unidos da Am\u00e9rica, Dane County Regional","codigo":"MSN"},{"cidade":"Madrid, Espanha, Adolfo Suarez Barajas","codigo":"MAD"},{"cidade":"Madurai, \u00cdndia, Madurai","codigo":"IXM"},{"cidade":"Mae Hong Son, Tail\u00e2ndia","codigo":"HGN"},{"cidade":"Mae Sot, Tail\u00e2ndia, Mae Sot","codigo":"MAQ"},{"cidade":"Mafia Island, Tanz\u00e2nia, Mafia Island","codigo":"MFA"},{"cidade":"Magadan, R\u00fassia, Sokol","codigo":"GDX"},{"cidade":"Magan, R\u00fassia, Magan","codigo":"GYG"},{"cidade":"Magnitogorsk, R\u00fassia, Magnitogorsk","codigo":"MQF"},{"cidade":"Magwey, Mianmar, Magwey","codigo":"MWQ"},{"cidade":"Mahajanga, Majunga, Madag\u00e1scar, Philibert Tsiranana","codigo":"MJN"},{"cidade":"Mahe Island, Seychelles, Seychelles Internationa","codigo":"SEZ"},{"cidade":"Maiduguri, Nig\u00e9ria, Maiduguri","codigo":"MIU"},{"cidade":"Maimanah, Afeganist\u00e3o, Maimanah","codigo":"MMZ"},{"cidade":"Makale, Eti\u00f3pia, Alula Aba Nega","codigo":"MQX"},{"cidade":"Makassar, Indon\u00e9sia, Sultan Hasanuddin","codigo":"UPG"},{"cidade":"Makhachkala, R\u00fassia, Uytash","codigo":"MCX"},{"cidade":"Makkovik, Canad\u00e1, Makkovik","codigo":"YMN"},{"cidade":"Malabo, Guin\u00e9 Equatorial, International","codigo":"SSG"},{"cidade":"Malacca, Mal\u00e1sia, Malacca","codigo":"MKZ"},{"cidade":"M\u00e1laga, Espanha, Malaga Airport","codigo":"AGP"},{"cidade":"Malang, Indon\u00e9sia","codigo":"MLG"},{"cidade":"Malanje,\u00a0Angola, Malanje","codigo":"MEG"},{"cidade":"Malargue, Argentina, Comodoro D.R. Salomon","codigo":"LGS"},{"cidade":"Malatya, Turquia, Erhac","codigo":"MLX"},{"cidade":"Mali Losinj, Cro\u00e1cia, Mali Losinj","codigo":"LSZ"},{"cidade":"Malindi, Qu\u00eania, Malindi","codigo":"MYD"},{"cidade":"Malmo Sturup, Su\u00e9cia, Malmo","codigo":"MMX"},{"cidade":"Mamuju, Indon\u00e9sia, Tampa Padang","codigo":"MJU"},{"cidade":"Manado, Indon\u00e9sia, San Ratulangi","codigo":"MDC"},{"cidade":"Managua, Nicar\u00e1gua, Augusto Cesar Sandino","codigo":"MGA"},{"cidade":"Manaung, Mianmar, Manaung","codigo":"MGU"},{"cidade":"Manaus, Brasil, Eduardo Gomes","codigo":"MAO"},{"cidade":"Manchester, Estados Unidos da Am\u00e9rica, Manchester Boston","codigo":"MHT"},{"cidade":"Manchester, Reino Unido, Manchester Airport","codigo":"MAN"},{"cidade":"Man, Costa do Marfim, Man","codigo":"MJC"},{"cidade":"Mandalay, Mianmar, Mandalay International","codigo":"MDL"},{"cidade":"Mandera, Qu\u00eania, Mandera","codigo":"NDE"},{"cidade":"Mangalore, \u00cdndia, Mangalore","codigo":"IXE"},{"cidade":"Mangshi, China, Dehong Mangshi","codigo":"LUM"},{"cidade":"Manhattan, Estados Unidos da Am\u00e9rica, Manhattan","codigo":"MHK"},{"cidade":"Manila, Filipinas, Ninoy Aquino International","codigo":"MNL"},{"cidade":"Maningrida, Austr\u00e1lia, Maningrida","codigo":"MNG"},{"cidade":"Manizales, Col\u00f4mbia, La Nubia","codigo":"MZL"},{"cidade":"Mannheim, Alemanha, City Airport","codigo":"MHG"},{"cidade":"Manokwari, Indon\u00e9sia, Rendani","codigo":"MKW"},{"cidade":"Mansa, Z\u00e2mbia, Mansa","codigo":"MNS"},{"cidade":"Manta, Equador, Eloy Alfaro","codigo":"MEC, Equador"},{"cidade":"Manzanillo, Cuba, Sierra Maestra","codigo":"MZO"},{"cidade":"Manzanillo, M\u00e9xico, Playa de Oro International","codigo":"ZLO"},{"cidade":"Manzhouli China, Xijiao","codigo":"NZH"},{"cidade":"Manzini, Suazil\u00e2ndia, King Mswati III International","codigo":"SHO"},{"cidade":"Maputo, Mo\u00e7ambique, Maputo International","codigo":"MPM"},{"cidade":"Marab\u00e1, Brasil, Joao Correa da Rocha","codigo":"MAB"},{"cidade":"Maracaibo, Venezuela, La Chinita","codigo":"MAR"},{"cidade":"Maracay, Venezuela, Mariscal Sucre","codigo":"MYC"},{"cidade":"Maradi, N\u00edger, Maradi","codigo":"MFQ"},{"cidade":"Mar del Plata, Argentina, Astor Piazzola","codigo":"MDQ"},{"cidade":"Mardin, Turquia, Mardin","codigo":"MQM"},{"cidade":"Margate, \u00c1frica do Sul, Margate","codigo":"MGH"},{"cidade":"Maribor, Eslov\u00eania, Edvard Rusjan","codigo":"MBX"},{"cidade":"Mariehamn, Finl\u00e2ndia, Mariehamn","codigo":"MHQ"},{"cidade":"Marinduque Island, Filipinas","codigo":"MRQ"},{"cidade":"Marion, Estados Unidos da Am\u00e9rica, Williamson County","codigo":"MWA"},{"cidade":"Maripasoula, Guiana Francesa,Maripasoula","codigo":"MPY"},{"cidade":"Maroantsetra, Madag\u00e1scar, Maroantsetra","codigo":"WMN"},{"cidade":"Maroua, Camar\u00f5es, Salak","codigo":"MVR"},{"cidade":"Marquette, Estados Unidos da Am\u00e9rica, Sawyer","codigo":"MQT"},{"cidade":"Marraqueche, Marrocos, Menara","codigo":"RAK"},{"cidade":"Marsa Alam, Egito, International","codigo":"RMF"},{"cidade":"Marsa Matruh, Egito, Mersa Matruh","codigo":"MUH"},{"cidade":"Marseille, Fran\u00e7a, Provence","codigo":"MRS"},{"cidade":"Marsh Harbour, Bahamas, Marsh Harbour","codigo":"MHH, Bahamas"},{"cidade":"Marudi, Mal\u00e1sia, Marudi","codigo":"MUR"},{"cidade":"Marys Harbour, Canad\u00e1, Marys Harbour","codigo":"YMH"},{"cidade":"Mary, Turcomenist\u00e3o, Mary","codigo":"MYP"},{"cidade":"Masbate, Filipinas","codigo":"MBT"},{"cidade":"Maseru, Lesoto, Moshoeshoe","codigo":"MSU"},{"cidade":"Mason City, Estados Unidos da Am\u00e9rica, Mason City","codigo":"MCW"},{"cidade":"Masset, Canad\u00e1, Masset","codigo":"ZMT"},{"cidade":"Masuda, Jap\u00e3o, Iwami","codigo":"IWJ"},{"cidade":"Matak, Indon\u00e9sia, Tarempa","codigo":"MWK"},{"cidade":"Matamoros, M\u00e9xico, Servando Canales International","codigo":"MAM"},{"cidade":"Matsumoto, Jap\u00e3o, Matsumoto","codigo":"MMJ"},{"cidade":"Matsuyama, Jap\u00e3o, Matsuyama","codigo":"MYJ"},{"cidade":"Maturin, Venezuela, Jose T Monagas","codigo":"MUN"},{"cidade":"Mau\u00e9s, Brasil, Mau\u00e9s","codigo":"MBZ"},{"cidade":"Maulamyine, Mianmar, Maulamyine","codigo":"MNU"},{"cidade":"Maumere, Indon\u00e9sia, Fransiskus x Seda","codigo":"MOF"},{"cidade":"Maun, Botsuana, Maun","codigo":"MUB"},{"cidade":"Maur\u00edcio, Ilhas Maur\u00edcio, Sir. S.Ramgoolam International","codigo":"MRU"},{"cidade":"Mayaguana, Bahamas, Mayaguana","codigo":"MYG"},{"cidade":"Mayag\u00fcez, Porto Rico, Eugenio Mar\u00eda de Hostos","codigo":"MAS"},{"cidade":"Mayo, Canad\u00e1, Mayo","codigo":"YMA"},{"cidade":"Mazar-E Sharif, Afeganist\u00e3o, Mazar-E Sharif","codigo":"MZR"},{"cidade":"Mazatlan, M\u00e9xico, Rafael Buelna International","codigo":"MZT"},{"cidade":"Mbandaka, Rep\u00fablica Democr\u00e1tica do Congo, Mbandaka","codigo":"MDK"},{"cidade":"Mbeya, Tanz\u00e2nia, Mbeya","codigo":"MBI"},{"cidade":"Mbuji Mayi, Rep\u00fablica Democr\u00e1tica do Congo, Mbuji Mayi","codigo":"MJM"},{"cidade":"McAllen, Estados Unidos da Am\u00e9rica, Miller International","codigo":"MFE"},{"cidade":"Mechria, Arg\u00e9lia","codigo":"MZW"},{"cidade":"Medan, Indon\u00e9sia, Kuala Namu","codigo":"KNO"},{"cidade":"Medell\u00edn, Col\u00f4mbia,Jose Maria Cordova","codigo":"MDE"},{"cidade":"Medellin, Col\u00f4mbia,Olaya Herrera","codigo":"EOH"},{"cidade":"Medford, Estados Unidos da Am\u00e9rica, Rogue Valley International","codigo":"MFR"},{"cidade":"Medicine Hat, Canad\u00e1, Medicine Hat","codigo":"YXH"},{"cidade":"Medina, Madinah, Ar\u00e1bia Saudita, Mohammad Bin Abdulaziz","codigo":"MED"},{"cidade":"Meekatharra, Austr\u00e1lia","codigo":"MKR"},{"cidade":"Megisti, Gr\u00e9cia, Megisti","codigo":"KZS"},{"cidade":"Mehamn, Noruega, Mehamn","codigo":"MEH"},{"cidade":"Meixian, China, Meixian","codigo":"MXZ"},{"cidade":"Melanguane, Indon\u00e9sia, Melanguane","codigo":"MNA"},{"cidade":"Melbourne, Austr\u00e1lia, Avalon Airport","codigo":"AVV"},{"cidade":"Melbourne, Austr\u00e1lia, Melbourne Airport","codigo":"MEL"},{"cidade":"Melbourne Essendon, Austr\u00e1lia","codigo":"MEB"},{"cidade":"Melbourne, Estados Unidos da Am\u00e9rica, Melbourne","codigo":"MLB"},{"cidade":"Melilha, Espanha, Melilla","codigo":"MLN"},{"cidade":"Memanbetsu, Jap\u00e3o, Memanbetsu","codigo":"MMB"},{"cidade":"Memmingen, Alemanha, Allgaeu","codigo":"FMM"},{"cidade":"Memphis, Estados Unidos da Am\u00e9rica, Memphis Intenational","codigo":"MEM"},{"cidade":"Mendoza, Argentina,\u00a0El Plumerillo","codigo":"MDZ"},{"cidade":"Menongue,\u00a0Angola, Menongue","codigo":"SPP"},{"cidade":"Menorca, Espanha, Menorca","codigo":"MAH"},{"cidade":"Merauke, Indon\u00e9sia, Mopah","codigo":"MKQ"},{"cidade":"Merida, M\u00e9xico, Manuel Crescencio Rej\u00f3n","codigo":"MID"},{"cidade":"Meridian, Estados Unidos da Am\u00e9rica, Key Field","codigo":"MEI"},{"cidade":"Merimbula, Austr\u00e1lia","codigo":"MIM"},{"cidade":"Meshed, Ir\u00e3, Shahid, Hashemi Nejad","codigo":"MHD"},{"cidade":"Metz Nancy, Fran\u00e7a, Lorraine","codigo":"ETZ"},{"cidade":"Mexicali, M\u00e9xico, Rodolfo S\u00e1nchez Taboada","codigo":"MXL"},{"cidade":"Mfuwe, Z\u00e2mbia, Mfuwe","codigo":"MFU"},{"cidade":"Miami, Estados Unidos da Am\u00e9rica, Miami","codigo":"MIA"},{"cidade":"Mianyang, China, Nanjiao","codigo":"MIG"},{"cidade":"Miconos, Gr\u00e9cia, Mykonos","codigo":"JMK"},{"cidade":"Middlemount, Austr\u00e1lia","codigo":"MMM"},{"cidade":"Midland, Estados Unidos da Am\u00e9rica, Midland International","codigo":"MAF"},{"cidade":"Mil\u00e3o, It\u00e1lia, Bergamo Orio Al Serio","codigo":"BGY"},{"cidade":"Mil\u00e3o, It\u00e1lia, Linate","codigo":"LIN"},{"cidade":"Mil\u00e3o, It\u00e1lia, Malpensa","codigo":"MXP"},{"cidade":"Mil\u00e3o, It\u00e1lia , Todos aeroportos","codigo":"MIL"},{"cidade":"Mildura, Austr\u00e1lia","codigo":"MQL"},{"cidade":"Millingimbi Island, Austr\u00e1lia","codigo":"MGT"},{"cidade":"Milos, Gr\u00e9cia, Milos","codigo":"MLO"},{"cidade":"Milwaukee, Estados Unidos da Am\u00e9rica, General Mitchell International","codigo":"MKE"},{"cidade":"Minamidaito Jima, Jap\u00e3o, Minamidaito","codigo":"MMD"},{"cidade":"Minatitlan, M\u00e9xico, Coatzacoalcos","codigo":"MTT"},{"cidade":"Mineralnye Vody, R\u00fassia, Mineralnye Vody","codigo":"MRV"},{"cidade":"Minneapolis, Estados Unidos da Am\u00e9rica, St. Paul","codigo":"MSP"},{"cidade":"Minot, Estados Unidos da Am\u00e9rica, Minot","codigo":"MOT"},{"cidade":"Minsk, Bielor\u00fassia, Minsk 2 International","codigo":"MSQ"},{"cidade":"Miri, Mal\u00e1sia, Miri","codigo":"MYY"},{"cidade":"Mirny, R\u00fassia, Mirny","codigo":"MJZ"},{"cidade":"Misawa, Jap\u00e3o, Misawa","codigo":"MSJ"},{"cidade":"Missoula, Estados Unidos da Am\u00e9rica, Missoula","codigo":"MSO"},{"cidade":"Misurata, L\u00edbia, Misurata","codigo":"MRA"},{"cidade":"Miyakejima, Jap\u00e3o, Miyakejima","codigo":"MYE"},{"cidade":"Miyako Jima Hirara, Jap\u00e3o, Miyako","codigo":"MMY"},{"cidade":"Miyako - Shimojishima, Jap\u00e3o, Shimojishima","codigo":"SHI"},{"cidade":"Miyazaki, Jap\u00e3o, Miyazaki","codigo":"KMI"},{"cidade":"Mmabatho Mafikeng, \u00c1frica do Sul, Mmabatho International","codigo":"MBD"},{"cidade":"Moa, Cuba, Orestes Acosta","codigo":"MOA"},{"cidade":"Moanda, Rep\u00fablica Democr\u00e1tica do Congo, Muanda","codigo":"MNB"},{"cidade":"Mobile, Estados Unidos da Am\u00e9rica, Mobile","codigo":"MOB"},{"cidade":"Modesto, Estados Unidos da Am\u00e9rica, Harry Sham Field","codigo":"MOD"},{"cidade":"Moenjodaro, Paquist\u00e3o, Moenjodaro","codigo":"MJD"},{"cidade":"Mogadishu, Som\u00e1lia, Aden Adde International","codigo":"MGQ"},{"cidade":"Mohe, China, Gulian","codigo":"OHE"},{"cidade":"Mo I Rana, Noruega, Rossvoll","codigo":"MQN"},{"cidade":"Molde, Noruega, Aro","codigo":"MOL"},{"cidade":"Moline, Estados Unidos da Am\u00e9rica, Quad City ","codigo":"MLI"},{"cidade":"Mombasa, Qu\u00eania, Moi International","codigo":"MBA"},{"cidade":"Monastir, Tun\u00edsia, Habib Bourguiba","codigo":"MIR"},{"cidade":"Monbetsu, Jap\u00e3o, Monbetsu","codigo":"MBE"},{"cidade":"Monclova, M\u00e9xico, Venustiano Carranza","codigo":"LOV"},{"cidade":"Moncton, Canad\u00e1, Greater Moncton","codigo":"YQM"},{"cidade":"Mong Hsat, Mianmar, Mong Hsat","codigo":"MOG"},{"cidade":"Mongomo, Guin\u00e9 Equatorial, Mongomo","codigo":"GEM"},{"cidade":"Monroe, Estados Unidos da Am\u00e9rica, Monroe","codigo":"MLU"},{"cidade":"Monrovia, Lib\u00e9ria, Roberts International","codigo":"ROB"},{"cidade":"Monteagudo, Bol\u00edvia, Monteagudo","codigo":"MHW"},{"cidade":"Montego Bay, Jamaica, Sangster","codigo":"MBJ"},{"cidade":"Monterey, Estados Unidos da Am\u00e9rica, Monterey ","codigo":"MRY"},{"cidade":"Monteria, Col\u00f4mbia,Los Garzones","codigo":"MTR"},{"cidade":"Monterrei, M\u00e9xico, Mariano Escobedo","codigo":"MTY"},{"cidade":"Montes Claros, Brasil, Mario Ribeiro","codigo":"MOC"},{"cidade":"Montevid\u00e9u, Uruguai, Carrasco","codigo":"MVD"},{"cidade":"Montgomery, Estados Unidos da Am\u00e9rica, Dannelly Field","codigo":"MGM"},{"cidade":"Mont Joli, Canad\u00e1,\u00a0Mont Joli","codigo":"YYY"},{"cidade":"Montpellier, Fran\u00e7a, Mediterranee","codigo":"MPL"},{"cidade":"Montreal, Canad\u00e1, Mirabel","codigo":"YMX"},{"cidade":"Montreal, Canad\u00e1, Pierre Elliott Trudeau","codigo":"YUL"},{"cidade":"Montreal, Canad\u00e1, St Hubert","codigo":"YHU"},{"cidade":"Montreal, Canad\u00e1 , Todos aeroportos","codigo":"YMQ"},{"cidade":"Montrose, Estados Unidos da Am\u00e9rica, Montrose","codigo":"MTJ"},{"cidade":"Mont Tremblant, Canad\u00e1, International","codigo":"YTM"},{"cidade":"Monywa, Mianmar, Monywa","codigo":"NYW"},{"cidade":"Moomba, Austr\u00e1lia, Moomba","codigo":"MOO"},{"cidade":"Moosonee, Canad\u00e1, Moosonee","codigo":"YMO"},{"cidade":"Moranbah, Austr\u00e1lia","codigo":"MOV"},{"cidade":"Mora, Su\u00e9cia, Siljan","codigo":"MXX"},{"cidade":"Moree, Austr\u00e1lia","codigo":"MRZ"},{"cidade":"Morelia, M\u00e9xico, Francisco J. Mujica International","codigo":"MLM"},{"cidade":"Morgantown, Estados Unidos da Am\u00e9rica, Morgantown","codigo":"MGW"},{"cidade":"Morioka Hanamaki, Jap\u00e3o, Hanamaki","codigo":"HNA"},{"cidade":"Mornington Island, Austr\u00e1lia","codigo":"ONG"},{"cidade":"Morondava, Madag\u00e1scar, Morondava","codigo":"MOQ"},{"cidade":"Moron, Mong\u00f3lia, Moron","codigo":"MXV"},{"cidade":"Morotai Island, Indon\u00e9sia, Pitu","codigo":"OTI"},{"cidade":"Moruya, Austr\u00e1lia, Moruya","codigo":"MYA"},{"cidade":"Moscou, R\u00fassia, Moscow Domodedovo","codigo":"DME"},{"cidade":"Moscou, R\u00fassia, Moscow Sheremetyevo","codigo":"SVO"},{"cidade":"Moscou, R\u00fassia, Moscow Vnukovo International","codigo":"VKO"},{"cidade":"Moscou, R\u00fassia, Moscow Zhukovsky","codigo":"ZIA"},{"cidade":"Moscou, R\u00fassia - Todos Aeroportos","codigo":"MOW"},{"cidade":"Mosinee, Estados Unidos da Am\u00e9rica, Central Wisconsin","codigo":"CWA"},{"cidade":"Mosjoen, Noruega, Kjaerstad","codigo":"MJF"},{"cidade":"Mostar, B\u00f3snia e Herzegovina, Mostar International","codigo":"OMO"},{"cidade":"Mount Gambier, Austr\u00e1lia","codigo":"MGB"},{"cidade":"Mount Isa, Austr\u00e1lia, Mount Isa","codigo":"ISA"},{"cidade":"Mount Magnet, Austr\u00e1lia","codigo":"MMG"},{"cidade":"Mtwara, Tanz\u00e2nia, Mtwara","codigo":"MYW"},{"cidade":"Muan, Cor\u00e9ia do Sul","codigo":"MWX"},{"cidade":"Muang Xay, Laos, Oudomxay","codigo":"ODY"},{"cidade":"Mudanjiang, China, Hailang","codigo":"MDG"},{"cidade":"Mudgee, Austr\u00e1lia","codigo":"DGE"},{"cidade":"Muenster Osnabrueck, Alemanha, Muenster Osnabrueck","codigo":"FMO"},{"cidade":"Mukah, Mal\u00e1sia, Mukah","codigo":"MKM"},{"cidade":"Mukalla, I\u00eamen, Riyan","codigo":"RIY"},{"cidade":"Mukhaizna, Om\u00e3, Mukhaizna","codigo":"UKH"},{"cidade":"Muko Muko, Indon\u00e9sia, Muko Muko","codigo":"MPC"},{"cidade":"Mulatupo, Panam\u00e1, Malatuputo","codigo":"MPP"},{"cidade":"Mulhouse Basel, Fran\u00e7a, Euroairport ","codigo":"MLH"},{"cidade":"Multan, Paquist\u00e3o, International","codigo":"MUX"},{"cidade":"Mulu, Mal\u00e1sia, Mulu","codigo":"MZV"},{"cidade":"Mumbai, \u00cdndia, Chhatrapati Shivaji Maharaj","codigo":"BOM"},{"cidade":"Muna, Indon\u00e9sia, Sugimanuru","codigo":"RAQ"},{"cidade":"Munique\u00a0, Alemanha, Munich International","codigo":"MUC"},{"cidade":"Murray Island, Austr\u00e1lia","codigo":"MYI"},{"cidade":"Muscat, Om\u00e3, Muscat International","codigo":"MCT"},{"cidade":"Muskegon, Estados Unidos da Am\u00e9rica, Muskegon County","codigo":"MKG"},{"cidade":"Musoma, Tanz\u00e2nia, Musoma","codigo":"MUZ"},{"cidade":"Mus, Turquia, Mus","codigo":"MSR"},{"cidade":"Mwanza, Tanz\u00e2nia, Mwanza","codigo":"MWZ"},{"cidade":"Myeik, Mianmar, Myeik","codigo":"MGZ"},{"cidade":"Myitkyina, Mianmar, Myitkyina","codigo":"MYT"},{"cidade":"Myrtle Beach, Estados Unidos da Am\u00e9rica, Myrtle Beach","codigo":"MYR"},{"cidade":"Mysore, \u00cdndia, Mandakaralli","codigo":"MYQ"},{"cidade":"Mytilini, Gr\u00e9cia, Odysseas Elytis","codigo":"MJT"},{"cidade":"Mzuzu, Mal\u00e1ui, Muzu","codigo":"ZZU"},{"cidade":"Nabire, Indon\u00e9sia, Nabire","codigo":"NBX"},{"cidade":"Nacala, Mo\u00e7ambique, Nacala","codigo":"MNC"},{"cidade":"Nador, Marrocos, El Aroui","codigo":"NDR"},{"cidade":"Nadym, R\u00fassia, Nadym","codigo":"NYM"},{"cidade":"Naga, Filipinas","codigo":"WNP"},{"cidade":"Nagasaki, Jap\u00e3o, Nagasaki Airport","codigo":"NGS"},{"cidade":"Nag\u00f3ia, Jap\u00e3o, Chubu Centrair International","codigo":"NGO"},{"cidade":"Nagpur, \u00cdndia, Dr. Ambedkar","codigo":"NAG"},{"cidade":"Nain, Canad\u00e1, Nain","codigo":"YDP"},{"cidade":"Nairobi, Qu\u00eania, Jomo Kenyatta International","codigo":"NBO"},{"cidade":"Nairobi, Qu\u00eania, Wilson","codigo":"WIL"},{"cidade":"Nakashibetsu, Jap\u00e3o, Nakashibetsu","codigo":"SHB"},{"cidade":"Nakchivan, Azerbaij\u00e3o, Nakchivan","codigo":"NAJ"},{"cidade":"Nakhon Phanom, Tail\u00e2ndia, Nakhon Phanom","codigo":"KOP"},{"cidade":"Nakhon Si Thammarat, Tail\u00e2ndia","codigo":"NST"},{"cidade":"Nalchik, R\u00fassia, Nalchik","codigo":"NAL"},{"cidade":"Namangan, Uzbequist\u00e3o, Namangan","codigo":"NMA"},{"cidade":"Namibe,\u00a0Angola, Yuri Gagarin","codigo":"MSZ"},{"cidade":"Namlea, Indon\u00e9sia, Namlea","codigo":"NAM"},{"cidade":"Nampula, Mo\u00e7ambique, Nampula","codigo":"APL"},{"cidade":"Namrole, Indon\u00e9sia, Namrole","codigo":"NRE"},{"cidade":"Namsos, Noruega, Namsos","codigo":"OSY"},{"cidade":"Nanaimo, Canad\u00e1, Nanaimo","codigo":"YCD"},{"cidade":"Nanchang, China, Changbei International","codigo":"KHN"},{"cidade":"Nanchong, China, Gaoping","codigo":"NAO"},{"cidade":"Nanded, \u00cdndia, Nanded","codigo":"NDC"},{"cidade":"Nanjing, China, Lukou International","codigo":"NKG"},{"cidade":"Nanning, China, Wuxu International","codigo":"NNG"},{"cidade":"Nan, Tail\u00e2ndia, Nan","codigo":"NNT"},{"cidade":"Nantes, Fran\u00e7a, Atlantique","codigo":"NTE"},{"cidade":"Nantong, China, Xingdong","codigo":"NTG"},{"cidade":"Nantucket, Estados Unidos da Am\u00e9rica, Memorial","codigo":"ACK"},{"cidade":"Nanyang, China, Jiangying","codigo":"NNY"},{"cidade":"Nanyuki, Qu\u00eania, Nanyuki","codigo":"NYK"},{"cidade":"N\u00e1poles, It\u00e1lia, Capodichino Airport","codigo":"NAP"},{"cidade":"Narathiwat, Tail\u00e2ndia, Narathiwat","codigo":"NAW"},{"cidade":"Narrabri, Austr\u00e1lia","codigo":"NAA"},{"cidade":"Narrandera, Austr\u00e1lia","codigo":"NRA"},{"cidade":"Narvik, Noruega, Framnes","codigo":"NVK"},{"cidade":"Naryan Mar, R\u00fassia, Naryan Mar","codigo":"NNM"},{"cidade":"Nashville, Estados Unidos da Am\u00e9rica, Nashville International","codigo":"BNA"},{"cidade":"Nasik, \u00cdndia, Ozar","codigo":"ISK"},{"cidade":"Nassau, Bahamas, Lynden Pindling","codigo":"NAS"},{"cidade":"Natal, Brasil, Augusto Severo","codigo":"NAT"},{"cidade":"Natashquan, Canad\u00e1, Natashquan","codigo":"YNA"},{"cidade":"Natuna, Indon\u00e9sia, Ranai","codigo":"NTX"},{"cidade":"Navegantes, Brasil, Victor Konder","codigo":"NVT"},{"cidade":"Navoi, Uzbequist\u00e3o, International","codigo":"NVI"},{"cidade":"Naxos, Gr\u00e9cia, Naxos","codigo":"JNX"},{"cidade":"Nay Pyi Taw, Mianmar, Nay Pyi Taw","codigo":"NYT"},{"cidade":"Nazran, Magas, R\u00fassia, Sleptsovskaya","codigo":"IGT"},{"cidade":"Ndalatando,\u00a0Angola, Ndalatando","codigo":"NDF"},{"cidade":"Ndjamena, Chade, Hassan Djamous International","codigo":"NDJ"},{"cidade":"NDola, Z\u00e2mbia, Ndola","codigo":"NLA"},{"cidade":"Negril, Jamica, Negril","codigo":"NEG"},{"cidade":"Neiva, Col\u00f4mbia,Benito Sala","codigo":"NVA"},{"cidade":"Nejran, Ar\u00e1bia Saudita, Nejran","codigo":"EAM"},{"cidade":"Nelspruit, \u00c1frica do Sul, Kruger Mpumalanga International","codigo":"MQP"},{"cidade":"Nelspruit, \u00c1frica do Sul, Kruger Mpumalanga International","codigo":"MQP"},{"cidade":"Nemiscau, Canad\u00e1, Nemiscau","codigo":"YNS"},{"cidade":"Neom, Ar\u00e1bia Saudita, Neom Bay","codigo":"NUM"},{"cidade":"Nepalganj, Nepal, Nepalganj","codigo":"KEP"},{"cidade":"Neryungri, R\u00fassia, Neryungri","codigo":"NER"},{"cidade":"Neuquen, Argentina, Presidente Peron","codigo":"NQN"},{"cidade":"Nevis, S\u00e3o Crist\u00f3v\u00e3o e N\u00e9vis, Vance W. Amory","codigo":"NEV"},{"cidade":"Nevsehir, Turquia, Kapadokya","codigo":"NAV"},{"cidade":"New Bedford, Estados Unidos da Am\u00e9rica, New Bedford","codigo":"EWB"},{"cidade":"New Bern, Estados Unidos da Am\u00e9rica, Coastal Carolina","codigo":"EWN"},{"cidade":"Newburgh, Estados Unidos da Am\u00e9rica, Stewart","codigo":"SWF"},{"cidade":"Newcastle, Austr\u00e1lia, Williamtown","codigo":"NTL"},{"cidade":"Newcastle, Reino Unido, Newcastle International","codigo":"NCL"},{"cidade":"New Haven, Estados Unidos da Am\u00e9rica, Tweed-New Haven","codigo":"HVN"},{"cidade":"Newman, Austr\u00e1lia","codigo":"ZNE"},{"cidade":"New Orleans, Estados Unidos da Am\u00e9rica, Louis Armstrong","codigo":"MSY"},{"cidade":"Newport News, Estados Unidos da Am\u00e9rica, Newport News Williamsburg","codigo":"PHF"},{"cidade":"Newquay, Reino Unido, Cornwall","codigo":"NQY"},{"cidade":"Neyveli, \u00cdndia, Neyveli","codigo":"NVY"},{"cidade":"Ngala, \u00c1frica do Sul, Ngala","codigo":"NGL"},{"cidade":"NGaoundere, Camar\u00f5es, NGaoundere","codigo":"NGE"},{"cidade":"Nha Trang, Vietn\u00e3, Cam Ranh","codigo":"CXR"},{"cidade":"Nhulunbuy, Austr\u00e1lia, Gove","codigo":"GOV"},{"cidade":"Niamey, N\u00edger,Diori Hamani International, ","codigo":"NIM"},{"cidade":"Nice, Fran\u00e7a, Cote D Azur","codigo":"NCE"},{"cidade":"Niigata, Jap\u00e3o, Niigata","codigo":"KIJ"},{"cidade":"Nikolayevsk Na Amure, R\u00fassia","codigo":"NLI"},{"cidade":"Nimes, Fran\u00e7a, Garons","codigo":"FNI"},{"cidade":"Ningbo, China, Lishe International","codigo":"NGB"},{"cidade":"Ninglang, China, Luguhu","codigo":"NLH"},{"cidade":"Nis, S\u00e9rvia, Konstantin Velik","codigo":"INI"},{"cidade":"Nizhnekamsk, R\u00fassia, Begishevo","codigo":"NBC"},{"cidade":"Nizhnevartovsk, R\u00fassia, Nizhnevartovsk","codigo":"NJC"},{"cidade":"Nizhny Novgorod, R\u00fassia, Strigino","codigo":"GOJ"},{"cidade":"Nogales, M\u00e9xico, Nogales International","codigo":"NOG"},{"cidade":"Nogliki, R\u00fassia, Nogliki","codigo":"NGK"},{"cidade":"Nome, Estados Unidos da Am\u00e9rica, Nome","codigo":"OME"},{"cidade":"Norden - Norddeich\u00a0, Alemanha","codigo":"NOD"},{"cidade":"Norfolk, Estados Unidos da Am\u00e9rica, Norfolk International","codigo":"ORF"},{"cidade":"Norilsk, R\u00fassia, Alykel","codigo":"NSK"},{"cidade":"Normanton, Austr\u00e1lia","codigo":"NTN"},{"cidade":"Norman Wells, Canad\u00e1, Norman Wells","codigo":"YVQ"},{"cidade":"Norrkoping, Su\u00e9cia, Kungsangen","codigo":"NRK"},{"cidade":"North Bay, Canad\u00e1, Jack Garland","codigo":"YYB"},{"cidade":"North Bend, Estados Unidos da Am\u00e9rica, Southwest Oregon Regional","codigo":"OTH"},{"cidade":"North Eleuthera, Bahamas, North Eleuthera","codigo":"ELH"},{"cidade":"North Spirit Lake, Canad\u00e1,\u00a0North Spirit Lake","codigo":"YNO"},{"cidade":"Norway House, Canad\u00e1, Norway House","codigo":"YNE"},{"cidade":"Norwich, Reino Unido, Norwich","codigo":"NWI"},{"cidade":"Nosara, Costa Rica, Nosara","codigo":"NOB"},{"cidade":"Nosy Be, Madag\u00e1scar, Fascene","codigo":"NOS"},{"cidade":"Notodden, Noruega, Notodden","codigo":"NTB"},{"cidade":"Nottingham, Reino Unido, East Midlands","codigo":"EMA"},{"cidade":"Nouadhibou, Maurit\u00e2nia, Nouadhibou","codigo":"NDB"},{"cidade":"Nouakchott, Maurit\u00e2nia, Nouadhibou","codigo":"NKC"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica, John F. Kennedy","codigo":"JFK"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica, LaGuardia","codigo":"LGA"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica, Newark Liberty","codigo":"EWR"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica - Todos Aeroportos","codigo":"NYC"},{"cidade":"Novokuznetsk, R\u00fassia, Spichenkovo","codigo":"NOZ"},{"cidade":"Novosibirsk, R\u00fassia, Tolmachevo","codigo":"OVB"},{"cidade":"Novy Urengoy, R\u00fassia, Novy Urengoy","codigo":"NUX"},{"cidade":"Nowshahr, Ir\u00e3, Nowshahr","codigo":"NSH"},{"cidade":"Noyabrsk, R\u00fassia, Noyabrsk","codigo":"NOJ"},{"cidade":"Nueva Gerona, Cuba, Rafael Cabre","codigo":"GER"},{"cidade":"Nuevo Laredo, M\u00e9xico, Quetzalcoatl International","codigo":"NLD"},{"cidade":"Nukus, Uzbequist\u00e3o, Nukus","codigo":"NCU"},{"cidade":"Nunukan, Indon\u00e9sia, Nunukan","codigo":"NNX"},{"cidade":"Nurembergue\u00a0, Alemanha, Nuremberg Airport","codigo":"NUE"},{"cidade":"Nur Sultan, Cazaquist\u00e3o, Nazarbayev","codigo":"TSE"},{"cidade":"Nyagan, R\u00fassia, Nyagan","codigo":"NYA"},{"cidade":"Nyala, Sud\u00e3o, Nyala","codigo":"UYL"},{"cidade":"Nyingchi, Linzhi, China, Mainling, Milin","codigo":"LZY"},{"cidade":"Nyurba, R\u00fassia, Nyurba","codigo":"NYR"},{"cidade":"Oakland, Estados Unidos da Am\u00e9rica, Oakland","codigo":"OAK"},{"cidade":"Oaxaca, M\u00e9xico, Xoxocotlan International","codigo":"OAX"},{"cidade":"Obihiro, Jap\u00e3o, Obihiro","codigo":"OBO"},{"cidade":"Ocho Rios, Jamaica, Ian Fleming","codigo":"OCJ"},{"cidade":"Odate Noshiro, Jap\u00e3o, Odate Noshiro","codigo":"ONJ"},{"cidade":"Odense, Dinamarca, Ondense","codigo":"ODE"},{"cidade":"Odessa, Ucr\u00e2nia, Odesa International","codigo":"ODS"},{"cidade":"Odienne, Costa do Marfim, Odienne","codigo":"KEO"},{"cidade":"Ohrid, Maced\u00f4nia, St. Paul the Apostle","codigo":"OHD"},{"cidade":"Oita, Jap\u00e3o, Oita","codigo":"OIT"},{"cidade":"Okayama, Jap\u00e3o, Okayama","codigo":"OKJ"},{"cidade":"Okha, R\u00fassia, Novostroyka","codigo":"OHH"},{"cidade":"Okhotsk, R\u00fassia, Okhotsk","codigo":"OHO"},{"cidade":"Oki Island, Jap\u00e3o, Oki","codigo":"OKI"},{"cidade":"Okinawa, Jap\u00e3o, Ryukyo Island-Naha","codigo":"OKA"},{"cidade":"Okinoerabu, Jap\u00e3o, Okinoerabu","codigo":"OKE"},{"cidade":"Oklahoma City, Estados Unidos da Am\u00e9rica, Will Rogers World","codigo":"OKC"},{"cidade":"Oksibil, Indon\u00e9sia, Gunung Bintang","codigo":"OKL"},{"cidade":"Okushiri, Jap\u00e3o, Okushiri","codigo":"OIR"},{"cidade":"Olbia, It\u00e1lia, Costa Smeralda","codigo":"OLB"},{"cidade":"Old Crow, Canad\u00e1, Old Crow","codigo":"YOC"},{"cidade":"Olekminsk, R\u00fassia, Olekminsk","codigo":"OLZ"},{"cidade":"Olenek, R\u00fassia, Olenek","codigo":"ONK"},{"cidade":"Olgii, Mong\u00f3lia, Olgii","codigo":"ULG"},{"cidade":"Olympic Dam, Austr\u00e1lia","codigo":"OLP"},{"cidade":"Omaha, Estados Unidos da Am\u00e9rica, Eppley Airfield","codigo":"OMA"},{"cidade":"Omsk, R\u00fassia, Tsentralny","codigo":"OMS"},{"cidade":"Ondangwa, Nam\u00edbia, Ondangwa","codigo":"OND"},{"cidade":"Ondjiva, Angola, Ondjiva","codigo":"VPE"},{"cidade":"Onslow, Austr\u00e1lia","codigo":"ONS"},{"cidade":"Ontario, Estados Unidos da Am\u00e9rica, Ontario","codigo":"ONT"},{"cidade":"Oostende Brugge, B\u00e9lgica, Oostende","codigo":"OST"},{"cidade":"Oradea, Rom\u00eania, Oradea","codigo":"OMR"},{"cidade":"Oran, Arg\u00e9lia, Ahmed Bem Bella","codigo":"ORN"},{"cidade":"Orange, Austr\u00e1lia","codigo":"OAG"},{"cidade":"Orange walk, Belize, Orange Walk","codigo":"ORZ"},{"cidade":"Oranjemund, Nam\u00edbia, Oranjemud","codigo":"OMD"},{"cidade":"Ordos, China, Ejin Horo","codigo":"DSN"},{"cidade":"Ordu Giresun, Turquia, Ordu Giresun","codigo":"OGU"},{"cidade":"Orebro, Su\u00e9cia, Orebro Airport","codigo":"ORB"},{"cidade":"Orenburg, R\u00fassia, Tsentralny","codigo":"REN"},{"cidade":"Orland, Noruega, Orland","codigo":"OLA"},{"cidade":"Orlando, Estados Unidos da Am\u00e9rica, Orlando, McCoy Field","codigo":"MCO"},{"cidade":"Orlando, Estados Unidos da Am\u00e9rica, Orlando Sanford","codigo":"SFB"},{"cidade":"Ormoc City, Filipinas, Ormoc","codigo":"OMC"},{"cidade":"Ornskoldsvik, Su\u00e9cia, Ornskoldsvik","codigo":"OER"},{"cidade":"Orsk, R\u00fassia, Orsk","codigo":"OSW"},{"cidade":"Orsta Volda, Noruega, Hovden","codigo":"HOV"},{"cidade":"Oruro, Bol\u00edvia, Juan Mendoza","codigo":"ORU"},{"cidade":"Osaka, Jap\u00e3o, Kansai International","codigo":"KIX"},{"cidade":"Osaka, Jap\u00e3o, Osaka International","codigo":"ITM"},{"cidade":"Osaka, Jap\u00e3o , Todos Aeroportos","codigo":"OSA"},{"cidade":"Oshima, Jap\u00e3o, Oshima","codigo":"OIM"},{"cidade":"Osh, Quirguist\u00e3o, Osh","codigo":"OSS"},{"cidade":"Osijek, Cro\u00e1cia, Osijek","codigo":"OSI"},{"cidade":"Oslo, Noruega, Gardermoen","codigo":"OSL"},{"cidade":"Oslo, Noruega, Sandefjord Torp","codigo":"TRF"},{"cidade":"Osorno, Chile, Canal Bajo","codigo":"ZOS"},{"cidade":"Ostrava, Rep\u00fablica Tcheca, Leos Janacek","codigo":"OSR"},{"cidade":"Ottawa, Canad\u00e1, Ottawa Macdonald Cartier","codigo":"YOW"},{"cidade":"Ouagadougou, Burkina Faso, Ouagadougou","codigo":"OUA"},{"cidade":"Ouargla, Arg\u00e9lia","codigo":"OGX"},{"cidade":"Ouarzazate, Marrocos, Ouarzazate","codigo":"OZZ"},{"cidade":"Oujda, Marrocos, Angads","codigo":"OUD"},{"cidade":"Oulu, Finl\u00e2ndia, Oulu","codigo":"OUL"},{"cidade":"Ovda, Israel, Ovda","codigo":"VDA"},{"cidade":"Oviedo Ast\u00farias, Espanha, Asturias","codigo":"OVD"},{"cidade":"Owerri, Nig\u00e9ria, Sam Mbakwe","codigo":"QOW"},{"cidade":"Oxford House, Canad\u00e1, Oxford House","codigo":"YOH"},{"cidade":"Oxnard, Estados Unidos da Am\u00e9rica, Oxnard","codigo":"OXR"},{"cidade":"Ozamis, Filipinas, Labo","codigo":"OZC"},{"cidade":"Padang, Indon\u00e9sia, Minangkabau","codigo":"PDG"},{"cidade":"Padangsidempuan, Indon\u00e9sia","codigo":"AEG"},{"cidade":"Paderborn Lippstadt, Alemanha, Paderborn Lippstadt","codigo":"PAD"},{"cidade":"Paducah, Estados Unidos da Am\u00e9rica, Barkley","codigo":"PAH"},{"cidade":"Pagadian, Filipinas","codigo":"PAG"},{"cidade":"Page, Estados Unidos da Am\u00e9rica, Municipal de Page","codigo":"PGA"},{"cidade":"Pago Pago, Estados Unidos da Am\u00e9rica, Pago Pago International","codigo":"PPG"},{"cidade":"Pai, Tail\u00e2ndia, Pai","codigo":"PYY"},{"cidade":"Pajala, Su\u00e9cia, Pajala, Yllas","codigo":"PJA"},{"cidade":"Pakse, Laos, Pakse International","codigo":"PKZ"},{"cidade":"Pakuba, Uganda, Pakuda","codigo":"PAF"},{"cidade":"Palangkaraya, Indon\u00e9sia","codigo":"PKY"},{"cidade":"Palembang, Indon\u00e9sia, Mahmud Badaruddin II","codigo":"PLM"},{"cidade":"Palermo, It\u00e1lia, Punta Raisi","codigo":"PMO"},{"cidade":"Palma de Maiorca, Espanha, Palma Mallorca","codigo":"PMI"},{"cidade":"Palmar Sur, Costa Rica, Palmar Sur","codigo":"PMZ"},{"cidade":"Palmas, Brasil, Palmas","codigo":"PMW"},{"cidade":"Palm Island, Austr\u00e1lia","codigo":"PMK"},{"cidade":"Palm Springs, Estados Unidos da Am\u00e9rica, Palm Springs","codigo":"PSP"},{"cidade":"Palopo, Indon\u00e9sia, Lagaligo","codigo":"LLO"},{"cidade":"Palu, Indon\u00e9sia, Mutiara","codigo":"PLW"},{"cidade":"Pamplona, Espanha, Pamplona","codigo":"PNA"},{"cidade":"Pampulha, Brasil, Pampulha","codigo":"PLU"},{"cidade":"Panama City Beach, Estados Unidos da Am\u00e9rica, Northwest Fl\u00f3rida Beaches","codigo":"PFN"},{"cidade":"Panama City, Panam\u00e1, Tocumen","codigo":"PTY"},{"cidade":"Pangkalanbuun, Indon\u00e9sia, Iskandar","codigo":"PKN"},{"cidade":"Pangkalpinang, Indon\u00e9sia, Depati Amir","codigo":"PGK"},{"cidade":"Panglao, Filipinas, Bohol International","codigo":"TAG"},{"cidade":"Panjgur, Paquist\u00e3o, Panjgur","codigo":"PJG"},{"cidade":"Pantelleria, It\u00e1lia, Pantelleria","codigo":"PNL"},{"cidade":"Pantnagar, \u00cdndia, Pantnagar","codigo":"PGH"},{"cidade":"Panzhihua, China, Bao Angong","codigo":"PZI"},{"cidade":"Paraburdoo, Austr\u00e1lia","codigo":"PBO"},{"cidade":"Paramaribo Zanderij, Suriname, Johan A Pengel","codigo":"PBM, Suriname"},{"cidade":"Parana, Argentina, General Urquiza","codigo":"PRA"},{"cidade":"Parauapebas, Brasil, Caraj\u00e1s","codigo":"CKS"},{"cidade":"Pardubice, Rep\u00fablica Tcheca, Pardubice","codigo":"PED"},{"cidade":"Parintins, Brasil, Julio Belem","codigo":"PIN"},{"cidade":"Paris, Fran\u00e7a, Charles de Gaulle","codigo":"CDG"},{"cidade":"Paris, Fran\u00e7a, Le Bourget","codigo":"LBG"},{"cidade":"Paris, Fran\u00e7a, Orly","codigo":"ORY"},{"cidade":"Paris, Fran\u00e7a , Todos Aeroportos","codigo":"PAR"},{"cidade":"Parkersburg, Estados Unidos da Am\u00e9rica, Mid Ohio Valley","codigo":"PKB"},{"cidade":"Parkes, Austr\u00e1lia","codigo":"PKE"},{"cidade":"Parma, It\u00e1lia, Parma","codigo":"PMF"},{"cidade":"Parna\u00edba, Brasil, Jo\u00e3o Silva Filho","codigo":"PHB"},{"cidade":"Paro, But\u00e3o, International","codigo":"PBH"},{"cidade":"Paros, Gr\u00e9cia, Paros","codigo":"PAS"},{"cidade":"Parsabad, Ir\u00e3, Moghan","codigo":"PFQ"},{"cidade":"Pasco, Estados Unidos da Am\u00e9rica, Tri Cities","codigo":"PSC"},{"cidade":"Pasighat, \u00cdndia, Pasighat","codigo":"IXT"},{"cidade":"Pasto, Col\u00f4mbia,Antonio Narino","codigo":"PSO"},{"cidade":"Pathankot, \u00cdndia, Pathankot","codigo":"IXP"},{"cidade":"Pathein, Mianmar, Pathein","codigo":"BSX"},{"cidade":"Patna, \u00cdndia, Jayaprakash Narayan","codigo":"PAT"},{"cidade":"Patrai, Gr\u00e9cia, Araxos","codigo":"GPA"},{"cidade":"Pau, Fran\u00e7a, Pyrenees","codigo":"PUF"},{"cidade":"Paulatuk, Canad\u00e1, Nora A. Ruben","codigo":"YPC"},{"cidade":"Paulo Afonso, Brasil, Paulo Afonso","codigo":"PAV"},{"cidade":"Pavlodar, Cazaquist\u00e3o, Pavlodar","codigo":"PWQ"},{"cidade":"Pechora, R\u00fassia, Pechora","codigo":"PEX"},{"cidade":"Pedro Juan Caballero, Paraguai, Augusto Roberto Fuster","codigo":"PJC"},{"cidade":"Pekanbaru, Indon\u00e9sia","codigo":"PKU"},{"cidade":"Pellston, Estados Unidos da Am\u00e9rica, Regional Emmet County","codigo":"PLN"},{"cidade":"Pelotas, Brasil, Pelotas","codigo":"PET"},{"cidade":"Pemba, Mo\u00e7ambique, Pemba","codigo":"POL"},{"cidade":"Pemba, Tanz\u00e2nia, Pemba","codigo":"PMA"},{"cidade":"Penang, Mal\u00e1sia, Penag International","codigo":"PEN"},{"cidade":"Pendleton, Estados Unidos da Am\u00e9rica, Eastern Oregon Regional","codigo":"PDT"},{"cidade":"Pensacola, Estados Unidos da Am\u00e9rica, Pensacola","codigo":"PNS"},{"cidade":"Penticton, Canad\u00e1, Regional","codigo":"YYF"},{"cidade":"Penza, R\u00fassia, Ternovka","codigo":"PEZ"},{"cidade":"Peoria, Estados Unidos da Am\u00e9rica, Greater Peoria","codigo":"PIA"},{"cidade":"Pequim, Beijing, China, Capital International","codigo":"PEK"},{"cidade":"Pequim, Beijing, China, Daxing International","codigo":"PKX"},{"cidade":"Pequim, Beijing, China, Nanyuan Airport","codigo":"NAY"},{"cidade":"Pequim, Beijing, China , Todos Aeroportos","codigo":"BJS"},{"cidade":"Pereira, Col\u00f4mbia,Matecana","codigo":"PEI"},{"cidade":"Perigueux, Fran\u00e7a, Bassillac","codigo":"PGX"},{"cidade":"Perito Moreno, Argentina, Perito Moreno","codigo":"PMQ"},{"cidade":"Perm, R\u00fassia, Bolshoye Savino","codigo":"PEE"},{"cidade":"Perpignan, Fran\u00e7a, Rivesaltes","codigo":"PGF"},{"cidade":"Perth, Austr\u00e1lia, Perth Airport","codigo":"PER"},{"cidade":"Perugia\u00a0, It\u00e1lia, St. Francis Of Assini","codigo":"PEG"},{"cidade":"Pescara, It\u00e1lia, Abruzzo","codigo":"PSR"},{"cidade":"Peshawar, Paquist\u00e3o, Bacha Khan International","codigo":"PEW"},{"cidade":"Petersburg, Estados Unidos da Am\u00e9rica, Petersburg James A. Johnson","codigo":"PSG"},{"cidade":"Petrolina, Brasil, Senador Nilo Coelho","codigo":"PNZ"},{"cidade":"Petropavlovsk, Cazaquist\u00e3o, Petropavlovsk","codigo":"PPK"},{"cidade":"Petropavlovsk, R\u00fassia, Yelizovo","codigo":"PKC"},{"cidade":"Petrozavodsk, R\u00fassia, Besovets","codigo":"PES"},{"cidade":"Pevek, R\u00fassia, Pevek","codigo":"PWE"},{"cidade":"Phalaborwa, \u00c1frica do Sul, Hendrik Van Eck","codigo":"PHW"},{"cidade":"Phaplu, Nepal, Phaplu","codigo":"PPL"},{"cidade":"Phinda, \u00c1frica do Sul, Zulu Inyala","codigo":"PZL"},{"cidade":"Phitsanulok, Tail\u00e2ndia, Phitsanulok","codigo":"PHS"},{"cidade":"Phnom Penh, Camboja, International","codigo":"PNH"},{"cidade":"Phoenix, Estados Unidos da Am\u00e9rica, Phoenix Sky Harbor","codigo":"PHX"},{"cidade":"Phongsaly, Laos, Boun Neua","codigo":"PCQ"},{"cidade":"Phonsavan, Laos, Xieng Khouang","codigo":"XKH"},{"cidade":"Phrae, Tail\u00e2ndia, Phrae","codigo":"PRH"},{"cidade":"Phuket, Tail\u00e2ndia, Phuket International","codigo":"HKT"},{"cidade":"Phu Quoc Island, Vietn\u00e3, International","codigo":"PQC"},{"cidade":"Pickle Lake, Canad\u00e1, Pickle Lake","codigo":"YPL"},{"cidade":"Pico Island, Portugal, Pico Island","codigo":"PIX"},{"cidade":"Piedras Negras, M\u00e9xico, Piedras Negras International","codigo":"PDS"},{"cidade":"Pierre, Estados Unidos da Am\u00e9rica, Pierre","codigo":"PIR"},{"cidade":"Pietermaritzburg, \u00c1frica do Sul, Pietermaritzburg","codigo":"PZB"},{"cidade":"Pisa, It\u00e1lia, Galileu Galilei","codigo":"PSA"},{"cidade":"Pisco, Peru, Renan Elias Oliveira","codigo":"PIO"},{"cidade":"Pittsburgh, Estados Unidos da Am\u00e9rica, Pittsburgh International","codigo":"PIT"},{"cidade":"Piura, Peru,\u00a0G Concha Iberico","codigo":"PIU"},{"cidade":"Placencia Village, Belize, Placencia","codigo":"PLJ"},{"cidade":"Plastun, R\u00fassia, Plastun","codigo":"TLY"},{"cidade":"Playon Chico, Panam\u00e1, Playon Chico","codigo":"PYC"},{"cidade":"Pleiku, Vietn\u00e3, Pleiku","codigo":"PXU"},{"cidade":"Plettenberg Bay, \u00c1frica do Sul, Plettenberg Bay","codigo":"PBZ"},{"cidade":"Plovdiv, Bulg\u00e1ria, Krumovo","codigo":"PDV"},{"cidade":"Plymouth, Reino Unido, City Airport","codigo":"PLH"},{"cidade":"Pocatello, Estados Unidos da Am\u00e9rica, Pocatello","codigo":"PIH"},{"cidade":"Po\u00e7os de Caldas, Brasil, Walther Moreira Salles","codigo":"POO"},{"cidade":"Podgorica, Montenegro, Podgorica","codigo":"TGD"},{"cidade":"Pohang, Cor\u00e9ia do Sul, Pohang","codigo":"KPO"},{"cidade":"Pointe Noire, Rep\u00fablica do Congo, Pointe Noire","codigo":"PNR"},{"cidade":"Points North Landing, Canad\u00e1, Points North Landing","codigo":"YNL"},{"cidade":"Poitiers, Fran\u00e7a, Biard","codigo":"PIS"},{"cidade":"Pokhara, Nepal, Pokhara","codigo":"PKR"},{"cidade":"Polillo, Filipinas, Balesin Island","codigo":"BSI"},{"cidade":"Polokwane, \u00c1frica do Sul, Polokwane International","codigo":"PTG"},{"cidade":"Polyarnyj, R\u00fassia, Polyarnyj","codigo":"PYJ"},{"cidade":"Pondicherry, \u00cdndia, Pondicherry","codigo":"PNY"},{"cidade":"Pond Inlet, Canad\u00e1, Pond Inlet","codigo":"YIO"},{"cidade":"Ponta Delgada, A\u00e7ores, Portugal, Joao Paulo II","codigo":"PDL"},{"cidade":"Ponta Por\u00e3, Brasil, Ponta Por\u00e3","codigo":"PMG"},{"cidade":"Pontianak, Indon\u00e9sia","codigo":"PNK"},{"cidade":"Popayan, Col\u00f4mbia,Guillermo Leon Valencia","codigo":"PPN"},{"cidade":"Poplar Hill, Canad\u00e1,\u00a0Poplar Hill","codigo":"YHP"},{"cidade":"Poprad, Eslov\u00e1quia, Tatry","codigo":"TAT"},{"cidade":"Porbandar, \u00cdndia, Porbandar","codigo":"PBD"},{"cidade":"Pori, Finl\u00e2ndia, Pori","codigo":"POR"},{"cidade":"Porlamar, Venezuela, Del Caribe","codigo":"PMV"},{"cidade":"Port Angeles, Estados Unidos da Am\u00e9rica, William R. Fairchild","codigo":"CLM"},{"cidade":"Port Augusta, Austr\u00e1lia","codigo":"PUG"},{"cidade":"Port Au Prince, Haiti Toussaint Louverture","codigo":"PAP"},{"cidade":"Port Blair, \u00cdndia, Veer Savarkar","codigo":"IXZ"},{"cidade":"Port Elizabeth, \u00c1frica do Sul, Port Elizabeth","codigo":"PLZ"},{"cidade":"Port Gentil, Gab\u00e3o, International","codigo":"POG"},{"cidade":"Port Harcourt, Nig\u00e9ria, Port Harcourt International","codigo":"PHC"},{"cidade":"Port Hardy, Canad\u00e1, Port Hardy","codigo":"YZT"},{"cidade":"Port Hedland, Austr\u00e1lia, Port Hedland International","codigo":"PHE"},{"cidade":"Port Hope Simpson, Canad\u00e1, Port Hope Simpson","codigo":"YHA"},{"cidade":"Portimao, Portugal, Portimao","codigo":"PRM"},{"cidade":"Portland, Austr\u00e1lia","codigo":"PTJ"},{"cidade":"Portland, Estados Unidos da Am\u00e9rica, Jetport ","codigo":"PWM"},{"cidade":"Portland, Estados Unidos da Am\u00e9rica, Portland International","codigo":"PDX"},{"cidade":"Port Lincoln, Austr\u00e1lia","codigo":"PLO"},{"cidade":"Port Macquarie, Austr\u00e1lia","codigo":"PQQ"},{"cidade":"Port Menier, Canad\u00e1, Port Menier","codigo":"YPN"},{"cidade":"Porto Alegre, Brasil, Salgado Filho","codigo":"POA"},{"cidade":"Port Of Spain, Trinidad e Tobago, Piarco","codigo":"POS"},{"cidade":"Porto, Portugal, Francisco Sa Carneiro","codigo":"OPO"},{"cidade":"Porto Santo, Portugal, Porto Santo","codigo":"PXO"},{"cidade":"Porto Seguro, Brasil, Porto Seguro","codigo":"BPS"},{"cidade":"Porto Velho, Brasil, Governador Jorge Teixeira","codigo":"PVH"},{"cidade":"Port Sudan, Sud\u00e3o, New International","codigo":"PZU"},{"cidade":"Posadas, Argentina, Jose de San Martin","codigo":"PSS"},{"cidade":"Poso, Indon\u00e9sia, Kasinguncu","codigo":"PSJ"},{"cidade":"Postville, Canad\u00e1, Postville","codigo":"YSO"},{"cidade":"Potosi, Bol\u00edvia, Capitain Nicolas Rojas","codigo":"POI"},{"cidade":"Powell River, Canad\u00e1, Powell River","codigo":"YPW"},{"cidade":"Poza Rica, M\u00e9xico, El Tajin","codigo":"PAZ"},{"cidade":"Poznan, Polonia, Lawica","codigo":"POZ"},{"cidade":"Praga, Rep\u00fablica Tcheca, Ruzyne","codigo":"PRG"},{"cidade":"Praia, Cabo Verde, Praia International","codigo":"RAI"},{"cidade":"Praya, Indon\u00e9sia, Lombok International","codigo":"LOP"},{"cidade":"Preobrazheniye, R\u00fassia, Preobrazheniye","codigo":"RZH"},{"cidade":"Presque Isle, Estados Unidos da Am\u00e9rica, Northern Maine","codigo":"PQI"},{"cidade":"Preveza Lefkada, Gr\u00e9cia, Aktion","codigo":"PVK"},{"cidade":"Prince Albert, Canad\u00e1, Glass Field","codigo":"YPA"},{"cidade":"Prince George, Canad\u00e1, Prince George","codigo":"YXS"},{"cidade":"Prince Rupert, Canad\u00e1, Digby Island","codigo":"YPR"},{"cidade":"Principe Island, S\u00e3o Tom\u00e9 e Pr\u00edncipe, International","codigo":"PCP"},{"cidade":"Pristina, S\u00e9rvia, Pristina International","codigo":"PRN"},{"cidade":"Prosperpine, Austr\u00e1lia, Whitsunday Coast","codigo":"PPP"},{"cidade":"Providence, Estados Unidos da Am\u00e9rica, Theodore Francis Green State","codigo":"PVD"},{"cidade":"Provincetown, Estados Unidos da Am\u00e9rica, Provincetown","codigo":"PVC"},{"cidade":"Pskov, R\u00fassia, Pskov","codigo":"PKV"},{"cidade":"Pucallpa, Peru, D Abenzur Rengifo","codigo":"PCL"},{"cidade":"Puebla, M\u00e9xico, Hermanos Serdan","codigo":"PBC"},{"cidade":"Puerto Asis, Col\u00f4mbia,Tres de Mayo","codigo":"PUU"},{"cidade":"Puerto Ayacucho, Venezuela, Cacique Aramare","codigo":"PYH"},{"cidade":"Puerto Barrios, Guatemala, Puerto Barrios","codigo":"PBR"},{"cidade":"Puerto Cabello, Venezuela, bartolome Salom","codigo":"PBL"},{"cidade":"Puerto Escondido, M\u00e9xico, Puerto Escondido International","codigo":"PXM"},{"cidade":"Puerto Jimenez, Costa Rica, Puerto Jimenez","codigo":"PJM"},{"cidade":"Puerto Lempira, Honduras, Puerto Lempira","codigo":"PEU"},{"cidade":"Puerto Madryn, Argentina, El Tehuelche","codigo":"PMY"},{"cidade":"Puerto Maldonado, Peru,\u00a0Padre Aldamiz","codigo":"PEM"},{"cidade":"Puerto Montt, Chile, El Tepual","codigo":"PMC"},{"cidade":"Puerto Natales, Chile, Teniente","codigo":"PNT"},{"cidade":"Puerto Obaldia, Panam\u00e1, Puerto Obaldia","codigo":"PUE"},{"cidade":"Puerto Ordaz, Venezuela, Manuel Carlos Piar","codigo":"PZO"},{"cidade":"Puerto Plata, Rep\u00fablica Dominicana, Gregorio Luperon","codigo":"POP"},{"cidade":"Puerto Princesa, Filipinas, International","codigo":"PPS"},{"cidade":"Puerto Vallarta, M\u00e9xico, Gustavo D\u00edaz Ordaz","codigo":"PVR"},{"cidade":"Puerto Williams, Chile, Guardiamarina Zanartu","codigo":"WPU"},{"cidade":"Pula, Cro\u00e1cia, Pula","codigo":"PUY"},{"cidade":"Pullman, Estados Unidos da Am\u00e9rica, Moscow Regional","codigo":"PUW"},{"cidade":"Pune, \u00cdndia, Lohegaon","codigo":"PNQ"},{"cidade":"Punta Arenas, Chile, Carlos Ibanez del Campo","codigo":"PUQ"},{"cidade":"Punta Cana, Rep\u00fablica Dominicana, Punta Cana","codigo":"PUJ"},{"cidade":"Punta Del Este, Uruguai, Punta Del Leste","codigo":"PDP"},{"cidade":"Punta Gorda, Belize, Punta Gorda","codigo":"BZE"},{"cidade":"Putao, Mianmar, Putao","codigo":"PBU"},{"cidade":"Putussibau, Indon\u00e9sia, Pangsuma","codigo":"PSU"},{"cidade":"Puvirnituq, Canad\u00e1, Puvirnituq","codigo":"YPX"},{"cidade":"Pyongyang, Cor\u00e9ia do Norte, Sunan International","codigo":"FNJ"},{"cidade":"Qabala, Azerbaij\u00e3o, Gabala International","codigo":"GBB"},{"cidade":"Qaisumah, Ar\u00e1bia Saudita, Haifar Al Batin","codigo":"AQI"},{"cidade":"Qamdo, Changdu, China, Bangda","codigo":"BPX"},{"cidade":"Qianjiang Zhoubai, China, Wulingshan","codigo":"JIQ"},{"cidade":"Qiemo, China, Qiemo","codigo":"IQM"},{"cidade":"Qilian, China, Haibei","codigo":"HBQ"},{"cidade":"Qingdao, China, Liuting International","codigo":"TAO"},{"cidade":"Qingyang, China, Qingyang","codigo":"IQN"},{"cidade":"Qinhuangdao, China, Beidaihe","codigo":"BPE"},{"cidade":"Qionghai, China, Boao","codigo":"BAR"},{"cidade":"Qiqihar, China, Sanjiazi","codigo":"NDG"},{"cidade":"Quang Ninh, Vietn\u00e3, Van Don International","codigo":"VDO"},{"cidade":"Quanzhou, China, Jinjiang","codigo":"JJN"},{"cidade":"Quaqtaq, Canad\u00e1, Puvirnituq","codigo":"YQC"},{"cidade":"Quebec, Canad\u00e1, Jean Lesage","codigo":"YQB"},{"cidade":"Quelimane, Mo\u00e7ambique, Quelimane","codigo":"UEL"},{"cidade":"Quepos, Costa Rica, La Managua","codigo":"XQP"},{"cidade":"Queretaro, M\u00e9xico, Queretaro Intercontinental","codigo":"QRO"},{"cidade":"Quesnel, Canad\u00e1, Quesnel","codigo":"YQZ"},{"cidade":"Quetta, Paquist\u00e3o, International","codigo":"UET"},{"cidade":"Quibdo, Col\u00f4mbia,El Carano","codigo":"UIB"},{"cidade":"Quilpie, Austr\u00e1lia","codigo":"ULP"},{"cidade":"Quimper, Fran\u00e7a, Pluguffan","codigo":"UIP"},{"cidade":"Quincy, Estados Unidos da Am\u00e9rica, Quincy Baldwin Field","codigo":"UIN"},{"cidade":"Qui Nhon, Vietn\u00e3, Phu Cat","codigo":"UIH"},{"cidade":"Quito, Equador, Mariscal Sucre","codigo":"UIO, Equador"},{"cidade":"Qurghonteppa,, Tajiquist\u00e3o, International","codigo":"KQT"},{"cidade":"Quzhou, China, Quzhou","codigo":"JUZ"},{"cidade":"Rabat, Marrocos, Sale","codigo":"RBA"},{"cidade":"Rach Gia, Vietn\u00e3, Rach Gia","codigo":"VKG"},{"cidade":"Rafha, Ar\u00e1bia Saudita, Rafha","codigo":"RAH"},{"cidade":"Rafsanjan, Ir\u00e3, Rafsanjan","codigo":"RJN"},{"cidade":"Rahim Yar Khan, Paquist\u00e3o, Rahim Yar Khan","codigo":"RYK"},{"cidade":"Raipur, \u00cdndia, Swami Vivekananda","codigo":"RPR"},{"cidade":"Rajahmundry, \u00cdndia, Rajahmundry","codigo":"RJA"},{"cidade":"Rajbiraj, Nepal, Rajbiraj","codigo":"RJB"},{"cidade":"Rajkot, \u00cdndia, Rajkot","codigo":"RAJ"},{"cidade":"Rajshahi, Bangladesh, Shah Makhdum","codigo":"RJH"},{"cidade":"Raleigh, Estados Unidos da Am\u00e9rica, Raleigh-Durham","codigo":"RDU"},{"cidade":"Ramsar, Ir\u00e3, Ramsar","codigo":"RZR"},{"cidade":"Ranchi, \u00cdndia, Birsa Munda","codigo":"IXR"},{"cidade":"Rankin Inlet, Canad\u00e1, Rankin Inlet","codigo":"YRT"},{"cidade":"Ranong, Tail\u00e2ndia, Ranong","codigo":"UNN"},{"cidade":"Rapid City, Estados Unidos da Am\u00e9rica, Rapid City","codigo":"RAP"},{"cidade":"Ras al Khaymah, Emirados \u00c1rabes Unidos, Ras al Khaimah","codigo":"RKT"},{"cidade":"Rasht, Ir\u00e3, Sandra E Jangal","codigo":"RAS"},{"cidade":"Reading, Estados Unidos da Am\u00e9rica, Reading Regional","codigo":"RDG"},{"cidade":"Recife, Brasil, Guararapes","codigo":"REC"},{"cidade":"Reconquista, Argentina, Reconquista","codigo":"RCQ"},{"cidade":"Redang Island, Mal\u00e1sia","codigo":"RDN"},{"cidade":"Redding, Estados Unidos da Am\u00e9rica, Redding","codigo":"RDD"},{"cidade":"Red Lake, Canad\u00e1, Red Lake","codigo":"YRL"},{"cidade":"Redmond, Estados Unidos da Am\u00e9rica, Roberts Field","codigo":"RDM"},{"cidade":"Reggio di Calabria, It\u00e1lia, Reggio di Calabria","codigo":"REG"},{"cidade":"Regina, Canad\u00e1, Regina","codigo":"YQR"},{"cidade":"Rengat, Indon\u00e9sia, Japura","codigo":"RGT"},{"cidade":"Rennes, Fran\u00e7a, St Jacques","codigo":"RNS"},{"cidade":"Reno, Estados Unidos da Am\u00e9rica, Tahoe","codigo":"RNO"},{"cidade":"Resistencia, Argentina, Resistencia","codigo":"RES"},{"cidade":"Resolute, Canad\u00e1, Resolute Bay","codigo":"YRB"},{"cidade":"Retalhuleu, Guatemala, Retalhuleu","codigo":"RER"},{"cidade":"Reus, Espanha, Reus","codigo":"REU"},{"cidade":"Reykjavik, Isl\u00e2ndia, Keflavik International","codigo":"KEF"},{"cidade":"Reykjavik, Isl\u00e2ndia, Reykjavik Domestic","codigo":"RKV"},{"cidade":"Reykjavik, Isl\u00e2ndia , Todos Aeroportos","codigo":"REK"},{"cidade":"Reynosa, M\u00e9xico, Lucio Blanco","codigo":"REX"},{"cidade":"Rhinelander, Estados Unidos da Am\u00e9rica, Oneida County","codigo":"RHI"},{"cidade":"Rhodes, Gr\u00e9cia, Diagoras Airport","codigo":"RHO"},{"cidade":"Riade, Ar\u00e1bia Saudita, Riyad King Khalid","codigo":"RUH"},{"cidade":"Ribeir\u00e3o Preto, Brasil, Leite Lopes","codigo":"RAO"},{"cidade":"Riberalta\u00a0, Bol\u00edvia, Riberalta","codigo":"RIB"},{"cidade":"Richards Bay, \u00c1frica do Sul, Richards Bay","codigo":"RCB"},{"cidade":"Richmond, Austr\u00e1lia","codigo":"RCM"},{"cidade":"Richmond, Estados Unidos da Am\u00e9rica, Richmond International","codigo":"RIC"},{"cidade":"Riga, Let\u00f4nia, Riga International","codigo":"RIX"},{"cidade":"Rigolet, Canad\u00e1, Rigolet","codigo":"YRG"},{"cidade":"Rijeka, Cro\u00e1cia, Rijeka","codigo":"RJK"},{"cidade":"Rimini, It\u00e1lia, Miramare","codigo":"RMI"},{"cidade":"Rio Branco, Brasil, Pl\u00e1cido de Castro","codigo":"RBR"},{"cidade":"Rio Cuarto, Argentina, Las Higueras","codigo":"RCU"},{"cidade":"Rio de Janeiro, Brasil, Gale\u00e3o","codigo":"GIG"},{"cidade":"Rio de Janeiro, Brasil, Santos Dumont","codigo":"SDU"},{"cidade":"Rio de Janeiro, Brasil , Todos Aeroportos","codigo":"RIO"},{"cidade":"Rio Gallegos, Argentina, Piloto N. Fernandez","codigo":"RGL"},{"cidade":"Rio Grande, Argentina, Hermes Quijada","codigo":"RGA"},{"cidade":"Riohacha, Col\u00f4mbia,Padilla","codigo":"RCH"},{"cidade":"Rio Hato, Panam\u00e1, Scarlett Martinez","codigo":"RIH"},{"cidade":"Rio Hondo, Argentina, Termas de Rio Hondo","codigo":"RHD"},{"cidade":"Rio Verde, Brasil, Leite de Castro","codigo":"RVD"},{"cidade":"Rishiri, Jap\u00e3o, Rishiri","codigo":"RIS"},{"cidade":"Riverton, Estados Unidos da Am\u00e9rica, Riverton Regional","codigo":"RIW"},{"cidade":"Rizhao, China, Shanzihe","codigo":"RIZ"},{"cidade":"Roanoke, Estados Unidos da Am\u00e9rica, Roanoke Regional","codigo":"ROA"},{"cidade":"Roatan, Honduras, Juan Manuel Galvez","codigo":"RTB"},{"cidade":"Rochester, Estados Unidos da Am\u00e9rica, Greater Rochester","codigo":"ROC"},{"cidade":"Rochester, Estados Unidos da Am\u00e9rica, Rochester","codigo":"RST"},{"cidade":"Rockhampton, Austr\u00e1lia","codigo":"ROK"},{"cidade":"Rockland, Estados Unidos da Am\u00e9rica, Knox Countyt","codigo":"RKD"},{"cidade":"Rock Sound, Bahamas, Rock Sound","codigo":"RSD"},{"cidade":"Rodez, Fran\u00e7a, Marcillac","codigo":"RDZ"},{"cidade":"Rodrigues Island, Ilhas Mauricio, Plane Corail","codigo":"RRG"},{"cidade":"Roervik, Noruega, Ryum","codigo":"RVK"},{"cidade":"Roi Et, Muang, Tail\u00e2ndia, Roi Et Airport","codigo":"ROI"},{"cidade":"Rokot, Indon\u00e9sia, Sipora","codigo":"RKI"},{"cidade":"Roma, Austr\u00e1lia","codigo":"RMA"},{"cidade":"Roma, It\u00e1lia, Ciampino","codigo":"CTA"},{"cidade":"Roma, It\u00e1lia, Fiumicino","codigo":"FCO"},{"cidade":"Roma, It\u00e1lia - Todos Aeroportos","codigo":"ROM"},{"cidade":"Rondon\u00f3polis, Brasil, Maestro Marinho Franco","codigo":"ROO"},{"cidade":"Ronneby, Karlskrona, Su\u00e9cia, kallinge","codigo":"RNB"},{"cidade":"Roros, Noruega, Roros","codigo":"RRS"},{"cidade":"Rosario, Argentina, Islas Malvinas","codigo":"ROS"},{"cidade":"Rost, Noruega, Rost","codigo":"RET"},{"cidade":"Rostock, Laage, Alemanha, Laage","codigo":"RLG"},{"cidade":"Rostov, R\u00fassia, Platov","codigo":"ROV"},{"cidade":"Roterd\u00e3, Holanda, Rotterdam","codigo":"RTM"},{"cidade":"Roti, Indon\u00e9sia, David C. Saudale","codigo":"RTI"},{"cidade":"Rouen, Fran\u00e7a, Vallee de Seine","codigo":"URO"},{"cidade":"Rourkela, \u00cdndia, Rourkela","codigo":"RRK"},{"cidade":"Rouyn Noranda, Canad\u00e1, Rouyn Noranda","codigo":"YUY"},{"cidade":"Rovaniemi, Finl\u00e2ndia, Rovaniemi","codigo":"RVN"},{"cidade":"Roxas City, Filipinas, Roxas","codigo":"RXS"},{"cidade":"Rundu, Nam\u00edbia, Rundu","codigo":"NDU"},{"cidade":"Ruoqiang, China, Loulan","codigo":"RQA"},{"cidade":"Rurrenabaque, Bol\u00edvia, Rurrenabaque","codigo":"RBQ"},{"cidade":"Ruteng, Indon\u00e9sia, Frans Sales Lega","codigo":"RTG"},{"cidade":"Rzeszow, Polonia, Jasionka","codigo":"RZE"},{"cidade":"Saarbrucken, Alemanha, Saarbrucken Airport","codigo":"SCN"},{"cidade":"Sabang, Indon\u00e9sia, Maimun Saleh","codigo":"SBG"},{"cidade":"Sabetta, R\u00fassia, Sabetta International","codigo":"SBT"},{"cidade":"Sabha, L\u00edbia, Sebha","codigo":"SEB"},{"cidade":"Sabzevar, Ir\u00e3, Sabzevar","codigo":"AFZ"},{"cidade":"Sacramento, Estados Unidos da Am\u00e9rica, Sacramento","codigo":"SMF"},{"cidade":"Saga, Jap\u00e3o, Saga Airport","codigo":"HSG"},{"cidade":"Saginaw, Estados Unidos da Am\u00e9rica, MBS","codigo":"MBS"},{"cidade":"Saguenay Bagotville, Canad\u00e1, Saguenay Bagotville","codigo":"YBG"},{"cidade":"Saibai Island, Austr\u00e1lia","codigo":"SBR"},{"cidade":"Saidpur, Bangladesh, Saidpur","codigo":"SPD"},{"cidade":"Saint Augustin, Pakuaship, Canad\u00e1, Saint Augustin","codigo":"YIF"},{"cidade":"Saint Croix, Christiansted, Virgin Islands Estados Unidos, Henry e Rohlsen","codigo":"STX"},{"cidade":"Sainte-Marie, Madag\u00e1scar, Sainte Marie","codigo":"SMS"},{"cidade":"Saint George, Estados Unidos da Am\u00e9rica, St. George Municipal","codigo":"SGU"},{"cidade":"Saint John, Canad\u00e1, Saint John","codigo":"YSJ"},{"cidade":"Saint Laurent du Maroni, Guiana Francesa, Saint Laurent du Maroni","codigo":"LDX"},{"cidade":"Saint Martin, Holanda, Princess Juliana","codigo":"SXM"},{"cidade":"Saint Thomas Island, Charlotte Amalie, Virgin Islands Estados Unidos, Cyril E. King","codigo":"STT"},{"cidade":"Saipan, Northern Mariana Islands,\u00a0Francisco C. Ada International","codigo":"SPN"},{"cidade":"Sakkyryr, R\u00fassia, Sakkyryr","codigo":"SUK"},{"cidade":"Sakon Nakhon, Tail\u00e2ndia, Sakon Nakhon","codigo":"SNO"},{"cidade":"Salalah, Om\u00e3, Salalah","codigo":"SLL"},{"cidade":"Salamanca, Espanha, Salamanca Airport","codigo":"SLM"},{"cidade":"Salekhard, R\u00fassia, Salekhard","codigo":"SLY"},{"cidade":"Salem, \u00cdndia, Salem","codigo":"SXV"},{"cidade":"Salenl, Su\u00e9cia, Scandinavian Mountains Airport","codigo":"SCR"},{"cidade":"Salina Cruz, M\u00e9xico, Salina Cruz","codigo":"SCX"},{"cidade":"Salinas, Equador, General Ulpiano Paez","codigo":"SNC, Equador"},{"cidade":"Salisbury, Estados Unidos da Am\u00e9rica, Wicomico","codigo":"SBY"},{"cidade":"Salluit, Canad\u00e1, Salluit","codigo":"YZG"},{"cidade":"Salta, Argentina, Martin M. de Guemes","codigo":"SLA"},{"cidade":"Saltillo, M\u00e9xico, Plan de Guadalupe","codigo":"SLW"},{"cidade":"Salt Lake City, Estados Unidos da Am\u00e9rica, Salt Lake City International","codigo":"SLC"},{"cidade":"Salvador, Brasil, D.L.E. Magalh\u00e3es","codigo":"SSA"},{"cidade":"Salzburg, \u00c1ustria, W.A. Mozart","codigo":"SZG"},{"cidade":"Samana, Rep\u00fablica Dominicana, El Catey International","codigo":"AZS"},{"cidade":"Samara, R\u00fassia, Kurumoch","codigo":"KUF"},{"cidade":"Samarinda, Indon\u00e9sia","codigo":"AAP"},{"cidade":"Samarkand, Uzbequist\u00e3o, Samarkand","codigo":"SKD"},{"cidade":"Sambava, Madag\u00e1scar, Sambava","codigo":"SVB"},{"cidade":"Samburu, Qu\u00eania, Buffalo Spring","codigo":"UAS"},{"cidade":"Sam Neua, Laos, Sam Neua","codigo":"NEU"},{"cidade":"Samos, Gr\u00e9cia, Aristarchos Of Samos","codigo":"SMI"},{"cidade":"Sampit, Indon\u00e9sia, H. Asan","codigo":"SMQ"},{"cidade":"Samsun, Turquia, Carsamba","codigo":"SZF"},{"cidade":"Sanaa, I\u00eamen, Sanaa International","codigo":"SAH"},{"cidade":"Sanana, Indon\u00e9sia, Emalamo","codigo":"SQN"},{"cidade":"Sanandaj, Ir\u00e3, Sanandaj","codigo":"SDG"},{"cidade":"San Andres, Col\u00f4mbia, Gustavo R Pinilla","codigo":"ADZ"},{"cidade":"San Andros, Bahamas, San Andros","codigo":"SAQ"},{"cidade":"San Angelo, Estados Unidos da Am\u00e9rica, Regional Mathis Field","codigo":"SJT"},{"cidade":"San Antonio, Estados Unidos da Am\u00e9rica, San Antonio International","codigo":"SAT"},{"cidade":"San Cristobal, Equador, San Cristobal","codigo":"SCY, Equador"},{"cidade":"Sandakan, Mal\u00e1sia, Sandakan","codigo":"SDK"},{"cidade":"Sandane, Noruega, Anda","codigo":"SDN"},{"cidade":"San Diego, Estados Unidos da Am\u00e9rica, San Diego","codigo":"SAN"},{"cidade":"Sandnessjoen, Noruega, Stokka","codigo":"SSJ"},{"cidade":"Sandspit, Canad\u00e1","codigo":"YZP"},{"cidade":"Sandy Lake, Canad\u00e1, Sandy Lake","codigo":"ZSJ"},{"cidade":"San Fernando de Apure, Venezuela, Las Flecheras","codigo":"SFD"},{"cidade":"San Ignacio, Belize, Matthew Spain","codigo":"SQS"},{"cidade":"Sanikiluaq, Canad\u00e1, Sanikiluaq","codigo":"YSK"},{"cidade":"San Isidro, Costa Rica, San Isidro","codigo":"IPZ"},{"cidade":"San Jose, Costa Rica, Juan Santamaria","codigo":"SJO"},{"cidade":"San Jose, Costa Rica, TOBIAS BOLANOS International","codigo":"SYQ"},{"cidade":"San Jose, Filipinas, San Jose","codigo":"SJI"},{"cidade":"San Jose Island, Panam\u00e1, San Jose Island","codigo":"SIC"},{"cidade":"San Juan, Argentina, Domingo F. Sarmiento","codigo":"UAQ"},{"cidade":"San Juan, Porto Rico, Fernando Luis Ribas Dominicci","codigo":"SIG"},{"cidade":"San Juan, Porto Rico, Luis Mu\u00f1oz Mar\u00edn International","codigo":"SJU"},{"cidade":"Sanliurfa, Turquia, Guney Anadolu","codigo":"GNY"},{"cidade":"San Luis, Argentina, D. Cesar Raul Ojeda","codigo":"LUQ"},{"cidade":"San Luis Obispo, Estados Unidos da Am\u00e9rica, McChesney Field","codigo":"SBP"},{"cidade":"San Luis Potosi, M\u00e9xico, Ponciano Arriaga","codigo":"SLP"},{"cidade":"San Martin de Los Andes, Argentina, Aviador Carlos Campos","codigo":"CPC"},{"cidade":"Sanming, China, Shaxian","codigo":"SQJ"},{"cidade":"San Pedro, Belize, San Pedro","codigo":"SPR"},{"cidade":"San Pedro, Costa do Marfim, San Pedro","codigo":"SPY"},{"cidade":"San Pedro Sula, Honduras, Ramon V. Morales","codigo":"SAP"},{"cidade":"San Rafael, Argentina, San Rafael","codigo":"AFA"},{"cidade":"San Salvador, Bahamas, Cockburn Town","codigo":"ZSA"},{"cidade":"San Salvador, El Salvador, El Salvador International","codigo":"SAL"},{"cidade":"San Sebastian, Espanha, San Sebastian Airport","codigo":"EAS"},{"cidade":"San Sebastian Gomera, Espanha, La Gomera","codigo":"GMZ"},{"cidade":"Santa Ana, Estados Unidos da Am\u00e9rica, John Wayne","codigo":"SNA"},{"cidade":"Santa B\u00e1rbara, Estados Unidos da Am\u00e9rica, Santa B\u00e1rbara","codigo":"SBA"},{"cidade":"Santa Clara, Cuba, Abel Santamaria","codigo":"SNU"},{"cidade":"Santa Cruz, Bol\u00edvia, Viru Viru","codigo":"VVI"},{"cidade":"Santa Cruz de La Palma, Espanha, La Palma","codigo":"SPC"},{"cidade":"Santa Fe, Argentina, Sauce Viejo","codigo":"SFN"},{"cidade":"Santa Fe, Estados Unidos da Am\u00e9rica, Santa Fe","codigo":"SAF"},{"cidade":"Santa Maria, Estados Unidos da Am\u00e9rica, Capt G. Allan Hancock Field","codigo":"SMX"},{"cidade":"Santa Maria Island, Portugal, Santa Maria Island","codigo":"SMA"},{"cidade":"Santa Marta, Col\u00f4mbia, Simon Bolivar","codigo":"SMR"},{"cidade":"Santander, Espanha, Santander Airport","codigo":"SDR"},{"cidade":"Santar\u00e9m, Brasil, Maestro Wilson Fonseca","codigo":"STM"},{"cidade":"Santa Rosa, Argentina, Santa Rosa","codigo":"RSA"},{"cidade":"Santa Rosa, Equador, Santa Rosa","codigo":"ETR, Equador"},{"cidade":"Santiago, Chile, Internacional, Arturo Merino Ben\u00edtez","codigo":"SCL"},{"cidade":"Santiago de Compostela, Espanha, Santiago de Compostela","codigo":"SCQ"},{"cidade":"Santiago de Cuba, Cuba, Antonio Maceo","codigo":"SCU"},{"cidade":"Santiago del Estero, Argentina, A. De La Paz Aragonez","codigo":"SDE"},{"cidade":"Santiago, Rep\u00fablica Dominicana, Cibao International","codigo":"STI"},{"cidade":"Santo Domingo, Rep\u00fablica Dominicana, La Isabela Joaquin Balanguer","codigo":"JBQ"},{"cidade":"Santo Domingo, Rep\u00fablica Dominicana, Las Americas","codigo":"SDQ"},{"cidade":"Santo Domingo, Venezuela, Buenaventura Vivas","codigo":"STD"},{"cidade":"San Tome, Venezuela, San Tome, ","codigo":"SOM"},{"cidade":"San Vicente, Filipinas","codigo":"SWL"},{"cidade":"Sanya, China, Phoenix International","codigo":"SYX"},{"cidade":"S\u00e3o Filipe, Cabo Verde, Sao Filipe","codigo":"SFL"},{"cidade":"S\u00e3o Francisco, Estados Unidos da Am\u00e9rica, S\u00e3o Francisco","codigo":"SFO"},{"cidade":"S\u00e3o Jorge Island, Portugal, S\u00e3o Jorge","codigo":"SJZ"},{"cidade":"S\u00e3o Jos\u00e9 dos Campos, Brasil, S\u00e3o Jos\u00e9 dos Campos","codigo":"SJK"},{"cidade":"S\u00e3o Jos\u00e9, Estados Unidos da Am\u00e9rica, S\u00e3o Jos\u00e9","codigo":"SJC"},{"cidade":"S\u00e3o Luiz, Brasil, Cunha Machado","codigo":"SLZ"},{"cidade":"S\u00e3o Paulo, Brasil, Congonhas","codigo":"CGH"},{"cidade":"S\u00e3o Paulo, Brasil, Guarulhos","codigo":"GRU"},{"cidade":"S\u00e3o Paulo, Brasil , Todos aeroportos","codigo":"SAO"},{"cidade":"S\u00e3o Paulo, Brasil, Viracopos Campinas","codigo":"VCP"},{"cidade":"S\u00e3o Petersburgo, Estados Unidos da Am\u00e9rica, S\u00e3o Petersburgo-Clearwater","codigo":"PIE"},{"cidade":"S\u00e3o Petersburgo, R\u00fassia, Pulkovo","codigo":"LED"},{"cidade":"S\u00e3o Tom\u00e9, S\u00e3o Tom\u00e9 e Pr\u00edncipe, International","codigo":"TMS"},{"cidade":"Sapporo, Jap\u00e3o, New Chitose","codigo":"CTS"},{"cidade":"Sapporo, Jap\u00e3o, Okada","codigo":"OKD"},{"cidade":"Sapporo, Jap\u00e3o , Todos Aeroportos","codigo":"SPK"},{"cidade":"Sarago\u00e7a, Espanha, Zaragoza","codigo":"ZAZ"},{"cidade":"Sarajevo, B\u00f3snia e Herzegovina, Sarajevo International","codigo":"SJJ"},{"cidade":"Saransk, R\u00fassia, Saransk","codigo":"SKX"},{"cidade":"Sarasota\u00a0, \u00a0Bradenton, Estados Unidos da Am\u00e9rica, Sarasota-Bradenton","codigo":"SRQ"},{"cidade":"Saratov, R\u00fassia, Gagarin","codigo":"GSV"},{"cidade":"Sarnia, Canad\u00e1, Chris Hadfield","codigo":"YZR"},{"cidade":"Sary, Ir\u00e3, Dashte Naz","codigo":"SRY"},{"cidade":"Saskatoon, Canad\u00e1, J.G Diefenbaker","codigo":"YXE"},{"cidade":"Saskylakh, R\u00fassia, Saskylakh","codigo":"SYS"},{"cidade":"Satu Mare, Rom\u00eania, Satu Mare","codigo":"SUJ"},{"cidade":"Saul, Guiana Francesa, Saul","codigo":"XAU"},{"cidade":"Sault Ste. Marie, Estados Unidos da Am\u00e9rica, Chippewa County","codigo":"CIU"},{"cidade":"Saumlaki, Indon\u00e9sia, Olilit","codigo":"SXK"},{"cidade":"Saurimo,\u00a0Angola, Saurimo","codigo":"VHC"},{"cidade":"Savannah, Estados Unidos da Am\u00e9rica, Hilton Head","codigo":"SAV"},{"cidade":"Savannakhet, Laos, Savannakhet","codigo":"ZVK"},{"cidade":"Savonlinna, Finl\u00e2ndia, Savonlinna","codigo":"SVL"},{"cidade":"Sawan, Paquist\u00e3o, Sawan","codigo":"RZS"},{"cidade":"Sawu, Indon\u00e9sia, Tardamu","codigo":"SAU"},{"cidade":"Sayaboury, Laos, Sayaboury","codigo":"ZBY"},{"cidade":"Schefferville, Canad\u00e1, Schefferville","codigo":"YKL"},{"cidade":"Seattle, Estados Unidos da Am\u00e9rica, Seattle-Tacoma International","codigo":"SEA"},{"cidade":"Seiyun, I\u00eamen, Sayun","codigo":"GXF"},{"cidade":"Semarang, Indon\u00e9sia, Ahmad Yani","codigo":"SRG"},{"cidade":"Semera, Eti\u00f3pia, Semera","codigo":"SZE"},{"cidade":"Semey, Cazaquist\u00e3o, Semey","codigo":"PLX"},{"cidade":"Sendai, Jap\u00e3o, Sendai","codigo":"SDJ"},{"cidade":"Sept Iles, Canad\u00e1, Sept Iles","codigo":"YZV"},{"cidade":"Seronera, Tanz\u00e2nia, Seronera","codigo":"SEU"},{"cidade":"Serui, Indon\u00e9sia","codigo":"ZRI"},{"cidade":"Setif, Arg\u00e9lia, Setif","codigo":"QSF"},{"cidade":"Seul, Cor\u00e9ia do Sul, Gimpo International","codigo":"GMP"},{"cidade":"Seul, Cor\u00e9ia do Sul, Incheon International","codigo":"ICN"},{"cidade":"Seul, Cor\u00e9ia do Sul , Todos Aeroportos","codigo":"SEL"},{"cidade":"Sevilha, Espanha, Sevilla Airport","codigo":"SVQ"},{"cidade":"Sfax, Tun\u00edsia, Thyna","codigo":"SFA"},{"cidade":"Shache, China, Yeerqiang","codigo":"QSZ"},{"cidade":"Shahre Kord, Ir\u00e3, Shahre Kord","codigo":"CQD"},{"cidade":"Shahrud, Ir\u00e3, Shahrud","codigo":"RUD"},{"cidade":"Shakhtersk, R\u00fassia, Shakhtersk","codigo":"EKS"},{"cidade":"Shangrao, China, Sanqingshan","codigo":"SQD"},{"cidade":"Shannon, Irlanda, Shannon, Irlanda","codigo":"SNN"},{"cidade":"Shantou, China, Jieyang Chaoshan","codigo":"SWA"},{"cidade":"Shaoyang, China, Wugang","codigo":"WGN"},{"cidade":"Sharjah, Emirados \u00c1rabes Unidos","codigo":"SHJ"},{"cidade":"Sharm el Sheikh, Egito, Sharm el Sheikh International","codigo":"SSH"},{"cidade":"Sharurah, Ar\u00e1bia Saudita, Sharudah","codigo":"SHW"},{"cidade":"Shennongjia, China, Hongping","codigo":"HPG"},{"cidade":"Shenyang, China, Taoxian International","codigo":"SHE"},{"cidade":"Shenzhen, China, Bao An International","codigo":"SZX"},{"cidade":"Sheridan, Estados Unidos da Am\u00e9rica, Sheridan County","codigo":"SHR"},{"cidade":"Shetland Islands, Reino Unido, Sumburgh","codigo":"LSI"},{"cidade":"Shihezi, China, Shanhaiguan Huayuan","codigo":"SHF"},{"cidade":"Shijiazhuang, China, Zhengding International","codigo":"SJW"},{"cidade":"Shillavo, Eti\u00f3pia, Shilabo","codigo":"HIL"},{"cidade":"Shillong, \u00cdndia, Barapani","codigo":"SHL"},{"cidade":"Shimla, \u00cdndia, Shimla","codigo":"SLV"},{"cidade":"Shiquanhe, China, Ngari Gunsa Ali Kunsha","codigo":"NGQ"},{"cidade":"Shirahama, Jap\u00e3o, Nanki Shirahama","codigo":"SHM"},{"cidade":"Shiraz, Ir\u00e3, Shahid Dastghaib","codigo":"SYZ"},{"cidade":"Shirdi, \u00cdndia, Shirdi","codigo":"SAG"},{"cidade":"Shiyan, China, Wudangshan","codigo":"WDS"},{"cidade":"Shizuoka, Jap\u00e3o, Mount Fuji","codigo":"FSZ"},{"cidade":"Shonai, Jap\u00e3o, Shonai","codigo":"SYO"},{"cidade":"Shoreham By Sea, Reino Unido, Shoreham By Sea","codigo":"ESH"},{"cidade":"Shreveport, Estados Unidos da Am\u00e9rica, Shreveport","codigo":"SHV"},{"cidade":"Shymkent, Cazaquist\u00e3o, Shymkent International","codigo":"CIT"},{"cidade":"Sialkot, Paquist\u00e3o, International","codigo":"SKT"},{"cidade":"Sibiu, Rom\u00eania, Sibiu","codigo":"SBZ"},{"cidade":"Sibolga, Indon\u00e9sia, Ferdinand","codigo":"FLZ"},{"cidade":"Siborong Borong, Indon\u00e9sia, Silangit","codigo":"DTB"},{"cidade":"Sibu, Mal\u00e1sia, Sibu","codigo":"SBW"},{"cidade":"Sicogon Island, Filipinas","codigo":"ICO"},{"cidade":"Sidney, Estados Unidos da Am\u00e9rica, Richland","codigo":"SDY"},{"cidade":"Siem Reap, Camboja, Angkor International","codigo":"REP"},{"cidade":"Siena, It\u00e1lia, Ampugnano","codigo":"SAY"},{"cidade":"Sigiriya, Sri Lanka, Sigiriya","codigo":"GIU"},{"cidade":"Sihanoukville, Camboja, International","codigo":"KOS"},{"cidade":"Siirt, Turquia, Siirt","codigo":"SXZ"},{"cidade":"Silchar, \u00cdndia, Kumbhirgram","codigo":"IXS"},{"cidade":"Simao, China, Simao","codigo":"SYM"},{"cidade":"Simara, Nepal, Simara","codigo":"SIF"},{"cidade":"Simferopol, Ucr\u00e2nia, Simferopol International","codigo":"SIP"},{"cidade":"Simikot, Nepal, Simikot","codigo":"IMK"},{"cidade":"Singapore, Singapura, Changi Airport","codigo":"SIN"},{"cidade":"Singapore, Singapura, Seletar Airport","codigo":"XSP"},{"cidade":"Singkep, Indon\u00e9sia, Dabo","codigo":"SIQ"},{"cidade":"Sinop, Brasil, Joao B. Figueiredo","codigo":"OPS"},{"cidade":"Sinop, Turquia, Sinop","codigo":"NOP"},{"cidade":"Sintang, Indon\u00e9sia, Susilo","codigo":"SQG"},{"cidade":"Sion, Su\u00ed\u00e7a, Sion","codigo":"SIR"},{"cidade":"Sioux City, Estados Unidos da Am\u00e9rica, Sioux Gateway","codigo":"SUX"},{"cidade":"Sioux Falls, Estados Unidos da Am\u00e9rica, Joe Foss Field","codigo":"FSD"},{"cidade":"Sioux Lookout, Canad\u00e1, Sioux Lookout","codigo":"YXL"},{"cidade":"Sirjan, Ir\u00e3, Sirjan","codigo":"SYJ"},{"cidade":"Sirnak, Turquia, Sirnak","codigo":"NKT"},{"cidade":"Sishen, \u00c1frica do Sul, Sishen","codigo":"SIS"},{"cidade":"Siteia, Gr\u00e9cia, Siteia","codigo":"JSH"},{"cidade":"Sitka, Estados Unidos da Am\u00e9rica, Sitka Rocky Gutierrez","codigo":"SIT"},{"cidade":"Sittwe, Mianmar, Sittwe","codigo":"AKY"},{"cidade":"Sivas, Turquia, Sivas","codigo":"VAS"},{"cidade":"Skardu, Paquist\u00e3o, Skardu","codigo":"KDU"},{"cidade":"Skelleftea, Su\u00e9cia, Skelleftea","codigo":"SFT"},{"cidade":"Skiathos, Gr\u00e9cia, Alex Papadiamants","codigo":"JSI"},{"cidade":"Skopje, Maced\u00f4nia, Skopje","codigo":"SKP"},{"cidade":"Skovde, Su\u00e9cia, Skovde","codigo":"KVB"},{"cidade":"Skukuza, \u00c1frica do Sul, Skukuza","codigo":"SZK"},{"cidade":"Skyros, Gr\u00e9cia, Skyros","codigo":"SKU"},{"cidade":"Sliac, Eslov\u00e1quia, Sliac","codigo":"SLD"},{"cidade":"Sligo, Irlanda, Sligo","codigo":"SXL"},{"cidade":"Smithers, Canad\u00e1, Smithers","codigo":"YYD"},{"cidade":"S\u00f3chi, R\u00fassia, S\u00f3chi International","codigo":"AER"},{"cidade":"Socotra, I\u00eamen, Socotra","codigo":"SCT"},{"cidade":"Sofia, Bulg\u00e1ria, Sofia","codigo":"SOF"},{"cidade":"Sogndal, Noruega, Haukasen","codigo":"SOG"},{"cidade":"Sohag, Egito, International","codigo":"HMB"},{"cidade":"Sohar, Om\u00e3, Sohar","codigo":"OHS"},{"cidade":"Sokoto, Nig\u00e9ria, Sadiq Abubakar","codigo":"SKO"},{"cidade":"Solovetsky, R\u00fassia, Solovki","codigo":"CSH"},{"cidade":"Solwezi, Z\u00e2mbia, Solwezi","codigo":"SLI"},{"cidade":"Sonderborg, Dinamarca, Sonderborg","codigo":"SGD"},{"cidade":"Songea, Tanz\u00e2nia, Sonega","codigo":"SGX"},{"cidade":"Songyuan, China, Chaganhu","codigo":"YSQ"},{"cidade":"Sorkjosen, Noruega, Sorkjosen","codigo":"SOJ"},{"cidade":"Sorong, Indon\u00e9sia, Domine Eduard Osok","codigo":"SOQ"},{"cidade":"Sorriso, Brasil, Sorriso","codigo":"SMT"},{"cidade":"Southampton, Reino Unido, Southampton","codigo":"SOU"},{"cidade":"South Bend, Estados Unidos da Am\u00e9rica, South Bend","codigo":"SBN"},{"cidade":"Sovetsky, R\u00fassia, Sovetsky","codigo":"OVS"},{"cidade":"Soyo,\u00a0Angola, Soyo","codigo":"SZA"},{"cidade":"Split, Cro\u00e1cia, Split","codigo":"SPU"},{"cidade":"Spokane, Estados Unidos da Am\u00e9rica, Spokane International","codigo":"GEG"},{"cidade":"Springfield, Estados Unidos da Am\u00e9rica, Abraham Lincoln Capital","codigo":"SPI"},{"cidade":"Springfield, Estados Unidos da Am\u00e9rica, Springfield Branson","codigo":"SGF"},{"cidade":"Spring Point, Bahamas, Spring Point","codigo":"AXP"},{"cidade":"Srednekolymsk, R\u00fassia, Srednekolymsk","codigo":"SEK"},{"cidade":"Srinagar, \u00cdndia, Sheikh Ul Alam","codigo":"SXR"},{"cidade":"St. Augustine, Estados Unidos da Am\u00e9rica, Northeast Fl\u00f3rida","codigo":"UST"},{"cidade":"Stavanger, Noruega, Sola","codigo":"SVG"},{"cidade":"Stavropol, R\u00fassia, Shpakovskoye","codigo":"STW"},{"cidade":"St. Cloud, Estados Unidos da Am\u00e9rica, St. Cloud","codigo":"STC"},{"cidade":"Stella Maris, Bahamas, Stella Maris","codigo":"SML"},{"cidade":"Stephenville, Canad\u00e1, International","codigo":"YJT"},{"cidade":"St. George, Austr\u00e1lia","codigo":"SGO"},{"cidade":"St. John, Canad\u00e1, St. Johns","codigo":"YYT"},{"cidade":"St. Lewis Fox Harbour, Canad\u00e1, St. Lewis","codigo":"YFX"},{"cidade":"St. Louis, Estados Unidos da Am\u00e9rica, Lambert","codigo":"STL"},{"cidade":"St. Lucia, Santa L\u00facia, George F.L. Charles","codigo":"SLU"},{"cidade":"St. Lucia, Santa L\u00facia, Hewanorra","codigo":"UVF"},{"cidade":"St. Nazaire, Fran\u00e7a, Montoir","codigo":"SNR"},{"cidade":"Stockton, Estados Unidos da Am\u00e9rica, Metropolitano de Stockton","codigo":"SCK"},{"cidade":"Stokmarknes, Noruega, Skagen","codigo":"SKN"},{"cidade":"Stord, Noruega, Sorstokken","codigo":"SRP"},{"cidade":"Stornoway, Reino Unido, Sotornoway","codigo":"SYY"},{"cidade":"St Tropez, Fran\u00e7a, La Mole","codigo":"LTT"},{"cidade":"Stuttgart\u00a0, Alemanha, Stuttgart Airport","codigo":"STR"},{"cidade":"St. Vincent, S\u00e3o Vicente e Granadinas, Argyle","codigo":"SVD"},{"cidade":"Subic Bay, Filipinas","codigo":"SFS"},{"cidade":"Suceava, Rom\u00eania, Stefan Cel Mare","codigo":"SCV"},{"cidade":"Sucre, Bol\u00edvia, Alcantari","codigo":"SRE"},{"cidade":"Sudbury, Canad\u00e1, Sudbury","codigo":"YSB"},{"cidade":"Sue Island Warraber, Austr\u00e1lia","codigo":"SYU"},{"cidade":"Sukhothai, Tail\u00e2ndia, Sukhothai","codigo":"THS"},{"cidade":"Sukkur, Paquist\u00e3o, Sukkur","codigo":"SKZ"},{"cidade":"Suleimania, Iraque, Sulaymaniyah","codigo":"ISU"},{"cidade":"Sumenep, Indon\u00e9sia, Trunojoyo","codigo":"SUP"},{"cidade":"Sunchales, Argentina, Sunchales","codigo":"NCJ"},{"cidade":"Sun City, \u00c1frica do Sul, Pilanesberg International, -","codigo":"NTY"},{"cidade":"Sundsvall, Harnosand, Su\u00e9cia, Sundsvall Timra","codigo":"SDL"},{"cidade":"Sunshine Coast, Austr\u00e1lia, Maroochydore","codigo":"MCY"},{"cidade":"Suntar, R\u00fassia, Suntar","codigo":"SUY"},{"cidade":"Sunyani, Gana, Sunyani","codigo":"NYI"},{"cidade":"Surabaia, Indon\u00e9sia, Juanda","codigo":"SUB"},{"cidade":"Surakarta, Solo, Indon\u00e9sia, Adi Sumarmo","codigo":"SOC"},{"cidade":"Surat, \u00cdndia, Surat","codigo":"STV"},{"cidade":"Surat Thani, Tail\u00e2ndia, Surat Thani","codigo":"URT"},{"cidade":"Surgut, R\u00fassia, Surgut","codigo":"SGC"},{"cidade":"Surigao, Filipinas, Surigao","codigo":"SUG"},{"cidade":"Surkhet, Nepal, Surkhet","codigo":"SKH"},{"cidade":"Suzhou, China, Guangfu","codigo":"SZV"},{"cidade":"Sveg, Su\u00e9cia, Sveg","codigo":"EVG"},{"cidade":"Svetlaya, R\u00fassia, Svetlaya","codigo":"ETL"},{"cidade":"Svolv\u00e6r, Noruega, Helle","codigo":"SVJ"},{"cidade":"Swansea, Reino Unido, Swansea","codigo":"SWS"},{"cidade":"Sydney, Austr\u00e1lia, Kingsford Smith","codigo":"SYD"},{"cidade":"Sydney, Canad\u00e1, J.A. Douglas Mccurdy","codigo":"YQY"},{"cidade":"Syktyvkar, R\u00fassia, Syktyvkar","codigo":"SCW"},{"cidade":"Sylhet, Bangladesh, Osmani International","codigo":"ZYL"},{"cidade":"Syracuse, Estados Unidos da Am\u00e9rica, Syracuse","codigo":"SYR"},{"cidade":"Syros Island, Gr\u00e9cia, Dimitrios Vikelas","codigo":"JSY"},{"cidade":"Szczecin, Polonia, Goleniow","codigo":"SZZ"},{"cidade":"Szczytno, Polonia, Szymany","codigo":"SZY"},{"cidade":"Taba, Egito, Taba International","codigo":"TCP"},{"cidade":"Tabarka, Tun\u00edsia, Ain Drahan","codigo":"TBJ"},{"cidade":"Tabas, Ir\u00e3, Tabas","codigo":"TCX"},{"cidade":"Tabatinga, Brasil, Tabatinga","codigo":"TBT"},{"cidade":"Tablas Island, Filipinas, Tugdan","codigo":"TBH"},{"cidade":"Tabora, Tanz\u00e2nia, Tabora","codigo":"TBO"},{"cidade":"Tabriz, Ir\u00e3, Tabriz International","codigo":"TBZ"},{"cidade":"Tabuk, Ar\u00e1bia Saudita, Tabuk","codigo":"TUU"},{"cidade":"Tacheng, China, Tacheng","codigo":"TCG"},{"cidade":"Tachilek, Mianmar, Tachilek","codigo":"THL"},{"cidade":"Tacloban, Filipinas","codigo":"TAC"},{"cidade":"Tacna, Peru, Ciriani Santa Rosa","codigo":"TCQ"},{"cidade":"Taif, Ar\u00e1bia Saudita, Taif","codigo":"TIF"},{"cidade":"Taiyuan, China, Wusu International","codigo":"TYN"},{"cidade":"Taizhou, China, Luqiao","codigo":"HYN"},{"cidade":"Takamatsu, Jap\u00e3o, Takamatsu","codigo":"TAK"},{"cidade":"Takoradi, Gana, Takoradi","codigo":"TKD"},{"cidade":"Talakan, R\u00fassia, Talakan","codigo":"TLK"},{"cidade":"Talara, Peru, Victor Monteas, Arias","codigo":"TYL"},{"cidade":"Taldykorgan, Cazaquist\u00e3o, Taldykorgan","codigo":"TDK"},{"cidade":"Tallahassee, Estados Unidos da Am\u00e9rica, Tallahassee","codigo":"TLH"},{"cidade":"Tallin, Est\u00f4nia, Lennart Meri","codigo":"TLL"},{"cidade":"Tamale, Gana, Tamale, ","codigo":"TML"},{"cidade":"Tamanrasset, Arg\u00e9lia","codigo":"TMR"},{"cidade":"Tamarindo, Costa Rica, Tamarindo","codigo":"TNO"},{"cidade":"Tambolaka, Indon\u00e9sia, Waikabubak","codigo":"TMC"},{"cidade":"Tambov, R\u00fassia, Donskoye","codigo":"TBW"},{"cidade":"Tamchy, Quirguist\u00e3o, Issyk-Kul","codigo":"IKU"},{"cidade":"Tampa, Estados Unidos da Am\u00e9rica, Tampa","codigo":"TPA"},{"cidade":"Tampere, Finl\u00e2ndia, Pirkkala","codigo":"TMP"},{"cidade":"Tampico, M\u00e9xico, Francisco Javier Mina","codigo":"TAM"},{"cidade":"Tamworth, Austr\u00e1lia","codigo":"TMW"},{"cidade":"Tanahmerah, Indon\u00e9sia, Tanahmerah","codigo":"TMH"},{"cidade":"Tana Toraja, Indon\u00e9sia, Pongtiku","codigo":"TTR"},{"cidade":"Tandag, Filipinas","codigo":"TDG"},{"cidade":"Tanegashima, Jap\u00e3o, Tanegashima","codigo":"TNE"},{"cidade":"Tanga, Tanz\u00e2nia, Tanga","codigo":"TGT"},{"cidade":"Tangier, Marrocos, IBN Batouta","codigo":"TNG"},{"cidade":"Tangshan, China, Sannuhe","codigo":"TVS"},{"cidade":"Tanjung Manis, Mal\u00e1sia, Tanjung Manis","codigo":"TGC"},{"cidade":"Tanjung Pandan, Indon\u00e9sia, H.A.S. Hanandjoeddin","codigo":"TJQ"},{"cidade":"Tanjung Pinang, Indon\u00e9sia, Raja Haji Fisabilillah","codigo":"TNJ"},{"cidade":"Tanjung Redeb, Indon\u00e9sia, Kalimarau","codigo":"BEJ"},{"cidade":"Tanjung Selor, Indon\u00e9sia, Tanjung Harapan","codigo":"TJS"},{"cidade":"Tanjung Warukin, Indon\u00e9sia, Tanjung Warukin","codigo":"TJG"},{"cidade":"Tan Tan, Marrocos, Plage Blanche","codigo":"TTA"},{"cidade":"Tapachula, M\u00e9xico, Tapachula International","codigo":"TAP"},{"cidade":"Tarakan, Indon\u00e9sia, Juwatta","codigo":"TRK"},{"cidade":"Tarama, Jap\u00e3o, Tarama","codigo":"TRA"},{"cidade":"Tarapoto, Peru, G Del Castillo Paredes","codigo":"TPP"},{"cidade":"Taraz, Cazaquist\u00e3o, Taraz","codigo":"DMB"},{"cidade":"Taree, Austr\u00e1lia","codigo":"TRO"},{"cidade":"Tarija, Bol\u00edvia, Cap. Oriel Lea Plaza","codigo":"TJA"},{"cidade":"Tarin kot, Afeganist\u00e3o, Tereen","codigo":"TII"},{"cidade":"Taroom, Austr\u00e1lia","codigo":"XTO"},{"cidade":"Tartu, Est\u00f4nia, Ulenurme","codigo":"TAY"},{"cidade":"Tashkent, Uzbequist\u00e3o, Tashkent International","codigo":"TAS"},{"cidade":"Tasikmalaya, Indon\u00e9sia, Wiriadinata","codigo":"TSY"},{"cidade":"Tasiujuaq, Canad\u00e1, Tasiujuaq","codigo":"YTQ"},{"cidade":"Tawau, Mal\u00e1sia, Tawau","codigo":"TWU"},{"cidade":"Tawi Tawi Island, Filipinas, Sanga Sanga","codigo":"TWT"},{"cidade":"Tbilisi, Ge\u00f3rgia, Tblisi International","codigo":"TBS"},{"cidade":"Tebessa, Arg\u00e9lia","codigo":"TEE"},{"cidade":"Teer\u00e3, Ir\u00e3, Imam Khomeini","codigo":"IKA"},{"cidade":"Tef\u00e9, Brasil, Tef\u00e9","codigo":"TFF"},{"cidade":"Tegucigalpa, Honduras, Toncontin International","codigo":"TGU"},{"cidade":"Teixeira Freitas, Brasil, Teixeira Freitas","codigo":"TXF"},{"cidade":"Tekirdag, Turquia, Corlu","codigo":"TEQ"},{"cidade":"Tel Aviv, Israel, Ben Gurion,\u00a0","codigo":"TLV"},{"cidade":"Telfer, Austr\u00e1lia","codigo":"TEF"},{"cidade":"Telluride, Estados Unidos da Am\u00e9rica, Telluride","codigo":"TEX"},{"cidade":"Tembagapura, Timika, Indon\u00e9sia, Mozes Kilangin","codigo":"TIM"},{"cidade":"Temuco, Chile, La Araucania","codigo":"ZCO"},{"cidade":"Tenerife, Espanha , Todos Aeroportos","codigo":"TCI"},{"cidade":"Tenerife Norte, Espanha, Tenerife Norte","codigo":"TFN"},{"cidade":"Tenerife Sul, Espanha, Tenerife Sur","codigo":"TFS"},{"cidade":"Tengchong, China, Tuofeng","codigo":"TCZ"},{"cidade":"Tennant Creek, Austr\u00e1lia","codigo":"TCA"},{"cidade":"Tepic, M\u00e9xico, Amado Nervo","codigo":"TPQ"},{"cidade":"Terceira Island, Portugal, Lajes","codigo":"TER"},{"cidade":"Teresina, Brasil, Petronio Portella","codigo":"THE"},{"cidade":"Termez Uz, Uzbequist\u00e3o, Termez Uz","codigo":"TMJ"},{"cidade":"Ternate, Indon\u00e9sia, Sultan Babullah","codigo":"TTE"},{"cidade":"Terney, R\u00fassia, Terney","codigo":"NEI"},{"cidade":"Terrace, Canad\u00e1, Northwest Regional","codigo":"YXT"},{"cidade":"Tete A La Baleine, Canad\u00e1, Tete A La Baleine","codigo":"ZTB"},{"cidade":"Tete, Mo\u00e7ambique, Chingozi","codigo":"TET"},{"cidade":"Tetouan, Marrocos, Saniat R Mel","codigo":"TTU"},{"cidade":"Texarkana, Estados Unidos da Am\u00e9rica, Texarkana, Webb Field","codigo":"TXK"},{"cidade":"Tezpur, \u00cdndia, Tezpur","codigo":"TEZ"},{"cidade":"Thandwe, Mianmar, Thandwe","codigo":"SNW"},{"cidade":"Thangool, Austr\u00e1lia","codigo":"THG"},{"cidade":"Thanh Hoa, Vietn\u00e3, Tho Xuan","codigo":"THD"},{"cidade":"Thargomindah, Austr\u00e1lia","codigo":"XTG"},{"cidade":"The Bight, Bahamas, New Bight","codigo":"TBI"},{"cidade":"The Pas, Canad\u00e1, The Pas","codigo":"YQD"},{"cidade":"Thessalnik, Gr\u00e9cia, Makedonia","codigo":"SKG"},{"cidade":"Thiruvananthapuram, \u00cdndia","codigo":"TRV"},{"cidade":"Thompson, Canad\u00e1, Thompson","codigo":"YTH"},{"cidade":"Thorshofn, Isl\u00e2ndia, Thorshofn","codigo":"THO"},{"cidade":"Thunder Bay, Canad\u00e1, Thunder Bay","codigo":"YQT"},{"cidade":"Tianjin, China, Binhai International","codigo":"TSN"},{"cidade":"Tianshui, China, Maijishan","codigo":"THQ"},{"cidade":"Tiaret Bouchekif, Arg\u00e9lia","codigo":"TID"},{"cidade":"Tijuana, M\u00e9xico, Abelardo L. Rodr\u00edguez","codigo":"TIJ"},{"cidade":"Tiksi, R\u00fassia, Tiksi","codigo":"IKS"},{"cidade":"Timimoun, Arg\u00e9lia","codigo":"TMX"},{"cidade":"Timisoara, Rom\u00eania, Traian Vuia","codigo":"TSR"},{"cidade":"Timmins, Canad\u00e1, Victor M. Power","codigo":"YTS"},{"cidade":"Tindouf, Arg\u00e9lia","codigo":"TIN"},{"cidade":"Tingo Maria, Peru, Tingo Maria","codigo":"TGI"},{"cidade":"Tioman Island, Mal\u00e1sia, Tioman Island","codigo":"TOD"},{"cidade":"Tira, Gr\u00e9cia, Santorini","codigo":"JTR"},{"cidade":"Tirana, Alb\u00e2nia, Nene Tereza","codigo":"TIA"},{"cidade":"Tiree, Reino Unido, Tiree","codigo":"TRE"},{"cidade":"Tirgu Mures, Rom\u00eania, Tirgu Mures","codigo":"TGM"},{"cidade":"Tiruchchirappalli, \u00cdndia, Tiruchchirappalli","codigo":"TRZ"},{"cidade":"Tirupati, \u00cdndia, Tirupati","codigo":"TIR"},{"cidade":"Tivat, Montenegro, Tivat","codigo":"TIV"},{"cidade":"Tlemcen, Arg\u00e9lia, Zenata Messali El Hadj","codigo":"TLM"},{"cidade":"Toamasina, Madag\u00e1scar, Toamasina","codigo":"TMM"},{"cidade":"Tobago, Trinidad e Tobago, A.N.R. Robinson","codigo":"TAB"},{"cidade":"Tofino, Canad\u00e1, Long Beach","codigo":"YAZ"},{"cidade":"Tokunoshima, Jap\u00e3o, Tokunoshima","codigo":"TKN"},{"cidade":"Tokushima, Jap\u00e3o, Tokushima","codigo":"TKS"},{"cidade":"Tolanaro, Madag\u00e1scar, Marillac","codigo":"FTU"},{"cidade":"Toledo, Estados Unidos da Am\u00e9rica, Express","codigo":"TOL"},{"cidade":"Toliara, Madag\u00e1scar, Toliara","codigo":"TLE"},{"cidade":"Tolitoli, Indon\u00e9sia, Lalos","codigo":"TLI"},{"cidade":"Toluca, M\u00e9xico, Adolfo L\u00f3pez Mateos","codigo":"TLC"},{"cidade":"Tomsk, R\u00fassia, Bogashevo","codigo":"TOF"},{"cidade":"Tonghua, China, Sanyuanpu","codigo":"TNH"},{"cidade":"Tongliao, China, Tongliao","codigo":"TGO"},{"cidade":"Tongren, China, Fenhuang","codigo":"TEN"},{"cidade":"Toowoomba, Austr\u00e1lia, Brisbane West Wellcamp","codigo":"WTB"},{"cidade":"Topeka, Estados Unidos da Am\u00e9rica, Forbes Field","codigo":"FOE"},{"cidade":"T\u00f3quio, Jap\u00e3o, Narita International","codigo":"NRT"},{"cidade":"T\u00f3quio, Jap\u00e3o - Todos Aeroportos","codigo":"TYO"},{"cidade":"T\u00f3quio, Jap\u00e3o, Tokyo International Haneda","codigo":"HND"},{"cidade":"Toronto, Canad\u00e1, Billy Bishop","codigo":"YTZ"},{"cidade":"Toronto, Canad\u00e1 , Todos Aeroportos","codigo":"YTO"},{"cidade":"Toronto, Canad\u00e1, Toronto Pearson","codigo":"YYZ"},{"cidade":"Torreon, M\u00e9xico, Francisco Sarabia","codigo":"TRC"},{"cidade":"Torsby, Su\u00e9cia, Torsby Apt","codigo":"TYF"},{"cidade":"Tortuguero, Costa Rica, Torturego","codigo":"TTQ"},{"cidade":"Tottori, Jap\u00e3o, Tottori","codigo":"TTJ"},{"cidade":"Touggourt - Sidi Mahdi, Arg\u00e9lia","codigo":"TGR"},{"cidade":"Toulon, Fran\u00e7a, Hyeres","codigo":"TLN"},{"cidade":"Tours, Fran\u00e7a, Vale do Loire","codigo":"TUF"},{"cidade":"Townsville, Austr\u00e1lia, Townsville International","codigo":"TSV"},{"cidade":"Toyama, Jap\u00e3o, Toyama","codigo":"TOY"},{"cidade":"Toyooka, Jap\u00e3o, Tajima","codigo":"TJH"},{"cidade":"Tozeur, Tun\u00edsia, Nefta","codigo":"TOE"},{"cidade":"Trabzon, Turquia, Trabzon","codigo":"TZX"},{"cidade":"Trail, Canad\u00e1, Trail","codigo":"YZZ"},{"cidade":"Trang, Tail\u00e2ndia, Trang","codigo":"TST"},{"cidade":"Trapani, It\u00e1lia, Birgi","codigo":"TPS"},{"cidade":"Trashigang, But\u00e3o, Yonphula","codigo":"YON"},{"cidade":"Trat, Tail\u00e2ndia, Trat Airport","codigo":"TDX"},{"cidade":"Traverse City, Estados Unidos da Am\u00e9rica, Cherry Capital","codigo":"TVC"},{"cidade":"Treasure Cay, Bahamas, Treasure Cay","codigo":"TCB"},{"cidade":"Trelew, Argentina, Almirante M.A.Zar","codigo":"REL"},{"cidade":"Trenton, Estados Unidos da Am\u00e9rica, Trenton-Mercer","codigo":"TTN"},{"cidade":"Trepell, Austr\u00e1lia","codigo":"TQP"},{"cidade":"Tri Cities, Estados Unidos da Am\u00e9rica, Tri Cities Regional","codigo":"TRI"},{"cidade":"Trieste, It\u00e1lia, Ronchi Dei Legionari","codigo":"TRS"},{"cidade":"Trincomalee, Sri Lanka, China Bay","codigo":"TRR"},{"cidade":"Trinidad, Bol\u00edvia, Jorge Henrich Arauz","codigo":"TDD"},{"cidade":"Tripoli, L\u00edbia","codigo":"TIP"},{"cidade":"Trollhattan, Vanersborg, Su\u00e9cia, Trollhattan","codigo":"THN"},{"cidade":"Tromso, Noruega, langnes","codigo":"TOS"},{"cidade":"Trondheim, Noruega, Vaernes","codigo":"TRD"},{"cidade":"Trujillo, Peru, C. Martinez de Pinillos","codigo":"TRU"},{"cidade":"Tsushima, Jap\u00e3o, Tsushima","codigo":"TSJ"},{"cidade":"Tucson, Estados Unidos da Am\u00e9rica, Tucson","codigo":"TUS"},{"cidade":"Tucum\u00e3, Argentina, Benjamin Matienzo","codigo":"TUC"},{"cidade":"Tucupita, Venezuela, San Rafael","codigo":"TUV"},{"cidade":"Tuguegarao, Filipinas","codigo":"TUG"},{"cidade":"Tulcea, Rom\u00eania, Delta Dunarii","codigo":"TCE"},{"cidade":"Tulsa, Estados Unidos da Am\u00e9rica, Tulsa International","codigo":"TUL"},{"cidade":"Tumaco, Col\u00f4mbia,La Florida","codigo":"TCO"},{"cidade":"Tumbes, Peru, Pedro Canga Rodrigues","codigo":"TBP"},{"cidade":"Tumlingtar, Nepal, Tumlingtar","codigo":"TMI"},{"cidade":"Tumushuke, China, Tangwangcheng","codigo":"TWC"},{"cidade":"Tunes, Tun\u00edsia, Carthage","codigo":"TUN"},{"cidade":"Tupelo, Estados Unidos da Am\u00e9rica, Tupelo","codigo":"TUP"},{"cidade":"Turaif, Ar\u00e1bia Saudita, Turaif","codigo":"TUI"},{"cidade":"Turbat, Paquist\u00e3o, International","codigo":"TUK"},{"cidade":"Turim, It\u00e1lia, Caselle","codigo":"TRN"},{"cidade":"Turkmenabat, Turcomenist\u00e3o, Turkmenabat","codigo":"CRZ"},{"cidade":"Turkmenbashi, Turcomenist\u00e3o, Turkmenbashi","codigo":"KRW"},{"cidade":"Turku, Finl\u00e2ndia, Turku","codigo":"TKU"},{"cidade":"Turpan, China, Jiaohe","codigo":"TLQ"},{"cidade":"Turukhansk, R\u00fassia, Turukhansk","codigo":"THX"},{"cidade":"Tuticorin, \u00cdndia, Tuticorin","codigo":"TCR"},{"cidade":"Tuxtla Gutierrez, M\u00e9xico, Angel Albino Corzo","codigo":"TGZ"},{"cidade":"Tuy Hoa, Vietn\u00e3, Dong Tac","codigo":"TBB"},{"cidade":"Tuzla, B\u00f3snia e Herzegovina, Tuzla International","codigo":"TZL"},{"cidade":"Twin Falls, Estados Unidos da Am\u00e9rica, Magic Valley Regional","codigo":"TWF"},{"cidade":"Tyler, Estados Unidos da Am\u00e9rica, Pounds Regional","codigo":"TYR"},{"cidade":"Tynda, R\u00fassia, Tynda","codigo":"TYD"},{"cidade":"Tyumen, R\u00fassia, Roshchino","codigo":"TJM"},{"cidade":"Ube, Jap\u00e3o, Yamaguchi Ube","codigo":"UBJ"},{"cidade":"Uberaba, Brasil, M. de Alemeida Franco","codigo":"UBA"},{"cidade":"Uberl\u00e2ndia, Brasil, Cesar Bombonato","codigo":"UDI"},{"cidade":"Ubon Ratchathani, Tail\u00e2ndia, Ubon Ratchathani","codigo":"UBP"},{"cidade":"Udaipur, \u00cdndia, Maharana Pratap","codigo":"UDR"},{"cidade":"Udon Thani, Tail\u00e2ndia, Udon Thani","codigo":"UTH"},{"cidade":"Ufa, R\u00fassia, Ufa","codigo":"UFA"},{"cidade":"Ukhta, R\u00fassia, Ukhta","codigo":"UCT"},{"cidade":"Ukunda, Qu\u00eania, Diane","codigo":"UKA"},{"cidade":"Ulaanbaatar, Mong\u00f3lia, Chinggis Khaan International","codigo":"ULN"},{"cidade":"Ulaangom, Mong\u00f3lia, Ulaangom","codigo":"ULO"},{"cidade":"Ulanhot, China, Ulanhot","codigo":"HLH"},{"cidade":"Ulanqab Jining, China, Ulanqab","codigo":"UCB"},{"cidade":"Ulan Ude, R\u00fassia, Mukhino","codigo":"UUD"},{"cidade":"Uliastai, Mong\u00f3lia, Donoi","codigo":"ULZ"},{"cidade":"Ulsan, Cor\u00e9ia do Sul","codigo":"USN"},{"cidade":"Ulukhaktok, Canad\u00e1, Ulukhaktok","codigo":"YHI"},{"cidade":"Ulusaba, \u00c1frica do Sul, Ulusaba","codigo":"ULX"},{"cidade":"Ulyanovsk, R\u00fassia, Baratayevka","codigo":"ULV"},{"cidade":"Ulyanovsk, R\u00fassia, Vostochny","codigo":"ULY"},{"cidade":"Umea, Su\u00e9cia, Umea","codigo":"UME"},{"cidade":"Umiujaq, Canad\u00e1, Umiujaq","codigo":"YUD"},{"cidade":"Umtata, \u00c1frica do Sul, K.D Matanzima","codigo":"UTT"},{"cidade":"Upington, \u00c1frica do Sul, Upington Municipal","codigo":"UTN"},{"cidade":"Uralsk, Cazaquist\u00e3o, Ak Zhol","codigo":"URA"},{"cidade":"Uray, R\u00fassia, Uray","codigo":"URJ"},{"cidade":"Urdzhar, Cazaquist\u00e3o, Urdzhar","codigo":"UZR"},{"cidade":"Urgench, Uzbequist\u00e3o, Intenational","codigo":"UGC"},{"cidade":"Urmieh, Ir\u00e3, Urimieh","codigo":"OMH"},{"cidade":"Uruapan, M\u00e9xico, Inacio Lopez Rayon","codigo":"UPN"},{"cidade":"Uruguaiana, Brasil, Rubem Berta","codigo":"URG"},{"cidade":"Urumqi, China, Diwopu International","codigo":"URC"},{"cidade":"Usak, Turquia, Usak","codigo":"USQ"},{"cidade":"Usharal, Cazaquist\u00e3o, Usharal","codigo":"USJ"},{"cidade":"Ushuaia, Argentina, Malvinas Argentinas","codigo":"USH"},{"cidade":"Usinsk, R\u00fassia, Usinsk","codigo":"USK"},{"cidade":"Ust-Kamenogorsk, Cazaquist\u00e3o","codigo":"UKK"},{"cidade":"Ust Kut, R\u00fassia, Ust Kut","codigo":"UKX"},{"cidade":"Ust Kuyga, R\u00fassia, Ust Kuyga","codigo":"UKG"},{"cidade":"Ust-Maya, R\u00fassia, Ust-Maya","codigo":"UMS"},{"cidade":"Ust Nera, R\u00fassia, Ust Nera","codigo":"USR"},{"cidade":"Ust Tsilma, R\u00fassia, Ust Tsilma","codigo":"UTS"},{"cidade":"U tapao, Tail\u00e2ndia, Rayong Pattaya","codigo":"UTP"},{"cidade":"Utarom, Indon\u00e9sia, Kaimana","codigo":"KNG"},{"cidade":"Utila, Honduras, Utila","codigo":"UII"},{"cidade":"Uyo, Nig\u00e9ria, Akwa Ibom International","codigo":"QUO"},{"cidade":"Uyuni, Bol\u00edvia, Uyuni","codigo":"UYU"},{"cidade":"Uzhhorod, Ucr\u00e2nia, Uzhhorod International","codigo":"UDJ"},{"cidade":"Vaasa, Finl\u00e2ndia, Vaasa","codigo":"VAA"},{"cidade":"Vadodara, \u00cdndia, Vadodara","codigo":"BDQ"},{"cidade":"Vadso, Noruega, Vadso","codigo":"VDS"},{"cidade":"Valdez, Estados Unidos da Am\u00e9rica, Pioneer Field","codigo":"VDZ"},{"cidade":"Valdivia, Chile, Pichoy","codigo":"ZAL"},{"cidade":"Val dOr, Canad\u00e1, Val dOr","codigo":"YVO"},{"cidade":"Valdosta, Estados Unidos da Am\u00e9rica, Valdosta","codigo":"VLD"},{"cidade":"Valen\u00e7a, Brasil, Valen\u00e7a","codigo":"VAL"},{"cidade":"Val\u00eancia, Espanha, Valencia Airport","codigo":"VLC"},{"cidade":"Valencia, Venezuela, Arturo Michelena","codigo":"VLN"},{"cidade":"Valera Carvajal, Venezuela, Antonio N Briceno","codigo":"VLV"},{"cidade":"Valladolid, Espanha, Valladolid Airport","codigo":"VLL"},{"cidade":"Valledupar, Col\u00f4mbia,Alfonso L\u00f3pez Pumarejo","codigo":"VUP"},{"cidade":"Valparaiso, Estados Unidos da Am\u00e9rica, Destin Ft Walton Beach","codigo":"VPS"},{"cidade":"Valverde, Espanha, El Hierro","codigo":"VDE"},{"cidade":"Vancouver, Canad\u00e1, de Vancouver","codigo":"YVR"},{"cidade":"Van, Turquia, Ferit Melen","codigo":"VAN"},{"cidade":"Varadero, Cuba, Juan G. Gomez","codigo":"VRA"},{"cidade":"Varanasi, \u00cdndia, Lal Badahur, Shastri","codigo":"VNS"},{"cidade":"Vardoe, Noruega, Svartnes","codigo":"VAW"},{"cidade":"Varginha, Brasil, Maj. Brig. Trompowsky","codigo":"VAG"},{"cidade":"Varna, Bulg\u00e1ria, Varna","codigo":"VAR"},{"cidade":"Vars\u00f3via, Polonia, Frederic Chopin","codigo":"WAW"},{"cidade":"Vaxjo, Su\u00e9cia, Smaland","codigo":"VXO"},{"cidade":"Veliky Ustyug, R\u00fassia, Veliky Ustyug","codigo":"VUS"},{"cidade":"Veneza, It\u00e1lia, Marco Polo","codigo":"VCE"},{"cidade":"Veracruz, M\u00e9xico, Heriberto Jara","codigo":"VER"},{"cidade":"Verkhnevilyuysk, R\u00fassia, Verkhnevilyuysk","codigo":"VHV"},{"cidade":"Verona, It\u00e1lia, Villafranca","codigo":"VRN"},{"cidade":"Vestmannaeyjar, Isl\u00e2ndia, Vestmannaeyjar","codigo":"VEY"},{"cidade":"Victoria, Canad\u00e1, Victoria","codigo":"YYJ"},{"cidade":"Victoria, Estados Unidos da Am\u00e9rica, Victoria Regional","codigo":"VCT"},{"cidade":"Victoria Falls, Zimb\u00e1bue, International","codigo":"VFA"},{"cidade":"Victorville, Estados Unidos da Am\u00e9rica, Log\u00edstico da Calif\u00f3rnia do Sul","codigo":"VCV"},{"cidade":"Vidyanagar, \u00cdndia, Jindal","codigo":"VDY"},{"cidade":"Viedma, Argentina, Gobernador E. Castello","codigo":"VDM"},{"cidade":"Viena, \u00c1ustria, Vienna International","codigo":"VIE"},{"cidade":"Vientiane, Laos, Wattay International","codigo":"VTE"},{"cidade":"Vieques, Porto Rico, Antonio Rivera Rodr\u00edguez","codigo":"VQS"},{"cidade":"Vigo, Espanha, Vigo Airport","codigo":"VGO"},{"cidade":"Vijayawada, \u00cdndia, Vijayawada","codigo":"VGA"},{"cidade":"Vilanculos, Mo\u00e7ambique, Vilankulos","codigo":"VNX"},{"cidade":"Vila Real, Portugal, Vila Real","codigo":"VRL"},{"cidade":"Vilhelmina, Su\u00e9cia, Vilhelmina","codigo":"VHM"},{"cidade":"Vilhena, Brasil, Brigadeiro Camarao","codigo":"BVH"},{"cidade":"Villahermosa, M\u00e9xico, Carlos Rovirosa P\u00e9rez","codigo":"VSA"},{"cidade":"Villavicencio, Col\u00f4mbia,Vanguardia","codigo":"VVC"},{"cidade":"Vilnius, Litu\u00e2nia, Vilnius International","codigo":"VNO"},{"cidade":"Vilyuysk, R\u00fassia, Vilyuysk","codigo":"VYI"},{"cidade":"Vineyard Haven, Estados Unidos da Am\u00e9rica, Marthas Vineyard","codigo":"MVY"},{"cidade":"Vinh City, Vietn\u00e3, Vinh","codigo":"VII"},{"cidade":"Vinnitsa, Ucr\u00e2nia, Gavryshivka","codigo":"VIN"},{"cidade":"Vipingo, Qu\u00eania, Vipingo","codigo":"VPG"},{"cidade":"Virac, Filipinas","codigo":"VRC"},{"cidade":"Visby, Su\u00e9cia, Visby","codigo":"VBY"},{"cidade":"Viseu, Portugal, Viseu","codigo":"VSE"},{"cidade":"Vishakhapatnam, \u00cdndia, Vishakhapatnam","codigo":"VTZ"},{"cidade":"Vitebsk, Bielor\u00fassia, Vitebsk","codigo":"VTB"},{"cidade":"Vit\u00f3ria da Conquista, Brasil, Glauber Rocha","codigo":"VDC"},{"cidade":"Vit\u00f3ria do Esp\u00edrito Santo, Brasil, Eurico de Aguiar Salles","codigo":"VIX"},{"cidade":"Vit\u00f3ria, Espanha, Vitoria","codigo":"VIT"},{"cidade":"Vladikavkaz, R\u00fassia, Beslan","codigo":"OGZ"},{"cidade":"Vladivostok, R\u00fassia, Knevichi","codigo":"VVO"},{"cidade":"Volgograd, R\u00fassia, Gumrak","codigo":"VOG"},{"cidade":"Volos, Gr\u00e9cia, Nea Aghialos","codigo":"VOL"},{"cidade":"Vopnafjordur, Isl\u00e2ndia, Vestmannaeyjar","codigo":"VPN"},{"cidade":"Vorkuta, R\u00fassia, Vorkuta","codigo":"VKT"},{"cidade":"Voronezh, R\u00fassia, Chertovitskoye","codigo":"VOZ"},{"cidade":"Wabush, Canad\u00e1, Wabush","codigo":"YWK"},{"cidade":"Waco, Estados Unidos da Am\u00e9rica, Waco International","codigo":"ACT"},{"cidade":"Wadi al Dawaser, Ar\u00e1bia Saudita","codigo":"WAE"},{"cidade":"Wadi Halfa, Sud\u00e3o, Wadi Halfa","codigo":"WHF"},{"cidade":"Wagga Wagga, Austr\u00e1lia","codigo":"WGA"},{"cidade":"Waingapu, Indon\u00e9sia","codigo":"WGP"},{"cidade":"Wajima, Jap\u00e3o, Noto Airport","codigo":"NTQ"},{"cidade":"Wajir, Qu\u00eania, Wajir","codigo":"WJR"},{"cidade":"Wakkanai, Jap\u00e3o, Wakkanai","codigo":"WKJ"},{"cidade":"Walla Walla, Estados Unidos da Am\u00e9rica, Walla Walla Regional","codigo":"ALW"},{"cidade":"Walvis Bay, Nam\u00edbia, Walvis Bay","codigo":"WVB"},{"cidade":"Wamena, Indon\u00e9sia, Wamena","codigo":"WMX"},{"cidade":"Wangerooge, Alemanha, Wangerooge","codigo":"AGE"},{"cidade":"Wanzhou, China, Wuqiao","codigo":"WXN"},{"cidade":"Warri, Nig\u00e9ria, Osubi","codigo":"QRW"},{"cidade":"Warrnambool, Austr\u00e1lia","codigo":"WMB"},{"cidade":"Washington, Estados Unidos da Am\u00e9rica, Dulles International","codigo":"IAD"},{"cidade":"Washington, Estados Unidos da Am\u00e9rica, Ronald Reagan","codigo":"DCA"},{"cidade":"Washington, Estados Unidos da Am\u00e9rica - Todos Aeroportos","codigo":"WAS"},{"cidade":"Waskaganish, Canad\u00e1, Waskaganish","codigo":"YKQ"},{"cidade":"Waterloo, Estados Unidos da Am\u00e9rica, Waterloo","codigo":"ALO"},{"cidade":"Wedjh, Ar\u00e1bia Saudita, Wedjh","codigo":"EJH"},{"cidade":"Weerawila, Sri Lanka, Weerawila","codigo":"WRZ"},{"cidade":"Weifang, China, Weifang","codigo":"WEF"},{"cidade":"Weihai, China, Dashhuibo","codigo":"WEH"},{"cidade":"Weipa, Austr\u00e1lia","codigo":"WEI"},{"cidade":"Wemindji, Canad\u00e1, Wemindji","codigo":"YNC"},{"cidade":"Wenatchee, Estados Unidos da Am\u00e9rica, Pangborn Memorial","codigo":"EAT"},{"cidade":"Wenshan, China, Puzhehei","codigo":"WNH"},{"cidade":"Wenzhou, China, Yongqiang","codigo":"WNZ"},{"cidade":"Westerland, Alemanha, Sylt","codigo":"GWT"},{"cidade":"West Palm Beach, Estados Unidos da Am\u00e9rica, Palm Beach","codigo":"PBI"},{"cidade":"Westray, Reino Unido, Westray","codigo":"WRY"},{"cidade":"Whale Cove, Canad\u00e1, Whale Cove","codigo":"YXN"},{"cidade":"Whati, Canad\u00e1, Whati","codigo":"YLE"},{"cidade":"Whitehorse, Canad\u00e1, Erik Nielsein","codigo":"YXY"},{"cidade":"White Plains, Estados Unidos da Am\u00e9rica, Westchester County Airport","codigo":"HPN"},{"cidade":"Whyalla, Austr\u00e1lia","codigo":"WYA"},{"cidade":"Wichita, Estados Unidos da Am\u00e9rica, Mid-Continent","codigo":"ICT"},{"cidade":"Wichita Falls, Estados Unidos da Am\u00e9rica, Municipal Sheppard","codigo":"SPS"},{"cidade":"Wick, Reino Unido, Wick","codigo":"WIC"},{"cidade":"Wilkes Barre\u00a0Scranton, Estados Unidos da Am\u00e9rica, Wilkes Barre Scranton International","codigo":"AVP"},{"cidade":"Williams Harbour, Canad\u00e1,\u00a0Williams Harbour","codigo":"YWM"},{"cidade":"Williams Lake, Canad\u00e1, Williams Lake","codigo":"YWL"},{"cidade":"Williamsport, Estados Unidos da Am\u00e9rica, Williamsport Regional","codigo":"IPT"},{"cidade":"Williston, Estados Unidos da Am\u00e9rica, Sloulin Field","codigo":"ISN"},{"cidade":"Wilmington, Estados Unidos da Am\u00e9rica, Wilmington","codigo":"ILM"},{"cidade":"Wiluna, Austr\u00e1lia","codigo":"WUN"},{"cidade":"Windhoek, Nam\u00edbia, Eros","codigo":"ERS"},{"cidade":"Windhoek, Nam\u00edbia, Hosea Kutako","codigo":"WDH"},{"cidade":"Windorah, Austr\u00e1lia","codigo":"WNR"},{"cidade":"Windsor, Canad\u00e1, Windsor","codigo":"YQG"},{"cidade":"Windsor Locks, Estados Unidos da Am\u00e9rica, Bradley","codigo":"BDL"},{"cidade":"Winnipeg, Canad\u00e1, J A Richardson","codigo":"YWG"},{"cidade":"Winnipeg, Canad\u00e1, Winnipeg","codigo":"YWG"},{"cidade":"Winton, Austr\u00e1lia","codigo":"WIN"},{"cidade":"Wollaston Lake, Canad\u00e1, Wollaston Lake","codigo":"ZWL"},{"cidade":"Wollongong, Austr\u00e1lia, Illawarra","codigo":"WOL"},{"cidade":"Wonju, Cor\u00e9ia do Sul","codigo":"WJU"},{"cidade":"Worcester, Estados Unidos da Am\u00e9rica, Worcester","codigo":"ORH"},{"cidade":"Wrangell, Estados Unidos da Am\u00e9rica, Wrangell","codigo":"WRG"},{"cidade":"Wroclaw, Polonia, Nicolaus Copernicus","codigo":"WRO"},{"cidade":"Wrotham Park, Austr\u00e1lia","codigo":"WPK"},{"cidade":"Wudalianchi, China, Dedu","codigo":"DTU"},{"cidade":"Wuhai, China, Wuhai","codigo":"WUA"},{"cidade":"Wuhan, China, Tianhe International","codigo":"WUH"},{"cidade":"W\u00fcrzburg\u00a0, Alemanha","codigo":"QWU"},{"cidade":"Wushan, China, Chongqing","codigo":"WSK"},{"cidade":"Wuxi, China, Sunan Shuofang","codigo":"WUX"},{"cidade":"Wuyishan, China, Wuyishan","codigo":"WUS"},{"cidade":"Wuzhou, China, Xijiang","codigo":"WUZ"},{"cidade":"Xalapa, M\u00e9xico, El Lencero","codigo":"JAL"},{"cidade":"Xangai, Shangai, China, Pudong International","codigo":"PVG"},{"cidade":"Xangai, Shangai, China , Todos Aeroportos","codigo":"SHA"},{"cidade":"Xiahe, China, Gannan Xiahe","codigo":"GXH"},{"cidade":"Xiamen, China, Gaoqi International","codigo":"XMN"},{"cidade":"Xi An, China, Xianyang International","codigo":"SIA"},{"cidade":"Xi An, China, Xianyang International","codigo":"XIY"},{"cidade":"Xiangyang, China, Liuji","codigo":"XFN"},{"cidade":"Xichang, China, Qingshan","codigo":"XIC"},{"cidade":"Xigaze Rikaze, China, Peace","codigo":"RKZ"},{"cidade":"Xilinhot, China, Xilinhot","codigo":"XIL"},{"cidade":"Xingyi, China, Xingyi","codigo":"ACX"},{"cidade":"Xining, China, Caojiabao","codigo":"XNN"},{"cidade":"Xinjiang, China, Nalati","codigo":"NLT"},{"cidade":"Xinyang, China, Minggang","codigo":"XAI"},{"cidade":"Xinzhou, China, Xinzhou Wutaishan","codigo":"WUT"},{"cidade":"Xuzhou, China, Guanyin","codigo":"XUZ"},{"cidade":"Yacuiba, Bol\u00edvia, Yacuiba","codigo":"BYC"},{"cidade":"Yahukimo, Indon\u00e9sia, Nop Goliath","codigo":"DEX"},{"cidade":"Yakima, Estados Unidos da Am\u00e9rica, Yakima Air Terminal","codigo":"YKM"},{"cidade":"Yakutat, Estados Unidos da Am\u00e9rica, Yakutat","codigo":"YAK"},{"cidade":"Yakutsk, R\u00fassia, Yakutsk","codigo":"YKS"},{"cidade":"Yamagata Junmachi, Jap\u00e3o, Yamagata","codigo":"GAJ"},{"cidade":"Yam Island, Austr\u00e1lia","codigo":"XMY"},{"cidade":"Yan An, China, Nanniwan","codigo":"ENY"},{"cidade":"Yanbu, Ar\u00e1bia Saudita, Yanbu Al Bahr","codigo":"YNB"},{"cidade":"Yancheng, China, NANYANG","codigo":"YNZ"},{"cidade":"Yangon, Mianmar, Mingaladon","codigo":"RGN"},{"cidade":"Yangyang, Cor\u00e9ia do Sul","codigo":"YNY"},{"cidade":"Yangzhou, China, Taizhou","codigo":"YTY"},{"cidade":"Yanji, China, Jiangbei International","codigo":"YNJ"},{"cidade":"Yantai Laishan, China, Penglai International","codigo":"YNT"},{"cidade":"Yaounde, Camar\u00f5es, Nsimalen International","codigo":"NSI"},{"cidade":"Yaroslavl, R\u00fassia, Tunoshna","codigo":"IAR"},{"cidade":"Yasouj, Ir\u00e3, Yasouj","codigo":"YES"},{"cidade":"Yazd, Ir\u00e3, Shahid Sadooghbi","codigo":"AZD"},{"cidade":"Yedinka, R\u00fassia, Yedinka","codigo":"EDN"},{"cidade":"Yellowknife, Canad\u00e1, Yellowknife","codigo":"YZF"},{"cidade":"Yeosu, Suncheon, Cor\u00e9ia do Sul","codigo":"RSU"},{"cidade":"Yerbogachen, R\u00fassia, Yerbogachen","codigo":"ERG"},{"cidade":"Yibin, China, Caiba","codigo":"YBP"},{"cidade":"Yichang, China, Sanxia","codigo":"YIH"},{"cidade":"Yichun, China, Mingyueshan","codigo":"YIC"},{"cidade":"Yichun Heilongjiang, China, Lindu","codigo":"LDS"},{"cidade":"Yinchuan, China, Hedong","codigo":"INC"},{"cidade":"Yingkou, China, Yingkou","codigo":"YKH"},{"cidade":"Yining, China, Yining","codigo":"YIN"},{"cidade":"Yiwu, China, Yiwu","codigo":"YIW"},{"cidade":"Yogyakarta, Indon\u00e9sia, Adisutjipt","codigo":"JOG"},{"cidade":"Yola, Nig\u00e9ria, Yola","codigo":"YOL"},{"cidade":"Yonago, Jap\u00e3o, Miho","codigo":"YGJ"},{"cidade":"Yonaguni, Jap\u00e3o, Yonaguni","codigo":"OGN"},{"cidade":"Yongzhou, China, Lingling","codigo":"LLF"},{"cidade":"Yopal, Col\u00f4mbia,El Alcaravan","codigo":"EYP"},{"cidade":"Yorke Islands, Austr\u00e1lia","codigo":"OKR"},{"cidade":"Yoron-Jima, Jap\u00e3o, Yoron","codigo":"RNJ"},{"cidade":"Yoshkar Ola, R\u00fassia, Yoshkar Ola","codigo":"JOK"},{"cidade":"Yueyang, China, Sanhe","codigo":"YYA"},{"cidade":"Yukushima, Jap\u00e3o, Yukushima","codigo":"KUM"},{"cidade":"Yulin, China, Yuang","codigo":"UYN"},{"cidade":"Yuma, Estados Unidos da Am\u00e9rica, Yuma\u00a0, \u00a0MCAS Yuma","codigo":"YUM"},{"cidade":"Yuncheng, China","codigo":"YCU"},{"cidade":"Yushu, China, Batang","codigo":"YUS"},{"cidade":"Yuzhno Kurilsk, R\u00fassia, Mendeleevo","codigo":"DEE"},{"cidade":"Yuzhno Sakhalinsk, R\u00fassia","codigo":"UUS"},{"cidade":"Zabol, Ir\u00e3, Zabol Airport","codigo":"ACZ"},{"cidade":"Zacatecas, M\u00e9xico, Leobardo C. Ruiz","codigo":"ZCL"},{"cidade":"Zadar, Cro\u00e1cia, Zadar","codigo":"ZAD"},{"cidade":"Zagreb, Cro\u00e1cia, Franjo Tudman","codigo":"ZAG"},{"cidade":"Zahedan, Ir\u00e3, Zahedan","codigo":"ZAH"},{"cidade":"Zakynthos, Gr\u00e9cia, Zakynthos","codigo":"ZTH"},{"cidade":"Zamboanga, Filipinas","codigo":"ZAM"},{"cidade":"Zanjan, Ir\u00e3, Zanjan","codigo":"JWN"},{"cidade":"Zanzibar, Tanz\u00e2nia, Zanzibar International","codigo":"ZNZ"},{"cidade":"Zaporizhia, Ucr\u00e2nia, Mokraya International","codigo":"OZH"},{"cidade":"Zaranj, Afeganist\u00e3o, Zaranj","codigo":"ZAJ"},{"cidade":"Zaysan, Cazaquist\u00e3o, Zaysan","codigo":"SZI"},{"cidade":"Zhalantun, China, Chengjisihan","codigo":"NZL"},{"cidade":"Zhangjiajie, China, Hehua","codigo":"DYG"},{"cidade":"Zhangjiakou, China, Zhangjiakou","codigo":"ZQZ"},{"cidade":"Zhangye, China, Ganzhou","codigo":"YZY"},{"cidade":"Zhanjiang, China, Zhanjiang","codigo":"ZHA"},{"cidade":"Zhaotong, China, Zhaotong","codigo":"ZAT"},{"cidade":"Zhengzhou, China, Shagjie Airport","codigo":"HSJ"},{"cidade":"Zhengzhou, China, Xinzheng Internatioal","codigo":"CGO"},{"cidade":"Zhezkazgan, Cazaquist\u00e3o, Zhezkazgan","codigo":"DZN"},{"cidade":"Zhigansk, R\u00fassia, Zhigansk","codigo":"ZIX"},{"cidade":"Zhijiang, China, Zhijiang","codigo":"HJJ"},{"cidade":"Zhob, Paquist\u00e3o, Zhob","codigo":"PZH"},{"cidade":"Zhongwei, China, Xiangshan","codigo":"ZHY"},{"cidade":"Zhoushan, China, Putuoshan","codigo":"HSN"},{"cidade":"Zhuhai, China, Sanzao International","codigo":"ZUH"},{"cidade":"Zielona Gora, Polonia, Babimost","codigo":"IEG"},{"cidade":"Ziguinchor, Senegal, Ziguinchor","codigo":"ZIG"},{"cidade":"Zinder, N\u00edger, Zinder","codigo":"ZND"},{"cidade":"Zonguldak, Turquia, Caycuma","codigo":"ONQ"},{"cidade":"Zouerate, Maurit\u00e2nia, Tazadit","codigo":"OUZ"},{"cidade":"Zunyi, China, Maotai","codigo":"WMT"},{"cidade":"Zunyi, China, Maotai Airport","codigo":"WMT"},{"cidade":"Zurique, Su\u00ed\u00e7a, Zurich Airport","codigo":"ZRH"},{"cidade":"Zyryanka, R\u00fassia, Zyryanka","codigo":"ZKP"}]';
}  

add_action( 'wp_ajax_get_aeroportos', 'get_aeroportos' );
add_action( 'wp_ajax_nopriv_get_aeroportos', 'get_aeroportos' );
function get_aeroportos(){
    
    return json_decode('[{"cidade":"Aalborg, Dinamarca, Aalborg","codigo":"AAL"},{"cidade":"Aarhus, Dinamarca, Aarhus","codigo":"AAR"},{"cidade":"Abadan, Ir\u00e3, Abadan","codigo":"ABD"},{"cidade":"Abakan, R\u00fassia, Abakan","codigo":"ABA"},{"cidade":"Abbotsford, Canad\u00e1,\u00a0International","codigo":"YXX"},{"cidade":"Aberdeen, Estados Unidos da Am\u00e9rica, Aberdeen","codigo":"ABR"},{"cidade":"Aberdeen, Reino Unido, Dyce","codigo":"ABZ"},{"cidade":"Abha, Ar\u00e1bia Saudita, Abha","codigo":"AHB"},{"cidade":"Abidjan, Costa do Marfim, F. Houphouet Boigny","codigo":"ABJ"},{"cidade":"Abilene, Estados Unidos da Am\u00e9rica, Abilene Regional","codigo":"ABI"},{"cidade":"Abingdon, Austr\u00e1lia","codigo":"ABG"},{"cidade":"Abu Dhabi, Emirados \u00c1rabes Unidos, International","codigo":"AUH"},{"cidade":"Abuja, Nig\u00e9ria, NNamdi Azikiwe","codigo":"ABV"},{"cidade":"Abu Musa Island, Ir\u00e3, Abu Musa","codigo":"AEU"},{"cidade":"Abu Simbel, Egito, Abu Simbel","codigo":"ABS"},{"cidade":"Acapulco, M\u00e9xico, Juan N. Alvarez International","codigo":"ACA"},{"cidade":"Achutupo, Panam\u00e1, Achutupo","codigo":"ACU"},{"cidade":"Acra, Gana, Kotoka International","codigo":"ACC"},{"cidade":"Adado, Som\u00e1lia, Adado","codigo":"AAD"},{"cidade":"Adampur, \u00cdndia, Adampur","codigo":"AIP"},{"cidade":"Adana, Turquia, Sakirpasa","codigo":"ADA"},{"cidade":"Adelaide, Austr\u00e1lia, Adelaide Airport","codigo":"ADL"},{"cidade":"Aden, I\u00eamen, Aden International","codigo":"ADE"},{"cidade":"Adis Abeba, Eti\u00f3pia, Bole","codigo":"ADD"},{"cidade":"Adiyaman, Turquia, Adiyaman","codigo":"ADF"},{"cidade":"Adrar, Arg\u00e9lia, Touat","codigo":"AZR"},{"cidade":"Agades, N\u00edger, Manu Dayak International","codigo":"AJY"},{"cidade":"Agadir, Marrocos, Al Massira","codigo":"AGA"},{"cidade":"Agartala, \u00cdndia, Agartala","codigo":"IXA"},{"cidade":"Agatti Island, \u00cdndia, Agatti Island","codigo":"AGX"},{"cidade":"Agen, Fran\u00e7a, La Garenne","codigo":"AGF"},{"cidade":"Agra, \u00cdndia, Agra","codigo":"AGR"},{"cidade":"Agri, Turquia","codigo":"AJI"},{"cidade":"Aguadilla, Porto Rico, Rafael Hern\u00e1ndez","codigo":"BQN"},{"cidade":"Aguascalientes, M\u00e9xico, Jes\u00fas Teran Peredo International","codigo":"AGU"},{"cidade":"Ahmedabad, \u00cdndia, S. Vallabhbhai Patel","codigo":"AMD"},{"cidade":"Ahwaz, Ir\u00e3, Ahwaz","codigo":"AWZ"},{"cidade":"Aizawl, \u00cdndia, Lengpui","codigo":"AJL"},{"cidade":"Ajaccio, Fran\u00e7a, Napoleon Bonaparte","codigo":"AJA"},{"cidade":"Akita, Jap\u00e3o, Akita","codigo":"AXT"},{"cidade":"Akron Canton, Estados Unidos da Am\u00e9rica, Akron Canton","codigo":"CAK"},{"cidade":"Aksu, China, Aksu","codigo":"AKU"},{"cidade":"Aktau, Cazaquist\u00e3o, Aktau","codigo":"SCO"},{"cidade":"Aktobe, Cazaquist\u00e3o, Aktobe","codigo":"AKX"},{"cidade":"Akulivik, Canad\u00e1, Akulivik","codigo":"AKV"},{"cidade":"Akure, Nig\u00e9ria, Akure","codigo":"AKR"},{"cidade":"Akureyri, Isl\u00e2ndia, Akureyri","codigo":"AEY"},{"cidade":"Al Ain, Emirados \u00c1rabes Unidos","codigo":"AAN"},{"cidade":"Al-Baha, Ar\u00e1bia Saudita, Al Aqiq","codigo":"ABT"},{"cidade":"Albany, Austr\u00e1lia, Albany","codigo":"ALH"},{"cidade":"Albany, Estados Unidos da Am\u00e9rica, Albany","codigo":"ALB"},{"cidade":"Albany, Estados Unidos da Am\u00e9rica, Southwest Ge\u00f3rgia","codigo":"ABY"},{"cidade":"Albenga, It\u00e1lia, Albenda","codigo":"ALL"},{"cidade":"Albuquerque, Estados Unidos da Am\u00e9rica, Internacional Sunport","codigo":"ABQ"},{"cidade":"Albury, Austr\u00e1lia, Albury","codigo":"ABX"},{"cidade":"Aldan, R\u00fassia, Aldan","codigo":"ADH"},{"cidade":"Alderney, Reino Unido, Alderney","codigo":"ACI"},{"cidade":"Alepo, S\u00edria, Aleppo International","codigo":"ALP"},{"cidade":"Alesund, Noruega, Vigra","codigo":"AES"},{"cidade":"Alexandria, Egito, Borg El Arab","codigo":"HBE"},{"cidade":"Alexandria, Estados Unidos da Am\u00e9rica, Alexandria","codigo":"AEX"},{"cidade":"Alexandroupolis, Gr\u00e9cia, Demokritos","codigo":"AXD"},{"cidade":"Al Ghaydah, I\u00eamen, Al GHaydah","codigo":"AAY"},{"cidade":"Alghero, It\u00e1lia, Fertilia","codigo":"AHO"},{"cidade":"Al Hoceima, Marrocos, Cherif Al Idriss","codigo":"AHU"},{"cidade":"Alicante, Espanha, Airport","codigo":"ALC"},{"cidade":"Alice Springs, Austr\u00e1lia, Alice Springs Airport","codigo":"ASP"},{"cidade":"Allahabad, \u00cdndia, Allahabad","codigo":"IXD"},{"cidade":"Allentown,Estados Unidos da Am\u00e9rica, Lehigh Valley International","codigo":"ABE"},{"cidade":"Almaty, Cazaquist\u00e3o, Almaty International","codigo":"ALA"},{"cidade":"Almeria, Espanha, Almeira","codigo":"LEI"},{"cidade":"Al Najaf, Iraque, As Ashraf International","codigo":"NJF"},{"cidade":"Alor, Indon\u00e9sia, Mali","codigo":"ARD"},{"cidade":"Alor Setar, Mal\u00e1sia, Sultan Abdul Halim","codigo":"AOR"},{"cidade":"Alpena, Estados Unidos da Am\u00e9rica, Alpena County","codigo":"APN"},{"cidade":"Alta Floresta, Brasil, Oswaldo Marques Dias","codigo":"AFL"},{"cidade":"Altai, Mong\u00f3lia, Altai","codigo":"LTI"},{"cidade":"Altamira, Brasil, Altamira","codigo":"ATM"},{"cidade":"Alta, Noruega, Alta","codigo":"ALF"},{"cidade":"Altay, China, Altay","codigo":"AAT"},{"cidade":"Altenburg, Alemanha, Nobitz","codigo":"AOC"},{"cidade":"Altenrhein, Su\u00ed\u00e7a, St.Gallen","codigo":"ACH"},{"cidade":"Altoona, Estados Unidos da Am\u00e9rica, Blair County","codigo":"AOO"},{"cidade":"Al Ula, Ar\u00e1bia Saudita, Majed Bin Adulaziz","codigo":"ULH"},{"cidade":"Am\u00e3, Jord\u00e2nia, Amman Queen Alia","codigo":"AMM"},{"cidade":"Amakusa, Jap\u00e3o, Amakusa","codigo":"AXJ"},{"cidade":"Amami, Jap\u00e3o, Amami","codigo":"ASJ"},{"cidade":"Amarillo, Estados Unidos da Am\u00e9rica, Rick Husband International","codigo":"AMA"},{"cidade":"Amasya, Turquia, Merzifon","codigo":"MZH"},{"cidade":"Ambon, Indon\u00e9sia, Pattimura","codigo":"AMQ"},{"cidade":"Amboseli, Qu\u00eania, Amboseli","codigo":"ASV"},{"cidade":"Amesterd\u00e3, Holanda, Amsterdam Schiphol Airport","codigo":"AMS"},{"cidade":"Amgu, R\u00fassia, Amgu","codigo":"AEM"},{"cidade":"Amritsar, \u00cdndia, Sri Guru Ram Dass Jee","codigo":"ATQ"},{"cidade":"Anadyr, R\u00fassia, Ugolny","codigo":"DYR"},{"cidade":"Anahim Lake, Canad\u00e1,\u00a0Anahim Lake","codigo":"YAA"},{"cidade":"Anapa, R\u00fassia, Vityazevo","codigo":"AAQ"},{"cidade":"Ancara, Turquia, Esenboga","codigo":"ESB"},{"cidade":"Anchorage, Estados Unidos da Am\u00e9rica, Ted Stevens","codigo":"ANC"},{"cidade":"Ancona, It\u00e1lia, Falconara","codigo":"AOI"},{"cidade":"Ancud, Chile, Pupelde","codigo":"ZUD"},{"cidade":"Andahuaylas, Peru, Andahuaylas","codigo":"ANS"},{"cidade":"Andenes, Noruega, Andoya","codigo":"ANX"},{"cidade":"Andizhan, Uzbequist\u00e3o, Andizhan","codigo":"AZN"},{"cidade":"Angelholm Helsingborg, Su\u00e9cia, Angelholm Airport","codigo":"AGH"},{"cidade":"Angers, Fran\u00e7a, Marce","codigo":"ANE"},{"cidade":"Anglesey, Reino Unido, Valley","codigo":"VLY"},{"cidade":"Angouleme, Fran\u00e7a, Brie Champniers","codigo":"ANG"},{"cidade":"Aniak, Estados Unidos da Am\u00e9rica, Aniak","codigo":"ANI"},{"cidade":"Anjouan, Comores, Ouani","codigo":"AJN"},{"cidade":"Annaba, Arg\u00e9lia, Rabah Bitat","codigo":"AAE"},{"cidade":"Annecy, Fran\u00e7a, Meythet","codigo":"NCY"},{"cidade":"Ann, Mianmar, Ann","codigo":"VBA"},{"cidade":"Annobon, Guin\u00e9 Equatorial, Annobon","codigo":"NBN"},{"cidade":"Anqing, China, Tianzhushan","codigo":"AQG"},{"cidade":"Anshan, China, Tang Ao","codigo":"AOG"},{"cidade":"Anshun, China, Huangguoshu","codigo":"AVA"},{"cidade":"Antalya, Turquia, Antalya","codigo":"AYT"},{"cidade":"Antananarivo, Madag\u00e1scar, Ivato International","codigo":"TNR"},{"cidade":"Antigua, Antigua e Barbuda, VC Bird International","codigo":"ANU"},{"cidade":"Antique, Filipinas, Evelio Javier","codigo":"EUQ"},{"cidade":"Antofagasta, Chile, Cerro Moreno","codigo":"ANF"},{"cidade":"Antsiranana, Madag\u00e1scar, Arrachart","codigo":"DIE"},{"cidade":"Antu\u00e9rpia, B\u00e9lgica, Antwerp International","codigo":"ANR"},{"cidade":"Aomori, Jap\u00e3o, Aomori","codigo":"AOJ"},{"cidade":"Apartado, Col\u00f4mbia, Carepa Ar Betancourt","codigo":"APO"},{"cidade":"Appleton, Estados Unidos da Am\u00e9rica, Appleton International","codigo":"ATW"},{"cidade":"Aqaba, Jord\u00e2nia, King Hussein International","codigo":"AQJ"},{"cidade":"Aracaju, Brasil, Santa Maria","codigo":"AJU"},{"cidade":"Aracati, Brasil, Dragao do Mar","codigo":"ARX"},{"cidade":"Arad, Rom\u00eania, Arad","codigo":"ARW"},{"cidade":"Arak, Ir\u00e3, Arak","codigo":"AJK"},{"cidade":"Arar, Ar\u00e1bia Saudita, Arar","codigo":"RAE"},{"cidade":"Arathusa Safari Lodge, \u00c1frica do Sul, Arathusa Safari Lodge","codigo":"ASS"},{"cidade":"Arauca, Col\u00f4mbia,Santiago P\u00e9rez","codigo":"AUC"},{"cidade":"Arax\u00e1, Brasil, Arax\u00e1","codigo":"AXX"},{"cidade":"Arba Mintch, Eti\u00f3pia, Arba Minch","codigo":"AMH"},{"cidade":"Arcata\u00a0Eureka, Estados Unidos da Am\u00e9rica, Arcata-Eureka","codigo":"ACV"},{"cidade":"Arctic Bay, Canad\u00e1, Arctic Bay","codigo":"YAB"},{"cidade":"Ardabil, Ir\u00e3, Ardabil","codigo":"ADU"},{"cidade":"Are Ostersund, Su\u00e9cia, Are Ostersund","codigo":"OSD"},{"cidade":"Arequipa, Peru, Rodriguez Ballon","codigo":"AQP"},{"cidade":"Argel, Arg\u00e9lia, Houari Boumediene","codigo":"ALG"},{"cidade":"Argyle, Austr\u00e1lia","codigo":"GYL"},{"cidade":"Arica, Chile, Chacalluta","codigo":"ARI"},{"cidade":"Arkhangelsk, R\u00fassia, Talagi","codigo":"ARH"},{"cidade":"Armenia, Col\u00f4mbia, El Ed\u00e9n","codigo":"AXM"},{"cidade":"Armidale, Austr\u00e1lia, Armidale","codigo":"ARM"},{"cidade":"Arthurs Town, Bahamas, Arthurs Town","codigo":"ATC"},{"cidade":"Arua, Uganda, Arua","codigo":"RUA"},{"cidade":"Arusha, Tanz\u00e2nia, Arusha","codigo":"ARK"},{"cidade":"Arviat, Canad\u00e1, Arviat Eskimo Point","codigo":"YEK"},{"cidade":"Arvidsjaur, Su\u00e9cia, Arvidsjaur","codigo":"AJR"},{"cidade":"Arxan, China, Yiershi Airport","codigo":"YIE"},{"cidade":"Asaba, Nig\u00e9ria, International","codigo":"ABB"},{"cidade":"Asahikawa, Jap\u00e3o, Asahikawa","codigo":"AKJ"},{"cidade":"Asalouyeh, Ir\u00e3, Persian Gulf International","codigo":"PGU"},{"cidade":"Asheville, Estados Unidos da Am\u00e9rica, Asheville","codigo":"AVL"},{"cidade":"Ashgabat, Turcomenist\u00e3o, Ashgabat International","codigo":"ASB"},{"cidade":"Asmara, Eritreia, Asmara","codigo":"ASM"},{"cidade":"Asosa, Eti\u00f3pia, Asosa","codigo":"ASO"},{"cidade":"Aspen, Estados Unidos da Am\u00e9rica, Pitkin-County","codigo":"ASE"},{"cidade":"Assiut, Egito, Asyut","codigo":"ATZ"},{"cidade":"Assu\u00e3o, Egito, Aswan International","codigo":"ASW"},{"cidade":"Assun\u00e7\u00e3o, Paraguai, Silvio Pettirossi","codigo":"ASU"},{"cidade":"Astrakhan, R\u00fassia, Astrakhan","codigo":"ASF"},{"cidade":"Astypalaia Island, Gr\u00e9cia","codigo":"JTY"},{"cidade":"Atambua, Indon\u00e9sia, Haliwen","codigo":"ABU"},{"cidade":"Atar, Maurit\u00e2nia, Mouakchott","codigo":"ATR"},{"cidade":"Atenas, Gr\u00e9cia, Athens Int. E Venizelos","codigo":"ATH"},{"cidade":"Atlanta, Estados Unidos da Am\u00e9rica, Hartsfield-Jackson","codigo":"ATL"},{"cidade":"Atlantic City, Estados Unidos da Am\u00e9rica, Atlantic City International","codigo":"ACY"},{"cidade":"Attawapiskat, , Canad\u00e1, Attawapiskat","codigo":"YAT"},{"cidade":"Atyrau, Cazaquist\u00e3o, Atyrau","codigo":"GUW"},{"cidade":"Auckland, Austr\u00e1lia, Auckland International","codigo":"AKL"},{"cidade":"Augusta, Estados Unidos da Am\u00e9rica, Bush Field","codigo":"AGS"},{"cidade":"Aupaluk, Canad\u00e1, Inukjuak","codigo":"YPJ"},{"cidade":"Aurangabad, \u00cdndia, Aurangabad","codigo":"IXU"},{"cidade":"Aurillac, Fran\u00e7a, Aurillac","codigo":"AUR"},{"cidade":"Aurukun, Austr\u00e1lia","codigo":"AUU"},{"cidade":"Austin, Estados Unidos da Am\u00e9rica, Austin Bergstrom International","codigo":"AUS"},{"cidade":"Avignon, Fran\u00e7a, Caumont","codigo":"AVN"},{"cidade":"Awassa, Eti\u00f3pia, Awasa","codigo":"AWA"},{"cidade":"Axum, Eti\u00f3pia, Axum","codigo":"AXU"},{"cidade":"Ayacucho, Peru, Alfredo M Duarte","codigo":"AYP"},{"cidade":"Ayers Rock, Austr\u00e1lia, Connellan Airport","codigo":"AYQ"},{"cidade":"Babau, Indon\u00e9sia","codigo":"BUW"},{"cidade":"Bacau, Rom\u00eania, Bacau","codigo":"BCM"},{"cidade":"Bacolod, Filipinas, Silay International","codigo":"BCD"},{"cidade":"Badajoz, Espanha, Badajoz","codigo":"BJZ"},{"cidade":"Badu Island, Austr\u00e1lia","codigo":"BDD"},{"cidade":"Bafoussam, Camar\u00f5es, Bafoussam","codigo":"BFX"},{"cidade":"Bagan Nyaung U, Mianmar","codigo":"NYU"},{"cidade":"Bagdogra, \u00cdndia, Bagdogra","codigo":"IXB"},{"cidade":"Bag\u00e9, Brasil, Gustavo Craemer","codigo":"BGX"},{"cidade":"Baghdad, Iraque, Baghdad International","codigo":"BGW"},{"cidade":"Bahar Dar, Eti\u00f3pia, Bahar Dar","codigo":"BJR"},{"cidade":"Bahawalpur, Paquist\u00e3o, Bahawalpur","codigo":"BHV"},{"cidade":"Bahia Blanca, Argentina, Comandante Espora","codigo":"BHI"},{"cidade":"Bahia Pina, Panam\u00e1, Bahia Pina","codigo":"BFQ"},{"cidade":"Bahrain, Bahrain International","codigo":"BAH"},{"cidade":"Baia Mare, Rom\u00eania, Baia Mare","codigo":"BAY"},{"cidade":"Baicheng, China, Changan","codigo":"DBC"},{"cidade":"Baie Comeau, Canad\u00e1, Baie Comeau","codigo":"YBC"},{"cidade":"Baise, China, Youjiang","codigo":"AEB"},{"cidade":"Baishan, China, Changbaishan","codigo":"NBS"},{"cidade":"Bajawa, Indon\u00e9sia, Soa","codigo":"BJW"},{"cidade":"Bakelalan, Mal\u00e1sia, Bakelalan","codigo":"BKM"},{"cidade":"Bakersfield, Estados Unidos da Am\u00e9rica, Meadows Field","codigo":"BFL"},{"cidade":"Baku, Azerbaij\u00e3o, Heydar Aliyev International","codigo":"GYD"},{"cidade":"Baku, Azerbaij\u00e3o , Todos Aeroportos","codigo":"BAK"},{"cidade":"Baku, Azerbaij\u00e3o, Zabrat Airport","codigo":"ZXT"},{"cidade":"Balboa, Panam\u00e1, Panama Pacifico","codigo":"BLB"},{"cidade":"Balikpapan, Indon\u00e9sia, Sepinggan","codigo":"BPN"},{"cidade":"Balkanabat, Turcomenist\u00e3o, Balkanabat","codigo":"BKN"},{"cidade":"Balkhash, Cazaquist\u00e3o, Balkhash","codigo":"BXH"},{"cidade":"Ballina, Austr\u00e1lia, Byron Gateway","codigo":"BNK"},{"cidade":"Balmaceda, Chile, Balmaceda","codigo":"BBA"},{"cidade":"Balti, Mold\u00e1via, Balti International","codigo":"BZY"},{"cidade":"Baltimore, Estados Unidos da Am\u00e9rica, Baltimore, Washington","codigo":"BWI"},{"cidade":"Bamako, Mali, Senou International","codigo":"BKO"},{"cidade":"Bamenda, Camar\u00f5es, Bamenda","codigo":"BPC"},{"cidade":"Bam, Ir\u00e3, Bam","codigo":"BXR"},{"cidade":"Bamyan, Afeganist\u00e3o, Bamyan","codigo":"BIN"},{"cidade":"Banda Aceh, Indon\u00e9sia","codigo":"BTJ"},{"cidade":"Bandar Abbas, Ir\u00e3, Bandar Abbas","codigo":"BND"},{"cidade":"Bandar Lampung, Indon\u00e9sia, Radin Inten II","codigo":"TKG"},{"cidade":"Bandar Lengeh, Ir\u00e3, Bandar Lengeh","codigo":"BDH"},{"cidade":"Bandar Mahshahr, Ir\u00e3, Bandar Mahshahr","codigo":"MRX"},{"cidade":"Bandar Seri Begawan, Brunei, Brunei International","codigo":"BWN"},{"cidade":"Bandung, Indon\u00e9sia","codigo":"BDO"},{"cidade":"Bangalore, \u00cdndia, Kempegowda International","codigo":"BLR"},{"cidade":"Bangkok,Tail\u00e2ndia, Don Mueang International","codigo":"DMK"},{"cidade":"Bangkok, Tail\u00e2ndia, Suvarnabhumi","codigo":"BKK"},{"cidade":"Bangor, Estados Unidos da Am\u00e9rica, Bangor","codigo":"BGR"},{"cidade":"Bangui, Rep\u00fablica Centro Africana, Mpoko International","codigo":"BGF"},{"cidade":"Banja Luka, B\u00f3snia e Herzegovina, Banja Luka International","codigo":"BNX"},{"cidade":"Banjarmasin, Indon\u00e9sia, Syamsudin Noor","codigo":"BDJ"},{"cidade":"Banjul Yundum, G\u00e2mbia, International","codigo":"BJL"},{"cidade":"Banyuwangi, Indon\u00e9sia, Blimbingsari","codigo":"BWX"},{"cidade":"Baoshan, China, Baoshan","codigo":"BSD"},{"cidade":"Baotou, China, Erliban","codigo":"BAV"},{"cidade":"Baracoa, Cuba, Gustavo Rizo","codigo":"BCA"},{"cidade":"Barcaldine, Austr\u00e1lia","codigo":"BCI"},{"cidade":"Barcelona, Espanha, Barcelona","codigo":"BCN"},{"cidade":"Barcelona, Venezuela, J A Anzoategui","codigo":"BLA"},{"cidade":"Bardufoss, Noruega, bardufoss","codigo":"BDU"},{"cidade":"Bar Harbor, Estados Unidos da Am\u00e9rica, Hancock County","codigo":"BHB"},{"cidade":"Bari, It\u00e1lia, Palese","codigo":"BRI"},{"cidade":"Bariloche, Argentina, Bariloche","codigo":"BRC"},{"cidade":"Barinas, Venezuela, Barinas","codigo":"BNS"},{"cidade":"Bario, Mal\u00e1sia, Bario","codigo":"BBN"},{"cidade":"Barisal, Bangladesh, Barisal","codigo":"BZL"},{"cidade":"Barnaul, R\u00fassia, Barnaul","codigo":"BAX"},{"cidade":"Barquisimeto, Venezuela, jacinto Lara","codigo":"BRM"},{"cidade":"Barra do Gar\u00e7as, Brasil, Barra do Gar\u00e7as","codigo":"BPG"},{"cidade":"Barrancabermeja, Col\u00f4mbia, Yariguies","codigo":"EJA"},{"cidade":"Barra North Bay, Reino Unido","codigo":"BRR"},{"cidade":"Barranquilla, Col\u00f4mbia, Ernesto Cortissoz","codigo":"BAQ"},{"cidade":"Barreiras, Brasil, Barreiras","codigo":"BRA"},{"cidade":"Barrow, Estados Unidos da Am\u00e9rica, Memorial Wiley Post-Will Rogers","codigo":"BRW"},{"cidade":"Basco, Filipinas, Basco","codigo":"BSO"},{"cidade":"Basileia, Su\u00ed\u00e7a, Basel Euroairport","codigo":"BSL"},{"cidade":"Basrah, Iraque, Basrah International","codigo":"BSR"},{"cidade":"Basseterre, St Kitts, S\u00e3o Crist\u00f3v\u00e3o e N\u00e9vis, Robert L Bradshaw","codigo":"SKB"},{"cidade":"Batagay, R\u00fassia, Batagay","codigo":"BQJ"},{"cidade":"Bata, Guin\u00e9 Equatorial, Bata","codigo":"BSG"},{"cidade":"Batam, Indon\u00e9sia, Hang Nadim","codigo":"BTH"},{"cidade":"Batavia Downs, Austr\u00e1lia","codigo":"BVW"},{"cidade":"Bathinda, \u00cdndia, Bathinda","codigo":"BUP"},{"cidade":"Bathurst, Austr\u00e1lia","codigo":"BHS"},{"cidade":"Bathurst, Canad\u00e1, Bathurst","codigo":"ZBF"},{"cidade":"Batman, Turquia, Batman","codigo":"BAL"},{"cidade":"Batna, Arg\u00e9lia, Moustepha Ben Boulaid","codigo":"BLJ"},{"cidade":"Baton Rouge, Estados Unidos da Am\u00e9rica, Metropolita Ryan Field","codigo":"BTR"},{"cidade":"Batsfjord, Noruega, Batsfjord","codigo":"BJF"},{"cidade":"Batticaloa, Sri Lanka, Batticaloa Airport","codigo":"BTC"},{"cidade":"Batu Licin, Indon\u00e9sia","codigo":"BTW"},{"cidade":"Batumi, Ge\u00f3rgia, Batumi","codigo":"BUS"},{"cidade":"Bauchi, Nig\u00e9ria, Bauchi","codigo":"BCU"},{"cidade":"Bayamo, Cuba, Carlos M. de Cespedes","codigo":"BYM"},{"cidade":"Bayannur, China, Tianjitai","codigo":"RLK"},{"cidade":"Bazhong, China, Enyang","codigo":"BZX"},{"cidade":"Beaumont\u00a0Port Arthur, Estados Unidos da Am\u00e9rica, Jack Brooks Regional","codigo":"BPT"},{"cidade":"Bechar, Arg\u00e9lia, Boudghene B Ali Loft","codigo":"CBH"},{"cidade":"Bedford, Estados Unidos da Am\u00e9rica, Laurence G.\u00a0Hanscom Field","codigo":"BED"},{"cidade":"Bedourie, Austr\u00e1lia","codigo":"BEU"},{"cidade":"Beida, L\u00edbia, Labraq","codigo":"LAQ"},{"cidade":"Beihai, China, Fucheng","codigo":"BHY"},{"cidade":"Beira, Mo\u00e7ambique, Beira","codigo":"BEW"},{"cidade":"Beirute, L\u00edbano, Rafic Hariri","codigo":"BEY"},{"cidade":"Bejaia, Arg\u00e9lia, Soumman Abane Ramdane","codigo":"BJA"},{"cidade":"Belaya Gora, R\u00fassia, Belaya Gora","codigo":"BGN"},{"cidade":"Bel\u00e9m, Brasil, Val de Cans","codigo":"BEL"},{"cidade":"Beletwene, Som\u00e1lia, Beletwene","codigo":"BLW"},{"cidade":"Belfast, Reino Unido, George Best City","codigo":"BHD"},{"cidade":"Belgau, \u00cdndia, Sambre","codigo":"IXG"},{"cidade":"Belgorod, R\u00fassia, Belgorod","codigo":"EGO"},{"cidade":"Belgrado, S\u00e9rvia, Nikola Tesla","codigo":"BEG"},{"cidade":"Belize City, Belize, Philip S. W. Goldson","codigo":"BZE"},{"cidade":"Bella Bella, Canad\u00e1, Campbell Island","codigo":"ZEL"},{"cidade":"Bella Coola, Canad\u00e1, Bella Coola","codigo":"QBC"},{"cidade":"Bellingham, Estados Unidos da Am\u00e9rica, Bellingham International","codigo":"BLI"},{"cidade":"Belmopan, Belize, Hector Silva","codigo":"BCV"},{"cidade":"Belo Horizonte, Brasil , Todos Aeroportos","codigo":"BHZ"},{"cidade":"Beloyarsky, R\u00fassia, Beloyarsky","codigo":"EYK"},{"cidade":"Bemidji, Estados Unidos da Am\u00e9rica, Bemidji","codigo":"BJI"},{"cidade":"Benbecula, Reino Unido, Benbecula","codigo":"BEB"},{"cidade":"Bendigo, Austr\u00e1lia","codigo":"BXG"},{"cidade":"Benghazi, L\u00edbia, Benina International","codigo":"BEN"},{"cidade":"Bengkulu, Indon\u00e9sia, Fatmawati Soekarno","codigo":"BKS"},{"cidade":"Beni Mellal, Marrocos, Beni Millal Nacional","codigo":"BEM"},{"cidade":"Benin City, Nig\u00e9ria, Benin","codigo":"BNI"},{"cidade":"Beni, Rep\u00fablica Democr\u00e1tica do Congo, Maivi","codigo":"BNC"},{"cidade":"Bentota, Sri Lanka, Bentota, River","codigo":"BJT"},{"cidade":"Bergen, Noruega, Flesland","codigo":"BGO"},{"cidade":"Bergerac, Fran\u00e7a, Roumaniere","codigo":"EGC"},{"cidade":"Berlevag, Noruega, Berlevag","codigo":"BVG"},{"cidade":"Berlim, Alemanha, Schoenefeld","codigo":"SXF"},{"cidade":"Berlim, Alemanha, Tegel","codigo":"TXL"},{"cidade":"Berlim, Alemanha , Todos Aeroportos","codigo":"BER"},{"cidade":"Berna, Su\u00ed\u00e7a, Berm Help","codigo":"BRN"},{"cidade":"Bertoua, Camar\u00f5es, Bertoua","codigo":"BTA"},{"cidade":"Bethel, Estados Unidos da Am\u00e9rica, Bethel","codigo":"BET"},{"cidade":"Beziers, Fran\u00e7a, Vias","codigo":"BZR"},{"cidade":"Bhadrapur, Nepal, Chandragri","codigo":"BDP"},{"cidade":"Bhairawa, Nepal, Gautam Buddha","codigo":"BWA"},{"cidade":"Bhamo, Mianmar, Bhamo","codigo":"BMO"},{"cidade":"Bharatpur, Nepal, Bharatpur","codigo":"BHR"},{"cidade":"Bhavnagar, \u00cdndia, Bhavnagar","codigo":"BHU"},{"cidade":"Bhopal, \u00cdndia, Raja Bhoj","codigo":"BHO"},{"cidade":"Bhubaneswar, \u00cdndia, Biju Patnaik","codigo":"BBI"},{"cidade":"Bhuj, \u00cdndia, Shyamji Krishna Verma","codigo":"BHJ"},{"cidade":"Biak, Indon\u00e9sia, Frans Kasiepo","codigo":"BIK"},{"cidade":"Biarritz, Fran\u00e7a, Pays Basque","codigo":"BIQ"},{"cidade":"Bijie, China, Bijie","codigo":"BFJ"},{"cidade":"Bikaner, \u00cdndia, Nal","codigo":"BKB"},{"cidade":"Bilbao, Espanha, Bilbao Airport","codigo":"BIO"},{"cidade":"Bildudalur, Isl\u00e2ndia, Bildudalur","codigo":"BIU"},{"cidade":"Billings, Estados Unidos da Am\u00e9rica, Logan","codigo":"BIL"},{"cidade":"Billund, Dinamarca, Billund","codigo":"BLL"},{"cidade":"Bima, Indon\u00e9sia","codigo":"BMU"},{"cidade":"Bimini, Bahamas, South Bimini","codigo":"BIM"},{"cidade":"Binghamton, Estados Unidos da Am\u00e9rica, Greater Binghamton","codigo":"BGM"},{"cidade":"Bingol, Turquia, Bingol","codigo":"BGG"},{"cidade":"Bintulu, Mal\u00e1sia, Bintulu Airport","codigo":"BTU"},{"cidade":"Biratnagar, Nepal, Biratnagar","codigo":"BIR"},{"cidade":"Birdsville, Austr\u00e1lia","codigo":"BVI"},{"cidade":"Birjand, Ir\u00e3, Birjand","codigo":"XBJ"},{"cidade":"Birmingham, Estados Unidos da Am\u00e9rica, Shuttlesworth","codigo":"BHM"},{"cidade":"Birmingham, Reino Unido, Birmingham","codigo":"BHX"},{"cidade":"Bisha, Ar\u00e1bia Saudita, Bisha","codigo":"BHH"},{"cidade":"Bishkek, Quirguist\u00e3o, Manas International","codigo":"FRU"},{"cidade":"Biskra, Arg\u00e9lia, Mohamed Khider","codigo":"BSK"},{"cidade":"Bismarck, Estados Unidos da Am\u00e9rica, Bismarck","codigo":"BIS"},{"cidade":"Bissau, Guin\u00e9-Bissau, Osvaldo Vieira","codigo":"OXB"},{"cidade":"Blackall, Austr\u00e1lia","codigo":"BKQ"},{"cidade":"Blagoveschensk, R\u00fassia, Ignatyevo","codigo":"BQS"},{"cidade":"Blanc Sablon, Canad\u00e1, Lourdes de Blancsablon","codigo":"YBX"},{"cidade":"Blantyre, Mal\u00e1ui, Chileka International","codigo":"BLZ"},{"cidade":"Bloemfontein, \u00c1frica do Sul, Bloemfontein International","codigo":"BFN"},{"cidade":"Bloomington\u00a0Normal, Estados Unidos da Am\u00e9rica, Central Illinois Regional","codigo":"BMI"},{"cidade":"Boa Vista, Brasil, Boa Vista","codigo":"BVB"},{"cidade":"Bobo Dioulasso, Burkina Faso, Bobo Dioulasso","codigo":"BOY"},{"cidade":"Bocas Del Toro, Panam\u00e1, Isla Colon","codigo":"BOC"},{"cidade":"Bodaybo, R\u00fassia, Bodaybo","codigo":"ODO"},{"cidade":"Bodo, Noruega, Bodo","codigo":"BOO"},{"cidade":"Bodrum, Turquia, Milas","codigo":"BJV"},{"cidade":"Bogorodskoye, R\u00fassia, Bogorodskoye","codigo":"BQG"},{"cidade":"Bogot\u00e1, Col\u00f4mbia, El Dorado","codigo":"BOG"},{"cidade":"Boigu Island, Austr\u00e1lia","codigo":"GIC"},{"cidade":"Boise, Estados Unidos da Am\u00e9rica, Air Terminal\u00a0Gowen Field","codigo":"BOI"},{"cidade":"Bojnurd, Ir\u00e3, Bojnurd","codigo":"BJB"},{"cidade":"Bokpyin, Mianmar, Bokpyin","codigo":"VBP"},{"cidade":"Bole, China, Alashankou","codigo":"BPL"},{"cidade":"Bolonha, It\u00e1lia, Guglielmo Marconi","codigo":"BLQ"},{"cidade":"Bolzano bozen, It\u00e1lia, Dolomiti","codigo":"BZO"},{"cidade":"Bom Jesus da Lapa, Brasil","codigo":"LZA"},{"cidade":"Bom Jesus da Lapa, Brasil, Bom Jesus da Lapa","codigo":"LAZ"},{"cidade":"Bonaventure, Canad\u00e1, Bonaventure","codigo":"YVB"},{"cidade":"Bordeaux, Fran\u00e7a, M\u00e9rignac","codigo":"BOD"},{"cidade":"Bordj Mokhtar, Arg\u00e9lia, Bordj Mokhtar","codigo":"BMW"},{"cidade":"Borlange Falun, Su\u00e9cia, Dala Airport","codigo":"BLE"},{"cidade":"Bornholm, Dinamarca, Ronne","codigo":"RNN"},{"cidade":"Bor, R\u00fassia, Podkamennaya Tunguska","codigo":"TGP"},{"cidade":"Bosaso, Som\u00e1lia, Bosaso International","codigo":"BSA"},{"cidade":"Boston, Estados Unidos da Am\u00e9rica, Edward L Logan","codigo":"BOS"},{"cidade":"Bouake, Costa do Marfim, Bouake","codigo":"BYK"},{"cidade":"Boulia, Austr\u00e1lia","codigo":"BQL"},{"cidade":"Bournemouth, Reino Unido, Bournemouth International","codigo":"BOH"},{"cidade":"Bovanenkovo, R\u00fassia, Bovanenkovo","codigo":"BVJ"},{"cidade":"Bozeman, Estados Unidos da Am\u00e9rica, Yellowstone","codigo":"BZN"},{"cidade":"Brac, Cro\u00e1cia, Bol","codigo":"BWK"},{"cidade":"Bragan\u00e7a, Portugal, Braganca","codigo":"BGC"},{"cidade":"Brainerd, Estados Unidos da Am\u00e9rica, Brainerd Lakes","codigo":"BRD"},{"cidade":"Bras\u00edlia, Brasil, Juscelino Kubitschek","codigo":"BSB"},{"cidade":"Bratislava, Eslov\u00e1quia, M R Stefanik","codigo":"BTS"},{"cidade":"Bratsk, R\u00fassia, Bratsk","codigo":"BTK"},{"cidade":"Brazzaville, Rep\u00fablica do Congo, Maya Maya","codigo":"BZV"},{"cidade":"Bremen\u00a0, Alemanha, Bremen","codigo":"BRE"},{"cidade":"Brest, Bielor\u00fassia, Brest","codigo":"BQT"},{"cidade":"Brest, Fran\u00e7a, Bretagne","codigo":"BES"},{"cidade":"Bridgetown, Barbados, Grantley Adams","codigo":"BGI"},{"cidade":"Brindisi, It\u00e1lia, Casale","codigo":"BDS"},{"cidade":"Brisbane, Austr\u00e1lia, Brisbane International Airport","codigo":"BNE"},{"cidade":"Bristol, Reino Unido, Bristol","codigo":"BRS"},{"cidade":"Brive La Gaillard, Fran\u00e7a, Vallee de la Dordogne","codigo":"BVE"},{"cidade":"Brize Norton, Reino Unido","codigo":"BZZ"},{"cidade":"Brno, Rep\u00fablica Tcheca, Turany","codigo":"BRQ"},{"cidade":"Broken Hill, Austr\u00e1lia, Broken Hill","codigo":"BHQ"},{"cidade":"Bronnoysund, Noruega, Bronnoy","codigo":"BNN"},{"cidade":"Broome, Austr\u00e1lia, Broome International","codigo":"BME"},{"cidade":"Brownsville, Estados Unidos da Am\u00e9rica, South Padre","codigo":"BRO"},{"cidade":"Brunswick, Estados Unidos da Am\u00e9rica, Golden Isles","codigo":"BQK"},{"cidade":"Bruxelas, B\u00e9gica, Brussels Zaventem","codigo":"BRU"},{"cidade":"Bruxelas Charleroi, B\u00e9lgica, Brussels Charleoi, ","codigo":"CRL"},{"cidade":"Bryansk, R\u00fassia, Bryansk","codigo":"BZK"},{"cidade":"Bucaramanga, Col\u00f4mbia, Palonegro","codigo":"BGA"},{"cidade":"Bucareste, Rom\u00eania, Bucharest Henri Coanda, ","codigo":"OTP"},{"cidade":"Budapeste, Hungria, Liszt Ferenc International","codigo":"BUD"},{"cidade":"Buenos Aires, Argentina, Ezeiza","codigo":"EZE"},{"cidade":"Buenos Aires, Argentina, J. Newbery","codigo":"AEP"},{"cidade":"Buenos Aires, Argentina , Todos aeroportos","codigo":"BUE"},{"cidade":"Buffalo, Estados Unidos da Am\u00e9rica, Buffalo Niagara","codigo":"BUF"},{"cidade":"Bugulma, R\u00fassia, Bugulma","codigo":"UUA"},{"cidade":"Bujumbura, Burundi, Bujumbura International","codigo":"BJM"},{"cidade":"Bukavu, Rep\u00fablica Democr\u00e1tica do Congo, Kavumu","codigo":"BKY"},{"cidade":"Bukhara, Uzbequist\u00e3o, International","codigo":"BHK"},{"cidade":"Bukoba, Tanz\u00e2nia, Bukoka","codigo":"BKZ"},{"cidade":"Bulawayo, Zimb\u00e1bue, Joshua M. Nkomo","codigo":"BUQ"},{"cidade":"Bullhead City, Estados Unidos da Am\u00e9rica, Laughlin Bullhead","codigo":"IFP"},{"cidade":"Bumba, Rep\u00fablica Democr\u00e1tica do Congo, Bumba","codigo":"BMB"},{"cidade":"Bundaberg, Austr\u00e1lia, Bundaberg","codigo":"BDB"},{"cidade":"Bunia, Rep\u00fablica Democr\u00e1tica do Congo, Bunia","codigo":"BUX"},{"cidade":"Buol, Indon\u00e9sia, Pogogul","codigo":"UOL"},{"cidade":"Buon Ma Thuot, Vietn\u00e3, Buon Ma Thuot","codigo":"BMV"},{"cidade":"Burbank, Estados Unidos da Am\u00e9rica, Bob Hope","codigo":"BUR"},{"cidade":"Burgas, Bulg\u00e1ria, Burgas","codigo":"BOJ"},{"cidade":"Burgos, Espanha, Burgos","codigo":"RGS"},{"cidade":"Buriram, Tail\u00e2ndia, Buriram","codigo":"BFV"},{"cidade":"Burketown, Austr\u00e1lia","codigo":"BUC"},{"cidade":"Burlington, Estados Unidos da Am\u00e9rica, Burlington International","codigo":"BTV"},{"cidade":"Burnie, Austr\u00e1lia, Wynyard","codigo":"BWT"},{"cidade":"Burqin, China, Kanas","codigo":"KJI"},{"cidade":"Bursa, Turquia, Yenisehir","codigo":"YEI"},{"cidade":"Busan, Cor\u00e9ia do Sul, Gimhae International","codigo":"PUS"},{"cidade":"Bushehr, Ir\u00e3, Bushehr","codigo":"BUZ"},{"cidade":"Busuanga, Filipinas","codigo":"USU"},{"cidade":"Butte, Estados Unidos da Am\u00e9rica, Bert Mooney","codigo":"BTM"},{"cidade":"Butuan, Filipinas, Bancasi","codigo":"BXU"},{"cidade":"Bydgoszcz, Polonia, Ignacy Jan Paderewski","codigo":"BZG"},{"cidade":"Cabinda, Angola, Cabinda","codigo":"CAB"},{"cidade":"Cacoal, Brasil, Cacoal","codigo":"OAL"},{"cidade":"Caen, Fran\u00e7a, Carpiquet","codigo":"CFR"},{"cidade":"Cagayan De Oro, Filipinas, Laguindingan","codigo":"CGY"},{"cidade":"Cagliari, It\u00e1lia, Elmas","codigo":"CAG"},{"cidade":"Caiena, Guiana Francesa, Felix Eboue","codigo":"CAY"},{"cidade":"Cairns International Airport, Austr\u00e1lia, Cairns International Airport","codigo":"CNS"},{"cidade":"Cairo, Egito, Cairo International","codigo":"CAI"},{"cidade":"Cajamarca, Peru, Armando R Iglesias","codigo":"CJA"},{"cidade":"Calabar, Nig\u00e9ria, Margaret Ekpo","codigo":"CBQ"},{"cidade":"Calama, Chile, El Loa","codigo":"CJC"},{"cidade":"Calamata, Gr\u00e9cia, Kalamata","codigo":"KLX"},{"cidade":"Calbayog, Filipinas, Calbayog","codigo":"CYP"},{"cidade":"Caldas Novas, Brasil, Nelson R. Guimaraes","codigo":"CLV"},{"cidade":"Calgary, Canad\u00e1, Calgary","codigo":"YYC"},{"cidade":"C\u00e1li, Col\u00f4mbia, Alfonso Bonilla Arag\u00f3n","codigo":"CLO"},{"cidade":"Calimnos, Gr\u00e9cia, Kalymnos Island","codigo":"JKL"},{"cidade":"Calvi, Fran\u00e7a, Ste Catherine","codigo":"CLY"},{"cidade":"Camaguey, Cuba, Ignacio Agramonte","codigo":"CMW"},{"cidade":"Ca Mau, Vietn\u00e3, Ca Mau","codigo":"CAH"},{"cidade":"Cambridge Bay, Canad\u00e1, Cambridge Bay","codigo":"YCB"},{"cidade":"Cambridge, Reino Unido, Cambridge","codigo":"CBG"},{"cidade":"Camiguin Island, Filipinas, Mambajao","codigo":"CGM"},{"cidade":"Campbell River, Canad\u00e1, Campbell River","codigo":"YBL"},{"cidade":"Campeche, M\u00e9xico, Alberto Acuna Ongay International","codigo":"CPE"},{"cidade":"Campina Grande, Brasil, Joao Suassuna","codigo":"CPV"},{"cidade":"Campo Grande, Brasil, Campo Grande","codigo":"CGR"},{"cidade":"Canakkale, Turquia, Canakkale","codigo":"CKZ"},{"cidade":"Canberra, Austr\u00e1lia, Canberra","codigo":"CBR"},{"cidade":"Canc\u00fan, M\u00e9xico, Cancun International","codigo":"CUN"},{"cidade":"Cangyuan, China, Washan","codigo":"CWJ"},{"cidade":"Cant\u00e3o, Guangzhou, China, Baiyun International","codigo":"CAN"},{"cidade":"Can Tho, Vietn\u00e3, International","codigo":"VCA"},{"cidade":"Cap Haitien,Haiti, Hugo Chavez","codigo":"CAP"},{"cidade":"Caracas, Venezuela, Simon Bolivar","codigo":"CCS"},{"cidade":"Carcassonne, Fran\u00e7a, Salvaza","codigo":"CCF"},{"cidade":"Cardiff, Reino Unido, Cardiff","codigo":"CWL"},{"cidade":"Carlisle, Reino Unido, Carlisle","codigo":"CAX"},{"cidade":"Carlsbad, Estados Unidos da Am\u00e9rica, McClellan-Palomar","codigo":"CLD"},{"cidade":"Carnarvon, Austr\u00e1lia, Carnarvon","codigo":"CVQ"},{"cidade":"Cartagena das \u00cdndias, Col\u00f4mbia, Rafael Nunez","codigo":"CTG"},{"cidade":"Cartum, Sud\u00e3o, International","codigo":"KRT"},{"cidade":"Casablanca, Marrocos, Mohammed V","codigo":"CMN"},{"cidade":"Cascais, Portugal, Tires","codigo":"CAT"},{"cidade":"Casper, Estados Unidos da Am\u00e9rica, Natrona County International","codigo":"CPR"},{"cidade":"Castellon De La Plana, Espanha, Castellon","codigo":"CDT"},{"cidade":"Castlegar, Canad\u00e1,\u00a0West Kootney Regional","codigo":"YCG"},{"cidade":"Cast\u00f3ria, Gr\u00e9cia, Kastoria Aristoteles","codigo":"KSO"},{"cidade":"Castres, Fran\u00e7a, Mazamet","codigo":"DCM"},{"cidade":"Castro, Chile, Mocopulli","codigo":"MHC"},{"cidade":"Catamarca Choya, Argentina, Catamarca","codigo":"CTC"},{"cidade":"Cat\u00e2nia\u00a0, It\u00e1lia, Fontanarossa","codigo":"CTA"},{"cidade":"Catarman, Filipinas, National","codigo":"CRM"},{"cidade":"Caticlan, Filipinas, Godofredo P Ramos","codigo":"MPH"},{"cidade":"Catmandu, Nepal, Tribhuvan International,","codigo":"KTM"},{"cidade":"Catumbela,\u00a0Angola, Catumbela","codigo":"CBT"},{"cidade":"Cauayan, Filipinas","codigo":"CYZ"},{"cidade":"Caye Caulker, Belize, Caye Caulker","codigo":"CUK"},{"cidade":"Caye Chapel, Belize, Caye Chapel","codigo":"CYC"},{"cidade":"Cayo Coco, Cuba, Jardines Del Rey, ","codigo":"CCC"},{"cidade":"Cayo Largo Del Sur, Cuba, Vilo Acuna","codigo":"CYO"},{"cidade":"Cebu, Filipinas, Mactan International","codigo":"CEB"},{"cidade":"Cedar Rapids, Estados Unidos da Am\u00e9rica, Eastern Iowa","codigo":"CID"},{"cidade":"Ceduna, Austr\u00e1lia, Ceduna","codigo":"CED"},{"cidade":"Celaya, M\u00e9xico, Captain Rogelio Castillo","codigo":"CYW"},{"cidade":"Cerro Sombrero, Chile, Franco Bianco","codigo":"SMB"},{"cidade":"Chabahar, Ir\u00e3, Konark","codigo":"ZBR"},{"cidade":"Chachapoyas, Peru,Chachapoyas","codigo":"CHH"},{"cidade":"Chaghcharan, Afeganist\u00e3o, Chaghcharan","codigo":"CCN"},{"cidade":"Chambery Aix les Bains, Fran\u00e7a, Chambery Aix les Bains","codigo":"CMF"},{"cidade":"Champaign\u00a0Urbana, Estados Unidos da Am\u00e9rica, University of Illinois","codigo":"CMI"},{"cidade":"Chanaral, Chile, Chanaral","codigo":"CNR"},{"cidade":"Chandigarh, \u00cdndia, Chandigarh","codigo":"IXC"},{"cidade":"Changchun, China, Longjia International","codigo":"CGQ"},{"cidade":"Changde, China, Taohuayuan","codigo":"CGD"},{"cidade":"Changsha, China, Huanghua International","codigo":"CSX"},{"cidade":"Changuinola, Panam\u00e1, Manuel Nino","codigo":"CHX"},{"cidade":"Changzhi, China, Wangcun","codigo":"CIH"},{"cidade":"Changzhou, China, Benniu","codigo":"CZX"},{"cidade":"Chania, Gr\u00e9cia, I Daskalogiannis","codigo":"CHQ"},{"cidade":"Chaoyang, China, Chaoyang Airport","codigo":"CHG"},{"cidade":"Charleston, Estados Unidos da Am\u00e9rica, Charleston AFB","codigo":"CHS"},{"cidade":"Charleston, Estados Unidos da Am\u00e9rica, Yeager","codigo":"CRW"},{"cidade":"Charleville, Austr\u00e1lia","codigo":"CTL"},{"cidade":"Charlotte, Estados Unidos da Am\u00e9rica, Charlotte, Douglas","codigo":"CLT"},{"cidade":"Charlottesville, Estados Unidos da Am\u00e9rica, Albemarle","codigo":"CHO"},{"cidade":"Charlottetown, Canad\u00e1, Charlottetown","codigo":"YYG"},{"cidade":"Charlottetown, Canad\u00e1, Charlottetown, Labrador","codigo":"YHG"},{"cidade":"Chateauroux, Fran\u00e7a, Deols","codigo":"CHR"},{"cidade":"Chattanooga, Estados Unidos da Am\u00e9rica, Metropolitan Airport","codigo":"CHA"},{"cidade":"Cheboksary, R\u00fassia, Cheboksary","codigo":"CSY"},{"cidade":"Cheliabinsk, R\u00fassia, Balandino","codigo":"CEK"},{"cidade":"Chengde, China, Puning","codigo":"CDE"},{"cidade":"Chengdu, China","codigo":"CTU"},{"cidade":"Chennai, \u00cdndia, Chennai International","codigo":"MAA"},{"cidade":"Cheongju, Cor\u00e9ia do Sul, Cheongju International","codigo":"CJJ"},{"cidade":"Cherbourg, Fran\u00e7a, Maupertus","codigo":"CER"},{"cidade":"Cherepovets, R\u00fassia, Cherepovts","codigo":"CEE"},{"cidade":"Chernivtsi, Ucr\u00e2nia, Chernivtsi International","codigo":"CWC"},{"cidade":"Chersky, R\u00fassia, Chersky","codigo":"CYX"},{"cidade":"Chesterfield, Canad\u00e1, Chesterfield Inlet","codigo":"YCS"},{"cidade":"Chester, Reino Unido, Harwarden","codigo":"CEG"},{"cidade":"Chetumal, M\u00e9xico, Chetumal International","codigo":"CTM"},{"cidade":"Chevery, Canad\u00e1, Chevery","codigo":"YHR"},{"cidade":"Cheyenne, Estados Unidos da Am\u00e9rica, Cheyenne Regional","codigo":"CYS"},{"cidade":"Chiang Mai, Tail\u00e2ndia, Chiang Mai","codigo":"CNX"},{"cidade":"Chiang Rai, Tail\u00e2ndia, Mae Fah Luang","codigo":"CEI"},{"cidade":"Chibougamau, Canad\u00e1, Chapais","codigo":"YMT"},{"cidade":"Chicago, Estados Unidos da Am\u00e9rica, Midway","codigo":"MDW"},{"cidade":"Chicago, Estados Unidos da Am\u00e9rica, OHare","codigo":"ORD"},{"cidade":"Chicago, Estados Unidos da Am\u00e9rica , Todos Aeroportos","codigo":"CHI"},{"cidade":"Chiclayo, Peru, J A Quinones Gonzales","codigo":"CIX"},{"cidade":"Chifeng, China, Yulong","codigo":"CIF"},{"cidade":"Chihuahua, M\u00e9xico, Roberto Fierro Villalobos","codigo":"CUU"},{"cidade":"Chile Chico, Chile, Chile Chico","codigo":"CCH"},{"cidade":"Chill\u00e1n, Chile, Gen. Bernardo Ohiggins","codigo":"YAI"},{"cidade":"Chimoio, Mo\u00e7ambique, Chimoio","codigo":"VPY"},{"cidade":"Chimore, Bol\u00edvia, Chimore","codigo":"CCA"},{"cidade":"Chinchilla, Austr\u00e1lia","codigo":"CCL"},{"cidade":"Chios, Gr\u00e9cia, Omiros","codigo":"JKH"},{"cidade":"Chisasibi, Canad\u00e1, Chisasibi","codigo":"YKU"},{"cidade":"Chisinau, Mold\u00e1via, Chisinau International","codigo":"KIV"},{"cidade":"Chitral, Paquist\u00e3o, Chitral","codigo":"CJL"},{"cidade":"Chitre, Panam\u00e1, Alonso Valderrama","codigo":"CTD"},{"cidade":"Chittagong, Bangladesh, Shah Amanat","codigo":"CGP"},{"cidade":"Chizhou, China, Jiuhuashan","codigo":"JUH"},{"cidade":"Chlef, Arg\u00e9lia","codigo":"CFK"},{"cidade":"Choibalsan, Mong\u00f3lia, Choibalsan","codigo":"COQ"},{"cidade":"Chokurdakh, R\u00fassia, Chokurdakh","codigo":"CKH"},{"cidade":"Chongqing, China","codigo":"CKG"},{"cidade":"Chu Lai, Vietn\u00e3, International","codigo":"VCL"},{"cidade":"Chumphon, Tail\u00e2ndia, Chumphon","codigo":"CJM"},{"cidade":"Churchill, Canad\u00e1","codigo":"YYQ"},{"cidade":"Churchill Falls, Canad\u00e1, Churchill Falls","codigo":"ZUM"},{"cidade":"Cidade do Cabo, \u00c1frica do Sul, Cape Town International","codigo":"CPT"},{"cidade":"Cidade do M\u00e9xico, M\u00e9xico, Benito Ju\u00e1rez International","codigo":"MEX"},{"cidade":"Cienfuegos, Cuba, Jaime Gonzalez","codigo":"CFG"},{"cidade":"Cilacap, Indon\u00e9sia, Tunggul Wulung","codigo":"CXP"},{"cidade":"Ciudad Bolivar, Venezuela, Tomas de Heres","codigo":"CBL"},{"cidade":"Ciudad del Carmen, M\u00e9xico, Ciudad del Carmen International","codigo":"CME"},{"cidade":"Ciudad del Este, Paraguai, Guarani","codigo":"AGT"},{"cidade":"Ciudad Ju\u00e1rez, M\u00e9xico, Abraham Gonz\u00e1lez International","codigo":"CJS"},{"cidade":"Ciudad Obregon, M\u00e9xico, Ciudad Obregon International","codigo":"CEN"},{"cidade":"Ciudad Victoria, M\u00e9xico, Pedro J. M\u00e9ndez International","codigo":"CVM"},{"cidade":"Clarksburg, Estados Unidos da Am\u00e9rica, North Central West Virginia","codigo":"CKB"},{"cidade":"Clermont Ferrand, Fran\u00e7a, Auvergne","codigo":"CFE"},{"cidade":"Cleveland, Estados Unidos da Am\u00e9rica, Hopkins International","codigo":"CLE"},{"cidade":"Cloncurry, Austr\u00e1lia","codigo":"CNJ"},{"cidade":"Cluj Napoca, Rom\u00eania, Cluj Napoca","codigo":"CLJ"},{"cidade":"Clyde River, Canad\u00e1, Clyde River","codigo":"YCY"},{"cidade":"Cobar, Austr\u00e1lia","codigo":"CAZ"},{"cidade":"Cobija, Bol\u00edvia, Capit\u00e1n An\u00edbal Arab","codigo":"CIJ"},{"cidade":"Coca, Equador, Francisco de Orellana","codigo":"OCC, Equador"},{"cidade":"Cochabamba, Bol\u00edvia, Jorge Wilstermann","codigo":"CBB"},{"cidade":"Cochrane, Chile, Cochrane","codigo":"LGR"},{"cidade":"Cody, Estados Unidos da Am\u00e9rica, Yellowstone regional","codigo":"COD"},{"cidade":"Coen, Austr\u00e1lia","codigo":"CUQ"},{"cidade":"Coffs Harbour, Austr\u00e1lia, Coffs Harbour","codigo":"CFS"},{"cidade":"Coimbatore, \u00cdndia, Iternational","codigo":"CJB"},{"cidade":"Colima, M\u00e9xico, Miguel de la Madrid","codigo":"CLQ"},{"cidade":"College Station, Estados Unidos da Am\u00e9rica, Easterwood ","codigo":"CLL"},{"cidade":"Coll Island, Reino Unido, Coll Island","codigo":"CAL"},{"cidade":"Coll, Reino Unido","codigo":"COL"},{"cidade":"Colmar, Fran\u00e7a, Houssen","codigo":"CMR"},{"cidade":"Colombo, Sri Lanka,Bandaranaike","codigo":"CMB"},{"cidade":"Colonia\u00a0, Alemanha, Cologne Bonn","codigo":"CGN"},{"cidade":"Colon, Panam\u00e1, Enrique Adolfo Jimenez","codigo":"ONX"},{"cidade":"Colonsay, Reino Unido, Colonsay","codigo":"CSA"},{"cidade":"Colorado Springs, Estados Unidos da Am\u00e9rica, Colorado Springs","codigo":"COS"},{"cidade":"Columbia, Estados Unidos da Am\u00e9rica, Columbia","codigo":"COU"},{"cidade":"Col\u00fambia, Estados Unidos da Am\u00e9rica, Col\u00fambia","codigo":"CAE"},{"cidade":"Columbus, Estados Unidos da Am\u00e9rica, Columbus","codigo":"CSG"},{"cidade":"Columbus, Estados Unidos da Am\u00e9rica, Golden Triangle","codigo":"GTR"},{"cidade":"Columbus, Estados Unidos da Am\u00e9rica, John Glenn International","codigo":"CMH"},{"cidade":"Comiso, It\u00e1lia, Vicenzo Maglioco","codigo":"CIY"},{"cidade":"Comodoro Rivadavia, Argentina, General E Mosconi","codigo":"CRD"},{"cidade":"Comox, Canad\u00e1, Comox","codigo":"YQQ"},{"cidade":"Conacri, Guin\u00e9, International","codigo":"CKY"},{"cidade":"Concepcion, Chile, Carriel Sur","codigo":"CCP"},{"cidade":"Con Dao Island, Vietn\u00e3, Co Ong","codigo":"VCS"},{"cidade":"Confins, Brasil, Tancredo Neves","codigo":"CNF"},{"cidade":"Constanta, Rom\u00eania, Mihail Kogalniceanu","codigo":"CND"},{"cidade":"Constantine, Arg\u00e9lia, Mohamed Boudiaf","codigo":"CZL"},{"cidade":"Contadora, Panam\u00e1, Contadora Island","codigo":"OTD"},{"cidade":"Coober Pedy, Austr\u00e1lia, Coober Pedy","codigo":"CPD"},{"cidade":"Cooktown, Austr\u00e1lia, Cooktown","codigo":"CTN"},{"cidade":"Cooma, Austr\u00e1lia, Snowy Mountains","codigo":"OOM"},{"cidade":"Copenhagen, Dinamarca, Kastrup","codigo":"CPH"},{"cidade":"Copiapo, Chile, Desierto de Atacama","codigo":"CPO"},{"cidade":"Corazon de Jesus, Panam\u00e1, Corazon de Jesus","codigo":"CZJ"},{"cidade":"C\u00f3rdoba, Argentina, Pajas Blancas","codigo":"COR"},{"cidade":"Cordova, Estados Unidos da Am\u00e9rica, Merle K., Mudhole","codigo":"CDV"},{"cidade":"Cork, Irlanda, Cork International","codigo":"ORK"},{"cidade":"Corozal, Belize, Corozal","codigo":"CZH"},{"cidade":"Corozal, Col\u00f4mbia, Las Brujas","codigo":"CZU"},{"cidade":"Corpus Christi, Estados Unidos da Am\u00e9rica, Corpus Christi International","codigo":"CRP"},{"cidade":"Corrientes, Argentina, Corrientes","codigo":"CNQ"},{"cidade":"Corumb\u00e1, Brasil, Corumb\u00e1","codigo":"CMG"},{"cidade":"Corunha, Espanha, A Coruna Airport","codigo":"LCG"},{"cidade":"Corvera, Espanha, Corvera International","codigo":"RMU"},{"cidade":"Corvo Island, Portugal, Corvo Island","codigo":"CVU"},{"cidade":"Cotabato, Filipinas, Awang","codigo":"CBO"},{"cidade":"Cotonou, Benin, Cadjehoun","codigo":"COO"},{"cidade":"Coventry - Baginton, Reino Unido","codigo":"CVT"},{"cidade":"Covington, Estados Unidos da Am\u00e9rica, Cincinnati, Northern Kentucky","codigo":"CVG"},{"cidade":"CoxS Bazar, Bangladesh, CoxS Bazar","codigo":"CXB"},{"cidade":"Coyhaique, Chile, Teniente Vidal","codigo":"GXQ"},{"cidade":"Cozumel, M\u00e9xico, Cozumel International","codigo":"CZM"},{"cidade":"Crac\u00f3via, Polonia, John Paul II Balice","codigo":"KRK"},{"cidade":"Craiova, Rom\u00eania, Craiova","codigo":"CRA"},{"cidade":"Cranbrook, Canad\u00e1, Canadian Rockies","codigo":"YXC"},{"cidade":"Crescent City, Estados Unidos da Am\u00e9rica, Jack McNamara Field","codigo":"CEC"},{"cidade":"Crici\u00fama, Brasil, Diomcio Freitas","codigo":"CCM"},{"cidade":"Crooked Island, Bahamas, Colonel Hill","codigo":"CRI"},{"cidade":"Crotone, It\u00e1lia, Crotone","codigo":"CRV"},{"cidade":"Cruzeiro do Sul, Brasil, Cruzeiro do Sul","codigo":"CZS"},{"cidade":"Cucuta, Col\u00f4mbia, Camilo Daza","codigo":"CUC"},{"cidade":"Cuddapah, \u00cdndia, Cuddapah","codigo":"CDP"},{"cidade":"Cuenca, Equador, Mariscal Lamar","codigo":"CUE, Equador"},{"cidade":"Cuernavaca, M\u00e9xico, Mariano Matamoros","codigo":"CVJ"},{"cidade":"Cuiab\u00e1, Brasil, Marechal Rondon","codigo":"CGB"},{"cidade":"Cuito Cuanavale,\u00a0Angola, Cuito Cuanavale","codigo":"CTI"},{"cidade":"Culiac\u00e1n, M\u00e9xico, Federal de Bachigualato","codigo":"CUL"},{"cidade":"Cumana, Venezuela, Antonio Jose de Sucre","codigo":"CUM"},{"cidade":"Cuneo, It\u00e1lia, Levaldigi","codigo":"CUF"},{"cidade":"Cunnamulla, Austr\u00e1lia","codigo":"CMA"},{"cidade":"Curitiba, Brasil, Afonso Pena","codigo":"CWB"},{"cidade":"Cusco, Peru, A Velasco Astete","codigo":"CUZ"},{"cidade":"Cuyo, Filipinas","codigo":"CYU"},{"cidade":"Cyangugu, Ruanda, Kamembe","codigo":"KME"},{"cidade":"Daegu, Cor\u00e9ia do Sul, Daegu International","codigo":"TAE"},{"cidade":"Dakar, Senegal, Blaise Diagne","codigo":"DSS"},{"cidade":"Dakhla, Marrocos, Dakhla","codigo":"VIL"},{"cidade":"Dalaman, Turquia, Dalaman","codigo":"DLM"},{"cidade":"Dalanzadgad, Mong\u00f3lia, Gurvan Saikhan","codigo":"DLZ"},{"cidade":"Da Lat, Vietn\u00e3, Lien Khuong","codigo":"DLI"},{"cidade":"Dalbandin, Paquist\u00e3o, Dalbadin","codigo":"DBA"},{"cidade":"Dalian, China, Zhoushuizi International","codigo":"DLC"},{"cidade":"Dali, China, Dali","codigo":"DLU"},{"cidade":"Dallas , Estados Unidos da Am\u00e9rica, Dallas Fort Worth International","codigo":"DFW"},{"cidade":"Dallas, Estados Unidos da Am\u00e9rica, Love Field","codigo":"DAL"},{"cidade":"Dalnegorsk, R\u00fassia, Dalnegorsk","codigo":"DHG"},{"cidade":"Dalnerechensk, R\u00fassia, Dalnerechensk","codigo":"DLR"},{"cidade":"Damasco, S\u00edria, Damascus International","codigo":"DAM"},{"cidade":"Damazin, Sud\u00e3o, Damazin","codigo":"RSS"},{"cidade":"Dammam, Ar\u00e1bia Saudita, King Fahd","codigo":"DMM"},{"cidade":"Da Nang, Vietn\u00e3, Da Nang","codigo":"DAD"},{"cidade":"Dandong, China, Langtou","codigo":"DDG"},{"cidade":"Dangriga, Belize, Dangriga","codigo":"DGA"},{"cidade":"Daocheng, China, Yading","codigo":"DCY"},{"cidade":"Daqing, China, Sartu","codigo":"DQA"},{"cidade":"Dar es Salaam, Tanz\u00e2nia, Julius Nyerere Intenational","codigo":"DAR"},{"cidade":"Darnley Island, Austr\u00e1lia","codigo":"NLF"},{"cidade":"Darwin, Austr\u00e1lia, Darwin International","codigo":"DRW"},{"cidade":"Dashoguz, Turcomenist\u00e3o, Dashoguz","codigo":"TAZ"},{"cidade":"Datong, China, Beijiazao","codigo":"DAT"},{"cidade":"Davao, Filipinas, Francisco Bangoy","codigo":"DVO"},{"cidade":"David, Panam\u00e1, Enrique Malek","codigo":"DAV"},{"cidade":"Dawadmi, Ar\u00e1bia Saudita, King Salman Abdulaziz","codigo":"DWD"},{"cidade":"Dawei, Mianmar, Dawei","codigo":"TVY"},{"cidade":"Dawson City, Canad\u00e1, Dawson City","codigo":"YDA"},{"cidade":"Dawson Creek, Canad\u00e1, Dawson Creek","codigo":"YDQ"},{"cidade":"Daytona Beach, Estados Unidos da Am\u00e9rica, Daytona Beach","codigo":"DAB"},{"cidade":"Dayton, Estados Unidos da Am\u00e9rica, James M. Cox International","codigo":"DAY"},{"cidade":"Dazhou, China, Heshi Airport","codigo":"DAX"},{"cidade":"Deadhorse, Estados Unidos da Am\u00e9rica, Deadhorse","codigo":"SCC"},{"cidade":"Deadmans Cay, Bahamas, Deadmans Cay","codigo":"LGI"},{"cidade":"Deauville, Fran\u00e7a, St. Gatien","codigo":"DOL"},{"cidade":"Debrecen, Hungria, Debrecen","codigo":"DEB"},{"cidade":"Decatur, Estados Unidos da Am\u00e9rica, Decatur Apt","codigo":"DEC"},{"cidade":"Deer Lake, Canad\u00e1, Regional","codigo":"YDF"},{"cidade":"Dehra dun, \u00cdndia, Jolly Grant Airport","codigo":"DED"},{"cidade":"Del Carmen Siargao, Filipinas, Sauak","codigo":"IAO"},{"cidade":"D\u00e9lhi, \u00cdndia, Indira Gandhi","codigo":"DEL"},{"cidade":"Delingha, China, Delingha","codigo":"HXD"},{"cidade":"Dembidollo, Eti\u00f3pia, Dembi Dolo","codigo":"DEM"},{"cidade":"Dempassar Bali, Indon\u00e9sia, Ngurah rai","codigo":"DPS"},{"cidade":"Denver, Estados Unidos da Am\u00e9rica, Denver","codigo":"DEN"},{"cidade":"Deputatsky, R\u00fassia, Deputatsky","codigo":"DPT"},{"cidade":"Dera Ghazi Khan, Paquist\u00e3o, International","codigo":"DEA"},{"cidade":"Derry, Reino Unido, Eglinton","codigo":"LDY"},{"cidade":"Des Moines, Estados Unidos da Am\u00e9rica, Des Moines","codigo":"DSM"},{"cidade":"Dessie, Eti\u00f3pia, Combolcha","codigo":"DSE"},{"cidade":"Detroit, Estados Unidos da Am\u00e9rica, Metropolitan Wayne County","codigo":"DTW"},{"cidade":"Deutsche Bahn - Ferrovias Alem\u00e3s\u00a0, Alemanha","codigo":"QYG"},{"cidade":"Devonport, Austr\u00e1lia, Devonport","codigo":"DPO"},{"cidade":"Dezful, Ir\u00e3, Dezful","codigo":"DEF"},{"cidade":"Dhaka, Bangladesh, Hazrat Shahjalal","codigo":"DAC"},{"cidade":"Dhangarhi, Nepal, Dhangarhi","codigo":"DHI"},{"cidade":"Dharamsala, \u00cdndia, Kangra","codigo":"DHM"},{"cidade":"Dibrugarh, \u00cdndia, Mohanbari","codigo":"DIB"},{"cidade":"Dien Bien Phu, Vietn\u00e3, Dien Bien Phu","codigo":"DIN"},{"cidade":"Dikson, R\u00fassia, Dikson","codigo":"DKS"},{"cidade":"Dikwella, Sri Lanka, Mawella Lagoon","codigo":"DIW"},{"cidade":"Dillingham, Estados Unidos da Am\u00e9rica, Dillingham","codigo":"DLG"},{"cidade":"Dimapur, \u00cdndia, Dimapur","codigo":"DMU"},{"cidade":"Dinard St Malo, Fran\u00e7a, Pleurtuit","codigo":"DNR"},{"cidade":"Dipolog, Filipinas, Dipolog","codigo":"DPL"},{"cidade":"Diqing Deqen, China, Shangri-La","codigo":"DIG"},{"cidade":"Dire Dawa, Eti\u00f3pia, Dire Dawa","codigo":"DIR"},{"cidade":"Diu, \u00cdndia, Diu","codigo":"DIU"},{"cidade":"Dixie, Austr\u00e1lia","codigo":"DXD"},{"cidade":"Diyarbakir, Turquia, Diyarbakir","codigo":"DIY"},{"cidade":"Djanet, Arg\u00e9lia, Tiska","codigo":"DJG"},{"cidade":"Djbouti, Djbouti, Ambouli","codigo":"JIB"},{"cidade":"Djerba, Tun\u00edsia, Zarzis","codigo":"DJE"},{"cidade":"Dnepropetrovsk, Ucr\u00e2nia, Dnipro International","codigo":"DNK"},{"cidade":"Dobo, Indon\u00e9sia","codigo":"DOB"},{"cidade":"Dodoma, Tanz\u00e2nia, Dodoma","codigo":"DOD"},{"cidade":"Doha, Qatar, Hamad International","codigo":"DOH"},{"cidade":"Dole, Fran\u00e7a, Tavaux","codigo":"DLE"},{"cidade":"Dolpa, Nepal, Dolpa","codigo":"DOP"},{"cidade":"Dominica, Dominica, Canefield","codigo":"DCF"},{"cidade":"Dominica, Dominica, Melville Hall","codigo":"DOM"},{"cidade":"Doncaster, Reino Unido, Robin Hood","codigo":"DSA"},{"cidade":"Donegal, Irlanda, Donegal","codigo":"CFN"},{"cidade":"Donetsk, Ucr\u00e2nia, Donetsk Internationak","codigo":"DOK"},{"cidade":"Dong Hoi, Vietn\u00e3, Dong Hoi","codigo":"VDH"},{"cidade":"Dongying, China, Shengli","codigo":"DOY"},{"cidade":"Dortmund\u00a0, Alemanha, Dortmund","codigo":"DTM"},{"cidade":"Dothan, Estados Unidos da Am\u00e9rica, Dothan","codigo":"DHN"},{"cidade":"Douala, Camar\u00f5es, Douala International","codigo":"DLA"},{"cidade":"Drake Bay, Costa Rica, Drake Bay","codigo":"DRK"},{"cidade":"Dresden, Alemanha, Dresden","codigo":"DRS"},{"cidade":"Drumduff, Austr\u00e1lia","codigo":"DFP"},{"cidade":"Dryden, Canad\u00e1, Regional","codigo":"YHD"},{"cidade":"Dubai, Emirados \u00c1rabes Unidos, Dubai International","codigo":"DXB"},{"cidade":"Dubbo, Austr\u00e1lia, Dubbo City Airport","codigo":"DBO"},{"cidade":"Dublin, Irlanda, Dublin International","codigo":"DUB"},{"cidade":"DuBois, Estados Unidos da Am\u00e9rica, DuBois Regional Airport","codigo":"DUJ"},{"cidade":"Dubrovnik, Cro\u00e1cia, Dubrovnik","codigo":"DBV"},{"cidade":"Dubuque, Estados Unidos da Am\u00e9rica, Dubuque","codigo":"DBQ"},{"cidade":"Duluth, Estados Unidos da Am\u00e9rica, Duluth","codigo":"DLH"},{"cidade":"Dumaguete, Filipinas, Sibulan","codigo":"DGT"},{"cidade":"Dumai, Indon\u00e9sia, Pinang Kam","codigo":"DUM"},{"cidade":"Dunbar, Austr\u00e1lia","codigo":"DNB"},{"cidade":"Dundee, Reino Unido, Dundee","codigo":"DND"},{"cidade":"Dundo,\u00a0Angola, Dundo","codigo":"DUE"},{"cidade":"Dunhuang, China, Dunhuang","codigo":"DNH"},{"cidade":"Duqm, Om\u00e3, Duqm International","codigo":"DQM"},{"cidade":"Durango, Estados Unidos da Am\u00e9rica, La Plata-Durango","codigo":"DRO"},{"cidade":"Durango, M\u00e9xico, Guadalupe Victoria International","codigo":"DGO"},{"cidade":"Durban, \u00c1frica do Sul, King Shaka International","codigo":"DUR"},{"cidade":"Durgapur, \u00cdndia, Kazi Nazrul Islam","codigo":"RDP"},{"cidade":"Durham, Reino Unido, Tees Valley","codigo":"MME"},{"cidade":"Dushanbe, Tajiquist\u00e3o, International","codigo":"DYU"},{"cidade":"Dusseldorf, Alemanha, Dusseldorf","codigo":"DUS"},{"cidade":"Eagle, Estados Unidos da Am\u00e9rica, Eagle","codigo":"EGE"},{"cidade":"East London, \u00c1frica do Sul, East London","codigo":"ELS"},{"cidade":"Eau Claire, Estados Unidos da Am\u00e9rica, Chippewa Valley Regional","codigo":"EAU"},{"cidade":"Ecaterimburgo, R\u00fassia, Yekateringurb Koltsovo","codigo":"SVX"},{"cidade":"Eday, Reino Unido, Eday","codigo":"EOI"},{"cidade":"Edimburgo, Reino Unido, Edinburgh Airport","codigo":"EDI"},{"cidade":"Edmonton, Canad\u00e1, Edmonton","codigo":"YEG"},{"cidade":"Edmonton, Canad\u00e1 , Todos aeroportos","codigo":"YEA"},{"cidade":"Edremit, Turquia, Koca Seyit","codigo":"EDO"},{"cidade":"Egilsstadir, Isl\u00e2ndia, Egilsstadir","codigo":"EGS"},{"cidade":"Eilat, Israel, Ramon International","codigo":"ETM"},{"cidade":"Eindhoven, Holanda, Eindhoven","codigo":"EIN"},{"cidade":"Ejina Banner, China, Taolai","codigo":"EJN"},{"cidade":"Elazig, Turquia, Elazig","codigo":"EZS"},{"cidade":"El Bayadh, Arg\u00e9lia","codigo":"EBH"},{"cidade":"El Calafate, Argentina,\u00a0Coadante A. Tola","codigo":"FTE"},{"cidade":"Eldoret, Qu\u00eania, International","codigo":"EDL"},{"cidade":"El Fasher, Sud\u00e3o, El Fasher","codigo":"ELF"},{"cidade":"El Golea, Arg\u00e9lia, El Golea","codigo":"ELG"},{"cidade":"Elista, R\u00fassia, Elista","codigo":"ESL"},{"cidade":"Elko, Estados Unidos da Am\u00e9rica, Elko","codigo":"EKO"},{"cidade":"Elmira\u00a0Corning, Estados Unidos da Am\u00e9rica, Elmira Corning","codigo":"ELM"},{"cidade":"El Nido, Filipinas","codigo":"ENI"},{"cidade":"El Obeid, Sud\u00e3o, El Obeid","codigo":"EBD"},{"cidade":"El Oued, Arg\u00e9lia, Guemar","codigo":"ELU"},{"cidade":"El Palomar, Argentina, El Palomar","codigo":"EPA"},{"cidade":"El Paso, Estados Unidos da Am\u00e9rica, El Paso International","codigo":"ELP"},{"cidade":"El Vigia, Venezuela, Juan P. Perez Alfonso, ","codigo":"VIG"},{"cidade":"Emden, Alemanha, Emden","codigo":"EME"},{"cidade":"Emerald, Austr\u00e1lia, Emerald","codigo":"EMD"},{"cidade":"Encarnacion, Paraguai, R Amin Ayub Gonzalez","codigo":"ENO"},{"cidade":"Ende, Indon\u00e9sia","codigo":"ENE"},{"cidade":"Enfidha, Tun\u00edsia, Hammamet","codigo":"NBE"},{"cidade":"Enontekio, Finl\u00e2ndia, Enontekio","codigo":"ENF"},{"cidade":"Enshi, China, Xujiaping","codigo":"ENH"},{"cidade":"Entebbe, Uganda, Entebbe International","codigo":"EBB"},{"cidade":"Enugu, Nig\u00e9ria, Akanu Ibiam","codigo":"ENU"},{"cidade":"Epinal, Fran\u00e7a, Mirecourt","codigo":"EPL"},{"cidade":"Erbil, Iraque, Erbil International","codigo":"EBL"},{"cidade":"Erenhot, China, Saiwusu","codigo":"ERL"},{"cidade":"Erevan, Yerevan, Arm\u00eania, Zvartnots International","codigo":"EVN"},{"cidade":"Erfurt, Alemanha, Erfurt Weimar","codigo":"ERF"},{"cidade":"Erie, Estados Unidos da Am\u00e9rica, Erie International","codigo":"ERI"},{"cidade":"Errachidia, Marrocos, Moulay Ali Cherif","codigo":"ERH"},{"cidade":"Erzincan, Turquia, Erzican","codigo":"ERC"},{"cidade":"Erzurum, Turquia, Erzurum","codigo":"ERZ"},{"cidade":"Esbjerg, Dinamarca, Esbjerg.","codigo":"EBJ"},{"cidade":"Esfahan, Ir\u00e3, Shahid Bereshti","codigo":"IFN"},{"cidade":"Esmeraldas, Equador, Concha Torres","codigo":"ESM, Equador"},{"cidade":"Esperance, Austr\u00e1lia, Esperance","codigo":"EPR"},{"cidade":"Esquel, Argentina, Esquel","codigo":"EQS"},{"cidade":"Essaouira, Marrocos, Mogador","codigo":"SEU"},{"cidade":"Essen\u00a0, Alemanha","codigo":"ESS"},{"cidade":"Estocolmo, Su\u00e9cia, Arlanda","codigo":"ARN"},{"cidade":"Estocolmo, Su\u00e9cia, Bromma","codigo":"BMA"},{"cidade":"Estocolmo, Su\u00e9cia, Skavsta International","codigo":"NYO"},{"cidade":"Estocolmo, Su\u00e9cia , Todos Aeroportos","codigo":"STO"},{"cidade":"Estocolmo, Su\u00e9cia, Vasteras","codigo":"VST"},{"cidade":"Estrasburgo, Fran\u00e7a, Entzheim","codigo":"SXB"},{"cidade":"Eugene, Estados Unidos da Am\u00e9rica, Mahlon Sweet Field","codigo":"EUG"},{"cidade":"Evansville, Estados Unidos da Am\u00e9rica, Evansville","codigo":"EVV"},{"cidade":"Evensk, R\u00fassia, Severo Evensk","codigo":"SWV"},{"cidade":"Exeter, Reino Unido,Exeter","codigo":"EXT"},{"cidade":"Fagernes, Noruega, Leirin","codigo":"VDB"},{"cidade":"Fairbanks, Estados Unidos da Am\u00e9rica, Fairbanks","codigo":"FAI"},{"cidade":"Fair Isle, Reino Unido, Fair Isle","codigo":"FIE"},{"cidade":"Faisalabad, Paquist\u00e3o, International","codigo":"LYP"},{"cidade":"Faizabad, Afeganist\u00e3o","codigo":"FBD"},{"cidade":"Fak-Fak, Indon\u00e9sia","codigo":"FKQ"},{"cidade":"Farah, Afeganist\u00e3o, Farah","codigo":"FAH"},{"cidade":"Fargo, Estados Unidos da Am\u00e9rica, Hector","codigo":"FAR"},{"cidade":"Farmington, Estados Unidos da Am\u00e9rica, Four Corners Regional","codigo":"FMN"},{"cidade":"Fayetteville, Estados Unidos da Am\u00e9rica, Grannis Field","codigo":"FAY"},{"cidade":"Fayetteville, Estados Unidos da Am\u00e9rica, Northwest Arkansas","codigo":"XNA"},{"cidade":"Feita de Santanta, Brasil, Joao Durval Carneiro","codigo":"FEC"},{"cidade":"Fergana, Uzbequist\u00e3o, Fergana","codigo":"FEG"},{"cidade":"Fes, Marrocos, Saiss","codigo":"FEZ"},{"cidade":"Figari, Fran\u00e7a, Sud Corse","codigo":"FSC"},{"cidade":"Filad\u00e9lfia, Estados Unidos da Am\u00e9rica, Philadelphia International","codigo":"PHL"},{"cidade":"Fitzroy Crossing, Austr\u00e1lia","codigo":"FIZ"},{"cidade":"Flagstaff, Estados Unidos da Am\u00e9rica, Flagstaff Pulliam","codigo":"FLG"},{"cidade":"Flinders, Austr\u00e1lia","codigo":"FLS"},{"cidade":"Flin Flon, Canad\u00e1, Flin Flon","codigo":"YFO"},{"cidade":"Flint, Estados Unidos da Am\u00e9rica, Bishop","codigo":"FNT"},{"cidade":"Floren\u00e7a, It\u00e1lia, Peretola","codigo":"FLR"},{"cidade":"Florence, Estados Unidos da Am\u00e9rica, Florence","codigo":"FLO"},{"cidade":"Florencia, Col\u00f4mbia, Gustavo A. Paredes","codigo":"FLA"},{"cidade":"Flores, Guatemala, Santa Elena","codigo":"FRS"},{"cidade":"Flores Island, Portugal, Flores Island","codigo":"FLW"},{"cidade":"Florian\u00f3polis, Brasil, Hercilio Luz","codigo":"FLN"},{"cidade":"Floro, Noruega, Floro","codigo":"FRO"},{"cidade":"Foggia, It\u00e1lia, Gino Lisa","codigo":"FOG"},{"cidade":"Forde, Noruega, Bringeland","codigo":"FDE"},{"cidade":"Forli, It\u00e1lia, Luigi Ridolf","codigo":"FRL"},{"cidade":"Formosa, Argentina, Formosa","codigo":"FMA"},{"cidade":"Fort Albany, Canad\u00e1, Fort Abany","codigo":"YFA"},{"cidade":"Fortaleza, Brasil, Pinto Martins","codigo":"FOR"},{"cidade":"Fort Frances, Canad\u00e1, Municipal","codigo":"YAG"},{"cidade":"Fort Good Hope, Canad\u00e1, Fort Good Hope, ","codigo":"YGH"},{"cidade":"Fort Hope, Canad\u00e1, Fort Hope","codigo":"YFH"},{"cidade":"Fort Lauderdale, Estados Unidos da Am\u00e9rica, Fort Lauderdale","codigo":"FLL"},{"cidade":"Fort McMurray, Canad\u00e1, Fort McMurray","codigo":"YMM"},{"cidade":"Fort Myers, Estados Unidos da Am\u00e9rica, Southwest Fl\u00f3rida","codigo":"RSW"},{"cidade":"Fort Severn, Canad\u00e1, Fort Severn","codigo":"YER"},{"cidade":"Fort Simpson, Canad\u00e1, Fort Simpson","codigo":"YFS"},{"cidade":"Fort Smith, Canad\u00e1, Fort Smith","codigo":"YSM"},{"cidade":"Fort Smith, Estados Unidos da Am\u00e9rica, Fort Smith","codigo":"FSM"},{"cidade":"Fort St. John, North Peace","codigo":"YXJ"},{"cidade":"Fortuna, Costa Rica, Arenal","codigo":"FON"},{"cidade":"Fort Wayne, Estados Unidos da Am\u00e9rica, Fort Wayne","codigo":"FWA"},{"cidade":"Foshan, China, Shadi","codigo":"FUO"},{"cidade":"Foula, Reino Unido, Foula","codigo":"FOA"},{"cidade":"Foz do Igua\u00e7u, Brasil, Cataratas","codigo":"IGU"},{"cidade":"Franceville, Gab\u00e3o, Mvengue","codigo":"MVB"},{"cidade":"Francistown, Botsuana, Francistown","codigo":"FRW"},{"cidade":"Frankfurt, Alemanha, Hahn Airport","codigo":"HHN"},{"cidade":"Frankfurt\u00a0, Alemanha, Frankfurt International","codigo":"FRA"},{"cidade":"Fredericton, Canad\u00e1, Frederiction","codigo":"YFC"},{"cidade":"Freeport, Bahamas, Grand Bahama","codigo":"FPO"},{"cidade":"Freetown, Serra Leoa, Lungi Internatinal","codigo":"FNA"},{"cidade":"Fresno, Estados Unidos da Am\u00e9rica, Fresno Yosemite","codigo":"FAT"},{"cidade":"Friedrichshafen, Alemanha, Friedrichshafen","codigo":"FDH"},{"cidade":"Fuerteventura, Espanha, Fuerteventura","codigo":"FUE"},{"cidade":"Fukue, Jap\u00e3o, Goto Fukue","codigo":"FUJ"},{"cidade":"Fukuoka, Jap\u00e3o, Fukuoka","codigo":"FUK"},{"cidade":"Fukushima, Jap\u00e3o, Fukushima","codigo":"FKS"},{"cidade":"Funchal, Portugal, Madeira","codigo":"FNC"},{"cidade":"Fuyang, China, Changle International","codigo":"FUG"},{"cidade":"Fuyuan, China, Fuyuan","codigo":"FYJ"},{"cidade":"Fuyun, China, Fuyun","codigo":"FYN"},{"cidade":"Fuzhou, China, Changle International","codigo":"FOC"},{"cidade":"Gabes, Tun\u00edsia, Matmata","codigo":"GAE"},{"cidade":"Gaborone, Botsuana, Sir Seretse Khama","codigo":"GBE"},{"cidade":"Gachsaran, Ir\u00e3, Gachsaran","codigo":"GCH"},{"cidade":"Gafsa, Tun\u00edsia, Ksar","codigo":"GAF"},{"cidade":"Gainesville, Estados Unidos da Am\u00e9rica, Gainesville","codigo":"GNV"},{"cidade":"Galapagos, Equador, Seymour","codigo":"GPS, Equador"},{"cidade":"Galcaio, Som\u00e1lia, Galcaio","codigo":"GLK"},{"cidade":"Galela, Indon\u00e9sia","codigo":"GLX"},{"cidade":"Galena, Estados Unidos da Am\u00e9rica, Edward G. Pitka Sr.","codigo":"GAL"},{"cidade":"Gallivare, Su\u00e9cia, Gallivare","codigo":"GEV"},{"cidade":"Galway, Irlanda, Galway","codigo":"GWY"},{"cidade":"Gambela, Eti\u00f3pia, Gambela","codigo":"GMB"},{"cidade":"Gamboola, Austr\u00e1lia","codigo":"GBP"},{"cidade":"Gander, Canad\u00e1, Gander","codigo":"YQX"},{"cidade":"Gangtok, \u00cdndia, Pakyong Airport","codigo":"PYG"},{"cidade":"Ganja, Azerbaij\u00e3o, Ganja","codigo":"KVD"},{"cidade":"Ganzhou, China, Huangjin.","codigo":"KOW"},{"cidade":"Ganzi, China, Gesaer","codigo":"GZG"},{"cidade":"Garissa, Qu\u00eania, Garissa","codigo":"GAS"},{"cidade":"Garoe, Som\u00e1lia, Garoe","codigo":"GGR"},{"cidade":"Garoua, Camar\u00f5es, Garoua","codigo":"GOU"},{"cidade":"Gaspe, Canad\u00e1, Michel Pouliot","codigo":"YGP"},{"cidade":"Gassim, Ar\u00e1bia Saudita, Gassim","codigo":"ELQ"},{"cidade":"Gaya, \u00cdndia, Gaya","codigo":"GAY"},{"cidade":"Gaziantep, Turquia, Oguzeli","codigo":"GZT"},{"cidade":"Gazipasa, Turquia, Gazipasa","codigo":"GZP"},{"cidade":"Gdansk, Polonia, Lech Walesa","codigo":"GDN"},{"cidade":"Gelendzhik, R\u00fassia, Gelendzhik","codigo":"GDZ"},{"cidade":"Gelephu, But\u00e3o, Gelephu","codigo":"GLU"},{"cidade":"Gemena, Rep\u00fablica Democr\u00e1tica do Congo, Gemena","codigo":"GMA"},{"cidade":"Genebra, Su\u00ed\u00e7a, Geneva International","codigo":"GVA"},{"cidade":"Geneina, Sud\u00e3o, Geneina","codigo":"EGN"},{"cidade":"General Santos Buayan, Filipinas","codigo":"GES"},{"cidade":"Genova, It\u00e1lia, Cristoforo Colombo","codigo":"GOA"},{"cidade":"George, \u00c1frica do Sul, George","codigo":"GRJ"},{"cidade":"George Town, Bahamas, Exuma International","codigo":"GGT"},{"cidade":"Georgetown, Guiana, Cheddi Jagan","codigo":"GEO"},{"cidade":"Georgetown, Guiana, Ogle","codigo":"OGL"},{"cidade":"Geraldton, Austr\u00e1lia, Geraldton","codigo":"GET"},{"cidade":"Ghardaia, Arg\u00e9lia, Noumetate","codigo":"GHA"},{"cidade":"Ghat, L\u00edbia, Ghat","codigo":"GHT"},{"cidade":"Gilgit, Paquist\u00e3o, Gilgit","codigo":"GIL"},{"cidade":"Gillam, Canad\u00e1, Gillam","codigo":"YGX"},{"cidade":"Gillette, Estados Unidos da Am\u00e9rica, Campbell County","codigo":"GCC"},{"cidade":"Girona, Espanha, Costa Brava","codigo":"GRO"},{"cidade":"Giza, Egito, Sphinx International","codigo":"SPX"},{"cidade":"Gizan, Ar\u00e1bia Saudita, gizan.","codigo":"GIZ"},{"cidade":"Gjoa Haven, Canad\u00e1, Gjoa Haven","codigo":"YHK"},{"cidade":"Gjogur, Isl\u00e2ndia, Gjogur","codigo":"GJR"},{"cidade":"Gladstone, Austr\u00e1lia, Gladstone","codigo":"GLT"},{"cidade":"Glasgow, Reino Unido, Glasgow International","codigo":"GLA"},{"cidade":"Goa, \u00cdndia, Dabolim","codigo":"GOI"},{"cidade":"Goba, Eti\u00f3pia, Robe","codigo":"GOB"},{"cidade":"Gode, Eti\u00f3pia, Gode","codigo":"GDE"},{"cidade":"Gods Lake Narrows, Canad\u00e1, Gods Lake Narrows","codigo":"YGO"},{"cidade":"Goi\u00e2nia, Brasil, Santa Genoveva","codigo":"GYN"},{"cidade":"Gold Coast, Austr\u00e1lia, Coolangatta","codigo":"OOL"},{"cidade":"Golfito, Costa Rica, Golfito","codigo":"GLF"},{"cidade":"Golmud, China, Golmud","codigo":"GOQ"},{"cidade":"Golog, China, Maqin","codigo":"GMQ"},{"cidade":"Goma, Rep\u00fablica Democr\u00e1tica do Congo, Goma","codigo":"GOM"},{"cidade":"Gombe, Nig\u00e9ria, Lawanti","codigo":"GMO"},{"cidade":"Gomel, Bielor\u00fassia, Gomel","codigo":"GME"},{"cidade":"Gondar, Eti\u00f3pia, Azezo","codigo":"GDQ"},{"cidade":"Goose Bay, Canad\u00e1, Goose Bay","codigo":"YYR"},{"cidade":"Gorakhpur, \u00cdndia, Gorakhpur","codigo":"GOP"},{"cidade":"Gorgan, Ir\u00e3, Gorgan Airport","codigo":"GBT"},{"cidade":"Gorno Altaysk, R\u00fassia, Gorno Altaysk","codigo":"RGK"},{"cidade":"Gorontalo, Indon\u00e9sia","codigo":"GTO"},{"cidade":"Gotemburgo, Su\u00e9cia, City Airport","codigo":"GSE"},{"cidade":"Gotemburgo, Su\u00e9cia, Landvetter","codigo":"GOT"},{"cidade":"Governador Valadares, Brasil, A. Machado Oliveira","codigo":"GVR"},{"cidade":"Governors Harbour, Bahamas, Governors Harbour","codigo":"GHB"},{"cidade":"Gr\u00e3 Can\u00e1ria, Espanha, Gran Canaria","codigo":"LPA"},{"cidade":"Graciosa Island, Portugal, Graciosa Island","codigo":"GRW"},{"cidade":"Grafton, Austr\u00e1lia, Clarence Valley","codigo":"GFN"},{"cidade":"Granada, Espanha, Frederico Garcia Lorca","codigo":"GRX"},{"cidade":"Granada, Granada, Maurice Bishop","codigo":"GND"},{"cidade":"Grande Prairie, Canad\u00e1,Grande Praire","codigo":"YQU"},{"cidade":"Grand Forks, Estados Unidos da Am\u00e9rica, Grand Forks","codigo":"GFK"},{"cidade":"Grand Junction, Estados Unidos da Am\u00e9rica, Grand Junction","codigo":"GJT"},{"cidade":"Grand Rapids, Estados Unidos da Am\u00e9rica, . Gerald R Ford","codigo":"GRR"},{"cidade":"Grand Santi, Guiana Francesa, Grand Santi","codigo":"GSI"},{"cidade":"Granites, Austr\u00e1lia","codigo":"GTS"},{"cidade":"Graz, \u00c1ustria, Graz Airport","codigo":"GRZ"},{"cidade":"Great Falls, Estados Unidos da Am\u00e9rica, Great Falls","codigo":"GTF"},{"cidade":"Green Bay, Estados Unidos da Am\u00e9rica, Austin Straubel International","codigo":"GRB"},{"cidade":"Greensboro, Estados Unidos da Am\u00e9rica, Piedmont Triad","codigo":"GSO"},{"cidade":"Greenville, Estados Unidos da Am\u00e9rica, Pitt-Greenville","codigo":"PGV"},{"cidade":"Greer, Estados Unidos da Am\u00e9rica, Greenville-Spartanburg","codigo":"GSP"},{"cidade":"Griffith, Austr\u00e1lia, Griffith","codigo":"GFF"},{"cidade":"Grimsey, Isl\u00e2ndia, Grimsey","codigo":"GRY"},{"cidade":"Grise Fiord, Canad\u00e1, Grise Fiord","codigo":"YGZ"},{"cidade":"Grodno, Bielor\u00fassia. Grodno","codigo":"GNA"},{"cidade":"Groningen, Holanda, Eelde","codigo":"GRQ"},{"cidade":"Groote Eylandt, Austr\u00e1lia, Groote Eylandt","codigo":"GTE"},{"cidade":"Grozny, R\u00fassia, Grozny","codigo":"GRV"},{"cidade":"Grumeti, Tanz\u00e2nia, Kirawira B","codigo":"GTZ"},{"cidade":"Guadalajara, M\u00e9xico, Miguel Hidalgo International","codigo":"GDL"},{"cidade":"Guaiaquil, Equador, Jose Joaquim de Olmedo","codigo":"GYE, Equador"},{"cidade":"Gualaco, Som\u00e1lia, Guriel","codigo":"GUO"},{"cidade":"Guam, Estados Unidos da Am\u00e9rica, Antonio B. Won Pat International","codigo":"GUM"},{"cidade":"Guanaja, Honduras, Guanaja","codigo":"GJA"},{"cidade":"Guangyuan, China, Panlong","codigo":"GYS"},{"cidade":"Guantanamo, Cuba, Guantanamo","codigo":"GAO"},{"cidade":"Guatemala City, Guatemala, La Aurora International","codigo":"GUA"},{"cidade":"Guayaramerin, Bol\u00edvia, Guayaramerin","codigo":"GYA"},{"cidade":"Guaymas, M\u00e9xico, Jose Maria Yanez International","codigo":"GYM"},{"cidade":"Guelmime, Marrocos, Guelmime","codigo":"GLN"},{"cidade":"Guernsey, Reino Unido, Guernsey","codigo":"GCI"},{"cidade":"Guerrero Negro, M\u00e9xico, Guerrero Negro","codigo":"GUB"},{"cidade":"Gueshm Island, Ir\u00e3, Dayrestan","codigo":"GSM"},{"cidade":"Guilin, China, Liangjiang International","codigo":"KWL"},{"cidade":"Guiyang, China, Longdongbao International","codigo":"KWE"},{"cidade":"Gulbarga, \u00cdndia, Kalaburgi","codigo":"GBI"},{"cidade":"Gulfport, Biloxi, Estados Unidos da Am\u00e9rica, Gulfport, Biloxi","codigo":"GPT"},{"cidade":"Gulu, Uganda, Gulu","codigo":"ULU"},{"cidade":"Gunnison, Estados Unidos da Am\u00e9rica, Gunnison-Crested Butte","codigo":"GUC"},{"cidade":"Gunsan, Cor\u00e9ia do Sul, Gunsan","codigo":"KUV"},{"cidade":"Gunungsitoli, Indon\u00e9sia","codigo":"GNS"},{"cidade":"Gurayat, Ar\u00e1bia Saudita, Gurayat","codigo":"URY"},{"cidade":"Guwahati, \u00cdndia, Gopinath Bordoloi","codigo":"GAU"},{"cidade":"Guyuan, China, Liupanshan","codigo":"GYU"},{"cidade":"Gwadar, Paquist\u00e3o, International","codigo":"GWD"},{"cidade":"Gwalior, \u00cdndia, Gwalior","codigo":"GWL"},{"cidade":"Gwangju, Cor\u00e9ia do Sul","codigo":"KWJ"},{"cidade":"Gyumri, Arm\u00eania, Shirak","codigo":"LWN"},{"cidade":"Hachijojima, Jap\u00e3o, Hachijojima","codigo":"HAC"},{"cidade":"Hagerstown, Estados Unidos da Am\u00e9rica, Hagerstown","codigo":"HGR"},{"cidade":"Hagfors, Su\u00e9cia, Hagfors","codigo":"HFS"},{"cidade":"Haifa, Israel, Haifa","codigo":"HFA"},{"cidade":"Haikou, China, Meilan International","codigo":"HAK"},{"cidade":"Hail, Ar\u00e1bia Saudita, Hail","codigo":"HAS"},{"cidade":"Hailar, China, Dongshan","codigo":"HLD"},{"cidade":"Hailey, Estados Unidos da Am\u00e9rica, Sun Valley","codigo":"SUN"},{"cidade":"Hai Phong, Vietn\u00e3, Cat Bi International","codigo":"HPH"},{"cidade":"Hakkari, Turquia, Y\u00fcksekova","codigo":"YKO"},{"cidade":"Hakodate, Jap\u00e3o, Hakodate","codigo":"HKD"},{"cidade":"Halifax, Canad\u00e1, Halifax","codigo":"YHZ"},{"cidade":"Hall Beach, Canad\u00e1, Hall Beach","codigo":"YUX"},{"cidade":"Halls Creek, Austr\u00e1lia","codigo":"HCQ"},{"cidade":"Halmstad, Su\u00e9cia, Halmstad","codigo":"HAD"},{"cidade":"Hamadan, Ir\u00e3, Hamadan","codigo":"HDM"},{"cidade":"Hamar, Noruega, Stafsberg","codigo":"HMR"},{"cidade":"Hambantota, Sri Lanka, Mattala Rajapaksa","codigo":"HRI"},{"cidade":"Hamburgo, Alemanha, Hamburg Internartional","codigo":"HAM"},{"cidade":"Hamburgo, Alemanha, Lubeck Blankensee","codigo":"LBC"},{"cidade":"Hamburgo, Alemanha, Luebeck Blankensee","codigo":"LBC"},{"cidade":"Hami, China, Hami","codigo":"HMI"},{"cidade":"Hamilton, Austr\u00e1lia, Great Barrier Reef Airport","codigo":"HTI"},{"cidade":"Hammerfest, Noruega, Hammerfest","codigo":"HFT"},{"cidade":"Hana, Estados Unidos da Am\u00e9rica, Hana","codigo":"HNM"},{"cidade":"Hancock, Estados Unidos da Am\u00e9rica, Houghton County","codigo":"CMX"},{"cidade":"Handan, China, Handan","codigo":"HDG"},{"cidade":"Hangzhou, China, Xiaoshan International","codigo":"HGH"},{"cidade":"Han\u00f3i, Vietn\u00e3, Noi Bai International","codigo":"HAN"},{"cidade":"Hanover\u00a0, Alemanha, Hannover","codigo":"HAJ"},{"cidade":"Hanzhong, China, Xiguan","codigo":"HZG"},{"cidade":"Harare, Zimb\u00e1bue, RG Mugabe International","codigo":"HRE"},{"cidade":"Harbin, China, Taiping International","codigo":"HRB"},{"cidade":"Hargeisa, Som\u00e1lia, Egal International","codigo":"HGA"},{"cidade":"Harlingen, Estados Unidos da Am\u00e9rica, Valley Intenational","codigo":"HRL"},{"cidade":"Harrisburg , Estados Unidos da Am\u00e9rica, Harrisburg International","codigo":"MDT"},{"cidade":"Harstad Narvik, Noruega, Evenes Apt","codigo":"EVE"},{"cidade":"Hassi Messaoud, Arg\u00e9lia, Oued Irara","codigo":"HME"},{"cidade":"Hassi RMel - Tilrempt, Arg\u00e9lia","codigo":"HRM"},{"cidade":"Hasvik, Noruega, Hasvik","codigo":"HAA"},{"cidade":"Hatay, Turquia, Hatay","codigo":"HTY"},{"cidade":"Hattiesburg\u00a0, \u00a0Laurel, Estados Unidos da Am\u00e9rica, Hattiesburg, Laurel","codigo":"PIB"},{"cidade":"Hatton, Sri Lanka, Castlereagh Reservoir","codigo":"NUF"},{"cidade":"Hat Yai, Tail\u00e2ndia, Hatyai","codigo":"HDY"},{"cidade":"Haugesund, Noruega, karmoy","codigo":"HAU"},{"cidade":"Havana, Cuba, Jos\u00e9 Marti","codigo":"HAV"},{"cidade":"Havre St. Pierre, Canad\u00e1, Havre St. Pierre","codigo":"YGV"},{"cidade":"Hayden, Estados Unidos da Am\u00e9rica, Yampa Valley","codigo":"HDN"},{"cidade":"Hay River, Canad\u00e1, Merlyn Carter","codigo":"YHY"},{"cidade":"Hechi, China, Jin Cheng Jiang","codigo":"HCJ"},{"cidade":"Hefei, China, Xianqiao International","codigo":"HFE"},{"cidade":"Heho, Mianmar, Heho","codigo":"HEH"},{"cidade":"Heide - B\u00fcsum Heide\u00a0, Alemanha","codigo":"HEI"},{"cidade":"Heihe, China, Heihe","codigo":"HEK"},{"cidade":"Helena, Estados Unidos da Am\u00e9rica, Helena","codigo":"HLN"},{"cidade":"Helgoland\u00a0, Alemanha","codigo":"HGL"},{"cidade":"Helsink, Finl\u00e2ndia, Vantaa","codigo":"HEL"},{"cidade":"Hemavan Tarnaby, Su\u00e9cia, Hemavan Tarnaby","codigo":"HMV"},{"cidade":"Hengyang, China, Bajialing","codigo":"HNY"},{"cidade":"Heraklion, Gr\u00e9cia, Nkos Kazantzakis","codigo":"HER"},{"cidade":"Herat, Afeganist\u00e3o, Herat","codigo":"HEA"},{"cidade":"Heringsdorf, Alemanha, Heringsdorf","codigo":"HDF"},{"cidade":"Hermosillo, M\u00e9xico, Ignacio Pesqueira Garcia","codigo":"HMO"},{"cidade":"Hervey Bay, Austr\u00e1lia, Hervey Bay","codigo":"HVB"},{"cidade":"Heviz, Hungria, Balaton","codigo":"SOB"},{"cidade":"Highbury, Austr\u00e1lia","codigo":"HIG"},{"cidade":"High Level, Canad\u00e1, High Level","codigo":"YOJ"},{"cidade":"Hilo, Estados Unidos da Am\u00e9rica, Hino","codigo":"ITO"},{"cidade":"Hilton Head Island, Estados Unidos da Am\u00e9rica, Hilton Head","codigo":"HXD"},{"cidade":"Hingurakgoda, Sri Lanka, Minneriya","codigo":"HIM"},{"cidade":"Hiroshima, Jap\u00e3o, Hiroshima Airport","codigo":"HIJ"},{"cidade":"Hobart, Austr\u00e1lia, Hobart International","codigo":"HBA"},{"cidade":"Ho Chi Minh Vity, Vietn\u00e3, Tan Son Nhat","codigo":"SGN"},{"cidade":"Hodeidah, I\u00eamen, Hodeidah International","codigo":"HOD"},{"cidade":"Hoedspruit, \u00c1frica do Sul, Hoedspruit","codigo":"HDS"},{"cidade":"Hof, Alemanha, Plauen","codigo":"HOQ"},{"cidade":"Hofuf, Ar\u00e1bia Saudita, Al Ahsa","codigo":"HOF"},{"cidade":"Hohhot, China, Baita International","codigo":"HET"},{"cidade":"Holgu\u00edn, Cuba, Frank Pais","codigo":"HOG"},{"cidade":"Homalin, Mianmar, Homalin","codigo":"HOX"},{"cidade":"Homer, Estados Unidos da Am\u00e9rica, Homer","codigo":"HOM"},{"cidade":"Hong Kong International Airport, China","codigo":"HKG"},{"cidade":"Hongyuan, China, Aba Hongyuan","codigo":"AHJ"},{"cidade":"Honningsvag, Noruega, Valan","codigo":"HVG"},{"cidade":"Honolulu, Estados Unidos da Am\u00e9rica, Hickam AFB","codigo":"HNL"},{"cidade":"Hoonah, Estados Unidos da Am\u00e9rica, Hoonah","codigo":"HNH"},{"cidade":"Hopedale, Canad\u00e1, Hopedale","codigo":"YHO"},{"cidade":"Hornafjorur, Isl\u00e2ndia, Hofn","codigo":"HFN"},{"cidade":"Horn Island, Austr\u00e1lia","codigo":"HID"},{"cidade":"Horta, Portugal, Horta","codigo":"HOR"},{"cidade":"Hotan, China, Hotan","codigo":"HTN"},{"cidade":"Houeisay, Laos, Houeisay","codigo":"HOE"},{"cidade":"Houston, Estados Unidos da Am\u00e9rica, George Bush International","codigo":"IAH"},{"cidade":"Houston, Estados Unidos da Am\u00e9rica, William P. Hobby","codigo":"HOU"},{"cidade":"Hua Hin, Tail\u00e2ndia, Hua Hin","codigo":"HHQ"},{"cidade":"Huaian, China, Lianshui","codigo":"HIA"},{"cidade":"Huambo,\u00a0Angola, Albano Machado","codigo":"NOV"},{"cidade":"Huang Ping, China, Kaili","codigo":"KJH"},{"cidade":"Huangshan, China, Tunxi International","codigo":"TXN"},{"cidade":"Huanuco, Peru, Huanuco","codigo":"HUU"},{"cidade":"Huaraz, Peru, German\u00a0Arias Graziani","codigo":"ATA"},{"cidade":"Huatugou, China, Huatugou","codigo":"HTT"},{"cidade":"Huatulco, M\u00e9xico, Bahias de Huatulco","codigo":"HUX"},{"cidade":"Hubli, \u00cdndia, Hubli","codigo":"HBX"},{"cidade":"Hue, Vietn\u00e3, Phu Bai International","codigo":"HUI"},{"cidade":"Hughenden, Austr\u00e1lia","codigo":"HGD"},{"cidade":"Huizhou, China, Huizhou","codigo":"HUZ"},{"cidade":"Humberside, Reino Unido, Humberside","codigo":"HUY"},{"cidade":"Humera, Eti\u00f3pia, Humera","codigo":"HUE"},{"cidade":"Huntington, Estados Unidos da Am\u00e9rica, Tri-State","codigo":"HTS"},{"cidade":"Huntsville, Estados Unidos da Am\u00e9rica, Carl T. Jones Field","codigo":"HSV"},{"cidade":"Huolinguole, China, Huolinhe","codigo":"HUO"},{"cidade":"Hurghada, Egito, Intenational","codigo":"HRG"},{"cidade":"Husavik, Isl\u00e2ndia, Husavik","codigo":"HZK"},{"cidade":"Hyannis, Estados Unidos da Am\u00e9rica, Barnstable","codigo":"HYA"},{"cidade":"Hyderabad, \u00cdndia, Rajiv Ganhi","codigo":"HYD"},{"cidade":"Iasi, Rom\u00eania, Iasi","codigo":"IAS"},{"cidade":"Ibadan, Nig\u00e9ria, Ibadan","codigo":"IBA"},{"cidade":"Ibague, Col\u00f4mbia, Perales","codigo":"IBE"},{"cidade":"Ibaraki, Jap\u00e3o, Ibaraki","codigo":"IBR"},{"cidade":"Ibiza, Espanha, Ibiza","codigo":"IBZ"},{"cidade":"Ic\u00e1ria, Gr\u00e9cia, Ikaria Island","codigo":"JIK"},{"cidade":"Idaho Falls, I Estados Unidos da Am\u00e9rica, \u00a0Idaho Falls","codigo":"IDA"},{"cidade":"Igarka, R\u00fassia, Igarka","codigo":"IAA"},{"cidade":"Igdir, Turquia, Igdir Airport","codigo":"IGD"},{"cidade":"Igloolik, Canad\u00e1, Igloolik","codigo":"YGT"},{"cidade":"Iguazu, Argentina, Cataratas Del Iguazu","codigo":"IGR"},{"cidade":"Iki, Jap\u00e3o, Iki","codigo":"IKI"},{"cidade":"Ilam, Ir\u00e3, Ilam","codigo":"IIL"},{"cidade":"Iles De La Madeleine, Canad\u00e1, Iles De La Madeleine","codigo":"YGR"},{"cidade":"Ilha Coconut, Austr\u00e1lia","codigo":"CNC"},{"cidade":"Ilha de Boa Vista, Cabo Verde, Rabil","codigo":"BVC"},{"cidade":"Ilha de Delma, Emirados \u00c1rabes Unidos, Delma Island","codigo":"ZDY"},{"cidade":"Ilha de Elba, It\u00e1lia, Marina de Campo","codigo":"EBA"},{"cidade":"Ilha de Elcho, Austr\u00e1lia","codigo":"ELC"},{"cidade":"Ilha de Maio, Cabo verde, Maio Island","codigo":"MMO"},{"cidade":"Ilha de Man, Reino Unido, Ronaldsway","codigo":"IOM"},{"cidade":"Ilha de Sao Nicolau, Cabo Verde, Preguica","codigo":"SNE"},{"cidade":"Ilha de Sao Vicente, Cabo Verde, San Pedro","codigo":"VXE"},{"cidade":"Ilha do Sal, Cabo Verde, Amilcar Cabral International, ","codigo":"SID"},{"cidade":"Ilh\u00e9us, Brasil, Jorge Amado","codigo":"IOS"},{"cidade":"Illizi, Arg\u00e9lia","codigo":"VVZ"},{"cidade":"Iloilo, Filipinas","codigo":"ILO"},{"cidade":"Ilo, Peru, Ilo","codigo":"ILQ"},{"cidade":"Ilorin, Nig\u00e9ria, Ilorin International","codigo":"ILR"},{"cidade":"Imperatriz, Brasil, Renato Moreira","codigo":"IMP"},{"cidade":"Imperial, Estados Unidos da Am\u00e9rica, Imperial County","codigo":"IPL"},{"cidade":"Imphal, \u00cdndia, Imphal","codigo":"IMF"},{"cidade":"Inagua, Bahamas, Matthew Town","codigo":"IGA"},{"cidade":"In Amenas, Arg\u00e9lia","codigo":"IAM"},{"cidade":"Indaselassie, Eti\u00f3pia, Shire","codigo":"SHC"},{"cidade":"Independence, Belize, Independence","codigo":"INB"},{"cidade":"Indianapolis, Estados Unidos da Am\u00e9rica, Indianapolis","codigo":"IND"},{"cidade":"Indore, \u00cdndia, Devi Ahilya Bai Holkar","codigo":"IDR"},{"cidade":"Ingolstadt Manching\u00a0, Alemanha","codigo":"IGS"},{"cidade":"In Guezzam, Arg\u00e9lia","codigo":"INF"},{"cidade":"Inhambane, Mo\u00e7ambique, Inhambane","codigo":"INH"},{"cidade":"Inkerman, Austr\u00e1lia","codigo":"IKP"},{"cidade":"Innsbruck, \u00c1ustria, Innsbruck Airport","codigo":"INN"},{"cidade":"In Salah, Arg\u00e9lia","codigo":"INZ"},{"cidade":"Inta, R\u00fassia, Inta","codigo":"INA"},{"cidade":"International Falls, Estados Unidos da Am\u00e9rica, International Falls","codigo":"INL"},{"cidade":"Inukjuak, Canad\u00e1, Inukjuak","codigo":"YPH"},{"cidade":"Inuvik, , Canad\u00e1, Mike Zubko","codigo":"YEV"},{"cidade":"Inverell, Austr\u00e1lia, Inverell","codigo":"IVR"},{"cidade":"Inyokern, Estados Unidos da Am\u00e9rica, Inyokern","codigo":"IYK"},{"cidade":"Ioannina, Gr\u00e9cia, King Pyrros","codigo":"IOA"},{"cidade":"Ipatinga, Brasil, Usiminas","codigo":"IPN"},{"cidade":"Ipoh, Mal\u00e1sia, Sultan Azlan Shah","codigo":"IPH"},{"cidade":"Iqaluit, Canad\u00e1, Iqaluit","codigo":"YFB"},{"cidade":"Iquique, Chile, Diego Aracena","codigo":"IQQ"},{"cidade":"Iquitos, Peru, F Secada Vignetta","codigo":"IQT"},{"cidade":"Iranshahr, Ir\u00e3, Iranshahr Airport","codigo":"IHR"},{"cidade":"Irarutu, Indon\u00e9sia, Babo","codigo":"BXB"},{"cidade":"Iringa, Tanz\u00e2nia, Iringa","codigo":"IRI"},{"cidade":"Irkutsk, R\u00fassia, Irkutsk","codigo":"IKT"},{"cidade":"Isafjordur, Isl\u00e2ndia, Isafjordur","codigo":"IFJ"},{"cidade":"Ishigaki, Jap\u00e3o, New Ishigaki","codigo":"ISG"},{"cidade":"Isiro, Rep\u00fablica Democr\u00e1tica do Congo, Matari","codigo":"IRP"},{"cidade":"Islamabad, Paquist\u00e3o, International","codigo":"ISB"},{"cidade":"Island Lake, Canad\u00e1, Garden Hill","codigo":"YIV"},{"cidade":"Islay, Reino Unido, Islay","codigo":"ILY"},{"cidade":"Islip, Estados Unidos da Am\u00e9rica, Long Island MacArthur","codigo":"ISP"},{"cidade":"Isparta, Turquia, Suleyman Demirel","codigo":"ISE"},{"cidade":"Istambul, Turquia, Ataturk Airport","codigo":"ISL"},{"cidade":"Istambul, Turquia, New Istanbul Airport","codigo":"IST"},{"cidade":"Istambul, Turquia, Sabiha Gokcen","codigo":"SAW"},{"cidade":"Istambul, Turquia , Todos Aeroportos","codigo":"IST"},{"cidade":"Ithaca, Estados Unidos da Am\u00e9rica, Tompkins","codigo":"ITH"},{"cidade":"Iturup Island, R\u00fassia, Iturup","codigo":"ITU"},{"cidade":"Ivalo, Finl\u00e2ndia, Ivalo","codigo":"IVL"},{"cidade":"Ivano Frankivsk, Ucr\u00e2nia, Ivano Frankivsk","codigo":"IFO"},{"cidade":"Ivanovo, R\u00fassia, Yuzhny","codigo":"IWA"},{"cidade":"Ivujivik, Canad\u00e1, Ivujivik","codigo":"YIK"},{"cidade":"Iwakuni, Jap\u00e3o, Iwakuni","codigo":"IWK"},{"cidade":"Ixtapa Zihuatanejo, M\u00e9xico, Ixtapa Zihuatanejo International","codigo":"ZIH"},{"cidade":"Izhevsk, R\u00fassia, Izhevsk","codigo":"IJK"},{"cidade":"Izmir, Turquia, Adnan Menderes","codigo":"ADB"},{"cidade":"Izumo, Jap\u00e3o, Izumo","codigo":"IZO"},{"cidade":"Jabalpur, \u00cdndia, Jabalpur","codigo":"JLR"},{"cidade":"Jacarta, Indon\u00e9sia, Halim Perdanakusama Airport","codigo":"HLP"},{"cidade":"Jacarta, Indon\u00e9sia, Soekarno Hatta International","codigo":"CGK"},{"cidade":"Jacarta, Indon\u00e9sia , Todos Aeroportos","codigo":"JKT"},{"cidade":"Jackson, Estados Unidos da Am\u00e9rica, Jackson Hole","codigo":"JAC"},{"cidade":"Jackson, Estados Unidos da Am\u00e9rica, Medgar W Everst","codigo":"JAN"},{"cidade":"Jacksonville, Estados Unidos da Am\u00e9rica, Albert J. Ellis","codigo":"OAJ"},{"cidade":"Jacksonville, Estados Unidos da Am\u00e9rica, Jacksonville","codigo":"JAX"},{"cidade":"Jaen, Peru, Aeropuerto de Shumba","codigo":"JAE"},{"cidade":"Jagdalpur, \u00cdndia, Jagdalpur","codigo":"JGB"},{"cidade":"Jahrom, Ir\u00e3, Jahrom Airport","codigo":"JAR"},{"cidade":"Jaipur, \u00cdndia, International","codigo":"JAI"},{"cidade":"Jaisalmer, \u00cdndia, Jaisalmer","codigo":"JSA"},{"cidade":"Jakar, But\u00e3o, Bathpalathang","codigo":"BUT"},{"cidade":"Jalalabad, Afeganist\u00e3o Faizabad","codigo":"JAA"},{"cidade":"Jambi, Indon\u00e9sia, Sultan Thaha","codigo":"DJB"},{"cidade":"Jamestown, Estados Unidos da Am\u00e9rica, Chautauqua County","codigo":"JHW"},{"cidade":"Jammu, \u00cdndia, Satwari","codigo":"IXJ"},{"cidade":"Jamnagar, \u00cdndia, Govardhanpur","codigo":"JGA"},{"cidade":"Janakpur, Nepal, Janakpur","codigo":"JKR"},{"cidade":"Jaque, Panam\u00e1, Jaque","codigo":"JQE"},{"cidade":"Jauja, Peru, Jauja","codigo":"JAU"},{"cidade":"Jayapura, Indon\u00e9sia, Sentani","codigo":"DJJ"},{"cidade":"Jeddah\u00a0 Ar\u00e1bia Saudita, King Abdulaziz","codigo":"JED"},{"cidade":"Jeju, Cor\u00e9ia do Sul, Jeju International","codigo":"CJU"},{"cidade":"Jember, Indon\u00e9sia, Noto Hadinegoro","codigo":"JBB"},{"cidade":"Jerez de la Frontera, Espanha, Jerez Airport","codigo":"XRY"},{"cidade":"Jericoacoara, Brasil, Jericoacoara","codigo":"JJD"},{"cidade":"Jersei, Reino Unido, Jersey","codigo":"JER"},{"cidade":"Jessore, Bangladesh, Jessore","codigo":"JSR"},{"cidade":"Jharsuguda, \u00cdndia, Veer Surendra Sai","codigo":"JRG"},{"cidade":"Jiagedaqi, China, Jiagedaqi","codigo":"JGD"},{"cidade":"Jiamusi, China, Dongjiao","codigo":"JMU"},{"cidade":"Ji An, China, Jinggangshan","codigo":"JGS"},{"cidade":"Jiansanjiang, China, Jiansanjiang","codigo":"JSJ"},{"cidade":"Jiayuguan, China, Jiayuguan","codigo":"JGN"},{"cidade":"Jijel, Arg\u00e9lia","codigo":"GJL"},{"cidade":"Jijiga, Eti\u00f3pia, Jijiga","codigo":"JIJ"},{"cidade":"Jimma, Eti\u00f3pia, Aba Segud","codigo":"JIM"},{"cidade":"Jinan, China, Yaoqiang International","codigo":"TNA"},{"cidade":"Jinchang, China, JINCHUAN","codigo":"JIC"},{"cidade":"Jingdezhen, China, Jingdezhen","codigo":"JDZ"},{"cidade":"Jinghong, China, Xishuangbanna","codigo":"JHG"},{"cidade":"Jining, China, Qufu","codigo":"JNG"},{"cidade":"Jinju, Cor\u00e9ia do Sul, Sacheon","codigo":"HIN"},{"cidade":"Jinka, Eti\u00f3pia, Bako","codigo":"BCO"},{"cidade":"Jinzhou, China, Jinzhouwan","codigo":"JNZ"},{"cidade":"Ji Paran\u00e1, Brasil, Jose Coleto","codigo":"JPR"},{"cidade":"Jiroft, Ir\u00e3, Jiroft","codigo":"JYR"},{"cidade":"Jiuzhaigou, China, Jiuzhai Huanglong","codigo":"JZH"},{"cidade":"Jixi, China, Xingkaihu","codigo":"JXA"},{"cidade":"Jo\u00e3o Pessoa, Brasil, Castro Pinto","codigo":"JPA"},{"cidade":"Jodhpur, \u00cdndia, Jodhpur","codigo":"JDH"},{"cidade":"Joensuu, Finl\u00e2ndia, Joensuu","codigo":"JOE"},{"cidade":"Johannesburgo, \u00c1frica do Sul, Oliver Tambo International","codigo":"JNB"},{"cidade":"Johnstown, Estados Unidos da Am\u00e9rica, John Murtha Cambria County","codigo":"JST"},{"cidade":"Johor Bahru, Mal\u00e1sia, Senai International","codigo":"JHB"},{"cidade":"Joinvile, Brasil, Lauro Carneiro Loyola","codigo":"JOI"},{"cidade":"Jomsom, Nepal, Jomsom","codigo":"JMO"},{"cidade":"Jonkoping, Su\u00e9cia, Jonkoping","codigo":"JKG"},{"cidade":"Joplin, Estados Unidos da Am\u00e9rica, Joplin","codigo":"JLN"},{"cidade":"Jorhat, \u00cdndia, Rowriah","codigo":"JRH"},{"cidade":"Jos, Nig\u00e9ria, Yakubu Gowon","codigo":"JOS"},{"cidade":"Jouf, Ar\u00e1bia Saudita, Jouf","codigo":"AJF"},{"cidade":"Juazeiro do Norte, Brasil, O. Bezerra de Menezes","codigo":"JDO"},{"cidade":"Juist\u00a0, Alemanha","codigo":"JUI"},{"cidade":"Juiz de Fora, Brasil, Presidente I. Franco","codigo":"IZA"},{"cidade":"Jujuy, Argentina, Gobernador A. Gusman","codigo":"JUJ"},{"cidade":"Juliaca, Peru, Inco Mnco Capac","codigo":"JUL"},{"cidade":"Julia Creek, Austr\u00e1lia","codigo":"JCK"},{"cidade":"Jumla, Nepal, Jumla","codigo":"JUM"},{"cidade":"Juneau, Estados Unidos da Am\u00e9rica, Juneau","codigo":"JNU"},{"cidade":"Jyvaskyla, Finl\u00e2ndia, Jyvaskyla","codigo":"JYV"},{"cidade":"Kabri Dar, Eti\u00f3pia, Kebri Dehar","codigo":"ABK"},{"cidade":"Kabul, Afeganist\u00e3o, International","codigo":"KBL"},{"cidade":"Kadanwari, Paquist\u00e3o, Thar","codigo":"KCF"},{"cidade":"Kaduna, Nig\u00e9ria, Kaduna","codigo":"KAD"},{"cidade":"Kagoshima, Jap\u00e3o, Kagoshima","codigo":"KOJ"},{"cidade":"Kahama, Tanz\u00e2nia, Buzwagi","codigo":"KBH"},{"cidade":"Kahramanmaras, Turquia, Kahramanmaras","codigo":"KCM"},{"cidade":"Kahului, Estados Unidos da Am\u00e9rica, Kahului ","codigo":"OGG"},{"cidade":"Kajaani, Finl\u00e2ndia, Kajaani","codigo":"KAJ"},{"cidade":"Kakamega, Qu\u00eania, Kakamega","codigo":"GGM"},{"cidade":"Kalabo, Z\u00e2mbia, Kalabo","codigo":"KLB"},{"cidade":"Kalaleh, Ir\u00e3, Kalaleh","codigo":"KLM"},{"cidade":"Kalamazoo, Estados Unidos da Am\u00e9rica, Kalamazoo, Battle Creek","codigo":"AZO"},{"cidade":"Kalbarri, Austr\u00e1lia","codigo":"KAX"},{"cidade":"Kalemie, Rep\u00fablica Democr\u00e1tica do Congo, Kalemie","codigo":"FMI"},{"cidade":"Kalemyo, Mianmar, Kalemyo","codigo":"KMV"},{"cidade":"Kalgoorlie, Austr\u00e1lia, Kalgoorlie Boulder","codigo":"KGI"},{"cidade":"Kalibo, Filipinas, Kalibo International","codigo":"KLO"},{"cidade":"Kaliningrado, R\u00fassia, Krasnoyarsk","codigo":"KGD"},{"cidade":"Kalispell, Estados Unidos da Am\u00e9rica, Glacier Park","codigo":"GPI"},{"cidade":"Kalmar, Su\u00e9cia, Kalmar","codigo":"KLR"},{"cidade":"Kaluga, R\u00fassia, Grabatsevo","codigo":"KLF"},{"cidade":"Kamishly, S\u00edria, Kamishly","codigo":"KAC"},{"cidade":"Kamloops, Canad\u00e1, Kamloops","codigo":"YKA"},{"cidade":"Kananga, Rep\u00fablica Democr\u00e1tica do Congo, Kananga","codigo":"KGA"},{"cidade":"Kandahar, Afeganist\u00e3o, International","codigo":"KDH"},{"cidade":"Kandla, \u00cdndia, Kandla","codigo":"IXY"},{"cidade":"Kandy, Sri Lanka, Polgolla Reservoir","codigo":"KDZ"},{"cidade":"Kandy - Victoria Reservoir, Sri Lanka","codigo":"KDW"},{"cidade":"Kangding, China, Kangding","codigo":"KGT"},{"cidade":"Kangiqsujuaq, Canad\u00e1, Wakeham Bay","codigo":"YWB"},{"cidade":"Kangirsuk, Canad\u00e1, Kangirsuk","codigo":"YKG"},{"cidade":"Kannur, \u00cdndia, International","codigo":"CNN"},{"cidade":"Kano, Nig\u00e9ria, Mallam Aminu Kano","codigo":"KAN"},{"cidade":"Kanpur, \u00cdndia, Kanpur","codigo":"KNU"},{"cidade":"Kansas City, Estados Unidos da Am\u00e9rica, Kansas City","codigo":"MCI"},{"cidade":"Kao, Indon\u00e9sia, Kaubang","codigo":"KAZ"},{"cidade":"Karachi, Paquist\u00e3o, Jinnah International","codigo":"KHI"},{"cidade":"Karaganda, Cazaquist\u00e3o, Sary Arka","codigo":"KGF"},{"cidade":"Karamay, China, Karamay","codigo":"KRY"},{"cidade":"Kardla, Est\u00f4nia, Kardla","codigo":"KDL"},{"cidade":"Karlovy Vary, Rep\u00fablica Tcheca, Karlovy Vary","codigo":"KLV"},{"cidade":"Karlsruhe, Alemanha, Baden Airpark","codigo":"FKB"},{"cidade":"Karlstad, Su\u00e9cia, Karlstad","codigo":"KSD"},{"cidade":"Karpathos, Gr\u00e9cia, karpathos","codigo":"AOK"},{"cidade":"Karratha, Austr\u00e1lia, Karratha","codigo":"KTA"},{"cidade":"Karshi, Uzbequist\u00e3o, Khanabad","codigo":"KSQ"},{"cidade":"Kars, Turquia, Kars","codigo":"KSY"},{"cidade":"Karumba, Austr\u00e1lia, Karumba","codigo":"KRB"},{"cidade":"Karup, Dinamarca, Karup","codigo":"KRP"},{"cidade":"Kasama, Z\u00e2mbia, Kasama","codigo":"KAA"},{"cidade":"Kasane, Botsuana, Kasane","codigo":"BBK"},{"cidade":"Kashan, Ir\u00e3, Kashan","codigo":"KKS"},{"cidade":"Kashechewan, Canad\u00e1, Kashechewan","codigo":"ZKE"},{"cidade":"Kashgar, China, Kashi","codigo":"KHG"},{"cidade":"Kasos Island, Gr\u00e9cia, Kasos Island","codigo":"KSJ"},{"cidade":"Kassala, Sud\u00e3o, Kassala","codigo":"KSL"},{"cidade":"Kassel\u00a0, Alemanha, Calden","codigo":"KSF"},{"cidade":"Kastamonu, Turquia, kastamonu","codigo":"KFS"},{"cidade":"Katherine, Austr\u00e1lia, Raaf Tindal","codigo":"KTR"},{"cidade":"Katima Mulilo, Nam\u00edbia, Mpacha","codigo":"MPA"},{"cidade":"Katowice, Polonia, Pyrzowice","codigo":"KTW"},{"cidade":"Kaunakakai, Estados Unidos da Am\u00e9rica, Molokai","codigo":"MKK"},{"cidade":"Kaunas, Litu\u00e2nia, Kaunas International","codigo":"KUN"},{"cidade":"Kavala, Gr\u00e9cia, Megas Alexandros","codigo":"KVA"},{"cidade":"Kavalerovo, R\u00fassia, Kavalerovo","codigo":"KVR"},{"cidade":"Kawthaung, Mianmar, Kawthaung","codigo":"KAW"},{"cidade":"Kayseri, Turquia, Erkilet","codigo":"ASR"},{"cidade":"Kazan, R\u00fassia, Kazan International","codigo":"KZN"},{"cidade":"Kefallinia, Gr\u00e9cia, Kefallinia","codigo":"EFL"},{"cidade":"Kegaska, Canad\u00e1,\u00a0Kegaska","codigo":"ZKG"},{"cidade":"Kelowna, Canad\u00e1, Kelowna","codigo":"YLW"},{"cidade":"Kemerovo, R\u00fassia, Kemerovo","codigo":"KEJ"},{"cidade":"Kemi Tornio, Finl\u00e2ndia, Kemi Tornio","codigo":"KEM"},{"cidade":"Kenai, Estados Unidos da Am\u00e9rica, Municipal de Kenai","codigo":"ENA"},{"cidade":"Kendari, Indon\u00e9sia","codigo":"KDI"},{"cidade":"Kengtung, Mianmar, Kengtung","codigo":"KET"},{"cidade":"Kenora, Canad\u00e1, Kenora","codigo":"YQK"},{"cidade":"Keperveyem, R\u00fassia, Keperveyem","codigo":"KPW"},{"cidade":"Kerinci, Indon\u00e9sia, Depati Parbo","codigo":"KRC"},{"cidade":"Kerkyra, Gr\u00e9cia, Ioannis Kapodistrias","codigo":"CFU"},{"cidade":"Kerman, Ir\u00e3, Kerman","codigo":"KER"},{"cidade":"Kermanshah, Ir\u00e3, Shahid Ashrafiesfahani","codigo":"KSH"},{"cidade":"Kerry County, Irlanda, Kerry County","codigo":"KIR"},{"cidade":"Kerteh, Mal\u00e1sia, kerteh","codigo":"KTE"},{"cidade":"Keshod, \u00cdndia, Keshod","codigo":"IXK"},{"cidade":"Ketapang, Indon\u00e9sia, Rahadi Osman","codigo":"KTG"},{"cidade":"Ketchikan, Estados Unidos da Am\u00e9rica, Ketchikan","codigo":"KTN"},{"cidade":"Key West, Estados Unidos da Am\u00e9rica, Key West","codigo":"EYW"},{"cidade":"Khabarovsk, R\u00fassia, Novy","codigo":"KHV"},{"cidade":"Khamti, Mianmar, Khamti","codigo":"KHM"},{"cidade":"Khandyga, R\u00fassia, Teply Klyuch","codigo":"KDY"},{"cidade":"Khanty Mansiysk, R\u00fassia, Khanty Mansiysk","codigo":"HMA"},{"cidade":"Khark Island, Ir\u00e3, Khark","codigo":"KHK"},{"cidade":"Kharkov, Ucr\u00e2nia, Kharkiv Osnova International","codigo":"HRK"},{"cidade":"Khasab, Om\u00e3, Khashab","codigo":"KHS"},{"cidade":"Khatanga, R\u00fassia, Khatanga","codigo":"HTG"},{"cidade":"Kherson, Ucr\u00e2nia, Kherson","codigo":"KHE"},{"cidade":"Khon Kaen, Tail\u00e2ndia, Khon Kaen","codigo":"KKC"},{"cidade":"Khonu, R\u00fassia, Moma","codigo":"MQJ"},{"cidade":"Khorramabad, Ir\u00e3, Khorramabad","codigo":"KHD"},{"cidade":"Khost, Afeganist\u00e3o, Chapman","codigo":"KHT"},{"cidade":"Khovd, Mong\u00f3lia, Khovd","codigo":"HVD"},{"cidade":"Khoy, Ir\u00e3, Khoy","codigo":"KHY"},{"cidade":"Kiev, Ucr\u00e2nia, Boryspil Intenational","codigo":"KBP"},{"cidade":"Kigali, Ruanda, International","codigo":"KGL"},{"cidade":"Kigoma, Tanz\u00e2nia, Kigoma","codigo":"TKQ"},{"cidade":"Kilimanjaro, Tanz\u00e2nia, Kilimanjaro International","codigo":"JRO"},{"cidade":"Killeen\u00a0Fort Hood, Estados Unidos da Am\u00e9rica, Killeen-Fort Hood\u00a0Regional","codigo":"GRK"},{"cidade":"Kilwa Masoko, Tanz\u00e2nia, Kilwa Masoko","codigo":"KIY"},{"cidade":"Kimberley, \u00c1frica do Sul, Kimberley","codigo":"KIM"},{"cidade":"Kimmirut, Canad\u00e1, Kimmirut","codigo":"YLC"},{"cidade":"Kindu, Rep\u00fablica Democr\u00e1tica do Congo, Kindu","codigo":"KND"},{"cidade":"King Island, Austr\u00e1lia","codigo":"KNS"},{"cidade":"King Salmon, Estados Unidos da Am\u00e9rica, King Salmon","codigo":"AKN"},{"cidade":"Kingscote, Austr\u00e1lia, Kingscote","codigo":"KGC"},{"cidade":"Kingston, Canad\u00e1, Norman Rogers","codigo":"YGK"},{"cidade":"Kingston, Jamaica, Norman Manley.","codigo":"KIN"},{"cidade":"Kingston, Jamaica, Tinson Pen Aerodrome","codigo":"KTP"},{"cidade":"Kinshasa, Rep\u00fablica Democr\u00e1tica do Congo, Ndjili, ","codigo":"FIH"},{"cidade":"Kirensk, R\u00fassia, Kirensk","codigo":"KCK"},{"cidade":"Kirkenes, Noruega, Hoybuktmoen","codigo":"KKN"},{"cidade":"Kirkwall, Reino Unido, Kirkwall","codigo":"KOI"},{"cidade":"Kirov, R\u00fassia, Pobedilovo","codigo":"KVX"},{"cidade":"Kirovsk Apatity, R\u00fassia, Khibiny","codigo":"KVK"},{"cidade":"Kiruna, Su\u00e9cia, Kiruna","codigo":"KRN"},{"cidade":"Kisangani, Rep\u00fablica Democr\u00e1tica do Congo, Bangoka","codigo":"FKI"},{"cidade":"Kishangarh, \u00cdndia, Ajmer","codigo":"KQH"},{"cidade":"Kish Island, Ir\u00e3, Kish","codigo":"KIH"},{"cidade":"Kismayu, Som\u00e1lia, Kismayu","codigo":"KMU"},{"cidade":"Kisumu, Qu\u00eania, Kisumo","codigo":"KIS"},{"cidade":"Kita-Daito, Jap\u00e3o, Kitadaito","codigo":"KTD"},{"cidade":"KitaKyushu, Jap\u00e3o, Kita Kyushu","codigo":"KKJ"},{"cidade":"Kitale, Qu\u00eania, Kitale","codigo":"KTL"},{"cidade":"Kittila, Finl\u00e2ndia, Kittila","codigo":"KTT"},{"cidade":"Klagenfurt, \u00c1ustria, Klagenfurt","codigo":"KLU"},{"cidade":"Klaipeda Palanga, Litu\u00e2nia,Palanga International","codigo":"PLQ"},{"cidade":"Klamath Falls, Estados Unidos da Am\u00e9rica, Klamath Falls Airport","codigo":"LMT"},{"cidade":"Knock, Irlanda, Ireland West","codigo":"NOC"},{"cidade":"Knoxville, Estados Unidos da Am\u00e9rica, McGhee Tyson","codigo":"TYS"},{"cidade":"Kocaeli, Turquia, Cengiz Topel","codigo":"KCO"},{"cidade":"Kochi, \u00cdndia, International","codigo":"COK"},{"cidade":"Kochi, Jap\u00e3o, Kochi","codigo":"KCZ"},{"cidade":"Kodiak, Estados Unidos da Am\u00e9rica, Kodiak","codigo":"ADQ"},{"cidade":"Kogalym, R\u00fassia, Kogalym","codigo":"KGP"},{"cidade":"Koggala, Sri Lanka, Koggala","codigo":"KCT"},{"cidade":"Kokkola Pietarsaa, Finl\u00e2ndia, Kruunupyy","codigo":"KOK"},{"cidade":"Kokshetau, Cazaquist\u00e3o, Kokshetau","codigo":"KOV"},{"cidade":"Kolaka, Indon\u00e9sia, Pomala","codigo":"PUM"},{"cidade":"Kolda, Seneguel, Kolda","codigo":"KDA"},{"cidade":"Kolhapur, \u00cdndia, Kolhapur","codigo":"KLH"},{"cidade":"Kolkata, \u00cdndia, Subhas Chandra Bose","codigo":"CCU"},{"cidade":"Kolwezi, Rep\u00fablica Democr\u00e1tica do Congo, Kolwezi","codigo":"KWZ"},{"cidade":"Komatsu, Jap\u00e3o, Komatsu","codigo":"KMQ"},{"cidade":"Komsomolsk Na Amure, R\u00fassia","codigo":"KXK"},{"cidade":"Kona, Estados Unidos da Am\u00e9rica, Keahole","codigo":"KOA"},{"cidade":"Konya, Turquia, Konya","codigo":"KYA"},{"cidade":"Korhogo, Costa do Marfim, korhogo","codigo":"HGO"},{"cidade":"Korla, China, Korla","codigo":"KRL"},{"cidade":"Ko Samui, Tail\u00e2ndia, Ko Samui","codigo":"USM"},{"cidade":"kos, Gr\u00e9cia, Ippokratis","codigo":"KGS"},{"cidade":"Kosice, Eslov\u00e1quia, Kosice","codigo":"KSC"},{"cidade":"Kostanay, Cazaquist\u00e3o, Kostanay","codigo":"KSN"},{"cidade":"Kotabaru, Indon\u00e9sia","codigo":"KBU"},{"cidade":"Kota Bharu, Mal\u00e1sia, Sultan Ismail Petra","codigo":"KBR"},{"cidade":"Kota Kinabalu, Mal\u00e1sia Redang","codigo":"BKI"},{"cidade":"Kotlas, R\u00fassia, Kotlas","codigo":"KSZ"},{"cidade":"Kotte, Sri Lanka, Diyawanna Oya SPB","codigo":"DWO"},{"cidade":"Kotzebue, Estados Unidos da Am\u00e9rica, Memorial Ralph Wien","codigo":"OTZ"},{"cidade":"Kowanyama, Austr\u00e1lia, Kowanyama","codigo":"KWM"},{"cidade":"Kozani, Gr\u00e9cia, Filippos","codigo":"KZI"},{"cidade":"Kozhikode, \u00cdndia, International","codigo":"CCJ"},{"cidade":"Krabi, Tail\u00e2ndia, Krabi","codigo":"KBV"},{"cidade":"Kraljevo, S\u00e9rvia, Morava","codigo":"KVO"},{"cidade":"Kramfors Solleftea, Su\u00e9cia, Kramfors","codigo":"KRF"},{"cidade":"Krasnodar, R\u00fassia, Pashkovsky","codigo":"KRR"},{"cidade":"Krasnoyarsk Yemelyanovo, R\u00fassia","codigo":"KJA"},{"cidade":"Kristiansand, Noruega, Kjevik","codigo":"KRS"},{"cidade":"Kristianstad, Su\u00e9cia, Kristianstad","codigo":"KID"},{"cidade":"Kristiansund, Noruega, Kvenberget","codigo":"KSU"},{"cidade":"Krui, Indon\u00e9sia","codigo":"TFY"},{"cidade":"Kuala Lumpur, Mal\u00e1sia, Kuala Lumpur International","codigo":"KUL"},{"cidade":"Kuala Lumpur, Mal\u00e1sia, Sultan Abdul Aziz Shah Airport","codigo":"SZB"},{"cidade":"Kuala Terengganu, Mal\u00e1sia, Sultan Mahmud","codigo":"TGG"},{"cidade":"Kuantan, Mal\u00e1sia, Sultan Haji Ahmad Shah","codigo":"KUA"},{"cidade":"Kubin, Austr\u00e1lia","codigo":"KUG"},{"cidade":"Kuching, Mal\u00e1sia, Kuching International","codigo":"KCH"},{"cidade":"Kudat, Mal\u00e1sia, Kudat","codigo":"KUD"},{"cidade":"Kufra, L\u00edbia, Kufra","codigo":"AKF"},{"cidade":"Kuito,\u00a0Angola, Kuito","codigo":"SVP"},{"cidade":"Kullu, \u00cdndia, Bhuntar","codigo":"KUU"},{"cidade":"Kulob, Tajiquist\u00e3o, Kulob","codigo":"TJU"},{"cidade":"Kumamoto, Jap\u00e3o, Kumamoto","codigo":"KMJ"},{"cidade":"Kumasi, Gana, Kumasi","codigo":"KMS"},{"cidade":"Kumejima, Jap\u00e3o, Kumejima","codigo":"UEO"},{"cidade":"Kunduz, Afeganist\u00e3o, Kunduz","codigo":"UND"},{"cidade":"Kunming Wujiaba, China, Kunming Wujiaba International","codigo":"KMG"},{"cidade":"Kununurra, Austr\u00e1lia, Kununurra","codigo":"KNX"},{"cidade":"Kuopio, Finl\u00e2ndia, Kuopio","codigo":"KUO"},{"cidade":"Kupang, Indon\u00e9sia, Eltari","codigo":"KOE"},{"cidade":"Kuqa, China, Qiuci","codigo":"KCA"},{"cidade":"Kuressaare, Est\u00f4nia, Kuressaare","codigo":"URE"},{"cidade":"Kurgan, R\u00fassia, Kurgan","codigo":"KRO"},{"cidade":"Kursk, R\u00fassia, Vostochny","codigo":"URS"},{"cidade":"Kushiro, Jap\u00e3o, Kushiro","codigo":"KUH"},{"cidade":"Kutahya, Turquia, Zafer Airport","codigo":"KZR"},{"cidade":"Kutaisi, Ge\u00f3rgia, Kutaisi International","codigo":"KUT"},{"cidade":"Kuujjuaq, Canad\u00e1, Kuujjuaq","codigo":"YVP"},{"cidade":"Kuujjuarapik, Canad\u00e1, Kuujjuarapik","codigo":"YGW"},{"cidade":"Kuusamo, Finl\u00e2ndia, Kuusamo","codigo":"KAO"},{"cidade":"Kuwait, Kuwait International","codigo":"KWI"},{"cidade":"Kyaukpyu, Mianmar, Kyaukpyu","codigo":"KYP"},{"cidade":"Kythira, Gr\u00e9cia, Alexandro A. Onassis","codigo":"KIT"},{"cidade":"Kyzylorda, Cazaquist\u00e3o, Kyzylorda","codigo":"KZO"},{"cidade":"Kyzyl, R\u00fassia, Kyzyl","codigo":"KYZ"},{"cidade":"Laayoune, Marrocos, Hassan I","codigo":"EUN"},{"cidade":"Labuan Bajo, Indon\u00e9sia, Komodo","codigo":"LBJ"},{"cidade":"Labuan, Mal\u00e1sia, Labuan","codigo":"LBU"},{"cidade":"Labuha, Indon\u00e9sia, Oesman Sadik","codigo":"LAH"},{"cidade":"Lac Brochet, Canad\u00e1, Lac Brochet","codigo":"XLB"},{"cidade":"La Ceiba, Honduras, Goloson International","codigo":"LCE"},{"cidade":"La Crosse, Estados Unidos da Am\u00e9rica, La Crosse Regional","codigo":"LSE"},{"cidade":"Lafayette, Estados Unidos da Am\u00e9rica, Lafayette","codigo":"LFT"},{"cidade":"Lafayette, Estados Unidos da Am\u00e9rica, Purdue University","codigo":"LAF"},{"cidade":"La Fria, Venezuela, La fria","codigo":"LFR"},{"cidade":"Laghouat LMekrareg, Arg\u00e9lia","codigo":"LOO"},{"cidade":"Lago Agrio, Equador, Lago Agrio","codigo":"LGQ, Equador"},{"cidade":"Lagos, Nig\u00e9ria, Murtala Muhamme","codigo":"LOS"},{"cidade":"La Grande Riviere, Canad\u00e1, La Grande Riviere","codigo":"YGL"},{"cidade":"Lahad Datu, Mal\u00e1sia, Lahad Datu","codigo":"LDU"},{"cidade":"Lahore, Paquist\u00e3o, Allama Iqbal International","codigo":"LHE"},{"cidade":"Lake Charles, Estados Unidos da Am\u00e9rica, Lake Charles","codigo":"LCH"},{"cidade":"Lakefield, Austr\u00e1lia","codigo":"LFP"},{"cidade":"Lake Manyara, Tanz\u00e2nia, Lake Manyara","codigo":"LKY"},{"cidade":"Lakselv, Noruega, Banak","codigo":"LKL"},{"cidade":"Lalibela, Eti\u00f3pia, Lalibela","codigo":"LLI"},{"cidade":"Lamerd, Ir\u00e3, Lamerd Airport","codigo":"LFM"},{"cidade":"Lamezia Terme, It\u00e1lia, Lamezia Terme","codigo":"SUF"},{"cidade":"Lampang, Tail\u00e2ndia, Lampang","codigo":"LPT"},{"cidade":"Lampedusa, It\u00e1lia, Lampedusa","codigo":"LMP"},{"cidade":"Lamu, Qu\u00eania, Manda","codigo":"LAU"},{"cidade":"Lanai City, Estados Unidos da Am\u00e9rica, Lanai","codigo":"LNY"},{"cidade":"Lancang, China, Jingmai","codigo":"JMJ"},{"cidade":"Lancaster, Estados Unidos da Am\u00e9rica, Lancaster","codigo":"LNS"},{"cidade":"Langgur, Indon\u00e9sia, Dumatubun","codigo":"LUV"},{"cidade":"Langkawi, Mal\u00e1sia, Langkawi International","codigo":"LGK"},{"cidade":"Lankaran, Azerbaij\u00e3o, Lankaran","codigo":"LLK"},{"cidade":"Lansdowne House, Canad\u00e1,\u00a0Lansdowne House","codigo":"YLH"},{"cidade":"Lanseria, \u00c1frica do Sul, International","codigo":"HLA"},{"cidade":"Lansing, Estados Unidos da Am\u00e9rica, Capital Region","codigo":"LAN"},{"cidade":"Lanzarote, Espanha, Lanzarote","codigo":"ACE"},{"cidade":"Lanzhou, China, Zhongchuan","codigo":"LHW"},{"cidade":"La Paz, Bol\u00edvia, El Alto","codigo":"LPB"},{"cidade":"La Paz, M\u00e9xico, Manuel M\u00e1rquez de Leon","codigo":"LAP"},{"cidade":"Lappeenranta, Finl\u00e2ndia, Lappeenranta","codigo":"LPP"},{"cidade":"Larantuka, Indon\u00e9sia, Gewayantana","codigo":"LKA"},{"cidade":"Laredo, Estados Unidos da Am\u00e9rica, Laredo International","codigo":"LRD"},{"cidade":"La Rioja, Argentina, Capitan V.A Almonacid","codigo":"IRJ"},{"cidade":"Lar, Ir\u00e3, Lar","codigo":"LRR"},{"cidade":"La Rochelle, Fran\u00e7a, Ile de Re","codigo":"LRH"},{"cidade":"La Romaine, Canad\u00e1, La Romaine","codigo":"ZGS"},{"cidade":"La Romana, Rep\u00fablica Dominicana, Casa de Campo","codigo":"LRM"},{"cidade":"La Ronge, Canad\u00e1, Barber Field","codigo":"YVC"},{"cidade":"La Serena, Chile, La Florida","codigo":"LSC"},{"cidade":"Lashio, Mianmar, Lashio","codigo":"LSH"},{"cidade":"Laskhar Gah, Afeganist\u00e3o, Bost","codigo":"BST"},{"cidade":"Las Piedras, Venezuela, Josefa Camejo","codigo":"LSP"},{"cidade":"Las Vegas, Estados Unidos da Am\u00e9rica, McCarran","codigo":"LAS"},{"cidade":"Las Vegas, Estados Unidos da Am\u00e9rica, North Las Vegas","codigo":"VGT"},{"cidade":"La Tabatiere, Canad\u00e1, La Tabatiere","codigo":"ZLT"},{"cidade":"Latrobe, Estados Unidos da Am\u00e9rica, Arnold Palmer Regional","codigo":"LBE"},{"cidade":"Launceston, Austr\u00e1lia, Launceston","codigo":"LST"},{"cidade":"Laura, Austr\u00e1lia","codigo":"LUU"},{"cidade":"Lavan Island, Ir\u00e3, Lavan","codigo":"LVP"},{"cidade":"Laverton, Austr\u00e1lia, Laverton","codigo":"LVO"},{"cidade":"Lawas, Mal\u00e1sia, Lawas","codigo":"LWY"},{"cidade":"Lawton, Estados Unidos da Am\u00e9rica, Lawton-Fort Sill Regional","codigo":"LAW"},{"cidade":"L\u00e1zaro C\u00e1rdenas, M\u00e9xico, L\u00e1zaro C\u00e1rdenas","codigo":"LZC"},{"cidade":"Learmonth, Austr\u00e1lia, Learmonth","codigo":"LEA"},{"cidade":"Leeds Bradford, Reino Unido, Leeds Bradford","codigo":"LBA"},{"cidade":"Legazpi, Filipinas, Legazpi","codigo":"LGP"},{"cidade":"Leh, \u00cdndia, Kushok Bakula Rimpoche","codigo":"IXL"},{"cidade":"Leinster, Austr\u00e1lia, Leinster","codigo":"LER"},{"cidade":"Leipzig, Halle, Alemanha, Leipzig, Halle","codigo":"LEJ"},{"cidade":"Leknes, Noruega, leknes","codigo":"LKN"},{"cidade":"Lemnos, Gr\u00e9cia, Limnos","codigo":"LXS"},{"cidade":"Len\u00e7\u00f3is, Brasil, Horacio de Matos","codigo":"LEC"},{"cidade":"Lensk, R\u00fassia, Lensk","codigo":"ULK"},{"cidade":"Leon, Espanha, Leon","codigo":"LEN"},{"cidade":"Leon Guanajuato, M\u00e9xico, Del Bajio International","codigo":"BJX"},{"cidade":"Leonora, Austr\u00e1lia, Leonora","codigo":"LNO"},{"cidade":"Le Puy, \u00a0Fran\u00e7a, Loudes","codigo":"LPY"},{"cidade":"Leros, Gr\u00e9cia, leros","codigo":"LRS"},{"cidade":"Lethbridge, Canad\u00e1,Lethbridge County","codigo":"YQL"},{"cidade":"Leticia, Col\u00f4mbia, Alfredo Vasquez Cobo","codigo":"LET"},{"cidade":"Le Touquet\u00a0 Paris Plage, Fran\u00e7a","codigo":"LTQ"},{"cidade":"Lewiston, Estados Unidos da Am\u00e9rica, Nez Perce County","codigo":"LWS"},{"cidade":"Lewoleba, Indon\u00e9sia, Wunopito","codigo":"LWE"},{"cidade":"Lexington, Estados Unidos da Am\u00e9rica, Blue Grass","codigo":"LEX"},{"cidade":"Lhasa, China, Gonggar","codigo":"LXA"},{"cidade":"Lhok seumawe, Indon\u00e9sia, Malikussaleh","codigo":"LSW"},{"cidade":"Liangping, China, Liangping","codigo":"LIA"},{"cidade":"Lianyungang, China, Baitabu","codigo":"LYG"},{"cidade":"Liberia, Costa Rica, Daniel Oduber Quiros","codigo":"LIR"},{"cidade":"Libo, China, Libo","codigo":"LLB"},{"cidade":"Libreville, Gab\u00e3o, Leon M Ba","codigo":"LBV"},{"cidade":"Lichinga, Mo\u00e7ambique, Lichinga","codigo":"VXC"},{"cidade":"Liege, B\u00e9lgica, Liege","codigo":"LGG"},{"cidade":"Liepaja, Let\u00f4nia, Liepaja International","codigo":"LPX"},{"cidade":"Lihue, Estados Unidos da Am\u00e9rica, Lihue","codigo":"LIH"},{"cidade":"Lijiang, China, Sanyi","codigo":"LJG"},{"cidade":"Likoma Island, Mal\u00e1ui, Likoma Island","codigo":"LIX"},{"cidade":"Lilabari, \u00cdndia, Lilabari","codigo":"IXI"},{"cidade":"Lille, Fran\u00e7a, Lesquin","codigo":"LIL"},{"cidade":"Lilongwe, Mal\u00e1ui, Kmuzu International","codigo":"LLWi"},{"cidade":"Lima, Peru, Jorge Chavez","codigo":"LIM"},{"cidade":"Limbang, Mal\u00e1sia, Limbang","codigo":"LMN"},{"cidade":"Limoges, Fran\u00e7a, Bellegarde","codigo":"LIG"},{"cidade":"Lincang, China, Lincang Airport","codigo":"LNJ"},{"cidade":"Lincoln, Estados Unidos da Am\u00e9rica, Lincoln","codigo":"LNK"},{"cidade":"Linfen, China, Qiaoli","codigo":"LFQ"},{"cidade":"Linkoping, Su\u00e9cia, City Airport","codigo":"LPI"},{"cidade":"Linyi, China, Shubuling","codigo":"LYI"},{"cidade":"Linz, \u00c1ustria, Blue Danube","codigo":"LNZ"},{"cidade":"Lipetsk, R\u00fassia, Lipetsk","codigo":"LPK"},{"cidade":"Liping, China, Liping","codigo":"HZH"},{"cidade":"Lisala, Rep\u00fablica Democr\u00e1tica do Congo, Lisala","codigo":"LIQ"},{"cidade":"Lisboa, Portugal, Lisboa","codigo":"LIS"},{"cidade":"Lismore, Austr\u00e1lia, Lismore","codigo":"LSY"},{"cidade":"Little Rock, Estados Unidos da Am\u00e9rica, Little Rock, Adams Field","codigo":"LIT"},{"cidade":"Liupanshui, China, Yue Zhao","codigo":"LPF"},{"cidade":"Liuzhou, China, Bailian","codigo":"LZH"},{"cidade":"Liverpool, Reino Unido, John Lennon","codigo":"LPL"},{"cidade":"Livingstone, Z\u00e2mbia, Livingstone","codigo":"LVI"},{"cidade":"Lizard Island, Austr\u00e1lia","codigo":"LZR"},{"cidade":"Ljubljana, Eslov\u00eania, Joze Pucnik","codigo":"LJU"},{"cidade":"Lleida, Espanha, Alguaire","codigo":"ILD"},{"cidade":"Lloydminster, Canad\u00e1, Lloydminster","codigo":"YLL"},{"cidade":"Lockhart River, Austr\u00e1lia","codigo":"IRG"},{"cidade":"Lodja, Rep\u00fablica Democr\u00e1tica do Congo, Lodja","codigo":"LJA"},{"cidade":"Lodwar, Qu\u00eania, Lodwar","codigo":"LOK"},{"cidade":"Lodz, Polonia, Wladyslaw Reymont","codigo":"LCJ"},{"cidade":"Loei, Tail\u00e2ndia, Loei","codigo":"LOE"},{"cidade":"Logrono, Espanha, Agoncillo","codigo":"RJL"},{"cidade":"Loikaw, Mianmar, Loikaw","codigo":"LIW"},{"cidade":"Loja, Equador, Catamayo","codigo":"LOH, Equador"},{"cidade":"Lom\u00e9, Togo, G. Eyadema International","codigo":"LFW"},{"cidade":"Londolozi, \u00c1frica do Sul, Londolozi","codigo":"LDZ"},{"cidade":"London, Canad\u00e1, International","codigo":"YXU"},{"cidade":"Londres, Reino Unido, City Airport","codigo":"LCY"},{"cidade":"Londres, Reino Unido, Gatwick","codigo":"LGW"},{"cidade":"Londres, Reino Unido, Heathrow","codigo":"LHR"},{"cidade":"Londres, Reino Unido, Luton","codigo":"LTN"},{"cidade":"Londres, Reino Unido, Stansted","codigo":"STN"},{"cidade":"Londres, Reino Unido , Todos Aeroportos","codigo":"LON"},{"cidade":"Londrina, Brasil, Jose Richa","codigo":"LDB"},{"cidade":"Long Akah, Mal\u00e1sia, Long Akah","codigo":"LKH"},{"cidade":"Long Banga, Mal\u00e1sia, Long Banga","codigo":"LBP"},{"cidade":"Long Beach, Estados Unidos da Am\u00e9rica, Daugherty Field","codigo":"LGB"},{"cidade":"Long Lellang, Mal\u00e1sia, Long Lellang","codigo":"LGL"},{"cidade":"Longnan, China, Cheng Xian","codigo":"LNL"},{"cidade":"Longreach, Austr\u00e1lia","codigo":"LRE"},{"cidade":"Long Seridan, Mal\u00e1sia, Long Seridan","codigo":"ODN"},{"cidade":"Longview, Estados Unidos da Am\u00e9rica, East Texas Regional","codigo":"GGG"},{"cidade":"Longyan, China, Guanzhishan","codigo":"LCX"},{"cidade":"Longyearbyen, Noruega, Svalbard","codigo":"LYR"},{"cidade":"Lord Howe Island, Austr\u00e1lia","codigo":"LDH"},{"cidade":"Loreto, M\u00e9xico, Loreto International","codigo":"LTO"},{"cidade":"Lorient, Fran\u00e7a, Lann Bihoue","codigo":"LRT"},{"cidade":"Los Angeles, Estados Unidos da Am\u00e9rica, Los Angeles","codigo":"LAX"},{"cidade":"Los Cabos, M\u00e9xico, Los Cabos International","codigo":"SJD"},{"cidade":"Los Mochis, M\u00e9xico, Federal del Valle del Fuerte","codigo":"LMM"},{"cidade":"Los Roques, Venezuela, Los Roques","codigo":"LRV"},{"cidade":"Louisville, Estados Unidos da Am\u00e9rica, \u00a0Standiford Field","codigo":"SDF"},{"cidade":"Lourdes Tarbes, Fran\u00e7a, Pyrenees","codigo":"LDE"},{"cidade":"Lower Zambezi National Park, Z\u00e2mbia, Jeki Airport","codigo":"JEK"},{"cidade":"Lower Zambezi National Park, Z\u00e2mbia, Royal Airport","codigo":"RYL"},{"cidade":"Luanda, Angola, 4 de Fevereiro","codigo":"LAD"},{"cidade":"Luang Namtha, Laos, Luang Namtha","codigo":"LXG"},{"cidade":"Luang Prabang, Laos, Luang Prabang","codigo":"LPQ"},{"cidade":"Lubango, Angola, Mukanka","codigo":"SDD"},{"cidade":"Lubbock, Estados Unidos da Am\u00e9rica, Preston Smith International","codigo":"LBB"},{"cidade":"Lublin, Polonia, Lublin","codigo":"LUZ"},{"cidade":"Lubuk Linggau, Indon\u00e9sia, Silampari","codigo":"LLJ"},{"cidade":"Lubumbashi, Rep\u00fablica Democr\u00e1tica do Congo, Luano","codigo":"FBM"},{"cidade":"Lucca, It\u00e1lia, Tassignano","codigo":"LCV"},{"cidade":"Lucknow, \u00cdndia, Chaudhary Charan Singh","codigo":"LKO"},{"cidade":"Luderitz, Nam\u00edbia, Luderitz","codigo":"LUD"},{"cidade":"Ludhiana, \u00cdndia, Ludhiana","codigo":"LUH"},{"cidade":"Luena,\u00a0Angola, Luena","codigo":"LUO"},{"cidade":"Lugano, Su\u00ed\u00e7a, Agno","codigo":"LUG"},{"cidade":"Lukla, Nepal, Tenzing Hillary","codigo":"LUA"},{"cidade":"Lulea, Su\u00e9cia, Kallax","codigo":"LLA"},{"cidade":"L\u00fcliang, China, L\u00fcliang","codigo":"LLV"},{"cidade":"Luoyang, China, Beijiao","codigo":"LYA"},{"cidade":"Lusaka, Z\u00e2mbia, Lusaka International","codigo":"LUN"},{"cidade":"Luwuk, Indon\u00e9sia, S. Aminuddin Amir","codigo":"LUW"},{"cidade":"Luxemburgo, Luxembourg","codigo":"LUX"},{"cidade":"Luxor, Egito, International","codigo":"LXR"},{"cidade":"Luzhou, China, Yunlong","codigo":"LZO"},{"cidade":"Luzon, Angeles Mabalact, Filipinas, Clark International","codigo":"CRK"},{"cidade":"Lviv, Ucr\u00e2nia, Lviv International","codigo":"LWO"},{"cidade":"Lycksele, Su\u00e9cia, Lycksele","codigo":"LYC"},{"cidade":"Lydd, Reino Unido, London Ashford","codigo":"LYX"},{"cidade":"Lynchburg, Estados Unidos da Am\u00e9rica, Preston Glenn Field\u00a0","codigo":"LYH"},{"cidade":"Lyon, Fran\u00e7a, Saint Exupery","codigo":"LYS"},{"cidade":"Maastricht, Aachen, Holanda, Maastricht, Aachen, ","codigo":"MST"},{"cidade":"Mabuiag Island, Austr\u00e1lia","codigo":"UBB"},{"cidade":"Macap\u00e1, Brasil, Alberto Al Columbre","codigo":"MCP"},{"cidade":"Mac Arthur River Mine, Austr\u00e1lia","codigo":"MCV"},{"cidade":"Macei\u00f3, Brasil, Zumbi dos Palmares","codigo":"MCZ"},{"cidade":"Mackay, Austr\u00e1lia, Mackay","codigo":"MKY"},{"cidade":"Macon, Estados Unidos da Am\u00e9rica, Middle Georgia","codigo":"MCN"},{"cidade":"Madison, Estados Unidos da Am\u00e9rica, Dane County Regional","codigo":"MSN"},{"cidade":"Madrid, Espanha, Adolfo Suarez Barajas","codigo":"MAD"},{"cidade":"Madurai, \u00cdndia, Madurai","codigo":"IXM"},{"cidade":"Mae Hong Son, Tail\u00e2ndia","codigo":"HGN"},{"cidade":"Mae Sot, Tail\u00e2ndia, Mae Sot","codigo":"MAQ"},{"cidade":"Mafia Island, Tanz\u00e2nia, Mafia Island","codigo":"MFA"},{"cidade":"Magadan, R\u00fassia, Sokol","codigo":"GDX"},{"cidade":"Magan, R\u00fassia, Magan","codigo":"GYG"},{"cidade":"Magnitogorsk, R\u00fassia, Magnitogorsk","codigo":"MQF"},{"cidade":"Magwey, Mianmar, Magwey","codigo":"MWQ"},{"cidade":"Mahajanga, Majunga, Madag\u00e1scar, Philibert Tsiranana","codigo":"MJN"},{"cidade":"Mahe Island, Seychelles, Seychelles Internationa","codigo":"SEZ"},{"cidade":"Maiduguri, Nig\u00e9ria, Maiduguri","codigo":"MIU"},{"cidade":"Maimanah, Afeganist\u00e3o, Maimanah","codigo":"MMZ"},{"cidade":"Makale, Eti\u00f3pia, Alula Aba Nega","codigo":"MQX"},{"cidade":"Makassar, Indon\u00e9sia, Sultan Hasanuddin","codigo":"UPG"},{"cidade":"Makhachkala, R\u00fassia, Uytash","codigo":"MCX"},{"cidade":"Makkovik, Canad\u00e1, Makkovik","codigo":"YMN"},{"cidade":"Malabo, Guin\u00e9 Equatorial, International","codigo":"SSG"},{"cidade":"Malacca, Mal\u00e1sia, Malacca","codigo":"MKZ"},{"cidade":"M\u00e1laga, Espanha, Malaga Airport","codigo":"AGP"},{"cidade":"Malang, Indon\u00e9sia","codigo":"MLG"},{"cidade":"Malanje,\u00a0Angola, Malanje","codigo":"MEG"},{"cidade":"Malargue, Argentina, Comodoro D.R. Salomon","codigo":"LGS"},{"cidade":"Malatya, Turquia, Erhac","codigo":"MLX"},{"cidade":"Mali Losinj, Cro\u00e1cia, Mali Losinj","codigo":"LSZ"},{"cidade":"Malindi, Qu\u00eania, Malindi","codigo":"MYD"},{"cidade":"Malmo Sturup, Su\u00e9cia, Malmo","codigo":"MMX"},{"cidade":"Mamuju, Indon\u00e9sia, Tampa Padang","codigo":"MJU"},{"cidade":"Manado, Indon\u00e9sia, San Ratulangi","codigo":"MDC"},{"cidade":"Managua, Nicar\u00e1gua, Augusto Cesar Sandino","codigo":"MGA"},{"cidade":"Manaung, Mianmar, Manaung","codigo":"MGU"},{"cidade":"Manaus, Brasil, Eduardo Gomes","codigo":"MAO"},{"cidade":"Manchester, Estados Unidos da Am\u00e9rica, Manchester Boston","codigo":"MHT"},{"cidade":"Manchester, Reino Unido, Manchester Airport","codigo":"MAN"},{"cidade":"Man, Costa do Marfim, Man","codigo":"MJC"},{"cidade":"Mandalay, Mianmar, Mandalay International","codigo":"MDL"},{"cidade":"Mandera, Qu\u00eania, Mandera","codigo":"NDE"},{"cidade":"Mangalore, \u00cdndia, Mangalore","codigo":"IXE"},{"cidade":"Mangshi, China, Dehong Mangshi","codigo":"LUM"},{"cidade":"Manhattan, Estados Unidos da Am\u00e9rica, Manhattan","codigo":"MHK"},{"cidade":"Manila, Filipinas, Ninoy Aquino International","codigo":"MNL"},{"cidade":"Maningrida, Austr\u00e1lia, Maningrida","codigo":"MNG"},{"cidade":"Manizales, Col\u00f4mbia, La Nubia","codigo":"MZL"},{"cidade":"Mannheim, Alemanha, City Airport","codigo":"MHG"},{"cidade":"Manokwari, Indon\u00e9sia, Rendani","codigo":"MKW"},{"cidade":"Mansa, Z\u00e2mbia, Mansa","codigo":"MNS"},{"cidade":"Manta, Equador, Eloy Alfaro","codigo":"MEC, Equador"},{"cidade":"Manzanillo, Cuba, Sierra Maestra","codigo":"MZO"},{"cidade":"Manzanillo, M\u00e9xico, Playa de Oro International","codigo":"ZLO"},{"cidade":"Manzhouli China, Xijiao","codigo":"NZH"},{"cidade":"Manzini, Suazil\u00e2ndia, King Mswati III International","codigo":"SHO"},{"cidade":"Maputo, Mo\u00e7ambique, Maputo International","codigo":"MPM"},{"cidade":"Marab\u00e1, Brasil, Joao Correa da Rocha","codigo":"MAB"},{"cidade":"Maracaibo, Venezuela, La Chinita","codigo":"MAR"},{"cidade":"Maracay, Venezuela, Mariscal Sucre","codigo":"MYC"},{"cidade":"Maradi, N\u00edger, Maradi","codigo":"MFQ"},{"cidade":"Mar del Plata, Argentina, Astor Piazzola","codigo":"MDQ"},{"cidade":"Mardin, Turquia, Mardin","codigo":"MQM"},{"cidade":"Margate, \u00c1frica do Sul, Margate","codigo":"MGH"},{"cidade":"Maribor, Eslov\u00eania, Edvard Rusjan","codigo":"MBX"},{"cidade":"Mariehamn, Finl\u00e2ndia, Mariehamn","codigo":"MHQ"},{"cidade":"Marinduque Island, Filipinas","codigo":"MRQ"},{"cidade":"Marion, Estados Unidos da Am\u00e9rica, Williamson County","codigo":"MWA"},{"cidade":"Maripasoula, Guiana Francesa,Maripasoula","codigo":"MPY"},{"cidade":"Maroantsetra, Madag\u00e1scar, Maroantsetra","codigo":"WMN"},{"cidade":"Maroua, Camar\u00f5es, Salak","codigo":"MVR"},{"cidade":"Marquette, Estados Unidos da Am\u00e9rica, Sawyer","codigo":"MQT"},{"cidade":"Marraqueche, Marrocos, Menara","codigo":"RAK"},{"cidade":"Marsa Alam, Egito, International","codigo":"RMF"},{"cidade":"Marsa Matruh, Egito, Mersa Matruh","codigo":"MUH"},{"cidade":"Marseille, Fran\u00e7a, Provence","codigo":"MRS"},{"cidade":"Marsh Harbour, Bahamas, Marsh Harbour","codigo":"MHH, Bahamas"},{"cidade":"Marudi, Mal\u00e1sia, Marudi","codigo":"MUR"},{"cidade":"Marys Harbour, Canad\u00e1, Marys Harbour","codigo":"YMH"},{"cidade":"Mary, Turcomenist\u00e3o, Mary","codigo":"MYP"},{"cidade":"Masbate, Filipinas","codigo":"MBT"},{"cidade":"Maseru, Lesoto, Moshoeshoe","codigo":"MSU"},{"cidade":"Mason City, Estados Unidos da Am\u00e9rica, Mason City","codigo":"MCW"},{"cidade":"Masset, Canad\u00e1, Masset","codigo":"ZMT"},{"cidade":"Masuda, Jap\u00e3o, Iwami","codigo":"IWJ"},{"cidade":"Matak, Indon\u00e9sia, Tarempa","codigo":"MWK"},{"cidade":"Matamoros, M\u00e9xico, Servando Canales International","codigo":"MAM"},{"cidade":"Matsumoto, Jap\u00e3o, Matsumoto","codigo":"MMJ"},{"cidade":"Matsuyama, Jap\u00e3o, Matsuyama","codigo":"MYJ"},{"cidade":"Maturin, Venezuela, Jose T Monagas","codigo":"MUN"},{"cidade":"Mau\u00e9s, Brasil, Mau\u00e9s","codigo":"MBZ"},{"cidade":"Maulamyine, Mianmar, Maulamyine","codigo":"MNU"},{"cidade":"Maumere, Indon\u00e9sia, Fransiskus x Seda","codigo":"MOF"},{"cidade":"Maun, Botsuana, Maun","codigo":"MUB"},{"cidade":"Maur\u00edcio, Ilhas Maur\u00edcio, Sir. S.Ramgoolam International","codigo":"MRU"},{"cidade":"Mayaguana, Bahamas, Mayaguana","codigo":"MYG"},{"cidade":"Mayag\u00fcez, Porto Rico, Eugenio Mar\u00eda de Hostos","codigo":"MAS"},{"cidade":"Mayo, Canad\u00e1, Mayo","codigo":"YMA"},{"cidade":"Mazar-E Sharif, Afeganist\u00e3o, Mazar-E Sharif","codigo":"MZR"},{"cidade":"Mazatlan, M\u00e9xico, Rafael Buelna International","codigo":"MZT"},{"cidade":"Mbandaka, Rep\u00fablica Democr\u00e1tica do Congo, Mbandaka","codigo":"MDK"},{"cidade":"Mbeya, Tanz\u00e2nia, Mbeya","codigo":"MBI"},{"cidade":"Mbuji Mayi, Rep\u00fablica Democr\u00e1tica do Congo, Mbuji Mayi","codigo":"MJM"},{"cidade":"McAllen, Estados Unidos da Am\u00e9rica, Miller International","codigo":"MFE"},{"cidade":"Mechria, Arg\u00e9lia","codigo":"MZW"},{"cidade":"Medan, Indon\u00e9sia, Kuala Namu","codigo":"KNO"},{"cidade":"Medell\u00edn, Col\u00f4mbia,Jose Maria Cordova","codigo":"MDE"},{"cidade":"Medellin, Col\u00f4mbia,Olaya Herrera","codigo":"EOH"},{"cidade":"Medford, Estados Unidos da Am\u00e9rica, Rogue Valley International","codigo":"MFR"},{"cidade":"Medicine Hat, Canad\u00e1, Medicine Hat","codigo":"YXH"},{"cidade":"Medina, Madinah, Ar\u00e1bia Saudita, Mohammad Bin Abdulaziz","codigo":"MED"},{"cidade":"Meekatharra, Austr\u00e1lia","codigo":"MKR"},{"cidade":"Megisti, Gr\u00e9cia, Megisti","codigo":"KZS"},{"cidade":"Mehamn, Noruega, Mehamn","codigo":"MEH"},{"cidade":"Meixian, China, Meixian","codigo":"MXZ"},{"cidade":"Melanguane, Indon\u00e9sia, Melanguane","codigo":"MNA"},{"cidade":"Melbourne, Austr\u00e1lia, Avalon Airport","codigo":"AVV"},{"cidade":"Melbourne, Austr\u00e1lia, Melbourne Airport","codigo":"MEL"},{"cidade":"Melbourne Essendon, Austr\u00e1lia","codigo":"MEB"},{"cidade":"Melbourne, Estados Unidos da Am\u00e9rica, Melbourne","codigo":"MLB"},{"cidade":"Melilha, Espanha, Melilla","codigo":"MLN"},{"cidade":"Memanbetsu, Jap\u00e3o, Memanbetsu","codigo":"MMB"},{"cidade":"Memmingen, Alemanha, Allgaeu","codigo":"FMM"},{"cidade":"Memphis, Estados Unidos da Am\u00e9rica, Memphis Intenational","codigo":"MEM"},{"cidade":"Mendoza, Argentina,\u00a0El Plumerillo","codigo":"MDZ"},{"cidade":"Menongue,\u00a0Angola, Menongue","codigo":"SPP"},{"cidade":"Menorca, Espanha, Menorca","codigo":"MAH"},{"cidade":"Merauke, Indon\u00e9sia, Mopah","codigo":"MKQ"},{"cidade":"Merida, M\u00e9xico, Manuel Crescencio Rej\u00f3n","codigo":"MID"},{"cidade":"Meridian, Estados Unidos da Am\u00e9rica, Key Field","codigo":"MEI"},{"cidade":"Merimbula, Austr\u00e1lia","codigo":"MIM"},{"cidade":"Meshed, Ir\u00e3, Shahid, Hashemi Nejad","codigo":"MHD"},{"cidade":"Metz Nancy, Fran\u00e7a, Lorraine","codigo":"ETZ"},{"cidade":"Mexicali, M\u00e9xico, Rodolfo S\u00e1nchez Taboada","codigo":"MXL"},{"cidade":"Mfuwe, Z\u00e2mbia, Mfuwe","codigo":"MFU"},{"cidade":"Miami, Estados Unidos da Am\u00e9rica, Miami","codigo":"MIA"},{"cidade":"Mianyang, China, Nanjiao","codigo":"MIG"},{"cidade":"Miconos, Gr\u00e9cia, Mykonos","codigo":"JMK"},{"cidade":"Middlemount, Austr\u00e1lia","codigo":"MMM"},{"cidade":"Midland, Estados Unidos da Am\u00e9rica, Midland International","codigo":"MAF"},{"cidade":"Mil\u00e3o, It\u00e1lia, Bergamo Orio Al Serio","codigo":"BGY"},{"cidade":"Mil\u00e3o, It\u00e1lia, Linate","codigo":"LIN"},{"cidade":"Mil\u00e3o, It\u00e1lia, Malpensa","codigo":"MXP"},{"cidade":"Mil\u00e3o, It\u00e1lia , Todos aeroportos","codigo":"MIL"},{"cidade":"Mildura, Austr\u00e1lia","codigo":"MQL"},{"cidade":"Millingimbi Island, Austr\u00e1lia","codigo":"MGT"},{"cidade":"Milos, Gr\u00e9cia, Milos","codigo":"MLO"},{"cidade":"Milwaukee, Estados Unidos da Am\u00e9rica, General Mitchell International","codigo":"MKE"},{"cidade":"Minamidaito Jima, Jap\u00e3o, Minamidaito","codigo":"MMD"},{"cidade":"Minatitlan, M\u00e9xico, Coatzacoalcos","codigo":"MTT"},{"cidade":"Mineralnye Vody, R\u00fassia, Mineralnye Vody","codigo":"MRV"},{"cidade":"Minneapolis, Estados Unidos da Am\u00e9rica, St. Paul","codigo":"MSP"},{"cidade":"Minot, Estados Unidos da Am\u00e9rica, Minot","codigo":"MOT"},{"cidade":"Minsk, Bielor\u00fassia, Minsk 2 International","codigo":"MSQ"},{"cidade":"Miri, Mal\u00e1sia, Miri","codigo":"MYY"},{"cidade":"Mirny, R\u00fassia, Mirny","codigo":"MJZ"},{"cidade":"Misawa, Jap\u00e3o, Misawa","codigo":"MSJ"},{"cidade":"Missoula, Estados Unidos da Am\u00e9rica, Missoula","codigo":"MSO"},{"cidade":"Misurata, L\u00edbia, Misurata","codigo":"MRA"},{"cidade":"Miyakejima, Jap\u00e3o, Miyakejima","codigo":"MYE"},{"cidade":"Miyako Jima Hirara, Jap\u00e3o, Miyako","codigo":"MMY"},{"cidade":"Miyako - Shimojishima, Jap\u00e3o, Shimojishima","codigo":"SHI"},{"cidade":"Miyazaki, Jap\u00e3o, Miyazaki","codigo":"KMI"},{"cidade":"Mmabatho Mafikeng, \u00c1frica do Sul, Mmabatho International","codigo":"MBD"},{"cidade":"Moa, Cuba, Orestes Acosta","codigo":"MOA"},{"cidade":"Moanda, Rep\u00fablica Democr\u00e1tica do Congo, Muanda","codigo":"MNB"},{"cidade":"Mobile, Estados Unidos da Am\u00e9rica, Mobile","codigo":"MOB"},{"cidade":"Modesto, Estados Unidos da Am\u00e9rica, Harry Sham Field","codigo":"MOD"},{"cidade":"Moenjodaro, Paquist\u00e3o, Moenjodaro","codigo":"MJD"},{"cidade":"Mogadishu, Som\u00e1lia, Aden Adde International","codigo":"MGQ"},{"cidade":"Mohe, China, Gulian","codigo":"OHE"},{"cidade":"Mo I Rana, Noruega, Rossvoll","codigo":"MQN"},{"cidade":"Molde, Noruega, Aro","codigo":"MOL"},{"cidade":"Moline, Estados Unidos da Am\u00e9rica, Quad City ","codigo":"MLI"},{"cidade":"Mombasa, Qu\u00eania, Moi International","codigo":"MBA"},{"cidade":"Monastir, Tun\u00edsia, Habib Bourguiba","codigo":"MIR"},{"cidade":"Monbetsu, Jap\u00e3o, Monbetsu","codigo":"MBE"},{"cidade":"Monclova, M\u00e9xico, Venustiano Carranza","codigo":"LOV"},{"cidade":"Moncton, Canad\u00e1, Greater Moncton","codigo":"YQM"},{"cidade":"Mong Hsat, Mianmar, Mong Hsat","codigo":"MOG"},{"cidade":"Mongomo, Guin\u00e9 Equatorial, Mongomo","codigo":"GEM"},{"cidade":"Monroe, Estados Unidos da Am\u00e9rica, Monroe","codigo":"MLU"},{"cidade":"Monrovia, Lib\u00e9ria, Roberts International","codigo":"ROB"},{"cidade":"Monteagudo, Bol\u00edvia, Monteagudo","codigo":"MHW"},{"cidade":"Montego Bay, Jamaica, Sangster","codigo":"MBJ"},{"cidade":"Monterey, Estados Unidos da Am\u00e9rica, Monterey ","codigo":"MRY"},{"cidade":"Monteria, Col\u00f4mbia,Los Garzones","codigo":"MTR"},{"cidade":"Monterrei, M\u00e9xico, Mariano Escobedo","codigo":"MTY"},{"cidade":"Montes Claros, Brasil, Mario Ribeiro","codigo":"MOC"},{"cidade":"Montevid\u00e9u, Uruguai, Carrasco","codigo":"MVD"},{"cidade":"Montgomery, Estados Unidos da Am\u00e9rica, Dannelly Field","codigo":"MGM"},{"cidade":"Mont Joli, Canad\u00e1,\u00a0Mont Joli","codigo":"YYY"},{"cidade":"Montpellier, Fran\u00e7a, Mediterranee","codigo":"MPL"},{"cidade":"Montreal, Canad\u00e1, Mirabel","codigo":"YMX"},{"cidade":"Montreal, Canad\u00e1, Pierre Elliott Trudeau","codigo":"YUL"},{"cidade":"Montreal, Canad\u00e1, St Hubert","codigo":"YHU"},{"cidade":"Montreal, Canad\u00e1 , Todos aeroportos","codigo":"YMQ"},{"cidade":"Montrose, Estados Unidos da Am\u00e9rica, Montrose","codigo":"MTJ"},{"cidade":"Mont Tremblant, Canad\u00e1, International","codigo":"YTM"},{"cidade":"Monywa, Mianmar, Monywa","codigo":"NYW"},{"cidade":"Moomba, Austr\u00e1lia, Moomba","codigo":"MOO"},{"cidade":"Moosonee, Canad\u00e1, Moosonee","codigo":"YMO"},{"cidade":"Moranbah, Austr\u00e1lia","codigo":"MOV"},{"cidade":"Mora, Su\u00e9cia, Siljan","codigo":"MXX"},{"cidade":"Moree, Austr\u00e1lia","codigo":"MRZ"},{"cidade":"Morelia, M\u00e9xico, Francisco J. Mujica International","codigo":"MLM"},{"cidade":"Morgantown, Estados Unidos da Am\u00e9rica, Morgantown","codigo":"MGW"},{"cidade":"Morioka Hanamaki, Jap\u00e3o, Hanamaki","codigo":"HNA"},{"cidade":"Mornington Island, Austr\u00e1lia","codigo":"ONG"},{"cidade":"Morondava, Madag\u00e1scar, Morondava","codigo":"MOQ"},{"cidade":"Moron, Mong\u00f3lia, Moron","codigo":"MXV"},{"cidade":"Morotai Island, Indon\u00e9sia, Pitu","codigo":"OTI"},{"cidade":"Moruya, Austr\u00e1lia, Moruya","codigo":"MYA"},{"cidade":"Moscou, R\u00fassia, Moscow Domodedovo","codigo":"DME"},{"cidade":"Moscou, R\u00fassia, Moscow Sheremetyevo","codigo":"SVO"},{"cidade":"Moscou, R\u00fassia, Moscow Vnukovo International","codigo":"VKO"},{"cidade":"Moscou, R\u00fassia, Moscow Zhukovsky","codigo":"ZIA"},{"cidade":"Moscou, R\u00fassia - Todos Aeroportos","codigo":"MOW"},{"cidade":"Mosinee, Estados Unidos da Am\u00e9rica, Central Wisconsin","codigo":"CWA"},{"cidade":"Mosjoen, Noruega, Kjaerstad","codigo":"MJF"},{"cidade":"Mostar, B\u00f3snia e Herzegovina, Mostar International","codigo":"OMO"},{"cidade":"Mount Gambier, Austr\u00e1lia","codigo":"MGB"},{"cidade":"Mount Isa, Austr\u00e1lia, Mount Isa","codigo":"ISA"},{"cidade":"Mount Magnet, Austr\u00e1lia","codigo":"MMG"},{"cidade":"Mtwara, Tanz\u00e2nia, Mtwara","codigo":"MYW"},{"cidade":"Muan, Cor\u00e9ia do Sul","codigo":"MWX"},{"cidade":"Muang Xay, Laos, Oudomxay","codigo":"ODY"},{"cidade":"Mudanjiang, China, Hailang","codigo":"MDG"},{"cidade":"Mudgee, Austr\u00e1lia","codigo":"DGE"},{"cidade":"Muenster Osnabrueck, Alemanha, Muenster Osnabrueck","codigo":"FMO"},{"cidade":"Mukah, Mal\u00e1sia, Mukah","codigo":"MKM"},{"cidade":"Mukalla, I\u00eamen, Riyan","codigo":"RIY"},{"cidade":"Mukhaizna, Om\u00e3, Mukhaizna","codigo":"UKH"},{"cidade":"Muko Muko, Indon\u00e9sia, Muko Muko","codigo":"MPC"},{"cidade":"Mulatupo, Panam\u00e1, Malatuputo","codigo":"MPP"},{"cidade":"Mulhouse Basel, Fran\u00e7a, Euroairport ","codigo":"MLH"},{"cidade":"Multan, Paquist\u00e3o, International","codigo":"MUX"},{"cidade":"Mulu, Mal\u00e1sia, Mulu","codigo":"MZV"},{"cidade":"Mumbai, \u00cdndia, Chhatrapati Shivaji Maharaj","codigo":"BOM"},{"cidade":"Muna, Indon\u00e9sia, Sugimanuru","codigo":"RAQ"},{"cidade":"Munique\u00a0, Alemanha, Munich International","codigo":"MUC"},{"cidade":"Murray Island, Austr\u00e1lia","codigo":"MYI"},{"cidade":"Muscat, Om\u00e3, Muscat International","codigo":"MCT"},{"cidade":"Muskegon, Estados Unidos da Am\u00e9rica, Muskegon County","codigo":"MKG"},{"cidade":"Musoma, Tanz\u00e2nia, Musoma","codigo":"MUZ"},{"cidade":"Mus, Turquia, Mus","codigo":"MSR"},{"cidade":"Mwanza, Tanz\u00e2nia, Mwanza","codigo":"MWZ"},{"cidade":"Myeik, Mianmar, Myeik","codigo":"MGZ"},{"cidade":"Myitkyina, Mianmar, Myitkyina","codigo":"MYT"},{"cidade":"Myrtle Beach, Estados Unidos da Am\u00e9rica, Myrtle Beach","codigo":"MYR"},{"cidade":"Mysore, \u00cdndia, Mandakaralli","codigo":"MYQ"},{"cidade":"Mytilini, Gr\u00e9cia, Odysseas Elytis","codigo":"MJT"},{"cidade":"Mzuzu, Mal\u00e1ui, Muzu","codigo":"ZZU"},{"cidade":"Nabire, Indon\u00e9sia, Nabire","codigo":"NBX"},{"cidade":"Nacala, Mo\u00e7ambique, Nacala","codigo":"MNC"},{"cidade":"Nador, Marrocos, El Aroui","codigo":"NDR"},{"cidade":"Nadym, R\u00fassia, Nadym","codigo":"NYM"},{"cidade":"Naga, Filipinas","codigo":"WNP"},{"cidade":"Nagasaki, Jap\u00e3o, Nagasaki Airport","codigo":"NGS"},{"cidade":"Nag\u00f3ia, Jap\u00e3o, Chubu Centrair International","codigo":"NGO"},{"cidade":"Nagpur, \u00cdndia, Dr. Ambedkar","codigo":"NAG"},{"cidade":"Nain, Canad\u00e1, Nain","codigo":"YDP"},{"cidade":"Nairobi, Qu\u00eania, Jomo Kenyatta International","codigo":"NBO"},{"cidade":"Nairobi, Qu\u00eania, Wilson","codigo":"WIL"},{"cidade":"Nakashibetsu, Jap\u00e3o, Nakashibetsu","codigo":"SHB"},{"cidade":"Nakchivan, Azerbaij\u00e3o, Nakchivan","codigo":"NAJ"},{"cidade":"Nakhon Phanom, Tail\u00e2ndia, Nakhon Phanom","codigo":"KOP"},{"cidade":"Nakhon Si Thammarat, Tail\u00e2ndia","codigo":"NST"},{"cidade":"Nalchik, R\u00fassia, Nalchik","codigo":"NAL"},{"cidade":"Namangan, Uzbequist\u00e3o, Namangan","codigo":"NMA"},{"cidade":"Namibe,\u00a0Angola, Yuri Gagarin","codigo":"MSZ"},{"cidade":"Namlea, Indon\u00e9sia, Namlea","codigo":"NAM"},{"cidade":"Nampula, Mo\u00e7ambique, Nampula","codigo":"APL"},{"cidade":"Namrole, Indon\u00e9sia, Namrole","codigo":"NRE"},{"cidade":"Namsos, Noruega, Namsos","codigo":"OSY"},{"cidade":"Nanaimo, Canad\u00e1, Nanaimo","codigo":"YCD"},{"cidade":"Nanchang, China, Changbei International","codigo":"KHN"},{"cidade":"Nanchong, China, Gaoping","codigo":"NAO"},{"cidade":"Nanded, \u00cdndia, Nanded","codigo":"NDC"},{"cidade":"Nanjing, China, Lukou International","codigo":"NKG"},{"cidade":"Nanning, China, Wuxu International","codigo":"NNG"},{"cidade":"Nan, Tail\u00e2ndia, Nan","codigo":"NNT"},{"cidade":"Nantes, Fran\u00e7a, Atlantique","codigo":"NTE"},{"cidade":"Nantong, China, Xingdong","codigo":"NTG"},{"cidade":"Nantucket, Estados Unidos da Am\u00e9rica, Memorial","codigo":"ACK"},{"cidade":"Nanyang, China, Jiangying","codigo":"NNY"},{"cidade":"Nanyuki, Qu\u00eania, Nanyuki","codigo":"NYK"},{"cidade":"N\u00e1poles, It\u00e1lia, Capodichino Airport","codigo":"NAP"},{"cidade":"Narathiwat, Tail\u00e2ndia, Narathiwat","codigo":"NAW"},{"cidade":"Narrabri, Austr\u00e1lia","codigo":"NAA"},{"cidade":"Narrandera, Austr\u00e1lia","codigo":"NRA"},{"cidade":"Narvik, Noruega, Framnes","codigo":"NVK"},{"cidade":"Naryan Mar, R\u00fassia, Naryan Mar","codigo":"NNM"},{"cidade":"Nashville, Estados Unidos da Am\u00e9rica, Nashville International","codigo":"BNA"},{"cidade":"Nasik, \u00cdndia, Ozar","codigo":"ISK"},{"cidade":"Nassau, Bahamas, Lynden Pindling","codigo":"NAS"},{"cidade":"Natal, Brasil, Augusto Severo","codigo":"NAT"},{"cidade":"Natashquan, Canad\u00e1, Natashquan","codigo":"YNA"},{"cidade":"Natuna, Indon\u00e9sia, Ranai","codigo":"NTX"},{"cidade":"Navegantes, Brasil, Victor Konder","codigo":"NVT"},{"cidade":"Navoi, Uzbequist\u00e3o, International","codigo":"NVI"},{"cidade":"Naxos, Gr\u00e9cia, Naxos","codigo":"JNX"},{"cidade":"Nay Pyi Taw, Mianmar, Nay Pyi Taw","codigo":"NYT"},{"cidade":"Nazran, Magas, R\u00fassia, Sleptsovskaya","codigo":"IGT"},{"cidade":"Ndalatando,\u00a0Angola, Ndalatando","codigo":"NDF"},{"cidade":"Ndjamena, Chade, Hassan Djamous International","codigo":"NDJ"},{"cidade":"NDola, Z\u00e2mbia, Ndola","codigo":"NLA"},{"cidade":"Negril, Jamica, Negril","codigo":"NEG"},{"cidade":"Neiva, Col\u00f4mbia,Benito Sala","codigo":"NVA"},{"cidade":"Nejran, Ar\u00e1bia Saudita, Nejran","codigo":"EAM"},{"cidade":"Nelspruit, \u00c1frica do Sul, Kruger Mpumalanga International","codigo":"MQP"},{"cidade":"Nelspruit, \u00c1frica do Sul, Kruger Mpumalanga International","codigo":"MQP"},{"cidade":"Nemiscau, Canad\u00e1, Nemiscau","codigo":"YNS"},{"cidade":"Neom, Ar\u00e1bia Saudita, Neom Bay","codigo":"NUM"},{"cidade":"Nepalganj, Nepal, Nepalganj","codigo":"KEP"},{"cidade":"Neryungri, R\u00fassia, Neryungri","codigo":"NER"},{"cidade":"Neuquen, Argentina, Presidente Peron","codigo":"NQN"},{"cidade":"Nevis, S\u00e3o Crist\u00f3v\u00e3o e N\u00e9vis, Vance W. Amory","codigo":"NEV"},{"cidade":"Nevsehir, Turquia, Kapadokya","codigo":"NAV"},{"cidade":"New Bedford, Estados Unidos da Am\u00e9rica, New Bedford","codigo":"EWB"},{"cidade":"New Bern, Estados Unidos da Am\u00e9rica, Coastal Carolina","codigo":"EWN"},{"cidade":"Newburgh, Estados Unidos da Am\u00e9rica, Stewart","codigo":"SWF"},{"cidade":"Newcastle, Austr\u00e1lia, Williamtown","codigo":"NTL"},{"cidade":"Newcastle, Reino Unido, Newcastle International","codigo":"NCL"},{"cidade":"New Haven, Estados Unidos da Am\u00e9rica, Tweed-New Haven","codigo":"HVN"},{"cidade":"Newman, Austr\u00e1lia","codigo":"ZNE"},{"cidade":"New Orleans, Estados Unidos da Am\u00e9rica, Louis Armstrong","codigo":"MSY"},{"cidade":"Newport News, Estados Unidos da Am\u00e9rica, Newport News Williamsburg","codigo":"PHF"},{"cidade":"Newquay, Reino Unido, Cornwall","codigo":"NQY"},{"cidade":"Neyveli, \u00cdndia, Neyveli","codigo":"NVY"},{"cidade":"Ngala, \u00c1frica do Sul, Ngala","codigo":"NGL"},{"cidade":"NGaoundere, Camar\u00f5es, NGaoundere","codigo":"NGE"},{"cidade":"Nha Trang, Vietn\u00e3, Cam Ranh","codigo":"CXR"},{"cidade":"Nhulunbuy, Austr\u00e1lia, Gove","codigo":"GOV"},{"cidade":"Niamey, N\u00edger,Diori Hamani International, ","codigo":"NIM"},{"cidade":"Nice, Fran\u00e7a, Cote D Azur","codigo":"NCE"},{"cidade":"Niigata, Jap\u00e3o, Niigata","codigo":"KIJ"},{"cidade":"Nikolayevsk Na Amure, R\u00fassia","codigo":"NLI"},{"cidade":"Nimes, Fran\u00e7a, Garons","codigo":"FNI"},{"cidade":"Ningbo, China, Lishe International","codigo":"NGB"},{"cidade":"Ninglang, China, Luguhu","codigo":"NLH"},{"cidade":"Nis, S\u00e9rvia, Konstantin Velik","codigo":"INI"},{"cidade":"Nizhnekamsk, R\u00fassia, Begishevo","codigo":"NBC"},{"cidade":"Nizhnevartovsk, R\u00fassia, Nizhnevartovsk","codigo":"NJC"},{"cidade":"Nizhny Novgorod, R\u00fassia, Strigino","codigo":"GOJ"},{"cidade":"Nogales, M\u00e9xico, Nogales International","codigo":"NOG"},{"cidade":"Nogliki, R\u00fassia, Nogliki","codigo":"NGK"},{"cidade":"Nome, Estados Unidos da Am\u00e9rica, Nome","codigo":"OME"},{"cidade":"Norden - Norddeich\u00a0, Alemanha","codigo":"NOD"},{"cidade":"Norfolk, Estados Unidos da Am\u00e9rica, Norfolk International","codigo":"ORF"},{"cidade":"Norilsk, R\u00fassia, Alykel","codigo":"NSK"},{"cidade":"Normanton, Austr\u00e1lia","codigo":"NTN"},{"cidade":"Norman Wells, Canad\u00e1, Norman Wells","codigo":"YVQ"},{"cidade":"Norrkoping, Su\u00e9cia, Kungsangen","codigo":"NRK"},{"cidade":"North Bay, Canad\u00e1, Jack Garland","codigo":"YYB"},{"cidade":"North Bend, Estados Unidos da Am\u00e9rica, Southwest Oregon Regional","codigo":"OTH"},{"cidade":"North Eleuthera, Bahamas, North Eleuthera","codigo":"ELH"},{"cidade":"North Spirit Lake, Canad\u00e1,\u00a0North Spirit Lake","codigo":"YNO"},{"cidade":"Norway House, Canad\u00e1, Norway House","codigo":"YNE"},{"cidade":"Norwich, Reino Unido, Norwich","codigo":"NWI"},{"cidade":"Nosara, Costa Rica, Nosara","codigo":"NOB"},{"cidade":"Nosy Be, Madag\u00e1scar, Fascene","codigo":"NOS"},{"cidade":"Notodden, Noruega, Notodden","codigo":"NTB"},{"cidade":"Nottingham, Reino Unido, East Midlands","codigo":"EMA"},{"cidade":"Nouadhibou, Maurit\u00e2nia, Nouadhibou","codigo":"NDB"},{"cidade":"Nouakchott, Maurit\u00e2nia, Nouadhibou","codigo":"NKC"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica, John F. Kennedy","codigo":"JFK"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica, LaGuardia","codigo":"LGA"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica, Newark Liberty","codigo":"EWR"},{"cidade":"Nova Iorque, New York, Estados Unidos da Am\u00e9rica - Todos Aeroportos","codigo":"NYC"},{"cidade":"Novokuznetsk, R\u00fassia, Spichenkovo","codigo":"NOZ"},{"cidade":"Novosibirsk, R\u00fassia, Tolmachevo","codigo":"OVB"},{"cidade":"Novy Urengoy, R\u00fassia, Novy Urengoy","codigo":"NUX"},{"cidade":"Nowshahr, Ir\u00e3, Nowshahr","codigo":"NSH"},{"cidade":"Noyabrsk, R\u00fassia, Noyabrsk","codigo":"NOJ"},{"cidade":"Nueva Gerona, Cuba, Rafael Cabre","codigo":"GER"},{"cidade":"Nuevo Laredo, M\u00e9xico, Quetzalcoatl International","codigo":"NLD"},{"cidade":"Nukus, Uzbequist\u00e3o, Nukus","codigo":"NCU"},{"cidade":"Nunukan, Indon\u00e9sia, Nunukan","codigo":"NNX"},{"cidade":"Nurembergue\u00a0, Alemanha, Nuremberg Airport","codigo":"NUE"},{"cidade":"Nur Sultan, Cazaquist\u00e3o, Nazarbayev","codigo":"TSE"},{"cidade":"Nyagan, R\u00fassia, Nyagan","codigo":"NYA"},{"cidade":"Nyala, Sud\u00e3o, Nyala","codigo":"UYL"},{"cidade":"Nyingchi, Linzhi, China, Mainling, Milin","codigo":"LZY"},{"cidade":"Nyurba, R\u00fassia, Nyurba","codigo":"NYR"},{"cidade":"Oakland, Estados Unidos da Am\u00e9rica, Oakland","codigo":"OAK"},{"cidade":"Oaxaca, M\u00e9xico, Xoxocotlan International","codigo":"OAX"},{"cidade":"Obihiro, Jap\u00e3o, Obihiro","codigo":"OBO"},{"cidade":"Ocho Rios, Jamaica, Ian Fleming","codigo":"OCJ"},{"cidade":"Odate Noshiro, Jap\u00e3o, Odate Noshiro","codigo":"ONJ"},{"cidade":"Odense, Dinamarca, Ondense","codigo":"ODE"},{"cidade":"Odessa, Ucr\u00e2nia, Odesa International","codigo":"ODS"},{"cidade":"Odienne, Costa do Marfim, Odienne","codigo":"KEO"},{"cidade":"Ohrid, Maced\u00f4nia, St. Paul the Apostle","codigo":"OHD"},{"cidade":"Oita, Jap\u00e3o, Oita","codigo":"OIT"},{"cidade":"Okayama, Jap\u00e3o, Okayama","codigo":"OKJ"},{"cidade":"Okha, R\u00fassia, Novostroyka","codigo":"OHH"},{"cidade":"Okhotsk, R\u00fassia, Okhotsk","codigo":"OHO"},{"cidade":"Oki Island, Jap\u00e3o, Oki","codigo":"OKI"},{"cidade":"Okinawa, Jap\u00e3o, Ryukyo Island-Naha","codigo":"OKA"},{"cidade":"Okinoerabu, Jap\u00e3o, Okinoerabu","codigo":"OKE"},{"cidade":"Oklahoma City, Estados Unidos da Am\u00e9rica, Will Rogers World","codigo":"OKC"},{"cidade":"Oksibil, Indon\u00e9sia, Gunung Bintang","codigo":"OKL"},{"cidade":"Okushiri, Jap\u00e3o, Okushiri","codigo":"OIR"},{"cidade":"Olbia, It\u00e1lia, Costa Smeralda","codigo":"OLB"},{"cidade":"Old Crow, Canad\u00e1, Old Crow","codigo":"YOC"},{"cidade":"Olekminsk, R\u00fassia, Olekminsk","codigo":"OLZ"},{"cidade":"Olenek, R\u00fassia, Olenek","codigo":"ONK"},{"cidade":"Olgii, Mong\u00f3lia, Olgii","codigo":"ULG"},{"cidade":"Olympic Dam, Austr\u00e1lia","codigo":"OLP"},{"cidade":"Omaha, Estados Unidos da Am\u00e9rica, Eppley Airfield","codigo":"OMA"},{"cidade":"Omsk, R\u00fassia, Tsentralny","codigo":"OMS"},{"cidade":"Ondangwa, Nam\u00edbia, Ondangwa","codigo":"OND"},{"cidade":"Ondjiva, Angola, Ondjiva","codigo":"VPE"},{"cidade":"Onslow, Austr\u00e1lia","codigo":"ONS"},{"cidade":"Ontario, Estados Unidos da Am\u00e9rica, Ontario","codigo":"ONT"},{"cidade":"Oostende Brugge, B\u00e9lgica, Oostende","codigo":"OST"},{"cidade":"Oradea, Rom\u00eania, Oradea","codigo":"OMR"},{"cidade":"Oran, Arg\u00e9lia, Ahmed Bem Bella","codigo":"ORN"},{"cidade":"Orange, Austr\u00e1lia","codigo":"OAG"},{"cidade":"Orange walk, Belize, Orange Walk","codigo":"ORZ"},{"cidade":"Oranjemund, Nam\u00edbia, Oranjemud","codigo":"OMD"},{"cidade":"Ordos, China, Ejin Horo","codigo":"DSN"},{"cidade":"Ordu Giresun, Turquia, Ordu Giresun","codigo":"OGU"},{"cidade":"Orebro, Su\u00e9cia, Orebro Airport","codigo":"ORB"},{"cidade":"Orenburg, R\u00fassia, Tsentralny","codigo":"REN"},{"cidade":"Orland, Noruega, Orland","codigo":"OLA"},{"cidade":"Orlando, Estados Unidos da Am\u00e9rica, Orlando, McCoy Field","codigo":"MCO"},{"cidade":"Orlando, Estados Unidos da Am\u00e9rica, Orlando Sanford","codigo":"SFB"},{"cidade":"Ormoc City, Filipinas, Ormoc","codigo":"OMC"},{"cidade":"Ornskoldsvik, Su\u00e9cia, Ornskoldsvik","codigo":"OER"},{"cidade":"Orsk, R\u00fassia, Orsk","codigo":"OSW"},{"cidade":"Orsta Volda, Noruega, Hovden","codigo":"HOV"},{"cidade":"Oruro, Bol\u00edvia, Juan Mendoza","codigo":"ORU"},{"cidade":"Osaka, Jap\u00e3o, Kansai International","codigo":"KIX"},{"cidade":"Osaka, Jap\u00e3o, Osaka International","codigo":"ITM"},{"cidade":"Osaka, Jap\u00e3o , Todos Aeroportos","codigo":"OSA"},{"cidade":"Oshima, Jap\u00e3o, Oshima","codigo":"OIM"},{"cidade":"Osh, Quirguist\u00e3o, Osh","codigo":"OSS"},{"cidade":"Osijek, Cro\u00e1cia, Osijek","codigo":"OSI"},{"cidade":"Oslo, Noruega, Gardermoen","codigo":"OSL"},{"cidade":"Oslo, Noruega, Sandefjord Torp","codigo":"TRF"},{"cidade":"Osorno, Chile, Canal Bajo","codigo":"ZOS"},{"cidade":"Ostrava, Rep\u00fablica Tcheca, Leos Janacek","codigo":"OSR"},{"cidade":"Ottawa, Canad\u00e1, Ottawa Macdonald Cartier","codigo":"YOW"},{"cidade":"Ouagadougou, Burkina Faso, Ouagadougou","codigo":"OUA"},{"cidade":"Ouargla, Arg\u00e9lia","codigo":"OGX"},{"cidade":"Ouarzazate, Marrocos, Ouarzazate","codigo":"OZZ"},{"cidade":"Oujda, Marrocos, Angads","codigo":"OUD"},{"cidade":"Oulu, Finl\u00e2ndia, Oulu","codigo":"OUL"},{"cidade":"Ovda, Israel, Ovda","codigo":"VDA"},{"cidade":"Oviedo Ast\u00farias, Espanha, Asturias","codigo":"OVD"},{"cidade":"Owerri, Nig\u00e9ria, Sam Mbakwe","codigo":"QOW"},{"cidade":"Oxford House, Canad\u00e1, Oxford House","codigo":"YOH"},{"cidade":"Oxnard, Estados Unidos da Am\u00e9rica, Oxnard","codigo":"OXR"},{"cidade":"Ozamis, Filipinas, Labo","codigo":"OZC"},{"cidade":"Padang, Indon\u00e9sia, Minangkabau","codigo":"PDG"},{"cidade":"Padangsidempuan, Indon\u00e9sia","codigo":"AEG"},{"cidade":"Paderborn Lippstadt, Alemanha, Paderborn Lippstadt","codigo":"PAD"},{"cidade":"Paducah, Estados Unidos da Am\u00e9rica, Barkley","codigo":"PAH"},{"cidade":"Pagadian, Filipinas","codigo":"PAG"},{"cidade":"Page, Estados Unidos da Am\u00e9rica, Municipal de Page","codigo":"PGA"},{"cidade":"Pago Pago, Estados Unidos da Am\u00e9rica, Pago Pago International","codigo":"PPG"},{"cidade":"Pai, Tail\u00e2ndia, Pai","codigo":"PYY"},{"cidade":"Pajala, Su\u00e9cia, Pajala, Yllas","codigo":"PJA"},{"cidade":"Pakse, Laos, Pakse International","codigo":"PKZ"},{"cidade":"Pakuba, Uganda, Pakuda","codigo":"PAF"},{"cidade":"Palangkaraya, Indon\u00e9sia","codigo":"PKY"},{"cidade":"Palembang, Indon\u00e9sia, Mahmud Badaruddin II","codigo":"PLM"},{"cidade":"Palermo, It\u00e1lia, Punta Raisi","codigo":"PMO"},{"cidade":"Palma de Maiorca, Espanha, Palma Mallorca","codigo":"PMI"},{"cidade":"Palmar Sur, Costa Rica, Palmar Sur","codigo":"PMZ"},{"cidade":"Palmas, Brasil, Palmas","codigo":"PMW"},{"cidade":"Palm Island, Austr\u00e1lia","codigo":"PMK"},{"cidade":"Palm Springs, Estados Unidos da Am\u00e9rica, Palm Springs","codigo":"PSP"},{"cidade":"Palopo, Indon\u00e9sia, Lagaligo","codigo":"LLO"},{"cidade":"Palu, Indon\u00e9sia, Mutiara","codigo":"PLW"},{"cidade":"Pamplona, Espanha, Pamplona","codigo":"PNA"},{"cidade":"Pampulha, Brasil, Pampulha","codigo":"PLU"},{"cidade":"Panama City Beach, Estados Unidos da Am\u00e9rica, Northwest Fl\u00f3rida Beaches","codigo":"PFN"},{"cidade":"Panama City, Panam\u00e1, Tocumen","codigo":"PTY"},{"cidade":"Pangkalanbuun, Indon\u00e9sia, Iskandar","codigo":"PKN"},{"cidade":"Pangkalpinang, Indon\u00e9sia, Depati Amir","codigo":"PGK"},{"cidade":"Panglao, Filipinas, Bohol International","codigo":"TAG"},{"cidade":"Panjgur, Paquist\u00e3o, Panjgur","codigo":"PJG"},{"cidade":"Pantelleria, It\u00e1lia, Pantelleria","codigo":"PNL"},{"cidade":"Pantnagar, \u00cdndia, Pantnagar","codigo":"PGH"},{"cidade":"Panzhihua, China, Bao Angong","codigo":"PZI"},{"cidade":"Paraburdoo, Austr\u00e1lia","codigo":"PBO"},{"cidade":"Paramaribo Zanderij, Suriname, Johan A Pengel","codigo":"PBM, Suriname"},{"cidade":"Parana, Argentina, General Urquiza","codigo":"PRA"},{"cidade":"Parauapebas, Brasil, Caraj\u00e1s","codigo":"CKS"},{"cidade":"Pardubice, Rep\u00fablica Tcheca, Pardubice","codigo":"PED"},{"cidade":"Parintins, Brasil, Julio Belem","codigo":"PIN"},{"cidade":"Paris, Fran\u00e7a, Charles de Gaulle","codigo":"CDG"},{"cidade":"Paris, Fran\u00e7a, Le Bourget","codigo":"LBG"},{"cidade":"Paris, Fran\u00e7a, Orly","codigo":"ORY"},{"cidade":"Paris, Fran\u00e7a , Todos Aeroportos","codigo":"PAR"},{"cidade":"Parkersburg, Estados Unidos da Am\u00e9rica, Mid Ohio Valley","codigo":"PKB"},{"cidade":"Parkes, Austr\u00e1lia","codigo":"PKE"},{"cidade":"Parma, It\u00e1lia, Parma","codigo":"PMF"},{"cidade":"Parna\u00edba, Brasil, Jo\u00e3o Silva Filho","codigo":"PHB"},{"cidade":"Paro, But\u00e3o, International","codigo":"PBH"},{"cidade":"Paros, Gr\u00e9cia, Paros","codigo":"PAS"},{"cidade":"Parsabad, Ir\u00e3, Moghan","codigo":"PFQ"},{"cidade":"Pasco, Estados Unidos da Am\u00e9rica, Tri Cities","codigo":"PSC"},{"cidade":"Pasighat, \u00cdndia, Pasighat","codigo":"IXT"},{"cidade":"Pasto, Col\u00f4mbia,Antonio Narino","codigo":"PSO"},{"cidade":"Pathankot, \u00cdndia, Pathankot","codigo":"IXP"},{"cidade":"Pathein, Mianmar, Pathein","codigo":"BSX"},{"cidade":"Patna, \u00cdndia, Jayaprakash Narayan","codigo":"PAT"},{"cidade":"Patrai, Gr\u00e9cia, Araxos","codigo":"GPA"},{"cidade":"Pau, Fran\u00e7a, Pyrenees","codigo":"PUF"},{"cidade":"Paulatuk, Canad\u00e1, Nora A. Ruben","codigo":"YPC"},{"cidade":"Paulo Afonso, Brasil, Paulo Afonso","codigo":"PAV"},{"cidade":"Pavlodar, Cazaquist\u00e3o, Pavlodar","codigo":"PWQ"},{"cidade":"Pechora, R\u00fassia, Pechora","codigo":"PEX"},{"cidade":"Pedro Juan Caballero, Paraguai, Augusto Roberto Fuster","codigo":"PJC"},{"cidade":"Pekanbaru, Indon\u00e9sia","codigo":"PKU"},{"cidade":"Pellston, Estados Unidos da Am\u00e9rica, Regional Emmet County","codigo":"PLN"},{"cidade":"Pelotas, Brasil, Pelotas","codigo":"PET"},{"cidade":"Pemba, Mo\u00e7ambique, Pemba","codigo":"POL"},{"cidade":"Pemba, Tanz\u00e2nia, Pemba","codigo":"PMA"},{"cidade":"Penang, Mal\u00e1sia, Penag International","codigo":"PEN"},{"cidade":"Pendleton, Estados Unidos da Am\u00e9rica, Eastern Oregon Regional","codigo":"PDT"},{"cidade":"Pensacola, Estados Unidos da Am\u00e9rica, Pensacola","codigo":"PNS"},{"cidade":"Penticton, Canad\u00e1, Regional","codigo":"YYF"},{"cidade":"Penza, R\u00fassia, Ternovka","codigo":"PEZ"},{"cidade":"Peoria, Estados Unidos da Am\u00e9rica, Greater Peoria","codigo":"PIA"},{"cidade":"Pequim, Beijing, China, Capital International","codigo":"PEK"},{"cidade":"Pequim, Beijing, China, Daxing International","codigo":"PKX"},{"cidade":"Pequim, Beijing, China, Nanyuan Airport","codigo":"NAY"},{"cidade":"Pequim, Beijing, China , Todos Aeroportos","codigo":"BJS"},{"cidade":"Pereira, Col\u00f4mbia,Matecana","codigo":"PEI"},{"cidade":"Perigueux, Fran\u00e7a, Bassillac","codigo":"PGX"},{"cidade":"Perito Moreno, Argentina, Perito Moreno","codigo":"PMQ"},{"cidade":"Perm, R\u00fassia, Bolshoye Savino","codigo":"PEE"},{"cidade":"Perpignan, Fran\u00e7a, Rivesaltes","codigo":"PGF"},{"cidade":"Perth, Austr\u00e1lia, Perth Airport","codigo":"PER"},{"cidade":"Perugia\u00a0, It\u00e1lia, St. Francis Of Assini","codigo":"PEG"},{"cidade":"Pescara, It\u00e1lia, Abruzzo","codigo":"PSR"},{"cidade":"Peshawar, Paquist\u00e3o, Bacha Khan International","codigo":"PEW"},{"cidade":"Petersburg, Estados Unidos da Am\u00e9rica, Petersburg James A. Johnson","codigo":"PSG"},{"cidade":"Petrolina, Brasil, Senador Nilo Coelho","codigo":"PNZ"},{"cidade":"Petropavlovsk, Cazaquist\u00e3o, Petropavlovsk","codigo":"PPK"},{"cidade":"Petropavlovsk, R\u00fassia, Yelizovo","codigo":"PKC"},{"cidade":"Petrozavodsk, R\u00fassia, Besovets","codigo":"PES"},{"cidade":"Pevek, R\u00fassia, Pevek","codigo":"PWE"},{"cidade":"Phalaborwa, \u00c1frica do Sul, Hendrik Van Eck","codigo":"PHW"},{"cidade":"Phaplu, Nepal, Phaplu","codigo":"PPL"},{"cidade":"Phinda, \u00c1frica do Sul, Zulu Inyala","codigo":"PZL"},{"cidade":"Phitsanulok, Tail\u00e2ndia, Phitsanulok","codigo":"PHS"},{"cidade":"Phnom Penh, Camboja, International","codigo":"PNH"},{"cidade":"Phoenix, Estados Unidos da Am\u00e9rica, Phoenix Sky Harbor","codigo":"PHX"},{"cidade":"Phongsaly, Laos, Boun Neua","codigo":"PCQ"},{"cidade":"Phonsavan, Laos, Xieng Khouang","codigo":"XKH"},{"cidade":"Phrae, Tail\u00e2ndia, Phrae","codigo":"PRH"},{"cidade":"Phuket, Tail\u00e2ndia, Phuket International","codigo":"HKT"},{"cidade":"Phu Quoc Island, Vietn\u00e3, International","codigo":"PQC"},{"cidade":"Pickle Lake, Canad\u00e1, Pickle Lake","codigo":"YPL"},{"cidade":"Pico Island, Portugal, Pico Island","codigo":"PIX"},{"cidade":"Piedras Negras, M\u00e9xico, Piedras Negras International","codigo":"PDS"},{"cidade":"Pierre, Estados Unidos da Am\u00e9rica, Pierre","codigo":"PIR"},{"cidade":"Pietermaritzburg, \u00c1frica do Sul, Pietermaritzburg","codigo":"PZB"},{"cidade":"Pisa, It\u00e1lia, Galileu Galilei","codigo":"PSA"},{"cidade":"Pisco, Peru, Renan Elias Oliveira","codigo":"PIO"},{"cidade":"Pittsburgh, Estados Unidos da Am\u00e9rica, Pittsburgh International","codigo":"PIT"},{"cidade":"Piura, Peru,\u00a0G Concha Iberico","codigo":"PIU"},{"cidade":"Placencia Village, Belize, Placencia","codigo":"PLJ"},{"cidade":"Plastun, R\u00fassia, Plastun","codigo":"TLY"},{"cidade":"Playon Chico, Panam\u00e1, Playon Chico","codigo":"PYC"},{"cidade":"Pleiku, Vietn\u00e3, Pleiku","codigo":"PXU"},{"cidade":"Plettenberg Bay, \u00c1frica do Sul, Plettenberg Bay","codigo":"PBZ"},{"cidade":"Plovdiv, Bulg\u00e1ria, Krumovo","codigo":"PDV"},{"cidade":"Plymouth, Reino Unido, City Airport","codigo":"PLH"},{"cidade":"Pocatello, Estados Unidos da Am\u00e9rica, Pocatello","codigo":"PIH"},{"cidade":"Po\u00e7os de Caldas, Brasil, Walther Moreira Salles","codigo":"POO"},{"cidade":"Podgorica, Montenegro, Podgorica","codigo":"TGD"},{"cidade":"Pohang, Cor\u00e9ia do Sul, Pohang","codigo":"KPO"},{"cidade":"Pointe Noire, Rep\u00fablica do Congo, Pointe Noire","codigo":"PNR"},{"cidade":"Points North Landing, Canad\u00e1, Points North Landing","codigo":"YNL"},{"cidade":"Poitiers, Fran\u00e7a, Biard","codigo":"PIS"},{"cidade":"Pokhara, Nepal, Pokhara","codigo":"PKR"},{"cidade":"Polillo, Filipinas, Balesin Island","codigo":"BSI"},{"cidade":"Polokwane, \u00c1frica do Sul, Polokwane International","codigo":"PTG"},{"cidade":"Polyarnyj, R\u00fassia, Polyarnyj","codigo":"PYJ"},{"cidade":"Pondicherry, \u00cdndia, Pondicherry","codigo":"PNY"},{"cidade":"Pond Inlet, Canad\u00e1, Pond Inlet","codigo":"YIO"},{"cidade":"Ponta Delgada, A\u00e7ores, Portugal, Joao Paulo II","codigo":"PDL"},{"cidade":"Ponta Por\u00e3, Brasil, Ponta Por\u00e3","codigo":"PMG"},{"cidade":"Pontianak, Indon\u00e9sia","codigo":"PNK"},{"cidade":"Popayan, Col\u00f4mbia,Guillermo Leon Valencia","codigo":"PPN"},{"cidade":"Poplar Hill, Canad\u00e1,\u00a0Poplar Hill","codigo":"YHP"},{"cidade":"Poprad, Eslov\u00e1quia, Tatry","codigo":"TAT"},{"cidade":"Porbandar, \u00cdndia, Porbandar","codigo":"PBD"},{"cidade":"Pori, Finl\u00e2ndia, Pori","codigo":"POR"},{"cidade":"Porlamar, Venezuela, Del Caribe","codigo":"PMV"},{"cidade":"Port Angeles, Estados Unidos da Am\u00e9rica, William R. Fairchild","codigo":"CLM"},{"cidade":"Port Augusta, Austr\u00e1lia","codigo":"PUG"},{"cidade":"Port Au Prince, Haiti Toussaint Louverture","codigo":"PAP"},{"cidade":"Port Blair, \u00cdndia, Veer Savarkar","codigo":"IXZ"},{"cidade":"Port Elizabeth, \u00c1frica do Sul, Port Elizabeth","codigo":"PLZ"},{"cidade":"Port Gentil, Gab\u00e3o, International","codigo":"POG"},{"cidade":"Port Harcourt, Nig\u00e9ria, Port Harcourt International","codigo":"PHC"},{"cidade":"Port Hardy, Canad\u00e1, Port Hardy","codigo":"YZT"},{"cidade":"Port Hedland, Austr\u00e1lia, Port Hedland International","codigo":"PHE"},{"cidade":"Port Hope Simpson, Canad\u00e1, Port Hope Simpson","codigo":"YHA"},{"cidade":"Portimao, Portugal, Portimao","codigo":"PRM"},{"cidade":"Portland, Austr\u00e1lia","codigo":"PTJ"},{"cidade":"Portland, Estados Unidos da Am\u00e9rica, Jetport ","codigo":"PWM"},{"cidade":"Portland, Estados Unidos da Am\u00e9rica, Portland International","codigo":"PDX"},{"cidade":"Port Lincoln, Austr\u00e1lia","codigo":"PLO"},{"cidade":"Port Macquarie, Austr\u00e1lia","codigo":"PQQ"},{"cidade":"Port Menier, Canad\u00e1, Port Menier","codigo":"YPN"},{"cidade":"Porto Alegre, Brasil, Salgado Filho","codigo":"POA"},{"cidade":"Port Of Spain, Trinidad e Tobago, Piarco","codigo":"POS"},{"cidade":"Porto, Portugal, Francisco Sa Carneiro","codigo":"OPO"},{"cidade":"Porto Santo, Portugal, Porto Santo","codigo":"PXO"},{"cidade":"Porto Seguro, Brasil, Porto Seguro","codigo":"BPS"},{"cidade":"Porto Velho, Brasil, Governador Jorge Teixeira","codigo":"PVH"},{"cidade":"Port Sudan, Sud\u00e3o, New International","codigo":"PZU"},{"cidade":"Posadas, Argentina, Jose de San Martin","codigo":"PSS"},{"cidade":"Poso, Indon\u00e9sia, Kasinguncu","codigo":"PSJ"},{"cidade":"Postville, Canad\u00e1, Postville","codigo":"YSO"},{"cidade":"Potosi, Bol\u00edvia, Capitain Nicolas Rojas","codigo":"POI"},{"cidade":"Powell River, Canad\u00e1, Powell River","codigo":"YPW"},{"cidade":"Poza Rica, M\u00e9xico, El Tajin","codigo":"PAZ"},{"cidade":"Poznan, Polonia, Lawica","codigo":"POZ"},{"cidade":"Praga, Rep\u00fablica Tcheca, Ruzyne","codigo":"PRG"},{"cidade":"Praia, Cabo Verde, Praia International","codigo":"RAI"},{"cidade":"Praya, Indon\u00e9sia, Lombok International","codigo":"LOP"},{"cidade":"Preobrazheniye, R\u00fassia, Preobrazheniye","codigo":"RZH"},{"cidade":"Presque Isle, Estados Unidos da Am\u00e9rica, Northern Maine","codigo":"PQI"},{"cidade":"Preveza Lefkada, Gr\u00e9cia, Aktion","codigo":"PVK"},{"cidade":"Prince Albert, Canad\u00e1, Glass Field","codigo":"YPA"},{"cidade":"Prince George, Canad\u00e1, Prince George","codigo":"YXS"},{"cidade":"Prince Rupert, Canad\u00e1, Digby Island","codigo":"YPR"},{"cidade":"Principe Island, S\u00e3o Tom\u00e9 e Pr\u00edncipe, International","codigo":"PCP"},{"cidade":"Pristina, S\u00e9rvia, Pristina International","codigo":"PRN"},{"cidade":"Prosperpine, Austr\u00e1lia, Whitsunday Coast","codigo":"PPP"},{"cidade":"Providence, Estados Unidos da Am\u00e9rica, Theodore Francis Green State","codigo":"PVD"},{"cidade":"Provincetown, Estados Unidos da Am\u00e9rica, Provincetown","codigo":"PVC"},{"cidade":"Pskov, R\u00fassia, Pskov","codigo":"PKV"},{"cidade":"Pucallpa, Peru, D Abenzur Rengifo","codigo":"PCL"},{"cidade":"Puebla, M\u00e9xico, Hermanos Serdan","codigo":"PBC"},{"cidade":"Puerto Asis, Col\u00f4mbia,Tres de Mayo","codigo":"PUU"},{"cidade":"Puerto Ayacucho, Venezuela, Cacique Aramare","codigo":"PYH"},{"cidade":"Puerto Barrios, Guatemala, Puerto Barrios","codigo":"PBR"},{"cidade":"Puerto Cabello, Venezuela, bartolome Salom","codigo":"PBL"},{"cidade":"Puerto Escondido, M\u00e9xico, Puerto Escondido International","codigo":"PXM"},{"cidade":"Puerto Jimenez, Costa Rica, Puerto Jimenez","codigo":"PJM"},{"cidade":"Puerto Lempira, Honduras, Puerto Lempira","codigo":"PEU"},{"cidade":"Puerto Madryn, Argentina, El Tehuelche","codigo":"PMY"},{"cidade":"Puerto Maldonado, Peru,\u00a0Padre Aldamiz","codigo":"PEM"},{"cidade":"Puerto Montt, Chile, El Tepual","codigo":"PMC"},{"cidade":"Puerto Natales, Chile, Teniente","codigo":"PNT"},{"cidade":"Puerto Obaldia, Panam\u00e1, Puerto Obaldia","codigo":"PUE"},{"cidade":"Puerto Ordaz, Venezuela, Manuel Carlos Piar","codigo":"PZO"},{"cidade":"Puerto Plata, Rep\u00fablica Dominicana, Gregorio Luperon","codigo":"POP"},{"cidade":"Puerto Princesa, Filipinas, International","codigo":"PPS"},{"cidade":"Puerto Vallarta, M\u00e9xico, Gustavo D\u00edaz Ordaz","codigo":"PVR"},{"cidade":"Puerto Williams, Chile, Guardiamarina Zanartu","codigo":"WPU"},{"cidade":"Pula, Cro\u00e1cia, Pula","codigo":"PUY"},{"cidade":"Pullman, Estados Unidos da Am\u00e9rica, Moscow Regional","codigo":"PUW"},{"cidade":"Pune, \u00cdndia, Lohegaon","codigo":"PNQ"},{"cidade":"Punta Arenas, Chile, Carlos Ibanez del Campo","codigo":"PUQ"},{"cidade":"Punta Cana, Rep\u00fablica Dominicana, Punta Cana","codigo":"PUJ"},{"cidade":"Punta Del Este, Uruguai, Punta Del Leste","codigo":"PDP"},{"cidade":"Punta Gorda, Belize, Punta Gorda","codigo":"BZE"},{"cidade":"Putao, Mianmar, Putao","codigo":"PBU"},{"cidade":"Putussibau, Indon\u00e9sia, Pangsuma","codigo":"PSU"},{"cidade":"Puvirnituq, Canad\u00e1, Puvirnituq","codigo":"YPX"},{"cidade":"Pyongyang, Cor\u00e9ia do Norte, Sunan International","codigo":"FNJ"},{"cidade":"Qabala, Azerbaij\u00e3o, Gabala International","codigo":"GBB"},{"cidade":"Qaisumah, Ar\u00e1bia Saudita, Haifar Al Batin","codigo":"AQI"},{"cidade":"Qamdo, Changdu, China, Bangda","codigo":"BPX"},{"cidade":"Qianjiang Zhoubai, China, Wulingshan","codigo":"JIQ"},{"cidade":"Qiemo, China, Qiemo","codigo":"IQM"},{"cidade":"Qilian, China, Haibei","codigo":"HBQ"},{"cidade":"Qingdao, China, Liuting International","codigo":"TAO"},{"cidade":"Qingyang, China, Qingyang","codigo":"IQN"},{"cidade":"Qinhuangdao, China, Beidaihe","codigo":"BPE"},{"cidade":"Qionghai, China, Boao","codigo":"BAR"},{"cidade":"Qiqihar, China, Sanjiazi","codigo":"NDG"},{"cidade":"Quang Ninh, Vietn\u00e3, Van Don International","codigo":"VDO"},{"cidade":"Quanzhou, China, Jinjiang","codigo":"JJN"},{"cidade":"Quaqtaq, Canad\u00e1, Puvirnituq","codigo":"YQC"},{"cidade":"Quebec, Canad\u00e1, Jean Lesage","codigo":"YQB"},{"cidade":"Quelimane, Mo\u00e7ambique, Quelimane","codigo":"UEL"},{"cidade":"Quepos, Costa Rica, La Managua","codigo":"XQP"},{"cidade":"Queretaro, M\u00e9xico, Queretaro Intercontinental","codigo":"QRO"},{"cidade":"Quesnel, Canad\u00e1, Quesnel","codigo":"YQZ"},{"cidade":"Quetta, Paquist\u00e3o, International","codigo":"UET"},{"cidade":"Quibdo, Col\u00f4mbia,El Carano","codigo":"UIB"},{"cidade":"Quilpie, Austr\u00e1lia","codigo":"ULP"},{"cidade":"Quimper, Fran\u00e7a, Pluguffan","codigo":"UIP"},{"cidade":"Quincy, Estados Unidos da Am\u00e9rica, Quincy Baldwin Field","codigo":"UIN"},{"cidade":"Qui Nhon, Vietn\u00e3, Phu Cat","codigo":"UIH"},{"cidade":"Quito, Equador, Mariscal Sucre","codigo":"UIO, Equador"},{"cidade":"Qurghonteppa,, Tajiquist\u00e3o, International","codigo":"KQT"},{"cidade":"Quzhou, China, Quzhou","codigo":"JUZ"},{"cidade":"Rabat, Marrocos, Sale","codigo":"RBA"},{"cidade":"Rach Gia, Vietn\u00e3, Rach Gia","codigo":"VKG"},{"cidade":"Rafha, Ar\u00e1bia Saudita, Rafha","codigo":"RAH"},{"cidade":"Rafsanjan, Ir\u00e3, Rafsanjan","codigo":"RJN"},{"cidade":"Rahim Yar Khan, Paquist\u00e3o, Rahim Yar Khan","codigo":"RYK"},{"cidade":"Raipur, \u00cdndia, Swami Vivekananda","codigo":"RPR"},{"cidade":"Rajahmundry, \u00cdndia, Rajahmundry","codigo":"RJA"},{"cidade":"Rajbiraj, Nepal, Rajbiraj","codigo":"RJB"},{"cidade":"Rajkot, \u00cdndia, Rajkot","codigo":"RAJ"},{"cidade":"Rajshahi, Bangladesh, Shah Makhdum","codigo":"RJH"},{"cidade":"Raleigh, Estados Unidos da Am\u00e9rica, Raleigh-Durham","codigo":"RDU"},{"cidade":"Ramsar, Ir\u00e3, Ramsar","codigo":"RZR"},{"cidade":"Ranchi, \u00cdndia, Birsa Munda","codigo":"IXR"},{"cidade":"Rankin Inlet, Canad\u00e1, Rankin Inlet","codigo":"YRT"},{"cidade":"Ranong, Tail\u00e2ndia, Ranong","codigo":"UNN"},{"cidade":"Rapid City, Estados Unidos da Am\u00e9rica, Rapid City","codigo":"RAP"},{"cidade":"Ras al Khaymah, Emirados \u00c1rabes Unidos, Ras al Khaimah","codigo":"RKT"},{"cidade":"Rasht, Ir\u00e3, Sandra E Jangal","codigo":"RAS"},{"cidade":"Reading, Estados Unidos da Am\u00e9rica, Reading Regional","codigo":"RDG"},{"cidade":"Recife, Brasil, Guararapes","codigo":"REC"},{"cidade":"Reconquista, Argentina, Reconquista","codigo":"RCQ"},{"cidade":"Redang Island, Mal\u00e1sia","codigo":"RDN"},{"cidade":"Redding, Estados Unidos da Am\u00e9rica, Redding","codigo":"RDD"},{"cidade":"Red Lake, Canad\u00e1, Red Lake","codigo":"YRL"},{"cidade":"Redmond, Estados Unidos da Am\u00e9rica, Roberts Field","codigo":"RDM"},{"cidade":"Reggio di Calabria, It\u00e1lia, Reggio di Calabria","codigo":"REG"},{"cidade":"Regina, Canad\u00e1, Regina","codigo":"YQR"},{"cidade":"Rengat, Indon\u00e9sia, Japura","codigo":"RGT"},{"cidade":"Rennes, Fran\u00e7a, St Jacques","codigo":"RNS"},{"cidade":"Reno, Estados Unidos da Am\u00e9rica, Tahoe","codigo":"RNO"},{"cidade":"Resistencia, Argentina, Resistencia","codigo":"RES"},{"cidade":"Resolute, Canad\u00e1, Resolute Bay","codigo":"YRB"},{"cidade":"Retalhuleu, Guatemala, Retalhuleu","codigo":"RER"},{"cidade":"Reus, Espanha, Reus","codigo":"REU"},{"cidade":"Reykjavik, Isl\u00e2ndia, Keflavik International","codigo":"KEF"},{"cidade":"Reykjavik, Isl\u00e2ndia, Reykjavik Domestic","codigo":"RKV"},{"cidade":"Reykjavik, Isl\u00e2ndia , Todos Aeroportos","codigo":"REK"},{"cidade":"Reynosa, M\u00e9xico, Lucio Blanco","codigo":"REX"},{"cidade":"Rhinelander, Estados Unidos da Am\u00e9rica, Oneida County","codigo":"RHI"},{"cidade":"Rhodes, Gr\u00e9cia, Diagoras Airport","codigo":"RHO"},{"cidade":"Riade, Ar\u00e1bia Saudita, Riyad King Khalid","codigo":"RUH"},{"cidade":"Ribeir\u00e3o Preto, Brasil, Leite Lopes","codigo":"RAO"},{"cidade":"Riberalta\u00a0, Bol\u00edvia, Riberalta","codigo":"RIB"},{"cidade":"Richards Bay, \u00c1frica do Sul, Richards Bay","codigo":"RCB"},{"cidade":"Richmond, Austr\u00e1lia","codigo":"RCM"},{"cidade":"Richmond, Estados Unidos da Am\u00e9rica, Richmond International","codigo":"RIC"},{"cidade":"Riga, Let\u00f4nia, Riga International","codigo":"RIX"},{"cidade":"Rigolet, Canad\u00e1, Rigolet","codigo":"YRG"},{"cidade":"Rijeka, Cro\u00e1cia, Rijeka","codigo":"RJK"},{"cidade":"Rimini, It\u00e1lia, Miramare","codigo":"RMI"},{"cidade":"Rio Branco, Brasil, Pl\u00e1cido de Castro","codigo":"RBR"},{"cidade":"Rio Cuarto, Argentina, Las Higueras","codigo":"RCU"},{"cidade":"Rio de Janeiro, Brasil, Gale\u00e3o","codigo":"GIG"},{"cidade":"Rio de Janeiro, Brasil, Santos Dumont","codigo":"SDU"},{"cidade":"Rio de Janeiro, Brasil , Todos Aeroportos","codigo":"RIO"},{"cidade":"Rio Gallegos, Argentina, Piloto N. Fernandez","codigo":"RGL"},{"cidade":"Rio Grande, Argentina, Hermes Quijada","codigo":"RGA"},{"cidade":"Riohacha, Col\u00f4mbia,Padilla","codigo":"RCH"},{"cidade":"Rio Hato, Panam\u00e1, Scarlett Martinez","codigo":"RIH"},{"cidade":"Rio Hondo, Argentina, Termas de Rio Hondo","codigo":"RHD"},{"cidade":"Rio Verde, Brasil, Leite de Castro","codigo":"RVD"},{"cidade":"Rishiri, Jap\u00e3o, Rishiri","codigo":"RIS"},{"cidade":"Riverton, Estados Unidos da Am\u00e9rica, Riverton Regional","codigo":"RIW"},{"cidade":"Rizhao, China, Shanzihe","codigo":"RIZ"},{"cidade":"Roanoke, Estados Unidos da Am\u00e9rica, Roanoke Regional","codigo":"ROA"},{"cidade":"Roatan, Honduras, Juan Manuel Galvez","codigo":"RTB"},{"cidade":"Rochester, Estados Unidos da Am\u00e9rica, Greater Rochester","codigo":"ROC"},{"cidade":"Rochester, Estados Unidos da Am\u00e9rica, Rochester","codigo":"RST"},{"cidade":"Rockhampton, Austr\u00e1lia","codigo":"ROK"},{"cidade":"Rockland, Estados Unidos da Am\u00e9rica, Knox Countyt","codigo":"RKD"},{"cidade":"Rock Sound, Bahamas, Rock Sound","codigo":"RSD"},{"cidade":"Rodez, Fran\u00e7a, Marcillac","codigo":"RDZ"},{"cidade":"Rodrigues Island, Ilhas Mauricio, Plane Corail","codigo":"RRG"},{"cidade":"Roervik, Noruega, Ryum","codigo":"RVK"},{"cidade":"Roi Et, Muang, Tail\u00e2ndia, Roi Et Airport","codigo":"ROI"},{"cidade":"Rokot, Indon\u00e9sia, Sipora","codigo":"RKI"},{"cidade":"Roma, Austr\u00e1lia","codigo":"RMA"},{"cidade":"Roma, It\u00e1lia, Ciampino","codigo":"CTA"},{"cidade":"Roma, It\u00e1lia, Fiumicino","codigo":"FCO"},{"cidade":"Roma, It\u00e1lia - Todos Aeroportos","codigo":"ROM"},{"cidade":"Rondon\u00f3polis, Brasil, Maestro Marinho Franco","codigo":"ROO"},{"cidade":"Ronneby, Karlskrona, Su\u00e9cia, kallinge","codigo":"RNB"},{"cidade":"Roros, Noruega, Roros","codigo":"RRS"},{"cidade":"Rosario, Argentina, Islas Malvinas","codigo":"ROS"},{"cidade":"Rost, Noruega, Rost","codigo":"RET"},{"cidade":"Rostock, Laage, Alemanha, Laage","codigo":"RLG"},{"cidade":"Rostov, R\u00fassia, Platov","codigo":"ROV"},{"cidade":"Roterd\u00e3, Holanda, Rotterdam","codigo":"RTM"},{"cidade":"Roti, Indon\u00e9sia, David C. Saudale","codigo":"RTI"},{"cidade":"Rouen, Fran\u00e7a, Vallee de Seine","codigo":"URO"},{"cidade":"Rourkela, \u00cdndia, Rourkela","codigo":"RRK"},{"cidade":"Rouyn Noranda, Canad\u00e1, Rouyn Noranda","codigo":"YUY"},{"cidade":"Rovaniemi, Finl\u00e2ndia, Rovaniemi","codigo":"RVN"},{"cidade":"Roxas City, Filipinas, Roxas","codigo":"RXS"},{"cidade":"Rundu, Nam\u00edbia, Rundu","codigo":"NDU"},{"cidade":"Ruoqiang, China, Loulan","codigo":"RQA"},{"cidade":"Rurrenabaque, Bol\u00edvia, Rurrenabaque","codigo":"RBQ"},{"cidade":"Ruteng, Indon\u00e9sia, Frans Sales Lega","codigo":"RTG"},{"cidade":"Rzeszow, Polonia, Jasionka","codigo":"RZE"},{"cidade":"Saarbrucken, Alemanha, Saarbrucken Airport","codigo":"SCN"},{"cidade":"Sabang, Indon\u00e9sia, Maimun Saleh","codigo":"SBG"},{"cidade":"Sabetta, R\u00fassia, Sabetta International","codigo":"SBT"},{"cidade":"Sabha, L\u00edbia, Sebha","codigo":"SEB"},{"cidade":"Sabzevar, Ir\u00e3, Sabzevar","codigo":"AFZ"},{"cidade":"Sacramento, Estados Unidos da Am\u00e9rica, Sacramento","codigo":"SMF"},{"cidade":"Saga, Jap\u00e3o, Saga Airport","codigo":"HSG"},{"cidade":"Saginaw, Estados Unidos da Am\u00e9rica, MBS","codigo":"MBS"},{"cidade":"Saguenay Bagotville, Canad\u00e1, Saguenay Bagotville","codigo":"YBG"},{"cidade":"Saibai Island, Austr\u00e1lia","codigo":"SBR"},{"cidade":"Saidpur, Bangladesh, Saidpur","codigo":"SPD"},{"cidade":"Saint Augustin, Pakuaship, Canad\u00e1, Saint Augustin","codigo":"YIF"},{"cidade":"Saint Croix, Christiansted, Virgin Islands Estados Unidos, Henry e Rohlsen","codigo":"STX"},{"cidade":"Sainte-Marie, Madag\u00e1scar, Sainte Marie","codigo":"SMS"},{"cidade":"Saint George, Estados Unidos da Am\u00e9rica, St. George Municipal","codigo":"SGU"},{"cidade":"Saint John, Canad\u00e1, Saint John","codigo":"YSJ"},{"cidade":"Saint Laurent du Maroni, Guiana Francesa, Saint Laurent du Maroni","codigo":"LDX"},{"cidade":"Saint Martin, Holanda, Princess Juliana","codigo":"SXM"},{"cidade":"Saint Thomas Island, Charlotte Amalie, Virgin Islands Estados Unidos, Cyril E. King","codigo":"STT"},{"cidade":"Saipan, Northern Mariana Islands,\u00a0Francisco C. Ada International","codigo":"SPN"},{"cidade":"Sakkyryr, R\u00fassia, Sakkyryr","codigo":"SUK"},{"cidade":"Sakon Nakhon, Tail\u00e2ndia, Sakon Nakhon","codigo":"SNO"},{"cidade":"Salalah, Om\u00e3, Salalah","codigo":"SLL"},{"cidade":"Salamanca, Espanha, Salamanca Airport","codigo":"SLM"},{"cidade":"Salekhard, R\u00fassia, Salekhard","codigo":"SLY"},{"cidade":"Salem, \u00cdndia, Salem","codigo":"SXV"},{"cidade":"Salenl, Su\u00e9cia, Scandinavian Mountains Airport","codigo":"SCR"},{"cidade":"Salina Cruz, M\u00e9xico, Salina Cruz","codigo":"SCX"},{"cidade":"Salinas, Equador, General Ulpiano Paez","codigo":"SNC, Equador"},{"cidade":"Salisbury, Estados Unidos da Am\u00e9rica, Wicomico","codigo":"SBY"},{"cidade":"Salluit, Canad\u00e1, Salluit","codigo":"YZG"},{"cidade":"Salta, Argentina, Martin M. de Guemes","codigo":"SLA"},{"cidade":"Saltillo, M\u00e9xico, Plan de Guadalupe","codigo":"SLW"},{"cidade":"Salt Lake City, Estados Unidos da Am\u00e9rica, Salt Lake City International","codigo":"SLC"},{"cidade":"Salvador, Brasil, D.L.E. Magalh\u00e3es","codigo":"SSA"},{"cidade":"Salzburg, \u00c1ustria, W.A. Mozart","codigo":"SZG"},{"cidade":"Samana, Rep\u00fablica Dominicana, El Catey International","codigo":"AZS"},{"cidade":"Samara, R\u00fassia, Kurumoch","codigo":"KUF"},{"cidade":"Samarinda, Indon\u00e9sia","codigo":"AAP"},{"cidade":"Samarkand, Uzbequist\u00e3o, Samarkand","codigo":"SKD"},{"cidade":"Sambava, Madag\u00e1scar, Sambava","codigo":"SVB"},{"cidade":"Samburu, Qu\u00eania, Buffalo Spring","codigo":"UAS"},{"cidade":"Sam Neua, Laos, Sam Neua","codigo":"NEU"},{"cidade":"Samos, Gr\u00e9cia, Aristarchos Of Samos","codigo":"SMI"},{"cidade":"Sampit, Indon\u00e9sia, H. Asan","codigo":"SMQ"},{"cidade":"Samsun, Turquia, Carsamba","codigo":"SZF"},{"cidade":"Sanaa, I\u00eamen, Sanaa International","codigo":"SAH"},{"cidade":"Sanana, Indon\u00e9sia, Emalamo","codigo":"SQN"},{"cidade":"Sanandaj, Ir\u00e3, Sanandaj","codigo":"SDG"},{"cidade":"San Andres, Col\u00f4mbia, Gustavo R Pinilla","codigo":"ADZ"},{"cidade":"San Andros, Bahamas, San Andros","codigo":"SAQ"},{"cidade":"San Angelo, Estados Unidos da Am\u00e9rica, Regional Mathis Field","codigo":"SJT"},{"cidade":"San Antonio, Estados Unidos da Am\u00e9rica, San Antonio International","codigo":"SAT"},{"cidade":"San Cristobal, Equador, San Cristobal","codigo":"SCY, Equador"},{"cidade":"Sandakan, Mal\u00e1sia, Sandakan","codigo":"SDK"},{"cidade":"Sandane, Noruega, Anda","codigo":"SDN"},{"cidade":"San Diego, Estados Unidos da Am\u00e9rica, San Diego","codigo":"SAN"},{"cidade":"Sandnessjoen, Noruega, Stokka","codigo":"SSJ"},{"cidade":"Sandspit, Canad\u00e1","codigo":"YZP"},{"cidade":"Sandy Lake, Canad\u00e1, Sandy Lake","codigo":"ZSJ"},{"cidade":"San Fernando de Apure, Venezuela, Las Flecheras","codigo":"SFD"},{"cidade":"San Ignacio, Belize, Matthew Spain","codigo":"SQS"},{"cidade":"Sanikiluaq, Canad\u00e1, Sanikiluaq","codigo":"YSK"},{"cidade":"San Isidro, Costa Rica, San Isidro","codigo":"IPZ"},{"cidade":"San Jose, Costa Rica, Juan Santamaria","codigo":"SJO"},{"cidade":"San Jose, Costa Rica, TOBIAS BOLANOS International","codigo":"SYQ"},{"cidade":"San Jose, Filipinas, San Jose","codigo":"SJI"},{"cidade":"San Jose Island, Panam\u00e1, San Jose Island","codigo":"SIC"},{"cidade":"San Juan, Argentina, Domingo F. Sarmiento","codigo":"UAQ"},{"cidade":"San Juan, Porto Rico, Fernando Luis Ribas Dominicci","codigo":"SIG"},{"cidade":"San Juan, Porto Rico, Luis Mu\u00f1oz Mar\u00edn International","codigo":"SJU"},{"cidade":"Sanliurfa, Turquia, Guney Anadolu","codigo":"GNY"},{"cidade":"San Luis, Argentina, D. Cesar Raul Ojeda","codigo":"LUQ"},{"cidade":"San Luis Obispo, Estados Unidos da Am\u00e9rica, McChesney Field","codigo":"SBP"},{"cidade":"San Luis Potosi, M\u00e9xico, Ponciano Arriaga","codigo":"SLP"},{"cidade":"San Martin de Los Andes, Argentina, Aviador Carlos Campos","codigo":"CPC"},{"cidade":"Sanming, China, Shaxian","codigo":"SQJ"},{"cidade":"San Pedro, Belize, San Pedro","codigo":"SPR"},{"cidade":"San Pedro, Costa do Marfim, San Pedro","codigo":"SPY"},{"cidade":"San Pedro Sula, Honduras, Ramon V. Morales","codigo":"SAP"},{"cidade":"San Rafael, Argentina, San Rafael","codigo":"AFA"},{"cidade":"San Salvador, Bahamas, Cockburn Town","codigo":"ZSA"},{"cidade":"San Salvador, El Salvador, El Salvador International","codigo":"SAL"},{"cidade":"San Sebastian, Espanha, San Sebastian Airport","codigo":"EAS"},{"cidade":"San Sebastian Gomera, Espanha, La Gomera","codigo":"GMZ"},{"cidade":"Santa Ana, Estados Unidos da Am\u00e9rica, John Wayne","codigo":"SNA"},{"cidade":"Santa B\u00e1rbara, Estados Unidos da Am\u00e9rica, Santa B\u00e1rbara","codigo":"SBA"},{"cidade":"Santa Clara, Cuba, Abel Santamaria","codigo":"SNU"},{"cidade":"Santa Cruz, Bol\u00edvia, Viru Viru","codigo":"VVI"},{"cidade":"Santa Cruz de La Palma, Espanha, La Palma","codigo":"SPC"},{"cidade":"Santa Fe, Argentina, Sauce Viejo","codigo":"SFN"},{"cidade":"Santa Fe, Estados Unidos da Am\u00e9rica, Santa Fe","codigo":"SAF"},{"cidade":"Santa Maria, Estados Unidos da Am\u00e9rica, Capt G. Allan Hancock Field","codigo":"SMX"},{"cidade":"Santa Maria Island, Portugal, Santa Maria Island","codigo":"SMA"},{"cidade":"Santa Marta, Col\u00f4mbia, Simon Bolivar","codigo":"SMR"},{"cidade":"Santander, Espanha, Santander Airport","codigo":"SDR"},{"cidade":"Santar\u00e9m, Brasil, Maestro Wilson Fonseca","codigo":"STM"},{"cidade":"Santa Rosa, Argentina, Santa Rosa","codigo":"RSA"},{"cidade":"Santa Rosa, Equador, Santa Rosa","codigo":"ETR, Equador"},{"cidade":"Santiago, Chile, Internacional, Arturo Merino Ben\u00edtez","codigo":"SCL"},{"cidade":"Santiago de Compostela, Espanha, Santiago de Compostela","codigo":"SCQ"},{"cidade":"Santiago de Cuba, Cuba, Antonio Maceo","codigo":"SCU"},{"cidade":"Santiago del Estero, Argentina, A. De La Paz Aragonez","codigo":"SDE"},{"cidade":"Santiago, Rep\u00fablica Dominicana, Cibao International","codigo":"STI"},{"cidade":"Santo Domingo, Rep\u00fablica Dominicana, La Isabela Joaquin Balanguer","codigo":"JBQ"},{"cidade":"Santo Domingo, Rep\u00fablica Dominicana, Las Americas","codigo":"SDQ"},{"cidade":"Santo Domingo, Venezuela, Buenaventura Vivas","codigo":"STD"},{"cidade":"San Tome, Venezuela, San Tome, ","codigo":"SOM"},{"cidade":"San Vicente, Filipinas","codigo":"SWL"},{"cidade":"Sanya, China, Phoenix International","codigo":"SYX"},{"cidade":"S\u00e3o Filipe, Cabo Verde, Sao Filipe","codigo":"SFL"},{"cidade":"S\u00e3o Francisco, Estados Unidos da Am\u00e9rica, S\u00e3o Francisco","codigo":"SFO"},{"cidade":"S\u00e3o Jorge Island, Portugal, S\u00e3o Jorge","codigo":"SJZ"},{"cidade":"S\u00e3o Jos\u00e9 dos Campos, Brasil, S\u00e3o Jos\u00e9 dos Campos","codigo":"SJK"},{"cidade":"S\u00e3o Jos\u00e9, Estados Unidos da Am\u00e9rica, S\u00e3o Jos\u00e9","codigo":"SJC"},{"cidade":"S\u00e3o Luiz, Brasil, Cunha Machado","codigo":"SLZ"},{"cidade":"S\u00e3o Paulo, Brasil, Congonhas","codigo":"CGH"},{"cidade":"S\u00e3o Paulo, Brasil, Guarulhos","codigo":"GRU"},{"cidade":"S\u00e3o Paulo, Brasil , Todos aeroportos","codigo":"SAO"},{"cidade":"S\u00e3o Paulo, Brasil, Viracopos Campinas","codigo":"VCP"},{"cidade":"S\u00e3o Petersburgo, Estados Unidos da Am\u00e9rica, S\u00e3o Petersburgo-Clearwater","codigo":"PIE"},{"cidade":"S\u00e3o Petersburgo, R\u00fassia, Pulkovo","codigo":"LED"},{"cidade":"S\u00e3o Tom\u00e9, S\u00e3o Tom\u00e9 e Pr\u00edncipe, International","codigo":"TMS"},{"cidade":"Sapporo, Jap\u00e3o, New Chitose","codigo":"CTS"},{"cidade":"Sapporo, Jap\u00e3o, Okada","codigo":"OKD"},{"cidade":"Sapporo, Jap\u00e3o , Todos Aeroportos","codigo":"SPK"},{"cidade":"Sarago\u00e7a, Espanha, Zaragoza","codigo":"ZAZ"},{"cidade":"Sarajevo, B\u00f3snia e Herzegovina, Sarajevo International","codigo":"SJJ"},{"cidade":"Saransk, R\u00fassia, Saransk","codigo":"SKX"},{"cidade":"Sarasota\u00a0, \u00a0Bradenton, Estados Unidos da Am\u00e9rica, Sarasota-Bradenton","codigo":"SRQ"},{"cidade":"Saratov, R\u00fassia, Gagarin","codigo":"GSV"},{"cidade":"Sarnia, Canad\u00e1, Chris Hadfield","codigo":"YZR"},{"cidade":"Sary, Ir\u00e3, Dashte Naz","codigo":"SRY"},{"cidade":"Saskatoon, Canad\u00e1, J.G Diefenbaker","codigo":"YXE"},{"cidade":"Saskylakh, R\u00fassia, Saskylakh","codigo":"SYS"},{"cidade":"Satu Mare, Rom\u00eania, Satu Mare","codigo":"SUJ"},{"cidade":"Saul, Guiana Francesa, Saul","codigo":"XAU"},{"cidade":"Sault Ste. Marie, Estados Unidos da Am\u00e9rica, Chippewa County","codigo":"CIU"},{"cidade":"Saumlaki, Indon\u00e9sia, Olilit","codigo":"SXK"},{"cidade":"Saurimo,\u00a0Angola, Saurimo","codigo":"VHC"},{"cidade":"Savannah, Estados Unidos da Am\u00e9rica, Hilton Head","codigo":"SAV"},{"cidade":"Savannakhet, Laos, Savannakhet","codigo":"ZVK"},{"cidade":"Savonlinna, Finl\u00e2ndia, Savonlinna","codigo":"SVL"},{"cidade":"Sawan, Paquist\u00e3o, Sawan","codigo":"RZS"},{"cidade":"Sawu, Indon\u00e9sia, Tardamu","codigo":"SAU"},{"cidade":"Sayaboury, Laos, Sayaboury","codigo":"ZBY"},{"cidade":"Schefferville, Canad\u00e1, Schefferville","codigo":"YKL"},{"cidade":"Seattle, Estados Unidos da Am\u00e9rica, Seattle-Tacoma International","codigo":"SEA"},{"cidade":"Seiyun, I\u00eamen, Sayun","codigo":"GXF"},{"cidade":"Semarang, Indon\u00e9sia, Ahmad Yani","codigo":"SRG"},{"cidade":"Semera, Eti\u00f3pia, Semera","codigo":"SZE"},{"cidade":"Semey, Cazaquist\u00e3o, Semey","codigo":"PLX"},{"cidade":"Sendai, Jap\u00e3o, Sendai","codigo":"SDJ"},{"cidade":"Sept Iles, Canad\u00e1, Sept Iles","codigo":"YZV"},{"cidade":"Seronera, Tanz\u00e2nia, Seronera","codigo":"SEU"},{"cidade":"Serui, Indon\u00e9sia","codigo":"ZRI"},{"cidade":"Setif, Arg\u00e9lia, Setif","codigo":"QSF"},{"cidade":"Seul, Cor\u00e9ia do Sul, Gimpo International","codigo":"GMP"},{"cidade":"Seul, Cor\u00e9ia do Sul, Incheon International","codigo":"ICN"},{"cidade":"Seul, Cor\u00e9ia do Sul , Todos Aeroportos","codigo":"SEL"},{"cidade":"Sevilha, Espanha, Sevilla Airport","codigo":"SVQ"},{"cidade":"Sfax, Tun\u00edsia, Thyna","codigo":"SFA"},{"cidade":"Shache, China, Yeerqiang","codigo":"QSZ"},{"cidade":"Shahre Kord, Ir\u00e3, Shahre Kord","codigo":"CQD"},{"cidade":"Shahrud, Ir\u00e3, Shahrud","codigo":"RUD"},{"cidade":"Shakhtersk, R\u00fassia, Shakhtersk","codigo":"EKS"},{"cidade":"Shangrao, China, Sanqingshan","codigo":"SQD"},{"cidade":"Shannon, Irlanda, Shannon, Irlanda","codigo":"SNN"},{"cidade":"Shantou, China, Jieyang Chaoshan","codigo":"SWA"},{"cidade":"Shaoyang, China, Wugang","codigo":"WGN"},{"cidade":"Sharjah, Emirados \u00c1rabes Unidos","codigo":"SHJ"},{"cidade":"Sharm el Sheikh, Egito, Sharm el Sheikh International","codigo":"SSH"},{"cidade":"Sharurah, Ar\u00e1bia Saudita, Sharudah","codigo":"SHW"},{"cidade":"Shennongjia, China, Hongping","codigo":"HPG"},{"cidade":"Shenyang, China, Taoxian International","codigo":"SHE"},{"cidade":"Shenzhen, China, Bao An International","codigo":"SZX"},{"cidade":"Sheridan, Estados Unidos da Am\u00e9rica, Sheridan County","codigo":"SHR"},{"cidade":"Shetland Islands, Reino Unido, Sumburgh","codigo":"LSI"},{"cidade":"Shihezi, China, Shanhaiguan Huayuan","codigo":"SHF"},{"cidade":"Shijiazhuang, China, Zhengding International","codigo":"SJW"},{"cidade":"Shillavo, Eti\u00f3pia, Shilabo","codigo":"HIL"},{"cidade":"Shillong, \u00cdndia, Barapani","codigo":"SHL"},{"cidade":"Shimla, \u00cdndia, Shimla","codigo":"SLV"},{"cidade":"Shiquanhe, China, Ngari Gunsa Ali Kunsha","codigo":"NGQ"},{"cidade":"Shirahama, Jap\u00e3o, Nanki Shirahama","codigo":"SHM"},{"cidade":"Shiraz, Ir\u00e3, Shahid Dastghaib","codigo":"SYZ"},{"cidade":"Shirdi, \u00cdndia, Shirdi","codigo":"SAG"},{"cidade":"Shiyan, China, Wudangshan","codigo":"WDS"},{"cidade":"Shizuoka, Jap\u00e3o, Mount Fuji","codigo":"FSZ"},{"cidade":"Shonai, Jap\u00e3o, Shonai","codigo":"SYO"},{"cidade":"Shoreham By Sea, Reino Unido, Shoreham By Sea","codigo":"ESH"},{"cidade":"Shreveport, Estados Unidos da Am\u00e9rica, Shreveport","codigo":"SHV"},{"cidade":"Shymkent, Cazaquist\u00e3o, Shymkent International","codigo":"CIT"},{"cidade":"Sialkot, Paquist\u00e3o, International","codigo":"SKT"},{"cidade":"Sibiu, Rom\u00eania, Sibiu","codigo":"SBZ"},{"cidade":"Sibolga, Indon\u00e9sia, Ferdinand","codigo":"FLZ"},{"cidade":"Siborong Borong, Indon\u00e9sia, Silangit","codigo":"DTB"},{"cidade":"Sibu, Mal\u00e1sia, Sibu","codigo":"SBW"},{"cidade":"Sicogon Island, Filipinas","codigo":"ICO"},{"cidade":"Sidney, Estados Unidos da Am\u00e9rica, Richland","codigo":"SDY"},{"cidade":"Siem Reap, Camboja, Angkor International","codigo":"REP"},{"cidade":"Siena, It\u00e1lia, Ampugnano","codigo":"SAY"},{"cidade":"Sigiriya, Sri Lanka, Sigiriya","codigo":"GIU"},{"cidade":"Sihanoukville, Camboja, International","codigo":"KOS"},{"cidade":"Siirt, Turquia, Siirt","codigo":"SXZ"},{"cidade":"Silchar, \u00cdndia, Kumbhirgram","codigo":"IXS"},{"cidade":"Simao, China, Simao","codigo":"SYM"},{"cidade":"Simara, Nepal, Simara","codigo":"SIF"},{"cidade":"Simferopol, Ucr\u00e2nia, Simferopol International","codigo":"SIP"},{"cidade":"Simikot, Nepal, Simikot","codigo":"IMK"},{"cidade":"Singapore, Singapura, Changi Airport","codigo":"SIN"},{"cidade":"Singapore, Singapura, Seletar Airport","codigo":"XSP"},{"cidade":"Singkep, Indon\u00e9sia, Dabo","codigo":"SIQ"},{"cidade":"Sinop, Brasil, Joao B. Figueiredo","codigo":"OPS"},{"cidade":"Sinop, Turquia, Sinop","codigo":"NOP"},{"cidade":"Sintang, Indon\u00e9sia, Susilo","codigo":"SQG"},{"cidade":"Sion, Su\u00ed\u00e7a, Sion","codigo":"SIR"},{"cidade":"Sioux City, Estados Unidos da Am\u00e9rica, Sioux Gateway","codigo":"SUX"},{"cidade":"Sioux Falls, Estados Unidos da Am\u00e9rica, Joe Foss Field","codigo":"FSD"},{"cidade":"Sioux Lookout, Canad\u00e1, Sioux Lookout","codigo":"YXL"},{"cidade":"Sirjan, Ir\u00e3, Sirjan","codigo":"SYJ"},{"cidade":"Sirnak, Turquia, Sirnak","codigo":"NKT"},{"cidade":"Sishen, \u00c1frica do Sul, Sishen","codigo":"SIS"},{"cidade":"Siteia, Gr\u00e9cia, Siteia","codigo":"JSH"},{"cidade":"Sitka, Estados Unidos da Am\u00e9rica, Sitka Rocky Gutierrez","codigo":"SIT"},{"cidade":"Sittwe, Mianmar, Sittwe","codigo":"AKY"},{"cidade":"Sivas, Turquia, Sivas","codigo":"VAS"},{"cidade":"Skardu, Paquist\u00e3o, Skardu","codigo":"KDU"},{"cidade":"Skelleftea, Su\u00e9cia, Skelleftea","codigo":"SFT"},{"cidade":"Skiathos, Gr\u00e9cia, Alex Papadiamants","codigo":"JSI"},{"cidade":"Skopje, Maced\u00f4nia, Skopje","codigo":"SKP"},{"cidade":"Skovde, Su\u00e9cia, Skovde","codigo":"KVB"},{"cidade":"Skukuza, \u00c1frica do Sul, Skukuza","codigo":"SZK"},{"cidade":"Skyros, Gr\u00e9cia, Skyros","codigo":"SKU"},{"cidade":"Sliac, Eslov\u00e1quia, Sliac","codigo":"SLD"},{"cidade":"Sligo, Irlanda, Sligo","codigo":"SXL"},{"cidade":"Smithers, Canad\u00e1, Smithers","codigo":"YYD"},{"cidade":"S\u00f3chi, R\u00fassia, S\u00f3chi International","codigo":"AER"},{"cidade":"Socotra, I\u00eamen, Socotra","codigo":"SCT"},{"cidade":"Sofia, Bulg\u00e1ria, Sofia","codigo":"SOF"},{"cidade":"Sogndal, Noruega, Haukasen","codigo":"SOG"},{"cidade":"Sohag, Egito, International","codigo":"HMB"},{"cidade":"Sohar, Om\u00e3, Sohar","codigo":"OHS"},{"cidade":"Sokoto, Nig\u00e9ria, Sadiq Abubakar","codigo":"SKO"},{"cidade":"Solovetsky, R\u00fassia, Solovki","codigo":"CSH"},{"cidade":"Solwezi, Z\u00e2mbia, Solwezi","codigo":"SLI"},{"cidade":"Sonderborg, Dinamarca, Sonderborg","codigo":"SGD"},{"cidade":"Songea, Tanz\u00e2nia, Sonega","codigo":"SGX"},{"cidade":"Songyuan, China, Chaganhu","codigo":"YSQ"},{"cidade":"Sorkjosen, Noruega, Sorkjosen","codigo":"SOJ"},{"cidade":"Sorong, Indon\u00e9sia, Domine Eduard Osok","codigo":"SOQ"},{"cidade":"Sorriso, Brasil, Sorriso","codigo":"SMT"},{"cidade":"Southampton, Reino Unido, Southampton","codigo":"SOU"},{"cidade":"South Bend, Estados Unidos da Am\u00e9rica, South Bend","codigo":"SBN"},{"cidade":"Sovetsky, R\u00fassia, Sovetsky","codigo":"OVS"},{"cidade":"Soyo,\u00a0Angola, Soyo","codigo":"SZA"},{"cidade":"Split, Cro\u00e1cia, Split","codigo":"SPU"},{"cidade":"Spokane, Estados Unidos da Am\u00e9rica, Spokane International","codigo":"GEG"},{"cidade":"Springfield, Estados Unidos da Am\u00e9rica, Abraham Lincoln Capital","codigo":"SPI"},{"cidade":"Springfield, Estados Unidos da Am\u00e9rica, Springfield Branson","codigo":"SGF"},{"cidade":"Spring Point, Bahamas, Spring Point","codigo":"AXP"},{"cidade":"Srednekolymsk, R\u00fassia, Srednekolymsk","codigo":"SEK"},{"cidade":"Srinagar, \u00cdndia, Sheikh Ul Alam","codigo":"SXR"},{"cidade":"St. Augustine, Estados Unidos da Am\u00e9rica, Northeast Fl\u00f3rida","codigo":"UST"},{"cidade":"Stavanger, Noruega, Sola","codigo":"SVG"},{"cidade":"Stavropol, R\u00fassia, Shpakovskoye","codigo":"STW"},{"cidade":"St. Cloud, Estados Unidos da Am\u00e9rica, St. Cloud","codigo":"STC"},{"cidade":"Stella Maris, Bahamas, Stella Maris","codigo":"SML"},{"cidade":"Stephenville, Canad\u00e1, International","codigo":"YJT"},{"cidade":"St. George, Austr\u00e1lia","codigo":"SGO"},{"cidade":"St. John, Canad\u00e1, St. Johns","codigo":"YYT"},{"cidade":"St. Lewis Fox Harbour, Canad\u00e1, St. Lewis","codigo":"YFX"},{"cidade":"St. Louis, Estados Unidos da Am\u00e9rica, Lambert","codigo":"STL"},{"cidade":"St. Lucia, Santa L\u00facia, George F.L. Charles","codigo":"SLU"},{"cidade":"St. Lucia, Santa L\u00facia, Hewanorra","codigo":"UVF"},{"cidade":"St. Nazaire, Fran\u00e7a, Montoir","codigo":"SNR"},{"cidade":"Stockton, Estados Unidos da Am\u00e9rica, Metropolitano de Stockton","codigo":"SCK"},{"cidade":"Stokmarknes, Noruega, Skagen","codigo":"SKN"},{"cidade":"Stord, Noruega, Sorstokken","codigo":"SRP"},{"cidade":"Stornoway, Reino Unido, Sotornoway","codigo":"SYY"},{"cidade":"St Tropez, Fran\u00e7a, La Mole","codigo":"LTT"},{"cidade":"Stuttgart\u00a0, Alemanha, Stuttgart Airport","codigo":"STR"},{"cidade":"St. Vincent, S\u00e3o Vicente e Granadinas, Argyle","codigo":"SVD"},{"cidade":"Subic Bay, Filipinas","codigo":"SFS"},{"cidade":"Suceava, Rom\u00eania, Stefan Cel Mare","codigo":"SCV"},{"cidade":"Sucre, Bol\u00edvia, Alcantari","codigo":"SRE"},{"cidade":"Sudbury, Canad\u00e1, Sudbury","codigo":"YSB"},{"cidade":"Sue Island Warraber, Austr\u00e1lia","codigo":"SYU"},{"cidade":"Sukhothai, Tail\u00e2ndia, Sukhothai","codigo":"THS"},{"cidade":"Sukkur, Paquist\u00e3o, Sukkur","codigo":"SKZ"},{"cidade":"Suleimania, Iraque, Sulaymaniyah","codigo":"ISU"},{"cidade":"Sumenep, Indon\u00e9sia, Trunojoyo","codigo":"SUP"},{"cidade":"Sunchales, Argentina, Sunchales","codigo":"NCJ"},{"cidade":"Sun City, \u00c1frica do Sul, Pilanesberg International, -","codigo":"NTY"},{"cidade":"Sundsvall, Harnosand, Su\u00e9cia, Sundsvall Timra","codigo":"SDL"},{"cidade":"Sunshine Coast, Austr\u00e1lia, Maroochydore","codigo":"MCY"},{"cidade":"Suntar, R\u00fassia, Suntar","codigo":"SUY"},{"cidade":"Sunyani, Gana, Sunyani","codigo":"NYI"},{"cidade":"Surabaia, Indon\u00e9sia, Juanda","codigo":"SUB"},{"cidade":"Surakarta, Solo, Indon\u00e9sia, Adi Sumarmo","codigo":"SOC"},{"cidade":"Surat, \u00cdndia, Surat","codigo":"STV"},{"cidade":"Surat Thani, Tail\u00e2ndia, Surat Thani","codigo":"URT"},{"cidade":"Surgut, R\u00fassia, Surgut","codigo":"SGC"},{"cidade":"Surigao, Filipinas, Surigao","codigo":"SUG"},{"cidade":"Surkhet, Nepal, Surkhet","codigo":"SKH"},{"cidade":"Suzhou, China, Guangfu","codigo":"SZV"},{"cidade":"Sveg, Su\u00e9cia, Sveg","codigo":"EVG"},{"cidade":"Svetlaya, R\u00fassia, Svetlaya","codigo":"ETL"},{"cidade":"Svolv\u00e6r, Noruega, Helle","codigo":"SVJ"},{"cidade":"Swansea, Reino Unido, Swansea","codigo":"SWS"},{"cidade":"Sydney, Austr\u00e1lia, Kingsford Smith","codigo":"SYD"},{"cidade":"Sydney, Canad\u00e1, J.A. Douglas Mccurdy","codigo":"YQY"},{"cidade":"Syktyvkar, R\u00fassia, Syktyvkar","codigo":"SCW"},{"cidade":"Sylhet, Bangladesh, Osmani International","codigo":"ZYL"},{"cidade":"Syracuse, Estados Unidos da Am\u00e9rica, Syracuse","codigo":"SYR"},{"cidade":"Syros Island, Gr\u00e9cia, Dimitrios Vikelas","codigo":"JSY"},{"cidade":"Szczecin, Polonia, Goleniow","codigo":"SZZ"},{"cidade":"Szczytno, Polonia, Szymany","codigo":"SZY"},{"cidade":"Taba, Egito, Taba International","codigo":"TCP"},{"cidade":"Tabarka, Tun\u00edsia, Ain Drahan","codigo":"TBJ"},{"cidade":"Tabas, Ir\u00e3, Tabas","codigo":"TCX"},{"cidade":"Tabatinga, Brasil, Tabatinga","codigo":"TBT"},{"cidade":"Tablas Island, Filipinas, Tugdan","codigo":"TBH"},{"cidade":"Tabora, Tanz\u00e2nia, Tabora","codigo":"TBO"},{"cidade":"Tabriz, Ir\u00e3, Tabriz International","codigo":"TBZ"},{"cidade":"Tabuk, Ar\u00e1bia Saudita, Tabuk","codigo":"TUU"},{"cidade":"Tacheng, China, Tacheng","codigo":"TCG"},{"cidade":"Tachilek, Mianmar, Tachilek","codigo":"THL"},{"cidade":"Tacloban, Filipinas","codigo":"TAC"},{"cidade":"Tacna, Peru, Ciriani Santa Rosa","codigo":"TCQ"},{"cidade":"Taif, Ar\u00e1bia Saudita, Taif","codigo":"TIF"},{"cidade":"Taiyuan, China, Wusu International","codigo":"TYN"},{"cidade":"Taizhou, China, Luqiao","codigo":"HYN"},{"cidade":"Takamatsu, Jap\u00e3o, Takamatsu","codigo":"TAK"},{"cidade":"Takoradi, Gana, Takoradi","codigo":"TKD"},{"cidade":"Talakan, R\u00fassia, Talakan","codigo":"TLK"},{"cidade":"Talara, Peru, Victor Monteas, Arias","codigo":"TYL"},{"cidade":"Taldykorgan, Cazaquist\u00e3o, Taldykorgan","codigo":"TDK"},{"cidade":"Tallahassee, Estados Unidos da Am\u00e9rica, Tallahassee","codigo":"TLH"},{"cidade":"Tallin, Est\u00f4nia, Lennart Meri","codigo":"TLL"},{"cidade":"Tamale, Gana, Tamale, ","codigo":"TML"},{"cidade":"Tamanrasset, Arg\u00e9lia","codigo":"TMR"},{"cidade":"Tamarindo, Costa Rica, Tamarindo","codigo":"TNO"},{"cidade":"Tambolaka, Indon\u00e9sia, Waikabubak","codigo":"TMC"},{"cidade":"Tambov, R\u00fassia, Donskoye","codigo":"TBW"},{"cidade":"Tamchy, Quirguist\u00e3o, Issyk-Kul","codigo":"IKU"},{"cidade":"Tampa, Estados Unidos da Am\u00e9rica, Tampa","codigo":"TPA"},{"cidade":"Tampere, Finl\u00e2ndia, Pirkkala","codigo":"TMP"},{"cidade":"Tampico, M\u00e9xico, Francisco Javier Mina","codigo":"TAM"},{"cidade":"Tamworth, Austr\u00e1lia","codigo":"TMW"},{"cidade":"Tanahmerah, Indon\u00e9sia, Tanahmerah","codigo":"TMH"},{"cidade":"Tana Toraja, Indon\u00e9sia, Pongtiku","codigo":"TTR"},{"cidade":"Tandag, Filipinas","codigo":"TDG"},{"cidade":"Tanegashima, Jap\u00e3o, Tanegashima","codigo":"TNE"},{"cidade":"Tanga, Tanz\u00e2nia, Tanga","codigo":"TGT"},{"cidade":"Tangier, Marrocos, IBN Batouta","codigo":"TNG"},{"cidade":"Tangshan, China, Sannuhe","codigo":"TVS"},{"cidade":"Tanjung Manis, Mal\u00e1sia, Tanjung Manis","codigo":"TGC"},{"cidade":"Tanjung Pandan, Indon\u00e9sia, H.A.S. Hanandjoeddin","codigo":"TJQ"},{"cidade":"Tanjung Pinang, Indon\u00e9sia, Raja Haji Fisabilillah","codigo":"TNJ"},{"cidade":"Tanjung Redeb, Indon\u00e9sia, Kalimarau","codigo":"BEJ"},{"cidade":"Tanjung Selor, Indon\u00e9sia, Tanjung Harapan","codigo":"TJS"},{"cidade":"Tanjung Warukin, Indon\u00e9sia, Tanjung Warukin","codigo":"TJG"},{"cidade":"Tan Tan, Marrocos, Plage Blanche","codigo":"TTA"},{"cidade":"Tapachula, M\u00e9xico, Tapachula International","codigo":"TAP"},{"cidade":"Tarakan, Indon\u00e9sia, Juwatta","codigo":"TRK"},{"cidade":"Tarama, Jap\u00e3o, Tarama","codigo":"TRA"},{"cidade":"Tarapoto, Peru, G Del Castillo Paredes","codigo":"TPP"},{"cidade":"Taraz, Cazaquist\u00e3o, Taraz","codigo":"DMB"},{"cidade":"Taree, Austr\u00e1lia","codigo":"TRO"},{"cidade":"Tarija, Bol\u00edvia, Cap. Oriel Lea Plaza","codigo":"TJA"},{"cidade":"Tarin kot, Afeganist\u00e3o, Tereen","codigo":"TII"},{"cidade":"Taroom, Austr\u00e1lia","codigo":"XTO"},{"cidade":"Tartu, Est\u00f4nia, Ulenurme","codigo":"TAY"},{"cidade":"Tashkent, Uzbequist\u00e3o, Tashkent International","codigo":"TAS"},{"cidade":"Tasikmalaya, Indon\u00e9sia, Wiriadinata","codigo":"TSY"},{"cidade":"Tasiujuaq, Canad\u00e1, Tasiujuaq","codigo":"YTQ"},{"cidade":"Tawau, Mal\u00e1sia, Tawau","codigo":"TWU"},{"cidade":"Tawi Tawi Island, Filipinas, Sanga Sanga","codigo":"TWT"},{"cidade":"Tbilisi, Ge\u00f3rgia, Tblisi International","codigo":"TBS"},{"cidade":"Tebessa, Arg\u00e9lia","codigo":"TEE"},{"cidade":"Teer\u00e3, Ir\u00e3, Imam Khomeini","codigo":"IKA"},{"cidade":"Tef\u00e9, Brasil, Tef\u00e9","codigo":"TFF"},{"cidade":"Tegucigalpa, Honduras, Toncontin International","codigo":"TGU"},{"cidade":"Teixeira Freitas, Brasil, Teixeira Freitas","codigo":"TXF"},{"cidade":"Tekirdag, Turquia, Corlu","codigo":"TEQ"},{"cidade":"Tel Aviv, Israel, Ben Gurion,\u00a0","codigo":"TLV"},{"cidade":"Telfer, Austr\u00e1lia","codigo":"TEF"},{"cidade":"Telluride, Estados Unidos da Am\u00e9rica, Telluride","codigo":"TEX"},{"cidade":"Tembagapura, Timika, Indon\u00e9sia, Mozes Kilangin","codigo":"TIM"},{"cidade":"Temuco, Chile, La Araucania","codigo":"ZCO"},{"cidade":"Tenerife, Espanha , Todos Aeroportos","codigo":"TCI"},{"cidade":"Tenerife Norte, Espanha, Tenerife Norte","codigo":"TFN"},{"cidade":"Tenerife Sul, Espanha, Tenerife Sur","codigo":"TFS"},{"cidade":"Tengchong, China, Tuofeng","codigo":"TCZ"},{"cidade":"Tennant Creek, Austr\u00e1lia","codigo":"TCA"},{"cidade":"Tepic, M\u00e9xico, Amado Nervo","codigo":"TPQ"},{"cidade":"Terceira Island, Portugal, Lajes","codigo":"TER"},{"cidade":"Teresina, Brasil, Petronio Portella","codigo":"THE"},{"cidade":"Termez Uz, Uzbequist\u00e3o, Termez Uz","codigo":"TMJ"},{"cidade":"Ternate, Indon\u00e9sia, Sultan Babullah","codigo":"TTE"},{"cidade":"Terney, R\u00fassia, Terney","codigo":"NEI"},{"cidade":"Terrace, Canad\u00e1, Northwest Regional","codigo":"YXT"},{"cidade":"Tete A La Baleine, Canad\u00e1, Tete A La Baleine","codigo":"ZTB"},{"cidade":"Tete, Mo\u00e7ambique, Chingozi","codigo":"TET"},{"cidade":"Tetouan, Marrocos, Saniat R Mel","codigo":"TTU"},{"cidade":"Texarkana, Estados Unidos da Am\u00e9rica, Texarkana, Webb Field","codigo":"TXK"},{"cidade":"Tezpur, \u00cdndia, Tezpur","codigo":"TEZ"},{"cidade":"Thandwe, Mianmar, Thandwe","codigo":"SNW"},{"cidade":"Thangool, Austr\u00e1lia","codigo":"THG"},{"cidade":"Thanh Hoa, Vietn\u00e3, Tho Xuan","codigo":"THD"},{"cidade":"Thargomindah, Austr\u00e1lia","codigo":"XTG"},{"cidade":"The Bight, Bahamas, New Bight","codigo":"TBI"},{"cidade":"The Pas, Canad\u00e1, The Pas","codigo":"YQD"},{"cidade":"Thessalnik, Gr\u00e9cia, Makedonia","codigo":"SKG"},{"cidade":"Thiruvananthapuram, \u00cdndia","codigo":"TRV"},{"cidade":"Thompson, Canad\u00e1, Thompson","codigo":"YTH"},{"cidade":"Thorshofn, Isl\u00e2ndia, Thorshofn","codigo":"THO"},{"cidade":"Thunder Bay, Canad\u00e1, Thunder Bay","codigo":"YQT"},{"cidade":"Tianjin, China, Binhai International","codigo":"TSN"},{"cidade":"Tianshui, China, Maijishan","codigo":"THQ"},{"cidade":"Tiaret Bouchekif, Arg\u00e9lia","codigo":"TID"},{"cidade":"Tijuana, M\u00e9xico, Abelardo L. Rodr\u00edguez","codigo":"TIJ"},{"cidade":"Tiksi, R\u00fassia, Tiksi","codigo":"IKS"},{"cidade":"Timimoun, Arg\u00e9lia","codigo":"TMX"},{"cidade":"Timisoara, Rom\u00eania, Traian Vuia","codigo":"TSR"},{"cidade":"Timmins, Canad\u00e1, Victor M. Power","codigo":"YTS"},{"cidade":"Tindouf, Arg\u00e9lia","codigo":"TIN"},{"cidade":"Tingo Maria, Peru, Tingo Maria","codigo":"TGI"},{"cidade":"Tioman Island, Mal\u00e1sia, Tioman Island","codigo":"TOD"},{"cidade":"Tira, Gr\u00e9cia, Santorini","codigo":"JTR"},{"cidade":"Tirana, Alb\u00e2nia, Nene Tereza","codigo":"TIA"},{"cidade":"Tiree, Reino Unido, Tiree","codigo":"TRE"},{"cidade":"Tirgu Mures, Rom\u00eania, Tirgu Mures","codigo":"TGM"},{"cidade":"Tiruchchirappalli, \u00cdndia, Tiruchchirappalli","codigo":"TRZ"},{"cidade":"Tirupati, \u00cdndia, Tirupati","codigo":"TIR"},{"cidade":"Tivat, Montenegro, Tivat","codigo":"TIV"},{"cidade":"Tlemcen, Arg\u00e9lia, Zenata Messali El Hadj","codigo":"TLM"},{"cidade":"Toamasina, Madag\u00e1scar, Toamasina","codigo":"TMM"},{"cidade":"Tobago, Trinidad e Tobago, A.N.R. Robinson","codigo":"TAB"},{"cidade":"Tofino, Canad\u00e1, Long Beach","codigo":"YAZ"},{"cidade":"Tokunoshima, Jap\u00e3o, Tokunoshima","codigo":"TKN"},{"cidade":"Tokushima, Jap\u00e3o, Tokushima","codigo":"TKS"},{"cidade":"Tolanaro, Madag\u00e1scar, Marillac","codigo":"FTU"},{"cidade":"Toledo, Estados Unidos da Am\u00e9rica, Express","codigo":"TOL"},{"cidade":"Toliara, Madag\u00e1scar, Toliara","codigo":"TLE"},{"cidade":"Tolitoli, Indon\u00e9sia, Lalos","codigo":"TLI"},{"cidade":"Toluca, M\u00e9xico, Adolfo L\u00f3pez Mateos","codigo":"TLC"},{"cidade":"Tomsk, R\u00fassia, Bogashevo","codigo":"TOF"},{"cidade":"Tonghua, China, Sanyuanpu","codigo":"TNH"},{"cidade":"Tongliao, China, Tongliao","codigo":"TGO"},{"cidade":"Tongren, China, Fenhuang","codigo":"TEN"},{"cidade":"Toowoomba, Austr\u00e1lia, Brisbane West Wellcamp","codigo":"WTB"},{"cidade":"Topeka, Estados Unidos da Am\u00e9rica, Forbes Field","codigo":"FOE"},{"cidade":"T\u00f3quio, Jap\u00e3o, Narita International","codigo":"NRT"},{"cidade":"T\u00f3quio, Jap\u00e3o - Todos Aeroportos","codigo":"TYO"},{"cidade":"T\u00f3quio, Jap\u00e3o, Tokyo International Haneda","codigo":"HND"},{"cidade":"Toronto, Canad\u00e1, Billy Bishop","codigo":"YTZ"},{"cidade":"Toronto, Canad\u00e1 , Todos Aeroportos","codigo":"YTO"},{"cidade":"Toronto, Canad\u00e1, Toronto Pearson","codigo":"YYZ"},{"cidade":"Torreon, M\u00e9xico, Francisco Sarabia","codigo":"TRC"},{"cidade":"Torsby, Su\u00e9cia, Torsby Apt","codigo":"TYF"},{"cidade":"Tortuguero, Costa Rica, Torturego","codigo":"TTQ"},{"cidade":"Tottori, Jap\u00e3o, Tottori","codigo":"TTJ"},{"cidade":"Touggourt - Sidi Mahdi, Arg\u00e9lia","codigo":"TGR"},{"cidade":"Toulon, Fran\u00e7a, Hyeres","codigo":"TLN"},{"cidade":"Tours, Fran\u00e7a, Vale do Loire","codigo":"TUF"},{"cidade":"Townsville, Austr\u00e1lia, Townsville International","codigo":"TSV"},{"cidade":"Toyama, Jap\u00e3o, Toyama","codigo":"TOY"},{"cidade":"Toyooka, Jap\u00e3o, Tajima","codigo":"TJH"},{"cidade":"Tozeur, Tun\u00edsia, Nefta","codigo":"TOE"},{"cidade":"Trabzon, Turquia, Trabzon","codigo":"TZX"},{"cidade":"Trail, Canad\u00e1, Trail","codigo":"YZZ"},{"cidade":"Trang, Tail\u00e2ndia, Trang","codigo":"TST"},{"cidade":"Trapani, It\u00e1lia, Birgi","codigo":"TPS"},{"cidade":"Trashigang, But\u00e3o, Yonphula","codigo":"YON"},{"cidade":"Trat, Tail\u00e2ndia, Trat Airport","codigo":"TDX"},{"cidade":"Traverse City, Estados Unidos da Am\u00e9rica, Cherry Capital","codigo":"TVC"},{"cidade":"Treasure Cay, Bahamas, Treasure Cay","codigo":"TCB"},{"cidade":"Trelew, Argentina, Almirante M.A.Zar","codigo":"REL"},{"cidade":"Trenton, Estados Unidos da Am\u00e9rica, Trenton-Mercer","codigo":"TTN"},{"cidade":"Trepell, Austr\u00e1lia","codigo":"TQP"},{"cidade":"Tri Cities, Estados Unidos da Am\u00e9rica, Tri Cities Regional","codigo":"TRI"},{"cidade":"Trieste, It\u00e1lia, Ronchi Dei Legionari","codigo":"TRS"},{"cidade":"Trincomalee, Sri Lanka, China Bay","codigo":"TRR"},{"cidade":"Trinidad, Bol\u00edvia, Jorge Henrich Arauz","codigo":"TDD"},{"cidade":"Tripoli, L\u00edbia","codigo":"TIP"},{"cidade":"Trollhattan, Vanersborg, Su\u00e9cia, Trollhattan","codigo":"THN"},{"cidade":"Tromso, Noruega, langnes","codigo":"TOS"},{"cidade":"Trondheim, Noruega, Vaernes","codigo":"TRD"},{"cidade":"Trujillo, Peru, C. Martinez de Pinillos","codigo":"TRU"},{"cidade":"Tsushima, Jap\u00e3o, Tsushima","codigo":"TSJ"},{"cidade":"Tucson, Estados Unidos da Am\u00e9rica, Tucson","codigo":"TUS"},{"cidade":"Tucum\u00e3, Argentina, Benjamin Matienzo","codigo":"TUC"},{"cidade":"Tucupita, Venezuela, San Rafael","codigo":"TUV"},{"cidade":"Tuguegarao, Filipinas","codigo":"TUG"},{"cidade":"Tulcea, Rom\u00eania, Delta Dunarii","codigo":"TCE"},{"cidade":"Tulsa, Estados Unidos da Am\u00e9rica, Tulsa International","codigo":"TUL"},{"cidade":"Tumaco, Col\u00f4mbia,La Florida","codigo":"TCO"},{"cidade":"Tumbes, Peru, Pedro Canga Rodrigues","codigo":"TBP"},{"cidade":"Tumlingtar, Nepal, Tumlingtar","codigo":"TMI"},{"cidade":"Tumushuke, China, Tangwangcheng","codigo":"TWC"},{"cidade":"Tunes, Tun\u00edsia, Carthage","codigo":"TUN"},{"cidade":"Tupelo, Estados Unidos da Am\u00e9rica, Tupelo","codigo":"TUP"},{"cidade":"Turaif, Ar\u00e1bia Saudita, Turaif","codigo":"TUI"},{"cidade":"Turbat, Paquist\u00e3o, International","codigo":"TUK"},{"cidade":"Turim, It\u00e1lia, Caselle","codigo":"TRN"},{"cidade":"Turkmenabat, Turcomenist\u00e3o, Turkmenabat","codigo":"CRZ"},{"cidade":"Turkmenbashi, Turcomenist\u00e3o, Turkmenbashi","codigo":"KRW"},{"cidade":"Turku, Finl\u00e2ndia, Turku","codigo":"TKU"},{"cidade":"Turpan, China, Jiaohe","codigo":"TLQ"},{"cidade":"Turukhansk, R\u00fassia, Turukhansk","codigo":"THX"},{"cidade":"Tuticorin, \u00cdndia, Tuticorin","codigo":"TCR"},{"cidade":"Tuxtla Gutierrez, M\u00e9xico, Angel Albino Corzo","codigo":"TGZ"},{"cidade":"Tuy Hoa, Vietn\u00e3, Dong Tac","codigo":"TBB"},{"cidade":"Tuzla, B\u00f3snia e Herzegovina, Tuzla International","codigo":"TZL"},{"cidade":"Twin Falls, Estados Unidos da Am\u00e9rica, Magic Valley Regional","codigo":"TWF"},{"cidade":"Tyler, Estados Unidos da Am\u00e9rica, Pounds Regional","codigo":"TYR"},{"cidade":"Tynda, R\u00fassia, Tynda","codigo":"TYD"},{"cidade":"Tyumen, R\u00fassia, Roshchino","codigo":"TJM"},{"cidade":"Ube, Jap\u00e3o, Yamaguchi Ube","codigo":"UBJ"},{"cidade":"Uberaba, Brasil, M. de Alemeida Franco","codigo":"UBA"},{"cidade":"Uberl\u00e2ndia, Brasil, Cesar Bombonato","codigo":"UDI"},{"cidade":"Ubon Ratchathani, Tail\u00e2ndia, Ubon Ratchathani","codigo":"UBP"},{"cidade":"Udaipur, \u00cdndia, Maharana Pratap","codigo":"UDR"},{"cidade":"Udon Thani, Tail\u00e2ndia, Udon Thani","codigo":"UTH"},{"cidade":"Ufa, R\u00fassia, Ufa","codigo":"UFA"},{"cidade":"Ukhta, R\u00fassia, Ukhta","codigo":"UCT"},{"cidade":"Ukunda, Qu\u00eania, Diane","codigo":"UKA"},{"cidade":"Ulaanbaatar, Mong\u00f3lia, Chinggis Khaan International","codigo":"ULN"},{"cidade":"Ulaangom, Mong\u00f3lia, Ulaangom","codigo":"ULO"},{"cidade":"Ulanhot, China, Ulanhot","codigo":"HLH"},{"cidade":"Ulanqab Jining, China, Ulanqab","codigo":"UCB"},{"cidade":"Ulan Ude, R\u00fassia, Mukhino","codigo":"UUD"},{"cidade":"Uliastai, Mong\u00f3lia, Donoi","codigo":"ULZ"},{"cidade":"Ulsan, Cor\u00e9ia do Sul","codigo":"USN"},{"cidade":"Ulukhaktok, Canad\u00e1, Ulukhaktok","codigo":"YHI"},{"cidade":"Ulusaba, \u00c1frica do Sul, Ulusaba","codigo":"ULX"},{"cidade":"Ulyanovsk, R\u00fassia, Baratayevka","codigo":"ULV"},{"cidade":"Ulyanovsk, R\u00fassia, Vostochny","codigo":"ULY"},{"cidade":"Umea, Su\u00e9cia, Umea","codigo":"UME"},{"cidade":"Umiujaq, Canad\u00e1, Umiujaq","codigo":"YUD"},{"cidade":"Umtata, \u00c1frica do Sul, K.D Matanzima","codigo":"UTT"},{"cidade":"Upington, \u00c1frica do Sul, Upington Municipal","codigo":"UTN"},{"cidade":"Uralsk, Cazaquist\u00e3o, Ak Zhol","codigo":"URA"},{"cidade":"Uray, R\u00fassia, Uray","codigo":"URJ"},{"cidade":"Urdzhar, Cazaquist\u00e3o, Urdzhar","codigo":"UZR"},{"cidade":"Urgench, Uzbequist\u00e3o, Intenational","codigo":"UGC"},{"cidade":"Urmieh, Ir\u00e3, Urimieh","codigo":"OMH"},{"cidade":"Uruapan, M\u00e9xico, Inacio Lopez Rayon","codigo":"UPN"},{"cidade":"Uruguaiana, Brasil, Rubem Berta","codigo":"URG"},{"cidade":"Urumqi, China, Diwopu International","codigo":"URC"},{"cidade":"Usak, Turquia, Usak","codigo":"USQ"},{"cidade":"Usharal, Cazaquist\u00e3o, Usharal","codigo":"USJ"},{"cidade":"Ushuaia, Argentina, Malvinas Argentinas","codigo":"USH"},{"cidade":"Usinsk, R\u00fassia, Usinsk","codigo":"USK"},{"cidade":"Ust-Kamenogorsk, Cazaquist\u00e3o","codigo":"UKK"},{"cidade":"Ust Kut, R\u00fassia, Ust Kut","codigo":"UKX"},{"cidade":"Ust Kuyga, R\u00fassia, Ust Kuyga","codigo":"UKG"},{"cidade":"Ust-Maya, R\u00fassia, Ust-Maya","codigo":"UMS"},{"cidade":"Ust Nera, R\u00fassia, Ust Nera","codigo":"USR"},{"cidade":"Ust Tsilma, R\u00fassia, Ust Tsilma","codigo":"UTS"},{"cidade":"U tapao, Tail\u00e2ndia, Rayong Pattaya","codigo":"UTP"},{"cidade":"Utarom, Indon\u00e9sia, Kaimana","codigo":"KNG"},{"cidade":"Utila, Honduras, Utila","codigo":"UII"},{"cidade":"Uyo, Nig\u00e9ria, Akwa Ibom International","codigo":"QUO"},{"cidade":"Uyuni, Bol\u00edvia, Uyuni","codigo":"UYU"},{"cidade":"Uzhhorod, Ucr\u00e2nia, Uzhhorod International","codigo":"UDJ"},{"cidade":"Vaasa, Finl\u00e2ndia, Vaasa","codigo":"VAA"},{"cidade":"Vadodara, \u00cdndia, Vadodara","codigo":"BDQ"},{"cidade":"Vadso, Noruega, Vadso","codigo":"VDS"},{"cidade":"Valdez, Estados Unidos da Am\u00e9rica, Pioneer Field","codigo":"VDZ"},{"cidade":"Valdivia, Chile, Pichoy","codigo":"ZAL"},{"cidade":"Val dOr, Canad\u00e1, Val dOr","codigo":"YVO"},{"cidade":"Valdosta, Estados Unidos da Am\u00e9rica, Valdosta","codigo":"VLD"},{"cidade":"Valen\u00e7a, Brasil, Valen\u00e7a","codigo":"VAL"},{"cidade":"Val\u00eancia, Espanha, Valencia Airport","codigo":"VLC"},{"cidade":"Valencia, Venezuela, Arturo Michelena","codigo":"VLN"},{"cidade":"Valera Carvajal, Venezuela, Antonio N Briceno","codigo":"VLV"},{"cidade":"Valladolid, Espanha, Valladolid Airport","codigo":"VLL"},{"cidade":"Valledupar, Col\u00f4mbia,Alfonso L\u00f3pez Pumarejo","codigo":"VUP"},{"cidade":"Valparaiso, Estados Unidos da Am\u00e9rica, Destin Ft Walton Beach","codigo":"VPS"},{"cidade":"Valverde, Espanha, El Hierro","codigo":"VDE"},{"cidade":"Vancouver, Canad\u00e1, de Vancouver","codigo":"YVR"},{"cidade":"Van, Turquia, Ferit Melen","codigo":"VAN"},{"cidade":"Varadero, Cuba, Juan G. Gomez","codigo":"VRA"},{"cidade":"Varanasi, \u00cdndia, Lal Badahur, Shastri","codigo":"VNS"},{"cidade":"Vardoe, Noruega, Svartnes","codigo":"VAW"},{"cidade":"Varginha, Brasil, Maj. Brig. Trompowsky","codigo":"VAG"},{"cidade":"Varna, Bulg\u00e1ria, Varna","codigo":"VAR"},{"cidade":"Vars\u00f3via, Polonia, Frederic Chopin","codigo":"WAW"},{"cidade":"Vaxjo, Su\u00e9cia, Smaland","codigo":"VXO"},{"cidade":"Veliky Ustyug, R\u00fassia, Veliky Ustyug","codigo":"VUS"},{"cidade":"Veneza, It\u00e1lia, Marco Polo","codigo":"VCE"},{"cidade":"Veracruz, M\u00e9xico, Heriberto Jara","codigo":"VER"},{"cidade":"Verkhnevilyuysk, R\u00fassia, Verkhnevilyuysk","codigo":"VHV"},{"cidade":"Verona, It\u00e1lia, Villafranca","codigo":"VRN"},{"cidade":"Vestmannaeyjar, Isl\u00e2ndia, Vestmannaeyjar","codigo":"VEY"},{"cidade":"Victoria, Canad\u00e1, Victoria","codigo":"YYJ"},{"cidade":"Victoria, Estados Unidos da Am\u00e9rica, Victoria Regional","codigo":"VCT"},{"cidade":"Victoria Falls, Zimb\u00e1bue, International","codigo":"VFA"},{"cidade":"Victorville, Estados Unidos da Am\u00e9rica, Log\u00edstico da Calif\u00f3rnia do Sul","codigo":"VCV"},{"cidade":"Vidyanagar, \u00cdndia, Jindal","codigo":"VDY"},{"cidade":"Viedma, Argentina, Gobernador E. Castello","codigo":"VDM"},{"cidade":"Viena, \u00c1ustria, Vienna International","codigo":"VIE"},{"cidade":"Vientiane, Laos, Wattay International","codigo":"VTE"},{"cidade":"Vieques, Porto Rico, Antonio Rivera Rodr\u00edguez","codigo":"VQS"},{"cidade":"Vigo, Espanha, Vigo Airport","codigo":"VGO"},{"cidade":"Vijayawada, \u00cdndia, Vijayawada","codigo":"VGA"},{"cidade":"Vilanculos, Mo\u00e7ambique, Vilankulos","codigo":"VNX"},{"cidade":"Vila Real, Portugal, Vila Real","codigo":"VRL"},{"cidade":"Vilhelmina, Su\u00e9cia, Vilhelmina","codigo":"VHM"},{"cidade":"Vilhena, Brasil, Brigadeiro Camarao","codigo":"BVH"},{"cidade":"Villahermosa, M\u00e9xico, Carlos Rovirosa P\u00e9rez","codigo":"VSA"},{"cidade":"Villavicencio, Col\u00f4mbia,Vanguardia","codigo":"VVC"},{"cidade":"Vilnius, Litu\u00e2nia, Vilnius International","codigo":"VNO"},{"cidade":"Vilyuysk, R\u00fassia, Vilyuysk","codigo":"VYI"},{"cidade":"Vineyard Haven, Estados Unidos da Am\u00e9rica, Marthas Vineyard","codigo":"MVY"},{"cidade":"Vinh City, Vietn\u00e3, Vinh","codigo":"VII"},{"cidade":"Vinnitsa, Ucr\u00e2nia, Gavryshivka","codigo":"VIN"},{"cidade":"Vipingo, Qu\u00eania, Vipingo","codigo":"VPG"},{"cidade":"Virac, Filipinas","codigo":"VRC"},{"cidade":"Visby, Su\u00e9cia, Visby","codigo":"VBY"},{"cidade":"Viseu, Portugal, Viseu","codigo":"VSE"},{"cidade":"Vishakhapatnam, \u00cdndia, Vishakhapatnam","codigo":"VTZ"},{"cidade":"Vitebsk, Bielor\u00fassia, Vitebsk","codigo":"VTB"},{"cidade":"Vit\u00f3ria da Conquista, Brasil, Glauber Rocha","codigo":"VDC"},{"cidade":"Vit\u00f3ria do Esp\u00edrito Santo, Brasil, Eurico de Aguiar Salles","codigo":"VIX"},{"cidade":"Vit\u00f3ria, Espanha, Vitoria","codigo":"VIT"},{"cidade":"Vladikavkaz, R\u00fassia, Beslan","codigo":"OGZ"},{"cidade":"Vladivostok, R\u00fassia, Knevichi","codigo":"VVO"},{"cidade":"Volgograd, R\u00fassia, Gumrak","codigo":"VOG"},{"cidade":"Volos, Gr\u00e9cia, Nea Aghialos","codigo":"VOL"},{"cidade":"Vopnafjordur, Isl\u00e2ndia, Vestmannaeyjar","codigo":"VPN"},{"cidade":"Vorkuta, R\u00fassia, Vorkuta","codigo":"VKT"},{"cidade":"Voronezh, R\u00fassia, Chertovitskoye","codigo":"VOZ"},{"cidade":"Wabush, Canad\u00e1, Wabush","codigo":"YWK"},{"cidade":"Waco, Estados Unidos da Am\u00e9rica, Waco International","codigo":"ACT"},{"cidade":"Wadi al Dawaser, Ar\u00e1bia Saudita","codigo":"WAE"},{"cidade":"Wadi Halfa, Sud\u00e3o, Wadi Halfa","codigo":"WHF"},{"cidade":"Wagga Wagga, Austr\u00e1lia","codigo":"WGA"},{"cidade":"Waingapu, Indon\u00e9sia","codigo":"WGP"},{"cidade":"Wajima, Jap\u00e3o, Noto Airport","codigo":"NTQ"},{"cidade":"Wajir, Qu\u00eania, Wajir","codigo":"WJR"},{"cidade":"Wakkanai, Jap\u00e3o, Wakkanai","codigo":"WKJ"},{"cidade":"Walla Walla, Estados Unidos da Am\u00e9rica, Walla Walla Regional","codigo":"ALW"},{"cidade":"Walvis Bay, Nam\u00edbia, Walvis Bay","codigo":"WVB"},{"cidade":"Wamena, Indon\u00e9sia, Wamena","codigo":"WMX"},{"cidade":"Wangerooge, Alemanha, Wangerooge","codigo":"AGE"},{"cidade":"Wanzhou, China, Wuqiao","codigo":"WXN"},{"cidade":"Warri, Nig\u00e9ria, Osubi","codigo":"QRW"},{"cidade":"Warrnambool, Austr\u00e1lia","codigo":"WMB"},{"cidade":"Washington, Estados Unidos da Am\u00e9rica, Dulles International","codigo":"IAD"},{"cidade":"Washington, Estados Unidos da Am\u00e9rica, Ronald Reagan","codigo":"DCA"},{"cidade":"Washington, Estados Unidos da Am\u00e9rica - Todos Aeroportos","codigo":"WAS"},{"cidade":"Waskaganish, Canad\u00e1, Waskaganish","codigo":"YKQ"},{"cidade":"Waterloo, Estados Unidos da Am\u00e9rica, Waterloo","codigo":"ALO"},{"cidade":"Wedjh, Ar\u00e1bia Saudita, Wedjh","codigo":"EJH"},{"cidade":"Weerawila, Sri Lanka, Weerawila","codigo":"WRZ"},{"cidade":"Weifang, China, Weifang","codigo":"WEF"},{"cidade":"Weihai, China, Dashhuibo","codigo":"WEH"},{"cidade":"Weipa, Austr\u00e1lia","codigo":"WEI"},{"cidade":"Wemindji, Canad\u00e1, Wemindji","codigo":"YNC"},{"cidade":"Wenatchee, Estados Unidos da Am\u00e9rica, Pangborn Memorial","codigo":"EAT"},{"cidade":"Wenshan, China, Puzhehei","codigo":"WNH"},{"cidade":"Wenzhou, China, Yongqiang","codigo":"WNZ"},{"cidade":"Westerland, Alemanha, Sylt","codigo":"GWT"},{"cidade":"West Palm Beach, Estados Unidos da Am\u00e9rica, Palm Beach","codigo":"PBI"},{"cidade":"Westray, Reino Unido, Westray","codigo":"WRY"},{"cidade":"Whale Cove, Canad\u00e1, Whale Cove","codigo":"YXN"},{"cidade":"Whati, Canad\u00e1, Whati","codigo":"YLE"},{"cidade":"Whitehorse, Canad\u00e1, Erik Nielsein","codigo":"YXY"},{"cidade":"White Plains, Estados Unidos da Am\u00e9rica, Westchester County Airport","codigo":"HPN"},{"cidade":"Whyalla, Austr\u00e1lia","codigo":"WYA"},{"cidade":"Wichita, Estados Unidos da Am\u00e9rica, Mid-Continent","codigo":"ICT"},{"cidade":"Wichita Falls, Estados Unidos da Am\u00e9rica, Municipal Sheppard","codigo":"SPS"},{"cidade":"Wick, Reino Unido, Wick","codigo":"WIC"},{"cidade":"Wilkes Barre\u00a0Scranton, Estados Unidos da Am\u00e9rica, Wilkes Barre Scranton International","codigo":"AVP"},{"cidade":"Williams Harbour, Canad\u00e1,\u00a0Williams Harbour","codigo":"YWM"},{"cidade":"Williams Lake, Canad\u00e1, Williams Lake","codigo":"YWL"},{"cidade":"Williamsport, Estados Unidos da Am\u00e9rica, Williamsport Regional","codigo":"IPT"},{"cidade":"Williston, Estados Unidos da Am\u00e9rica, Sloulin Field","codigo":"ISN"},{"cidade":"Wilmington, Estados Unidos da Am\u00e9rica, Wilmington","codigo":"ILM"},{"cidade":"Wiluna, Austr\u00e1lia","codigo":"WUN"},{"cidade":"Windhoek, Nam\u00edbia, Eros","codigo":"ERS"},{"cidade":"Windhoek, Nam\u00edbia, Hosea Kutako","codigo":"WDH"},{"cidade":"Windorah, Austr\u00e1lia","codigo":"WNR"},{"cidade":"Windsor, Canad\u00e1, Windsor","codigo":"YQG"},{"cidade":"Windsor Locks, Estados Unidos da Am\u00e9rica, Bradley","codigo":"BDL"},{"cidade":"Winnipeg, Canad\u00e1, J A Richardson","codigo":"YWG"},{"cidade":"Winnipeg, Canad\u00e1, Winnipeg","codigo":"YWG"},{"cidade":"Winton, Austr\u00e1lia","codigo":"WIN"},{"cidade":"Wollaston Lake, Canad\u00e1, Wollaston Lake","codigo":"ZWL"},{"cidade":"Wollongong, Austr\u00e1lia, Illawarra","codigo":"WOL"},{"cidade":"Wonju, Cor\u00e9ia do Sul","codigo":"WJU"},{"cidade":"Worcester, Estados Unidos da Am\u00e9rica, Worcester","codigo":"ORH"},{"cidade":"Wrangell, Estados Unidos da Am\u00e9rica, Wrangell","codigo":"WRG"},{"cidade":"Wroclaw, Polonia, Nicolaus Copernicus","codigo":"WRO"},{"cidade":"Wrotham Park, Austr\u00e1lia","codigo":"WPK"},{"cidade":"Wudalianchi, China, Dedu","codigo":"DTU"},{"cidade":"Wuhai, China, Wuhai","codigo":"WUA"},{"cidade":"Wuhan, China, Tianhe International","codigo":"WUH"},{"cidade":"W\u00fcrzburg\u00a0, Alemanha","codigo":"QWU"},{"cidade":"Wushan, China, Chongqing","codigo":"WSK"},{"cidade":"Wuxi, China, Sunan Shuofang","codigo":"WUX"},{"cidade":"Wuyishan, China, Wuyishan","codigo":"WUS"},{"cidade":"Wuzhou, China, Xijiang","codigo":"WUZ"},{"cidade":"Xalapa, M\u00e9xico, El Lencero","codigo":"JAL"},{"cidade":"Xangai, Shangai, China, Pudong International","codigo":"PVG"},{"cidade":"Xangai, Shangai, China , Todos Aeroportos","codigo":"SHA"},{"cidade":"Xiahe, China, Gannan Xiahe","codigo":"GXH"},{"cidade":"Xiamen, China, Gaoqi International","codigo":"XMN"},{"cidade":"Xi An, China, Xianyang International","codigo":"SIA"},{"cidade":"Xi An, China, Xianyang International","codigo":"XIY"},{"cidade":"Xiangyang, China, Liuji","codigo":"XFN"},{"cidade":"Xichang, China, Qingshan","codigo":"XIC"},{"cidade":"Xigaze Rikaze, China, Peace","codigo":"RKZ"},{"cidade":"Xilinhot, China, Xilinhot","codigo":"XIL"},{"cidade":"Xingyi, China, Xingyi","codigo":"ACX"},{"cidade":"Xining, China, Caojiabao","codigo":"XNN"},{"cidade":"Xinjiang, China, Nalati","codigo":"NLT"},{"cidade":"Xinyang, China, Minggang","codigo":"XAI"},{"cidade":"Xinzhou, China, Xinzhou Wutaishan","codigo":"WUT"},{"cidade":"Xuzhou, China, Guanyin","codigo":"XUZ"},{"cidade":"Yacuiba, Bol\u00edvia, Yacuiba","codigo":"BYC"},{"cidade":"Yahukimo, Indon\u00e9sia, Nop Goliath","codigo":"DEX"},{"cidade":"Yakima, Estados Unidos da Am\u00e9rica, Yakima Air Terminal","codigo":"YKM"},{"cidade":"Yakutat, Estados Unidos da Am\u00e9rica, Yakutat","codigo":"YAK"},{"cidade":"Yakutsk, R\u00fassia, Yakutsk","codigo":"YKS"},{"cidade":"Yamagata Junmachi, Jap\u00e3o, Yamagata","codigo":"GAJ"},{"cidade":"Yam Island, Austr\u00e1lia","codigo":"XMY"},{"cidade":"Yan An, China, Nanniwan","codigo":"ENY"},{"cidade":"Yanbu, Ar\u00e1bia Saudita, Yanbu Al Bahr","codigo":"YNB"},{"cidade":"Yancheng, China, NANYANG","codigo":"YNZ"},{"cidade":"Yangon, Mianmar, Mingaladon","codigo":"RGN"},{"cidade":"Yangyang, Cor\u00e9ia do Sul","codigo":"YNY"},{"cidade":"Yangzhou, China, Taizhou","codigo":"YTY"},{"cidade":"Yanji, China, Jiangbei International","codigo":"YNJ"},{"cidade":"Yantai Laishan, China, Penglai International","codigo":"YNT"},{"cidade":"Yaounde, Camar\u00f5es, Nsimalen International","codigo":"NSI"},{"cidade":"Yaroslavl, R\u00fassia, Tunoshna","codigo":"IAR"},{"cidade":"Yasouj, Ir\u00e3, Yasouj","codigo":"YES"},{"cidade":"Yazd, Ir\u00e3, Shahid Sadooghbi","codigo":"AZD"},{"cidade":"Yedinka, R\u00fassia, Yedinka","codigo":"EDN"},{"cidade":"Yellowknife, Canad\u00e1, Yellowknife","codigo":"YZF"},{"cidade":"Yeosu, Suncheon, Cor\u00e9ia do Sul","codigo":"RSU"},{"cidade":"Yerbogachen, R\u00fassia, Yerbogachen","codigo":"ERG"},{"cidade":"Yibin, China, Caiba","codigo":"YBP"},{"cidade":"Yichang, China, Sanxia","codigo":"YIH"},{"cidade":"Yichun, China, Mingyueshan","codigo":"YIC"},{"cidade":"Yichun Heilongjiang, China, Lindu","codigo":"LDS"},{"cidade":"Yinchuan, China, Hedong","codigo":"INC"},{"cidade":"Yingkou, China, Yingkou","codigo":"YKH"},{"cidade":"Yining, China, Yining","codigo":"YIN"},{"cidade":"Yiwu, China, Yiwu","codigo":"YIW"},{"cidade":"Yogyakarta, Indon\u00e9sia, Adisutjipt","codigo":"JOG"},{"cidade":"Yola, Nig\u00e9ria, Yola","codigo":"YOL"},{"cidade":"Yonago, Jap\u00e3o, Miho","codigo":"YGJ"},{"cidade":"Yonaguni, Jap\u00e3o, Yonaguni","codigo":"OGN"},{"cidade":"Yongzhou, China, Lingling","codigo":"LLF"},{"cidade":"Yopal, Col\u00f4mbia,El Alcaravan","codigo":"EYP"},{"cidade":"Yorke Islands, Austr\u00e1lia","codigo":"OKR"},{"cidade":"Yoron-Jima, Jap\u00e3o, Yoron","codigo":"RNJ"},{"cidade":"Yoshkar Ola, R\u00fassia, Yoshkar Ola","codigo":"JOK"},{"cidade":"Yueyang, China, Sanhe","codigo":"YYA"},{"cidade":"Yukushima, Jap\u00e3o, Yukushima","codigo":"KUM"},{"cidade":"Yulin, China, Yuang","codigo":"UYN"},{"cidade":"Yuma, Estados Unidos da Am\u00e9rica, Yuma\u00a0, \u00a0MCAS Yuma","codigo":"YUM"},{"cidade":"Yuncheng, China","codigo":"YCU"},{"cidade":"Yushu, China, Batang","codigo":"YUS"},{"cidade":"Yuzhno Kurilsk, R\u00fassia, Mendeleevo","codigo":"DEE"},{"cidade":"Yuzhno Sakhalinsk, R\u00fassia","codigo":"UUS"},{"cidade":"Zabol, Ir\u00e3, Zabol Airport","codigo":"ACZ"},{"cidade":"Zacatecas, M\u00e9xico, Leobardo C. Ruiz","codigo":"ZCL"},{"cidade":"Zadar, Cro\u00e1cia, Zadar","codigo":"ZAD"},{"cidade":"Zagreb, Cro\u00e1cia, Franjo Tudman","codigo":"ZAG"},{"cidade":"Zahedan, Ir\u00e3, Zahedan","codigo":"ZAH"},{"cidade":"Zakynthos, Gr\u00e9cia, Zakynthos","codigo":"ZTH"},{"cidade":"Zamboanga, Filipinas","codigo":"ZAM"},{"cidade":"Zanjan, Ir\u00e3, Zanjan","codigo":"JWN"},{"cidade":"Zanzibar, Tanz\u00e2nia, Zanzibar International","codigo":"ZNZ"},{"cidade":"Zaporizhia, Ucr\u00e2nia, Mokraya International","codigo":"OZH"},{"cidade":"Zaranj, Afeganist\u00e3o, Zaranj","codigo":"ZAJ"},{"cidade":"Zaysan, Cazaquist\u00e3o, Zaysan","codigo":"SZI"},{"cidade":"Zhalantun, China, Chengjisihan","codigo":"NZL"},{"cidade":"Zhangjiajie, China, Hehua","codigo":"DYG"},{"cidade":"Zhangjiakou, China, Zhangjiakou","codigo":"ZQZ"},{"cidade":"Zhangye, China, Ganzhou","codigo":"YZY"},{"cidade":"Zhanjiang, China, Zhanjiang","codigo":"ZHA"},{"cidade":"Zhaotong, China, Zhaotong","codigo":"ZAT"},{"cidade":"Zhengzhou, China, Shagjie Airport","codigo":"HSJ"},{"cidade":"Zhengzhou, China, Xinzheng Internatioal","codigo":"CGO"},{"cidade":"Zhezkazgan, Cazaquist\u00e3o, Zhezkazgan","codigo":"DZN"},{"cidade":"Zhigansk, R\u00fassia, Zhigansk","codigo":"ZIX"},{"cidade":"Zhijiang, China, Zhijiang","codigo":"HJJ"},{"cidade":"Zhob, Paquist\u00e3o, Zhob","codigo":"PZH"},{"cidade":"Zhongwei, China, Xiangshan","codigo":"ZHY"},{"cidade":"Zhoushan, China, Putuoshan","codigo":"HSN"},{"cidade":"Zhuhai, China, Sanzao International","codigo":"ZUH"},{"cidade":"Zielona Gora, Polonia, Babimost","codigo":"IEG"},{"cidade":"Ziguinchor, Senegal, Ziguinchor","codigo":"ZIG"},{"cidade":"Zinder, N\u00edger, Zinder","codigo":"ZND"},{"cidade":"Zonguldak, Turquia, Caycuma","codigo":"ONQ"},{"cidade":"Zouerate, Maurit\u00e2nia, Tazadit","codigo":"OUZ"},{"cidade":"Zunyi, China, Maotai","codigo":"WMT"},{"cidade":"Zunyi, China, Maotai Airport","codigo":"WMT"},{"cidade":"Zurique, Su\u00ed\u00e7a, Zurich Airport","codigo":"ZRH"},{"cidade":"Zyryanka, R\u00fassia, Zyryanka","codigo":"ZKP"}]', true);
}  


add_action( 'wp_ajax_get_companhias', 'get_companhias' );
add_action( 'wp_ajax_nopriv_get_companhias', 'get_companhias' );
function get_companhias(){

	echo '[{"nome_companhia":"S7 Airlines","cod_companhia":"S7","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/S7.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/S7.png"},{"nome_companhia":"JetStar Asia","cod_companhia":"3K","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/3K.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/3K.png"},{"nome_companhia":"Saudia","cod_companhia":"SV","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SV.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SV.png"},{"nome_companhia":"Air Burkina","cod_companhia":"2J","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/2J.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo13.png"},{"nome_companhia":"Air Philippines","cod_companhia":"2P","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/3P.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo32.png"},{"nome_companhia":"Passaredo","cod_companhia":"2Z","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/2Z.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo77.png"},{"nome_companhia":"Cebu Pacific","cod_companhia":"5J","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/5J.png","img_maior_companhia":""},{"nome_companhia":"Israir","cod_companhia":"6H","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/6H.png","img_maior_companhia":""},{"nome_companhia":"Air Mandalay","cod_companhia":"6T","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/6T.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo28.png"},{"nome_companhia":"Tajikistan Airlines","cod_companhia":"7J","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/7J.png","img_maior_companhia":""},{"nome_companhia":"Myanmar Airways","cod_companhia":"8M","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/8M.png","img_maior_companhia":""},{"nome_companhia":"Aegean Airlines","cod_companhia":"A3","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/A3.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo2.png"},{"nome_companhia":"American Airlines","cod_companhia":"AA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo47.png"},{"nome_companhia":"Air Canada","cod_companhia":"AC","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AC.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo16.png"},{"nome_companhia":"Azul","cod_companhia":"AD","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AD.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo51.png"},{"nome_companhia":"Air France","cod_companhia":"AF","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AF.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo21.png"},{"nome_companhia":"Air Algerie","cod_companhia":"AH","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AH.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo11.png"},{"nome_companhia":"Air India","cod_companhia":"AI","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AI.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo23.png"},{"nome_companhia":"Aerom\u00e9xico","cod_companhia":"AM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/5D.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo8.png"},{"nome_companhia":"Aerolineas Argentinas","cod_companhia":"AR","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190607\/flights\/airlines_square\/AR.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo4.png"},{"nome_companhia":"Alaska Airlines","cod_companhia":"AS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AS.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo43.png"},{"nome_companhia":"Royal Air Maroc","cod_companhia":"AT","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AT.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo81.png"},{"nome_companhia":"Avianca","cod_companhia":"AV","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/O6.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/O6.png"},{"nome_companhia":"Africa","cod_companhia":"AW","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AW.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AW.png"},{"nome_companhia":"Finnair","cod_companhia":"AY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AY.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo64.png"},{"nome_companhia":"Alitalia","cod_companhia":"AZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/AZ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo44.png"},{"nome_companhia":"Jetblue","cod_companhia":"B6","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/B6.png","img_maior_companhia":""},{"nome_companhia":"Eritrean Airlines","cod_companhia":"B8","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/B8.png","img_maior_companhia":""},{"nome_companhia":"British Airways","cod_companhia":"BA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo53.png"},{"nome_companhia":"Flybe","cod_companhia":"BE","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BE.png","img_maior_companhia":""},{"nome_companhia":"Royal Brunei","cod_companhia":"BI","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BI.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo82.png"},{"nome_companhia":"Nouvelair","cod_companhia":"BJ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BJ.png","img_maior_companhia":""},{"nome_companhia":"Pacific Airlines","cod_companhia":"BL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/3F.png","img_maior_companhia":""},{"nome_companhia":"Air Botswana","cod_companhia":"BP","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BP.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo12.png"},{"nome_companhia":"airBaltic","cod_companhia":"BT","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BT.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo40.png"},{"nome_companhia":"Air China","cod_companhia":"CA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo18.png"},{"nome_companhia":"Airlines PNG","cod_companhia":"CG","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CG.png","img_maior_companhia":""},{"nome_companhia":"China Airlines","cod_companhia":"CI","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CI.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo55.png"},{"nome_companhia":"Lufthansa CityLine","cod_companhia":"CL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CL.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo73.png"},{"nome_companhia":"Copa Airlines","cod_companhia":"CM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CM.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo56.png"},{"nome_companhia":"Cubana de Aviaci\u00f3n","cod_companhia":"CU","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CU.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo57.png"},{"nome_companhia":"Cathay Pacific","cod_companhia":"CX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CX.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo54.png"},{"nome_companhia":"China Southern Airlines","cod_companhia":"CZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/CZ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo55.png"},{"nome_companhia":"Delta Airlines","cod_companhia":"DL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/DL.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo59.png"},{"nome_companhia":"Easyjet Airlines Switzerland","cod_companhia":"DS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/U2.png","img_maior_companhia":""},{"nome_companhia":"Airblue","cod_companhia":"ED","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo41.png"},{"nome_companhia":"Aer Lingus","cod_companhia":"EI","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/EI.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo3.png"},{"nome_companhia":"Emirates Airlines","cod_companhia":"EK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/EK.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo61.png"},{"nome_companhia":"Air Dolomiti","cod_companhia":"EN","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/EN.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo19.png"},{"nome_companhia":"Ethiopian Airlines","cod_companhia":"ET","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/ET.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo62.png"},{"nome_companhia":"Etihad Airways","cod_companhia":"EY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/EY.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo63.png"},{"nome_companhia":"Freedom Air","cod_companhia":"FP","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/FP.png","img_maior_companhia":""},{"nome_companhia":"Ryanair","cod_companhia":"FR","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/FR.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo84.png"},{"nome_companhia":"FlyEgypt","cod_companhia":"FT","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/FEG.png","img_maior_companhia":""},{"nome_companhia":"Rossiya","cod_companhia":"FV","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/FV.png","img_maior_companhia":""},{"nome_companhia":"Flydubai","cod_companhia":"FZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/FZ.png","img_maior_companhia":""},{"nome_companhia":"GOL","cod_companhia":"G3","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/G3.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo65.png"},{"nome_companhia":"Gulf Air","cod_companhia":"GF","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/GF.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo66.png"},{"nome_companhia":"Air Greenland","cod_companhia":"GL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/GL.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo22.png"},{"nome_companhia":"Air Rarotonga","cod_companhia":"GZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/GZ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo33.png"},{"nome_companhia":"Sky Airline","cod_companhia":"H2","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/H2.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo95.png"},{"nome_companhia":"Air Seychelles","cod_companhia":"HM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/HM.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo35.png"},{"nome_companhia":"Transavia","cod_companhia":"HV","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/HV.png","img_maior_companhia":""},{"nome_companhia":"Aurora","cod_companhia":"HZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/HZ.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/HZ.png"},{"nome_companhia":"Iraqi Airways","cod_companhia":"IA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/IA.png","img_maior_companhia":""},{"nome_companhia":"Iberia Airlines","cod_companhia":"IB","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/IB.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo67.png"},{"nome_companhia":"Solomon Airlines","cod_companhia":"IE","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/IE.png","img_maior_companhia":""},{"nome_companhia":"Iran Air","cod_companhia":"IR","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/IR.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo68.png"},{"nome_companhia":"Azerbaijan","cod_companhia":"J2","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/J2.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo50.png"},{"nome_companhia":"LATAM","cod_companhia":"JJ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo72.png"},{"nome_companhia":"JAL","cod_companhia":"JL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/JC.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo69.png"},{"nome_companhia":"Air Jamaica","cod_companhia":"JM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/BW.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo24.png"},{"nome_companhia":"Adria Airways","cod_companhia":"JP","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/JP.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo1.png"},{"nome_companhia":"Air Koryo","cod_companhia":"JS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/JS.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo26.png"},{"nome_companhia":"Air Serbia","cod_companhia":"JU","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/JU.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo34.png"},{"nome_companhia":"Druk Air","cod_companhia":"KB","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/KB.png","img_maior_companhia":""},{"nome_companhia":"Korean Air","cod_companhia":"KE","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/KE.png","img_maior_companhia":""},{"nome_companhia":"KLM","cod_companhia":"KL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/KL.png","img_maior_companhia":""},{"nome_companhia":"Kenya Airways","cod_companhia":"KQ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/KQ.png","img_maior_companhia":""},{"nome_companhia":"Kuwait Airways","cod_companhia":"KU","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/KU.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo71.png"},{"nome_companhia":"Cayman Airways","cod_companhia":"KX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/KX.png","img_maior_companhia":""},{"nome_companhia":"Latam","cod_companhia":"LA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo72.png"},{"nome_companhia":"Lufthansa","cod_companhia":"LH","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LH.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo73.png"},{"nome_companhia":"Hi Fly","cod_companhia":"LK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/5K.png","img_maior_companhia":""},{"nome_companhia":"Libyan Airlines","cod_companhia":"LN","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LN.png","img_maior_companhia":""},{"nome_companhia":"Jet2.com","cod_companhia":"LS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LS.png","img_maior_companhia":""},{"nome_companhia":"Swiss AirLines","cod_companhia":"LX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LX.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo88.png"},{"nome_companhia":"El Al Israel Airlines","cod_companhia":"LY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/LY.png","img_maior_companhia":""},{"nome_companhia":"Air Madagascar","cod_companhia":"MD","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/MD.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo27.png"},{"nome_companhia":"Middle East Airlines","cod_companhia":"ME","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/ME.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo75.png"},{"nome_companhia":"Malaysia Airlines","cod_companhia":"MH","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/MH.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo74.png"},{"nome_companhia":"Air Mauritius","cod_companhia":"MK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/MK.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo29.png"},{"nome_companhia":"Egypt Air","cod_companhia":"MS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/MS.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo70.png"},{"nome_companhia":"Nesma Air","cod_companhia":"NE","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NA.png","img_maior_companhia":""},{"nome_companhia":"Air Vanuatu","cod_companhia":"NF","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NF.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NF.png"},{"nome_companhia":"All Nippon","cod_companhia":"NH","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NH.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo45.png"},{"nome_companhia":"Nile Air","cod_companhia":"NP","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NP.png","img_maior_companhia":""},{"nome_companhia":"Binter","cod_companhia":"NT","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/3B.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo52.png"},{"nome_companhia":"Air Macau","cod_companhia":"NX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NX.png","img_maior_companhia":""},{"nome_companhia":"Air New Zealand","cod_companhia":"NZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/NZ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo30.png"},{"nome_companhia":"Avianca","cod_companhia":"O6","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/O6.png","img_maior_companhia":""},{"nome_companhia":"Olympic Airlines","cod_companhia":"OA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OA.png","img_maior_companhia":""},{"nome_companhia":"Boliviana de Avia\u00e7\u00e3o","cod_companhia":"OB","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OB.png","img_maior_companhia":""},{"nome_companhia":"Orbest","cod_companhia":"OBS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/6O.png","img_maior_companhia":""},{"nome_companhia":"Czech Airlines","cod_companhia":"OK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OK.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo58.png"},{"nome_companhia":"MIAT Mongolian Airlines","cod_companhia":"OM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OM.png","img_maior_companhia":""},{"nome_companhia":"Austrian Airlines","cod_companhia":"OS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OS.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo49.png"},{"nome_companhia":"Croatia Airlines","cod_companhia":"OU","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OU.png","img_maior_companhia":""},{"nome_companhia":"Asiana Airlines","cod_companhia":"OZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/OZ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo48.png"},{"nome_companhia":"Pakistan International Airlines","cod_companhia":"PK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PK.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo76.png"},{"nome_companhia":"Philippine Airlines","cod_companhia":"PR","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PR.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo78.png"},{"nome_companhia":"Ukraine International","cod_companhia":"PS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PS.png","img_maior_companhia":""},{"nome_companhia":"Precision Air","cod_companhia":"PW","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PW.png","img_maior_companhia":""},{"nome_companhia":"Air Niugini","cod_companhia":"PX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PX.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo31.png"},{"nome_companhia":"Surinam Airways","cod_companhia":"PY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/PY.png","img_maior_companhia":""},{"nome_companhia":"Camair-Co","cod_companhia":"QC","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/QC.png","img_maior_companhia":""},{"nome_companhia":"Qantas Airways","cod_companhia":"QF","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/QF.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo79.png"},{"nome_companhia":"Qatar Airways","cod_companhia":"QR","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/QR.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo80.png"},{"nome_companhia":"Royal Jordanian Airlines","cod_companhia":"RJ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/RJ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo83.png"},{"nome_companhia":"Tarom","cod_companhia":"RO","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/RO.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo90.png"},{"nome_companhia":"Starbow","cod_companhia":"S9","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/S9.png","img_maior_companhia":""},{"nome_companhia":"South African","cod_companhia":"SA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo86.png"},{"nome_companhia":"Aircalin","cod_companhia":"SB","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SB.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo42.png"},{"nome_companhia":"Sudan Airways","cod_companhia":"SD","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SD.png","img_maior_companhia":""},{"nome_companhia":"Scandinavian Airlines System","cod_companhia":"SK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SK.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo85.png"},{"nome_companhia":"Air Cairo","cod_companhia":"SM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SM.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SM.png"},{"nome_companhia":"Brussels Airlines","cod_companhia":"SN","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SN.png","img_maior_companhia":""},{"nome_companhia":"Aeroflot","cod_companhia":"SU","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/SU.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo7.png"},{"nome_companhia":"Air Tanzania","cod_companhia":"TC","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TC.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo37.png"},{"nome_companhia":"Thai Airways International","cod_companhia":"TG","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TG.png","img_maior_companhia":""},{"nome_companhia":"Turkish Airlines","cod_companhia":"TK","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TK.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo92.png"},{"nome_companhia":"Air Tahiti Nui","cod_companhia":"TN","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TN.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo36.png"},{"nome_companhia":"TAP Portugal","cod_companhia":"TP","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TP.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo89.png"},{"nome_companhia":"Air Transat","cod_companhia":"TS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TS.png","img_maior_companhia":""},{"nome_companhia":"Tunisair","cod_companhia":"TU","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TU.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo91.png"},{"nome_companhia":"Air Cara\u00efbes","cod_companhia":"TX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TX.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TX.png"},{"nome_companhia":"Air Caledonie","cod_companhia":"TY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TY.png","img_maior_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/TY.png"},{"nome_companhia":"Easyjet Airlines","cod_companhia":"U2","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/U2.png","img_maior_companhia":""},{"nome_companhia":"United Airlines","cod_companhia":"UA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/UA.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo93.png"},{"nome_companhia":"AlMasria","cod_companhia":"UJ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/UJ.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo46.png"},{"nome_companhia":"SriLankan Airlines","cod_companhia":"UL","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/UL.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo87.png"},{"nome_companhia":"Air Zimbabwe","cod_companhia":"UM","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/UM.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo39.png"},{"nome_companhia":"Hong Kong Express","cod_companhia":"UO","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/HX.png","img_maior_companhia":""},{"nome_companhia":"Air Europa","cod_companhia":"UX","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/UX.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo20.png"},{"nome_companhia":"Buraq Air","cod_companhia":"UZ","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/UZ.png","img_maior_companhia":""},{"nome_companhia":"Vietnam Airlines","cod_companhia":"VN","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/VN.png","img_maior_companhia":""},{"nome_companhia":"TACV Airlines","cod_companhia":"VR","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/VR.png","img_maior_companhia":""},{"nome_companhia":"Virgin Atlantic Airways","cod_companhia":"VS","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/VS.png","img_maior_companhia":""},{"nome_companhia":"Air Tahiti","cod_companhia":"VT","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/VT.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo36.png"},{"nome_companhia":"Vueling","cod_companhia":"VY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/VY.png","img_maior_companhia":""},{"nome_companhia":"Wizz Air","cod_companhia":"W6","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/W6.png","img_maior_companhia":""},{"nome_companhia":"Rwandair Express","cod_companhia":"WB","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/WB.png","img_maior_companhia":""},{"nome_companhia":"White Airways","cod_companhia":"WI","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/WI.png","img_maior_companhia":""},{"nome_companhia":"Aero VIP","cod_companhia":"WV","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/RVP.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo6.png"},{"nome_companhia":"Oman Air","cod_companhia":"WY","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/WY.png","img_maior_companhia":""},{"nome_companhia":"Yeti Airlines","cod_companhia":"YA","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/YT.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo94.png"},{"nome_companhia":"Montenegro Airlines","cod_companhia":"YN","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/YM.png","img_maior_companhia":""},{"nome_companhia":"Aigle Azur","cod_companhia":"ZI","img_companhia":"https:\/\/res.cloudinary.com\/wego\/w_30,h_27,f_auto,fl_lossy,q_80\/v20190606\/flights\/airlines_square\/ZI.png","img_maior_companhia":"https:\/\/img.taurusmulticanal.com.br\/files\/img_companhias\/logo10.png"}]';
}

add_action( 'wp_ajax_get_city_airport', 'get_city_airport' );
add_action( 'wp_ajax_nopriv_get_city_airport', 'get_city_airport' );

function get_city_airport() { 

	function tirarAcentosString($string){
		return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
	}  
 
  	$local = tirarAcentosString(str_replace(" ", "%20", $_POST['local']));

    $aeroportos = get_aeroportos();

    echo json_encode($aeroportos);
}

add_shortcode('TTBOOKING_MOTOR_RESERVA_FLIGHTS', 'shortcode_motor_reserva_flights');  

function shortcode_motor_reserva_flights(){
	$retorno = "";

	$retorno = ''; 

	$retorno .= '<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">';
	$retorno .= '<link rel="preconnect" href="https://fonts.googleapis.com">
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
				<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=1.0"> '; 

	$retorno .= '<style>
		.search-sec{padding:2.5rem 2rem}
		.search-slt{display:block;width:100%;font-size:.875rem;line-height:1.5;color:#55595c;background-color:#fff;background-image:none;border:1px solid #ccc;height:calc(3rem + 2px)!important;border-radius:0}
		.wrn-btn{width:100%;font-size:16px;font-weight:400;text-transform:capitalize;height:calc(3rem + 9px)!important;border-radius:0 4px 4px 0;}
		.wrn-btn:focus{outline:none;box-shadow:none;border:none;}
		@media (min-width:992px){
			.daterangepicker .drp-calendar{
				    max-width: 280px !important;
			}
			.idtrecho{
				padding: 10px 9px;font-size: 17px;font-weight: 800;text-align: center;background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';color:#fff;border-radius: 100%;width: 40px;height: 40px;margin: 5px 26px;
			}
			.search-sec{
				bottom:0px;
				width:100%;
				background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
				z-index:9;
				border-radius: 15px;
				box-shadow: 4px 4px 8px #dadada;
				font-family: \'Montserrat\';
			}  
			.daterangepicker .drp-calendar.left{
				margin-right: 49px;
			}

			.fieldFrom, .fieldTo, .fieldDates .form-group{
				display: inline-flex;
				width: 47%;
			}
			.fieldChange{
				display: inline-flex;
			    width: 2%;
			    padding: 5px 22px 5px 6px;
			    font-size: 16px;
			    margin-left: -19px !important;
			    background-color: #fff;
			    border: 1px solid #d2d8dd;
			    border-radius: 7px;
			    cursor: pointer;
			}
			.custom-select-form label, .fieldDates label, .fieldPax .label{
				position: absolute;margin: 5px 10px;font-size: 9px;font-weight: 700;color: #000;top:3px;
			}
			.custom-select-form{
				padding: 8px 0;
			} 
			.custom-search-input-2 input{
				margin-top: 7px !important;
			}
		}
			.form-control:disabled, .form-control[readonly]{
				background-color: #fff !important;
			}
		@media (max-width:992px){
			.banner{
				margin: 5px !important;
			}
			.ripple{
				    margin-top: 15px;
			}
			.panel-dropdown-flights .panel-dropdown-content{
				width: 245px !important;
			}
			.qtyButtons label{
				font-size: 16px !important;
			} 
			.search-sec{bottom:0px;width:100%;background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'c2;z-index:9;border-radius: 15px;box-shadow: 4px 4px 8px #dadada;font-family: \'Montserrat\';}.custom-search-input-2 .form-group {margin-bottom: 15px !important;}
		.owl-carousel.main_banner{position:relative !important;}
		.custom_header{position:relative !important;top:0;z-index:99;width:100%;background: rgba(26,70,104,.51) !important;border-radius:0;}
		}
		.custom-search-input-2{background-color:#fff;-webkit-border-radius:5px;-moz-border-radius:5px;-ms-border-radius:5px;border-radius:5px;margin-top:15px;box-shadow: 0 0 0 6px rgba(255,255,255,.25);}
		@media (max-width: 991px){.custom-search-input-2{background:none;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
		}
		.custom-search-input-2 input{font-family: \'Montserrat\' !important;font-size: .85rem !important;border:0;height:34px;padding-left:15px; font-weight:500;padding:10px;margin-top:-7px}
		@media (max-width: 991px){.custom-search-input-2 input{border:none}
		}
		.custom-search-input-2 input:focus{box-shadow:none; }
		@media (max-width: 991px){.custom-search-input-2 input:focus{border-right:none}
		}
		.custom-search-input-2 select{font-size: 13px;padding: 5px;height: 30px !important;}
		.custom-search-input-2 .nice-select .current{font-weight:500;color:#6f787f}
		.custom-search-input-2 .form-group{margin:0}
		@media (max-width: 991px){.custom-search-input-2 .form-group{margin-bottom:5px}
		}
		.custom-search-input-2 i{-webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    font-size: 1.125rem;
    position: absolute;
    background-color: #fff;
    line-height: 57px;
    top: 0;
    right: 1px;
    padding-right: 6px;
    display: block;
    width: 20px;
    box-sizing: content-box;
    height: 57px;
    z-index: 9;
    color: #999;
    text-align: center;
    border-right: 1px solid #ddd;}
		@media (max-width: 991px){.custom-search-input-2 i{padding-right:10px}
		}
		.custom-search-input-2 input[type=\'submit\']{-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out;color:#fff;font-weight:600;font-size:14px;font-size:0.875rem;border:0;padding:0 25px;height:50px;cursor:pointer;outline:none;width:100%;-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;-ms-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;background-color:#fc5b62;margin-right:-1px}
		@media (max-width: 991px){.custom-search-input-2 input[type=\'submit\']{margin:20px 0 0 0;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px}
		}
		.custom-search-input-2 input[type=\'submit\']:hover{background-color:#FFC107;color:#222}
		.custom-search-input-2.inner{margin-bottom:30px;-webkit-box-shadow:0px 0px 30px 0px rgba(0,0,0,0.1);-moz-box-shadow:0px 0px 30px 0px rgba(0,0,0,0.1);box-shadow:0px 0px 30px 0px rgba(0,0,0,0.1)}
		@media (max-width: 991px){.custom-search-input-2.inner{margin:0 0 20px 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
		}
		.custom-search-input-2.inner-2{margin:0 0 20px 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;background:none}
		.custom-search-input-2.inner-2 .form-group{margin-bottom:10px}
		.custom-search-input-2.inner-2 input{border:1px solid #ededed}
		.custom-search-input-2.inner-2 input[type=\'submit\']{-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;margin-top:10px}
		.custom-search-input-2.inner-2 i{padding-right:10px;line-height:48px;height:48px;top:1px}
		.custom-search-input-2.inner-2 .nice-select{border:1px solid #ededed}
		.panel-dropdown-flights{position:relative;text-align:left;padding:21px 6px 0 0px}
		@media (max-width: 991px){.panel-dropdown-flights{background-color:#fff;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;height:50px}
		}
		.panel-dropdown-flights a{color:#727b82;font-weight:500;transition:all 0.3s;display:flex;align-items:center;justify-content:flex-start;position:relative;top:1px;font-size: 13px;}
		.panel-dropdown-flights a:after{content:"\25BE";font-size:1.7rem;color:#999;font-weight:500;-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out;position:absolute;right:0;top:-11px;}
		.panel-dropdown-flights.active a:after{transform:rotate(180deg);}
		.panel-dropdown-flights .panel-dropdown-content{opacity:0;visibility:hidden;transition:all 0.3s;position:absolute;top:58px;left:0px;z-index:99;background:#fff;border-radius:4px;white-space:normal;width:310px;box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;border:none;}
		.panel-dropdown-flights .panel-dropdown-content:after{bottom:100%;left:15px;border:solid transparent;content:" ";height:0;width:0;position:absolute;pointer-events:none;border-bottom-color:#fff;border-width:7px;margin-left:-7px}
		.panel-dropdown-flights .panel-dropdown-content.right{left:auto;right:0}
		.panel-dropdown-flights .panel-dropdown-content.right:after{left:auto;right:15px}
		.panel-dropdown-flights.active .panel-dropdown-content{opacity:1;visibility:visible}
		.qtyButtons{display:flex;margin:0 0 13px 0}
		.qtyButtons input{outline:0;font-size:16px;font-size:1rem;text-align:center;width:50px;height:36px !important;color:#333;line-height:36px;margin:0 !important;padding:0 5px !important;border:none;box-shadow:none;pointer-events:none;display:inline-block;border:none !important}
		.qtyButtons label{font-weight:400;line-height:36px;padding-right:15px;display:block;flex:1;color:#626262;    font-size: 18px;}
		.qtyIncFlight,.qtyDecFlight, .qtyIncMulti,.qtyDecMulti{width:28px;height:28px;line-height:22px;font-size:15px;background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd;-webkit-text-stroke:1px #fff;color:#333;display:inline-block;text-align:center;border-radius:50%;cursor:pointer;}
		.qtyIncFlight:hover,.qtyDecFlight:hover,.qtyIncMulti:hover,.qtyDecMulti:hover{background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd;}
		.qtyIncFlight:hover:before, .qtyDecFlight:hover:before, .qtyIncMulti:hover:before, .qtyDecMulti:hover:before{color:#fff}
		.qtyIncFlight:before, .qtyIncMulti:before{content:"\002B";font-size:19px;font-weight:900;line-height: 29px;}
		.qtyDecFlight:before, .qtyDecMulti:before{content:"\2212";font-size:19px;font-weight:900;line-height: 29px;}
		.qtyTotalFlights, .qtyRoom, .qtyTotalMultiFlights{border-radius:50%;color:#66676b;display:inline-block;font-size:14px;font-weight:600;font-family:\'Montserrat\', sans-serif;line-height:18px;text-align:center;position:relative;    top: 0px;
    left: 0px;
    height: 18px;
    width: 18px;
    margin-right: 0px;}
		.rotate-x{animation-duration:.5s;animation-name:rotate-x}
		@keyframes rotate-x{from{transform:rotateY(0deg)}
		to{transform:rotateY(360deg)}
		}
		.daterangepicker{box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;border:none;}
		.daterangepicker td.in-range{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'54;cor:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'54;}
		.daterangepicker td.active, .daterangepicker td.active:hover {background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';border-color:transparent;color:#fff;}
		.daterangepicker td.available:hover, .daterangepicker th.available:hover{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'99;color:#fff;border-radius:40px}
		.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{background-color:#c82333;border-color:#c82333;}
		.ripple{font-family:\'Montserrat\';position:relative;overflow:hidden;transform:translate3d(0,0,0)}
		.ripple:after{content:"";display:block;position:absolute;width:100%;height:100%;top:0;left:0;pointer-events:none;background-image:radial-gradient(circle,#000 10%,transparent 10.01%);background-repeat:no-repeat;background-position:50%;transform:scale(10,10);opacity:0;transition:transform .5s,opacity 1s}
		.ripple:active:after{transform:scale(0,0);opacity:.2;transition:0s}
		.btn-primary{color:#fff;background-color:#DC3545;border-color:#DC3545;}
		.btn-primary:hover{background-color:#c82333;border-color:#bd2130;}
		.btn-primary:focus{background-color:#c82333;border-color:#bd2130;box-shadow:0 0 0 0.2rem rgba(200, 35, 51, 0.5)!important;}
		.nice-select.wide{width:100%}
		.nice-select.wide .list{left:0 !important;right:0 !important}
		.custom-select-form .nice-select{-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;border:1px solid #d2d8dd;height:45px;line-height:42px}
		.custom-select-form .nice-select:hover{border-color:#d2d8dd}
		.custom-select-form .nice-select:active,.custom-select-form .nice-select.open,.custom-select-form .nice-select:focus{border-color:#80bdff;outline:0;box-shadow:0 0 0 0.2rem rgba(0,123,255,0.25)}
		.custom-select-form select{display:none} 
		.custom-select-form .nice-select{border:none;height:50px;line-height:50px;border-radius:4px 0 0 4px;border-right:1px solid #d2d8dd !important;}
		.nice-select .list{box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;width:100%;}
		.nice-select.open .list{height:250px;overflow-y:auto;}
		.custom-select-form .nice-select:active, .custom-select-form .nice-select.open, .custom-select-form .nice-select:focus {border-color:#fff;outline:0;box-shadow:none;}
		.wrn-btn span{cursor:pointer;display:inline-block;position:relative;transition:.5s}
		.wrn-btn span:after{content:\'\00bb\';position:absolute;opacity:0;top:-8px;right:-20px;transition:.5s;font-size:24px;}
		.wrn-btn:hover span{padding-right:20px}
		.wrn-btn:hover span:after{opacity:1;right:0}
		.wrapper-grid{padding:0 20px}
		.box_grid{background-color:#fff;display:block;position:relative;margin-bottom:30px;-webkit-box-shadow:0px 0px 20px 0px rgba(0,0,0,0.1);-moz-box-shadow:0px 0px 20px 0px rgba(0,0,0,0.1);box-shadow:0px 0px 20px 0px rgba(0,0,0,0.1)}
		.box_grid .price{display:inline-block;font-weight:500;color:#999}
		.box_grid .price strong{color:#32a067}
		.box_grid a.wish_bt{position:absolute;right:15px;top:15px;z-index:1;background-color:#000;background-color:rgba(0,0,0,0.6);padding:7px 10px 7px 10px;display:inline-block;color:#fff;line-height:1;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px}
		.box_grid a.wish_bt:after{content:"\2661";-moz-transition:all 0.5s ease;-o-transition:all 0.5s ease;-webkit-transition:all 0.5s ease;-ms-transition:all 0.5s ease;transition:all 0.5s ease;font-size:20px;}
		.box_grid a.wish_bt.liked:after{content:"\e089";color:#fc5b62}
		.box_grid a.wish_bt:hover.liked:after{color:#fc5b62}
		.box_grid a.wish_bt:hover:after{content:"\e089";color:#fff}
		.box_grid figure{margin-bottom:0;overflow:hidden;position:relative;height:210px}
		.box_grid figure small{position:absolute;background-color:#000;background-color:rgba(0,0,0,0.6);left:20px;top:22px;text-transform:uppercase;color:#ccc;font-weight:600;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;padding:5px 10px 5px 10px;line-height:1}
		.box_grid figure .read_more{position:absolute;top:50%;left:0;margin-top:-12px;-webkit-transform:translateY(10px);-moz-transform:translateY(10px);-ms-transform:translateY(10px);-o-transform:translateY(10px);transform:translateY(10px);text-align:center;opacity:0;visibility:hidden;width:100%;-webkit-transition:all 0.6s;transition:all 0.6s;z-index:2}
		.box_grid figure .read_more span{background-color:#fcfcfc;background-color:rgba(255,255,255,0.8);-webkit-border-radius:20px;-moz-border-radius:20px;-ms-border-radius:20px;border-radius:20px;display:inline-block;color:#222;font-size:12px;font-size:0.75rem;padding:5px 10px}
		.box_grid figure:hover .read_more{opacity:1;visibility:visible;-webkit-transform:translateY(0);-moz-transform:translateY(0);-ms-transform:translateY(0);-o-transform:translateY(0);transform:translateY(0)}
		.box_grid figure a img{position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%) scale(1.1);-moz-transform:translate(-50%, -50%) scale(1.1);-ms-transform:translate(-50%, -50%) scale(1.1);-o-transform:translate(-50%, -50%) scale(1.1);transform:translate(-50%, -50%) scale(1.1);-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;width:100%;-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out}
		.box_grid figure a:hover img{-webkit-transform:translate(-50%, -50%) scale(1);-moz-transform:translate(-50%, -50%) scale(1);-ms-transform:translate(-50%, -50%) scale(1);-o-transform:translate(-50%, -50%) scale(1);transform:translate(-50%, -50%) scale(1)}
		.box_grid .wrapper{padding:25px}
		.box_grid .wrapper h3{font-size:20px;font-size:1.25rem;margin-top:0}
		.box_grid ul{padding:20px 15px;border-top:1px solid #ededed}
		.box_grid ul li{display:inline-block;margin-right:15px}
		.box_grid ul li .score{margin-top:-10px}
		.box_grid ul li:last-child{margin-right:0;float:right}
		.score strong{background-color:#0054a6;color:#fff;line-height:1;-webkit-border-radius:5px 5px 5px 0;-moz-border-radius:5px 5px 5px 0;-ms-border-radius:5px 5px 5px 0;border-radius:5px 5px 5px 0;padding:10px;display:inline-block}
		.score span{display:inline-block;position:relative;top:7px;margin-right:8px;font-size:12px;font-size:0.75rem;text-align:right;line-height:1.1;font-weight:500}
		.score span em{display:block;font-weight:normal;font-size:11px;font-size:0.6875rem}
		.main_title_2 h2{margin:25px 0 0 0;color:#333;}
		.main_title_2 h3{margin:25px 0 0 0;color:#727272;}
		.main_title_2 p{margin:8px 0 0 0;color:#727272;}
		p{color:#727272;font-size:15px;line-height:20px;}
		a{color:#DC3545;}
		a:hover{text-decoration:none;color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'}
		.owl-carousel .owl-nav button.owl-next,.owl-carousel .owl-nav button.owl-prev,.owl-carousel button.owl-dot{background:rgba(0, 84, 166, 0.85)!important;color:inherit;border:none;padding:5px 14px!important;position:absolute;top:50%;color:#fff!impotant;border-radius:3px!impotant}
		.owl-carousel .owl-nav .owl-prev{left:0;}
		.owl-carousel .owl-nav .owl-prev span{font-size:20px;line-height:22px;}
		.owl-carousel .owl-nav .owl-prev:focus{outline:none;border:none;box-shadow:none}
		.owl-carousel .owl-nav .owl-next{right:0}
		.owl-carousel .owl-nav .owl-next span{font-size:20px;line-height:22px;}
		.owl-carousel .owl-nav .owl-next:focus{outline:none;border:none;box-shadow:none}
		#places{margin-top:40px}
		@media (max-width: 767px){#places{margin-top:0}
		}
		#places .item{margin:0 15px}
		#places .owl-item{opacity:0.5;transform:scale(0.85);-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;-webkit-transform:translateZ(0) scale(0.85, 0.85);transition:all 0.3s ease-in-out 0s;overflow:hidden}
		#places .owl-item.active.center{opacity:1;-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;-webkit-transform:translateZ(0) scale(1, 1);transform:scale(1)}
		#places .owl-item.active.center .item .title h4,#places .owl-item.active.center .item .views{opacity:1}
		.owl-theme .owl-dots{margin-top:10px !important;margin-bottom:25px}
		.search-sec .tag_line h3{font-size: 2.625rem;text-shadow: 4px 4px 12px rgba(0,0,0,0.3);color:#fff;margin:0;text-transform:uppercase;font-weight:700;}
		.search-sec .tag_line p{font-size: 21px;text-shadow: 4px 4px 12px rgba(0,0,0,0.3);color:#fff;margin:5px 0 0 0;font-weight:400;}
		.custom_header{position:absolute;top:0;z-index:99;width:100%;background: rgba(26,70,104,.51) !important;border-radius:0;}
		.navbar .navbar-brand{color:#fff!important;font-size:30px;}
		.navbar .navbar-nav li a{color:#fff!important;}
		.navbar .navbar-nav li.active a{color:#DC3545!important;}
		#side-menu{display:none;position:fixed;width:320px;top:0;right:-300px;height:100%;overflow-y:auto;z-index:99999;background:#fff;padding:20px 15px;color:#333;transition:.4s;box-shadow:-5px 0 20px rgba(0, 0, 0, 0.2);}
		body.side-menu-visible #side-menu{transform:translateX(-300px);overflow:hidden;}
		#side-menu .logo{max-width:65%;}
		#side-menu .contents{margin-top:00px;border-top:1px solid #eee;padding-top:20px;}
		#side-menu li.nav-item:before{content:\'\203A\';position:absolute;left:2px;top:7px;}
		#side-menu li.nav-item{padding-left:20px;}
		#side-menu .nav-link{color:#333;font-size:14px;font-weight:600;padding:10px 0}
		#side-menu .nav-link:hover{opacity:.8;color:#1b820a;}
		#side-menu li.nav-item.dropdown.show{border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:10px;}
		#side-menu .close{font-size:36px;font-weight:400;position:absolute;top:5px;right:15px;}
		#side-menu .contact a, #side-menu .contact .fa{padding:5px 0px;background:#fff;font-size:14px;color:#727272;}
		#side-menu .contact a:hover, #side-menu .contact .fa:hover{color: #28ab13 !important;}
		#side-menu .contact a:focus, #side-menu .contact .fa:focus{color: #28ab13 !important;}
		.dadosOrigin{position:absolute;}
		.dadosOrigin ul li{margin-top: 0 !important;}
		table td, table th{padding:9px;font-family: \'Montserrat\';font-weight: 600;}
		table caption+thead tr:first-child td, table caption+thead tr:first-child th, table colgroup+thead tr:first-child td, table colgroup+thead tr:first-child th, table thead:first-child tr:first-child td, table thead:first-child tr:first-child th{
			border-top:none !important;
			font-size:17px !important;
		    text-transform: capitalize;
		}
		.daterangepicker .calendar-table th, .daterangepicker .calendar-table td{text-transform:uppercase}
		.daterangepicker td.start-date{border-radius:40px 0px 0px 40px}
		.daterangepicker td.end-date{border-radius:0px 40px 40px 0px}
		.daterangepicker.show-calendar .drp-buttons{font-family: \'Montserrat\'}
		.daterangepicker td.start-date.end-date{border-radius:40px}
		.cancelBtn{color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd !important}
		.cancelBtn:hover{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd !important;color:#fff !important}
		.applyBtn{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).' !important;border-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).' !important}
		.applyBtn:hover{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd !important}
		.daterangepicker .drp-selected{display:none !important;}
		.btnAddRoom{font-size: 13px;font-weight: 700;color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';padding:6px 0;background-color:#fff;font-family: \'Montserrat\'}
		.btnAddRoom:hover{color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'ee;background-color:#fff;}
		.btnApplyRoom{background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';color: #fff;font-size: 14px;font-weight: 600;border-radius: 40px;padding: 5px 30px;float: right;}
		.btnApplyRoom:hover{background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'d4;}
		.ripple{background-color:'.(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' )).' !important;border:transparent !important}
		.ripple:hover{background-color:'.(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' )).'80 !important}
		.dadosOrigin:after{
			bottom: 100%;
		    left: 15px;
		    border: solid transparent;
		    content: " ";
		    height: 0;
		    width: 0;
		    position: absolute;
		    pointer-events: none;
		    border-bottom-color: #fff;
		    border-width: 7px;
		    margin-left: -7px;
		}
		.dadosOrigin ul li:hover{
			background-color: #f1f1f1;
		}
		.banner{
		margin: 10px 0px;
		} 
		button.typeFlight {
		    margin-left: 15px;
		    border-radius: 40px;
		    font-size: 13px;
		    font-weight: 600;
		    color: #fff;
		    border: 1px solid #fff;
		}
		button.typeFlight.active, button.typeFlight:hover { 
		    color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'; 
		    background-color: #fff;
		}
		</style>';

	$retorno .= '
	<section class="banner">  
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
					<div class="row no-gutters custom-search-input-2" id="flightsPadron" style=""> 
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
								<i class="fas fa-map-marker-alt"></i>
							</div>
						</div>
						<div class="col-lg-4 fieldDates">
							<div class="form-group">
								<label style="">DATAS</label>
								<input class="form-control search-slt" type="text" name="dateGo" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
							</div>
							<div class="form-group dateReturn">
									<label style=""> </label>
								<input class="form-control search-slt" type="text" name="dateBack" placeholder="Informe o retorno" autocomplete="off" readonly="readonly">
								<i class="fa fa-calendar"></i>
							</div>
						</div>
						<div class="col-lg-3 fieldPax">
							<label class="label" style="">PASSAGEIROS E CLASSE</label>
							<div class="panel-dropdown-flights panelDropdownFlights" id="panelDropdownFlights">
								<a href="#"><i class="fa fa-user" style="position: unset;padding: 0;line-height: 1;height: auto;margin-left: 8px;BORDER: NONE;"></i> <span class="qtyTotalFlights">2</span> pessoas, <span class="classeTrip">Econômica</span></a>
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
												<label style="line-height:1">
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
								<div class="form-group" style="width:100%">
									<label style="">DATAS</label>
									<input class="form-control search-slt" type="text" id="date_trecho1" name="date_trecho1" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
								</div>
							</div>
							<div class="col-lg-3 fieldPax">
								<label class="label" style="">PASSAGEIROS E CLASSE</label>
								<div class="panel-dropdown-flights panel-multi" id="panelDropdownMultiFlights">
									<a href="#"><i class="fa fa-user" style="position: unset;padding: 0;line-height: 1;height: auto;margin-left: 8px;BORDER: NONE;"></i> <span class="qtyTotalMultiFlights">2</span> pessoas, <span class="classeTripMulti">Econômica</span></a>
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
													<label style="line-height:1">
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
								<div class="form-group" style="width:100%">
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
								<div class="form-group" style="width:100%">
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
								<div class="form-group" style="width:100%">
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
								<div class="form-group" style="width:100%">
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
	</section> ';

	$retorno .= '<input type="hidden" id="url_ajax" value="'.admin_url('admin-ajax.php').'">';

	$retorno .= '<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
	<script src="https://www.jqueryscript.net/demo/Customizable-Animated-Dropdown-Plugin-with-jQuery-CSS3-Nice-Select/js/jquery.nice-select.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
	<script src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/js/script-search-flights.js?v='.date("YmdHis").'&amp;ver=6.2.2" id="scripts-flights-js"></script>';

	return $retorno;

} 

add_shortcode('TTBOOKING_MOTOR_RESERVA_FLIGHT_LATERAL', 'shortcode_motor_reserva_flights_lateral');  

function shortcode_motor_reserva_flights_lateral(){
	$retorno = "";

	$retorno = ''; 

	$retorno .= '<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">';
	$retorno .= '<link rel="preconnect" href="https://fonts.googleapis.com">
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
				<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=1.0"> '; 

	$retorno .= '<style>
		.search-sec{padding:1.2rem}
		.search-slt{display:block;width:100%;font-size:.875rem;line-height:1.5;color:#55595c;background-color:#fff;background-image:none;border:1px solid #ccc;height:calc(3rem + 2px)!important;border-radius:0}
		.wrn-btn{width:100%;font-size:16px;font-weight:400;text-transform:capitalize;height:calc(3rem + 9px)!important;border-radius:0 4px 4px 0;}
		.wrn-btn:focus{outline:none;box-shadow:none;border:none;}
		@media (min-width:992px){
			.daterangepicker .drp-calendar{
				    max-width: 280px !important;
			}
			.idtrecho{
				padding: 10px 9px;font-size: 17px;font-weight: 800;text-align: center;background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';color:#fff;border-radius: 100%;width: 40px;height: 40px;margin: 5px 26px;
			}
			.search-sec{
				bottom:0px;
				width:100%;
				background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
				z-index:9;
				border-radius: 15px;
				box-shadow: 4px 4px 8px #dadada;
				font-family: \'Montserrat\';
			}  
			.daterangepicker .drp-calendar.left{
				margin-right: 49px;
			}

			.fieldFrom, .fieldTo, .fieldDates .form-group{
				display: inline-flex;
				width: 100%;
			}
			.fieldChange{
				display: inline-flex;
			    width: 2%;
			    padding: 5px 22px 5px 6px;
			    font-size: 16px;
			    margin-left: -19px !important;
			    background-color: #fff;
			    border: 1px solid #d2d8dd;
			    border-radius: 7px;
			    cursor: pointer;
			}
			.custom-select-form label, .fieldDates label, .fieldPax .label{
				 margin: 5px 10px;font-size: 9px;font-weight: 700;color: #000; 
			}
			.custom-select-form{
				padding: 8px 0;
                width: 100%;
			} 
			.custom-search-input-2 input{
				margin-top: 0px !important;
			}
		}
			.form-control:disabled, .form-control[readonly]{
				background-color: #fff !important;
			}
		@media (max-width:992px){
			.banner{
				margin: 5px !important;
			}
			.ripple{
				    margin-top: 15px;
			}
			.panel-dropdown-flights .panel-dropdown-content{
				width: 245px !important;
			}
			.qtyButtons label{
				font-size: 16px !important;
			} 
			.search-sec{bottom:0px;width:100%;background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'c2;z-index:9;border-radius: 15px;box-shadow: 4px 4px 8px #dadada;font-family: \'Montserrat\';}.custom-search-input-2 .form-group {margin-bottom: 15px !important;}
		.owl-carousel.main_banner{position:relative !important;}
		.custom_header{position:relative !important;top:0;z-index:99;width:100%;background: rgba(26,70,104,.51) !important;border-radius:0;}
		}
		.custom-search-input-2{background-color:transparent;-webkit-border-radius:5px;-moz-border-radius:5px;-ms-border-radius:5px;border-radius:5px;margin-top:15px;box-shadow: none;}
		@media (max-width: 991px){.custom-search-input-2{background:none;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
		}
		.custom-search-input-2 input{font-family: \'Montserrat\' !important;font-size: .85rem !important;border:0;height:34px;padding-left:15px; font-weight:500;padding:10px;margin-top:-7px}
		@media (max-width: 991px){.custom-search-input-2 input{border:none}
		}
		.custom-search-input-2 input:focus{box-shadow:none; }
		@media (max-width: 991px){.custom-search-input-2 input:focus{border-right:none}
		}
		.custom-search-input-2 select{font-size: 13px;padding: 5px;height: 30px !important;}
		.custom-search-input-2 .nice-select .current{font-weight:500;color:#6f787f}
		.custom-search-input-2 .form-group{margin:0;background: #fff;margin-bottom: 10px;}
		@media (max-width: 991px){.custom-search-input-2 .form-group{margin-bottom:5px}
		}
		.custom-search-input-2 i{-webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    font-size: 1.125rem;
    position: absolute;
    background-color: #fff;
    line-height: 57px;
    top: 0;
    right: 1px;
    padding-right: 6px;
    display: block;
    width: 20px;
    box-sizing: content-box;
    height: 57px;
    z-index: 9;
    color: #999;
    text-align: center;
    border-right: 1px solid #ddd;}
		@media (max-width: 991px){.custom-search-input-2 i{padding-right:10px}
		}
		.custom-search-input-2 input[type=\'submit\']{-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out;color:#fff;font-weight:600;font-size:14px;font-size:0.875rem;border:0;padding:0 25px;height:50px;cursor:pointer;outline:none;width:100%;-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;-ms-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;background-color:#fc5b62;margin-right:-1px}
		@media (max-width: 991px){.custom-search-input-2 input[type=\'submit\']{margin:20px 0 0 0;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px}
		}
		.custom-search-input-2 input[type=\'submit\']:hover{background-color:#FFC107;color:#222}
		.custom-search-input-2.inner{margin-bottom:30px;-webkit-box-shadow:0px 0px 30px 0px rgba(0,0,0,0.1);-moz-box-shadow:0px 0px 30px 0px rgba(0,0,0,0.1);box-shadow:0px 0px 30px 0px rgba(0,0,0,0.1)}
		@media (max-width: 991px){.custom-search-input-2.inner{margin:0 0 20px 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
		}
		.custom-search-input-2.inner-2{margin:0 0 20px 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;background:none}
		.custom-search-input-2.inner-2 .form-group{margin-bottom:10px}
		.custom-search-input-2.inner-2 input{border:1px solid #ededed}
		.custom-search-input-2.inner-2 input[type=\'submit\']{-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;margin-top:10px}
		.custom-search-input-2.inner-2 i{padding-right:10px;line-height:48px;height:48px;top:1px}
		.custom-search-input-2.inner-2 .nice-select{border:1px solid #ededed}
		.panel-dropdown-flights{position:relative;text-align:left;padding:21px 6px 0 0px}
		@media (max-width: 991px){.panel-dropdown-flights{background-color:#fff;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;height:50px}
		}
		.panel-dropdown-flights a{color:#727b82;font-weight:500;transition:all 0.3s;display:flex;align-items:center;justify-content:flex-start;position:relative;top:1px;font-size: 13px;}
		.panel-dropdown-flights a:after{content:"\25BE";font-size:1.7rem;color:#999;font-weight:500;-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out;position:absolute;right:0;top:-11px;}
		.panel-dropdown-flights.active a:after{transform:rotate(180deg);}
		.panel-dropdown-flights .panel-dropdown-content{opacity:0;visibility:hidden;transition:all 0.3s;position:absolute;top:58px;left:0px;z-index:99;background:#fff;border-radius:4px;white-space:normal;width:310px;box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;border:none;}
		.panel-dropdown-flights .panel-dropdown-content:after{bottom:100%;left:15px;border:solid transparent;content:" ";height:0;width:0;position:absolute;pointer-events:none;border-bottom-color:#fff;border-width:7px;margin-left:-7px}
		.panel-dropdown-flights .panel-dropdown-content.right{left:auto;right:0}
		.panel-dropdown-flights .panel-dropdown-content.right:after{left:auto;right:15px}
		.panel-dropdown-flights.active .panel-dropdown-content{opacity:1;visibility:visible}
		.qtyButtons{display:flex;margin:0 0 13px 0}
		.qtyButtons input{outline:0;font-size:16px;font-size:1rem;text-align:center;width:50px;height:36px !important;color:#333;line-height:36px;margin:0 !important;padding:0 5px !important;border:none;box-shadow:none;pointer-events:none;display:inline-block;border:none !important}
		.qtyButtons label{font-weight:400;line-height:36px;padding-right:15px;display:block;flex:1;color:#626262;    font-size: 18px;}
		.qtyIncFlight,.qtyDecFlight, .qtyIncMulti,.qtyDecMulti{width:28px;height:28px;line-height:22px;font-size:15px;background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd;-webkit-text-stroke:1px #fff;color:#333;display:inline-block;text-align:center;border-radius:50%;cursor:pointer;}
		.qtyIncFlight:hover,.qtyDecFlight:hover,.qtyIncMulti:hover,.qtyDecMulti:hover{background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd;}
		.qtyIncFlight:hover:before, .qtyDecFlight:hover:before, .qtyIncMulti:hover:before, .qtyDecMulti:hover:before{color:#fff}
		.qtyIncFlight:before, .qtyIncMulti:before{content:"\002B";font-size:19px;font-weight:900;line-height: 29px;}
		.qtyDecFlight:before, .qtyDecMulti:before{content:"\2212";font-size:19px;font-weight:900;line-height: 29px;}
		.qtyTotalFlights, .qtyRoom, .qtyTotalMultiFlights{border-radius:50%;color:#66676b;display:inline-block;font-size:14px;font-weight:600;font-family:\'Montserrat\', sans-serif;line-height:18px;text-align:center;position:relative;    top: 0px;
    left: 0px;
    height: 18px;
    width: 18px;
    margin-right: 0px;}
		.rotate-x{animation-duration:.5s;animation-name:rotate-x}
		@keyframes rotate-x{from{transform:rotateY(0deg)}
		to{transform:rotateY(360deg)}
		}
		.daterangepicker{box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;border:none;}
		.daterangepicker td.in-range{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'54;cor:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'54;}
		.daterangepicker td.active, .daterangepicker td.active:hover {background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';border-color:transparent;color:#fff;}
		.daterangepicker td.available:hover, .daterangepicker th.available:hover{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'99;color:#fff;border-radius:40px}
		.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{background-color:#c82333;border-color:#c82333;}
		.ripple{font-family:\'Montserrat\';position:relative;overflow:hidden;transform:translate3d(0,0,0)}
		.ripple:after{content:"";display:block;position:absolute;width:100%;height:100%;top:0;left:0;pointer-events:none;background-image:radial-gradient(circle,#000 10%,transparent 10.01%);background-repeat:no-repeat;background-position:50%;transform:scale(10,10);opacity:0;transition:transform .5s,opacity 1s}
		.ripple:active:after{transform:scale(0,0);opacity:.2;transition:0s}
		.btn-primary{color:#fff;background-color:#DC3545;border-color:#DC3545;}
		.btn-primary:hover{background-color:#c82333;border-color:#bd2130;}
		.btn-primary:focus{background-color:#c82333;border-color:#bd2130;box-shadow:0 0 0 0.2rem rgba(200, 35, 51, 0.5)!important;}
		.nice-select.wide{width:100%}
		.nice-select.wide .list{left:0 !important;right:0 !important}
		.custom-select-form .nice-select{-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;border:1px solid #d2d8dd;height:45px;line-height:42px}
		.custom-select-form .nice-select:hover{border-color:#d2d8dd}
		.custom-select-form .nice-select:active,.custom-select-form .nice-select.open,.custom-select-form .nice-select:focus{border-color:#80bdff;outline:0;box-shadow:0 0 0 0.2rem rgba(0,123,255,0.25)}
		.custom-select-form select{display:none} 
		.custom-select-form .nice-select{border:none;height:50px;line-height:50px;border-radius:4px 0 0 4px;border-right:1px solid #d2d8dd !important;}
		.nice-select .list{box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;width:100%;}
		.nice-select.open .list{height:250px;overflow-y:auto;}
		.custom-select-form .nice-select:active, .custom-select-form .nice-select.open, .custom-select-form .nice-select:focus {border-color:#fff;outline:0;box-shadow:none;}
		.wrn-btn span{cursor:pointer;display:inline-block;position:relative;transition:.5s}
		.wrn-btn span:after{content:\'\00bb\';position:absolute;opacity:0;top:-8px;right:-20px;transition:.5s;font-size:24px;}
		.wrn-btn:hover span{padding-right:20px}
		.wrn-btn:hover span:after{opacity:1;right:0}
		.wrapper-grid{padding:0 20px}
		.box_grid{background-color:#fff;display:block;position:relative;margin-bottom:30px;-webkit-box-shadow:0px 0px 20px 0px rgba(0,0,0,0.1);-moz-box-shadow:0px 0px 20px 0px rgba(0,0,0,0.1);box-shadow:0px 0px 20px 0px rgba(0,0,0,0.1)}
		.box_grid .price{display:inline-block;font-weight:500;color:#999}
		.box_grid .price strong{color:#32a067}
		.box_grid a.wish_bt{position:absolute;right:15px;top:15px;z-index:1;background-color:#000;background-color:rgba(0,0,0,0.6);padding:7px 10px 7px 10px;display:inline-block;color:#fff;line-height:1;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px}
		.box_grid a.wish_bt:after{content:"\2661";-moz-transition:all 0.5s ease;-o-transition:all 0.5s ease;-webkit-transition:all 0.5s ease;-ms-transition:all 0.5s ease;transition:all 0.5s ease;font-size:20px;}
		.box_grid a.wish_bt.liked:after{content:"\e089";color:#fc5b62}
		.box_grid a.wish_bt:hover.liked:after{color:#fc5b62}
		.box_grid a.wish_bt:hover:after{content:"\e089";color:#fff}
		.box_grid figure{margin-bottom:0;overflow:hidden;position:relative;height:210px}
		.box_grid figure small{position:absolute;background-color:#000;background-color:rgba(0,0,0,0.6);left:20px;top:22px;text-transform:uppercase;color:#ccc;font-weight:600;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;padding:5px 10px 5px 10px;line-height:1}
		.box_grid figure .read_more{position:absolute;top:50%;left:0;margin-top:-12px;-webkit-transform:translateY(10px);-moz-transform:translateY(10px);-ms-transform:translateY(10px);-o-transform:translateY(10px);transform:translateY(10px);text-align:center;opacity:0;visibility:hidden;width:100%;-webkit-transition:all 0.6s;transition:all 0.6s;z-index:2}
		.box_grid figure .read_more span{background-color:#fcfcfc;background-color:rgba(255,255,255,0.8);-webkit-border-radius:20px;-moz-border-radius:20px;-ms-border-radius:20px;border-radius:20px;display:inline-block;color:#222;font-size:12px;font-size:0.75rem;padding:5px 10px}
		.box_grid figure:hover .read_more{opacity:1;visibility:visible;-webkit-transform:translateY(0);-moz-transform:translateY(0);-ms-transform:translateY(0);-o-transform:translateY(0);transform:translateY(0)}
		.box_grid figure a img{position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%) scale(1.1);-moz-transform:translate(-50%, -50%) scale(1.1);-ms-transform:translate(-50%, -50%) scale(1.1);-o-transform:translate(-50%, -50%) scale(1.1);transform:translate(-50%, -50%) scale(1.1);-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;width:100%;-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out}
		.box_grid figure a:hover img{-webkit-transform:translate(-50%, -50%) scale(1);-moz-transform:translate(-50%, -50%) scale(1);-ms-transform:translate(-50%, -50%) scale(1);-o-transform:translate(-50%, -50%) scale(1);transform:translate(-50%, -50%) scale(1)}
		.box_grid .wrapper{padding:25px}
		.box_grid .wrapper h3{font-size:20px;font-size:1.25rem;margin-top:0}
		.box_grid ul{padding:20px 15px;border-top:1px solid #ededed}
		.box_grid ul li{display:inline-block;margin-right:15px}
		.box_grid ul li .score{margin-top:-10px}
		.box_grid ul li:last-child{margin-right:0;float:right}
		.score strong{background-color:#0054a6;color:#fff;line-height:1;-webkit-border-radius:5px 5px 5px 0;-moz-border-radius:5px 5px 5px 0;-ms-border-radius:5px 5px 5px 0;border-radius:5px 5px 5px 0;padding:10px;display:inline-block}
		.score span{display:inline-block;position:relative;top:7px;margin-right:8px;font-size:12px;font-size:0.75rem;text-align:right;line-height:1.1;font-weight:500}
		.score span em{display:block;font-weight:normal;font-size:11px;font-size:0.6875rem}
		.main_title_2 h2{margin:25px 0 0 0;color:#333;}
		.main_title_2 h3{margin:25px 0 0 0;color:#727272;}
		.main_title_2 p{margin:8px 0 0 0;color:#727272;}
		p{color:#727272;font-size:15px;line-height:20px;}
		a{color:#DC3545;}
		a:hover{text-decoration:none;color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'}
		.owl-carousel .owl-nav button.owl-next,.owl-carousel .owl-nav button.owl-prev,.owl-carousel button.owl-dot{background:rgba(0, 84, 166, 0.85)!important;color:inherit;border:none;padding:5px 14px!important;position:absolute;top:50%;color:#fff!impotant;border-radius:3px!impotant}
		.owl-carousel .owl-nav .owl-prev{left:0;}
		.owl-carousel .owl-nav .owl-prev span{font-size:20px;line-height:22px;}
		.owl-carousel .owl-nav .owl-prev:focus{outline:none;border:none;box-shadow:none}
		.owl-carousel .owl-nav .owl-next{right:0}
		.owl-carousel .owl-nav .owl-next span{font-size:20px;line-height:22px;}
		.owl-carousel .owl-nav .owl-next:focus{outline:none;border:none;box-shadow:none}
		#places{margin-top:40px}
		@media (max-width: 767px){#places{margin-top:0}
		}
		#places .item{margin:0 15px}
		#places .owl-item{opacity:0.5;transform:scale(0.85);-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;-webkit-transform:translateZ(0) scale(0.85, 0.85);transition:all 0.3s ease-in-out 0s;overflow:hidden}
		#places .owl-item.active.center{opacity:1;-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;-webkit-transform:translateZ(0) scale(1, 1);transform:scale(1)}
		#places .owl-item.active.center .item .title h4,#places .owl-item.active.center .item .views{opacity:1}
		.owl-theme .owl-dots{margin-top:10px !important;margin-bottom:25px}
		.search-sec .tag_line h3{font-size: 2.625rem;text-shadow: 4px 4px 12px rgba(0,0,0,0.3);color:#fff;margin:0;text-transform:uppercase;font-weight:700;}
		.search-sec .tag_line p{font-size: 21px;text-shadow: 4px 4px 12px rgba(0,0,0,0.3);color:#fff;margin:5px 0 0 0;font-weight:400;}
		.custom_header{position:absolute;top:0;z-index:99;width:100%;background: rgba(26,70,104,.51) !important;border-radius:0;}
		.navbar .navbar-brand{color:#fff!important;font-size:30px;}
		.navbar .navbar-nav li a{color:#fff!important;}
		.navbar .navbar-nav li.active a{color:#DC3545!important;}
		#side-menu{display:none;position:fixed;width:320px;top:0;right:-300px;height:100%;overflow-y:auto;z-index:99999;background:#fff;padding:20px 15px;color:#333;transition:.4s;box-shadow:-5px 0 20px rgba(0, 0, 0, 0.2);}
		body.side-menu-visible #side-menu{transform:translateX(-300px);overflow:hidden;}
		#side-menu .logo{max-width:65%;}
		#side-menu .contents{margin-top:00px;border-top:1px solid #eee;padding-top:20px;}
		#side-menu li.nav-item:before{content:\'\203A\';position:absolute;left:2px;top:7px;}
		#side-menu li.nav-item{padding-left:20px;}
		#side-menu .nav-link{color:#333;font-size:14px;font-weight:600;padding:10px 0}
		#side-menu .nav-link:hover{opacity:.8;color:#1b820a;}
		#side-menu li.nav-item.dropdown.show{border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:10px;}
		#side-menu .close{font-size:36px;font-weight:400;position:absolute;top:5px;right:15px;}
		#side-menu .contact a, #side-menu .contact .fa{padding:5px 0px;background:#fff;font-size:14px;color:#727272;}
		#side-menu .contact a:hover, #side-menu .contact .fa:hover{color: #28ab13 !important;}
		#side-menu .contact a:focus, #side-menu .contact .fa:focus{color: #28ab13 !important;}
		.dadosOrigin{position:absolute;}
		.dadosOrigin ul li{margin-top: 0 !important;}
		table td, table th{padding:9px;font-family: \'Montserrat\';font-weight: 600;}
		table caption+thead tr:first-child td, table caption+thead tr:first-child th, table colgroup+thead tr:first-child td, table colgroup+thead tr:first-child th, table thead:first-child tr:first-child td, table thead:first-child tr:first-child th{
			border-top:none !important;
			font-size:17px !important;
		    text-transform: capitalize;
		}
		.daterangepicker .calendar-table th, .daterangepicker .calendar-table td{text-transform:uppercase}
		.daterangepicker td.start-date{border-radius:40px 0px 0px 40px}
		.daterangepicker td.end-date{border-radius:0px 40px 40px 0px}
		.daterangepicker.show-calendar .drp-buttons{font-family: \'Montserrat\'}
		.daterangepicker td.start-date.end-date{border-radius:40px}
		.cancelBtn{color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd !important}
		.cancelBtn:hover{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd !important;color:#fff !important}
		.applyBtn{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).' !important;border-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).' !important}
		.applyBtn:hover{background-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'bd !important}
		.daterangepicker .drp-selected{display:none !important;}
		.btnAddRoom{font-size: 13px;font-weight: 700;color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';padding:6px 0;background-color:#fff;font-family: \'Montserrat\'}
		.btnAddRoom:hover{color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'ee;background-color:#fff;}
		.btnApplyRoom{background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';color: #fff;font-size: 14px;font-weight: 600;border-radius: 40px;padding: 5px 30px;float: right;}
		.btnApplyRoom:hover{background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'d4;}
		.ripple{background-color:'.(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' )).' !important;border:transparent !important}
		.ripple:hover{background-color:'.(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' )).'80 !important}
		.dadosOrigin:after{
			bottom: 100%;
		    left: 15px;
		    border: solid transparent;
		    content: " ";
		    height: 0;
		    width: 0;
		    position: absolute;
		    pointer-events: none;
		    border-bottom-color: #fff;
		    border-width: 7px;
		    margin-left: -7px;
		}
		.dadosOrigin ul li:hover{
			background-color: #f1f1f1;
		}
		.banner{
		margin: 10px 0px;
		} 
		button.typeFlight { 
		    border-radius: 40px;
		    font-size: 13px;
		    font-weight: 600;
		    color: #fff;
		    border: 1px solid #fff;
		}
		button.typeFlight.active, button.typeFlight:hover { 
		    color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'; 
		    background-color: #fff;
		}
		/* The radio */
		.radio {
		 
		        display: inline;
		    position: relative;
		    padding-left: 15px;
		    margin-bottom: 12px;
		    cursor: pointer;
		    font-size: 20px;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none
		}
		.form-check-label{
			color: #fff;
		}

		/* Hide the browsers default radio button */
		.radio input {
		    position: absolute;
		    opacity: 0;
		    cursor: pointer;
		}

		/* Create a custom radio button */
		.checkround {

		    position: absolute;
		    top: 6px;
		    left: 0;
		    height: 12px;
		    width: 12px;
		    background-color: #fff ;
		    border-color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
		    border-style:solid;
		    border-width:2px;
		     border-radius: 50%;
		}


		/* When the radio button is checked, add a blue background */
		.radio input:checked ~ .checkround {
		    background-color: #fff;
		}

		/* Create the indicator (the dot/circle - hidden when not checked) */
		.checkround:after {
		    content: "";
		    position: absolute;
		    display: none;
		}

		/* Show the indicator (dot/circle) when checked */
		.radio input:checked ~ .checkround:after {
		    display: block;
		}

		/* Style the indicator (dot/circle) */
		.radio .checkround:after {
		     left: 2px;
		    top: 2px;
		    width: 6px;
		    height: 6px;
		    border-radius: 50%;
		    background:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
		    
		 
		}
        .custom-select-form ul li{
            padding: 12px 10px !important;
            font-size: 13px !important;
        }

        .elementor-element-3eab11e:hover{
        	border: 1px solid '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
    		border-radius: 50px;
        }
        @media (min-width: 576px){
			.modal-dialog {
			    max-width: 605px !important;
			    margin: 1.75rem auto;
			}
			.modal-content{
			    width: 605px !important;
			}
		}
		</style>';

	$retorno .= '<input type="hidden" id="url_ajax" value="'.admin_url('admin-ajax.php').'">';

	$retorno .= '
	<section class="banner">  
		<div class="search-sec container">
            <input type="hidden" id="type_motor" value="0"> 

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
					<h4 style="color: #fff;font-weight: 600;font-size: 17px;margin-bottom: 22px;"> Passagens Aéreas
					</h4> 
						<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typeFlight" id="flightRoundTrip" value="1" style="    margin-top: 4px;"  onclick="change_type_flight(1)">
					  	<label class="form-check-label" for="flightRoundTrip" style="    font-size: 13px;">Ida e Volta</label>
					</div>
						<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typeFlight" id="oneWay" value="2" style="    margin-top: 4px;" onclick="change_type_flight(2)">
					  	<label class="form-check-label" for="oneWay" style="    font-size: 13px;">Somente Ida</label>
					</div>
						<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typeFlight" id="multiWay" value="3" style="    margin-top: 4px;" onclick="change_type_flight(3)">
					  	<label class="form-check-label" for="multiWay" style="    font-size: 13px;">Multidestino</label>
					</div>
					<div class="row no-gutters custom-search-input-2" id="flightsPadron" style=""> 
						<div class="col-lg-12">
							<div class="form-group fieldFrom">
								<div class="custom-select-form">
									<label style="">ORIGEM</label>
									<input type="text" class="form-control" id="field_name_origin_flight" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
									<div class="dadosOrigin">
										<ul style="padding:0;margin: 0;"></ul>
									</div>
								</div> 
							</div> 
							<div class="form-group fieldTo">
								<div class="custom-select-form">
									<label style="">DESTINO</label>
									<input type="text" class="form-control" id="field_name_destin_flight" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
									<div class="dadosDestin">
										<ul style="padding:0;margin: 0;"></ul>
									</div>
								</div>  
							</div>
						</div>
						<div class="col-lg-12 fieldDates" style="background: #fff">
								<label style=" ">DATAS</label> 
						</div>
						<div class="col-lg-12 fieldDates">
							<div class="form-group" style=""> 
								<input class="form-control search-slt" type="text" name="dateGo" placeholder="Informe a partida" autocomplete="off" readonly="readonly"> 
							</div>
							<div class="form-group dateReturn" style=""> 
								<input class="form-control search-slt" type="text" name="dateBack" placeholder="Informe o retorno" autocomplete="off" readonly="readonly"> 
							</div>
						</div>
						<div class="col-lg-12 fieldPax" style="    background-color: #fff;margin-bottom: 14px;">
							<label class="label" style="">PASSAGEIROS E CLASSE</label>
							<div class="panel-dropdown-flights panelDropdownFlights" id="panelDropdownFlights" style="padding: 10px 0px;">
								<a href="#"><i class="fa fa-user" style="position: unset;padding: 0;line-height: 1;height: auto;margin-left: 8px;BORDER: NONE;"></i> <span class="qtyTotalFlights">2</span> pessoas, <span class="classTrip">Econômica</span></a>
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
												<label style="line-height:1">
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
															<option value="1">Econômica</option>
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
						<div class="col-lg-12">
							<button type="submit" class="btn_search btn btn-danger wrn-btn ripple" onclick="search_results_flights()"><span>Buscar </span></button>
						</div>
					</div>
					<div class="no-gutters custom-search-input-2" id="multiway" style="display:none"> 
						<div class="row" id="trecho1">
							<div class="col-lg-12"> 
								<h4 class="idtrecho" style="margin: 0;width: 100%;text-align: left;">Trecho 1</h4>
							</div>
							<div class="col-lg-12">
								<div class="form-group fieldFrom">
									<div class="custom-select-form">
										<label style="">ORIGEM</label>
										<input type="text" class="form-control" id="field_origin_trecho1" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
										<div id="dados_trecho1" class="dados">
											<ul style="padding:0;margin: 0;"></ul>
										</div>
									</div> 
								</div>
								<div class="form-group fieldChange" style="position: absolute;top: 35%;right: 15px;border-radius: 0;padding: 10px 25px 11px 10px;"> 
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
								</div>
							</div>
							<div class="col-lg-12 fieldDates">
								<div class="form-group" style="width:100%">
                                    <div class="custom-select-form">
    									<label style="">DATAS</label>
    									<input class="form-control search-slt" type="text" name="date_trecho1" placeholder="Informe a partida" autocomplete="off" readonly="readonly" style="height: 27px !important;"> 
                                    </div>
								</div>
							</div>
						</div>
						<div class="row" id="trecho2">
							<div class="col-lg-12"> 
								<h4 class="idtrecho" style="margin: 0;width: 100%;text-align: left;">Trecho 2</h4>
							</div>
							<div class="col-lg-12">
								<div class="form-group fieldFrom">
									<div class="custom-select-form">
										<label style="">ORIGEM</label>
										<input type="text" class="form-control" id="field_origin_trecho2" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
										<div id="dados_trecho2" class="dados">
											<ul style="padding:0;margin: 0;"></ul>
										</div>
									</div> 
								</div>
								<div class="form-group fieldChange" style="position: absolute;top: 35%;right: 15px;border-radius: 0;padding: 10px 25px 11px 10px;"> 
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
								</div>
							</div>
							<div class="col-lg-12 fieldDates">
								<div class="form-group" style="width:100%">
                                    <div class="custom-select-form">
    									<label style="">DATAS</label>
    									<input class="form-control search-slt" type="text" name="date_trecho2" placeholder="Informe a partida" autocomplete="off" readonly="readonly" style="height: 27px !important;"> 
                                    </div>
                                </div>
							</div>
							<div class="col-lg-12 fieldPax hideTrecho2">
								 <span></span>
							</div>
							<div class="col-lg-12 hideTrecho2" style="position: relative;bottom: 7px;">
								<span class="showSpan2" style="font-weight: 700;color: #fff;font-size: 12px;cursor: pointer;float: left;" onclick="show_trecho(3, 2)">+ Novo trecho</span>
							</div>
						</div>
						<div class="row" id="trecho3" style="display:none">
							<div class="col-lg-12"> 
								<h4 class="idtrecho" style="margin: 0;width: 100%;text-align: left;">Trecho 3</h4>
							</div>
							<div class="col-lg-12">
								<div class="form-group fieldFrom">
									<div class="custom-select-form">
										<label style="">ORIGEM</label>
										<input type="text" class="form-control" id="field_origin_trecho3" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
										<div id="dados_trecho3" class="dados">
											<ul style="padding:0;margin: 0;"></ul>
										</div>
									</div> 
								</div>
								<div class="form-group fieldChange" style="position: absolute;top: 35%;right: 15px;border-radius: 0;padding: 10px 25px 11px 10px;"> 
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
								</div>
							</div>
							<div class="col-lg-12 fieldDates">
								<div class="form-group" style="width:100%">
                                    <div class="custom-select-form">
    									<label style="">DATAS</label>
    									<input class="form-control search-slt" type="text" name="date_trecho3" placeholder="Informe a partida" autocomplete="off" readonly="readonly" style="height: 27px !important;"> 
                                    </div>
                                </div>
							</div>
							<div class="col-lg-12 fieldPax hideTrecho3" style="margin-bottom: 10px">
                                <span class="showSpan3" style="font-weight: 700;color: #fff;font-size: 12px;cursor: pointer;float: left;" onclick="show_trecho(4, 3)">+ Novo trecho</span>
								<span class="hideSpan3" style="font-weight: 700;color: #ffa1a1;font-size: 12px;cursor: pointer;float: right;" onclick="hide_trecho(3)">- Remover trecho</span>
							</div> 
						</div>
						<div class="row" id="trecho4" style="display:none">
							<div class="col-lg-12"> 
								<h4 class="idtrecho" style="margin: 0;width: 100%;text-align: left;">Trecho 4</h4>
							</div>
							<div class="col-lg-12">
								<div class="form-group fieldFrom">
									<div class="custom-select-form">
										<label style="">ORIGEM</label>
										<input type="text" class="form-control" id="field_origin_trecho4" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
										<div id="dados_trecho4" class="dados">
											<ul style="padding:0;margin: 0;"></ul>
										</div>
									</div> 
								</div>
								<div class="form-group fieldChange" style="position: absolute;top: 35%;right: 15px;border-radius: 0;padding: 10px 25px 11px 10px;"> 
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
								</div>
							</div>
							<div class="col-lg-12 fieldDates">
								<div class="form-group" style="width:100%">
                                    <div class="custom-select-form">
    									<label style="">DATAS</label>
    									<input class="form-control search-slt" type="text" name="date_trecho4" placeholder="Informe a partida" autocomplete="off" readonly="readonly" style="height: 27px !important;"> 
                                    </div>
                                </div>
							</div>
							<div class="col-lg-12 fieldPax hideTrecho4" style="margin-bottom: 10px">
                                <span class="showSpan4" style="font-weight: 700;color: #fff;font-size: 12px;cursor: pointer;float: left;" onclick="show_trecho(5, 4)">+ Novo trecho</span>
								<span class="hideSpan4" style="font-weight: 700;color: #ffa1a1;font-size: 12px;cursor: pointer;float: right;" onclick="hide_trecho(4)">- Remover trecho</span>
							</div> 
						</div>
						<div class="row" id="trecho5" style="display:none">
							<div class="col-lg-12"> 
								<h4 class="idtrecho" style="margin: 0;width: 100%;text-align: left;">Trecho 5</h4>
							</div>
							<div class="col-lg-12">
								<div class="form-group fieldFrom">
									<div class="custom-select-form">
										<label style="">ORIGEM</label>
										<input type="text" class="form-control" id="field_origin_trecho5" autocomplete="off" placeholder="Informe a cidade..." onfocus="this.value=\'\'">
										<div id="dados_trecho5" class="dados">
											<ul style="padding:0;margin: 0;"></ul>
										</div>
									</div> 
								</div>
								<div class="form-group fieldChange" style="position: absolute;top: 35%;right: 15px;border-radius: 0;padding: 10px 25px 11px 10px;"> 
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
								</div>
							</div>
							<div class="col-lg-12 fieldDates">
								<div class="form-group" style="width:100%">
                                    <div class="custom-select-form">
    									<label style="">DATAS</label>
    									<input class="form-control search-slt" type="text" name="date_trecho5" placeholder="Informe a partida" autocomplete="off" readonly="readonly" style="height: 27px !important;"> 
                                    </div>
                                </div>
							</div>
							<div class="col-lg-12 fieldPax hideTrecho5" style="margin-bottom: 10px">
								<span class="hideSpan5" style="font-weight: 700;color: #ffa1a1;font-size: 12px;cursor: pointer;float: right;" onclick="hide_trecho(5)">- Remover trecho</span>
							</div>
							<div class="col-lg-12" style="position:relative">
								 
							</div>
						</div>
                        <div class="row"> 
                            <div class="col-lg-12 fieldPax">
                                <div style="    background-color: #fff;margin-bottom: 14px;">
                                    <label class="label" style="">PASSAGEIROS E CLASSE</label>
                                    <div class="panel-dropdown-flights panel-multi" id="panelDropdownMultiFlights" style="padding: 10px 0px;">
                                        <a href="#"> <span class="qtyTotalMultiFlights">2</span> pessoas, <span class="classeTripMulti">Econômica</span></a>
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
                                                        <label style="line-height:1">
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
                                                                    <option value="1">Econômica</option>
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
                            </div>
                            <div class="col-lg-12">
                                
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
	</section> ';

	$retorno .= '<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
	<script src="https://www.jqueryscript.net/demo/Customizable-Animated-Dropdown-Plugin-with-jQuery-CSS3-Nice-Select/js/jquery.nice-select.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
	<script src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/js/script-search-flights.js?v='.date("YmdHis").'&amp;ver=6.2.2" id="scripts-flights-js"></script>';

	return $retorno;

}

add_shortcode('TTBOOKING_RESULTADOS_FLIGHTS', 'shortcode_resultados_flights');  

function shortcode_resultados_flights(){
	$retorno = '';

	$retorno .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
	$retorno .= '<link rel="preconnect" href="https://fonts.googleapis.com">
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
				<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
				<link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" rel="stylesheet">
				<link href="'.plugin_dir_url( __FILE__ ) . 'includes/assets/css/results.css?v='.date("YmdHis").'" rel="stylesheet">'; 

	$retorno .= '<style>
		body{
			background-color: #efefef !important;
		}
		.dadosGerais{
			font-family: \'Montserrat\', sans-serif !important;
		}

		.rowGeral{
			margin: 15px 0px;
			border: 1px solid #eee;
    		padding: 20px;
    		font-family: \'Montserrat\', sans-serif;
		}
		.rowGeral:hover{
    		box-shadow: 2px 2px 6px #fafafa;
		}
		.rowInterna label{
			text-transform: uppercase;
			font-weight: 700;
			font-size: 13px;
			background-color: #0c9dbf;
			padding: 5px 0px;
    		color: #fff;
    		width: 100%;
		}
		.rowInterna p{
    		font-size: 15px;
    		margin: 10px 0px; 
		}
		.rowPrice{
			font-size: 13px;
		    width: 100%;
		    padding: 12px;
		    margin: 13px 0;
		    background-color: #f8f8f8;
		}
		@media(max-width: 766px){
			.rowHotel{
				margin: 20px 0 !important
			}
			.rowHotel .colImage img{
				width: 100% !important;
				border-radius: 10px 10px 0px 0px !important;
			}
			.rowHotel .colDetails, .rowHotel .colSelect{
				text-align: center !important;
			}
			.rowHotel .colDetails div{
				margin: 0 !important;
			}
			.rowHotel .colSelect .desc{
				font-size: 16px !important; 
			}
			.rowHotel .colSelect .price{
				font-size: 29px !important;
			}
			.rowHotel .colSelect .included_price{
				margin-top: 20px !important;
			}
			.rowHotel .colDetails .payment span, .rowHotel .colSelect .included_price span{
				font-size: 13px !important;
			}
			.divisor{
				display: none;
			}
			.responsiveBR{
				display: inherit;
			}
			#show_results{
				padding: 10px;
			}
		}

		@media(min-width:767px){
			.modal-content{
				width: 450px !important;
			}
			.rowMeioInterna{
				padding: 0 20px !important;
			}
			.responsivePadding{
				padding-left: 0 !important;
			}

			.rowHotel{
				height: 274px;
				margin-left: 0px !important;
			}
			.rowHotel .colImage img{
				border-radius: 10px 0px 0px 10px;
				height: 273px;
				width: 100% !important;
			}
			.rowHotel .colDetails h5{
				font-size: 20px;
			    line-height: 27px;
			}  
			.rowHotel .colDetails div{
				margin: 12px 0;
			}
			.rowHotel .colDetails .payment{
				position: absolute;
				bottom: 0;
			}
			.rowHotel .colSelect{
				border-left: 1px solid #ddd;
			}
			.rowHotel .colSelect .included_price{
				margin-top: 20px;
			} 
			.rowHotel .colSelect .included_price{
				position: absolute;
				bottom: 7px;
    			margin-right: 14px;
			}
			.divisor{
				display: contents;
			}
			.responsiveBR{
				display: none;
			}
			.resultsOrder .selectOrder{
				width: 80%;
			}
			div.range{
				padding: 0px 28px;
			}
			div.filter-price{
				min-height: 160px
			}
			.accordion-body{
				padding: 5px 20px;
			}
			.accordion-button{
				padding: 20px 0px 20px 20px;
			}
		}

		.rowHotel{
			background-color: #fff;
    		border-radius: 10px;
    		border: 1px solid #ddd;
    		margin-bottom: 20px;
    		font-family: \'Montserrat\'
		}
		.rowHotel .colImage{
			padding: 0
		}
		.rowHotel .colDetails, .rowHotel .colSelect{
			padding: 15px;
		}
		.rowHotel .colDetails h5{
		    font-weight: 600;
		    color: #3e3e3e;
		    margin-bottom: 0;
		}
		.rowHotel .colDetails h5 img{
			display: inline;
    		margin-top: -4px;
		}
		.rowHotel .colDetails h6{ 
		    color: #3e3e3e;
		    margin-top: 5px;
		    margin-bottom: 0;
		    font-size: 13px;
		}
		.rowHotel .colDetails span.address, .rowHotel .colSelect .desc{
			font-size: 12px;
		    line-height: 16px;
		    font-weight: 500;
		}
		.rowHotel .colDetails .review{
			padding: 5px;
		    background-color: #03a691;
		    font-size: 12px;
		    color: #fff;
		    margin-right: 5px;
		    border-radius: 6px;
		    font-weight: 600;
		    width: 27px;
		    display: inline-block;
		    height: 27px;
		}
		.rowHotel .colDetails .fa-star{
			font-size: 12px;
    		color: #f3ae0c;
    		margin-right:2px;
		}
		.rowHotel .colDetails .inclusion{
			border-left:1px solid #ddd;
			margin-left: 3px;
    		padding-left: 6px;
		}
		.rowHotel .colDetails .inclusion i{
			font-size: 16px;
    		color: #3e3e3e;
    		padding-right: 4px;
		}
		.rowHotel .colDetails .payment span, .rowHotel .colSelect .included_price span{
			font-size: 11px;
    		font-weight: 700;
    		letter-spacing: 0.5px;
    		color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
    		cursor: pointer;
		}
		.rowHotel .colDetails .payment span:hover, .rowHotel .colSelect .included_price span:hover{
			color: #575658;
		}
		.rowHotel .colSelect .desc{
			color: #000;
		}
		.rowHotel .colSelect .price{
			margin-top: 9px;
    		font-size: 24px;
    		color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
    		font-weight: 700;
    		margin-bottom: 0;
		}
		.rowHotel .colSelect .price .currency{ 
   			font-size: 14px; 
    		font-weight: 500;
		}
		.rowHotel .colSelect .tax{
			font-size: 11px; 
    		letter-spacing: 0.5px; 
		}
		.rowHotel .btnSelect{
			background-color: '.(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' )).'d4;
		    margin: 10px 0;
		    width: 100%;
		    border-radius: 40px;
		    color: #fff;
		    font-weight: 700;
		    letter-spacing: 0.2px;
		    font-size: 15px;
		}
		.rowHotel .btnSelect:hover{
			background-color: '.(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' )).'; 
		}

		.blog .carousel-indicators {
			left: 0;
			top: auto;
    		bottom: -40px; 
		}

		/* The colour of the indicators */
		.blog .carousel-indicators li {
		    background: #a3a3a3;
		    border-radius: 50%;
		    width: 8px;
		    height: 8px;
		}

		.blog .carousel-indicators .active {
			background: #707070;
		}

		.banner{
			margin: 0 !important;
		}

		.resultsOrder{
			margin-bottom: 20px;
		}
		.resultsOrder .selectOrder{
			border-radius: 8px;
		    font-family: \'Montserrat\';
		    font-size: 13px;
		    cursor:pointer;
		    border: 1px solid '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
		}
		.resultsOrder label{
			font-size: 10px;
		    font-weight: 700;
		    font-family: \'Montserrat\';
		    margin-bottom: 0;
		    color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';
		}
		.filter hr{
			margin: 20px 0;
    		border-top: 1px solid #6f6f6f; 
		}
		.filter .accordion-button, .filter .accordion-body{
			background-color: #f0f0f0 !important;
			color: #000 !important;
			border: none !important;
			font-family: \'Montserrat\' !important;
			box-shadow: none !important;
		}
		.filter .accordion-button{
			font-weight: 700;
		} 
		.noUi-horizontal .noUi-tooltip{
			bottom: -150%
		}
		.price-range-right, .price-range-left{
			font-weight: 700;
    		font-size: 13px;
		}
		.info-flex{
			font-size: 11px;
		    letter-spacing: 0.2px;
		    line-height: 1.4;
		    margin-bottom: 0;
		}
		.form-check-input{
			width: 1em;
			height: 1em;
		}
		.span-qty{
			width: 2rem;
		    height: 1.6rem;
		    border: 1px solid #c7c7c7;
		    border-radius: 5px;
		    font-size: 12px;
		    padding: 3px 6px;
		    font-weight: 700;
		    margin-bottom: 0;
		}
		.accordion-body .row{
			margin-bottom: 8px;
		}
		.form-check-label{
			margin-left: 8px;
		}
		.accordion-body .fa{
			color: #575757;
		}

        .row-is-loading{
            background: #eee;
            background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
            border-radius: 5px;
            background-size: 200% 100%;
            animation: 1.5s shine linear infinite;
            min-height: 60px;
        }

		.row-is-loading h5, .row-is-loading h6, .row-is-loading .div-review, .row-is-loading .payment, .row-is-loading .colSelect .desc, .row-is-loading .colSelect .price, .row-is-loading .colSelect .tax, .row-is-loading .colSelect .included_price, .row-is-loading .colImage{
			background: #eee;
		    background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
		    border-radius: 5px;
		    background-size: 200% 100%;
		    animation: 1.5s shine linear infinite;
		}
		.row-is-loading .filter-price-flights, .row-is-loading .filter-stops-flights, .row-is-loading .filter-luggage-flights, .row-is-loading .filter-hour-flights{
			background: #eee;
		    background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
		    border-radius: 5px;
		    background-size: 200% 100%;
		    animation: 1.5s shine linear infinite;
		}

		.row-is-loading .filter-price-flights{
			height: 160px;
		}
		.row-is-loading .filter-stops-flights, .row-is-loading .filter-luggage-flights, .row-is-loading .filter-hour-flights{
			height: 60px;
		}

		.row-is-loading .colSelect .desc, .row-is-loading .colSelect .tax{
			height: 15px;
		}
		.row-is-loading .colSelect .price{
			height: 24px;
		} 
		.row-is-loading .colSelect .included_price{
			height: 42px;
			width: 84%;
		}
		.row-is-loading .payment{
			height: 22px;
			width: 91%;
		}
		.row-is-loading h6{
			height: 20px;
		}
		.row-is-loading .div-review{
			height: 22px;
		}
		.row-is-loading .colImage{
			height: 272px;
		}

		@keyframes shine {
		  	to {
		    	background-position-x: -200%;
		  	}
		}

		.modal-open .modal{
			font-family: \'Montserrat\';
		}
		.bootbox-close-button{
			background-color: transparent !important;
			color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).' !important;
		}

	</style>';  

    $retorno .= '<input type="hidden" id="type_reserva_flights" value="'.get_option( 'type_reserva_flights' ).'">';
    $retorno .= '<input type="hidden" id="color_flights" value="'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'">';

	$retorno .= '<div class="container">
		<div class="row">
			<div class="col-lg-3 col-12 responsivePadding">';
				$retorno .= do_shortcode('[TTBOOKING_MOTOR_RESERVA_FLIGHT_LATERAL]'); 

				$retorno .= '<div id="filter" class="filter row-is-loading">

					<div class="filter-price-flights">
						 
					</div> 

					<hr> 

					<div class="filter-stops-flights">
						 
					</div>

					<hr> 

					<div class="filter-luggage-flights">
						 
					</div> 

				</div>';
			$retorno .= '</div>
			<div class="col-lg-9 col-12">
				<div id="show_results">
					<div class="loader" style="display:none">
						<br>
						<h6 style="text-align:center;font-family: \'Montserrat\';line-height: 1.4;">Aguarde... <br> Estamos buscando as melhores ofertas.</h6>
						<img src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/img/loader.gif" style="margin: 0 auto"> 
					</div>
					<div class="results"> 
						<div class="resultsFlights">';
							for($i=0; $i<10; $i++){
								$retorno .= '<div class="elementor-container elementor-column-gap-default" style="margin-bottom: 20px;display:flex;background-color: #fff; ">
								    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-3c1f62c" data-id="3c1f62c" data-element_type="column" data-settings=\'{"background_background":"classic"}\' style="width:75%">
								        <div class="elementor-widget-wrap elementor-element-populated">
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no row-is-loading"
								                data-id="bdb8934"
								                data-element_type="section" style="margin-bottom: 30px;"
								            >
								                <div class="elementor-container elementor-column-gap-default">

								                </div>
								            </section>   
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-bdb8934 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no row-is-loading"
								                data-id="bdb8934"
								                data-element_type="section" style="margin-bottom: 30px;"
								            >
								                <div class="elementor-container elementor-column-gap-default">

								                </div>
								            </section>  
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-764c24b elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no row-is-loading"
								                data-id="764c24b"
								                data-element_type="section"
								            > 
								            </section>
								        </div>
								    </div>

								    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-8a66ad2 rowJur" data-id="8a66ad2" data-element_type="column" data-settings=\'{"background_background":"classic"}\'>
								        <div class="elementor-widget-wrap elementor-element-populated">
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-29d3bb9 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no"
								                data-id="29d3bb9"
								                data-element_type="section"
								            >
								                <div class="elementor-container elementor-column-gap-default">
								                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8ce4cf7 row-is-loading" data-id="8ce4cf7" data-element_type="column" style="height: 20px !important;min-height: 20px;"> 
								                    </div>
								                </div>
								            </section>
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-83cc7be elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no"
								                data-id="83cc7be"
								                data-element_type="section" style="margin-bottom: 30px;"
								            >
								                <div class="elementor-container elementor-column-gap-default">
								                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6fbcd6c row-is-loading" data-id="6fbcd6c" data-element_type="column"> 
								                    </div>
								                </div>
								            </section> 
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-29d3bb9 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no"
								                data-id="29d3bb9"
								                data-element_type="section"
								            >
								                <div class="elementor-container elementor-column-gap-default">
								                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8ce4cf7 row-is-loading" data-id="8ce4cf7" data-element_type="column" style="height: 20px !important;min-height: 20px;"> 
								                    </div>
								                </div>
								            </section>
								            <section
								                class="elementor-section elementor-inner-section elementor-element elementor-element-29d3bb9 elementor-section-boxed elementor-section-height-default elementor-section-height-default wpr-particle-no wpr-jarallax-no wpr-parallax-no wpr-sticky-section-no"
								                data-id="29d3bb9"
								                data-element_type="section"
								            >
								                <div class="elementor-container elementor-column-gap-default">
								                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8ce4cf7 row-is-loading" data-id="8ce4cf7" data-element_type="column" style="height: 20px !important;min-height: 20px;"> 
								                    </div>
								                </div>
								            </section>
								        </div>
								    </div>
								</div>';
							}
						$retorno .= '</div>
					</div>
				</div> 
			</div> 
		</div>
	</div>';

	$retorno .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>';
	$retorno .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" crossorigin="anonymous"></script>';	
	$retorno .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js" crossorigin="anonymous"></script>';		
	$retorno .= '<script src="https://refreshless.com/nouislider/documentation/assets/wNumb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>';	 		
	$retorno .= '<script src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/js/scripts-results.js?v='.date("dmYHis").'" crossorigin="anonymous"></script>';	 		

	return $retorno;
}

add_shortcode('TTBOOKING_CHECKOUT_FLIGHTS', 'shortcode_checkout_flights_reserva');  



function shortcode_checkout_flights_reserva(){

	$retorno = '';



	$retorno .= '

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

		<link rel="preconnect" href="https://fonts.googleapis.com">

		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

		<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> '; 



	$retorno .= '<style>

		body{

			background-color: #efefef !important;

			font-family: \'Montserrat\', sans-serif !important;

		} 

		.container-fluid{ 

			font-family: \'Montserrat\', sans-serif !important;

		}



		.contact, .address, .guests, .resume-price, .detail, .pay{

			padding: 20px 30px;

		    border-radius: 10px;

		    background-color: #fff;

		    border: 1px solid #ddd;

		    margin-bottom: 25px;

		}

		.contact h5, .address h5, .guests h5{

			margin-bottom: 30px;

			color: #333;

		}

		.contact label, .address label, .guests label{

			font-weight: 600;

		    color: #333;

		    margin-bottom: 8px;

		    font-size: 13px;

		    text-transform: uppercase;

		}

    	.input-group-prepend{

    		padding: 10px 16px;

		    background-color: #f0f0f0;

		    color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';

		    border-radius: 10px 0px 0px 10px;

    	}

    	.input-group .form-control{

    		border: 1px solid #f0f0f0;

    		border-radius: 0;

    		font-size: 15px;

    	}

    	.input-group .form-control:focus{

    		box-shadow: none;

    		border: 1px solid #f0f0f0;

    	}

    	.guests .qt{

    		color: #333;

    		font-size: 16px;

    	}

    	.guests .guest{

    		color: #333;

    		font-size: 15px;

    		margin-bottom: 8px;

    	}

    	.guests .rowGuest{

    		border-bottom: 1px solid #ddd;

    		padding-bottom: 20px;

    		margin-bottom: 20px;

    	}

    	.resume-price .col-lg-8, .resume-price .col-lg-4, .resume-price .col-lg-12{

    		padding: 0 3px;

    	}

    	.data_price, .value_price{ 

		    font-size: 13px;

		    color: #333;

		    margin-bottom: 0;

    	}

    	.value_price{

    		text-align: right;

    	}

    	.resume-price hr, .detail hr{

    		margin: 15px 0;

    	}

    	.data_total_price{

    		margin-bottom: 0;

		    font-weight: 700;

		    font-size: 15px;

		    color: #333;

		    padding: 6px 0px;

    	}

    	.value_total_price{

    		margin-bottom: 0;

		    font-weight: 700;

		    font-size: 22px;

		    color: #333;

		    text-align: right;

    	}

    	.value_total_price .currency{

    		font-size: 13px;

    	}

    	.title-hotel, .date-hotel span, .date-hotel strong{

    		color: #333;

    		font-weight: 700;

    	}

    	.star-hotel{

    		margin-bottom: 5px;

    	}

		.address-hotel{

			color: #333;

			font-size: 12px;

		}

		.detailRoom p{

			margin-bottom: 02px;

			font-size: 13px;

		}

		.certiSign p{

			margin-bottom: 0;

			font-size: 13px;

			color: #333;

		}

		.btnSelect{

			background-color: '.(empty(get_option( 'cor_botao_ehtl' )) ? '#000000' : get_option( 'cor_botao_ehtl' )).'d4;

		    margin: 10px 0;

		    width: 100%;

		    border-radius: 40px;

		    color: #fff;

		    font-weight: 700;

		    letter-spacing: 0.2px;

		    font-size: 15px;

		}

		.btnSelect:hover{

			background-color: '.(empty(get_option( 'cor_botao_ehtl' )) ? '#000000' : get_option( 'cor_botao_ehtl' )).'; 

		    color: #fff;

		}



		@media(min-width:767px){ 

			.certiSign img{

				height: 36px;

				margin-bottom: 6px;

				float:right;

			}

			.show-mobile{

				display: none;

			}

		}



		@media(max-width:767px){

			.certiSign div{

				text-align: center;

			}

			.certiSign img{

				height: 36px;

				margin-bottom: 6px;

				margin: 0 auto;

			}

			#rowPrincipal{

				flex-direction: row-reverse;

			}

			.show-desktop{

				display: none;

			}

			.h4principal{

				font-size: 17px;

				margin-bottom: 20px !important

			}

		}

		.row-is-loading{

			background: #eee;

		    background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);

		    border-radius: 5px;

		    background-size: 200% 100%;

		    animation: 1.5s shine linear infinite;

		}



		/*

		 * CSS payment card

		 */ 



		.payment-card__footer{

			text-align: center;

			margin-top: 2rem;

		}



		.bank-card{

			position: relative;

		}



		@media screen and (min-width: 481px){



		    .bank-card{

		    	height: 21rem;

		    }



		    .bank-card__side{

		    	border-radius: 10px;

		    	border: 1px solid transparent;

				  position: absolute;

				  width: 65%;

		    }



		    .bank-card__side_front{

		    	background-color: '.(empty(get_option( 'cor_flights' )) ? '#f0f0ee' : get_option( 'cor_flights' )).';

		    	padding: 5%;

		    	box-shadow: 0 0 10px #545454;

		    	border-color: #a29e97;



		    	top: 0;

		    	left: 0;

		    	z-index: 3;

		    }



		    .bank-card__side_back{

		    	background-color: #e0ddd7;

		    	padding: 20.5% 5% 11%;

		    	box-shadow: 0 0 2rem #f3f3f3;



		    	text-align: right;

		    	border-color: #dad9d6;



				  top: 12%;

		    	right: 0;

		    }



		    .bank-card__side_back:before{

		    	content: "";

		    	width: 100%;

		    	height: 25%;

		    	background-color: '.(empty(get_option( 'cor_flights' )) ? '#8e8b85' : get_option( 'cor_flights' )).';



		    	position: absolute;

		    	top: 14%;

		    	right: 0;

		    }

		}



		@media screen and (max-width: 480px){



		    .bank-card__side{

		        border: 1px solid #a29e97;

		        background-color: '.(empty(get_option( 'cor_flights' )) ? '#f0f0ee' : get_option( 'cor_flights' )).';

		        padding-left: 5%;

		        padding-right: 5%;

		    }



		    .bank-card__side_front{

		        border-radius: 10px 10px 0 0;

		        border-bottom: none;

		        padding-top: 5%;

		    }



		    .bank-card__side_back{

		        border-radius: 0 0 10px 10px;

		        border-top: none;

		        padding-bottom: 5%;

		    }

		}



		.bank-card__inner{

			margin-bottom: 4%;

		}



		.bank-card__inner:last-child{

			margin-bottom: 0;

		}



		.bank-card__label{

			display: inline-block;

			vertical-align: middle;

		}



		.bank-card__label_holder, .bank-card__label_number{

			width: 100%;

		}



		@media screen and (min-width: 481px){



		    .bank-card__month, .bank-card__year, .bank-card__operadora{

		        width: 25%;

		    }

		}



		@media screen and (max-width: 480px){



		    .bank-card__month, .bank-card__year, .bank-card__operadora{

		        width: 48%;

		    }

		}



		@media screen and (min-width: 481px){



		    .bank-card__cvc{

		        width: 25%;

		    }

		}



		@media screen and (max-width: 480px){



		    .bank-card__cvc{

		        width: 100%;

		        margin-top: 4%;

		    }

		}



		.bank-card__hint{

			position: absolute;

			left: -9999px;

		}



		.bank-card__caption{

			text-transform: uppercase;

			font-size: 1.1rem;

		  margin-left: 1%;

		}



		.bank-card__field{

			box-sizing: border-box;

			border: 1px solid #cecece !important;

			width: 100%;

			height: 44px;

			padding: 1rem;

			font-family: inherit;

			font-size: 100%;

		}



		.bank-card__field:focus{

			outline: none;

			border-color: #fdde60;

		}



		.bank-card__separator{

			font-size: 3.2rem;

			color: #c4c4c3;



			margin-left: 3%;

			margin-right: 3%;

			display: inline-block;

			vertical-align: middle;

		}



		@media screen and (max-width: 480px){



		    .bank-card__separator{

		        display: none;

		    }

		}



		@media screen and (min-width: 481px){



		    .bank-card__footer{

		        background-image: url("https://stas-melnikov.ru/demo-icons/mastercard-colored.svg"), url("https://stas-melnikov.ru/demo-icons/visa-colored.svg");

		        background-repeat: no-repeat;

		        background-position: 78% 50%, 100% 50% ;

		    }

		}



		@media screen and (max-width: 480px){



		    .bank-card__footer{

		        display: flex;

		        justify-content: space-between;

		    }

		}



		.payment-card__button{



			background-color: #ada093;

			transition: background-color .4s ease-out;



			border-radius: 5px;

			border: 3px solid transparent;

			cursor: pointer;

			padding: 1rem 6.5rem;



			font-size: 100%;

			font-family: inherit;

			color: #fff;

		}



		.payment-card__button:focus{

			outline: none;

			border-color: #fdde60;

		}



		.payment-card__button:hover, .payment-card__button:focus{

			background-color: #8e8b85;

		}



		.demo{

			margin-top: 30px;

		}



	</style>';



	$retorno .= '<input type="hidden" id="type_reserva_flights" value="'.get_option('type_reserva_flights').'">';



	$retorno .= '<div class="container-fluid" style="margin: 40px 0">

		<div class="row">

			<div class="col-lg-12 col-12">

				<h4 class="h4principal"><strong>Complete seus dados para finalizar a <span id="hTextOrder">'.(get_option('type_reserva_flights') == 2 ? 'reserva' : 'solicitação').'</span>!</strong></h4>

			</div>

		</div>

		<div class="row" id="rowPrincipal">



			<div class="col-lg-4 col-12 col-xs-12 show-mobile"> 



				<h5 style="color:#333">Detalhe do pagamento</h5>



				<div class="resume-price row-is-loading" style="min-height:155px;"> 

					<div class="row mb-2"> 

						<div class="col-lg-12 col-12">
							<strong style="font-size:18px">Por adulto</strong><br>
							<p class="price_without_tax value_price"> </p>

						</div>

					</div>

					<div class="row mb-2">

						<div class="col-lg-8 col-8">

							<p class="data_price data_order"> </p>

						</div>

						<div class="col-lg-4 col-4">

							<p class="value_without_tax value_price"> </p>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-8 col-8">

							<p class="data_price">Impostos, taxas e encargos</p>

						</div>

						<div class="col-lg-4 col-4">

							<p class="value_price tax"> </p>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-12 col-12">

							<hr>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-6 col-8">

							<p class="data_total_price">TOTAL</p>

						</div>

						<div class="col-lg-6 col-4">

							<p class="value_total_price value_total"> </p>

						</div>

					</div>

				</div>



				<h5 style="color:#333">Detalhe da reserva</h5>



				<div class="row rowContact">

					<div class="col-lg-12 col-12">



						<div class="detail row-is-loading" style="min-height:306px;">

							<div class="row">

								<div class="col-lg-12 col-12">

									<i class="fas fa-plane-departure" style="font-size: 29px;"></i> 

									<h5 class="title-hotel"> </h5>

									<p class="star-hotel"> </p> 

									<p class="address-hotel"> </p>

								</div>

							</div>

							<div class="row">

								<div class="col-lg-6 col-6 date-hotel">

									<label class="">Partida</label>

									<br>

									<strong class="checkin"> </strong>

									<br>

									<span class="hour-flight-ida"> </span>

								</div>

								<div class="col-lg-6 col-6 date-hotel">

									<label class="">Retorno</label>

									<br>

									<strong class="checkout"> </strong>

									<br>

									<span class="hour-flight-volta"> </span>

								</div>

							</div>

							<div class="row">

								<div class="col-lg-12 col-12">

									<hr>

								</div>

							</div>

							<div class="row detailRoom">

								<div class="col-lg-12 col-12">

									<p class="detail_trip" style="line-height:2">

										 

									</p>

									<p class="name_room">

										 

									</p>

								</div>

							</div>

						</div>

					</div>

				</div>



			</div>



			<div class="col-lg-8 col-12 col-xs-12">



				<div class="row rowContact">

					<div class="col-lg-12 col-12">



						<div class="contact"> 

							<div class="row">

								<div class="col-lg-12 col-12">

									<h5>Dados do titular</h5>

								</div>

							</div>

							<div class="row">

								<div class="col-lg-6 col-12">

									<label>Nome completo</label>

									<div class="input-group mb-4">

									  	<div class="input-group-prepend">

									    	<i class="fa fa-user"></i>

									  	</div>

									  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu nome" id="nomeTitular" aria-describedby="basic-addon1" autocomplete="off">

									</div>

								</div>



								<div class="col-lg-6 col-12">

									<label>E-mail</label>

									<div class="input-group mb-4">

									  	<div class="input-group-prepend">

									    	<i class="fa fa-envelope"></i>

									  	</div>

									  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu e-mail" id="emailTitular" aria-describedby="basic-addon1" autocomplete="off">

									</div>

								</div>



								<div class="col-lg-6 col-12">

									<label>Celular</label>

									<div class="input-group mb-4">

									  	<div class="input-group-prepend">

									    	<i class="fab fa-whatsapp"></i>

									  	</div>

									  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu celular" id="celularTitular" aria-describedby="basic-addon1" autocomplete="off">

									</div>

								</div>



								<div class="col-lg-6 col-12">

									<label>CPF</label>

									<div class="input-group mb-4">

									  	<div class="input-group-prepend">

									    	<i class="fa fa-cog"></i>

									  	</div>

									  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu CPF" id="cpfTitular" aria-describedby="basic-addon1" autocomplete="off">

									</div>

								</div>

							</div> 

						</div>



						<div class="guests"> 

							<div class="row">

								<div class="col-lg-12 col-12">

									<h5>Dados dos passageiros</h5>

								</div>

							</div>



							<div id="set_room">



								<div class="row rowGuest"> 

									<div class="col-lg-12 col-12"> 

										<p class="guest">Adulto 1</p> 



										<div class="row">

											<div class="col-lg-4 col-12">

												<label>Nome</label>

												<div class="input-group mb-4">

												  	<div class="input-group-prepend">

												    	<i class="fa fa-user"></i>

												  	</div>

												  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1">

												</div>

											</div>

											<div class="col-lg-4 col-12">

												<label>Sobrenome</label>

												<div class="input-group mb-4">

												  	<div class="input-group-prepend">

												    	<i class="fa fa-user"></i>

												  	</div>

												  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1">

												</div>

											</div> 

											<div class="col-lg-4 col-12">

												<label>Nascimento</label>

												<div class="input-group mb-4">

												  	<div class="input-group-prepend">

												    	<i class="fa fa-calendar"></i>

												  	</div>

												  	<input type="text" class="form-control" placeholder="" aria-label="Insira seu nome" aria-describedby="basic-addon1">

												</div>

											</div>

										</div> 



									</div> 

								</div> 



							</div>



						</div>';



						if(get_option('type_reserva_flights') == 2){

							$retorno .= '<div class="pay"> 

								<div class="row">

									<div class="col-lg-12 col-12">

										<h5>Dados de pagamento</h5>

									</div>

								</div>



								<div class="demo">

									<form class="payment-card">

										<div class="bank-card">

											<div class="bank-card__side bank-card__side_front">

												<div class="bank-card__inner">

													<label class="bank-card__label bank-card__label_holder">

														<span class="bank-card__hint">Nome do titular</span>

														<input type="text" class="bank-card__field" placeholder="Nome do titular" pattern="[A-Za-z, ]{2,}" id="holder-card" required>

													</label>

												</div>

												<div class="bank-card__inner">

													<label class="bank-card__label bank-card__label_number">

														<span class="bank-card__hint">Número do cartão</span>

														<input type="text" class="bank-card__field" placeholder="Número do cartão" pattern="[0-9]{16}" id="number-card" onfocusout="select_credit_card()"  required>

													</label>

												</div> 

												<div class="bank-card__inner bank-card__footer">

													<label class="bank-card__label bank-card__month">

														<span class="bank-card__hint">Mês</span>

														<input type="text" class="bank-card__field" placeholder="MM" maxlength="2" pattern="[0-9]{2}" id="mm-card" name="mm-card" required>

													</label>

													<span class="bank-card__separator">/</span>

													<label class="bank-card__label bank-card__year">

														<span class="bank-card__hint">Ano</span>

														<input type="text" class="bank-card__field" placeholder="YYYY" maxlength="2" pattern="[0-9]{2}" id="year-card" name="year-card" required>

													</label>

													<label class="bank-card__label bank-card__operadora">

														 

													</label>

												</div>

											</div>

											<div class="bank-card__side bank-card__side_back">

												<div class="bank-card__inner">

													<label class="bank-card__label bank-card__cvc">

														<span class="bank-card__hint">CVC</span>

														<input type="text" class="bank-card__field" placeholder="CVC" maxlength="3" pattern="[0-9]{3}" name="cvc-card" id="cvc-card" required>

													</label>

												</div>

											</div>

										</div> 

									</form>

								</div>



								<label><strong>Parcelamento:</strong></label>

								<select class="form-control" id="installments">



								</select>

							</div>'; 



							$retorno .= '<div class="address"> 

								<div class="row">

									<div class="col-lg-12 col-12">

										<h5>Dados de faturamento</h5>

									</div>

								</div>

								<div class="row">

									<div class="col-lg-6 col-12">

										<label>CEP</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											<i class="fa fa-map"></i>

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira seu CEP" aria-describedby="basic-addon1" id="cep" autocomplete="off">

										</div>

									</div>

								</div>



								<div class="row">

									<div class="col-lg-9 col-12">

										<label>Endereço</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											<i class="fa fa-house-user"></i>

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira seu endereço" id="endereco" aria-describedby="basic-addon1" autocomplete="off">

										</div>

									</div>



									<div class="col-lg-3 col-12">

										<label>Número</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											#

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira o número" id="numero" aria-describedby="basic-addon1" autocomplete="off">

										</div>

									</div>



									<div class="col-lg-12 col-12">

										<label>Complemento</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											<i class="fa fa-info"></i>

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira o complemento" id="complemento" aria-describedby="basic-addon1" autocomplete="off">

										</div>

									</div>



									<div class="col-lg-4 col-12">

										<label>Bairro</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											<i class="fa fa-warehouse"></i>

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira seu bairro" id="bairro" aria-describedby="basic-addon1" autocomplete="off">

										</div>

									</div>



									<div class="col-lg-4 col-12">

										<label>Cidade</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											<i class="fa fa-building"></i>

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira a cidade" id="cidade" aria-describedby="basic-addon1" autocomplete="off">

										</div>

									</div>



									<div class="col-lg-4 col-12">

										<label>Estado</label>

										<div class="input-group mb-4">

											<div class="input-group-prepend">

											<i class="fa fa-flag"></i>

											</div>

											<input type="text" class="form-control" placeholder="" aria-label="Insira o estado" id="estado" aria-describedby="basic-addon1" autocomplete="off">

										</div>

									</div>

								</div> 

							</div>';

						

						}



						$retorno .= '<a onclick="send_order_flights('.get_option('type_reserva_flights').')"><button class="btn btnSelect show-mobile">Finalizar '.(get_option('type_reserva_flights') == 2 ? 'reserva' : 'solicitação').'</button></a>



					</div>

				</div>



				<div class="row certiSign">

					<div class="col-lg-8 col-12">

						<p>

							<i class="fa fa-lock"></i> <strong>Este site é um site seguro.</strong>

						</p>

						<p>

							Utilizamos conexões seguras para proteger sua informação.

						</p>

					</div>

					<div class="col-lg-4 col-12">

						<img src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/img/logo-ssl.png" style=""> 

					</div>

				</div>



			</div>



			<div class="col-lg-4 col-12 col-xs-12 show-desktop"> 



				<h5 style="color:#333">Detalhe do pagamento</h5>



				<div class="resume-price row-is-loading" style="min-height:155px;"> 

					<div class="row mb-2"> 

						<div class="col-lg-12 col-12">
							<p class="price_without_tax value_price" style="font-size:20px"> </p>
							<strong style="font-size: 11px;float: right;">por adulto</strong><br>

						</div>

					</div>

					<div class="row mb-2">

						<div class="col-lg-8 col-8">

							<p class="data_price data_order"> </p>

						</div>

						<div class="col-lg-4 col-4">

							<p class="value_without_tax value_price"> </p>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-8 col-8">

							<p class="data_price">Impostos, taxas e encargos</p>

						</div>

						<div class="col-lg-4 col-4">

							<p class="value_price tax"> </p>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-12 col-12">

							<hr>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-6 col-8">

							<p class="data_total_price">TOTAL</p>

						</div>

						<div class="col-lg-6 col-4">

							<p class="value_total_price value_total"> </p>

						</div>

					</div>

				</div>



				<h5 style="color:#333">Detalhe da reserva</h5>



				<div class="row rowContact">

					<div class="col-lg-12 col-12">



						<div class="detail row-is-loading" style="min-height:306px;">

							<div class="row">

								<div class="col-lg-12 col-12">

									<i class="fas fa-plane-departure" style="font-size: 29px;"></i> 

									<h5 class="title-hotel"> </h5>

									<p class="star-hotel"> </p> 

									<p class="address-hotel"> </p>

								</div>

							</div>

							<div class="row">

								<div class="col-lg-6 col-6 date-hotel">

									<label class="">Partida</label>

									<br>

									<strong class="checkin"> </strong>

									<br>

									<span class="hour-flight-ida"> </span>

								</div>

								<div class="col-lg-6 col-6 date-hotel">

									<label class="">Retorno</label>

									<br>

									<strong class="checkout"> </strong>

									<br>

									<span class="hour-flight-volta"> </span>

								</div>

							</div>

							<div class="row">

								<div class="col-lg-12 col-12">

									<hr>

								</div>

							</div>

							<div class="row detailRoom">

								<div class="col-lg-12 col-12">

									<p class="detail_trip" style="line-height:2">

										 

									</p>

									<p class="name_room">

										 

									</p>

								</div>

							</div>

						</div>

					</div>

				</div>



				<a onclick="send_order_flights('.get_option('type_reserva_flights').')"><button class="btn btnSelect show-desktop">Finalizar '.(get_option('type_reserva_flights') == 2 ? 'reserva' : 'solicitação').'</button></a> 



			</div>

		</div>

	</div>';



	$retorno .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>';

	$retorno .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/js/script-checkout-flights.js?v='.date("dmYHis").'"></script>';	 

	return $retorno;

}

add_shortcode('TTBOOKING_CONFIRM_RESERVA_FLIGHTS', 'shortcode_confirm_reserva_flights');  



function shortcode_confirm_reserva_flights(){

	$retorno = '';



	$retorno .= ' 

		<link rel="preconnect" href="https://fonts.googleapis.com">

		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

		<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> '; 



	$retorno .= '<style type="text/css">

 		 br{

 		 	display: none;

 		 }

	</style>'; 



	$logo = esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] );

 	

 	$tipoReserva = 'solicitação';

	if(get_option( 'type_reserva_flights' ) == 2){

		$htmlAdicional = '<br style="display: block !important"> <span>Número de confirmação: '.$_GET['order'].'</span>';

		$tipoReserva = 'reserva'; 

	}

	$retorno .= '<input type="hidden" id="type_reserva" value="'.get_option( 'type_reserva_flights' ).'">';
	$retorno .= '<input type="hidden" id="order" value="'.$_GET['order'].'">';
	$retorno .= '<input type="hidden" id="plugin_dir_url" value="'.plugin_dir_url( __FILE__ ).'">';
	$retorno .= '<input type="hidden" id="color_ehtl" value="'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).'">';

	$retorno .= '<input type="hidden" id="url_ajax" value="'.admin_url('admin-ajax.php').'">';

	$retorno .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

		<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">

	    	<head>

		        <meta name="viewport" content="width=device-width" />

		        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>

		        <style type="text/css">  @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700); h2 { text-align: center; } p { font-size: 13px; } input { display: none; visibility: hidden; }

		            label {

			            display: block;

			            letter-spacing: 2px;

			            color: #b58952;

			            text-align: justify;

			            font-size: 14px;

			            font-weight: 700;

			            width: 96%;

		            }

		            label:hover {

			            color: #b58952;

			            text-decoration: underline;

		            }

		            label::after {

			            font-weight: bold;

			            font-size: 17px;

			            content: "-";

			            vertical-align: text-top;

			            display: inline-block;

			            float: right;

		            }

		            #expand {

			            height: 0px;

			            overflow: hidden;

			            transition: height 0.5s;

			            color: #000;

		            }

		            #toggle:checked ~ #expand {

		            	height: 90px;

		            }

		            #toggle:checked ~ label::after {

		            	content: "+";

		            }

		            @media (min-width: 961px){

			            .larguraTabel{

			            	width: 508px;

			            }

			            .alturaYoutube{

			            	padding-top: 14px !important;

			            }

		            }

		            @media (max-width: 960px){

		            	.alturaYoutube{

		            		padding-top: 36px;

		            	}

		            }

		        </style>

	       	</head>

	        <table align="center" border="0" cellpadding="0" class="larguraTabel" cellspacing="0" style="border-collapse:collapse;border: none;width: 640px;margin: 0 auto;" >

	            <tbody style="background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';">

	                <tr>';

		                if(!empty($logo)){

		                    $retorno .= '<td align="center" height="0" style="width:35%;border: none;" ><img src="https://traveltec.com.br/wp-content/uploads/2021/08/Logotipo-Pequeno.png" style=""></td>';

		                }

	                    $retorno .= '<td align="center" height="0" style="border: none;word-break: break-word;font-family:\'Montserrat\';color: #fff;padding: 20px;font-size: 11px;text-align: right;" ><strong>SEU PEDIDO FOI RECEBIDO COM SUCESSO!</strong> '.$htmlAdicional.'</td>

	                </tr>

	            </tbody>

	        </table>

	        <table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;">

	                <tr>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:12px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '

	                            	<p style="margin: 0">

	                            		<img src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/img/icon-check-round.png" style="    display: inline-flex;height: 21px;margin-right: 5px;"> <small style="font-size: 13px;font-weight: 600;">Agradecemos sua '.$tipoReserva.'!</small> <h6 style="margin: 0;font-weight: 700;">Sua '.$tipoReserva.' para <span id="local_reserva"> </span> está confirmada.</h6>

	                            	</p>



	                            	<p style="margin: 5px 0">

	                            		<img src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/img/icon-check.png" style="    display: inline-flex;margin-right: 5px;"> Vôo solicitado para <strong id="checkin_reserva"> </strong>.

	                            	</p>



	                            	<p style="margin: 5px 0">

	                            		<img src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/img/icon-check.png" style="    display: inline-flex;margin-right: 5px;"> <span id="info_payment">Entraremos em contato para cuidar do pagamento.</span>

	                            	</p> 

	                         </td>

	                     </tr> 

	            </tbody>

	        </table>

	        <table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;">

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Sua reserva é para</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="desc_dia_room_reserva"> </span>

	                         </td>

	                     </tr>

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Companhia</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="desc_sua_reserva_para"> </span>

	                         </td>

	                     </tr>

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Partida</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="desc_sua_reserva_checkin"> </span>

	                         </td>

	                     </tr>

	                     <tr style="">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  class="retorno">

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Retorno</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  class="retorno">

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="desc_sua_reserva_checkout"> </span>

	                         </td>

	                     </tr>



	            </tbody>

	        </table>



	        <table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;">

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="font-family:\'Montserrat\';word-break: break-word;background-color: '.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';text-align: justify;border: none;color: #fff;padding: 20px;" valign="top"  >

	                    		<p style="margin-bottom:5px;font-weight:600;font-size:14px;" id="desc_room_reserva"> </p>

	                    		<p style="margin-bottom:5px;font-weight:600;font-size:14px;" id="desc_taxa_reserva"></p>

	                    		<p style="margin:5px 0;font-weight:600;font-size:19px;">Total <span style="float:right;" id="price_total"> </span></p>



	                    		<p style="margin:5px 0; font-size:13px;">

	                    			Aguarde entrarmos em contato para cuidarmos do pagamento.

	                    		</p>

	                    		<p style="margin:5px 0; font-size:13px;">

									Por favor, observe que pedidos adicionais não estão incluídos neste valor.

	                    		</p>

								<p style="margin:5px 0; font-size:13px;">

									O preço total mostrado é o valor que você pagará pelo vôo. Não cobramos dos passageiros nenhuma taxa de reserva, administrativa ou de qualquer outro tipo.

	                    		</p>

								<p style="margin:5px 0; font-size:13px;">

									Se você cancelar, impostos aplicáveis ainda podem ser cobrados pela companhia aérea.

	                    		</p>

								<p style="margin:5px 0; font-size:13px;">

									Se você não comparecer sem cancelar com antecedência, a companhia poderá cobrar o valor total da reserva.

	                    		</p>

	                         </td>

	                     </tr>



	            </tbody>

	        </table>  



	        <table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;"> 

	                     <tr>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;padding: 0px 14px;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:12px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '

	                            	<h5 class="" style="margin: 14px 0;color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';font-size: 18px;"><strong>Informações do solicitante</strong></h5> 

	                         </td>

	                     </tr>

	            </tbody>

	        </table>

	        <table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;">

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Titular da reserva</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="titular_order_flight"> </span>

	                         </td>

	                     </tr>

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>CPF</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="cpf_order_flight"> </span>

	                         </td>

	                     </tr>

	                     <tr style="border-bottom: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Email</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="email_order_flight"> </span>

	                         </td>

	                     </tr>

	                     <tr style="">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;" valign="top"  class="retorno">

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<strong>Telefone</strong>

	                         </td>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  class="retorno">

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '<span id="telefone_order_flight"> </span>

	                         </td>

	                     </tr>



	            </tbody>

	        </table> 



	        <table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;"> 

	                     <tr>

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: justify;border: none;padding: 0px 14px;" valign="top"  >

	                        <font style="font-family:\'Montserrat\', sans-serif;font-size:12px;color:#666666;margin:1em 0">

	                            '; 

	                            $retorno .= '

	                            	<h5 class="" style="margin: 14px 0;color:'.(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' )).';font-size: 18px;"><strong>Pagamento</strong></h5> 

	                         </td>

	                     </tr>

	            </tbody>

	        </table>';



	        if(get_option( 'type_reserva_flights' ) == 2){

		        $retorno .= '<table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" id="payment_card">

		            <tbody style="background-color: #ddd;">

		                     <tr style="border-bottom: 1px solid #f0f0f0;">

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: left;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<strong>Nome do titular</strong>

		                         </td>

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<span id="desc_titular_card"> </span>

		                         </td>

		                     </tr>

		                     <tr style="border-bottom: 1px solid #f0f0f0;">

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: left;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<strong>Número do cartão</strong>

		                         </td>

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<span id="desc_number_card"> </span>

		                         </td>

		                     </tr>

		                     <tr style="border-bottom: 1px solid #f0f0f0;">

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: left;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<strong>Validade</strong>

		                         </td>

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<span id="desc_validade_card"> </span>

		                         </td>

		                     </tr>

		                     <tr style="">

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: left;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<strong>Parcelas</strong>

		                         </td>

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: right;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= '<span id="desc_parcelas_card"> </span>

		                         </td>

		                     </tr>



		            </tbody>

		        </table>';

		    }else{



		        $retorno .= '<table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" id="payment_agency">

		            <tbody style="background-color: #ddd;">

		                     <tr style=" ">

		                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: left;border: none;" valign="top"  >

		                        <font style="font-family:\'Montserrat\', sans-serif;font-size:14px;color:#666666;margin:1em 0">

		                            '; 

		                            $retorno .= 'Entraremos em contato para cuidar das informações de pagamento. Mas não se preocupe, sua solicitação foi recebida!

		                         </td> 

		                     </tr> 



		            </tbody>

		        </table>';

	       }



	        $retorno .= '<table align="center" border="0" cellpadding="0" class="larguraTabel" style="border-collapse:collapse;border: none;margin: 0 auto" >

	            <tbody style="background-color: #ddd;">

	                     <tr style="border-top: 1px solid #f0f0f0;">

	                    <td align="center" height="" style="word-break: break-word;background-color: #fff;text-align: left;border: none;" valign="top"  >

	                    	<p style="font-family:\'Montserrat\', sans-serif; color:#666666;text-align:center;font-size:12px;"><a href="https://traveltec.com.br" target="_blank">Travel Tec</a> © 2023. Todos os direitos reservados.</p>

	                    </td>

	                   </tr>

	                  </tbody>

	                  </table>



	        </body>

		</html>';



	$retorno .= ' 

	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'includes/assets/js/script-confirm-flights.js?v='.date("dmYHis").'"></script>';	 

	return $retorno;

}

 // define the wp_mail_failed callback



    function action_wp_mail_failed_flights($wp_error)



    {



        return error_log(print_r($wp_error, true));



    }







    function wpse27856_set_content_type_flights(){



        return "text/html";



    }



    add_filter( 'wp_mail_content_type','wpse27856_set_content_type_flights' );







    // add the action



    add_action('wp_mail_failed', 'action_wp_mail_failed_flights', 10, 1);


add_action( 'wp_ajax_send_mail_confirmation_flights', 'send_mail_confirmation_flights' ); 
add_action( 'wp_ajax_nopriv_send_mail_confirmation_flights', 'send_mail_confirmation_flights' );

function send_mail_confirmation_flights(){

	$headers = "From: Travel Tec <sac@traveltec.com.br>"; 

	$html = '';

 	$tipoReserva = 'solicitação de cotação';
 	$htmlAdicional = '';

	if($_POST['type_reserva'] == 2){

		$htmlAdicional = '<br style="display: block !important"> <span>Número de confirmação: '.$order.'</span>'; 
		$tipoReserva = 'reserva'; 

	}

	$plugin_dir_url = $_POST['plugin_dir_url'];
	$color_ehtl = $_POST['color_ehtl'];
	$destino = $_POST['destino'];
	$hotel_reserva = $_POST['hotel_reserva'];
	$checkin = $_POST['checkin'];
	$checkout = $_POST['checkout'];
	$irrevocableGuarantee = $_POST['irrevocableGuarantee'];
	$cancellationDeadline = $_POST['cancellationDeadline'];
	$hotelAdressComplete = $_POST['hotelAdressComplete'];
	$diaria = $_POST['diaria'];
	$quartos = $_POST['quartos'];
	$pax = $_POST['pax'];
	$tipo_quarto = $_POST['tipo_quarto'];
	$taxa = $_POST['taxa'];
	$total = $_POST['total'];
	$customer = $_POST['customer'];
	$type_reserva = $_POST['type_reserva'];
	$holder = $_POST['holder'];
	$number = $_POST['number'];
	$month = $_POST['month'];
	$parcelas = $_POST['parcelas'];

	$html .= '<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
		    <head>
		        <meta charset="utf-8">
		        <meta name="viewport" content="width=device-width">
		        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		        <meta name="x-apple-disable-message-reformatting">

				<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
		        <title></title>
		        <style>
		            /* What it does: Remove spaces around the email design added by some email clients. */
		            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
		            html,
		            body {
		                margin: 0 auto !important;
		                padding: 0 !important;
		                height: 100% !important;
		                width: 100% !important;
		                background: #f1f1f1;
		                font-family: \'Montserrat\'
		            }

		            /* What it does: Stops email clients resizing small text. */
		            * {
		                -ms-text-size-adjust: 100%;
		                -webkit-text-size-adjust: 100%;
		            }

		            /* What it does: Centers email on Android 4.4 */
		            div[style*="margin: 16px 0"] {
		                margin: 0 !important;
		            }

		            /* What it does: Stops Outlook from adding extra spacing to tables. */
		            table,
		            td {
		                mso-table-lspace: 0pt !important;
		                mso-table-rspace: 0pt !important;
		            }

		            /* What it does: Fixes webkit padding issue. */
		            table {
		                border-spacing: 0 !important;
		                border-collapse: collapse !important;
		                table-layout: fixed !important;
		                margin: 0 auto !important;
		            }

		            /* What it does: Uses a better rendering method when resizing images in IE. */
		            img {
		                -ms-interpolation-mode: bicubic;
		            }

		            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
		            a {
		                text-decoration: none;
		            }

		            /* What it does: A work-around for email clients meddling in triggered links. */
		            *[x-apple-data-detectors],
		            /* iOS */
		            .unstyle-auto-detected-links *,
		            .aBn {
		                border-bottom: 0 !important;
		                cursor: default !important;
		                color: inherit !important;
		                text-decoration: none !important;
		                font-size: inherit !important;
		                font-family: inherit !important;
		                font-weight: inherit !important;
		                line-height: inherit !important;
		            }

		            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
		            .a6S {
		                display: none !important;
		                opacity: 0.01 !important;
		            }

		            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
		            .im {
		                color: inherit !important;
		            }

		            /* If the above doesnt work, add a .g-img class to any image in question. */
		            img.g-img+div {
		                display: none !important;
		            }

		            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
		            /* Create one of these media queries for each additional viewport size youd like to fix */
		            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
		            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
		                u~div .email-container {
		                    min-width: 320px !important;
		                }
		            }

		            /* iPhone 6, 6S, 7, 8, and X */
		            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
		                u~div .email-container {
		                    min-width: 375px !important;
		                }
		            }

		            /* iPhone 6+, 7+, and 8+ */
		            @media only screen and (min-device-width: 414px) {
		                u~div .email-container {
		                    min-width: 414px !important;
		                }
		            }
		        </style>
		        <style>
		            .primary {
		                background: #17bebb;
		            }

		            .bg_white {
		                background: #ffffff;
		            }

		            .bg_ehtl {
		                background: '.$color_ehtl.';
		            }

		            .bg_light {
		                background: #f7fafa;
		            }

		            .bg_black {
		                background: #000000;
		            }

		            .bg_dark {
		                background: rgba(0, 0, 0, .8);
		            }

		            .email-section {
		                padding: 2.5em;
		            }

		            /*BUTTON*/
		            .btn {
		                padding: 10px 15px;
		                display: inline-block;
		            }

		            .btn.btn-primary {
		                border-radius: 5px;
		                background: #17bebb;
		                color: #ffffff;
		            }

		            .btn.btn-white {
		                border-radius: 5px;
		                background: #ffffff;
		                color: #000000;
		            }

		            .btn.btn-white-outline {
		                border-radius: 5px;
		                background: transparent;
		                border: 1px solid #fff;
		                color: #fff;
		            }

		            .btn.btn-black-outline {
		                border-radius: 0px;
		                background: transparent;
		                border: 2px solid #000;
		                color: #000;
		                font-weight: 700;
		            }

		            .btn-custom {
		                color: rgba(0, 0, 0, .3);
		                text-decoration: underline;
		            }

		            h1,
		            h2,
		            h3,
		            h4,
		            h5,
		            h6 {
		                color: #fff;
		                margin-top: 0;
		                font-weight: 600;
		                font-size: 12px;
		                font-family: \'Montserrat\'
		            }

		            body {
		                font-weight: 400;
		                font-size: 15px;
		                line-height: 1.8;
		                color: rgba(0, 0, 0, .4);
		                font-family: \'Montserrat\'
		            }

		            a {
		                color: #17bebb;
		            }

		            table {}

		            /*LOGO*/
		            .logo h1 {
		                margin: 0;
		            }

		            .logo h1 a {
		                color: #17bebb;
		                font-size: 24px;
		                font-weight: 700;
		            }

		            /*HERO*/
		            .hero {
		                position: relative;
		                z-index: 0;
		            }

		            .hero .text {
		                color: rgba(0, 0, 0, .3);
		            }

		            .hero .text h2 {
		                color: #000;
		                font-size: 14px;
		                margin-bottom: 15px;
		                font-weight: 400;
		                line-height: 1.2;
		            }

		            .hero .text h3 {
		                font-size: 12px;
    					font-weight: 600;
    					color: #000;
		            }

		            .hero .text h2 span {
		                font-weight: 600;
		                color: #000;
		            }

		            /*PRODUCT*/
		            .product-entry {
		                display: block;
		                position: relative;
		                float: left;
		                padding-top: 20px;
		            }

		            .product-entry .text {
		                width: calc(100% - 125px);
		                padding-left: 20px;
		            }

		            .product-entry .text h3 {
		                margin-bottom: 0;
		                padding-bottom: 0;
		            }

		            .product-entry .text p {
		                margin-top: 0;
		            }

		            .product-entry img,
		            .product-entry .text {
		                float: left;
		            }

		            ul.social {
		                padding: 0;
		            }

		            ul.social li {
		                display: inline-block;
		                margin-right: 10px;
		            }

		            /*FOOTER*/
		            .footer {
		                border-top: 1px solid rgba(0, 0, 0, .05);
		                color: rgba(0, 0, 0, .5);
		            }

		            .footer .heading {
		                color: #fff;
		                font-size: 18px;
		                font-weight: 600;
		                font-family: \'Montserrat\';
		            }

		            .footer p {
		                color: #fff;
		                font-size: 14px; 
		                font-family: \'Montserrat\';
		            }

		            .footer ul {
		                margin: 0;
		                padding: 0;
		            }

		            .footer ul li {
		                list-style: none;
		                margin-bottom: 10px;
		            }

		            .footer ul li a {
		                color: rgba(0, 0, 0, 1);
		            }

		            @media screen and (max-width: 500px) {}
		        </style>
		        <meta name="robots" content="noindex, follow"> 
		        <style type="text/css"></style>
		    </head>
		    <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
		        <center style="width: 100%; background-color: #f1f1f1;">
		            <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;"> ‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp; </div>
		            <div style="max-width: 600px; margin: 0 auto;" class="email-container">
		                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
		                    <tbody>
		                        <tr>
		                            <td valign="top" class="bg_ehtl" style="padding: 1em 2.5em 1em 2.5em;">
		                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		                                    <tbody>
		                                        <tr>
		                                            <td class="logo" style="text-align: right;text-transform:uppercase;font-size:18px;font-weight:600">
		                                                <h1> Seu pedido foi recebido com sucesso! '.$htmlAdicional.'</h1>
		                                            </td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td valign="middle" class="hero bg_white" style="padding: 2em 0 2em 0;">
		                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		                                    <tbody>
		                                        <tr>
		                                            <td style="padding: 0 2.5em; text-align: left;">
		                                                <div class="text">
		                                                    <h2><img src="cid:icon-check-round" style="height:20px"> Agradecemos sua solicitação!<br>Sua '.$tipoReserva.' para <strong>'.$destino.'</strong> foi recebida.</h2>'; 

		                                                	$html .= '<h2><img src="cid:icon-check"> Vôo solicitado para <strong>'.$checkin.'</strong>.</h2>'; 

		                                                    $html .= '<h2><img src="cid:icon-check"> Entraremos em contato para cuidar do pagamento.</h2>'; 

		                                                $html .= '</div>
		                                            </td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </td>
		                        </tr>
		                        <tr></tr>
		                    </tbody>
		                </table> 

		                <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		                    <tbody>
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Sua reserva é para</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$pax.'</th>
		                        </tr> 
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Companhia</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$quartos.'</th>
		                        </tr> 
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Partida</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$checkin.'</th>
		                        </tr> 
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Retorno</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$checkout.'</th>
		                        </tr> 
		                    </tbody>
		                </table>

		                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
		                    <tbody>
		                        <tr>
		                            <td valign="middle" class="bg_ehtl footer email-section">
		                                <table>
		                                    <tbody>
		                                        <tr>
		                                            <td valign="top" width="100%" style="padding-top: 20px;">
		                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
		                                                    <tbody>
		                                                        <tr>
		                                                            <td style="text-align: left; padding-right: 10px;">
		                                                                <h3 class="heading">
			                                                                '.$tipo_quarto.'
			                                                                <br>
			                                                                '.$taxa.' inclusa
			                                                                <br>
			                                                                Total <span style="float:right"> '.$total.'</span>
		                                                                </h3> 
		                                                                <p> Aguarde entrarmos em contato para cuidarmos do pagamento. </p>

																		<p> Por favor, observe que pedidos adicionais não estão incluídos neste valor. </p>

																		<p> O preço total mostrado é o valor que você pagará pelo vôo. Não cobramos dos passageiros nenhuma taxa de reserva, administrativa ou de qualquer outro tipo. </p>

																		<p> Se você cancelar, impostos aplicáveis ainda podem ser cobrados pela companhia aérea. </p>

																		<p> Se você não comparecer sem cancelar com antecedência, a companhia poderá cobrar o valor total da reserva. </p>
		                                                            </td>
		                                                        </tr>
		                                                    </tbody>
		                                                </table>
		                                            </td> 
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </td>
		                        </tr> 
		                    </tbody>
		                </table> 

		                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
		                    <tbody> 
		                        <tr>
		                            <td valign="middle" class="hero bg_white" style="padding: 2em 0 1em 0;">
		                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		                                    <tbody>
		                                        <tr>
		                                            <td style="padding: 0 2.5em; text-align: left;">
		                                                <div class="text">
		                                                    <h2 style="color:'.$color_ehtl.' !important;font-weight:600;font-size:18px !important;font-family: \'Montserrat\' !important;">Informações do solicitante</h2>  

		                                                </div>
		                                            </td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </td>
		                        </tr>
		                        <tr></tr>
		                    </tbody>
		                </table> 
		                <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		                    <tbody>
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Titular da reserva</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$_POST['customer'].'</th>
		                        </tr> 
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">CPF</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$_POST['cpf_order'].'</th>
		                        </tr> 
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">E-mail</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$_POST['email_order'].'</th>
		                        </tr> 
		                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
		                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Telefone</th>
		                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$_POST['tel_order'].'</th>
		                        </tr> 
		                    </tbody>
		                </table>

		                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
		                    <tbody> 
		                        <tr>
		                            <td valign="middle" class="hero bg_white" style="padding: 2em 0 1em 0;">
		                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		                                    <tbody>
		                                        <tr>
		                                            <td style="padding: 0 2.5em; text-align: left;">
		                                                <div class="text">
		                                                    <h2 style="color:'.$color_ehtl.' !important;font-weight:600;font-size:18px !important;font-family: \'Montserrat\' !important;">Pagamento</h2>  

		                                                </div>
		                                            </td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </td>
		                        </tr>
		                        <tr></tr>
		                    </tbody>
		                </table>';

		                if($type_reserva == 2){
			                $html .= '<table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
			                    <tbody>
			                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
			                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Nome do titular</th>
			                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$holder.'</th>
			                        </tr> 
			                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
			                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Número do cartão</th>
			                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$number.'</th>
			                        </tr> 
			                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
			                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Validade</th>
			                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$month.'</th>
			                        </tr> 
			                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
			                            <th width="50%" style="text-align:left;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: \'Montserrat\';font-weight: 600;">Parcelas</th>
			                            <th width="50%" style="text-align:right;padding:1.5em 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">'.$parcelas.'</th>
			                        </tr> 
			                    </tbody>
			                </table>';
			            }else{
			                $html .= '<table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
			                    <tbody>
			                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);"> 
			                            <th width="100%" style="text-align:left;padding:0 2.5em;color:#000;padding-bottom:20px;font-family: Montserrat;font-weight: 400;">Entraremos em contato para cuidar das informações de pagamento. Mas não se preocupe, sua solicitação foi recebida!</th>
			                        </tr>  
			                    </tbody>
			                </table>';
			            }

		                $html .= '<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
		                    <tbody> 
		                        <tr>
		                            <td class="bg_white" style="text-align: center;">
		                                <p style="font-family: \'Montserrat\' !important;"><a href="https://traveltec.com.br" target="_blank">Travel Tec</a> © '.date("Y").'. Todos os direitos reservados.</a>
		                                </p>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>

		            </div>
		        </center> 
		    </body>
		</html>';

		/* Usage */

		/* Set mail parameters */
		$to = 'raabe@montenegroev.com.br';
		$subject = "Passagens Aéreas - Nova cotação";
		$body = $html;
		$headers = "Content-type: text/html";
		$my_attachments = [
		    [
		        "cid" => "icon-check-round", /* used in email body */
		        "path" => plugin_dir_path(__FILE__) . 'includes/assets/img/icon-check-round.png',
		    ],
		    [
		        "cid" => "icon-check", /* used in email body */
		        "path" => plugin_dir_path(__FILE__) . 'includes/assets/img/icon-check.png',
		    ], 
		];

		$custom_mailer = new Custom_Mailer_Flights();
		$custom_mailer->send($_POST['email_order'], 'Pedido efetuado com sucesso!', $body, $headers, $my_attachments); 
		$custom_mailer->send(get_option( 'admin_email' ), $subject, $body, $headers, $my_attachments); 
		$custom_mailer->send('sac@traveltec.com.br', $subject, $body, $headers, $my_attachments); 

}

function get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page' ) { 
  	global $wpdb; 
   	$page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", $page_slug, $post_type ) ); 
	if ( $page ) 
        return get_post($page, $output); 
    return false; 
}

global $wpdb;

$check_page_exist = get_page_by_slug('offers-flights');  

if(!$check_page_exist) {

    $wpdb->insert($wpdb->posts, array( 
        'comment_status' => 'close', 
        'ping_status'    => 'close', 
        'post_author'    => 1, 
        'post_title'     => ucwords('Resultados de Voos'), 
        'post_name'      => 'offers-flights', 
        'post_status'    => 'publish', 
        'post_content'   => '[TTBOOKING_RESULTADOS_FLIGHTS]', 
        'post_type'      => 'page' 
    ));

}

$check_page_exist = get_page_by_slug('order-flights');  

if(empty($check_page_exist)) {

    $wpdb->insert($wpdb->posts, array( 
        'comment_status' => 'close', 
        'ping_status'    => 'close', 
        'post_author'    => 1, 
        'post_title'     => ucwords('Finalizar pedido - Vôos'), 
        'post_name'      => 'order-flights', 
        'post_status'    => 'publish', 
        'post_content'   => '[TTBOOKING_CHECKOUT_FLIGHTS]', 
        'post_type'      => 'page' 
    ));

}
$check_page_exist = get_page_by_slug('confirm-order-flights');  



if(empty($check_page_exist)) {



    $wpdb->insert($wpdb->posts, array( 

        'comment_status' => 'close', 

        'ping_status'    => 'close', 

        'post_author'    => 1, 

        'post_title'     => ucwords('Confirmação Pedido - Vôos'), 

        'post_name'      => 'confirm-order-flights', 

        'post_status'    => 'publish', 

        'post_content'   => '[TTBOOKING_CONFIRM_RESERVA_FLIGHTS]', 

        'post_type'      => 'page' 

    ));



} 



    add_action('admin_menu', 'menu_flights');



    function menu_flights() { 



  add_menu_page( 



      'Passagens Aéreas', 



      'TT - Vôos', 



      'edit_posts', 



      'ttflights', 



      'gerador_de_conteudo_flights', 



      'dashicons-airplane' 



     );



}



 



     



    function gerador_de_conteudo_flights() { ?>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=1.0">

        <style>
        	#wpcontent{
        		background-color: #f0f0f0;
        		padding: 0;
    			font-family: 'Montserrat';
        	}
        	#wpfooter{
        		display: none;
        	}
        	.header{
        		padding: 25px 30px;
        	}
        	.content{
        		padding: 25px 0;
        	}
        	.content{
        		min-height: 200px;
        	}
        	.footer{
    			padding: 20px; 
    			background-color: #fff;
    			position: absolute;
    			bottom: 0;
    			width: 100%;
        	}
        	.header h2{
        		font-size: 36px;
    			font-weight: 400;
    			font-family: 'Montserrat';
        	}
        	.header p{
        		font-family: 'Montserrat';
        		font-size: 14px;
        		margin-bottom: 0;
        	}
        	.footer p{ 
			    font-family: 'Montserrat';
			    font-size: 11px; 
        	}
        	.footer p.copyright, .footer p.links{
        		margin-bottom: 7px; 
        	}
        	.footer p.redes{
        		margin-bottom: 0px; 
        	}
        	.footer p.links .divisor{
        		font-weight: 600;
    			color: #858585;
    			margin: 0px 4px;
        	}
        	.footer p.copyright{ 
			    font-weight: 600;
			    color: #858585;
        	}
        	.footer p.redes i{
        		font-size: 16px;
    			color: #858585;
    			margin-right: 4px;
        	}

        	.nav-item{
        		margin-bottom: -1px;
        	}
        	.nav-link{
        		border: none;
			    padding: 12px 25px;
			    font-size: 14px;
			    font-weight: 600;
			    font-family: Montserrat;
        	}
        	.nav-tabs{
        		border: none;
        		padding: 0px 30px;
        	}
        	.nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover, .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        		border: 0;
        	}
        	.tab-content{
        		padding: 45px 30px;
        		background-color: #fff;
        	}

        	.copy-button {
			    height: 36px;
			    margin-left: -4px;
			    margin-top: -2px;
			    border-radius: 0px 5px 5px 0px;
			    margin-right: 5px;
			}

			.tip {
			    background-color: #263646;
			    padding: 0 14px;
			    line-height: 27px;
			    position: absolute;
			    border-radius: 4px;
			    z-index: 100;
			    color: #fff;
			    font-size: 12px;
			    animation-name: tip;
			    animation-duration: .6s;
			    animation-fill-mode: both
			}

			.tip:before {
			    content: "";
			    background-color: #263646;
			    height: 10px;
			    width: 10px;
			    display: block;
			    position: absolute;
			    transform: rotate(45deg);
			    top: -4px;
			    left: 17px
			}

			#copied_tip {
			    animation-name: come_and_leave;
			    animation-duration: 1s;
			    animation-fill-mode: both;
			    bottom: -35px;
			    left: 2px
			}

			.text-line {
				font-weight: 600;
			    background-color: #d5d5d5;
			    padding: 8px;
			    border-radius: 5px 0px 0px 5px;
			    margin-left: 5px;
			}

			.btn-check:active+.btn-primary:focus, .btn-check:checked+.btn-primary:focus, .btn-primary.active:focus, .btn-primary:active:focus, .show>.btn-primary.dropdown-toggle:focus{
				box-shadow: none !important;
			}

			.form-label{
				font-size: 14px;
    			font-weight: 600;
			}
			.form-control{
				height: 40px;
    			border: 1px solid #e2e2e2 !important;
    			border-radius: 0 !important;
			}

			.wp-core-ui p .button{
				padding: 10px 20px;
    			font-size: 15px;
			}
        </style>

        <div class="header">
        	<h2>Passagens Aéreas</h2> 
        	<p>Integre facilmente o seu fornecedor de aéreo ao seu site.</p>
        </div>

        <div class="content">

	        <ul class="nav nav-tabs" id="myTab" role="tablist">
	  			<li class="nav-item" role="presentation">
	    			<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sobre</button>
	  			</li>
	  			<li class="nav-item" role="presentation">
	    			<button class="nav-link" id="profileFlights-tab" data-bs-toggle="tab" data-bs-target="#profileFlights" type="button" role="tab" aria-controls="profileFlights" aria-selected="false">Configuração</button>
	  			</li>
	  			<li class="nav-item" role="presentation">
	    			<button class="nav-link" id="contactFlights-tab" data-bs-toggle="tab" data-bs-target="#contactFlights" type="button" role="tab" aria-controls="contactFlights" aria-selected="false">Licenciamento</button>
	  			</li>
			</ul>
			<div class="tab-content" id="myTabContent">
	  			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 

	  				<p style="font-size:17px;line-height: 1.8"> O Plugin <strong>Travel Tec - Vôos</strong> é um plugin desenvolvido para agências e operadoras de turismo que precisam tratar reserva de passagens aéreas de fornecedores, com integração ao fornecedor Rextur. </p>

	  				<p style="font-size:17px;line-height: 1.8">Use o shortcode <span class="text-line">[TTBOOKING_MOTOR_RESERVA_FLIGHTS]</span>  <button onclick="copy('[TTBOOKING_MOTOR_RESERVA_FLIGHTS]','#copy_button_1')" id="copy_button_1" class="btn btn-sm btn-primary copy-button" data-toggle="tolltip" data-placement="top" tilte="Copiar shortcode">Copiar</button> para adicionar o motor de reserva em qualquer página.</p>

                    <?php if ( (shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_FLIGHTS' ) && shortcode_exists( 'TTBOOKING_MOTOR_RESERVA' ) ) || (shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_FLIGHTS' ) && shortcode_exists( 'TTBOOKING_MOTOR_RESERVA_CARS' ) ) ){ ?>

 
                        <p style="font-size:17px;line-height: 1.8">Use o shortcode <span class="text-line">[TTBOOKING_MOTOR_SERVICES]</span>  <button onclick="copy('[TTBOOKING_MOTOR_SERVICES]','#copy_button_1')" id="copy_button_2" class="btn btn-sm btn-primary copy-button" data-toggle="tolltip" data-placement="top" tilte="Copiar shortcode">Copiar</button> para adicionar o motor de reserva com todos os serviços em qualquer página.</p>
                    <?php } ?>

	  			</div>
	  			<div class="tab-pane fade" id="profileFlights" role="tabpanel" aria-labelledby="profileFlights-tab">

	  				<div class="row">
	  					<div class="col-lg-6 col-12">
	  						<ul class="nav nav-tabs" id="myTabCredencial" role="tablist" style="padding: 0px;">
					  			<li class="nav-item" role="presentation">
					    			<button class="nav-link active" id="credencial-tab" data-bs-toggle="tab" data-bs-target="#credencial" type="button" role="tab" aria-controls="home" aria-selected="true" style="border: none;background-color: #ebebeb;">Credenciais</button>
					  			</li>
							</ul>
							<div class="tab-content" id="myTabContentCredencial" style="background-color: #ebebeb;height: 435px;">
					  			<div class="tab-pane fade show active" id="credencial" role="tabpanel" aria-labelledby="credencial-tab">  

					  				<h5 style="margin-bottom:20px;">Rextur</h5>

				  					<div style="height: 230px;">

						  				<div class="mb-3">
											<label for="Gtw-Agency-Id" class="form-label">Gtw-Agency-Id</label>
											<input type="text" class="form-control" id="Gtw-Agency-Id" name="Gtw-Agency-Id" value="<?=(empty(get_option( 'Gtw-Agency-Id' )) ? '' : get_option( 'Gtw-Agency-Id' ))?>">
										</div>

						  				<div class="mb-3">
											<label for="Gtw-Group-Id" class="form-label">Gtw-Group-Id</label>
											<input type="text" class="form-control" id="Gtw-Group-Id" name="Gtw-Group-Id" value="<?=(empty(get_option( 'Gtw-Group-Id' )) ? '' : get_option( 'Gtw-Group-Id' ))?>">
										</div> 

						  				<div class="mb-3">
											<label for="Package" class="form-label">Package</label>
											<input type="text" class="form-control" id="Package" name="Package" value="<?=(empty(get_option( 'Package' )) ? '' : get_option( 'Package' ))?>">
										</div> 

									</div>

									<?php submit_button(); ?> 

					  			</div>
					  		</div>
	  					</div> 

	  					<div class="col-lg-6 col-12">
	  						<ul class="nav nav-tabs" id="myTabEstilo" role="tablist" style="padding: 0px;">
					  			<li class="nav-item" role="presentation">
					    			<button class="nav-link active" id="estilo-tab" data-bs-toggle="tab" data-bs-target="#estilo" type="button" role="tab" aria-controls="home" aria-selected="true" style="border: none;background-color: #ebebeb;">Estilização</button>
					  			</li> 
							</ul>
							<div class="tab-content" id="myTabContentEstilo" style="background-color: #ebebeb;height: 355px;">
					  			<div class="tab-pane fade show active" id="estilo" role="tabpanel" aria-labelledby="estilo-tab"> 

				  					<div style="height: 190px;">

				  						<input type="hidden" id="type_reserva_flights" value="<?=get_option( 'type_reserva_flights' )?>">

				  						<div class="mb-3">
					  						<div class="form-check form-check-inline">
											  	<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" style="    margin-top: 4px;" <?=(get_option( 'type_reserva_flights' ) == 1 ? 'checked' : '')?> onclick="set_type_reserva_flights(1)">
											  	<label class="form-check-label" for="inlineRadio1" style="    font-size: 14px;">Cotação</label>
											</div>
											<div class="form-check form-check-inline">
											  	<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2" style="    margin-top: 4px;" <?=(get_option( 'type_reserva_flights' ) == 2 ? 'checked' : '')?> onclick="set_type_reserva_flights(2)">
											  	<label class="form-check-label" for="inlineRadio2" style="    font-size: 14px;">Reserva</label>
											</div> 
											<p style="font-size: 11px;margin: 11px 0px;">Selecione o tipo da solicitação: reserva, para compra online, e cotação, para envio dos dados por e-mail.</p>
										</div> 

										<div class="row">
											<div class="col-lg-6 col-12">
								  				<div class="mb-3">
													<label for="cor_flights" class="form-label">Cor principal</label>
													<input type="color" class="form-control form-control-color" id="cor_flights" name="cor_flights" value="<?=(empty(get_option( 'cor_flights' )) ? '#000000' : get_option( 'cor_flights' ))?>" title="Selecione uma cor">
													<p style="font-size: 11px;margin: 11px 0px;">A cor informada será utilizada ao longo de todo o sistema.</p>
												</div> 
											</div>
											<div class="col-lg-6 col-12">
								  				<div class="mb-3">
													<label for="cor_botao_flights" class="form-label">Cor dos botões</label>
													<input type="color" class="form-control form-control-color" id="cor_botao_flights" name="cor_botao_flights" value="<?=(empty(get_option( 'cor_botao_flights' )) ? '#000000' : get_option( 'cor_botao_flights' ))?>" title="Selecione uma cor"> 
												</div> 
											</div>
										</div>

									</div>

									<?php submit_button(); ?>

					  			</div>
					  		</div>
	  					</div>
	  				</div>

	  			</div>
	  			<div class="tab-pane fade" id="contactFlights" role="tabpanel" aria-labelledby="contact-tab">

  					<div class="col-lg-6 col-12">
  						<ul class="nav nav-tabs" id="myTabCredencial" role="tablist" style="padding: 0px;">
				  			<li class="nav-item" role="presentation">
				    			<button class="nav-link active" id="credencialFlights-tab" data-bs-toggle="tab" data-bs-target="#credencialFlights" type="button" role="tab" aria-controls="home" aria-selected="true" style="border: none;background-color: #ebebeb;">Dados da licença</button>
				  			</li>
						</ul>
						<div class="tab-content" id="myTabContentCredencial" style="background-color: #ebebeb;height: 355px;">
				  			<div class="tab-pane fade show active" id="credencialFlights" role="tabpanel" aria-labelledby="credencial-tab">  

			  					<div style=" ">

					  				<div class="mb-3">
										<label for="chave_licenca_flights" class="form-label">Chave</label>
										<input type="text" class="form-control" id="chave_licenca_flights" name="chave_licenca_flights" value="<?=(empty(get_option( 'chave_licenca_flights' )) ? '' : get_option( 'chave_licenca_flights' ))?>">
									</div> 

								</div>

								<?php submit_button(); ?> 

				  			</div>
				  		</div>
  					</div> 

	  			</div>
			</div> 

		</div>

		<div class="footer text-center"> 
			<p class="copyright">
				<img src="https://traveltec.com.br/wp-content/uploads/2021/08/Logotipo-Pequeno.png" style="height: 20px;margin-bottom: 10px;">
				<br>
				Desenvolvido por Travel Tec © <?=date("Y")?> - Todos os direitos reservados
			</p>
			<p class="links">
				<a href="/">Suporte</a> <span class="divisor">|</span> <a href="/">Site oficial</a> <span class="divisor">|</span> <a href="/">Outros plugins</a>
			</p>
			<p class="redes">
				<i class="fa fa-instagram"></i>
				<i class="fa fa-youtube"></i>
			</p>
		</div>

		<script>
			jQuery(function(){
				jQuery("[data-toggle='tooltip']").tooltip();

				jQuery("#copy_button_1").attr('title', 'Copiar shortcode').tooltip('_fixTitle');
			});

			function copy(text, target) {
				navigator.clipboard.writeText(text);

				jQuery(target).attr('title', 'Copiado!').tooltip('_fixTitle').tooltip('show');

				setTimeout(function() {
					jQuery(target).attr('title', 'Copiar shortcode').tooltip('_fixTitle').tooltip('show');
				}, 800);
			}
		</script>

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> 

        <?php 

    } 

    add_action( 'wp_ajax_search_top_results_flights', 'search_top_results_flights' );
    add_action( 'wp_ajax_nopriv_search_top_results_flights', 'search_top_results_flights' );
    function search_top_results_flights(){ 

        $curl = curl_init(); 

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://agcy-api.reservafacil.tur.br/gwaereo/v0/flights?ages='.$_POST['ages'].'&businessClass='.$_POST['businessClass'].'&packageGroup='.get_option( 'Package' ).'&routes='.$_POST['routes'].'&preferences=maxResults:80',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Gtw-Agency-Id: '.get_option( 'Gtw-Agency-Id' ),
                'Gtw-Branch-Id: 1000',
                'Gtw-Password: MhmcypMMye',
                'Gtw-Username: montenegrogw',
                'Gtw-Group-Id: '.get_option( 'Gtw-Group-Id' ),
                'x-api-key: 0Oa1lV5bCz1SMNasZxuyl4qgMkEiYIMN6ulsgiQS',
                'Authorization: Bearer 1tWAWRWzzXBVCJgTFrUDJZWuDQFQYkBzF15Y7tTz'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }


    add_action( 'wp_ajax_save_data_flights', 'save_data_flights' );
	add_action( 'wp_ajax_nopriv_save_data_flights', 'save_data_flights' );
    function save_data_flights(){
    	$Gtw_Agency_Id     = $_POST['Gtw_Agency_Id'];
		$Gtw_Group_Id      = $_POST['Gtw_Group_Id'];
		$Package           = $_POST['Package'];
		$cor_flights       = $_POST['cor_flights'];
		$cor_botao_flights = $_POST['cor_botao_flights'];
		$type_reserva      = $_POST['type_reserva'];
		$licenca           = $_POST['licenca'];

		update_option('Gtw-Agency-Id', $Gtw_Agency_Id);

		update_option('Gtw-Group-Id', $Gtw_Group_Id);

		update_option('Package', $Package);

		update_option('cor_flights', $cor_flights);

		update_option('cor_botao_flights', $cor_botao_flights);

		update_option('chave_licenca_flights', $licenca);

		update_option('type_reserva_flights', $type_reserva);
    }

/* ***************************************** */
		/* FUNÇÃO PARA O MOTOR COM TODOS OS SERVIÇOS */
		/* VERIFICA SE O PLUGIN GERAL DE SHORTCODE ESTÁ ATIVO */
		/* SE NÃO, PEDE PRA INSTALAR */
		/* SE SIM, PROSSEGUE */
		/* Plugin criado para evitar duplicação de código e gerenciar o motor com todos os serviços em um só lugar */
		add_action( 'admin_init', 'flights_plugin_has_parents' );
		function flights_plugin_has_parents() {
			if (is_admin() && current_user_can('activate_plugins') && !is_plugin_active('TT-Helpers-1.0.0/helpers.php')){

			    add_action( 'admin_notices', 'flights_plugin_notice' );

			    deactivate_plugins( plugin_basename( __FILE__) );
			    if ( isset( $_GET['activate'] ) ) {
			      	unset( $_GET['activate'] );
			    }
			}
		}
		function flights_plugin_notice() { ?>
			<div class="error">
				<p>O plugin <strong>Vouchertec - Vôos</strong> precisa que o plugin <strong>Vouchertec - Shortcode</strong> esteja instalado e ativo para funcionar corretamente. Você pode fazer o download através <a href="https://github.com/TravelTec/TT-Helpers/archive/refs/tags/1.0.0.zip" target="_blank">deste link</a>. </p>
			</div>
		<?php }
		/* ***************************************** */

// Adiciona abas de detalhes ao plugin
function aereo_details_tabs($links, $file) {
    // Verifica se é o plugin desejado
    if (strpos($file, 'vouchertec-flights.php') !== false) {
        // Adiciona a aba "Documentação" antes do link de desativar
        $documentation_link = '<span style="font-weight: bold;"><a href="https://traveltec.freshdesk.com/support/solutions/folders/43000591964" target="_blank">Documentação</a></span>';
        
        // Encontra a posição do link de desativar
        $deactivate_position = array_search('deactivate', array_keys($links));
        
        // Insere o link de documentação diretamente na posição desejada
        array_splice($links, $deactivate_position, 0, $documentation_link);
    }

    return $links;
}
add_filter('plugin_action_links', 'aereo_details_tabs', 10, 2);
