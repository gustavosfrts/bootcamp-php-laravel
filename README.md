# Comandos úteis

* composer create-project laravel/laravel nome-do-projeto
* php artisan make:model nomeModel -mcr (cria model, controller e migration)
* php artisan storage:link
* composer require "darkaonline/l5-swagger"
  * php artisan vendor:publish --provider
  * php artisan l5-swagger:generate
    * https://ivankolodiy.medium.com/how-to-write-swagger-documentation-for-laravel-api-tips-examples-5510fb392a94
* composer require tymon/jwt-auth
  * php artisan jwt:secret 
  * https://www.positronx.io/laravel-jwt-authentication-tutorial-user-login-signup-api/
* php artisan db:seed
