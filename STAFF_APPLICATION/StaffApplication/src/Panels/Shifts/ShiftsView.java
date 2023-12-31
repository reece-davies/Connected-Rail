/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Shifts;

import java.awt.Font;
import java.awt.FontFormatException;
import java.awt.Graphics;
import java.awt.GraphicsEnvironment;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import javax.imageio.ImageIO;
import javax.swing.DefaultComboBoxModel;
import javax.swing.table.DefaultTableModel;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public final class ShiftsView extends javax.swing.JPanel {

    protected user ShiftUser;
    private BufferedImage image;

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        g.drawImage(image, 0, 0, this); // see javadoc for more info on the parameters            
    }

    /**
     * Creates new form ShiftsView
     */
    public ShiftsView() {
        initComponents();
        try {
            image = ImageIO.read(new File("IMG\\background.png"));
        } catch (IOException ex) {
        }
        try {
            //font declaration
            Font customFont = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Bold.ttf")).deriveFont(24f);
            Font customFont2 = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Regular.ttf")).deriveFont(18f);
            GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
            //register the font
            ge.registerFont(customFont);
            jLabel1.setFont(customFont);
            jLabel2.setFont(customFont);
            shiftsTable.setFont(customFont2);
            shiftDateCombo.setFont(customFont);
            tableSearchBtn.setFont(customFont);
            shiftsTable.getTableHeader().setFont(customFont);

        } catch (IOException | FontFormatException e) {
        }

    }

    public void setUser(user User) {
        System.out.println("Shiftuser:" + ShiftUser);
        ShiftUser = User;
    }

    public user getShiftUser() {
        return ShiftUser;
    }

   

    public void setComboBoxes(List shiftID) {
        DefaultComboBoxModel modelShiftID = new DefaultComboBoxModel(shiftID.toArray());
        this.shiftDateCombo.setModel(modelShiftID);
    }

    void addSearchListener(ActionListener s) {
        this.tableSearchBtn.addActionListener(s);
    }

    /**
     * This method is called from within the constructor to initialise the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jScrollPane1 = new javax.swing.JScrollPane();
        shiftsTable = new javax.swing.JTable();
        jLabel1 = new javax.swing.JLabel();
        shiftDateCombo = new javax.swing.JComboBox<>();
        jLabel2 = new javax.swing.JLabel();
        tableSearchBtn = new javax.swing.JButton();

        shiftsTable.setModel(new javax.swing.table.DefaultTableModel(
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
        jScrollPane1.setViewportView(shiftsTable);

        jLabel1.setFont(new java.awt.Font("Dialog", 1, 14)); // NOI18N
        jLabel1.setText("Find a specific shift:");

        jLabel2.setText("Shift Day:");

        tableSearchBtn.setText("Search");

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(shiftDateCombo, 0, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jLabel1)
                            .addComponent(jLabel2, javax.swing.GroupLayout.PREFERRED_SIZE, 141, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(0, 191, Short.MAX_VALUE))
                    .addComponent(tableSearchBtn, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                .addGap(18, 18, 18)
                .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 1394, javax.swing.GroupLayout.PREFERRED_SIZE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel1)
                .addGap(18, 18, 18)
                .addComponent(jLabel2, javax.swing.GroupLayout.PREFERRED_SIZE, 32, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(18, 18, 18)
                .addComponent(shiftDateCombo, javax.swing.GroupLayout.PREFERRED_SIZE, 56, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(64, 64, 64)
                .addComponent(tableSearchBtn, javax.swing.GroupLayout.PREFERRED_SIZE, 66, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
            .addComponent(jScrollPane1, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.DEFAULT_SIZE, 950, Short.MAX_VALUE)
        );
    }// </editor-fold>//GEN-END:initComponents

    /**
     *
     * @param data
     * @param shiftTable
     * @param test
     */

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JScrollPane jScrollPane1;
    protected javax.swing.JComboBox<String> shiftDateCombo;
    protected javax.swing.JTable shiftsTable;
    private javax.swing.JButton tableSearchBtn;
    // End of variables declaration//GEN-END:variables
}
