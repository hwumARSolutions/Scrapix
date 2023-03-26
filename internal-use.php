<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Internal Use | Tracking Record Page</title>
</head>

<style>
  table, td, th {
  border: 1px solid black;
  text-align: center;
  }

  table {
  width: 50%;
  border-collapse: collapse;
  }
</style>

<body>
  <div class="container">
    <div class="row">
      <h2>User Record</h2>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>username</th>
            <th>email</th>
            <th>password</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include_once('connect.php');
          $a = 1;
          $stmt = $mysqli->query("SELECT * FROM user");
          while($user = $stmt->fetch_assoc()) {
          ?>
          <tr>
            <td>
              <?php echo $user['user_id']; ?>
            </td>
            <td>
              <?php echo $user['username']; ?>
            </td>
            <td>
              <?php echo $user['email']; ?>
            </td>
            <td>
              <?php echo $user['password']; ?>
            </td>
            <?php
          }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>