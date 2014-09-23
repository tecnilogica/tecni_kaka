php

use \enumerator\EnumCategory;

class Category{

    private $f3;

    public function __construct() {

        $this->f3 = Base::instance();
        
    }

    public function beforeRoute(){
        //Comprobar permisos del usuario??
    }

    public function afterRoute(){
        
    }
    
    /**
     * Obtener todas las categorías
     */
    public function getAllCategories() {

        foreach (EnumCategory::getConstants() as $key=>$value) {
          $categories[] = array(
            'id'      => $key,
            'value' => $this->f3->get('dict_enum_category_' . $key)
            );
          
        }

        HeadersHelper::sendJSON($categories);

    }

}

?>