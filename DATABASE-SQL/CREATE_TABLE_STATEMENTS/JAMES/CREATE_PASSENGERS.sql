/*
* Create table statement for table PASSENGERS.
*/
CREATE TABLE PASSENGERS
(
    /*
    * Auto incrementing primary key.
    */
    id number(10) DEFAULT PASSENGERS_SEQ.nextval NOT NULL
    CONSTRAINT passenger_id_pk PRIMARY KEY,

    /*
    * Passenger's email address (used to uniquely identify them (on bookings etc)).
    * Ensure it matches the correct REGEX pattern for a valid email address.
    * Ensure the value is unique.
    */
    email_address varchar2(255)
    CONSTRAINT passenger_email_address_valid_chk
        CHECK (email_address IS NOT NULL AND
            REGEXP_LIKE (email_address,'[A-Z]{1,2}\d{1,2}[A-Z]? \d{1}[ABD-HJLN-UW-Z]{2}')),
    CONSTRAINT passenger_email_address_unique UNIQUE (email_address),

    /*
    * Passenger's password - stored in hashed form (so large varchar required).
    */
    password varchar2(999) NOT NULL,

    /*
    * Passenger's first name.
    */
    first_name varchar2(255) NOT NULL,

    /*
    * Passenger's last name.
    */
    last_name varchar2(255) NOT NULL,

    /*
    * Passenger's date of birth.
    */
    date_of_birth DATE NOT NULL,

    /*
    * Passenger's gender.
    * Three possible values: male, female, other.
    */
    gender varchar2(255) NOT NULL
);
