<?php

use pavlinter\adm\Adm;
use pavlinter\adm\widgets\Menu;

$items = [];

/* @var $adm pavlinter\adm\Adm */
$adm = Adm::getInstance();
foreach ($adm->params['left-menu'] as $name => $item) {
    $items[] = $item;
}
?>


<aside class="aside bg-dark dk" id="nav">
    <section class="vbox">
        <section class="scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px">
                <nav class="nav-primary hidden-xs" data-ride="collapse">
                    <?php
                    echo Menu::widget([
                        'submenuTemplate' => "\n<ul class=\"nav none dker\">\n{items}\n</ul>\n",
                        'linkTemplate' => '<a href="{url}">{label}</a>',
                        'options' => [
                            'class' => 'nav',
                        ],
                        'itemOptions' => [

                        ],
                        'items' => $items,
                    ]);
                    ?>
                </nav>
            </div>
        </section>
    </section>
</aside>