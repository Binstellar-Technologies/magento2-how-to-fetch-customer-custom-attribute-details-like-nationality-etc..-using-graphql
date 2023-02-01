## Magento2 How to fetch Customer custom attribute Details like nationality, marital_status etc... using GraphQL

> Magento2 GraphQL to get customer custom attribute values. There is always a need to add new customer attributes like Nationaity, Marital Status etc.. 

Wondering how to achieve that? Don't worry we have got the solution for it.

> Install our module Binstellar/MyAccount


## Installation Steps

Step 1 : Download the Zip file from Github & Unzip it
Step 2 : Create a directory under app/code/Binstellar/MyAccount
Step 3 : Upload the files & folders from extracted package to app/code/Binstellar/MyAccount
Step 4 : Go to the Magento2 Root directory & run following commands

php bin/magento setup:upgrade 
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy -f
php bin/magento cache:flush


## Note : We have tested this option in Magento ver. 2.4.5-p1