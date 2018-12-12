/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Connection;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.Charset;

/**
 *
 * @author allysha, kirbyp
 */
public class JavaHTTPUrlConnectionReader {
    
    public JavaHTTPUrlConnectionReader(String URL) {
        try {
            String results = doHttpUrlConnectionAction(URL);
            System.out.println(results);
        }   catch (Exception e) {
                System.out.println("error");
            }
    }

    /**
     * NAME: doHttpUrlConnectionAction
     * PURPOSE: Creating URL connection Action.
     * PARAMETERS: String desiredURL
     * RETURN VALUE: String
     */
    
    private String doHttpUrlConnectionAction(String desiredUrl) throws Exception {
        URL url = null;
        BufferedReader reader = null;
        StringBuilder stringBuilder;
        
        try{
            url = new URL(desiredUrl);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("GET");
            connection.setReadTimeout(15*1000);
            connection.connect();

            reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            //reader = new BufferedReader(new InputStreamReader(((HttpURLConnection) (new URL(desiredUrl)).openConnection()).getInputStream(), Charset.forName("UTF-8")));
            stringBuilder = new StringBuilder();

            String line = null;
            while ((line = reader.readLine()) != null) {
                stringBuilder.append(line + "\n");
            }
            
            return stringBuilder.toString();
        }   catch (Exception e) {
                e.printStackTrace();
                throw e;
            }
        
        finally {
            if (reader != null) {
                try {
                    reader.close();
                }   catch (IOException ioe) {
                        ioe.printStackTrace();
                    }
            }
        }
    }
}