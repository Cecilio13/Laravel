<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\UserCostCenterAccess;
use App\UserAccess;
use App\HR_Company_Basic_Info;
use App\HR_Company_Bank;
use App\HR_Company_Cost_Center;
use App\HR_Company_Department;
use App\HR_Company_Work_Policy;
use App\HR_Company_Tax_Computation;
use App\HR_Company_Govt_SSS;
use App\HR_Company_Govt_PhilHealth;
use App\HR_Company_payroll_computation;
use App\HR_Company_payroll_computation_thirteen;
use App\HR_Company_payroll_computation_rest_day;
use App\HR_Company_payroll_computation_ot_rate;
use App\HR_Company_payroll_computation_ot_comp_option;
use App\HR_Company_payroll_computation_new_hire;
use App\HR_Company_payroll_computation_late;
use App\HR_Company_payroll_computation_final_computation;
use App\HR_Company_payroll_computation_absent;
use App\HR_Company_reference_sss_table;
use App\HR_Company_reference_tax_table_deduction;
use App\HR_Company_reference_tax_tax_table;
use App\HR_Company_reference_hr_payroll_adjustment_template;
use App\HR_Company_reference_hr_payroll_company_adjustment;
use App\HR_Company_reference_hr_reference_govt_or_record;
use App\HR_Company_reference_hr_ot_table;
use App\HR_hr_employee_info;
use App\HR_hr_employee_email;
use App\HR_hr_employee_alt_contact;
use App\HR_hr_employee_emergency_contact;
use App\HR_hr_employee_education;
use App\HR_hr_employee_seminar;
use App\HR_hr_employee_trainer;
use App\HR_hr_employee_salary_detail;
use App\HR_hr_employee_job_detail;
use App\HR_hr_employee_leavemanagement;
use App\HR_hr_employee_schedule_detail;
use Illuminate\Support\Facades\DB;
use App\HR_hr_memo;
use App\HR_hr_form_template;
use App\HR_hr_cash_advances;
use App\HR_cash_advance_loan_type;
use App\HR_payroll;
use App\HR_hr_employee_adjustment;
use App\HR_hr_employee_attendance;
use App\HR_hr_cash_advances_payment;
use App\HR_hr_notification;

