/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Connection.DBIPAddress;
import Connection.DL_json;
import Connection.JavaHTTPUrlConnectionReader;
import View.UpdateSupplier;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.text.SimpleDateFormat;
import javax.swing.JOptionPane;
/**
 *
 * @author allysha
 */
public class SupplierController {
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    public void getSupplier (){
        System.out.println("Start: View Employee");
        DL_json download = new DL_json();
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/supplier/viewSupplier.php?";
        System.out.println("Ok: getSupplier");
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/supplier/viewSupplier.json", "viewSupplier");
        }   catch (IOException ex) {    
            }   
    }
    
    public void addSupplier (String supplierName, String supplierAddress, String supplierEmail, String supplierContactNumber, String supplierContactPerson) throws UnsupportedEncodingException{
        System.out.println(supplierName+", "+supplierAddress+", "+supplierEmail+", "+supplierContactNumber+", "+supplierContactPerson);        
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/supplier/addSupplier.php?supplierName="+URLEncoder.encode(supplierName,"UTF-8")+""
                + "&supplierAddress="+URLEncoder.encode(supplierAddress,"UTF-8")+""
                + "&supplierEmail="+URLEncoder.encode(supplierEmail,"UTF-8")+""
                + "&supplierContactNumber="+URLEncoder.encode(supplierContactNumber,"UTF-8")+""
                +"&supplierContactPerson="+URLEncoder.encode(supplierContactPerson,"UTF-8")+"";
        new JavaHTTPUrlConnectionReader(myUrl);
        JOptionPane.showMessageDialog(null, "Added Supplier");  
    }
    
    
    public void updateSupplier(int suppID, String supplierName,String supplierAddress,String supplierEmail,String supplierContactNumber,String supplierContactPerson)throws UnsupportedEncodingException{
        UpdateSupplier us = new UpdateSupplier();
        us.getSupplierId();
        System.out.println("SUPP ID: "+suppID);
        System.out.println(supplierName+", "+supplierAddress+", "+supplierEmail+", "+supplierContactNumber+", "+supplierContactPerson);
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/supplier/updateSupplier.php?suppID="+suppID+"&supplierName="+URLEncoder.encode(supplierName,"UTF-8")+""
                + "&supplierAddress="+URLEncoder.encode(supplierAddress,"UTF-8")+""
                + "&supplierEmail="+URLEncoder.encode(supplierEmail,"UTF-8")+""
                + "&supplierContactNumber="+supplierContactNumber+""
                +"&supplierContactPerson="+URLEncoder.encode(supplierContactPerson,"UTF-8")+""; 
        new JavaHTTPUrlConnectionReader(myUrl);
        JOptionPane.showMessageDialog(null, "Updated Supplier");
    }
    
    public void deleteSupplier(int suppID){
        System.out.println(suppID);
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/supplier/deleteSupplier.php?suppID="+suppID+"";
        new JavaHTTPUrlConnectionReader(myUrl);
        JOptionPane.showMessageDialog(null, "Deleted Supplier");
    }
    
    
}
