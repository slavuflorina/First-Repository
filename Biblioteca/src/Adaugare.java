import java.awt.*;
import java.awt.event.*;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.InputStream;

import javax.swing.*;
import javax.swing.border.*;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import javax.swing.filechooser.FileNameExtensionFilter;
import javax.swing.text.Document;

import com.mysql.jdbc.PreparedStatement;

import java.sql.Blob;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
public class Adaugare extends JFrame implements ActionListener, DocumentListener{
	private JButton b1;
	private JButton b3;
	private JButton b4;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t4;
	private JTextField t5;
	private JTextField t6;
	private JTextField t7;
	private JTextField t8;
	private JTextField t;
	String s;
	public Adaugare(){
		setTitle( "Adaugare" ); 
		setSize( 1000, 600 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
	}
	public void Componente(){
		    b1=new JButton("Adauga");
	        b1.addActionListener(this);
	        b3=new JButton("Resetare");
	        b3.addActionListener(this);
	        b4=new JButton("Iesire");
	        b4.addActionListener(this);
	        JLabel label1=new JLabel("*Titlu");
	        JLabel label2=new JLabel("*Autor");
	        JLabel label3=new JLabel("*Editura");
	        JLabel label4=new JLabel("*Categorie");
	        JLabel label5=new JLabel("*Pret");
	        JLabel label6=new JLabel("An aparitie");
	        JLabel label7=new JLabel("*Numar pagini");
	        JLabel label8=new JLabel("Format");
	        JLabel label9=new JLabel("Descriere");
	        t=new JTextField(1000);
	        t.setToolTipText("Se pot adauga 1000 de caractere");
	        t1=new JTextField(50);
	        t1.setToolTipText("Se pot adauga 50 de caractere");
	        t2=new JTextField(50);
	        t2.setToolTipText("Se pot adauga 50 de caractere");
	        t3=new JTextField(30);
	        t3.setToolTipText("Se pot adauga 30 de caractere");
	        t4=new JTextField(20);
	        t4.setToolTipText("Se pot adauga 20 de caractere");
	        t5=new JTextField();
	        Document document=t5.getDocument();
	        document.addDocumentListener(this);
	        t6=new JTextField();
	        Document document1=t5.getDocument();
	        document1.addDocumentListener(this);
	        t7=new JTextField();
	        Document document2=t5.getDocument();
	        document2.addDocumentListener(this);
	        t8=new JTextField(7); 
	        t8.setToolTipText("Se pot adauga 7 caractere");
	        JPanel p1=new JPanel();
	        JPanel p2=new JPanel();
	        JPanel p3=new JPanel();
	        p1.setBackground(Color.blue);
	        p1.add(b1);
	        p1.add(b3);
	        p1.add(b4);
	        p2.setLayout(new GridLayout(16,2));
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
	        p3.add(label9);
	        p3.add(t);
	        JScrollPane jsp=new JScrollPane(t);
	        p3.add(jsp);
	        p3.setLayout(new GridLayout(3,3));
	        getContentPane().add(p1,BorderLayout.NORTH);
	        getContentPane().add(p2,BorderLayout.WEST);
	        getContentPane().add(p3,BorderLayout.CENTER);
	}
	public void actionPerformed(ActionEvent e) {
		 if( e.getSource() == b1 ){
			 if(t6.getText().equals("")){
				 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `numar_pagini`, `format`, `prezentare`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
					 +t4.getText()+"','"+t5.getText()+"','"+t7.getText()+"','"+t8.getText()+"','"+t.getText()+"');";
					 					Statement stmt=conn.createStatement();
					 					stmt.executeUpdate(query);
					 JOptionPane.showMessageDialog(null,"Carte adaugata");
					 			 } catch(Exception ex){
					JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
					 				}
			 }else
			 if(t8.getText().equals(""))
			 {
			 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `an_aparitie`, `numar_pagini`, `prezentare`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
+t4.getText()+"','"+t5.getText()+"','"+t6.getText()+"','"+t7.getText()+"','"+t.getText()+"');";
					Statement stmt=conn.createStatement();
					stmt.executeUpdate(query);
JOptionPane.showMessageDialog(null,"Carte adaugata");
			 } catch(Exception ex){
				 JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
				}}
			 else
				 if(t.getText().equals(""))
			 {
					 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `an_aparitie`, `numar_pagini`, `format`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
						 +t4.getText()+"','"+t5.getText()+"','"+t6.getText()+"','"+t7.getText()+"','"+t8.getText()+"');";
						 					Statement stmt=conn.createStatement();
						 					stmt.executeUpdate(query);
						 JOptionPane.showMessageDialog(null,"Carte adaugata");
						 			 } catch(Exception ex){
	JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
						 				}				 
			 }else
			if(t6.getText().equals("") && t8.getText().equals("") && t.getText().equals("")){
				 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `numar_pagini`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
					+t4.getText()+"','"+t5.getText()+"','"+t7.getText()+"');";
					 						 Statement stmt=conn.createStatement();
					 						 	stmt.executeUpdate(query);
					 	JOptionPane.showMessageDialog(null,"Carte adaugata");
					 						 			 } catch(Exception ex){
					 	JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
					 						 				}				 		
				 }else
