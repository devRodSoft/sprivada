<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CotconfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cotconfig-search">

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

<div id="custom-search-input">
        <div class="input-group col-md-12">

           <?=  $form->field($model, 'globalSearch')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar..."])->label(false); ?>
           
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
    
    <?php  ActiveForm::end(); ?>
</div>
