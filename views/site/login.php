<?php

use app\assets\LoginAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= Yii::$app->name ?> | 登录</title>      
        <?php $this->head() ?>
    </head>

    <body class="gray-bg">
        <?php $this->beginBody() ?>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <h3>欢迎登录后台管理系统</h3>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'm-t']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
                </div>

                <a href="#"><small>忘记密码?</small></a>

                <?php ActiveForm::end(); ?>

                <p class="m-t"> <small><?= Yii::$app->name ?> &copy; <?= date('Y') ?></small> </p>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
