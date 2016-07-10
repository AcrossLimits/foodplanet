

<div id="page_upload" class="page" data="#bbe5fa" name="Upload Your Dish">
    <form enctype="multipart/form-data" id="formUpload" action="uploadSubmit.php" method="POST">
        
        <input type="hidden" name="provider" value="<?php echo $user->getFullName();?>" />
        <input type="hidden" name="uid" value="<?php echo $user->id;?>" />
        <div id="upper">
            <div id="uploadImage" class="fade-in one">
                <img id="uploadphoto" src="img/questions/uploadPhoto.jpg" alt="" />
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input id="fileupload" type="file" name="imageUpload" accept="image/*">                                
            </div>
        </div>
        <div id="middle">
            <input type="text" name="title" value="" id="txtUploadName" placeholder="What do you call this?" maxlength="34">
            
            <select id="ddCountry" name="countryid">
                <option value="0">Where is this from?</option>
                <?php
                global $connection;
                $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                $database = mysqli_select_db($connection, DB_DATABASE);
                $query = "SELECT * from tblAnswer ORDER BY text ASC";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){ 
                        echo "<option value='$row[0]'>$row[1]</option>";

                    }           
                }
            ?>
            </select>
            <textarea type="text" name="description" id="txtUploadDescription" rows="3" value="" placeholder="Enter a description"></textarea>
            <div class="uploadDivider">---------- OR ----------</div>
            <textarea type="text" name="europeanaLink" id="txtUploadEuropeana" rows="1" value="" placeholder="Paste a link from Europeana"></textarea>
        </div>
        <div id="uploadButton">
            Send to cyberspace
        </div>
    </form>
</div>

<script>
    
</script>
