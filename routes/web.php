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

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
 */

Route::get('/', 'Frontend\PagesController@index')->name('index');

Route::get('/terms-and-service', 'Frontend\PagesController@termsAndService')->name('terms');
Route::get('/privacy-policy', 'Frontend\PagesController@privacyPolicy')->name('privacy');

/*** Employers **/
Route::group(['prefix' => 'employers'], function () {
    Route::get('', 'Frontend\EmployersController@index')->name('employers');
    Route::get('/view/{username}', 'Frontend\EmployersController@show')->name('employers.show');

    // About
    Route::post('/about/update/{id}', 'Frontend\EmployersController@updateAbout')->name('employers.about.update');
    Route::post('/profile/update/{id}', 'Frontend\EmployersController@updateProfile')->name('employers.profile.update');

    Route::get('/search', 'Frontend\EmployersController@search')->name('employers.search');
    Route::get('/dashboard', 'Frontend\EmployersController@dashboard')->name('employers.dashboard');
    Route::get('/favorite-jobs', 'Frontend\EmployersController@favoriteJobs')->name('employers.jobs.favorite');
    Route::get('/posted-jobs', 'Frontend\EmployersController@postedJobs')->name('employers.jobs.posted');
    Route::post('/posted-jobs/delete/{slug}', 'Frontend\EmployersController@deleteJob')->name('employers.jobs.delete');
    Route::get('/applications/{slug}', 'Frontend\EmployersController@jobApplications')->name('employers.jobs.applications');
    Route::get('/messages', 'Frontend\EmployersController@messages')->name('employers.messages');

});

/*** candidates **/
Route::group(['prefix' => 'candidates'], function () {
    Route::get('', 'Frontend\CandidatesController@index')->name('candidates');
    Route::get('/view/{username}', 'Frontend\CandidatesController@show')->name('candidates.show');
    Route::get('/view-resume/{username}', 'Frontend\CandidatesController@showResume')->name('candidates.showResume');
    Route::get('/search', 'Frontend\CandidatesController@search')->name('candidates.search');

    // Experience
    Route::post('/add-experience', 'Frontend\ExperiencesController@store')->name('candidates.experience.store');
    Route::post('/update-experience/{id}', 'Frontend\ExperiencesController@update')->name('candidates.experience.update');
    Route::post('/delete-experience/{id}', 'Frontend\ExperiencesController@destroy')->name('candidates.experience.delete');

    // Education
    Route::post('/add-education', 'Frontend\EducationsController@store')->name('candidates.education.store');
    Route::post('/update-education/{id}', 'Frontend\EducationsController@update')->name('candidates.education.update');
    Route::post('/delete-education/{id}', 'Frontend\EducationsController@destroy')->name('candidates.education.delete');

    // Awards
    Route::post('/add-award', 'Frontend\AwardsController@store')->name('candidates.award.store');
    Route::post('/update-award/{id}', 'Frontend\AwardsController@update')->name('candidates.award.update');
    Route::post('/delete-award/{id}', 'Frontend\AwardsController@destroy')->name('candidates.award.delete');

    // Skills
    Route::post('/add-skill', 'Frontend\SkillsController@store')->name('candidates.skill.store');
    Route::post('/update-skill/{id}', 'Frontend\SkillsController@update')->name('candidates.skill.update');
    Route::post('/delete-skill/{id}', 'Frontend\SkillsController@destroy')->name('candidates.skill.delete');

    // Portfolio
    Route::post('/addportfolio', 'Frontend\PortfoliosController@store')->name('candidates.portfolio.store');
    Route::post('/update-portfolio/{id}', 'Frontend\PortfoliosController@update')->name('candidates.portfolio.update');
    Route::post('/delete-portfolio/{id}', 'Frontend\PortfoliosController@destroy')->name('candidates.portfolio.delete');

    // About
    Route::post('/about/update/{id}', 'Frontend\CandidatesController@updateAbout')->name('candidates.about.update');
    Route::post('/profile/update/{id}', 'Frontend\CandidatesController@updateProfile')->name('candidates.profile.update');

    Route::get('/dashboard', 'Frontend\CandidatesController@dashboard')->name('candidates.dashboard');
    Route::get('/messages', 'Frontend\CandidatesController@messages')->name('candidates.messages');
    Route::get('/favorite-jobs', 'Frontend\CandidatesController@favoriteJobs')->name('candidates.jobs.favorite');
    Route::get('/applied-jobs', 'Frontend\CandidatesController@appliedJobs')->name('candidates.jobs.applied');
});

