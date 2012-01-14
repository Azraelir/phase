<?php echo $this->element('head'); ?>
<body id="<?php echo $this->name ?>" class="<?php echo $this->action ?>">
    <?php echo $this->element('header') ?>

    <div id="main-container">
        <div id="main" class="wrapper clearfix">
            <?php echo $this->Session->flash(); ?>
            <article>
                <header>
                    <h1><?php echo $this->fetch('title'); ?></h1>
                    <?php echo $this->fetch('content'); ?>
            </article>

            <?php echo $this->element('side'); ?>
        </div>
    </div>

    <?php echo $this->element('footer') ?>
    <?php echo $this->element('scripts') ?>
</body>
</html>
