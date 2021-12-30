<?php

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\taxonomies\ListTaxonomy;
use com\cminds\listmanager\plugin\helpers\HTMLHelper;
use com\cminds\listmanager\plugin\options\Options;
?>
<tr class="form-field">
    <th scope="row" valign="top"><label for="term-link">Category link</label></th>
    <td>
      <input type="text" name="<?php echo sprintf('%s_category_link', App::PREFIX);?>" value="<?php echo $category_link;?>" id="term-link">
      <p class="description">Clicking on the category header will direct the user to this link</p>
    </td>
</tr>

<tr class="form-field">
    <th scope="row" valign="top"><label for="term-list">Lists</label></th>
    <td>
        <div class="cmlm-form-field-checkboxes">
            <?php
            wp_list_categories(array(
                'hide_empty' => FALSE,
                'hierarchical' => FALSE,
                'style' => 'none',
                'pad_counts' => 0,
                'taxonomy' => ListTaxonomy::TAXONOMY,
                'selected_cats' => $list_id_arr,
                'walker' => new Walker_Category_Checklist()
            ));
            ?>
        </div>
        <!--<p class="description"></p>-->
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top"><label for="term-color">Color</label></th>
    <td>
        <?php echo HTMLHelper::inputColor(sprintf('%s_bg_color', App::PREFIX), $bg_color); ?>
        <p>The background color.</p>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top"><label for="term-link">Category view access</label></th>
	    <td>
    <select name="<?php echo sprintf('%s_category_access_list', App::PREFIX);?>" value="<?php echo $who_access; ?>" id="term-access-list">
		<option value='<?= Options::ALL_USERS ?>' <?= selected($who_access, Options::ALL_USERS, false);?>>All</option>
		<option value='<?= Options::REGISTERED_USERS ?>' <?= selected($who_access, Options::REGISTERED_USERS, false);?>>Logged in users only</option>
		<option value='<?= Options::SELECTED_ROLES ?>' <?= selected($who_access, Options::SELECTED_ROLES, false);?>>Registered users with selected roles</option>
		<option value='<?= Options::PERSONAL_ACCESS ?>' <?= selected($who_access, Options::PERSONAL_ACCESS, false);?>>Personal (category author) access only</option>
		<option value='<?= Options::DEFAULT_ACCESS ?>' <?= selected($who_access, Options::DEFAULT_ACCESS, false);?>>Default access (plugin option)</option>
	</select>
		<fieldset id="cmlm_roles_list" style="display:<?= ($who_access == Options::SELECTED_ROLES) ? 'block' : 'none' ?>">
			<?php
				
				$roles = wp_roles()->get_names();
				foreach( $roles as $role ) {
					$role_slug = strtolower($role);
					echo "<input type='checkbox' name='" . sprintf('%s_category_access_roles', App::PREFIX) . "[]' value='$role_slug' " . checked(true, in_array($role_slug, $access_roles), false) . ">$role<br>";
				}

			?>
		</fieldset>
    <p class="description">Who can view this category</p>
	    <input type="hidden" name="<?php echo sprintf('%s_category_author', App::PREFIX);?>" value="<?= $author_id ?>" id="category_author">
    </td>
</tr>
