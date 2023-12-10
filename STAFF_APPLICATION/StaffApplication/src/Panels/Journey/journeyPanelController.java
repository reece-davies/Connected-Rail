/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Journey;

import MainJFrame.mainJFrameView;
import java.awt.Font;
import java.awt.FontFormatException;
import java.awt.GraphicsEnvironment;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.IOException;
import java.util.Arrays;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.SwingUtilities;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;
import javax.swing.table.DefaultTableModel;

/**
 *
 * @author Joe This is the journey panel controller, it controls the interaction
 * between the journey view and model.
 */
public final class journeyPanelController {

    private final JourneyView theJView;
    private final journeyPanelModel theJModel;
    private mainJFrameView theView;

    public journeyPanelController(JourneyView theJView, journeyPanelModel theJModel) {
        this.theJView = theJView;
        this.theJModel = theJModel;
        this.setTableCall();
        this.setComboBoxes();
        //The table model has to be declared within the SwingUtilities
        // GUI elements can only be updated on the event dispatch thread
        //this thread is invoked via this immediately.
        SwingUtilities.invokeLater(() -> {
            DefaultTableModel journeyTableModel;

            String[] columnNames = {"ID", "Journey Cost", "Arrival Location ID", "Departure Location ID"};
            journeyTableModel = new DefaultTableModel(0, 0);
            journeyTableModel.setColumnIdentifiers(columnNames);
            theJView.JourneyTable.setDefaultEditor(Object.class, null);
            theJView.JourneyTable.setModel(journeyTableModel);
            //calls worker thread
            addTableRows(journeyTableModel);
        });

        this.theJView.addJourneyTableListener(new JourneyTableListener());
        this.theJView.addSearchListener(new SearchListener());
    }

    public void setTableCall() {
        //   this.theJModel.getTableDataThread(0);
        this.setTable(this.theJModel.getTableData());
    }

    public void setComboBoxes() {
        this.theJView.setComboBoxes(this.theJModel.getComboBoxJourneyID(), this.theJModel.getComboBoxArrivalID(), this.theJModel.getComboBoxDepartureID());
    }

    public JPanel getView() {
        return this.theJView;
    }

    public void setTable(String[][] data) {

        for (String[] data1 : data) {
            if (data1 == null) {
            } else {
                System.out.println(Arrays.toString(data1));
                theJView.JourneyTable.setRowHeight(30);
                //     journeyTableModel;
                ((DefaultTableModel) theJView.JourneyTable.getModel()).addRow(data1);
                // JourneyTable.revalidate();
            }
        }
    }

