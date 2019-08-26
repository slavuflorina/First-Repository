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
public class Reduceri extends JFrame implements ActionListener, DocumentListener{
	private JButton b1;
	private JButton b2;
	private JButton b3;
	private JButton b4;
	private JButton b5;
	private JButton b6;
	private JButton b7;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t4;
	private JTextField t5;
	private JTextField t6;
	private JTextField t7;
	private JTextField t8;
	private JComboBox comboBox;
	public void List(){
		try{
			Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
			 String query="select * from reduceri";
				PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
				ResultSet rs=stmt.executeQuery(query);	
				while(rs.next()){
						comboBox.addItem(rs.getString("titlu"));
				}
		}catch(Exception ex){	
		}
	}
	public Reduceri(){
		setTitle( "Reduceri" ); 
		setSize( 1000, 600 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
	}
	public void Componente(){
		comboBox=new JComboBox();
		 b1=new JButton("Adauga o carte noua");
	        b1.addActionListener(this);
	        b2=new JButton("Sterge");
	        b2.addActionListener(this);
	        b3=new JButton("Resetare");
	        b3.addActionListener(this);
	        b4=new JButton("Comanda");
	        b4.addActionListener(this);
	        b5=new JButton("Iesire");
	        b5.addActionListener(this);
	        b6=new JButton(">");
	        b6.addActionListener(this);
	        b7=new JButton("<");
	        b7.addActionListener(this);
	        JLabel label1=new JLabel("Titlu");
	        JLabel label2=new JLabel("Autor");
	        JLabel label3=new JLabel("Editura");
	        JLabel label4=new JLabel("Categorie");
	        JLabel label5=new JLabel("Pret");
	        JLabel label6=new JLabel("Reducere");
	        JLabel label7=new JLabel("Pret vechi");
	        JLabel label8=new JLabel("ID");
	        t1=new JTextField(50);
	        t2=new JTextField(50);
	        t3=new JTextField(30);
	        t4=new JTextField(20);
	        t5=new JTextField();
	        Document document=t5.getDocument();
	        document.addDocumentListener(this);
	        t6=new JTextField();
	        Document document1=t5.getDocument();
	        document1.addDocumentListener(this);
	        t7=new JTextField();
	        Document document2=t5.getDocument();
	        document2.addDocumentListener(this);
	        t8=new JTextField();
	        JPanel p1=new JPanel();
	        JPanel p2=new JPanel();
	        p1.setBackground(Color.blue);
	        p1.add(comboBox);
	        p1.add(b7);
	        p1.add(b6);
	        p1.add(b1);
	        p1.add(b2);
	        p1.add(b3);
	        p1.add(b4);
	        p1.add(b5);
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
	        getContentPane().add(p1,BorderLayout.NORTH);
	        getContentPane().add(p2,BorderLayout.WEST);
	        List();
	        comboBox.addActionListener(new ActionListener(){
	        	public void actionPerformed(ActionEvent e){
	        		try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
	        			String query="select * from reduceri where titlu=?";
	        			PreparedStatement stmt=(PreparedStatement) conn.prepareStatement(query);
	        			stmt.setString(1,(String)comboBox.getSelectedItem());
	        			ResultSet rs=stmt.executeQuery();
	        			while(rs.next()){
	        				if(comboBox.getSelectedItem().equals(rs.getString("titlu"))){
	        					t1.setText(rs.getString("titlu"));
	        					t2.setText(rs.getString("autor"));
	        					t3.setText(rs.getString("editura"));
	        					t4.setText(rs.getString("categorie"));
	        					t5.setText(rs.getString("pret"));
	        					t6.setText(rs.getString("reducere")+"%");
	        					t7.setText(rs.getString("pret_vechi"));
	        					t8.setText(rs.getString("ID"));
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
String query="INSERT INTO `biblioteca`.`reduceri` (`titlu`, `autor`, `editura`, `categorie`, `pret`, `reducere`, `pret_vechi`,`ID`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"
+t4.getText()+"','"+t5.getText()+"','"+t6.getText()+"','"+t7.getText()+"','"+t8.getText()+"');";
					Statement stmt=conn.createStatement();
					stmt.executeUpdate(query);
JOptionPane.showMessageDialog(null,"Carte adaugata.");
			 } catch(Exception ex){
				 JOptionPane.showMessageDialog(null,"Cartea nu a fost adaugata.");
				}
		 }
		 else
			 if( e.getSource() == b2 ){
				 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
				 String query="DELETE FROM `biblioteca`.`reduceri` WHERE `titlu`='"+t1.getText()+"';";
					Statement stmt=conn.createStatement();
					stmt.executeUpdate(query);	
					JOptionPane.showMessageDialog(null,"Date sterse");}catch(Exception ex){
						JOptionPane.showMessageDialog(null,"Datele nu au fost sterse");
					}
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
		 }
 else
 if( e.getSource() == b4 ){
	 try{
		 Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/biblioteca","root","flower");
		 String query="INSERT INTO `biblioteca`.`comenzi` (`titlu`, `autor`, `pret`,`ID`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"
		 +t5.getText()+"','"+t8.getText()+"');";
		 Statement stmt=conn.createStatement();
		 stmt.executeUpdate(query);
		 JOptionPane.showMessageDialog(null,"Cartea a fost comandata");
		 						 } catch(Exception ex){
		 							 JOptionPane.showMessageDialog(null,"Cartea nu a fost comandata. Cartea exista deja.");
		 							}			 
 }
 else
	 if( e.getSource() == b5 ){
		 this.dispose();
	 }
	 else
		 if( e.getSource() == b6 ){
			 try{
				 comboBox.setSelectedIndex(comboBox.getSelectedIndex()+1);
		 }catch(IllegalArgumentException s){}
		 }
		 else
			 if( e.getSource() == b7 ){
				 try{
					 comboBox.setSelectedIndex(comboBox.getSelectedIndex()-1);
			 }catch(IllegalArgumentException s){}
			 }
}
	@Override
	public void insertUpdate(DocumentEvent event) {
		String s1=t5.getText();
		String s2=t6.getText();
		String s3=t7.getText();
		String s4=t8.getText();
		try{
			float fValue=Float.parseFloat(s1);
			int iValue=Integer.parseInt(s2);
			float iValue1=Float.parseFloat(s3);
			int iValue2=Integer.parseInt(s4);
		}catch(NumberFormatException e){}
	}
	@Override
	public void changedUpdate(DocumentEvent arg0) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void removeUpdate(DocumentEvent arg0) {
		// TODO Auto-generated method stub
		
	}
}
