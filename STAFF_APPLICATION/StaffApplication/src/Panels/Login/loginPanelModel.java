/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Login;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import com.google.gson.JsonElement;
import com.google.gson.*;
import java.io.OutputStreamWriter;
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class loginPanelModel {

    private final String USER_AGENT = "Mozilla/5.0";

    private user User;

    public user getLoginData(String email) throws MalformedURLException, IOException, NoSuchAlgorithmException {

        String url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs";

        URL obj = new URL(url);
        HttpURLConnection con = (HttpURLConnection) obj.openConnection();

        // GET Request
        con.setRequestMethod("GET");

        //add request header
        con.setRequestProperty("User-Agent", USER_AGENT);
        try {
            int responseCode = con.getResponseCode();

            System.out.println("\nSending 'GET' request to URL : " + url);
            System.out.println("Response Code : " + responseCode);
        } catch (FileNotFoundException io) {
            System.out.println("Wrong username");
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
        JsonArray jarray = jelement.getAsJsonArray();

        Boolean isFound = false;

        user Usertest = new user();
        for (int i = 0; i < jarray.size(); i++) {

            JsonObject jobject = jarray.get(i).getAsJsonObject();

            if (jobject.get("EMAIL_ADDRESS").getAsString().equals(email)) {

                Usertest.setID(jobject.get("ID").getAsString());
                Usertest.setEMAIL_ADDRESS(jobject.get("EMAIL_ADDRESS").getAsString());
                Usertest.setPASSWORD(jobject.get("PASSWORD").getAsString());
                Usertest.setFIRST_NAME(jobject.get("FIRST_NAME").getAsString());
                Usertest.setLAST_NAME(jobject.get("LAST_NAME").getAsString());
                Usertest.setDATE_OF_BIRTH(jobject.get("DATE_OF_BIRTH").getAsString());
                Usertest.setGENDER(jobject.get("GENDER").getAsString());
                Usertest.setSTAFF_ROLE(jobject.get("STAFF_ROLE").getAsString());
                Usertest.setPHOTO("");
                Usertest.setTRAIN_JOURNEY_STAFF(jobject.get("TRAIN_JOURNEY_STAFF").toString());

                isFound = true;
            } else {
                if (!isFound) {
                    Usertest.setFIRST_NAME("Failed");
                }
            }
        }
        return Usertest;
    }

    public user getUser() {
        return User;
    }

    public void setUser(user User) {
        this.User = User;
    }

    protected String encrypt(String password) throws NoSuchAlgorithmException {

        MessageDigest digest = MessageDigest.getInstance("SHA-256");
        String salt = "PRC$252GROUPL";
        byte[] salt2 = salt.getBytes();
        digest.update(salt2);
        byte[] encodedhash = digest.digest(password.getBytes(StandardCharsets.UTF_8));

        StringBuffer hexString = new StringBuffer();
        for (int i = 0; i < encodedhash.length; i++) {
            String hex = Integer.toHexString(0xff & encodedhash[i]);
            if (hex.length() == 1) {
                hexString.append('0');
            }
            hexString.append(hex);
        }
        String encryptedPassword = hexString.toString();
        return encryptedPassword;
    }

    protected void putRequest(user User2) throws MalformedURLException, IOException {
        URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs/" + User2.getID());
        HttpURLConnection httpCon = (HttpURLConnection) url.openConnection();
        httpCon.setDoOutput(true);
        httpCon.setRequestMethod("PUT");
        httpCon.setRequestProperty("Content-Type", "application/json");
        Gson gson = new Gson();
        String json = gson.toJson(User2);
        System.out.println(json);
        OutputStreamWriter out = new OutputStreamWriter(httpCon.getOutputStream());
        out.write(json);
        out.close();
        httpCon.getInputStream();
    }

}
