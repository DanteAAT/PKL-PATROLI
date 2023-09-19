<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EmergencyMessageController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\JadwalPenilaianKesehatanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatrolScheduleController;
use App\Http\Controllers\PenilaianKesehatanCategoryController;
use App\Http\Controllers\PenilaianKesehatanController;
use App\Http\Controllers\PersonilController;
use App\Http\Controllers\PersonilSchedulingController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ReturnEquipmentController;
use App\Http\Controllers\TakeEquipmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\SystemUserGroupController;


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
    return view('splash');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//*SYSTEMUSER
Route::get('/system-user', [SystemUserController::class, 'index'])->name('system-user');
Route::get('/system-user/add', [SystemUserController::class, 'addSystemUser'])->name('add-system-user');
Route::post('/system-user/process-add-system-user', [SystemUserController::class, 'processAddSystemUser'])->name('process-add-system-user');
Route::get('/system-user/edit/{user_id}', [SystemUserController::class, 'editSystemUser'])->name('edit-system-user');
Route::post('/system-user/process-edit-system-user', [SystemUserController::class, 'processEditSystemUser'])->name('process-edit-system-user');
Route::get('/system-user/delete-system-user/{user_id}', [SystemUserController::class, 'deleteSystemUser'])->name('delete-system-user');
Route::get('/system-user/change-password/{user_id}  ', [SystemUserController::class, 'changePassword'])->name('change-password');
Route::post('/system-user/process-change-password', [SystemUserController::class, 'processChangePassword'])->name('process-change-password');
Route::get('/system-user/detail-seller/{user_id}', [SystemUserController::class, 'detailSystemUserSeller'])->name('detail-system-user-seller');
Route::get('/system-user/detail-buyer/{user_id}', [SystemUserController::class, 'detailSystemUserBuyer'])->name('detail-system-user-buyer');
Route::post('/system-user/filter', [SystemUserController::class, 'filter'])->name('filter-system-user');
Route::get('/system-user/blokir/{user_id}', [SystemUserController::class, 'blokirSystemUser'])->name('blokir-system-user');
Route::get('/system-user/unblokir/{user_id}', [SystemUserController::class, 'unblokirSystemUser'])->name('unblokir-system-user');


//*SYSTEMUSERGROUP
Route::get('/system-user-group', [SystemUserGroupController::class, 'index'])->name('system-user-group');
Route::get('/system-user-group/add', [SystemUserGroupController::class, 'addSystemUserGroup'])->name('add-system-user-group');
Route::post('/system-user-group/process-add-system-user-group', [SystemUserGroupController::class, 'processAddSystemUserGroup'])->name('process-add-system-user-group');
Route::get('/system-user-group/edit/{user_id}', [SystemUserGroupController::class, 'editSystemUserGroup'])->name('edit-system-user-group');
Route::post('/system-user-group/process-edit-system-user-group', [SystemUserGroupController::class, 'processEditSystemUserGroup'])->name('process-edit-system-user-group');
Route::get('/system-user-group/delete-system-user-group/{user_id}', [SystemUserGroupController::class, 'deleteSystemUserGroup'])->name('delete-system-user-group');

//START LOCATION
Route::get('/location', [LocationController::class, 'index'])->name('location');
Route::get('/location/tambah', [LocationController::class, 'screenTambah']);
Route::get('/location/tambah/process', [LocationController::class, 'tambah']);
Route::get('/location/edit/{location_id}',[LocationController::class, 'edit']);
Route::get('/location/edit/process/{location_id}',[LocationController::class, 'update']);
Route::get('/location/detail/{location_id}', [LocationController::class, 'detail']);
Route::get('/location/hapus/{location_id}', [LocationController::class, 'delete']);
Route::get('/location/scan/cetak-pdf/{location_id}', [LocationController::class, 'scan']);
//END LOCATION



//START PATROL SCHEDULE
Route::get('/patrol-schedule', [PatrolScheduleController::class, 'index'])->name('patrol-schedule');
Route::get('/patrol-schedule/tambah', [PatrolScheduleController::class, 'screenTambah']);

Route::POST('/patrol-schedule/tambah/jadwal', [PatrolScheduleController::class, 'jadwal']);
Route::post('/patrol-schedule/tambah-jadwal-patroli', [PatrolScheduleController::class, 'JadwalPatroliSession'])->name('JadwalPatroliSession');
Route::get('/patrol-schedule/hapus-jadwal-patroli/{index}', [PatrolScheduleController::class, 'deleteJadwalPatroli']);

