<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12 template-index">

        <div class="box">
            <?php $form = ActiveForm::begin(); ?>

            <div class="box-body">

                <?= $form->field($user, 'username')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true]) ?>

            </div>

            <div class="box-footer">
                <?= Html::submitButton(Yii::t('app', 'Change Password'), ['class' => 'btn btn-info pull-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>