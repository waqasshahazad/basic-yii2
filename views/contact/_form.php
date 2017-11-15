<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if(!empty($address) ): ?>
    <?= $form->field($model, 'address_id')
        ->dropDownList(
            $address,           // Flat array ('id'=>'label')
            ['prompt'=>'Please Select Address']    // options
        ); ?>
    <?php endif;?>

    <?php if(!empty($company) ): ?>
    <?= $form->field($model, 'company_id')
        ->dropDownList(
            $company,           // Flat array ('id'=>'label')
            ['prompt'=>'Please Select Company']    // options
        ); ?>
    <?php endif;?>

    <?= $form->field($model, 'is_default')->dropDownList([0 => 'No' , 1 => 'Yes']); ?>

      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
