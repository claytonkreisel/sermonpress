<?php

    define('BPMS_PLUGINS_DIR', WP_PLUGIN_DIR . '/sermonpress/dependencies/'); //The location of the plugins directory. If left blank then your "../bpms/plugins" will be default. Do not include trailing slash.

    //Use the array below to include plugins to the theme. The format should look like this.
    /*
        $included_plugins = array(
            '{tag}' => array( //Tag should typically be the plugin directory name. IE MetaBox would be meta-box, WooCommerce would be woocommerce, iThemes Security would be wp-better-security
                'order' => 1, //The priority you want the plugin to load in.
                'main_file' => plugin_name/plugin_name.php //The main file that loads the plugin
                'version' => 1.0.0 //The plugin version upto three decimals
            ),
            '{tag2}' => array( ... ),
            '{tag3}' => array( ... ),
            ...
        )
    */
    $included_plugins = array(
        'meta-box' => array(
            'order' => 1,
            'main_file' => 'meta-box/meta-box.php',
            'version' => '4.13.3'
        ),
        'mb-settings-page' => array(
            'order' => 2,
            'main_file' => 'mb-settings-page/mb-settings-page.php',
            'version' => '1.3.2'
        ),
        'mb-term-meta' => array(
            'order' => 3,
            'main_file' => 'mb-term-meta/mb-term-meta.php',
            'version' => '1.2.2'
        ),
        'meta-box-group' => array(
            'order' => 4,
            'main_file' => 'meta-box-group/meta-box-group.php',
            'version' => '1.2.12'
        ),
        'meta-box-tooltip' => array(
            'order' => 5,
            'main_file' => 'meta-box-tooltip/meta-box-tooltip.php',
            'version' => '1.1.1'
        ),
        'meta-box-columns' => array(
            'order' => 6,
            'main_file' => 'meta-box-columns/meta-box-columns.php',
            'version' => '1.2.2'
        ),
        'meta-box-conditional-logic' => array(
            'order' => 7,
            'main_file' => 'meta-box-conditional-logic/meta-box-conditional-logic.php',
            'version' => '1.5.5'
        ),
        'meta-box-tabs' => array(
            'order' => 8,
            'main_file' => 'meta-box-tabs/meta-box-tabs.php',
            'version' => '1.0.3'
        )

    );


    /******** DO NOT EDIT BELOW THIS POINT *********/
    define('BPMS_DIR', __DIR__ . '/'); //The Director Path for this file.

    global $bpms_plugins;

    $bpms_plugins = $included_plugins;
    add_filter('bpms_plugins', 'bpms_load_plugins');
    function bpms_load_plugins($init_plugins){
        global $bpms_plugins;
        return $bpms_plugins;
    }

    if(!class_exists('BPMS')){
        include_once BPMS_DIR . '/bpms.php';
        include_once BPMS_DIR . '/functions.php';
    }
    include_once BPMS_DIR . '/init.php';
?>
