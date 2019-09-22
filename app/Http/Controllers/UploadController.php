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
}
