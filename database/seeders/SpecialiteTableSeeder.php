<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SpecialiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialites')->delete();

        $specialites = array(
            array('lib' => 'Médecine interne'),
            array('lib' => 'Maladies infectieuses'),
            array('lib' => 'Réanimation médicale'),
            array('lib' => 'Carcinologie médicale'),
            array('lib' => 'Nutrition et maladies nutritionnelles'),
            array('lib' => 'Hématologie clinique'),
            array('lib' => 'Endocrinologie'),
            array('lib' => 'Cardiologie'),
            array('lib' => 'Néphrologie'),
            array('lib' => 'Neurologie'),
            array('lib' => 'Pneumologie'),
            array('lib' => 'Rhumatologie'),
            array('lib' => 'Gastro-entérologie'),
            array('lib' => 'Médecine physique'),
            array('lib' => 'rééducation et réadaptation fonctionnelle'),
            array('lib' => 'Dermatologie'),
            array('lib' => 'Pédiatrie'),
            array('lib' => 'Psychiatrie'),
            array('lib' => 'Pédopsychiatrie'),
            array('lib' => 'Imagerie médicale'),
            array('lib' => 'Radiothérapie carcinologique'),
            array('lib' => 'Médecine légale'),
            array('lib' => 'Médecine du travail'),
            array('lib' => 'Médecine préventive et communautaire'),
            array('lib' => 'Anesthésie - réanimation'),
            array('lib' => 'Anatomie et cytologie pathologique'),
            array('lib' => 'Médecine d\'urgence'),
            array('lib' => 'Chirurgie générale'),
            array('lib' => 'Chirurgie carcinologique'),
            array('lib' => 'Chirurgie thoracique'),
            array('lib' => 'Chirurgie vasculaire périphérique'),
            array('lib' => 'Chirurgie neurologique'),
            array('lib' => 'Chirurgie urologique'),
            array('lib' => 'Chirurgie plastique, réparatrice et esthétique'),
            array('lib' => 'Chirurgie orthopédique et traumatologique'),
            array('lib' => 'Chirurgie pédiatrique'),
            array('lib' => 'Chirurgie cardio-vasculaire'),
            array('lib' => 'Ophtalmologie'),
            array('lib' => 'O.R.L.Stomatologie et chirurgie maxillo-faciale'),
            array('lib' => 'Gynécologie-obstétrique'),
            array('lib' => 'Biologie et disciplines fondamentalesBiologie médicale'),
            array('lib' => 'Biologie médicale (option : biochimie)'),
            array('lib' => 'Biologie médicale (option : microbiologie)'),
            array('lib' => 'Biologie médicale (option : parasitologie)'),
            array('lib' => 'Biologie médicale (option: immunologie)'),
            array('lib' => 'Biologie médicale (option: hématologie)'),
            array('lib' => 'Histo-embryologie'),
            array('lib' => 'Physiologie et exploration fonctionnelle'),
            array('lib' => 'Biophysique et médecine nucléaire'),
            array('lib' => 'Pharmacologie'),
            array('lib' => 'Génétique'),
            array('lib' => 'Anatomie'),
            array('lib' => 'Médecine de la plongée sous-marine'),
            array('lib' => 'Médecine aéronautique et spatiale'),
            array('lib' => 'Hygiène nucléaire'),
            array('lib' => 'Allergologie'),
            array('lib' => 'Angiologie'),
            array('lib' => 'Acupuncture'),
            array('lib' => 'Homéopathie'),
            array('lib' => 'Hémodialyse'),
            array('lib' => 'Médecine appliquée au sport'),
            array('lib' => 'Médecine aéronautique'),
            array('lib' => 'Gériatrie'),
            array('lib' => 'Prise en charge des urgences'),
            array('lib' => 'Phytothérapie'),
            array('lib' => 'Crénothérapie'),
            array('lib' => 'Sexologie'),
            array('lib' => 'Handicap et réhabilitation des handicapés'),
            array('lib' => 'Réparation juridique du dommage corporel'),
            array('lib' => 'Toxicologie'),
            array('lib' => 'Santé publique'),
            array('lib' => 'Maladies professionnelles'),
            array('lib' => 'Médecine subaquatique et hyperbare'),
            array('lib' => 'Hygiène hospitalière')
        );

        DB::table('specialites')->insert($specialites);
    }
}
