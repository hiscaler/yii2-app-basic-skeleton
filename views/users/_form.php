<?php

use app\models\User;
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

                <?= $form->field($model, 'type')->dropDownList(User::typeOptions(), ['prompt' => '']) ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

                <?php if ($model->isNewRecord): ?>
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => 255]) ?>
                <?php endif; ?>

                <?= $form->field($model, 'nickname')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'role')->dropDownList(User::roleOptions(), ['prompt' => '']) ?>

                <?= $form->field($model, 'status')->dropDownList(User::statusOptions(), ['prompt' => '']) ?>

            </div>

            <div class="box-footer">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-info pull-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>