Allegro is an asynchronous messaging web application. This document aims to explain its inner workings to contributors.

## Creating Views

A view represents a page that is rendered or an action like logging out. It processes data and passes them to templates or redirects to another view. Templates contain html and may render php variables passed to them.

Views are functions in `views.php`. They also need to be added to the urls array in `urls.php`:

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
   //or if you're not passing variables:
   render("ourNewTemplate.php");
}
```

### A view redirecting:

```php
function ourNewView(){

   //do some business stuff
   header("Location: /"); //redirect home
}
```

## Models

Model classes represent database tables, and their instances database records. After they are created, the corresponding database table needs to be created manually.

### Model structure:

```php
class User extends Model{

    public $id;        //
    public $email;     //
    public $password;  //
    public $firstName; //
    public $lastName;  // database fields as class properties as they appear in the database

    function fullName(){ //utility methods can be created

        return $this->$firstName." ".$this->$lastName;
    }

    static function who(){ //this method is needed by the parent class

        return __CLASS__;
    }
}
```

### Creating a record:

```php
$newUser = new User();
$newUser->email = "newuser@example.com";
$newUser->firstName = "new";
$newUser->lastName = "user";
$newUser->save(); //it's now in the database!
```

### Reading and updating a record:

```php
$user = User::get("email = newuser@example.com");
//do whatever you'd like, such as changing a field:
$user->email = "newmail@example.com";
$user->save();
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

* [PHPMailer](https://github.com/PHPMailer/PHPMailer) (Place `src/` folder of PHPMailer into `src/base/external/PHPMailer/`. `PHPMailer.php`, `SMTP.php`, and `Exception.php` are sufficient)
