/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

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
public class myModel extends dbModel{
    
    private int sales_id; 
    private int employee_id;
    private float changefund;
    private float total_sales;
    
    static int transaction_id;
    private float transaction_grandtotal;
    private float transaction_tender;
    private float transaction_change;
    
    private int transactionItem_id;
    private int product_id;
    private int transactionItem_qty;
    private float transactionItem_unitprice;
    private float transactionItem_subtotal;
    

    private String product_code;
    private String product_name;
    private int product_type;
    private int category_id; 
    private float standard_cost;
    private float markup_cost;
    private float list_price;
    private int branch_id;
    private int deleteStatus;
    
    
    JFrame frame = new JFrame();
    
    public int checkDate(){
        Statement st;
        int ret = 0;
        ResultSet rs = null;
        this.initialize();
        
        String str = "SELECT COUNT(*) AS total FROM `sales` WHERE DATE_FORMAT(sales_datetime, '%y-%m-%d') = DATE_FORMAT(CURRENT_TIMESTAMP, '%y-%m-%d') ";
        System.out.println(str);
        
        try{
            st = conn.createStatement();     
            rs = st.executeQuery(str);
            while(rs.next()){
                ret = rs.getInt("total");
           }
        }   catch(SQLException ex){
          
            }
      
        System.out.println(ret);
        return ret;
    }
    
    public int getLastRowId(){ 
        Statement st;
        int ret  = 0;
        this.initialize();
        
        String str = "SELECT * FROM `transaction`";
        
        try{
            st = conn.createStatement();
            ResultSet rs = st.executeQuery(str);
            rs.last();
            ret = rs.getInt("transaction_id");
            System.out.println("This is transaction id");
        }   catch(Exception e){
            
            }
        return ret;
    }
    
    public ResultSet search(long id){ //cashier page input product code search bar
        Statement st;
        ResultSet ret = null;
        this.initialize();
        
        String str = "SELECT * FROM `product` WHERE product_code ="+id+" LIMIT 1";
        
        try{
            st = conn.createStatement();
            ResultSet rs = st.executeQuery(str);
            
            if(rs.isBeforeFirst()){
                rs.next();
            }   else if(!rs.isBeforeFirst()){
                    JOptionPane.showMessageDialog(frame,"The Product Code does not exist.");
                }
            return rs;   
        }   catch(SQLException ex){
                return ret;        
            }
    }
    
    
    
