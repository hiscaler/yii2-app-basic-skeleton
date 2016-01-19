<?php
$formatter = Yii::$app->getFormatter();
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-text-width"></i>
                    <h3 class="box-title">用户资料</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>帐号</dt>
                        <dd><?= $model->username ?></dd>
                        <dt>昵称</dt>
                        <dd><?= $model->nickname ?></dd>
                        <dt>注册日期</dt>
                        <dd><?= $formatter->asDatetime($model->created_at) ?></dd>
                        <dt>最后登陆时间</dt>
                        <dd><?= $formatter->asDatetime($model->last_login_time) ?></dd>
                        <dt>最后登陆 IP</dt>
                        <dd><?= $model->last_login_ip ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>