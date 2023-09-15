<?php
session_start();

include('base_url.php');

$jsonData = file_exists('res/storage.json') ? json_decode(file_get_contents('res/storage.json'), true) : [];

$max_page = count($jsonData) + 2;

$login = isset($_SESSION['login']) ? $_SESSION['login'] : false;

function isRange($id) {
    global $jsonData;
    if ($id >= 1 && $id <= count($jsonData)) {
        return true;
    } else {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <link href="https://fonts.cdnfonts.com/css/insiders" rel="stylesheet">
    <link rel="stylesheet" href="res/style.css">
    <style>
        body {
            background-image: url('<?= $base_url ?>/assets/background.jpg');
        }
        .front.main {
            background-image: url('<?= $base_url ?>/assets/book_cover.png');
        }
        .front:not(.main), .back:not(.main) {
            background-image: url('<?= $base_url ?>/assets/page.png');
        }
    </style>
</head>
<body>
    <div id="content">
        <!-- <div id="ruler">
            <div id="text-ruler">
                SECRET RECIPE
            </div>
        </div> -->
        <div id="cardflip">
            <div class="inside">Continue</div>
            <?php for ($i=1; $i <= $max_page ; $i++) : ?>
                <?php if ($max_page == $i) : ?>
                    <div class="page <?= $i ?>">
                        <div class="front main">
                        </div>
                        <div class="back main"></div>
                    </div>
                <?php else : ?>
                    <div class="page <?= $i ?>">
                        <div class="front" data-id="<?= $i ?>">
                            <img class="preview-front-<?= $i ?> img-shadow" width="250" src="<?= $base_url . (isRange($i) ? $jsonData[$i] : 'assets/note.png') ?>" alt="Image Preview">
                        </div>
                        <div class="back back-upload">
                            <div class="drop-area" id="backDropArea<?= $i ?>">
                                <input type="file" class="file-input" accept="image/*" multiple data-page="<?= $i ?>">
                            </div>
                            <div class="preview" id="backPreview<?= $i ?>"></div>
                        </div>
                    </div>
                    <input type="file" class="file-input file-input-front" data-id="<?= $i ?>" style="display: none;" accept="image/*" data-page="<?= $i ?>">
                <?php endif ?>
            <?php endfor ?>
        </div>
    </div>

    <?php if ($login) : ?>
        <a href="#" class="floating-button logout">Logout</a>
    <?php else: ?>
        <a href="#" class="floating-button login">Login</a>
    <?php endif ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const base_url = '<?= $base_url ?>'

        const login = <?= $login ? 'true' : 'false' ?>

        window.current_page = <?= $max_page ?>

        window.total_page = <?= $max_page ?>
    </script>
    <script src="res/script.js"></script>
</body>
</html>
