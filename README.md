# PHP Simple Framework (PSF)
A very simple PHP MVC framework designed to kick start your projects, without learning anything. 

Some basic features include:

- MVC, models and views are optional of course
- Some simple libraries included for DB access, media uploads, logging, data tables and routes
- Full composer support
- Routes are as simple as www.example.com/controller/method/
- That's it, everything else is up to you.

- [Full Documentation](https://brendanwex.github.io/psf/)
- DB Library is from [MysqliDb](https://github.com/ThingEngineer/PHP-MySQLi-Database-Class)


# Quick Start

1. Download the latest release of PSF, and extract the archive or install using composer `composer create-project "webtronic/psf:dev-master" my-project-name`
2. All files should be behind the public facing section of your site except the contents of the public folder. This can be renamed to anything you like such as "httpdocs", "wwwroot", "public_html"
3. Edit the .htaccess file in the public folder to correspond to your routes / server
4. Open Config.php and edit your settings
5. You should be good to go now.
6. See [Full Documentation](https://brendanwex.github.io/psf/) for all configuration and options
