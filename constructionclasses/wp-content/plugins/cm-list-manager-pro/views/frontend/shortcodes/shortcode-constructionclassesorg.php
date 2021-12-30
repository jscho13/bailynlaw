<?php



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\frontend\walkers\FilterWalker;

use com\cminds\listmanager\plugin\frontend\walkers\CategoryWalkerConstructionclassesorg as CategoryWalker;

use com\cminds\listmanager\plugin\frontend\walkers\TagWalker;

use com\cminds\listmanager\plugin\taxonomies\CategoryTaxonomy;

use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;

use com\cminds\listmanager\plugin\options\Options;




$meta_query = array('relation' => 'AND');

$links_count_arr = array();



if (count($list_term_id_arr)) {

    $meta_query = array_merge($meta_query, array(

        array(

            'key' => sprintf('%s_list', App::PREFIX),

            'value' => $list_term_id_arr,

            'compare' => 'IN'

        )

    ));

}

$cat_term_id_arr = get_terms(CategoryTaxonomy::TAXONOMY, array(

    'hide_empty' => FALSE,

	'fields'     => 'ids',

    'include' => count($category_term_id_arr) ? $category_term_id_arr : NULL,

    'meta_query' => $meta_query

        ));



$cat_term_id_arr = array_filter($cat_term_id_arr, function($t_id) { return CategoryTaxonomy::isVisible($t_id);});





// Pagination Starts

$items_per_page = !empty($items_per_page) ? $items_per_page : intval(Options::getOption('items_per_page'));



