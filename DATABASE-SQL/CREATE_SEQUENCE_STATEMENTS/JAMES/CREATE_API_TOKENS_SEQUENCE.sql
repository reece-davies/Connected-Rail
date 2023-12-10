/*
* Sequence used to auto increments value of id field within table API_TOKENS.
*/
CREATE SEQUENCE API_TOKENS_SEQ START WITH 1
INCREMENT BY 1
MAXVALUE 10000
CYCLE
NOCACHE;
