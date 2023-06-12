-- Maze generator lowest move display

DROP DATABASE IF EXISTS maze;

CREATE DATABASE maze;

USE maze;

CREATE TABLE
    maze_user (
        id int(11) NOT NULL AUTO_INCREMENT,
        username varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO
    maze_user (username, password)
VALUES ('rijan', '0c570ba682df2e2e778d25a1ec9d384a'), ('rakesh', '67a05e3822ce48a6386746388e6c81f5');

CREATE TABLE
    score (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id int(11) NOT NULL,
        moves int(11) NOT NULL,
        time int NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) REFERENCES maze_user (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- View to show the leaderboard

CREATE VIEW
    leaderboard AS
        SELECT
            maze_user.username,
            score.moves,
            score.time
        FROM
            maze_user
        INNER JOIN score ON score.user_id = maze_user.id
        ORDER BY
            score.moves ASC,
            score.time ASC;

