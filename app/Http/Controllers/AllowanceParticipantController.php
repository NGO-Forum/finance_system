<?php

namespace App\Http\Controllers;

use App\Models\AllowanceForm;
use App\Models\AllowanceParticipant;
use Illuminate\Http\Request;

class AllowanceParticipantController extends Controller
{
    /**
     * Store a new participant.
     */
    public function store(Request $request, AllowanceForm $allowance)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'gender'       => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:255',
            'position'     => 'nullable|string|max:255',
            'province'     => 'nullable|string|max:255',
            'distance'     => 'nullable|numeric|min:0',
        ]);

        AllowanceParticipant::create([
            'allowance_form_id' => $allowance->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'organization' => $request->organization,
            'position' => $request->position,
            'province' => $request->province,
            'distance' => $request->distance ?? 0,
            'breakfast' => 0,
            'lunch' => 0,
            'dinner' => 0,
            'accommodation' => 0,
            'taxi' => 0,
            'local_transport' => 0,
            'other' => 0,
            'total' => 0,
            'remarks' => null,
        ]);

        return back()->with(
            'success',
            'Participant added successfully.'
        );
    }

    /**
     * Update participant information.
     */
    public function update(
        Request $request,
        AllowanceParticipant $participant
    ) {

        $request->validate([
            'name'         => 'required|string|max:255',
            'gender'       => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:255',
            'position'     => 'nullable|string|max:255',
            'province'     => 'nullable|string|max:255',
            'distance'     => 'nullable|numeric|min:0',
        ]);

        $participant->update([

            'name' => $request->name,

            'gender' => $request->gender,

            'organization' => $request->organization,

            'position' => $request->position,

            'province' => $request->province,

            'distance' => $request->distance ?? 0,

        ]);

        return back()->with(
            'success',
            'Participant updated successfully.'
        );
    }

    /**
     * Delete participant.
     */
    public function destroy(
        AllowanceParticipant $participant
    ) {

        $participant->delete();

        return back()->with(
            'success',
            'Participant deleted successfully.'
        );
    }

    /**
     * Save allowance amounts.
     */
    public function saveAmount(
        Request $request,
        AllowanceForm $allowance
    ) {

        if (!$request->has('participants')) {

            return back()->with(
                'error',
                'No participant data found.'
            );
        }

        foreach ($request->participants as $id => $data) {

            $participant = AllowanceParticipant::find($id);

            if (!$participant) {
                continue;
            }

            $breakfast = (float) ($data['breakfast'] ?? 0);

            $lunch = (float) ($data['lunch'] ?? 0);

            $dinner = (float) ($data['dinner'] ?? 0);

            $accommodation = (float) ($data['accommodation'] ?? 0);

            $taxi = (float) ($data['taxi'] ?? 0);

            $localTransport = (float) ($data['local_transport'] ?? 0);

            $other = (float) ($data['other'] ?? 0);

            $total =
                $breakfast +
                $lunch +
                $dinner +
                $accommodation +
                $taxi +
                $localTransport +
                $other;

            $participant->update([

                'breakfast' => $breakfast,

                'lunch' => $lunch,

                'dinner' => $dinner,

                'accommodation' => $accommodation,

                'taxi' => $taxi,

                'local_transport' => $localTransport,

                'other' => $other,

                'total' => $total,

                'remarks' => $data['remarks'] ?? null,

            ]);
        }

        return back()->with(
            'success',
            'Allowance information saved successfully.'
        );
    }
}
