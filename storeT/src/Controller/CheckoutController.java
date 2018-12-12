/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Connection.DBIPAddress;
import Connection.JavaHTTPUrlConnectionReader;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;
/**
 *
 * @author allysha
 */
public class CheckoutController {
   
    DBIPAddress dbip = new DBIPAddress();
    String IP = dbip.getIP();
    JFrame frame = new JFrame();
  
    public class TransItem{
        int transId;
        int transQty;
        int prodId; 
        float unitprice;
        float subtotal; 
        
        
        public int getTransId() {
            return transId;
        }

        public void setTransId(int transId) {
            this.transId = transId;
        }

        public int getTransQty() {
            return transQty;
        }

        public void setTransQty(int transQty) {
            this.transQty = transQty;
        }

        public int getProdId() {
            return prodId;
        }

        public void setProdId(int prodId) {
            this.prodId = prodId;
        }

        public float getUnitprice() {
            return unitprice;
        }

        public void setUnitprice(float unitprice) {
            this.unitprice = unitprice;
        }

        public float getSubtotal() {
            return subtotal;
        }

        public void setSubtotal(float subtotal) {
            this.subtotal = subtotal;
        }   
    }
    
    public int addToTransaction (float totalTender, float totalChange, int empID, float totalPurchase){ //add to transaction table
        System.out.println(totalTender + totalChange + empID + totalPurchase);
        System.out.println("TENDER: " + totalTender);
        System.out.println("CHANGE: " + totalChange);
        System.out.println("EMP ID: " + empID);
        System.out.println("TOTAL PURCHASE: " + totalPurchase);
        
        String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/pos/addToTransaction.php?totalTender="+totalTender+"&totalChange="+totalChange+"&empID="+empID+"&totalPurchase="+totalPurchase+"";
        new JavaHTTPUrlConnectionReader(myUrl);
        System.out.println(myUrl);  
        
        JOptionPane.showMessageDialog(frame,"Purchase Succeeded.");
        return 1; 
    }
  
   
    public void addItems(int indx,DefaultTableModel model){ //add to transactionitem table
       TransItem[] trans = new TransItem[100];
       int i = 0;
       System.out.println("OK transaction"+indx);
       for(i=0; i<model.getRowCount();i++){
           trans[i] = new TransItem();
           trans[i].setProdId(Integer.parseInt(String.valueOf(model.getValueAt(i,0))));
           trans[i].setTransId(indx);
           trans[i].setTransQty(Integer.parseInt(String.valueOf(model.getValueAt(i, 2))));
           trans[i].setUnitprice(Float.parseFloat(String.valueOf(model.getValueAt(i,3))));
           trans[i].setSubtotal(Float.parseFloat(String.valueOf(model.getValueAt(i,4))));

            String myUrl = "http://"+IP+"/TanciongStore_v2/phpFiles/pos/addItem.php?transID="+indx+"&prodID="+trans[i].prodId+""
                + "&transQty="+trans[i].transQty+"&unitprice="+trans[i].unitprice+"&subtotal="+trans[i].subtotal+"";
            new JavaHTTPUrlConnectionReader(myUrl);
            System.out.println(myUrl);
       }
   }


}
