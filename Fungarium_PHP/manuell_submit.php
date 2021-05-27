<?php
    //-----------------------------------------------------------
    // submit new entered data (form) to DB
    //-----------------------------------------------------------

 if(isset($_POST['licht'])){
        
        $licht =  $_POST['licht']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$licht'");
        $sql->execute(array('ID' => 1, 'Bezeichnung' => 'licht', 'Wert' => $licht)); // write new data   

    }
    
    if(isset($_POST['heizung'])){
        
        $heizung =  $_POST['heizung']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$heizung'");
        $sql->execute(array('ID' => 2, 'Bezeichnung' => 'heizung', 'Wert' => $heizung)); // write new data   

    }  
    
    if(isset($_POST['kuehlung'])){
        
        $kuehlung =  $_POST['kuehlung']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$kuehlung'");
        $sql->execute(array('ID' => 3, 'Bezeichnung' => 'kuehlung', 'Wert' => $kuehlung)); // write new data   

    }
                    
    if(isset($_POST['fogger'])){
        
        $fogger =  $_POST['fogger']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$fogger'");
        $sql->execute(array('ID' => 4, 'Bezeichnung' => 'fogger', 'Wert' => $fogger)); // write new data   

    }
    
    if(isset($_POST['lueftung'])){
        
        $lueftung =  $_POST['lueftung']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$lueftung'");
        $sql->execute(array('ID' => 5, 'Bezeichnung' => 'lueftung', 'Wert' => $lueftung)); // write new data   

    }
    
    if(isset($_POST['lueftungNiedertourig'])){
        
        $lueftungNiedertourig =  $_POST['lueftungNiedertourig']; 
        
        // Database Login
        include_once "databaseLogin.php";

        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$lueftungNiedertourig'");
        $sql->execute(array('ID' => 6, 'Bezeichnung' => 'lueftungNiedertourig', 'Wert' => $lueftungNiedertourig)); // write new data   

    }
    
    if(isset($_POST['sensorneustart'])){

        // new data submitted by User
        $sensorneustart =  $_POST['sensorneustart']; 
        
        // Database Login
        include_once "databaseLogin.php";
        
        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$sensorneustart'");
        $sql->execute(array('ID' => 7, 'Bezeichnung' => 'sensorneustart', 'Wert' => $sensorneustart)); // write new data   

        
        }
        
    if(isset($_POST['befeuchtungsroutine'])){

        // new data submitted by User
        $befeuchtungsroutine =  $_POST['befeuchtungsroutine']; 
        
        // Database Login
        include_once "databaseLogin.php";
        
        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$befeuchtungsroutine'");
        $sql->execute(array('ID' => 8, 'Bezeichnung' => 'befeuchtungsroutine', 'Wert' => $befeuchtungsroutine)); // write new data   

        
        }
        
    if(isset($_POST['autoManu'])){

        // new data submitted by User
        $autoManu =  $_POST['autoManu']; 
        
        // Database Login
        include_once "databaseLogin.php";
        
        $sql =  $db->prepare("INSERT INTO manuell (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$autoManu'");
        $sql->execute(array('ID' => 9, 'Bezeichnung' => 'autoManu', 'Wert' => $autoManu)); // write new data   

        
        }
?>
