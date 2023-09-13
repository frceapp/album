<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/style.css">
    <title>Open Book on Scroll</title>
</head>
<body>
    <?php 
    function randomHexColor() {
        $red = mt_rand(0, 255);
        $green = mt_rand(0, 255);
        $blue = mt_rand(0, 255);
    
        $hex = sprintf("#%02x%02x%02x", $red, $green, $blue);
    
        return $hex;
    }
    ?>
    <div id="content">
        <!-- <div id="ruler">
            <div id="text-ruler">
                SECRET RECIPE
            </div>
        </div> -->
        <div id="cardflip">
            <div class="inside">Nyumy</div>
            <div class="page 1">
                <div class="front">
                    Ulekan
                </div>
                <div class="back">

                </div>
            </div>
            <div class="page 2">
                <div class="front">
                    Cabai
                </div>
                <div class="back">

                </div>
            </div>
            <div class="page 3">
                <div class="front main">
                    <div style="font-size: 25px;">Resep sambal Geprek</div>
                </div>
                <div class="back">

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="res/script.js"></script>
</body>
</html>
