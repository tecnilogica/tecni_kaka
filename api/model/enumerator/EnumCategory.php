<?php

namespace enumerator;

/**
 * Clase para modelar las claves de las categorías de preguntas.
 * Solo se usa la clave, el valor es simplemente descriptivo. Se trata
 * como si fuese un conjunto de datos enumerado.
 */
class EnumCategory extends BasicEnum {

  /** CATEGORIAS */
  const TO = 'TODAS';
  const DE = 'DEPORTES';
  const MO = 'MODA';
  const CI = 'CINE';
  const TE = 'TECNOLOGIA';

}