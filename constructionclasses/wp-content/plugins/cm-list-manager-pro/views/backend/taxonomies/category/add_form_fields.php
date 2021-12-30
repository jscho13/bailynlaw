<?php

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\ListTaxonomy;
use com\cminds\listmanager\plugin\helpers\HTMLHelper;
use com\cminds\listmanager\plugin\options\Options;
?>
<div class="form-field">
    <input type="hidden" name="<?php echo sprintf('%s_category_author', App::PREFIX);?>" value="<?= get_current_user_id(); ?>" id="category_author">
    <label for="term-link">Category link</label>
    <input type="text" name="<?php echo sprintf('%s_category_link', App::PREFIX);?>" value="" id="term-link">
    <p class="description">Clicking on the category header will direct the user to this link</p>
</div>
<div class="form-field form-required">
    <label for="term-tags">Lists</label>
    <div class="cmlm-form-field-checkboxes">
        <?php
        wp_list_categories(array(
            'hide_empty' => FALSE,
            'hierarchical' => FALSE,
            'style' => 'none',
            'pad_counts' => 0,
            'taxonomy' => ListTaxonomy::TAXONOMY,
            'walker' => new Walker_Category_Checklist()
        ));
        ?>
    </div>
</div>
<div class="form-field">
    <label for="term-color">Color</label>
    <?php echo HTMLHelper::inputColor(sprintf('%s_bg_color', App::PREFIX), NULL, array('id' => 'term-color')); ?>
    <p>The background color.</p>
</div>
<div class="form-field">
    <label for="term-link">Category view access</label>
    <select name="<?php echo sprintf('%s_category_access_list', App::PREFIX);?>" value="" id="term-access-list">
		<option value='<?= Options::ALL_USERS ?>'>All users</option>
		<option value='<?= Options::REGISTERED_USERS ?>'>Logged in users only</option>
		<option value='<?= Options::SELECTED_ROLES ?>'>Registered users with selected roles</option>
		<option value='<?= Options::PERSONAL_ACCESS ?>'>Personal (category author) access only</option>
		<option value='<?= Options::DEFAULT_ACCESS ?>' selected='selected'>Default access (plugin option)</option>
	</select>
		<fieldset id="cmlm_roles_list" style="display:none;">
			<?php
				
				$roles = wp_roles()->get_names();
				foreach( $roles as $role ) {
					$role_slug = strtolower($role);
					echo "<input type='checkbox' name='" . sprintf('%s_category_access_roles', App::PREFIX) . "[]' value='$role_slug'>$role<br>";
				}

			?>
		</fieldset>
    <p class="description">Who can view this category</p>
</div>
