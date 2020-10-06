<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiPorpagar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Sigi Porpagars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sigi-porpagar-view">

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
            'codocu',
            'edificio_id',
            'unidad_id',
            'monto',
            'igv',
            'codpresup',
            'monto_usd',
            'glosa',
            'fechadoc',
            'codestado',
            'detalle:ntext',
        ],
    ]) ?>

</div>
