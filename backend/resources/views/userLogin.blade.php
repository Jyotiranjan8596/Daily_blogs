<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div class="wrapper">
    <h3 id="heading-txt" >Login</h3>
        <div class="view-container">
            <form action="/userLogin" method="POST" >
                @csrf

                <input type="email" name="usermail" placeholder="Username" id="user-mail" required="required" autofocus="autofocus">
                <br><br>
                <input type="password" name="userpass" placeholder="Password" id="user-password" required="required" >
                <br><br>
              <input type="submit" value="Login">
            </form>

        </div>
   </div>
</body>
</html>
