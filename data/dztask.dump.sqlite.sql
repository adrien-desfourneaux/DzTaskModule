INSERT INTO task_state (
    state_id,
    label,
    icon_url
) VALUES (
    1,
    'not-started',
    '/img/dztask/not-started.png'
);

INSERT INTO task_state (
    state_id,
    label,
    icon_url
) VALUES (
    2,
    'in-progress',
    '/img/dztask/in-progress.png'
);

INSERT INTO task_state (
    state_id,
    label,
    icon_url
) VALUES (
    3,
    'done',
    '/img/dztask/done.png'
);

INSERT INTO task_state (
    state_id,
    label,
    icon_url
) VALUES (
    4,
    'late',
    '/img/dztask/late.png'
);

/* --------------------  */

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    1,
    'Tâche non débutée',
    strftime('%s', 'now', 'start of day', '-1 hour', '+6 months'),
    strftime('%s', 'now', 'start of day', '-1 hour', '+1 year'),
    1
);

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    2,
    "Tâche qui débute aujourd'hui",
    strftime('%s', 'now', 'start of day', '-1 hour'),
    strftime('%s', 'now', 'start of day', '-1 hour', '+2 years'),
    1
);

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    3,
    "Tâche en cours 1",
    strftime('%s', 'now', 'start of day', '-1 hour', '-1 day'),
    strftime('%s', 'now', 'start of day', '-1 hour', '+3 years'),
    2
);

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    4,
    "Tâche en cours 2",
    strftime('%s', 'now', 'start of day', '-1 hour', '-1 day'),
    strftime('%s', 'now', 'start of day', '-1 hour', '+3 years'),
    2
);

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    5,
    "Tâche qui se termine aujourd'hui",
    strftime('%s', 'now', 'start of day', '-1 hour', '-1 day'),
    strftime('%s', 'now', 'start of day', '-1 hour'),
    2
);

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    6,
    'Tâche faite',
    strftime('%s', 'now', 'start of day', '-1 hour', '-2 days'),
    strftime('%s', 'now', 'start of day', '-1 hour', '-1 day'),
    3
);

INSERT INTO task (
    task_id,
    description,
    begin_date,
    end_date,
    state_id
) VALUES (
    7,
    'Tâche en retard',
    strftime('%s', 'now', 'start of day', '-1 hour', '-2 days'),
    strftime('%s', 'now', 'start of day', '-1 hour', '-1 day'),
    4
);
