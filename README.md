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

Check this websites to grab your own CLIENT_ID and CLIENT_SECRET

[PAYPAL DEVELOPER](https://developer.paypal.com/home)
<br>
[GOOGLE CONSOLE DEVELOPER](https://console.developers.google.com/apis/credentials?project=intense-base-324910)
<br>
[FACEBOOK DEVELOPER](https://developers.facebook.com/apps/)
<br>
[CLOUDINARY](https://cloudinary.com/)


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

MIT License

Copyright (c) 2022 Robert Miras https://robertmiras.herokuapp.com/

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

