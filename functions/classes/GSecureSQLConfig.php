<?php

class GSecureSQLConfig
{
    static function get_mysqli_config($type = NULL)
    {

        $config = @parse_ini_file('../config.ini');
        if(!$config){
            $config = @parse_ini_file('../../config.ini');
        }

        return array(
            'host' => $config['host'],
            'user' => $config['username'],
            'pass' => $config['password'],
            'db'   => $config['dbname']
        );

    }
} 

