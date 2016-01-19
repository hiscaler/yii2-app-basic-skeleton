<?php

use app\models\Yad;
use yii\helpers\Url;
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="<?= $identity->username ?>" class="img-circle" src="<?= Yii::$app->getRequest()->getBaseUrl() ?>/images/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="text-muted text-xs block"><?= $identity->username ?> <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">                        
                        <li><a href="<?= Url::toRoute(['site/profile']) ?>">个人资料</a></li>
                        <li><a href="<?= Url::toRoute(['site/change-password']) ?>">修改密码</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    Mai3
                </div>
            </li>
            <li<?= in_array($controllerId, ['lookups']) ? ' class="active"' : '' ?>>
                <a href="javascript:;"><i class="fa fa-tv"></i> <span class="nav-label">系统管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li<?= $controllerId == 'lookups' ? ' class="active"' : '' ?>><a href="<?= Url::toRoute(['lookups/index']) ?>">基本设置</a></li>
                </ul>
            </li>
            <li<?= in_array($controllerId, ['users', 'members']) ? ' class="active"' : '' ?>>
                <a href="javascript:;"><i class="fa fa-user"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li<?= $controllerId == 'users' ? ' class="active"' : '' ?>><a href="<?= Url::toRoute(['users/index']) ?>">系统用户管理</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>