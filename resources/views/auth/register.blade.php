
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Регистрация пользователя</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin" method="post">
        {!!csrf_field()!!}
      <div class="text-center mb-4">
        <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Пожалуйста, пройтите процедуру регистрации.</h1>
        <p>Пройдя процедуру регистрации у Вас будет возможность пользоваться ресурсом без ограничений.</p>
      </div>

      <div class="form-label-group">
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
        <input type="password" id="inputPassword" name="password_confirmation" class="form-control" placeholder="Подтвердить пароль" required>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="auth" value="1"> Авторизироваться
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
    </form>
  </body>
</html>
