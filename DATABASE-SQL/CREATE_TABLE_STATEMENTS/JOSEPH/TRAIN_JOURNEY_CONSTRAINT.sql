ALTER TABLE TRAIN_JOURNEY ADD CONSTRAINT train_journey_arrival_location_id_fk FOREIGN KEY (ARRIVAL_LOCATION_ID) REFERENCES LOCATIONS(ID) ON DELETE SET NULL;