<?php
require 'config.inc.php';
  
session_start();

$message = '';

if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = new mysqli(
      MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
           $db->real_escape_string($_POST['name']));

    $result = $db->query($sql);
    $row = $result->fetch_object();

    if ($row != null) {
      $hash = $row->hash;
      if (password_verify($_POST['password'], $hash)) {
        $message = 'Login successful.';

        $_SESSION['username'] = $row->name;
        $_SESSION['isAdmin'] = $row->isAdmin;
      } else {
        $message = 'Login failed.';
      }
    } else {
      $message = 'Login failed.';
    }
    
    $db->close();
}


?>
<?php
readfile('header.tmpl.html');

echo "<div class='text-info'>$message</div>";
?>
<form method="post" action="">
  <div class="form-group">
    <label for="name">User name</label> <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="password">Password</label> <input type="password" class="form-control" name="password" id="password"><br>
  </div>
  <input type="submit" value="Login" class="btn btn-primary">
</form>
</div>
</div>
<?php
readfile('footer.tmpl.html');
?>