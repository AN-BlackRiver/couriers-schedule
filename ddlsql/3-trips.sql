CREATE TABLE public.trips (
	id serial4 NOT NULL,
	courier_id int4 NULL,
	region_id int4 NULL,
	departure_date date NOT NULL,
	arrival_date date NOT NULL,
	CONSTRAINT trips_courier_id_departure_date_key UNIQUE (courier_id, departure_date),
	CONSTRAINT trips_pkey PRIMARY KEY (id)
);
