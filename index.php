<html>
    <head>
        <meta charset="UTF-8">
        <title>Say Online Web Lite</title>
    </head>
    <body>
        <h1>Say Online Web Lite</h1>
        <?
            if(!isset($_COOKIE['token'])) {
                if(!isset($_COOKIE['promise'])) {
        ?>
        <a href="auth">Login</a>
        <?
                } else {
        ?>
        Promise created<br>
        <a href="//auth.sayonline.ml/?promise=<? echo $_COOKIE['promise'] ?>" target="_blank">
            Open authorization form
        </a><br>
        <a href="auth">Continue</a><br>
        If you can't authorize within this browser due software or hardware incompatibility with auth.sayonline.ml:<br>
        Try to open <strong>https://auth.sayonline.ml/?promise=<? echo $_COOKIE['promise'] ?></strong> ASAP.
        <?
                }
            } else {
        ?>
        Welcome!<br>
        <a href="chats">Chats</a>
        <?
            }
        ?>
        <hr>
        Say Online Web Lite v1.0
    </body>
</html>