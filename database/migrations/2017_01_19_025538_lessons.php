    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contributor_id');
            $table->boolean('enable')->default(0);
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->string('image');
            $table->text('description');
            $table->string('slug');
            $table->string('meta_desc');
            $table->boolean('status')->unsigned()->default(0);
            $table->tinyInteger('revisi_ke')->unsigned()->default(0);
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('lessons');
    }
}
