<?php include "compose.php" ?>

<div style="height: 100vh; padding: 16px; background: linear-gradient(to left, #606c88, #3f4c6b)">

    <div class="lbr-background-default" style="width: 90%; height: 100%; margin: 0 auto; border-radius: 8px 8px 0px 8px; display: flex; flex-direction: column;">
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
        <div style="display: flex; height: 100%; flex-grow: 1;">
            <div style="min-width: 250px; height: 100%; display: flex; flex-direction: column; box-shadow: 10px 0 5px -2px aliceblue; z-index: 1;">
                <div class="lbr-border-right" style="padding: 24px;">
                    <button class="lbr-button" onclick="document.getElementById('composeModal').hidden = false;" style="width: 100%;">New Message</button>
                </div>
                <div class="lbr-tab-vertical-dashed">
                    <button class=" active" style="width: 100%; text-align: left"><i class="fas fa-inbox lbr-margin-small-right"></i>Inbox</button>
                    <button style="width: 100%; text-align: left"><i class="fas fa-paper-plane lbr-margin-small-right"></i>Sent</button>
                    <button style="width: 100%; text-align: left"><i class="fas fa-pencil-alt lbr-margin-small-right"></i>Drafts</button>
                </div>

                <div class="lbr-border-right"style=" flex-grow: 1">
                
                </div>
                <div class="lbr-border-right lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta">
                    <a><i class="fas fa-life-ring lbr-margin-small-right"></i>Support</a>
                </div>
            </div>
            <div style="min-width: 400px; height: 100%; display: flex; flex-direction: column;-1">
                <a class="lbr-border-right lbr-border-bottom" style=" background-color: #f1f1f1; padding: 24px;">
                <div class="lbr-text-lead">Hey</div>
                        <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                            <div>Harold Finch</div>
                            <div>20/21/3421</div>
                        </div>
                </a>
                <a class="lbr-border-bottom" style="padding: 24px;">
                        <div class="lbr-text-lead">Hey</div>
                        <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                            <div>Harold Finch</div>
                            <div>20/21/3421</div>
                        </div>
                </a>
                <a class="lbr-border-right lbr-border-bottom" style=" background-color: #f1f1f1; padding: 24px;">
                <div class="lbr-text-lead">Hey</div>
                        <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                            <div>Harold Finch</div>
                            <div>20/21/3421</div>
                        </div>
                </a>
                <a class="lbr-border-right lbr-border-bottom" style=" background-color: #f1f1f1; padding: 24px;">
                <div class="lbr-text-lead">Hey</div>
                        <div class="lbr-text-meta lbr-flex lbr-flex-space-between">
                            <div>Harold Finch</div>
                            <div>20/21/3421</div>
                        </div>
                </a>
                <div class="lbr-border-right" style="flex-grow: 1; background-color: #f1f1f1; ">
                </div>
            </div>
            <div style="flex-grow: 1; padding: 24px; scrollbar-width: thin; overflow-y: auto">
                <div class="lbr-border-bottom lbr-padding-small-bottom lbr-flex lbr-flex-space-between">
                    <div>
                        <div class="lbr-text-lead">Hey</div>
                        <div class="lbr-text-meta">Harold Finch - 20/21/3421</div>
                    </div>
                    <div class="lbr-flex lbr-flex-middle"><i class="fas fa-reply"></i><i class="lbr-margin-left fas fa-trash"></i></div>
                </div>
                <p>Donec eget hendrerit quam. Cras fringilla quis urna tristique pretium. Duis velit elit, pulvinar quis consequat id, ultrices id metus. Vestibulum id orci semper ligula congue malesuada. Nullam lorem risus, euismod sit amet nisi a, euismod suscipit felis. Nunc in iaculis tortor. Sed magna justo, auctor vel viverra vel, gravida a metus. Nullam lacinia elementum est, at facilisis elit ornare in. Nam et velit sit amet purus bibendum malesuada auctor in ex. Nam rutrum nibh placerat urna tincidunt imperdiet scelerisque sit amet diam. Phasellus quis tortor vulputate, tincidunt enim ut, vulputate nisi. Aliquam erat volutpat. Vivamus efficitur luctus vulputate. Nullam sit amet nulla rutrum, iaculis dolor ut, sodales tortor. Phasellus nisl sapien, mattis et mollis at, luctus sed arcu. </p>

            </div>
        </div>
    </div>
</div>
<ul> 
    <?php foreach($context["users"] as $user): ?>
        <li><?= $user["username"] ?></li> 
    <?php endforeach ?> 
    </ul>
