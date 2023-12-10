/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.DashBoard;

import Panels.Journey.journeyPanelModel;
import Panels.Shifts.shiftsPanelModel;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;
import com.google.gson.Gson;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class dashboardPanelModel {


    protected void putRequest(user User2) throws MalformedURLException, IOException {
        URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs/" + User2.getID());
        HttpURLConnection httpCon = (HttpURLConnection) url.openConnection();
        httpCon.setDoOutput(true);
        httpCon.setRequestMethod("PUT");
        httpCon.setRequestProperty("Content-Type", "application/json");
        Gson gson = new Gson();
        String json = gson.toJson(User2);
        System.out.println(json);
        try (OutputStreamWriter out = new OutputStreamWriter(
                httpCon.getOutputStream())) {
            out.write(json);
        }
        httpCon.getInputStream();
    }

}
