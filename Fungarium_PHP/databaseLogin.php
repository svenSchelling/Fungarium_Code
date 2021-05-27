 <?php
    // Database Login
    $user = 'robin'; // !!! change to your username !!!
    $pass = 'raiders'; // !!! change to your password !!!
    $dbname = 'fungarium'; // !!! change to your dbname !!!
    $db = new PDO( 'mysql:host=localhost;dbname=' . $dbname, $user, $pass );
    
    // activate Errors
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 ?>
