<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Schema;

class ChangeEvolutionsExperienceRequiredColumn extends Migration
{
    public function up()
    {
        $evolutions = DB::table('evolutions')
            ->get();

        Schema::table('evolutions', function (Blueprint $table) {
            $table->dropColumn('requirements');
            $table->integer('experience_required')->nullable()->after('name');
        });

        foreach ($evolutions as $evolution) {
            $requirements = json_decode($evolution->requirements);
            $experienceRequired = $requirements['experience'];

            DB::table('evolutions')
                ->where('id', $evolution->id)
                ->update([
                    'experience_required' => $experienceRequired,
                ]);
        }
    }

    public function down()
    {
        throw new LogicException("Let's all rewrite this later and re-migrate prod imo");
    }
}
