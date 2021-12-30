<?php



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;

use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;

use com\cminds\listmanager\plugin\helpers\HTMLHelper;





wp_enqueue_script( 'cmlm-edit-link-js', plugin_dir_url( App::PLUGIN_FILE ) . 'assets/backend/js/edit-link.js', array( 'jquery', 'common' ), time() );



?>



<tr class="form-field term-subtitle-wrap">

    <th scope="row" valign="top"><label for="term-subtitle">Subtitle</label></th>

    <td>

        <input name="<?php echo sprintf('%s_subtitle', App::PREFIX); ?>" id="term-subtitle" type="text" value="<?php echo esc_html($subtitle); ?>" size="40"/>

        <p class="description">The subtitle is displayed under the name.</p>

    </td>

</tr>

<tr class="form-field">

    <th scope="row" valign="top"><label for="term-url">URL</label></th>

    <td>

        <input name="<?php echo sprintf('%s_url', App::PREFIX); ?>" id="term-url" type="url" value="<?php echo esc_html($url); ?>" size="40"/>

        <p class="description">The link is target address.</p>

		<button type="submit" class="upload_url_button dashicons-before dashicons-upload">Upload</button>

		<i>(Upload or select file from Wordpress media library)</i>

    </td>

</tr>

<tr class="form-field" id="tagfile_wrapper_1">

    <th scope="row" valign="top"><div>Attachment 1</div></th>

    <td>

		<p class="description">URL of attachment 1</p>

		<input name="<?php echo sprintf('%s_tagfile1_url', App::PREFIX); ?>" id="term-tagfile1-url" type="url" value="<?php echo esc_html($tagfile1_url); ?>" />

        <p class="description">The name of link to attachment 1</p>

        <input name="<?php echo sprintf('%s_tagfile1_name', App::PREFIX); ?>" id="term-tagfile1-name" type="text" value="<?php echo esc_html($tagfile1_name); ?>" />

		<button type="submit" class="upload_file_button dashicons-before dashicons-upload">Upload file</button>

		<i>(Upload or select file from Wordpress media library)</i>

	</td>

</tr>

<tr class="form-field" id="tagfile_wrapper_2">

    <th scope="row" valign="top"><div>Attachment 2</div></th>

    <td>

		<p class="description">URL of attachment 2</p>

		<input name="<?php echo sprintf('%s_tagfile2_url', App::PREFIX); ?>" id="term-tagfile2-url" type="url" value="<?php echo esc_html($tagfile2_url); ?>" />

        <p class="description">The name of link to attachment 2</p>

        <input name="<?php echo sprintf('%s_tagfile2_name', App::PREFIX); ?>" id="term-tagfile2-name" type="text" value="<?php echo esc_html($tagfile2_name); ?>" />

		<button type="submit" class="upload_file_button dashicons-before dashicons-upload">Upload file</button>

		<i>(Upload or select file from Wordpress media library)</i>

	</td>

</tr>

<tr class="form-field" id="tagfile_wrapper_3">

    <th scope="row" valign="top"><div>Attachment 3</div></th>

    <td>

		<p class="description">URL of attachment 3</p>

		<input name="<?php echo sprintf('%s_tagfile3_url', App::PREFIX); ?>" id="term-tagfile3-url" type="url" value="<?php echo esc_html($tagfile3_url); ?>" />

        <p class="description">The name of link to attachment 3</p>

        <input name="<?php echo sprintf('%s_tagfile3_name', App::PREFIX); ?>" id="term-tagfile3-name" type="text" value="<?php echo esc_html($tagfile3_name); ?>" />

		<button type="submit" class="upload_file_button dashicons-before dashicons-upload">Upload file</button>

		<i>(Upload or select file from Wordpress media library)</i>

	</td>

</tr>

<tr class="form-field">

    <td colspan='2'>

		<div id="tagfile-btn-add" class="button">Add attachment</div>

	</td>

</tr>

<tr class="form-field">

    <th scope="row" valign="top"><label for="term-video-url">Video URL (vimeo or youtube)</label></th>

    <td>

        <input name="<?php echo sprintf('%s_video_url', App::PREFIX); ?>" id="term-video-url" type="url" value="<?php echo esc_html($video_url); ?>" />

        <p class="description">The video is displayed next to the name. Size can be change in plugin options.</p>

    </td>

</tr>

