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
var reload_page="1";
function checkreload(){
	if(reload_page=='1'){
		location.reload();
	}else{

	}
}
function ApproveRequest(request,asset_tag){
	if(request=="TransferCheckout"){
		
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'TransferCheckoutSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#TransferCheckoutModal" ).replaceWith( data );
			
		// 	demo('#TransferCheckoutModal');
			
		// } 											 
		// })
	}
	if(request=="New Asset"){
		console.log(request);
		console.log(asset_tag);
		$.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'NewAssetFirstApprove',                
        data:{tag:asset_tag,_token: '{{csrf_token()}}'},
        success: function(data) {
			
			checkreload()
            
        }  
        }) 
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'NewAssetFirstApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#NewAssetModal" ).replaceWith( data );
			
		// 	demo('#NewAssetModal');
			
		// } 											 
		// })
		
	}
	if(request=="AssetSetup"){
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'AssetSetupFirstApprove',                
			data:{tag:asset_tag,_token: '{{csrf_token()}}'},
			success: function(data) {
				
			checkreload()
				
			}  
			})
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'AssetSetupFirstApprove.php',                
			// 	data: {tag:asset_tag},
			// success: function(data) {
				
			// 	$('.modal-backdrop').remove();
			// 	$( "#DisposalModal" ).replaceWith( data );
			// 	demo('#DisposalModal');
			// } 											 
			// })
			
	}
	if(request=="Transfer"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'TransferSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#TransferModal" ).replaceWith( data );
			
		// 	demo('#TransferModal');
		// } 											 
		// })
		
	}
	if(request=="Check Out"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'CheckoutSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#CheckoutModal" ).replaceWith( data );
			
		// 	demo('#CheckoutModal');
		// } 											 
		// })
		
	}
	if(request=="Check In"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'CheckinSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#CheckinModal" ).replaceWith( data );
		// 	demo('#CheckinModal');
		// } 											 
		// })
		
	}
	if(request=="Maintenance"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'MaintenanceSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#MaintenanceModal" ).replaceWith( data );
		// 	demo('#MaintenanceModal');
		// } 											 
		// })
		
	}
	if(request=="Dispose"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'DisposeSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#DisposalModal" ).replaceWith( data );
		// 	demo('#DisposalModal');
		// } 											 
		// })
		
	}
	if(request=="Recover"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'RecoverFirstApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#RecoveryModal" ).replaceWith( data );
		// 	demo('#RecoveryModal');
		// } 											 
		// })
		
	}
	if(request=="Extend Due Date"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'ExtendSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
			
		// 	$('.modal-backdrop').remove();
		// 	$( "#RecoveryModal" ).replaceWith( data );
		// 	demo('#RecoveryModal');
		// } 											 
		// })
	}
	
	
}
function ConfirmRequest(request,asset_tag){
	if(request=="New Asset"){
		$.ajax({
		type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'NewAssetSecondApprove',                
		data:{tag:asset_tag,_token: '{{csrf_token()}}'},
		success: function(data) {
			
			checkreload()
			
		}  
		})
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'NewAssetSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#NewAssetModal2" ).replaceWith( data );
			
		// 	demo('#NewAssetModal2');
			
		// } 											 
		// })
		
	}
	if(request=="Transfer"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'TransferSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#TransferModal2" ).replaceWith( data );
			
		// 	demo('#TransferModal2');
		// } 											 
		// })
		
	}
	if(request=="Check Out"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'CheckoutSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#CheckoutModal2" ).replaceWith( data );
			
		// 	demo('#CheckoutModal2');
		// } 											 
		// })
		
	}
	if(request=="Check In"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'CheckinSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#CheckinModal2" ).replaceWith( data );
		// 	demo('#CheckinModal2');
		// } 											 
		// })
		
	}
	if(request=="Maintenance"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'MaintenanceSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#MaintenanceModal2" ).replaceWith( data );
		// 	demo('#MaintenanceModal2');
		// } 											 
		// })
		
	}
	if(request=="Dispose"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'DisposeSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#DisposalModal2" ).replaceWith( data );
		// 	demo('#DisposalModal2');
		// } 											 
		// })
		
	}
	if(request=="Recover"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'RecoverSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#RecoveryModal2" ).replaceWith( data );
		// 	demo('#RecoveryModal2');
		// } 											 
		// })
		
	}
	
	if(request=="TransferCheckout"){
		
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'TransferCheckoutSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#TransferCheckoutModal2" ).replaceWith( data );
		// 	demo('#TransferCheckoutModal2');
			
		// } 											 
		// })
	}
	if(request=="Extend Due Date"){
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'ExtendSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
		// 	$('.modal-backdrop').remove();
		// 	$( "#RecoveryModal" ).replaceWith( data );
		// 	demo('#RecoveryModal');
		// } 											 
		// })
	}
	if(request=="AssetSetup"){
		$.ajax({
		type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'AssetSetupSecondApprove',                
		data:{tag:asset_tag,_token: '{{csrf_token()}}'},
		success: function(data) {
			
			checkreload()
			
		}  
		})
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'AssetSetupSecondApprove.php',                
		// 	data: {tag:asset_tag},
		// success: function(data) {
			
		// 	$('.modal-backdrop').remove();
		// 	$( "#DisposalModal" ).replaceWith( data );
		// 	demo('#DisposalModal');
		// } 											 
		// })
		
	}
}
function DenyRequest(request,asset_tag,ticket_no){
	var txt;
	var person = prompt("Please state the reason reason for "+ticket_no);
	if (person == null || person == "") {
		alert("Action Cancelled....");
		
	} else {
		txt = person;
		console.log(txt+" "+request+" "+asset_tag);
		if(request=="TransferCheckout"){
		
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'TransferCheckoutDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#TransferCheckoutModal" ).replaceWith( data );
				
			// 	demo('#TransferCheckoutModal');
				
			// } 											 
			// })
		}
		if(request=="New Asset"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'NewAssetDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#NewAssetModal" ).replaceWith( data );
				
			// 	demo('#NewAssetModal');
				
			// } 											 
			// })
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'NewAssetDeny',                
			data:{tag:asset_tag,reason:txt,_token: '{{csrf_token()}}'},
			success: function(data) {
				
			checkreload()
				
			}  
			})
			
		}
		if(request=="New Asset2"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'NewAssetDenySecond.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#NewAssetModal" ).replaceWith( data );
				
			// 	demo('#NewAssetModal');
				
			// } 											 
			// })
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'NewAssetDenySecond',                
			data:{tag:asset_tag,reason:txt,_token: '{{csrf_token()}}'},
			success: function(data) {
				
			checkreload()
				
			}  
			})
			
		}
		if(request=="Transfer"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'TransferDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#TransferModal" ).replaceWith( data );
				
			// 	demo('#TransferModal');
			// } 											 
			// })
			
		}
		if(request=="Check Out"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'CheckoutDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#CheckoutModal" ).replaceWith( data );
				
			// 	demo('#CheckoutModal');
			// } 											 
			// })
			
		}
		if(request=="Check In"){
			// console.log('YOYO');
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'CheckinDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	//alert(data);
			// 	$('.modal-backdrop').remove();
			// 	$( "#CheckinModal" ).replaceWith( data );
			// 	demo('#CheckinModal');
			// 	console.log('YOYO22');
			// },
			// error: function (request, status, error) {
			// 		alert(request.responseText);
			// 	}					
			// })
			
		}
		if(request=="Maintenance"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'MaintenanceDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#MaintenanceModal" ).replaceWith( data );
			// 	demo('#MaintenanceModal');
			// } 											 
			// })
			
		}
		if(request=="Dispose"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'DisposeDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#DisposalModal" ).replaceWith( data );
			// 	demo('#DisposalModal');
			// } 											 
			// })
			
		}
		if(request=="AssetSetup"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'DisposeAssetSetup.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
				
			// 	$('.modal-backdrop').remove();
			// 	$( "#DisposalModal" ).replaceWith( data );
			// 	demo('#DisposalModal');
			// } 											 
			// })
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'DisposeAssetSetup',                
			data:{tag:asset_tag,reason:txt,_token: '{{csrf_token()}}'},
			success: function(data) {
				
			checkreload()
				
			}  
			})
			
		}
		if(request=="AssetSetup2"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'DisposeAssetSetup2.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
				
			// 	$('.modal-backdrop').remove();
			// 	$( "#DisposalModal" ).replaceWith( data );
			// 	demo('#DisposalModal');
			// } 											 
			// })
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'DisposeAssetSetup2',                
			data:{tag:asset_tag,reason:txt,_token: '{{csrf_token()}}'},
			success: function(data) {
				
			checkreload()
				
			}  
			})
			
		}
		if(request=="Recover"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'RecoverDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
			// 	$('.modal-backdrop').remove();
			// 	$( "#RecoveryModal" ).replaceWith( data );
			// 	demo('#RecoveryModal');
			// } 											 
			// })
			
		}
		if(request=="Extend Due Date"){
			// $.ajax({
			// 	type: 'POST',
			// 	url: 'ExtendDeny.php',                
			// 	data: {tag:asset_tag,reason:txt},
			// success: function(data) {
				
			// 	$('.modal-backdrop').remove();
			// 	$( "#RecoveryModal" ).replaceWith( data );
			// 	demo('#RecoveryModal');
			// } 											 
			// })
		}
	}
	
}
function DeleteRequest(id){
	var txt;
	var r = confirm('Are you sure you want to delete the New Fixed Asset request?');
	if (r == true) {
		$.ajax({
		type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'delete_request_new_asset',                
		data:{id:id,_token: '{{csrf_token()}}'},
		success: function(data) {
			reload_page="1";
			checkreload()
			
		}  
		})
	}
	
}
function DeleteRequestSetup(id){
	var txt;
	var r = confirm('Are you sure you want to delete the Asset Setup request?');
	if (r == true) {
		$.ajax({
		type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'delete_request_asset_setup',                
		data:{id:id,_token: '{{csrf_token()}}'},
		success: function(data) {
			reload_page="1";
			checkreload()
			
		}  
		})
	}	
}
function ViewAssetSetup(id){
	$.ajax({
	type: 'POST',
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	url: 'ViewAssetSetupModalBody',                
	data:{AssetTagID:id,_token: '{{csrf_token()}}'},
	success: function(data) {
		$( "#ViewAssetSetupModalBody" ).replaceWith( data.html );
		$('#ViewAssetSetup').modal();
		
	}  
	})
	
}
function ViewPendingAssets(id){
	$.ajax({
	type: 'POST',
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	url: 'getViewAssetInfoModalBody',                
	data:{AssetTagID:id,_token: '{{csrf_token()}}'},
	success: function(data) {
		$( "#ViewAssetModalBody" ).replaceWith( data.html );
		$('#ViewAssetModal').modal();
		
	}  
	})
	
}
function EditAssetInfo(id){
	$.ajax({
	type: 'POST',
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	url: 'EditAssetSetupModalBody',                
	data:{AssetTagID:id,_token: '{{csrf_token()}}'},
	success: function(data) {
		$( "#ViewAssetModalBody" ).replaceWith( data.html );
		$('#ViewAssetModal').modal();
		
	}  
	})
}
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
function toggleindi(source){
	checkboxes = document.getElementsByName('LG');
	var z=0;
  for(var i=0, n=checkboxes.length;i<n;i++) {
	  
	if(checkboxes[i].checked){
		z++;
	  document.getElementById('MassApproveBtn2223').style.display="inline-block";
	  document.getElementById('MassDenyBtn2223').style.display="inline-block";
	  
	  }
	if(z==0){
		 document.getElementById('MassApproveBtn2223').style.display="none";
		 document.getElementById('MassDenyBtn2223').style.display="none";
		
		document.getElementsByName('SelectAll').checked=false;
	}
	
	if(z==n){
		document.getElementById('MassApproveBtn2223').style.display="inline-block";
	  document.getElementById('MassDenyBtn2223').style.display="inline-block";
	
	}
  }
  
}
var checkboxes="";
function toggle(source) {
  checkboxes = document.getElementsByName('LG');
 
  for(var i=0, n=checkboxes.length;i<n;i++) {
	checkboxes[i].checked = source.checked;
	if(checkboxes[i].checked){
	  document.getElementById('MassApproveBtn2223').style.display="inline-block";
	  document.getElementById('MassDenyBtn2223').style.display="inline-block";
	  }else{
		 document.getElementById('MassApproveBtn2223').style.display="none";
		 document.getElementById('MassDenyBtn2223').style.display="none";
	  }
  }
  
}
function MassApprove(){
	reload_page="0";
	checkboxes = document.getElementsByName('LG');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		if(checkboxes[i].checked){
			var type=checkboxes[i].title;
			var id=checkboxes[i].value;
			console.log(type+" "+id+" "+i);
			ApproveRequest(type,id);
		}
		
	}
	reload_page="1";
	checkreload()
}
function MassDeny(){
	reload_page="0";
	checkboxes = document.getElementsByName('LG');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		if(checkboxes[i].checked){
			var type=checkboxes[i].title;
			var id=checkboxes[i].value;
			var ticket_no=checkboxes[i].getAttribute('data-ticket');
			DenyRequest(type,id,ticket_no);
		}
		
	}
	reload_page="1";
	checkreload()
	
}
function MassApprove2(){
	checkboxes = document.getElementsByName('LG');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		if(checkboxes[i].checked){
			var type=checkboxes[i].title;
			var id=checkboxes[i].value;
			console.log(type+" "+id);
			ConfirmRequest(type,id);
		}
		
	}
}
function MassDeny2(){
	checkboxes = document.getElementsByName('LG');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		if(checkboxes[i].checked){
			var type=checkboxes[i].title;
			var id=checkboxes[i].value;
			var ticket_no=checkboxes[i].getAttribute('data-ticket');
			if(type=="AssetSetup"){
				type="AssetSetup2";
			}
			DenyRequest(type,id,ticket_no);
		}
		
	}
	
}
function EditAssetInfo2(){
	
}
</script>
<style>
select option[disabled] {
	display: none;
}

</style>
<div class="modal fade modal-full" id="ViewAssetModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        
        <div class="modal-body" id="ViewAssetModalBody">
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        </div>
        </div>
    </div>
</div>
<div class="modal fade " id="ViewAssetSetup"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        
        <div class="modal-body" id="ViewAssetSetupModalBody">
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        </div>
        </div>
    </div>
</div>
