<?php

function isMobileDevice() {
    if(isset($_SERVER["HTTP_USER_AGENT"]))
        return is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    return false;
}

function isTabletDevice() {
    if(isset($_SERVER["HTTP_USER_AGENT"]))
        return is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));
    return false;
}

function isIpadPro() {
    if(isset($_SERVER["HTTP_USER_AGENT"]) && str_contains($_SERVER["HTTP_USER_AGENT"], '(iPad; CPU OS 11_0 like Mac OS X)')){
        return true;
    }else{
        return false;
    }
}

function isIphone(){
    if(isset($_SERVER["HTTP_USER_AGENT"]))
        return preg_match("/(iPhone|iPod|blackberry|iPad)/i", $_SERVER["HTTP_USER_AGENT"]);
    return false;
}

function isAndroid(){
    if(isset($_SERVER["HTTP_USER_AGENT"]))
        return preg_match("/(android|nokia|tablet)/i", $_SERVER["HTTP_USER_AGENT"]);
    return false;
}

function isHuawei(){
    if(isset($_SERVER["HTTP_USER_AGENT"]))
        return preg_match("/(huawei)/i", $_SERVER["HTTP_USER_AGENT"]);
    return false;
}

