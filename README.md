<a id="readme-top"></a>

[![Contributors][contributors-shield]][contributors-url] [![Issues][issues-shield]][issues-url] [![PHP][PHP]][php-url]

<br />
<div align="center">
<a href="https://github.com/christs1/PHP-mySQL-Project">
  <img src="./img/svg/football-white.svg" alt="Logo" height="60" style="filter: invert(1);">
</a>
  <h3 align="center">NFL Dashboard</h3>

  <p align="center">
    A Role-Based Access Control (RBAC) NFL Dashboard using PHP and MySQL for football team management.
    <br />
    Features multiple user roles with different permissions and capabilities.
    <br />
    <br />
    <a href="https://github.com/christs1/PHP-mySQL-Project/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

## Features

### Role-Based Access Control

- **League Manager**: Full administrative access
- **Coach**: Team management and player statistics
- **Player**: Personal statistics and team information
- **Statistician**: Statistical analysis and data management
- **Fan**: View-only access to public information

### Key Functionality

- Secure user authentication and session management
- Team and player management
- Game scheduling and statistics tracking
- Profile management with password reset capabilities
- View-as-Fan mode for public access
- Dark/Light theme switching

<!-- GETTING STARTED -->

## Getting Started

### Prerequisites

This project requires [XAMPP](https://www.apachefriends.org/index.html) to run a local Apache server with PHP and MySQL. Ensure you have XAMPP installed on your system before proceeding.

1. Download XAMPP from the [official website](https://www.apachefriends.org/index.html).
2. Install XAMPP and start the Apache and MySQL modules from the XAMPP Control Panel.

### Installation

1. Clone the repository into your `htdocs` directory:

```bash
cd /path/to/htdocs
git clone git@github.com:christs1/PHP-mySQL-Project.git
```

2. Set up the database:

   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named 'nfl_management'
   - Import the database schema from `sql/init_database.sql`

3. Configure the database connection:

   - Copy `config/config.ini.example` to `config/config.ini`
   - Update the database credentials in `config/config.ini`

4. Access the application:
   - Open http://localhost/RBAC/PHP-mySQL-Project in your browser
   - You can log in with different role accounts or use "View as Fan" for public access

````

### Rename the Project Directory

If you'd like to access the project using a different path in your browser, you can rename the project directory as follows:

```bash
mv PHP-mySQL-Project/ nfl/
````

After renaming, you can access the project in your browser at:

```
http://localhost/nfl/
```

## Project Structure

```
PHP-mySQL-Project/
├── config/             # Database and configuration files
├── css/               # Stylesheets and theme files
├── doc/               # Documentation and diagrams
├── img/               # Images, icons, and assets
├── includes/          # Shared PHP functions and session handling
├── js/                # JavaScript files and bundles
├── main/              # Core application pages
│   ├── account.php    # User account management
│   ├── dashboard.php  # Main dashboard view
│   ├── games.php      # Game scheduling and management
│   ├── players.php    # Player management
│   ├── teams.php      # Team management
│   └── users.php      # User management
├── sql/               # Database initialization and schemas
├── templates/         # Reusable UI components
│   └── partials/      # Header, footer, and navigation
├── index.php          # Application entry point
├── page_register.php  # User registration
└── README.md          # Project documentation
```