    public int addTotalSales(int id,float totalSales){ //adds the total sales of the employee for the day every time the employee will log out
         Statement st;
        ResultSet rs = null;
        int ret = 0,count;
        this.initialize();
        count = checkDateAndFund(id);
        if(count==0){
            String str = "INSERT INTO `sales` (`sales_id`, `sales_datetime`,`employee_id` ,`total_sales`) VALUES (NULL, CURRENT_TIMESTAMP,'"+id+"',  '"+totalSales+"')";
             try{
                st = conn.createStatement();
                ret = st.executeUpdate(str);
            } catch (SQLException ex){
                Logger.getLogger(myModel.class.getName()).log(Level.SEVERE, null, ex);
            }
        }else{
            String str = "UPDATE `sales` SET `total_sales` = '"+totalSales+"' WHERE employee_id='"+id+"'AND "
                    + "DATE_FORMAT(sales_datetime, '%y-%m-%d') = DATE_FORMAT(CURRENT_TIMESTAMP, '%y-%m-%d')";
            
            try{
                st = conn.createStatement();
                ret = st.executeUpdate(str);
            } catch (SQLException ex){
                Logger.getLogger(myModel.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
  
        return ret;
    }
    
    public int checkDateAndFund(int id){ //checks if the changefund was inputted for the day
      Statement st;
      int ret = 0;
      ResultSet rs = null;
      this.initialize();
        
       String str = "SELECT COUNT(*) AS total FROM `sales` WHERE DATE_FORMAT(sales_datetime, '%y-%m-%d') = DATE_FORMAT(CURRENT_TIMESTAMP, '%y-%m-%d')"
               + "AND changefund=0 AND employee_id='"+id+"'";
      System.out.println(str);
      try{
           st = conn.createStatement();     
           rs = st.executeQuery(str);
           while(rs.next()){
               ret = rs.getInt("total");
           }
      }catch(SQLException ex){
          
      }
      
      System.out.println(ret);
      return ret;
    }
    
    
    public float computeTotalSales(int id){ //computes the total sales of the employee
        Statement st;
        ResultSet rs = null;
        float ret = 0;
        this.initialize();
        
        String str = "SELECT `transaction_grandtotal` FROM `transaction` WHERE employee_id= '"+id+"'"
                + " AND DATE_FORMAT(transaction_datetime, '%y-%m-%d') = DATE_FORMAT(CURRENT_TIMESTAMP, '%y-%m-%d') ";
         try{
         st = conn.createStatement();
             rs = st.executeQuery(str);
         while(rs.next()){
             ret += rs.getFloat("transaction_grandtotal");
         }
        
        }catch(Exception e){
            
        }
        
        return ret;
    }
    
    public int getSales_id(){
        return sales_id;
    }
    
    public void setSales_id(int sales_id){
        this.sales_id = sales_id;
    }
    
    public int getEmployee_id(){
        return employee_id;
    }
    
    public void setEmployee_id(int employee_id){
        this.employee_id = employee_id;
    }
    
    public float getChangefund(){
        return changefund;
    }
    
    public void setChangefund(float changefund){
        this.changefund = changefund;
    }
    
    public float getTotal_sales(){
        return total_sales;
    }
    
    public void setTotal_sales(float total_sales){
        this.total_sales = total_sales;
    }
    
    public int getProduct_id() {
        return product_id;
    }

    public void setProduct_id(int product_id) {
        this.product_id = product_id;
    }
    
     public String getProduct_code() {
        return product_code;
    }

    public void setProduct_code(String product_code) {
        this.product_code = product_code;
    }
    
    public String getProduct_name() {
        return product_name;
    }

    public void setProduct_name(String product_name) {
        this.product_name = product_name;
    }
    
    public int getProduct_type(){
        return product_type;
    }
    
    public void setProduct_type(int product_type){
        this.product_type = product_type;
    }
    
    public int getProduct_category() {
        return category_id;
    }

    public void setProduct_category(int category_id) {
        this.category_id = category_id;
    }
    
    public float getStandard_cost() {
        return standard_cost;
    }

    public void setStandard_cost(float standard_cost) {
        this.standard_cost = standard_cost;
    }
    
    public float getMarkup_cost() {
        return markup_cost;
    }

    public void setMarkup_cost(float markup_cost) {
        this.markup_cost = markup_cost;
    }
    
    public int getBranch_id() {
        return branch_id;
    }

    public void setBranch_id(int product_id) {
        this.branch_id = product_id;
    }
    
    
    
    public float getTransaction_total(){
        return transaction_grandtotal;
    }
    
    public void setTransaction_total(float transaction_grandtotal){
        this.transaction_grandtotal = transaction_grandtotal;
    }
    
    public float getTransaction_tender(){
        return transaction_tender;
    }
    
    public void setTransaction_tender(float transaction_tender){
        this.transaction_tender = transaction_tender;
    }
    
    public float getTransaction_change(){
        return transaction_change;
    }
    
    public void setTransaction_change(float transaction_change){
        this.transaction_change = transaction_change;
    }
    
    
    public int getTransactionItem_id(){
       return transactionItem_id;
    }
    
    public void setTransactionItem_id(int transactionItem_id){
        this.transactionItem_qty = transactionItem_id;
    }
    
    
    public void setProduct_code(int product_id){
        this.product_id = product_id;
    }
    
    public int getTransactionItem_qty(){
        return transactionItem_qty;
    }
    
    public void setTransactionItem_qty(int transactionItem_qty){
        this.transactionItem_qty = transactionItem_qty;
    }
    
    public float getTransactionItem_unitprice(){
        return transactionItem_unitprice;
    }
    
    public void setTransactionItem_unitprice(float transactionItem_unitprice){
        this.transactionItem_unitprice = transactionItem_unitprice;
    }
    
    public float getTransactionItem_subtotal(){
        return transactionItem_subtotal;
    }
    
    public void setTransactionItem_subtotal(float transactionItem_subtotal){
        this.transactionItem_subtotal = transactionItem_subtotal;
    }
    
}
