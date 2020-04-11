<html>
   <head>
      <title>Connecting MySQL Server</title>
   </head>
   <body>
      <?php
         $dbhost = 'remotemysql.com:3306';
         $dbuser = 'AbT5ydOVVn';
         $dbpass = '1nN7Vx4PQ3';
         //mysql -u AbT5ydOVVn -h remotemysql.com -P 3306 -D AbT5ydOVVn -p
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
         
         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }
         echo 'Connected successfully';
         mysqli_close($conn);
      ?>
   </body>
</html>