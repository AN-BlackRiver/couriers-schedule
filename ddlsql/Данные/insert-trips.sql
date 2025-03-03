DO $$
DECLARE
    courier RECORD;
    region RECORD;
    start_date DATE;
    end_date DATE;
    departure_date DATE;
    arrival_date DATE;
    travel_days INT;
    random_courier_id INT;
BEGIN
    
    start_date := CURRENT_DATE - INTERVAL '3 months';
    end_date := CURRENT_DATE;

   
    FOR region IN SELECT * FROM Regions LOOP
       
        departure_date := start_date + (random() * (end_date - start_date))::INT;

        
        travel_days := region.travel_days;

        
        arrival_date := departure_date + travel_days;

       
        SELECT Id INTO random_courier_id
        FROM Couriers
        ORDER BY random()
        LIMIT 1;

        
        INSERT INTO Trips (courier_id, region_id, departure_date, arrival_date)
        VALUES (random_courier_id, region.ID, departure_date, arrival_date);
    END LOOP;
END $$;