<!DOCTYPE html>
<html lang="de">
    
<!-- Site: 'Manuell' -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title id="title"></title>

        <!-- homescreen icon -->
        <link rel="icon" type="image/ico" id="IconStart">
        
        <!-- css stylesheets --> 
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/tooplate.css">
        <link rel="stylesheet" href="css/time.css">
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
                                <img id="homeIcon" >
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="manuell.php">Manuell</a>
                                    </li>                                             
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                
                <!-- 1. white block, includes 'Lichteinstellungen': 'Lichtstart' & 'Lichtende'-->
                 <div class="row tm-content-row tm-mt-big">
                    <div class="tm-col tm-col-big">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Manueller Betrieb</h2>
                                                            
                                <label for="appt1" method>Auto/Manuell:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="autoManu" name="autoManu" <?php echo manuell("autoManu");?>>
                                  <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                <!-- 1. white block, includes 'Lichteinstellungen': 'Lichtstart' & 'Lichtende'-->
                    <div class="tm-col tm-col-big" id="divshow" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Manueller Aktorbetrieb</h2>                    
                                <label for="appt1" method>Licht:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="licht" name="licht" <?php echo manuell("licht");?>>
                                  <span class="slider round"></span>
                                </label>
                                
                                <label for="appt1" method>Heizung:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="heizung" name="heizung" <?php echo manuell("heizung");?>>
                                  <span class="slider round"></span>
                                </label>     

                                <label for="appt1" method>Kühlung:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="kuehlung" name="kuehlung" <?php echo manuell("kuehlung");?>>
                                  <span class="slider round"></span>
                                </label>   

                                <label for="appt1" method>Fogger:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="fogger" name="fogger" <?php echo manuell("fogger");?>>
                                  <span class="slider round"></span>
                                </label>     
                                
                                <label for="appt1" method>Lüftung:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="lueftung" name="lueftung" <?php echo manuell("lueftung");?>>
                                  <span class="slider round"></span>
                                </label>     
                            </div>
                        </div>
                        
                        <div class="tm-col tm-col-big">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Manuelle Aktionen</h2>
                                                            
                                <label for="sensorneustart" method>Sensorneustart:</label>
                                    <input type="submit" class="sensorneustart" value="Starten">
                                <label for="befeuchtungsroutine" method>Befeuchtungsroutine:</label>
                                    <input type="submit" class="befeuchtungsroutine" value="Starten">
                        </div>
                    </div>
                    <div class="tm-col tm-col-big" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Steuerungsauswahl</h2>
                                                            
                                <label for="appt1" method>Terrarium/Fungarium</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="TerraFunga" name="TerraFunga" <?php echo terraFunga("terraFunga");?>>
                                  <span class="slider round"></span>
                                </label>
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
                
            function terraFunga(String $Bezeichnung)
                {         
                    // Database Login
                    include "databaseLogin.php";
                    
                    // create table "einstellungen" when the data is submitted for the first time
                    $sql = "CREATE TABLE IF NOT EXISTS komponenten (
                    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Bezeichnung VARCHAR(30) NOT NULL,
                    Wert TINYINT NOT NULL,
                    Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
                    $db->exec($sql);
                    
                    // execute query
                    $result = $db->query("SELECT * FROM komponenten WHERE Bezeichnung='$Bezeichnung'");

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
        <!-- js to submit entered data to the DB -->
        <!-- each white block has a separate js -->
        
        <script>     
            $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#autoManu")[0].checked)
            {
                $("#divshow").fadeIn("slow");
                $("#timeManu").fadeIn("slow");
                $("#timeManuLabel").fadeIn("slow");                
                isShow = true;
            }else{
                $("#divshow").fadeOut("slow");
                $("#timeManu").fadeOut("slow");
                $("#timeManuLabel").fadeOut("slow");    
                isShow = false;
            }
            
                $("#autoManu").click(function(){
                    if(isShow == false){
                        $("#divshow").fadeIn("slow");
                        $("#timeManu").fadeIn("slow");
                        $("#timeManuLabel").fadeIn("slow");    
                        isShow = true;
                    }else{
                        $("#divshow").fadeOut("slow");
                        $("#timeManu").fadeOut("slow");
                        $("#timeManuLabel").fadeOut("slow");    
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
            $(document).ready(
            function(){
            
            var isShow = false;
            
            if($("#TerraFunga")[0].checked)
            {
                $("#header").html("Fungarium");      
                $("#title").html("Steuerung Fungarium");      
                $("#homeIcon").attr('src',"favicon.ico/mushrooms_30.ico");    
                $("#IconStart").attr('href',"favicon.ico/mushrooms.ico");   
                isShow = true;
            } else{
                $("#header").html("Terrarium");  
                $("#title").html("Steuerung Terrarium");   
                $("#homeIcon").attr('src',"favicon.ico/terrarium_30.ico");       
                $("#IconStart").attr('href',"favicon.ico/terrarium.ico");      
                isShow = false;
            }
            
                $("#TerraFunga").click(function(){
                    if(isShow == false){
                        $("#header").html("Fungarium"); 
                        $("#title").html("Steuerung Fungarium");    
                        $("#homeIcon").attr('src',"favicon.ico/mushrooms_30.ico");   
                        $("#IconStart").attr('href',"favicon.ico/mushrooms.ico");   
                        isShow = true;
                    } else{
                        $("#header").html("Terrarium");   
                        $("#title").html("Steuerung Terrarium");   
                        $("#homeIcon").attr('src',"favicon.ico/terrarium_30.ico");     
                        $("#IconStart").attr('href',"favicon.ico/terrarium.ico");   
                        isShow = false;
                    }
                })
            
                
            }
        );
        </script>
    </body>
</html>
