<?php
require_once __DIR__ . "/array.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="新みんなのチャットは初心者・趣味・年代別・地域別など色々なチャット＆パソコン・スマホから誰でも無料で参加できます。" />
    <meta name="keywords" content="新みんなのチャット, 新みんなのチャット裏口, チャット, 無料チャット, 雑談, スマホチャット">
    <link href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" rel="stylesheet">
    <link rel="icon" href="mincha.ico">
    <link rel="stylesheet" href="css/index.css">
    <title>新みんなのチャット</title>
</head>
<body>
<header><img src="img/main_img.jpg"></header>
<main>
    <h1>新みんなのチャット</h1>
<?php foreach($Category as $title => $rooms): ?>
    <h2><i class="fa-regular fa-comment"></i> <?= $title ?></h2>
    <section>
<?php foreach($rooms as $num => $arr): ?>
        <form action="./room.php" method="get">
            <input type="hidden" name="roomUrl" value="<?= $arr["roomUrl"] ?>">
            <button class="<?= in_array($arr["roomName"], $care) ? 'care' : ''; ?><?= in_array($arr["roomName"], $gray) ? 'gray' : '' ?>"><?= $arr["roomName"] ?></button>
        </form>
<?php endforeach ?>
    </section>
<?php endforeach ?>
</main>
<script>
// localStorageの削除
const keys = ['chat_username', 'retime', 'lines', 'color', 'check'];
window.addEventListener('DOMContentLoaded', () => {
    keys.forEach(key => localStorage.removeItem(key));
});
</script>
</body>
</html>