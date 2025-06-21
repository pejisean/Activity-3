CREATE TABLE IF NOT EXISTS public.tasks (
    task_id int NOT NULL PRIMARY KEY,
    title varchar(255) NOT NULL,
    description text,
    due_date timestamptz,
    status varchar(50) DEFAULT 'Pending',
    assigned_user_id int
);
