<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForgotPassword;

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

/*These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group */
Route::get('forgot-password', [ForgotPassword::class, 'sendForgotPasswordCode']);

Route::post('reset-password', [ChangePasswordController::class, 'passwordResetProcess']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-leaders/{role}', 'UserDisplayController@getAllLeaders');

// Kini siya nga function kay i return niya ang tanan nga pastors 
Route::get('get-pastors', 'UserDisplayController@returnAllPastorsWithItsLeaders');

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

// Kini siya nga function kay iyang kuhaon ang kapareho niya sa cell group 
Route::get('get-the-same-role/{role}', 'UserDisplayController@returnCellGroup');

// This route is to get the account of a certain user
Route::get('user-account/{id}', 'UserDisplayController@getUserAccount');

Route::post('updateUser', 'UserDisplayController@update');

Route::get('return-all-pastors/{code}', 'UserDisplayController@getAllPastorCode1');
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

Route::get('regular-members/{code}', 'attendanceController@returnRegularMembers');

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

Route::post('event-announcement/update/{id}', 'eventAndAnnouncementControl@updateEventsAndAnnouncement');

Route::delete('event-announcement/delete/{id}', 'eventAndAnnouncementControl@deleteEventsAndAnnouncement');

// This route is to return all students of a specific events or announcements
Route::get('add-event-announcement/return-all-students/{id}', 'eventAndAnnouncementControl@returnAllStudents');

Route::get('event-owner/{id}','eventAndAnnouncementControl@eventOwner');

Route::get('event-return/{id}', 'eventAndAnnouncementControl@returnEvent');

// This routes is the responsible in adding trainings and also lessons 
Route::get('trainings-and-classes/return-all-traininings', 'trainingsAndClasses@returnAllTrainings');

Route::post('trainings-and-classes/add-trainings-with-lessons', 'trainingsAndClasses@addTrainingsAndLessons');

Route::delete('trainings-and-classes/delete-selected-training/{trainingID}', 'trainingsAndClasses@deleteTrainingAndLessons');

Route::get('trainings-and-classes/get-all-trainings/{id}', 'trainingsAndClasses@returnTrainingByUser');

Route::post('trainings-and-classes/add-lesson-of-training/{trainingsID}', 'trainingsAndClasses@addLessonOfTraining');

Route::get('trainings-and-classes/return-lesson-of-selected-training/{id}', 'trainingsAndClasses@returnLessonsOfTraining');

Route::get('trainings-and-classes/return-classes-of-selected-training/{id}', 'trainingsAndClasses@returnClasses');

Route::post('trainings-and-classes/add-classes-with-students', 'trainingsAndClasses@addClasses');

Route::post('trainings-and-classes/update-class-of-training/{classID}', 'trainingsAndClasses@updateClass');

Route::get('trainings-and-classes/return-selected-class/{id}', 'trainingsAndClasses@returnSelectedClass');

Route::get('trainings-and-classes/return-selected-training/{id}', 'trainingsAndClasses@returnSelectedTraining');

Route::get('trainings-and-classes/return-selected-lesson/{lessonID}', 'trainingsAndClasses@returnLessonDetails');

Route::post('trainings-and-classes/add-students-to-class', 'trainingsAndClasses@addStudentToAClass');

Route::post('trainings-and-classes/add-students-records', 'trainingsAndClasses@addStudentRecord');

Route::get('trainings-and-classes/get-students-of-selected-class/{classID}', 'trainingsAndClasses@returnStudentsID');

Route::get('trainings-and-classes/students-of-the-class/{classID}', 'trainingsAndClasses@getStudentOfSelectedClass');

Route::get('trainings-and-classes/update-students-score/{studentId}/{score}/{classID}', 'trainingsAndClasses@updateStudentsScore');

Route::get('trainings-and-classes/deleteLessonOfTraining/{id}', 'trainingsAndClasses@deleteLessonsOfTraining');

Route::get('trainings-and-classes/get-certain-student-collection-student/{usersID}', 'trainingsAndClasses@returnStudentFromStudentCollection');

Route::get('trainings-and-classes/check-student-already-exist/{studentID}/{classID}', 'trainingsAndClasses@checkStudentIfAlreadyExist');

Route::delete('trainings-and-classes/remove-student-from-class/{studentID}/{classID}', 'trainingsAndClasses@removeStudentOfCertainClass');
// This routes are for adding students to records
// Route::post('class-records/add-student', 'RecordsController@addNewRecord');

// Route::get('class-records/get-students/{lessonID}/{classID}', 'RecordsController@getAllStudentsFromRecords');

// Route::post('student-trainings-or-class/addToRecords', 'TrainingsRecords@addStudentToRecords');

// Route::get('student-trainings-or-class/get-student-using-cms-ID/{id}', 'TrainingsRecords@getStudentFromStudentTable');

// Route::post('student-trainings-or-class/update-students-score', 'TrainingsRecords@updateScoreOfStudent');

// Route::get('student-trainings-or-class/get-students-trainings-classes/{id}/{type}', 'TrainingsRecords@getStudentsOfClassOrTraining');

// Route::get('student-trainings-or-class/get-student/{id}', 'TrainingsRecords@getStudentFromCMS_UserTable');

// Route::post('student-trainings-or-class/delete-multiple-students', 'TrainingsRecords@multipleStudentDelete');

// Route::post('student-trainings-or-class/delete-record/{id}', 'TrainingsRecords@deleteRecord');

// Route::get('student-trainings-or-class/delete-student/{id}', 'TrainingsRecords@deleteStudent');

// This route is for the adding an attendance of a member in sunday celebration or adding an attendance in events 
Route::post('add-attendance/today-has-event', 'AttendanceEventAndSunday@addAttendanceInSCorEvents');

Route::get('add-attendance/get-all-events-dates', 'AttendanceEventAndSunday@allEventsDates');

Route::get('add-attendance/get-event-details/{id}', 'AttendanceEventAndSunday@attendanceForTheSelectedEvent');

Route::post('lesson/update/{id}', 'trainingsAndClasses@updateLessonOfTraining');