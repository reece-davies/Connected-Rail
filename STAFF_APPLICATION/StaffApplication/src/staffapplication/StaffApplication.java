/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package staffapplication;

import MainJFrame.mainJFrameController;
import MainJFrame.mainJFrameModel;
import MainJFrame.mainJFrameView;
import Panels.DashBoard.DashBoardView;
import Panels.DashBoard.dashboardPanelController;
import Panels.DashBoard.dashboardPanelModel;
import Panels.Journey.JourneyView;
import Panels.Journey.journeyPanelController;
import Panels.Journey.journeyPanelModel;
import Panels.Login.LoginView;
import Panels.Login.loginPanelController;
import Panels.Login.loginPanelModel;
import Panels.Shifts.ShiftsView;
import Panels.Shifts.shiftsPanelController;
import Panels.Shifts.shiftsPanelModel;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.SwingUtilities;
import javax.swing.UIManager;
import javax.swing.UIManager.LookAndFeelInfo;
import javax.swing.UnsupportedLookAndFeelException;

/**
 *
 * @author Joe
 */
public class StaffApplication {

    /**
     * @param args the command line arguments
     * @throws java.io.IOException needed to catch possible exception
     */
    public static void main(String[] args) throws IOException {
      
              try {
                  for (LookAndFeelInfo info : UIManager.getInstalledLookAndFeels()) {
                      if ("Nimbus".equals(info.getName())) {
                          UIManager.setLookAndFeel(info.getClassName());
                          break;
                      }
                  }
              } catch (ClassNotFoundException | IllegalAccessException | InstantiationException | UnsupportedLookAndFeelException e) {
                  // if nimbus isn't working use default look and feel
                  try {
                      UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
                  } catch (ClassNotFoundException | InstantiationException | IllegalAccessException | UnsupportedLookAndFeelException ex) {
                      Logger.getLogger(StaffApplication.class.getName()).log(Level.SEVERE, null, ex);
                  }
              }
              //Declare MVC areas. Each area is needed to be declared for the controller
              ShiftsView theSView = new ShiftsView();
              JourneyView theJView = new JourneyView();
              DashBoardView theDView = new DashBoardView();
              LoginView theLView = new LoginView();
              mainJFrameView theView = mainJFrameView.getInstance();
              
              journeyPanelModel theJModel = new journeyPanelModel();
              shiftsPanelModel theSModel = new shiftsPanelModel();
              loginPanelModel theLModel = new loginPanelModel();
              mainJFrameModel theModel = new mainJFrameModel();
              dashboardPanelModel theDModel = new dashboardPanelModel();
              
              
              //Controllers
              dashboardPanelController theDController = new dashboardPanelController(theDView, theDModel, theView, theLModel, theJModel);
              shiftsPanelController theSController = new shiftsPanelController(theSView, theSModel, theDView);
              loginPanelController theLController = new loginPanelController(theLView, theLModel, theDView, theView, theModel, theSController, theSView);
              journeyPanelController theJController = new journeyPanelController(theJView, theJModel);
              mainJFrameController theController= new mainJFrameController(theView,theModel);
              
              
              theView.pack();
              theView.setVisible(true);
       
    }
}
