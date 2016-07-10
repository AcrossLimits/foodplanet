<?php if($uid != "Guest") {?>
<script>
    var menu_geographical = document.getElementById('menuGeographical');
    var menu_challenges = document.getElementById('menuChallenges');
    var menu_uploads = document.getElementById('menuUploads');

    var badges_geographical = document.getElementById('badges_geographical');
    var badges_challenge = document.getElementById('badges_challenge');
    var badges_upload = document.getElementById('badges_upload');

    menu_geographical.onclick = function() {
      menu_geographical.className = 'selected';
      menu_challenges.className = '';
      menu_uploads.className = '';
      badges_geographical.style.display = 'block';  
      badges_challenge.style.display = 'none';
      badges_upload.style.display = 'none';
    };

    menu_challenges.onclick = function() {
      menu_geographical.className = '';
      menu_challenges.className = 'selected';
      menu_uploads.className = '';
      badges_geographical.style.display = 'none';  
      badges_challenge.style.display = 'block';
      badges_upload.style.display = 'none';
    };

    menu_uploads.onclick = function() {
      menu_geographical.className = '';
      menu_challenges.className = '';
      menu_uploads.className = 'selected';
      badges_geographical.style.display = 'none';  
      badges_challenge.style.display = 'none';
      badges_upload.style.display = 'block';
    };

    var height = (document.getElementById('badgesMenu').clientHeight + document.getElementById('header').clientHeight);
    console.log(height);
    badges_geographical.style.height = (window.innerHeight - height) + 'px';
    badges_challenge.style.height = (window.innerHeight - height) + 'px';
    badges_upload.style.height = (window.innerHeight - height) + 'px';
    menu_geographical.className = 'selected';
      menu_challenges.className = '';
      menu_uploads.className = '';
      badges_geographical.style.display = 'block';  
      badges_challenge.style.display = 'none';
      badges_upload.style.display = 'none';
</script>

<script>
        <?php foreach($geo_badges as $b) : ?>
            var badge_<?php echo $b->id; ?> = document.getElementById('badge_<?php echo $b->id; ?>');
            <?php if(in_array($b->id, $userBadges)) { ?>
                badge_<?php echo $b->id; ?>.onclick = function() {ShowOwnedBadge(<?php echo $b->id; ?>, '<?php echo $b->name; ?>', '<?php echo $b->description; ?>', '<?php echo $b->borderColor; ?>', '<?php echo $b->bgColor; ?>')};
            <?php } else { ?>
                badge_<?php echo $b->id; ?>.onclick = function() {ShowBadge(<?php echo $b->id; ?>, '<?php echo $b->name; ?>', '<?php echo $b->description; ?>', '<?php echo $b->borderColor; ?>', '<?php echo $b->bgColor; ?>')};
            <?php } ?>
            
        <?php endforeach;?>
        <?php foreach($challenge_badges as $b) : ?>
            var badge_<?php echo $b->id; ?> = document.getElementById('badge_<?php echo $b->id; ?>');
            <?php if(in_array($b->id, $userBadges)) { ?>
                badge_<?php echo $b->id; ?>.onclick = function() {ShowOwnedBadge(<?php echo $b->id; ?>, '<?php echo $b->name; ?>', '<?php echo $b->description; ?>', '<?php echo $b->borderColor; ?>', '<?php echo $b->bgColor; ?>')};
            <?php } else { ?>
                badge_<?php echo $b->id; ?>.onclick = function() {ShowBadge(<?php echo $b->id; ?>, '<?php echo $b->name; ?>', '<?php echo $b->description; ?>', '<?php echo $b->borderColor; ?>', '<?php echo $b->bgColor; ?>')};
            <?php } ?>
        <?php endforeach;?>
        <?php foreach($upload_badges as $b) : ?>
            var badge_<?php echo $b->id; ?> = document.getElementById('badge_<?php echo $b->id; ?>');
            <?php if(in_array($b->id, $userBadges)) { ?>
                badge_<?php echo $b->id; ?>.onclick = function() {ShowOwnedBadge(<?php echo $b->id; ?>, '<?php echo $b->name; ?>', '<?php echo $b->description; ?>', '<?php echo $b->borderColor; ?>', '<?php echo $b->bgColor; ?>')};
            <?php } else { ?>
                badge_<?php echo $b->id; ?>.onclick = function() {ShowBadge(<?php echo $b->id; ?>, '<?php echo $b->name; ?>', '<?php echo $b->description; ?>', '<?php echo $b->borderColor; ?>', '<?php echo $b->bgColor; ?>')};
            <?php } ?>
        <?php endforeach;?>

        var badgePreview = document.getElementById('badgePreview');
        var badgeInfoName = document.getElementById('badgeInfoName');
        var badgeInfoDescription = document.getElementById('badgeInfoDescription');

        function ShowBadge(id, name, description, borderColor, bgColor) {
            var imgID = id;
            if(id < 10)
                imgID = "0"+id;                
            setUpBadgeDialog(name, description, imgID, borderColor, bgColor);
            document.getElementById('dialogBadgeUnlocked').style.display = "block";
        };

        function ShowOwnedBadge(id, name, description, borderColor, bgColor) {
            var imgID = id;
            if(id < 10)
                imgID = "0"+id;                
            setUpBadgeOwnedDialog(name, description, imgID, borderColor, bgColor);
            document.getElementById('dialogBadgeOwned').style.display = "block";
        };

    </script>
<?php }?>