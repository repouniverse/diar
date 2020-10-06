<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
?>

    
   
  
     <div class="box-body">
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    
    
<?php
//var_dump($grupo_id);die();
$idPjax="pjax_colector_".$grupo_id;
   

$gridColumns = [
                   
               
                
                'cargo.codcargo',
                'cargo.descargo',
                ['attribute' => 'tasamora',],
                     [
                          'attribute' => 'regular',
                         'format' => 'raw',
                            'value' => function ($model) {
                            return \yii\helpers\Html::checkbox('regular[]', $model->regular, [ 'disabled' => true]);
                                   },
                      ],
                                           [
                          'attribute' => 'montofijo',
                         'format' => 'raw',
                            'value' => function ($model) {
                            return \yii\helpers\Html::checkbox('montofijo[]', $model->montofijo, [ 'disabled' => true]);
                                   },
                      ],
                                           [
                          'attribute' => 'individual',
                         'format' => 'raw',
                            'value' => function ($model) {
                            return \yii\helpers\Html::checkbox('individual[]', $model->individual, [ 'disabled' => true]);
                                   },
                      ],
                  ['attribute'=>'monto',
                            'format' => ['decimal', 2],
                            'pageSummary' => true,
                            ]    ,                     
            ]   ;

    
  ?>
   <div> 
  <?php
   Pjax::begin(['id'=>$idPjax]);
 echo GridView::widget([
    'id' => 'mygrilla',
      'showPageSummary' => true,
    'dataProvider' => (new frontend\modules\sigi\models\SigiCargosedificioSearch())->searchByGrupo($grupo_id),
   'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    
    'pjax' => true, // pjax is set to always true for this demo
   'responsive' => TRUE,
    
]);
 
?>
  
 <?php
  Pjax::end();
   
   ?>   

    </div>
</div>

  
       

