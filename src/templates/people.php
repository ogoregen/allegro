<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

include "components/notificationmodal.php";

?>

<div class="lbr-flex lbr-flex-vertical lbr-height-viewport" style="border-radius: 8px 8px 0px 8px;">
    
    <?php includeTemplate("nav_app.php", ["current" => "people"]) ?>

    <div class="lbr-flex lbr-flex-expand" style="max-height: calc(100% - 52px);">
        <div style="min-width: 250px; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue;">
            <div class="lbr-border-right" style="padding: 24px;">
            </div>

            <div class="lbr-border-right" style=" flex-grow: 1">
            
            </div>
            <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                <a><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
            </div>
        </div>
        <div class="lbr-padding">

            <h1>Classmates</h1>

                <?php foreach($context["people"] as $user): ?>
                    <div class="lbr-flex lbr-padding-small lbr-border-radius lbr-border lbr-margin lbr-flex-space-between lbr-flex-middle">
                        <?php if($user->lastActive > time() - 120): ?>
                            <i class="fas fa-book"></i>
                        <?php else: ?>
                            <i class="fas fa-book-open lbr-text-success"></i>
                        <?php endif ?>
                        <div class="lbr-padding-small">
                            <?= $user->fullName() ?>
                        </div>
                        <a class="fas fa-envelope"></a>
                    </div>
                <?php endforeach ?>
        </div>
    </div>
    </div>
    </div>