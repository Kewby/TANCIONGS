/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Connection.DBIPAddress;
import Connection.DL_json;
import Connection.JavaHTTPUrlConnectionReader;
import java.io.IOException;

/**
 *
 * @author kirby
 */
public class StockDeliveryController {
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    public void getStock(){
        System.out.println("Start: View Stock");
        
        DL_json download = new DL_json();
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/stock/viewStock.php?";
        System.out.println("Ok: getStock");
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/stock/viewStock.json", "viewStock");
        }   catch (IOException ex) {
            
        }     
    }
    
    public void getDelivery(){
        System.out.println("Start: View Delivery");
        
        DL_json download = new DL_json();
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/delivery/viewDelivery.php?";
        System.out.println("Ok: getDelivery");
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/delivery/viewDelivery.json", "viewDelivery");
        }   catch (IOException ex) {
            
        }     
    }
}
