USE bakeoff;

CREATE TABLE jobs (
	id 		INT 		NOT NULL 	AUTO_INCREMENT 		PRIMARY KEY,
	approved	ENUM		("NO", "YES")	NOT NULL,
	post_date	DATETIME	NOT NULL,

	poster_name	TEXT		NOT NULL,
	poster_company	TEXT		NOT NULL,
	poster_email	TEXT		NOT NULL,
	poster_location	TEXT		NOT NULL,

	type		ENUM 		("FULL_TIME", "PART_TIME", "CONTRACT", "FREELANCE")	NOT NULL,
	title		TEXT		NOT NULL,
	tagline		TEXT		NOT NULL,
	description 	TEXT 		NOT NULL
) TYPE=MyISAM;

CREATE FULLTEXT INDEX idx_fulltext_jobs ON jobs (tagline, description, title);