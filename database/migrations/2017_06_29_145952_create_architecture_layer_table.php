<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectureLayerTable extends Migration
{
    /**
     * 系統底層基本表
     *
     * @return void
     */
    public function up()
    {

        Schema::create($table = 'BASIC_COLUMN', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('BACOL_ID')->comment('關聯代碼')->primary();

            $table->string('BACOL_PARENT_ID', 100)->comment('父關聯代碼');
            $table->string('BACOL_NAME', 100)->comment('顯示名稱');
            $table->unsignedInteger('BACOL_LEVEL')->comment('關聯層級');
            $table->unsignedInteger('BACOL_ORDER')->comment('排序');
            $table->unsignedTinyInteger('IS_DELETE')->comment('是否刪除');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '基本欄位'");




        Schema::create($table = 'CONTENT', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('CL_ID')->comment('內容管理ID')->primary();

            $table->string('MODULE_ID',100)->comment('關聯代碼');
            $table->string('CL_CAPTION',255)->comment('標題');
            $table->string('CL_CONTENT',3000)->nullable()->comment('內文');
            $table->string('CL_REG_CONTENT',3000)->nullable()->comment('濾tag內文');
            $table->dateTime('CL_DATE')->comment('公告日期');
            $table->unsignedInteger('ORDER_NO')->default(1)->comment('排序編號');
            $table->unsignedTinyInteger('IS_TOP')->default(0)->comment('是否置頂');
            $table->unsignedTinyInteger('IS_DELETE')->default(0)->comment('是否刪除');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT 'Portal內容管理'");




        Schema::create($table = 'CONTENT_FILE_REL', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('CONTENT_REL_ID')->comment('關連檔ID')->primary();

            $table->uuid('CL_ID')->comment('內容管理ID');
            $table->uuid('FILE_ID')->comment('檔案ID');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT 'Portal內容管理檔案關連'");





        Schema::create($table = 'FILE_INFO', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('FILE_ID')->comment('檔案ID')->primary();

            $table->string('MODULE_ID',100)->comment('關聯代碼');
            $table->string('FILE_NAME',100)->comment('檔案抬頭');
            $table->string('FILE_FILENAME',500)->comment('檔案名稱(實際檔案放置的名稱)');
            $table->string('FILE_NEW_FILENAME',500)->comment('檔案名稱 (下載/串流檔案名稱)');
            $table->unsignedInteger('FILE_TYPE')->comment('可用類型(限本人下載、有登入即可、相對路徑)');
            $table->string('FILE_PATH',500)->comment('檔案路徑');
            $table->string('FILE_LINK',500)->nullable()->comment('檔案串流連結');
            $table->string('FILE_URL',500)->nullable()->comment('點擊連結');
            $table->string('FILE_DESCRIPTION',500)->nullable()->comment('描述');
            $table->unsignedTinyInteger('IS_ACTIVE')->default(1)->comment('是否顯示');
            $table->dateTime('BEGIN_DT')->nullable()->comment('有效起日');
            $table->dateTime('END_DT')->nullable()->comment('有效訖日');
            $table->unsignedInteger('ORDER_NO')->comment('排序');
            $table->uuid('TS_ID')->comment('擁有者帳號');
            $table->string('SROL_ID',50)->comment('角色代碼');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '檔案表'");





        Schema::create($table = 'MENU', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->unsignedBigInteger('MNU_ID')->comment('選單代碼')->primary();

            $table->unsignedBigInteger('MNU_PARENT_ID')->comment('父選單代碼');
            $table->string('SYS_CLASS',100)->comment('系統別');
            $table->string('MNU_NAME',30)->comment('選單名稱');
            $table->string('MNU_URL',255)->nullable()->comment('選單連結');
            $table->char('MNU_KIND',1)->comment('選單類型');
            $table->unsignedInteger('MNU_LEVEL')->comment('選單層級');
            $table->unsignedInteger('MNU_ORDER')->comment('排序');
            $table->unsignedTinyInteger('IS_AUTHORIZE_PAGE')->default(1)->comment('需驗證才顯示(目錄是否需在使用者登入的情況下才顯示)');
            $table->unsignedTinyInteger('IS_BLANK_PAGE')->default(0)->comment('開啟新頁面');
            $table->unsignedTinyInteger('IS_DELETE')->default(0)->comment('是否刪除');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '系統選單'");





        Schema::create($table = 'NEWS', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('NEWS_ID')->comment('最新消息ID')->primary();

            $table->string('INTERN_CLASS_ID',100)->comment('實習／校園資訊');
            $table->string('NEWS_CLASS_ID',100)->comment('分類編號');
            $table->string('CAPTION',255)->comment('公告主題');
            $table->string('CONTENT',3000)->comment('消息公告');
            $table->string('REG_CONTENT',3000)->comment('濾tag內文');
            $table->unsignedInteger('ORDER_NO')->comment('排序編號');
            $table->unsignedTinyInteger('IS_TOP')->comment('是否置頂');
            $table->unsignedTinyInteger('IS_LIGHT')->nullable()->comment('是否跑馬燈');
            $table->unsignedTinyInteger('IS_DELETE')->comment('是否刪除');
            $table->dateTime('BEGIN_DT')->nullable()->comment('活動起日與時間');
            $table->dateTime('END_DT')->nullable()->comment('活動迄日與時間');
            $table->string('PLACE',255)->nullable()->comment('活動地點');
            $table->string('NEWS_DEPT',50)->nullable()->comment('公告單位');
            $table->string('NEWS_PERSON',20)->nullable()->comment('承辦人員');
            $table->string('NEWS_PHONE',20)->nullable()->comment('連絡電話');
            $table->dateTime('NEWS_DATE')->comment('公告日期');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '最新消息'");


        Schema::create($table = 'NEWS_FILE_REL', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('NFILE_REL_ID')->comment('關連檔ID')->primary();
            $table->uuid('NEWS_ID')->comment('最新消息ID');
            $table->uuid('FILE_ID')->comment('檔案ID');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '最新消息檔案關連'");





        Schema::create($table = 'SROL_MNU', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->string('SROL_ID',50)->comment('角色代碼')->primary();
            $table->unsignedBigInteger('MNU_ID')->comment('選單代碼');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '角色選單關係表'");




        Schema::create($table = 'SYS_ROLE', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->string('SROL_ID',50)->comment('角色代碼')->primary();

            $table->string('SROL_NAME',50)->comment('角色名稱');
            $table->unsignedInteger('SROL_ORDER')->comment('排序');
            $table->unsignedTinyInteger('SROL_IS_DEFAULT')->default(0)->comment('由系統自動建立標記(註記本欄位是否為系統資料庫建立時自動建立的預設欄位，或該欄位日後不允許進行內容修改或刪除)');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '系統角色'");





        Schema::create($table = 'SYS_YEAR', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('SYSYR_ID')->comment('學年期代碼')->primary();

            $table->string('SYSYR_NAME',50)->comment('顯示名稱');
            $table->string('SYSYR_STARTDATE')->comment('開始日期');
            $table->string('SYSYR_ENDDATE')->comment('結束日期');
            $table->string('SYSYR_ORDER')->comment('排序');
            $table->string('SYSYR_AYR',3)->nullable()->comment('學年');
            $table->string('SYSYR_ASM',2)->nullable()->comment('學期');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '學年期資訊'");





        Schema::create($table = 'TRUSTEE', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('TS_ID')->comment('使用者帳號')->primary();

            $table->string('TS_NAME',200)->comment('使用者名稱');
            $table->string('TS_ACCOUNT',50)->comment('使用者帳號');
            $table->string('TS_PASSWORD',200)->nullable()->comment('使用者密碼');
            $table->string('TS_PASSWORD_SALT',20)->nullable()->comment('密碼動態加密代碼(密碼加密用字串)');
            $table->string('TS_EMAIL',200)->comment('使用者Email');
            $table->string('TS_PHONE',20)->comment('使用者電話');
            $table->unsignedTinyInteger('TS_STATUS')->default(1)->comment('是否啟用');
            $table->unsignedTinyInteger('TS_IS_LDAP')->default(0)->comment('是否為 Ldap 帳號');
            $table->unsignedTinyInteger('TS_IS_DEFAULT')->default(0)->comment('由系統自動建立標記(註記本欄位是否為系統資料庫建立時自動建立的預設欄位，或該欄位日後不允許進行內容修改或刪除)');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '系統使用者'");





        Schema::create($table = 'TS_MNU', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('TS_ID')->comment('使用者帳號');
            $table->unsignedBigInteger('MNU_ID')->comment('選單代碼');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');

            $table->primary(['TS_ID','MNU_ID']);
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '使用者選單關係'");





        Schema::create($table = 'TS_SROL', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('TS_ID')->comment('使用者帳號');
            $table->string('SROL_ID',50)->comment('角色代碼');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '使用者角色關係表'");


        Schema::create($table = 'DEPARTMENT', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('DEP_ID')->comment('單位代碼')->primary();
            $table->uuid('SYSYR_ID')->comment('學年期ID');
            $table->string('COLLEGE_ID',50)->nullable()->comment('學院代碼');
            $table->string('COLLEGE_NAME',200)->nullable()->comment('學院名稱');
            $table->string('DEPARTMENT_ID',50)->nullable()->comment('系所代碼');
            $table->string('DEPARTMENT_NAME',200)->nullable()->comment('系所名稱');
            $table->string('GRADE_ID',50)->nullable()->comment('年級代碼');
            $table->string('GRADE_NAME',200)->nullable()->comment('年級名稱');
            $table->string('CLASS_ID',50)->nullable()->comment('班級代碼');
            $table->string('CLASS_NAME',200)->nullable()->comment('班級名稱');
            $table->unsignedTinyInteger('IS_DELETE')->default(0)->nullable()->comment('是否刪除');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '單位表(年學院系所年級班級)'");




        Schema::create($table = 'TS_DEP_REL', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('TDR_ID')->comment('關係ID')->primary();
            $table->uuid('SYSYR_ID')->comment('學年期');
            $table->uuid('TS_ID')->comment('使用者帳號');
            $table->string('SROL_ID',50)->comment('角色代碼');
            $table->uuid('DEP_ID')->comment('單位代碼');
            $table->unsignedInteger('ORDERNO')->comment('排序');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '使用者單位關係表(學年期）'");





        Schema::create($table = 'SYS_LOG', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('SYSLOG_ID')->comment('LOG ID')->primary();
            $table->uuid('TS_ID')->comment('使用者帳號');
            $table->string('SYSLOG_IP',20)->comment('IP位置');
            $table->unsignedBigInteger('MNU_ID')->nullable()->comment('選單代碼');
            $table->unsignedTinyInteger('MODULE_ID')->nullable()->comment('模組代碼');
            $table->unsignedTinyInteger('ACTION_TYPE')->nullable()->comment('0: 瀏覽; 1: 查詢; 2: 新增; 3: 修改; 4: 刪除');
            $table->string('ACTION_LOG',3000)->nullable()->comment('動作內容');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '系統Log紀錄'");




        Schema::create($table = 'IMPORT_LOG', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('IPL_ID')->comment('紀錄代碼ID')->primary();
            $table->uuid('SYSYR_ID')->comment('學年期代碼');
            $table->string('MOUDLE_ID',100)->comment('模組');
            $table->uuid('TS_ID')->comment('使用者帳號');
            $table->string('SROL_ID',50)->comment('角色代碼');
            $table->string('IPL_FILEPATH',255)->comment('原始檔案路徑');
            $table->unsignedInteger('IPL_TOTAL')->comment('總筆數');
            $table->unsignedInteger('IPL_SUCCESSNUM')->comment('成功筆數');
            $table->unsignedInteger('IPL_FAILNUM')->comment('失敗筆數');
            $table->string('IPL_ERRORLOGPATH',255)->comment('錯誤記錄檔案路徑');


            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '匯入Log紀錄'");


        Schema::create($table = 'MAIL_LOG', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();
            $table->uuid('ML_ID')->comment('紀錄代碼ID')->primary();
            $table->string('SENDER',1000)->nullable()->comment('寄件者');
            $table->string('RECEIVER',1000)->nullable()->comment('收件者');
            $table->string('SUBJECT',100)->nullable()->comment('信件主旨標題');
            $table->string('BODY',2000)->nullable()->comment('信件內文');
            $table->unsignedTinyInteger('IS_SENT')->default(0)->comment('是否寄送');
            $table->string('ERROR_MSG',2000)->nullable()->comment('錯誤訊息');
            $table->string('IP',20)->nullable()->comment('寄送使用的IP');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');

        });
        DB::statement("ALTER TABLE " . $table . " COMMENT 'Email寄件Log紀錄'");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MAIL_LOG');
        Schema::dropIfExists('IMPORT_LOG');
        Schema::dropIfExists('SYS_LOG');
        Schema::dropIfExists('TS_DEP_REL');
        Schema::dropIfExists('DEPARTMENT');
        Schema::dropIfExists('TS_SROL');
        Schema::dropIfExists('TS_MNU');
        Schema::dropIfExists('TRUSTEE');
        Schema::dropIfExists('SYS_YEAR');
        Schema::dropIfExists('SYS_ROLE');
        Schema::dropIfExists('SROL_MNU');
        Schema::dropIfExists('NEWS_FILE_REL');
        Schema::dropIfExists('NEWS');
        Schema::dropIfExists('MENU');
        Schema::dropIfExists('FILE_INFO');
        Schema::dropIfExists('CONTENT_FILE_REL');
        Schema::dropIfExists('CONTENT');
        Schema::dropIfExists('BASIC_COLUMN');
    }
}
