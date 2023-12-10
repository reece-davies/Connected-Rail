CREATE TABLE TRAIN_CARRIAGES
(

id number(10) DEFAULT TRAIN_CARRIAGE_SEQ.nextval NOT NULL
CONSTRAINT train_carriage_id_pk PRIMARY KEY,

train_id number(10)
CONSTRAINT train_id_fk FOREIGN KEY (train_id) REFERENCES TRAINS(train_id),

carriage_classification VARCHAR(255) NOT NULL

freight_company_id number(10)
CONSTRAINT freight_company_id_fk FOREIGN KEY (freight_company_id) REFERENCES TRAIN_COMPANIES (freight_company_id),

total_number_of_seats int(255) NOT NULL,

number_of_available_seats int(255) NOT NULL

);