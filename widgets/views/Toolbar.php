<?php

use yii\helpers\Html;

if ($items):
    ?>
    <section class="content-toolbar">
        <div class="btn-group">
            <?php
            foreach ($items as $item) {
                if (!isset($item['htmlOptions']['class'])) {
                    $item['htmlOptions']['class'] = 'btn btn-default';
                } else {
                    $item['htmlOptions']['class'] .= ' btn btn-default';
                }
                if (!isset($item['url']) || $item['url'] == '#') {
                    $item['url'] = 'javascript:;';
                }
                echo Html::a($item['label'], $item['url'], isset($item['htmlOptions']) ? $item['htmlOptions'] : []);
            }
            ?>
        </div>
    </section>
<?php endif; ?>
