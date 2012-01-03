<div id="footer-container">
	<footer class="wrapper">
      <a class="feed" href="<?php echo Configure::read('Phase.feed.url') ?>">
        <img src="/img/feed/feed-icon-28x28.png" alt="Subscribe to RSS Feed" />
      </a>
      <div class="contact">
        <h3>
          <?php echo Configure::read('Phase.author.name') ?><br />
          <?php echo Configure::read('Phase.author.email') ?>
        </p>
      </div>
      <div class="contact">
        <p>
          <a href="http://github.com/<?php echo Configure::read('Phase.author.github') ?>/">github.com/<?php echo Configure::read('Phase.author.github') ?></a><br />
          <a href="http://twitter.com/<?php echo Configure::read('Phase.author.twitter') ?>/">twitter.com/<?php echo Configure::read('Phase.author.twitter') ?></a><br />
        </p>
      </div>
    </footer>
</div>