Route::get('/patrol-schedule/tambah/process', [PatrolScheduleController::class, 'tambah']);
// Route::get('/patrol-schedule/tambah/list',[PatrolScheduleController::class, 'sessionList'])->name('sessionListPatrolSchedule');
Route::get('/patrol-schedule/edit/{patrol_id}',[PatrolScheduleController::class, 'edit']);
Route::get('/patrol-schedule/edit/process/{patrol_id}',[PatrolScheduleController::class, 'update']);
Route::get('/patrol-schedule/detail/{patrol_id}', [PatrolScheduleController::class, 'detail']);
Route::get('/patrol-schedule/hapus/{patrol_id}', [PatrolScheduleController::class, 'delete']);
Route::post('/patrol-schedule/tambah-task', [PatrolScheduleController::class, 'taskSession'])->name('taskSession');
Route::get('/patrol-schedule/hapus-task/{index}', [PatrolScheduleController::class, 'deleteTask']);
Route::post('/patrol-schedule/edit/tambah-task', [PatrolScheduleController::class, 'editTaskSession'])->name('editTaskSession');
Route::post('/patrol-schedule/edit/tambah-jadwal-patroli', [PatrolScheduleController::class, 'editJadwalPatroliSession'])->name('editJadwalPatroliSession');
Route::get('/patrol-schedule/edit/hapus-task/{patrol_id}/{patrol_schedule_id}', [PatrolScheduleController::class, 'editDeleteTask']);
Route::get('/patrol-schedule/edit/hapus-jadwal-patroli/{patrol_id}/{patrol_task_id}', [PatrolScheduleController::class, 'editDeleteJadwalPatroli']);
Route::get('/patrol-schedule/edit/hapus-task-session/{patrol_id}/{index}', [PatrolScheduleController::class, 'editDeleteTaskSession']);
Route::get('/patrol-schedule/edit/hapus-jadwal-patroli-session/{patrol_id}/{index}', [PatrolScheduleController::class, 'editDeleteJadwalPatroliSession']);
// Map
Route::get('/patrol-schedule/mapping/{patrol_id}', [PatrolScheduleController::class, 'PatrolMapping'])->name('PatrolMapping');
Route::post('/patrol-schedule/mapping/get-marker/', [PatrolScheduleController::class, 'getMarkers'])->name('PatrolMappingGetMarker');
// Map
//END PATROL SCHEDULE



// <<<----- START PERSONIL ----->>> // 
Route::get('/personil', [PersonilController::class, 'index'])->name('Personil');
Route::view('/personil/tambah', 'content/Personil/TambahPersonil');
Route::get('/personil/tambah/process', [PersonilController::class, 'tambah']);
Route::get('/personil/edit/{personil_id}', [PersonilController::class, 'edit']);
Route::get('/personil/edit/process/{personil_id}', [PersonilController::class, 'update']);
Route::get('/personil/detail/{personil_id}', [PersonilController::class, 'detail']);
Route::get('/personil/hapus/{personil_id}', [PersonilController::class, 'delete']);
// <<<----- END PERSONIL----->>>




//START PERSONIL SCHEDULING
Route::get('/personil-scheduling', [PersonilSchedulingController::class, 'index'])->name('personil-scheduling');
Route::get('/personil-scheduling/tambah', [PersonilSchedulingController::class, 'screenTambah']);
Route::get('/personil-scheduling/tambah/process', [PersonilSchedulingController::class, 'tambah']);
Route::get('/personil-scheduling/edit/{personil_scheduling_id}', [PersonilSchedulingController::class, 'edit']);
Route::get('/personil-scheduling/edit/process/{personil_scheduling_id}', [PersonilSchedulingController::class, 'update']);
Route::get('/personil-scheduling/detail/{personil_scheduling_id}', [PersonilSchedulingController::class, 'detail']);
Route::get('/personil-scheduling/hapus/{personil_scheduling_id}', [PersonilSchedulingController::class, 'delete']);
Route::get('/personil-scheduling/cetak-pdf', [PersonilSchedulingController::class, 'CetakPDF']);
Route::get('/personil-scheduling/cetak-excel', [PersonilSchedulingController::class, 'CetakExcel']);
//END PERSONIL SCHEDULING


