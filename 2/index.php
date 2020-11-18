<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pre</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <style>
    body {
        background-color: ivory;
        margin-top:10px;
    }
}

    </style>
</head>
<body>
    <div class="content container row" style="margin-left:280px;">
        <form method="post" style="width: 100%;">
            <?php
                $clicked = false;
                $check_all = true;
                $find = "";

                if(isset($_POST['test'])) {
                    $clicked = true;

                    if($clicked){
                        $find = $_POST['text'];
                    }
                }

                echo '<h6>ระบุคำค้นหา :</h6>';
                echo '<div style="width: 100% ;margin-bottom: 20px"><input id="text" name="text" value="' . $find . '" class="form-control align-center" style="width: 80%; display: inline-block;">
                <button type="submit" name="test" class="btn btn-danger" style="margin-left: 15px">ค้นหา</button></div>';
            ?>

            </form>
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $count = 0;
                $fcount = 0;

                if ($find == ""){
                    $check_all = false;
                    foreach ($result->tracks->items as $items){
                        echo '<div class="card" style="width: 25%; margin: 10px; margin-bottom: 20px;">';
                        foreach ($items->album->images as $img){
                            if ($img->height == 640){
                                echo '<img class="card-img-top" src="' . $img->url . '">';
                            }
                        }
                        echo '<div >';
                        echo "<p>" . $items->album->name . "</p>";
                        foreach ($items->album->artists as $art){
                            echo "Artist: " . $art->name . "<br>";
                        }
                        echo "Release date: " . $items->album->release_date . "<br>";
                        foreach ($items->album->available_markets as $available_markets){
                            $count++;
                        }
                        echo "Avaliable : " . $count . " countries<br></div></div>";
                    }
                }
                else{

                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $art){
                            if (strpos(strtoupper($art->name), strtoupper($find)) !== false){
                                $check = true;
                            }
                        }
                        if (strpos(strtoupper($items->album->name), strtoupper($find)) !== false || $check){
                            $fcount++;
                        }
                    }
                    if ($fcount > 0){
                        echo "<div style='width:100%; margin-bottom: 10px;'>ค้นหาเจอ " . $fcount . " รายการ<br></div>";
                    }
                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $art){
                            if (strpos(strtoupper($art->name), strtoupper($find)) !== false){
                                $check = true;
                            }
                        }
                        if (strpos(strtoupper($items->album->name), strtoupper($find)) !== false || $check){
                            $check_all = false;
                            echo '<div class="card" style="width: 25%; margin: 10px; margin-bottom: 20px;">';
                            foreach ($items->album->images as $img){
                                if ($img->height == 640){
                                    echo '<img class="card-img-top" src="' . $img->url . '" alt="Card image cap">';
                                }
                            }
                            echo '<div';
                            echo "<p" . $items->album->name . "</p>";
                            foreach ($items->album->artists as $art){
                                echo "Artist: " . $art->name . "<br>";
                            }
                            echo "Release date: " . $items->album->release_date . "<br>";
                            foreach ($items->album->available_markets as $amarkets){
                                $count++;
                            }
                            echo "Avaliable : " . $count . " countries<br></div></div>";
                        }
                    }
                }

                if ($check_all){
                    echo 'Not Found';
                }
            ?>
    </div>
</body>
</html>
