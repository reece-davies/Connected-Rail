 /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package MainJFrame;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JOptionPane;
/**
 *
 * @author Joe
 */
public class mainJFrameController {

    private final mainJFrameView theView;
    private final mainJFrameModel theModel;

    public mainJFrameController(mainJFrameView theView, mainJFrameModel theModel) {
        this.theView = theView;
        this.theModel = theModel;

        this.theView.addOverviewListener(new OverViewListener());
        this.theView.addShiftsListener(new ShiftsListener());
        this.theView.addJourneyListener(new JourneyListener());
        this.theView.addCloseListener(new CloseListener());
        this.theView.addLogoutListener(new LogoutListener());
    }

    private class LogoutListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {
              Boolean isLogged = theModel.getIsLogged();
            
            if (!isLogged) {
                JOptionPane.showMessageDialog(theView,
                        "No user logged in!");    
            } else {
                String panel = "LOGINVIEW";
                theView.setView(panel);
                theModel.setIsLogged(false);
                
            }
        }
    }

    /**
     *
     * @param username
     * @param User
     */
    private class OverViewListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {

            Boolean isLogged = theModel.getIsLogged();
            
            if (!isLogged) {
                JOptionPane.showMessageDialog(theView,
                        "Don't forget to login!");    
            } else {
                String panel = "DASHVIEW";
                theView.setView(panel);
                
            }
        }
    }

    private class ShiftsListener implements ActionListener {


        @Override
        public void actionPerformed(ActionEvent e) {

            
            Boolean isLogged = theModel.getIsLogged();
            
            if (isLogged == false) {
                JOptionPane.showMessageDialog(theView,
                        "Don't forget to login!");

            } else {
                String panel = "SHIFTSVIEW";
                theView.setView( panel);
            }
        }
    }

    public class JourneyListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {
            Boolean isLogged = theModel.getIsLogged();
            
            if (!isLogged) {
                JOptionPane.showMessageDialog(theView,
                        "Don't forget to login!");

            } else {
                String panel = "JOURNEYVIEW";
                theView.setView( panel);
            }
        }
    }

    public class CloseListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {
            theView.dispose();
            System.exit(0);
        }
    }

}
