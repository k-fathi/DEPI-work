<?php
/**
 * file to store global configuration e.g.:
 * sitename, colors, links
 */


 class Config {

    public function getConfig()
    {

        $config = [
            'primary_color' => '#43836f',
            'primary_color_darkmode' => '#bef1e1',
            'sitename' => 'demo site',
            'logo' => 'codenlassen-logo.svg',
            'tracking' => false, // true enables tracking function 
            'local_tracking' => false, // true enables tracking function 
            'github_link' => 'https://github.com/stefan-klaes/super-simple-php-website', //whatever you want to access
            'stefan_github' => 'https://github.com/stefan-klaes',
        ];

        return $config;
        
    }

 }
