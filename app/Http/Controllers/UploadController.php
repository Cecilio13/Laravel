<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
use App\HR_hr_employee_adjustment;

use Auth;
use App\HR_hr_Asset_setup;
use Illuminate\Support\Facades\DB;
class UploadController extends Controller
{
    public function downloadexceltemplate_adjustment(Request $request){
        
        
        $streamedResponse = new StreamedResponse();
        $streamedResponse->setCallback(function () {
            //load spreadsheet
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("extra/import_file/employee_salary_adjustment.xlsx");

            //change it
            $sheet = $spreadsheet->getActiveSheet();
            $result=HR_hr_employee_info::all();
            $index=2;
            foreach($result as $data){
                $sheet->setCellValue('A'.$index, $data->employee_id);
                $sheet->setCellValue('B'.$index, $data->fname." ".$data->lname);
                $index++;
            }
            //write it again to Filesystem with the same name (=replace)
            $writer = new Xlsx($spreadsheet);
            // $writer->save('extra/import_file/yourspreadsheet.xlsx');
            $writer->save('php://output');
        });
        $streamedResponse->setStatusCode(Response::HTTP_OK);
        $streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $streamedResponse->headers->set('Content-Disposition', 'attachment; filename="Employee Salary Adjustment Template.xlsx"');
        return $streamedResponse->send();
    }
    public function UploadMassAdjustment(Request $request){
        $file = $request->file('theFile');
        $path = $file->getRealPath();
        $inputFileName = $path;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $error_count=0;
        $saved_count=0;
        $countloop=0;
        $rowcount=0;
        $extra="";
        $Log="";
        $payroll_id=$request->payroll_id;
        foreach ($worksheet->getRowIterator() as $row) {
            $rowcount++;
            
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            if($rowcount>1){
                $countloop++;
                $column=1;
                $system_id="";
                $employee_name="";
                $adjustment_name="";
                $adjustment_type="";
                $adjsutment_code="";
                $amount="";
                $apply_before="";
                $taxable="";
                
                foreach ($cellIterator as $cell) {
                    if($column<8){
                        if($column==1){
                            $system_id=$cell->getCalculatedValue();
                        }
                        if($column==2){
                            $employee_name=$cell->getCalculatedValue();
                        }
                        if($column==3){
                            $adjustment_name=$cell->getCalculatedValue();
                        }
                        if($column==4){
                            $adjustment_type=$cell->getCalculatedValue();
                        }
                        if($column==5){
                            $adjsutment_code=$cell->getCalculatedValue();
                        }
                        if($column==6){
                            $amount=$cell->getCalculatedValue();
                        }
                        if($column==7){
                            $apply_before=$cell->getCalculatedValue();
                        }
                        if($column==8){
                            $taxable=$cell->getCalculatedValue();
                        }
                        
                    }
                    $column++;
                }
                if($system_id!=''){
                    if($amount!=''){
                        if(is_numeric($amount)){
                            $data=new HR_hr_employee_adjustment;
                            $data->employee_adjustment_type=$adjustment_type;
                            $data->employee_adjustment_name=$adjustment_name;
                            $data->employee_adjustment_code=$adjsutment_code;
                            $data->employee_adjustment_amount=$amount;
                            $data->employee_adjustment_apply_before=$apply_before=="YES"? '1' : '0';
                            $data->employee_adjustment_taxable=$taxable=="YES"? '1' : '0';
                            $data->employee_adjustment_remarks="";
                            $data->employee_adjustment_payroll_id=$payroll_id;
                            $data->employee_adjustment_emp_id=$system_id;
                            $data->employee_adjustment_active="1";
                            $data->save();
                            $saved_count++;
                        }else{
                            $error_count++;
                            $Log.="invalid Amount on row ".$rowcount." from file.\n";  
                        }
                        
                    }else{
                        $error_count++;
                        $Log.="Empty Amount on row ".$rowcount." from file.\n";  
                    }
                }else{
                    $error_count++;
                    $Log.="Empty system id on row ".$rowcount." from file.\n";  
                }

            }
            
        }
        $data = array(
            'Success' => $saved_count,
            'Total' => $countloop,
            'Skiped'  => $error_count,
            'Error_Log' =>$Log,
            'Extra'=>$extra
        );
        return json_encode($data);
        
    }
    public function UploadMassEmployee(Request $request){
        //generate excel
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World :____))) !');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello w222orld.xlsx');

        //read excel
        $file = $request->file('theFile');
        $path = $file->getRealPath();
        $inputFileName = $path;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $error_count=0;
        $saved_count=0;
        $countloop=0;
        $rowcount=0;
        $extra="";
        $Log="";
        foreach ($worksheet->getRowIterator() as $row) {
            $rowcount++;
            
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            if($rowcount>1){
                $countloop++;
                $column=1;
                $company_id="";
                $biometrics_id="";
                $fname="";
                $mname="";
                $lname="";
                $gender="";
                $civil_status="";
                $date_of_birth="";
                $Address="";
                foreach ($cellIterator as $cell) {
                    
                    if($column<9){
                        if($column==1){
                            $company_id=$cell->getCalculatedValue();
                        }
                        if($column==2){
                            $biometrics_id=$cell->getCalculatedValue();
                        }
                        if($column==3){
                            $fname=$cell->getCalculatedValue();
                        }
                        if($column==4){
                            $mname=$cell->getCalculatedValue();
                        }
                        if($column==5){
                            $lname=$cell->getCalculatedValue();
                        }
                        if($column==6){
                            $gender=$cell->getCalculatedValue();
                        }
                        if($column==7){
                            $civil_status=$cell->getCalculatedValue();
                        }
                        if($column==8){
                            $date_of_birth=$cell->getCalculatedValue();
                        }
                        if($column==9){
                            $Address=$cell->getCalculatedValue();
                        }
                        
                        
                    }
                    $column++;
                }
                if($fname!=''){
                    if($lname!=''){
                        if($date_of_birth!=''){
                            $a=new HR_hr_employee_info;
                            $a->biometrics_id=$biometrics_id;
                            $a->company_id=$company_id;
                            $a->fname=$fname;
                            $a->mname=$mname;
                            $a->lname=$lname;
                            $a->gender=$gender;
                            $a->civil_status=$civil_status;
                            $a->date_of_birth=$date_of_birth;
                            $a->address=$Address;
                            if($a->save()){
                                $data = new HR_hr_employee_salary_detail;
                                $data->emp_id=$a->employee_id;
                                $data->save();
                                $data = new HR_hr_employee_job_detail;
                                $data->emp_id=$a->employee_id;
                                $data->save();
                                // use App\HR_hr_employee_salary_detail;
                                // use App\HR_hr_employee_job_detail;
                                $saved_count++;
                            }
                            
                        }else{
                            $error_count++;
                            $Log.="Empty Date of Birth on row ".$rowcount." from file.\n";  
                        }
                    }else{
                        $error_count++;
                        $Log.="Empty Last Name on row ".$rowcount." from file.\n";  
                    }
                }else{
                    $error_count++;
                    $Log.="Empty First Name on row ".$rowcount." from file.\n";  
                }

            }
            
        }
        $data = array(
            'Success' => $saved_count,
            'Total' => $countloop,
            'Skiped'  => $error_count,
            'Error_Log' =>$Log,
            'Extra'=>$extra
        );
        return json_encode($data);
        
    }
    public function UploadMassAssetSetup(Request $request){
        $file = $request->file('theFile');
        $path = $file->getRealPath();
        $inputFileName = $path;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $error_count=0;
        $saved_count=0;
        $countloop=0;
        $rowcount=0;
        $extra="";
        $Log="";
        foreach ($worksheet->getRowIterator() as $row) {
            $rowcount++;
            
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            if($rowcount>1){
                $countloop++;
                $column=1;
                $type="";
                $description="";
                $description_code="";
                $category="";
                $category_code="";
                $sub_category="";
                $sub_category_code="";
                $serial_number="";
                $plate_number="";
                $location="";
                $site="";
                foreach ($cellIterator as $cell) {
                    
                    if($column<12){
                        if($column==1){
                            $type=$cell->getCalculatedValue();
                        }
                        if($column==2){
                            $description=$cell->getCalculatedValue();
                        }
                        if($column==3){
                            $description_code=$cell->getCalculatedValue();
                        }
                        if($column==4){
                            $category=$cell->getCalculatedValue();
                        }
                        if($column==5){
                            $category_code=$cell->getCalculatedValue();
                        }
                        if($column==6){
                            $sub_category=$cell->getCalculatedValue();
                        }
                        if($column==7){
                            $sub_category_code=$cell->getCalculatedValue();
                        }
                        if($column==8){
                            $serial_number=$cell->getCalculatedValue();
                        }
                        if($column==9){
                            $plate_number=$cell->getCalculatedValue();
                        }
                        if($column==10){
                            $location=$cell->getCalculatedValue();
                        }
                        if($column==11){
                            $site=$cell->getCalculatedValue();
                        }
                        
                        
                    }
                    $column++;
                }
                $extra.=$type.", ".$location." ".$site."\n";
                if($type!=''){
                    if($type=="Asset Tag"){
                        if($description!=''){
                            if($description_code!=''){
                                if($category!=''){
                                    if($category_code!=''){
                                        $require_code="0";
                                        $require_sub="0";
                                        if($sub_category!=''){
                                            $require_sub="1";
                                        }else{
                                            $require_sub="0";
                                        }
                                        if($sub_category_code!=''){
                                            $require_code="1";
                                        }else{
                                            $require_code="0";
                                        }
    
                                        if($require_sub==$require_code){
                                            //save asset tag setup
                                            $desc=$description;
                                            $CN=$category;
                                            $SC=$sub_category;
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
                                                $error_count++;
                                                $Log.="Duplicate Asset Tag Combination on row ".$rowcount." from file.\n";  
                                            }else{
                                                $gen=$this->generate_id();
                                                $data= new HR_hr_Asset_setup;
                                                $data->asset_setup_tag=$type;
                                                $data->asset_setup_description=$description;
                                                $data->asset_setup_category=$category;
                                                $data->asset_setup_sub_cat=$sub_category;
                                                $data->asset_setup_ad=$description_code;
                                                $data->asset_setup_ac=$category_code;
                                                $data->asset_setup_sc=$sub_category_code;
                                                //plate number required
                                                $data->asset_setup_sku=$plate_number=='1'? $plate_number : '0' ;
                                                //serial number
                                                $data->uom=$serial_number=='1'? $serial_number : '0' ;
                                                $data->ticket_no=$gen;
                                                $data->requested_by=Auth::user()->id;
                                                if($data->save()){
                                                    $this->generate_transaction_log($gen,$type,'Asset Setup','Queued on AM',$data->id,'');
                                                }
                                            }
                                        }else{
                                            $error_count++;
                                            $Log.="Empty Category Code on row ".$rowcount." from file.\n";  
                                        }
                                        
                                    }else{
                                        $error_count++;
                                        $Log.="Empty Category Code on row ".$rowcount." from file.\n";  
                                    }
                                }else{
                                    $error_count++;
                                    $Log.="Empty Category on row ".$rowcount." from file.\n";  
                                } 
                            }else{
                                $error_count++;
                                $Log.="Empty Description Code on row ".$rowcount." from file.\n";  
                            }
                        }else{
                            $error_count++;
                            $Log.="Empty Description on row ".$rowcount." from file.\n";  
                        } 
                    }else if($type=="Site And Location"){
                        if($location!=''){
                            if($site!=''){
                                //save site and location setup
                                $data=HR_hr_Asset_setup::where([
                                    ['asset_setup_location','=',$location],
                                    ['asset_setup_site','=',$site],
                                    ['asset_setup_tag','=','Site And Location']
                                ])->first();
                                
                                if(!empty($data)){
                                    $error_count++;
                                    $Log.="Duplicate Site And Location on row ".$rowcount." from file.\n";  
                                    
                                }else{
                                    $gen=$this->generate_id();
                                    $data= new HR_hr_Asset_setup;
                                    $data->asset_setup_tag=$type;
                                    $data->asset_setup_site=$site;
                                    $data->asset_setup_location=$location;
                                    $data->ticket_no=$gen;
                                    $data->requested_by=Auth::user()->id;
                                    if($data->save()){
                                        $this->generate_transaction_log($gen,$type,'Asset Setup','Queued on AM',$data->id,'');
                                    }  
                                }
                                
                            }else{
                                $error_count++;
                                $Log.="Empty Site on row ".$rowcount." from file.\n";  
                            }
                        }else{
                            $error_count++;
                            $Log.="Empty Location on row ".$rowcount." from file.\n";  
                        }
                    }
                    
                }else{
                    $error_count++;
                    $Log.="Empty Type on row ".$rowcount." from file.\n";  
                }
                

            }
            
        }
        $data = array(
            'Success' => $saved_count,
            'Total' => $countloop,
            'Skiped'  => $error_count,
            'Error_Log' =>$Log,
            'Extra'=>$extra
        );
        return json_encode($data);
    }
}
