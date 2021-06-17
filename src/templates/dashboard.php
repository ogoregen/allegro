<?php
include "components/composemodal.php";
include "components/notificationmodal.php";
?>
<div style="max-height: 100vh; padding: 16px; overflow: hidden; background: linear-gradient(to left, #606c88, #3f4c6b)">
    <div class="lbr-background-default lbr-flex lbr-flex-vertical" style="max-height: 100%; width: 90%; margin: 0 auto; border-radius: 8px 8px 0px 8px;">
       
        <div style="display: flex; background-color: aliceblue; border-radius: 8px 8px 0 0;">
            <a class="lbr-border-bottom lbr-text-logo" style="padding: 8px 24px;">Allegro</a>
            <div class="lbr-border-bottom lbr-flex-expand">
            </div>
            <div class="lbr-menu lbr-flex">
                <button class="active"><i class="fas fa-envelope-open-text lbr-margin-small-right"></i>Messages</button>
                <button><i class="fas fa-users lbr-margin-small-right"></i>People</button>
                <button><i class="fas fa-cog lbr-margin-small-right"></i>Settings</button>
            </div>
        </div>

        <div style="display: flex; max-height: 100%">
            <div style="min-width: 250px; display: flex; max-height: 100%; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue;">
                <div class="lbr-border-right" style="padding: 24px;">
                    <button class="lbr-button lbr-button-primary" onclick="document.getElementById('composeModal').hidden = false;" style="width: 100%;">New Message</button>
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
            <div style="min-width: 400px; max-height: 100%; display: flex; flex-direction: column; overflow: scroll; scrollbar-width: thin;">
                <?php foreach($context["allegroMessages"] as $message): ?>
                    <a href="?tab=<?php echo $context["tab"]."&message=".$message->id ?>" class="lbr-message-nav <?php if(($context["selectedMessage"]->id ?? -1) == $message->id) echo "lbr-message-nav-active" ?>">
                    <div class="lbr-text-lead"><?= $message->subject ?></div>
                    <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                        <div><?= $message->author ?></div>
                        <div><?= date($message->createdOn) ?></div>
                    </div>
                    </a>
                <?php endforeach ?>
                <div class="lbr-border-right" style="flex-grow: 1; background-color: #f1f1f1; ">
                </div>
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
