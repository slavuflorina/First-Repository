import java.awt.*;
import java.awt.event.*;
import java.io.File;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;

import javax.swing.*;
import javax.swing.border.*;
import javax.swing.event.DocumentEvent;

import com.mysql.jdbc.PreparedStatement;

import java.sql.Blob;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
public class Comenzi extends JFrame implements ActionListener{
	private JButton b1;
	private JButton b2;
	private JButton b4;
	private JButton b5;
	private JButton b6;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t5;
	private JTextField t6;
	private JComboBox comboBox;
	ResultSet rs;
	public void List(){
		try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
			 String query="select * from comenzi";
				PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
				ResultSet rs=stmt.executeQuery(query);
				while(rs.next()){
						comboBox.addItem(rs.getString("titlu"));
				}
		}catch(Exception ex){	
		}}
	public Comenzi(){
		setTitle( "Comenzi" ); 
		setSize( 1320, 600 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		b1=new JButton("Scoate din lista");
        b1.addActionListener(this);
        b2=new JButton("Iesire");
        b2.addActionListener(this);
        b4=new JButton(">");
        b4.addActionListener(this);
        b5=new JButton("<");
        b5.addActionListener(this);
        b6=new JButton("Finalizeaza comanda");
        b6.addActionListener(this);
        comboBox=new JComboBox();
        JLabel label1=new JLabel("Titlu");
        JLabel label2=new JLabel("Autor");
        JLabel label3=new JLabel("Pret");
        JLabel label5=new JLabel("Adresa");
        JLabel label6=new JLabel("Mod de livrare");
        JLabel label7=new JLabel("Metoda de plata");
        JLabel label8=new JLabel("Observatii livrare");
        JLabel label9=new JLabel("Cost transport  10 lei");
        t1=new JTextField(50);
        t2=new JTextField(50);
        t3=new JTextField(6);
        t5=new JTextField();
        t6=new JTextField();
        ButtonGroup g=new ButtonGroup();
        JRadioButton r1=new JRadioButton("Curier rapid");
        g.add(r1);
        JRadioButton r2=new JRadioButton("Ridicare personala(gratuit)");
        g.add(r2);
        ButtonGroup r=new ButtonGroup();
        JRadioButton r3=new JRadioButton("Numerar/Ramburs");
        r.add(r3);
        JRadioButton r4=new JRadioButton("Online cu card bancar");
        r.add(r4);
        JRadioButton r5=new JRadioButton("BRD Finance");
        r.add(r5);
        JRadioButton r6=new JRadioButton("STAR BT");
        r.add(r6);
        JRadioButton r7=new JRadioButton("Paypal");
        r.add(r7);
        JPanel p1=new JPanel();
        JPanel p2=new JPanel();
        JPanel p3=new JPanel();
        p1.setBackground(Color.blue);
        p1.add(comboBox);
        p1.add(b5);
        p1.add(b4);
        p1.add(b1);
        p1.add(b6);
        p1.add(b2);
        p2.add(label1);
        p2.add(t1);
        p2.add(label2);
        p2.add(t2);
        p2.add(label3);
        p2.add(t3);
        p3.setLayout(new GridLayout(14,2));
        p3.add(label5);
        p3.add(t5);
        p3.add(label6);
        p3.add(r1);
        p3.add(r2);
        p3.add(label7);
        p3.add(r3);
        p3.add(r4);
        p3.add(r5);
        p3.add(r6);
        p3.add(r7);
        p3.add(label8);
        p3.add(t6);
        p3.add(label9);
        getContentPane().add(p1,BorderLayout.NORTH);
        getContentPane().add(p2,BorderLayout.WEST);
        getContentPane().add(p3,BorderLayout.SOUTH);
        List();
        comboBox.addActionListener(new ActionListener(){
        	public void actionPerformed(ActionEvent e){
        		try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
        			String query="select * from comenzi where titlu=?";
        			PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
        			stmt.setString(1,(String)comboBox.getSelectedItem());
        			ResultSet rs=stmt.executeQuery();
        			while(rs.next()){
        				if(comboBox.getSelectedItem().equals(rs.getString("titlu"))){
        					t1.setText(rs.getString("titlu"));
        					t2.setText(rs.getString("autor"));
        					t3.setText(rs.getString("pret"));
        				}
        			}
        		}catch(Exception ex){
        		}
        	}
        });
	}
	public void actionPerformed(ActionEvent e) {
		 if( e.getSource() == b1 ){
			 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
		String query="DELETE FROM `biblioteca`.`comenzi` WHERE `titlu`='"+t1.getText()+"';";
				 						Statement stmt=conn.createStatement();
				 						stmt.executeUpdate(query);	
JOptionPane.showMessageDialog(null,"Cartea a fost scoasa din lista");}catch(Exception ex){
				 JOptionPane.showMessageDialog(null,"Cartea nu a fost scoasa din lista");
				 						}			 
		 }
			 else
				 if( e.getSource() == b2 ){
					 this.dispose();
				 }
				else
						 if( e.getSource() == b4 ){
							 try{
								 comboBox.setSelectedIndex(comboBox.getSelectedIndex()+1);
						 }catch(IllegalArgumentException s){}
						 }
						 else
							 if( e.getSource() == b5 ){
								 try{
									 comboBox.setSelectedIndex(comboBox.getSelectedIndex()-1);
							 }catch(IllegalArgumentException s){}
							 }
								 else
					if( e.getSource() == b6 ){
						JOptionPane.showMessageDialog(null,"Comanda a fost plasata");
					}}
}