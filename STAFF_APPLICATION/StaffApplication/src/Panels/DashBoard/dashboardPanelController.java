/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.DashBoard;

import MainJFrame.mainJFrameView;
import Panels.Journey.journeyPanelModel;
import Panels.Login.loginPanelModel;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Base64;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.ImageIO;
import javax.swing.JFileChooser;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class dashboardPanelController {

    private final DashBoardView theDView;
    private final dashboardPanelModel theDModel;
    private final journeyPanelModel theJModel;
    private final mainJFrameView theView;
    private final loginPanelModel theLModel;

    public dashboardPanelController(DashBoardView theDView, dashboardPanelModel theDModel, mainJFrameView theView, loginPanelModel theLModel, journeyPanelModel theJModel) {
        this.theDView = theDView;
        this.theDModel = theDModel;
        this.theView = theView;
        this.theLModel = theLModel;
        this.theJModel = theJModel;
        this.theDView.addLoginListener(new profileListener());
        this.theDView.addPasswordListener(new passwordListener());
        this.setTable();
    }

    public void setTable() {
        this.theDView.setTable(theJModel.getTableData());

    }

    public JPanel getView() {
        return this.theDView;
    }

    private class passwordListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {
            user User = theLModel.getUser();

            try {

                MessageDigest digest = MessageDigest.getInstance("SHA-256");
                String salt = "PRC$252GROUPL";
                byte[] salt2 = salt.getBytes();
                digest.update(salt2);
                byte[] encodedhash = digest.digest(theDView.newPasswordField.getText().getBytes(StandardCharsets.UTF_8));

                StringBuffer hexString = new StringBuffer();
                for (int i = 0; i < encodedhash.length; i++) {
                    String hex = Integer.toHexString(0xff & encodedhash[i]);
                    if (hex.length() == 1) {
                        hexString.append('0');
                    }
                    hexString.append(hex);
                }
                User.setPASSWORD(hexString.toString());
                //user feedback dialog
                JOptionPane.showMessageDialog(theView, "Password changed sucessfully ");
                //clear field
                theDView.newPasswordField.setText("");
                theDModel.putRequest(User);

            } catch (NoSuchAlgorithmException | IOException ex) {
                Logger.getLogger(dashboardPanelController.class.getName()).log(Level.SEVERE, null, ex);
            }

        }
    }

    private class profileListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {
            JFileChooser filechooser = new JFileChooser();
            filechooser.setDialogTitle("Choose Your File");
            filechooser.setFileSelectionMode(JFileChooser.FILES_ONLY);
            // below code selects the file 
            int returnval = filechooser.showOpenDialog(theView);
            if (returnval == JFileChooser.APPROVE_OPTION) {
                try {
                    File file = filechooser.getSelectedFile();
                    BufferedImage buffImg;

                    buffImg = ImageIO.read(file);
                    //scales to the label size on the panel
                    Image img = buffImg.getScaledInstance(theDView.getIconWidth(), theDView.getIconHeight(),
                            Image.SCALE_SMOOTH);
                    //Sends image over
                    theDView.setNewImg(img);

                    try {
                        FileInputStream fileInputStreamReader = new FileInputStream(file);
                        byte[] bytes = new byte[(int) file.length()];
                        fileInputStreamReader.read(bytes);
                        String encodedFile = Base64.getEncoder().encodeToString(bytes);
                        System.out.println(encodedFile);

                    } catch (FileNotFoundException e2) {
                        //image converted to base64 to be used in the database.
                    }
                } catch (IOException ex) {
                    Logger.getLogger(dashboardPanelController.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        }
    }
}
