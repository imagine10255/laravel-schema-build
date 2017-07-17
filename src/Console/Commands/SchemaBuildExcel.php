<?php
/**
 * Created by PhpStorm.
 * User: imagine
 * Date: 2015/10/31
 * Time: 上午 10:32
 */
namespace Imagine10255\SchemaBuild\Console\Commands;

use DB;
use Illuminate\Console\Command;
use PHPExcel_IOFactory;

class SchemaBuildExcel extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'schema:build-excel';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'build schema output excel';

    protected $userService;
    protected $excelObj;
    protected $database;

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $file = storage_path('schema-build/sample/excel.xlsx');
        if(!file_exists($file)){
            $this->error("$file is not exists, Please run publishes");
            return ;
        }

        $this->excelObj = PHPExcel_IOFactory::load($file);

        $this->database = config('database.connections.mysql.database');

        $tables = collect(DB::table('information_schema.tables')->where('table_schema',$this->database)
            ->select('table_name','table_comment')
            ->get());

        $sheet = $this->excelObj->getSheetByName('Index'); //選取目錄表
        $start_span = 2;
        $tables->each(function($table,$index) use($sheet,$start_span){ //一張表 建立一個分頁
            $span = $start_span+$index;
            $this->createExcelPage($table);
            $sheet->setCellValue("A${span}",$index+1);
            $sheet->setCellValue("B${span}",strtoupper(substr($table->table_name,0,1)));
            $sheet->setCellValue("C${span}",$table->table_name);
            $sheet->getCell("C${span}")->getHyperlink()->setUrl("sheet://'$table->table_name'!A1");
            $sheet->setCellValue("D${span}",$table->table_comment);
        });

        $this->excelObj->removeSheetByIndex(1);



        //產生Excel
        $excel = PHPExcel_IOFactory::createWriter($this->excelObj, 'Excel2007');

        $outputPath = storage_path('schema-build/'.$this->database.'-in'.date('Ymd').'.xlsx');
        $excel->save($outputPath);
        $this->info('file build success in '.$outputPath);
    }




    private function createExcelPage($table)
    {
        $sheet = $this->excelObj->getSheetByName('example'); //取範例檔
        $sheet_copy = clone $sheet; //複製一份範例
        $sheet_copy->setTitle('Cloned Sheet');
        $this->excelObj->addSheet($sheet_copy); //加進目前的工作表
        $sheet = $this->excelObj->getSheetByName('Cloned Sheet'); //操作剛剛加進來的工作表

        $sheet->setTitle(substr($table->table_name,0,30)); //分頁標題
        $sheet->setCellValue('B1', $table->table_name);
        $sheet->setCellValue('B2', $table->table_comment);

        $query = collect(DB::select('SHOW FULL FIELDS FROM '.$table->table_name));

        $span = 3;
        //顯示索引鍵
        $indexQuery = collect(DB::table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA',$this->database)
            ->where('TABLE_NAME',$table->table_name)
            ->select('CONSTRAINT_NAME','COLUMN_NAME','REFERENCED_TABLE_NAME','REFERENCED_COLUMN_NAME')
            ->get());

        $indexQuery->each(function($indexData,$keyName) use ($sheet,&$span){
            $span++;
            $sheet->insertNewRowBefore($span,1);
            $sheet->mergeCells('A'.$span.':B'.$span); //Key name
            $sheet->mergeCells('C'.$span.':D'.$span); //Column name
            $sheet->mergeCells('F'.$span.':G'.$span); //Column name

            $sheet->setCellValue("A${span}",$indexData->CONSTRAINT_NAME);
            $sheet->setCellValue("C${span}",$indexData->COLUMN_NAME);
            $sheet->setCellValue("E${span}",$indexData->REFERENCED_TABLE_NAME);
            $sheet->setCellValue("F${span}",$indexData->REFERENCED_COLUMN_NAME);
        });

        $span+=2;
        //顯示各欄位資料
        $query->each(function($row,$index) use($sheet,&$span){
            $span++;
            $sheet->setCellValue("A${span}",$row->Field);
            $sheet->setCellValue("B${span}",$row->Type);
            $sheet->setCellValue("C${span}",$row->Null);
            $sheet->setCellValue("D${span}",$row->Key);
            $sheet->setCellValue("E${span}",$row->Default);
            $sheet->setCellValue("F${span}",$row->Extra);
            $sheet->setCellValue("G${span}",$row->Comment);
        });

    }
}