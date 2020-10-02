<?php
namespace App\Util;

class DateFormat {

    private static $arrMeses = array('01'=>'Enero', '02'=>'Febrero', '03'=>'Marzo', '04'=>'Abril', '05'=>'Mayo', '06'=>'Junio', '07'=>'Julio', '08'=>'Agosto', '09'=>'Septiembre', '10'=>'Octubre', '11'=>'Noviembre', '12'=>'Diciembre');
    private static  $arrDias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    
    public static function get_Dia($id){
		return self::$arrDias[$id];
	}

	public static function get_Mes($id){
		return self::$arrMeses[$id];
	}
        
	public static function get_Meses(){
		return self::$arrMeses;
	}

	public static function get_Dias(){
		return self::$arrDias;
	}

}
?>