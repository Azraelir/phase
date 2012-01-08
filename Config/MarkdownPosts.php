<?php
/**
 * Pre-populate the markdown helper with shortlinks for all posts.
 *
 * Assuming that a post titled "Some post" exists, written on the 25th december (and it's the last
 * post of the year - all of the following will render the same output:
 *  [2011 ][]
 *  [2011/12][]
 *  [2011/12/25][]
 *  [Some post][]
 *
 * The rendered output in all cases would be:
 *  <a href="/2011/12/25/Some-post.html" title="Some post">Some post</a>
 *
 * Therefore you only need to know/remember the date or the title to be able to lazily link to a
 * previous post
 *
 * You can of course overwrite the link text, e.g. [Last Year I wrote about something][2011 ].
 * Note the space after the year is unfortunately required.
 */

$posts = ClassRegistry::init('Post')->findAll();
foreach(array_reverse($posts) as $post) {
    $config['Markdown']['urls'][$post['title']] = $post['url'];

    $config['Markdown']['urls'][$post['year'] . ' '] = $post['url'];
    $config['Markdown']['urls'][$post['year'] . '/' . $post['month']] = $post['url'];
    $config['Markdown']['urls'][$post['year'] . '/' . $post['month'] . '/' . $post['day']] = $post['url'];

    $config['Markdown']['titles'][$post['title']] = $post['title'];

    $config['Markdown']['titles'][$post['year'] . ' '] = $post['title'];
    $config['Markdown']['titles'][$post['year'] . '/' . $post['month']] = $post['title'];
    $config['Markdown']['titles'][$post['year'] . '/' . $post['month'] . '/' . $post['day']] = $post['title'];

}
