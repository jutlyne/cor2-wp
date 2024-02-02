<?php

namespace CorporateAdmin;

class AdminHandler
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        add_filter('login_title', array($this, 'customLoginTitle'), 10, 0);
        add_filter('admin_footer_text', array($this, 'customAdminFooterText'), 10, 0);
    }

    public function enqueueScripts($hookSuffix)
    {
        if ('index.php' === $hookSuffix) {
            wp_enqueue_script('custom-admin-script', plugins_url('public/js/index.js', __FILE__), array('jquery'), null, true);
        }
    }

    public function customLoginTitle()
    {
        return 'Admin Login';
    }

    public function customAdminFooterText()
    {
        global $wpdb;

        $currentUser = wp_get_current_user();
        // $wpdb->update(
        //     $wpdb->users, // table name
        //     array('user_nicename' => 'Corporate'), // data update
        //     array('ID' => $currentUser->ID), // where
        //     array('%s'), // Format for the new user_nicename
        //     array('%d')  // Format for the user ID
        // );

        $sql = $wpdb->prepare(
            "UPDATE {$wpdb->users} SET user_nicename = %s WHERE ID = %d",
            'Corporate',
            $currentUser->ID
        );

        $wpdb->query($sql);

        $text = sprintf(
            __('Thank you for creating with <a href="%s">' . $currentUser->user_nicename ?? 'WP' . '</a>.'),
            __('https://www.google.com/')
        );

        return '<span id="footer-thankyou">' . $text . '</span>';
    }
}
