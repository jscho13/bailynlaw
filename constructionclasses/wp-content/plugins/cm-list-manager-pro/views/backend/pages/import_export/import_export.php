<?php

use com\cminds\listmanager\App;
use com\cminds\listmanager\plugin\services\ExportService;
use com\cminds\listmanager\plugin\services\CategoryImportService;
use com\cminds\listmanager\plugin\pages\ImportExportPage;
use com\cminds\listmanager\plugin\taxonomies\ListTaxonomy;
?>
<div class="clear"></div>
<hr />
<div class="cmlm">
    <h2 class="nav-tab-wrapper">
        <a href="#cmlm-tab-import" data-for="import" class="nav-tab">Import CSV</a>
        <a href="#cmlm-tab-export" data-for="export" class="nav-tab">Export CSV</a>
        <a href="#cmlm-tab-file-format" data-for="file-format" class="nav-tab">CSV Files Format</a>
        <a href="#cmlm-tab-category-import" data-for="category-import" class="nav-tab">Import categories</a>
    </h2>
    <div data-role="tab" data-tab="import" style="display: none;">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo ImportExportPage::NONCE; ?>" value="<?php echo wp_create_nonce(ImportExportPage::NONCE); ?>" />
            <input type="hidden" name="action" value="test" />
            <h3>Import</h3>
            <p>
                Imported CSV files should have <?php echo get_option('blog_charset'); ?> encoding and semicolon separator.
            </p>
            <p>
                For files format details go to <a href="javascript:void(0)" onclick="jQuery('a.nav-tab[data-for=\'file-format\']').click();return false;">CSV Files Format</a> tab.
            </p>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="file">CSV file *</label></th>
                    <td>
                        <input name="file" type="file" id="file" accept=".csv" required="required" />
                        <p class="description">CSV file with data.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="skip_header">Skip header</label></th>
                    <td>
                        <input type="checkbox" name="skip_header" value="1" checked="checked" />
                        <p class="description">You should check this if imported CSV file has header on first line.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label>Import to list</label></th>
                    <td>
                        <div class="cmlm-form-field-checkboxes">
                            <?php
                            $key = sprintf('%s_list', App::PREFIX);
                            $selected_lists = isset($_POST['tax_input']) && isset($_POST['tax_input'][$key]) ? $_POST['tax_input'][$key] : array();
                            wp_list_categories(array(
                                'hide_empty' => FALSE,
                                'hierarchical' => FALSE,
                                'style' => 'none',
                                'pad_counts' => 0,
                                'taxonomy' => ListTaxonomy::TAXONOMY,
                                'walker' => new Walker_Category_Checklist(),
                                'selected_cats' => $selected_lists,
                            ));
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="rewrite_links">Rewrite links in lists</label></th>
                    <td>
                        <input type="checkbox" name="rewrite_links" value="1" autocomplete="off" <?php checked(filter_input(INPUT_POST, 'rewrite_links'), 1) ?> />
                        <p class="description"><strong>Attention!</strong> All existing categories and links in the selected lists will be removed and cannot be restored. <br>Then will be created new ones from CSV. If one category with links assigned to several lists it will be deleted from all of them. If no lists selected links will be added.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Import'); ?>
            <small>* - required fields</small>
        </form>
    </div>
	
    <div data-role="tab" data-tab="category-import" style="display: none;">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo CategoryImportService::NONCE; ?>" value="<?php echo wp_create_nonce(CategoryImportService::NONCE); ?>" />
            <input type="hidden" name="action" value="<?php echo CategoryImportService::ACTION_CAT_IMPORT; ?>" />
            <h3>Import categories</h3>
            <p>
                Import categories from the blog.
            </p>
            <p>
                <input type="checkbox" name="<?php echo CategoryImportService::IMPORT_POSTS; ?>" value="false" onclick="this.value = this.checked;">Import links of blog posts.
            </p>
            <?php submit_button('Import categories'); ?>
        </form>
    </div>
	
    <div data-role="tab" data-tab="export" style="display: none;">
        <form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
            <h3>Export</h3>
            <p>
                Generated CSV files with semicolon separator have <?php echo get_option('blog_charset'); ?> encoding.
            </p>
            <p>
                For files format details go to <a href="javascript:void(0)" onclick="jQuery('a.nav-tab[data-for=\'file-format\']').click();return false;">CSV Files Format</a> tab.
            </p>
            <input type="hidden" name="<?php echo ExportService::NONCE; ?>" value="<?php echo wp_create_nonce(ExportService::NONCE); ?>" />
            <input type="hidden" name="action" value="<?php echo ExportService::ACTION_GET_CSV; ?>" />
            <?php submit_button('Download'); ?>
        </form>
    </div>

    <div data-role="tab" data-tab="file-format" style="display: none;">
        <h3>CSV Files Format</h3>
        <p>Import and export CSV files have same format.</p>
        <p>Example CSV file content ready to import:</p>
        <?php $datetime = new DateTime("now"); ?>
        <div class="cmlm-csv-table">
            <table>
                <tr>
                    <td class="header">
                        &nbsp;
                    </td>
                    <td class="header">
                        A
                    </td>
                    <td class="header">
                        B
                    </td>
                    <td class="header">
                        C
                    </td>
                    <td class="header">
                        D
                    </td>
                    <td class="header">
                        E
                    </td>
                    <td class="header">
                        F
                    </td>
                    <td class="header">
                        G
                    </td>
                    <td class="header">
                        H
                    </td>
                </tr>
                <tr>
                    <td class="header">
                        1
                    </td>
                    <td class="data">
                        category
                    </td>
                    <td class="data">
                        link-slug
                    </td>
                    <td class="data">
                        link-name
                    </td>
                    <td class="data">
                        link-url
                    </td>
                    <td class="data">
                        link-subtitle
                    </td>
                    <td class="data">
                        link-description
                    </td>
                    <td class="data">
                        tags
                    </td>
                    <td class="data">
                        link-date
                    </td>
                </tr>
                <tr>
                    <td class="header">
                        2
                    </td>
                    <td class="data">
                        General
                    </td>
                    <td class="data">
                        wordpress
                    </td>
                    <td class="data">
                        WordPress
                    </td>
                    <td class="data">
                        https://wordpress.org/
                    </td>
                    <td class="data">
                        WordPress is web software
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        WP
                    </td>
                    <td class="data">
                        <?php echo $datetime->format(App::CSV_DATE_FORMAT); ?>
                    </td>
                </tr>
                <tr>
                    <td class="header">
                        3
                    </td>
                    <td class="data">
                        Themes
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        Theme Directory
                    </td>
                    <td class="data">
                        https://wordpress.org/themes/
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        WP,Theme
                    </td>
                    <td class="data">
                        <?php echo $datetime->modify('+1 day')->format(App::CSV_DATE_FORMAT); ?>
                    </td>
                </tr>
                <tr>
                    <td class="header">
                        4
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        https://wordpress.org/about/
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        &nbsp;
                    </td>
                    <td class="data">
                        <?php echo $datetime->modify('+1 hour 25 min')->format(App::CSV_DATE_FORMAT); ?>
                    </td>
                </tr>
            </table>
            <p>
                Comments on example CSV file:
            </p>
            <ol>
                <li>
                    In first line (row <code>1</code>) is no data you want to import, so during importing this file you should mark <cite>skip header</cite> checkbox.
                </li>
                <li>
                    Category with name specified in column <code>A</code> will be created if not exists, or <strong>first matched</strong> category with this name will be assigned to link.
                </li>
                <li>
                    Row <code>2</code> has filled field <code>link-slug</code> - in this case link term with slug <cite>wordpress</cite> if exists will be updated, in other case created.
                </li>
                <li>
                    Link from row <code>3</code> without <code>link-slug</code> will be created.
                </li>
                <li>
                    Row <code>4</code> will be skipped during import because column <code>C</code> (<code>link-name</code>) is required (you can't create link without name).
                </li>
                <li>
                    Tags in column <code>G</code> (<code>tags</code>) are commma separated and created if needed (same as categories).
                </li>
                <li>
                    Dates in column <code>H</code> (<code>link-date</code>) is date in format <?php echo App::CSV_DATE_FORMAT; ?> (<?php echo $datetime->format(App::CSV_DATE_FORMAT); ?>) for the link (not mandatory). If date format in csv will be wrong no date will be saved with the link.
                </li>
            </ol>
        </div>
    </div>
</div>

<style type="text/css">
    .cmlm .cmlm-csv-table table{
        border-spacing: 0;
        font-size: 10px;
        border-bottom: 1px solid #ccc;
        border-right: 1px solid #ccc;
    }
    .cmlm .cmlm-csv-table td{
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        padding: 2px;
    }
    .cmlm .cmlm-csv-table .header{
        text-align: center;
    }
    .cmlm .cmlm-csv-table .data{
        background: #fff;
    }
    .cmlm .form-table-inline{
        width: auto;
    }
    .cmlm .form-table-inline th, td{
        width: auto;
    }
    .cmlm .form-table-inline .description{
        display: inline;
    }
    .cmlm h2.nav-tab-wrapper{
        margin-top: 20px;
    }
    .cmlm .nav-tab{
        box-shadow: none;
    }
    .cmlm .card{
        max-width: none;
    }
</style>
<script type="text/javascript">
    (function ($) {
        "use strict";
        $('.cmlm .nav-tab').on('click', function () {
            $('.cmlm .nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.cmlm *[data-role="tab"]').hide();
            $('.cmlm *[data-role="tab"][data-tab="' + $(this).data('for') + '"]').show();
        });
        if ($('.cmlm a[href="' + window.location.hash + '"]').click().length != 1) {
            $('.cmlm a.nav-tab').first().click();
        }
//        $('.cmlm input[type="submit"]').on('click', function () {
//            if ($('.cmlm form').find(':invalid')) {
//                var tab = $('.cmlm form').find(':invalid').first().parents('*[data-role="tab"]').data('tab');
//                $('.cmlm').find('a[data-for="' + tab + '"]').click();
//            }
//        });
    })(jQuery);
</script>