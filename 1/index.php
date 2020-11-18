<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
<style>

body {
        background-color: ivory;
        margin-top:10px;
    }

</style>
<?php
 $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
 $response = file_get_contents($url);
 $result = json_decode($response);
 $count = 0;
 echo'<div class="content container row" style="margin-left:280px;">';
     $result = (json_decode($response));
     foreach ($result->tracks->items as $i){
        echo '<div class="card" style="width: 25%; margin: 10px; margin-bottom: 20px;">';
        foreach ($i->album->images as $img){
            if ($img->height == 640){
                echo '<img class="card-img-top" src="' . $img->url . '">';
            }
        }
            echo '<div>';
                    echo "<p>" . $i->album->name . "</p>";
                    foreach ($i->album->artists as $artists){
                        echo "Artist: " . $artists->name . "<br>";
                    }
                    echo "Release date: " . $i->album->release_date . "<br>";
                    foreach ($i->album->available_markets as $amarket){
                        $count++;
                    }
                    echo "Avaliable : " . $count . " countries<br></div></div>";
        }
 echo"</div>";
?>

</body>
</html>