<h1>COMP1006 Final Exam</h1>
<p></p>Run this SQL script to create and populate new database tables in your AWS database.  Note: each table is prefixed with the word “exam” so there should be no conflicts with any existing tables you may already have. Please only use examgames, examcategories, and examusers tables for this exam not the original tables we built in class. Use MySQLWorkbench to access your MySQL database on the AWS server.</p>

DROP TABLE IF EXISTS exampublishers;

DROP TABLE IF EXISTS examgames;

DROP TABLE IF EXISTS examusers;

CREATE TABLE exampublishers
(publisherId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
photo VARCHAR(100));

CREATE TABLE examgames (
gameId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(50) NOT NULL,
releaseYear INT NOT NULL,
rating VARCHAR(10),
photo VARCHAR(100),
publisherId INT NOT NULL);

ALTER TABLE examgames AUTO_INCREMENT 10000; 

CREATE TABLE examusers
(userId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL,
password VARCHAR(128) NOT NULL,
photo VARCHAR(100));

INSERT INTO exampublishers (name) VALUES ('Blizzard');

INSERT INTO exampublishers (name) VALUES ('Nintendo');

INSERT INTO exampublishers (name) VALUES ('EA');

INSERT INTO exampublishers (name) VALUES ('Bethesda');

INSERT INTO exampublishers (name) VALUES ('FromSoft');

INSERT INTO exampublishers (name) VALUES ('Activision');

INSERT INTO exampublishers (name) VALUES ('Naughty Dog');

INSERT INTO examgames (title, releaseYear, rating, photo, publisherId) 
VALUES ('NHL 2K11', 2011, 'E', 'ptr2bnkodujtj5ht4uanobp5pm-nhl-2k11.jpg', 3);

INSERT INTO examgames (title, releaseYear, rating, photo, publisherId) 
VALUES ('Dark Souls', 2011, 'M', 'ptr2bnkodujtj5ht4uanobp5pm-dark-souls.jpg', 5);

INSERT INTO examgames (title, releaseYear, rating, photo, publisherId) 
VALUES ('Madden 21', 2020, 'E', 'ptr2bnkodujtj5ht4uanobp5pm-madden-21.jpg', 3);

INSERT INTO examgames (title, releaseYear, rating, photo, publisherId) 
VALUES ('Last of Us', 2013, 'M', 'ptr2bnkodujtj5ht4uanobp5pm-last-of-us.jpg', 7);

INSERT INTO examgames (title, releaseYear, rating, photo, publisherId) 
VALUES ('Tennis', 1986, 'E', 'ptr2bnkodujtj5ht4uanobp5pm-activision-tennis.jpg', 6);

INSERT INTO examgames (title, releaseYear, rating, photo, publisherId) 
VALUES ('World of Warcraft', 2004, 'T', 'ptr2bnkodujtj5ht4uanobp5pm-wow.jpg', 1);
