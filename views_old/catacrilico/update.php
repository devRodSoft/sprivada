<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcalibreAcrilicoModel */

$this->title = 'Editar : ' . $model->idccalibre_acrilico;
$this->render("_menu.php");
//$this->params['breadcrumbs'][] = ['label' => $model->idccalibre_acrilico, 'url' => ['view', 'id' => $model->idccalibre_acrilico]];
?>
<div class="ccalibre-acrilico-model-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
