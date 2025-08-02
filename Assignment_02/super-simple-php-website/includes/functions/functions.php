<?php

/**
 * Summary of get_icon
 * echo the content of the icon svg
 * @param string $icon_name
 * @param string $size
 * @param string $class
 * @return void
 */
function get_icon($icon_name,$size,$class) {

    $file = 'static/icons/' . $icon_name . '.php';
    if ( file_exists($file) ) {
        include $file;
    }
    else {
        echo '';
    }

}


/**
 * Summary of imgSrc
 * @param string $file_name
 * @param string $dark
 * @return void
 */
function imgSrc($file_name,$dark) {

    global $darkmode;

    if ( $dark == 'darkmode' && $darkmode == 'darkmode' ) {
        $file_name = str_replace('.','darkmode.',$file_name);
    }

    $file_path = 'static/img/' . $file_name;

    if ( !file_exists($file_path) && $darkmode == 'darkmode' ) {
        $file_path = str_replace('darkmode.','.',$file_path);
    }
    
    if ( !file_exists($file_path) ) {
        $file_path = ''; 
    }
    else {
        $file_path = '/' . $file_path;
    }

    echo $file_path;
}


/**
 * Summary of sites
 * @param string $name
 * @return string
 */
function sites($name) {

    // get all routes
    global $routes;

    $page_path = '';
    foreach ( $routes as $path => $val_array ) {
        if ( isset($val_array['name']) && $name === $val_array['name'] ) {
            $page_path = $path;
            break;
        }
    }

    return $page_path;

}


function siteData($name,$key) {

    // get all routes
    global $routes;

    $name = strtolower($name);

    $val = '';
    foreach ( $routes as $path => $val_array ) {
        if ( isset($val_array['name']) && $name == $val_array['name'] && isset($val_array[$key]) ) {
            $val = $val_array[$key];
            break;
        }
        else if ( isset($val_array['name']) && $name == $val_array['name'] && $key == $path ) {
            $val = $path;
            break;
        }
    }

    return $val;

}



/**
 * Summary of is_email
 * @param string $email
 * @return bool
 */
function is_email($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    else {
        return true;
    }
}


/**
 * Summary of get_all_codesnippets
 * @return array
 */
function get_all_codesnippets() {

    $retun_array = [];

    $code_snippet_folder = 'includes/templates/my-work/';
    $scan = scandir($code_snippet_folder);
    foreach($scan as $folder) {
        $file_name = $code_snippet_folder . $folder . "/info.json";
        $code = $code_snippet_folder . $folder . "/code.txt";
        if ( file_exists($file_name) ) {
            $info_json = [];
            $get_info_json = file_get_contents($file_name);
            $info_json = json_decode($get_info_json ,true);
            $info_json["file_name"] = $folder;
            $info_json["code"] = $code;
            $info_json["path"] = $code_snippet_folder . $folder;
            $retun_array[] = $info_json;
        }
    }

    return $retun_array;

}


/**
 * Summary of get_blog_details
 * @param mixed $this_blog
 * @return mixed
 */
function get_blog_details($this_blog) {

    $retun_array = [];

    $code_snippet_folder = 'includes/templates/blog/';

    $file_name = $code_snippet_folder . $this_blog . "/info.json";
    $code = $code_snippet_folder . $this_blog . "/code.txt";
    if ( file_exists($file_name) ) {
        $info_json = [];
        $get_info_json = file_get_contents($file_name);
        $info_json = json_decode($get_info_json ,true);
        $info_json["file_name"] = $this_blog;
        $info_json["code"] = $code;
        $info_json["path"] = $code_snippet_folder . $this_blog;
        $retun_array = $info_json;
    }

    return $retun_array;

}



/**
 * Summary of get_referenz_details
 * @param mixed $this_referenz
 * @return mixed
 */
function get_referenz_details($this_referenz) {

    $retun_array = [];

    $code_snippet_folder = 'includes/templates/my-work/';

    $file_name = $code_snippet_folder . $this_referenz . "/info.json";
    $code = $code_snippet_folder . $this_referenz . "/code.txt";
    if ( file_exists($file_name) ) {
        $info_json = [];
        $get_info_json = file_get_contents($file_name);
        $info_json = json_decode($get_info_json ,true);
        $info_json["file_name"] = $this_referenz;
        $info_json["code"] = $code;
        $info_json["path"] = $code_snippet_folder . $this_referenz;
        $retun_array = $info_json;
    }


    return $retun_array;

}



/**
 * Summary of lines_of_code
 * @param mixed $file
 * @return int
 */
function lines_of_code($file) {
    
    $linecount = 0;
    if ( file_exists($file) ) {
        $handle = fopen($file, "r");
        while(!feof($handle)){
            $line = fgets($handle);
            if ( $line !== "" ) {
                $linecount++;
            }
        }
        fclose($handle);
    }

    return $linecount;

}


/**
 * Summary of get_all_blog_articles
 * @return array
 */
function get_all_blog_articles() {

    $retun_array = [];

    $code_snippet_folder = 'includes/templates/blog/';
    $scan = scandir($code_snippet_folder);
    foreach($scan as $folder) {
        $file_name = $code_snippet_folder . $folder . "/info.json";
        $code = $code_snippet_folder . $folder . "/code.txt";
        if ( file_exists($file_name) ) {
            $info_json = [];
            $get_info_json = file_get_contents($file_name);
            $info_json = json_decode($get_info_json ,true);
            $info_json["file_name"] = $folder;
            $info_json["code"] = $code;
            $info_json["path"] = $code_snippet_folder . $folder;
            $retun_array[] = $info_json;
        }
    }

    return $retun_array;

}


/**
 * Summary of leistungen_cards
 * @return void
 */
function leistungen_cards() {
    include 'includes/blocks/leistungen.php';
}

/**
 * Summary of panzer_cards
 * @return void
 */
function panzer_cards() {
    include 'includes/blocks/panzer.php';
}

/**
 * Summary of showBlock
 * @param mixed $filename
 * @return void
 */
function showBlock($filename) {

    $file = 'includes/blocks/' . $filename . '.php';
    if ( file_exists($file) ) {
        global $darkmode;
        global $config;
        include 'includes/blocks/' . $filename . '.php';
    }
    else {
        echo '';
    }
    
}