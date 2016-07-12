[![GitHub license](https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Cc-by-nc_icon.svg/88px-Cc-by-nc_icon.svg.png)](https://creativecommons.org/licenses/by-nc/2.0/)

# Food Planet Framework
An open source PHP/HTML5 quiz framework based on the game Food Planet, an application built by [AcrossLimits Ltd. (Malta)](http://www.acrosslimits.com/) for the [Europeana Food and Drink project](http://foodanddrinkeurope.eu/). All replications of the application using the provided template must follow the rules of the above mentioned license: Attribution-NonCommercial 2.0 Generic (CC BY-NC 2.0) and **MUST** credit AcrossLimits and their website at [http://www.acrosslimits.com/](http://www.acrosslimits.com/).

The original Food Planet game is free to download and can be found on [Google Play](https://play.google.com/store/apps/details?id=com.acrosslimits.foodplanet&hl=en), [iTunes](https://itunes.apple.com/us/app/food-planet/id1038410544?mt=8) and the [Microsoft App Store](https://www.microsoft.com/en-us/store/apps/food-planet/9nblggh6h48c).

## Summary
Food Planet is a game where players try and answer questions as quickly as possible receiving points based on the speed in which they give correct answers. In the scope of Food Planet, the player is presented with a food or drink item and four possible countries in which the item can originate from. The player selects the corresponding country and receives points depending on whether they are correct or not. After five questions, you user is shown his/her score and if applicable their opponents score too.

## Requirements
In order to successfully replicate this application you must make sure you possess a server with the following:
- PHP
- mySQL
- Access to File/Folder permissions
- A fresh application registered on Facebook
- Ability to create cron jobs or scheduled tasks

## Replication
Below see the steps you will need to take to replicate Food Planet

#### - The Facebook Application
This framework makes use of Facebook to handle logins. In order to facilitate this you need to create a blank Facebook application. To do this, navigate to the [Facebook Developers](https://developers.facebook.com/) page, login and then click `My Apps > Add a New App` from the menu in the top right of the page.

When asked what platform to use, chose `Website`, give your new app a name and then click `Create New Facebook App ID`. When prompted, enter a contact email and select the category your new app will fall under, in our case `Games>Trivia & Word`. *You may need to prove you are human at this point.* You will then be taken to a Quick-start page, ignore this and simply click the `Skip Quickstart` button on the top right of the page.

Finally, you will be taken to your new applications settings page. Take note of the `App ID` and `App Secret` as we will be using them later. At this point we have created a blank Facebook Application but we will be returning to this page later on to finish things up.

#### - The Database
Download the database schema `Schema.sql` found within the `Schema` folder. Create a mySQL database and run the schema within it, creating the required tables. 

#### - The Application
In order to replicate the Food Planet codebase download the files in the template folder and upload them on to your file server via FTP or any other upload method. 

#####  Database Connections
Find `DBConnection.php` within the `template/classes` and open it. Find the following lines of code on the top of the file and replace them with the information of the database you created in the previous step.

```php
define('DB_SERVER', 'SERVER-ADDRESS');    // Replace SERVER-ADDRESS to your server domain/IP
define('DB_USERNAME', 'USERNAME');        // Replace USERNAME with your database admin username
define('DB_PASSWORD', 'PASSWORD');        // Replace PASSWORD with your database admin password
define('DB_DATABASE', 'DATABASE NAME');   // Replace DATABASE NAME with your database name
```

Repeat this step for the `DBConnection.php` file in `template/upload_tool/classes` and the `dbconfig.php` file in `template/php/Facebook`.

#####  Facebook Application Settings

Locate `fbconfig.php` in `template/php/Facebook` and find the following lines within it:

```php
// init app with app id and secret
FacebookSession::setDefaultApplication( 'FACEBOOK-APP-ID','FACEBOOK-APP-SECRET' );
```

Replace `FACEBOOK-APP-ID` and `FACEBOOK-APP-SECRET` with the values found in [#The Facebook Application](https://github.com/AcrossLimits/foodplanet/blob/master/README.md#the-facebook-application) above. Do the same for `template/loginSubmit.php`

Return to the [Facebook Developers](https://developers.facebook.com/) page, select the application you created and navigate to `Settings`. Find the `Namespace` field and enter a unique one-word identifier for your application. In the `App Domains`field enter the URL of your application.

Once you have updated your settings, navigate to `App Review` and change `Make <Application Name> public?` to Yes. If everything was succesfull then you should now be able to login to your app via Facebook. Take a deep breath, we're almost done.

##### Administrator Rights

Log in to your database management tool (such as phpMyAdmin) and connect to the application database. Navigate to `tblUser`, find the row which contains your user data and change the value of `statusID` from `1` to `2`. This will set you up as an Administrator and allow you to verify user uploaded content in-game.


##### The Scheduled Task/Cron Job

The last thing we need to do is set up a scheduled task that will periodically clean up any residual challenges. In Food Planet, any challenges over 48 hours old are automatically closed, keeping things fresh. Another task done is re-opening challenges which for some reason might be marked as `occupied` however haven't concluded within an hour.

To do this, a file named `template/cron.php` was created which when opened will run these tasks. In order to automate this, we need to create a scheduled task or cron job to execute this file at a regular interval. The way in which to do this differs from one host to another, so you will need to do your own research on how to set these up. In the case of Food Planet, `cron.php` was set up to execute every 30 minutes.

##### Adding Content

The final thing left to do is add some content to our game. Navigate to the upload tool at `<YOUR-DOMAIN.com>/upload_tool/`. Over here simply fill out the fields of each item for your game and submit them. You **MUST** have at least five items uploaded.

## Conclusion

That's it! If everything went according to plan you should now have your very own version of the game on your domain. We had to remove the question content from the template due to licensing but we threw in all the badges, country flags and icons. You will need to modify some of the text of course!

Happy Playing!
