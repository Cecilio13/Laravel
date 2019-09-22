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
Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>['auth']], function() {
    Route::get('/router', 'HomeController@router');
    Route::get('/access_denied', 'PageController@access_denied');
    Route::get('/test_page', 'PageController@test_page');
    Route::get('/bulletin', 'PageController@bulletin');
    Route::get('/ceo', 'PageController@ceo');
    Route::get('/hr', 'PageController@hr');
    Route::get('/employee_list', 'PageController@employee_list');
    Route::get('/add_employee', 'PageController@add_employee');
    Route::get('/view_employee', 'PageController@view_employee');
    Route::get('/memo', 'PageController@memo');
    Route::get('/form_generator', 'PageController@form_generator');
    Route::get('/cash_advance', 'PageController@cash_advance');
    Route::get('/payroll', 'PageController@payroll');
    Route::get('/create_payroll', 'PageController@create_payroll');
    Route::get('/employee', 'PageController@employee');
    Route::get('/payroll_report', 'PageController@payroll_report');
    Route::get('/govt_report', 'PageController@govt_report');
    Route::get('/asset_management', 'PageController@asset_management');
    Route::get('/asset_management_dispose', 'PageController@asset_management_dispose');
    Route::get('/asset', 'PageController@asset');
    Route::get('/transaction', 'PageController@transaction');
    Route::get('/audit', 'PageController@audit');
    Route::get('/audit_detail', 'PageController@audit_detail');
    Route::get('/report', 'PageController@report');
    Route::get('/print_qr', 'PageController@print_qr');
    Route::get('/department', 'PageController@department');
    Route::get('/project_management', 'PageController@project_management');
    Route::get('/hr', 'PageController@hr');
    
    Route::get('/employee_dashboard', 'PageController@employee_dashboard');

    
    Route::get('/setup_company', 'PageController@setup_company');
    Route::get('/setup_payroll', 'PageController@setup_payroll');
    Route::get('/setup_references', 'PageController@setup_references');

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
    

    
});

Route::get('/clear-cache', function() {
    session()->flush();
    Artisan::call('cache:clear');
    return redirect('/');
});
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
