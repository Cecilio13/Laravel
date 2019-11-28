<table style="width:100%;">
    <thead>
        <tr>
        <th></th>
        <th></th>
        <th></th>
        </tr>
        
    </thead>
    <tbody>
<?php
$column=1;
$count=count($included);
?>
@foreach ($included as $inc)
<?php
$ViewAssetTag=$inc->asset_tag;
$ViewAssetDesc=$inc->asset_description;
$ViewAssetCategoryName=$inc->asset_category_name;
$CategoryNameFull=$ViewAssetCategoryName;
$ViewAssetSub=$inc->asset_sub_category;
$ViewAssetSerialNumber=$inc->asset_serial_number;
$sku_code=$inc->sku_code;
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
    @if ($column==1)
    <tr>
       <td style="vertical-align:middle;text-align:center;padding-top:10px;">
            <img class="qr-img" src="{{$qrdata}}"><br>
            <span class="qr-tag" style="font-weight:bold;width:100%;font-size: 100%;">{{$inc->asset_tag}}</span><br>
        </td>
        <?php
        $column=2;
        ?>
    @elseif($column==2)
        <td style="vertical-align:middle;text-align:center;padding-top:10px;">
            <img class="qr-img" src="{{$qrdata}}"><br>
            <span class="qr-tag" style="font-weight:bold;width:100%;font-size: 100%;">{{$inc->asset_tag}}</span><br>
        </td> 
        <?php
        $column=3;
                ?>
    @elseif($column==3)
        <td style="vertical-align:middle;text-align:center;padding-top:10px;">
            <img class="qr-img" src="{{$qrdata}}"><br>
            <span class="qr-tag" style="font-weight:bold;width:100%;font-size: 100%;">{{$inc->asset_tag}}</span><br>
        </td>
    </tr>
    <?php
    $column=1;
            ?>
    @elseif($c==$count)
    </tr>
    @endif
    
@endforeach
</tbody>
</table>
<script src="{{asset('js/JQuery.js')}}"></script>
<script>
$(document).ready(function(){
    window.print();
    setTimeout(window.close, 500);
})
</script>
