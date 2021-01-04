<div style="position:absolute;
     width:180px;height:80px;
     padding:0px; top:<?php echo $model->ylogo-1; ?>px;
     left:<?php echo $model->xlogo-1; ?>px; border-style:solid; border-width:0px; border-color:#e1e1e1 ">


<div style="position:absolute; padding:1px;border-style:none; 
     top:<?php echo $model->ylogo; ?>px; left:<?php echo $model->xlogo; ?>px; ">
    				<div style="float:right">
	<?php 
       
        echo \yii\helpers\Html::img($model->files[0]->path, ['width'=>300,'height'=>200]); ?>
				</div>

</div>


</div>

