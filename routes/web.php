<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Middleware\HRMiddleWare;
use App\Http\Middleware\PayrollMiddleWare;
use App\Http\Middleware\SetupMiddleWare;
use App\Http\Middleware\BulletinMiddleWare;
use App\Http\Middleware\CEOMiddleWare;
use App\Http\Middleware\AssetMiddleWare;


Route::get('/', function () {
    // $emailll='ceciliohr@gmail.com';
    // $passww="Odanobunaga13";
    // $sss=$passww;
    // $arr2 = str_split($passww);
    // $length=1;
    // $dencrypted="";
    // $userdata = array(
    //     'email' => $emailll ,
    //     'password' => $passww
    // );
    // if (Auth::attempt($userdata)){
    //     return redirect()->intended('/home');

    // }else{
    //     return redirect()->intended('/login');
    // }
    return view('welcome');
});
//Custom API for ReactJS App

Route::get('api/getBankInfo', 'ApiController@getBankInfo');
Route::get('api/getBanks', 'ApiController@getBanks');
Route::get('api/getSettingAdvance', 'ApiController@getSettingAdvance');
Route::get('api/getSettingAdvanceNumberring', 'ApiController@getSettingAdvanceNumberring');
Route::get('api/getSettingExpense', 'ApiController@getSettingExpense');
Route::get('api/getSettingSales', 'ApiController@getSettingSales');
Route::get('api/getSettingCompany', 'ApiController@getSettingCompany');
Route::get('api/getAccount', 'ApiController@getAccount');
Route::get('api/students', 'ApiController@getAllStudents');
Route::get('api/getDashboardData', 'ApiController@getDashboardData');
Route::post('api/update_setting_company', 'ApiController@update_setting_company');
Route::post('api/update_setting_sales', 'ApiController@update_setting_sales');
Route::post('api/update_setting_expense', 'ApiController@update_setting_expense');
Route::post('api/update_setting_advance', 'ApiController@update_setting_advance');
Route::post('api/add_bank', 'ApiController@add_bank');

// END Custom API for ReactJS App

