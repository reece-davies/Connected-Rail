CREATE TABLE TRAIN_JOURNEY_STAFF
(
    /*
    * Incrementing train staff primary key.
    */
    id number(10) DEFAULT TRAIN_JOURNEY_STAFF_SEQ.nextval NOT NULL
    CONSTRAINT id_pk PRIMARY KEY,

   
    staff_id number(10),
   CONSTRAINT staff_id_fk FOREIGN KEY(id) REFERENCES STAFF(id)
   ON DELETE SET NULL, 
   
   journey_id
   number(10),
   CONSTRAINT journey_id_fk FOREIGN KEY(id) REFERENCES TRAIN_JOURNEY(id)
   ON DELETE SET NULL
 
 
);
