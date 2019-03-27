<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CcalibreAcrilicoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ccalibre-acrilico-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id'=>'searchForm',
        'fieldConfig' => [
            'template' => "{input}",
            'options' => [
                'tag'=>'span'
            ]
        ],
    ]); ?>

<?php
// $form->field($model, 'idccalibre_acrilico')
//<?= $form->field($model, 'globalSearch')
 ?>
    <div id="custom-search-input">
        <div class="input-group col-md-12">

            <?= $form->field($model, 'globalSearch')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar..."])->label(false); ?>
<!--            <input type="text" id="ccalibreacrilicosearch-globalsearch" class="form-control" name="CcalibreAcrilicoSearch[globalSearch]" placeholder="Buscar..">-->
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-lg" id="reset" >
                            <i class="glyphicon glyphicon-erase"></i>
                        </button>
                        <button type="submit" class="btn btn-info btn-lg" >
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
