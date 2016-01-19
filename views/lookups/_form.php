<?php

use app\models\Lookup;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lookup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12 template-index">

        <div class="box">
            <?php $form = ActiveForm::begin(); ?>
            <div class="box-body">

                <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'value')->textarea() ?>

                <?= $form->field($model, 'return_type')->dropDownList(Lookup::returnTypeOptions()) ?>

                <?= $form->field($model, 'enabled')->checkbox() ?>

            </div>

            <div class="box-footer">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-info pull-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>