# adrenth/thetvdb

This is an API client for the thetvdb.com website. It's using the RESTful API which you'll need to register for to use this package.

## API Key Registration

To use this PHP package, you need to request an API Key from the thetvdb.com website: [http://thetvdb.com/?tab=apiregister](http://thetvdb.com/?tab=apiregister).

Please follow these guidelines:

* If you will be using the API information in a commercial product or website, you must email [scott@thetvdb.com](mailto:scott@thetvdb.com) and wait for authorization before using the API. However, you MAY use the API for development and testing before a public release.
* If you have a publicly available program, you MUST inform your users of this website and request that they help contribute information and artwork if possible.
* You MUST familiarize yourself with our data structure, which is detailed in the wiki documentation.
* You MUST NOT perform more requests than are necessary for each user. This means no downloading all of our content (we'll provide the database if you need it). Play nice with our server.
* You MUST NOT directly access our data without using the documented API methods.
* You MUST keep the email address in your account information current and accurate in case we need to contact you regarding your key (we hate spam as much as anyone, so we'll never release your email address to anyone else).
* Please feel free to contact us and request changes to our site and/or API. We'll happily consider all reasonable suggestions.

*Source: thetvdb.com*

## Installation

Install this package using composer:

````
$ composer require adrenth/thetvdb2
````

## Contributing

This is version 2.0 of the TheTVDB.com API client. Feel free to join us and create a stable version which is compatible with the brand new TheTVDB.com RESTful API.

