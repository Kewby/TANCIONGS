/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Connection.DBIPAddress;
import Connection.JavaHTTPUrlConnectionReader;

/**
 *
 * @author allysha
 */
public class CashierPageController {
    
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    
    public void addChangeFund (float changefund, int empID){
        System.out.println(changefund + empID);
        System.out.println("EMPID: " + empID);
        System.out.println("Ok: Changefund");

        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/pos/addChangeFund.php?changefund="+changefund+"&empID="+empID+"";
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
    }
    
    
    


}

