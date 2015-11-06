/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package admpns;

/**
 *
 * @author flakoloko32
 */
public class Router {
    private String hostname;
    private String eth0;
    private String eth1;
    private String link0;
    private String link1;
    private String default_gateway;
      
    public void setHostname(String h){
        this.hostname = h;
    }
    public String getHostname(){
        return this.hostname;
    }    
    public void setEth0IP(String eth0){
        this.eth0 = eth0;
    }
    public String getEth0IP(){
        return this.eth0;
    }
    public void setEth1IP(String eth1){
        this.eth1 = eth1;
    }
    public String getEth1IP(){
        return this.eth1;
    }
    public void setLink0(String link0){
        this.link0 = link0;
    }
    public String getLink0(){
        return this.link0;
    }
    public void setLink1(String link1){
        this.link1 = link1;
    }
    public String getLink1(){
        return this.link1;
    }
    public void setGateway(String gw){
        this.default_gateway = gw;
    }
    public String getGateway(){
        return this.default_gateway;
    }
}
