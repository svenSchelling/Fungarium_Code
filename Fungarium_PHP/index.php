<!DOCTYPE html>
<html lang="de">
    
<!-- Site: 'Menü' -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title id="title" ></title>

        <!-- homescreen icon -->
        <link rel="icon" type="image/ico" id="IconStart">
        
        <!-- css stylesheets --> 
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/tooplate.css">
        <link rel="stylesheet" href="css/time.css">
        
        <!-- input value out of range -> red border -->
        <style>
            input:out-of-range {
                border:2px solid red;
            }
            .bild {
                width: 100%;
                height: 100%;
            }
        </style>
    </head>

    <body id="reportsPage">
        <div class="" id="home">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- navigationbar with dropdown menu -->
                        <nav class="navbar navbar-expand-xl navbar-light bg-light">
                            <a class="navbar-brand" href="#">
                                <!-- navigationbar icon -->
                                <img id="homeIcon">
                                <h1 class="tm-site-title mb-0" id="header"></h1>
                            </a>
                            <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mx-auto">
                                    
                                    <!-- pages in navigationbar -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Menü</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="temperature.php">Temperatur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="feuchtigkeit.php">Feuchtigkeit</a>
                                    </li>                               
                                    <li class="nav-item">
                                        <a class="nav-link" href="protokoll.php">Protokoll</a>
                                    </li>         
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                
                <!-- 1. white block, includes 'Lichteinstellungen': 'Lichtstart' & 'Lichtende'-->
                 <div class="row tm-content-row tm-mt-big">
                    <div class="tm-col tm-col-big" id="lichteinstellungen" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Licht Einstellungen</h2>
                            <form method="get" action="" id="contactform">
                                <label for="lichtstart" method>Lichtstart:</label>
                                <input type="time" id="lichtstart" name="lichtstart" 
                                    min="09:00" max="18:00" value= <?php echo einstellungen('Lichtstart');?> required>

                                <label for="lichtende">Lichtende:</label>
                                <input type="time" id="lichtende" name="lichtende" 
                                    min="09:00" max="18:00" value= <?php echo einstellungen('Lichtende');?> required>
                            </form>
                            <input type="submit" class="submit">
                                <div class="result">
                            </div>
                        </div>
                    </div>
                    
                    <!-- 2. white block, includes 'Temperatureinstellungen': 'Mindesttemperatur' & 'Höchsttemperatur'-->
                    <div class="tm-col tm-col-big" id="temperatureinstellungen" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Temperatur Einstellungen</h2>
                            <form method="get" action="" id="contactform">
                                <label for="mindesttemp">Mindesttemperatur:</label>
                                    <input id="mindesttemp" name="mindesttemp" type="number" min="0" max="25" step="1" maxlength="2" size="5" value= <?php echo einstellungen('Mindesttemperatur');?> required>
                                    °C
                                <label for="hoechsttemp">Höchsttemperatur:</label>
                                    <input id="hoechsttemp" name="hoechsttemp" type="number" min="15" max="35" step="1" maxlength="2" size="5" value= <?php echo einstellungen('Höchsttemperatur');?> required>
                                    °C
                                <label for="mindesttempNacht">Mindesttemperatur nachts:</label>
                                    <input id="mindesttempNacht" name="mindesttempNacht" type="number" min="0" max="25" step="1" maxlength="2" size="5" value= <?php echo einstellungen('MindesttemperaturNacht');?> required>
                                    °C
                                <label for="hoechsttempNacht">Höchsttemperatur nachts:</label>
                                    <input id="hoechsttempNacht" name="hoechsttempNacht" type="number" min="15" max="35" step="1" maxlength="2" size="5" value= <?php echo einstellungen('HöchsttemperaturNacht');?> required>
                                    °C
                                </form>
                                <input type="submit" class="submit" >
                                <div class="result">
                            </div>
                        </div>
                    </div>
                    
                    <!-- 3. white block, includes 'Luftfeuchtigkeitseinstellungen': 'Mindestfeuchte' & 'Befeuchtungsdauer'-->
                    <div class="tm-col tm-col-big" id="luftfeuchtigkeitseinstellungen" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Luftfeuchtigkeit Einstellungen</h2>
                            <form method="get" action="" id="contactform">
                                <label for="mindestfeuchte">Mindestfeuchtigkeit:</label>
                                    <input id="mindestfeuchte" name="mindestfeuchte" type="number" min="50" max="100" step="1" maxlength="3" size="5" value= <?php echo einstellungen('Mindestfeuchtigkeit');?> required>
                                    %
                                 
                                <label for="befeuchtungsdauer">Befeuchtungsdauer:</label>
                                    <input id="befeuchtungsdauer" name="befeuchtungsdauer" type="number" min="5" max="30" step="1" maxlength="2" size="5" value= <?php echo einstellungen('Befeuchtungsdauer');?> required>
                                    min
                                    
                                    </form>
                                    <input type="submit" class="submit" >
                                <div class="result">
                            </div>                                
                        </div>
                    </div>
                    
                    <!-- 4. white block, includes 'Lüftungseinstellungen': 'Lüftungsdauer'-->
                    <div class="tm-col tm-col-big" id="lueftungseinstellungen" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Lüftung Einstellungen</h2>
                            <form method="get" action="" id="contactformLuft">
                                <label for="lueftungsdauer">Lüftungsdauer:</label>
                                    <input id="lueftungsdauer" name="lueftungsdauer" type="number" min="5" max="30" step="1" maxlength="2" size="5" value= <?php echo einstellungen('Lüftungsdauer');?> required>
                                    min
                                  
                                <label for="lueftungsintervall">Lüftungsintervall:</label>
                                    <input id="lueftungsintervall" name="lueftungsintervall" type="number" min="0" max="255" step="1" maxlength="3" size="5" value= <?php echo einstellungen('Lüftungsintervall');?> required>
                                    min
                                    
                                    </form>
                                    <input type="submit" class="submit" >
                                <div class="result">
                            </div>                
                        </div>
                    </div>
                    
                      <div class="tm-col tm-col-big" id="divshow" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Manueller Aktorbetrieb</h2>                                                 
                                <label for="lichtManu" id="lichtManuLabel" method>Licht:</label>
                                    <label class="switch" id="lichtManuSw">
                                      <input type="checkbox" id="lichtManu" name="lichtManu" <?php echo manuell("licht");?>>
                                      <span class="slider round"></span>
                                    </label>                       
                                <label for="heizungManu" id="heizungManuLabel" method>Heizung:</label>
                                    <label class="switch" id="heizungManuSw">
                                      <input type="checkbox" id="heizungManu" name="heizungManu" <?php echo manuell("heizung");?>>
                                      <span class="slider round"></span>
                                    </label>                                
                                <label for="kuehlungManu" id="kuehlungManuLabel" method>Kühlung:</label>
                                    <label class="switch" id="kuehlungManuLabelSwitch">
                                      <input type="checkbox" id="kuehlungManu" name="kuehlungManu" <?php echo manuell("kuehlung");?>>
                                      <span class="slider round"></span>
                                    </label>                                 
                                <label for="foggerManu" id="foggerManuLabel" method>Fogger:</label>
                                    <label class="switch" id="foggerManuLabelSwitch">
                                      <input type="checkbox" id="foggerManu" name="foggerManu" <?php echo manuell("fogger");?>>
                                      <span class="slider round"></span>
                                    </label>                                                                          
                                <label for="lueftungManu" id="lueftungManuLabel" method>Lüftung:</label>
                                    <label class="switch" id="lueftungManuLabelSwitch">
                                      <input type="checkbox" id="lueftungManu" name="lueftungManu" <?php echo manuell("lueftung");?>>
                                      <span class="slider round"></span>
                                    </label>                                   
                                      <label for="lueftungNiedertourigManu" id="lueftungNiedertourigManuLabel" method>Lüftung leicht:</label>
                                <label class="switch" id="lueftungNiedertourigManuLabelSwitch">
                                      <input type="checkbox" id="lueftungNiedertourigManu" name="lueftungNiedertourigManu" <?php echo manuell("lueftungNiedertourig");?>>
                                      <span class="slider round"></span>
                                </label>  
                            </div>
                        </div>
                        
                        <div class="tm-col tm-col-big" id="manuAktio" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Manuelle Aktionen</h2>
                                <label for="sensorneustart" method>Sensorneustart:</label>
                                    <input type="submit" class="sensorneustart" value="Starten">
                                <label for="befeuchtungsroutine" method>Befeuchtungsroutine:</label>
                                    <input type="submit" class="befeuchtungsroutine" value="Starten">
                        </div>
                    </div>
                    
                    <div class="tm-col tm-col-big" id="steuerung" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Steuerungsauswahl</h2>
                                  <table border="0" cellspacing="0" cellpadding="4">
                                      <tbody>
                                        <tr>
                                          <td>                                
                                            <label for="autoManu" method>Automatisch/Manuell:</label>
                                          </td>
                                          <td>
                                            <label class="switch">
                                              <input type="checkbox" id="autoManu" name="autoManu" <?php echo manuell("autoManu");?>>
                                              <span class="slider round"></span>
                                            </label>  
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>                                
                                            <label for="voreinstellungAus" method>Voreinstellungen:</label>
                                          </td>
                                          <td>
                                            <label class="switch">
                                              <input type="checkbox" id="voreinstellungAus" name="voreinstellungAus">
                                              <span class="slider round"></span>
                                            </label>   
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>                                
                                              <label for="TerraFunga" id="TerraFungaLabel" method>Terrarium/Fungarium:</label>
                                          <td>
                                            <label class="switch" id="TerraFungaSw">
                                              <input type="checkbox" id="TerraFunga" name="TerraFunga" <?php echo voreinstellungen("TerraFunga");?>>
                                              <span class="slider round"></span>
                                            </label>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>                                
                                              <label for="LichtAlsHeizung" id="LichtAlsHeizungLabel" method>Licht als Heizung:</label>
                                          <td>
                                            <label class="switch" id="LichtAlsHeizungSw">
                                              <input type="checkbox" id="LichtAlsHeizung" name="LichtAlsHeizung" <?php echo voreinstellungen("LichtAlsHeizung");?>>
                                              <span class="slider round"></span>
                                            </label>
                                          </td>
                                        </tr>
                                      </tbody>
                                  </table>  
                            </div>
                        </div>    
                                        
                    <!-- 5. white block, includes 'Vorhandene Komponenten'-->                    
                    <div class="tm-col tm-col-big" id="komponentenID" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Vorhandene Komponenten</h2>
                                   <table border="0" cellspacing="0" cellpadding="4">
                                      <tbody>
                                        <tr>
                                          <td>Licht:</td>
                                          <td>
                                              <label class="switch">
                                                <input type="checkbox" id="licht" name="licht" <?php echo voreinstellungen("licht");?>>
                                                <span class="slider round"></span>
                                              </label>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Heizung:</td>
                                          <td>
                                              <label class="switch">
                                                <input type="checkbox" id="heizung" name="heizung" <?php echo voreinstellungen("heizung");?>>
                                                <span class="slider round"></span>
                                              </label>     
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Kühlung:</td>
                                          <td>
                                              <label class="switch">
                                                  <input type="checkbox" id="kuehlung" name="kuehlung" <?php echo voreinstellungen("kuehlung");?>>
                                                  <span class="slider round"></span>
                                              </label>   
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Fogger:</td>
                                          <td>
                                              <label class="switch">
                                                  <input type="checkbox" id="fogger" name="fogger" <?php echo voreinstellungen("fogger");?>>
                                                  <span class="slider round"></span>
                                              </label>     
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Lüftung:</td>
                                          <td>
                                            <label class="switch">
                                              <input type="checkbox" id="lueftung" name="lueftung" <?php echo voreinstellungen("lueftung");?>>
                                              <span class="slider round"></span>
                                            </label>  
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Lüftung leicht:</td>
                                          <td>
                                            <label class="switch">
                                              <input type="checkbox" id="lueftungNiedertourig" name="lueftungNiedertourig" <?php echo voreinstellungen("lueftungNiedertourig");?>>
                                              <span class="slider round"></span>
                                            </label>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Sensor:</td>
                                          <td>
                                            <label class="switch">
                                              <input type="checkbox" id="sensor" name="sensor" <?php echo voreinstellungen("sensor");?>>
                                              <span class="slider round"></span>
                                            </label>
                                          </td>
                                        </tr>
                                      </tbody>
                                  </table>  
                            </div>                                
                        </div>
                        
                    <!-- 5. white block, includes 'Pinbelegung'-->                    
                    <div class="tm-col tm-col-big" id="Pinbelegung" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">GPIO-Pinbelegung</h2>
                                <details>
                                    <summary>WPI-Pinbelegung</summary>
                                    <img src="/favicon.ico/PIPinbelegungWPI.PNG"
                                    class="bild">
                                    <p>Verwenden folgender Pinbelegung: <b>GPIO#</b></p>
                                </details>
                                    <table border="0" cellspacing="0" cellpadding="4">
                                      <tbody>
                                        <tr>
                                          <td>Licht:</td>
                                          <td>
                                            <input id="lichtPin" name="lichtPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("licht");?> >
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Heizung:</td>
                                          <td>
                                            <input id="heizungPin" name="heizungPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("heizung");?> >
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Kühlung:</td>
                                          <td>
                                            <input id="kuehlungPin" name="kuehlungPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("kuehlung");?> >
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Fogger:</td>
                                          <td>
                                            <input id="foggerPin" name="foggerPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("fogger");?> > 
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Lüftung:</td>
                                          <td>
                                            <input id="lueftungPin" name="lueftungPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("lueftung");?> >
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Lüftung leicht:</td>
                                          <td>
                                            <input id="lueftungNiedertourigPin" name="lueftungNiedertourigPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("lueftungNiedertourig");?> >
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>DHT-Sensor:</td>
                                          <td>
                                            <input id="sensorPin" name="sensorPin" type="number" placeholder= "--" min="0" max="31" step="1" maxlength="2" size="2" value= <?php echo pinbelegung("sensor");?> >
                                          </td>
                                        </tr>
                                      </tbody>
                                  </table>
                                <input type="submit" class="submitPin" id="submitPin" name="submitPin">
                                <div class="resultPin">
                            </div>                                
                        </div>
                  </div>
                </div>
                
        <?php
        //------------------------------------------------------------------------------------
        // function to fill the input elements with the current data out of the DB
        // updates when site gets reloaded
        //------------------------------------------------------------------------------------
            
            // get 'einstellungen' out of DB -> write current 'einstellung' value in input element
            function einstellungen(String $Bezeichnung)
                {         
                    // Database Login
                    include "databaseLogin.php";
                    
                    // create table "einstellungen" when the data is submitted for the first time
                    $sql = "CREATE TABLE IF NOT EXISTS einstellungen (
                    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Bezeichnung VARCHAR(30) NOT NULL,
                    Wert VARCHAR(8) NOT NULL,
                    Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    $db->exec($sql);
                    
                    $res = $db->prepare('SELECT * FROM einstellungen WHERE Bezeichnung = :Bezeichnung');
                    $res->execute(array(':Bezeichnung' => $Bezeichnung ));

                    while($row = $res->fetch())
                    {
                        $einstellung = $row['Wert'];
                    }
                    return $einstellung;
                }
                
            function pinbelegung(String $Bezeichnung)
                {         
                    // Database Login
                    include "databaseLogin.php";
                    
                    $sql = "CREATE TABLE IF NOT EXISTS voreinstellungen (
                    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Bezeichnung VARCHAR(30) NOT NULL,
                    Wert VARCHAR(4) NULL,
                    Pin VARCHAR(4) NULL,
                    Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    $db->exec($sql);
                    
                    $res = $db->prepare('SELECT * FROM voreinstellungen WHERE Bezeichnung = :Bezeichnung');
                    $res->execute(array(':Bezeichnung' => $Bezeichnung ));

                    while($row = $res->fetch())
                    {
                        $returnWert = $row['Pin'];
                    }
                    return $returnWert;
                    
                }
                
            function voreinstellungen(String $Bezeichnung)
                {         
                    // Database Login
                    include "databaseLogin.php";
                    
                    // create table "einstellungen" when the data is submitted for the first time
                    $sql = "CREATE TABLE IF NOT EXISTS voreinstellungen (
                    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Bezeichnung VARCHAR(30) NOT NULL,
                    Wert VARCHAR(4) NULL,
                    Pin VARCHAR(4) NULL,
                    Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    $db->exec($sql);
                    
                    // execute query
                    $result = $db->query("SELECT * FROM voreinstellungen WHERE Bezeichnung='$Bezeichnung'");

                    foreach ($result as $row)
                    
                    $returnWert = $row["Wert"];
                    
                        if ($returnWert) {
                                $returnWert = 'checked';
                            }
                        else {
                                $returnWert = 'unchecked';
                            }
                    return $returnWert;
                }
                
            function manuell(String $Bezeichnung)
                {         
                    // Database Login
                    include "databaseLogin.php";
                    
                    // create table "einstellungen" when the data is submitted for the first time
                    $sql = "CREATE TABLE IF NOT EXISTS manuell (
                    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Bezeichnung VARCHAR(30) NOT NULL,
                    Wert TINYINT NOT NULL,
                    Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    $db->exec($sql);
                    
                    // execute query
                    $result = $db->query("SELECT * FROM manuell WHERE Bezeichnung='$Bezeichnung'");

                    foreach ($result as $row)
                    
                    $einstellungen = $row["Wert"];
                    
                    if ($einstellungen) {
                            $returnWert = 'checked';
                        }
                        else {
                            $returnWert = 'unchecked';
                        }
                        return $returnWert;
                }
        ?>  
        
        <!-- java scripts -->  
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tooplate-scripts.js"></script>
        <script src= "https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <script src="js/submitAutoData.js"></script>
        <script src="js/submitPinbelegung.js"></script>
        <script src="js/actionManuAutoSwitch.js"></script>
        
        <script src="js/actionTerraFungaTitle.js"></script>
        
        <script src="js/ManualComponentSwitch/ShowHide/actionLichtSwitch.js"></script>
        <!-- js to submit entered data to the DB -->
        <!-- each white block has a separate js -->
        <script>
         $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#heizung")[0].checked)
            {
                $("#heizungManu").show(); 
                $("#heizungManuLabel").show(); 
                $("#heizungManuSw").show(); 
                isShow = true;
            }else{
                $("#heizungManu").hide();
                $("#heizungManuLabel").hide();  
                $("#heizungManuSw").hide(); 
                isShow = false;
            }
            
                $("#heizung").click(function(){
                    if(isShow == false){
                        $("#heizungManu").show(); 
                        $("#heizungManuLabel").show();
                        $("#heizungManuSw").show();  
                        isShow = true;
                    }else{
                        $("#heizungManu").hide();
                        $("#heizungManuLabel").hide(); 
                        $("#heizungManuSw").hide(); 
                        isShow = false;
                    }
                })
            }
        );
        </script>
        
        <script>
         $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#kuehlung")[0].checked)
            {
                $("#kuehlungManu").show(); 
                $("#kuehlungManuLabel").show(); 
                $("#kuehlungManuLabelSwitch").show(); 
                isShow = true;
            }else{
                $("#kuehlungManu").hide();
                $("#kuehlungManuLabel").hide();  
                $("#kuehlungManuLabelSwitch").hide(); 
                isShow = false;
            }
            
                $("#kuehlung").click(function(){
                    if(isShow == false){
                        $("#kuehlungManu").show(); 
                        $("#kuehlungManuLabel").show();
                        $("#kuehlungManuLabelSwitch").show();  
                        isShow = true;
                    }else{
                        $("#kuehlungManu").hide();
                        $("#kuehlungManuLabel").hide(); 
                        $("#kuehlungManuLabelSwitch").hide(); 
                        isShow = false;
                    }
                })
            }
        );
        </script>
        <script>
         $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#lueftung")[0].checked)
            {
                $("#lueftungManu").show(); 
                $("#lueftungManuLabel").show(); 
                $("#lueftungManuLabelSwitch").show(); 
                isShow = true;
            }else{
                $("#lueftungManu").hide();
                $("#lueftungManuLabel").hide(); 
                $("#lueftungManuLabelSwitch").hide();  
                isShow = false;
            }
            
                $("#lueftung").click(function(){
                    if(isShow == false){
                        $("#lueftungManu").show(); 
                        $("#lueftungManuLabel").show(); 
                        $("#lueftungManuLabelSwitch").show(); 
                        isShow = true;
                    }else{
                        $("#lueftungManu").hide();
                        $("#lueftungManuLabel").hide(); 
                        $("#lueftungManuLabelSwitch").hide(); 
                        isShow = false;
                    }
                })
            }
        );
        </script>
        <script>
         $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#fogger")[0].checked)
            {
                $("#foggerManu").show(); 
                $("#foggerManuLabel").show(); 
                $("#foggerManuLabelSwitch").show(); 
                isShow = true;
            }else{
                $("#foggerManu").hide();
                $("#foggerManuLabel").hide();  
                $("#foggerManuLabelSwitch").hide(); 
                isShow = false;
            }
            
                $("#fogger").click(function(){
                    if(isShow == false){
                        $("#foggerManu").show(); 
                        $("#foggerManuLabel").show(); 
                        $("#foggerManuLabelSwitch").show(); 
                        isShow = true;
                    }else{
                        $("#foggerManu").hide();
                        $("#foggerManuLabel").hide(); 
                        $("#foggerManuLabelSwitch").hide(); 
                        isShow = false;
                    }
                })
            }
        );
        </script>
        
        <script>
        $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#lueftungNiedertourig")[0].checked)
            {
                $("#lueftungNiedertourigManu").show(); 
                $("#lueftungNiedertourigManuLabel").show();
                $("#lueftungNiedertourigManuLabelSwitch").show();
                isShow = true;
            }else{
                $("#lueftungNiedertourigManu").hide();
                $("#lueftungNiedertourigManuLabel").hide();  
                $("#lueftungNiedertourigManuLabelSwitch").hide();
                isShow = false;
            }
            
                $("#lueftungNiedertourig").click(function(){
                    if(isShow == false){
                        $("#lueftungNiedertourigManu").show(); 
                        $("#lueftungNiedertourigManuLabel").show(); 
                        $("#lueftungNiedertourigManuLabelSwitch").show();
                        isShow = true;
                    }else{
                        $("#lueftungNiedertourigManu").hide();
                        $("#lueftungNiedertourigManuLabel").hide(); 
                        $("#lueftungNiedertourigManuLabelSwitch").hide();
                        isShow = false;
                    }
                })
            }
        );
        </script>
        
        <script>     
                $('#autoManu').change(function(){
                if(this.checked) {
                    var autoManu = 1;
                }
                else {
                    var autoManu = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "autoManu": autoManu },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        
        <script>     
                $('#lichtManu').change(function(){
                if(this.checked) {
                    var licht = 1;
                }
                else {
                    var licht = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "licht": licht },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#heizungManu').change(function(){
                if(this.checked) {
                    var heizung = 1;
                }
                else {
                    var heizung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "heizung": heizung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#kuehlungManu').change(function(){
                if(this.checked) {
                    var kuehlung = 1;
                }
                else {
                    var kuehlung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "kuehlung": kuehlung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#foggerManu').change(function(){
                if(this.checked) {
                    var fogger = 1;
                }
                else {
                    var fogger = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "fogger": fogger },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#lueftungManu').change(function(){
                if(this.checked) {
                    var lueftung = 1;
                }
                else {
                    var lueftung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "lueftung": lueftung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#lueftungNiedertourigManu').change(function(){
                if(this.checked) {
                    var lueftungNiedertourig = 1;
                }
                else {
                    var lueftungNiedertourig = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "lueftungNiedertourig": lueftungNiedertourig },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('.sensorneustart').click(function (e) {
                e.preventDefault();
                var sensorneustart = 1;
                // Alert window "swal"
                swal({title:'Sensorneustart erfolgt...',
                     icon: "success"});      
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "sensorneustart": sensorneustart},
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
                });
            });
        </script>
        
        <script>
            $(document).ready(function () {
                $('.befeuchtungsroutine').click(function (e) {
                e.preventDefault();
                var befeuchtungsroutine = 1;
                // Alert window "swal"
                swal({title:'Befeuchtungsroutine erfolgt...',
                     icon: "success"});      
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "manuell_submit.php",
                    data: { "befeuchtungsroutine": befeuchtungsroutine},
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
                });
            });
        </script>
        <script>     
            $('#licht').change(function(){
            if(this.checked) {
                var licht = 1;
            }
            else {
                var licht = 0;
            }
            $.ajax
                ({
                type: "POST",
                
                // submit function 
                url: "voreinstellungen_submit.php",
                data: { "licht": licht },
                success: function (data) {
                    $('.result').html(data);
                    $('#contactform')[0].reset();
                }
                });
        });
        </script>
        <script>     
                $('#heizung').change(function(){
                if(this.checked) {
                    var heizung = 1;
                }
                else {
                    var heizung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "heizung": heizung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#kuehlung').change(function(){
                if(this.checked) {
                    var kuehlung = 1;
                }
                else {
                    var kuehlung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "kuehlung": kuehlung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#fogger').change(function(){
                if(this.checked) {
                    var fogger = 1;
                }
                else {
                    var fogger = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "fogger": fogger },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#lueftung').change(function(){
                if(this.checked) {
                    var lueftung = 1;
                }
                else {
                    var lueftung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "lueftung": lueftung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#lueftungNiedertourig').change(function(){
                if(this.checked) {
                    var lueftungNiedertourig = 1;
                }
                else {
                    var lueftungNiedertourig = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "lueftungNiedertourig": lueftungNiedertourig },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#sensor').change(function(){
                if(this.checked) {
                    var sensor = 1;
                }
                else {
                    var sensor = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "sensor": sensor },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#TerraFunga').change(function(){
                if(this.checked) {
                    var terraFunga = 1;
                }
                else {
                    var terraFunga = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "terraFunga": terraFunga },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
        <script>     
                $('#LichtAlsHeizung').change(function(){
                if(this.checked) {
                    var LichtAlsHeizung = 1;
                }
                else {
                    var LichtAlsHeizung = 0;
                }
                $.ajax
                    ({
                    type: "POST",
                    
                    // submit function 
                    url: "voreinstellungen_submit.php",
                    data: { "LichtAlsHeizung": LichtAlsHeizung },
                    success: function (data) {
                        $('.result').html(data);
                        $('#contactform')[0].reset();
                    }
                    });
            });
        </script>
    
        <script>        
             $(document).ready(
                function(){
                
                var isShow = false;
                
                if($("#voreinstellungAus")[0].checked)
                {
                    $("#komponentenID").show(); 
                    $("#Pinbelegung").show();
                    $("#TerraFunga").show();
                    $("#TerraFungaSw").show();
                    $("#TerraFungaLabel").show();
                    $("#LichtAlsHeizung").show();
                    $("#LichtAlsHeizungSw").show();
                    $("#LichtAlsHeizungLabel").show();
                    isShow = true;
                }else{
                    $("#komponentenID").hide();
                    $("#Pinbelegung").hide();
                    $("#TerraFunga").hide();
                    $("#TerraFungaSw").hide();
                    $("#TerraFungaLabel").hide();
                    $("#LichtAlsHeizung").hide();
                    $("#LichtAlsHeizungSw").hide();
                    $("#LichtAlsHeizungLabel").hide();
                    isShow = false;
                }
                
                    $("#voreinstellungAus").click(function(){
                        if(isShow == false){
                            $("#komponentenID").show(); 
                            $("#Pinbelegung").show();
                            $("#TerraFunga").show();
                            $("#TerraFungaSw").show();
                            $("#TerraFungaLabel").show();
                            $("#LichtAlsHeizung").show();
                            $("#LichtAlsHeizungSw").show();
                            $("#LichtAlsHeizungLabel").show();
                            isShow = true;
                        }else{
                            $("#komponentenID").hide();
                            $("#Pinbelegung").hide();
                            $("#TerraFunga").hide();
                            $("#TerraFungaSw").hide();
                            $("#TerraFungaLabel").hide();
                            $("#LichtAlsHeizung").hide();
                            $("#LichtAlsHeizungSw").hide();
                            $("#LichtAlsHeizungLabel").hide();
                            isShow = false;
                        }
                    })
                }
            );
        </script>
    </body>
</html>
