<?php

class ValidatorHelper{

    const VAL_OK          = 0;
    const VAL_ISMANDATORY = 1;
    const VAL_ISNUMERIC   = 2;
    const VAL_ISEMAIL     = 3;
    const VAL_EXISTS      = 4;
    const VAL_MYQUESTION  = 5; //No puedo votar a mi propia pregunta
    private static $validatemsg   = array();

    /**
     * Valida los campos de un Mapper
     * @param  [String]  $validations Validaciones a realizar sobre el Mapper
     * @param  [DB\SQL\Mapper]  $model Mapper a validar
     * @return [Array]  Devuelve los mensajes de errores de validación
     */
    public static function validate($validations, $model){
        
        foreach ($validations as $field => $functions){
            $functions = explode(' ', $functions);
            foreach ($functions as $function){
                self::$function($model, $field);
            }
            
        }

        return self::$validatemsg;
    }
    
    /**
     * Valida campos obligatorios
     * @param  [DB\SQL\Mapper]  $model Mapper a validar
     * @param  [String]  $field campo a validar
     */
    protected static function isMandatory($model, $field){

        if( !$model->get($field) || $model->get($field) === 0){
            $model->clear($field);
            self::$validatemsg[$field] = self::VAL_ISMANDATORY;            
        }
        
    }

    /**
     * Valida campos numéricos
     * @param  [DB\SQL\Mapper]  $model Mapper a validar
     * @param  [String]  $field campo a validar
     */
    protected static function isNumeric($model, $field){

        if( !is_int($model->get($field)) ){
            $model->clear($field);
            self::$validatemsg[$field] = self::VAL_ISNUMERIC;            
        }
        
    }

    /**
     * Valida campos tipo email
     * @param  [DB\SQL\Mapper]  $model Mapper a validar
     * @param  [String]  $field campo a validar
     */
    protected static function isEmail($model, $field){

        $audit = \Audit::instance();

        if( !$audit->email($model->get($field), FALSE) ){
            $model->clear($field);
            self::$validatemsg[$field] = self::VAL_ISEMAIL;            
        }
        
    }

}

?>