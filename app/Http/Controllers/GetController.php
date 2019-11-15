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
}
