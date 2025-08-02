<?php
/**
 * simple analytics tracking function to track:
 * pageviews, interactions
 * 
 */


/**
 * Summary of tracking
 * @param string $request_url_full
 * @param string $type
 * @param string $event
 * @return void
 */
function tracking($request_url_full,$type,$event) {

    global $config;

    // if tracking not enabled don't do anything
    if (!isset($config['tracking']) || $config['tracking'] !== true) {
        return;
    }
    
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    if ( strpos($referrer,"style") > 0 || $request_url_full == "favicon.ico" ) {
        $no_tracking = "yes";
    }
    else {

        $conn = db_connect();
		
		$request_url_full = "/" . $request_url_full;

        date_default_timezone_set('Europe/Berlin');
        $datum = date("Y-m-d H:i");

        $url_para_string = "";
        if ( strpos($request_url_full,"?") > -1 ) {
            $url_para_string = explode("?",$request_url_full)[1];
            $request_url_full = explode("?",$request_url_full)[0];
        }

        $seite = $request_url_full;
        $session = session_id();
        $para = $url_para_string;

    
        $sql = "INSERT INTO tracking (datum, type, seite, referrer, session, event, para) 
            VALUES ('$datum', '$type', '$seite', '$referrer', '$session', '$event', '$para')";

        $save = $conn->query($sql);
        $conn->close();
    }
}