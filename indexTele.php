<html>
<head>
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>(beta) LED Steuerung @ Home</title>
    <link rel="icon" 
          type="image/ico" 
          href="favicon.ico">
     <!-- import google material design apis -->
     <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-blue.min.css" /> 
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- import custom stylesheet -->
    <link rel="stylesheet" media="screen" href="design.css">   
 

</head>
<body  bgcolor="#d6d6d6">
        <!-- Simple header with fixed tabs. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
                mdl-layout--fixed-tabs">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
        <span class="mdl-layout-title">LED Control Panel</span>
             <div class="mdl-layout-spacer"></div>
        
          <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" href="wecker.php">Wecker (beta)</a>
            <a class="mdl-navigation__link" href="index-oldhtml.html">alte Fadeseite</a> 
          </nav>
        </div>
        <!-- Tabs -->
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
          <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Steady Lighting</a>
          <a href="#fixed-tab-2" class="mdl-layout__tab">Advanced</a>
        </div>
         
      </header>
        <!-- drawer -->
        
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">LED Control Panel</span>
        <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="wecker.php">Wecker (beta)</a>
                <a class="mdl-navigation__link" href="index-oldhtml.html">alte Fadeseite</a>  
      </div>
      <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
          <div class="page-content">
            <!-- Steady lighting is the former index.html with the sliders -->
            <div class="mdl-grid ">
                <div class="mdl-cell  mdl-cell--3-col-desktop mdl-cell--hide-phone mdl-cell--1-col-tablet">
                                <!-- empty cell so the design looks good on every screen (so the center card is centered    -->
                </div>
                <?php
                //read the config file and save results in array
                $color = 0;
		if (($handle = fopen("example.csv", "r")) !== FALSE) {
		    while (($colorData = fgetcsv($handle, 1000, ";")) !== FALSE) {
			$num = count($colorData);
			//echo "<p> $num Felder in Zeile $color: <br /></p>\n";
			
			for ($c=0; $c < $num; $c++) {
			    $allColors[$color][$c]=$colorData[$c];
			}
			$color++;
			
		    }
		    fclose($handle);
		}
		//echo "http: " . $_SERVER['PHP_SELF'];
                ?>
                
                <div class="mdl-cell mdl-cell--middle mdl-cell--stretch mdl-cell--6-col mdl-cell--4-col-phone mdl-cell--6-col-tablet ">
                    <div class="mdl-card  mdl-shadow--4dp steady_lighting-card"> 
                        <form action="fade.php" method="get">
                        <div class="mdl-card__actions mdl-card--border">
                        	<input type="hidden" name="url" value="<?php echo $_SERVER['PHP_SELF'] ?>" />    

                                weiß: 
                                <input class="mdl-slider mdl-js-slider" type="range" name="<?=$allColors[3][0] ?>" min="0" max="1000" step="1" value="<?=$allColors[3][2] ?>">

                               <!-- <label for="chkboxW" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                    <input type="checkbox" id="chkboxW" class="mdl-checkbox__input" name="w" value="-1"  checked>
                                    <span class="mdl-checkbox__label">keine Änderung</span>
                                </label>  -->
                        </div> 

                         <div class="mdl-card__actions mdl-card--border" style="background-color: rgba(178, 34, 34, 0.78);">  
                                rot: 
                                <input class="mdl-slider mdl-js-slider" type="range" name="<?=$allColors[2][0] ?>" min="0" max="1000" step="1" value="<?=$allColors[2][2] ?>">


                              <!--    <label for="chkboxR" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                    <input type="checkbox" id="chkboxR" class="mdl-checkbox__input" name="r" value="-1"  checked>
                                    <span class="mdl-checkbox__label">keine Änderung</span>
                                </label> -->
                               
                         </div> 
                         <div class="mdl-card__actions mdl-card--border" style="background-color: rgba(34, 139, 34, 0.73);">      
                                grün: 
                                <input class="mdl-slider mdl-js-slider" type="range" name="<?=$allColors[1][0] ?>" min="0" max="1000" step="1" value="<?=$allColors[1][2] ?>">

                                <!--  <label for="chkboxG" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                    <input type="checkbox" id="chkboxG" class="mdl-checkbox__input" name="g" value="-1"  checked>
                                    <span class="mdl-checkbox__label">keine Änderung</span>
                                </label>-->
                            </div>     
                            <div class="mdl-card__actions mdl-card--border" style="background-color: rgba(30, 144, 255, 0.87);">  
                                blau: 
                                <input class="mdl-slider mdl-js-slider" type="range" name="<?=$allColors[0][0] ?>" min="0" max="1000" step="1" value="<?=$allColors[0][2] ?>">

                                <!--  <label for="chkboxB" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                    <input type="checkbox" id="chkboxB" class="mdl-checkbox__input" name="b" value="-1"  checked>
                                    <span class="mdl-checkbox__label">keine Änderung</span>
                                </label>-->

                            </div>    
                            <div class="mdl-card__actions mdl-card--border">
                           <!-- Accent-colored raised button with ripple -->
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                LEDs schalten
                            </button>
                            </div>
                        </form>
                    </div> 
                </div> 
                <div class="mdl-cell  mdl-cell--3-col-desktop mdl-cell--hide-phone mdl-cell--1-col-tablet">
                                <!-- empty cell so the design looks good on every screen (so the center card is centered    -->
                </div>
            </div>          
        </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-2">
          <div class="page-content">
              <!-- former advanced html is now here! -->
              <div class="mdl-grid ">
                  <div class="mdl-cell  mdl-cell--3-col-desktop mdl-cell--hide-phone mdl-cell--1-col-tablet">
                        <!-- empty cell so the design looks good on every screen (so the center card is centered    -->
                  </div>
                  <div class="mdl-cell mdl-cell--middle mdl-cell--stretch mdl-cell--6-col mdl-cell--4-col-phone mdl-cell--6-col-tablet ">
                    <div class="mdl-card  mdl-shadow--4dp steady_lighting-card"> 
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Mode wählen</h2>
                        </div>
                        <form action="fade.php">
                        <div class="mdl-card__actions mdl-card--border">   
                        	<input type="hidden" name="url" value="<?php echo $HTTP_REFERER ?>" /> 
                                    <b> zusätzliche Modi</b>: <br><br>                       
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                            <input type="radio" id="option-1" class="mdl-radio__button" name="mode" value="0" checked>
                                            <span class="mdl-radio__label">Mode 0</span>
                                    </label>
                                    feste Farben, die <a href="/index.html">hier</a> eingestellt werden <br>
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                        <input type="radio" id="option-2" class="mdl-radio__button" name="mode" value="1">
                                        <span class="mdl-radio__label">Mode 1</span>
                                    </label>
                                    Fade zu zufällig generierten Farben 
                                <br>                                    
                                <!-- Accent-colored raised button with ripple -->
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Mode wählen
                                 </button>
                                    
                                 </div>
                            </form>
                    </div>
                    <div class="mdl-card mdl-shadow--4dp steady_lighting-card">   
                        <div class="mdl-card__title">
                              <h2 class="mdl-card__title-text">Fadezeit einstellen</h2>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">   
                        <form action="fade.php">   
                        	<input type="hidden" name="url" value="<?php echo $HTTP_REFERER ?>" />                                  
                             Dauer zum Anschalten der LEDs bestimmen: <br>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" id="timebox" size="10" name="a_time" min="200" max="1000000">
                                <label class="mdl-textfield__label" for="timebox">Fadezeit</label>
                                <span class="mdl-textfield__error">Zahl zwischen 200 und 1 Mio. eingeben!</span>
                            </div>
                             
                           <br>  oder mit dem Slider auswählen (200-5'000)
                             <input class="mdl-slider mdl-js-slider" type="range" name="time" min="200" max="5000" step="1" value="0">                                                          
                             <!-- Accent-colored raised button with ripple -->
                             <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                 Fadezeit ändern
                             </button>
                        </form>
                        </div>
                    </div>
                </div>
                  <div class="mdl-cell  mdl-cell--3-col-desktop mdl-cell--hide-phone mdl-cell--1-col-tablet">
                        <!-- empty cell so the design looks good on every screen (so the center card is centered    -->
                  </div>
            </div>
            </div>
        </section>
        
      </main>
    </div>
</body>
</html>