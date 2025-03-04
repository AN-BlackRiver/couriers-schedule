CREATE TABLE public.trips (
    ID SERIAL PRIMARY KEY,
    courier_id INT REFERENCES Couriers(Id),
    region_id INT REFERENCES Regions(ID),
    departure_date DATE NOT NULL,
    arrival_date DATE
);
