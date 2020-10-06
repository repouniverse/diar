<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiMovimientosPre */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Sigi Movimientos Pres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sigi-movimientos-pre-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('sigi.labels', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('sigi.labels', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('sigi.labels', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idop',
            'edificio_id',
            'cuenta_id',
            'fechaop',
            'fechacre',
            'tipomov',
            'glosa',
            'monto',
            'igv',
            'monto_usd',
            'user_id',
            'activo',
        ],
    ]) ?>

</div>
