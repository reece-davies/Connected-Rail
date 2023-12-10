/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package staffapplication;

/**
 *
 * @author jpkilbane
 */
public class user {

    protected String ID;
    protected String EMAIL_ADDRESS;
    protected String PASSWORD;
    protected String FIRST_NAME;
    protected String LAST_NAME;
    protected String DATE_OF_BIRTH;
    protected String GENDER;
    protected String STAFF_ROLE;
    protected String PHOTO;
    protected String TRAIN_JOURNEY_STAFF = "[]";

    public user() {
    }

    public String getID() {
        return ID;
    }

    public void setID(String ID) {
        this.ID = ID;
    }

    public String getEMAIL_ADDRESS() {
        return EMAIL_ADDRESS;
    }

    public void setEMAIL_ADDRESS(String EMAIL_ADDRESS) {
        this.EMAIL_ADDRESS = EMAIL_ADDRESS;
    }

    public String getPASSWORD() {
        return PASSWORD;
    }

    public void setPASSWORD(String PASSWORD) {
        this.PASSWORD = PASSWORD;
    }

    public String getFIRST_NAME() {
        return FIRST_NAME;
    }

    public void setFIRST_NAME(String FIRST_NAME) {
        this.FIRST_NAME = FIRST_NAME;
    }

    public String getLAST_NAME() {
        return LAST_NAME;
    }

    public void setLAST_NAME(String LAST_NAME) {
        this.LAST_NAME = LAST_NAME;
    }

    public String getDATE_OF_BIRTH() {
        return DATE_OF_BIRTH;
    }

    public void setDATE_OF_BIRTH(String DATE_OF_BIRTH) {
        this.DATE_OF_BIRTH = DATE_OF_BIRTH;
    }

    public String getGENDER() {
        return GENDER;
    }

    public void setGENDER(String GENDER) {
        this.GENDER = GENDER;
    }

    public String getSTAFF_ROLE() {
        return STAFF_ROLE;
    }

    public void setSTAFF_ROLE(String STAFF_ROLE) {
        this.STAFF_ROLE = STAFF_ROLE;
    }

    public String getPHOTO() {
        return PHOTO;
    }

    public void setPHOTO(String PHOTO) {
        this.PHOTO = "";
    }

    public String getTRAIN_JOURNEY_STAFF() {
        return TRAIN_JOURNEY_STAFF;
    }

    public void setTRAIN_JOURNEY_STAFF(String TRAIN_JOURNEY_STAFF) {
        this.TRAIN_JOURNEY_STAFF = "";
    }

    @Override
    public String toString() {
        return "ID=" + ID + ", EMAIL_ADDRESS=" + EMAIL_ADDRESS + ", PASSWORD=" + PASSWORD + ", FIRST_NAME=" + FIRST_NAME + ", LAST_NAME=" + LAST_NAME + ", DATE_OF_BIRTH=" + DATE_OF_BIRTH + ", GENDER=" + GENDER + ", STAFF_ROLE=" + STAFF_ROLE + ", PHOTO=" + PHOTO + ", TRAIN_JOURNEY_STAFF=" + TRAIN_JOURNEY_STAFF;
    }

}
