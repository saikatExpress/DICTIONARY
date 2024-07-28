<?php
    function VersionCheck()
    {
        $minimum_version = '5.6.0';
        $current_version = phpversion();

        if (version_compare($current_version, $minimum_version, '>=')) {
            
        } else {
            echo "Your PHP version ($current_version) does not meet the minimum requirement ($minimum_version). Please upgrade your PHP version.";
            exit();
        }
    }
?>
