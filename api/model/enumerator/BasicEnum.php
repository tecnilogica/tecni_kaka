<?php

namespace enumerator;

/**
 * Clase para modelar una implementación de los tipos de datos Enumerados en
 * otros lenguajes.
 *
 * @author  Fernando Porres <fernando.porres@tecnilogica.com>
 */
abstract class BasicEnum {


  /**
   * Colección de valores enumerados.
   * @var Array
   */
  private static $constCache = NULL;


  /**
   * Obtiene las constantes definidas en la clase invocada y las asigna a la
   * propiedad constCache para simular valores enumerados.
   * @return Array Colección de valores enumerados.
   */
  public static function getConstants() {

    $reflect = new \ReflectionClass(get_called_class());
    self::$constCache = $reflect->getConstants();
    return self::$constCache;

  }


  /**
   * Obtiene la constante identificada por el código recibido como parámetro.
   * @return String Valor asociado a la constante.
   */
  public static function getConstant($key) {

    $constants = self::getConstants();
    $constant = NULL;

    if (array_key_exists($key, $constants)) {
      $constant = $constants[$key];
    }

    return $constant;

  }


  /**
   * Comprueba si el valor enviado como parámetro existe como clave en el
   * conjunto de valores enumerados.
   * @param  String  $name   Clave del valor enumerado a buscar.
   * @param  boolean $strict Indica si la búsqueda es sensible a mayúsculas.
   * @return boolean         Encontrado o no?
   */
  public static function isValidName($name, $strict = false) {

    $constants = self::getConstants();

    if ($strict) {
      return array_key_exists($name, $constants);
    }

    $keys = array_map('strtolower', array_keys($constants));
    return in_array(strtolower($name), $keys);
  }



  /**
   * Comprueba si el valor pasado como parámetro pertenece al conjunto
   * enumerado.
   * @param  [type]  $value [description]
   * @return boolean        Es válido o no.
   */
  public static function isValidValue($value) {

    $values = array_values(self::getConstants());
    return in_array($value, $values, $strict = true);

  }

}