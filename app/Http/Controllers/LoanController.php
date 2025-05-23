<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // Get all loans (optional: restrict to user if needed)
    public function getLoans()
    {
        return response()->json(Loan::with('user')->get(), 200);
    }

    // Add a new loan
    public function addLoan(Request $request)
    {
        $request->validate([
            'monthly_salary' => 'required|numeric|min:10000|max:100000',
            'loan_amount' => 'required|numeric|max:30000',
            'term_months' => 'nullable|integer|min:1',
        ]);

        if ($request->monthly_salary < 10000) {
            return response()->json(['error' => 'Minimum salary must be ₱10,000'], 422);
        }

        if ($request->loan_amount > 30000) {
            return response()->json(['error' => 'Maximum loan amount allowed is ₱30,000'], 422);
        }

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'monthly_salary' => $request->monthly_salary,
            'loan_amount' => $request->loan_amount,
            'term_months' => $request->term_months,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Loan request submitted successfully',
            'loan' => $loan
        ], 201);
    }

    // Update loan status or details (optional)
    public function updateLoan(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $loan->update($request->only([
            'monthly_salary',
            'loan_amount',
            'term_months',
            'status'
        ]));

        return response()->json([
            'message' => 'Loan updated successfully',
            'loan' => $loan
        ]);
    }

    // Delete loan
    public function deleteLoan($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return response()->json(['message' => 'Loan deleted successfully']);
    }
}
