# API Demo

This demo works to serve as a real-life demo of Cartalyst's API V2 for Laravel 4.1. The package is a work-in-progress and therefore this demo is as well.

This demo is a mockup of Foursqure and the following entities:

1. Places
2. Users
3. Checkins

Data is seeded to the database by Laravel's seeding. We utilise our API package for internal API requests - allowing you to build API-first applications (an abstraction where your application's controllers talk [in runtime] directly to your RESTful API).

This demo is following [Phil Sturgeon's](https://github.com/philsturgeon) recommendations for [building a decent RESTful API](http://philsturgeon.co.uk/blog/2013/07/building-a-decent-api).

We are also utilising [The League of Extraordinary Packages'](http://thephpleague.com) REST API helper package, [Fractal](https://github.com/php-loep/fractal).

For more information on using Fractal to build awesome REST APIs, see [Build APIs You Won't Hate](https://leanpub.com/build-apis-you-wont-hate).


## Installation

To install this demo, firstly you must be a subscriber of Cartalyst's [Arsenal](http://cartalyst.com/arsenal).

Installation:

1. Clone this repo:

```
git clone git@github.com:cartalyst/api-demo.git
```

2. Setup your virtual host.

3. Go into the directory in your terminal app and install composer dependencies:

```
composer install
```

4. Configure your database connection.

5. Run migrations for Sentinel and the main application

```
php artisan migrate --package=cartalyst/sentinel
php artisan migrate
```

6. Seed your database (you can do this as many times as you want, it will reset the database each time).

```
php artisan db:seed
```

## API Usage

We have fulfilled the basic ~~C~~RUD processed for a "place" entity. Begin by hitting the following endpoint on your app:

```
GET /api/v1/places HTTP/1.1
Host: api.dev
```

Excerpt From: Phil Sturgeon. “Build APIs You Won't Hate.” iBooks.

This will return a nicely formatted array of available places. You may also nest in checkins for each place and associated users (which was populated through the seeding process above). To have a play with this, get your favorite HTTP client (I like the [Postman REST Client](https://chrome.google.com/webstore/detail/postman-rest-client/fdmmgilgnpjigdojojpjoooidkmcomcm?hl=en) for Chrome):

```
GET /api/v1/places?include=checkins HTTP/1.1
Host: api.dev
```

```
GET /api/v1/places?include=checkins.user HTTP/1.1
Host: api.dev
```

Take a look at `app/routes.php` for the endpoints we've implemented in this basic demo.

You may also perform a `PUT` request following URI to update a place, for example (note, our API demo is expecting JSON-encoded data, and so should your API, ditch that form-url-encoded junk):

```
PUT /api/v1/places/1 HTTP/1.1
Host: api.dev
```

```
{"name":"New Name","address","123 Fake Street\nFake City"}
```

And of course, you may `DELETE` a place:

```
DELETE /api/v1/places/1 HTTP/1.1
Host: api.dev
```

At this stage, we've not built endpoints for creating places, because that can happen through database seeding. This is a demo only, not a full app :)

## Admin Usage

Once again, being a demo, there's no admin filters, nothing too fancy, just routes to simulate an admin interface.

To begin, navigate your browser to `http://api.dev/admin/places` (substituting your HTTP host in). The rest is obvious, you may edit/delete places. The code is where you want to look though, to see the interactions between the admin controllers and the API controllers, to see how requests are created at runtime and objects are returned.

> *Note:* This demo is not a fully-fledged app. It's a demo, so we're not covering every possible scenario or completed every endpoint.
