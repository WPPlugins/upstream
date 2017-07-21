<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


class UpStream_Template_Loader {

    /**
     * Get things going
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_filter( 'template_include', array( $this, 'template_loader' ) );
    }

    /**
     * Load a template.
     *
     * Handles template usage so that we can use our own templates instead of the themes.
     *
     * Templates are in the 'templates' folder. upstream looks for theme.
     * overrides in /theme/upstream/ by default.
     *
     * @param mixed $template
     * @return string
     */
    public function template_loader( $template ) {

        $file = '';

        if( get_post_type() != 'project' )
            return $template;

        if ( is_single() ) {
            $file = 'single-project.php';
        }
        if ( is_archive() ) {
            $file = 'archive-project.php';
        }

        if (isset($_GET['action']) && $_GET['action'] === 'logout' && !isset($_POST['login'])) {
            UpStream_Login::doDestroySession();
        }

        /*
         * Login page if not logged in
         */
        if ( ! upstream_is_user_logged_in() ) {
            $file = 'login.php';
            $GLOBALS['login_template'] = true;
        }

        if ( $file ) {

            $check_dirs = array(
                trailingslashit( get_stylesheet_directory() ) . upstream_template_path(),
                trailingslashit( get_template_directory() ) . upstream_template_path(),
                UPSTREAM_PLUGIN_DIR . 'templates/'
            );

            foreach ( $check_dirs as $dir ) {
                if ( file_exists( trailingslashit( $dir ) . $file ) ) {
                    load_template( $dir . $file );
                    return;
                }
            }

        }

        return $template;
    }

}

new UpStream_Template_Loader();
