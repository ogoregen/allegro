<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

include "components/notificationmodal.php";

includeTemplate("composemodal.php", [
    "hidden" => !$context["compose"],
    "autofill" => $context["autofill"],
]);

includeTemplate("deleteconfirmationmodal.php", [
    "deleteMessage" => $context["deleteMessage"],
    "messageToDelete" => $context["messageToDelete"],
    "deletePermanently" => $context["deletePermanently"]
]);

?>

<div class="lbr-flex lbr-flex-vertical lbr-height-viewport lbr-padding lbr-background-shapes-gradient">
    <div class="lbr-border-radius lbr-container-large lbr-background-default" style="height: calc(100vh - 48px);">
        <?php includeTemplate("nav_app.php", ["current" => "dashboard"]) ?>
        <div class="lbr-flex" style="height: calc(100% - 62px);">
            <div style="min-width: 250px; max-width: 250px;display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue;">
                <div class="lbr-border-right" style="padding: 24px;">
                    <button class="lbr-button lbr-button-primary" onclick="document.getElementById('composeModal').hidden = false;" style="width: 100%;">New Message</button>
                </div>
                <div class="lbr-border-right" style="padding: 24px; padding-top: 0;">
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
                <div class="lbr-tab-vertical-dashed">
                    <a href="/dashboard?tab=inbox" class="<?= ($context["tab"] ?? "inbox") == "inbox" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-inbox lbr-margin-small-right"></i>Inbox</a>
                    <a href="/dashboard?tab=sent" class="<?= ($context["tab"] ?? "inbox") == "sent" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-paper-plane lbr-margin-small-right"></i>Sent</a>
                    <a href="/dashboard?tab=drafts" class="<?= ($context["tab"] ?? "inbox") == "drafts" ? "active" : "" ?>" style="width: 100%; text-align: left"><i class="fas fa-pencil-alt lbr-margin-small-right"></i>Drafts</a>
                </div>
                <div class="lbr-border-right" style=" flex-grow: 1">
                </div>
                <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                    <a href="support" class="lbr-link-text"><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
                </div>
            </div>
            <div class="lbr-border-right" style="min-width: 400px; max-width: 400px; max-height: 100%; overflow: auto; scrollbar-width: thin;">
                <?php if ($context["allegroMessages"]) : ?>
                    <?php foreach ($context["allegroMessages"] as $message) : ?>
                        <a href="?tab=<?php echo $context["tab"] . "&message=" . $message->id ?>" class="lbr-message-nav <?php if (($context["selectedMessage"]->id ?? -1) == $message->id) echo "lbr-message-nav-active" ?>">
                            <div class="lbr-margin-small" style="text-overflow: ellipsis; white-space: nowrap;
                                overflow: hidden;"><?= $message->subject ?>
                            </div>
                            <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                                <div>
                                    <?php if ($context["tab"] == "inbox") : ?>
                                        <?= $message->author->fullName() ?>
                                    <?php elseif ($context["tab"] == "sent") : ?>
                                        <?= $message->recipient->fullName() ?>
                                    <?php endif ?>
                                </div>
                                <div><?= date("d/m/y, H:i", strtotime($message->createdOn)) ?></div>
                            </div>
                        </a>
                    <?php endforeach ?>
                <?php else: ?>
                    <div class="lbr-height-full lbr-flex lbr-flex-middle lbr-width-full">
                        <div class="lbr-text-center lbr-width-full">No messages here, yet.</div>
                    </div>
                <?php endif ?>
            </div>
            <div style="flex-grow: 1; padding: 24px; scrollbar-width: thin; overflow-y: auto;">
                <?php if ($context["selectedMessage"]): ?>
                    <div class="lbr-border-bottom lbr-padding-small-bottom lbr-flex lbr-flex-space-between">
                        <div>
                            <div class="lbr-margin-0-top lbr-margin-small" style="font-size: 1.9rem;"><?= $context["selectedMessage"]->subject ?></div>
                            <div class="lbr-text-meta">
                                <?php if ($context["tab"] == "inbox"): ?>
                                    From <a href="classmates?id=<?= $context["selectedMessage"]->author->id ?>"><?= $context["selectedMessage"]->author->fullName() ?></a> -
                                <?php elseif ($context["tab"] == "sent"): ?>
                                    To <a href="classmates?id=<?= $context["selectedMessage"]->recipient->id ?>"><?= $context["selectedMessage"]->recipient->fullName() ?></a> -
                                <?php endif ?>

                                <?= date("d/m/y, H:i", strtotime($context["selectedMessage"]->createdOn)) ?>
                            </div>
                        </div>
                        <div class="lbr-flex lbr-margin-small " style="align-items: flex-end">
                            <?php if ($context["tab"] == "inbox"): ?>
                                <a href="?tab=inbox&compose&message=<?= $context["selectedMessage"]->id ?>" class="fas lbr-link-icon fa-reply"></a>
                            <?php endif ?>
                            <?php if ($context["selectedMessage"]->status == 'D'): ?>
                                <a href="?tab=drafts&compose&message=<?= $context["selectedMessage"]->id ?>" class="fas lbr-link-icon fa-pencil-alt"></a>
                            <?php endif ?>
                            <a href="?tab=<?= $context['tab'] ?>&message=<?= $context['selectedMessage']->id ?>&delete" class="lbr-margin-left lbr-link-icon fas fa-trash"></a>
                        </div>
                    </div>
                    <div>
                        <?= $context["selectedMessage"]->body ?>
                    </div>
                <?php else: ?>
                    <div class="lbr-height-full lbr-flex lbr-flex-middle lbr-width-full">
                        <div class="lbr-text-center lbr-width-full">Select message to display.</div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>