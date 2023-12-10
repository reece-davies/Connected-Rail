/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Journey;

import com.google.gson.JsonElement;
import com.google.gson.JsonParser;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Arrays;
import org.junit.Test;
import static org.junit.Assert.*;

/**
 *
 * @author Joe
 */
public class journeyPanelModelTest {
    journeyPanelModel model= new journeyPanelModel();
    public journeyPanelModelTest() {
    }
    

    @Test
    public void testGetTableData() {
        String[][]data=model.getTableData();
        //the second train journey on record
        assertEquals("[47, 17.0, Plymouth Railway Station, Paignton Railway Station]",Arrays.toString(data[1]));
    }

    @Test
    public void testGetComboBoxJourneyID() {
          String[] journeys= model.getComboBoxJourneyID();
        assertEquals("19",journeys[5].toString());
    }

 

    @Test
    public void testGetTableDataThread() {
           
        //incorrect amount of train journeys
        assertEquals(true,model.getTableDataThread(4));
        //correct amount
        assertEquals(false,model.getTableDataThread(11));
        
    }


 

    @Test
    public void testGetLocations() throws Exception {
        
        String location = model.getLocations("1");
        assertEquals("Plymouth Railway Station",location);
        
    }

    @Test
    public void testGetTrainBookings() throws Exception {
        String [][] bookings = model.getTrainBookings("11");
      //the first booking for this journey
        assertEquals("[3, 2019-04-10, 07:17:00, 2019-04-10, 07:27:00, 1.0, 2.0]",Arrays.toString(bookings[0]));
        
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
    
}
