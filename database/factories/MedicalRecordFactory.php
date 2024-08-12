<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1, User::all()->count()) ,
            'x_ray' =>fake()->randomElement($this->xRay()),
            'ultrasound_scan' => fake()->randomElement($this->ultrasoundScan()),
            'ct_scan' => fake()->randomElement($this->ctScan()),
            'mri' => fake()->randomElement($this->mri()),
        ];
    }

    public function xRay(){
        return $xRay =  [
            'Chest', 'Cervical Vertebrae', 'Thoracic Vertebrae', 'Lumbar Vertebrae',
            'Thoraco Lumbar Vertebrae', 'Wrist Joint', 'Thoracic Inlet', 'Elbow Joint',
            'Knee Joint', 'Sacro Iliac Joint', 'Shoulder Joint', 'Hip Joint', 'Femoral',
            'Ankle', 'Pelvic Joint', 'Humerus', 'Radius/Ulner', 'Foot', 'Tibia/Fibula',
            'Fingers', 'Toes'
        ];
    }
    public function ultrasoundScan(){
        return $ultrasoundScan = ['Obstetric', 'Abdominal', 'Pelvis', 'Prostate', 'Breast', 'Thyroid'];

    }
    public function ctScan(){
        return [''];
    }
    public function mri(){
        return [''];
    }

}
