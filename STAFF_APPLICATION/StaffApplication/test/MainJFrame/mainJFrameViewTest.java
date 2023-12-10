/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package MainJFrame;

import org.junit.After;
import org.junit.AfterClass;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.Test;
import static org.junit.Assert.*;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class mainJFrameViewTest {

    user UserTest = new user();

    public mainJFrameViewTest() {
        UserTest.setID("15");
        UserTest.setFIRST_NAME("Joe");
        UserTest.setLAST_NAME("Kilbane");

    }

    @BeforeClass
    public static void setUpClass() {
    }

    @AfterClass
    public static void tearDownClass() {
    }

    @Before
    public void setUp() {
    }

    @After
    public void tearDown() {
    }

    @Test
    public void testGetInstance() {
    }

    @Test
    public void testAddCloseListener() {
    }

    @Test
    public void testAddOverviewListener() {
    }

    @Test
    public void testAddShiftsListener() {
    }

    @Test
    public void testAddJourneyListener() {
    }

    @Test
    public void testSetUserDetails() {
    
    }

    @Test
    public void testSetView() {
    }

    @Test
    public void testAddLogoutListener() {
    }

}
