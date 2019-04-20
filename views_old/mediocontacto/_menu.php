<?php
/**
 * Created by PhpStorm.
 * User: moskito
 * Date: 11/05/2016
 * Time: 06:35 PM
 */
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['\clientes']];
$this->params['breadcrumbs'][] = ['label' => 'Medio Contacto', 'url' => ['index']];
if (strpos($this->title, 'Editar') !== false) {
    $this->params['breadcrumbs'][] = "Editar";
}else if (strpos($this->title, 'Mostrar') !== false) {
    $this->params['breadcrumbs'][] = "Mostrar";
}else{
    $this->params['breadcrumbs'][] = $this->title;
}


?>