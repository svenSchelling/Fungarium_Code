 <?php
 if(isset($_POST['lichtende']) || isset($_POST['lichtstart']) || isset($_POST['mindesttemp'])|| isset($_POST['hoechsttemp']) || isset($_POST['mindesttempNacht'])|| isset($_POST['hoechsttempNacht'])|| isset($_POST['mindestfeuchte'])|| isset($_POST['befeuchtungsdauer']) || isset($_POST['lueftungsdauer']) || isset($_POST['lueftungsintervall'])){

        // new data submitted by User
        $wertLichtstart =  $_POST['lichtstart']; 
        $wertLichtende = $_POST['lichtende'];
        $wertMindesttemp =  $_POST['mindesttemp'];
        $wertHoechsttemp = $_POST['hoechsttemp'];
        $wertMindesttempNacht =  $_POST['mindesttempNacht'];
        $wertHoechsttempNacht = $_POST['hoechsttempNacht'];
        $wertMindestfeuchte =  $_POST['mindestfeuchte'];
        $wertBefeuchtungsdauer = $_POST['befeuchtungsdauer'];
        $wertLueftungsdauer =  $_POST['lueftungsdauer'];
        $wertlueftungsintervall = $_POST['lueftungsintervall'];
        
                
        // Database Login
        include_once "databaseLogin.php";

        // write new data in the table
try {
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertLichtstart'");
        $sql->execute(array('ID' => 1, 'Bezeichnung' => 'Lichtstart', 'Wert' => $wertLichtstart)); // write new data   
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertLichtende'");
        $sql->execute(array('ID' => 2, 'Bezeichnung' => 'Lichtende', 'Wert' => $wertLichtende)); // write new data   
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertMindesttemp'");
        $sql->execute(array('ID' => 3, 'Bezeichnung' => 'Mindesttemperatur', 'Wert' => $wertMindesttemp)); // write new data   
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertHoechsttemp'");
        $sql->execute(array('ID' => 4, 'Bezeichnung' => 'Höchsttemperatur', 'Wert' => $wertHoechsttemp)); // write new data   
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertMindesttempNacht'");
        $sql->execute(array('ID' => 5, 'Bezeichnung' => 'MindesttemperaturNacht', 'Wert' => $wertMindesttempNacht)); // write new data   
       
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertHoechsttempNacht'");
        $sql->execute(array('ID' => 6, 'Bezeichnung' => 'HöchsttemperaturNacht', 'Wert' => $wertHoechsttempNacht)); // write new data  
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertMindestfeuchte'");
        $sql->execute(array('ID' => 7, 'Bezeichnung' => 'Mindestfeuchtigkeit', 'Wert' => $wertMindestfeuchte)); // write new data   
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertBefeuchtungsdauer'");
        $sql->execute(array('ID' => 8, 'Bezeichnung' => 'Befeuchtungsdauer', 'Wert' => $wertBefeuchtungsdauer)); // write new data   
       
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertLueftungsdauer'");
        $sql->execute(array('ID' => 9, 'Bezeichnung' => 'Lüftungsdauer', 'Wert' => $wertLueftungsdauer)); // write new data  
        
        $sql =  $db->prepare("INSERT INTO einstellungen (ID,Bezeichnung,Wert) VALUES (:ID, :Bezeichnung, :Wert) ON DUPLICATE KEY UPDATE Wert = '$wertlueftungsintervall'");
        $sql->execute(array('ID' => 10, 'Bezeichnung' => 'Lüftungsintervall', 'Wert' => $wertlueftungsintervall)); // write new data   

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
    }
?>
