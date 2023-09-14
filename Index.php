<?php
include('base_url.php');

$max_page = 10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
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
                            <img class="preview-front-<?= $i ?>" width="250" src="<?= $base_url ?>/assets/note.png" alt="Image Preview">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const base_url = '<?= $base_url ?>'

        window.current_page = <?= $max_page ?>

        window.total_page = <?= $max_page ?>
    </script>
    <script src="res/script.js"></script>
</body>
</html>
