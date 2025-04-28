
<a id="readme-top"></a>

[![Contributors][contributors-shield]][contributors-url] [![Issues][issues-shield]][issues-url] [![PHP][PHP]][php-url]

<br />
<div align="center">
<a href="https://github.com/christs1/PHP-mySQL-Project">
  <img src="./img/svg/football-white.svg" alt="Logo" height="60" style="filter: invert(1);">
</a>

  <h3 align="center">NFL Dashboard</h3>

  <p align="center">
    An interactive NFL dashboard using PHP and MySQL for team management.
    <br />
    <br />
    <a href="https://github.com/christs1/PHP-mySQL-Project/issues/new?labels=bug&template=bug-report---.md">Report Bug</a>
    ·
    <a href="https://github.com/christs1/PHP-mySQL-Project/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

This project requires [XAMPP](https://www.apachefriends.org/index.html) to run a local Apache server with PHP and MySQL. Ensure you have XAMPP installed on your system before proceeding.

1. Download XAMPP from the [official website](https://www.apachefriends.org/index.html).
2. Install XAMPP and start the Apache and MySQL modules from the XAMPP Control Panel.


### Clone the repository

Clone the repository into your `htdocs` directory.

```bash
cd /path/to/htdocs
git clone git@github.com:christs1/PHP-mySQL-Project.git
```

### Rename the Project Directory

If you'd like to access the project using a different path in your browser, you can rename the project directory as follows:

```bash
mv PHP-mySQL-Project/ nfl/
```

After renaming, you can access the project in your browser at:

```
http://localhost/nfl/
```

## Foler Structure
The project folder structure is organized as follows:

```
PHP-mySQL-Project/
├── coach/              # PHP pages for coach accounts
├── config/             # Store configuration files
├── css/                # Stylesheets for the project
├── fan/                # PHP pages for fan accounts
├── img/                # Images and icons used in the project
│   ├── svg/            # SVG icons
├── includes/           # For shared code/helper functions
├── js/                 # JavaScript files
├── php/                # PHP scripts for backend logic
├── player/             # PHP pages for player accounts
├── smartadmin/         # Smartadmin files
├── sql/                # SQL scripts for database setup
├── statistician/       # PHP pages for statistician accounts
├── templates/          # HTML templates for reusable components
├── index.php           # Main entry point of the application
└── README.md           # Project documentation
```

## Top Contributors

<a href="https://github.com/christs1/PHP-mySQL-Project/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=christs1/PHP-mySQL-Project" alt="contrib.rocks image" />
</a>

<!-- MARKDOWN LINKS & IMAGES -->
[contributors-shield]: https://img.shields.io/github/contributors/christs1/PHP-mySQL-Project.svg?style=for-the-badge
[contributors-url]: https://github.com/christs1/PHP-mySQL-Project/graphs/contributors
[issues-shield]: https://img.shields.io/github/issues/christs1/PHP-mySQL-Project.svg?style=for-the-badge
[issues-url]: https://github.com/christs1/PHP-mySQL-Project/issues

[PHP]: https://img.shields.io/badge/php-000000?style=for-the-badge&logo=php
[php-url]: https://www.php.net/