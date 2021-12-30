<?php

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\helpers\HTMLHelper;
?>

<div class="form-field form-required">
    <label for="term-color">Color <sup>required</sup></label>
    <?php echo HTMLHelper::inputColor(sprintf('%s_color', App::PREFIX), NULL, array('id' => 'term-color')); ?>
    <p>The color of the tag.</p>
</div>
