<?php

namespace frontend\modules\sigi\controllers;

use Yii;
use frontend\modules\sigi\models\SigiMovimientosPre;
use frontend\modules\sigi\models\SigiMovimientosPreSearch;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use yii\helpers\Url;
use frontend\controllers\base\baseController;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * MovimientosController implements the CRUD actions for SigiMovimientosPre model.
 */
class MovimientosController extends baseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SigiMovimientosPre models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SigiMovimientosPreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SigiMovimientosPre model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SigiMovimientosPre model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SigiMovimientosPre();
        
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SigiMovimientosPre model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SigiMovimientosPre model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SigiMovimientosPre model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SigiMovimientosPre the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SigiMovimientosPre::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('sigi.labels', 'The requested page does not exist.'));
    }
    
    
    public function actionMovConfirmar(){
        
    }
    
    
    public function actionCuentasBancarias(){
         $searchModel = new \frontend\modules\sigi\models\SigiCuentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('cuentas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionEditaCuenta($id){
       $model= \frontend\modules\sigi\models\SigiCuentas::findOne($id);
      if(is_null($model))
       throw new NotFoundHttpException(Yii::t('sigi.labels', 'No se encontró el registro'));
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuentas']);
        }

        return $this->render('edita_cuenta', [
            'model' => $model,
        ]); 
        
       
    }
    
  public function actionCorteCuenta($id){
    $this->layout = "install";
         $modelCuenta= \frontend\modules\sigi\models\SigiCuentas::findOne($id);  
       if(is_null($modelCuenta)){
           throw new NotFoundHttpException(Yii::t('sigi.labels', 'Esta dirección no existe'));
       }
      //echo "sas";die();
        $model= New \frontend\modules\sigi\models\SigiMovbanco();
        $model->setScenario($model::SCE_CORTE);
        $model->edificio_id=$modelCuenta->edificio_id;
        $model->cuenta_id=$modelCuenta->id;
       
         $model->tipomov=$model::TIPO_CORTE;
       $datos=[];
        if(h::request()->isPost){
           // VAR_DUMP($model->attributes);
            $model->load(h::request()->post());
             //VAR_DUMP($model->attributes);DIE();
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();
                
                //$model->assignStudentsByRandom();
                  return ['success'=>1,'id'=>$model->edificio_id];
            }
        }else{
           return $this->renderAjax('_modal_movbanco', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        } 
}  
    
}