// PRESENSI
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi');
Route::post('/presensi/validate', [PresensiController::class, 'validasi'])->name('PresensiValidate');
Route::post('/presensi/tambah/process', [PresensiController::class, 'tambah']);
Route::get('/laporan-presensi', [PresensiController::class, 'laporanIndex'])->name('laporan-presensi');
Route::post('/laporan-presensi/filter', [PresensiController::class, 'filter'])->name('filter-laporan-presensi');
Route::get('/laporan-presensi/cetak-pdf', [PresensiController::class, 'CetakPDF']);
Route::get('/laporan-presensi/cetak-excel', [PresensiController::class, 'CetakExcel']);
// PRESENSI


// <<<----- START EMERGENCY MESSAGE ----->>> // 
Route::get('/emergency-message', [EmergencyMessageController::class, 'index'])->name('Emergency');
Route::get('/emergency-message/tambah', [EmergencyMessageController::class, 'screenTambah']);
Route::get('/emergency-message/tambah/process', [EmergencyMessageController::class, 'tambah']);
Route::get('/emergency-message/edit/{emergency_message_id}', [EmergencyMessageController::class, 'edit']);
Route::get('/emergency-message/edit/process/{emergency_message_id}', [EmergencyMessageController::class, 'update']);
Route::get('/emergency-message/detail/{emergency_message_id}', [EmergencyMessageController::class, 'detail']);
Route::get('/emergency-message/hapus/{emergency_message_id}', [EmergencyMessageController::class, 'delete']);
Route::get('/emergency-message/hapus/{emergency_message_id}', [EmergencyMessageController::class, 'delete']);
Route::get('/emergency-message/kirim-pesan/{emergency_message_id}', [EmergencyMessageController::class, 'kirimPesan']);
Route::get('/emergency-message/kirim-pesan', [EmergencyMessageController::class, 'kirimPesan']);
// <<<----- END EMERGENCY MESSAGE ----->>> //


// <<<----- START EQUIPMENT ----->>> // 
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment');
Route::get('/equipment/tambah', [EquipmentController::class, 'screenTambah']);
Route::get('/equipment/tambah/process', [EquipmentController::class, 'tambah']);
Route::get('/equipment/edit/{equipment_id}', [EquipmentController::class, 'edit']);
Route::get('/equipment/edit/process/{equipment_id}', [EquipmentController::class, 'update']);
Route::get('/equipment/detail/{equipment_id}', [EquipmentController::class, 'detail']);
Route::get('/equipment/hapus/{equipment_id}', [EquipmentController::class, 'delete']);
// <<<----- END EQUIPMENT----->>>



// <<<----- START TAKE EQUIPMENT ----->>> // 
Route::get('/take-equipment', [TakeEquipmentController::class, 'index'])->name('take-equipment');
Route::get('/take-equipment/tambah', [TakeEquipmentController::class, 'screenTambah']);
Route::get('/take-equipment/tambah/process', [TakeEquipmentController::class, 'tambah']);
Route::post('/take-equipment/tambah/sessionList',[TakeEquipmentController::class, 'sessionList'])->name('TakeEquipmentSession');
Route::get('/take-equipment/hapus-id-equipment/{index}', [TakeEquipmentController::class, 'deleteIdEquipment']);
Route::post('/take-equipment/tambah-equipment', [TakeEquipmentController::class, 'equipmentIdSession'])->name('equipmentIdSession');
Route::POST('/take-equipment/tambah/input', [TakeEquipmentController::class, 'takeEquipmentInput']);
// <<<----- END TAKE EQUIPMENT----->>>



// <<<----- START RETURN EQUIPMENT----->>>
Route::get('/return-equipment', [ReturnEquipmentController::class, 'index'])->name('return-equipment');
Route::get('/return-equipment/choose-take-equipment', [ReturnEquipmentController::class, 'indexReturnEquipment'])->name('choose-return-equipment');
Route::get('/return-equipment/tambah', [ReturnEquipmentController::class, 'screenTambah']);
Route::get('/return-equipment/tambah/process', [ReturnEquipmentController::class, 'tambah']);
Route::get('/return-equipment/choose-take-equipment/pilih/{take_equipment_id}', [ReturnEquipmentController::class, 'screenPilih']);
Route::get('/return-equipment/choose-take-equipment/pilih/process/{take_equipment_id}', [ReturnEquipmentController::class, 'tambahPilih']);
Route::post('/update-status/{take_equipment_id}', [ReturnEquipmentController::class, 'updateStatus']);
// <<<----- END RETURN EQUIPMENT----->>>



