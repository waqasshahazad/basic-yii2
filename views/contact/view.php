<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContactPerson */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            //'address_id',
            //'company_id',
            ['attribute' => 'is_default',
                    'header' => 'Default',
                    'value' => function ($data) {
                              if($data->is_default){
                                return "Yes";
                              }
                              else{
                                return "No";
                              }
                            }
            ],
            //'is_default',
        ],
    ]) ?>
<?php if(!empty($address)): ?>
  <h1><?php echo Yii::t("app","Address"); ?></h1>
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

<?php if(!empty($company)): ?>
  <h1><?php echo Yii::t("app","Company Name"); ?></h1>
      <?= DetailView::widget([
          'model' => $company,
          'attributes' => [
            'name',
            'description',
          ],
      ]) ?>
<?php endif;?>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
