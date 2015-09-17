<html>  
<head>
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>(beta) LED Steuerung @ Home</title>
    <link rel="icon" 
          type="image/ico" 
          href="favicon.ico">
    <link rel="stylesheet" media="screen" href="design.css">        

        <p id="default"> <br>
    Die LEDs wurden angeschaltet oder die Konfiguration verändert. <br>
    In 5s erscheint die Seite zum Ändern der Helligkeit. <br>    
    Falls nicht, <a href="/index.html">hier klicken!</a> <br>
    (es kann sein das dadurch das LED Schalten verhindert wird) <br>
    Falls du zur Konfigurationsseite "Erweitert" möchtest, <a href="/advanced.html">hier klicken!</a>  <br> <br>      

        
<?php

$mode = $_GET['mode'];  //fade einlesen
$speed = $_GET['speed'];  //speed einlesen
$time = $_GET['a_time']; 	//time einlesen
//$a_time = $_GET['a_time'];

$luminance[0] = $_GET['w'];  //wert für weiss einlesen
$luminance[1] = $_GET['r'];  //wert für rot einlesen
$luminance[2] = $_GET['g'];  //wert für gruen einlesen
$luminance[3] = $_GET['b'];  //wert für blau einlesen

//alternative werte aus den input fields einlesen
$alternative[0] = $_GET['a_white'];
$alternative[1] = $_GET['a_red'];
$alternative[2] = $_GET['a_green'];
$alternative[3] = $_GET['a_blue'];

$colorName = array( //array for the names of the colors (matching the names in led-blaster)
0 => 'w',
1 => 'r',
2 => 'g',
3 => 'b',
 );

if($speed == "")  
{
  	$speed=1;     // default is factor 1
}
if($time == "")  //if there's nothing in the variable the input field was empty -> we'll take the range input field then
{
  	$time=$_GET['time'];     // default is time=1000
}

$numberOfChangedBrightness = 0;

//wenn etwas in das Textfeld eingetragen wird, dann wird dieser wert der jeweiligen helligkeitFarbe zugeordnet
//das Textfeld überschreibt also die checkboxen
for ($color = 0; $color < 4; $color++) //some things we have to apply to each color
{
	if($alternative[$color] != "")  { 	//only use the input field value when its not an empty string
		$luminance[$color] = $alternative[$color];
	}
    //if luminance[color] is an empty string we won't do anything
	if ($luminance[$color] != -1 && $luminance[$color] != "") 	//if color is -1 we don't have to do anything since it means 'no change in brightness'
	{
		$numberOfChangedBrightness++;		//if it isn't -1 we'll change the brightness. this variable is important for the wait=x command expected by led-blaster
	}
}


if ($numberOfChangedBrightness > 0) //only if we have to change the brightness of at least one color
{
    
    $cmd = "echo wait=$numberOfChangedBrightness > /dev/led-blaster"; 			//set wait counter to $numberOfChangedBrightness (itll fade after changing four colorBrightnesses if everything was changed
	$val =  shell_exec($cmd); 
	echo $cmd . "<br>";							//debugging info (only used at the beginning)
	for ($color = 0; $color < 4; $color++) //write every color's brightness to fifo
	{
		if ($luminance[$color] != -1 && $luminance[$color] != "") //if we have to change the brightness and theres acutally a brightness ;_)
		{
			$cmd = "echo ". $colorName[$color] . "=" . $luminance[$color] . " > /dev/led-blaster"; 	//set each brightness WRGB
			$val =  shell_exec($cmd); 
            echo "<br>" . $cmd . "<br>\n";
		}
    }
}

//we want to transmit time everytime its not nothing
if ($time != "")
{
    $cmd = "echo time=" . $time . " > /dev/led-blaster"; //echo the desired time into led-blaster
    $val =  shell_exec($cmd); //and execute that command
    echo "<br>" . $cmd . "<br>\n";	
}

if($mode != "") {								//change the mode
	$cmd = "echo mode=$mode > /dev/led-blaster"; //echo the desired mode into led-blaster, thats all we have to do
	$val =  shell_exec($cmd); 
	echo $cmd . "<br>\n";							//debugging info (only used at the beginning)
	if ($mode == 1 && $speed != "")
	{
		$cmd = "echo speed=$speed > /dev/led-blaster"; //echo the desired mode into led-blaster, thats all we have to do
		$val =  shell_exec($cmd); 
		echo $cmd . "<br>\n";							//debugging info (only used at the beginning)
	}
}

?>
    
    </p><br> <br>
    <meta http-equiv="refresh" content="5; URL='/index.html">
</head>    
</html>    
