<div class="modal-body" id="ViewAssetSetupModalBody">
        <script>
                $(document).ready(function(){
                    
                    $("#AssetSetupEdit_SiteAdndLocation").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'update_asset_setup_site_and_location',                
                            data: $('#AssetSetupEdit_SiteAdndLocation').serialize(),
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Updated Asset Setup',
                                }).then((result) => {
                                    location.reload();
                                })
                            }
                        })
                    });
                })
            </script>
    <form id="AssetSetupEdit_SiteAdndLocation"></form>
    <table class="table borderless" >
        <style>
        .table.borderless td,table.borderless th{
             border: none !important;
            
        }
        </style>
        
        <?php
        if($Kind=="Asset Tag"){
        ?>
        
            <tbody>
            <tr>
                <td width="15%" style="vertical-align: middle;text-align:right;color:#083240;">Asset <input type="hidden" name="asset_setup_type" form="AssetSetupEdit_SiteAdndLocation" value='Asset Tag'><input type="hidden" name="Asset_Setup_ID" form="AssetSetupEdit_SiteAdndLocation" value='{{$setup_id}}'></td>
                <td width="20%" style="vertical-align: middle;"><input type="text" id="DESC_Edit" name="AssetDescriptionSetup" required form="AssetSetupEdit_SiteAdndLocation" class="form-control" style="text-transform: capitalize" onclick="ShowSearchAssetDescEdit(),CheckAssetTagaCombinationEdit()" onkeyup="CheckAssetTagaCombinationEdit(),CheckCOdeEdit()"  onkeypress="return alphaOnly(event)" title="Characters(A-Z) Only" value="<?php echo $asset_setup_description; ?>" data-value="<?php echo $asset_setup_description; ?>" list="AssetDescSearchREsultEdit">
                <datalist id="AssetDescSearchREsultEdit">
                            
                        </datalist>
                </td>
                <td width="11%"style="vertical-align: middle;text-align:right;color:#083240;" >AD CODE</td>
                <td width="20%"style="vertical-align: middle;"><input name="AD_COde" type="text" maxlength="5" id="ADCODEEdit" style="text-transform: uppercase" onkeyup="CheckAssetTagaCombinationEdit()" list="AssetDescCOdeSearchREsultEdit" onclick="AssetDescCOdeSearchREsultEdit(),CheckAssetTagaCombinationEdit()"  onkeypress="return alphaOnly(event)" title="Characters(A-Z) Only" required form="AssetSetupEdit_SiteAdndLocation" class="form-control"  value="<?php echo $asset_setup_ad; ?>" ><datalist id="AssetDescCOdeSearchREsultEdit"></datalist></td>
            </tr>
            <tr>
                <td style="vertical-align: middle;text-align:right;color:#083240;">Category Name</td>
                <td style="vertical-align: middle;"><input type="text" class="form-control" name="CategoryNameSetup" form="AssetSetupEdit_SiteAdndLocation" required value="<?php echo $asset_setup_category; ?>" data-value="<?php echo $asset_setup_category; ?>" onkeyup="AssetCategorySearchREsultEdit(),CheckCOdeCNEdit(),CheckAssetTagaCombinationEdit()" id="CNEdit" style="text-transform: capitalize"  onclick="AssetCategorySearchREsultEdit(),CheckAssetTagaCombinationEdit()"   list="AssetCategorySearchREsultEdit"><datalist id="AssetCategorySearchREsultEdit"></datalist></td>
                <td  style="vertical-align: middle;text-align:right;color:#083240;" >CN CODE</td>
                <td width="15%"style="vertical-align: middle;"><input type="text" name="CN_COde" form="AssetSetupEdit_SiteAdndLocation" required class="form-control" value="<?php echo $asset_setup_ac; ?>" maxlength="5" style="text-transform: uppercase" onkeyup="AssetCNCodeSearchREsulteDIT(),CheckAssetTagaCombinationEdit()" onclick="AssetCNCodeSearchREsulteDIT(),CheckAssetTagaCombinationEdit()"  id="CNCODEeDIT" onkeypress="return alphaOnly(event)" list="AssetCNCodeSearchREsulteDIT" title="Characters(A-Z) Only"><datalist id="AssetCNCodeSearchREsulteDIT"></datalist></td>
                
            </tr>
            <tr>
                <td style="vertical-align: middle;text-align:right;color:#083240;">Sub Category</td>
                <td style="vertical-align: middle;"><input type="text" form="AssetSetupEdit_SiteAdndLocation" name="SubCategorySetup" ID="SC_CART"  class="form-control" value="<?php echo $asset_setup_sub_cat; ?>"  data-value="<?php echo $asset_setup_sub_cat; ?>" onkeyup="ShowSubCatEdit(),CheckCOdeSCeDIT(),CheckAssetTagaCombinationEdit()" onclick="ShowSubCatEdit()" style="text-transform: capitalize" list="AssetSubCategorySearchResultEdit"><datalist id="AssetSubCategorySearchResultEdit"></datalist></td>
                <td style="vertical-align: middle;text-align:right;color:#083240;" >SC CODE</td>
                <td width="15%"style="vertical-align: middle;"><input type="text" name="SC_COde" form="AssetSetupEdit_SiteAdndLocation" class="form-control" value="<?php echo $asset_setup_sc; ?>" id="SCCODEEDIT" onkeypress="return alphaOnly(event)" onkeyup="ShowSubCatCodeEdit()" list="AssetSubCategoryCodeSearchResultEdit" onclick="ShowSubCatCodeEdit()" title="Characters(A-Z) Only"><datalist id="AssetSubCategoryCodeSearchResultEdit"></datalist></td>
                
            </tr>
            <tr>
                <td style="padding-top:11px;text-align:right;color:#083240;">Required Fields</td>
                <td colspan="3" >
                <div class="checkbox" style="margin-top:0px;">
                <label style="padding-top:5px;"><input form="AssetSetupEdit_SiteAdndLocation"  type="checkbox" name="RequireSerial" value="Serial" <?php echo $setup_require_serial=='1'? 'checked' : ''; ?>>Serial Number</label>
                <label style="padding-top:5px;"><input form="AssetSetupEdit_SiteAdndLocation"  type="checkbox" name="RequirePlateNumber" value="Plate" <?php echo $setup_require_plate=='1'? 'checked' : ''; ?>>Plate Number</label>
                </div>
                
                </td>
                
                
                <select class="form-control" name="ConsumableAsset" style="display:none;" readonly>
                <?php
                if($setup_require_serial=="0"){
                ?>
                <option value="0">Not Consumable</option>
                <?php
                }else{
                ?>
                <option value="1">Consumable</option>
                <?php
                }
                ?>
                </select>
                </td>
            </tr>
            </tbody>
        
        <?php
        }
        if($Kind=="Site And Location"){
        ?>
        <tbody >
            <tr>
                <td width="5%"style="text-align:left;color:#083240;" >
                        <input type="hidden" name="asset_setup_type" form="AssetSetupEdit_SiteAdndLocation" value='Site And Location'>
                    Location <input type="hidden" name="Asset_Setup_ID" form="AssetSetupEdit_SiteAdndLocation" value='{{$setup_id}}'><datalist id="LocSearchReultDivEdit"></datalist></td>
                <td width="20%"style=""><input type="text" class="form-control" data-value="<?php echo $asset_setup_location; ?>" value="<?php echo $asset_setup_location; ?>" list="LocSearchReultDivEdit"  id="LocationSetupEdit" onclick="GetExistingLocationEdit()" onkeyup="GetExistingLocationEdit(),CheckSiteEdit()" name="LocationSetup2Edit" required  form="AssetSetupEdit_SiteAdndLocation"></td>
                <td width="5%" style="text-align:right;color:#083240;">Site</td>
                <td width="20%" style=""><input type="text" class="form-control" onclick="GetExistingSites()"  id="SiteSetupEdit" name="SiteSetup2Edit" rows="2" onkeyup="GetExistingSitesEdit(),CheckSiteEdit()" list="siteSearchReultDivEdit" required  form="AssetSetupEdit_SiteAdndLocation" data-value="<?php echo $asset_setup_site; ?>" value='<?php echo $asset_setup_site; ?>'><datalist id="siteSearchReultDivEdit"></datalist></td></td>
            </tr>
            
        </tbody>
       
        <?php
        }
        if($Kind=="Storage"){
        ?>
        <tbody id="AssetSetup_TBody">
            <tr>
                <td width="5%" style="vertical-align: middle;text-align:right;color:#083240;">Storage</td>
                <td width="20%" style="vertical-align: middle;"><input type="text" class="form-control" value="<?php echo $asset_setup_sku; ?>"  readonly></td>
                <td width="20%"></td>
            </tr>
        </tbody>
        <?php	
        }
        if($Kind=="UOM"){
        ?>
        <tbody>
            <tr>
                <td width="5%" style="vertical-align: middle;text-align:right;color:#083240;">UOM</td>
                <td width="20%" style="vertical-align: middle;"><input type="text" class="form-control" value="<?php echo $uom; ?>" required  readonly></td>
                <td width="5%"style="vertical-align: middle;text-align:right;color:#083240;" >Abbr.</td>
                <td width="20%"style="vertical-align: middle;"><input type="text" class="form-control" value="<?php echo $uom_abbr; ?>" required readonly></td>
                
            </tr>
        </tbody>
        <?php	
        }
        
        ?>
        
      </table>
      <table class="table borderless">
        <tr>
            <td colspan="4"><button style="float:right;" class="btn btn-primary" type="submit" form="AssetSetupEdit_SiteAdndLocation" id="SaveBtnAssetSetupEdit">Save Changes</button></td>
        </tr>
      </table>
  </div>