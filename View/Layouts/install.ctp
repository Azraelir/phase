<head>
    <meta charset="utf-8">

    <title><?php echo $this->fetch('title'); ?></title>

    <style>
    <?php echo file_get_contents (APP . 'Skel/webroot/css/style.css'); ?>
    </style>

    <script src="/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body id="<?php echo $this->name ?>" class="<?php echo $this->action ?>">
    <?php echo $this->element('header') ?>

    <div id="main-container">
		<div id="main" class="wrapper clearfix">
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>

    <?php echo $this->element('footer') ?>
    <?php echo $this->element('scripts') ?>
</body>
</html>
