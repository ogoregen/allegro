
<div class="lbr-modal" id="composeModal" style="padding: 24px;" hidden>
    <div class="lbr-container lbr-height-full lbr-margin-auto-horizontal lbr-flex lbr-flex-vertical lbr-border-radius lbr-background-default">
        <div class="lbr-flex lbr-flex-space-between lbr-padding-small lbr-flex-middle lbr-border-bottom">
            <span style="padding-left: 12px">Compose a message</span>
            <a onclick="document.getElementById('composeModal').hidden = true;" class="fas fa-times" style="padding-right: 12px"></a>
        </div>
        <form class="lbr-flex-expand lbr-flex lbr-flex-vertical" action="" method="POST">
            <div class="lbr-padding">
                <div class="lbr-flex lbr-margin lbr-width-full lbr-margin-bottom">
                    <label class="lbr-label-inline" for="to">To</label>
                    <input name="to" class="lbr-input lbr-flex-expand" placeholder="Email address or username, separate multiple with spaces" id="to" required>
                </div>
                <div class="lbr-flex lbr-margin lbr-width-full">
                    <label for="subject" class="lbr-label-inline">Subject</label>
                    <input name="subject" class="lbr-input lbr-flex-expand" id="subject" required>
                </div>
            </div>
            <div class="lbr-flex">
                <div class="lbr-tab lbr-flex" id="tabNav">
                    <button class="active" onclick="tabInput(this);" type="button"><i class="fas fa-pencil-alt lbr-margin-small-right"></i>Compose</button>
                    <button onclick="tabInput(this); generatePreview();" type="button"><i class="fas fa-eye lbr-margin-small-right"></i>Preview</button>
                </div>
                <div class="lbr-border-bottom lbr-flex-expand">
                </div>
                <span class="lbr-tab lbr-flex">
                    <button type="button"><i class="fas fa-save lbr-margin-small-right"></i>Save as draft</button>
                    <button type="submit"><i class="fas fa-paper-plane lbr-margin-small-right"></i>Send</button>
                </span>
            </div>
            <div class="lbr-height-full" id="tabs">
                <textarea name="message" class="lbr-textarea-minimal" id="input" required></textarea>
                <div class="lbr-padding-horizontal" id="preview" hidden>
                </div>
                
            </div>
        </form>

    <div class="lbr-border-top lbr-padding-small lbr-padding-horizontal lbr-text-meta lbr-text-right">
        <a href="https://guides.github.com/features/mastering-markdown/" target="_blank"><i class="fab fa-markdown lbr-margin-small-right"></i>Markdown help</a>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
var buttons = document.getElementById("tabNav").children;
var tabs = document.getElementById("tabs").children;
var preview = document.getElementById("preview");
var input = document.getElementById("input");


function tabInput(selected){

    for(let i = 0; i < buttons.length; i++){

        buttons[i].classList.remove("active");
        tabs[i].hidden = true;
        if(buttons[i] == selected){

            tabs[i].hidden = false;
            buttons[i].classList.add("active");
        }
    }
}

function generatePreview(){

    preview.innerHTML = marked(input.value);
}
</script>