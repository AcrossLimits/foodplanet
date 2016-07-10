<script>
    // 1 - Sort A-Z
    // 2 - Sort by Country

    var catalogState = 1;

    var btnCatalogAZ = document.getElementById("catalogAZ");
    var btnCatalogCountry = document.getElementById("catalogCountry");

    var catalog_AZ = document.getElementById('catalog_AZ');
    var catalog_Country = document.getElementById('catalog_Country');
    var currentCatalog = catalog_AZ;

    document.getElementById('catalogTable1').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('catalogMenu').clientHeight + 0)) + 'px';
    document.getElementById('catalogTable2').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('catalogMenu').clientHeight + 0)) + 'px';
    
    //console.log($('.playerPhotoWrapper').css("Width"));
    
    btnCatalogAZ.onclick = function () {
        if (catalogState != 1) {
            SwitchCatalog(1);
        }
    }

    btnCatalogCountry.onclick = function () {
        if (catalogState != 2) {
            SwitchCatalog(2);
        }
    }


    function SwitchCatalog(state) {
        currentCatalog.style.display = 'none';
        if (state == 1) {
            btnCatalogAZ.className = 'selected';
            btnCatalogCountry.className = '';
            currentCatalog = catalog_AZ;
        }
        else {
            btnCatalogCountry.className = 'selected';
            btnCatalogAZ.className = '';
            currentCatalog = catalog_Country;
        }

        // finally
        currentCatalog.style.display = 'block';
        var size = $('.playerPhotoWrapper').css('padding-bottom');
        $('.leaderPhoto').height(size);
        $('.leaderPhoto').width(size);
        catalogState = state;
    }

    SwitchCatalog(1);


</script>

<script>
    var infoBox = document.getElementById("moreInfo");
    var infoName = document.getElementById("moreinfoTitle");
    var infoContent = document.getElementById("moreInfoContent");
    var infoImage = document.getElementById("moreinfoUpper");
    var infoEuropeana = document.getElementById("moreInfoEuropeana");
    infoBox.style.display = 'none';
</script>

<script>

    function ShowItemInfo(itemID) {
        "use strict";
        $.ajax({
            type:"GET", 
            url: "https://fnd.acrosslimits.com/getItemInformation.php",
            data: "itemID="+itemID, 
            success: function(data) {

                    infoBox.style.display = 'block';
                    var splitData = data.split("##");
                    var europeana = splitData[4];
                    var provider = splitData[3];
                    
                    var content = splitData[2];
                    if(provider != "") {
                        content += "</br></br>Provided by:</br>"+provider;
    }
                    infoName.innerHTML = splitData[0];
                    infoContent.innerHTML = content;
                    if(europeana == ""){
                        infoEuropeana.innerHTML = "<a><img src='img/icon_vieweuropeana.png' alt='' /></a>";
                        if($("#moreInfoEuropeana").hasClass("europeana")){
                            $("#moreInfoEuropeana").removeClass("europeana");
                                
                         }
                    }
                    else{
                        if(!$("#moreInfoEuropeana").hasClass("europeana")){
                            $("#moreInfoEuropeana").addClass("europeana");
                         }
                    infoEuropeana.innerHTML = "<a href='"+europeana+"' target='_blank'><img src='img/icon_vieweuropeana.png' alt='' /></a>";}
                    infoImage.innerHTML = "<img src='img/questions/"+splitData[1]+"' alt=''/>";
                    
                    shareImage = "https://fnd.acrosslimits.com/img/questions/"+splitData[1];
                    shareTitle = "I just learnt about " + splitData[0];
                    shareDescription = "I just learnt about " + splitData[0] + " in Food Planet. Do you know where it's from?";
                    var fbShareBtn = document.querySelector('.fb_share');
                            fbShareBtn.addEventListener('click', function (e) {
                                e.preventDefault();
                                var title = shareTitle,
                                desc = shareDescription,
                                url = fbShareBtn.getAttribute('href'),
                                image = shareImage;
                                //postToFeed(title, desc, url, image);
								facebookShare(desc);
                                return false;
                            });

                    
                }, 
            error: function(jqXHR, textStatus, errorThrown) {
                    //console.log("Unable to get item information");
                }});}

    <?php foreach($catalog_AZ as $catAZ):?>
        
        var catAZ_<?php echo $catAZ->itemID;?> = document.getElementById('itemAZ_<?php echo $catAZ->itemID;?>');
        catAZ_<?php echo $catAZ->itemID;?>.onclick = function() {ShowItemInfo(<?php echo $catAZ->itemID;?>)};

    <?php endforeach?>

    <?php foreach($catalog_country as $catC):?>
        
        var catC_<?php echo $catC->itemID;?> = document.getElementById('itemC_<?php echo $catC->itemID;?>');
        catC_<?php echo $catC->itemID;?>.onclick = function() {ShowItemInfo(<?php echo $catC->itemID;?>)};

    <?php endforeach?>


    var moreInfoContinue = document.getElementById('moreInfoContinue');
    moreInfoContinue.innerHTML = "&nbsp;&nbsp;Close";
    moreInfoContinue.onclick = function() {infoBox.style.display = 'none';};
    


</script>