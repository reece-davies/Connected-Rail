/*
* Create table statement for table LOCATIONS.
*/
CREATE TABLE LOCATIONS
(
    /*
    * Auto incrementing primary key.
    */
    id number(10) DEFAULT LOCATIONS_SEQ.nextval NOT NULL
    CONSTRAINT location_id_pk PRIMARY KEY,

    /*
    * The name of the city.
    */
    city_name varchar2(255) NOT NULL,

    /*
    * The name of the city's train station.
    */
    train_station_name varchar2(255) NOT NULL,

    /*
    * The latidude of the train station.
    */
    latitude varchar2(255) NOT NULL,

    /*
    * The longitude of the train station.
    */
    longitude varchar2(255) NOT NULL,

    /*
    * Ensure latitude / longitude values are unique, thus stopping duplicate location entries.
    */
    CONSTRAINT location_unique UNIQUE (latitude, longitude)
);
