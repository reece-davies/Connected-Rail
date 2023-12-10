/*
* Create table statement for table ADMINISTRATORS.
*/
CREATE TABLE ADMINISTRATORS
(
    /*
    * Auto incrementing primary key.
    */
    id number(10) DEFAULT ADMINISTRATORS_SEQ.nextval NOT NULL
    CONSTRAINT administrator_id_pk PRIMARY KEY,

    /*
    * Administrator's email address.
    * Ensure it matches the correct REGEX pattern for a valid email address.
    * Ensure the value is unique.
    */
    email_address varchar2(255)
    CONSTRAINT administrator_email_address_valid_chk
        CHECK (email_address IS NOT NULL AND
            REGEXP_LIKE (email_address,'[A-Z]{1,2}\d{1,2}[A-Z]? \d{1}[ABD-HJLN-UW-Z]{2}')),
    CONSTRAINT administrator_email_address_unique UNIQUE (email_address),

    /*
    * Administrator's password - stored in hashed form (so large varchar required).
    */
    password varchar2(999) NOT NULL,

    /*
    * Administrator's first name.
    */
    first_name varchar2(255) NOT NULL,

    /*
    * Administrator's last name.
    */
    last_name varchar2(255) NOT NULL,

    /*
    * Administrator's date of birth.
    */
    date_of_birth DATE NOT NULL,

    /*
    * Administrator's gender.
    * Three possible values: male, female, other.
    */
    gender varchar2(255) NOT NULL
);
