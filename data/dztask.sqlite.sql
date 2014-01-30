CREATE TABLE task
(
    task_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    description VARCHAR(200) NOT NULL UNIQUE,
    begin_date INTEGER NOT NULL,
    end_date INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
    FOREIGN KEY (state_id) REFERENCES task_state (state_id)
);

CREATE TABLE task_state
(
	state_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	label    VARCHAR(20) NOT NULL UNIQUE
);

INSERT INTO task_state (state_id, label) VALUES (1, 'Pas commencé');
INSERT INTO task_state (state_id, label) VALUES (2, 'En cours');
INSERT INTO task_state (state_id, label) VALUES (3, 'Fait');
INSERT INTO task_state (state_id, label) VALUES (4, 'En retard');