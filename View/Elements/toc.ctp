<?php $headers = $this->Markdown->getHeaders();
if (!$headers) {
    return;
}
?>
<aside id="toc">
    <h3>Contents</h3>
    <ul>
        <li><a href='#main'>Intro</a></li>
        <?php foreach($headers as $header) {
            echo "<li><a href='#{$header['id']}'>{$header['title']}</a></li>";
        } ?>
    </ul>
</aside>
