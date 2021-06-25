# Allegro - Student Messaging System

[Allegro](https://allegroapp.me) is an asynchronous messaging web application aimed at students.

## Features

- Authentication
  - Login with email address or username 
  - Email verification and password recovery with single use tokens
- Customization and settings
  - Changeable user information
  - Notification preferences
  - Privacy preferences
    - Disable online status
    - Hide email address
- Drafting messages
- Message replies
- Message deletion
  - Removal from inbox 
  - Permanent deletion by message author
- Text formatting with Markdown
- Notification emails
- Silent messages that do not create notifications
- Classmates page
  - Online status of users
  - User details 
- Support tickets

## Deployment

Allegro requires PHP (version 8.0 or above) and MySQL. It is designed to work on Apache 2, but can easily be adapted for other HTTP servers. The folder `src/public/` must be served. Code to create required database structure is included in `data/database.sql`. `src/config/credentials.php` must be created with credentials for the database and an external mail server.

## Dependencies

- [Parsedown](https://github.com/erusev/parsedown)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)

## Credits

Allegro was developed by Berfin Sünnetcioğlu, Fatma Kara, and Oğuzhan Göregen as part of CEIT133 course.

Allegro uses [League Spartan](https://www.theleagueofmoveabletype.com/league-spartan) and [Manrope](https://manropefont.com/) fonts, background images from [BGJar](https://bgjar.com/), icons from [Font Awesome](https://fontawesome.com), and mockup images from [Smartmockups](https://smartmockups.com).
