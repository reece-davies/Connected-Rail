CREATE OR REPLACE TRIGGER staff_date_of_birth_trigger 
BEFORE INSERT OR UPDATE of date_of_birth ON staff FOR EACH ROW
DECLARE   s_staff_age   INT; 
BEGIN     s_staff_age := TRUNC(MONTHS_BETWEEN(SYSDATE, :NEW.date_of_birth))/12;
IF s_staff_age < 18 THEN
raise_application_error(-20101,
'ERROR: Staff must be 18 or older');
END IF; END; 