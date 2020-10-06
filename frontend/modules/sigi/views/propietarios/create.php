<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiPropietarios */

$this->title = Yii::t('base.labels', 'Create Sigi Propietarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Sigi Propietarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sigi-propietarios-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>