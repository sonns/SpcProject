<!--<div class="message error" onclick="this.classList.add('hidden');">--><?//= h($message) ?><!--</div>-->

<?php $this->Html->scriptStart(['block' => true]);?>
$.notify({
title: 'Error',
text: '<?= h($message) ?>',
image: "<i class='fa fa-exclamation'></i>"
}, {
style: 'metro',
className: 'error',
globalPosition:'top center',
showAnimation: "show",
showDuration: 0,
hideDuration: 0,
autoHide: false,
clickToHide: true
});
<?php $this->Html->scriptEnd(); ?>
