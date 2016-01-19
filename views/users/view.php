<?php

use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title = '用户管理';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;

$this->params['menus'] = [
    ['label' => Yii::t('app', 'List'), 'url' => ['index']],
    ['label' => Yii::t('app', 'Create'), 'url' => ['create']],
    ['label' => Yii::t('app', 'Update'), 'url' => ['update', 'id' => $model->id]],
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?= Yii::t('user', 'Base Informations') ?></a></li>
                        <li><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?= Yii::t('app', 'Login Logs') ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'type:userType',
                                    'username',
                                    'nickname',
                                    'email:email',
                                    'role:userRole',
                                    'status:userStatus',
                                    'register_ip',
                                    'login_count',
                                    'last_login_ip',
                                    'last_login_time:datetime',
                                    [
                                        'attribute' => 'created_by',
                                        'value' => $model['creater']['nickname']
                                    ],
                                    'created_at:datetime',
                                    [
                                        'attribute' => 'updated_by',
                                        'value' => $model['updater']['nickname']
                                    ],
                                    'updated_at:datetime',
                                    [
                                        'attribute' => 'deleted_by',
                                        'value' => $model['deleter']['nickname']
                                    ],
                                    'deleted_at:datetime',
                                ],
                            ])
                            ?>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <?php
                            Pjax::begin();
                            echo GridView::widget([
                                'dataProvider' => $loginLogsDataProvider,
                                'columns' => [
                                    [
                                        'class' => 'yii\grid\SerialColumn',
                                        'contentOptions' => ['class' => 'serial-number']
                                    ],
                                    [
                                        'attribute' => 'login_at',
                                        'format' => 'datetime',
                                        'contentOptions' => ['class' => 'datetime'],
                                    ],
                                    [
                                        'attribute' => 'login_ip',
                                        'contentOptions' => ['class' => 'ip-address'],
                                    ],
                                    [
                                        'attribute' => 'client_informations',
                                        'headerOptions' => ['class' => 'last']
                                    ],
                                ],
                            ]);
                            Pjax::end();
                            ?>
                        </div>
                    </div><!-- /.tab-content -->
                </div>

            </div>
        </div>
    </div>
</div>