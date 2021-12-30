<?php

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\helpers\HTMLHelper;
?>

<tr class="form-field form-required">
    <th scope="row" valign="top"><label for="term-color">Color</label></th>
    <td>
        <?php echo HTMLHelper::inputColor(sprintf('%s_color', App::PREFIX), $color); ?>
        <p>The color of the tag.</p>
    </td>
</tr>