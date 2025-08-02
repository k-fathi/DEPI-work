<?php
/**
 * defined core functions to run the site smoothly
 */

include 'config/config.php';
include 'includes/functions/tracking.php';
include 'includes/functions/mailer.php';

// include secrets
$dir = 'secrets';
$files = scandir($dir);

foreach($files as $file) {
    if ($file == 'index.php') {
        continue;
    }
    $secretspath = $dir . '/' . $file;
    if (is_file($secretspath)) {
        require_once $secretspath;
        break;
    }
}

class Core {

    /**
     * Summary of getDarkmode
     * @return mixed
     */
    public function getDarkmode() {

        $darkmode = isset($_COOKIE['darkmode']) ? $_COOKIE['darkmode'] : '';
        return $darkmode;

    }


    /**
     * Summary of getConfig
     * @return mixed
     */
    public function getConfig() {

        // access config
        $configInstance = new Config();
        $config = $configInstance->getConfig();
        return $config;

    }


    /**
     * Summary of getRoutes
     * get all page paths and names from the pages folder and return array like:
     * $routes[$pagepath] = ['name' => $pagename, 'file' => $file]
     * 
     * @return array
     * 
     */
    public function getRoutes() {

        $routes = [];

        $folder = 'pages';
        $dir = scandir($folder);
        foreach ($dir as $file) {

            $file_path = $folder . '/' . $file;

            // continue if file does not exist or is not .php
            if (!file_exists($file_path) || !is_file($file_path) || strpos($file,'.php') == -1 || $file == 'index.php')
                continue;

            // get the comments to read the route @route: path="/pagepath" name="pagename"
            $source = file_get_contents( $folder.'/'.$file );
            $tokens = token_get_all( $source );
            $comment = array(
                T_COMMENT,
                T_DOC_COMMENT   
            );

            foreach ($tokens as $token) {

                if (!isset($token[0]) || !isset($token[1]) || !in_array($token[0], $comment))
                    continue;

                // read page path and name
                if (strpos($token[1], '@route') > -1) {
                    preg_match('/path="(.*?)" name="(.*?)"/', $token[1], $matches);

                    $path = isset($matches[1]) ? $matches[1] : '';
                    $name = isset($matches[2]) ? $matches[2] : '';
                    $path_data = [];
                    $path_data['name'] = strtolower($name);
                    $path_data['file'] = strtolower($file);

                    $routes[$path] = $path_data;

                } 
                    

                $page_paras = [
                    'title',
                    'headline',
                    'seotitle',
                    'seodesc',
                    'seokeywords',
                    'navtitle',
                    'navname',
                    'navprefix',
                    'navicon',
                    'navdisplay',
                    'navmobile',
                ];

                foreach ($page_paras as $para) {
                    if (strpos($token[1], "@$para") > -1) {
                        preg_match("/@$para: (.*)/", $token[1], $matches);
                        $content = isset($matches[1]) ? $matches[1] : '';
                        $content = trim($content);
                        if ($content !== '') {
                            $routes[$path][$para] = $content;
                        }

                    }
                }
                
                
            }
        }

        return $routes;

    }

    // define global variables
    //$routes = getRoutes();
    //$darkmode = isset($_COOKIE['darkmode']) ? $_COOKIE['darkmode'] : '';



    /**
     * Summary of requestUrl
     * returns the currect request url
     * 
     * @return string
     * 
     */
    public function requestUrl() {

        $request_url = $_SERVER["REQUEST_URI"];

        if ( strpos($request_url,"?") > -1 ) {
            $request_url = explode("?", $request_url)[0];
        }

        if (substr($request_url, -1) === '/' ) {
            $request_url = substr($request_url, 0, -1);
        }


        if ($request_url == "") {
            $request_url = "/";
        }

        return $request_url;

    }


