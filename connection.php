<?php
/*
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}






                'host' => 'mysql.hostinger.ph',
                'user' => 'u412994236_bec',
                'pass' => 'sX5eDJOHupKMu5nCL5',
                'db' => 'u412994236_bec'*/

class GSecureSQLConfig
{
    static function get_mysqli_config($type = NULL)
    {
        if (strtoupper($type) == 'localhost') {
            return array(
                'host' => 'localhost:3306',
                'user' => 'root',
                'pass' => '',
                'db' => 'becdb'
            );
        } else {
            return array(
                'host' => 'localhost:3306',
                'user' => 'root',
                'pass' => '',
                'db' => 'becdb'
            );
        }
    }
}


class GSecureSQL
{
    private static $config;

    private static function _get_mysqli_config()
    {
        self::$config = GSecureSQLConfig::get_mysqli_config();
    }

    static function query($sql, $has_return = FALSE, $types = NULL)
    {
        // validation

        // -----
        self::_get_mysqli_config();
        $cn = new mysqli(
            self::$config['host'],
            self::$config['user'],
            self::$config['pass'],
            self::$config['db']
        );
        $ret = NULL;

        $st = $cn->prepare($sql);

        if($cn->errno <> 0){
            trigger_error('MySQL Connection Error #' . $cn->errno . ': ' . $cn->error, E_USER_ERROR);
        }
        if (is_null($types)) {
            if (!$has_return) {
                $st->execute();
                $st->close();
                $cn->close();
                $ret = 'Query has been executed';
            } else {
                $st->execute();
                $code_result = '$st->bind_result(';
                $bool = false;
                $p = array();
                for($i = 0; $i < $st->field_count; $i++){
                    if(!$bool){
                        $bool = true;
                        $code_result .= '$p[' . $i . ']';
                    }else{
                        $code_result .= ',$p[' . $i . ']';
                    }
                }
                $code_result .= ');';
                eval($code_result);

                $ret = array();
                $k = 0;
                while($st->fetch()){
                    for($i = 0; $i < count($p); $i++){
                        $ret[$k][$i] = $p[$i];
                    }
                    $k++;
                }

                $st->close();
                $cn->close();
            }
        } else {
            if (!$has_return) {
                $arg = func_get_args();
                $code = '$st->bind_param($types';
                for ($i = 3; $i < count($arg); $i++) {
                    $code .= ',$arg[' . $i . ']';
                }
                $code .= ');';
                eval($code);
                $st->execute();
                $st->close();
                $cn->close();
            } else {
                $arg = func_get_args();
                $code = '$st->bind_param($types';
                for ($i = 3; $i < count($arg); $i++) {
                    $code .= ',$arg[' . $i . ']';
                }
                $code .= ');';
                eval($code);
                $st->execute();
                $code_result = '$st->bind_result(';
                $bool = false;
                $p = array();
                for($i = 0; $i < $st->field_count; $i++){
                    if(!$bool){
                        $bool = true;
                        $code_result .= '$p[' . $i . ']';
                    }else{
                        $code_result .= ',$p[' . $i . ']';
                    }
                }
                $code_result .= ');';
                eval($code_result);

                $ret = array();
                $k = 0;
                while($st->fetch()){
                    for($i = 0; $i < count($p); $i++){
                        $ret[$k][$i] = $p[$i];
                    }
                    $k++;
                }

                $st->close();
                $cn->close();
            }
        }
        return $ret;
    }
}
