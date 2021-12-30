<?php

namespace com\cminds\listmanager\plugin\helpers;

use com\cminds\listmanager\App;

class HTMLHelper {

    public static function inputColor($name, $value = '#FFFFFF', $arr = array()) {
        if (isset($arr['class'])) {
            $arr['class'] = $arr['class'] . ' cmlm-input-color';
        } else {
            $arr['class'] = 'cmlm-input-color';
        }
        $arr = array_merge(array(
            'size' => '40',
            'aria-required' => 'false',
            'id' => uniqid('id')
                ), $arr);
        array_walk($arr, function(&$v, $k) {
            $v = sprintf('%s="%s"', $k, $v);
        });
        return sprintf('<input name="%s" type="text" value="%s" %s />', $name, esc_attr($value), implode(' ', $arr));
    }

    public static function enqueueInputColorAssets() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('cmlm-backend-color-picker', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/color-picker.js', array('wp-color-picker'), App::version());
    }

    public static function inputFontSize($name, $value = NULL, $arr = array()) {
        $arr = array_merge(array(
            'placeholder' => 'e.g. 16px or 1.1em',
            'size' => '40',
            'aria-required' => 'false',
            'id' => uniqid('id')
                ), $arr);
        array_walk($arr, function(&$v, $k) {
            $v = sprintf('%s="%s"', $k, $v);
        });
        return sprintf('<input name="%s" type="text" value="%s" %s />', $name, esc_attr($value), implode(' ', $arr));
    }

    public static function enqueueInputDateAssets() {
        wp_enqueue_style('pickmeup-css', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/css/pickmeup.css', false, App::version());
        wp_enqueue_script('pickmeup-date-picker', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/pickmeup.min.js', array('jquery'), App::version());
        wp_enqueue_script('cmlm-backend-date-picker', plugin_dir_url(App::PLUGIN_FILE) . 'assets/backend/js/date-picker.js', array('pickmeup-date-picker'), App::version());
    }

    public static function inputDate($name, $value = '', $arr = array()) {
        if (isset($arr['class'])) {
            $arr['class'] = $arr['class'] . ' cmlm-input-date';
        } else {
            $arr['class'] = 'cmlm-input-date';
        }
        $arr = array_merge(array(
            'size' => '40',
            'aria-required' => 'false',
            'id' => uniqid('id')
                ), $arr);
        array_walk($arr, function(&$v, $k) {
            $v = sprintf('%s="%s"', $k, $v);
        });
        return sprintf('<input name="%s" type="text" value="%s" %s />', $name, esc_attr($value), implode(' ', $arr));
    }

}
