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
class AssetPostController extends Controller
{
    //
    public function update_asset_information(Request $request){
        $AssetTag=$request->AssetTagID; 
		// $AssetType=$request->AssetType;
		$NewAssignTO=$request->NewAssignTO; 
		$AssetDescription=$request->AssetDescription;
		$SerialNumber=$request->SerialNumber;
		$Manufacturer=$request->Manufacturer;
		$Model=$request->Model;
		$CategoryName=$request->CategoryName;
		$AssetCondition=$request->AssetCondition;
		$AssetSite=$request->AssetSite;
		$AssetLocation=$request->AssetLocation;
		$DepartmentCode=$request->DepartmentCode;
		$assigntoview=$request->assigntoview;
		$Brand=$request->Brand;
		$vendor_number=$request->vendor_name; 
		$purchase_order=$request->purchase_Order; 
		$purchase_date=$request->purchaseDate222; 
		$purchase_cost=$request->Purchase_Cost222; 
		$initial_value=$request->INITVALLL; 
		$depreciation_frequency=$request->Freq; 
		$useful_life_span=$request->usefultime; 
		$depreciation_cost=$request->depcost223123; 
		$current_value=$request->curvaluesss; 
		$salvage_value=$request->SalvageCVAAS; 
		$depreciable_value=$request->DEPVal222; 
		$sku_code=$request->AssetSKU; 
		$SubCategory=$request->SubCategory;
		
		$depreciation_date=$request->depreciation_date2; 
        $invoice_number=$request->invoice_number2; 
        
        $data= HR_hr_Asset::find($request->AssetID);
        $data->asset_tag=$AssetTag;
        $data->asset_description=$AssetDescription;
        $data->asset_serial_number=$SerialNumber;
        $data->asset_manufacturer=$Manufacturer;
        $data->asset_brand=$Brand;
        $data->asset_model=$Model;
        $data->asset_category_name=$CategoryName;
        $data->asset_sub_category=$SubCategory;
        $data->asset_condition=$AssetCondition;
        $data->asset_site=$AssetSite;
        $data->asset_location=$AssetLocation;
        $data->asset_department_code=$DepartmentCode;
        $data->asset_assign_to=$NewAssignTO;
        $data->vendor_number=$vendor_number;
        $data->purchase_order=$purchase_order;
        $data->purchase_date=$purchase_date;
        $data->purchase_cost=$purchase_cost;
        $data->initial_value=$initial_value;
        $data->salvage_value=$salvage_value;
        $data->depriciable_value=$depreciable_value;
        $data->depreciation_frequency=$depreciation_frequency;
        $data->useful_life_span=$useful_life_span;
        $data->depreciation_cost=$depreciation_cost;
        $data->current_cost=$current_value;
        $data->assigned_to_temp=$assigntoview;
        $data->asset_assign_to=$assigntoview;
        $data->sku_code=$sku_code;
        $data->depreciation_date=$depreciation_date;
        $data->invoice_number=$invoice_number;
        if($data->save()){
            
        }
    }
    public function update_asset_information_denied(Request $request){
        $AssetTag=$request->AssetTagID; 
		// $AssetType=$request->AssetType;
		$NewAssignTO=$request->NewAssignTO; 
		$AssetDescription=$request->AssetDescription;
		$SerialNumber=$request->SerialNumber;
		$Manufacturer=$request->Manufacturer;
		$Model=$request->Model;
		$CategoryName=$request->CategoryName;
		$AssetCondition=$request->AssetCondition;
		$AssetSite=$request->AssetSite;
		$AssetLocation=$request->AssetLocation;
		$DepartmentCode=$request->DepartmentCode;
		$assigntoview=$request->assigntoview;
		$Brand=$request->Brand;
		$vendor_number=$request->vendor_name; 
		$purchase_order=$request->purchase_Order; 
		$purchase_date=$request->purchaseDate222; 
		$purchase_cost=$request->Purchase_Cost222; 
		$initial_value=$request->INITVALLL; 
		$depreciation_frequency=$request->Freq; 
		$useful_life_span=$request->usefultime; 
		$depreciation_cost=$request->depcost223123; 
		$current_value=$request->curvaluesss; 
		$salvage_value=$request->SalvageCVAAS; 
		$depreciable_value=$request->DEPVal222; 
		$sku_code=$request->AssetSKU; 
		$SubCategory=$request->SubCategory;
		
		$depreciation_date=$request->depreciation_date2; 
        $invoice_number=$request->invoice_number2; 
        
        $data= HR_hr_Asset::find($request->AssetID);
        $data->asset_tag=$AssetTag;
        $data->asset_description=$AssetDescription;
        $data->asset_serial_number=$SerialNumber;
        $data->asset_manufacturer=$Manufacturer;
        $data->asset_brand=$Brand;
        $data->asset_model=$Model;
        $data->asset_category_name=$CategoryName;
        $data->asset_sub_category=$SubCategory;
        $data->asset_condition=$AssetCondition;
        $data->asset_site=$AssetSite;
        $data->asset_location=$AssetLocation;
        $data->asset_department_code=$DepartmentCode;
        $data->asset_assign_to=$NewAssignTO;
        $data->vendor_number=$vendor_number;
        $data->purchase_order=$purchase_order;
        $data->purchase_date=$purchase_date;
        $data->purchase_cost=$purchase_cost;
        $data->initial_value=$initial_value;
        $data->salvage_value=$salvage_value;
        $data->depriciable_value=$depreciable_value;
        $data->depreciation_frequency=$depreciation_frequency;
        $data->useful_life_span=$useful_life_span;
        $data->depreciation_cost=$depreciation_cost;
        $data->current_cost=$current_value;
        $data->assigned_to_temp=$assigntoview;
        $data->asset_assign_to=$assigntoview;
        $data->sku_code=$sku_code;
        $data->depreciation_date=$depreciation_date;
        $data->invoice_number=$invoice_number;
        $data->asset_approval='-1';
        if($data->save()){
            $this->generate_transaction_log_denied_am($data->asset_setcheck_defualt,$data->id,'New Asset','Queued on AM','','');
            
        }
    }
    
