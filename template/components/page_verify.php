<?php 
    include_once('classes/Question.php'); 
    $question = new Question;
    $questions = $question->getUnverified(); 
?>
<div id="page_verify" class="page" data="#bbe5fa" name="Verify Uploaded Meals">
    <div id="verfiy_content">
        <?php if (count($questions) < 1) { ?>
            <div class="noQuestions">No Submissions</div>
        <?php } else {?>
            <div id="verify_uploads">
                <?php foreach($questions as $q) : ?>
                            <table class="uploadItem">
                                <tr>
                                    <td class="tdimage">
                                        <div class="imageWrapper"><img src='img/questions/<?php echo $q->imgURL?>' alt="" /></div>
                                    </td>
                                    <td class="tddetails">
                                        <div class="details">
                                            <div class="itemName"><?php echo $q->title;?></div>
                                            <div class="itemAuthor"><b>Uploaded by:</b> <?php echo $q->authorName;?></div>
                                            <div class="itemLocation"><b>Location:</b> <?php echo $q->answer;?></div>
                                            <div class="itemDescription"><b>Description:</b> <?php echo $q->description;?></div>
                                        </div>
                                        <div class="controls">
                                            <a href="verifyAccept.php?qid=<?php echo $q->id;?>&adult=0"><div class="control accept">Accept</div></a>
                                            <a href="verifyAccept.php?qid=<?php echo $q->id;?>&adult=1"><div class="control accept18">Accept 18+</div></a>
                                            <a href="verifyReject.php?qid=<?php echo $q->id;?>&adult=1"><div class="control reject">Reject</div></a>
                                            <a href="banUser.php?qid=<?php echo $q->id;?>&loc=1"><div class="control ban">Ban User</div></a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                        <?php endforeach;?>
            </div>
        <?php }?>
    </div>

</div>