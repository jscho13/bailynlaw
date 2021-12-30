<?php



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;

use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;



wp_enqueue_script( 'cmlm-edit-link-js', plugin_dir_url( App::PLUGIN_FILE ) . 'assets/backend/js/edit-link.js', array( 'jquery', 'common' ), time() );



?>



<div class="form-field term-subtitle-wrap">

    <label for="term-subtitle">Subtitle</label>

    <input name="<?php echo sprintf('%s_subtitle', App::PREFIX); ?>" id="term-subtitle" type="text" value="" size="40" />

    <p>The subtitle is displayed under the name.</p>

</div>

<div class="form-field">

    <label for="term-url">URL</label>

    <input name="<?php echo sprintf('%s_url', App::PREFIX); ?>" id="term-url" type="url" value="" size="40"/>

    <p>The link is target address.</p>

	<button type="submit" class="upload_url_button dashicons-before dashicons-upload">Upload</button>

	<i>(Upload or select file from Wordpress media library)</i>

</div>

<div class="form-field"> 

	<div id="tagfile_wrapper_1">

		<p class="description">URL of attachment 1</p>

		<input name="<?php echo sprintf('%s_tagfile1_url', App::PREFIX); ?>" id="term-tagfile1-url" type="url" value="" size="40"/>

        <p class="description">The name of link to attachment 1</p>

		<input name="<?php echo sprintf('%s_tagfile1_name', App::PREFIX); ?>" id="term-tagfile1-name" type="text" value="" size="20"/>

		<button type="submit" class="upload_file_button dashicons-before dashicons-upload">Upload file</button>

		<i>(Upload or select file from Wordpress media library)</i>

	</div>

	<div id="tagfile_wrapper_2">

		<label for="term-tagfile2-url">URL of attachment 2</label>

		<input name="<?php echo sprintf('%s_tagfile2_url', App::PREFIX); ?>" id="term-tagfile2-url" type="url" value="" size="40"/>

		<p>The link is target address.</p>

		<label for="term-tagfile2-name">Link label of attachment 2</label>

		<input name="<?php echo sprintf('%s_tagfile2_name', App::PREFIX); ?>" id="term-tagfile2-name" type="text" value="" size="20"/>

		<p>The name of link to attachment 2.</p>

	</div>

	<div id="tagfile_wrapper_3">

		<label for="term-tagfile3-url">URL of attachment 3</label>

		<input name="<?php echo sprintf('%s_tagfile3_url', App::PREFIX); ?>" id="term-tagfile3-url" type="url" value="" size="40"/>

		<p>The link is target address.</p>

		<label for="term-tagfile3-name">Link label of attachment 3</label>

		<input name="<?php echo sprintf('%s_tagfile3_name', App::PREFIX); ?>" id="term-tagfile3-name" type="text" value="" size="20"/>

		<p>The name of link to attachment 3.</p>

	</div>

	<div id="tagfile-btn-add" class="button">Add attachment</div>

</div>

<div class="form-field term-video-url-wrap">

    <label for="term-video-url">Video URL (vimeo or youtube)</label>

    <input name="<?php echo sprintf('%s_video_url', App::PREFIX); ?>" id="term-video-url" type="url" value="" size="40"/>

    <p>The video is displayed next to the name. Size can be change in plugin options.</p>

</div>

<div class="form-field term-image-url-wrap">

    <label for="term-image-url">Image URL</label>

    <input name="<?php echo sprintf('%s_image_url', App::PREFIX); ?>" id="term-image-url" type="url" value="" size="40" />

    <p>The image is displayed next to the name. Size can be change in plugin options.</p>

</div>

<div class="form-field form-required">

    <label for="term-category_id">Category</label>

    <?php

    $terms = get_terms([

        'taxonomy' => CategoryTaxonomy::TAXONOMY,

        'hide_empty' => false,

        'orderby' => 'slug'

    ]);



    $hierarchy = _get_term_hierarchy(CategoryTaxonomy::TAXONOMY);

    $size = (count($terms) > 10) ? 10 : 5;

    ?>



    <select name="cmlm_category[]" multiple id="term-category_id" style="min-height: 120px;" size="<?php echo $size; ?>">



    <?php

    function output_child( $parent, $hierarchy, $count ) {

        foreach( $hierarchy[$parent->term_id] as $child) {

            $child = get_term($child, CategoryTaxonomy::TAXONOMY );

            $dash = str_repeat('-', $count );

            echo '<option value="' . $child->term_id . '">'.$dash.' ' . $child->name . '</option>';

            if( isset( $hierarchy[$child->term_id] ) ) output_child( $child, $hierarchy, $count + 1 );

        }

    }

    foreach($terms as $term) {

        if($term->parent) continue;



        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';



        if( isset( $hierarchy[$term->term_id] ) ) output_child($term, $hierarchy ,1);

    }



    ?>

    </select>

    <p>The category group your links.</p>

</div>

<div class="form-field term-tags-wrap">

    <label for="term-tags">Tags</label>

    <div class="cmlm-form-field-checkboxes">

        <?php

        wp_list_categories(array(

            'hide_empty' => FALSE,

            'hierarchical' => FALSE,

            'title_li' => NULL,

            'show_option_none' => 'No tags',

            'pad_counts' => 0,

            'taxonomy' => TagTaxonomy::TAXONOMY,

            'walker' => new Walker_Category_Checklist()

        ));

        ?>

    </div>

    <p>Using tags is good way to provide some informations.</p>

</div>

<div class="form-field term-show-checkbox-wrap">

    <label>

        <input type="checkbox" id="term-show-checkbox" onchange="jQuery(this).next().val(this.checked ? 1 : 0)" />

        <input type="hidden" id="term-show-checkbox-hidden" name="<?php echo sprintf('%s_show_checkbox', App::PREFIX); ?>" value="0" />

        Show checkbox

    </label>

    <p>The checkbox before link which allow users mark visited address.</p>

</div>

<div class="form-field term-date-wrap">

    <label for="term-date">Date</label>

    <input name="<?php echo sprintf('%s_date', App::PREFIX); ?>" id="term-date" type="text" value="" size="40" placeholder="<?php echo App::CSV_DATE_FORMAT; ?>" autocomplete="off" />

    <p class="description">The date assigned to link in format <?php echo App::CSV_DATE_FORMAT ?>. For example: <?php echo date_i18n(App::CSV_DATE_FORMAT, false, false); ?></p>

</div>


<div class="form-field term-date-wrap">

    <label for="term-date">Price</label>

    <input name="<?php echo sprintf('%s_rank', App::PREFIX); ?>" id="term-rank" type="number" value="" />

    <p class="description">This is where you add the price. Please put the price in whole numbers.</p>

</div>

