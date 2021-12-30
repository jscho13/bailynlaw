<?php

namespace com\cminds\listmanager\plugin\misc;

use com\cminds\listmanager\plugin\helpers\ViewHelper;

class Bookmarklet {

    public static function getShortcutLink() {
        $src = ViewHelper::load('assets/backend/js/bookmarklet.min.js');
        $url = wp_json_encode(admin_url('edit-tags.php?taxonomy=cmlm_link&source=bookmarklet'));
        $link = 'javascript:' . str_replace('window.pt_url', $url, $src);
        return $link;
    }

}