/*** contacts **/

Route::get('/contact-us', 'Frontend\ContactsController@index')->name('contacts');
Route::post('/contact-us', 'Frontend\ContactsController@store')->name('contacts.store');
Route::post('/contact-us/delete/{id}', 'Frontend\ContactsController@destroy')->name('contacts.delete');

/*** jobs **/
Route::group(['prefix' => 'jobs'], function () {
    Route::get('', 'Frontend\JobsController@index')->name('jobs');
    Route::get('/view/{slug}', 'Frontend\JobsController@show')->name('jobs.show');
    Route::get('/positions/{slug}', 'Frontend\JobsController@category')->name('jobs.categories.show');
    Route::get('/skills/{slug}', 'Frontend\JobsController@category')->name('jobs.skills.show');
    Route::get('/experiences/{slug}', 'Frontend\JobsController@category')->name('jobs.experiences.show');
    Route::get('/post', 'Frontend\JobsController@post')->name('jobs.post');
    Route::get('/update/{slug}', 'Frontend\JobsController@edit')->name('jobs.edit');
    Route::post('/update-job/{slug}', 'Frontend\JobsController@update')->name('jobs.update');
    Route::post('/post/add', 'Frontend\JobsController@store')->name('jobs.store');
    Route::post('/apply', 'Frontend\JobsController@apply')->name('jobs.apply');
    Route::post('/apply-update', 'Frontend\JobsController@applyUpdate')->name('jobs.apply.update');
    Route::get('/search', 'Frontend\JobsController@searchJob')->name('jobs.search');
    /*
     * start route quiz or online exam
     */
    Route::group(['prefix' => 'exam'], function () {
        Route::get('/home/{id}', 'Frontend\ExamController@index')->name('exam');
        Route::get('/questions/{id}', 'Frontend\ExamController@questions');
        Route::get('/check-skill', 'Frontend\ExamController@checkSkill');
        Route::get('/results', 'Frontend\ExamController@ShowResult')->name('show-result');
        Route::post('/results', 'Frontend\ExamController@Results');
        Route::get('/check-exam-status', 'Frontend\ExamController@examStatus');
    });
});

Route::group(['prefix' => 'messages'], function () {
    Route::get('', 'Frontend\ContactsController@getMessages')->name('messages');
    Route::post('/store', 'Frontend\ContactsController@store')->name('messages.store');
    Route::post('/view/{id}', 'Frontend\ContactsController@viewMessage')->name('messages.show');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/dashboard', 'Frontend\UsersController@dashboard')->name('users.dashboard');

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', 'Frontend\UsersController@getMessages')->name('users.messages');
        Route::get('/{id}', 'Frontend\UsersController@showMessage')->name('users.messages.show');
    });
});

/** Subscription Routes **/
Route::post('/get-subscribed', 'Frontend\SubscriberController@store')->name('users.subscribe');
Route::get('/unsubscribe/{email}', 'Frontend\SubscriberController@unsubscribe')->name('users.unsubscribe');
// Route::get('/send-email-all-subscriber/{token}', 'Frontend\SubscriberController@sendEmailAsCron')->name('users.subscribe.send-email');

/** Authentication Routes **/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify/{verify_token}', 'Auth\VerificationController@verify')->name('user.verify');

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| All the routes which is related to backend/admin panel of the site will be placed here
|
 */

