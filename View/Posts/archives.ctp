---
layout: default
title: All posts
---

<h1>All articles</h1>
<ul class="posts">
<?php foreach($posts as $file): $post = $this->Post->metaData($file); ?>
    <li><span><?php echo strftime('%d %b, %G', $post['date']) ?></span> » <a href="<?php echo $post['url']?>"><?php echo $post['title'] ?></a></li>
<?php endforeach; ?>
</ul>
