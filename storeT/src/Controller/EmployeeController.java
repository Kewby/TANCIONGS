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
import javax.swing.JOptionPane;
/**
 *
 * @author kirby, allysha
 */
public class EmployeeController {
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    
    public void getEmployee(){
        System.out.println("Start: View Employee");
        DL_json download = new DL_json();
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/employee/viewEmployee.php?";
        System.out.println("Ok: getEmployee");
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
        
        try {
            download.downloadData("http://"+IP+"/TanciongStore_v2/phpFiles/employee/viewEmployee.json", "viewEmployee");
        }   catch (IOException ex) {
            
        }     
    }
    
    
    public void addEmployee(String firstname, String lastname, String username, String password, String email, String contactNumber, String tinNumber, String philHealth, String sssNumber, String address)throws UnsupportedEncodingException{
        System.out.println(firstname+","+lastname+","+username+","+password+","+email+","+contactNumber+","+tinNumber+","+philHealth+","+sssNumber+","+address);
        System.out.println("Ok: addEmployee");
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/employee/addEmployee.php?firstname="+URLEncoder.encode(firstname,"UTF-8")+""
                + "&lastname="+URLEncoder.encode(lastname,"UTF-8")+""
                + "&username="+URLEncoder.encode(username,"UTF-8")+"&password="+password+"&email="+URLEncoder.encode(email,"UTF-8")+""
                + "&contactNumber="+contactNumber+"&tinNumber="+tinNumber+""
                + "&philHealth="+philHealth+"&sssNumber="+sssNumber+"&address="+URLEncoder.encode(address,"UTF-8")+"";        
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
    }
    
    public void updateEmployee(int empID, String employeeFirstname, String employeeLastname, String employeeEmail, String employeeAddress, String employeeNumber, String employeeTin, String employeePhilhealth , String employeeSSS, String employeePassword, String employeeUsername)throws UnsupportedEncodingException {
        System.out.println(employeeFirstname+","+employeeLastname+","+employeeEmail+","+employeeAddress+","+employeeNumber+","+employeeTin+","+employeePhilhealth+","+employeeSSS+","+employeePassword+","+employeeUsername);
        System.out.println("Ok: updateEmployee");
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/employee/updateEmployee.php?empID="+empID+"&employeeFirstname="+URLEncoder.encode(employeeFirstname,"UTF-8")+""
                + "&employeeLastname="+URLEncoder.encode(employeeLastname,"UTF-8")+""
                + "&employeeUsername="+URLEncoder.encode(employeeUsername,"UTF-8")+""
                + "&employeeEmail="+URLEncoder.encode(employeeEmail,"UTF-8")+"&employeeAddress="+employeeAddress+"&employeeNumber="+URLEncoder.encode(employeeNumber,"UTF-8")+""
                + "&employeeTin="+employeeTin+"&employeePhilhealth="+employeePhilhealth+""
                + "&employeeSSS="+employeeSSS+"&employeePassword="+employeePassword+"";        
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);
    }
    
    public void deleteEmployee(int empID){
        System.out.println(empID);
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/employee/deleteEmployee.php?empID="+empID+"";
        new JavaHTTPUrlConnectionReader(myUrl);
        JOptionPane.showMessageDialog(null, "Deleted Employee");
    }
}