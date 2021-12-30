(function ($) {

    $(function () {
        $('#term-access-list').on('change', function () {
            if ( $(this).val() == 'selected_roles' ) {
                $('#cmlm_roles_list').show();
            } else {
                $('#cmlm_roles_list').hide();
			}
        });
    });

})(jQuery);