<?php 
// Creamos un helper para validar nuestros campos del formulario de registro
function mostrar_error($validation, $field){
    if($validation->hasError($field)){
        return $validation->getError($field);
    }else{
        return false;
    }
}


?>