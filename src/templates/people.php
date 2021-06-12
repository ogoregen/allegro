<?php
include "components/composemodal.php";
include "components/notificationmodal.php";
?>
<div style="height: 100vh; padding: 16px; background: linear-gradient(to left, #606c88, #3f4c6b)">

    <div class="lbr-background-default" style="width: 90%; height: 100%; margin: 0 auto; border-radius: 8px 8px 0px 8px; display: flex; flex-direction: column;">
        <div style="display: flex; background-color: aliceblue; border-radius: 8px 8px 0 0;">
            <a class="lbr-border-bottom lbr-text-logo" style="padding: 8px 24px;">Allegro</a>
            <div class="lbr-border-bottom lbr-flex-expand">
            </div>
            <div class="lbr-menu lbr-flex">
                <button ><i class="fas fa-envelope-open-text lbr-margin-small-right"></i><a href="/dashboard">Messages</a></button>
                <button class="active"><i class="fas fa-users lbr-margin-small-right"></i>People</button>
                <button><i class="fas fa-cog lbr-margin-small-right"></i>Settings</button>
            </div>
        </div>
        <div style="display: flex; height: 100%; flex-grow: 1;">
            <div style="min-width: 250px; height: 100%; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue; z-index: 1;">
                <div class="lbr-border-right" style="padding: 24px;">
                    <button class="lbr-button lbr-button-primary" onclick="document.getElementById('composeModal').hidden = false;" style="width: 100%;">New Message</button>
                </div>
                <div class="lbr-tab-vertical-dashed">
                    <button style="width: 100%; text-align: left"><i class="fas fa-inbox lbr-margin-small-right"></i><a href="/dashboard">Inbox</a></button>
                    <button style="width: 100%; text-align: left"><i class="fas fa-paper-plane lbr-margin-small-right"></i><a href="/sent">Sent</a></button>
                    <button class="active" style="width: 100%; text-align: left"><i class="fas fa-pencil-alt lbr-margin-small-right"></i>Drafts</button>
                </div>

                <div class="lbr-border-right"style=" flex-grow: 1">
                
                </div>
                <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                    <a><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
                </div>
            </div>
        </div>
    </div>
</div>