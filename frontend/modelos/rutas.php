<?php

class Ruta{

    /*======================================
	    RUTA LADO DEL CLIENTE      
	========================================*/
	static public function ctrRuta(){

		return "http://172.16.46.94/Comanda/frontend/";
		//172.16.46.94
	}

	/*======================================
	    RUTA LADO DEL SERVIDOR      
	========================================*/

	static public function ctrRutaServidor(){

		return "http://172.16.46.94/Comanda/backend/";
	}
}