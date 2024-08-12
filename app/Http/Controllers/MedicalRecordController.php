<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMedicalRecordRequest;
use App\Http\Requests\UpdateMedicalRecordRequest;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MedicalRecord::with('user')->paginate(50);

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'medical records fetched',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicalRecordRequest $request)
    {
        if(Auth::user()->role !== 'doctors'){
            // Return response
            return response()->json([
                'success' => 'false',
                'message' => 'unauthorized',
            ], 403);
        }

        $data = MedicalRecord::create($request->validated());

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'medical record created successfully',
            'data' => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $data = $medicalRecord::with('user') ?? [];

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'medical record fetched',
            'data' => $data,
        ], 200);        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalRecordRequest $request, MedicalRecord $medicalRecord)
    {
        $data = $medicalRecord->update($request->only(['x_ray', 'ultrasound_scan', 'ct_scan', 'mri']));

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'medical record updated',
            'data' => $data,
        ], 200);         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'medical record deleted',
        ], 200);

    }

    /**
     * Display a listing of the resource.
     */
    public function get(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $data = MedicalRecord::where('user_id', $request->user_id)->get();

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'medical records fetched',
            'data' => $data,
        ], 200);
        
    }

    
    public function getTests()
    {
        $data = [
            'x_ray' => [
                'Chest', 'Cervical Vertebrae', 'Thoracic Vertebrae', 'Lumbar Vertebrae',
                'Thoraco Lumbar Vertebrae', 'Wrist Joint', 'Thoracic Inlet', 'Elbow Joint',
                'Knee Joint', 'Sacro Iliac Joint', 'Shoulder Joint', 'Hip Joint', 'Femoral',
                'Ankle', 'Pelvic Joint', 'Humerus', 'Radius/Ulner', 'Foot', 'Tibia/Fibula',
                'Fingers', 'Toes'
            ],
            'ultrasound_scan' => ['Obstetric', 'Abdominal', 'Pelvis', 'Prostate', 'Breast', 'Thyroid'],
            'ct_scan' => [''], 
            'mri' => [''],
        ];

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'laboratory tests fetched',
            'data' => $data,
        ], 200);
    }


}
