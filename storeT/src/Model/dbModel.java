/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JFrame;
import javax.swing.JOptionPane;

/**
 *
 * @author allysha
 */
public class dbModel {
    
    Connection conn = null; 
    String username = "root";
    String password = "";

    
    public void initialize () { //localhost database
        
        try {
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException ex) {
            System.out.println("ERROR");
        }
        
        try {
            conn  = (Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/finaltanciongs", 
                    username, password);
        } catch (SQLException ex) {
            Logger.getLogger(dbModel.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
