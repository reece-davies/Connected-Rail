/*
* Sequence used to auto increments value of id field within table PASSENGERS.
*/
CREATE SEQUENCE PASSENGERS_SEQ START WITH 1
INCREMENT BY 1
MAXVALUE 10000
CYCLE
NOCACHE;
