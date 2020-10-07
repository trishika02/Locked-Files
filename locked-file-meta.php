<?php
function lf_add_custom_meta() {
    add_meta_box(
      'lf_meta',
      __('Student Files'),
      'lf_meta_callback',
      'lockedfiles',
      'normal',
      'high'
    );
}

add_action( 'add_meta_boxes', 'lf_add_custom_meta' );

function lf_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'locked_file_nonce' );
	$lf_stored_meta = get_post_meta( $post->ID );
	?>
	<div class="locked-files-admin-wrap">
    	<div id="lf-loading-image" style="background-image:url('http://mentors.com.bd/education/wp-content/uploads/2020/10/35.gif');"></div>
    	<div class="meta-row lf-meta-row">	
    		<input type="button" class="button button-secondary" value="Upload Student Certificate" id="upload-file-button">
    				<input type="text" id="student_certificate" name="student_certificate" value="<?php if ( ! empty ( $lf_stored_meta['student_certificate'] ) ) { echo esc_attr( $lf_stored_meta['student_certificate'][0] );} ?>"/>
    	</div>
    	<div class="meta-row lf-meta-row">
    		<input type="button" class="button button-secondary" value="Generate Password for User" id="generate-pass-button">
    		<input type="text" id="passsword-show" name="passsword-show" value="<?php if ( ! empty ( $lf_stored_meta['passsword-show'] ) ) { echo esc_attr( $lf_stored_meta['passsword-show'][0] );} ?>"/>
    	</div>
    
    	<div class="meta-row lf-meta-row">
    			<div class="meta-th">
    				<label for="student-mail" class="meta-row-title"><?php _e( 'Student Email', 'lf-textdomain' )?></label>
    			</div>
    		<input type="email" id="student-mail" name="student-mail" value="<?php if ( ! empty ( $lf_stored_meta['student-mail'] ) ) { echo esc_attr( $lf_stored_meta['student-mail'][0] );} ?>"/>
    	</div>
    </div>
<?php	
}

	function lf_meta_save( $post_id ) {
	// Checks save status
    $lf_is_autosave = wp_is_post_autosave( $post_id );
    $lf_is_revision = wp_is_post_revision( $post_id );
    $lf_is_valid_nonce = ( isset( $_POST[ 'locked_file_nonce' ] ) && wp_verify_nonce( $_POST[ 'locked_file_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $lf_is_autosave || $lf_is_revision || !$lf_is_valid_nonce ) {
        return;
    }
	
	
	if ( isset( $_POST[ 'student_certificate' ] ) ) {
    	update_post_meta( $post_id, 'student_certificate', sanitize_text_field( $_POST[ 'student_certificate' ] ) );
    }
	if ( isset( $_POST[ 'passsword-show' ] ) ) {
    	update_post_meta( $post_id, 'passsword-show', sanitize_text_field( $_POST[ 'passsword-show' ] ) );
    }	
		if ( isset( $_POST[ 'student-mail' ] ) ) {
    	update_post_meta( $post_id, 'student-mail', sanitize_text_field( $_POST[ 'student-mail' ] ) );	
    }	
		
		
		
	
}

add_action( 'save_post', 'lf_meta_save' );


function send_mails($post_ID)  { 
	$postmeta =  get_post_meta( $post->ID, 'tris-days-check', true );
      $origen = "trina.haque02@gmail.com";
      
		$studentMail = get_post_meta( $post->ID, 'student-mail', true );
		$contentido = get_post_meta( $post->ID, 'passsword-show', true );
		$title = "Mentors Student Password";
	   $headers = 'From: '. $origen . "\r\n" .
    'Reply-To: ' . $origen . "\r\n";
		wp_mail($studentMail,$title,$contenido,$headers);
     return $post_ID;
}
add_action( 'publish_post', 'send_mails' );










