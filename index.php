<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/tools/db_process.php');

$name = "";
$email = "";
$errors = [];

if (isset($_POST['submit']))
{
	$name = (!empty($_POST['name'])) ? $_POST['name'] : "";
	$email = (!empty($_POST['email'])) ? $_POST['email'] : "";
	
	$name = mysqli_real_escape_string($link, $name);
	$email = mysqli_real_escape_string($link, $email);
	
	$name = htmlspecialchars($name);
	$email = htmlspecialchars($email);
	
  $name = trim($name);
  $email = trim($email);

  if (!strlen($name))
  {
    $errors[] = "Поле Имя не должно быть пустым!";
  }
  
  if (!strlen($email))
  {
    $errors[] = "Поле Email не должно быть пустым!";
  }
  
  if (strpos($email, "@") === false)
  {
    $errors[] = "Поле Email должно быть валидным Email адресом!";
  }

  if (empty($errors))
  {
    $query = sprintf("INSERT INTO feedback (`name`, `email`) VALUES ('%s', '%s')", $name, $email);
    $dbResult = mysqli_query($link, $query);
    
    header('Location: /');
    die();
  }

}

?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Your awesome cats</title>

	<!-- Favicon -->
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA/b8AAIZhAAD+fwAAhaEAAP//AAD//wAAz/MAAM/zAADP8wAA//8AAPgfAAB37gAAr/UAAN/7AAD//wAA" rel="icon" type="image/x-icon" />

	<!-- Bootstrap 4 CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="/css/style.css">

	<!-- JQuery 3.4.1 -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Custom JS -->
	<script src="/js/script.js" type="text/javascript"></script>
</head>
<body>
	<header></header>
	<section class="main">
		<div class="container mt-3">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Возьмите котёнка из приюта!</h1>
				</div>
				<div class="col-md-4 image-wrapper">
					<img src="images/cat-1.jpg" class="img-fluid">
				</div>
				<div class="col-md-4 image-wrapper">
					<img src="images/cat-2.jpg" class="img-fluid">
				</div>
				<div class="col-md-4 image-wrapper">
					<img src="images/cat-3.jpg" class="img-fluid">
				</div>
				<div class="col-md-12 text-center">
					<h3><em>Котики - самое пушистое, что есть на земле</em></h3>
				</div>
				<div class="col-md-12 text-center mt-4">
					<h3>Не всё равно? Оставьте свои данные и мы свяжемся с вами!</h3>
				</div>
				<div class="col-md-6 offset-md-3 mt-4">

          <?if(!empty($errors)){?>
            <div class="alert alert-danger" role="alert">
              <ul>
              <?foreach($errors as $key => $value){?>
                <li><?=$value?></li>
              <?}?>
              </ul>
            </div>
          <?}?>
        
					<form action="" method="post">
						<div class="form-group">
						    <label for="user-email">Email</label>
						    <input type="email" name="email" class="form-control" id="user-email" placeholder="Введите email" value="<?=$email?>">
						</div>
						<div class="form-group">
						    <label for="user-name">Имя</label>
						    <input type="text" name="name" class="form-control" id="user-name" placeholder="Введите ваше имя" value="<?=$name?>">
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Отправить</button>
					</form>
				</div>
				
			</div>
		</div>

	</section>
	<footer></footer>
</body>
</html>