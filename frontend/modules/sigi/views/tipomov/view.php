<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiTipomov */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Tipos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sigi-tipomov-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('sigi.labels', 'Editar'), ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
     
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'descripcion',
        ],
    ]) ?>

</div>
