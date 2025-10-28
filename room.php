<?php
require_once __DIR__ . "/array.php";

$roomUrl  = filter_input(INPUT_GET,'roomUrl' ,FILTER_SANITIZE_SPECIAL_CHARS);
$roomUrl = mb_substr($roomUrl, 0, 20);

// urlを手掛かりに部屋名を割り出す
$roomName = null;
foreach ($Category as $group) {
    foreach ($group as $room) {
        if ($room['roomUrl'] === $roomUrl) {
            $roomName = $room['roomName'];
            break 2; // 二重ループを抜ける
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" rel="stylesheet">
    <link rel="icon" href="mincha.ico">
    <link rel="stylesheet" href="css/room.css">
    <title><?= $roomName ?></title>
</head>
<body>
<div class="container">
    <form>
        <div class="flex_box">
            <span>名前</span>
            <div class="hdn"><input type="text" class="h_name"></div>
            <label class="label_nico"><input type="checkbox" class="nico">😊</label>
            <span>- <?= $roomName ?> -</span>
            <a class="exit" href="./">退室</a>
        </div>
        <div class="flex_box">
            <span>更新</span>
            <select class="retime">
                <option value="5" > 5秒</option>
                <option value="10">10秒</option>
                <option value="20">20秒</option>
                <option value="30">30秒</option>
                <option value="1800" selected>30分</option>
            </select>
            <span>色</span>

            <select class="color">
                <!--
                <option value="0"  style="color:#000000" selected>黒</option>
                <option value="1"  style="color:#ff1493">ﾛｰｽﾞ</option>
                -->
            </select>
            
            <span>行</span>
            <select class="lines">
                <option value="5" > 5行</option>
                <option value="10">10行</option>
                <option value="20">20行</option>
                <option value="30" selected>30行</option>
                <option value="100">100行</option>
                <option value="200">200行</option>
                <option value="500">500行</option>
            </select>
            <input class="roomUrl" type="hidden" value="<?= $roomUrl ?>">
        </div>
        <div class="flex_box">
            <input type="text" class="comment" placeholder="発言">
            <button><i class="fa-regular fa-paper-plane"></i></button>
        </div>
    </form>
    <iframe frameborder="0"></iframe>
</div>
<script src="js/room_select.js"></script>
<script src="js/room_main.js"></script>
</body>
</html>