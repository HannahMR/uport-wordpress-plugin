<?php


/**
 * When catching an exception, this allows us to log it if unexpected.
 *
 * @since 0.1.0
 * @param Exception $exception_object The exception object.
 * @param string    $function The function which threw exception.
 * @param array     $args The args passed to the function.
 */
function uwp_caught_exception( $exception_object, $function = '', $args = array() ) {
	// @codingStandardsIgnoreStart
	$message  = $exception_object->getMessage();
	$message .= '. Args: ' . print_r( $args, true ) . '.';

	do_action( 'uportwordpress_caught_exception', $exception_object, $function, $args );
	error_log( "Exception caught in {$function}. {$message}." );
	// @codingStandardsIgnoreEnd
}

/**
 * Wrapper for uwp_doing_it_wrong.
 *
 * @since  0.1.0
 * @param string $function Function used.
 * @param string $message Message to log.
 * @param string $version Version the message was added in.
 */
function uwp_doing_it_wrong( $function, $message, $version ) {
	// @codingStandardsIgnoreStart
	$message .= ' Backtrace: ' . wp_debug_backtrace_summary();

	if ( is_ajax() ) {
		do_action( 'doing_it_wrong_run', $function, $message, $version );
		error_log( "{$function} was called incorrectly. {$message}. This message was added in version {$version}." );
	} else {
		_doing_it_wrong( $function, $message, $version );
	}
	// @codingStandardsIgnoreEnd
}
