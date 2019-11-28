@extends('main.main')


@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-bottom:0px;margin-left:10px;">QR CODES</h2>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        if(document.getElementById('qr_list_table')){
            var table = $('#qr_list_table').DataTable( {
                order: [2, 'desc'],
                ordering:false,
                paging:false
            } );
            if(document.getElementById('qr_list_table_length')){
                document.getElementById('qr_list_table_info').style.display="none";
                
                document.getElementById('qr_list_table_paginate').style.textAlign ="center";
                document.getElementById('qr_list_table_paginate').style.cssFloat ="none";
                
            } 
        }
        $('#PrintButtonQR').click(function() {
        checked = $("input[type=checkbox]:checked").length;

        if(!checked) {
            alert("You must check at least one checkbox.");
            return false;
        }

        });
        $('#selectall').change(function(event) {
            
            if(this.value=="1") {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        });
    })
    </script>
    <form id="print_qr_form" method="POST" action="print_qr" target="_blank">
    {{ csrf_field() }}
    <table class="table table-sm" id="qr_list_table" style="background-color:white;">
		<thead style="background-color:#124f62; color:white;padding:0px !important;">
			<tr>
				<th colspan="4" style="vertical-align:middle;">Print Asset Tag QR Codes </th>
            </tr>
            <tr>
                <th style="vertical-align:middle;" width="10%">
                    <select id="selectall" class="form-control">
                        <option value=""></option>
                        <option value="1">Select All</option>
                        <option value="0">Select None</option>
                    </select>
                </th>
                <th style="vertical-align:middle;">QR Code</th>
                <th style="vertical-align:middle;">Asset Description</th>
                <th style="vertical-align:middle;" style="display:none;"></th>
            </tr>
		</thead>
		<tbody>
            @foreach ($asset_list_qr as $asset)
                <tr id="{{$asset->id}}-id">
                    <td style="vertical-align:middle;text-align:center;">
                        <div class="checkbox">
                            <?php
								if($asset->depreciation_date!=""){
								?>
								<label><input type="checkbox" name="include[]" value="<?php echo $asset->id; ?>" ></label>
								<?php
								}else{
								?>
								<label style="color:red;padding:0px;" title="Disabled printing for this QR/ Required to Set Start Date.."><span class="fa fa-ban"></span></label>
								
								<?php	
								}
							?>
                        </div>
                    </td>
                    <?php
                    $ViewAssetTag=$asset->asset_tag;
                    $ViewAssetDesc=$asset->asset_description;
                    $ViewAssetCategoryName=$asset->asset_category_name;
                    $CategoryNameFull=$ViewAssetCategoryName;
                    $ViewAssetSub=$asset->asset_sub_category;
                    $ViewAssetSerialNumber=$asset->asset_serial_number;
                    $sku_code=$asset->sku_code;
                    ?>
                    @foreach ($asset_setup_lists as $setup)
                        @if ($setup->asset_setup_ad==$ViewAssetDesc)
                        <?php 
                        $ViewAssetDesc=$setup->asset_setup_description;
                        ?>
                        @endif
                        @if ($setup->asset_setup_ac==$ViewAssetCategoryName)
                        <?php 
                        $CategoryNameFull=$setup->asset_setup_category;
                        ?> 
                        @endif
                        @if ($setup->asset_setup_sc==$ViewAssetSub)
                        <?php 
                        $ViewAssetSub=$setup->asset_setup_sub_cat;
                        ?> 
                        @endif
                    @endforeach
                    <?php
                    $ViewAssetSub1="";
                    $ViewAssetSerialNumber1="";
                    $sku_code1="";
                    if($ViewAssetSub!=""){
					//$ViewAssetSub1="SC - ".$ViewAssetSub."%0A";
					$ViewAssetSub1="";
					
					}
					$ViewAssetSerialNumber1="";
					if($ViewAssetSerialNumber!=""){
						$ViewAssetSerialNumber1="SN-".$ViewAssetSerialNumber."%0A";
						
					}
					$sku_code1="";
					if($sku_code!=""){
						$sku_code1="PN-".$sku_code."%0A";
						
					}
                    
                    $qrdata="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=".$ViewAssetTag."%0A"."Asset Description - ".$ViewAssetDesc."%0A"."Category - ".$CategoryNameFull."%0A".$ViewAssetSub1."%0A".$ViewAssetSerialNumber1."%0A".$sku_code1."%0A";
                    ?>
                    <td style="vertical-align:middle;text-align:center;">
                        <img class="qr-img" src="{{$qrdata}}"><br>
                        <span class="qr-tag" style="font-weight:bold;width:100%;font-size: 1.2vw;">{{$asset->asset_tag}}</span><br>
                    </td>
                    <td style="vertical-align:middle;text-align:center;">MINOR EQUIPMENT</td>
                    <td style="display:none;">{{$asset->asset_site." ".$asset->asset_location}}</td>
                </tr>
            @endforeach
		</tbody>
    </table>
    </form>
    <div style="margin-bottom:10px;position: fixed;bottom:1%;right:1%;width:20%">
        <table class="table borderless" style="margin-bottom:0px;">
            <tbody>
            <tr>
            <td style="vertical-align:middle;">
            
            </td>
            <td style="vertical-align:middle;text-align:right;">
            <button class="btn btn-primary btn-lg" form="print_qr_form" id="PrintButtonQR"><span class="fa fa-print"></span></button>
            </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection