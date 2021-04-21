## Running Locally with XAMPP

Steps 1-3 only need to be done once as a configuration

1. Place repository into `C:\xampp\htdocs` (or your installation folder)
2. Run XAMPP, open `httpd.conf` with Config menu of Apache
3. Change the lines

   ```xml
   DocumentRoot "C:/xampp/htdocs"
   <Directory "C:/xampp/htdocs">
   ```
   to
   ```xml
   DocumentRoot "C:/xampp/htdocs/allegro-mail/src"
   <Directory "C:/xampp/htdocs/allegro-mail/src">
   ```
4. Start Apache in XAMPP and open `localhost` or `127.0.0.1` in your browser

## Dependencies

* [PHPMailer](https://github.com/PHPMailer/PHPMailer) (Place `src/` folder of PHPMailer into `src/external/PHPMailer/`. `PHPMailer.php`, `SMTP.php`, and `Exception.php` are sufficient)
