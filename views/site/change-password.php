<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->params['breadcrumbs'][] = Yii::t('app', 'Change Password');
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-text-width"></i>
                    <h3 class="box-title">修改登录密码</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=
                    $this->render('_changePasswordForm', [
                        'user' => $user,
                        'model' => $model,
                    ]);
                    ?>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
