use bakeoff;

CREATE TABLE job_keywords (
	job_id	INT	NOT NULL,
	keyword	TEXT	NOT NULL
) TYPE=MyISAM;

CREATE INDEX idx_job_id ON job_keywords (job_id);
