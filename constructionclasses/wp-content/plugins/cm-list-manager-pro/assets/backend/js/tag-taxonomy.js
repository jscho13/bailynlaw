( function ( $ ) {

    $( function () {
        $( document ).ajaxSuccess( function ( event, xhr, settings ) {
            if ( settings.data.match( /action=add-tag/ ) && !xhr.responseText.match( /wp_error/ ) ) {
                $( '#term-color' ).wpColorPicker( 'color', '#FFFFFF' );
            }
            jQuery('.form-invalid').removeClass('form-invalid');
        } );
    } );

} )( jQuery );

validateForm = function ( form ) {
    return !jQuery( form )
        .find( '.form-required' )
        .filter( function () {
            return jQuery( ':input:not([type=button])', this ).val() === '';
        } )
        .addClass( 'form-invalid' )
        .find( ':input:visible' )
        .change( function () {
            jQuery( this ).closest( '.form-invalid' ).removeClass( 'form-invalid' );
        } )
        .length;
};

inlineEditTax.cmlmedit = inlineEditTax.edit;


inlineEditTax.edit = function ( id ) {
    var tag_id = id;
    if ( typeof ( tag_id ) === 'object' ) {
        tag_id = this.getId( tag_id );
    }

    inlineEditTax.cmlmedit( id );

    var val = jQuery( 'td.cmlm_color', '#tag-' + tag_id ).text();
    val = val ? val : '#FFFFFF';

    //jQuery(':input[name="slug"]', '#edit-' + tag_id).closest('label').hide();

    jQuery( ':input[name="cmlm_color"]', '#edit-' + tag_id ).wpColorPicker();
    jQuery( ':input[name="cmlm_color"]', '#edit-' + tag_id ).wpColorPicker( 'color', val );

    return false;

};
