<?php

namespace app\widgets;

use Yii;

/**
 * 控制面板
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class ControlPanel extends \yii\base\Widget
{

    public function run()
    {
        $controller = $this->view->context;

        return $this->render('ControlPanel', [
                'identity' => Yii::$app->getUser()->getIdentity(),
                'controllerId' => $controller->id,
                'actionId' => $controller->action->id,
        ]);
    }

}
