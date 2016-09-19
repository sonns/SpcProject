<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $this->fetch('title'); ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('AdminTheme./assets/libs/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/animate-css/animate.min.css') ?>
    <?= $this->Html->css('AdminTheme./assets/libs/nifty-modal/css/component.css') ?>
    <!-- Extra CSS Libraries Start -->
    <?= $this->Html->css('AdminTheme./assets/css/style.css') ?>

    <!-- Extra CSS Libraries End -->
    <?= $this->Html->css('AdminTheme./assets/css/style-responsive.css') ?>

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
</head>
<body class="fixed-left full-content">
<!-- Begin page -->
<div class="container">
    <div class="animated flipInX" style="width: 100%;margin: 5% auto;text-align: center;">
        <?= $this->Flash->render() ?>

        <?= $this->fetch('content') ?>

        <a class="btn btn-primary btn-sm" href="javascript:history.back()"><i class="fa fa-angle-left"></i> Back to Dashboard</a>
    </div>
</div>
<!-- End of page -->
<?php echo $this->fetch('scriptBlock'); ?>
</body>
</html>