if ( isset( $items_per_page ) && !empty( $items_per_page ) ) {

    $pagination_html = '';



    // links quantity for each category

    global $wpdb;

    $category_taxonomy = CategoryTaxonomy::TAXONOMY;

    $all_links = 0;

    foreach ( $cat_term_id_arr as $cat_term_id ) {

        $links_count = $wpdb->get_var(

                        "SELECT COUNT(*)

                        FROM $wpdb->termmeta

                        WHERE meta_key = '{$category_taxonomy}'

                        AND meta_value REGEXP '{App::$mysql_regexp_markers[0]}{$cat_term_id}{App::$mysql_regexp_markers[1]}'");

        if( $links_count > 0 ) {

            if( $links_count > $max_links && $max_links > 0 ) {

                $links_count = $max_links;

            }

            $links_count_arr[$cat_term_id] = $links_count;

        }

        $all_links += $links_count;

    }



    // getting a links distribution array on pages

    $links_count_arr_copy = $links_count_arr;

	$arr_item_tax_total_gen = array();

    while (!empty($links_count_arr_copy)) {

        $j = 0;

        $arr_item_tax_total = array_map(function(){return 0;}, $links_count_arr_copy);



        for ($i=0; $i < $items_per_page; $i++) {

            $k = 0;

            foreach ($links_count_arr_copy as $key => $value) {

                if($i >= $items_per_page) break;

                if($j > 2*$items_per_page) break;

                if( $value > 0) {

                    $links_count_arr_copy[$key] = $value - 1;

                    $arr_item_tax_total[$key] += 1;

                } else {

                    $j++;

                    unset($links_count_arr_copy[$key]);

                    $correct_array = $key;

                    continue;

                }

                $k++;

                if(count($links_count_arr_copy) != $k) {

                    $i++;

                }



            }



        }



        if(!empty($arr_item_tax_total)) $arr_item_tax_total_gen[] = $arr_item_tax_total;

    }



    $page_number = 1;



    // getting max_number_pages

    if( $items_per_page && (count($cat_term_id_arr) * $max_links > $items_per_page || $max_links == 0)) {

        $max_page_number = ceil(array_sum($links_count_arr) / $items_per_page);

    } else {

        $max_page_number = 1;

    }

    if( $page_number > $max_page_number ) $page_number = $max_page_number;



    if( $max_page_number > 1 ) {

        $pagination_html .= '<div class="cmlm-category-box cmlm_pagination" data-scroll="' . $scroll . '"><div class="cmlm_pagination-wrapper">';



            for ($i=0; $i < $max_page_number; $i++) {

                $page_link = '<a href="#" class="cmlm-pagination-btn" data-page-number="' . ( $i + 1 ) . '" data-max-page-number="'.$max_page_number.'" data-list-term-id-arr="'.implode(',',$list_term_id_arr).'" data-category-term-id-arr="'.implode(',',$cat_term_id_arr).'" data-max-height="'.$max_height.'" data-tag-term-id-arr="'.implode(',',$tag_term_id_arr).'" data-items-per-page="'.$items_per_page.'" data-max-links="'.$max_links.'">' . ( $i + 1 ) . '</a>';



                if ( ($i + 1) != $page_number ) {

                    $pagination_html .= '<div class="cmlm_pagination_pin">';

                } else {

                    $pagination_html .= '<div class="cmlm_pagination_pin active">';

                }

                $pagination_html .=  $page_link.'</div>';

            }

        $pagination_html .= "</div></div>";

    }

    $totalCount = array_sum( $links_count_arr );

}

?>



<div class="cmlm constructionclassesorg">



    <?php if (Options::getOption('show_search_and_filter')): ?>



        <div class="cmlm-filter">



            <?php

            if( $categories_filter != '0' ) {

	            echo '<ul class="cmlm-filter-list">';

	            wp_list_categories( array(

		            'hide_empty'       => false,

		            'hierarchical'     => true,

		            'include'          => $cat_term_id_arr,

		            'title_li'         => null,

		            'show_option_none' => null,

		            'show_option_all'  => Options::getOption('all_categories_label'),

		            'taxonomy'         => CategoryTaxonomy::TAXONOMY,

		            'walker'           => new FilterWalker()

	            ) );


				echo'<li style="margin:0; margin-left:25px; padding:0; border:none !important;"><a class="nav-link btn btn-primary" style="background-color:rgba(239,202,0,1) !important; border-color:rgba(239,202,0,1) !important; color:black !important;" target="_blank" href="https://lp.constantcontactpages.com/su/wSjFP2O">Subscribe Here</a></li>';
	            echo '</ul>';

            }

			$search_label = Options::getOption('label_for_search_input');

            ?>
			<br>
			

            <div class="cmlm-search">

				<?php if ( !empty($search_label) ) : ?>

				<div class="cmlm-search-input-wrapper">

				<?php endif; ?>

                <input type="text" placeholder="<?php echo $placeholder; ?>" class="cmlm-search-input cmlm-clearable" name="cmlm-search-input" />

				<?php if ( !empty($search_label) ) : ?>

				</div>

				<?php endif; ?>

            </div>

            <?php if ( $description ): ?>

              <div class="cmlm-search-description"><?php echo $description; ?></div>

            <?php endif; ?>

        </div>

    <?php endif; ?>



    <?php //if ( Options::getOption('show_sortby_event_date') ) : ?>

       <!-- <div class="cmlm-sorting">

            Sort by Event date 

            <a href="?<?php echo http_build_query(array_merge($_GET, array(App::PREFIX . '_orderby' => sprintf('%s_date', App::PREFIX), App::PREFIX . '_order' => 'ASC'))) ?>"><span class="dashicons dashicons-arrow-up"></span></a> 

            <a href="?<?php echo http_build_query(array_merge($_GET, array(App::PREFIX . '_orderby' => sprintf('%s_date', App::PREFIX), App::PREFIX . '_order' => 'DESC'))) ?>"><span class="dashicons dashicons-arrow-down"></span></a>

        </div>-->
	<div style="display:flex">
        <div class="cmlm-sorting">

            Sort by Event date 

            <span class="dashicons dashicons-arrow-up" onclick="sortAsc()" style="cursor:pointer; font-size:12px; line-height: 2;">▲</span>

            <span class="dashicons dashicons-arrow-down" onclick="sortDesc()" style="cursor:pointer; font-size:12px; line-height: 2;">▼</span>

        </div>

        <div class="cmlm-sorting">

            Sort by Popularity Rank

            <span class="dashicons dashicons-arrow-up" onclick="sortRankAsc()" style="cursor:pointer; font-size:12px; line-height: 2;">▲</span>

            <span class="dashicons dashicons-arrow-down" onclick="sortRankDesc()" style="cursor:pointer; font-size:12px; line-height: 2;">▼</span>

        </div>
	
		<div class="cmlm-sorting">

            Sort by Price

            <span class="dashicons dashicons-arrow-up" onclick="sortPriceAsc()" style="cursor:pointer; font-size:12px; line-height: 2;">▲</span>

            <span class="dashicons dashicons-arrow-down" onclick="sortPriceDesc()" style="cursor:pointer; font-size:12px; line-height: 2;">▼</span>

         </div>
	</div>

    <?php //endif; ?>



    <?php if ( Options::getOption('show_bonus_info') || !empty($show_bonus_info) ): ?>



        <div class="cmlm-bonus-info" data-total-count="<?php echo isset( $totalCount ) ? $totalCount : '' ?>">



            <span class="cmlm-js-placeholder" data-html="<?php echo esc_attr(Options::getOption('bonus_info_format')); ?>"></span>



        </div>



    <?php endif; ?>



    <?php if( isset( $pagination_html ) ) echo $pagination_html; ?>

    <div class="cmlm-content">



      <?php if ( isset( $pagination_html ) ): ?>

          <div class="cmlm-loader cmlm-hidden-loader"><div class="cmlm-loader-big"><img width="30" src="<?php echo plugins_url( 'assets/img/ajax-loader-big.gif', App::PLUGIN_FILE ); ?>" ></div></div>

      <?php endif; ?>



      <div class="cmlm-content-links">

        <div class="cmlm-grid-sizer"></div>

        <div class="cmlm-gutter-sizer"></div>

        <?php

        $paginationData = array();

        if ( isset( $page_number ) ) {

            $paginationData = array(

              'items_per_page' => $items_per_page,

              'arr_item_tax_total_gen' => $arr_item_tax_total_gen,

              'page_number'     => $page_number,

              'max_page_number'  =>  $max_page_number

            );

        }



        wp_list_categories(array(

            'style' => NULL,

            'hide_empty' => FALSE,

            'hierarchical' => TRUE,

            'title_li' => NULL,

            'show_option_all' => '',

            'include' => $cat_term_id_arr,

            'taxonomy' => CategoryTaxonomy::TAXONOMY,

            'walker' => new CategoryWalker( array_merge( array(

                'max_links' => $max_links,

                'max_height' => $max_height,

                'tag_term_id_arr' => $tag_term_id_arr),

                $paginationData ))

        ));

        ?>

        <?php

        wp_list_categories(array(

            'style' => NULL,

            'hide_empty' => FALSE,

            'hierarchical' => FALSE,

            'title_li' => NULL,

            'show_option_none' => '',

            'show_option_all' => '',

            //'include' => count($tag_term_id_arr) ? $tag_term_id_arr : NULL,

            'taxonomy' => TagTaxonomy::TAXONOMY,

            'walker' => new TagWalker(array(

                'cat_term_id_arr' => $cat_term_id_arr,

                'tag_term_id_arr' => $tag_term_id_arr))

        ));

        ?>

      </div>

    </div>

    <?php if( isset( $pagination_html ) ) echo $pagination_html; ?>

</div>

<script>
    //set up funtion
// this converts time from 3p format

function sortAsc(){
    console.log(`Pressed`);

var convertTime12to24 = (time12h) => {
    console.log(time12h);
    console.log(time12h.split(' '));
    const [emptytOne, time, modifier, emptyTwo] = time12h.split(' ');
    console.log(time);
    
    let [hours, minutes] = time.split(':');
    
    if(minutes === undefined){
        minutes = '00';
    }

    if (hours === '12') {
      hours = '00';
    }
  
    if (modifier === 'PM') {
      hours = parseInt(hours, 10) + 12;
    }
  
    return `${hours}:${minutes}`;
  }
  


//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

//console.log(categoryClassLists);
//this gets the second element in the cmlm category group
//getColumns[0].children[1];
//this lets us step into the list of classes so we can start the sort
//getColumns[0].children[1].children;
// time to loop through each class list isself

//var classes = [];
//var classTimes = [];
//need to put this in a key value pair to change the order of the list
categoryClassLists.forEach(function(list){
    //console log each list
    //console.log(list);
    //[...list.children].sort( (a,b)=>a.innerText>b.innerText?1:-1).forEach(node=>list.appendChild(node));
    [...list.children].sort(function(a,b){
        //console.log(a.children[1].textContent);
        if(a.children[1].textContent.includes('at',5) && b.children[1].textContent.includes('at',5)){
            //console.log(a.children[1].textContent.split(" at"));
            //console.log(a.children[1].textContent.split(" at")[1]);
            var aDate = a.children[1].textContent.split(" at")[0];
            var bDate = b.children[1].textContent.split(" at")[0];
            var aTime = convertTime12to24(a.children[1].textContent.split(" at")[1]);
            var bTime = convertTime12to24(b.children[1].textContent.split(" at")[1]);
            var aDateTime = Date.parse(`${aDate} ${aTime}`);
            var bDateTime = Date.parse(`${bDate} ${bTime}`);
            console.log(a.children[1].textContent.split(" at")[1]);
            console.log(`this is the time ${aTime}`);
            console.log(aDateTime);
        }else{
            var aDate = a.children[1].textContent;
            var bDate = b.children[1].textContent;
            var aDateTime = Date.parse(`${aDate}`);
            var bDateTime = Date.parse(`${bDate}`);
        }


        //console.log(aDateTime);
        //console.log(bDateTime);
        if(aDateTime < bDateTime){
            return -1;
        }
        if(aDateTime > bDateTime){
            return 1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));




    //console.log(list);


/*------ Nothing but test code and notes below

    //var classes = list.children;
    //console.log(classes);
    //sort each list and its elements inside of it
    //console.log(list);
    
    /*
    classes.forEach(function(clas){
        // this is the time
        //console.log(clas.children[1].textContent.split('@'));
        //console.log(clas.children[1].textContent.split('@')[1]);

        //gets the date and time to numbers to sort
        var dayOfClass;
        var timeOfClass;
        timeOfClass = convertTime12to24(clas.children[1].textContent.split('@')[1]);
        dayOfClass = clas.children[1].textContent.split('@')[0];
        console.log(Date.parse(`${dayOfClass} ${timeOfClass}`));


    });
    */

    });

}


//set up funtion
// this converts time from 3p format

function sortDesc(){


    var convertTime12to24 = (time12h) => {
        //console.log(time12h);
        //console.log(time12h.split(' '));
        const [emptytOne, time, modifier, emptyTwo] = time12h.split(' ');
        //console.log(time);
        
        let [hours, minutes] = time.split(':');
        
        if(minutes === undefined){
            minutes = '00';
        }

        if (hours === '12') {
        hours = '00';
        }
    
        if (modifier === 'PM') {
        hours = parseInt(hours, 10) + 12;
        }
    
        return `${hours}:${minutes}`;
    }
      
      //console.log(convertTime12to24('01:02 PM'));
      //console.log(convertTime12to24('05:06 PM'));
      //console.log(convertTime12to24('12:00 PM'));
      //console.log(convertTime12to24('12:00 AM'));
    
    
    //First we need to select otter most column for each column and put them in their own array.
    var getColumns = document.querySelectorAll('.categorySort');
    
    //second we need to search each column for the date element time to make the loop to select each column
    //getColumns.forEach(column => console.log(column)); this gets all the columns on their own
    
    //this needs to go into a funtion to restart itself
    var categoryClassLists = [];
    
    getColumns.forEach(function(column){
         categoryClassLists.push(column.children[1]);
        });
    
    //console.log(categoryClassLists);
    //this gets the second element in the cmlm category group
    //getColumns[0].children[1];
    //this lets us step into the list of classes so we can start the sort
    //getColumns[0].children[1].children;
    // time to loop through each class list isself
    
    //var classes = [];
    var classTimes = [];
    //need to put this in a key value pair to change the order of the list
    categoryClassLists.forEach(function(list){
        //console log each list
        //console.log(list);
        //[...list.children].sort( (a,b)=>a.innerText>b.innerText?1:-1).forEach(node=>list.appendChild(node));
        [...list.children].sort(function(a,b){
            //console.log(a.children[1].textContent);
            if(a.children[1].textContent.includes(" at") && b.children[1].textContent.includes(" at")){
    
                var aDate = a.children[1].textContent.split(" at")[0];
                var bDate = b.children[1].textContent.split(" at")[0];
                var aTime = convertTime12to24(a.children[1].textContent.split(" at")[1]);
                var bTime = convertTime12to24(b.children[1].textContent.split(" at")[1]);
                var aDateTime = Date.parse(`${aDate} ${aTime}`);
                var bDateTime = Date.parse(`${bDate} ${bTime}`);
            }else{
                var aDate = a.children[1].textContent;
                var bDate = b.children[1].textContent;
                var aDateTime = Date.parse(`${aDate}`);
                var bDateTime = Date.parse(`${bDate}`);
            }
    
    
            //console.log(aDateTime);
            //console.log(bDateTime);
            if(aDateTime < bDateTime){
                return 1;
            }
            if(aDateTime > bDateTime){
                return -1;
            }
    
            return 0;
    
        }).forEach(node=>list.appendChild(node));
    
    
    
    
        //console.log(list);
    
    
    /*------ Nothing but test code and notes below
    
        //var classes = list.children;
        //console.log(classes);
        //sort each list and its elements inside of it
        //console.log(list);
        
        /*
        classes.forEach(function(clas){
            // this is the time
            //console.log(clas.children[1].textContent.split('@'));
            //console.log(clas.children[1].textContent.split('@')[1]);
    
            //gets the date and time to numbers to sort
            var dayOfClass;
            var timeOfClass;
            timeOfClass = convertTime12to24(clas.children[1].textContent.split('@')[1]);
            dayOfClass = clas.children[1].textContent.split('@')[0];
            console.log(Date.parse(`${dayOfClass} ${timeOfClass}`));
    
    
        });
        */
    
        });
    
    }



//this lets us get 
//getColumns[0].children[1].children[0].children[1];


//Next we split the date element using element.split.
//example:  var splitDate = textDate.split('@');
//getColumns[0].children[1].children[0].children[1].textContent.split('@');

//this will pull the date and time into 2 different arrays
//var sortableDates = getColumns[0].children[1].children[0].children[1].textContent.split('@');
//then we use date.parse on the first item in the array to get the value of the date

//split the date and time and fill out the rest of the time into the proper format to put back


//Date.parse(sortableDates[0]);
//example: var testDateTwo = splitDate[0];
//Date.parse(testDateTwo);
//use this value to sort the columns



//set up funtion
// this converts time from 3p format

function sortPriceAsc(){


//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

categoryClassLists.forEach(function(list){
    //console.log(list.children[0].children[2].children[0].textContent);
    
    
    [...list.children].sort(function(a,b){
        //console.log(a.children[2].textContent.split("$")[1]);

        
        
        if(parseFloat(a.children[3].children[0].textContent.split("$")[1]) < parseFloat(b.children[3].children[0].textContent.split("$")[1])){
            return -1;
        }
        if(parseFloat(a.children[3].children[0].textContent.split("$")[1]) > parseFloat(b.children[3].children[0].textContent.split("$")[1])){
            return 1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));

    });

}


//set up funtion
// this converts time from 3p format

function sortPriceDesc(){
    
    

//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

categoryClassLists.forEach(function(list){
    
    
    
    [...list.children].sort(function(a,b){
        //console.log(a.children[2].textContent.split("$")[1]);

        if(parseFloat(a.children[3].children[0].textContent.split("$")[1]) < parseFloat(b.children[3].children[0].textContent.split("$")[1])){
            return 1;
        }
        if(parseFloat(a.children[3].children[0].textContent.split("$")[1]) > parseFloat(b.children[3].children[0].textContent.split("$")[1])){
            return -1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));

    });
    
}
	
function sortRankAsc(){


//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

categoryClassLists.forEach(function(list){
    //console.log(list.children[0].children[2].children[0].textContent);
    
    
    [...list.children].sort(function(a,b){
        //console.log(a.children[2].textContent.split("$")[1]);

        if(parseFloat(a.children[2].children[0].textContent) < parseFloat(b.children[2].children[0].textContent)){
            return -1;
        }

        if(parseFloat(a.children[2].children[0].textContent) > parseFloat(b.children[2].children[0].textContent)){
            return 1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));

    });

}


//set up funtion
// this converts time from 3p format

function sortRankDesc(){
    
    

//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

categoryClassLists.forEach(function(list){
    //console.log(list.children[0].children[2].children[0].textContent);
    
    
    [...list.children].sort(function(a,b){
        //console.log(a.children[2].children[0].textContent);

        if(parseFloat(a.children[2].children[0].textContent) < parseFloat(b.children[2].children[0].textContent)){
            return 1;
        }
        if(parseFloat(a.children[2].children[0].textContent) > parseFloat(b.children[2].children[0].textContent)){
            return -1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));

    });
    
}



</script>