use App\HR_hr_Asset;
use App\HR_hr_Asset_setup;
use App\HR_hr_a_digit;
use App\HR_hr_asset_photo;
use App\HR_hr_asset_request;
use App\HR_hr_asset_transaction_log;
use App\HR_hr_audit;
class GetController extends Controller
{
    //
    public function get_asset_setup_site(Request $request){
        $value=$request->value;
        $Site=$request->Site;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','=',$value],
            ['asset_setup_site','like','%'.$Site.'%'],
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_site')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_site.'</option>';
        }
        return $rr;
    }
    public function GetSiteNewAsset(Request $request){
        $value=$request->value2;
        $Site=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','=',$value],
            ['asset_setup_site','like','%'.$Site.'%'],
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_site')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_site.'</option>';
        }
        return $rr;
    }
    public function check_site(Request $request){
        $value=$request->value;
        $site=$request->site;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','=',$value],
            ['asset_setup_site','=',$site],
            ['asset_setup_tag','=','Site And Location']
        ])->first();
        $result="0";
        if(!empty($data)){
            $result='1';
        }
        return $result;
    }
    public function get_asset_setup_location(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','like','%'.$value.'%'],
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_location')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_location.'</option>';
        }
        return $rr;
    }
    public function GetLocationNewAsset(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','like','%'.$value.'%'],
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_location')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_location.'</option>';
        }
        return $rr;
    }
    public function get_asset_desc(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','like','%'.$value.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_description')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_description.'</option>';
        }
        return $rr;
    }
    public function get_asset_category(Request $request){
        $value=$request->value;
        $cat=$request->category;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_category','like','%'.$cat.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_category')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_category.'</option>';
        }
        return $rr;
    }
    public function get_asset_sub_cat(Request $request){
        $value=$request->value;
        $cat=$request->CN;
        $sub=$request->SC;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_category','=',$cat],
            ['asset_setup_sub_cat','like','%'.$sub.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_sub_cat')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_sub_cat.'</option>';
        }
        return $rr;
    }
    
    public function get_asset_desc_code_list(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_ad','like','%'.$value.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_ad')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_ad.'</option>';
        }
        return $rr;
    }
    public function getCategoryNewAsset(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_ad','=',$value],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_category')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option value="'.$ss->asset_setup_ac.'">'.$ss->asset_setup_category.'</option>';
        }
        return $rr;
    }
    public function GetAssetCount(Request $request){
        $count=count(HR_hr_Asset::all());
        $count++;
        $oldstr= sprintf("%'.06d\n", $count);
        $newstr = substr_replace($oldstr,"-",3, 0);
        return $newstr;
    }
    public function checkserialunique(Request $request){
        $serial=$request->serial;
        if($serial!=''){
            $count=count(HR_hr_Asset::where([
                ['asset_serial_number','=',$serial]
            ])->get());
        }else{
            $count=0;
        }
        return $count;
    }
    public function checkplateunique(Request $request){
        $serial=$request->serial;
        if($serial!=''){
            $count=count(HR_hr_Asset::where([
                ['invoice_number','=',$serial]
            ])->get());
        }else{
            $count=0;
        }
        return $count;
    }
    public function checkinvoicenumbernewasset(Request $request){
        $serial=$request->serial;
        if($serial!=''){
            $count=count(HR_hr_Asset::where([
                ['sku_code','=',$serial]
            ])->get());
        }else{
            $count=0;
        }
        return $count;
    }
    public function SetSerialAndUOM(Request $request){
        $Desc=$request->Desc;
        $Cat=$request->Cat;
        $Sub=$request->Sub;
        $SCUB="";
        if($Sub!=""){
            $SCUB="AND asset_setup_sc='$Sub'";
        }
        $scripts='<div id="requireserial_div">';
        
        $get = DB::connection('mysql')->select("SELECT * FROM hr_asset_setup WHERE asset_setup_ad='$Desc' AND asset_setup_ac='$Cat' $SCUB AND asset_setup_status='1'");
        foreach($get as $gg){
            $require_serial=$gg->uom;
            $require_plate=$gg->asset_setup_sku;
            $scripts.="<script>console.log('INPUT ".$Desc." ".$Cat." ".$Sub."');</script>";
            $scripts.="<script>console.log('SSOOP ".$require_serial." ".$require_plate."');</script>";
            if($require_serial!="" || $require_plate!=''){
                    if($require_plate=="0" || $require_plate==""){
                    $scripts.='<script>';
                    $scripts.='document.getElementById(\'PlateLabel\').innerHTML="Plate Number";';
                    $scripts.='document.getElementById("SKUCODE").required = false;';
                    $scripts.='</script>';
                    
                    }else{
                    
                        $scripts.='<script>';
                        $scripts.='document.getElementById(\'PlateLabel\').innerHTML="Plate Number *";';
                        $scripts.='document.getElementById("SKUCODE").required = true;';
                        $scripts.='</script>';
                    
                    }
                    if($require_serial=="0" || $require_serial==""){
                    $scripts.='<script>';
                    $scripts.='document.getElementById(\'SerialLabel\').innerHTML="Serial Number";';
                    $scripts.='document.getElementById("SerialCode").required = false;';
                    $scripts.='</script>';
                    
                    }else{
                    
                        $scripts.='<script>';
                        $scripts.='document.getElementById(\'SerialLabel\').innerHTML="Serial Number *";';
                        $scripts.='document.getElementById("SerialCode").required = true;';
                        $scripts.='</script>';
                    
                    }
            }else{
                $scripts.='<script>';
                $scripts.='document.getElementById(\'SerialLabel\').innerHTML="Serial Number";';
                $scripts.='document.getElementById("SerialCode").required = false;';
                $scripts.='document.getElementById(\'PlateLabel\').innerHTML="Plate Number";';
                $scripts.='document.getElementById("SKUCODE").required = false;';
                $scripts.='</script>';
            }
            
        }
        $scripts.='</div>';
        return $scripts;
    }
    public function GetSubNewAsset(Request $request){
        
        $value=$request->value;
        $value2=$request->value2;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_ad','=',$value],
            ['asset_setup_ac','=',$value2],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_category')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option value="'.$ss->asset_setup_sc.'">'.$ss->asset_setup_sub_cat.'</option>';
        }
        return $rr;
    }
    
    public function get_asset_category_code_list(Request $request){
        $value=$request->value;
        $cat_code=$request->category;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_ac','like','%'.$cat_code.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_ac')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_ac.'</option>';
        }
        return $rr;
    }
    public function get_asset_sub_cat_code_list(Request $request){
        $value=$request->value;
        $cat=$request->CN;
        $cat_sub_code=$request->SC;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_category','=',$cat],
            ['asset_setup_sc','like','%'.$cat_sub_code.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_sc')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_sc.'</option>';
        }
        return $rr;
    }
    public function get_asset_desc_code(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_status','=','1']
        ])->first();
        $result="";
        if(!empty($data)){
            $result=$data->asset_setup_ad;
        }
        return $result;
    }
    public function get_asset_cat_code(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_category','=',$value],
            ['asset_setup_status','=','1']
        ])->first();
        $result="";
        if(!empty($data)){
            $result=$data->asset_setup_ac;
        }
        return $result;
    }
    public function get_asset_sub_cat_code(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_sub_cat','=',$value],
            ['asset_setup_status','=','1']
        ])->first();
        $result="";
        if(!empty($data)){
            $result=$data->asset_setup_sc;
        }
        return $result;
    }
    public function check_asset_setup_asset_tag_combination(Request $request){
        $desc=$request->desc;
        $CN=$request->CN;
        $SC=$request->SC;
        $descrip="";
        $CNNN="";
        $SCCC="";
        if($desc!=""){
            $descrip="asset_setup_description='$desc' ";
        }
        if($CN!=""){
            $CNNN="AND asset_setup_category='$CN' ";
        }
        if($SC!=""){
            $SCCC="AND asset_setup_sub_cat='$SC'";
        }
        $get_adjustment = DB::connection('mysql')->select("SELECT * FROM hr_asset_setup WHERE $descrip $CNNN $SCCC");
        if(count($get_adjustment)>0){
            return 1;
        }else{
            return 0;
        }
    }
    public function getComapny_defined_Tagging(Request $request){
        $table='<tbody id="Company_Defined_Tagging_Tbody">';
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_description')->get();
        if(count($data)>0){
            $i=0;
			$desccount=0;
            $rowcount=0;
            foreach($data as $de){
                $Asset_Desc=$de->asset_setup_description;
                $Asset_Desc_code=$de->asset_setup_ad;
                $catcount=0;
                $data_cat=HR_hr_Asset_setup::where([
                    ['asset_setup_description','=',$Asset_Desc],
                    ['asset_setup_tag','=','Asset Tag'],
                    ['asset_setup_status','=','1']
                ])->groupBy('asset_setup_category')->get();
                foreach($data_cat as $de_cat){
                    $Asset_Cat=$de_cat->asset_setup_category;
					$Asset_Cat_code=$de_cat->asset_setup_ac;
                    $subcount=0;
                    $data_sub=HR_hr_Asset_setup::where([
                        ['asset_setup_category','=',$Asset_Cat],
                        ['asset_setup_tag','=','Asset Tag'],
                        ['asset_setup_status','=','1']
                    ])->groupBy('asset_setup_sub_cat')->get();
                    foreach($data_sub as $de_cat_sub){
                        $rowcount++;
						$Asset_Sub=$de_cat_sub->asset_setup_sub_cat;
						$Asset_Sub_code=$de_cat_sub->asset_setup_sc;
						$asset_setup_id=$de_cat_sub->asset_setup_id;
						$Asset_Desc_codef="";
						$Asset_Cat_codef="";
						$Asset_Sub_codef="";
						if($Asset_Desc_code!=""){
							$Asset_Desc_codef=$Asset_Desc_code."-";
						}
						if($Asset_Sub_code!=""){
							$Asset_Sub_codef=$Asset_Sub_code."-";
						}
						if($Asset_Cat_code!=""){
							$Asset_Cat_codef=$Asset_Cat_code."-";
                        }
                        $Asset_tag_Example=$Asset_Desc_codef.$Asset_Cat_codef.$Asset_Sub_codef."000-001";
						$Asset_Desc2=$de_cat_sub->asset_setup_ad;
						$Asset_Cat2=$de_cat_sub->asset_setup_ac;
                        $Asset_Sub2=$de_cat_sub->asset_setup_sc;
                        $Asset_Desctitle=$de_cat_sub->asset_setup_description;
                        $Asset_Cattitle=$de_cat_sub->asset_setup_category;
                        $Asset_Subtitle=$de_cat_sub->asset_setup_sub_cat;
                        $data_asset=HR_hr_Asset::where([
                            ['asset_description','=',$Asset_Desc2],
                            ['asset_category_name','=',$Asset_Cat2],
                            ['asset_sub_category','=',$Asset_Sub2],
                            ['asset_transaction_status','!=','3']
                        ])->get();
                        $asset_count=count($data_asset);
                        $table.='<tr id="XX'.$rowcount.'">';
                        $table.='<td '.($asset_count==0? 'contenteditable="false"' : '').' id="A'.$rowcount.'" style="text-transform: capitalize" title="'.$Asset_Desctitle.'">'.$Asset_Desc.'</td>';
                        $table.='<td '.($asset_count==0? 'contenteditable="false"' : '').' id="B'.$rowcount.'" style="text-transform: uppercase" onkeyup="limit(this)" title="'.$Asset_Desc_code.'">'.($desccount==0? $Asset_Desc_code : '').'</td>';
                        $table.='<td '.($asset_count==0? 'contenteditable="false"' : '').' id="C'.$rowcount.'" style="text-transform: capitalize" title="'.$Asset_Cattitle.'">'.$Asset_Cat.'</td>';
                        $table.='<td '.($asset_count==0? 'contenteditable="false"' : '').' id="D'.$rowcount.'" style="text-transform: uppercase" onkeyup="limit(this)" title="'.$Asset_Cat_code.'">'.($catcount==0? $Asset_Cat_code : '').'</td>';
                        $table.='<td '.($asset_count==0? 'contenteditable="false"' : '').' id="E'.$rowcount.'" style="text-transform: capitalize" title="'.$Asset_Subtitle.'">'.$Asset_Sub.'</td>';
                        $table.='<td '.($asset_count==0? 'contenteditable="false"' : '').' id="F'.$rowcount.'" style="text-transform: uppercase" onkeyup="limit(this)" title="'.$Asset_Sub_code.'">'.($subcount==0? $Asset_Sub_code : '').'</td>';
                        $table.='<td><select class="form-control" onchange="SelectAction(\''.$rowcount.'\',\''.$de_cat_sub->id.'\')" id="SelectedAction'.$rowcount.'"><option value="">--Action--</option>';
                        if($asset_count==0){
                            // $table.='<option value="Save">Save Changes</option>';
                            $table.='<option value="Delete">Delete</option>';
                        }
                        $table.'</select></td>';
                        $table.='</tr>';
                        $Asset_Desc="";
						$Asset_Cat="";
						$Asset_Sub="";
						$desccount=1;
						$catcount=1;
                    }
                    $catcount=0;
                }
                $desccount=0;
				$i++;
            }
        }else{
            $table.='<tr>';
            $table.='<td></td>';
            $table.='<td></td>';
            $table.='<td></td>';
            $table.='<td></td>';
            $table.='<td></td>';
            $table.='<td></td>';
            $table.='<td></td>';
            $table.='</tr>';
        }
        $table.="</tbody>";
        return $table;
    }
    public function getComapny_defined_Tagging_site_and_location(Request $request){
        $table='<tbody id="SiteAndLocationComapnyDefinedTaggingTbody">';
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->orderBy('asset_setup_location')->get();
        $Loccc="";
		$DDD="";
        foreach($data as $de){
            if($Loccc==$de->asset_setup_location){
                $DDD="";
            }else{
                $Loccc=$de->asset_setup_location;
                $DDD=$de->asset_setup_location;
            }
            $table.="<tr>";
            $table.="<td>".$DDD."</td>";
            $table.="<td>".$de->asset_setup_site."</td>";
            $table.="</tr>";
        }
        $table.="</tbody>";
        return $table;
    }
    public function getAssetInfoAuditLogTbody(Request $request){
        $value=$request->value;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_tag','=',$value],
            ['transaction_action','=','Audited']
        ])->orderBy('log_date', 'DESC')->orderBy('log_time', 'DESC')->get();
        $content='';
        if(count($data)>0){
            foreach($data as $da){
                $audit_name=$da->transaction_ticket_no;
                $audit_data=HR_hr_audit::where([
                    ['audit_window_name','=',$audit_name],
                    ['audit_asset_tag','=',$value]
                ])->first();
                $at=(!empty($audit_data)? $audit_data->auditor : '');
                $user_data=User::find($at);
                $content.='<tr>';
                $content.='<td>';
                $content.=date("m-d-Y", strtotime($da->log_date));
                $content.='</td>';
                $content.='<td>';
                $content.=date("g:i a", strtotime($da->log_time));
                $content.='</td>';
                $content.='<td>';
                $content.=(!empty($user_data)? $user_data->name : '');
                $content.='</td>';
                $statusss="";
                if(!empty($audit_data)){
                    if($audit_data->audit_check=="1"){
                        $statusss="FOUND";
                    }
                    if($audit_data->audit_check=="0"){
                        $statusss="NOT FOUND";
                    }
                    if($audit_data->audit_check=="2"){
                        $statusss="ASSET UNASSIGNED TO THIS LOCATION";
                    }
                }
                
                $content.='<td>';
                $content.=$statusss;
                $content.='</td>';
                $content.='<td>';
                $content.=$da->transaction;
                $content.='</td>';
                $content.='<td>';
                $content.=(!empty($audit_data)? $audit_data->requestor : '');
                $content.='</td>';
                $content.='<td>';
                $content.=$da->log_action;
                $content.='</td>';
                $content.='<td>';
                $content.=$da->deny_reason;
                $content.='</td>';
                $content.='</tr>';
            }
        }else{
            $content.='<tr><td colspan="11" style="text-align:center;">No Audit Log Found</td></tr>';
        }
        


        return $content;
    }
    public function getAssetInfoTransactionLogTbody(Request $request){
        $value=$request->value;
        
        $data = DB::connection('mysql')->select("SELECT * FROM hr_asset_transaction_log
            JOIN hr_assets ON hr_assets.id=hr_asset_transaction_log.asset_tag
            WHERE hr_asset_transaction_log.asset_tag='$value'
            AND transaction_action!='Audited'
            ORDER BY asset_transaction_log_id DESC");
        $content='';
        if(!empty($data)){
            foreach($data as $rows){
                $content.='<tr>';
                $content.='<td>';
                $content.=$rows->asset_transaction_log_id;
                $content.='</td>';
                $content.='<td>';
                $content.=date("m-d-Y", strtotime($rows->audit_action_date));
                $content.='</td>';
                $content.='<td>';
                $content.=$rows->log_action_requestor;
                $content.='</td>';
                $content.='<td>';
                $content.=$rows->log_action;
                $content.='</td>';
                $content.='<td>';
                $content.=$rows->transaction_action;
                $content.='</td>';
                $content.='<td>';
                $content.=$rows->deny_reason;
                $content.='</td>';
                $content.='<td>';
                $content.=date("m-d-Y", strtotime($rows->log_date));
                $content.='</td>';
                $content.='<td>';
                $content.=date("g:i a", strtotime($rows->log_time));
                $content.='</td>';
                $content.='</tr>';
            }
        }else{
            $content.='<tr><td style="text-align:center;" colspan="8">No Log Found</td></tr>';
        }
        
        
        return $content;
    }
    public function getDefaultViewAssetList(Request $request){
        $table='<table class="table table-bordered table-hover table-sm" id="TableAsset" style="background-color:white; margin-top:10px;">';
        $table.='<thead style="background-color:#124f62; color:white;">';
        $table.='<tr>';
        $table.='<th width="15%">Asset</th><th width="15%">Category</th><th width="15%">Sub Category</th><th width="5%">Quantity</th><th width="5%">Item Out</th><th width="5%">Available</th>';
        $table.='</tr>';
        $table.='</thead>';
        $table.='<tbody style="cursor: pointer;">';
        $data = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE (asset_transaction_status!='3' AND asset_transaction_status!='4'AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5') AND asset_approval='1' GROUP BY asset_description, asset_category_name,asset_sub_category");
        if(!empty($data)){
            foreach($data as $rows){
                $desc=$rows->asset_description;
                $categ=$rows->asset_category_name;
                $subcateg=$rows->asset_sub_category;
                $desc_data=HR_hr_Asset_setup::where([
                    ['asset_setup_ad','=',$desc],
                    ['asset_setup_tag','!=','Deleted']
                ])->first();
                $cat=HR_hr_Asset_setup::where([
                    ['asset_setup_ac','=',$categ],
                    ['asset_setup_tag','!=','Deleted']
                ])->first();
                $cat_sub=HR_hr_Asset_setup::where([
                    ['asset_setup_sc','=',$subcateg],
                    ['asset_setup_tag','!=','Deleted']
                ])->first();
                $table.='<tr onclick="select_assets(\''.$desc.'\',\''.$categ.'\',\''.$subcateg.'\')">';
                $table.='<td style="vertical-align: middle;color:#083240;">'.(!empty($desc_data)? $desc_data->asset_setup_description: '').'</td>';
                $table.='<td style="vertical-align: middle;color:#083240;">'.(!empty($cat)? $cat->asset_setup_category: '').'</td>';
                $table.='<td style="vertical-align: middle;color:#083240;">'.(!empty($cat_sub)? $cat_sub->asset_setup_sub_cat: '').'</td>';
                $data1 = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_description='$desc' AND asset_category_name='$categ' AND asset_sub_category='$subcateg' AND (asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5') AND asset_approval='1'");
                $table.='<td style="vertical-align: middle;color:#083240;">'.count($data1).'</td>';
                $data2 = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_description='$desc' AND asset_category_name='$categ' AND asset_sub_category='$subcateg' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2' OR asset_transaction_status='4' OR asset_transaction_status='-1.7' OR asset_transaction_status='-1.8') AND asset_approval='1'");
                $table.='<td style="vertical-align: middle;color:#083240;">'.count($data2).'</td>';
                $data3 = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_description='$desc' AND asset_category_name='$categ' AND asset_sub_category='$subcateg' AND (asset_transaction_status='1' OR asset_transaction_status='2.1' OR asset_transaction_status='2.2' OR asset_transaction_status='4.2'OR asset_transaction_status='4.1' OR asset_transaction_status='3.2'OR asset_transaction_status='3.1') AND asset_approval='1'");
                $table.='<td style="vertical-align: middle;color:#083240;">'.count($data3).'</td>';
                $table.='</tr>';
            }
            
        }else{
            $table.='<tr>';
            $table.='<td colspan="6" style="font-weight:bold;text-align:center;">No Asset Found</td>';
            $table.='</tr>';
        }
        $table.='</tbody>';
        $table.='</table>';



        return $table;
    }
    public function getColumnAssetList(Request $request){
        $h1=$request->h1;
        $h2=$request->h2;
        $h3=$request->h3;
        $h4=$request->h4;
        $h5=$request->h5;
        $h6=$request->h6;
        $h7=$request->h7;
        $h8=$request->h8;
        $h9=$request->h9;
        $h10=$request->h10;
        $h14=$request->h14;
        $h15=$request->h15;
        $h16=$request->h16;
        
        $h11=0;
        $h12=0;
        $h13=0;

        if($h1==0 && $h6==0 && $h7==0 && $h8==0 && $h9==0 && $h10==0 && $h14==0 && $h15==0 && $h2==1 && $h3==1 && $h4==1 && $h5==1 && $h16==0){
        $h11=1;
        $h12=1;
        $h13=1;
            
        }
        $table='';
        if($h16==0){
            $table.='<table class="table table-bordered table-hover table-sm" id="TableAsset" style="background-color:white; margin-top:10px;">';
            $table.='<thead style="background-color:#124f62; color:white;">';
            $table.='<tr>';
            $table.='<th '.($h1==0? 'style="display:none;"'  : '').'>Asset Tag</th>';
            $table.='<th '.($h2==0? 'style="display:none;"'  : '').'>Asset</th>';
            $table.='<th '.($h3==0? 'style="display:none;"'  : '').'>Asset Type</th>';
            $table.='<th '.($h4==0? 'style="display:none;"'  : '').'>Category Name</th>';
            $table.='<th '.($h5==0? 'style="display:none;"'  : '').'>Sub Category</th>';
            $table.='<th '.($h6==0? 'style="display:none;"'  : '').'>Brand</th>';
            $table.='<th '.($h7==0? 'style="display:none;"'  : '').'>Department</th>';
            $table.='<th '.($h8==0? 'style="display:none;"'  : '').'>Availabiliy</th>';
            $table.='<th '.($h9==0? 'style="display:none;"'  : '').'>Status</th>';
            $table.='<th '.($h10==0? 'style="display:none;"'  : '').'>Condition</th>';
            $table.='<th '.($h14==0? 'style="display:none;"'  : '').'>Site</th>';
            $table.='<th '.($h15==0? 'style="display:none;"'  : '').'>Location</th>';
            $table.='<th '.($h11==0? 'style="display:none;"'  : '').' width="5%">Quantity</th>';
            $table.='<th '.($h12==0? 'style="display:none;"'  : '').' width="5%">Item Out</th>';
            $table.='<th '.($h13==0? 'style="display:none;"'  : '').' width="5%">Available</th>';
            
            $table.='</tr>';
            $table.='</thead>';
            $table.='<tbody style="cursor: pointer;">';
            $data = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE (asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5') AND asset_approval='1'");
            if(!empty($data)){
                foreach($data as $rows){
                    $desc=$rows->asset_description;
                    $categ=$rows->asset_category_name;
                    $subcateg=$rows->asset_sub_category;
                    $desc_data=HR_hr_Asset_setup::where([
                        ['asset_setup_ad','=',$desc],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first();
                    $cat=HR_hr_Asset_setup::where([
                        ['asset_setup_ac','=',$categ],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first();
                    $cat_sub=HR_hr_Asset_setup::where([
                        ['asset_setup_sc','=',$subcateg],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first(); 
                    $table.='<tr onclick="select_assets_id(\''.$rows->id.'\')">';
                    $table.='<td '.($h1==0? 'style="display:none;"'  : '').'>'.$rows->asset_tag.'</td>';
                    $table.='<td '.($h2==0? 'style="display:none;"'  : '').'>'.(!empty($desc_data)? $desc_data->asset_setup_description: '').'</td>';
                    $table.='<td '.($h3==0? 'style="display:none;"'  : '').'></td>';
                    $table.='<td '.($h4==0? 'style="display:none;"'  : '').'>'.(!empty($cat)? $cat->asset_setup_category: '').'</td>';
                    $table.='<td '.($h5==0? 'style="display:none;"'  : '').'>'.(!empty($cat_sub)? $cat_sub->asset_setup_sub_cat: '').'</td>';
                    $table.='<td '.($h6==0? 'style="display:none;"'  : '').'>'.$rows->asset_brand.'</td>';
                    $coddd=$rows->asset_department_code;
                    $department=HR_Company_Department::where([
                        ['department_id','=',$coddd]
                    ])->first();
                    $table.='<td '.($h7==0? 'style="display:none;"'  : '').'>'.(!empty($department)? $department->department_name: '').'</td>';
                    
                    $table.='<td '.($h8==0? 'style="display:none;"'  : '').'>';
                    if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.2" || $rows->asset_transaction_status=="2.1"  ){
						$table.="Yes";
						
					}
					if($rows->asset_transaction_status=="4.2" || $rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
						$table.="Yes";
					}
					if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.2" || $rows->asset_transaction_status=="1.1"){
						$table.="No";
					}
					if($rows->asset_transaction_status=="4" || $rows->asset_transaction_status=="-1.7" || $rows->asset_transaction_status=="-1.8"){
						$table.="No";
					}
                    $table.='</td>';
                    $table.='<td '.($h9==0? 'style="display:none;"'  : '').'>';
                    if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.2" || $rows->asset_transaction_status=="2.1"  ){
						$table.="N/A";
						
					}
					if($rows->asset_transaction_status=="4.2" || $rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
						$table.="N/A";
					}
					if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.2" || $rows->asset_transaction_status=="1.1"){
						$table.="Checked Out";
					}
					if($rows->asset_transaction_status=="4" || $rows->asset_transaction_status=="-1.7" || $rows->asset_transaction_status=="-1.8"){
						$table.="Maintenance";
					}
                    $table.='</td>';
                    
                    $table.='<td '.($h10==0? 'style="display:none;"'  : '').'>'.$rows->asset_condition.'</td>';
                    $table.='<td '.($h14==0? 'style="display:none;"'  : '').'>'.$rows->asset_site.'</td>';
                    $table.='<td '.($h15==0? 'style="display:none;"'  : '').'>'.$rows->asset_location.'</td>';
                    $data1 = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_description='$desc' AND asset_category_name='$categ' AND asset_sub_category='$subcateg' AND (asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5') AND asset_approval='1'");
                    $table.='<td '.($h11==0? 'style="display:none;"'  : '').''.count($data1).'</td>';
                    $data2 = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_description='$desc' AND asset_category_name='$categ' AND asset_sub_category='$subcateg' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2' OR asset_transaction_status='4' OR asset_transaction_status='-1.7' OR asset_transaction_status='-1.8') AND asset_approval='1'");
                    $table.='<td '.($h12==0? 'style="display:none;"'  : '').''.count($data2).'</td>';
                    $data3 = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_description='$desc' AND asset_category_name='$categ' AND asset_sub_category='$subcateg' AND (asset_transaction_status='1' OR asset_transaction_status='2.1' OR asset_transaction_status='2.2' OR asset_transaction_status='4.2'OR asset_transaction_status='4.1' OR asset_transaction_status='3.2'OR asset_transaction_status='3.1') AND asset_approval='1'");
                    $table.='<td '.($h13==0? 'style="display:none;"'  : '').'>'.count($data3).'</td>';
                    $table.='</tr>';
                }
                
            }else{
                $table.='<tr>';
                $table.='<td colspan="6" style="font-weight:bold;text-align:center;">No Asset Found</td>';
                $table.='</tr>';
            }
            $table.='</tbody>';
            $table.='</table>';
        }


        return $table;
    }
    public function getselected_assets_modal(Request $request){
        $desc=$_POST['desc'];
        $cat=$_POST['cat'];
        $sub=$_POST['sub'];
        $body='';
        $body.='<tbody id="selected_asset_tbody_sadas">';
                                                
        $data = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' AND  asset_description='$desc' AND asset_category_name='$cat' AND asset_sub_category='$sub'");
            if(!empty($data)){
                foreach($data as $rows){
                    $body.='<tr>';
                    $ViewAssetTag=$rows->asset_tag;
					$ViewAssetDesc=$rows->asset_description;
					$ViewAssetCategoryName=$rows->asset_category_name;
					$ViewAssetSub=$rows->asset_sub_category;
					$ViewAssetSerialNumber=$rows->asset_serial_number;
					$sku_code=$rows->sku_code;
					if($ViewAssetSub!=""){
						//$ViewAssetSub1="SC - ".$ViewAssetSub."%0A";
						$ViewAssetSub1="";
						
					}
					if($ViewAssetSerialNumber!=""){
						$ViewAssetSerialNumber1="SN-".$ViewAssetSerialNumber."%0A";
						
					}
					if($sku_code!=""){
						$sku_code1="PN-".$sku_code."%0A";
						
                    }
                    $desc_data=HR_hr_Asset_setup::where([
                        ['asset_setup_ad','=',$ViewAssetDesc],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first();
                    $DescNameFull=!empty($desc_data)? $desc_data->asset_setup_description: '';
                    $cat=HR_hr_Asset_setup::where([
                        ['asset_setup_ac','=',$ViewAssetCategoryName],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first();
                    $CategoryNameFull=!empty($cat)? $cat->asset_setup_category: '';
                    $qrdata="https://api.qrserver.com/v1/create-qr-code/?data=".$ViewAssetTag."%0A"."AD-".$DescNameFull."%0A"."Cat-".$CategoryNameFull."%0A".$ViewAssetSub1."".$ViewAssetSerialNumber1."".$sku_code1."&amp;size=150x150";
                    $body.='<td style="text-align:center;"><img id="barcode"  src="'.$qrdata.'" alt="" title="'.$ViewAssetTag.' '.$DescNameFull.'" width="100" height="100" /></td>';
                    $body.='<td style="text-align:center;"><a href="asset?page=3&AssetTagID='.$rows->id.'">'.$rows->asset_tag.'</a></td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_brand.'</td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_department_code.'</td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_location.'</td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_condition.'</td>';
                    $body.='<td style="text-align:center;" >';
                    if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.2" || $rows->asset_transaction_status=="2.1"  ){
						$body.="Yes";
						
					}
					if($rows->asset_transaction_status=="4.2" || $rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
						$body.="Yes";
					}
					if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.2" || $rows->asset_transaction_status=="1.1"){
						$body.="No";
					}
					if($rows->asset_transaction_status=="4" || $rows->asset_transaction_status=="-1.7" || $rows->asset_transaction_status=="-1.8"){
						$body.="No";
					}
                    $body.='</td>';
                    $body.='<td style="text-align:center;">';
                    if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.2" || $rows->asset_transaction_status=="2.1"  ){
						$body.="N/A";
						
					}
					if($rows->asset_transaction_status=="4.2" || $rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
						$body.="N/A";
					}
					if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.2" || $rows->asset_transaction_status=="1.1"){
						$body.="Checked Out";
					}
					if($rows->asset_transaction_status=="4" || $rows->asset_transaction_status=="-1.7" || $rows->asset_transaction_status=="-1.8"){
						$body.="Maintenance";
					}
                    $body.='</td>';
                    $body.='</tr>';
                }
            }
        $body.='</tbody>';

        return $body;
    }
    public function getselected_asset_modal_individual(Request $request){
        $id=$_POST['id'];
        
        $body='';
        $body.='<tbody id="selected_asset_tbody_sadas">';
                                                
        $data = DB::connection('mysql')->select("SELECT * FROM hr_assets WHERE id='$id'");
            if(!empty($data)){
                foreach($data as $rows){
                    $body.='<tr>';
                    $ViewAssetTag=$rows->asset_tag;
					$ViewAssetDesc=$rows->asset_description;
					$ViewAssetCategoryName=$rows->asset_category_name;
					$ViewAssetSub=$rows->asset_sub_category;
					$ViewAssetSerialNumber=$rows->asset_serial_number;
					$sku_code=$rows->sku_code;
					if($ViewAssetSub!=""){
						//$ViewAssetSub1="SC - ".$ViewAssetSub."%0A";
						$ViewAssetSub1="";
						
					}
					if($ViewAssetSerialNumber!=""){
						$ViewAssetSerialNumber1="SN-".$ViewAssetSerialNumber."%0A";
						
					}
					if($sku_code!=""){
						$sku_code1="PN-".$sku_code."%0A";
						
                    }
                    $desc_data=HR_hr_Asset_setup::where([
                        ['asset_setup_ad','=',$ViewAssetDesc],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first();
                    $DescNameFull=!empty($desc_data)? $desc_data->asset_setup_description: '';
                    $cat=HR_hr_Asset_setup::where([
                        ['asset_setup_ac','=',$ViewAssetCategoryName],
                        ['asset_setup_tag','!=','Deleted']
                    ])->first();
                    $CategoryNameFull=!empty($cat)? $cat->asset_setup_category: '';
                    $qrdata="https://api.qrserver.com/v1/create-qr-code/?data=".$ViewAssetTag."%0A"."AD-".$DescNameFull."%0A"."Cat-".$CategoryNameFull."%0A".$ViewAssetSub1."".$ViewAssetSerialNumber1."".$sku_code1."&amp;size=150x150";
                    $body.='<td style="text-align:center;"><img id="barcode"  src="'.$qrdata.'" alt="" title="'.$ViewAssetTag.' '.$DescNameFull.'" width="100" height="100" /></td>';
                    $body.='<td style="text-align:center;"><a href="asset?page=3&AssetTagID='.$rows->id.'">'.$rows->asset_tag.'</a></td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_brand.'</td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_department_code.'</td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_location.'</td>';
                    $body.='<td style="text-align:center;">'.$rows->asset_condition.'</td>';
                    $body.='<td style="text-align:center;" >';
                    if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.2" || $rows->asset_transaction_status=="2.1"  ){
						$body.="Yes";
						
					}
					if($rows->asset_transaction_status=="4.2" || $rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
						$body.="Yes";
					}
					if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.2" || $rows->asset_transaction_status=="1.1"){
						$body.="No";
					}
					if($rows->asset_transaction_status=="4" || $rows->asset_transaction_status=="-1.7" || $rows->asset_transaction_status=="-1.8"){
						$body.="No";
					}
                    $body.='</td>';
                    $body.='<td style="text-align:center;">';
                    if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.2" || $rows->asset_transaction_status=="2.1"  ){
						$body.="N/A";
						
					}
					if($rows->asset_transaction_status=="4.2" || $rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
						$body.="N/A";
					}
					if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.2" || $rows->asset_transaction_status=="1.1"){
						$body.="Checked Out";
					}
					if($rows->asset_transaction_status=="4" || $rows->asset_transaction_status=="-1.7" || $rows->asset_transaction_status=="-1.8"){
						$body.="Maintenance";
					}
                    $body.='</td>';
                    $body.='</tr>';
                }
            }
        $body.='</tbody>';

        return $body;
    }
}
