<?php
global $post;
add_shortcode( 'locked-files', 'lf_post_parameters_shortcode' );
function lf_post_parameters_shortcode() {
    ob_start();
    ?>
    <div class="lf-row check-user-wrap">
        <h1 class="lf-heading">Check The Certificate Validity</h1>
        <div class="locked-student-id-wrap">
	        <input type="text" id="lf-student-id-check" name="lf-student-id-check" placeholder="Student Id" required>
	    </div>
	    <button id="check-user">Check</button>
	    
	    <div class="lf-results lf-check-result"></div>
	    <div id="lf-loading-check"></div>
    </div>
    
<div class="lf-row locked-user-wrap">
     <h1 class="lf-heading">Get Your Certificate</h1>
	<div class="locked-student-id-wrap">
	     <input type="text" id="lf-student-id" name="lf-student-id" placeholder="Student Id" required>
	    <input type="password" id="lf-pass" name="lf-pass" minlength="8" maxlength="8" placeholder="Password" required>
	</div>
	<button id="unlock-files">Login</button>
	
	<div class="lf-results lf-file-container"></div>
	<div id="lf-loading-file"></div>
</div>

    <?
}


function get_student_file(){
    $lf_studentId =  $_POST['studentId'];
	$lf_studentPass =  $_POST['studentPass'];
	$found_student = post_exists(  $lf_studentId,'','','lockedfiles');
 if($found_student){
     	$thisStudentPass = get_post_meta( $found_student, 'passsword-show', true );
     	if($lf_studentPass == $thisStudentPass){
     	    $lf_studentCert =  get_post_meta( $found_student, 'student_certificate', true );
     	    echo '<a class="lf-download-file" href="'.$lf_studentCert.'" download>Download Your Certificate</a>';
     	}
     	else{
     	    echo "Pasword Incorrect!!!!";
     	}
 } 
 else{
     echo "Student Not Found!!!!!!";
 }

		wp_die();
    
}

add_action('wp_ajax_get_student_file', 'get_student_file');
add_action('wp_ajax_nopriv_get_student_file', 'get_student_file');



function check_student_file(){
    $lf_check_studentId =  $_POST['check_studentId'];
	$check_student = post_exists(  $lf_check_studentId,'','','lockedfiles');
 if($check_student){
     echo "Verified!!!";
 } 
 else{
     echo "Not Verified!!!!";
 }

		wp_die();
    
}

add_action('wp_ajax_check_student_file', 'check_student_file');
add_action('wp_ajax_nopriv_check_student_file', 'check_student_file');