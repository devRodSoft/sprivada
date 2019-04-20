<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CformaPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */




$gridColumns1 = ['idllamada', 'created_at', 'prospecto', 'telefono', 'email:email', 'asunto', 
['attribute'=> 'fk_lstatus', 'value' => 'fkLstatus.lstatus', ],];?> 

<div class="cforma-pago-index">
<?php
   echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";

GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns1,
]);
?>
</div>
