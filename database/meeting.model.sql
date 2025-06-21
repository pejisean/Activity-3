CREATE TABLE IF NOT EXISTS public.meeting (
    meeting_id int NOT NULL PRIMARY KEY,
    title varchar(255) NOT NULL,
    description text,
    start_time timestamptz NOT NULL,
    end_time timestamptz NOT NULL,
    location varchar
);