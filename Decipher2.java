import java.io.*;
import java.util.*;
class Decipher2
{
	public static void main(String args[])throws IOException
	{
		 FileReader in  = new FileReader("output2.txt");
		 FileWriter out = new FileWriter("decipheroutput.txt");
		 Scanner sc=new Scanner(System.in);		 
		 try 
		{	
			 int key=0,c=0;
			 System.out.println("\n\n--------------    Transposition Method (Deciphering Part )  --------------\n\n\n");
			 System.out.print("Enter The Key : ");
			 key=sc.nextInt();
			 
		     char[] input=new char[100];
			 char[][] CipherText = new char[100][100];
			 char[][] PlainText  = new char[100][100];
			int i=0,j=0;//For Looping 
			int len=0;
		     while ((c = in.read()) != -1) 
		     {				
					 input[len]=(char)c;
					 len++;
		     }
			 int temp=(len+1)/key;
			 int k=0;
			 for(i=0; i<key; i++)
			 {
				 for(j=0; j<temp; j++)
				 {
					 CipherText[i][j]=input[k];
					 k++;
				 }
			 }
			 for(i=0; i<temp; i++)
			 {
				 for(j=0; j<key; j++)
				 {
					 System.out.print(CipherText[j][i]);
					 out.write(CipherText[j][i]);
				 }
			 }
	    } 
		 finally 
		 {
		     if (in != null) 
		     {in.close();}
		     if (out != null) 
		     {out.close(); }
        }
	}

}
