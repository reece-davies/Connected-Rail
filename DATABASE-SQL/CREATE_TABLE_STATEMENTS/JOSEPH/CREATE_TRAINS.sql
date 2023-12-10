CREATE TABLE TRAINS
(
    /*
    * Incrementing trains primary key.
    */
    id number(10) DEFAULT TRAINS_SEQ.nextval NOT NULL
    CONSTRAINT trains_id_pk PRIMARY KEY,

    /*
    *As company name will always be unique, it can be used for the company id
    */
    train_company_id number(10),
   CONSTRAINT train_company_id_fk FOREIGN KEY(train_company_id) REFERENCES TRAIN_COMPANIES(id), 
    /*
    * Train type, diesel, electric or hybrid
    * This attribute could be used to affect which trains can go on what journeys.
    * For example an electric train must be on an electrified route (inner city)
    */
    train_type varchar2(255) NOT NULL,

    /*
    * Trains can be either cargo or more typically passenger trains.
    * This information is helpful for the admin and staff.
    */
    cargo_type varchar2(255) NOT NULL

);