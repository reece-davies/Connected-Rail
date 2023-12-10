/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Panels.Shifts;

import Panels.DashBoard.DashBoardView;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JPanel;
import javax.swing.SwingUtilities;
import javax.swing.table.DefaultTableModel;
import staffapplication.user;

/**
 *
 * @author Joe
 */
public final class shiftsPanelController {

    //other views needs to be declared to send data to them (dash/overview)
    private final ShiftsView theSView;
    private final shiftsPanelModel theSModel;
    private final DashBoardView theDView;
    
    public shiftsPanelController(ShiftsView theSView, shiftsPanelModel theSModel, DashBoardView theDView) {
        
        this.theSView = theSView;
        this.theSModel = theSModel;
        this.theDView = theDView;
        this.theSView.addSearchListener(new SearchListener());
        SwingUtilities.invokeLater(() -> {
            DefaultTableModel shiftTableModel;
            String[] columnNames = {"Shift ID", "Journey ID", "dep", "arrive"};
            shiftTableModel = new DefaultTableModel(0, 0);
            shiftTableModel.setColumnIdentifiers(columnNames);
            theSView.shiftsTable.setDefaultEditor(Object.class, null);
            theSView.shiftsTable.setModel(shiftTableModel);
            
        });
    }
    
    public JPanel getView() {
        
        return this.theSView;
    }
    
    public void setTableData(String[][] rowData) {
        ((DefaultTableModel) theSView.shiftsTable.getModel()).setRowCount(0);
        List combo = new ArrayList();
        combo.add("All");
        theDView.setShiftTable(rowData);
//Checks if null, adds to table if isnt.
        for (String[] rowData1 : rowData) {
            if (rowData1[0] == null) {
            } else {
                combo.add(rowData1[2]);
                ((DefaultTableModel) theSView.shiftsTable.getModel()).addRow(rowData1);
                theSView.shiftsTable.setRowHeight(30);
            }
        }
        theSView.setComboBoxes(combo);
        //Start the thread
        addShiftTableRows( ((DefaultTableModel) theSView.shiftsTable.getModel()));
    }
    
    public void setTable2(String[][] rowData) {
  
        ((DefaultTableModel) theSView.shiftsTable.getModel()).setRowCount(0);
        
        for (String[] rowData1 : rowData) {
            if (rowData1 == null) {
            } else {
                ((DefaultTableModel) theSView.shiftsTable.getModel()).addRow(rowData1);
                theSView.shiftsTable.setRowHeight(30);
            }
        }
    }
    
    public void setTable(user User) {
//inital table data set
        System.out.println("User: " + User);
        String id = User.getID();
        try {
            this.setTableData(this.theSModel.getShiftTableData(id));
            this.theDView.setShiftTable(this.theSModel.getShiftTableData(id));
        } catch (IOException ex) {
            Logger.getLogger(shiftsPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    void addShiftTableRows(DefaultTableModel model) {
        
        new Thread() {
            @Override
            public void run() {
                while (true) {
                    
                    SwingUtilities.invokeLater(() -> {
                        //if true update table
                        //the method calls compared the displayed row count to the rows on the database, 
                        //if different then call update
                        user User = theSView.getShiftUser();
                        String id = User.getID();
                        try {
                            if (theSModel.getShiftTableDataThread(id, theSView.shiftsTable.getModel().getRowCount())) {
                                
                                try {
                                    String depID = theSView.shiftDateCombo.getSelectedItem().toString();
                                    ((DefaultTableModel) theSView.shiftsTable.getModel()).setRowCount(0);
                                    String[][] shift = theSModel.getShiftTableData(id);
                                    String[][] shift2 = new String[shift.length][];
                                    
                                    if (!depID.equals("All")) {
                                        for (int i = 0; i < shift.length; i++) {
                                            
                                            if (shift[i][2] == null) {
                                            } else if (shift[i][2].equals(depID)) {
                                                shift2[i] = shift[i];
                                            }
                                        }
                                        setTable2(shift2);
                                    } else {
                                        setTableData(shift);
                                    }
                                } catch (IOException ex) {
                                    Logger.getLogger(shiftsPanelController.class.getName()).log(Level.SEVERE, null, ex);
                                }
                                
                            }
                        } catch (IOException ex) {
                            Logger.getLogger(shiftsPanelController.class.getName()).log(Level.SEVERE, null, ex);
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
    
    private class SearchListener implements ActionListener {
        
        @Override
        public void actionPerformed(ActionEvent e) {
            user User = theSView.getShiftUser();
            String id = User.getID();
            try {
                String depID = theSView.shiftDateCombo.getSelectedItem().toString();
                ((DefaultTableModel) theSView.shiftsTable.getModel()).setRowCount(0);
                String[][] shift = theSModel.getShiftTableData(id);
                String[][] shift2 = new String[shift.length][];
                
                if (!depID.equals("All")) {
                    for (int i = 0; i < shift.length; i++) {
                        
                        if (shift[i][2] == null) {
                        } else if (shift[i][2].equals(depID)) {
                            shift2[i] = shift[i];
                        }
                    }
                    setTable2(shift2);
                } else {
                    setTableData(shift);
                }
            } catch (IOException ex) {
                Logger.getLogger(shiftsPanelController.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }
}
