<?
    if(!isset($_COOKIE['token'])) {
        header('Location: /');
        die();
    }
    if(isset($_GET['action'])) {
        if($_GET['action'] === 'send') {
            if(isset($_POST['text'])) {
                file_get_contents('https://api.sayonline.ml/?token=' . $_COOKIE['token'] . '&req=chat.send&chat=' . $_GET['chat'] . '&message=' . urlencode($_POST['text']));
            }
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Say Online Web Lite</title>
    </head>
    <body>
        <?
            if(!isset($_GET['chat'])) {
        ?>
        <h1>Chats</h1>
        <a href="?chat=global">Global chat</a><br>
        <?
                foreach(json_decode(file_get_contents('https://api.sayonline.ml/?token=' . $_COOKIE['token'] . '&req=chat.get'), true) as &$v) {
                    echo "<a href=\"?chat=$v\">$v</a><br>";
                }
        ?>
        <br>
        <a href="..">Go back</a>
        <?
            } else {
        ?>
        <h1><? echo $_GET['chat'] ?></h1>
        <?
                foreach(json_decode(file_get_contents('https://api.sayonline.ml/?token=' . $_COOKIE['token'] . '&req=chat.get&chat=' . $_GET['chat'] . '&count=5'), true) as &$v) {
                    if($v['status'] === "default") {
                        echo date('G\:i\ \|\ d\.m\.Y\ \|\ ', $v['timestamp']) . htmlentities($v['sender']) . ' | ' . htmlentities($v['text']) . '<br>';
                    }
                }
        ?>
        <form action="?chat=<? echo $_GET['chat'] ?>&action=send" method="post">
            <input name="text" id="text">
            <input type="submit">
        </form>
        <br>
        <a href=".">Go back</a>
        <?
            }
        ?>
    </body>
</html>