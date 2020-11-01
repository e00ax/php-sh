# Laravel smarthome frontend
!!!Development status:<br>
> Package is currently in Development status. Bugs may occur, library may be unstable, API may be changed anytime.<br>
## Prequisites:
This smarthome needs a very specific enviroment, sorry if it doesn't match yours.<br>
- Philips Hue bridge.
- Philips Hue developer id and token for the bridge.
- Nuki lock (or more) + bridge.
- Nuki id and developer token.
- Pi (or zero pi) with a lamp enviroment and a relais card for the door.
- Pi (or zero pi) with a lamp enviroment and a relais card for the Atmotec gas boiler.
- A blank laravel project (everything else doesn't make sense)

> Of course everything must be setup and ready!

## Installation:
Package may be installed using Composer:
> `composer require e00ax/php-sh`<br>

Add the ServiceProvider in `config/app.php`:<br>
> `E00ax\Sh\ShServiceProvider::class`

And publish with:<br>
> `php artisan vendor:publish --provider=E00ax\Sh\ShServiceProvider`

## To Do:
- Use laravel session managment
- Implement auth middleware

> This frontend has no security features since it is intended to run in a seperate enviroment!

> Sorry, no further documentation available yet!
