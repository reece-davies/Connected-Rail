CREATE TABLE TRAIN_JOURNEY
(
id number(10) DEFAULT JOURNEY_SEQ.nextval NOT NULL /*PK */
CONSTRAINT train_journey_id_pk PRIMARY KEY,
journey_cost int NOT NULL,
arrival_location_id number(10) /*FK */
CONSTRAINT train_journey_arrival_location_id_fk  REFERENCES LOCATIONS(id) ON DELETE SET NULL,
departure_location_id number(10)  /*FK */
CONSTRAINT train_journey_departure_location_id_fk REFERENCES LOCATIONS(id) ON DELETE SET NULL
);