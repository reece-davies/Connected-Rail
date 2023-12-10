CREATE TABLE BOOKINGS
(
id number(10) DEFAULT BOOKINGS_SEQ.nextval NOT NULL, /*PK */
CONSTRAINT bookings_id_PK PRIMARY KEY (id),
passenger_id number(10)/* FK*/
CONSTRAINT bookings_passenger_id_fk REFERENCES Passengers(id) ON DELETE SET NULL,
journey_id number(10)/* FK*/
CONSTRAINT bookings_journey_id_fk REFERENCES train_journey(id)ON DELETE SET NULL,
booking_type varchar(255),
seat_number varchar(255) NOT NULL,
seat_preference varchar(255) NOT NULL,
departure_date_time date NOT NULL,
departure_platform int NOT NULL,
arrival_date_time date NOT NULL,
arrival_platform int NOT NULL 


);
