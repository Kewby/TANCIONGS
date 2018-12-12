/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Connection;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

/**
 *
 * @author kirbyp
 */
public class DBIPAddress {
    
    public String getIP(){
        String ret=null;
        
        /*
            get IP.txt from java file and paste it in your C drive
            then replace the IP into your computer's IP
        */
        
        String FILENAME = "C:\\IP.txt";
        try (BufferedReader br = new BufferedReader(new FileReader(FILENAME))) {
            String sCurrentLine;
            while ((sCurrentLine = br.readLine()) != null) {
                ret = sCurrentLine;
            }
        }   catch (IOException e) {
                e.printStackTrace();
            }
        System.out.println("IP address: "+ ret);
        return ret;
    }
  
    public static void main(String[] args) throws IOException{
        DBIPAddress dbip  = new DBIPAddress();
        System.out.println(dbip.getIP());
    }
    
}
