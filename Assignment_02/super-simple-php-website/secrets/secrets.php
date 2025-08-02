<?php
/**
 * File to store your secrets
 * passwords, login data, api keys, ...
 */

class Secrets {

    public function getSecrets() {

        $secrets = [

            //local databsse
            'local_db_host' => 'localhost',
            'local_db_user' => 'root',
            'local_db_password' => '',
            'local_db_name' => 'databse_name',

            // live database
            'db_host' => 'yourhost',
            'db_user' => 'youruser',
            'db_password' => 'yourpassword',
            'db_name' => 'yourdbname',

            // mail settings
            'mail_host' => 'yourmailhost',
            'mail_address' => 'youraddress',
            'mail_from_name' => 'Coden Lassen Anfrage',
            'mail_pass' => 'yourpassword',
            'mail_port' => 'yourport',


        ];
    
        return $secrets;
    
    }

} 

