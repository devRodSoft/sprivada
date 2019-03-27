<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = "Mostrar : ".$model->idcotizacion;
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = 'Cotizacions';

$this->params['breadcrumbs'][] = "Mostrar : ".$model->idcotizacion;
?>
<div class="cotizacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcotizacion',
            'fecha',
            'referencia',
            'elaboracion',
            'sitio:html',
            'edificio:html',
            'iluminacion:html',
            'tipo',
            'direccion',
            'razon',
            'nombre_proyecto',
            'escala',
            'fkCotestatus.cotestatus',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

        <h1>Propuesta :</h1>
     <?= GridView::widget([
        'dataProvider' => $escalaProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],
            'escala',
            'dimensiones',
            'precio',
        ],
    ]); ?>

</div>
