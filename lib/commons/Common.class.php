<?php

/**
 * Common functions
 */
class Common
{
	/**
	 * Check email
	 *
	 * @param string $email
	 * @return string
	 */
	public static function getEmailError($email)
	{
		$st_error = '';
		$validate = new sfValidatorEmail(array('required'=>true), array('required'=>'Enter the email', 'invalid'=>'The email seems incorrect'));

  	try { $validate->clean($email); } catch(sfValidatorError $e) { $st_error = $e; }

  	return $st_error;
	}

	/**
	 * Check password
	 *
	 * @param string $password
	 * @return string
	 */
	public static function getPasswordError($password)
	{
		$st_error = '';
		$validate = new sfValidatorAnd(
			array(
				new sfValidatorRegex(array('pattern' => "((?=.*\d)(?=.*[a-zA-Z]).)")),
				new sfValidatorString(array('min_length' => 6))
    	), array('required'=>true), array('required'=>'Enter the password', 'invalid'=>'The password seems incorrect')
    );
  	try { $validate->clean($password); } catch(sfValidatorError $e) { $st_error = $e; }

  	return $st_error;
	}

	/**
	 * Render options for simple select tag
	 *
	 * @param array $options
	 * @param mixed $selected
	 * @return string
	 */
	public static function fillSimpleSelect($options, $selected = 0)
	{
		$tag_options = '';

		foreach ($options as $key => $value) {
			$style_selected = $key == $selected ? ' selected' : '';

			$tag_options .= "<option value='$key'$style_selected>$value</option>\n";
		}		
		return $tag_options;
	}
	
	/**
	 * Render options for multiple select tag with checkboxes
	 *
	 * @param string $objeto
	 * @param array $datos
	 * @param array $seleccionados
	 * @param integer $altura_div
	 * @return string
	 */
	public static function fillMultipleSelectWithBoxes($objeto, $datos, $seleccionados = array(), $altura_div = 158)
	{
		$Opciones = "<div class='d_2' style='height:$altura_div;'>";

		foreach($datos as $indice => $valor)
		{
			$elegida = "";
			$bgcolor = "#E5E5E5";
			$frcolor = "#333333";

			foreach ($seleccionados as $selected) {
				if ($indice == $selected) {
					$elegida = " CHECKED "; $bgcolor = "#F1DCB4"; break;
				}
			}
			$Opciones .= "<label style='display:block;background-color:$bgcolor;color:$frcolor;'>";
			$Opciones .= "<input name='$objeto' value='$indice' type='checkbox' $elegida onclick='highlight_div(this);' style='vertical-align:middle;'>";
			$Opciones .= "&nbsp;$valor</label>\n";
		}
		return $Opciones."</div>";
	}

 /**
  * get strtr special characters
  * @param string $toClean
  * @return string
  */
  public static function getStrtrSpecialCharacters($toClean)
  {
    $GLOBALS['normalizeChars'] = array(
      'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
      'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
      'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
      'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
      'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
      'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
      'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f'
		);
    $toClean = str_replace('&', '_and_', $toClean);
    $toClean = str_replace('--', '_', $toClean);
    $toClean = str_replace(' ', '_', $toClean);

    return strtr($toClean, $GLOBALS['normalizeChars']);
  }
  
  /**
   * Get date in certain format
   *
   * @param string $date
   * @return string
   */
  public static function getFormattedDate($date, $format='Y-m-d')
  {
    $date = new DateTime($date);
    return $date->format($format);
  }
  
  /**
	 * Dump debbug info to file
	 *
	 * @param string $data
	 */
	public static function writeThisInLog($data)
  {
    $dir = sfConfig::get('sf_upload_dir') . '/debugging/';
    $txt = $dir . 'log.txt';

    if ($fh = fopen($txt, 'a+'))
    {
      fwrite($fh, $data . "\n");
      fclose($fh);

      chmod($txt, 0777);
    }
  }
  
  /**
   * Replace html linebreak with plain text linebreak
   *
   * @param string $input
   * @return string
   */
  public static function br2n($input)
  {
 		return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
	}

	/**
	 * Get nombre mes según idioma
	 *
	 * @param integer $nro_mes
	 * @param string $idioma
	 * @return string
	 */
	public static function nombresMes($nro_mes, $idioma = 'es')
	{
		$nro_mes = is_int($nro_mes) ? $nro_mes: (integer) $nro_mes;
		$nro_mes = $nro_mes > 0 && $nro_mes < 13 ? $nro_mes : 1;

		$arMeses = array(
			'es'=>array(1=>'Enero'  ,'Febrero' ,'Marzo','Abril','Mayo','Junio','Julio'  ,'Agosto','Setiembre','Octubre','Noviembre','Diciembre'),
			'en'=>array(1=>'January','February','March','April','May' ,'June' ,'July'   ,'August','September','October','November' ,'December'),
			'fr'=>array(1=>'Janvier','Février' ,'Mars' ,'Avril','Mai' ,'Juin' ,'Juillet','Août'  ,'Septembre','Octobre','Novembre' ,'Décembre')
		);
		return $arMeses[$idioma][$nro_mes];
	}

	/**
	 * Get día semana según idioma
	 *
	 * @param integer $nro_dia
	 * @param string $idioma
	 * @return string
	 */
	public static function diaSemana($nro_dia, $idioma = 'es')
	{
		$nro_dia = is_int($nro_dia) ? $nro_dia : (integer) $nro_dia;
		$nro_dia = $nro_dia >= 0 && $nro_dia <= 6 ? $nro_dia : 0;

		$arrDias = array(
			'es'=>array('Domingo' ,'Lunes' ,'Martes'  ,'Miércoles','Jueves'    ,'Viernes' ,'Sábado'),
			'en'=>array('Sunday'  ,'Monday','Tuesday' ,'Wednesday','Thursday'  ,'Friday'  ,'Saturday'),
			'fr'=>array('Dimanche','Lundi' ,'Mardi'   ,'Mercredi' ,'Jeudi'     ,'Vendredi','Samedi')
		);
		return $arrDias[$idioma][$nro_dia];
	}
	
	/**
	 * Select multiple con checkboxes
	 *
	 * @param string $objeto
	 * @param array $datos
	 * @param array $seleccionados
	 * @param integer $altura_div
	 * @return string
	 */
	public static function llenarSelectMultipleWithBoxes($objeto, $datos, $seleccionados = "", $altura_div = 158)
	{
		$Opciones = "<div class='d_2' style='height:".$altura_div."px;'>";

		if (!is_array($seleccionados)) {
			$seleccionados = array($seleccionados);
		}
		foreach($datos as $indice => $valor)
		{
			$elegida = "";
			$bgcolor = "#E5E5E5";
			$frcolor = "#000000";

			if (in_array($indice, $seleccionados)) {
				$elegida = " CHECKED ";
				$bgcolor = "#F1DCB4";
			}
			$Opciones .= "<label style='display:block;background-color:$bgcolor;color:$frcolor;'>";
			$Opciones .= "<input name='$objeto' value='$indice' type='checkbox' $elegida onclick='highlight_div(this);' style='vertical-align:middle;'>";
			$Opciones .= "&nbsp;$valor</label>\n";
		}
		return $Opciones."</div>";
	}

} // end class