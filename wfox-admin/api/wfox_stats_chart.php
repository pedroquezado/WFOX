<?php
	function phpHtmlChart($paData, $piMaxSize = 100, $psMaxSizeUnit = 'px') {

		// Headers/scale
		$sHTML = '';
		$iMax = 0;
		for($iRow = 0; $iRow < sizeof($paData); $iRow++) {
			// Test for max...
			if($paData[$iRow][1] > $iMax) $iMax = $paData[$iRow][1];
		} // Rows in paData...

		$iScale = $iMax / $piMaxSize;
		
		// Ouput the rows
		for($iRow = 0; $iRow < sizeof($paData); $iRow++) {
			$iBarLength = $paData[$iRow][1] / $iScale;
			$sHTML .= "<li title=" . $paData[$iRow][0] . "><span style='height: $iBarLength$psMaxSizeUnit;'></span></li>";
		}
		return $sHTML;
	}
?>