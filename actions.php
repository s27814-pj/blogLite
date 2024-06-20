<?php include( './includes/header.php')?>



<?php include( './includes/navbar.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//    echo $_POST['func']($_POST['username'],$_POST['password']);

    switch($_POST['func']) {
        case "changePassword":
            echo changePasswordByUsername($_POST['username'], $_POST['password']);;
            break;
        case "changeYourPassword":
            echo changePasswordByUsername($_SESSION['currentUser']['username'], $_POST['password']);
            break;
        case "addPost":

            $target_file="";

            if ($_FILES["fileToUpload"]["size"] != 0) {

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

// Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

// Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";


                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
    }
            echo $target_file;
            echo addPost($_POST['header'],$_POST['body'],$_POST['title'],$target_file,$_SESSION['currentUser']['id']);
            break;


        case "deletePost":
            echo deletePostById($_POST['postId']);
            break;

        case "editBodyPost":
            echo editBodyPostById($_POST['postId'],$_POST['body']);
            break;
    }
}


include('./includes/footer.php');