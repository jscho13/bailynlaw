(function (window, document, href, pt_url) {
    var encURI = window.encodeURIComponent,
            target = '_cmlm_press_this_app',
            selection;

    if (!pt_url) {
        return;
    }

    if (window.getSelection) {
        selection = window.getSelection() + '';
    } else if (document.getSelection) {
        selection = document.getSelection() + '';
    } else if (document.selection) {
        selection = document.selection.createRange().text || '';
    }

    pt_url += '&url=' + encURI(href);
    pt_url += '&name=' + encURI(document.title.substr(0, 256));
    if (selection) {
        pt_url += '&description=' + encURI(selection.substr(0, 512));
    }
    pt_url += '&buster=' + (new Date().getTime());

    var windowWidth = 675;
    var windowHeight = 500;

    window.open(pt_url, target, 'location,resizable,scrollbars,width=' + windowWidth + ',height=' + windowHeight);
    return;
})(window, document, top.location.href, window.pt_url);