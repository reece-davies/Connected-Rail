CREATE OR REPLACE TRIGGER admin_date_of_birth_trigger 
BEFORE INSERT OR UPDATE of date_of_birth ON administrators FOR EACH ROW
DECLARE   a_admin_age   INT; 
BEGIN     a_admin_age := TRUNC(MONTHS_BETWEEN(SYSDATE, :NEW.date_of_birth))/12;
IF a_admin_age < 18 THEN
raise_application_error(-20101,
'ERROR: Admin must be 18 or older');
END IF; END; 