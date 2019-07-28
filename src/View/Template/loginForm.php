<!DOCTYPE html>
<html lang="en">
<head>
    <title>ShareMyArt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../css/login.css">

</head>

<body>
<header>  </header>
<form class="form-signin" method="post" action="/user/loginPost">


    <h1 class="h3 mb-3 font-weight-normal" style="color:white">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" name="email" id="inputEmail" class="form-control"
           placeholder="Email address" required autofocus>
    <?php if (isset($_POST) && $errors && array_key_exists(1,$errors)) { ?>
        <div style="color: rgb(204, 0, 0)"><?php echo $errors[1] ?></div>
    <?php } ?>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control"
           placeholder="Password" required>
    <?php if (isset($_POST) && $errors && array_key_exists('invalidPasswordError',$errors)) { ?>
        <div style="color: rgb(204, 0, 0)"><?php echo $errors['invalidPasswordError'] ?></div>
    <?php } ?>

    <?php if (isset($_POST) && $errors && array_key_exists(0,$errors)) { ?>
        <div style="color: rgb(204, 0, 0)"><?php echo $errors[0] ?></div>
    <?php } ?>

    <?php if (isset($_POST) && $errors && array_key_exists('userNotFoundError',$errors)) { ?>
        <div style="color: rgb(204, 0, 0)"><?php echo $errors['userNotFoundError'] ?></div>
    <?php } ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit" formnovalidate>
        Sign in
    </button>
</form>


</body>
</html>
