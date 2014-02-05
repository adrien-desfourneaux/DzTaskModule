CREATE TABLE task
(
    task_id     INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    description VARCHAR(200) NOT NULL UNIQUE,
    begin_date  INTEGER NOT NULL,
    end_date    INTEGER NOT NULL,
    state_id    INTEGER NOT NULL,
    FOREIGN KEY (state_id) REFERENCES task_state (state_id)
);

CREATE TABLE task_state
(
	state_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	label    VARCHAR(20) NOT NULL UNIQUE,
	icon_url VARCHAR(200)
);

INSERT INTO task_state (state_id, label, icon_url) VALUES (1, 'Pas commencé', '/img/DzTask/not-started.png');
INSERT INTO task_state (state_id, label, icon_url) VALUES (2, 'En cours', '/img/DzTask/in-progress.png');
INSERT INTO task_state (state_id, label, icon_url) VALUES (3, 'Fait', '/img/DzTask/done.png');
INSERT INTO task_state (state_id, label, icon_url) VALUES (4, 'En retard', '/img/DzTask/late.png');