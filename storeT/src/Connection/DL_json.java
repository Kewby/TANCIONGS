/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Connection;

import java.io.BufferedInputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.net.URL;
import java.nio.channels.Channels;
import java.nio.channels.ReadableByteChannel;

/**
 *
 * @author kirbyp, allyshas
 */
public class DL_json {
    
    public static void downloadData(String url, String responsible) throws IOException{
        String filePath = "C:\\TANCIONGS\\"+responsible+".json";
        File file = new File(filePath);
        File dir = new File("C:\\TANCIONGS");
        
        System.out.println(filePath);
            if (!dir.exists()) {
                if (dir.mkdir()) {
                    System.out.println("Directory is created!");
                }   else {
                        System.out.println("Failed to create directory!");
                    }
            }
            
            if (file.createNewFile()){
                System.out.println("File is created!");
            }   else {
                    System.out.println("File already exists.");
                }
            
            downloadUsingNIO(url,filePath);
            System.out.println("Downloading "+url+" |||| "+filePath);
            System.out.println("Download Complete!");
    }
    
    public void downloadUsingStream(String urlStr, String file) throws IOException{
        URL url = new URL(urlStr);
        BufferedInputStream bis = new BufferedInputStream(url.openStream());
        FileOutputStream fis = new FileOutputStream(file);
        byte[] buffer = new byte[1024];
        
        int count=0;
        while((count = bis.read(buffer,0,1024)) != -1) {
            fis.write(buffer, 0, count);
        }
        
        fis.close();
        bis.close();
    }
          
    public static void downloadUsingNIO(String urlStr, String file) throws IOException {
        URL url = new URL(urlStr);
        ReadableByteChannel rbc = Channels.newChannel(url.openStream());
        FileOutputStream fos = new FileOutputStream(file);
        fos.getChannel().transferFrom(rbc, 0, Long.MAX_VALUE);
        fos.close();
        rbc.close();
    }
    
    public static void main(String[] args) throws IOException{
     
    }
    
}