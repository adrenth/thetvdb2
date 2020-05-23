# adrenth/thetvdb2

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

```
$ composer require adrenth/thetvdb2
```

## Requirements

At least PHP 7.1

## Documentation

The official API documentation can be found here: [https://api.thetvdb.com/swagger]().

### Authentication

```
$client = new \Adrenth\Thetvdb\Client();
$client->setLanguage('nl');

// Obtain a token
$token = $client->authentication()->login($apiKey, $username, $userKey);
$client->setToken($token);

// Or refresh token
$client->refreshToken();
```

### Extensions

The `Client` has a few extensions. A few usage examples are listed below:

#### Authentication
```
$client->authentication()->login($apiKey, $username, $userKey);
$client->authentication()->refreshToken();
```

#### Languages
```
$client->languages()->all();
$client->languages()->get($languageId);
```

#### Episodes
```
$client->episodes()->get($episodeId);
// ..
```

#### Series
```
$client->series()->get($seriesId);
$client->series()->getActors($seriesId);
$client->series()->getEpisodes($seriesId);
$client->series()->getImages($seriesId);
$client->series()->getLastModified($seriesId);
// ..
```

#### Search
```
$client->search()->seriesByName('lost');
$client->search()->seriesByImdbId('tt2243973');
$client->search()->seriesByZap2itId('EP015679352');
// ..
```

#### Updates

Fetch a list of Series that have been recently updated:

```
$client->updates()->query($fromTime, $toTime);
```

#### Users

```
$client->users()->get();
$client->users()->getFavorites();
$client->users()->addFavorite($identifier);
$client->users()->removeFavorite($identifier);
$client->users()->getRatings();
$client->users()->addRating($type, $itemId, $rating);
$client->users()->updateRating($type, $itemId, $rating);
$client->users()->removeRating($type, $itemId);

//..
```

#### Movies

```
$client->movies()->get(78398);
$client->movies()->getUpdates();
```

### Response data

Every response object has a `getData()` method which may contain a collection of objects.

For example:

```
// Get all available languages
$languageData = $client->languages()->all(); // Returns a LanguageData instance
$languages = $languageData->getData()->all();

array:23 [▼
  0 => Language {#26 ▼
    -values: array:4 [▼
      "id" => 27
      "abbreviation" => "zh"
      "name" => "中文"
      "englishName" => "Chinese"
    ]
  }
  1 => Language {#19 ▶}
  2 => Language {#30 ▶}
  3 => Language {#21 ▶}
  // ..
];
```

## Contributing

Feel free to join us and create a stable version which is compatible with the brand new TheTVDB.com RESTful API.

