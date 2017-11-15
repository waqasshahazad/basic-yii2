<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Address;
use app\models\Company;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contact Persons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-person-index">
  <?php if (Yii::$app->session->hasFlash('contactDefaultAddress')): ?>

      <div class="alert alert-danger">
        <?php echo Yii::t("app","Default Address can not be deleted.")?>
      </div>
  <?php endif;?>
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            ['attribute' => 'address_id',
                    'header' => 'Address',
                    'value' => function ($data) {
                            $addr = Address::findOne(['id'=>$data->address_id]);
                              if(!empty($addr))
                              {
                                return $addr->street.','.$addr->city.','.
                                          $addr->state.','.$addr->country;

                              }
                            }
            ],

            //'address_id',
            ['attribute' => 'company_id',
                    'header' => 'Company',
                    'value' => function ($data) {
                      return  Company::findOne(['id'=>$data->company_id])->name;
                            }
            ],
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<p>
    <?= Html::a(Yii::t('app', 'Create Contact Person'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
