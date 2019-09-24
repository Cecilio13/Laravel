<?php
$cars = array("Volvo", "BMW", "Toyota");

?>


<html lang="en">
  <head>
    <script type="text/javascript" src="jszip.js"></script>
    <script type="text/javascript" src="FileSaver.js"></script>
    <script type="text/javascript" src="myexcel.js"></script>
	<script>
		function randomDate(start, end) {
			var d= new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
			return d;
		}
		
		function go(){
			
		    var excel = $JExcel.new("Calibri light 10 #333333");			// Default font
			
			// excel.set is the main function to generate content:
			// 		We can use parameter notation excel.set(sheetValue,columnValue,rowValue,cellValue,styleValue) 
			// 		Or object notation excel.set({sheet:sheetValue,column:columnValue,row:rowValue,value:cellValue,style:styleValue })
			// 		null or 0 are used as default values for undefined entries		
			
			excel.set( {sheet:0,value:"This is Sheet 1" } );
		    excel.addSheet("Sheet 2");
			
			
			excel.set(0,8,1,15);		
			excel.set(0,8,2,13);		
			excel.set(0,7,3,"15+13");		
			excel.set(0,8,3,"=I2+I3");		

				
			var evenRow=excel.addStyle ( { 																	// Style for even ROWS
				border: "none,none,none,thin #333333"});													// Borders are LEFT,RIGHT,TOP,BOTTOM. Check $JExcel.borderStyles for a list of valid border styles

			var oddRow=excel.addStyle ( { 																	// Style for odd ROWS
				fill: "#ECECEC" , 																			// Background color, plain #RRGGBB, there is a helper $JExcel.rgbToHex(r,g,b)
				border: "none,none,none,thin #333333"}); 
			
			
			for (var i=1;i<50;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });					// Set style for the first 50 rows
			excel.set({row:3,value: 30  });																	// We want ROW 3 to be EXTRA TALL
 
			var headers=["Header 0","Header 1","Header 2","Header 3","Header 4"];							// This array holds the HEADERS text
			var formatHeader=excel.addStyle ( { 															// Format for headers
					border: "none,none,none,thin #333333", 													// 		Border for header
					font: "Calibri 12 #0000AA B"}); 														// 		Font for headers

			for (var i=0;i<headers.length;i++){																// Loop all the haders
				excel.set(0,i,0,headers[i],formatHeader);													// Set CELL with header text, using header format
				excel.set(0,i,undefined,"auto");															// Set COLUMN width to auto (according to the standard this is only valid for numeric columns)
			}
			
			
			// Now let's write some data
			var initDate = new Date(2000, 0, 1);
			var endDate = new Date(2016, 0, 1);
			var dateStyle = excel.addStyle ( { 																// Format for date cells
					align: "R",																				// 		aligned to the RIGHT
					format: "yyyy.mm.dd hh:mm:ss", 															// 		using DATE mask, Check $JExcel.formats for built-in formats or provide your own 
					font: "#00AA00"}); 																		// 		in color green
			
			for (var i=1;i<50;i++){																			// we will fill the 50 rows
				excel.set(0,0,i,"This is line "+i);															// This column is a TEXT
				var d=randomDate(initDate,endDate);															// Get a random date
				excel.set(0,1,i,d.toLocaleString());														// Store the random date as STRING
				excel.set(0,2,i,$JExcel.toExcelLocalTime(d));												// Store the previous random date as a NUMERIC (there is also $JExcel.toExcelUTCTime)
				excel.set(0,3,i,$JExcel.toExcelLocalTime(d),dateStyle);										// Store the previous random date as a NUMERIC,  display using dateStyle format
				excel.set(0,4,i,"Some other text");															// Some other text
				}

			excel.set(0,1,undefined,30);																	// Set COLUMN 1 to 30 chars width
			excel.set(0,3,undefined,30);																	// Set COLUMN 3 to 20 chars width
			excel.set(0,4,undefined,20, excel.addStyle( {align:"R"}));										// Align column 4 to the right
			excel.set(0,1,3,undefined,excel.addStyle( {align:"L T"}));										// Align cell 1-3  to LEFT-TOP
			excel.set(0,2,3,undefined,excel.addStyle( {align:"C C"}));										// Align cell 2-3  to CENTER-CENTER
			excel.set(0,3,3,undefined,excel.addStyle( {align:"R B"}));										// Align cell 3-3  to RIGHT-BOTTOM
			
			<?php
			for($c=0;$c<count($cars);$c++){
			?>
			excel.set(1,0,<?php echo $c; ?>,'<?php echo $cars[$c]; ?>');
			<?php
			}
			?>
			
		    excel.generate("SampleData.xlsx");
			
		}
	</script>
  </head>
  <body>
	<a href="#" onclick="go();">GO</a>
  </body>
</html>
