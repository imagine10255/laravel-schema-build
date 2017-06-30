<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAboutTable extends Migration
{
    /**
     * 學生基本資料表
     *
     * @return void
     */
    public function up()
    {
        Schema::create($table = 'STUDENT', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();

            $table->uuid('STU_ID')->comment('學生ID')->primary();
            $table->uuid('TS_ID')->comment('使用者ID');
            $table->unsignedBigInteger('SYS_SID')->comment('校務系統ID');
            $table->string('STU_NAME',200)->comment('姓名');
            $table->string('STU_NO',50)->comment('學號');
            $table->string('IDENT',20)->nullable()->comment('身份證號(0=女,1=男)');
            $table->unsignedTinyInteger('SEX')->nullable()->comment('性別');
            $table->date('BIRTHDAY')->nullable()->comment('生日');
            $table->string('STATUS',100)->nullable()->comment('學籍身份(EnumJOB_JOB_IDENT多值組JSON)');
            $table->string('MAIL1',50)->nullable()->comment('EMAIL');
            $table->string('MAIL2',50)->nullable()->comment('EMAIL2');
            $table->string('MOBILE',20)->nullable()->comment('手機');
            $table->string('PHONE',20)->nullable()->comment('住家電話');
            $table->string('ADDR1',100)->nullable()->comment('地址－地區');
            $table->string('ADDR2',100)->nullable()->comment('地址－縣市');
            $table->string('ADDR3',100)->nullable()->comment('地址－區域');
            $table->string('ADDR4',500)->nullable()->comment('地址－詳細');

            //基本資料
            $table->string('GUARDIAN',200)->nullable()->comment('家長或監護人');
            $table->string('BOB_PHONE',20)->nullable()->comment('父手機');
            $table->string('MOM_PHONE',20)->nullable()->comment('母手機');
            $table->unsignedTinyInteger('HANDBOOK_HAD')->default(0)->nullable()->comment('身心障礙手冊(0=無,1=有)');
            $table->string('HANDBOOK_TYPE',50)->nullable()->comment('身心障礙手冊-手冊記載類別');
            $table->string('HANDBOOK_LV',50)->nullable()->comment('身心障礙手冊-程度');
            $table->unsignedTinyInteger('KAM_HAD')->default(0)->nullable()->comment('鑑輔會鑑定證明(0=無,1=有)');
            $table->string('KAM_TYPE',50)->nullable()->comment('鑑輔會鑑定證明-鑑定類別');
            $table->string('KAM_NO',50)->nullable()->comment('鑑輔會鑑定證明-證明文號');

            //家庭狀況
            $table->unsignedTinyInteger('RANKING')->nullable()->comment('排行');
            $table->unsignedTinyInteger('BROTHER')->nullable()->comment('兄幾人');
            $table->unsignedTinyInteger('SISTER')->nullable()->comment('姊幾人');
            $table->unsignedTinyInteger('YOUNGER_BROTHER')->nullable()->comment('弟幾人');
            $table->unsignedTinyInteger('YOUNGER_SISTER')->nullable()->comment('妹幾人');

            $table->unsignedTinyInteger('PARENTAL_RELATIONSHIP')->nullable()->comment('父母關係');
            $table->unsignedTinyInteger('PARENTAL_RELATIONSHIP_OTHER')->nullable()->comment('父母關係-其他');
            $table->unsignedTinyInteger('ECONOMIC STATUS')->nullable()->comment('經濟狀況');
            $table->unsignedTinyInteger('MC')->nullable()->comment('主要照顧者');
            $table->string('MC_OTHER',200)->nullable()->comment('主要照顧者-其他');
            $table->unsignedTinyInteger('MC_STYLE')->nullable()->comment('主要照顧者之管教方式');
            $table->string('MC_STYLE_OTHER',200)->nullable()->comment('主要照顧者之管教方式-其他');
            $table->unsignedTinyInteger('LIVING_ENVIRONMENT')->nullable()->comment('居住環境');
            $table->string('LIVING_ENVIRONMENT_OTHER',200)->nullable()->comment('居住環境-其他');
            $table->unsignedTinyInteger('MAIN LANGUAGE')->nullable()->comment('家中主要使用語言');
            $table->unsignedTinyInteger('MEMBER_SPECIAL_CASE')->nullable()->comment('家中成員是否有其他特殊個案');
            $table->string('MEMBER_SPECIAL_CASE_CONTENT',200)->nullable()->comment('家中成員是否有其他特殊個案-內容');


            //健康情形
            $table->unsignedTinyInteger('HEARING')->nullable()->comment('聽力(1=正常,2=未矯正,3=已矯正)');
            $table->unsignedTinyInteger('HEARING_LEFT')->nullable()->comment('聽力-矯正後左耳');
            $table->unsignedTinyInteger('HEARING_RIGHT')->nullable()->comment('聽力-矯正後右耳');
            $table->unsignedTinyInteger('VISION')->nullable()->comment('視力(1=正常,2=未矯正,3=已矯正)');
            $table->unsignedTinyInteger('VISION_LEFT')->nullable()->comment('視力-矯正後左眼');
            $table->unsignedTinyInteger('VISION_RIGHT')->nullable()->comment('視力-矯正後右眼');

            $table->json('SYMPTOMS')->nullable()->comment('伴隨症狀');
            $table->string('SYMPTOMS_OTHER',200)->nullable()->comment('伴隨症狀-其他');

            $table->unsignedTinyInteger('SEE_DOCTOR')->nullable()->comment('醫療狀況-有無看診');
            $table->string('ETIOLOGY',200)->nullable()->comment('醫療狀況-病因');
            $table->string('MAJOR_HOSPITAL',200)->nullable()->comment('醫療狀況-主要醫院');
            $table->json('FOLLOW_MEDICATION')->nullable()->comment('醫療狀況-定期追蹤服藥');
            $table->unsignedTinyInteger('NOT_MEDICATION_COUNT')->nullable()->comment('醫療狀況-定期追蹤不服藥(次)');
            $table->unsignedTinyInteger('NOT_MEDICATION_YEAR')->nullable()->comment('醫療狀況-定期追蹤不服藥(年)');
            $table->unsignedTinyInteger('MEDICATION_COUNT')->nullable()->comment('醫療狀況-定期服藥(次)');
            $table->unsignedTinyInteger('MEDICATION_YEAR')->nullable()->comment('醫療狀況-定期服藥(天)');

            $table->unsignedTinyInteger('LONG_MEDICATION')->nullable()->comment('長期用藥(0=無,1=有)');
            $table->string('LONG_MEDICATION_DRUG_NAME',200)->nullable()->comment('長期用藥-藥名/每日劑量');
            $table->string('LONG_MEDICATION_SIDE_EFFECT',200)->nullable()->comment('長期用藥-副作用');
            $table->date('TAKING_DATE')->nullable()->comment('長期用藥-開始服用日期');

            $table->unsignedTinyInteger('ALLERGIES')->nullable()->comment('是否有過敏(0=無,1=有)');
            $table->json('ALLERGIES_TYPE')->nullable()->comment('過敏類別');
            $table->unsignedTinyInteger('ADVICE')->nullable()->comment('醫囑');
            $table->unsignedTinyInteger('ADVICE_CONTENT')->nullable()->comment('醫囑-有的內容');



            //現況描述
            $table->json('READING_ABILITY')->nullable()->comment('認知與專業能力-閱讀能力');
            $table->string('READING_ABILITY_OTHER',200)->nullable()->comment('認知與專業能力-閱讀能力-其他');
            $table->json('WRITING_EXPRESSION')->nullable()->comment('認知與專業能力-書寫表達');
            $table->json('ARITHMETIC_ABILITY')->nullable()->comment('認知與專業能力-算術能力');
            $table->json('LEARNING_HABIT')->nullable()->comment('認知與專業能力-學習習慣');
            $table->string('OTHER_OBSERVATION_RECORDS',500)->nullable()->comment('認知與專業能力-其他觀察紀錄');

            $table->json('COMMUNICATION')->nullable()->comment('溝通能力-慣用溝通方式(1=口語,2=非口語)');
            $table->json('COMMUNICATION_SPEAK')->nullable()->comment('溝通能力-慣用溝通方式-口語');
            $table->json('COMMUNICATION_NSPEAK')->nullable()->comment('溝通能力-慣用溝通方式-非口語');
            $table->string('COMMUNICATION_SPEAK_OTHER',200)->nullable()->comment('溝通能力-慣用溝通方式-口語-其他');
            $table->string('COMMUNICATION_NSPEAK_OTHER',200)->nullable()->comment('溝通能力-慣用溝通方式-非口語-其他');
            $table->string('COMMUNICATION_OTHER_OBSERVATION_RECORDS',500)->nullable()->comment('溝通能力-其他觀察記錄	');

            $table->json('SCHOOL_TRAFFIC')->nullable()->comment('行動能力-到校交通工具');
            $table->json('INDEPENDENT_ACTION')->nullable()->comment('行動能力-獨立行動方面');
            $table->json('FINE_ACTION')->nullable()->comment('行動能力-精細動作方面');
            $table->string('FINE_OTHER_OBSERVATION_RECORDS',500)->nullable()->comment('行動能力-其他觀察記錄');

            $table->json('RELATIONSHIPS')->nullable()->comment('情緒/人際關係-情緒/人際關係');
            $table->string('RELATIONSHIPS_OTHER_OBSERVATION_RECORDS')->nullable()->comment('情緒/人際關係-其他觀察記錄	');

            $table->unsignedTinyInteger('HEALTH_STATUS_ACTION')->nullable()->comment('感官功能/健康狀況-動作');
            $table->unsignedTinyInteger('VISUAL_CONDITION')->nullable()->comment('感官功能/健康狀況-視覺狀況');
            $table->unsignedTinyInteger('AUDITORY_CONDITION')->nullable()->comment('感官功能/健康狀況-聽覺狀況');
            $table->json('HEALTH_STATUS')->nullable()->comment('感官功能/健康狀況-健康狀況');
            $table->string('HEALTH_OTHER_OBSERVATION_RECORDS',500)->nullable()->comment('感官功能/健康狀況-其他觀察記錄');


            $table->unsignedTinyInteger('WASHING_ASPECTS')->nullable()->comment('生活自理能力-盥洗方面');
            $table->unsignedTinyInteger('TOILET_SIDE')->nullable()->comment('生活自理能力-如廁方面');
            $table->unsignedTinyInteger('EATING_SIDE')->nullable()->comment('生活自理能力-進食方面');
            $table->unsignedTinyInteger('CLOTHING_SIDE')->nullable()->comment('生活自理能力-衣著方面');
            $table->string('CLOTHING_OTHER_OBSERVATION_RECORDS',500)->nullable()->comment('生活自理能力-其他觀察記錄');

            //學生身心障礙狀況對其上課及生活之影響及調整
            $table->string('IMPACT_CLASS_OTHER',500)->nullable()->comment('對上課之影響-其他');
            $table->string('IMPACT_LIFE_OTHER',500)->nullable()->comment('對生活之影響-其他');


            //異動後追蹤輔導紀錄
            $table->string('CAUSE_CHANGE',500)->nullable()->comment('異動原因(1=畢業,2=修轉學)');
            $table->unsignedTinyInteger('CURRENTLY')->nullable()->comment('目前(1=就學,2=就業,3=在家,4=其他)');
            $table->string('CURRENTLY_OTHER',500)->nullable()->comment('目前-其他');


            //基礎學習能力評估表
            $table->string('NATIONAL_CAPACITY',500)->nullable()->comment('基礎學習能力評估表-國文能力');
            $table->string('ENGLISH_ABILITY',500)->nullable()->comment('基礎學習能力評估表-英文能力');
            $table->string('MATHEMATICAL_ABILITY',500)->nullable()->comment('基礎學習能力評估表-數學能力');



            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '學生基本表'");


        //學生身心障礙狀況對其上課及生活之影響及調整
        Schema::create($table = 'STUDENT_INFLUENCES', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();

            $table->uuid('STU_ID')->comment('學生ID')->primary();

            $table->unsignedTinyInteger('TYPE')->nullable()->comment('類別(1=對上課影響,2=對生活影響)');
            $table->string('CONTENT')->nullable()->comment('內容(1=認知能力,2=溝通能力,3=行動能力,4=情緒,5=人際關係,6=感官功能,7=健康狀況,8=生活自理,9=表達能力,10=邏輯推理能力');
            $table->string('IS_AFFECTS')->nullable()->comment('是否影響(0=否,1=是)');
            $table->string('AFFECTS_CONTENT')->nullable()->comment('影響內容');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');

            $table->unique(['STU_ID','TYPE','CONTENT']);
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '學生身心障礙狀況對其上課及生活之影響及調整'");


        //行政支援及相關服務
        Schema::create($table = 'STUDENT_RELATED_SERVICE', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();

            $table->uuid('STU_ID')->comment('學生ID')->primary();

            $table->unsignedTinyInteger('SERVICE')->nullable()->comment('服務項目(1=無障礙環境,2=交通服務,3=輔導器材,4=諮商服務,5=復健服務,6=學習相關服務,7=考試服務-輔具,8=考試服務-考題,9=考試服務-作答,10=考試服務-情境,11=考試服務-時間)');
            $table->unsignedTinyInteger('NEED')->nullable()->comment('需求評估(0=無,1=有)');
            $table->json('CONTENT')->nullable()->comment('內容及方式');
            $table->string('CONTENT_OTHER',200)->nullable()->comment('內容及方式-其他');
            $table->string('PRINCIPAL',100)->nullable()->comment('行政/負責人');
            $table->string('REMARK',500)->nullable()->comment('備註');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');

        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '行政支援及相關服務'");



        //轉銜服務計畫
        Schema::create($table = 'STUDENT_SERVICE_PLAN', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();

            $table->uuid('STU_ID')->comment('學生ID')->primary();

            $table->unsignedTinyInteger('SERVICE')->nullable()->comment('類別(1=無障礙環境,2=交通服務,3=輔導器材,4=諮商服務,5=復健服務,6=學習相關服務,7=考試服務-輔具,8=考試服務-考題,9=考試服務-作答,10=考試服務-情境,11=考試服務-時間)');
            $table->unsignedTinyInteger('NEED')->nullable()->comment('需求評估(0=無,1=有)');
            $table->json('CONTENT')->nullable()->comment('內容及方式');
            $table->string('CONTENT_OTHER',200)->nullable()->comment('內容及方式-其他');
            $table->string('PRINCIPAL',100)->nullable()->comment('行政/負責人');
            $table->string('REMARK',500)->nullable()->comment('備註');


            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');

        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '轉銜服務計畫'");



        //基礎學習能力評估表
        Schema::create($table = 'STUDENT_BASIC_LEARNING', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();

            $table->uuid('STU_ID')->comment('學生ID')->primary();

            $table->string('TYPE')->nullable()->comment('類別
            (國文 A1=寫正確的字,A2=自行書寫正確的句子,A3=自行書寫文章,A4=認字能力,A5=唸讀能力,A6=文章瞭解能力)
            (英文 B1=唸出單字,B2=聽寫單字,B3=念出完整句子,B4=唸完一段課文,B5=完成中文翻譯,B6=完成英文造句)
            (數學 C1=會加、減法,C2=會乘、除法,C3=四則混合運算,C4=列出正確的計算式,C5=正確導入公式運用,C6=完成應用問題)
            ');
            $table->unsignedTinyInteger('LEVEL')->nullable()->comment('等級(1=很弱,2=較弱,3=尚可,4=不錯,5=很好)');
            $table->json('CONTENT')->nullable()->comment('其他說明項目');
            $table->string('CONTENT_OTHER',200)->nullable()->comment('其他說明項目-文字');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '基礎學習能力評估表'");



        //學習紀錄-教學目標及評量
        Schema::create($table = 'STUDENT_TEACHING_OBJECTIVES', function (Blueprint $table) {
            $table->unsignedBigInteger('SN')->comment('SN')->unique();

            $table->uuid('STU_ID')->comment('學生ID')->primary();

            $table->string('TEACHING_OBJECTIVES')->nullable()->comment('教學目標');
            $table->unsignedTinyInteger('EVALUATION_DATE')->nullable()->comment('評量日期');
            $table->json('TYPE')->nullable()->comment('評量方式');
            $table->string('TYPE_TEXT',200)->nullable()->comment('評量方式-文字');
            $table->unsignedTinyInteger('EVALUATION_RESULTS')->nullable()->comment('評量結果評估(1=通過,2=不通過)');
            $table->string('EVALUATION_RESULTS_ANALYSIS',500)->nullable()->comment('評量結果評估-學習困難分析');
            $table->string('EVALUATION_RESULTS_STRATEGIES',500)->nullable()->comment('評量結果評估-輔導策略');

            $table->string('CREUSER', 100)->comment('建立帳號');
            $table->dateTime('CREDATE')->comment('建立時間');
            $table->string('UPDUSER', 100)->nullable()->comment('更新帳號');
            $table->dateTime('UPDDATE')->nullable()->comment('更新時間');
        });
        DB::statement("ALTER TABLE " . $table . " COMMENT '學習紀錄-教學目標及評量'");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('STUDENT_TEACHING_OBJECTIVES');
        Schema::dropIfExists('STUDENT_BASIC_LEARNING');
        Schema::dropIfExists('STUDENT_SERVICE_PLAN');
        Schema::dropIfExists('STUDENT_RELATED_SERVICE');
        Schema::dropIfExists('STUDENT_INFLUENCES');
        Schema::dropIfExists('STUDENT');
    }
}
