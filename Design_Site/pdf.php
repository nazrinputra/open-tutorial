<?php
	require('FPDF/fpdf.php');
	
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	class PDF extends FPDF
	{
		// Page header
		function Header()
		{
			$this->Image('images/left-top.png',55,10,100);// Logo
			$this->SetFont('Helvetica','',15);// Arial bold 15
			$this->Ln(20);// Line break
			$this->Cell(45);// Move to the right
			$this->Cell(100,10,'Transactions History at OpenTutorial',1,10,'C');// Title
			$this->Ln(20);// Line break
		}

		// Page footer
		function Footer()
		{
			// Position at 1.5 cm from bottom
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Page number
			$this->Cell(0,10,'OpenTutorial 2014 | Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		
		function LoadData($file)
		{
			// Read file lines
			$lines = file($file);
			$data = array();
			foreach($lines as $line)
				$data[] = explode(';',trim($line));
			return $data;
		}
		
		// Colored table
		function FancyTable($header, $data)
		{
			// Colors, line width and bold font
			$this->SetFillColor(0,0,255);
			$this->SetTextColor(255);
			$this->SetDrawColor(0,0,128);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			// Header
			$w = array(40, 35, 40, 55);
			$this->Cell(10);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Data
			$fill = false;
			foreach($data as $row)
			{	
				$this->Cell(10);
				$this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
				$this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
				$this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
				$this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
				$this->Ln();
				$fill = !$fill;
			}
			// Closing line
			$this->Cell(10);
			$this->Cell(array_sum($w),0,'','T');
		}
		
		function PDF($orientation='P', $unit='mm', $size='A4')
		{
			// Call parent constructor
			$this->FPDF($orientation,$unit,$size);
			// Initialization
			$this->B = 0;
			$this->I = 0;
			$this->U = 0;
			$this->HREF = '';
		}
		
		function WriteHTML($html)
		{
			// HTML parser
			$html = str_replace("\n",' ',$html);
			$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
			foreach($a as $i=>$e)
			{
				if($i%2==0)
				{
					// Text
					if($this->HREF)
						$this->PutLink($this->HREF,$e);
					else
						$this->Write(5,$e);
				}
				else
				{
					// Tag
					if($e[0]=='/')
						$this->CloseTag(strtoupper(substr($e,1)));
					else
					{
						// Extract attributes
						$a2 = explode(' ',$e);
						$tag = strtoupper(array_shift($a2));
						$attr = array();
						foreach($a2 as $v)
						{
							if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
								$attr[strtoupper($a3[1])] = $a3[2];
						}
						$this->OpenTag($tag,$attr);
					}
				}
			}
		}

		function OpenTag($tag, $attr)
		{
			// Opening tag
			if($tag=='B' || $tag=='I' || $tag=='U')
				$this->SetStyle($tag,true);
			if($tag=='A')
				$this->HREF = $attr['HREF'];
			if($tag=='BR')
				$this->Ln(5);
		}

		function CloseTag($tag)
		{
			// Closing tag
			if($tag=='B' || $tag=='I' || $tag=='U')
				$this->SetStyle($tag,false);
			if($tag=='A')
				$this->HREF = '';
		}

		function SetStyle($tag, $enable)
		{
			// Modify style and select corresponding font
			$this->$tag += ($enable ? 1 : -1);
			$style = '';
			foreach(array('B', 'I', 'U') as $s)
			{
				if($this->$s>0)
					$style .= $s;
			}
			$this->SetFont('',$style);
		}

		function PutLink($URL, $txt)
		{
			// Put a hyperlink
			$this->SetTextColor(0,0,255);
			$this->SetStyle('U',true);
			$this->Write(5,$txt,$URL);
			$this->SetStyle('U',false);
			$this->SetTextColor(0);
		}
	}
	
	$realname=$row["Member_Name"];
	$email=$row["Member_Email"];
	$date=date("Y-m-d H:i:s");
	$html='       This is all of your transactions history listed in our database under your name.
	                              For more information, please visit our <a href="http://localhost/FYP/Design_Site/history.php">live history</a> page. 
	                                                             <i>Thank you for using <b>OpenTutorial</b></i>';
	
	$pdf = new PDF();
	$header = array('Title', 'Subject', 'Material' , 'Price');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$data = $pdf->LoadData('report.txt');
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(40,7,'Name: '.$realname,0,0);
	$pdf->Cell(80,7,'',0,0);
	$pdf->Cell(40,7,'Email: '.$email,0,0);
	$pdf->SetFont('Arial','B',16);
	$pdf->Ln(20);
	$pdf->FancyTable($header,$data);
	$pdf->Ln(70);
	$pdf->SetFontSize(14);
	$pdf->WriteHTML($html);
	$pdf->Ln(20);
	$pdf->SetFont('Arial','I',12);
	$pdf->SetLeftMargin(65);
	$pdf->Cell(40,7,'Last updated on: '.$date,0,0);
	$pdf->SetLeftMargin(0);
	$pdf->Output();
?>