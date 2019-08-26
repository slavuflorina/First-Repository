import java.awt.*;
import java.awt.event.*;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;

import javax.swing.*;
import javax.swing.border.*;

import com.mysql.jdbc.PreparedStatement;

import java.sql.Blob;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
public class Cauta extends JFrame implements ActionListener{
	private JButton b1;
	private JButton b2;
	private JButton b3;
	private JTextField tf;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t4;
	private JTextField t5;
	private JTextField t6;
	private JTextField t7;
	private JTextField t8;
	private JTextField t;
	private JComboBox combo;
	public Cauta(){
		setTitle( "Cautare dupa autor" ); 
		setSize( 1360, 600 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
		}
	public void Componente(){
		combo=new JComboBox();
		b1=new JButton("Cauta");
        b1.addActionListener(this);
        b2=new JButton("Resetare");
        b2.addActionListener(this);
        b3=new JButton("Inchide");
        b3.addActionListener(this);
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
        t=new JTextField();
        t1=new JTextField(50);
        t2=new JTextField(50);
        t3=new JTextField(50);
        t4=new JTextField(50);
        t5=new JTextField(50);
        t6=new JTextField(50);
        t7=new JTextField(50);
        t8=new JTextField(50); 
        JPanel p1=new JPanel();
        JPanel p2=new JPanel();
        JPanel p3=new JPanel();
        p1.setBackground(Color.blue);
        p1.add(tf);
        p1.add(b1);
        p1.add(combo);
        p1.add(b2);
        p1.add(b3);
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
        p3.add(label9);
        p3.add(t);
        JScrollPane jsp=new JScrollPane(t);
        p3.add(jsp);
        p3.setLayout(new GridLayout(3,3));
        getContentPane().add(p1,BorderLayout.NORTH);
        getContentPane().add(p2,BorderLayout.EAST);
        getContentPane().add(p3,BorderLayout.CENTER);
	}
	public void actionPerformed(ActionEvent e) {
		 if( e.getSource() == b1 ){
			 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
				 										 String query="select * from carti";
				 PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
				 					ResultSet rs=stmt.executeQuery(query);
				 					while(rs.next()){
				 			if(tf.getText().equals(rs.getString("autor")))
				 				combo.addItem(rs.getString("titlu"));
				 											}
				 									}catch(Exception ex){
				 									}
				 							 }
		 else
			 if( e.getSource() == b2 )
			 				 {
				 tf.setText("");
		    	 t1.setText("");
		    	 t2.setText("");
		    	 t3.setText("");
		    	 t4.setText("");
		    	 t5.setText("");
		    	 t6.setText("");
		    	 t7.setText("");
		    	 t8.setText("");
		    	 t.setText("");
		    	 combo.removeAllItems();
			 				 }
		 else
			 if( e.getSource() == b3 )
			 				 {
				 this.dispose();
			 				 }
		 combo.addActionListener(new ActionListener(){
	        	public void actionPerformed(ActionEvent e){
	        		try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
	        			String query="select * from carti where titlu=?";
	        			PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
	        			stmt.setString(1,(String)combo.getSelectedItem());
	        			ResultSet rs=stmt.executeQuery();
	        			while(rs.next()){
	        				if(combo.getSelectedItem().equals(rs.getString("titlu"))){
	        					t1.setText(rs.getString("titlu"));
	        					t2.setText(rs.getString("autor"));
	        					t3.setText(rs.getString("editura"));
	        					t4.setText(rs.getString("categorie"));
	        					t5.setText(rs.getString("pret"));
	        					t6.setText(rs.getString("an_aparitie"));
	        					t7.setText(rs.getString("numar_pagini"));
	        					t8.setText(rs.getString("format"));
	        					t.setText(rs.getString("prezentare"));
	        				}
	        			}
	        		}catch(Exception ex){
	        		}
	        	}
	        });
	}
}