    public void updateTableLogic() {
        String jID = theJView.journeyIDCombo.getSelectedItem().toString();
        String arrID = theJView.arrivalLocationCombo.getSelectedItem().toString();
        String depID = theJView.departureLocationCombo.getSelectedItem().toString();
        ((DefaultTableModel) theJView.JourneyTable.getModel()).setRowCount(0);
        String[][] journey = theJModel.getTableData();
        String[][] journey2 = new String[journey.length][];

        //Combo box logic, with most likely choice first
        if (jID.equals("All") && arrID.equals("All") && depID.equals("All")) {
            setTable(journey);
            setComboBoxes();
        } else if (!jID.equals("All") && arrID.equals("All") && depID.equals("All")) {
            for (int i = 0; i < journey.length; i++) {
                if (journey[i][0].equals(jID)) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        } else if ((!jID.equals("All") && !arrID.equals("All") && depID.equals("All"))) {
            for (int i = 0; i < journey.length; i++) {
                if (journey[i][0].equals(jID) && (journey[i][2].equals(arrID))) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        } else if ((!jID.equals("All") && !arrID.equals("All") && !depID.equals("All"))) {
            for (int i = 0; i < journey.length; i++) {
                if (journey[i][0].equals(jID) && (journey[i][2].equals(arrID)) && (journey[i][3].equals(depID))) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        } else if ((jID.equals("All") && !arrID.equals("All") && depID.equals("All"))) {
            for (int i = 0; i < journey.length; i++) {
                if ((journey[i][2].equals(arrID))) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        } else if ((jID.equals("All") && !arrID.equals("All") && !depID.equals("All"))) {
            for (int i = 0; i < journey.length; i++) {
                if ((journey[i][2].equals(arrID)) && (journey[i][3].equals(depID))) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        } else if ((jID.equals("All") && arrID.equals("All") && !depID.equals("All"))) {
            for (int i = 0; i < journey.length; i++) {
                if ((journey[i][3].equals(depID))) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        } else if ((!jID.equals("All") && arrID.equals("All") && !depID.equals("All"))) {
            for (int i = 0; i < journey.length; i++) {
                if (journey[i][0].equals(jID) && (journey[i][3].equals(depID))) {
                    journey2[i] = journey[i];
                }
            }
            setTable(journey2);
        }
        //updates combo boxes after refresh
           
    }

    void addTableRows(DefaultTableModel model) {

        new Thread() {
            @Override
            public void run() {
                while (true) {
                    String jID = theJView.journeyIDCombo.getSelectedItem().toString();
                    String arrID = theJView.arrivalLocationCombo.getSelectedItem().toString();
                    String depID = theJView.departureLocationCombo.getSelectedItem().toString();
                    SwingUtilities.invokeLater(() -> {
                        //if true update table
                        //the method calls compared the displayed row count to the rows on the database, 
                        //if different then call update
                        if (theJModel.getTableDataThread(theJView.JourneyTable.getModel().getRowCount())) {  
                            if (jID.equals("All") && arrID.equals("All") && depID.equals("All")) {updateTableLogic();}
                                
                        }
                    });
                    try {
                        //This 1 second sleep is needed to allow the jtable to update in time, 
                        //also it stops constant pinging to the api which needlessly increases web traffic
                        Thread.sleep(1000);
                    } catch (InterruptedException e) {
                    }
                }
            }
        }.start();
    }

    protected class SearchListener implements ActionListener {

        @Override
        public void actionPerformed(ActionEvent e) {
            updateTableLogic();
        }
    }

    private class JourneyTableListener implements ListSelectionListener {

        @Override
        public void valueChanged(ListSelectionEvent e) {
            JTable bookingTable = new JTable();
            JTable platformTable = new JTable();
            try {
                //create the font to use. Specify the size!
                Font customFont = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Bold.ttf")).deriveFont(18f);
                Font customFont2 = Font.createFont(Font.TRUETYPE_FONT, new File("font\\Raleway-Regular.ttf")).deriveFont(14f);
                GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
                //register the font
                ge.registerFont(customFont);
                //Give elements the fonts
                bookingTable.getTableHeader().setFont(customFont);
                bookingTable.setFont(customFont2);
                platformTable.getTableHeader().setFont(customFont);
                platformTable.setFont(customFont2);
            } catch (IOException | FontFormatException e2) {
            }
            try {
                String id = theJView.JourneyTable.getValueAt(theJView.JourneyTable.getSelectedRow(), 0).toString();
                //Call api with id for more data
                String[][] temp = theJModel.getTrainBookings(id);
                String[][] Platform = new String[1][2];

                DefaultTableModel TableModel2 = new DefaultTableModel(0, 0);
                platformTable.setDefaultEditor(Object.class, null);
                String[] colsPlat = {"Depart Platform", "Arrive Platform"};
                TableModel2.setColumnIdentifiers(colsPlat);
                platformTable.setRowHeight(30);
                //for each loop to add platform data
                for (String[] temp1 : temp) {
                    if (temp1[0] != null) {
                        bookingTable.setRowHeight(30);
                        Platform[0][0] = temp1[5];
                        Platform[0][1] = temp1[6];

                        TableModel2.addRow(Platform[0]);
                        bookingTable.setRowHeight(30);
                        //break not ideal 
                        break;
                    } else {
                    }
                }
                platformTable.setModel(TableModel2);

                DefaultTableModel TableModel = new DefaultTableModel(0, 0);
                bookingTable.setDefaultEditor(Object.class, null);
                String[] cols = {"Seat #", "Depart date", "Time", "Arrive date", "Time"};
                TableModel.setColumnIdentifiers(cols);

                bookingTable.setModel(TableModel);

                // create a simple jpanel
                JPanel panel = new JPanel();
                panel.add(new JScrollPane(bookingTable));
                panel.add(new JScrollPane(platformTable));
                for (String[] temp1 : temp) {
                    if (temp1[0] != null) {
                        bookingTable.setRowHeight(30);
                        TableModel.addRow(temp1);
                        bookingTable.setRowHeight(30);
                    } else {
                    }
                }
                //if no data then display 'No data'
                if (TableModel.getRowCount() == 0) {
                    String[] noInfo = {"No data"};
                    TableModel.addRow(noInfo);
                }
                //Add panel to message diaglog
                bookingTable.setAutoResizeMode(JTable.AUTO_RESIZE_ALL_COLUMNS);
                JOptionPane.showMessageDialog(theView, panel, "For Journey: " + id, JOptionPane.PLAIN_MESSAGE);

            } catch (IOException | ArrayIndexOutOfBoundsException ex) {
                Logger.getLogger(journeyPanelController.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }
}
