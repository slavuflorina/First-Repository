import java.awt.*;
import java.awt.event.*;
import java.awt.image.BufferedImage;
import java.awt.Color;
import java.awt.Image;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;

import javax.imageio.ImageIO;
import javax.swing.*;
import javax.swing.border.*;

import com.mysql.jdbc.PreparedStatement;

import java.sql.Blob;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
public class biblioteca extends JFrame implements ActionListener{
	private JButton b1;
	private JButton b2;
	private JButton b3;
	private JButton b4;
	private JButton b5;
	private JButton b6;
	private JButton b7;
	private JButton b8;
	private JButton b9;
	private JButton b10;
	private JButton b11;
	private JButton b12;
	private JButton b13;
	private JButton b14;
	private JButton b16;
	private JButton b17;
	private JTextField tf;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t4;
	private JTextField t5;
	private JTextField t6;
	private JTextField t7;
	private JTextField t8;
	private JTextField t9;
	private JTextField t;
	Connection conn;
	public biblioteca(){
		setTitle( "Biblioteca" ); 
		setSize( 1360, 600 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
		}
		public void Componente(){
	        b1=new JButton("Cautare dupa titlu");
	        b1.addActionListener(this);
	        b2=new JButton("Adaugare");
	        b2.addActionListener(this);
	        b3=new JButton("Resetare");
	        b3.addActionListener(this);
	        b4=new JButton("Stergere");
	        b4.addActionListener(this);
	        b5=new JButton("Comanda");
	        b5.addActionListener(this);
	        b6=new JButton("Comenzi efectuate");
	        b6.addActionListener(this);   
	        b7=new JButton("Inchide");
	        b7.addActionListener(this);
	        b8=new JButton("Aventura");
	        b8.addActionListener(this);
	        b9=new JButton("Biografii&Memorii");
	        b9.addActionListener(this);
	        b10=new JButton("Fictiune");
	        b10.addActionListener(this);
	        b11=new JButton("Horror");
	        b11.addActionListener(this);
	        b12=new JButton("Literatura romana");
	        b12.addActionListener(this);
	        b13=new JButton("Romantic");
	        b13.addActionListener(this);   
	        b14=new JButton("Thriller");
	        b14.addActionListener(this);
	        b16=new JButton("Reduceri");
	        b16.addActionListener(this);
	        b17=new JButton("Cauta dupa autor");
	        b17.addActionListener(this);
	        tf=new JTextField(50);
	        JLabel label1=new JLabel("Titlu");
	        JLabel label2=new JLabel("Autor");
	        JLabel label3=new JLabel("Editura");
	        JLabel label4=new JLabel("Categorie");
	        JLabel label5=new JLabel("Pret");
	        JLabel label6=new JLabel("An aparitie");
	        JLabel label7=new JLabel("Numar pagini");
	        JLabel label8=new JLabel("Format");
	        JLabel label9=new JLabel("Descriere");
	        JLabel label11=new JLabel("ID");
	        t=new JTextField();
	        t1=new JTextField(50);
	        t2=new JTextField(50);
	        t3=new JTextField(50);
	        t4=new JTextField(50);
	        t5=new JTextField(50);
	        t6=new JTextField(50);
	        t7=new JTextField(50);
	        t8=new JTextField(50); 
	        t9=new JTextField(50); 
	        JPanel p1=new JPanel();
	        JPanel p2=new JPanel();
	        JPanel p3=new JPanel();
	        JPanel p4=new JPanel();
	        p1.setBorder(new BevelBorder(EtchedBorder.RAISED));
	        p1.setBackground(Color.blue);
	        p1.add(tf);
	        p1.add(b1);
	        p1.add(b17);
	        p1.add(b2);
	        p1.add(b3);
	        p1.add(b4);
	        p1.add(b7);
	        p2.setLayout(new GridLayout(18,2));
	        p2.add(label1);
	        p2.add(t1);
	        p2.add(label2);
	        p2.add(t2);
	        p2.add(label3);
	        p2.add(t3);
	        p2.add(label4);
	        p2.add(t4);
	        p2.add(label5);
	        p2.add(t5);
	        p2.add(label6);
	        p2.add(t6);
	        p2.add(label7);
	        p2.add(t7);
	        p2.add(label8);
	        p2.add(t8);
	        p2.add(label11);
	        p2.add(t9);
	       p3.add(label9);
	        p3.add(t);
	        JScrollPane jsp=new JScrollPane(t);
	        p3.add(jsp);
	        p3.setLayout(new GridLayout(3,3));
	        p4.setBackground(Color.blue);
	        p4.add(b5);
	        p4.add(b6);
	        p4.add(b16);
	        p4.add(b8);
	        p4.add(b9);
	        p4.add(b10);
	        p4.add(b11);
	        p4.add(b12);
	        p4.add(b13);
	        p4.add(b14);
	        getContentPane().add(p1,BorderLayout.NORTH);
	        getContentPane().add(p2,BorderLayout.EAST);
	        getContentPane().add(p3,BorderLayout.CENTER);
	        getContentPane().add(p4,BorderLayout.SOUTH);
	        
}
		
		@Override
		public void actionPerformed(ActionEvent e) {
			 if( e.getSource() == b1 )
			 {try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","fllorina");
				 String query="select * from carti where `titlu`='"+tf.getText()+"';";
					Statement stmt=conn.createStatement();
					ResultSet rs=stmt.executeQuery(query);
					while(rs.next()){
						{t1.setText(rs.getString("titlu"));
						t2.setText(rs.getString("autor"));
						t3.setText(rs.getString("editura"));
						t4.setText(rs.getString("categorie"));
						t5.setText(rs.getString("pret"));
						t6.setText(rs.getString("an_aparitie"));
						t7.setText(rs.getString("numar_pagini"));
						t8.setText(rs.getString("format"));
						t9.setText(rs.getString("ID"));
						t.setText(rs.getString("prezentare"));
						}
					}}
			 catch(Exception ex){
					}
			 }
			 else
if( e.getSource() == b2 )
				 {
					Adaugare ad=new Adaugare();
					ad.show();
}
			 else
			     if( e.getSource() == b3 ){
			    	 tf.setText("");
			    	 t1.setText("");
			    	 t2.setText("");
			    	 t3.setText("");
			    	 t4.setText("");
			    	 t5.setText("");
			    	 t6.setText("");
			    	 t7.setText("");
			    	 t8.setText("");
			    	 t9.setText("");
			    	 t.setText("");
					 }
		     else
				 if( e.getSource() == b4 ){
					 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
					 String query="DELETE FROM `biblioteca`.`carti` WHERE `titlu`='"+tf.getText()+"';";
						Statement stmt=conn.createStatement();
						stmt.executeUpdate(query);	
						JOptionPane.showMessageDialog(null,"Date sterse");}catch(Exception ex){
							JOptionPane.showMessageDialog(null,"Datele nu au fost sterse");
						}
				 }
				 else
					 if( e.getSource() == b5 ){
						 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`comenzi` (`titlu`, `autor`, `pret`,`ID`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"
+t5.getText()+"','"+t9.getText()+"');";
Statement stmt=conn.createStatement();
stmt.executeUpdate(query);
JOptionPane.showMessageDialog(null,"Cartea a fost comandata");
						 } catch(Exception ex){
							 JOptionPane.showMessageDialog(null,"Cartea nu a fost comandata");
							}
					 }
					 else
						 if( e.getSource() == b6 ){
							 Comenzi comanda=new Comenzi();
							comanda.show();
						 }
			 else
				 if( e.getSource() == b7 ){
					 System.exit(0);
							 }
			 else
				 if( e.getSource() == b8 ){
					 Aventura a=new Aventura();
					 a.show();
							 }
			 else
				 if( e.getSource() == b9 ){
					 Biografii b=new Biografii();
					 b.show();
							 }
			 else
				 if( e.getSource() == b10 ){
					 Fictiune f=new Fictiune();
					 f.show();
								}
			 else
				 if( e.getSource() == b11 ){
					 Horror h=new Horror();
					 h.show();
								 }
			 else
				 if( e.getSource() == b12 ){
					 Literatura_romana l=new Literatura_romana();
					 l.show();
								}
			 else
				 if( e.getSource() == b13 ){
					 Romantic r=new Romantic();
					 r.show();
								 }
			 else
				 if( e.getSource() == b14 ){
					 Thriller t=new Thriller();
					 t.show();
								 }
					 else
						 if( e.getSource() == b16 ){
							 Reduceri r=new Reduceri();
							 r.show();
						 }
						 else
							 if( e.getSource() == b17 ){
								 Cauta s=new Cauta();
								 s.show();}
	}
		/* try{
			  Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/Filme","root","fllorina");
		 // System.out.println("Connection success");
		  String query="SELECT * FROM filme.`colectie personala de filme`";
		  Statement stmt=conn.createStatement();
		  ResultSet rs=stmt.executeQuery(query);
		  while(rs.next()){System.out.println("Nume: "+rs.getString("Nume")+" Categorii: "+rs.getString("Categorii"));
		  }
		  } catch(Exception e){
			  System.err.println(e);
	}   } */
public static void main(String [] args){
	biblioteca mainFrame = new biblioteca(); 
	mainFrame.setVisible(true); 
}
}