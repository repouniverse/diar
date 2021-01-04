<?php  use yii\grid\GridView;?>

   <?=$contenidoSinGrilla?>
         <div style="position:absolute; width:90%; left:<?php echo $modelo->x_grilla; ?>px; top:<?php echo $modelo->y_grilla; ?>px">
             <?php
                //yii::error($modelo->vistaalterna);
                    if(!empty($modelo->vistaalterna)) { ?>
                        
                         <?php
                                $grupos=$dataProvider->query->select(['codgrupo','desgrupo'])
                                    ->distinct()->asArray()->all();
                                $detalles=$dataProvider->query->select(['codgrupo',
                                    'desgrupo',
                                    'descargo','codsuministro','unidades','lanterior','lectura','delta',
                                    'monto','montototal','simbolo'])
                                    ->asArray()->all();
                                echo $this->render($modelo->vistaalterna,[
                                    'modelo'=>$modelo,
                                    'grupos'=>$grupos,
                                    'detalles'=>$detalles,
                                    ]);
                         
                         ?>
                      
                     <?php    //$this->render($modelo->vistaalterna);
                     /*$grupos=$dataProvider->query->select(['desgrupo'])
                      ->distinct()->asArray()->all();
                     foreach($grupos as $filaGrupo){
                         echo $filaGrupo['desgrupo']."<BR>";
                     }*/
             ?>
<?php }else {    ?> 
            <?php 
                    yii::error(' este render NO ES DE LA VISTA ALTERNA ');
                 ?>
  <?php 
if(count($columnas)>0)
echo GridView::widget([
        'id'=>'detallerepoGrid',
     'showFooter' => true,
    'summary' => '',
    //'showPageSummary' => true,
    //'striped' => true,
    'emptyCell'=>'',
    // 'showFooter' => true,
         // 'tableOptions'=>['class'=>'table no-margin'],
               'dataProvider' => $dataProvider,        
        'columns' =>$columnas ,
    // 'pager' => ['options'=>['visible'=>false]],
        ]
    );  ?>




<?php }?>

</div>