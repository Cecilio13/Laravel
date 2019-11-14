<script>
function alphaOnly(evt) {
 var charCode = (evt.which) ? evt.which : event.keyCode
 console.log(charCode);
 if (charCode < 65 && charCode > 32 )
	return false;
 return true;
}
function limit(element)
{
	var max_chars = 5;
	if(element.innerHTML.length > max_chars) {
		element.innerHTML = element.innerHTML.substr(0, max_chars);
	}
}
function capitalize(s){
	return s.toLowerCase().replace( /\b./g, function(a){ return a.toUpperCase(); } );
};
function SelectAction(idcount,id){
	
	var V=document.getElementById('SelectedAction'+idcount).value;
	
	document.getElementById('A'+idcount).title=capitalize(document.getElementById('A'+idcount).innerHTML);
	document.getElementById('B'+idcount).title=document.getElementById('B'+idcount).innerHTML.toUpperCase();
	document.getElementById('C'+idcount).title=capitalize(document.getElementById('C'+idcount).innerHTML);
	document.getElementById('D'+idcount).title=document.getElementById('D'+idcount).innerHTML.toUpperCase();
	document.getElementById('E'+idcount).title=capitalize(document.getElementById('E'+idcount).innerHTML);
	document.getElementById('F'+idcount).title=document.getElementById('F'+idcount).innerHTML.toUpperCase();
	
	var AssetDesc=document.getElementById('A'+idcount).title;
	var AssetADCODE=document.getElementById('B'+idcount).title;
	var AssetCAT=document.getElementById('C'+idcount).title;
	var AssetCNCODE=document.getElementById('D'+idcount).title;
	var AssetSUB=document.getElementById('E'+idcount).title;
	var AssetSC=document.getElementById('F'+idcount).title;
	if(V=="Save"){
		var r = confirm("Do You Want to Save the Changes?!");
		if (r == true) {
			
			console.log(AssetDesc+" "+AssetADCODE+" "+AssetCAT+" "+AssetCNCODE+" "+AssetSUB+" "+AssetSC);
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'SaveEditTagging.php',                
			// 	data: {id:id,AssetDesc:AssetDesc,AssetADCODE:AssetADCODE,AssetCAT:AssetCAT,AssetCNCODE:AssetCNCODE,AssetSUB:AssetSUB,AssetSC:AssetSC},
			// success: function(data) {
			// 	if(data==1){
			// 		alert('Successfully Saved the Changes...');
			// 	}
			// 	if(data==0){
			// 		alert('Tag Template Already Exist...');
			// 	}
			// 	if(data==2){
			// 		alert('Failed to Save the Changes...Please Try Again Later...');
			// 	}
			// 	//UpdateDesc();
			// } 											 
			// })
		}else{
			document.getElementById('SelectedAction'+idcount).value="";
		}
	}
	if(V=="Delete"){
		
		var r = confirm("Are you sure you want to delete this Asset Tag?");
		if (r == true) {
			$.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'DeleteTagging',                
                data:{id:id,_token: '{{csrf_token()}}'},
                success: function(data) {
					if(data==1){
						Swal.fire({
                        type: 'success',
                        title: 'Success!',
                        text: 'Successfully Deleted Asset Setup',
                        }).then((result) => {
                            location.href="asset";
                        })
					}
					
					if(data==2){
						Swal.fire({
                        type: 'error',
                        title: 'Error!',
                        text: 'Failed to Delete Asset Setup',
                        }).then((result) => {
                            location.href="asset";
                        })
					}
					
					var row = document.getElementById('XX'+idcount);
					row.parentNode.removeChild(row);
                }  
            }) 
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'DeleteTagging.php',                
			// 	data: {id:id,AssetDesc:AssetDesc,AssetADCODE:AssetADCODE,AssetCAT:AssetCAT,AssetCNCODE:AssetCNCODE,AssetSUB:AssetSUB,AssetSC:AssetSC},
			// success: function(data) {
			// 	if(data==1){
			// 		alert('Asset Tag was deleted successfully.');
			// 	}
				
			// 	if(data==2){
			// 		alert('Failed to delete Asset Tag. Please try again.');
			// 	}
				
			// 	var row = document.getElementById('XX'+idcount);
			// 	row.parentNode.removeChild(row);
			// 	//UpdateDesc();
			// } 											 
			// })
			
		}
		else{
			document.getElementById('SelectedAction'+idcount).value="";
		}
		
	}
	document.getElementById('SelectedAction'+idcount).value="";
}
</script>
<style>
select option[disabled] {
	display: none;
}
</style>