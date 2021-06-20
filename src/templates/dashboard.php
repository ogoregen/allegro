<?php

require_once "../core/template.php";
use function Allegro\Core\template\includeTemplate;

include "components/composemodal.php";
include "components/notificationmodal.php";

?>

<div class="lbr-flex lbr-flex-vertical lbr-height-viewport" style="border-radius: 8px 8px 0px 8px;">
    
    <?php includeTemplate("nav_app.php", ["current" => "dashboard"]) ?>

    <div class="lbr-flex lbr-flex-expand" style="max-height: calc(100% - 62px);">
        <div style="min-width: 250px; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue;">
            <div class="lbr-border-right" style="padding: 24px;">
                <button class="lbr-button lbr-button-primary" onclick="document.getElementById('composeModal').hidden = false;" style="width: 100%;">New Message</button>
            </div>
            <div class="lbr-border-right" style="padding: 24px; padding-top: 0;">
                <div class="lbr-border lbr-border-radius lbr-padding-small lbr-flex lbr-flex-space-between lbr-flex-middle">
                <div>
                    <div><?= $_SESSION["user"]->fullName() ?></div>
                    <div><i class="fas fa-book-open lbr-text-success"></i> Online</div>
                </div>
                    
                    <a href="logout" class="fas fa-sign-out-alt"></a>
                </div>
            </div>
            <div class="lbr-tab-vertical-dashed">
                <a href="/dashboard?tab=inbox" class="<?= ($context["tab"] ?? "inbox") == "inbox" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-inbox lbr-margin-small-right"></i>Inbox</a>
                <a href="/dashboard?tab=sent" class="<?= ($context["tab"] ?? "inbox") == "sent" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-paper-plane lbr-margin-small-right"></i>Sent</a>
                <a href="/dashboard?tab=drafts" class="<?= ($context["tab"] ?? "inbox") == "drafts" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-pencil-alt lbr-margin-small-right"></i>Drafts</a>
            </div>

            <div class="lbr-border-right" style=" flex-grow: 1">
            
            </div>
            <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                <a><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
            </div>
        </div>
        <div class="lbr-border-right" style="min-width: 400px; max-height: 100%; overflow: auto; scrollbar-width: thin;">
            <?php foreach($context["allegroMessages"] as $message): ?>
                <a href="?tab=<?php echo $context["tab"]."&message=".$message->id ?>" class="lbr-message-nav <?php if(($context["selectedMessage"]->id ?? -1) == $message->id) echo "lbr-message-nav-active" ?>">
                    <div class="lbr-text-lead"><?= $message->subject ?></div>
                    <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                        <div><?= $message->author ?></div>
                        <div><?= date($message->createdOn) ?></div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
        <div style="flex-grow: 1; padding: 24px; scrollbar-width: thin; overflow-y: auto">
            <?php if($context["selectedMessage"]): ?>
            <div class="lbr-border-bottom lbr-padding-small-bottom lbr-flex lbr-flex-space-between">

                <div>
                    <div class="lbr-text-lead"><?= $context["selectedMessage"]->subject ?></div>
                    <div class="lbr-text-meta"><?= $context["selectedMessage"]->author ?> - <?= $context["selectedMessage"]->createdOn ?></div>
                </div>
                <div class="lbr-flex lbr-flex-middle"><i class="fas fa-reply"></i><i class="lbr-margin-left fas fa-trash"></i></div>
                </div>
                <?= $context["selectedMessage"]->body ?>

            <?php endif ?>
        </div>
    </div>
    </div>
    </div>

