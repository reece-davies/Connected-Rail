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

/**
 *
 * @author Joe
 */
public class mainJFrameModelTest {
    
     mainJFrameModel model = new mainJFrameModel();
    public mainJFrameModelTest() {
        
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
    public void testGetIsLogged() {
        assertEquals(false, model.getIsLogged());
    }

    @Test
    public void testSetIsLogged() {
        model.setIsLogged(true);
        assertEquals(true,model.getIsLogged());
    }

 
    
}
