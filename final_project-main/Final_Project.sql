--
-- Database: ``
--

-- --------------------------------------------------------



USE `Final_Project`;-- put your databse name inside the single quote.
-- if you want to upload this sql to remote njit databse server, you need put your UCID inside the single quotes.

DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `tasks`;


-- create the tables

CREATE TABLE users (
  userID            INT            NOT NULL   AUTO_INCREMENT,
  userName          VARCHAR(60)    DEFAULT NULL,
  email             VARCHAR(320)   DEFAULT NULL,
  userPassword      VARCHAR(128)   DEFAULT NULL, 
  firstName         VARCHAR(600)   DEFAULT NULL,
  lastName          VARCHAR(600)   DEFAULT NULL,
  oldPassword       VARCHAR(128)   DEFAULT NULL,
  oldestPassword    VARCHAR(128)   DEFAULT NULL,
  PRIMARY KEY (userID)
);

CREATE TABLE tasks (
  taskID            INT            NOT NULL   AUTO_INCREMENT,
  userID            INT            NOT NULL,
  taskName          TEXT           NOT NULL,
  taskDescription   TEXT           DEFAULT NULL,
  dueDate           DATETIME       DEFAULT NULL,
  urgency           INT            DEFAULT NULL,
  taskStatus        BOOLEAN        NOT NULL,
  PRIMARY KEY (taskID),
  FOREIGN KEY (userID) REFERENCES users(userID)
);



-- insert data into the database
INSERT INTO users (userID, userName, email, userPassword, firstName, lastName) VALUES
(1, 'oliviarodrigo', 'orodrigo@notreal.com', 'password', 'Olivia', 'Rodrigo'),
(2, 'conangray', 'cgray@notreal.com', 'password', 'Conan', 'Gray'),
(3, 'taylorswift', 'tswift@notreal.com', 'password', 'Taylor', 'Swift');


INSERT INTO tasks (taskID, userID, taskName, taskDescription, dueDate, urgency, taskStatus) VALUES
(1, 1, 'Drive through the suburbs', 'Crying cause you are not around', '2022-02-20', 2, 1),
(2, 2, 'Be Heather', 'You like her better', '2021-06-01', 1, 0),
(3, 3, 'Release Fearless (My Version)', 'Stick it to Big Machine Records', '2021-04-09', 1, 1);

