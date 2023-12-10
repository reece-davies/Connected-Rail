/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Login;

import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import org.junit.Test;
import static org.junit.Assert.*;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class loginPanelModelTest {
    loginPanelModel model= new loginPanelModel();
    public loginPanelModelTest() {
        
    }
    

    @Test
    public void testGetLoginData() throws IOException, NoSuchAlgorithmException {
        String email="josephkilbane@connectedrail.com";
         user UserToTest = model.getLoginData(email);
         
         assertEquals(email,UserToTest.getEMAIL_ADDRESS());
    }

    @Test
    public void testEncrypt() throws Exception {
        //this is the hash and salt of 'password'
        String password="f906b1f72c9227b48a8339b8ede447260decfa18da1490515ff900d7b626de25";
        String passwordEncrypt=model.encrypt("password");
        assertEquals(password,passwordEncrypt);
    }

    
}
