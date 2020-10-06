<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\sigi\models\SigiCargosgrupoedificioSearch;
?>
<div class="edificios-index_doycus">

     <div class="box-body">
         
<?php
 $url= Url::to(['agrega-grupo','id'=>$model->id,'gridName'=>'grilla-grupocargos','idModal'=>'buscarvalor']);
   echo  Html::button(yii::t('base.verbs','Insertar'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Agrupacion'),'id'=>'btn_grupos_edi', 'class' => 'botonAbre btn btn-success']); 
?> 
<?php
 //$url= Url::to(['replica-presupuesto','id'=>$model->id]);
   echo  Html::button(yii::t('base.verbs','Partidas'), ['title' => yii::t('sta.labels','Generar Partidas'),'id'=>'btn_presupuesto', 'class' => 'btn btn-warning']); 
?>
         <div class="badge badge-info"><?=yii::t('base.labels','Monto planificado total : ').'       '.$model->montoTotalColectores()?></div>

<?php
 //$url= Url::to(['replica-presupuesto','id'=>$model->id]);
   echo  Html::button(yii::t('base.verbs','Partidas'), ['title' => yii::t('sta.labels','Generar Partidas'),'id'=>'btn_presupuesto', 'class' => 'btn btn-warning']); 
?> 
    <?php Pjax::begin(['id'=>'grilla-grupocargos']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'dataProvider' =>(new SigiCargosgrupoedificioSearch())->searchByEdificio($model->id),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{update}{delete}',
               'buttons' => [
                  'update' => function($url, $model) {   
                        $url= \yii\helpers\Url::to(['edita-grupo','id'=>$model->id,'gridName'=>'grilla-grupocargos','idModal'=>'buscarvalor']);
                        $options = [
                            'title' => Yii::t('base.verbs', 'Editar'), 
                            'class'=>'botonAbre',
                            'data-pjax'=>'0'
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                        'delete' => function ($url,$model) {
			   $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                        
                    ]
                ],
                [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                                },
                            'detail' => function ($model, $key, $index, $column) {
                            return Yii::$app->controller->renderPartial('/edificios/colectores/_colectores', ['grupo_id' => $model->id]);
                            },
                    //'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
                ],
            'codgrupo',
              'descripcion', [
    'attribute' => 'activo',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('activo[]', $model->activo, [ 'disabled' => true]);

             },
          ],
        ],
    ]); ?>
         <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgruidBancos',
            'idGrilla'=>'grilla-grupocargos',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
       
     <?php    
     $string="$('#btn_presupuesto').on( 'click', function(){ 
     
       $.ajax({
              url: '".Url::to(['/sigi/edificios/replica-presupuesto','id'=>$model->id])."', 
              type: 'get',
              data:{id:".$model->id."  },
              dataType: 'json', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
              var n = Noty('id');
                      
                       if ( !(typeof json['error']==='undefined') ) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                          }    

                             if ( !(typeof json['warning']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['warning']);
                              $.noty.setType(n.options.id, 'warning');  
                             } 
                          if ( !(typeof json['success']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['success']);
                              $.noty.setType(n.options.id, 'success');  
                             }      
                   
                        }
                        });


             })";
  
   $this->registerJs($string, \yii\web\View::POS_END); ?>    
         
         
         
         
    <?php Pjax::end(); ?>

    </div>
      </div>