import java.awt.*;
import java.awt.event.*;

import javax.swing.*;
import javax.swing.border.*;

import com.mysql.jdbc.PreparedStatement;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
public class Horror extends JFrame implements ActionListener {
	private JButton b1;
	private JButton b2;
	private JButton b3;
	private JButton b4;
	private JComboBox comboBoxName;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t4;
	private JTextField t5;
	private JTextField t6;
	private JTextField t7;
	private JTextField t8;
	private JTextField t;
	public void List(){
		try{
			Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","fllorina");
			 String query="select * from carti";
				PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
				ResultSet rs=stmt.executeQuery(query);
				
				while(rs.next()){
					if(rs.getString("categorie").equals("Horror"))
						comboBoxName.addItem(rs.getString("titlu"));
				}
		}catch(Exception ex){	
		}
	}
	public Horror(){
		setTitle( "Carti disponibile in categoria Horror" ); 
		setSize( 1200, 600 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
	}
	public void Componente(){
		comboBoxName=new JComboBox();
        b1=new JButton("Comanda");
        b1.addActionListener(this);
        b2=new JButton("Inchide");
        b2.addActionListener(this);
        b3=new JButton(">");
        b3.addActionListener(this);
        b4=new JButton("<");
        b4.addActionListener(this);
        JLabel label1=new JLabel("Titlu");
        JLabel label2=new JLabel("Autor");
        JLabel label3=new JLabel("Editura");
        JLabel label4=new JLabel("Pret");
        JLabel label5=new JLabel("An aparitie");
        JLabel label6=new JLabel("Numar pagini");
        JLabel label7=new JLabel("Format");
        JLabel label8=new JLabel("ID");
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
        p1.add(comboBoxName);
        p1.add(b4);
        p1.add(b3);
        p1.add(b1);
        p1.add(b2);
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
        p3.add(label9);
        p3.add(t);
        JScrollPane jsp=new JScrollPane(t);
        p3.add(jsp);
        p3.setLayout(new GridLayout(3,3));
        getContentPane().add(p1,BorderLayout.NORTH);
        getContentPane().add(p2,BorderLayout.WEST);
        getContentPane().add(p3,BorderLayout.CENTER);
        List();
        comboBoxName.addActionListener(new ActionListener(){
        	public void actionPerformed(ActionEvent e){
        		try{
        			Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","fllorina");
        			String query="select * from carti where titlu=?";
        			PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
        			stmt.setString(1,(String)comboBoxName.getSelectedItem());
        			ResultSet rs=stmt.executeQuery();
        			while(rs.next()){
        				if(comboBoxName.getSelectedItem().equals(rs.getString("titlu"))){
        					t1.setText(rs.getString("titlu"));
        					t2.setText(rs.getString("autor"));
        					t3.setText(rs.getString("editura"));
        					t4.setText(rs.getString("pret"));
        					t5.setText(rs.getString("an_aparitie"));
        					t6.setText(rs.getString("numar_pagini"));
        					t7.setText(rs.getString("format"));
        					t8.setText(rs.getString("ID"));
        					t.setText(rs.getString("prezentare"));
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
				 String query="INSERT INTO `biblioteca`.`comenzi` (`titlu`, `autor`, `pret`,`ID`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"
				 +t4.getText()+"','"+t8.getText()+"');";
				 Statement stmt=conn.createStatement();
				 stmt.executeUpdate(query);
				 JOptionPane.showMessageDialog(null,"Cartea a fost comandata");
				 						 } catch(Exception ex){
				 	JOptionPane.showMessageDialog(null,"Cartea nu a fost comandata");
				 							}					 
		 }
		 else
			 if( e.getSource() == b2 ){
				 this.dispose();
			 }  else
				 if( e.getSource() == b3 ){
					 try{
						 comboBoxName.setSelectedIndex(comboBoxName.getSelectedIndex()+1);
				 }catch(IllegalArgumentException s){}
				 }
				 else
					 if( e.getSource() == b4 ){
						 try{
							 comboBoxName.setSelectedIndex(comboBoxName.getSelectedIndex()-1);
					 }catch(IllegalArgumentException s){}
					 }
}
	}