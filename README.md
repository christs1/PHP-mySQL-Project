# PHP-mySQL-Project
PHP & mySQL Project Guidelines

Overview:
You are a PHP and MySQL database application developer tasked with defining, implementing, deploying, and delivering a 3-tier software solution1 that keeps track of information related to running a sports team.

Requirements:
1.1 Development Environment & Tools
Local Development Stack: You will need a local LAMP/WAMP/MAMP stack or similar environment (e.g., XAMPP) to develop and test before deployment:


Web Server: Apache or Nginx.


PHP Runtime: PHP 7.4+ (or PHP 8+ recommended) for full compatibility with modern libraries.


MySQL (or MariaDB) for the relational database.


Version Control: Git repository (e.g., GitHub, Bitbucket, or GitLab) to collaborate, manage changes, and maintain the DDL scripts.


Email Service or SMTP: For password reset emails:


Either a local SMTP server or a service like Gmail SMTP (plus secure credentials management).


A PHP email-sending library (e.g., PHPMailer, SwiftMailer, or built-in mail() function, though PHPMailer is more secure/reliable).


IDE / Code Editor: (VSCode, PhpStorm, etc.) for coding, debugging, and integrated Git usage.


1.2 Frameworks & Libraries (Optional but Recommended)
PHP Framework:


Laravel, Symfony, or a lighter-weight micro-framework like Slim or CodeIgniter.


Front-End Libraries (Optional but helpful for UI):


Bootstrap for quick layout and responsiveness.


jQuery or modern JS frameworks (if you want dynamic features).


1.3 Security & Best Practices
Password Hashing: The PDF states passwords should be encrypted. You will need to use password_hash() and password_verify() or a library offering secure hashing (e.g., bcrypt, Argon2).


Input Sanitization & Validation:


Ensure server-side validation (not just JavaScript).


Use parameterized queries (e.g., PDO or MySQLi prepared statements) to avoid SQL injections.


Session Management: The PDF mentions session variables for login. Be sure to:


Configure session_start() properly.


Use secure session cookies (SSL/TLS if possible).


Regenerate session IDs on login to prevent session fixation attacks.


Cross-Site Scripting (XSS) Protection:


Escape all user-submitted data when rendering in HTML.


Use frameworks or libraries that handle output escaping.


1.4 Application Architecture Details
Three-Tier Structure:


Presentation/Client Layer: HTML/CSS/JS in the browser.


Application Layer: The PHP server-side code, routes, controllers, etc.


Data/Database Layer: MySQL with well-defined schema and stored procedures/triggers (if needed).


MVC or Similar Pattern (Recommended):


Although not required by the PDF, adopting an MVC pattern helps keep code organized.


Database Connection Handling:


Use a singleton or centralized database connection approach (especially if using raw PHP without a framework).


Ensure secure credentials (not hard-coded in publicly accessible files).


Email / Password Reset Flow:


Possibly store a password_reset token, with an expiration date/time, then email a secure link.


Alternatively, automatically generate a new password and email it.








Required Views: 
Use Case View
Entity Relationship View (ERD)
Requirements View
Deployment View
Security View
Implementation View
Testing View
Configuration Management View


1. Use Case View


Identify the questions your operators will ask of the application. Draw the sequence starting with the forms used and the messages exchanged between the client, application, and database layers. To get you started, consider:


• What teams are in the league?
• What teams did CSUF play last this season?
• What games did Player X play in?
• Who played in Game X?
• Who coached last week’s game?
• Who has an account and what is their role?
• Who has logged in in the past 48 hours?


You can also show (describe) activities for each role, for example
• “observers” can
o Read non-sensitive data you define what this non-sensitive data is
o change their own password
• “users” can
o Create, Read, Update, and Delete non-sensitive data Same non-sensitive data as you defined above
o change their own password
• “executive managers” can
o Create Read Update Delete sensitive and non-sensitive data reset anyone’s password, assign an existing user to a different role but cannot create or alter the database schema.
• “DB administrators” can
o do everything/anything


2. Entity Relationship View (ERD)
Ex:


3. Requirements View
Use Cases are a form of functional requirements and can complement this view. But some requirements are not easily expressed in a use case. To get you started, consider:


• “shall” statements
• constraints
• roles and access
• webpage content and navigation
• legal values, ranges, etc.
• negative paths and feedback




4. Deployment View
• software and versions, hardware, network
• Client
• Web server
• PHP engine
• Database server


5. Security View
• CIA


6. Implementation View
• source code
• programming languages


7. Testing View
• Test cases (should match use case),
• Results and action taken
• Testing environment(s)


8. Configuration Management View
• How did you control the code, including the DDL, amongst your team?
• How well did it work?


Database
You are to define and design a database schema to support your application. Your entities and relationships should support the questions your users will ask, which should be captured in your use case and requirement views.

Ex:


User Authentication

• Users should be able to register their usernames and passwords. 
O You need some restrictions on the length and format of each username and password.
o You should store passwords in an encrypted format for security reasons.
• Users should be able to log in with the details they supplied in the registration process.
• Users should be able to log out after they have finished using a site.
o This capability is not particularly important if people use the site from their home PC but is very important for security if they use the site from a shared PC such as at a library.
• The site needs to be able to check whether a particular user is logged in and then access data for the logged-in user.
• Users should be able to change their passwords as an aid to security.
• Users should be able to reset their passwords without needing personal assistance from you. A common way of doing this is to send a user’s password to him or her at an email address he or she has provided at registration. This means you need to store the user’s email address at registration. Because you store the passwords in an encrypted form and cannot decrypt the user’s original password, you actually need to generate a new password, set it, and mail the new password to the user.


