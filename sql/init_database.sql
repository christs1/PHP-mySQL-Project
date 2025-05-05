-- Create the NFL management system database
CREATE DATABASE IF NOT EXISTS nfl_management;
USE nfl_management;

-- Create roles table
CREATE TABLE IF NOT EXISTS roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create permissions table
CREATE TABLE IF NOT EXISTS permissions (
    permission_id INT PRIMARY KEY AUTO_INCREMENT,
    permission_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create role_permissions table (many-to-many relationship)
CREATE TABLE IF NOT EXISTS role_permissions (
    role_id INT,
    permission_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id) ON DELETE CASCADE
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    role_id INT,
    team_id INT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- Create teams table
CREATE TABLE IF NOT EXISTS teams (
    team_id INT PRIMARY KEY AUTO_INCREMENT,
    team_name VARCHAR(100) NOT NULL UNIQUE,
    city VARCHAR(100) NOT NULL,
    division VARCHAR(50) NOT NULL,
    conference VARCHAR(50) NOT NULL,
    head_coach_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (head_coach_id) REFERENCES users(user_id)
);

-- Create players table
CREATE TABLE IF NOT EXISTS players (
    player_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE,
    team_id INT,
    jersey_number INT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    position VARCHAR(50) NOT NULL,
    height VARCHAR(10),
    weight DECIMAL(5,2),
    date_of_birth DATE,
    status VARCHAR(50) DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (team_id) REFERENCES teams(team_id)
);

-- Create player_statistics table
CREATE TABLE IF NOT EXISTS player_statistics (
    stat_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    game_date DATE NOT NULL,
    opponent_team_id INT,
    games_played INT DEFAULT 0,
    passing_yards INT DEFAULT 0,
    rushing_yards INT DEFAULT 0,
    receiving_yards INT DEFAULT 0,
    touchdowns INT DEFAULT 0,
    interceptions INT DEFAULT 0,
    tackles INT DEFAULT 0,
    sacks DECIMAL(4,1) DEFAULT 0,
    field_goals_made INT DEFAULT 0,
    field_goals_attempted INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (player_id) REFERENCES players(player_id),
    FOREIGN KEY (opponent_team_id) REFERENCES teams(team_id)
);

-- Create team_schedule table
CREATE TABLE IF NOT EXISTS team_schedule (
    game_id INT PRIMARY KEY AUTO_INCREMENT,
    home_team_id INT,
    away_team_id INT,
    game_date DATETIME NOT NULL,
    venue VARCHAR(100),
    game_status VARCHAR(50) DEFAULT 'Scheduled',
    home_score INT,
    away_score INT,
    season_year INT NOT NULL,
    week_number INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (home_team_id) REFERENCES teams(team_id),
    FOREIGN KEY (away_team_id) REFERENCES teams(team_id)
);

-- Insert default roles
INSERT INTO roles (role_name, description) VALUES
('leaguemanager', 'League manager with full access'),
('coach', 'Team coach with team management permissions'),
('player', 'Team player with limited access'),
('statistician', 'Statistical analyst with data management permissions'),
('fan', 'Fan with limited access');

-- Insert default permissions
INSERT INTO permissions (permission_name, description) VALUES
('view_team', 'Can view team information'),
('edit_team', 'Can edit team information'),
('view_player', 'Can view player information'),
('edit_player', 'Can edit player information'),
('view_statistics', 'Can view statistics'),
('edit_statistics', 'Can edit statistics'),
('view_schedule', 'Can view team schedule'),
('edit_schedule', 'Can edit team schedule'),
('manage_users', 'Can manage user accounts'),
('assign_user_role', 'Can assign users to roles'),
('remove_user_role', 'Can remove users from roles'),
('assign_player_to_team', 'Can assign players to teams'),
('remove_player_from_team', 'Can remove players from teams'),
('assign_coach_to_team', 'Can assign coaches to teams'),
('remove_coach_from_team', 'Can remove coaches from teams'),
('assign_statistician_to_team', 'Can assign statisticians to teams'),
('remove_statistician_from_team', 'Can remove statisticians from teams'),
('create_team', 'Can create new teams'),
('delete_team', 'Can delete teams');

-- Assign permissions to roles
-- Admin permissions
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.role_id, p.permission_id
FROM roles r
CROSS JOIN permissions p
WHERE r.role_name = 'leaguemanager';

-- Coach permissions
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.role_id, p.permission_id
FROM roles r
CROSS JOIN permissions p
WHERE r.role_name = 'coach'
AND p.permission_name IN (
    'view_team', 'edit_team',
    'view_player', 'edit_player',
    'view_statistics', 'view_schedule',
    'edit_schedule'
);

-- Player permissions
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.role_id, p.permission_id
FROM roles r
CROSS JOIN permissions p
WHERE r.role_name = 'player'
AND p.permission_name IN (
    'view_team', 'view_player',
    'view_statistics', 'view_schedule'
);

-- Statistician permissions
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.role_id, p.permission_id
FROM roles r
CROSS JOIN permissions p
WHERE r.role_name = 'statistician'
AND p.permission_name IN (
    'view_team', 'view_player',
    'view_statistics', 'edit_statistics',
    'view_schedule'
);

-- Fan permissions
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.role_id, p.permission_id
FROM roles r
CROSS JOIN permissions p
WHERE r.role_name = 'fan';