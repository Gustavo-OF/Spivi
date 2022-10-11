<?php 

namespace Controller;

use SimpleXMLElement;

class ControllerFuncoes{

    public function __construct(){

    }

    public function formataRetorno($data) : SimpleXMLElement
    {

        $xml = new SimpleXMLElement($data);
        return $xml;
    }

    public function remover_Injection($string) {
		$string = strtr(
		$string,
		array (
									 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
									 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
									 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
									 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
									 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
									 'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
									 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
									 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
									 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
									 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
									 'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
								   )
					);
					
					$string = preg_replace("/select/", "", $string);
					$string = preg_replace("/update/", "", $string);
					$string = preg_replace("/delete/", "", $string);
					$string = preg_replace("/from/", "", $string);
					$string = preg_replace("/into/", "", $string);
					$string = preg_replace("/insert/", "", $string);
					$string = preg_replace("/where/", "", $string);
					$string = preg_replace("/drop/", "", $string);
					
					$string = preg_replace("/SELECT/", "", $string);
					$string = preg_replace("/UPDATE/", "", $string);
					$string = preg_replace("/DELETE/", "", $string);
					$string = preg_replace("/FROM/", "", $string);
					$string = preg_replace("/INTO/", "", $string);
					$string = preg_replace("/INSERT/", "", $string);
					$string = preg_replace("/WHERE/", "", $string);
					$string = preg_replace("/DROP/", "", $string);

		
		$string = preg_replace("/[][><}{)(:;,=!?*%~^`\'-]/", "", $string);
		//$string = preg_replace("/ /", "", $string);
		return $string;
	}
}
?>