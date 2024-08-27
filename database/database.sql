DROP TABLE tasks;
DROP TABLE users;
DROP TABLE user_session;

CREATE TABLE tasks(
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    optional TEXT,
    image TEXT,
    user_id INT NOT NULL
);


CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE user_session (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    status BOOLEAN NOT NULL,
    date DATE NOT NULL
);

INSERT INTO tasks (title, description, optional, image, user_id)
VALUES
    ('Tarea 1', 'Descripción de la tarea 1', 'a', '', 1),
    ('Tarea 2', 'Descripción de la tarea 2', 'a', '', 1),
    ('Tarea 3', 'Descripción de la tarea 3', 'a', '', 1),
    ('Tarea 4', 'Descripción de la tarea 4', 'a', '', 1),
    ('Tarea 5', 'Descripción de la tarea 5', 'a', '', 1),
    ('Tarea 6', 'Descripción de la tarea 6', 'a', '', 1),
    ('Tarea 7', 'Descripción de la tarea 7', 'a', '', 1),
    ('Tarea 8', 'Descripción de la tarea 8', 'a', '', 1),
    ('Tarea 9', 'Descripción de la tarea 9', 'a', '', 1),
    ('Tarea 10', 'Descripción de la tarea 10', 'b', '', 1),
    ('Tarea 11', 'Descripción de la tarea 11', 'b', '', 1),
    ('Tarea 12', 'Descripción de la tarea 12', 'b', '', 1),
    ('Tarea 13', 'Descripción de la tarea 13', 'b', '', 1),
    ('Tarea 14', 'Descripción de la tarea 14', 'b', '', 1),
    ('Tarea 15', 'Descripción de la tarea 15', 'b', '', 1);

INSERT INTO users (username, password)
VALUES
    ('username1', 'password1'),
    ('username2', 'password2'),
    ('username3', 'password3'),
    ('username4', 'password4'),
    ('username5', 'password5');