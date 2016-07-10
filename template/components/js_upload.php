<script>
    var uploadsize = $('#uploadImage').css('padding-bottom');
    $('#uploadphoto').width(uploadsize);
    $('#uploadphoto').height(uploadsize);

    var uploadThankssize = $('#uploadThanksWrapper').css('padding-bottom');
    $('#uploadThanksIcon').width(uploadThankssize);
    $('#uploadThanksIcon').height(uploadThankssize);

    var uploadFailedsize = $('#uploadFailedWrapper').css('padding-bottom');
    $('#uploadFailedIcon').width(uploadFailedsize);
    $('#uploadFailedIcon').height(uploadFailedsize);



    var uploadButton = document.getElementById("uploadButton");
    var txtUploadName = document.getElementById("txtUploadName");
    var ddCountry = document.getElementById("ddCountry");
    var txtUploadDescription = document.getElementById("txtUploadDescription");
    var txtEuropeanaLink = document.getElementById("txtUploadEuropeana");

    uploadButton.onclick = function () {
        var success = true;
        var uploadName = txtUploadName.value;
        var uploadDescription = txtUploadDescription.value;
        var europeanaLink = txtEuropeanaLink.value;

        if (europeanaLink == "") {

            // If the name passes validation
            if (passesValidation(uploadName)) {
                $('#txtUploadName').css("border", "1px solid #fff");
                $('#txtUploadName').css("border-bottom", "2px solid #5f9ab3");
            }

            else {
                success = false;
                $('#txtUploadName').css("border", "1px solid #ff0000");
                $('#txtUploadName').css("border-bottom", "2px solid #ff0000");
            }

            // If the country passes validation
            if (ddCountry.value > 0) {
                $('#ddCountry').css("border", "1px solid #fff");
                $('#ddCountry').css("border-bottom", "2px solid #5f9ab3");
            }
            else {
                success = false;
                $('#ddCountry').css("border", "1px solid #ff0000");
                $('#ddCountry').css("border-bottom", "2px solid #ff0000");
            }

            // If the description passes validation
            if (passesValidation(uploadDescription)) {
                $('#txtUploadDescription').css("border", "1px solid #fff");
                $('#txtUploadDescription').css("border-bottom", "2px solid #5f9ab3");
            }

            else {
                success = false;
                $('#txtUploadDescription').css("border", "1px solid #ff0000");
                $('#txtUploadDescription').css("border-bottom", "2px solid #ff0000");
            }
        }
        else {
            if(europeanaLink.indexOf("europeana.eu") > -1) {
                
            }
            else {
                success = false;
                $('#txtUploadEuropeana').css("border", "1px solid #ff0000");
                $('#txtUploadEuropeana').css("border-bottom", "2px solid #ff0000");
            }
                
        }

        // Finally, if all data is succesfully entered, upload
        if (success) {
            document.forms["formUpload"].submit();
        }
    };

    var uploadSuccessButton = document.getElementById("uploadSuccessReturn");

    uploadSuccessButton.onclick = function () {
        window.location = "page.php#dashboard";
    };


    var uploadFailedButton = document.getElementById("uploadFailedReturn");

    uploadFailedButton.onclick = function () {
        window.location = "page.php#dashboard";
    };

    function passesValidation(string) {
        if (string != "" && string.indexOf(";") == -1 && string.indexOf("=") == -1 && string.indexOf("&") == -1 && string.indexOf("!") == -1)
            return true;
        else
            return false;
    }


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#uploadphoto').attr('src', e.target.result);

                if (uploadphoto.clientHeight > uploadphoto.clientWidth) {
                    $('#uploadphoto').css('height', $('#uploadphoto').css('width'));
                }
                if (uploadphoto.clientWidth > uploadphoto.clientHeight) {
                    $('#uploadphoto').css('width', $('#uploadphoto').css('height'));
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileupload").change(function () {
        readURL(this);

    });

</script>