<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\ContactPerson;
use app\models\Address;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'description',
            ['attribute' => 'default_contact_person',
                    'header' => 'Default Contact Person',
                    'value' => function ($data) {
                      if(!empty($data->default_contact_person))
                      {
                        $person = ContactPerson::findOne(
                              ['id'=>$data->default_contact_person]);
                        if(!empty($person->address_id) ){
                          $addr = Address::findOne(
                                ['id'=>$person->address_id]);
                                return $person->name.': '.$addr->phone.','.
                                $addr->city.','.$addr->country.','.
                                                                    $addr->zip;
                        }
                        else{
                          return $person->name;
                        }
                    }

                            }
            ],
            //'default_contact_person',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<p>
    <?= Html::a(Yii::t('app', 'Create New Company'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
