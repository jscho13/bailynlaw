<?php



namespace com\cminds\listmanager\plugin\frontend\walkers;



use com\cminds\listmanager\App;

use com\cminds\listmanager\plugin\taxonomies\TagTaxonomy;

use com\cminds\listmanager\plugin\taxonomies\LinkTaxonomy;

use com\cminds\listmanager\plugin\options\Options;

use com\cminds\listmanager\plugin\frontend\walkers\LinkWalker;



class LinkWalkerConstructionclassesorg extends LinkWalker {



    private static $extensions = array(

        'Document'     => array(

            'doc', 'docx', 'log', 'txt', 'wps', 'csv', 'xml', 'pdf', 'xls', 'xlsx'

        ),

        'Archive'      => array(

            '7z', 'zip', 'rar'

        ),

        'Audio'        => array(

            'mp3', 'wav', 'avi', 'ai'

        ),

        'Video'        => array(

            'avi', 'mov', 'mp4'

        ),

        'Presentation' => array('ppt'),

        'Image'        => array(

            'gif', 'svg', 'jpg', 'bmp', 'png', 'jpeg', 'psd', 'ico'

        ),

    );

    private $show_tags = false;





    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {

        $meta = get_term_meta($category->term_id);

        $url = isset($meta[sprintf('%s_url', App::PREFIX)]) ? $meta[sprintf('%s_url', App::PREFIX)][0] : NULL;

        $subtitle = isset($meta[sprintf('%s_subtitle', App::PREFIX)]) ? $meta[sprintf('%s_subtitle', App::PREFIX)][0] : NULL;

        $tagfile1_name = isset($meta[sprintf('%s_tagfile1_name', App::PREFIX)]) ? $meta[sprintf('%s_tagfile1_name', App::PREFIX)][0] : NULL;

        $tagfile1_url = isset($meta[sprintf('%s_tagfile1_url', App::PREFIX)]) ? $meta[sprintf('%s_tagfile1_url', App::PREFIX)][0] : "empty meta";

        $tagfile2_name = isset($meta[sprintf('%s_tagfile2_name', App::PREFIX)]) ? $meta[sprintf('%s_tagfile2_name', App::PREFIX)][0] : NULL;

        $tagfile2_url = isset($meta[sprintf('%s_tagfile2_url', App::PREFIX)]) ? $meta[sprintf('%s_tagfile2_url', App::PREFIX)][0] : NULL;

        $tagfile3_name = isset($meta[sprintf('%s_tagfile3_name', App::PREFIX)]) ? $meta[sprintf('%s_tagfile3_name', App::PREFIX)][0] : NULL;

        $tagfile3_url = isset($meta[sprintf('%s_tagfile3_url', App::PREFIX)]) ? $meta[sprintf('%s_tagfile3_url', App::PREFIX)][0] : NULL;

        $image_url = isset($meta[sprintf('%s_image_url', App::PREFIX)]) ? $meta[sprintf('%s_image_url', App::PREFIX)][0] : NULL;

        $video_url = isset($meta[sprintf('%s_video_url', App::PREFIX)]) ? $meta[sprintf('%s_video_url', App::PREFIX)][0] : NULL;

        $create_time = isset($meta[sprintf('%s_create_time', App::PREFIX)]) ? intval($meta[sprintf('%s_create_time', App::PREFIX)][0]) : 0;

        $edit_time = isset($meta[sprintf('%s_edit_time', App::PREFIX)]) ? intval($meta[sprintf('%s_edit_time', App::PREFIX)][0]) : 0;

        $show_checkbox = isset($meta[sprintf('%s_show_checkbox', App::PREFIX)]) ? intval($meta[sprintf('%s_show_checkbox', App::PREFIX)][0]) : 0;

        //adding in price im not sure where this price is showing up at
        $price = isset($meta[sprintf('%s_price', App::PREFIX)]) ? intval($meta[sprintf('%s_price', App::PREFIX)][0]) : 0;

        //adding in rank im not sure where this rank is showing up at
        $rank = isset($meta[sprintf('%s_rank', App::PREFIX)]) ? intval($meta[sprintf('%s_rank', App::PREFIX)][0]) : 0;

        $link_wordwrap = Options::getOption('link_word_break');

        $favicon = $this->metaToFavicon($meta, $category->term_id);

        $tag_id_arr = $this->metaToTagIdArr($meta);



        if(isset($meta[sprintf('%s_date', App::PREFIX)])){

            $ts = $meta[sprintf('%s_date', App::PREFIX)][0];

            $date = $ts ? date_i18n(App::getWpDateFormat(), $ts, false) : false;

        }else{

            $date = false;

        }



        if (!$url && $show_checkbox) {

            $favicon = NULL;

        }



        if ($edit_time + Options::getOption('new_tag_duration') > time()) {

            $tag_id_arr [] = Options::getOption('new_tag_id');

        }



        $rel_nofollow = '';

        if (Options::getOption('links_rel_nofollow')) {

            $rel_nofollow = 'rel="nofollow"';

        }



        $target = '';

        if (Options::getOption('links_target_blank')) {

            $target = 'target="_blank"';

        }



        //Options::getOption('show_checkboxes')

        if ($show_checkbox) {

            $output .= '<li class="cmlm-category-link-list-entry cmlm-checkboxes">';

            $output .= sprintf('<span class="cmlm-link-checkbox"><input type="checkbox" name="cmlm_link_checkbox[]" data-id="%s" /></span>', $category->term_id);

        } else {

            $output .= '<li class="cmlm-category-link-list-entry">';

        }



        $css_class = 'cmlm-link';

        if (isset($link_wordwrap)) {

            switch ($link_wordwrap) {

                case 'break-all':

                    $css_class .= ' wb-ba';

                    break;

                case 'keep-all':

                    $css_class .= ' wb-ka';

                    break;

                case 'normal':

                    $css_class .= ' wb-nr';

                    break;

                case 'break-word':

                default:

                    $css_class .= ' wb-bw';

            }

        } else {

            $css_class .= ' wb-bw';

        }

        if (!$favicon) {

            $css_class .= ' cmlm-no-favicon';

        }

        $output .= sprintf('<a href="%s" class="%s" title="%s" %s %s data-create-time="%s" data-edit-time="%s">', $url, $css_class, esc_attr($category->description), $rel_nofollow, $target, $create_time, $edit_time);



        if ($favicon) {

            $output .= sprintf('<img src="%s" alt="%s" class="cmlm-favicon" />', $favicon, 'item favicon');

        }

        $output .= $category->name;

        if ($this->show_tags && count($tag_id_arr) > 0) {

            $items = get_terms(TagTaxonomy::TAXONOMY, array(

                'hide_empty'   => FALSE,

                'hierarchical' => FALSE,

                'include'      => implode(',', $tag_id_arr)

            ));

            $output .= ' ';

            $output .= implode(' ', array_map(function($item) {

                        $color = get_term_meta($item->term_id, sprintf('%s_color', App::PREFIX), TRUE);

                        return sprintf('<span class="cmlm-tag" style="background: %s" data-id="%s">%s</span>', $color, $item->term_id, $item->name);

                    }, $items));

        }



        if ($image_url) {

            $output .= sprintf('<img src="%s" class="cmlm-link-image" alt="%s" />', $image_url, $category->name . 'item image');

        }



        if ($video_url) {

            $output .= sprintf('<iframe src="%s" class="cmlm-link-video" ' . $this->getVideoWidth() . ' ' . $this->getVideoHeight() . ' frameborder="0" allowfullscreen></iframe>', $this->getVideoSrc($video_url));

        }

        $output .= '</a>';



        // Event Datetime

        if (Options::getOption('show_event_date') && $date) {

            // hook for constructionclasses.org 

            // if dates and times in column "link-date" of the imported csv not in one format

            // use time string after "@" from subtitles

            $time_str = "";

            if($subtitle){

                $ar = explode("@", $subtitle);

                $day = isset($ar[0]) ? $ar[0] : "";

                $time_str = isset($ar[1]) ? $ar[1] : "";

                //remove the EST and et this will allow me to sort the list in js

                $time_str_without_est_ar = explode("E", $time_str);

                //print_r($time_str_without_est_ar);

                $time_str_without_est = isset($time_str_without_est_ar[0]) ? $time_str_without_est_ar[0] : "";
                //echo print_r($ar);
                //echo $time_str_without_est;

                //exit;

            }

            //$datetime = $date . ( $time_str ? " @ " . $time_str : "");

            //$datetime = $date . ( $time_str ?  $time_str : "");

            $datetime = $day . ( $time_str_without_est ? " @ " . $time_str_without_est : "");

            //$datetime = $date;

            $output .= sprintf('<p class="cmlm-link-event-date">%s</p>', $datetime );

        }

        //Add in Rank
        $output .= sprintf('<p class="cmlm-link-rank">Popularity Rank: <span>%s </span></p>', $rank );
        //Add in Price
        $output .= sprintf('<p class="cmlm-link-price">Price: <span>$%s.00 </span></p>', $price );




        // Tags >

		$show_tagfile_icons = Options::getOption('show_tagfile_icon');

		if ( !$show_tagfile_icons ) {

			$output .= '<div class="tag-link-wrapper">';

		}

        if ($tagfile1_name && $tagfile1_url) {

        	$tagfile1_bg_color = Options::getOption('tagfile1_link_background_color') ? Options::getOption('tagfile1_link_background_color') : "#fff";

            $ext = substr(strrchr($tagfile1_url, "."), 1);

        	if ( $show_tagfile_icons ) {

        		$icon_name = self::get_icon_name($ext);

        		$output .= sprintf('<div class="tag-link-wrapper"><div class="cmlm-tagfile-link-wrap" style="background-color: %s;"><a class="cmlm-link" href="%s" target="_blank">%s</a></div><img src="%s" class="cmlm-tag-icon"></div>', $tagfile1_bg_color, $tagfile1_url, $tagfile1_name, plugins_url('assets/img/' . $icon_name . '.png', App::PLUGIN_FILE));

        	} else {

        		$output .= sprintf( '<div class="cmlm-tagfile-link-wrap" style="background-color: %s; display: inline-block !important; width: auto !important;"><a class="cmlm-link" href="%s" target="_blank">%s</a></div>', $tagfile1_bg_color, $tagfile1_url, $tagfile1_name );

        	}

        }

        if ($tagfile2_name && $tagfile2_url) {

        	$tagfile2_bg_color = Options::getOption('tagfile2_link_background_color') ? Options::getOption('tagfile2_link_background_color') : "#fff";

            $ext = substr(strrchr($tagfile2_url, "."), 1);

        	if ( $show_tagfile_icons ) {

        		$icon_name = self::get_icon_name($ext);

        		$output .= sprintf('<div class="tag-link-wrapper"><div class="cmlm-tagfile-link-wrap" style="background-color: %s;"><a class="cmlm-link" href="%s" target="_blank">%s</a></div><img src="%s" class="cmlm-tag-icon"></div>', $tagfile2_bg_color, $tagfile2_url, $tagfile2_name, plugins_url('assets/img/' . $icon_name . '.png', App::PLUGIN_FILE));

        	} else {

        		$output .= sprintf( '<div class="cmlm-tagfile-link-wrap" style="background-color: %s; display: inline-block !important; width: auto !important;"><a class="cmlm-link" href="%s" target="_blank">%s</a></div>', $tagfile2_bg_color, $tagfile2_url, $tagfile2_name );

        	}

        }



        if ($tagfile3_name && $tagfile3_url) {

        	$tagfile3_bg_color = Options::getOption('tagfile3_link_background_color') ? Options::getOption('tagfile3_link_background_color') : "#fff";

            $ext = substr(strrchr($tagfile3_url, "."), 1);

        	if ( $show_tagfile_icons ) {

        		$icon_name = self::get_icon_name($ext);

        		$output .= sprintf('<div class="tag-link-wrapper"><div class="cmlm-tagfile-link-wrap" style="background-color: %s;"><a class="cmlm-link" href="%s" target="_blank">%s</a></div><img src="%s" class="cmlm-tag-icon"></div>', $tagfile3_bg_color, $tagfile3_url, $tagfile3_name, plugins_url('assets/img/' . $icon_name . '.png', App::PLUGIN_FILE));

        	} else {

        		$output .= sprintf( '<div class="cmlm-tagfile-link-wrap" style="background-color: %s; display: inline-block !important; width: auto !important;"><a class="cmlm-link" href="%s" target="_blank">%s</a></div>', $tagfile3_bg_color, $tagfile3_url, $tagfile3_name );

        	}

        }

		if ( !$show_tagfile_icons ) {

			$output .= '</div>';

		}

        // < Tags



        if (Options::getOption('link_social_buttons')) {

            $twitterURL = 'https://twitter.com/intent/tweet?text=' . $category->name . '&amp;url=' . $url;

            $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;

            $googleURL = 'https://plus.google.com/share?url=' . $url;

            $bufferURL = 'https://bufferapp.com/add?url=' . $url . '&amp;text=' . $category->name;

            //	$whatsappURL = 'whatsapp://send?text='.$category->name . ' ' . $url;

            $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&amp;title=' . $category->name;

            $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $url . '&amp;media=' . $image_url . '&amp;description=' . $category->name;

            $redditURL = 'https://www.reddit.com/submit?url=' . $url;

            $tumblURL = 'http://www.tumblr.com/share/link?url=' . $url . '&amp;name=' . $category->name;



			// $output .= '<div class="cmlm-social-wrapper><div class="cmlm-social-share-btn" style="background-image:url(' . plugins_url( 'assets/img/share-social-icon.png', App::PLUGIN_FILE ) . ');" ></div>';

            

            $social_wrapper_class = "cmlm-social-wrapper " .

                    ( intval(Options::getOption('link_social_buttons_in_new_line')) ? ' newline ' : '') .

                    ( intval(Options::getOption('link_social_buttons_expand_on_hover')) ? ' onhover ' : '');



            $output = $output . '<div class="' . $social_wrapper_class . '"><div class="cmlm-social-share-btn"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"></path></svg></div>';

            $output .= '<div class="cmlm-social">';



            if (Options::getOption('link_social_facebook')) {

                $output .= '<a class="cmlm-share-btn cmlm-facebook" href="' . $facebookURL . '" target="_blank"><img src="' . plugins_url('assets/img/facebook.png', App::PLUGIN_FILE) . '" ></a>';

            }

            if (Options::getOption('link_social_twitter')) {

                $output .= '<a class="cmlm-share-btn cmlm-twitter" href="' . $twitterURL . '" target="_blank"><img src="' . plugins_url('assets/img/twitter.png', App::PLUGIN_FILE) . '" ></a>';

            }

            if (Options::getOption('link_social_linkedin')) {

                $output .= '<a class="cmlm-share-btn cmlm-linkedin" href="' . $linkedInURL . '" target="_blank"><img src="' . plugins_url('assets/img/linkedin.png', App::PLUGIN_FILE) . '" ></a>';

            }

            if (Options::getOption('link_social_pinterest')) {

                $output .= '<a class="cmlm-share-btn cmlm-pinterest" href="' . $pinterestURL . '" data-pin-custom="true" target="_blank"><img src="' . plugins_url('assets/img/pinterest.png', App::PLUGIN_FILE) . '" ></a>';

            }

            if (Options::getOption('link_social_reddit')) {

                $output .= '<a class="cmlm-share-btn cmlm-reddit" href="' . $redditURL . '" target="_blank"><img src="' . plugins_url('assets/img/reddit.png', App::PLUGIN_FILE) . '" ></a>';

            }

            if (Options::getOption('link_social_tumblr')) {

                $output .= '<a class="cmlm-share-btn cmlm-tumblr" href="' . $tumblURL . '" target="_blank"><img src="' . plugins_url('assets/img/tumblr.png', App::PLUGIN_FILE) . '" ></a>';

            }

            if (Options::getOption('link_social_buffer')) {

                $output .= '<a class="cmlm-share-btn cmlm-buffer" href="' . $bufferURL . '" target="_blank"><img src="' . plugins_url('assets/img/buffer.png', App::PLUGIN_FILE) . '" ></a>';

            }

            $output .= '</div></div>';

        }



        if (Options::getOption('link_show_subtitle') && $subtitle) {

            $output .= sprintf('<span class="cmlm-link-subtitle">%s</span>', $subtitle);

        }



        // Show Like option

        if ('1' == Options::getOption('link_like_button')) {

            $output .= '<div class="cmlm-like-wrapper">';



            $showButton = $this->showLikeButton($category->term_id);

            if ($showButton) {

                $output .= sprintf('<a href="#" class="cmlm-like-btn" data-link-id="%s" data-like-status="1" data-ip-address="%s">Like</a>', $category->term_id, $currentIp);

            }

            $output .= sprintf('<img src="' . plugins_url('assets/img/like.png', App::PLUGIN_FILE) . '" class="cmlm-like-btn-img" width="18"><span>%s</span></div>', $this->likeCount($category->term_id));

        }

        // Show Upvote/downvote option

        else if ('2' == Options::getOption('link_like_button')) {



            $output .= '<div class="cmlm-like-wrapper">';

            $currentIp = $this->getIpAddress();

            $canVote = LinkTaxonomy::canVoteOnLink($category->term_id);

            $linkscore = isset($meta[sprintf('%s_linkscore', App::PREFIX)]) ? $meta[sprintf('%s_linkscore', App::PREFIX)][0] : 0;



            if ($canVote) {

                $thumbsup = sprintf('<span data-link-id="%s" data-ip-address="%s" class="cmlm-vote cmlm-thumbsup dashicons dashicons-thumbs-up"></span>', $category->term_id, $currentIp);

                $thumbsdown = sprintf('<span data-link-id="%s" data-ip-address="%s" class="cmlm-vote cmlm-thumbsdown dashicons dashicons-thumbs-down"></span>', $category->term_id, $currentIp);

            } else {

                $thumbsup = '<span disabled="disabled" class="disabled cmlm-vote cmlm-thumbsup dashicons dashicons-thumbs-up"></span>';

                $thumbsdown = '<span disabled="disabled" class="disabled cmlm-vote cmlm-thumbsdown dashicons dashicons-thumbs-down"></span>';

            }

            $score = sprintf('<span class="cmlm_score_count" data-link-id="%s">%s</span>', $category->term_id, $linkscore);



            $output .= sprintf(' %s %s %s', $thumbsup, $thumbsdown, $score);

            $output .= '</div>';

        }



        if (current_user_can('manage_options')) {

            $deleteurl = wp_nonce_url(admin_url("edit-tags.php?action=delete&amp;taxonomy={$category->taxonomy}&amp;tag_ID=$category->term_id"), 'delete-tag_' . $category->term_id);

            $deleteconfirm = "onclick='return confirm(\"Are you sure you want to delete this link?\")'";

            $editlink = sprintf('<a target="_blank" class="nostyling" title="' . __('Edit link') . '" href="%s">%s</s>', get_edit_term_link($category->term_id), '<span class="dashicons dashicons-admin-tools"></span>');

            $deletelink = sprintf(

                    '<a href="%s" %s class="nostyling delete-tag aria-button-if-js" aria-label="%s">%s</a>',

                    $deleteurl,

                    $deleteconfirm,

                    esc_attr(sprintf(__('Delete &#8220;%s&#8221;'), $category->name)),

                    '<span title="' . __('Delete link') . '" class="dashicons dashicons-no"></span>');

        } else {

            $editlink = '';

            $deletelink = '';

        }

        $output .= sprintf(' %s %s', $editlink, $deletelink);

    }





    private function metaToFavicon($meta, $term_id) {

        if (Options::getOption('favicons_display')) {

            $key = sprintf('%s_favicon_attachment', App::PREFIX);

            if (Options::getOption('favicons_local_cache') && (isset($meta[$key]))) {

                $res = wp_get_attachment_url(intval($meta[$key][0]));

                return $res;

            } else {

                $url = isset($meta[sprintf('%s_url', App::PREFIX)]) ? $meta[sprintf('%s_url', App::PREFIX)][0] : NULL;

                if (!$url) {

                    $url = 'localhost';

                } else {

                    $ext = substr(strrchr($url, "."), 1);

                    $icon_name = self::get_icon_name($ext);

                    if ($icon_name !== 'Service') {

                        return plugins_url('assets/img/' . $icon_name . '.png', App::PLUGIN_FILE);

                    }

                    $favicon = sprintf('https://www.google.com/s2/favicons?domain_url=%s', urlencode($url));

                    return $favicon;

                }

            }

        } else {

            return NULL;

        }

    }



    private function metaToTagIdArr($meta) {

        $key = sprintf('%s_tag', App::PREFIX);

        $res = array();

        if (isset($meta[$key])) {

            $res = $meta[$key];

        }

        return $res;

    }

}

