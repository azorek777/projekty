<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

<!-- font -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Sono:wght@400;500;700&display=swap" rel="stylesheet">
<script src="script.js"></script>
</head>
<body>
<h1 style="display:flex; justify-content: center; align-items:center;">Galeria:</h1>
<div style="display:flex;flex-wrap:wrap;justify-content:space-around;">

    <?php 
    $con = mysqli_connect("localhost", "root", "", "psi");

    $query = "SELECT * FROM boxy";
    $result = mysqli_query($con, $query);

    while ($value = mysqli_fetch_assoc($result)) {
        echo '<a href="index.php?css=' . $value['css'] . '"><div style="';
        echo $value['css'];
        echo '">';
        echo $value['tekst'];
        echo '</div></a>';

        
    }
    mysqli_close($con);



    ?>
</div>
    
</body>
</html>