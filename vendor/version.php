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

    function getProjectInfo()
    {
        $dbObj = new DB();
        $query = "SELECT * FROM settings";

        $data = $dbObj->select($query);

        if(empty($data)){
            header("Location: log/error.php");
            exit();
        }else{
            return $data;
        }
    }

    function getDeviceType() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        
        // Regular expressions to detect different types of devices
        $mobileAgents = '/(android|iphone|ipod|blackberry|iemobile|opera mini|mobile)/i';
        $tabletAgents = '/(ipad|android 3.0|xoom|sch-i800|playbook|tablet|kindle)/i';

        if (preg_match($mobileAgents, $userAgent)) {
            return 'Mobile';
        } elseif (preg_match($tabletAgents, $userAgent)) {
            return 'Tablet';
        } else {
            return 'Desktop';
        }
    }
?>
