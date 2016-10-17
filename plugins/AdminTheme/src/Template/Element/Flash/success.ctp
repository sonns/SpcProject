<!--<div class="message error" onclick="this.classList.add('hidden');">--><?//= h($message) ?><!--</div>-->
<?php $this->Html->scriptStart(['block' => true]);?>
$.notify({
title: 'Success',
text: '<?= h($message) ?>',
image: "<i class='fa fa-check'></i>"
}, {
style: 'metro',
className: 'success',
globalPosition:'top center',
showAnimation: "show",
showDuration: 0,
hideDuration: 0,
autoHideDelay: 3000,
autoHide: true,
clickToHide: true
});
<?php $this->Html->scriptEnd(); ?>

