<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div id="main-index">

    
    <?php foreach ( $links as  $item) : ?>
         <div class="menu-item espaciado">
        <div class="menu">
             <?=Html::img($item["img"] ,['style'=>["width"=>"170px"]]); ?> 
             <p><?php echo Html::a($item["nombre"], Url::to(Yii::$app->homeUrl.$item["link"], true ));   ?></p>
            </div>   


        </div>
     <?php endforeach; ?>
        
        

</div>
