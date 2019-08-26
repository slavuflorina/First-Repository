import java.awt.Color;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.Statement;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.WindowConstants;


public class Stergere extends JFrame implements ActionListener{
	private JButton b1;
	private JButton b2;
	private JTextField t;
	public Stergere(){
		setTitle( "Stergere" ); 
		setSize( 600, 200 ); 
		setBackground( Color.gray );  
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ; 
		Componente();
	}
	private void Componente() {
		b1=new JButton("Sterge film");
        b1.addActionListener(this);
        b2=new JButton("Iesire");
        b2.addActionListener(this);
        t=new JTextField(50);
        t.setToolTipText("Scrieti numele filmului pe care doriti sa-l stergeti. Se pot adauga 50 de caractere");
        JPanel p=new JPanel();
        p.add(t);
        p.add(b1);
        p.add(b2);
        getContentPane().add(p);
	}
	public void actionPerformed(ActionEvent e) {
		 if( e.getSource() == b1 ){
			 try{
				 Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/Filme","root","fllorina");
				 					 String query="DELETE FROM `filme`.`colectie personala de filme` WHERE `Nume`='"+t.getText()+"';";
				 						Statement stmt=conn.createStatement();
				 						stmt.executeUpdate(query);	
				 						JOptionPane.showMessageDialog(null,"Filmul a fost sters.");}catch(Exception ex){
				 							JOptionPane.showMessageDialog(null,"Filmul nu a fost sters. Eroare");
				 						}		
		 }else
			 if( e.getSource() == b2 ){
				 this.dispose();
}}}
