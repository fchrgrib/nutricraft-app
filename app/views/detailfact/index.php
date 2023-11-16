<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/detailfact.css">
    <script defer src="../../../public/js/detailfact.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
    ?>
    <script>
        window.onload = function() {loadpage(<?php echo $id; ?>);};
    </script>
    <div class="content" id="content">
        <h1 id="title">judul</h1>
        <div class = "authorcontainer">
            <img src="../../../assets/thumbnail.png" alt="" id="image">
            <div class="authortext">
                <h2 id="author">Author</h2>
                <h4 id="totSubs">10 Subscribers</h4>
            </div>
            <button type="button" class="subscribe">Subscribe</button>
        </div>
        <div class="factcontainer">
            <img src="../../../assets/thumbnail.png" alt="" id="imageContent">
            <div class="facttext">
                <p id="bodyContent">lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet </p>
            </div>
        </div>
    </div>
</body>
</html>