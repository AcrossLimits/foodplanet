[![GitHub license](https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Cc-by-nc_icon.svg/88px-Cc-by-nc_icon.svg.png)](https://creativecommons.org/licenses/by-nc/2.0/)

# Food Planet Framework
An open source PHP/HTML5 quiz framework based on the game Food Planet, an application built by [AcrossLimits Ltd. (Malta)](http://acrosslimits.com/) for the [Europeana Food and Drink project](http://foodanddrinkeurope.eu/). All replications of the application using the provided template must follow the rules of the above mentioned license: Attribution-NonCommercial 2.0 Generic (CC BY-NC 2.0).

The original Food Planet game is free to download and can be found on [Google Play](https://play.google.com/store/apps/details?id=com.acrosslimits.foodplanet&hl=en), [iTunes](https://itunes.apple.com/us/app/food-planet/id1038410544?mt=8) and the [Microsoft App Store](https://www.microsoft.com/en-us/store/apps/food-planet/9nblggh6h48c).

# Summary
Food Planet is a game where players try and answer questions as quickly as possible receiving points based on the speed in which they give correct answers. In the scope of Food Planet, the player is presented with a food or drink item and four possible countries in which the item can originate from. The player selects the corresponding country and receives points depending on whether they are correct or not. After five questions, you user is shown his/her score and if applicable their opponents score too.

# Requirements
In order to successfully replicate this application you must make sure you possess a server with the following:
- PHP
- mySQL
- Access to File/Folder permissions
- A fresh application registered on Facebook
- Ability to create cron jobs or scheduled tasks

# Replication
Below see the steps you will need to take to replicate Food Planet


#### The Database
Download the database schema `Schema.sql` found within the `Schema` folder. Create a mySQL database and run the schema within it, creating the required tables. 

#### The Application
In order to replicate the Food Planet game download the files in the template folder and upload them on to your file server via FTP or any other upload method. Find `DBConnection.php` within the `template/classes` and open it.

