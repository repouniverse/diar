<?php
$model=$dataProvider->getModels();
//echo $dataProvider->query->createCommand()->rawSql; die();
$grupos=$dataProvider->query->select(['desgrupo'])->distinct()->column();

?>
<div style="position:absolute; width:80%; left:<?php echo $modelo->x_grilla; ?>px; top:<?php echo $modelo->y_grilla; ?>px">
    <?php foreach($grupos as $key=>$grupo){ ?>
    <table style="border-style:2px; border-color:black;">
        <tr><?=$grupo?></tr>
        
    </table>
    <?php } ?>
</div>

