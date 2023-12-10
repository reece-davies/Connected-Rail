/*
* Sequence used to auto increments value of id field within table TRAINS
*/
CREATE SEQUENCE TRAINS_SEQ START WITH 1
INCREMENT BY 1
MAXVALUE 10000
CYCLE
NOCACHE;
