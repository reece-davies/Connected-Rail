/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Shifts;

import com.google.gson.JsonElement;
import com.google.gson.JsonParser;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Arrays;
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
public class shiftsPanelModelTest {
     shiftsPanelModel model= new shiftsPanelModel();
    public shiftsPanelModelTest() {
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
    public void testGetShiftTableData() throws IOException {
        String [][] shift=model.getShiftTableData("15");
        //first shift of staff 15
        assertEquals("[22, 14, 2019-04-10T07:17:00, 2019-04-10T07:27:00]",Arrays.toString(shift[1]));
        

        
    }


    @Test
    public void testApiCall() throws Exception {   
        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/1";
        final String USER_AGENT = "Mozilla/5.0";
         URL obj = new URL(url);
        HttpURLConnection con = (HttpURLConnection) obj.openConnection();

        // optional default is GET
        con.setRequestMethod("GET");

        //add request header
        con.setRequestProperty("User-Agent", USER_AGENT);
        try {
            int responseCode = con.getResponseCode();

            System.out.println("\nSending 'GET' request to URL : " + url);
            System.out.println("Response Code : " + responseCode);
        } catch (FileNotFoundException io) {
            System.out.println("No info found");
        }
        StringBuffer response;
        try (BufferedReader in = new BufferedReader(
                new InputStreamReader(con.getInputStream()))) {
            String inputLine;
            response = new StringBuffer();
            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
        }
        JsonElement jelement = new JsonParser().parse(response.toString());
        
       assertEquals(jelement,model.apiCall(url));
        
         }

    @Test
    public void testGetShiftTableDataThread() throws Exception {
       
        //Correct amount of shifts for ID 15
        assertEquals(false,model.getShiftTableDataThread("15",4));
        //Incorrect shifts for ID 15, so value has changed
        assertEquals(true,model.getShiftTableDataThread("15",5));
    }
    
}
