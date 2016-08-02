import java.util.*;
import java.io.*;


class Encipher
{
	public static void main(String[] args)throws IOException
	{
		 FileReader in  = new FileReader("input2.txt");
		 FileWriter out = new FileWriter("output2.txt");
		 Scanner sc=new Scanner(System.in);
		 try 
		 {	
			 int key=0,len=0;
			 System.out.println("Enter The Key : ");
			 key=sc.nextInt();
			
			 len=key+1;
		     char[][] PlainText  = new char[100][key];
			 char[][] CipherText = new char[100][100];

			 int c=0,i=0,j=0;//For Looping 
		     while ((c = in.read()) != -1) 
		     {				
					 PlainText[i][j]=(char)c;
					 j++;
					 if(j==key)
					 {
						 i++;
						 j=0;
					 }
		     }
			 for(int k=0; k<key; k++)
			 {
				 for(int l=0; l<i; l++)
				 {
					 CipherText[k][l]=PlainText[l][k];
					 out.write(CipherText[k][l]);
				 }
			 }
		 } 
		 finally 
		 {
		     if (in != null) 
		     { in.close();}
		     if (out != null) 
		     { out.close();}
         }
	}

}
