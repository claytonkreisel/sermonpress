<?php

    global $bpms;
    if(class_exists('BPMS') && !is_a($bpms, 'BPMS')){
        $bpms = new BPMS();
    }

?>