Route::group(['middleware'=>['auth']], function() {

    Route::get('/router', 'HomeController@router');
    Route::get('/access_denied', 'PageController@access_denied');
    Route::get('/test_page', 'PageController@test_page');
    Route::get('/bulletin', 'PageController@bulletin')->middleware(BulletinMiddleWare::class);
    Route::get('/ceo', 'PageController@ceo')->middleware(CEOMiddleWare::class);

    Route::get('/employee_list', 'PageController@employee_list')->middleware(HRMiddleWare::class);
    Route::get('/add_employee', 'PageController@add_employee')->middleware(HRMiddleWare::class);
    Route::get('/view_employee', 'PageController@view_employee')->middleware(HRMiddleWare::class);
    Route::get('/memo', 'PageController@memo')->middleware(HRMiddleWare::class);
    Route::get('/form_generator', 'PageController@form_generator')->middleware(HRMiddleWare::class);
    Route::get('/hr', 'PageController@hr')->middleware(HRMiddleWare::class);
    Route::get('/cash_advance', 'PageController@cash_advance')->middleware(HRMiddleWare::class);

    Route::get('/payroll', 'PageController@payroll')->middleware(PayrollMiddleWare::class);
    Route::get('/create_payroll', 'PageController@create_payroll')->middleware(PayrollMiddleWare::class);
    Route::get('/employee', 'PageController@employee')->middleware(PayrollMiddleWare::class);
    Route::get('/payroll_report', 'PageController@payroll_report')->middleware(PayrollMiddleWare::class);
    Route::get('/govt_report', 'PageController@govt_report')->middleware(PayrollMiddleWare::class);

    Route::get('/asset_management', 'PageController@asset_management')->middleware(AssetMiddleWare::class);
    Route::get('/asset_management_dispose', 'PageController@asset_management_dispose')->middleware(AssetMiddleWare::class);
    Route::get('/asset', 'PageController@asset')->middleware(AssetMiddleWare::class);
    Route::get('/transaction', 'PageController@transaction')->middleware(AssetMiddleWare::class);
    Route::get('/audit', 'PageController@audit')->middleware(AssetMiddleWare::class);
    Route::post('/audit_detail', 'PageController@audit_detail')->middleware(AssetMiddleWare::class);
    Route::get('/report', 'PageController@report')->middleware(AssetMiddleWare::class);
    Route::get('/print_qr', 'PageController@print_qr')->middleware(AssetMiddleWare::class);
    Route::get('/department', 'PageController@department');
    Route::get('/project_management', 'PageController@project_management');
    
    
    Route::get('/employee_dashboard', 'PageController@employee_dashboard');

    
    Route::get('/setup_company', 'PageController@setup_company')->middleware(SetupMiddleWare::class);
    Route::get('/setup_payroll', 'PageController@setup_payroll')->middleware(SetupMiddleWare::class);
    Route::get('/setup_references', 'PageController@setup_references')->middleware(SetupMiddleWare::class);

    Route::post('/update_company_setup_data', 'FormController@update_company_setup_data');
    Route::post('/update_company_bank_data', 'FormController@update_company_bank_data');
    Route::post('/update_company_cost_center_data', 'FormController@update_company_cost_center_data');
    Route::post('/update_company_department_data', 'FormController@update_company_department_data');
    Route::post('/delete_bank_data', 'FormController@delete_bank_data');
    Route::post('/delete_cost_center_data', 'FormController@delete_cost_center_data');
    Route::post('/delete_department_data', 'FormController@delete_department_data');
    Route::post('/get_bank_data', 'FormController@get_bank_data');
    Route::post('/update_company_bank_data_edit', 'FormController@update_company_bank_data_edit');
    Route::post('/update_company_costcenter_data_edit', 'FormController@update_company_costcenter_data_edit');
    Route::post('/get_costcenter_data', 'FormController@get_costcenter_data');
    Route::post('/update_company_department_data_edit', 'FormController@update_company_department_data_edit');
    Route::post('/get_department_data', 'FormController@get_department_data');
    Route::post('/update_work_policy', 'FormController@update_work_policy');
    Route::post('/update_tax_computation', 'FormController@update_tax_computation');
    Route::post('/update_govt_contribution', 'FormController@update_govt_contribution');
    Route::post('/update_payroll_computation', 'FormController@update_payroll_computation');
    Route::post('/update_sss_table', 'FormController@update_sss_table');
    Route::post('/get_tax_tax_table_data', 'FormController@get_tax_tax_table_data');
    Route::post('/update_taxtta_table', 'FormController@update_taxtta_table');
    Route::post('/get_tax_table_deduction_data', 'FormController@get_tax_table_deduction_data');
    Route::post('/update_tax_table_deduction_data', 'FormController@update_tax_table_deduction_data');
    Route::post('/add_new_adjsutment_template', 'FormController@add_new_adjsutment_template');
    Route::post('/get_adjustment_template_data', 'FormController@get_adjustment_template_data');
    Route::post('/update_adjustment_template_data', 'FormController@update_adjustment_template_data');
    Route::post('/add_company_adjustment_data', 'FormController@add_company_adjustment_data');
    Route::post('/get_company_adjustment_data', 'FormController@get_company_adjustment_data');
    Route::post('/update_company_adjustment_data', 'FormController@update_company_adjustment_data');
    Route::post('/delete_company_adjustment_data', 'FormController@delete_company_adjustment_data');
    Route::post('/add_govt_or_record_data', 'FormController@add_govt_or_record_data');
    Route::post('/GetGovtOR', 'FormController@GetGovtOR');
    Route::post('/delete_ot_rate_table_data', 'FormController@delete_ot_rate_table_data');
    Route::post('/add_ot_rate_table_name', 'FormController@add_ot_rate_table_name');
    Route::post('/get_ot_rate_table_data', 'FormController@get_ot_rate_table_data');
    Route::post('/update_ot_rate_table_data', 'FormController@update_ot_rate_table_data');
    Route::post('/add_employee_data', 'FormController@add_employee_data');
    Route::post('/update_employee_data', 'FormController@update_employee_data');
    Route::post('/UploadMassEmployee', 'UploadController@UploadMassEmployee');
    Route::post('/add_emp_memo', 'FormController@add_emp_memo');
    Route::post('/upload_emp_memo', 'FormController@upload_emp_memo');
    Route::post('/update_emp_memo', 'FormController@update_emp_memo');
    Route::post('/get_emp_memo_data', 'FormController@get_emp_memo_data');
    Route::post('/check_form_template_name', 'FormController@check_form_template_name');
    Route::post('/add_form_template', 'FormController@add_form_template');
    Route::post('/get_required_field_form_generator', 'FormController@get_required_field_form_generator');
    Route::post('/add_cash_advance', 'FormController@add_cash_advance');
    Route::post('/get_cash_advance_data', 'FormController@get_cash_advance_data');
    Route::post('/get_attendance_today_by_department', 'FormController@get_attendance_today_by_department');
    Route::post('/add_new_payroll', 'FormController@add_new_payroll');
    Route::post('/get_payroll_employees', 'FormController@get_payroll_employees');
    Route::post('/update_payroll_employee', 'FormController@update_payroll_employee');
    Route::post('/get_employee_adjustment', 'FormController@get_employee_adjustment');
    Route::post('/add_employee_salary_adjustment', 'FormController@add_employee_salary_adjustment');
    Route::post('/get_employee_data', 'FormController@get_employee_data');
    Route::post('/update_employee_salary_adjustment', 'FormController@update_employee_salary_adjustment');
    Route::post('/disable_employee_saary_adjustment', 'FormController@disable_employee_saary_adjustment');
    Route::get('/downloadexceltemplate_adjustment', 'UploadController@downloadexceltemplate_adjustment');
    Route::post('/UploadMassAdjustment', 'UploadController@UploadMassAdjustment');
    Route::post('/review_payroll', 'FormController@review_payroll');
    Route::post('/process_payroll', 'FormController@process_payroll');
    Route::post('/get_excluded_employee_from_payroll', 'FormController@get_excluded_employee_from_payroll');
    Route::post('/get_employee_payroll', 'FormController@get_employee_payroll');
    Route::post('/add_payment_to_cash_advance', 'FormController@add_payment_to_cash_advance');
    Route::post('/get_payroll_list_summary', 'FormController@get_payroll_list_summary');
    Route::post('/post_payroll', 'FormController@post_payroll');
    Route::post('/view_payroll_summary_modal', 'FormController@view_payroll_summary_modal');
    Route::post('/include_emp_salary', 'FormController@include_emp_salary');
    Route::post('/fetch_notif', 'NotifController@fetch_notif');
    Route::post('/clearnotif', 'NotifController@clearnotif');
    Route::post('/get_asset_desc', 'GetController@get_asset_desc');
    Route::post('/get_asset_desc_code', 'GetController@get_asset_desc_code');
    Route::post('/check_asset_setup_asset_tag_combination', 'GetController@check_asset_setup_asset_tag_combination');
    Route::post('/get_asset_desc_code_list', 'GetController@get_asset_desc_code_list');
    Route::post('/get_asset_category', 'GetController@get_asset_category');
    Route::post('/get_asset_cat_code', 'GetController@get_asset_cat_code');
    Route::post('/get_asset_category_code_list', 'GetController@get_asset_category_code_list');
    Route::post('/get_asset_sub_cat', 'GetController@get_asset_sub_cat');
    Route::post('/get_asset_sub_cat_code', 'GetController@get_asset_sub_cat_code');
    Route::post('/get_asset_sub_cat_code_list', 'GetController@get_asset_sub_cat_code_list');
    Route::post('/get_asset_setup_location', 'GetController@get_asset_setup_location');
    Route::post('/check_site', 'GetController@check_site');
    Route::post('/get_asset_setup_site', 'GetController@get_asset_setup_site');
    Route::post('/get_asset_setup_siteaudit', 'GetController@get_asset_setup_siteaudit');
    
    Route::post('/getComapny_defined_Tagging', 'GetController@getComapny_defined_Tagging');
    Route::post('/getComapny_defined_Tagging_site_and_location', 'GetController@getComapny_defined_Tagging_site_and_location');
    Route::post('/getCategoryNewAsset', 'GetController@getCategoryNewAsset');
    Route::post('/GetSubNewAsset', 'GetController@GetSubNewAsset');
    Route::post('/GetAssetCount', 'GetController@GetAssetCount');
    Route::post('/SetSerialAndUOM', 'GetController@SetSerialAndUOM');
    Route::post('/checkserialunique', 'GetController@checkserialunique');
    Route::post('/checkplateunique', 'GetController@checkplateunique');
    Route::post('/GetLocationNewAsset', 'GetController@GetLocationNewAsset');
    Route::post('/GetSiteNewAsset', 'GetController@GetSiteNewAsset');
    Route::post('/checkinvoicenumbernewasset', 'GetController@checkinvoicenumbernewasset');
    Route::post('/getAssetInfoAuditLogTbody', 'GetController@getAssetInfoAuditLogTbody');
    Route::post('/getAssetInfoTransactionLogTbody', 'GetController@getAssetInfoTransactionLogTbody');
    Route::post('/getDefaultViewAssetList', 'GetController@getDefaultViewAssetList');
    Route::post('/getColumnAssetList', 'GetController@getColumnAssetList');
    Route::post('/getselected_assets_modal', 'GetController@getselected_assets_modal');
    Route::post('/getselected_asset_modal_individual', 'GetController@getselected_asset_modal_individual');
    Route::post('/getViewNotes', 'GetController@getViewNotes');
    Route::post('/getViewAssetInfoModalBody', 'GetController@getViewAssetInfoModalBody');
    Route::post('/ViewAssetSetupModalBody', 'GetController@ViewAssetSetupModalBody');
    Route::post('/EditAssetSetupModalBody', 'GetController@EditAssetSetupModalBody');
    Route::post('/EditAssetSetupModalBodyasds', 'GetController@EditAssetSetupModalBodyasds');
    Route::post('/get_asset_info_checkout', 'GetController@get_asset_info_checkout');
    Route::post('/get_asset_info_checkin', 'GetController@get_asset_info_checkin');
    Route::post('/print_qr', 'GetController@print_qr');
    Route::post('/get_asset_setup_site_param', 'GetController@get_asset_setup_site_param');
    
    Route::post('/UploadMassAssetSetup', 'UploadController@UploadMassAssetSetup');
    Route::post('/add_asset_setup_request', 'AssetPostController@add_asset_setup_request');
    Route::post('/DeleteTagging', 'AssetPostController@DeleteTagging');
    Route::post('/add_new_asset', 'AssetPostController@add_new_asset');
    Route::post('/update_asset_information', 'AssetPostController@update_asset_information');
    Route::post('/update_asset_information_denied', 'AssetPostController@update_asset_information_denied');
    
    Route::post('/NewAssetFirstApprove', 'AssetPostController@NewAssetFirstApprove');
    Route::post('/AssetSetupFirstApprove', 'AssetPostController@AssetSetupFirstApprove');
    Route::post('/NewAssetSecondApprove', 'AssetPostController@NewAssetSecondApprove');
    Route::post('/AssetSetupSecondApprove', 'AssetPostController@AssetSetupSecondApprove');
    Route::post('/DisposeAssetSetup2', 'AssetPostController@DisposeAssetSetup2');
    Route::post('/NewAssetDenySecond', 'AssetPostController@NewAssetDenySecond');
    Route::post('/NewAssetDeny', 'AssetPostController@NewAssetDeny');
    Route::post('/DisposeAssetSetup', 'AssetPostController@DisposeAssetSetup');
    Route::post('/delete_request_new_asset', 'AssetPostController@delete_request_new_asset');
    Route::post('/delete_request_asset_setup', 'AssetPostController@delete_request_asset_setup');
    Route::post('/update_asset_setup_site_and_location', 'AssetPostController@update_asset_setup_site_and_location');
    Route::post('/SaveAssetCheckOut', 'AssetPostController@SaveAssetCheckOut');
    Route::post('/CheckoutSecondApprove', 'AssetPostController@CheckoutSecondApprove');
    Route::post('/CheckoutDeny', 'AssetPostController@CheckoutDeny');
    Route::post('/SaveAssetCheckIn', 'AssetPostController@SaveAssetCheckIn');
    Route::post('/CheckinSecondApprove', 'AssetPostController@CheckinSecondApprove');
    Route::post('/CheckinDeny', 'AssetPostController@CheckinDeny');
    Route::post('/SaveAssetExtend', 'AssetPostController@SaveAssetExtend');
    Route::post('/ExtendSecondApprove', 'AssetPostController@ExtendSecondApprove');
    Route::post('/ExtendDeny', 'AssetPostController@ExtendDeny');
    Route::post('/SaveAssetMove', 'AssetPostController@SaveAssetMove');
    Route::post('/TransferDeny', 'AssetPostController@TransferDeny');
    Route::post('/TransferSecondApprove', 'AssetPostController@TransferSecondApprove');
    Route::post('/SaveAssetDisposal', 'AssetPostController@SaveAssetDisposal');
    Route::post('/DisposeSecondApprove', 'AssetPostController@DisposeSecondApprove');
    Route::post('/DisposeDeny', 'AssetPostController@DisposeDeny');
    Route::post('/SaveAssetMaintenance', 'AssetPostController@SaveAssetMaintenance');
    Route::post('/MaintenanceSecondApprove', 'AssetPostController@MaintenanceSecondApprove');
    Route::post('/MaintenanceDeny', 'AssetPostController@MaintenanceDeny');
    Route::post('/SaveAssetRecover', 'AssetPostController@SaveAssetRecover');
    Route::post('/RecoverFirstApprove', 'AssetPostController@RecoverFirstApprove');
    Route::post('/RecoverSecondApprove', 'AssetPostController@RecoverSecondApprove');
    Route::post('/RecoverDeny', 'AssetPostController@RecoverDeny');
    
    Route::post('/CountExistingAudit','AuditController@CountExistingAudit');
    Route::post('/FetchExistingAudit','AuditController@FetchExistingAudit');
    Route::post('/get_assets_audit','AuditController@get_assets_audit');
    Route::get('/GETAUDITEXCEL','AuditController@GETAUDITEXCEL');
    Route::post('/SaveFirstAudit','AuditController@SaveFirstAudit');
    Route::post('/GetNotFoundReconcileModal','AuditController@GetNotFoundReconcileModal');
    Route::post('/SaveAssetMoveAudit','AuditController@SaveAssetMoveAudit');
    Route::post('/SaveAssetDisposalAudit','AuditController@SaveAssetDisposalAudit');
    Route::post('/SaveAssetMaintenanceAudit','AuditController@SaveAssetMaintenanceAudit');
    Route::post('/SaveAssetOtherAudit','AuditController@SaveAssetOtherAudit');
    Route::post('/FinishAudit','AuditController@FinishAudit');

    Route::post('/ReportAsset_type','ReportController@ReportAsset_type');
    Route::post('/ReplaceAuditParam','ReportController@ReplaceAuditParam');
    Route::get('/Report','ReportController@Report');
    Route::post('/GetReportAsExcel','ReportController@GetReportAsExcel');
    
    
});

Route::get('/clear-cache', function() {
    session()->flush();
    Artisan::call('cache:clear');
    return redirect('/');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
