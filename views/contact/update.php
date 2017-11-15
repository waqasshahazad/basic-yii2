<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContactPerson */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contact Person',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contact-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company' => $company,
        'address' => $address,
    ]) ?>

</div>
