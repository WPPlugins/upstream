<?php
if (!defined('ABSPATH')) exit;

$clientId = (int)upstream_project_client_id();
$clientLogo = upstream_client_logo($clientId);
?>

<?php do_action('upstream_before_top_nav'); ?>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php if (!empty($clientLogo)): ?>
                        <img src="<?php echo $clientLogo; ?>" alt="" height="40" />
                        <?php endif; ?>

                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="<?php echo get_post_type_archive_link('project'); ?>">
                                <i class="fa fa-home pull-right"></i><?php printf(__('My %s', 'upstream'), upstream_project_label_plural()); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url('mailto:' . upstream_admin_email()); ?>">
                                <i class="fa fa-envelope-o pull-right"></i><?php _e('Contact Admin', 'upstream'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(upstream_logout_url()); ?>">
                                <i class="fa fa-sign-out pull-right"></i><?php _e('Log Out', 'upstream'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

<?php do_action('upstream_after_top_nav'); ?>
