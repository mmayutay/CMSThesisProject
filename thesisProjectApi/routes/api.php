<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-leaders', 'UserDisplayController@getAllLeaders');

//This is for looking who is active and inactive users
Route::get('allMemberUsers', 'findActiveAndInactiveUsers@returnAllMembers');

Route::post('addInactiveUser', 'findActiveAndInactiveUsers@userInactive');

//This is for creating account and for logging in
Route::get('list', 'Controls@allUsersFromAdminToMember');

Route::get('allAccounts', 'Controls@allAccount');

Route::post('login', 'authController@login');

Route::post('sign-up', 'authController@signUp');

Route::post('userProfile', 'App\Http\Controllers\Controls@getUserInfo');


//This is for the logged users matter
Route::post('/info','UserDisplayController@getUsers');

// Route::get('/info/edit', 'UserDisplayController@editUserInfo');

// Route::post('/info/update', 'UserDisplayController@updateUserInfo');

Route::post('getCurrentUser', 'App\Http\Controllers\LoggedUserMatters@getTheCurrentUser');

Route::get('edit', 'UserDisplayController@edit');

Route::post('updateUser', 'UserDisplayController@update');

// Route::post('member', 'UserDisplayController@insert');

Route::post('leader', 'Controls@getCell');

Route::post('cell', 'Controls@getLeader');

Route::post('network', 'Controls@getNetwork');

Route::post('currentUserRole', 'Controls@getRolesById');

Route::get('getAllUserRoles', 'Controls@cell');

Route::get('users', 'Controls@cell');

Route::post('attendance', 'attendanceController@getDay');

Route::get('vip-users', 'returnVipUsers@retrieveAllVipUsers');

Route::get('vip-user-with-leader', 'returnVipUsers@retrieveVipUsersWithLeader');

Route::get('all-new-unvip-members', 'returnVipUsers@allRecordedNewMember');

Route::post('get-user-attendance', 'attendanceController@viewAttendance');

Route::post('current-user-attendance', 'attendanceController@returnCurrentUserAttendance');

Route::post('user-attendance-year-selected', 'attendanceController@currentUsersAttendanceYear');

Route::post('viewAttendancesOfSCandEvents', 'attendanceController@viewAttendanceSCandEvents');

Route::post('viewAttendancesOfCellGroup', 'attendanceController@viewCellAttendance');

Route::get('regular-members', 'attendanceController@returnRegularMembers');

Route::post('leader-sc-cg', 'attendanceController@returnEventsandSC');


// Auth::routes();


//This is for Auxiliary
Route::post('profile/auxiliary', 'AuxiliaryController@index');

//This is for Ministries
Route::post('profile/ministries', 'MinistriesController@index');

Route::get('ministries', 'MinistriesController@getMinistry');

Route::get('ministries/list', 'MinistriesController@ministryList');

Route::post('ministries/add/{id}', 'MinistriesController@store');

Route::post('return-weekly-attendance', 'attendanceController@returnWeeklyAttendance');

//This function will return all the members of a certain group by the ID of a leader
Route::post('return-members-group', 'Controls@returnMembersOfAGroup');

// Route::get('add-role-to-collection', 'findActiveAndInactiveUsers@insertDataForUserRoles');

//This function is for the user to add an event and announcement
Route::post('add-event-announcement', 'eventAndAnnouncementControl@addEventOrAnnouncement');

Route::get('add-event-announcement/display', 'eventAndAnnouncementControl@returnAllEventsAndAnnouncement');

Route::post('add-event-announcement/update/{id}', 'eventAndAnnouncementControl@updateEventsAndAnnouncement');

Route::delete('add-event-announcement/delete/{id}', 'eventAndAnnouncementControl@deleteEventsAndAnnouncement');

Route::get('event-owner/{id}','eventAndAnnouncementControl@eventOwner');

Route::get('event-return/{id}', 'eventAndAnnouncementControl@returnEvent');


// This routes is for the trainings and classes
Route::get('trainings-by-instructor/return-by-current-user/{id}', 'trainingsAndClasses@trainingsAndClassesPosted');

Route::get('trainings-by-instructor/{id}', 'trainingsAndClasses@returnTrainingsLeader');

Route::post('trainings-by-instructor/get-selected-class', 'trainingsAndClasses@getSelectedClassOrTrainings');

Route::post('trainings-by-instructor/get-student-of-a-class-training', 'trainingsAndClasses@getStudentsOfACertainClassOrTrainings');

Route::post('trainings-by-instructor/add', 'trainingsAndClasses@addATrainingOrClass');

Route::post('trainings-by-instructor/update-training-or-class/{id}', 'trainingsAndClasses@updateSelectedClassOrTrainings');

Route::post('trainings-by-instructor/delete-training-or-class/{id}', 'trainingsAndClasses@deleteSelectedClassOrTraining');

// This routes are for adding students to records
Route::post('student-trainings-or-class/addToRecords', 'TrainingsRecords@addStudentToRecords');

Route::get('student-trainings-or-class/get-student/{id}', 'TrainingsRecords@getStudentFromCMS_UserTable');

Route::post('student-trainings-or-class/delete-multiple-students', 'TrainingsRecords@multipleStudentDelete');