<?php
$con = mysqli_connect("localhost","root","","psi");


$tekst = $_POST ['tekst'];
$boxround = $_POST['zaokraglenie'];
$boxwidth = $_POST['grubosc'];
$bordertype = $_POST['bordertype'];
$boxshadowx = $_POST['boxshadowx'];
$boxshadowy = $_POST['boxshadowy'];
$boxshadowblur = $_POST['boxshadowblur'];
$fontname = $_POST['fontname'];
$fontsize = $_POST['fontsize'];
$textalign = $_POST['textalign'];
$textshadowx = $_POST['textshadowx'];
$textshadowy = $_POST['textshadowy'];
$textshadowblur = $_POST['textshadowblur'];

//zamiana z hex na rgb
list($r, $g, $b) = sscanf($_POST['color'], "#%02x%02x%02x");
$bgcolor = "rgb($r,$g,$b)";

//zamiana z hex na rgb
list($r1, $g1, $b1) = sscanf($_POST['bordercolor'], "#%02x%02x%02x");
$bordercolor = "rgb($r1,$g1,$b1)";

//zamiana z hex na rgb
list($r2, $g2, $b2) = sscanf($_POST['boxshadowcolor'], "#%02x%02x%02x");
$boxshadowcolor = "rgb($r2,$g2,$b2)";

//zamiana z hex na rgb
list($r3, $g3, $b3) = sscanf($_POST['textcolor'], "#%02x%02x%02x");
$textcolor = "rgb($r3,$g3,$b3)";

//zamiana z hex na rgb
list($r4, $g4, $b4) = sscanf($_POST['textshadowcolor'], "#%02x%02x%02x");
$textshadowcolor = "rgb($r4,$g4,$b4)";



$newbgcolor = "background-color:" . $bgcolor . ";";
$newboxround = "border-radius:" . $boxround . "px;";
$newboxwidth = "border-width:" . $boxwidth . "px;";
$newbordercolor = "border-color:" . $bordercolor . ";";
$newbordertype = "border-style:" . $bordertype . ";";
$newboxshadow = "box-shadow:" . $boxshadowx . "px " .  $boxshadowy . "px " . $boxshadowblur . "px " . $boxshadowcolor . ";";
$newtextcolor = "color: " . $textcolor . ";";
$newfontname = "font-family: " . $fontname . ";"; 
$newfontsize = "font-size: " . $fontsize . "px;";
$newtextalign = "text-align: " . $textalign . ";";
$newtextshadow = "text-shadow: " . $textshadowx . "px " . $textshadowy . "px " . $textshadowblur . "px " . $textshadowcolor . ";";

$css = $newbgcolor . $newboxround . $newboxwidth . $newbordercolor . $newbordertype . $newboxshadow . $newtextcolor . $newfontname . $newfontsize . $newtextalign . $newtextshadow;

$zapytanie = "INSERT INTO `boxy` 
VALUES
    ('','$tekst','$css');";

mysqli_query($con, $zapytanie);

header('location: index.php');

?>