<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>Вход в систему</title>
    <link rel="stylesheet" href="/css/loginStyle.css">
    <link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,300italic,300,100italic,100,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700' rel='stylesheet' type='text/css'>
    <!-- For-Mobile-Apps-and-Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //For-Mobile-Apps-and-Meta-Tags -->

</head>
<body>

<h1>ВХОД В СИСТЕМУ</h1>
<div class="main">
    <h2>Введите данные для входа</h2>
    <?php if (isset($data['errorMessage'])) { ?>
        <div class="errorMessage"><?php echo $data['errorMessage']; ?></div>
    <?php } ?>
    <form action="/user/login" method="post">
        <input type="text" class="name" name="login" placeholder="Логин" required="">
        <input type="password" class="password" name="password" placeholder="Пароль" required="">
        <input type="submit" value="ВОЙТИ">
    </form>
</div>
<div class="footer">
    <p> &copy; 2016 Plain Login Form. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
</div>
</body>
</html>
