/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Journey;

import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.Arrays;
import java.util.LinkedHashSet;
import java.util.logging.Level;
import java.util.logging.Logger;


/**
 *
 * @author Joe
 */
public class journeyPanelModel {

    private final String USER_AGENT = "Mozilla/5.0";

    public String[][] getTableData() {
        //api call 
        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey";

        JsonElement jelement = null;
        try {
            jelement = apiCall(url);
        } catch (IOException ex) {
            Logger.getLogger(journeyPanelModel.class.getName()).log(Level.SEVERE, null, ex);
        }

        JsonArray jarray = jelement.getAsJsonArray();

        int size = jarray.size();
        String[] arrivalLocations = new String[(size) + 1];
        String[] depatureLocations = new String[(size) + 1];
        arrivalLocations[0] = "All";
        depatureLocations[0] = "All";
        String[][] data = new String[jarray.size()][4];
        for (int i = 0; i < jarray.size(); i++) {
            JsonObject jobject = jarray.get(i).getAsJsonObject();
            try {

                data[i][0] = jobject.get("ID").getAsString();
                data[i][1] = jobject.get("JOURNEY_COST").getAsString();
                data[i][2] = getLocations(jobject.get("ARRIVAL_LOCATION_ID").getAsString());
                data[i][3] = getLocations(jobject.get("DEPARTURE_LOCATION_ID").getAsString());

                //for combo boxes
                arrivalLocations[i + 1] = getLocations(jobject.get("ARRIVAL_LOCATION_ID").getAsString());
                depatureLocations[i + 1] = getLocations(jobject.get("DEPARTURE_LOCATION_ID").getAsString());

            } catch (IOException ex) {
                Logger.getLogger(journeyPanelModel.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        //A feature of a linkedhashset it that it doesn't allow duplicates, perfect for removing them without loops!
        LinkedHashSet<String> arrivalLocations2 = new LinkedHashSet<>(Arrays.asList(arrivalLocations));
        //create array from the LinkedHashSet
        String[] removedDuplicatedArrival = arrivalLocations2.toArray(new String[(arrivalLocations2.size())]);

        LinkedHashSet<String> depatureLocations2 = new LinkedHashSet<>(Arrays.asList(depatureLocations));
        //create array from the LinkedHashSet
        String[] removedDuplicateddepatureLocations = depatureLocations2.toArray(new String[(depatureLocations2.size())]);

        setArrivalID(removedDuplicatedArrival);
        setDepartureID(removedDuplicateddepatureLocations);
        return data;
    }

    protected boolean getTableDataThread(int prevValue) {
        //api call 
        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey";

        JsonElement jelement = null;
        try {
            jelement = apiCall(url);
        } catch (IOException ex) {
            Logger.getLogger(journeyPanelModel.class.getName()).log(Level.SEVERE, null, ex);
        }

        JsonArray jarray = jelement.getAsJsonArray();

        boolean isChanged = false;
        int number = jarray.size();

        if (prevValue != number) {
            isChanged = true;

            //  tableCheck(number,true);
        } else {
            //    tableCheck(number,false);}

        }

        return isChanged;
    }


    String[] arrivalID;
    String[] departureID;

    public void setArrivalID(String[] arrivalID) {
        this.arrivalID = arrivalID;
    }

    public void setDepartureID(String[] departureID) {
        this.departureID = departureID;
    }

    public String getLocations(String id) throws IOException {

        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/" + id;

        JsonElement jelement = apiCall(url);

        JsonObject jobject = jelement.getAsJsonObject();

        String location = jobject.get("TRAIN_STATION_NAME").getAsString();

        return location;

    }

    public String[] getComboBoxJourneyID() {
       
         String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey";

        JsonElement jelement = null;
        try {
            jelement = apiCall(url);
        } catch (IOException ex) {
            Logger.getLogger(journeyPanelModel.class.getName()).log(Level.SEVERE, null, ex);
        }

        JsonArray jarray = jelement.getAsJsonArray();
        String[] journeyID = new String[jarray.size() + 1];
        journeyID[0] = "All";
        for (int i = 1; i <= jarray.size(); i++) {
            JsonObject jobject = jarray.get(i - 1).getAsJsonObject();

            journeyID[i] = jobject.get("ID").getAsString();
        }
        return journeyID;
        
        
    }

    public String[] getComboBoxArrivalID() {
        System.out.println("getComboBoxArrivalID");
        return arrivalID;
    }

    public String[] getComboBoxDepartureID() {
        System.out.println("getComboBoxArrivalID");
        return departureID;
    }

    public String[][] getTrainBookings(String id) throws IOException {
        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/bookings";

        JsonElement jelement = apiCall(url);

        JsonArray jarray = jelement.getAsJsonArray();

        String[][] journeyBookings = new String[jarray.size()][7];

        for (int i = 0; i < jarray.size(); i++) {
            JsonObject jobject = jarray.get(i).getAsJsonObject();
            if (jobject.get("JOURNEY_ID").getAsString().equals(id)) {

                journeyBookings[i][0] = ((jobject.get("SEAT_NUMBER").getAsString()));

                //splitting date and time
                String string = jobject.get("DEPARTURE_DATE_TIME").getAsString();

                String[] parts = string.split("T");
                String part1 = parts[0];
                String part2 = parts[1];
                journeyBookings[i][1] = part1;
                journeyBookings[i][2] = part2;

                String string2 = jobject.get("ARRIVAL_DATE_TIME").getAsString();
                String[] partsA = string2.split("T");
                String part1A = partsA[0];
                String part2A = partsA[1];

                journeyBookings[i][3] = part1A;
                journeyBookings[i][4] = part2A;
                journeyBookings[i][5] = jobject.get("DEPARTURE_PLATFORM").getAsString();
                journeyBookings[i][6] = jobject.get("ARRIVAL_PLATFORM").getAsString();
            }
        }
        return journeyBookings;
    }

    public JsonElement apiCall(String url) throws MalformedURLException, IOException {

        URL obj = new URL(url);
        HttpURLConnection con = (HttpURLConnection) obj.openConnection();

        // GET request
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
        return jelement;
    }

    // setting the listener 
}
