/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package MainJFrame;

import java.awt.event.ActionListener;
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
import java.awt.CardLayout;
import java.awt.Color;
import java.awt.Font;
import java.awt.FontFormatException;
import java.awt.GradientPaint;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.GraphicsEnvironment;
import java.awt.Image;
import java.awt.RenderingHints;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class mainJFrameView extends javax.swing.JFrame {

    static int mainWidth = 0;
    //Use of singleton to ensure only one frame instance runs
    private static final mainJFrameView singleton = new mainJFrameView();
    private final mainJFrameModel theModel = new mainJFrameModel();
    
    //the views
    JourneyView theJView = new JourneyView();
    DashBoardView dashView = new DashBoardView();
    ShiftsView shiftsView = new ShiftsView();
    LoginView theLView = new LoginView();
    
    //the models
    journeyPanelModel theJModel = new journeyPanelModel();
    loginPanelModel theLModel = new loginPanelModel();
    dashboardPanelModel theDModel = new dashboardPanelModel();
    shiftsPanelModel theSModel = new shiftsPanelModel();
    
    //the controllers
    journeyPanelController theJController = new journeyPanelController(theJView, theJModel);
    dashboardPanelController theDController = new dashboardPanelController(dashView, theDModel, singleton, theLModel, theJModel);
    shiftsPanelController theSController = new shiftsPanelController(shiftsView, theSModel, dashView);
    loginPanelController theLController = new loginPanelController(theLView, theLModel, dashView, singleton, theModel, theSController, shiftsView);

    public static mainJFrameView getInstance() {
        mainWidth = singleton.getWidth();
        return singleton;
    }

    public mainJFrameView() {
         
          
 
        initComponents();

        navPanel.setSize(mainWidth, 70);

        //add panel to content panel
        this.contentPanel.setLayout(new CardLayout());
        this.contentPanel.add(theLController.getView(), "LOGINVIEW");
        this.contentPanel.add(theJController.getView(), "JOURNEYVIEW");
        this.contentPanel.add(theDController.getView(), "DASHVIEW");
        this.contentPanel.add(theSController.getView(), "SHIFTSVIEW");

        try {
            //create the font to use. Specify the size!
            Font customFont = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Bold.ttf")).deriveFont(18f);
            GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
            //register the font
            ge.registerFont(customFont);
            staffIDLabel.setFont(customFont);
            nameLabel.setFont(customFont);
            nameLabel.setFont(customFont);
            jLabel1.setFont(customFont);
            closeButton.setFont(customFont);
            journeyButton.setFont(customFont);
            overViewButton.setFont(customFont);
            logoutBtn.setFont(customFont);
            shiftsButton.setFont(customFont);
            jLabel2.setFont(customFont);
        } catch (IOException | FontFormatException e) {
        }
        BufferedImage img = null;
        try {
            img = ImageIO.read(new File("IMG\\Logo_grey.png"));
        } catch (IOException e) {
        }
        Image dimg = img.getScaledInstance(Icon.getWidth(), Icon.getHeight(),
                Image.SCALE_SMOOTH);
        ImageIcon imageIcon = new ImageIcon(dimg);
        Icon.setIcon(imageIcon);

       }  
    
    void addLogoutListener(ActionListener listenforLogout){
    logoutBtn.addActionListener(listenforLogout);}

    void addCloseListener(ActionListener listenforCloseBtn) {
        closeButton.addActionListener(listenforCloseBtn);
    }

    void addOverviewListener(ActionListener listenforOverViewBtn) {
        overViewButton.addActionListener(listenforOverViewBtn);
    }

    void addShiftsListener(ActionListener listenforShiftsBtn) {
        shiftsButton.addActionListener(listenforShiftsBtn);
    }

    void addJourneyListener(ActionListener listenforJourneyBtn) {
        journeyButton.addActionListener(listenforJourneyBtn);
    }

    public void setUserDetails(user User) {

        this.staffIDLabel.setText(User.getID());
        this.nameLabel.setText(User.getFIRST_NAME() + " " + User.getLAST_NAME());

    }

    public void setView(String panelName) {

        CardLayout cl = (CardLayout) (contentPanel.getLayout());
        cl.show(contentPanel, panelName);
  
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        icon = new javax.swing.JLabel();
        navPanel = new javax.swing.JPanel(){ @Override
            protected void paintComponent(Graphics g) {
                super.paintComponent(g);
                Graphics2D g2d = (Graphics2D) g;
                g2d.setRenderingHint(RenderingHints.KEY_RENDERING, RenderingHints.VALUE_RENDER_QUALITY);
                int w = getWidth();
                int h = getHeight();
                Color color1 = Color.decode("#009667");
                Color color2 = Color.lightGray;
                GradientPaint gp = new GradientPaint( 00,00,color1, 1000, 950, color2);
                g2d.setPaint(gp);
                g2d.fillRect(0,0,w,h);
            }

        };
        closeButton = new javax.swing.JButton();
        overViewButton = new javax.swing.JButton();
        shiftsButton = new javax.swing.JButton();
        journeyButton = new javax.swing.JButton();
        jLabel2 = new javax.swing.JLabel();
        logoutBtn = new javax.swing.JButton();
        accountPanel = new javax.swing.JPanel(){ protected void paintComponent(Graphics g) {
            super.paintComponent(g);
            Graphics2D g2d = (Graphics2D) g;
            g2d.setRenderingHint(RenderingHints.KEY_RENDERING, RenderingHints.VALUE_RENDER_QUALITY);
            int w = getWidth();
            int h = getHeight();
            Color color1 = Color.decode("#009667");
            Color color2 = Color.lightGray;
            GradientPaint gp = new GradientPaint( 0,0,color1, 0, h, color2);
            g2d.setPaint(gp);
            g2d.fillRect(0,0,w,h);
        }};
        nameLabel = new javax.swing.JLabel();
        jLabel1 = new javax.swing.JLabel();
        Icon = new javax.swing.JLabel();
        staffIDLabel = new javax.swing.JLabel();
        contentPanel = new javax.swing.JPanel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setBackground(new java.awt.Color(0, 153, 102));
        setForeground(new java.awt.Color(0, 153, 102));
        setMinimumSize(new java.awt.Dimension(1280, 720));
        setSize(new java.awt.Dimension(1920, 1080));
        getContentPane().setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());
        getContentPane().add(icon, new org.netbeans.lib.awtextra.AbsoluteConstraints(0, 0, -1, -1));

        navPanel.setBackground(new java.awt.Color(0, 102, 0));
        navPanel.setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        closeButton.setText("Close");
        navPanel.add(closeButton, new org.netbeans.lib.awtextra.AbsoluteConstraints(1750, 10, 150, 50));

        overViewButton.setText("Overview");
        navPanel.add(overViewButton, new org.netbeans.lib.awtextra.AbsoluteConstraints(290, 10, 150, 50));

        shiftsButton.setText("Shifts");
        navPanel.add(shiftsButton, new org.netbeans.lib.awtextra.AbsoluteConstraints(450, 10, 150, 50));

        journeyButton.setText("Journeys");
        navPanel.add(journeyButton, new org.netbeans.lib.awtextra.AbsoluteConstraints(610, 10, 150, 50));

        jLabel2.setText("ConnectedRail™");
        navPanel.add(jLabel2, new org.netbeans.lib.awtextra.AbsoluteConstraints(20, 30, -1, -1));

        logoutBtn.setText("Logout");
        navPanel.add(logoutBtn, new org.netbeans.lib.awtextra.AbsoluteConstraints(1540, 10, 150, 50));

        getContentPane().add(navPanel, new org.netbeans.lib.awtextra.AbsoluteConstraints(0, 0, 1920, 70));

        accountPanel.setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        nameLabel.setFont(new java.awt.Font("Dialog", 1, 18)); // NOI18N
        nameLabel.setForeground(new java.awt.Color(0, 0, 0));
        accountPanel.add(nameLabel, new org.netbeans.lib.awtextra.AbsoluteConstraints(10, 130, 150, 40));

        jLabel1.setFont(new java.awt.Font("Dialog", 1, 14)); // NOI18N
        jLabel1.setForeground(new java.awt.Color(0, 0, 0));
        jLabel1.setText("Staff ID:");
        accountPanel.add(jLabel1, new org.netbeans.lib.awtextra.AbsoluteConstraints(10, 190, -1, 30));

        Icon.setFont(new java.awt.Font("Dialog", 1, 24)); // NOI18N
        accountPanel.add(Icon, new org.netbeans.lib.awtextra.AbsoluteConstraints(20, 20, 100, 100));

        staffIDLabel.setFont(new java.awt.Font("Dialog", 1, 14)); // NOI18N
        staffIDLabel.setForeground(new java.awt.Color(0, 0, 0));
        accountPanel.add(staffIDLabel, new org.netbeans.lib.awtextra.AbsoluteConstraints(80, 190, 90, 30));

        getContentPane().add(accountPanel, new org.netbeans.lib.awtextra.AbsoluteConstraints(0, 70, 170, 1010));

        contentPanel.setMaximumSize(new java.awt.Dimension(2560, 1440));
        contentPanel.setLayout(new java.awt.CardLayout());
        getContentPane().add(contentPanel, new org.netbeans.lib.awtextra.AbsoluteConstraints(170, 70, 1750, 1010));

        pack();
    }// </editor-fold>//GEN-END:initComponents

    /**
     *
     * @param args the command line arguments
     */

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel Icon;
    private javax.swing.JPanel accountPanel;
    private javax.swing.JButton closeButton;
    public javax.swing.JPanel contentPanel;
    private javax.swing.JLabel icon;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JButton journeyButton;
    private javax.swing.JButton logoutBtn;
    private javax.swing.JLabel nameLabel;
    public javax.swing.JPanel navPanel;
    private javax.swing.JButton overViewButton;
    private javax.swing.JButton shiftsButton;
    private javax.swing.JLabel staffIDLabel;
    // End of variables declaration//GEN-END:variables
}
