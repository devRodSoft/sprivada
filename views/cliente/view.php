<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = "Mostrar : ".$model->idcliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['/dash/catclientes']];
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Mostrar";
?>
<div class="cliente-view">

    <?php /**    <h1> Html::encode($this->title) ?></h1>

    <p>
        <?= GlypIcon::aglyp('Nuevo', 'glyphicon-plus' ,  ['create'], ['class' => 'btn btn-success']) ?>
        <?= GlypIcon::aglyp('Editar', 'glyphicon-pencil' ,['update',  'idcliente' => $model->idcliente , 'fk_mediocontacto' => $model->fk_mediocontacto , 'fk_estado' => $model->fk_estado ], ['class' => 'btn btn-primary']) ?>
        <?= GlypIcon::aglyp('Eliminar','glyphicon-remove' , ['delete', 'idcliente' => $model->idcliente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro de Eliminar?',
                'method' => 'post',
            ],
        ])  
    </p>**/?>
<?php
//<!--    <div class="row">-->
//<!--        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">-->
//<!--            <div class="panel panel-default">-->
//<!--                <!-- Default panel contents -->-->
//<!--                <div class="panel-heading"Datos Generales</div>-->
//<!---->
//<!--            <ul class="list-group">-->
//<!--                <li class="list-group-item">-->
//<!--                        caso1-->
//<!--                    </li>-->

?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcliente',
            'nombre_razon_social',
            'rfc',
            'lider_proy',
            'vinculador_1',
            'correo_vin_1',
            'vinculador_2',
            'correo_vin_2',
            'telefono',
            'direccion',
            'ciudad',
            'fkEstado.estado',
            'fkMediocontacto.medio',
        ],
    ]) ?>

</div>
