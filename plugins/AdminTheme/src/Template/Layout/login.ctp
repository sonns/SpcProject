<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'SPC';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($theme['title']) ? $theme['title'] : 'SPCProject'; ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/fontello/css/fontello.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/animate-css/animate.min.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/nifty-modal/css/component.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/magnific-popup/magnific-popup.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/ios7-switch/ios7-switch.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/pace/pace.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/sortable/sortable-theme-bootstrap.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/bootstrap-datepicker/css/datepicker.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/jquery-icheck/skins/all.css') ?>
    <!-- Code Highlighter for Demo -->
    <?= $this->Html->css('AdminTheme./assets/libs/jquery-icheck/skins/all.css') ?>
    <!-- Extra CSS Libraries Start -->
    <?= $this->Html->css('AdminTheme./assets/css/style.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/jquery-notifyjs/styles/metro/notify-metro.css') ?>
    <!-- Extra CSS Libraries End -->
    <?= $this->Html->css('AdminTheme./assets/css/style-responsive.css') ?>
    <?php echo $this->fetch('cssBlock'); ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

  <link rel="shortcut icon" href="assets/img/favicon.ico">
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
  <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png" />

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
<?= $this->Flash->render() ?>

    <!-- Modal Start -->
    <!-- Modal Task Progress -->
        <?php
        echo $this->element('task_progress');
        ?>
    <!-- Modal Logout -->
        <?php
        $this->element('logout');
        ?>
    <!-- Modal End -->
    <!-- Begin page -->
    <div class="container">
        <?php echo $this->fetch('content'); ?>
    </div>

    <!-- End of page -->
    <!-- the overlay modal element -->
    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->

    <script>
    		var resizefunc = [];
    </script>
    <?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/bootstrap/js/bootstrap.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-detectmobile/detect.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-animate-numbers/jquery.animateNumbers.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/ios7-switch/ios7.switch.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/fastclick/fastclick.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-blockui/jquery.blockUI.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/bootstrap-bootbox/bootbox.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-slimscroll/jquery.slimscroll.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-sparkline/jquery-sparkline.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/nifty-modal/js/classie.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/nifty-modal/js/modalEffects.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/sortable/sortable.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/bootstrap-fileinput/bootstrap.file-input.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/bootstrap-select/bootstrap-select.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/bootstrap-select2/select2.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/magnific-popup/jquery.magnific-popup.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/pace/pace.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-icheck/icheck.min.js') ?>

    <!-- Demo Specific JS Libraries -->
    <?= $this->Html->script('AdminTheme./assets/libs/prettify/prettify.js') ?>

    <?= $this->Html->script('AdminTheme./assets/js/init.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-notifyjs/notify.min.js') ?>

    <?= $this->Html->script('AdminTheme./assets/libs/jquery-notifyjs/styles/metro/notify-metro.js') ?>

    <?= $this->fetch('script') ?>
</body>
</html>
