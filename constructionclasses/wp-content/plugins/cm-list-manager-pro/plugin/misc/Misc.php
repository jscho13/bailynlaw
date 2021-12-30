<?php

namespace com\cminds\listmanager\plugin\misc;

class Misc {

    public static function update_term_meta_array($term_id, $key, $value) {
        $meta = get_term_meta($term_id, $key);
        foreach ($value as $item) {
            if (!in_array($item, $meta)) {
                add_term_meta($term_id, $key, $item);
            }
        }
        foreach ($meta as $item) {
            if (!in_array($item, $value)) {
                delete_term_meta($term_id, $key, $item);
            }
        }
    }

    public static function invisibleChunkSplit($s, $i = 20) {
        return chunk_split(esc_html($s), $i, '​'); // U+200B - ZERO WIDTH SPACE
    }

}
