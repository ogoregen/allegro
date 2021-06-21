
<?php if($context["deleteMessage"]): ?>
	<div class="lbr-modal" id="confirmationModal">
		<ul class="lbr-container lbr-margin-auto-horizontal lbr-flex lbr-flex-vertical lb lbr-padding-0 lbr-margin-0-vertical lbr-padding-horizontal" style="list-style-type: none;">
			<li class="lbr-text-right lbr-padding-small lbr-background-default lbr-border-radius-bottom lbr-border">
				<a onclick="hide('#confirmationModal');">Dismiss</a>
			</li>
				<li class="lbr-border-radius lbr-border lbr-background-default lbr-padding lbr-margin-small"><p>Are you sure?</p>
					<form action="deletemessage" method="POST"><input name="messageID" value="<?= $context["messageToDelete"] ?>" hidden><button type="submit" class="lbr-button lbr-button-primary">Yes</button></form>
					<button onclick="hide('#confirmationModal');" class="lbr-button lbr-button-default">No</button>
				</li>
		</ul>
	</div>
	<script src="static/js/util.js"></script>
<?php endif ?>
