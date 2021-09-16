# MinimalistCMS
Blog-styled CMS with standard core features.

## About MinimalistCMS
MinimalistCMS is a prototype to Content Management System, built by myself. The project is intended for educational purposes, in learning of PHP, little bit of jQuery and MySQL.

## Specification
MinimalistCMS can be running with PHP at least 5.x and later, and MySQL. Using XAMPP is recommended.

## SQL/Database Structure?
[Click Here](db.sql)

## Known Bugs
MinimalistCMS currently in alpha stage, means any bugs is likely to be found, both UX and UI. Here's known bugs by contributor:
- CKEditor's plugin `codesnippet` will render HTML code to "actual HTML" upon editing post.
- CKEditor's plugin `codesnippet` did not display as intended at front-end view.
- Possible security holes in back-end.
- All articles are required to submit password upon entering, even it's not protected. The field can be left blank and submitted (authentication through cookie)
- All post are required to use Page Break button at CKEditor because it act as separator between summary and article's thorough content (may implement automated page break later)
