<?
    if(isset($_COOKIE['token'])) {
        header('Location: /');
        die();
    }
    if(!isset($_COOKIE['promise'])) {
        header('Location: /');
        setcookie('promise', json_decode(file_get_contents('https://auth.sayonline.ml/promise/new/?appid=7'), true)['promise'], 0, '/');
        die();
    }
    $answer = json_decode(file_get_contents('https://auth.sayonline.ml/promise/?id=' . $_COOKIE['promise']), true);
    if(isset($answer['error'])) {
        header('500 Internal Server Error');
        setcookie('promise', '', 1, '/');
        echo '<h1>500 Internal Server Error</h1><a href="/">Go home</a>';
        die();
    }
    if(isset($answer['token'])) {
        setcookie('promise', '', 1, '/');
        setcookie('token', $answer['token'], time()+60*60*24*365*20, '/');
        header('Location: /');
        die();
    }
    if($answer['status'] === 'fail') {
        echo '<h1>Auth failed</h1>Timed out.<br><a href="/">Go home</a>';
        die();
    }
    header('Location: /');
?>