# Covid Tracker 
### A CovidResearch Project

This is a RESTful API microservice for tracking the Covid-19 coronavirus pandemic statistics.

It is dockerized and runs PHP, Nginx, PostgreSQL and Redis. 

**tl;dr:** To get started, just do this:

    git clone https://github.com/CovidResearch/CovidTracker.git
    cd CovidTracker 
    setfacl -Rm u:http:rwx bootstrap/cache storage
    docker-compose up -d
    composer install
    php artisan migrate
    php artisan key:generate

* Watch the [**construction timelepse of this project**](https://)!

[![Installation Video](https://goo.gl/zrNzEL)](https://vimeo.com/254289186)

## Features: ##

1. RESTful API for tracking Covid-19 infections, deaths, and recoveries by country.


## Inspiration ##

This was inspired by https://www.worldofstats.com/coronavirus/

## Author

Theodore R. Smith <theodore@phpexperts.pro>
