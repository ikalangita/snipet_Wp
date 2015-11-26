<?php 

	add_filter( 'wp_mail_from', 'my_mail_from' );
	function my_mail_from( $email )
	{
	return "change-this-to-your-email-address";
	}

	add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
	function my_mail_from_name( $name )
	{
	return "My Name";
	}