    public function renderPage() {

        // get all routes
        global $routes;

        // get darkmode cookie
        global $darkmode;

        // get congigs
        global $config;
        

        // get requeste url
        $request_url = $this->requestUrl();

        // if tracking
        if ( strpos($request_url,'track/track') > -1 && isset($config['tracking']) && $config['tracking'] == true ) {
            $this->track_page_view($request_url);
            die();
        }
        

        // open matching file from route
        if (isset($routes[$request_url]['file']) && file_exists('pages/' . $routes[$request_url]['file'])) {
            $route = $routes[$request_url];
        } else {
            $route = $routes['/404'];
        }
        

        header("Content-Type: text/html; charset=UTF-8");

        include 'pages/templates/layout.php';

    }


    /**
     * Summary of showNavigation
     * @return array<array>
     */
    public function showNavigation() {

        $nav_array = [];
        $count_index = 9999;

        global $routes;

        foreach ( $routes as $path => $val_array ) {
            if ( isset($val_array['navdisplay']) && strpos($val_array['navdisplay'],'main') > -1 ) {
                if ( strpos($val_array['navdisplay'],':') > 0 ) {
                    $index = explode(':', $val_array['navdisplay'])[0];
                }
                else {
                    $count_index++;
                    $index = $count_index;
                }
                $nav_array[$index]['display']['nav_headlines'][] = isset($val_array['navname']) ? $val_array['navname'] : '';
                $nav_array[$index]['display']['nav_prefix'][] = isset($val_array['navprefix']) ? $val_array['navprefix'] : '';
                $nav_array[$index]['display']['nav_icons'][] = isset($val_array['navicon']) ? $val_array['navicon'] : '';
                $nav_array[$index]['display']['nav_links'][] = isset($path) ? $path : '';
            }
            if ( isset($val_array['navdisplay']) && $val_array['navdisplay'] == 'official' ) {
                if ( strpos($val_array['navdisplay'],':') > 0 ) {
                    $index = explode(':', $val_array['navdisplay'])[0];
                }
                else {
                    $count_index++;
                    $index = $count_index;
                }
                $nav_array[$index]['official']['nav_headlines'][] = isset($val_array['navname']) ? $val_array['navname'] : '';
                $nav_array[$index]['official']['nav_links'][] = isset($path) ? $path : '';
            }
            if ( isset($val_array['navmobile']) && strpos($val_array['navmobile'],'main') > -1 ) {
                if ( strpos($val_array['navmobile'],':') > 0 ) {
                    $index = explode(':', $val_array['navmobile'])[0];
                }
                else {
                    $count_index++;
                    $index = $count_index;
                }
                $nav_array[$index]['mobile_main']['nav_headlines'][] = isset($val_array['navname']) ? $val_array['navname'] : '';
                $nav_array[$index]['mobile_main']['nav_icons'][] = isset($val_array['navicon']) ? $val_array['navicon'] : '';
                $nav_array[$index]['mobile_main']['nav_links'][] = isset($path) ? $path : '';
            }
            if ( isset($val_array['navmobile']) && strpos($val_array['navmobile'],'popup') > -1 ) {
                if ( strpos($val_array['navmobile'],':') > 0 ) {
                    $index = explode(':', $val_array['navmobile'])[0];
                }
                else {
                    $count_index++;
                    $index = $count_index;
                }
                $nav_array[$index]['mobile_popup']['nav_headlines'][] = isset($val_array['navname']) ? $val_array['navname'] : '';
                $nav_array[$index]['mobile_popup']['nav_icons'][] = isset($val_array['navicon']) ? $val_array['navicon'] : '';
                $nav_array[$index]['mobile_popup']['nav_links'][] = isset($path) ? $path : '';
            }
        }


        $final_nav = [];
        ksort($nav_array);
        foreach ( $nav_array as $key => $val ) {
            foreach ( $val as $k => $v ) {
                $final_nav[$k][] = $v;
            }
        }

        return $final_nav;

    }


