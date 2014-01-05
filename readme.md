# API Demo

This demo works to serve as a real-life demo of Cartalyst's API V2 for Laravel 4.1. The package is a work-in-progress and therefore this demo is as well.

This demo is a mockup of Foursqure and the following entities:

1. Places
2. Users
3. Checkins

Data is seeded to the database by Laravel's seeding. We utilise our API package for internal API requests - allowing you to build API-first applications (an abstraction where your application's controllers talk [in runtime] directly to your RESTful API).

This demo is following [Phil Sturgeon's](https://github.com/philsturgeon) recommendations for [building a decent RESTful API](http://philsturgeon.co.uk/blog/2013/07/building-a-decent-api).

We are also utilising [The League of Extraordinary Packages'](http://thephpleague.com) REST API helper package, [Fractal](https://github.com/php-loep/fractal).


 https://leanpub.com/build-apis-you-wont-hate


## Installation

To install this demo, firstly you must be a subscriber of Cartalyst's [Arsenal](http://cartalyst.com/arsenal).

Installation:

1. Clone this repo:

        git clone git@github.com:cartalyst/api-demo.git

2. Go into the directory in your terminal app and install composer dependencies:

        composer install

3. Run migrations for Sentry and the main application

        composer install
