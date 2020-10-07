jQuery(document).ready( function($){

 $(document).on('click', '#unlock-files', function(e)  {
		e.preventDefault();
		 $('#lf-loading-file').fadeToggle('fast');
	var student_id = $('#lf-student-id').val();
	var student_pass = $('#lf-pass').val();
	
			$.ajax({
    type: 'POST',
    url: '/education/wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'get_student_file',
      studentId: student_id,
	  studentPass: student_pass,
    },
    success: function(res) {
         $('#lf-loading-file').fadeToggle('fast');
    $('.lf-file-container').fadeIn('fast');
     $('.lf-file-container').html(res);
	
		}
  });
});


 $(document).on('click', '#check-user', function(e)  {
		e.preventDefault();
		 $('#lf-loading-check').fadeToggle('fast');
	var check_id = $('#lf-student-id-check').val();
			$.ajax({
    type: 'POST',
    url: '/education/wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'check_student_file',
      check_studentId: check_id,
    },
    success: function(res) {
    $('#lf-loading-check').fadeToggle('fast');
    $('.lf-check-result').fadeIn('fast');
    $('.lf-check-result').html(res);
	
		}
  });
});



});