<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="row">
    <?php 
         foreach ( $links as $item) : ?>
         <div class="col-sm-2 col-lg-2 col-md-2 espaciado">
        <div class="menu">
             <?=Html::img($item["img"] ,['style'=>["width"=>"100%;"]]); ?> 
             <p><?php echo Html::a($item["nombre"], Url::to(Yii::$app->homeUrl.$item["link"], true ));   ?></p>
            </div>   
        </div>
     <?php endforeach; ?>
        
        

    </div>
</div>
