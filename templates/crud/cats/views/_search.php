<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
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

           <?= "<?= " ?> $form->field($model, 'globalSearch')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar..."])->label(false); ?>
           
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
    
    <?= "<?php " ?> ActiveForm::end(); ?>
</div>
