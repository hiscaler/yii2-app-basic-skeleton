<?php

namespace app\widgets;

/**
 * 工具条
 */
class Toolbar extends \yii\base\Widget
{

    public function run()
    {
        return $this->render('Toolbar', [
                'items' => isset($this->view->params['menus']) ? $this->view->params['menus'] : [],
        ]);
    }

}
