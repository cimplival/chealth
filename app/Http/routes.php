<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Author: Valentine Mwangi
| © Cimplicity Apps. All Rights Reserved.
| 2016
|
*/


Route::get('/',                           ['uses' => 'Home\HomeController@getHome','as' => 'home', 'middleware'=> array('guest')]);
Route::get('/signout',                    ['uses' => 'Auth\AuthController@getLogout','as' => 'log-out']);
Route::get('/home',              ['uses' => 'Home\HomeController@getHome','as' => 'home-redirect', 'middleware'=> array('guest')]);
Route::post('/',                   		    ['uses' => 'Auth\AuthController@postLogin', 'middleware'=> array('guest')]);

Route::get('change-password',             ['uses' => 'Admin\UsersController@changePassword','as' => 'change-password']);
Route::post('change-password', ['uses' => 'Admin\UsersController@updatePassword']);


Route::get('/doctor',                     ['uses' => 'Doctor\DoctorController@getDashboard','as' => 'doctor-home', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-appointments',        ['uses' => 'Doctor\DoctorController@getDoctorAppointments','as' => 'doctor-appointments', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-history',       ['uses' => 'Doctor\DoctorController@getDoctorHistory','as' => 'doctor-consultations', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-calendar',            ['uses' => 'Doctor\DoctorController@getDoctorCalendar','as' => 'doctor-calendar', 'middleware'=> 'auth:doctor']);
Route::put('/appointment/{id}',           ['uses' => 'Doctor\DoctorController@consultPatient', 'as' => 'consultPatient']);
Route::put('/lab-visit/{id}',           ['uses' => 'Doctor\DoctorController@labVisit', 'as' => 'lab-visit']);
Route::delete('/doctor-appointments/{id}','Doctor\DoctorController@cancelAppointment');
Route::put('/view-medical-profile/{id}',           ['uses' => 'Doctor\DoctorController@viewMedicalProfile', 'as' => 'view-medical-profile']);


Route::get('/triage',                     ['uses' => 'Triage\TriageController@getHome','as' => 'triage-home', 'middleware'=> 'auth:triage']);
Route::get('/triage-vitals',                   ['uses' => 'Triage\TriageController@getPatients','as' => 'triage-vitals', 'middleware'=> 'auth:triage']);
Route::post('/add-vitals',             ['uses' => 'Triage\TriageController@addVitals', 'middleware'=> 'auth:triage']);
Route::post('/search-vital',        	  ['uses' => 'Triage\TriageController@searchVitals', 'as' => 'search-vitals', 'middleware'=> 'auth:triage']);

Route::get('/medical-certificates',       ['uses' => 'Medical\SecondaryVitalsController@getPatients','as' => 'secondary-vitals', 'middleware'=> 'auth:accountant']);
Route::post('/search-certificates',                    ['uses' => 'Triage\TriageController@searchPatient',  'as' => 'search-certificate', 'middleware'=> 'auth:accountant']);
Route::get('/medical-certificate',        ['uses' => 'Medical\SecondaryVitalsController@getMedicalCertificate', 'as' => 'medical-certificate', 'middleware'=> 'auth:accountant']);
Route::post('/save-medical-vitals',       ['uses' => 'Medical\SecondaryVitalsController@saveAllVitals','as' => 'save-all-vitals', 'middleware'=> 'auth:accountant']);
Route::put('/checkout-patient/{id}',      ['uses' => 'Triage\TriageController@checkoutPatient', 'as' => 'checkout-patient', 'middleware'=> 'auth:accountant']);

Route::get('/reception',                  ['uses' => 'Reception\ReceptionController@getHome','as' => 'reception-home', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-patients',         ['uses' => 'Reception\ReceptionController@getPatients','as' => 'reception-patients', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-patients-results', ['uses' => 'Reception\ReceptionController@getPatientsResults','as' => 'reception-patients-results', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-registration',     ['uses' => 'Reception\ReceptionController@getRegistration','as' => 'reception-registration', 'middleware'=> 'auth:receptionist']);
Route::post('/reception-registration',    ['uses' => 'Medical\PatientController@registerPatient', 'as' => 'register-patient', 'middleware'=> 'auth:receptionist']);
Route::post('/search',                    ['uses' => 'Reception\ReceptionController@searchPatient',  'as' => 'search-patient', 'middleware'=> 'auth:receptionist']);
Route::put('/appointments-update/{id}',   ['uses' => 'Reception\AppointmentsController@updateAppointment', 'as' => 'appointments-update', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-appointments',     ['uses' => 'Reception\AppointmentsController@getAppointments','as' => 'reception-appointments', 'middleware'=> 'auth:receptionist']);
Route::get('/new-appointment',            ['uses' => 'Reception\AppointmentsController@newAppointment', 'as' => 'new-appointment', 'middleware'=> 'auth:receptionist']);
Route::post('/search-merge-patient',                    ['uses' => 'Reception\ReceptionController@searchMergePatient',  'as' => 'search-merge-patient', 'middleware'=> 'auth:receptionist']);
//Route::get('/results-merge-patients',     ['uses' => 'Reception\ReceptionController@getSearchMergePatients','as' => 'results-merge-patients', 'middleware'=> 'auth:receptionist']);
Route::post('/merge-patients',            ['uses' => 'Medical\PatientController@mergePatients',  'as' => 'merge-patients', 'middleware'=> 'auth:receptionist']);

Route::post('/create-appointment',        ['uses' => 'Reception\AppointmentsController@createAppointment', 'as' => 'create-appointment', 'middleware'=> 'auth:receptionist']);
Route::post('/search-appointment',        ['uses' => 'Reception\ReceptionController@searchAppointment', 'as' => 'search-appointment', 'middleware'=> 'auth:receptionist']);
Route::delete('/reception-appointments/{id}','Reception\AppointmentsController@cancelAppointment');
Route::post('/schedule',                  ['uses' => 'Reception\AppointmentsController@scheduleAppointment','as' => 'schedule-appointment', 'middleware'=> 'auth:receptionist']);
Route::post('/checkin-appointment',        ['uses' => 'Reception\AppointmentsController@checkInPatient', 'as' => 'checkin-appointment', 'middleware'=> 'auth:receptionist']);
Route::get('/unknown-patient',             ['uses' => 'Reception\ReceptionController@getUnknownPatient','as' => 'unknown-patient', 'middleware'=> 'auth:receptionist']);
Route::post('/add-unknown-patient',                  ['uses' => 'Reception\ReceptionController@addUnknownPatient','as' => 'add-unknown-patient', 'middleware'=> 'auth:receptionist']);



Route::get('/accounts',                       ['uses' => 'Accounts\AccountsController@getHome','as' => 'accounts-home', 'middleware'=> 'auth:accountant']);
Route::get('/accounts-payments',              ['uses' => 'Accounts\AccountsController@getPayments','as' => 'accounts-payments', 'middleware'=> 'auth:accountant']);
Route::get('/accounts-services',              ['uses' => 'Accounts\ServicesController@getServices','as' => 'accounts-services', 'middleware'=> 'auth:accountant']);
Route::get('/accounts-insurance',             ['uses' => 'Accounts\InsuranceController@getInsurance','as' => 'accounts-insurance', 'middleware'=> 'auth:accountant']);
Route::get('/accounts-reports',               ['uses' => 'Accounts\AccountsController@getReports','as' => 'accounts-reports', 'middleware'=> 'auth:accountant']);
Route::post('/accounts-services',             ['uses' => 'Accounts\ServicesController@addService', 'middleware'=> 'auth:accountant']);
Route::delete('/accounts-services/{id}',      ['uses' => 'Accounts\ServicesController@deleteService', 'middleware'=> 'auth:accountant']);
Route::put('/accounts-services/{id}',         ['uses' => 'Accounts\ServicesController@updateService',   'as' => 'update-service', 'middleware'=> 'auth:accountant']);
Route::post('/search-services',               ['uses' => 'Accounts\ServicesController@searchService', 'as' => 'search-services', 'middleware'=> 'auth:accountant']);
Route::put('/confirm-payment/{id}',           ['uses' => 'Accounts\AccountsController@confirmPayment', 'as' => 'confirm-payment', 'middleware'=> 'auth:accountant']);
Route::post('/search-payment',                ['uses' => 'Accounts\AccountsController@searchPayment', 'as' => 'search-payment', 'middleware'=> 'auth:accountant']);
Route::put('/payment/{id}',                   ['uses' => 'Accounts\AccountsController@updatePayment',   'as' => 'update-payment', 'middleware'=> 'auth:accountant']);
Route::post('/create-insurance',              ['uses' => 'Accounts\InsuranceController@createInsurance', 'middleware'=> 'auth:accountant']);
Route::delete('/delete-insurance/{id}',        ['uses' => 'Accounts\InsuranceController@deleteInsurance', 'middleware'=> 'auth:accountant']);
Route::put('/insurance-payment/{id}',         ['uses' => 'Accounts\InsuranceController@updateInsurance',   'as' => 'update-insurance', 'middleware'=> 'auth:accountant']);
Route::post('/search-insurances',             ['uses' => 'Accounts\InsuranceController@searchInsurance', 'as' => 'search-insurances', 'middleware'=> 'auth:accountant']);
Route::post('/search-insurance-plans',             ['uses' => 'Accounts\InsuranceController@searchInsurancePlans', 'as' => 'search-insurance-plans', 'middleware'=> 'auth:accountant']);
Route::get('/drugs-payments',                 ['uses' => 'Accounts\DrugsPaymentsController@getPayments','as' => 'drugs-payments', 'middleware'=> 'auth:accountant']);
Route::put('/drugs-payment/{id}',              ['uses' => 'Accounts\DrugsPaymentsController@updateCost',   'as' => 'update-drug-payment', 'middleware'=> 'auth:accountant']);
Route::post('/search-drugs-accounts',                ['uses' => 'Accounts\AccountsController@searchDrugs', 'as' => 'search-drugs-accounts', 'middleware'=> 'auth:accountant']);
Route::get('/accounts-insurance-plans',                 ['uses' => 'Accounts\AccountsController@getInsurancePlans','as' => 'get-insurance-plans', 'middleware'=> 'auth:accountant']);
Route::put('/confirm-insurance-plan/{id}',              ['uses' => 'Accounts\InsuranceController@confirmInsurancePlan', 'middleware'=> 'auth:accountant']);


Route::get('/pharmacy',                       ['uses' => 'Pharmacy\DispensationController@getHome','as' => 'pharmacy-home', 'middleware'=> 'auth:pharmacy']);
Route::get('/dispensations',                  ['uses' => 'Pharmacy\DispensationController@getDispensation','as' => 'pharmacy-dispensations', 'middleware'=> 'auth:pharmacy']);
Route::get('/archives',                  ['uses' => 'Pharmacy\ArchivesController@getArchives','as' => 'pharmacy-archives', 'middleware'=> 'auth:pharmacy']);
Route::get('/inventory',                      ['uses' => 'Pharmacy\InventoryController@getInventory','as' => 'pharmacy-inventory', 'middleware'=> 'auth:pharmacy']);
Route::put('/refill-inventory/{id}',      ['uses' => 'Pharmacy\InventoryController@refillDrug',   'as' => 'refill-inventory', 'middleware'=> 'auth:pharmacy']);
Route::post('/search-inventory',        ['uses' => 'Pharmacy\InventoryController@searchInventory',   'as' => 'search-inventory', 'middleware'=> 'auth:pharmacy']);
Route::get('/refills',                        ['uses' => 'Pharmacy\RefillController@getRefill','as' => 'pharmacy-refills', 'middleware'=> 'auth:pharmacy']);
Route::post('/refill-new',                    ['uses' => 'Pharmacy\InventoryController@refillNew', 'middleware'=> 'auth:pharmacy']);
Route::post('/search-refills',        ['uses' => 'Pharmacy\RefillController@searchRefills',   'as' => 'search-refills', 'middleware'=> 'auth:pharmacy']);
Route::put('/dispense-drug/{id}',      ['uses' => 'Pharmacy\DispensationController@dispenseDrug',   'as' => 'dispense-drug', 'middleware'=> 'auth:pharmacy']);
Route::post('/search-dispensations',        ['uses' => 'Pharmacy\DispensationController@searchDispensations', 'as' => 'search-dispensations', 'middleware'=> 'auth:pharmacy']);
Route::post('/search-archives',        ['uses' => 'Pharmacy\ArchivesController@searchArchives',   'as' => 'search-archives', 'middleware'=> 'auth:pharmacy']);


Route::get('/lab',                ['uses' => 'Medical\LabController@getHome', 'as' => 'lab-home', 'middleware'=> 'auth:laboratorist']);
Route::get('/lab-requests',        ['uses' => 'Medical\LabController@getRecords', 'as' => 'lab-records', 'middleware'=> 'auth:laboratorist']);
Route::get('/lab-archives',   ['uses' => 'Medical\LabController@getPastRecords', 'as' => 'past-records', 'middleware'=> 'auth:laboratorist']);
Route::post('/lab-search',        ['uses' => 'Lab\LabController@searchLabRequests','as' => 'search-lab', 'middleware'=> 'auth:laboratorist']);
Route::put('/lab/{id}',   ['uses' => 'Lab\LabController@updateLab', 'as' => 'update-lab', 'middleware'=> 'auth:laboratorist']);
Route::put('/lab-review/{id}',   ['uses' => 'Lab\LabController@updateReview', 'as' => 'update-lab-review']);


Route::get('/nurse', ['uses' => 'Medical\NurseController@getHome', 'as'=> 'nurse-home', 'middleware'=> 'auth:nurse']);
Route::get('/beds',  ['uses' => 'Nurse\BedController@getBeds','as'=> 'get-beds', 'middleware'=> 'auth:nurse']);
Route::post('/beds',       ['uses' => 'Nurse\BedController@createBed', 'middleware'=> 'auth:nurse']);
Route::put('/beds/{id}',   ['uses' => 'Nurse\BedController@updateBed', 'as' => 'update-bed', 'middleware'=> 'auth:nurse']);
Route::delete('/delete-bed/{id}', ['uses' => 'Nurse\BedController@deleteBed', 'middleware'=> 'auth:nurse']);
Route::post('/search-beds',        ['uses' => 'Nurse\BedController@searchBeds', 'as' => 'search-beds', 'middleware'=> 'auth:nurse']);


Route::get('/wards',        ['uses' => 'Nurse\WardController@getWards', 'as'=> 'get-wards', 'middleware'=> 'auth:nurse']);
Route::post('/wards',       ['uses' => 'Nurse\WardController@createWard', 'middleware'=> 'auth:nurse']);
Route::put('/wards/{id}',   ['uses' => 'Nurse\WardController@updateWard','as' => 'update-ward', 'middleware'=> 'auth:nurse']);
Route::delete('/delete-ward/{id}', ['uses' => 'Nurse\WardController@deleteWard', 'middleware'=> 'auth:nurse']);
Route::post('/search-wards',        ['uses' => 'Nurse\WardController@searchWards','as' => 'search-wards', 'middleware'=> 'auth:nurse']);


Route::get('/inpatient',        ['uses' => 'Nurse\InpatientController@getInpatient', 'as'=> 'get-inpatient', 'middleware'=> 'auth:nurse']);
Route::post('/discharge-patient',       ['uses' => 'Nurse\InpatientController@dischargePatient', 'middleware'=> 'auth:nurse']);
Route::delete('/delete-inpatient/{id}', ['uses' => 'Nurse\InpatientController@deleteInpatient', 'middleware'=> 'auth:nurse']);
Route::post('/inpatient-patient',       ['uses' => 'Nurse\InpatientController@createInpatient', 'middleware'=> 'auth:doctor']);
Route::post('/search-inpatient',        ['uses' => 'Nurse\InpatientController@searchInpatient','as' => 'search-inpatient', 'middleware'=> 'auth:nurse']);

Route::get('/medical-profile',    ['uses' => 'Medical\MedicalController@getHome','as' => 'medical-profile', 'middleware'=> 'auth:doctor']);
Route::put('/checkout/{id}',           ['uses' => 'Doctor\DoctorController@consulted', 'as' => 'consulted']);
Route::put('/patient/{id}',               ['uses' => 'Medical\PatientController@updatePatient', 'as' => 'updatePatient']);
Route::post('/health-vitals',             ['uses' => 'Medical\VitalsController@addVitals', 'as' => 'health-vitals']);
Route::post('/prescribe-medication',             ['uses' => 'Medical\MedicationController@prescribeMedication', 'as' => '/prescribe-medication']);
Route::post('/diagnosis',             ['uses' => 'Medical\DiagnosisController@addDiagnosis', 'as' => 'add-diagnosis']);
Route::post('/immunizations',             ['uses' => 'Medical\ImmunizationController@addImmunization', 'as' => 'add-immunization']);
Route::post('/therapies',             ['uses' => 'Medical\TherapyController@addTherapy', 'as' => 'add-therapy']);
Route::post('/procedures',             ['uses' => 'Medical\ProcedureController@addProcedure', 'as' => 'add-procedure']);
Route::post('/histories',             ['uses' => 'Medical\HistoryController@addHistory', 'as' => 'add-history']);
Route::post('/allergies',             ['uses' => 'Medical\AllergyController@addAllergy', 'as' => 'add-allergy']);
Route::post('/add-lab',                  ['uses' => 'Lab\LabController@addLab', 'as' => 'add-lab']);


Route::get('/administrator',                     ['uses' => 'Admin\AdminController@getHome','as' => 'admin-home', 'middleware'=> 'auth:administrator']);
Route::get('/users',                     ['uses' => 'Admin\UsersController@getUsers','as' => 'admin-users', 'middleware'=> 'auth:administrator']);
Route::post('/user',       ['uses' => 'Admin\UsersController@createNewUser','as' => 'create-new-user', 'middleware'=> 'auth:administrator']);
Route::post('/add-role',       ['uses' => 'Admin\UsersController@addRole','as' => 'add-role', 'middleware'=> 'auth:administrator']);
Route::post('/remove-role',       ['uses' => 'Admin\UsersController@removeRole','as' => 'add-role', 'middleware'=> 'auth:administrator']);
Route::put('/user/{id}',           ['uses' => 'Admin\UsersController@editUser', 'as' => 'edit-user', 'middleware'=> 'auth:administrator']);
Route::delete('/user-delete/{id}', ['uses' => 'Admin\UsersController@deleteUser', 'middleware'=> 'auth:administrator']);
Route::post('/search-user',        ['uses' => 'Admin\UsersController@searchUser','as' => 'search-user', 'middleware'=> 'auth:administrator']);


Route::get('/activities',                     ['uses' => 'Admin\ActivitiesController@getActivities','as' => 'activities']);


Route::get('/reports',                     ['uses' => 'Admin\ReportsController@getReports','as' => 'admin-reports', 'middleware'=> 'auth:administrator']);
Route::post('/add-email-report',                  ['uses' => 'Admin\ReportsController@addEmail', 'as' => 'add-email-report']);
Route::post('/remove-email-report',                  ['uses' => 'Admin\ReportsController@removeEmail', 'as' => 'remove-email-report']);


Route::get('/backups',                     ['uses' => 'Admin\BackupsController@getBackups','as' => 'admin-backups', 'middleware'=> 'auth:administrator']);
Route::get('/notifications',               ['uses' => 'Admin\NotificationsController@getNotifications','as' => 'admin-notifications', 'middleware'=> 'auth:administrator']);
Route::get('/settings',               ['uses' => 'Admin\SettingsController@getSettings','as' => 'admin-settings', 'middleware'=> 'auth:administrator']);
Route::post('/create-backup',       ['uses' => 'Admin\BackupsController@createBackup','as' => 'create-backup', 'middleware'=> 'auth:administrator']);
Route::post('/restore-backup',       ['uses' => 'Admin\BackupsController@restoreBackup','as' => 'restore-backup', 'middleware'=> 'auth:administrator']);
Route::post('/backup-delete', ['uses' => 'Admin\BackupsController@deleteBackup', 'middleware'=> 'auth:administrator']);
Route::post('/search-activities',        ['uses' => 'Admin\ActivitiesController@searchActivities','as' => 'search-activities']);

Route::put('/settings/{id}',      ['uses' => 'Admin\SettingsController@updateSettings', 'as' => 'update-settings', 'middleware'=> 'auth:administrator']);
Route::put('/update-notifications/{id}',      ['uses' => 'Admin\NotificationsController@updateNotifications', 'as' => 'update-notifications', 'middleware'=> 'auth:administrator']);
Route::put('/update-reports/{id}',      ['uses' => 'Admin\ReportsController@updateReports', 'as' => 'update-reports', 'middleware'=> 'auth:administrator']);
	
Route::get('export-pdf',            ['uses' => 'Medical\MedicalController@exportPDF']);
Route::post('export-invoice',        ['uses' => 'Medical\MedicalController@exportInvoice']);
Route::post('export-medical-certificate',        ['uses' => 'Medical\SecondaryVitalsController@exportCertificate']);
Route::post('export-all-payments',        ['uses' => 'Medical\MedicalController@exportAllPayments']);
Route::post('export-monthly-payments',        ['uses' => 'Medical\MedicalController@exportMonthlyPayments']);
Route::post('export-daily-payments',        ['uses' => 'Medical\MedicalController@exportDailyPayments']);

Route::post('export-daily-appointments',        ['uses' => 'Reports\ReportsController@exportDailyAppointments']);
Route::post('export-monthly-appointments',        ['uses' => 'Reports\ReportsController@exportMonthlyAppointments']);
Route::post('export-all-appointments',        ['uses' => 'Reports\ReportsController@exportAllAppointments']);

Route::post('export-daily-triages',        ['uses' => 'Reports\ReportsController@exportDailyTriages']);
Route::post('export-monthly-triages',        ['uses' => 'Reports\ReportsController@exportMonthlyTriages']);
Route::post('export-all-triages',        ['uses' => 'Reports\ReportsController@exportAllTriages']);

Route::post('export-daily-doctor-examinations',        ['uses' => 'Reports\ReportsController@exportDailyDoctorExaminations']);
Route::post('export-monthly-doctor-examinations',        ['uses' => 'Reports\ReportsController@exportMonthlyDoctorExaminations']);
Route::post('export-all-doctor-examinations',        ['uses' => 'Reports\ReportsController@exportAllDoctorExaminations']);

Route::post('export-daily-dispensations',        ['uses' => 'Reports\ReportsController@exportDailyDispensations']);
Route::post('export-monthly-dispensations',        ['uses' => 'Reports\ReportsController@exportMonthlyDispensations']);
Route::post('export-all-dispensations',        ['uses' => 'Reports\ReportsController@exportAllDispensations']);

Route::post('export-daily-labs',        ['uses' => 'Reports\ReportsController@exportDailyLabs']);
Route::post('export-monthly-labs',        ['uses' => 'Reports\ReportsController@exportMonthlyLabs']);
Route::post('export-all-labs',        ['uses' => 'Reports\ReportsController@exportAllLabs']);

Route::post('export-daily-inpatient',        ['uses' => 'Reports\ReportsController@exportDailyInpatient']);
Route::post('export-monthly-inpatient',        ['uses' => 'Reports\ReportsController@exportMonthlyInpatient']);
Route::post('export-all-inpatient',        ['uses' => 'Reports\ReportsController@exportAllInpatient']);

Route::post('export-daily-activity',        ['uses' => 'Reports\ReportsController@exportDailyActivity']);
Route::post('export-monthly-activity',        ['uses' => 'Reports\ReportsController@exportMonthlyActivity']);

Route::post('export-daily-user-activity',        ['uses' => 'Reports\ReportsController@exportDailyUserActivity']);
Route::post('export-monthly-user-activity',        ['uses' => 'Reports\ReportsController@exportMonthlyUserActivity']);

Route::auth();
