import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.Statement;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.WindowConstants;
import javax.swing.event.DocumentEvent;
import javax.swing.text.Document;


public class Adaugare extends JFrame implements ActionListener{
	private JButton b1;
	private JButton b2;
	private JTextField t1;
	private JTextField t2;
	private JTextField t3;
	private JTextField t4;
	private JTextField t5;
	public Adaugare(){
		setTitle( "Adaugare" ); 
		setSize( 600, 400 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
		}
	private void Componente() {
		b1=new JButton("Adauga film");
        b1.addActionListener(this);
        b2=new JButton("Iesire");
        b2.addActionListener(this);
        JLabel label1=new JLabel("*Nume");
        JLabel label2=new JLabel("*Categorii");
        JLabel label3=new JLabel("Data lansarii (an-luna-zi)");
        JLabel label4=new JLabel("Rating");
        JLabel label5=new JLabel("*ID Imdb");
        t1=new JTextField(50);
        t1.setToolTipText("Se pot adauga 50 de caractere");
        t2=new JTextField(30);
        t2.setToolTipText("Se pot adauga 30 de caractere");
        t3=new JTextField();
        t4=new JTextField();
        t5=new JTextField(15);
        t5.setToolTipText("Se pot adauga 15 de caractere");
        JPanel p1=new JPanel();
        JPanel p2=new JPanel();
        p1.add(label1);
        p1.add(t1);
        p1.add(label2);
        p1.add(t2);
        p1.add(label3);
        p1.add(t3);
        p1.add(label4);
        p1.add(t4);
        p1.add(label5);
        p1.add(t5);
        p1.setLayout(new GridLayout(10,2));
        p2.add(b1);
        p2.add(b2);
        getContentPane().add(p1,BorderLayout.SOUTH);
        getContentPane().add(p2,BorderLayout.NORTH);
	}
	public void actionPerformed(ActionEvent e) {
		 if( e.getSource() == b1 ){
			 if(t4.getText().equals("")){
				 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/Filme","root","fllorina");
String query="INSERT INTO `filme`.`colectie personala de filme` (`Nume`, `Categorii`, `Data lansarii`, `ID Imdb`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"+t5.getText()+"');";
					 					Statement stmt=conn.createStatement();
					 					stmt.executeUpdate(query);
					 JOptionPane.showMessageDialog(null,"Filmul a fost adaugat.");
					 			 } catch(Exception ex){
					JOptionPane.showMessageDialog(null,"Filmul nu a fost adaugat. Eroare");
					 				}
			 }
				 else{
					 try{
Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/Filme","root","fllorina");
String query="INSERT INTO `filme`.`colectie personala de filme` (`Nume`, `Categorii`, `Data lansarii`, `Rating`, `ID Imdb`) VALUES ('"+t1.getText()+"','"+t2.getText()+"','"+t3.getText()+"','"+t4.getText()+"','"+t5.getText()+"');";
								Statement stmt=conn.createStatement();
												stmt.executeUpdate(query);
				 JOptionPane.showMessageDialog(null,"Filmul a fost adaugat.");
												 			 } catch(Exception ex){
				JOptionPane.showMessageDialog(null,"Filmul nu a fost adaugat. Eroare");
												 			 }	 				}
										 }		 
			 if( e.getSource() == b2 ){
				 this.dispose();
}}
}