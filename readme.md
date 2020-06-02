## Installation:-

``` bash
1.) Take checkout from master branch
2.) Create .env file and paste the codes from .env.example
3.) Run command composer install
4.) Run command php artisan migrate
4.) Run command php artisan passport:install
5.) Run command php artisan db:seed

```

## login API using Passport:-

``` bash
Test as per given norms:-

1.)  API end point '/api/auth/signup', Method 'POST', body->application/json
    {
        "name" : "shashank",
        "email" : "shashank@a.com",
        "password" : "12345678",
        "password_confirmation" : "12345678"
    }
2.) API end point '/api/auth/login', Method 'POST', body->application/json
    {
        "email" : "shashank@a.com",
        "password" : "12345678",
        "remember_me" : true
    }
3.) API end point '/api/auth/user', Method 'GET', Header->Bearer Token
3.) API end point 'api/auth/logout', Method 'GET', Header->Bearer Token
```