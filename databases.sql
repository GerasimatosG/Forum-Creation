
CREATE DATABASE forum;

-- create table users

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    PRIMARY KEY (id)    
);

INSERT INTO users (id,username, email, password, role) VALUES
(3, 'user', 'user@email.gr', '121212', 'user'),
(70, 'admin', 'admin@admin.com', '1234', 'admin');

-- Create table threads

CREATE TABLE threads (
    thread_id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    creator_username VARCHAR(255) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (thread_id)    
);

-- Create table posts

CREATE TABLE posts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    thread_id INT(11) NOT NULL,
    content TEXT NOT NULL,
    author_username VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (thread_id) REFERENCES threads(thread_id)
    
);
