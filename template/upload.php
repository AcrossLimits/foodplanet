<?php
session_start();


include('classes/User.php');
include_once('classes/Question.php');
 
$user = new User;
$question = new Question;



if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    $user = $user->getUser($uid);

    // If the user has been banned, redirect them
    if($user->statusID == 3) {
        header("Location: banned.php");
    }

}
else {
    header("Location: login.php");
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Mobify">
        <meta name="description" content="A responsive, mobile first accordion UI module from Mobify">
        <meta name="keywords" content="mobify,mobile,modules,ui,responsive,carousel,scooch,slider">
        <title>Europeana Food & Drink</title>
        <link rel="stylesheet" href="css/page.css">
        <link rel="stylesheet" href="css/upload.css">
        <link rel="stylesheet" href="css/countryselector.css">
        <link rel="stylesheet" href="css/ingredientselector.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        
        <div id="header">
            <div class="title">Upload Your Dish</div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>
                <form enctype="multipart/form-data" action="uploadSubmit.php" method="POST">

                        <div id="pageWrapper">
                            <div id="uploadImage" class="fade-in one">
                                <img id="uploadphoto" src="img/questions/uploadPhoto.jpg" alt="" />
                                <input id="fileupload" type="file" name="userfile" accept="image/*">
                                
                            </div>
                            <div id="entries" class="fade-in two">
                                <div class="entryWrapper"><input type="text" name="Name" value="" placeholder="What do you call this?"></div>
                                <div class="entryWrapper" id="entryWhere">
                                    <p id="whereQuestion">Where on earth is this from?</p>
                                    <ul id="whereAnswer">
                                        <li>
                                            <div class="flag"><img id="whereFlag" src="img/answers/italy.png"  alt="2" /></div>
                                            <div class="name" id="whereName">Italy</div>
                                        </li>
                                    </ul>
                                    <input type="hidden" name="hiddenCountry" id="hiddenCountry" value="0">
                                    <input type="hidden" name="hiddenIngredients" id="hiddenIngredients" value="0">
                                </div>
                                <div class="entryWrapper" id="entryIngredient">
                                    <p id="ingredientQuestion">Select ingredients (optional)</p>
                                    <p id="ingredientAnswer"></p>
                                </div>
                            </div>
                        </div>


            
        <div id="uploadLower" class="fade-in three">
            <div class="text">Send to Cyberspace</div>
            <input type="submit" value="Upload Image" name="submit">
        </div>
                </form>

        <?php include_once "comp/countryselector.php"; ?>
        <?php include_once "comp/ingredientselector.php"; ?>
        <?php include_once "comp/menu.php"; ?>

        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        
        <script>
            var uploadphoto = document.getElementById("uploadphoto");
            var uploadwhere = document.getElementById('entryWhere');
            var uploadingredients = document.getElementById('entryIngredient');
            var whereName = document.getElementById('whereName');
            var countryselector = document.getElementById('countrySelector');
            var ingredientselector = document.getElementById('ingredientSelector');
            var whereQuestion = document.getElementById('whereQuestion');
            var whereAnswer = document.getElementById('whereAnswer');
            uploadwhere.onclick = function () { OpenCountrySelector() };
            uploadingredients.onclick = function () { OpenIngredientSelector() };

            var ingredientClose = document.getElementById("ingredientsClose");
            ingredientClose.onclick = function () { CloseIngredientSelector() };

            var ingredientQuestion = document.getElementById("ingredientQuestion");
            var ingredientAnswer = document.getElementById("ingredientAnswer");

            function CloseIngredientSelector() {
                ingredientselector.style.display = "none";
                var names = "";
                var ids = "";
                for (var i = 0; i < ingredientIDs.length; i++) {
                    names += ingredientNames[i] + ", ";
                    ids += ingredientIDs[i] + ", ";
                }
                if (names != "") {
                    var ing = names.slice(0, -2);
                    ids = ids.slice(0, -2);
                    var MAX_LENGTH = 35;
                    var len = ing.length;
                    if (len > MAX_LENGTH) {
                        ing = ing.substring(0, MAX_LENGTH) + "...";
                    }
                    document.getElementById("hiddenIngredients").value = '' + ids;
                    ingredientAnswer.innerHTML = "" + ing;
                    ingredientAnswer.style.display = "block";
                    ingredientQuestion.style.display = "none";

                }
                else {
                    ingredientAnswer.style.display = "none";
                    ingredientQuestion.style.display = "block";
                }
            };

            function OpenCountrySelector() {
                console.log("open country selector");
                countryselector.style.display = "block";
                countryselector.style.height = window.innerHeight + 'px';

                var countryselectortitle = document.getElementById("countryselectortitle");

                var countrywrapper = document.getElementById("countryWrapper");

                var countrylist = document.getElementById("countrylist");
                countrylist.style.height = (countrywrapper.clientHeight - countryselectortitle.clientHeight) + 'px';
            };

            function OpenIngredientSelector() {
                console.log("open ingredient selector");
                ingredientselector.style.display = "block";
                ingredientselector.style.height = window.innerHeight + 'px';
                ingredientlist = document.getElementById("ingredientlist");
                ingredientlist.style.height = (ingredientWrapper.clientHeight - ingredientselectortitle.clientHeight) + 'px';
            };

            //var leaderTable = document.getElementById('leaderTable');
            //leaderTable.style.height = (window.innerHeight - (document.getElementById('headerL').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 18)) + 'px';
        </script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>     
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#uploadphoto').attr('src', e.target.result);

                        if (uploadphoto.clientHeight > uploadphoto.clientWidth)
                            uploadphoto.style.height = uploadphoto.clientWidth + 'px';
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#fileupload").change(function () {
                readURL(this);

            });

            AttachEvent(countrylist, "click", EventHandler);


            function AttachEvent(element, type, handler) {
                if (element.addEventListener)
                    element.addEventListener(type, handler, false);
                else
                    element.attachEvent("on" + type, handler);
            }

            function EventHandler(e) {
                selectedCountry = "" + e.target.title;
                whereName.innerHTML = selectedCountry;
                selectedCountry = selectedCountry.toLowerCase();
                selectedCountry = selectedCountry.replace(" ", "");
                selectedID = e.target.getAttribute('name');
                console.log(selectedCountry);
                console.log(selectedID);
                document.getElementById("hiddenCountry").value = '' + selectedID;
                $('#whereFlag').attr('src', 'img/answers/' + selectedCountry + '.png');

                countryselector.style.display = "none";
                whereQuestion.style.display = "none";
                whereAnswer.style.display = "block";
            }
        </script>
        
    </body>
</html>