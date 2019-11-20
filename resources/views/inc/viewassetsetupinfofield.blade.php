<div class="modal-body" id="ViewAssetSetupModalBody">
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
            <td width="15%" style="vertical-align: middle;text-align:right;color:#083240;">Asset</td>
            <td width="20%" style="vertical-align: middle;"><input type="text" required class="form-control" value="<?php echo $asset_setup_description; ?>" readonly></td>
            <td width="11%"style="vertical-align: middle;text-align:right;color:#083240;" >AD CODE</td>
            <td width="20%"style="vertical-align: middle;"><input type="text" required class="form-control"  value="<?php echo $asset_setup_ad; ?>" readonly></td>
            
        </tr>
        <tr>
            <td style="vertical-align: middle;text-align:right;color:#083240;">Category Name</td>
            <td style="vertical-align: middle;"><input type="text" class="form-control" required value="<?php echo $asset_setup_category; ?>" readonly></td>
            <td  style="vertical-align: middle;text-align:right;color:#083240;" >CN CODE</td>
            <td width="15%"style="vertical-align: middle;"><input type="text" required class="form-control" value="<?php echo $asset_setup_ac; ?>" readonly></td>
            
        </tr>
        <tr>
            <td style="vertical-align: middle;text-align:right;color:#083240;">Sub Category</td>
            <td style="vertical-align: middle;"><input type="text"  class="form-control" value="<?php echo $asset_setup_sub_cat; ?>" readonly></td>
            <td style="vertical-align: middle;text-align:right;color:#083240;" >SC CODE</td>
            <td width="15%"style="vertical-align: middle;"><input type="text" class="form-control" value="<?php echo $asset_setup_sc; ?>" readonly></td>
            
        </tr>
        <tr>
            <td style="padding-top:11px;text-align:right;color:#083240;">Required Fields</td>
            <td colspan="3" >
            <div class="checkbox" style="margin-top:0px;">
              <label style="padding-top:5px;"><input disabled type="checkbox" name="RequireSerial" value="Serial" <?php echo $setup_require_serial=='1'? 'checked' : ''; ?>>Serial Number</label>
              <label style="padding-top:5px;"><input disabled type="checkbox" name="RequirePlateNumber" value="Plate" <?php echo $setup_require_plate=='1'? 'checked' : ''; ?>>Plate Number</label>
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
                
                <td width="5%"style="text-align:left;color:#083240;" >Location</td>
                <td width="20%"style=""><input type="text" class="form-control" value="<?php echo $asset_setup_location; ?>" required readonly ></td>
                <td width="5%" style="text-align:right;color:#083240;">Site</td>
                <td width="20%" style=""><textarea class="form-control" required  readonly><?php echo $asset_setup_site; ?></textarea></td>
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
  </div>