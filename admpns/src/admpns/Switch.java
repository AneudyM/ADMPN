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
public class Switch {
    private String hostname;
    private String link0;
    private String eth0;
    private String eth1;
    private String eth2;
    private String eth3;
    
    
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
    public void setEth2(String eth2){
        this.eth2 = eth2;
    }
    public String getEth2(){
        return this.eth2;
    }
    public void setEth3IP(String eth3){
        this.eth3 = eth3;
    }
    public String getEth3IP(){
        return this.eth3;
    }
    public void setLink0(String link0){
        this.link0 = link0;
    }
    public String getLink0(){
        return this.link0;
    }
    
    
}
