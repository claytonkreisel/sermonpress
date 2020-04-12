<?php

    class BPMS {

        public $plugins;
        public $plugins_dir;
        public $bpms_dir;

        public function __construct(){
            $this->config();
            $this->hooks();
        }

        private function config(){

            if(BPMS_PLUGINS_DIR == ''){
                $this->plugins_dir = BPMS_DIR . 'plugins/';
            } else {
                $pdir = rtrim(BPMS_PLUGINS_DIR, '/');
                $this->plugins_dir = $pdir . '/';
            }
            $this->plugins = apply_filters('bpms_plugins', array());

        }

        private function hooks(){
            add_action('plugins_loaded', array($this, 'load_plugins'));
        }

        public function version_number_compare($a, $b){
            $va = explode('.', $a);
            $vb = explode('.', $b);
            $max_count = count($va);
            if(count($vb) < $max_count){
                $max_count = count($vb);
            }
            for($i=0; $i<$max_count; $i++){
                if($va[$i] > $vb[$i]){
                    return 1;
                } elseif((int)$va[$i] < (int)$vb[$i]){
                    return -1;
                }
            }
            if(count($va) > count($vb)){
                return 1;
            } elseif(count($va) < count($vb)){
                return -1;
            }
            return 0;
        }

        public function get_included_plugin_version($tag){
            if(isset($this->plugins[$tag]['version'])){
                return $this->plugins[$tag]['version'];
            }
            return 0;
        }

        public function load_plugins(){

            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

            do_action('bpms_before_load_plugins', $this->plugins);

            //Check Meta-Box
            foreach($this->plugins as $plugin){
                if(is_plugin_active($plugin['main_file'])){
                    $pfile = WP_PLUGIN_DIR . '/' . $plugin['main_file'];
                    $mbplug = get_plugin_data($pfile);
                    if($this->version_number_compare($plugin['version'], $mbplug['Version']) >= 0){
                        deactivate_plugins($pfile);
                        include_once($this->plugins_dir  . $plugin['main_file']);
                    }
                } else {
                    include_once($this->plugins_dir  . $plugin['main_file']);
                }
            }

            do_action('bpms_after_load_plugins', $this->plugins);

        }


    }
