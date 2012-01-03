<?php echo $this->element('head', compact('title_for_layout')) ?>
<body id="<?php echo $this->name ?>" class="<?php echo $this->action ?>">
    <?php echo $this->element('header') ?>

    <div id="main-container">
        <div id="main" class="wrapper clearfix">
            <?php echo $this->Session->flash(); ?>
            <article>
                <header>
                    <h1><?php echo $title_for_layout ?></h1>
                    <?php echo $content_for_layout; ?>
            </article>

            <?php echo $this->element('side'); ?>
        </div>
    </div>

    <?php echo $this->element('footer') ?>
    <?php echo $this->element('scripts', compact('scripts_for_layout')) ?>
</body>
</html>
