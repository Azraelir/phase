---
layout: home
title: Phase blog install
description: Latest posts from Somebody
---

  <h2>Title</h2>
  <p>Tagline.</p>
  <?php $latest = $this->Post->data($latest); ?><h2>Latest: <a href="<?php echo $latest['url'] ?>"><?php echo $latest['title'] ?></a></h2>
  <h3 class="date"><?php echo strftime('%e %b, %Y', $latest['date']) ?></h3>
  <?php echo $latest['intro'] ?>

  <h2>Recent Writing</h2>
  <ul class="posts">
    <?php foreach($posts as $post): ?>
      <li>
        <span class="date"><?php echo strftime('%d %b, %Y', $post['date']) ?></span>
        »
        <a href="<?php echo $post['url']?>"><?php echo $post['title'] ?></a>
      </li>
    <?php endforeach; ?>
    <li><a href="/archives.html">All articles</a></li>
  </ul>
