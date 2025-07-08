CREATE TABLE IF NOT EXISTS public.project_users (
    project_id INTEGER NOT NULL REFERENCES public.projects (id) ON DELETE CASCADE,
    user_id INTEGER NOT NULL REFERENCES public.users (id) ON DELETE CASCADE,
    role VARCHAR(50) NOT NULL,
    PRIMARY KEY (project_id, user_id)
);