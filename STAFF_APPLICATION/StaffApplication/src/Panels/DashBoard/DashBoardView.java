/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.DashBoard;

import MainJFrame.mainJFrameView;
import Panels.Login.LoginView;
import java.awt.Font;
import java.awt.FontFormatException;
import java.awt.Graphics;
import java.awt.GraphicsEnvironment;
import java.awt.Image;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public class DashBoardView extends javax.swing.JPanel {

    private BufferedImage image;
    private mainJFrameView theView;
    private LoginView theLView;

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        g.drawImage(image, 0, 0, this); // see javadoc for more info on the parameters            
    }

    DefaultTableModel journeyTableModel;
    DefaultTableModel shiftTableModel;

    /**
     * Creates new form DashBoardView
     */
    public DashBoardView() {
        initComponents();
        try {
            image = ImageIO.read(new File("IMG\\background.png"));
        } catch (IOException ex) {

        }
        try {
            //create the font to use. Specify the size!
            Font customFont = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Bold.ttf")).deriveFont(24f);
            Font customFont1 = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Bold.ttf")).deriveFont(20f);
            Font customFont2 = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Regular.ttf")).deriveFont(18f);
            GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
            //register the font
            ge.registerFont(customFont);
            jLabel1.setFont(customFont);
            jLabel2.setFont(customFont);
            jLabel3.setFont(customFont);
            jLabel4.setFont(customFont);
            jLabel5.setFont(customFont);
            jLabel6.setFont(customFont);
            jLabel7.setFont(customFont);
            nameLabel.setFont(customFont2);
            IDlabel.setFont(customFont2);
            profileBtn.setFont(customFont1);
            updatePasswordBtn.setFont(customFont1);
            journeyTable.setFont(customFont2);
            journeyTable.getTableHeader().setFont(customFont);
            shiftTable.setFont(customFont2);
            shiftTable.getTableHeader().setFont(customFont1);
        } catch (IOException | FontFormatException e) {
        }
        setupTables();
    }

    public void setupTables() {
        //For both tables on the overview page
        String[] columnNames = {"Shift ID", "Journey ID", "dep", "arrive"};
        this.shiftTableModel = new DefaultTableModel(0, 0);
        shiftTableModel.setColumnIdentifiers(columnNames);
        this.shiftTable.setDefaultEditor(Object.class, null);
        shiftTable.setModel(shiftTableModel);

        String[] columnNames2 = {"ID", "Journey Cost", "Arrive", "Depart"};
        this.journeyTableModel = new DefaultTableModel(0, 0);
        journeyTableModel.setColumnIdentifiers(columnNames2);
        this.journeyTable.setDefaultEditor(Object.class, null);
        journeyTable.setModel(journeyTableModel);

    }

    public void setupProfile(user User) {
        try {
            nameLabel.setText(User.getFIRST_NAME() + " " + User.getLAST_NAME());
            IDlabel.setText(User.getID());
            BufferedImage buffImg;
            buffImg = ImageIO.read(new File("IMG\\defaultUser.png"));
            //scales to the label size on the panel
            Image img = buffImg.getScaledInstance(getIconWidth(), getIconHeight(),
                    Image.SCALE_SMOOTH);
            ImageIcon imageIcon = new ImageIcon(img);
            imgIcon.setIcon(imageIcon);

            //Just a test to see base64 working!
            // if (isDefault) {
            //  }
            /*   try {
             String base64Image2 = "";
             String base64Image = base64Image2.split(",")[1];
             byte[] imageBytes = javax.xml.bind.DatatypeConverter.parseBase64Binary(base64Image);
             BufferedImage img64 = ImageIO.read(new ByteArrayInputStream(imageBytes));
             Image dimg = img64.getScaledInstance(imgIcon.getWidth(), imgIcon.getHeight(),
             Image.SCALE_SMOOTH);
             ImageIcon imageIcon = new ImageIcon(dimg);
             imgIcon.setIcon(imageIcon);
             
             byte[] compressed;
             try (ByteArrayOutputStream bos = new ByteArrayOutputStream(base64Image2.length())) {
             try (GZIPOutputStream gzip = new GZIPOutputStream(bos)) {
             gzip.write(imageBytes);
             }
             compressed = bos.toByteArray();
             }
             System.out.println("Old " + base64Image2);
             System.out.println("New " + Arrays.toString(compressed));
             Path file = Paths.get("New");
             Files.write(file, compressed);
             
             } catch (IOException ex) {
             Logger.getLogger(DashBoardView.class.getName()).log(Level.SEVERE, null, ex);
             }*/
        } catch (IOException ex) {
            Logger.getLogger(DashBoardView.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    public int getIconWidth() {
        return imgIcon.getWidth();
    }

    public int getIconHeight() {
        return imgIcon.getHeight();
    }

    public void setNewImg(Image img) {

        ImageIcon imageIcon = new ImageIcon(img);
        imgIcon.setIcon(imageIcon);
        //Quick user feedback
        JOptionPane.showMessageDialog(theView, "Profile Picture Updated!");
    }

    public void setShiftTable(String[][] rowData) {
//Checks if null, adds to table if isnt.
shiftTableModel.setRowCount(0);
        for (String[] rowData1 : rowData) {
            if (rowData1[0] == null) {
            } else {
                shiftTableModel.addRow(rowData1);
                shiftTable.setRowHeight(30);
            }
        }
    }

    public void setTable(String[][] rowData) {

        for (int i = 0; i < rowData.length; i++) {
            journeyTableModel.addRow(rowData[i]);
            journeyTable.setRowHeight(i, 30);
        }
    }

    void addPasswordListener(ActionListener u) {
        this.updatePasswordBtn.addActionListener(u);
    }

    void addLoginListener(ActionListener p) {
        this.profileBtn.addActionListener(p);
    }

    void addtableListener(ActionListener t) {
        theLView.loginBtn.addActionListener(t);
    }

    /**
     * This method is called from within the constructor to initialise the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        shiftTable = new javax.swing.JTable();
        jLabel2 = new javax.swing.JLabel();
        jScrollPane2 = new javax.swing.JScrollPane();
        journeyTable = new javax.swing.JTable();
        jLabel3 = new javax.swing.JLabel();
        jLabel4 = new javax.swing.JLabel();
        nameLabel = new javax.swing.JLabel();
        IDlabel = new javax.swing.JLabel();
        imgIcon = new javax.swing.JLabel();
        profileBtn = new javax.swing.JButton();
        jLabel5 = new javax.swing.JLabel();
        jLabel6 = new javax.swing.JLabel();
        newPasswordField = new javax.swing.JPasswordField();
        jLabel7 = new javax.swing.JLabel();
        updatePasswordBtn = new javax.swing.JButton();

        setBackground(new java.awt.Color(204, 204, 204));
        setMaximumSize(new java.awt.Dimension(2560, 1440));
        setMinimumSize(new java.awt.Dimension(1280, 720));

        jLabel1.setFont(new java.awt.Font("Dialog", 1, 24)); // NOI18N
        jLabel1.setForeground(new java.awt.Color(0, 0, 0));
        jLabel1.setText("Quick Overview");

        shiftTable.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null}
            },
            new String [] {
                "Title 1", "Title 2", "Title 3", "Title 4"
            }
        ));
        jScrollPane1.setViewportView(shiftTable);

        jLabel2.setFont(new java.awt.Font("Dialog", 1, 18)); // NOI18N
        jLabel2.setText("Current Weeks Shifts");

        journeyTable.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null}
            },
            new String [] {
                "Title 1", "Title 2", "Title 3", "Title 4"
            }
        ));
        jScrollPane2.setViewportView(journeyTable);

        jLabel3.setFont(new java.awt.Font("Dialog", 1, 18)); // NOI18N
        jLabel3.setText("Current Train Journeys");

        jLabel4.setFont(new java.awt.Font("Dialog", 1, 18)); // NOI18N
        jLabel4.setText("Edit user profile:");

        nameLabel.setText("Please Login");

        IDlabel.setText("-------------------");

        imgIcon.setText("IMG");

        profileBtn.setText("New Profile Picture");
        profileBtn.setToolTipText("");

        jLabel5.setText("Your staff ID:");

        jLabel6.setText("Your username:");

        jLabel7.setText("New Password:");

        updatePasswordBtn.setText("Update Password");

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jLabel1)
                        .addContainerGap(1566, Short.MAX_VALUE))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                        .addGap(0, 0, Short.MAX_VALUE)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jLabel4)
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                    .addComponent(jLabel6, javax.swing.GroupLayout.DEFAULT_SIZE, 146, Short.MAX_VALUE)
                                    .addComponent(jLabel5, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                    .addComponent(jLabel7, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addComponent(nameLabel, javax.swing.GroupLayout.PREFERRED_SIZE, 224, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(IDlabel, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.PREFERRED_SIZE, 224, javax.swing.GroupLayout.PREFERRED_SIZE))
                                    .addComponent(newPasswordField, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(updatePasswordBtn, javax.swing.GroupLayout.PREFERRED_SIZE, 200, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(18, 18, 18)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(profileBtn, javax.swing.GroupLayout.PREFERRED_SIZE, 217, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(imgIcon, javax.swing.GroupLayout.PREFERRED_SIZE, 220, javax.swing.GroupLayout.PREFERRED_SIZE)))
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel3, javax.swing.GroupLayout.PREFERRED_SIZE, 368, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 772, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(56, 56, 56)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel2)
                                    .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 670, javax.swing.GroupLayout.PREFERRED_SIZE))))
                        .addGap(66, 66, 66))))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel1)
                .addGap(10, 10, 10)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jLabel2)
                        .addGap(18, 18, 18)
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 0, Short.MAX_VALUE))
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jLabel3)
                        .addGap(18, 18, 18)
                        .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 172, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addGap(67, 67, 67)
                .addComponent(jLabel4)
                .addGap(26, 26, 26)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jLabel6, javax.swing.GroupLayout.PREFERRED_SIZE, 43, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(18, 18, 18)
                                .addComponent(jLabel5, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(nameLabel, javax.swing.GroupLayout.PREFERRED_SIZE, 43, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addComponent(IDlabel, javax.swing.GroupLayout.PREFERRED_SIZE, 45, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addComponent(jLabel7, javax.swing.GroupLayout.PREFERRED_SIZE, 35, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(newPasswordField, javax.swing.GroupLayout.DEFAULT_SIZE, 41, Short.MAX_VALUE))
                        .addGap(6, 6, 6))
                    .addComponent(imgIcon, javax.swing.GroupLayout.PREFERRED_SIZE, 165, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(55, 55, 55)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(profileBtn, javax.swing.GroupLayout.PREFERRED_SIZE, 48, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(updatePasswordBtn, javax.swing.GroupLayout.PREFERRED_SIZE, 48, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addContainerGap(303, Short.MAX_VALUE))
        );
    }// </editor-fold>//GEN-END:initComponents


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel IDlabel;
    private javax.swing.JLabel imgIcon;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel6;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JScrollPane jScrollPane2;
    private javax.swing.JTable journeyTable;
    private javax.swing.JLabel nameLabel;
    protected javax.swing.JPasswordField newPasswordField;
    private javax.swing.JButton profileBtn;
    private javax.swing.JTable shiftTable;
    private javax.swing.JButton updatePasswordBtn;
    // End of variables declaration//GEN-END:variables
}
