<?php
    //-----------------------------------------------------------
    // submit new entered data (form) to DB
    //-----------------------------------------------------------
    
    //echo shell_exec('sh /home/pi/Fungarium/start.sh');
    //$message = "START";
    //echo "<script type='text/javascript'>alert('$message');</script>";
            
    if(isset($_POST['licht'])){
        
        $licht =  $_POST['licht']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$licht'");
        $sql->execute(array('ID' => 1, 'Bezeichnung' => 'licht', 'Wert' => $licht)); // write new data   

    }
    
     if(isset($_POST['lichtPin'])){
        $lichtPin =  $_POST['lichtPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$lichtPin'");
        $sql->execute(array('ID' => 1, 'Bezeichnung' => 'licht', 'Pin' => $lichtPin)); // write new data   

    }
    
    if(isset($_POST['heizung'])){
        
        $heizung =  $_POST['heizung']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$heizung'");
        $sql->execute(array('ID' => 2, 'Bezeichnung' => 'heizung', 'Wert' => $heizung)); // write new data   

    }
    
     if(isset($_POST['heizungPin'])){
        $heizungPin =  $_POST['heizungPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$heizungPin'");
        $sql->execute(array('ID' => 2, 'Bezeichnung' => 'heizung', 'Pin' => $heizungPin)); // write new data   

    }
    
    if(isset($_POST['kuehlung'])){
        
        $kuehlung =  $_POST['kuehlung']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$kuehlung'");
        $sql->execute(array('ID' => 3, 'Bezeichnung' => 'kuehlung', 'Wert' => $kuehlung)); // write new data   

    }
    
     if(isset($_POST['kuehlungPin'])){
        $kuehlungPin =  $_POST['kuehlungPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$kuehlungPin'");
        $sql->execute(array('ID' => 3, 'Bezeichnung' => 'kuehlung', 'Pin' => $kuehlungPin)); // write new data   

    }
    
    if(isset($_POST['fogger'])){
        
        $fogger =  $_POST['fogger']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$fogger'");
        $sql->execute(array('ID' => 4, 'Bezeichnung' => 'fogger', 'Wert' => $fogger)); // write new data   

    }
    
     if(isset($_POST['foggerPin'])){
        $foggerPin =  $_POST['foggerPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$foggerPin'");
        $sql->execute(array('ID' => 4, 'Bezeichnung' => 'fogger', 'Pin' => $foggerPin)); // write new data   

    }
    
    if(isset($_POST['lueftung'])){
        
        $lueftung =  $_POST['lueftung']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$lueftung'");
        $sql->execute(array('ID' => 5, 'Bezeichnung' => 'lueftung', 'Wert' => $lueftung)); // write new data   

    }
    
     if(isset($_POST['lueftungPin'])){
        $lueftungPin =  $_POST['lueftungPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$lueftungPin'");
        $sql->execute(array('ID' => 5, 'Bezeichnung' => 'lueftung', 'Pin' => $lueftungPin)); // write new data   

    }
    if(isset($_POST['lueftungNiedertourig'])){
        
        $lueftungNiedertourig =  $_POST['lueftungNiedertourig']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$lueftungNiedertourig'");
        $sql->execute(array('ID' => 6, 'Bezeichnung' => 'lueftungNiedertourig', 'Wert' => $lueftungNiedertourig)); // write new data   

    }
    
     if(isset($_POST['lueftungNiedertourigPin'])){
        $lueftungNiedertourigPin =  $_POST['lueftungNiedertourigPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$lueftungNiedertourigPin'");
        $sql->execute(array('ID' => 6, 'Bezeichnung' => 'lueftungNiedertourig', 'Pin' => $lueftungNiedertourigPin)); // write new data   

    }
    
    if(isset($_POST['sensor'])){
        
        $sensor =  $_POST['sensor']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$sensor'");
        $sql->execute(array('ID' => 7, 'Bezeichnung' => 'sensor', 'Wert' => $sensor)); // write new data   

    }
    
     if(isset($_POST['sensorPin'])){
        $sensorPin =  $_POST['sensorPin']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Pin) VALUES (:ID, :Bezeichnung, :Pin) ON DUPLICATE KEY UPDATE Pin = '$sensorPin'");
        $sql->execute(array('ID' => 7, 'Bezeichnung' => 'sensor', 'Pin' => $sensorPin)); // write new data   

    }

    if(isset($_POST['terraFunga'])){
        
        $terraFunga =  $_POST['terraFunga']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$terraFunga'");
        $sql->execute(array('ID' => 8, 'Bezeichnung' => 'terraFunga', 'Wert' => $terraFunga)); // write new data   

    }
    
     if(isset($_POST['LichtAlsHeizung'])){
        $LichtAlsHeizung =  $_POST['LichtAlsHeizung']; 

        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO voreinstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$LichtAlsHeizung'");
        $sql->execute(array('ID' => 9, 'Bezeichnung' => 'LichtAlsHeizung', 'Wert' => $LichtAlsHeizung)); // write new data   

    }
?>
