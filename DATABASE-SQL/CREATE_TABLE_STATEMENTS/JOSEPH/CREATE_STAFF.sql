/*
* Create table statement for STAFF.
*/
CREATE TABLE STAFF
(
    /*
    * Incrementing staff primary key.
    */
    id number(10) DEFAULT STAFF_SEQ.nextval NOT NULL
    CONSTRAINT staff_id_pk PRIMARY KEY,

    /*
    * Staff email address, will be used for work related emails, such as shift times or updates.
    * Ensure it matches the correct REGEX pattern for a valid email address.
    * Ensure the value is unique.
    */
    email_address varchar2(255)
    CONSTRAINT staff_email_address_valid_chk
        CHECK (email_address IS NOT NULL AND
            REGEXP_LIKE (email_address,'[A-Z]{1,2}\d{1,2}[A-Z]? \d{1}[ABD-HJLN-UW-Z]{2}')),
    CONSTRAINT passenger_email_address_unique UNIQUE (email_address),

    /*
    * Staff's password - stored in hashed form (so large varchar required).
    */
    password varchar2(999) NOT NULL,

    /*
    * Staff's first name.
    */
    first_name varchar2(255) NOT NULL,

    /*
    * Staff's last name.
    */
    last_name varchar2(255) NOT NULL,

    /*
    * Staff's date of birth.
    */
    date_of_birth DATE NOT NULL,

    /*
    * Staff's gender.
    * Three possible values: male, female, other.
    */
    gender varchar2(255) NOT NULL
);