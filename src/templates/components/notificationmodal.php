<?php if($context["messages"]): ?>
	<div class="lbr-modal" id="notificationModal">
		<ul class="lbr-container lbr-margin-auto-horizontal lbr-flex lbr-flex-vertical lbr-padding-0 lbr-margin-0-vertical lbr-padding-horizontal" style="list-style-type: none;">
			<li class="lbr-text-right lbr-padding-small lbr-background-default lbr-border-radius-bottom lbr-margin-small" style="background-color: aliceblue; ">
				<a onclick="hide('#notificationModal');">Dismiss</a>
			</li>
			<?php foreach($context["messages"] as $message): ?>
				<li class="lbr-border-radius lbr-background-default lbr-padding lbr-margin-small <?= $message["level"] ?>">
					<?= $message["body"] ?>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
	<script src="static/js/util.js"></script>
<?php endif ?>