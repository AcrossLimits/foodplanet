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

    if($user->statusID != 2)
        header("Location: dashboard.php");


    $questions = $question->getUnverified();

    $statusID = 0;
    $statusText = "";

    if(isset($_GET['status'])) {
        $statusID = $_GET['status'];

        if($statusID > 0) {
            if($statusID == 1)
                $statusText = "<div class='text'>Submission verified</div>";
            else if($statusID == 2)
                $statusText = "<div class='text'>Submission verified as 18+</div>";
            else if($statusID == 3)
                $statusText = "<div class='text'>Submission rejected</div>";
            else if($statusID == 4)
                $statusText = "<div class='text'>User banned</div>";
            else if($statusID == 5)
                $statusText = "<div class='text'>No submissions found</div>";
            else if($statusID == 6)
                $statusText = "<div class='text'>You cannot ban an Admin</div>";
            else
                $statusText = "";
        }

    }
    else {
        $statusID = 0;
    }

    if (count($questions) < 1) {
      $statusID = 5;
      $statusText = "<div class='text'>No submissions found</div>";
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
        <link rel="stylesheet" href="css/verifyUploaded.css">
        <link rel="stylesheet" href="css/verifyDialog.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        
        <div id="header">
            <div class="title">Verify Uploaded Meals</div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>
                    <div id="pageWrapper">
                        <div id="status"><?php echo $statusText; ?></div>
                        <div id="uploadItems">
                        <?php foreach($questions as $q) : ?>
                            <div class="uploadItem" id="item_<?php echo $q->id;?>" title="<?php echo $q->id;?>">
                                <div class="imageWrapper"><img src='img/questions/<?php echo $q->imgURL?>' alt="" /></div>
                                <div class="itemDetails">
                                    <div class="itemName"><?php echo $q->title;?></div>
                                    <div class="itemAuthor">Uploaded by: <?php echo $q->authorName;?></div>
                                    <div class="itemLocation">
                                        <div class="flag"><img src="img/answers/<?php echo $q->answerImage?>" alt="" /></div>
                                        <div class="name"><?php echo $q->answer;?></div>
                                    </div>
                                </div>
                                <div class="itemControls" id="controls_<?php echo $q->id;?>">
                                        <a href="verifyAccept.php?qid=<?php $q->id;?>&adult=0"><div class="itemButton accept" id="accept_<?php echo $q->id;?>" title="<?php echo $q->id;?>">
                                        <div class="icon"><img src="img/icons/iconAccept.png" alt="Accept" /></div>
                                        <div class="text">Accept</div></a>
                                    </div>
                                    <div class="itemButton accept" id="accept18_<?php echo $q->id;?>" title="<?php echo $q->id;?>">
                                        <div class="icon"><img src="img/icons/iconAccept18.png" alt="Accept 18+" /></div>
                                        <div class="text">Accept 18+</div>
                                    </div>
                                    <div class="itemButton reject" id="reject_<?php echo $q->id;?>" title="<?php echo $q->id;?>">
                                        <div class="icon"><img src="img/icons/iconReject.png" alt="Reject" /></div>
                                        <div class="text">Reject</div>
                                    </div>
                                    <div class="itemButton ban" id="ban_<?php echo $q->id;?>" title="<?php echo $q->id;?>">
                                        <div class="icon"><img src="img/icons/iconBanUser.png" alt="Ban User" /></div>
                                        <div class="text">Ban User</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                        </div>
                    </div>
           


        <?php include_once "comp/dialogVerifyAccept.php"; ?>
        <?php include_once "comp/dialogVerifyAccept18.php"; ?>
        <?php include_once "comp/dialogVerifyReject.php"; ?>
        <?php include_once "comp/dialogVerifyBan.php"; ?>
        <?php include_once "comp/menu.php"; ?>
        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        
        
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>     
        <script>
            var uploadWrapper = document.getElementById('uploadItems');
            var statusBar = document.getElementById('status');
            uploadWrapper.style.height = (window.innerHeight - (document.getElementById('header').clientHeight + statusBar.clientHeight + 0)) + 'px';

            var dialogAccept = document.getElementById('dialogAccept');
            var dialogAccept18 = document.getElementById('dialogAccept18');
            var dialogReject = document.getElementById('dialogReject');
            var dialogBan = document.getElementById('dialogBan');

            var acceptPreview = document.getElementById('acceptPreview');
            var accept18Preview = document.getElementById('accept18Preview');
            var rejectPreview = document.getElementById('rejectPreview');
            var banPreview = document.getElementById('banPreview');

            var buttonAcceptYes = document.getElementById('buttonAcceptYes');
            var buttonAcceptCancel = document.getElementById('buttonAcceptCancel');

            var buttonAccept18Yes = document.getElementById('buttonAccept18Yes');
            var buttonAccept18Cancel = document.getElementById('buttonAccept18Cancel');

            var buttonRejectYes = document.getElementById('buttonRejectYes');
            var buttonRejectCancel = document.getElementById('buttonRejectCancel');

            var buttonBanYes = document.getElementById('buttonBanYes');
            var buttonBanCancel = document.getElementById('buttonBanCancel');

            var previewItem = 0;

            buttonAcceptCancel.onclick = function () { document.getElementById('controls_'+previewItem).style.display = 'block'; dialogAccept.style.display = 'none'; dialogOpen = false; };
            buttonAccept18Cancel.onclick = function () { document.getElementById('controls_'+previewItem).style.display = 'block'; dialogAccept18.style.display = 'none'; dialogOpen = false; };
            buttonRejectCancel.onclick = function () { document.getElementById('controls_'+previewItem).style.display = 'block'; dialogReject.style.display = 'none'; dialogOpen = false; };
            buttonBanCancel.onclick = function () { document.getElementById('controls_'+previewItem).style.display = 'block'; dialogBan.style.display = 'none'; dialogOpen = false; };
        </script>
        <script>
            // Variable to store whether dialog box is currently open or not
            var dialogOpen = false;

            // Press Accept button
            function Accept(id) {
                if (!dialogOpen) {
                    dialogOpen = true;

                    // Set preview
                    document.getElementById('controls_' + id).style.display = 'none';
                    previewItem = id;
                    acceptPreview.innerHTML = document.getElementById('item_' + id).outerHTML;

                    // Set the Yes button function
                    buttonAcceptYes.onclick = function () { window.location="verifyAccept.php?qid="+id+"&adult=0"; };

                    // Show the dialog box
                    dialogAccept.style.display = "block";
                }
            };

            // Press Accept 18+ button
            function Accept18(id) {
                if (!dialogOpen) {
                    dialogOpen = true;

                    // Set preview
                    document.getElementById('controls_' + id).style.display = 'none';
                    previewItem = id;
                    accept18Preview.innerHTML = document.getElementById('item_' + id).outerHTML;

                    // Set the Yes button function
                    buttonAccept18Yes.onclick = function () { window.location="verifyAccept.php?qid="+id+"&adult=1"; };

                    // Show the dialog box
                    dialogAccept18.style.display = "block";
                }
            };

            // Press Reject button
            function Reject(id) {
                if (!dialogOpen) {
                    dialogOpen = true;

                    // Set preview
                    document.getElementById('controls_' + id).style.display = 'none';
                    previewItem = id;
                    rejectPreview.innerHTML = document.getElementById('item_' + id).outerHTML;

                    // Set the Yes button function
                    buttonRejectYes.onclick = function () { window.location="verifyReject.php?qid="+id; };

                    // Show the dialog box
                    dialogReject.style.display = "block";
                }
            };

            // Press Ban User button
            function Ban(id) {
                if (!dialogOpen) {
                    dialogOpen = true;

                    // Set preview
                    document.getElementById('controls_' + id).style.display = 'none';
                    previewItem = id;
                    banPreview.innerHTML = document.getElementById('item_' + id).outerHTML;

                    // Set the Yes button function
                    buttonBanYes.onclick = function () { window.location="banUser.php?qid="+id+"&loc=1"; };

                    // Show the dialog box
                    dialogBan.style.display = "block";
                }
            };

        </script>
        <script>
            <?php foreach($questions as $q) : ?>
                var item = document.getElementById('item_<?php echo $q->id;?>');
                var accept = document.getElementById('accept_<?php echo $q->id;?>');
                    accept.onclick = function() {Accept(this.title)};
                var accept18 = document.getElementById('accept18_<?php echo $q->id;?>');
                    accept18.onclick = function() {Accept18(this.title)};
                var reject = document.getElementById('reject_<?php echo $q->id;?>');
                    reject.onclick = function() {Reject(this.title)};
                var ban = document.getElementById('ban_<?php echo $q->id;?>');
                    ban.onclick = function() {Ban(this.title)};        
            <?php endforeach;?>

        </script>
        
        
        
    </body>
</html>