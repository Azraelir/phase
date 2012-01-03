<div id="header-container">
    <header class="wrapper clearfix">
    <?php if (Router::url() === '/'): ?>
        <h1 id="title"><?php echo $title_for_layout ?></h1>
    <?php else: ?>
        <p id="title"><?php echo Configure::read('Phase.site.name') ?></p>
    <?php endif; ?>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">about</a></li>
            </ul>
        </nav>
    </header>
</div>
