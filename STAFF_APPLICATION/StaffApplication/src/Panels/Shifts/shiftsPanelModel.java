/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Shifts;

import Panels.Journey.journeyPanelModel;
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

/**
 *
 * @author Joe
 */
public class shiftsPanelModel {

    journeyPanelModel theJModel;

    private final String USER_AGENT = "Mozilla/5.0";

    public JsonElement apiCall(String url) throws MalformedURLException, IOException {

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
        return jelement;
    }

    public String[][] getShiftTableData(String id) throws IOException {
        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/TRAIN_JOURNEY_STAFF";

        JsonElement jelement = apiCall(url);

        JsonArray jarray = jelement.getAsJsonArray();

        String[][] staffShifts = new String[jarray.size()][4];

        for (int i = 0; i < jarray.size(); i++) {
            JsonObject jobject = jarray.get(i).getAsJsonObject();
            if (jobject.get("STAFF_ID").getAsString().equals(id)) {

                staffShifts[i][0] = ((jobject.get("ID").getAsString()));
                staffShifts[i][1] = ((jobject.get("JOURNEY_ID").getAsString()));

                String url2 = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/bookings";

                JsonElement jelement2 = apiCall(url2);

                JsonArray jarray2 = jelement2.getAsJsonArray();
                for (int j = 0; j < jarray2.size(); j++) {
                    JsonObject jobject2 = jarray2.get(j).getAsJsonObject();

                    if (jobject2.get("JOURNEY_ID").getAsString().equals(staffShifts[i][1])) {
                        staffShifts[i][2] = (jobject2.get("DEPARTURE_DATE_TIME").getAsString());
                        staffShifts[i][3] = (jobject2.get("ARRIVAL_DATE_TIME").getAsString());
                    }
                }
            }
        }
        return staffShifts;
    }

    public boolean getShiftTableDataThread(String id, int prevValue) throws IOException {
        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/TRAIN_JOURNEY_STAFF";

        JsonElement jelement = apiCall(url);

        JsonArray jarray = jelement.getAsJsonArray();

        boolean isChanged = false;
        int counter = 0;
        // checks to see if any more shifts match the users ID
        //If true table will be told to update
        for (int i = 0; i < jarray.size(); i++) {
            JsonObject jobject = jarray.get(i).getAsJsonObject();
            if (jobject.get("STAFF_ID").getAsString().equals(id)) {
                counter++;

            }
        }
        int number = counter;
        if (prevValue != number) {
            isChanged = true;

            //  tableCheck(number,true);
        } else {
            //    tableCheck(number,false);}

        }

        return isChanged;

    }

}
