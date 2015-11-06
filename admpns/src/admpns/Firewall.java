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
public class Firewall {
    private String hostname;
    private String ip_address;
    private String netmask;
    private String default_gateway;
    
    // set the hostname of the Firewall
    public void setHostname(String h){
        this.hostname = h;
    }
    // retrieve the hostname of the Firewall
    public String getHostname(){
        return this.hostname;
    }
    // set the IP of the Firewall
    public void setIP(String ip){
        this.ip_address = ip;
    }
    // retrieve the IP of the Firewall
    public String getIP(){
        return this.ip_address;
    }
    // set the network mask
    public void setNetmask(String mask){
        this.netmask = mask;
    }
    // retrieve the network mask
    public String getNetmask(){
        return this.netmask;
    }
    // set the default-gateway
    public void setGateway(String gw){
        this.default_gateway = gw;
    }
    // retrieve the default-gateway
    public String getGateway(){
        return this.default_gateway;
    }
}