<tr class="form-field">

    <th scope="row" valign="top"><label for="term-image-url">Image URL</label></th>

    <td>

        <input name="<?php echo sprintf('%s_image_url', App::PREFIX); ?>" id="term-image-url" type="url" value="<?php echo esc_html($image_url); ?>" size="40"/>

        <p class="description">The image is displayed next to the name. Size can be change in plugin options.</p>

    </td>

</tr>

<tr class="form-field form-required">

    <th scope="row" valign="top"><label for="term-category_id">Category</label></th>

    <td>

        <?php

        $terms = get_terms([

            'taxonomy' => CategoryTaxonomy::TAXONOMY,

            'hide_empty' => false,

            'orderby' => 'slug'

        ]);

        $hierarchy = _get_term_hierarchy(CategoryTaxonomy::TAXONOMY);



        function output_child( $parent, $hierarchy, $category_arr, $count ) {

            foreach( $hierarchy[$parent->term_id] as $child) {

                $child    = get_term($child, CategoryTaxonomy::TAXONOMY );

                $dash     = str_repeat('-', $count );

                $selected = in_array( $child->term_id, $category_arr ) ? 'selected' : '';

                echo '<option value="'. $child->term_id .'" '. $selected .'>'.$dash.' ' . $child->name .'</option>';





                if( isset( $hierarchy[$child->term_id] ) ) output_child( $child, $hierarchy, $category_arr, $count + 1 );

            }

        }

        $size = (count($terms) > 10) ? 10 : 5;

        ?>



        <select name="cmlm_category[]" multiple style="min-height: 120px;" size="<?php echo $size; ?>">



        <?php foreach($terms as $term) {

            if($term->parent) continue;



            $category_arr = explode(',', $category_id );

            $selected = in_array( $term->term_id, $category_arr ) ? 'selected' : '';

            echo '<option value="'. $term->term_id .'" '. $selected .'>'. $term->name .'</option>';



            if( isset( $hierarchy[$term->term_id] ) ) output_child($term, $hierarchy, $category_arr, 1);

        }?>

        </select>

        <p class="description">The category group your links.</p>

    </td>

</tr>

<tr class="form-field">

    <th scope="row" valign="top"><label for="term-tag_id">Tags</label></th>

    <td>

        <div class="cmlm-form-field-checkboxes">

            <?php

            wp_list_categories(array(

                'hide_empty' => FALSE,

                'hierarchical' => FALSE,

                'title_li' => NULL,

                'show_option_none' => 'No tags',

                'pad_counts' => 0,

                'taxonomy' => TagTaxonomy::TAXONOMY,

                'selected_cats' => $tag_id_arr,

                'walker' => new Walker_Category_Checklist()

            ));

            ?>

        </div>

        <p class="description">Using tags is good way provide some informations.</p>

    </td>

</tr>

<tr class="form-field">

    <th scope="row" valign="top">&nbsp;</th>

    <td>

        <label>

            <input type="checkbox" onchange="jQuery(this).next().val(this.checked ? 1 : 0)" <?php echo $show_checkbox ? 'checked="checked"' : ''; ?> />

            <input type="hidden" name="<?php echo sprintf('%s_show_checkbox', App::PREFIX); ?>" value="<?php echo $show_checkbox; ?>" />

            Show checkbox

        </label>

        <p class="description">The checkbox before link which allow users mark visited address.</p>

    </td>

</tr>

<tr class="form-field term-date-wrap">

    <th scope="row" valign="top"><label for="term-date">Date</label></th>

    <td>

        <?php $date = $date ? date_i18n(App::CSV_DATE_FORMAT, $date, false) : false; ?>

        <input name="<?php echo sprintf('%s_date', App::PREFIX); ?>" id="term-date" type="text" value="<?php echo esc_html($date); ?>" size="40" placeholder="<?php echo App::CSV_DATE_FORMAT; ?>" />



        <?php // TO DO: datetime picker, now is only date picker //echo HTMLHelper::inputDate('event_date', ""); ?>



        <p class="description">The date assigned to link in format <?php echo App::CSV_DATE_FORMAT ?>. For example: <?php echo date_i18n(App::CSV_DATE_FORMAT, false, false); ?></p>

    </td>

</tr>

<tr class="form-field term-date-wrap">

    <th scope="row" valign="top"><label for="term-date">Price</label></th>

    <td>

        <input name="<?php echo sprintf('%s_rank', App::PREFIX); ?>" id="term-rank" type="number" value="<?php echo esc_html($rank); ?>" />

        <?php // TO DO: datetime picker, now is only date picker //echo HTMLHelper::inputDate('event_date', ""); ?>

    </td>

</tr>


<script type="text/javascript">





</script>

