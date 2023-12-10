/*
* Create table statement for table API_TOKENS.
*/
CREATE TABLE API_TOKENS
(
    /*
    * Auto incrementing primary key.
    */
    id number(10) DEFAULT API_TOKENS_SEQ.nextval NOT NULL
    CONSTRAINT api_token_id_pk PRIMARY KEY,

    /*
    * Holds token value (the token itself).
    * Ensure it has a unique value.
    */
    token_value varchar2(99) NOT NULL,
    CONSTRAINT token_value_unique UNIQUE (token_value)
);
