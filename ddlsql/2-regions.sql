CREATE TABLE public.regions (
	id serial4 NOT NULL,
	"name" varchar(255) NOT NULL,
	travel_days int4 NOT NULL,
	CONSTRAINT regions_pkey PRIMARY KEY (id)
);