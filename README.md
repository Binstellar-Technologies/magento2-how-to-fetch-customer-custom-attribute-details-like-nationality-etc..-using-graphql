## Magento2 How to fetch Customer custom attribute Details like nationality, marital_status etc... using GraphQL

> GraphQL, a query language for the APIs. 

&nbsp;
&nbsp;

> GraphQL provides a complete and understandable description of the data in your API, it makes it easier to evolve APIs over time.

&nbsp;
&nbsp;

> Here we have created a custom GraphQL module to get customer custom attribute values. There is always a need to add new customer attributes like Nationaity, Marital Status, Preferred Language, Highest Education etc.. 

&nbsp;
&nbsp;

Wondering how to achieve that? Don't worry we have got the solution for it.


> Install our module Binstellar/MyAccount

&nbsp;
&nbsp;

> In order to achieve this we have created a custom Resolver & added the functionality to get the customer added values via GRAPHQL end point.

&nbsp;
&nbsp;

## Installation Steps

##### Step 1 : Download the Zip file from Github & Unzip it
##### Step 2 : Create a directory under app/code/Binstellar/MyAccount
##### Step 3 : Upload the files & folders from extracted package to app/code/Binstellar/MyAccount
##### Step 4 : Go to the Magento2 Root directory & run following commands

php bin/magento setup:upgrade 

php bin/magento setup:di:compile

php bin/magento setup:static-content:deploy -f

php bin/magento cache:flush

&nbsp;
&nbsp;


![screenshot-nimbusweb me-2023 02 01-11_00_09](https://user-images.githubusercontent.com/123800304/215959599-cd832b7f-4c9a-412d-ab01-06a292c9f39a.png)


&nbsp;
&nbsp;


## Note : We have tested this option in Magento ver. 2.4.5-p1
