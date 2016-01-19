<?php

use backend\components\MessageBox;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;

$this->params['menus'] = [
    ['label' => Yii::t('app', 'List'), 'url' => ['index']],
    ['label' => Yii::t('app', 'Create'), 'url' => ['create']],
    ['label' => Yii::t('app', 'Search'), 'url' => '#'],
];
?>

<div class="row">
    <div class="col-md-12 template-index">
        <div class="box">                
            <div class="box-body">

                <?= $this->render('_search', ['model' => $searchModel]) ?>

                <?php
                $session = Yii::$app->getSession();
                if ($session->hasFlash('notice')) {
                    echo MessageBox::widget([
                        'title' => '提示信息',
                        'message' => $session->getFlash('notice'),
                        'showCloseButton' => true
                    ]);
                }

                Pjax::begin([
                    'formSelector' => '#form-user-search',
                ]);
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['class' => 'serial-number']
                        ],
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model['username'], ['update', 'id' => $model['id']]);
                            },
                                'headerOptions' => ['class' => 'username']
                            ],
                            [
                                'attribute' => 'nickname',
                                'headerOptions' => ['class' => 'username']
                            ],
                            'email:email',
                            [
                                'attribute' => 'role',
                                'format' => 'userRole',
                                'headerOptions' => ['class' => 'center'],
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'userStatus',
                                'headerOptions' => ['class' => 'data-status'],
                            ],
                            [
                                'attribute' => 'register_ip',
                                'headerOptions' => ['class' => 'ip-address'],
                            ],
                            [
                                'attribute' => 'login_count',
                                'headerOptions' => ['class' => 'number'],
                            ],
                            [
                                'attribute' => 'last_login_time',
                                'format' => 'datetime',
                                'headerOptions' => ['class' => 'datetime'],
                            ],
                            [
                                'attribute' => 'last_login_ip',
                                'headerOptions' => ['class' => 'ip-address'],
                            ],
                            [
                                'attribute' => 'created_by',
                                'value' => function ($model) {
                                    return $model['creater']['nickname'];
                                },
                                'headerOptions' => ['class' => 'username']
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'date',
                                'headerOptions' => ['class' => 'date']
                            ],
                            [
                                'attribute' => 'updated_by',
                                'value' => function ($model) {
                                    return $model['updater']['nickname'];
                                },
                                'headerOptions' => ['class' => 'username']
                            ],
                            [
                                'attribute' => 'updated_at',
                                'format' => 'date',
                                'headerOptions' => ['class' => 'date']
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {change-password} {auth} {delete}',
                                'buttons' => [
                                    'change-password' => function ($url, $model, $key) {
                                        return Html::a('<span class="glyphicon glyphicon glyphicon-sunglasses"></span>', $url, ['title' => '预览模板']);
                                    },
                                    ],
                                    'headerOptions' => ['class' => 'btns-4'],
                                ],
                            ],
                        ]);
                        Pjax::end();
                        ?>
            </div>
        </div>
    </div>
</div>