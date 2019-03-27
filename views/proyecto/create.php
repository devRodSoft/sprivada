<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Nuevo Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-create">

	<?php  if(isset($model->idllamada))
			echo "<h1>Proyecto</h1>" ;  ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
