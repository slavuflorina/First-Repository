using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Media;

namespace VSFM
{
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form1 form1 = new Form1(); form1.Show();
            this.Hide();
        }

        private void Form3_Load(object sender, EventArgs e)
        {
         //   System.Media.SoundPlayer player = new System.Media.SoundPlayer();
         //   player.SoundLocation = "C:\\VSFM\\Sunete\\Public.wav";
         //   player.Play();
        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }
    }
}
