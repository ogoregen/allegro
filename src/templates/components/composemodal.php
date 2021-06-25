<div class="lbr-modal lbr-height-viewport lbr-modal-back-blurred" id="composeModal" style="padding: 24px;" <?= $context["hidden"] ? "hidden" : "" ?>>
    <div class="lbr-container lbr-height-full lbr-margin-auto-horizontal lbr-border lbr-flex lbr-flex-vertical lbr-border-radius lbr-background-default">
        <div class="lbr-flex lbr-flex-space-between lbr-padding-small lbr-flex-middle lbr-border-bottom">
            <span style="padding-left: 12px">Compose a message</span>
            <a onclick="document.getElementById('composeModal').hidden = true;" class="lbr-link-icon fas fa-times" style="padding-right: 12px"></a>
        </div>
        <form class="lbr-flex-expand lbr-flex lbr-flex-vertical" action="/sendmessage" method="POST">
            <input value="<?= $context["autofill"]["id"] ?? "" ?>" name="id" hidden>
            <div class="lbr-padding">
                <div class="lbr-flex lbr-margin lbr-width-full lbr-margin-bottom">
                    <label class="lbr-label-inline" for="to">To</label>
                    <input name="to" class="lbr-input lbr-flex-expand" placeholder="Email address or username" id="to" value="<?= $context["autofill"]["to"] ?? "" ?>">
                </div>
                <div class="lbr-flex lbr-margin lbr-width-full">
                    <label for="subject" class="lbr-label-inline">Subject</label>
                    <input name="subject" class="lbr-input lbr-flex-expand" id="subject" value="<?= $context["autofill"]["subject"] ?? "" ?>" required>
                </div>
                <label class="lbr-text-meta"><input type="checkbox" name="isSilent" value="true"> Send this message silently.</label>
            </div>
            <div class="lbr-flex">
                <div class="lbr-tab lbr-flex" id="tabNav">
                    <button class="active lbr-no-hover" type="button"><i class="fas fa-pencil-alt lbr-margin-small-right lbr-no-hover"></i>Compose</button>
                </div>
                <div class="lbr-border-bottom lbr-flex-expand">
                </div>
                <span class="lbr-tab lbr-flex">
                    <button name="button" value="draft" type="submit"><i class="fas fa-save lbr-margin-small-right"></i>Save as draft</button>
                    <button name="button" value="send" type="submit"><i class="fas fa-paper-plane lbr-margin-small-right"></i>Send</button>
                </span>
            </div>
            <div class="lbr-height-full">
                <textarea name="body" class="lbr-textarea-minimal" id="input" required><?= $context["autofill"]["body"] ?? "" ?></textarea>
            </div>
        </form>
        <div class="lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta lbr-text-right">
            <a class="lbr-link-text" href="https://guides.github.com/features/mastering-markdown/" target="_blank"><i class="fab fa-markdown lbr-margin-small-right"></i>Markdown help</a>
        </div>
    </div>
</div>