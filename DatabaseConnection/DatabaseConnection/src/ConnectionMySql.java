import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.sql.Connection;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.WindowConstants;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;
import javax.swing.text.Document;

import net.proteanit.sql.DbUtils;

import com.mysql.jdbc.PreparedStatement;


public class ConnectionMySql extends JFrame implements ActionListener{
	private JButton b1;
	private JButton b2;
	private JButton b3;
	private JButton b4;
	public ConnectionMySql(){
		setTitle( "Filme" ); 
		setSize( 600, 200 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
	}
	public void Componente(){
		b1=new JButton("Adauga film");
        b1.addActionListener(this);
        b2=new JButton("Sterge film");
        b2.addActionListener(this);
        b3=new JButton("Iesire");
        b3.addActionListener(this);
        b4=new JButton("Salvare filme in fisier");
        b4.addActionListener(this);
        JPanel p=new JPanel();
        p.add(b1);
        p.add(b2);
        p.add(b3);
        p.add(b4);
        getContentPane().add(p,BorderLayout.NORTH);
	}
	public void actionPerformed(ActionEvent e) {
		 if( e.getSource() == b1 ){
			 Adaugare ad=new Adaugare();
				ad.show();
		 }else
			 if( e.getSource() == b2 ){
				 Stergere ad=new Stergere();
					ad.show();
		 }else
			 if( e.getSource() == b3 ){
				 System.exit(0);
		 }
			 else
				 if( e.getSource() == b4 ){
					}
				
	} 
  public static void main(String[] args ){
	  ConnectionMySql mainFrame = new ConnectionMySql(); 
		mainFrame.setVisible(true); 
  }
	 }
