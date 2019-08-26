/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package problemapartitii;
 
import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.ArrayList;
import java.util.List;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.WindowConstants;

public class PartitionSumSubsetProblem  extends JFrame implements ActionListener{
    String x=" ";
   JLabel jlabel= new JLabel("");
    JButton jbutton1;
    JLabel jlabelerror;   
    String text1="", text2="", text3="";
    JLabel jlabel1;  
    JLabel  jlabel2;
    JLabel  jlabel3;
    long timp1=0;
    PartitionSumSubsetProblem(){
         setLocationRelativeTo(null);
         setSize(300,300); 
	 setBackground(Color.gray);  
         this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ;       
         initilizare();
         
    }
    public void initilizare(){
      
        double timp1= System.currentTimeMillis();
        JPanel p=new JPanel(new GridLayout(0,1,20,20));
        jbutton1=new JButton("Partitioneaza");
        jbutton1.setBounds(30,50, 60, 40); 
        jbutton1.addActionListener(this);
        jlabelerror= new JLabel("");
        jlabelerror.setBounds(30, 100, 60, 30);
        jlabel1=new JLabel(text1);
        jlabel1.setBounds(30,100,60,30);
        jlabel2= new JLabel(text2);
        jlabel2.setBounds(30,130,60,30);
        jlabel3= new JLabel(x);
        jlabel3.setBounds(30,130,60,30);
        p.add(jbutton1);
        p.add(jlabel3);
        p.add(jlabel1);
        p.add(jlabel2);
        p.add(jlabelerror);  
        p.add(jlabel);
        getContentPane().add(p); 
        
    }
    @Override
    public void actionPerformed(ActionEvent e) {
        if(e.getSource()==jbutton1)
        try{ 
            Integer[] arr = new Integer[10];
            //Integer[] arr ={ 4,2,6,4,5 };
            for(int k=0;k<10;k++){
                double x=(Math.random()*9);
                arr[k]= (int)x;
            }
            for (Integer num : arr)
                {
                 x=x+" "+num + ", ";
                }
            jlabel3.setText(x);
            jlabel3.setVisible(true);
   
Integer[][] parts = partition(arr);
  if (parts == null)
  {
   jlabelerror.setText("partitionarea nu e posibila");
   jlabelerror.setVisible(true);
   jlabel1.setVisible(false);
   jlabel2.setVisible(false);
   
   System.out.println("the array is: "+ x);
   text1="";
   text2="";
   x="";
 
  } 
  else
  { 	jlabelerror.setVisible(false);
  	for (Integer num : parts[0])
  		text1=text1+""+num + ", ";
  	for (Integer num : parts[1])
   text2=text2+""+ num + ", ";
         
        jlabel1.setText(text1);
        jlabel2.setText(text2);
        jlabel1.setVisible(true);
        jlabel2.setVisible(true);
   
        System.out.println("the array is: "+ x);
        System.out.println("the 1 partition is: "+text1);
        System.out.println("the 2 partion is: "+ text2);
        text1="";
        text2="";
        x=""; }
        
       long timp2= System.currentTimeMillis()-timp1;
        jlabel.setText(timp2+" ");
        jlabel.setVisible(true);
        }  
       catch(NullPointerException ex){
           text1="";
        text2="";
        x="";
       double timp2= System.currentTimeMillis()-timp1;
        jlabel.setText(timp2+" ");
        jlabel.setVisible(true);
       } 
       }
       
             
 
 public static void main(String[] args)
 {
     
      PartitionSumSubsetProblem mainFrame = new PartitionSumSubsetProblem(); 
		 mainFrame.setVisible(true); 
                 
 }
   static Integer[][] partition(Integer[] arr)
 {
  List < Integer > list = new ArrayList < Integer >();
  List < Integer > part = new ArrayList < Integer >();

  int sum = 0;
  for (Integer num : arr)
  {
   list.add(num);
   sum += num;
  }
  if (sum % 2 == 1)
   return null;
  sum /= 2;
  int[][] memo = new int[arr.length + 1][sum + 1];
  for (int i = 1; i <= arr.length; ++i)
  {
   for (int s = 1; s <= sum; ++s)
   {
    if (arr[i - 1] > s
      || memo[i - 1][s] > arr[i - 1]
        + memo[i - 1][s - arr[i - 1]])
     memo[i][s] = memo[i - 1][s];
    else
    {
     memo[i][s] = arr[i - 1] + memo[i - 1][s - arr[i - 1]];
    }
   }
  }
  if (memo[arr.length][sum] != sum)
   return null;
  int i = arr.length;
  int s = sum;
  while (s > 0 && i > 0)
  {
   if (arr[i - 1] <= s
     && memo[i][s] == arr[i - 1] + memo[i - 1][s - arr[i - 1]])
   {
    part.add(arr[i - 1]);
    s = s - arr[i - 1];
   }
   i--;
  }
  for (Integer num : part)
   list.remove(num);
  Integer[][] result = new Integer[2][];
  result[0] = part.toArray(new Integer[] {});
  result[1] = list.toArray(new Integer[] {});
  return result;
 }
 

}
