using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.IO;
using System.Media;

namespace VSFM
{
    public partial class Form2 : Form
    {
        int contor;
        int i, n;
        int nr = 0;
        bool verifica = false;
        string cale = "C:\\VSFM\\Intrebari.txt";
        string[] ic = new string[200];
        string[] r1 = new string[30];
        string[] r2 = new string[30];
        string[] r3 = new string[30];
        string[] r4 = new string[30];
        string[] rc = new string[30];
        public Form2()
        {
            InitializeComponent();
            radioButton1.Checked = false;
            radioButton2.Checked = false;
            radioButton3.Checked = false;
            radioButton4.Checked = false;
            //     label4.Visible = false;
            using (StreamReader f = new StreamReader(Path.GetFullPath(cale)))
            {
                n = Int32.Parse(f.ReadLine());
                for (i = 1; i <= n; i++)
                {
                    ic[i] = f.ReadLine();
                    r1[i] = f.ReadLine();
                    r2[i] = f.ReadLine();
                    r3[i] = f.ReadLine();
                    r4[i] = f.ReadLine();
                    rc[i] = f.ReadLine();
                } f.Close();
            }
            contor = 88;
            timer1.Start();
           
            label4.Text = ic[1];
            radioButton1.Text = r1[1];
            radioButton2.Text = r2[1];
            radioButton3.Text = r3[1];
            radioButton4.Text = r4[1];
            i = 1; // prima intrebare
        }

        

        private void button2_Click(object sender, EventArgs e)
        {
            contor = 88;
            timer1.Start();
            if (verifica == false && i <= n)
            {
                if (radioButton1.Checked == true && r1[i] == rc[i])
                    nr = nr + 100;
                else
                    if (radioButton2.Checked == true && r2[i] == rc[i])
                        nr = nr + 100;
                    else
                        if (radioButton3.Checked == true && r3[i] == rc[i])
                            nr = nr + 100;
                        else
                            if (radioButton4.Checked == true && r4[i] == rc[i])
                                nr = nr + 100;
                i++;
                radioButton1.Checked = false;
                radioButton2.Checked = false;
                radioButton3.Checked = false;
                radioButton4.Checked = false;
            }
            textBox2.Text = nr.ToString();
            if (i <= n)
            {
                label4.Text = ic[i];
                radioButton1.Text = r1[i];
                radioButton2.Text = r2[i];
                radioButton3.Text = r3[i];
                radioButton4.Text = r4[i];
                radioButton1.Show();
                radioButton2.Show();
                radioButton3.Show();
                radioButton4.Show();
            }
            else
                if (nr == 1000)
                {
                    timer1.Stop();
                   
                    Form5 f = new Form5();
                    f.Show();
                    this.Hide();
                    textBox1.Text = contor.ToString();
                }
                else
                {
                    if (nr < 1000)
                    {
                        timer1.Stop();
                        MessageBox.Show("Sorry! Jocul s-a terminat. Nu ai ajuns miliardar!! ", "Mai incearca! ", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                        Form1 f = new Form1();
                        f.Show();
                        this.Hide();
                    } textBox1.Text = contor.ToString();
                }
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            contor--;
            if (contor == 0)
            {
                timer1.Stop();
                MessageBox.Show("Sorry! Timpul a expirat. Ai pierdut. ", "Nu esti miliardar :(", MessageBoxButtons.OK, MessageBoxIcon.Stop);
                Form1 f = new Form1();
                f.Show();
                this.Hide();
            } textBox1.Text = contor.ToString();
        }

        private void Form2_Load(object sender, EventArgs e)
        {
            System.Media.SoundPlayer player = new System.Media.SoundPlayer();
            player.SoundLocation = "C:\\VSFM\\Sunete\\Prison Break - Soundtrack.wav";
            player.Play();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if ( r1[i] != rc[i])
                radioButton1.Hide();
            else
                if (r2[i] != rc[i])
                    radioButton2.Hide();

                if ( r4[i] != rc[i]  )
                    radioButton4.Hide();
                else
                    if ( r3[i] != rc[i])
                        radioButton3.Hide();
            button1.Hide();
            contor = 88;
            timer1.Start();

        }

        private void button3_Click(object sender, EventArgs e)
        {
            timer1.Stop();
            MessageBox.Show( rc[i]," Publicul a votat.", MessageBoxButtons.OK   );
            button3.Hide();
            contor = 88;
            timer1.Start();

        }

        private void button4_Click(object sender, EventArgs e)
        {
            timer1.Stop();
            MessageBox.Show(rc[i], " Prietenul dvs. a ales.", MessageBoxButtons.OK);
            button4.Hide();
            contor = 88;
            timer1.Start();
        }

        private void label4_Click(object sender, EventArgs e)
        {

        }
    }
}