    public function add_new_asset(Request $request){
        
        $AssetTag=$request->AssetTag;
		// $AssetType=$request->AssetType;
		$NewAssignTO=$request->NewAssignTO;
		$AssetDescription=$request->AssetDescription;
		$SerialNumber=$request->SerialNumber;
		$Manufacturer=$request->Manufacturer;
		$Model=$request->Model;
		$CategoryName=$request->CategoryName;
		$AssetCondition=$request->AssetCondition;
		$AssetSite=$request->AssetSite;
		$AssetLocation=$request->AssetLocation;
		$DepartmentCode=$request->DepartmentCode;
		
		$Brand=$request->Brand;
		$vendor_number=$request->vendor_number;
		$purchase_order=$request->purchase_order;
		$purchase_date=$request->purchase_date;
		$purchase_cost=$request->purchase_cost;
		$initial_value=$request->initial_value;
		$depreciation_frequency=$request->depreciation_frequency;
		$useful_life_span=$request->useful_life_span;
		$depreciation_cost=$request->depreciation_cost;
		$current_value=$request->current_value;
		$salvage_value=$request->salvage_value;
		$depreciable_value=$request->depreciable_value;
		$dataentry=$request->dataentry;
		$sku_code=$request->AssetSKU;
		$SubCategory=$request->SubCategory;
		// $AssetUOM=$request->AssetUOM;
		// $AssetUOMAmount=$request->AssetUOMAmount;
		// $StorageAsset=$request->StorageAsset;
		$depreciation_date=$request->depreciation_date;
        $invoice_number=$request->invoice_number;
        // if (!file_exists('Files/Asset_attachment/'.$AssetTag)) {
        //     mkdir('Files/Asset_attachment/'.$AssetTag, 0777, true);
        // }
        $now=date("Y-m-d");
        $data_count=HR_hr_Asset::where([
            ['asset_tag','=',$AssetTag]
        ])->get();
        if(!empty($data_count)){
            $gen=$this->generate_id();
            $SetCheckOut=$gen;
            $data= new HR_hr_Asset;
            $data->asset_tag=$AssetTag;
            $data->asset_description=$AssetDescription;
            $data->asset_serial_number=$SerialNumber;
            $data->asset_manufacturer=$Manufacturer;
            $data->asset_brand=$Brand;
            $data->asset_model=$Model;
            $data->asset_category_name=$CategoryName;
            $data->asset_sub_category=$SubCategory;
            $data->asset_condition=$AssetCondition;
            $data->asset_site=$AssetSite;
            $data->asset_location=$AssetLocation;
            $data->asset_department_code=$DepartmentCode;
            $data->asset_setcheck_defualt=$SetCheckOut;
            $data->asset_transaction_status='1';
            $data->asset_assign_to=$NewAssignTO;
            $data->assigned_to_temp=$NewAssignTO;
            
            $data->vendor_number=$vendor_number;
            $data->purchase_order=$purchase_order;
            $data->purchase_date=$purchase_date;
            $data->purchase_cost=$purchase_cost;
            $data->initial_value=$initial_value;
            $data->salvage_value=$salvage_value;
            $data->depriciable_value=$depreciable_value;
            $data->depreciation_frequency=$depreciation_frequency;
            $data->useful_life_span=$useful_life_span;
            $data->depreciation_cost=$depreciation_cost;
            $data->current_cost=$current_value;
            $data->asset_approval='-1';
            $data->date_added=$now;
            $data->data_entry_by=$dataentry;
            $data->sku_code=$sku_code;
            $data->depreciation_date=$depreciation_date;
            $data->invoice_number=$invoice_number;
            if($data->save()){
                $this->generate_transaction_log($gen,$data->id,'New Asset','Queued on AM','','');
                return 1;
            }
            
        }else{
            return 0;
        }
    }
    public function NewAssetFirstApprove(Request $request){
        $tag=$request->tag;
        $data=HR_hr_Asset::find($tag);
        $data->asset_approval='0';
        if($data->save()){
            $this->generate_transaction_log_confirmation($data->asset_setcheck_defualt,$tag,'New Asset','Queued on FA','','');
        }
    }
    public function AssetSetupFirstApprove(Request $request){
        $tag=$request->tag;
        $data=HR_hr_Asset_setup::find($tag);
        $data->asset_setup_status='2';
        if($data->save()){
            $this->generate_transaction_log_confirmation($data->ticket_no,$data->asset_setup_tag,'Asset Setup','Queued on FA',$tag,'');
        }
    }
    public function NewAssetSecondApprove(Request $request){
        $tag=$request->tag;
        $data=HR_hr_Asset::find($tag);
        $data->asset_approval='1';
        if($data->save()){
            $this->generate_transaction_log_approve($data->asset_setcheck_defualt,$tag,'New Asset','Approved','','');
        }
    }
    public function AssetSetupSecondApprove(Request $request){
        $tag=$request->tag;
        
        $data=HR_hr_Asset_setup::find($tag);
        $data->asset_setup_status='1';
        if($data->save()){
            $this->generate_transaction_log_approve($data->ticket_no,$data->asset_setup_tag,'Asset Setup','Approved',$tag,'');
        }
    }
    public function DisposeAssetSetup2(Request $request){
        $tag=$request->tag;
        $reason=$request->reason;
        $data=HR_hr_Asset_setup::find($tag);
        $data->asset_setup_status='3';
        if($data->save()){
            $this->generate_transaction_log_deny_fa($data->ticket_no,$data->asset_setup_tag,'Asset Setup','Denied by FA',$tag,$reason);
        }
    }
    public function NewAssetDenySecond(Request $request){
        $tag=$request->tag;
        $reason=$request->reason;
        $data=HR_hr_Asset::find($tag);
        $data->asset_approval='-1';
        if($data->save()){
            $this->generate_transaction_log_deny_fa($data->asset_setcheck_defualt,$tag,'New Asset','Denied by FA','',$reason);
        }
    }
    public function NewAssetDeny(Request $request){
        $tag=$request->tag;
        $reason=$request->reason;
        $data=HR_hr_Asset::find($tag);
        $data->asset_approval='-11';
        if($data->save()){
            $this->generate_transaction_log_deny_am($data->asset_setcheck_defualt,$tag,'New Asset','Denied','',$reason);
        }
    }
    public function DisposeAssetSetup(Request $request){
        $tag=$request->tag;
        $reason=$request->reason;
        $data=HR_hr_Asset_setup::find($tag);
        $data->asset_setup_status='0';
        if($data->save()){
            $this->generate_transaction_log_deny_am($data->ticket_no,$data->asset_setup_tag,'Asset Setup','Denied',$tag,$reason);
        }
    }
    public function delete_request_new_asset(Request $request){
        $tag=$request->id;
        $data=HR_hr_Asset::find($tag);
        $data->asset_approval='DELETED';
        if($data->save()){
            $this->generate_transaction_log_delete($data->asset_setcheck_defualt,$tag,'New Asset','Deleted','','');
        }
    }
    public function delete_request_asset_setup(Request $request){
        $tag=$request->id;
        
        $data=HR_hr_Asset_setup::find($tag);
        $data->asset_setup_status='DELETED';
        if($data->save()){
            $this->generate_transaction_log_deny_am($data->ticket_no,$data->asset_setup_tag,'Asset Setup','Denied',$tag,'');
        }
    }
    public function DeleteTagging(Request $request){
        $data= HR_hr_Asset_setup::find($request->id);
        $data->asset_setup_status="";
        $data->asset_setup_tag="Deleted";
        if($data->save()){
            return 1;
        }else{
            return 2;
        }
    }
    public function add_asset_setup_request(Request $request){
        //return $this->generate_id();
        $gen=$this->generate_id();
        $setup_require_serial="0";
        $RequirePlateNumber="0";
        if ($request->has('RequireSerial')) {
            $setup_require_serial="1";
        }else{
            $setup_require_serial="0";
        }
        if ($request->has('RequirePlateNumber')) {
            $RequirePlateNumber="1";
        }else{
            $RequirePlateNumber="0";
        }
        $data= new HR_hr_Asset_setup;
        $data->asset_setup_tag=$request->asset_setup_type;
        if($request->asset_setup_type=="Asset Tag"){
            $data->asset_setup_description=$request->AssetDescriptionSetup;
            $data->asset_setup_category=$request->CategoryNameSetup;
            $data->asset_setup_sub_cat=$request->SubCategorySetup;
            $data->asset_setup_ad=$request->AD_COde;
            $data->asset_setup_ac=$request->CN_COde;
            $data->asset_setup_sc=$request->SC_COde;
            //plate number required
            $data->asset_setup_sku=$RequirePlateNumber;
            //serial number
            $data->uom=$setup_require_serial;
            
            
        }else{
            $data->asset_setup_site=$request->SiteSetup2;
            $data->asset_setup_location=$request->LocationSetup2;
        }
        $data->ticket_no=$gen;
        $data->requested_by=Auth::user()->id;
        if($data->save()){
            $this->generate_transaction_log($gen,$request->asset_setup_type,'Asset Setup','Queued on AM',$data->id,'');
        }
    }
    function update_asset_setup_site_and_location(Request $request){
        //return $this->generate_id();
        
        $setup_require_serial="0";
        $RequirePlateNumber="0";
        if ($request->has('RequireSerial')) {
            $setup_require_serial="1";
        }else{
            $setup_require_serial="0";
        }
        if ($request->has('RequirePlateNumber')) {
            $RequirePlateNumber="1";
        }else{
            $RequirePlateNumber="0";
        }
        $data= HR_hr_Asset_setup::find($request->Asset_Setup_ID);
        $data->asset_setup_tag=$request->asset_setup_type;
        if($request->asset_setup_type=="Asset Tag"){
            $data->asset_setup_description=$request->AssetDescriptionSetup;
            $data->asset_setup_category=$request->CategoryNameSetup;
            $data->asset_setup_sub_cat=$request->SubCategorySetup;
            $data->asset_setup_ad=$request->AD_COde;
            $data->asset_setup_ac=$request->CN_COde;
            $data->asset_setup_sc=$request->SC_COde;
            //plate number required
            $data->asset_setup_sku=$RequirePlateNumber;
            //serial number
            $data->uom=$setup_require_serial;
            
            
        }else{
            $data->asset_setup_site=$request->SiteSetup2Edit;
            $data->asset_setup_location=$request->LocationSetup2Edit;
        }
        $data->asset_setup_status='3';
        if($data->save()){
            $this->generate_transaction_log_denied_am($data->ticket_no,$data->asset_setup_tag,'Asset Setup','Queued on AM',$request->Asset_Setup_ID,'');
        }  
    }
}
