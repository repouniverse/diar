<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiPropietarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Sigi Propietarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sigi-propietarios-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('base.labels', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base.labels', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base.labels', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'unidad_id',
            'tipo',
            'codepa',
            'correo',
            'edificio_id',
            'correo1',
            'correo2',
            'celulares',
            'fijo',
            'dni',
            'user_id',
            'nombre',
            'espropietario',
            'participacion',
            'detalle:ntext',
            'recibemail:email',
            'activo',
            'finicio',
            'fcese',
        ],
    ]) ?>

</div>
