<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login to OurFarm</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/ourfarm/public/css/Login.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="mainframe">
                <img src="/ourfarm/public/img/avt.jpg" alt="logo">
                <h1><span>our</span>Farm</h1>
                <form action="/ourfarm/login/loginHandling" method="post">
                    <label>
                        <input type="email" name="email" placeholder="&#xf0e0 Email"  required>
                    </label>
                    <label>
                        <input type="password" name="password" placeholder="&#xf084 Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&~*_=+-]).{8,36}$" required>
                    </label>
                    <a href="#">Forgot password?</a>
                    <?php
                        if(isset($data['loginStatus']))
                            if($data['loginStatus'] == false){
                                echo "<p class=\"danger-text\">Account don't exist</p>";
                            }
                    ?>
                    
                    <input type="submit" value="Login">
                </form>

        </div>
    </body>
</html>