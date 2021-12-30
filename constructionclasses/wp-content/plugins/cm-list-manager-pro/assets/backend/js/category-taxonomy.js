(function ($) {

    $(function () {
        $(document).ajaxSuccess(function (event, xhr, settings) {
            if (settings.data.match(/action=add-tag/) && !xhr.responseText.match(/wp_error/)) {
                $('input[name="tax_input[cmlm_list][]"]').removeAttr('checked');
                $('#term-color').wpColorPicker('color', '#FFFFFF');
                $('#term-color').val('');
                $('#parent').val('-1');
            }
        });
    });

})(jQuery);