/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Login;

import MainJFrame.mainJFrameController;
import MainJFrame.mainJFrameModel;
import MainJFrame.mainJFrameView;
import Panels.DashBoard.DashBoardView;
import Panels.Shifts.ShiftsView;
import Panels.Shifts.shiftsPanelController;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import staffapplication.user;

/**
 *
 * @author Joe The main aims of this page is to 1.Hash and salt password 2.Get
 * user details using given username 3.if exception thrown, wrong username
 * 4.compare hashes 5.result
 *
 * 1.username is an email address 2. parse the json object
 *
 */
public class loginPanelController {

    mainJFrameController theController;
    private final LoginView theLView;
    private final DashBoardView theDView;
    private final ShiftsView theSView;
    private final loginPanelModel theLModel;
    static private mainJFrameView theView;
    static private mainJFrameModel theModel;
    private final shiftsPanelController theSController;

    public loginPanelController(LoginView theLView, loginPanelModel theLModel, DashBoardView theDView, mainJFrameView theView, mainJFrameModel theModel, shiftsPanelController theSController, ShiftsView theSView) {
        this.theLView = theLView;
        this.theLModel = theLModel;
        this.theDView = theDView;
        this.theSView = theSView;
        loginPanelController.theModel = theModel;
        loginPanelController.theView = theView;

        this.theSController = theSController;
        this.theLView.addLoginListener(new LoginListener());
    }

    public class LoginListener implements ActionListener {

        String ID;
        String name;
        user User = new user();

        @Override
        public void actionPerformed(ActionEvent e) {

            try {
                Boolean isLogged = false;

                String password, email;
                email = theLView.getUserName();
                password = theLView.getPassword();
                String encrypted = theLModel.encrypt(password);

                user UserToTest = theLModel.getLoginData(email);

                if (UserToTest.getFIRST_NAME().equals("Failed")) {
                    theLView.setResult(isLogged);
                    theModel.setIsLogged(isLogged);

                } else if (UserToTest.getPASSWORD().equals(encrypted)) {
                    User = UserToTest;
                    //This is only tested once the user has passed the inital test- still secure.
                    if (UserToTest.getPASSWORD().equals("f906b1f72c9227b48a8339b8ede447260decfa18da1490515ff900d7b626de25")) {

                        theLModel.setUser(User);
                        isLogged = true;
                        theSController.setTable(User);
                        theModel.setIsLogged(isLogged);
                        theDView.setupProfile(User);
                        String panelname = "DASHVIEW";
                        theView.setView(panelname);
                        theView.setUserDetails(User);
                        JPanel panel = new JPanel();
                        JLabel label = new JLabel();
                        label.setText("Default password found, please enter new one:");
                        JPasswordField newPassField = new JPasswordField();
                        panel.add(label);
                        panel.add(newPassField);
                        theLView.setFields();
                        JOptionPane.showMessageDialog(theView, newPassField, "Default password must be changed:", JOptionPane.PLAIN_MESSAGE);
                        String newEncrypted = theLModel.encrypt(newPassField.getText());

                        User.setPASSWORD((newEncrypted));
                        theLModel.putRequest(User);
                    }
                    theLModel.setUser(User);
                    isLogged = true;
                    theSController.setTable(User);
                    theModel.setIsLogged(isLogged);
                    theDView.setupProfile(User);

                    theSView.setUser(User);
                    String panelname = "DASHVIEW";
                    theView.setView(panelname);
                    theView.setUserDetails(User);
                    theLView.setFields();

                } else {
                    theLView.setResult(isLogged);
                    theModel.setIsLogged(isLogged);
                }
            } catch (IOException | NoSuchAlgorithmException ex) {
                Logger.getLogger(loginPanelController.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }

    public JPanel getView() {
        return this.theLView;
    }
}
