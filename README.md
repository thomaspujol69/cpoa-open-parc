# CPOA - Open Parc

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Features

* Production, development and CI ready
* Automatic HTTPS (in dev and in prod!)
* HTTP/2, HTTP/3 and [Preload](https://symfony.com/doc/current/web_link.html) support
* Built-in [Mercure](https://symfony.com/doc/current/mercure.html) hub
* [Vulcain](https://vulcain.rocks) support
* Just 2 services (PHP FPM and Caddy server)
* Super-readable configuration

**Enjoy!**

## Docker docs

1. [Build options](dockerDocs/build.md)
2. [Using Symfony Docker with an existing project](dockerDocs/existing-project.md)
3. [Support for extra services](dockerDocs/extra-services.md)
4. [Deploying in production](dockerDocs/production.md)
5. [Installing Xdebug](dockerDocs/xdebug.md)
6. [Using a Makefile](dockerDocs/makefile.md)
7. [Troubleshooting](dockerDocs/troubleshooting.md)

