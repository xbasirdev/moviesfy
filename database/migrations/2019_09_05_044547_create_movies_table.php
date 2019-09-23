<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('genre');
            $table->integer('year');
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Excel;


class ImportExcelController extends Controller
{
    function index()
    {
     $data = DB::table('empleados')->orderBy('id', 'DESC')->get();
     $message = null;
     return view('import_excel', compact('data','message'));
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::load($path)->noHeading()->skip(1)->get();
  
     if($data->count() > 0)
     {
        $insert_data = array();
        $rejected_data = array();
        $final_data = array();
        foreach($data->toArray() as $key => $value)
        {
            if($key==0){
                foreach($value as $i => $row) {
                    $insert_data = $value;
                }
            }elseif( empty($value[0]) || empty($value[1] || empty($value[0])) ){
                $rejected_data[] = [
                    "nombre" => $key."rechazado por falta de datos",
                ];
            }else{
            $final_data[] = [
                $insert_data[0] => $value[0],
                $insert_data[1] => $value[1],
                $insert_data[2] => $value[2],
                $insert_data[3] => $value[3],
                $insert_data[4] => $value[4],
                $insert_data[5] => $value[5],
                $insert_data[6] => $value[6],
                $insert_data[7] => $value[7],
                $insert_data[8] => $value[8],
                $insert_data[9] => $value[9],
                $insert_data[10] => $value[10],
                $insert_data[11] => $value[11],
                $insert_data[12] => $value[12],
                $insert_data[13] => $value[13],
                $insert_data[14] => $value[14],
                $insert_data[15] => $value[15],
                $insert_data[16] => $value[16],
                $insert_data[17] => $value[17],
            ];
            }
        }
        

      if(!empty($final_data))
      {
       //DB::table('tbl_customer')->insert($final_data);
      }
     }
     $data = DB::table('empleados')->orderBy('id', 'DESC')->get();
     $message = "Se importaron correctamente los datos";
     return view('import_excel', compact('rejected_data', 'data', 'message'));
    
    }
}




