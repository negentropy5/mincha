<?php
// header("Access-Control-Allow-Origin: *");
if($_SERVER["REQUEST_METHOD"]==="POST") {
    
    $lines = filter_input(INPUT_POST,'lines', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $color = filter_input(INPUT_POST,'color', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $retime = filter_input(INPUT_POST,'retime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $comment = filter_input(INPUT_POST,'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $h_name = filter_input(INPUT_POST,'h_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $roomUrl = filter_input(INPUT_POST,'roomUrl', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $https = "https://kinopiix0120.xsrv.jp";
    $cgi = ($roomUrl == 'ai') ? 'robo.cgi' : 'comchat.cgi';

    $url = "$https/$roomUrl/$cgi?lines=$lines&color=$color&retime=$retime&name=$h_name&mode=regist&comment=$comment";

    header('Content-Type: application/json');
    echo json_encode($url);
    exit;
}