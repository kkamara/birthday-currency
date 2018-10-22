### Task

Using the following service [http://fixer.io/] you are to create a simple web app which allows a user to find out what the exchange rate (for a currency of your choice) was on their previous birthday. 

You are to store all submissions to the site and display them on the webpage. One caveate to this is if the same birthday occurs twice then this should be indicated with the number of times that birthday has occurred _not_ duplicate entries.

The results should be shown in date order with the most recent birthday being first. Their should also be some validation in place which doesn't allow dates over a year ago or in the future. Also if the api was down the app should be able to fail gracefully and return a simple error message.

The date should be displayed in the following format "15th January 2017"