if(t6.getText().equals("") && t8.getText().equals("")){
	try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `numar_pagini`,`prezentare`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
+t4.getText()+"','"+t5.getText()+"','"+t7.getText()+"','"+t.getText()+"');";
							  Statement stmt=conn.createStatement();
							 		stmt.executeUpdate(query);
			JOptionPane.showMessageDialog(null,"Carte adaugata");
							 				 } catch(Exception ex){
JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
							 						 				}	
}else
	if(t6.getText().equals("") && t.getText().equals("")){
		try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `numar_pagini`,`format`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
+t4.getText()+"','"+t5.getText()+"','"+t7.getText()+"','"+t8.getText()+"');";
						Statement stmt=conn.createStatement();
					stmt.executeUpdate(query);
			JOptionPane.showMessageDialog(null,"Carte adaugata");
								 		 } catch(Exception ex){
		JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
								 		}	}
		else
			if(t8.getText().equals("") && t.getText().equals("")){
				try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`,`an_aparitie` ,`numar_pagini`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
+t4.getText()+"','"+t5.getText()+"','"+t6.getText()+"','"+t7.getText()+"');";
					Statement stmt=conn.createStatement();
										 stmt.executeUpdate(query);
			JOptionPane.showMessageDialog(null,"Carte adaugata");
									 } catch(Exception ex){
		JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
										 }}	
				else{
					try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
String query="INSERT INTO `biblioteca`.`carti` (`titlu`, `autor`, `editura`, `categorie`, `pret`,`an_aparitie` ,`numar_pagini`,`format`,`prezentare`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
+t4.getText()+"','"+t5.getText()+"','"+t6.getText()+"','"+t7.getText()+"','"+t.getText()+"','"+t.getText()+"');";
			Statement stmt=conn.createStatement();
				stmt.executeUpdate(query);
					JOptionPane.showMessageDialog(null,"Carte adaugata");
									} catch(Exception ex){
			JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
										}}
		 }
			 
			 else
 if( e.getSource() == b3 ){
	 t1.setText("");
	 t2.setText("");
	 t3.setText("");
	 t4.setText("");
	 t5.setText("");
	 t6.setText("");
	 t7.setText("");
	 t8.setText("");
	 t.setText(""); 
		 }
 else
 if( e.getSource() == b4 ){
	 this.dispose();
 }
}
	@Override
	public void changedUpdate(DocumentEvent arg0) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void insertUpdate(DocumentEvent event) {
		String s1=t5.getText();
		String s2=t6.getText();
		String s3=t7.getText();
		try{
			float fValue=Float.parseFloat(s1);
			int iValue=Integer.parseInt(s2);
			int iValue1=Integer.parseInt(s3);
		}catch(NumberFormatException e){}
	}
	@Override
	public void removeUpdate(DocumentEvent event) {
		
	}
}
