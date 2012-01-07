---
layout: default
title: All posts
meta_title: Index of all posts
meta_description: Want to see what else has been published on this site? You've found the right place
---

<h1>All articles</h1>
<ul class="posts">
<?php foreach($posts as $post): ?>
    <li>
        <span class="date"><?php echo strftime('%d %b, %Y', $post['date']) ?></span>
        »
        <a href="<?php echo $post['url']?>"><?php echo $post['title'] ?></a>
    </li>
<?php endforeach; ?>
</ul>