// <<<----- START BERITA ----->>>
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/tambah', [BeritaController::class, 'screenTambah']);
Route::post('/berita/tambah/process', [BeritaController::class, 'tambah']);
Route::get('/berita/edit/{berita_id}',[BeritaController::class, 'edit']);
Route::post('/berita/edit/process/{berita_id}',[BeritaController::class, 'update']);
Route::get('/berita/detail/{berita_id}', [BeritaController::class, 'detail']);
Route::get('/berita/hapus/{berita_id}', [BeritaController::class, 'delete']);
// <<<----- END BERITA ----->>>



// <<<----- START PENILAIAN KESEHATAN CATEGORY ----->>>
Route::get('/kategori-penilaian-kesehatan', [PenilaianKesehatanCategoryController::class, 'index'])->name('kategori-penilaian-kesehatan');
Route::get('/kategori-penilaian-kesehatan/tambah', [PenilaianKesehatanCategoryController::class, 'screenTambah']);
Route::get('/kategori-penilaian-kesehatan/tambah/process', [PenilaianKesehatanCategoryController::class, 'tambah']);
Route::get('/kategori-penilaian-kesehatan/edit/{penilaian_kesehatan_category_id}',[PenilaianKesehatanCategoryController::class, 'edit']);
Route::get('/kategori-penilaian-kesehatan/edit/process/{penilaian_kesehatan_category_id}',[PenilaianKesehatanCategoryController::class, 'update']);
Route::get('/kategori-penilaian-kesehatan/hapus/{penilaian_kesehatan_category_id}', [PenilaianKesehatanCategoryController::class, 'delete']);
// <<<----- END PENILAIAN KESEHATAN CATEGORY ----->>>


// <<<----- START Jadwal Penilaian Kesehatan ----->>>
Route::get('/jadwal-penilaian-kesehatan', [JadwalPenilaianKesehatanController::class, 'index'])->name('jadwal-penilaian-kesehatan');
Route::get('/jadwal-penilaian-kesehatan/tambah', [JadwalPenilaianKesehatanController::class, 'screenTambah']);
Route::post('/jadwal-penilaian-kesehatan/tambah/process', [JadwalPenilaianKesehatanController::class, 'tambah']);
Route::get('/jadwal-penilaian-kesehatan/edit/{penilaian_kesehatan_schedule_id}',[JadwalPenilaianKesehatanController::class, 'edit']);
Route::post('/jadwal-penilaian-kesehatan/edit/process/{penilaian_kesehatan_schedule_id}',[JadwalPenilaianKesehatanController::class, 'update']);
Route::get('/jadwal-penilaian-kesehatan/detail/{penilaian_kesehatan_schedule_id}', [JadwalPenilaianKesehatanController::class, 'detail']);
Route::get('/jadwal-penilaian-kesehatan/hapus/{penilaian_kesehatan_schedule_id}', [JadwalPenilaianKesehatanController::class, 'delete']);
// <<<----- END Jadwal Penilaian Kesehatan ----->>>



Route::get('/penilaian-kesehatan', [PenilaianKesehatanController::class, 'index'])->name('penilaian-kesehatan');
Route::get('/penilaian-kesehatan/tambah', [PenilaianKesehatanController::class, 'screenTambah']);
Route::get('/penilaian-kesehatan/tambah/process', [PenilaianKesehatanController::class, 'tambah']);
Route::get('/penilaian-kesehatan/edit/{penilaian_kesehatan_schedule_id}',[PenilaianKesehatanController::class, 'edit']);
Route::get('/penilaian-kesehatan/edit/process/{penilaian_kesehatan_schedule_id}',[PenilaianKesehatanController::class, 'update']);
Route::get('/penilaian-kesehatan/detail/{penilaian_kesehatan_schedule_id}', [PenilaianKesehatanController::class, 'detail']);
Route::get('/penilaian-kesehatan/hapus/{penilaian_kesehatan_schedule_id}', [PenilaianKesehatanController::class, 'delete']);
Route::get('/penilaian-kesehatan/cetak-pdf', [PenilaianKesehatanController::class, 'CetakPDF']);
Route::get('/penilaian-kesehatan/cetak-excel', [PenilaianKesehatanController::class, 'CetakExcel']);