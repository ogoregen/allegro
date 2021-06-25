<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

include "components/notificationmodal.php";

includeTemplate("composemodal.php", ["hidden" => !$context["compose"], "autofill" => ["to" => $context["to"]]]);

?>

<div class="lbr-flex lbr-flex-vertical lbr-height-viewport lbr-padding lbr-background-shapes-gradient">
    <div class="lbr-border-radius lbr-container-large lbr-background-default" style="height: calc(100vh - 24px);">
        <?php includeTemplate("nav_app.php", ["current" => "people"]) ?>
        <div class="lbr-flex" style="height: calc(100% - 62px);">
            <div style="min-width: 250px; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue; height: 100%;">
                <div style="padding: 24px" class="lbr-border-right">
                    <div class="lbr-border lbr-border-radius lbr-padding-small lbr-flex lbr-flex-space-between lbr-flex-middle" style="height: 48px;">
                        <div>
                            <?php if ($_SESSION["user"]->displayOnline): ?>
                                <i class="fas fa-book-open lbr-text-success"></i>
                            <?php else: ?>
                                <i class="fas fa-book"></i>
                            <?php endif ?>
                            <span class="lbr-margin-small-left"><?= $_SESSION["user"]->firstName ?></span>
                        </div>
                        <a href="logout" class="lbr-link-icon fas fa-sign-out-alt"></a>
                    </div>
                </div>
                <div class="lbr-border-right" style=" flex-grow: 1">

                </div>
                <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                    <a href="support" class="lbr-link-text "><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
                </div>
            </div>
            <div class="lbr-border-right lbr-height-full" style="min-width: 400px; overflow: auto; scrollbar-width: thin;">

                <?php foreach ($context["people"] as $user): ?>
                    <a href="?id=<?= $user->id ?>" class="lbr-message-nav <?php if (($context["classmate"]->id ?? -1) == $user->id) echo "lbr-message-nav-active" ?>">
                        <div class="lbr-flex lbr-flex-space-between lbr-flex-middle">
                            <?php if ($user->displayOnline && $user->lastActive > time() - 120) : ?>
                                <i class="fas fa-book-open lbr-text-success"></i>
                            <?php else: ?>
                                <i class="fas fa-book"></i>
                            <?php endif ?>
                            <div class="lbr-padding-small">
                                <?= $user->fullName() ?>
                            </div>
                            <div></div>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
            <div style="flex-grow: 1; padding: 24px; scrollbar-width: thin; overflow-y: auto">
                <?php if ($context["classmate"]) : ?>
                    <div class="lbr-border-bottom lbr-margin lbr-flex lbr-flex-space-between lbr-flex-middle" style="margin-bottom: 24px;">
                        <div style="font-size: 1.9rem;"><?= $context["classmate"]->fullName() ?></div>
                        <a href="?compose&to=<?= $context["classmate"]->username ?>" class="lbr-button lbr-button-default lbr-margin-small">Send Message</a>
                    </div>
                    <div class="lbr-margin"><strong>Username:</strong> <?= $context["classmate"]->username ?></div>
                    <?php if ($context["classmate"]->displayEmail): ?>
                        <div class="lbr-margin"><strong>Email Address:</strong> <?= $context["classmate"]->email ?></div>
                    <?php endif ?>
                <?php else: ?>
                    <div class="lbr-height-full lbr-flex lbr-flex-middle lbr-width-full">
                        <div class="lbr-text-center lbr-width-full">Select classmate to display.</div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>