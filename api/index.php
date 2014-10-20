<?php



// CARGA LA LIBRERÍA BASE
$f3=require('lib/fatfree/base.php');





// CAMBIO INTRODUCIDO EN FF3.1.1
// http://www.php.net/manual/en/book.pcre.php
// Eliminado del proyecto por incompatibilidad con PRE
// if ((float)PCRE_VERSION<7.9) {
//   trigger_error('PCRE version is out of date');
// }

// CARGA FICHEROS DE CONFIGURACIÓN Y CONSTANTES
$f3->config('config/config.cfg');
//$f3->config("./config/constants.cfg");

// CARGA AUTOMÁTICA DE CÓDIGO

$f3->set('AUTOLOAD', 'model/; helpers/');
//$f3->set('UPLOADS','uploads/');

// CODIFICACIÓN DEL CONTENIDO
$f3->set('ENCODING','UTF-8');
// RUTAS A LAS PLANTILLAS
//$f3->set('UI','./web/templates/');
// RUTAS AL TEMP PARA CAaCHEAR LAS PLANTILLAS
$f3->set('TEMP','temp/');
// RUTA HASTA LOS DICCIONARIOS
$f3->set('LOCALES', 'dict/');
$f3->set('FALLBACK','es_ES');

// Ruta base para los includes manuales (sin autoload)
//$f3->set('BASEPATH', $f3->get('ROOT') . $f3->get('BASE')) ;

// CARGA DE FUNCIONES COMUNES A TODAS LAS PETICIONES
//require_once('./config/common.php');

// CARGA EL MAPA DE RUTAS
//require_once('./config/routes_web.php');

$f3->set('DB', new \DB\SQL($f3->get('DBConnectString'),
					   $f3->get('DBUser'),
					   $f3->get('DBPassword')));

$db = $f3->get('DB');

$web = \Web::instance();

// Metano data
$f3->route('GET    /stadistic' , 'Stadistic->getStadistics'); 
$f3->route('POST    /stadistic' , 'Stadistic->addStadistic'); 


$f3->run();

?>