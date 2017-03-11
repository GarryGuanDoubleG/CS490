<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="narrowPage">
    <div class="card">
    <form action="index.php" method="post" class="login-form">
      <input type="text" placeholder="username" name="username" required/>
      <input type="password" placeholder="password" name="password" required/>
      <button class="popup">login</button>
    </form>
   <?php require 'login.php';?>
  </div>
</div>
</body>
</html>
