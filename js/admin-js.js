jQuery(document).ready( function($){
	
	var mediaUploader;
	var attachments;
	var imageUrls ='';
 $(document).on('click', '#upload-file-button', function(e)  {
		e.preventDefault();
		if( mediaUploader ){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Certificate PDF',
			button: {
				text: 'Choose PDF'
			},
			multiple: false
		});
		
		mediaUploader.on('select', function(){
			attachments = mediaUploader.state().get('selection').first().toJSON();
			$('#student_certificate').val(attachments.url);
			console.log(imageUrls)
		});
		
		mediaUploader.open();
			
	});
	
$(document).on("click", "#generate-pass-button",function(e) {
	  e.preventDefault();
	 $('#lf-loading-image').fadeToggle('fast');
	
			$.ajax({
    type: 'POST',
    url: '/education/wp-admin/admin-ajax.php',
    dataType: 'text',
    data: {
      action: 'generatePass',
		main: 'success',
    },
    success: function(res) {
         $('#lf-loading-image').fadeToggle('fast');
      $('#passsword-show').val(res);
		}
  });

});
	
	
	
	
	
	
	
});