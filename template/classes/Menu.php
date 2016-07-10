<?php

    class Menu
    {
        // property declaration
        public $user;

	    public function create(User $user) {            
		    $this->user = $user;
	    }

        public function getMenu() {
            $menu = file_get_contents('comp/navigation.php', true);

            $menu = str_replace("__USERNAME__", $this->user->getFullName(), $menu);
            $menu = str_replace("__USERPOINTS__", $this->user->getPoints($this->user->id), $menu);
            $menu = str_replace("__USERWINS__", $this->user->getWins($this->user->id), $menu);
            $menu = str_replace("__USERBADGES__", $this->user->getBadges($this->user->id), $menu);
            $menu = str_replace("__USERIMAGE__", $this->user->pictureURL, $menu);

            if($this->user->statusID == 2)
                $menu = str_replace("__ISADMIN__", "<a href='verifyUploaded.php'><div class='navItem admin'><div class='navIcon'><img src='img/icons/iconReview.png' /></div><div class='navLink'>Verify uploaded meals</div></div></a>", $menu);
            else
                $menu = str_replace("__ISADMIN__", "", $menu);
            echo $menu;
            
        } 
    }

?>
