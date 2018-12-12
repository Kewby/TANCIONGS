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
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

/**
 *
 * @author kirby
 */
public class ProductController {
    
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    public void getProduct(){
        System.out.println("Start: View Product");
        
        DL_json download = new DL_json();
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/product/viewProduct.php?";
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/product/viewProduct.json", "viewProduct");
        }   catch (IOException ex) {
            
        }     
    }
    
    public void getCategories(){
        System.out.println("Fetching Categories");
        
        DL_json download = new DL_json();
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/category/category.php?";
        System.out.println("Got Categories!");
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/category/category.json", "category");
        }   catch (IOException ex) {
            
        }     
    }
    
    public void updateProduct(int prodID, String prodName, String prodStandard, String prodMarkup, String prodType, String prodCategory)throws UnsupportedEncodingException {
        System.out.println(prodName+","+prodStandard+","+prodMarkup+","+prodType+","+prodCategory);
        System.out.println("Ok: updateProduct");
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/employee/updateProduct.php?prodID="+prodID+"&prodName="+URLEncoder.encode(prodName,"UTF-8")+""
                + "&prodStandard="+URLEncoder.encode(prodStandard,"UTF-8")+""
                + "&prodMarkup="+URLEncoder.encode(prodMarkup,"UTF-8")+""
                + "&prodType="+URLEncoder.encode(prodType,"UTF-8")+"&prodCategory="+prodCategory+"";        
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
    }
    
    
}
