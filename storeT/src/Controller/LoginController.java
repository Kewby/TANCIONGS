/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Connection.DBIPAddress;
import Connection.DL_json;
import Connection.JavaHTTPUrlConnectionReader;
import java.io.FileReader;
import java.io.IOException;
import javax.swing.JOptionPane;
import org.json.*;
import org.json.simple.parser.JSONParser;

/**
 *
 * @author allysha, kirby
 */
public class LoginController {
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    public String username = null;
    public String password = null;
    
    public String getUsername(){
        return username;
    }
    public void setUsername(String username){
        this.username = username;
    }
    public String getPassword(){
        return password;
    }
    public void setPassword (String password){
        this.password = password;
    }
    
    public void phpLogin (String username, String password){
        System.out.println("Start: Login");
        
        DL_json download = new DL_json(); 
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/login.php?username="+username+"&password="+password+"";
        new JavaHTTPUrlConnectionReader(myUrl); 
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/login.json?", "login");
        } catch (IOException ex) {
            System.out.println("ERROR!");
        }
    }
    
    public int logindata(){
        String[] ret = new String[6];
        JSONArray array = null;
        JSONParser parser = new JSONParser();
        
        try{
            Object o = parser.parse(new FileReader("C:\\TANCIONGS\\login.json"));
            JSONObject json = new JSONObject(o.toString());
            System.out.println("JSON Object from File: ");
            System.out.println(json);
            array = json.getJSONArray("data");
            JSONObject newJson = array.getJSONObject(0);
            System.out.println("Employee ID Retrieved: ");
            System.out.println(newJson.get("employee_id"));
            return 1;
           
        }catch(Exception e){            
            e.printStackTrace();
            JOptionPane.showMessageDialog(null, "Invalid Username/Password",
                    "Login Error", JOptionPane.ERROR_MESSAGE);
            return 0;
        } 
    }
    
    public float computeTotalSales (int empID){ //add to transaction table
        
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/pos/computeTotalSales.php?empID="+empID+"";
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);  
        
        JOptionPane.showMessageDialog(null,"Purchase Succeeded.");
        return 1; 
    }
    
    
}
