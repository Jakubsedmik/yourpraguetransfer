<ul class="s7-languageSwitcher">
    <?php global $languages; ?>
    <?php foreach ($languages as $key => $val): ?>
        <li>
            <a href="<?php echo home_url() . "?lang=" . $val['code']; ?>" title="<?php echo $val['label']; ?>">
                <img src="<?php echo $val['label_image'] ?>">
            </a>
        </li>
    <?php endforeach; ?>
</ul>