<?php
class Session{
    public static function userConnected(){
        if(isset($_SESSION["id"])){
            return true;
        }
        return false;
    }

    public static function userConnecting(){
        if(isset($_POST["action"])){
            if ($_POST["action"] == "connecterInternaute"){
                return true;
            }
        }
        return false;
    }
}
?>