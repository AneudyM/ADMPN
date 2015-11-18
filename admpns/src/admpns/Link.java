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
public class Link {
    /* Member fields */
    private int nodeA;
    private int nodeB;
    private boolean up;
    
    /** Constructor **/
    public Link(int nodeA, int nodeB){
        this.nodeA = nodeA;
        this.nodeB = nodeB;
        up = true;
    }
    
    public final int getEndpointA(){
        return nodeA;
    }
    public final int getEndpointB(){
        return nodeB;
    }
    public final boolean isUp(){
        return up;
    }
    public final void up(){
        up = true;
    }
    public final void down(){
        up = false;
    }
    
    public final int getDest(int addr){
        if(addr == nodeA)
            return nodeB;
        else if(addr == nodeB)
            return nodeA;
        else
            return -1;
    }
    
    
    
    
    
}
