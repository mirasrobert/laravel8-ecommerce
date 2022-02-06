# MewTronShop eCommerce Platform

> A fully functional eCommerce platform built with the Laravel framework.

![screenshot](https://github.com/mirasrobert/laravel8-ecommerce/blob/main/public/img/WEBSITE_SCREENSHOT.png)

![screenshot](https://github.com/mirasrobert/laravel8-ecommerce/blob/main/public/img/WEBSITE_SCREENSHOT_2.png)

## Features

- Full featured shopping cart
- Product reviews and ratings
- Top products carousel
- Product pagination
- Product sort feature
- User profile with orders
- Admin product management
- Admin user management
- Admin Order details page
- Mark orders as delivered option
- Checkout process (shipping, payment method, etc)
- PayPal / credit card integration


## Usage

## How to Clone/Install
1. Clone the repo
2. Install Composer
<code>composer install</code>
3. Rename .env.example to .env and updated it with your database credentials.<br />


## API CREDENTIALS
We are using CLOUDINARY to save our images so you need to get it from the cloudinary website

Get your Sandbox Account PAYPAL CLIENT ID in Paypal website.
If you want OAUTH LOGIN then you need to grab your own credentials.

```
CLOUDINARY_URL=
CLOUDINARY_UPLOAD_PRESET=
CLOUDINARY_NOTIFICATION_URL=
PAYPAL_CLIENT_ID = your paypal client id

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
```

## GET KEY AND CREDENTIALS
```
[PAYPAL DEVELOPER](https://developer.paypal.com/home)
[GOOGLE CONSOLE DEVELOPER](https://console.developers.google.com/apis/credentials?project=intense-base-324910)
[CLOUDINARY](https://cloudinary.com/)
```


### Install Other Tables

After migrating tables, import some tables manually in <i>database/mysql</i> folder for shipping address to work.

## SERVE APPLICATION
<b>Run this 3 command in your project terminal</b> <br />
<code>$ php artisan key:generate</code> <br />
<code>$ composer update</code> <br />
<code>$ php artisan serve</code> <br />

## Additional

<code>$ php artisan storage:link</code> <br />
<code>$ php artisan migrate</code> <br />

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
