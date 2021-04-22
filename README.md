## Creating Views

A view represents a page that is rendered or an action like logging out. It processes data and passes them to templates or redirects to another view. Templates contain html and may render php variables passed to them.

Views are functions in `views.php`. They also need to be added to the urls array in `index.php`:

```php
$urls = [
   //...
   "pathToView" => "nameOfView"
];
```

This record defines a view that is served on `localhost/pathToview` by the function `nameOfView`.

### A view rendering a template:

```php
function ourNewView(){

   $context = [
      //this array is for data that will be used in the template
      "fruit" => "apple",
      "color" => "green
   ];
   render("ourNewTemplate.php", $context)
}
```

### A view redirecting:

```php
function ourNewView(){

   //do some business stuff
   header("Location: /"); //redirect home
}
```

## Running Locally with XAMPP

Steps 1-4 only need to be done once as a configuration

1. Place repository into `C:/xampp/htdocs/` (or your installation folder)
2. Download and place [dependencies](#dependencies)
3. Run XAMPP, open `httpd.conf` with Config menu of Apache
4. Change the lines

   ```xml
   DocumentRoot "C:/xampp/htdocs"
   <Directory "C:/xampp/htdocs">
   ```
   to
   ```xml
   DocumentRoot "C:/xampp/htdocs/allegro/src"
   <Directory "C:/xampp/htdocs/allegro/src">
   ```
5. Start Apache in XAMPP and open `localhost` or `127.0.0.1` in your browser

## Dependencies

* [PHPMailer](https://github.com/PHPMailer/PHPMailer) (Place `src/` folder of PHPMailer into `src/external/PHPMailer/`. `PHPMailer.php`, `SMTP.php`, and `Exception.php` are sufficient)
