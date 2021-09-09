<?php

	if(isset($_SERVER['REQUEST_METHOD']) && 'GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['reftoken'])){
		require_once('include/registration_funcs.php');
		// Include the main TCPDF library (search for installation path).
		require_once('libs/TCPDF/tcpdf_include.php');

		$ref_token = $_GET['reftoken'];

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("DSC'17");
		$pdf->SetTitle("DSC'17 Order #$ref_token");
		$pdf->SetSubject('');
		$pdf->SetKeywords('');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

		// set some text to print
		$html = getOrderDetailsPdf($ref_token);
		if(empty($html)){
			// receipe is only avaliable for those who had paid
			header("Location: registration.php");
		}

		// print a block of text using Write()
		//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		//Close and output PDF document
		ob_end_clean();
		$pdf->Output("dsc17_order_$ref_token.pdf", 'I');

		//============================================================+
		 // END OF FILE
		//============================================================+
	}
	else{
		header("Location: registration.php");
	}

?>
