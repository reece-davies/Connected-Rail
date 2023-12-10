CREATE OR REPLACE TRIGGER passengers_date_of_birth_trigger 
BEFORE INSERT OR UPDATE of date_of_birth ON passengers FOR EACH ROW
DECLARE   p_passengers_age   INT; 
BEGIN     p_passengers_age := TRUNC(MONTHS_BETWEEN(SYSDATE, :NEW.date_of_birth))/12;
IF p_passengers_age <16 THEN
raise_application_error(-20101,
'ERROR: Passengers must be 16 or older');
END IF; END;