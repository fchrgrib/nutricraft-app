<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
    <link rel="stylesheet" href="../../../public/css/addfact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="../../../public/js/addmeal.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="../../../server/controller/auth/cms/AddFact.php" method="POST" enctype="multipart/form-data">
        <div class="content">
            <div class="imagecontainer">
                <img src="../../../assets/Nopict.png" alt="defaultProfPic" class="photoProfile">
                <div class="editPhotoButton">
                    <label for="file" class="labelFile">Upload File</label>
                    <input type="file" name="file[]" id="file" class="file" accept="*/*" multiple="multiple">
                </div>
            </div>
            <div class="editcontainer">
                <div class="factinformation">
                    <h2 class="facttitle">Fact Information</h2>
                    <div class="videotitle">
                        <p class="labeldescription">Video Title</p>
                        <input type="text" placeholder="Title" class="inputtitle" id="edittitle" name="facttitle">
                    </div>
                    <div class="videotitle">
                        <p class="labeldescription">Video Highlight</p>
                        <input type="text" placeholder="Highlight" class="inputtitle" id="edithighlight" name="facthighlight">
                    </div>
                    <div class="factdescription">
                        <p class="labeldescription">Fact Description</p>
                        <textarea name="factdescription" id="factdescription" class="inputdescription" placeholder="Description"></textarea>
                    </div>

                </div>

                <button type="submit" class="submitButton" name="submit" >Save Change</button>
            </div>
        </div>
    </form>
</body>
</html>