<?php
/**
 * Plugin Name: Guty2
 * Description: A rebuild of guty blocks
 * Version: 0.0.1
 * Author: Jim Schofield
 * Text Domain: guty2
 * Domain Path: /languages
 *
 * @package guty2
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue block JavaScript and CSS for the editor
 */
function guty2_plugin_editor_scripts() {

    // Enqueue block editor JS
    wp_enqueue_script(
        'guty2-editor-scripts',
        plugins_url( '/assets/dist/build.js', __FILE__ ),
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
        filemtime( plugin_dir_path( __FILE__ ) . '/assets/dist/build.js' )
    );

    // Enqueue block editor styles
     wp_enqueue_style(
         'guty2-css',
         plugins_url( '/assets/dist/style.css', __FILE__ ),
         [ 'wp-blocks' ],
         filemtime( plugin_dir_path( __FILE__ ) . '/assets/dist/style.css' )
     );

	register_block_type(
		'guty2/paint-me', array(
			'style'           => 'guty2-css',
			'editor_style'    => 'guty2-css',
			'editor_script'   => 'guty2-editor-scripts',
		)
	);

}

// Hook the enqueue functions into the editor
add_action( 'enqueue_block_editor_assets', 'guty2_plugin_editor_scripts' );

/**
 * Enqueue view scripts
 */
function guty2_plugin_view_scripts() {
    if ( is_admin() ) {
        return;
    }

    wp_enqueue_script(
		'guty2/view-scripts',
		plugins_url( '/assets/dist/build.view.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'react', 'react-dom' )
    );
}

add_action( 'enqueue_block_assets', 'guty2_plugin_view_scripts' );
