<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ContactPerson;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            ['attribute' => 'default_contact_person',
                    'header' => 'Contact Person',
                    'value' => function ($data) {
                            if(!empty($data->default_contact_person))
                            return ContactPerson::findOne(
                                  ['id'=>$data->default_contact_person])->name;
                            }
            ],
            //'default_contact_person',
        ],
    ]) ?>

    <?php if(!empty($contact)):?>
        <h1><?php echo Yii::t("app","Contact detail"); ?></h1>

            <?= DetailView::widget([
                'model' => $contact,
                'attributes' => [
                    'id',
                    'name',
                ],
            ]) ?>
        <?php if(!empty($address)):?>
            <?= DetailView::widget([
                'model' => $address,
                'attributes' => [
                    'city',
                    'state',
                    'country',
                    'phone',
                    'zip',
                ],
            ]) ?>
        <?php endif;?>
      <?php endif;?>

    <p>
        <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
