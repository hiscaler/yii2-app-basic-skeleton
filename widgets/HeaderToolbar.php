<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

/**
 * 订单提醒
 * 
 * @author hiscaler <hiscaler@gmail.com>
 */
class HeaderToolbar extends Widget
{

    public function getOrders()
    {
        return [];
    }

    public function run()
    {
        $orders = $this->getOrders();
        $ordersCount = count($orders);

        return $this->render('HeaderToolbar', [
                'orders' => $this->getOrders(),
                'ordersCount' => $ordersCount,
        ]);
    }

}
