<?php


class Stadistic extends \DB\SQL\Mapper{

    private $f3, $error, $validations;

    public function __construct() {

        $this->f3 = Base::instance();
        $this->error = array();
        $this->validations = array('est_metano'           => 'isMandatory',
                                   'fk_ser_id'           => 'isMandatory',
                                   'est_entrada'           => 'isMandatory',
                                   'est_salida'           => 'isMandatory');

        parent::__construct($this->f3->get('DB'), 'estadisticas');
    }

    public function beforeRoute(){
       

    }

    public function afterRoute(){
        
    }
   
    public function getStadistics() {

        $stadistics = array();
        
        $stadistics = $this->find(array());

         $results = array();        
        foreach($stadistics as $stadistic){
            $results[] = $stadistic->cast();
        }

        
        HeadersHelper::sendJSON($results);
    }

   

    /**
     * Crear nueva estadistica 
     * {"est_metano": "120.1",
     *  "fk_ser_id": 1,
     *  "est_entrada": "2014-10-20 12:30",
     *  "est_salida": "2014-10-20 12:40"] }
     */
    public function addStadistic() {

        $body = json_decode($this->f3->get('BODY'), true);


        $date = date("Y-m-d H:i:s");

        // Set by user
        $this->set('est_metano',      $body['est_metano']);
        $this->set('fk_ser_id',   $body['fk_ser_id']);
        $this->set('est_entrada', $body['est_entrada']);
        $this->set('est_salida', $body['est_salida']);

        // Auto set
        $this->set('est_fecha', $date);


        $this->error['stadistic'] = ValidatorHelper::validate($this->validations, $this);

        if($this->error['stadistic']){
            $this->error['result'] = 'KO';
            HeadersHelper::sendJSON($this->error);
        }else{
            $this->save();
            HeadersHelper::sendJSON($this->cast());

        }
        

    }

}

?>