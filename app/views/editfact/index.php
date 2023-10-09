<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
    <link rel="stylesheet" href="../../../public/css/editfact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="../../../public/js/editfact.js"></script>
    <title>Document</title>
    <?php
        $id = $_GET['id'];
    ?>
    <script>
        window.onload = function() {loadpage(<?php echo $id; ?>);};

    </script>
</head>
<body>
<div class="overlay" id="confirmationBox">
        <div class="confirmation-dialog">
            <p id="message">Are you sure you want to continue?</p>
            <div class="confirmbtn">
                <button id="confirmButton">Confirm</button>
                <button id="cancelButton">Cancel</button>
            </div>
        </div>
    </div>
    <div class="content" id="content">
        <div class="imagecontainer">
            <img src="../../../assets/Nopict.png" alt="defaultProfPic" class="photoProfile" id ="imagevideo">
            <div class="editPhotoButton">
                <label for="file" class="labelFile">Upload Photo</label>
                <input type="file" name="file" id="file" class="file" accept="image/*,video/*">
            </div>
        </div>
        <div class="editcontainer">
            <div class="factinformation">
                <h2 class="facttitle">Fact Information</h2>
                <div class="nametype">
                    <div class="name-container">
                        <div class="factname">
                            <p class="labelname">Video File</p>
                                <label for="file" class="labelFile" id="filename">Upload Video</label>
                                <input type="file" name="videofile" id="videofile" class="videofile" accept="image/*,video/*">
                                <button type="submit" class="updatebtn" id="updatebtn" name="updatebtn">Update</button>
                        </div>
                    </div>
                </div>
                <div class="videotitle">
                    <p class="labeldescription">Video Title</p>
                    <input type="text" placeholder="Title" class="inputtitle" id="edittitle" name="facttitle">
                </div>
                <div class="videotitle">
                    <p class="labeldescription">Video Highlight</p>
                    <input type="text" placeholder="Highlight" class="inputtitle" id="edithighlight" name="facthiglight">
                </div>
                <div class="factdescription">
                    <p class="labeldescription">Fact Description</p>
                    <textarea name="factdescription" id="editdescription"class="inputdescription" placeholder="Description"></textarea>
                </div>
                
            </div>

    
            <button type="button" class="submitButton" name="submit"id="submitbtn" onclick="showConfirmationfact()">Save Change</button>
        </div>
</body>
</html>