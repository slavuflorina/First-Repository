package ip;

import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.WindowConstants;
import javax.swing.border.BevelBorder;
import javax.swing.border.EtchedBorder;





public class ip extends JFrame implements ActionListener{

	private JTextField t1;
	private JButton b1;
	private JButton b2;
	
	Connection conn;
	public ip()
	{
		
		setTitle("IP");
		setSize(500,120);
		setBackground(Color.GRAY);
		this.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE) ;
		Componente();
		
	}
	
	public void Componente()
	{
		t1=new JTextField(45);
		b1=new JButton("Cauta");
		b1.addActionListener(this);
		b2=new JButton("Iesire");
		b2.addActionListener(this);
		
		JPanel p=new JPanel();
		 p.setLayout(new GridLayout(18,2));
		 p.setBorder(new BevelBorder(EtchedBorder.RAISED));
		  p.add(t1);
		  p.add(b1);
		  p.add(b2);
		 
		  getContentPane().add(p,BorderLayout.NORTH);
		  
	}
	public void actionPerformed(ActionEvent e) {
		if(e.getSource()== b1 )
		{
			try {
				Connection conn=DriverManager.getConnection("jdbc:mysql://localhost/mydbs","root","madalina");
			String query="select * from `mydbs`.`ips` where `country`='"+t1.getText()+"';";
			Statement stmt=conn.createStatement();
			ResultSet rs=stmt.executeQuery(query);
				while(rs.next())
			JOptionPane.showMessageDialog(null,"Gasit");
				
			} catch (SQLException e1) {
				
				JOptionPane.showMessageDialog(null,"N a fost  gasit");
				t1.setText("");
			} }
			else if(e.getSource()== b2)
			{
				System.exit(0);
			}
				
			 
		
		
	}
	
	public static void main(String [] args){
		ip mainFrame = new ip(); 
		mainFrame.setVisible(true); 
	}

}
