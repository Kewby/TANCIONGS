/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Connection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
/**
 *
 * @author allysha
 */
public class MyConn {
    
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    Connection conn = null; 
    String username = "root";
    String password = "";
    

    public void initialize() throws SQLException{
         
        try {
            Class.forName("com.mysql.jdbc.Driver");
        }   catch (ClassNotFoundException ex) {
                System.out.println("ERROR");
            }
        
        //conn  = (Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/tanciongs",
        conn  = (Connection) DriverManager.getConnection("http://"+IP+"/TanciongStore/php/connection.php?username="+username+"&password="+password+"",
                username, password);
    }
    
}
