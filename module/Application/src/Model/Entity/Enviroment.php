<?php
namespace Application\Model\Entity;

class Enviroment{
	const MSG_SAVE = 'Se ha guardado el registro satisfacoriamente.';
	const MSG_UPDATE = 'Se ha actualizado el registro satisfacoriamente.';
	const MSG_DELETE = 'Se ha eliminado el registro satisfacoriamente.';
	const MSG_ERROR = 'Se ha producido un error, intente en unos minutos o ponganse en contacto con el administrador.';
	const NOT_FIND = 'El registro que buscaba no se ha encontrado.';

	public static function GetDate(){
		$date = getdate();
		return sprintf('%s-%s-%s', $date['year'], $date['mon'], $date['mday']);
	}
}