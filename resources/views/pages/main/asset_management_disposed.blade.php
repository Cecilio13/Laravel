@extends('main.main')


@section('content')
<div class="container-fluid" style="margin-bottom:10px;">


<style>
.half-background {
    background: linear-gradient(180deg, white 50%, transparent 50%);
    margin-bottom:10px;
}
</style>

   <div class="half-background">
                <table class="table table-sm" id="DeniedRequestTable" style="background-color:white;width:100%;">						
                    <thead >
                        <tr style="background-color:#083240;color:white;">
                        <th colspan="6" style="text-align:center;font-weight:bold;color:white;font-size:20px;">DENIED REQUEST</th>
                        </tr>
                        <tr style="background-color:#0e3d4c; color:white;">
                            <th style="text-align:center;">Ticket No.</th>
                            <th>Request Date</th>
                            <th>Requested By</th>
                            <th >Transaction</th>
                            <th >Item</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="border-bottom:1px solid #cecece;">
                        @foreach ($pending_denied_new_assets as $rows)
                        <tr>
                            <td style="text-align:center;vertical-align:middle;">
                                {{$rows->asset_setcheck_defualt}}
                            </td>
                            <td style="vertical-align:middle;">
                                {{date("m-d-Y", strtotime($rows->audit_action_date))}}
                            </td>
                            <td style="vertical-align:middle;">
                                {{$rows->log_action_requestor}}
                            </td>
                            <td style="vertical-align:middle;">
                                {{$rows->log_action}}
                            </td>
                            <td style="vertical-align:middle;">
                                <?php
                                $cccccc="";
                                ?>
                                @foreach ($asset_description_grouped as $sad)
                                    @if ($rows->asset_description==$sad->asset_setup_ad)
                                    <?php
                                        $cccccc=$sad->asset_setup_description;
                                        break;
                                    ?>
                                    @endif
                                @endforeach
                                <a class=" btn-link" style="cursor: pointer;" onclick="EditAssetInfo('<?php echo $rows->ASSET_ID; ?>')"><?php echo $cccccc;?></a>
                                
                            </td>
                            
                            <td style="vertical-align:middle;text-align:center;">
                                <button type="button" onclick="DeleteRequest('{{$rows->ASSET_ID}}')" class="btn btn-danger btn-sm"   name="Asset_tag_button"><span class="fa fa-times-circle"></span></button>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($pending_denied_new_asset_setup as $rows)
                        <tr>
                            <td  style="text-align:center;vertical-align:middle;">{{$rows->ticket_no}}</td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($rows->audit_action_date))}}</td>
                            <td style="vertical-align:middle;">{{$rows->log_action_requestor}}</td>
                            <td style="vertical-align:middle;" >{{$rows->log_action}}</td>
                            <td style="vertical-align:middle;" >
                                <a class=" btn-link" style="cursor: pointer;" onclick="EditAssetSetup('<?php echo $rows->ASSET_SETUP_ID; ?>')"><?php echo $rows->asset_setup_tag;?></a>
                                
                            </td>
                            
                            <td style="vertical-align:middle;text-align:center;">
                                <button type="button" onclick="DeleteRequestSetup('{{$rows->ASSET_SETUP_ID}}')" class="btn btn-danger btn-sm"   name="Asset_tag_button"><span class="fa fa-times-circle"></span></button>
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
   </div> 
       
</div>

@endsection