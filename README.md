
## About My Laravel App 

This is a user registration system using Appetiser's Baseplate API. It contains 4 pages:
- Login Page
- Registration Page
- Verification Page
- Success Page

### How to build my Laravel App
1. Download and Install the following 3rd-party applications:
	- Composer (https://getcomposer.org/download/)
	- XAMPP (https://www.apachefriends.org/index.html)
2. Using windows command prompt, go to xampp directory (xampp/htdocs), then create a laravel project using Composer
	composer create-project laravel/laravel myApp
3. Run the Apache serve on XAMPP, then open http://localhost/myApp/public/ on your browser, and now you can see the default welcome page of a Laravel project.
4. To create the webpages, go to resources/views, where you can find welcome.blade.php which is the default welcome page of your Laravel project. On these folder, you will add your views or the files that contains the layout of your webpages.
5. To access these webpages, you must create routes, you can add routes on the routes/web.php file. Declaring routes will be including your layouts(views) in order for you to see them as a webpage on your browser.
6. To add logic in your routes, like validation of inputs from a form, you need also to create controllers. Controllers contains functions connected to your routes, on these functions, you will add the logic behind your routes and this will be triggered every time you open the webpage connected to that route. Controller must be created on the app/Http/Controllers folder.