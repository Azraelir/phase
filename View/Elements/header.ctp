<div id="header-container">
    <header class="wrapper clearfix">
    <?php if ($this->action === 'home'): ?>
        <h1 id="title"><?php echo $this->fetch('title'); ?></h1>
    <?php else: ?>
        <p id="title"><a href="/"><?php echo Configure::read('Phase.site.name') ?></a></p>
    <?php endif; ?>
        <nav>
            <ul>
                <li><a href="/about.html">about</a></li>
            </ul>
        </nav>
    </header>
</div>