// Route::get('admin', 'Backend\PagesController@index')->name('index');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // HomePage
    Route::get('', function () {
        return redirect()->route('admin.index');
    });
    Route::get('/dashboard', 'Backend\PagesController@index')->name('index');

    // Admin Login Routes
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('login');
    Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('login.submit');
    Route::post('/logout/submit', 'Auth\Admin\LoginController@logout')->name('logout');

    // Password Email Send
    Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/resetPost', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    // Password Reset
    Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('password.reset.post');

    Route::get('/change-password', 'Backend\PagesController@changePasswordForm')->name('password.changeForm');
    Route::post('/change-password', 'Backend\PagesController@changePassword')->name('password.change');

    /**
     * Job Routes
     */
    Route::group(['prefix' => 'job'], function () {
        Route::get('/', 'Backend\JobsController@index')->name('job.index');
        Route::get('/trash', 'Backend\JobsController@trash')->name('job.trash');
        Route::post('/add', 'Backend\JobsController@store')->name('job.submit');
        Route::post('/edit/{id}', 'Backend\JobsController@update')->name('job.update');
        Route::post('/delete/{id}', 'Backend\JobsController@destroy')->name('job.delete');
        Route::post('/active/{id}', 'Backend\JobsController@active')->name('job.active');
    });

    /**
     * Admin Account Routes
     */
    Route::get('/list', 'Backend\AdminController@index')->name('account.index');
    Route::get('/add', 'Backend\AdminController@create')->name('account.add');
    Route::post('/add', 'Backend\AdminController@store')->name('account.store');
    Route::get('/edit/{username}', 'Backend\AdminController@edit')->name('account.edit');
    Route::post('/edit/{username}', 'Backend\AdminController@update')->name('account.update');
    Route::get('/activate/{verify_token}', 'Backend\AdminController@activateAccount')->name('account.active');
    Route::post('/delete/{username}', 'Backend\AdminController@destroy')->name('account.delete');

    /**
     * Category Routes
     */
    Route::group(['prefix' => 'positions'], function () {
        Route::get('/', 'Backend\CategoryController@index')->name('category.index');
        Route::get('/trash', 'Backend\CategoryController@trash')->name('category.trash');
        Route::post('/add', 'Backend\CategoryController@store')->name('category.submit');
        Route::post('/edit/{id}', 'Backend\CategoryController@update')->name('category.update');
        Route::post('/delete/{id}', 'Backend\CategoryController@destroy')->name('category.delete');
        Route::post('/active/{id}', 'Backend\CategoryController@active')->name('category.active');
    });

    /**
     * Skill Routes
     */
    Route::group(['prefix' => 'skill'], function () {
        Route::get('/', 'Backend\SkillsController@index')->name('skill.index');
        Route::get('/trash', 'Backend\SkillsController@trash')->name('skill.trash');
        Route::post('/add', 'Backend\SkillsController@store')->name('skill.submit');
        Route::post('/edit/{id}', 'Backend\SkillsController@update')->name('skill.update');
        Route::post('/delete/{id}', 'Backend\SkillsController@destroy')->name('skill.delete');
        Route::post('/active/{id}', 'Backend\SkillsController@active')->name('skill.active');
    });

    /**
     * Discipline Routes
     */
    Route::group(['prefix' => 'discipline'], function () {
        Route::get('/', 'Backend\DisciplinesController@index')->name('discipline.index');
        Route::get('/trash', 'Backend\DisciplinesController@trash')->name('discipline.trash');
        Route::post('/add', 'Backend\DisciplinesController@store')->name('discipline.submit');
        Route::post('/edit/{id}', 'Backend\DisciplinesController@update')->name('discipline.update');
        Route::post('/delete/{id}', 'Backend\DisciplinesController@destroy')->name('discipline.delete');
        Route::post('/active/{id}', 'Backend\DisciplinesController@active')->name('discipline.active');
    });

    /**
     * Segment Routes
     */
    Route::group(['prefix' => 'segment'], function () {
        Route::get('/', 'Backend\SegmentsController@index')->name('segment.index');
        Route::get('/trash', 'Backend\SegmentsController@trash')->name('segment.trash');
        Route::post('/add', 'Backend\SegmentsController@store')->name('segment.submit');
        Route::post('/edit/{id}', 'Backend\SegmentsController@update')->name('segment.update');
        Route::post('/delete/{id}', 'Backend\SegmentsController@destroy')->name('segment.delete');
        Route::post('/active/{id}', 'Backend\SegmentsController@active')->name('segment.active');
    });

    /**
     * Sector Routes
     */
    Route::group(['prefix' => 'sector'], function () {
        Route::get('/', 'Backend\SectorsController@index')->name('sector.index');
        Route::get('/trash', 'Backend\SectorsController@trash')->name('sector.trash');
        Route::post('/add', 'Backend\SectorsController@store')->name('sector.submit');
        Route::post('/edit/{id}', 'Backend\SectorsController@update')->name('sector.update');
        Route::post('/delete/{id}', 'Backend\SectorsController@destroy')->name('sector.delete');
        Route::post('/active/{id}', 'Backend\SectorsController@active')->name('sector.active');
    });

    /**
     * Experience Routes
     */
    Route::group(['prefix' => 'experience'], function () {
        Route::get('/', 'Backend\ExperiencesController@index')->name('experience.index');
        Route::get('/trash', 'Backend\ExperiencesController@trash')->name('experience.trash');
        Route::post('/add', 'Backend\ExperiencesController@store')->name('experience.submit');
        Route::post('/edit/{id}', 'Backend\ExperiencesController@update')->name('experience.update');
        Route::post('/delete/{id}', 'Backend\ExperiencesController@destroy')->name('experience.delete');
        Route::post('/active/{id}', 'Backend\ExperiencesController@active')->name('experience.active');
    });

    /**
     * User Routes
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/candidates', 'Backend\UsersController@candidates')->name('users.candidates');
        Route::get('/employers', 'Backend\UsersController@employers')->name('users.employers');
        Route::post('/bann/{id}', 'Backend\UsersController@ban')->name('users.change_status');
    });

    /**
     * Tag Routes
     */
    Route::group(['prefix' => 'tag'], function () {
        Route::get('/', 'Backend\TagController@index')->name('tag.index');
        Route::get('/add', 'Backend\TagController@create')->name('tag.add');
        Route::post('/add', 'Backend\TagController@store')->name('tag.submit');
        Route::get('/edit/{id}', 'Backend\TagController@edit')->name('tag.edit');
        Route::post('/edit/{id}', 'Backend\TagController@update')->name('tag.update');
        Route::post('/delete/{id}', 'Backend\TagController@destroy')->name('tag.delete');
    });

    //Route::get('/','QuestionController@index');
    Route::post('question/{id}', 'Backend\QuestionController@update')->name('que.update');

    Route::resource('question', 'Backend\QuestionController');
    Route::get('delete_question/{question_id}', 'Backend\QuestionController@delete_question');

    /**
     * Template Routes
     * Job Posting Template Routes
     */
    Route::group(['as' => ''], function () {
        Route::resource('templates', 'Backend\TemplatesController');
    });

    // City/Country Manage
    Route::resource('cities', 'Backend\CitiesController');

    // State Manage
    Route::resource('states', 'Backend\StatesController');

    // Job Crawlers
    Route::resource('crawlers', 'Backend\JobCrawlersController');

    // Crawler Sites
    Route::resource('crawler_sites', 'Backend\CrawlerSitesController');

    // Assign Url to Site
    Route::get('assign-site', 'Backend\JobCrawlersController@asignSite')->name('sites.assign');
    Route::get('assign-site-list', 'Backend\JobCrawlersController@asignSiteList')->name('sites.asignSiteList');
    Route::post('assign-site', 'Backend\JobCrawlersController@asignSiteStore')->name('sites.assign.store');
    Route::delete('assign-site/{id}', 'Backend\JobCrawlersController@asignSiteDelete')->name('sites.assign.delete');

    Route::get('extract-links', 'Backend\JobCrawlersController@extractLinks')->name('crawl.extractLinks');
    Route::post('extract-links', 'Backend\JobCrawlersController@extractLinksStore')->name('crawl.extractLinks.store');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('', 'Backend\SettingsController@index')->name('settings.index');
        Route::put('', 'Backend\SettingsController@update')->name('settings.update');
    });
});

Route::post('/question/upload', "Backend\QuestionController@upload");
Route::get('/question/file_browser', "Backend\QuestionController@fileBrowser");