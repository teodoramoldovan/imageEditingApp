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
<form class="form-signin" method="post" action="/user/registerPost">


    <h1 class="h3 mb-3 font-weight-normal" style="color:white">Register</h1>


    <div class="form-group">
    <label for="inputName" class="sr-only">Name</label>
    <input type="text" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"
           name="name" id="inputName" class="form-control"
           placeholder="Name" required autofocus>
    </div>

    <div class="form-group">
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
           name="email" id="inputEmail" class="form-control"
           placeholder="Email address" required>
        <?php if (isset($_POST) && $this->errors && array_key_exists('invalidEmailFormatError',$this->errors)) { ?>
            <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['invalidEmailFormatError'] ?></div>
        <?php } ?>
        <?php if (isset($_POST) && $this->errors && array_key_exists('userAlreadyExistsError',$this->errors)) { ?>
            <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['userAlreadyExistsError'] ?></div>
        <?php } ?>
    </div>


    <div class="form-group">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control"
           placeholder="Password" required>
    </div>

    <div class="form-group">
    <label for="inputPasswordConfirmation" class="sr-only">Confirm password</label>
    <input type="password" name="passwordConfirmation" id="inputPasswordConfirmation" class="form-control"
           placeholder="Confirm password" required>
        <?php if (isset($_POST) && $this->errors && array_key_exists('passwordMatchError',$this->errors)) { ?>
            <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['passwordMatchError'] ?></div>
        <?php } ?>
    </div>

    <?php if (isset($_POST) && $this->errors && array_key_exists('emptyFieldsError',$this->errors)) { ?>
        <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['emptyFieldsError'] ?></div>
    <?php } ?>

    <br/>



    <button class="btn btn-lg btn-primary btn-block" type="submit" formnovalidate>
        Register
    </button>
</form>




</body>
</html>
