<?php
   if( $_REQUEST["name"] || $_REQUEST["age"] ) {
      echo "Welcome ". $_GET['name']. "<br />";
      echo "You are ". $_POST['age']. " years old.";
//       exit();
   }
?>
<html>
   <body>
      
      <form action = "test.php?name=test-name" method = "POST">
         Age: <input type = "text" name = "age" value="test-age" />
         <input type = "submit" />
      </form>
      
   </body>
</html>