    /**
     * Summary of db_connect
     * @return mixed
     */
    public function db_connect() {

        // access secrets
        $secretsInstance = new Secrets();
        $secrets = $secretsInstance->getSecrets();

        $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if ( strpos($current_url,'localhost') > -1 ) {
            global $config;
            if ( isset($config['local_tracking']) && $config['local_tracking'] == true ) {
                $dbhost = $secrets["local_db_host"];
                $dbuser = $secrets["local_db_user"];
                $dbpass = $secrets["local_db_password"];
                $dbname = $secrets["local_db_name"];
            }
            else {
                return '';
            }
        }
        else {
            $dbhost = $secrets["db_host"];
            $dbuser = $secrets["db_user"];
            $dbpass = $secrets["db_password"];
            $dbname = $secrets["db_name"];
        }

        try {
            $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        } catch (PDOException $e) {
            $pdo = 'Verbindung local fehlgeschlagen: ' . $e->getMessage();
        }
        
        return $pdo;

    }


    /**
     * Summary of tracking
     * @param string $request_url_full
     * @param string $type
     * @param string $event
     * @return void
     */
    public function tracking($request_url_full,$type,$event) {

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

            $pdo = $this->db_connect();

            if ($pdo !== '') {

                $request_url_full = "/" . $request_url_full;

                date_default_timezone_set('Europe/Berlin');
                $date = date("Y-m-d H:i");

                $url_para_string = "";
                if (strpos($request_url_full, "?") > -1) {
                    $url_para_string = explode("?", $request_url_full)[1];
                    $request_url_full = explode("?", $request_url_full)[0];
                }

                $page = $request_url_full;
                $session = session_id();
                $para = $url_para_string;

                $page = str_replace('//', '/', $page);
                $referrer = str_replace('//', '/', $referrer);

                $sql = "INSERT INTO tracking (date, type, page, referrer, session, event, para) 
                    VALUES (:date, :type, :page, :referrer, :session, :event, :para)";

                $stmt = $pdo->prepare($sql);

                $data = [
                    'date' => $date,
                    'type' => $type,
                    'page' => $page,
                    'referrer' => $referrer,
                    'session' => $session,
                    'event' => $event,
                    'para' => $para
                ];

                $stmt->execute($data);

                $pdo = null;

            }
        }
    }



    public function track_page_view($request_url) {

        $pdo = $this->db_connect();

        if ($pdo !== '') {
            $referrer = isset($_GET["referrer"]) ? $_GET["referrer"] : "";
            $type = isset($_GET["type"]) ? $_GET["type"] : "pageview";
            $event = isset($_GET["event"]) ? $_GET["event"] : "";
            
            $request_url_full = "/" . $request_url;

            date_default_timezone_set('Europe/Berlin');
            $date = date("Y-m-d H:i");

            $request_url_full = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $request_url_full = str_replace("https://", "", $request_url_full);
            $request_url_full = str_replace("http://", "", $request_url_full);
            $request_url_full = str_replace("coden-lassen.de", "", $request_url_full);

            $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $referrer = str_replace("https://", "", $referrer);
            $referrer = str_replace("http://", "", $referrer);
            $referrer = str_replace("coden-lassen.de", "", $referrer);
            
            $url_para_string = "";
            if ( strpos($request_url_full,"?") > -1 ) {
                $url_para_string = explode("?",$request_url_full)[1];
                $request_url_full = explode("?",$request_url_full)[0];
            }

            $page = $request_url_full;
            $session = session_id();
            $para = $url_para_string;

            $date = strip_tags($date);
            $type = strip_tags($type);
            $page = strip_tags($page);
            $page = str_replace('//', '/', $page);
            $referrer = strip_tags($referrer);
            $referrer = str_replace('//', '/', $referrer);
            $session = strip_tags($session);
            $event = strip_tags($event);
            $para = strip_tags($para);


            $sql = "INSERT INTO tracking (date, type, page, referrer, session, event, para) 
            VALUES (:date, :type, :page, :referrer, :session, :event, :para)";

            $stmt = $pdo->prepare($sql);

            $data = [
                'date' => $date,
                'type' => $type,
                'page' => $page,
                'referrer' => $referrer,
                'session' => $session,
                'event' => $event,
                'para' => $para
            ];

            $stmt->execute($data);

            $pdo = null;

        }

        header('Content-Type: image/gif');
        echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
        die();

    }



} // end class