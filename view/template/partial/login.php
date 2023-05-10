<style>
.bfsb-login-form h4 {
	font-size: 18px;
    font-weight: 500;
    color: #2D3748;
    padding: 0;
    margin: 0;
}

.bfsb-login-form label {
	font-size: 16px; 
    color: #2D3748; 
}
.bfsb-login-form input[type=text], .bfsb-login-form input[type=password] {
	border-radius: 4px;
	color: #4A5568;
	font-size: 14px;
	padding: 8px;
	border: 1px solid #CBD5E0;
	outline: none;
	line-height: 100%;
	background: #fff;
}

.bfsb-login-form input[type=submit] {
	background: linear-gradient(180deg, #4C6FFF 0%, #3157F0 99.99%, rgba(76, 111, 255, 0) 100%);
	padding: 10px 30px;
	font-weight: 600;
	color: #fff;
	cursor: pointer;
	border: none;
	font-size: 14px;
	line-height: 100%;
	display: inline-flex;
	align-items: center;
	border-radius: 4px;
}
.bfsb-login-form input[type=submit]:hover {
	background: linear-gradient(180deg, #365DFD 0%, #123DEE 100%);
	transition: all 0.3s ease-out;
}
</style>
<div class="bfsb-login-form" >
    <h4 class="bfsb-login-title"><?php esc_html_e( 'Please login to see SpaceX data', 'spacex-blocks' ); ?></h4>
	<?php 
		$args = array(
			'redirect' => get_permalink(get_the_ID()), 
			'form_id' => 'ndpv-login-form',
			'label_username' => esc_html__( 'Username', 'spacex-blocks' ),
			'label_password' => esc_html__( 'Password', 'spacex-blocks' ),
			'label_remember' => esc_html__( 'Remember Me', 'spacex-blocks' ),
			'label_log_in' => esc_html__( 'Log In', 'spacex-blocks' ),
			'remember' => true
		);
		wp_login_form( $args );
		if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) {
			echo '<p style="color: red">' . esc_html__( 'You enterd wrong credentials', 'spacex-blocks' ) . '</p>';
		}
	?> 
</div> 