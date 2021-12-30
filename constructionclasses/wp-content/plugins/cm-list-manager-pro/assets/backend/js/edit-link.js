(function ($) {
        $(function () {
            $('#edittag .term-subtitle-wrap').prependTo('#edittag table tbody');
            $('#edittag .term-name-wrap').prependTo('#edittag table tbody');
        });

	$(document).ready(function() {
		var tagFileWrappers = $("[id^='tagfile_wrapper_']");
		for ( let i = 1; i < $(tagFileWrappers).length; i++) {
			var val = $(tagFileWrappers[i]).find('[id$="-url"]')[0].value;
			if ( val == "" ) {
				$(tagFileWrappers[i]).addClass('hidden');
			} else {
				if ( i == $(tagFileWrappers).length - 1 ) {
					$("#tagfile-btn-add").addClass('hidden');
				}
			}
		}
		
		$(tagFileWrappers).each(function() {
			var wrp = $(this);
			var tagf = wrp.find('[id$="-url"]')[0];
			insert_icon(tagf);
			$(tagf).on('change', function(){
				insert_icon(this);
				let file_url = $(this).val();
				let ind = file_url.lastIndexOf('/'); 
				$(this).parent().children('[id$="-name"]').val( file_url.substr(ind + 1) );
			});
			
		});
		$("#tagfile-btn-add").on('click', function() {
			$(tagFileWrappers).closest('.hidden').first().removeClass('hidden');
			if ( $(tagFileWrappers).closest('.hidden').length == 0 ) {
				$(this).addClass('hidden');
			}
		});
	});
	function insert_icon(tagf) {
		var exts = ['doc', 'docx', 'log', 'txt', 'wps', 'csv', 'dat', 'ppt', 'xml', 'mp3', 'wav', 'avi', 'mov', 'mp4', '3ds', 'max', 'gif', 'ai', 'svg', 'pdf', 'xls', 'xlsx', 'sql', 'exe', 'js', 'html', 'xhtml', 'css', 'asp', 'ttf', 'dll', '7z', 'zip', 'c', 'cs', 'java', 'jpg', 'torrent', 'php', 'hh', 'go', 'py', 'rss', 'file'];
		var file_name = tagf.value;
		if ( file_name.length > 0 ) {
			var ind = file_name.lastIndexOf(".");
			var ext = file_name.substr(ind + 1);
			console.log("ext: "+ext);
			if ( exts.indexOf(ext) < 0 ) {
				ext = 'file';
			}
			var icon = '<div class="fi fi-' + ext + '"><div class="fi-content">'+ ext + '</div></div>';
			console.log("icon: "+icon);
			var cont = $(tagf).closest('tr').find('div[class^="fi "]').remove();
			$(tagf).closest('tr').find('th').append(icon);
		}
		return true;
	}
	
	$('.upload_file_button').click(function() {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		wp.media.editor.send.attachment = function(props, attachment) {
			$(button).parent().find('[id$="-url"]').val(attachment.url).trigger('change');
			var title = attachment.title;
			var ind = title.lastIndexOf('.');
			title = title.substr(0, ind);
			$(button).parent().find('[id$="-name"]').val(title);
	//        wp.media.editor.send.attachment = send_attachment_bkp;
		}
		wp.media.editor.open(button);
		return false;
		
	});
	$('.upload_url_button').click(function() {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		wp.media.editor.send.attachment = function(props, attachment) {
			$(button).parent().find('#term-url').val(attachment.url);
	//        wp.media.editor.send.attachment = send_attachment_bkp;
		}
		wp.media.editor.open(button);
		return false;
		
	});



})(jQuery);
