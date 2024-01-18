<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $user = User::hint(auth()->user());
        $pendingTransactions = $acceptedTransactions = $deliveredTransactions = collect();

        if ($user->role === 'head' || $user->role === 'employee') {
            $pendingTransactions = Transaction::query()->where('status', 'pending')
                ->when($user->role === 'employee', function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
                ->get();
        }

        if ($user->role === 'head' || $user->role === 'keeper') {
            $acceptedTransactions = Transaction::query()->where('status', 'accepted')->get();
            $deliveredTransactions = Transaction::query()->where('status', 'delivered')->get();
        } else if ($user->role === 'employee') {
            $acceptedTransactions = Transaction::query()->where('status', 'accepted')->where('user_id', $user->id)->get();
            $deliveredTransactions = Transaction::query()->where('status', 'delivered')->where('user_id', $user->id)->get();
        }

        return view('transactions.index', compact('pendingTransactions', 'acceptedTransactions', 'deliveredTransactions'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'employee') {
            return redirect()->back()->withErrors('Unauthorized action.');
        }
        $selectedItem = null;
        if ($request->has('item')) {
            $selectedItem = Item::query()->find( $request->get('item'));
        }

        // Add logic to fetch necessary data for the form
        return view('transactions.create', compact('selectedItem'));
    }

    public function store(Request $request)
    {
        $user = User::hint(auth()->user());
        if ($user->role !== 'employee') {
            return redirect()->back()->withErrors('Unauthorized action.');
        }

//        'status' => 'required|string|in:pending,accepted,delivered',

        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => ['required', 'integer', 'min:0', function ($attribute, $value, $fail) use ($request) {
                $item = Item::find($request->item_id);
                if (!$item || $value > $item->quantity) {
                    $fail('The ' . $attribute . ' exceeds available quantity.');
                }
            }],
        ]);

        $item = Item::query()->find($request->item_id);

        $validatedData['user_id'] = $user->id;
        $validatedData['warehouse_id'] = $item->warehouse->id;
        $validatedData['transaction_date'] = now();
        $validatedData['status'] = 'pending'; // Default status

        Transaction::create($validatedData);

        return redirect()->route('transactions.index');
    }

    public function updateStatus(Request $request)
    {
        $user = auth()->user();

        // Validate the new status and transaction ID
        $validatedData = $request->validate([
            'new_status' => 'required|string|in:pending,accepted,delivered',
            'transaction_id' => 'required|exists:transactions,id'
        ]);

        // Retrieve the transaction
        $transaction = Transaction::find($validatedData['transaction_id']);
        $item = $transaction->item;
        // Implement role-based status update logic
        if ($user->role == 'keeper') {
            if ($transaction->status == 'accepted' && $validatedData['new_status'] == 'delivered') {
                $transaction->status = 'delivered';
            } elseif ($transaction->status == 'delivered' && $validatedData['new_status'] == 'accepted') {
                $transaction->status = 'accepted';
            } else {
                return redirect()->back()->withErrors('Unauthorized action for this status.');
            }
        } elseif ($user->role == 'head') {
            if ($transaction->status == 'pending' && $validatedData['new_status'] == 'accepted') {
                $transaction->status = 'accepted';
                $item->quantity = $item->quantity - $transaction->quantity;
            } elseif ($transaction->status == 'accepted' && $validatedData['new_status'] == 'pending') {
                $transaction->status = 'pending';
                $item->quantity = $item->quantity + $transaction->quantity;

            } else {
                return redirect()->back()->withErrors('Unauthorized action for this status.');
            }
        }

        // Save the updated transaction
        $transaction->save();
        $item->save();
        return redirect()->route('transactions.index')->with('success', 'Transaction status updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $user = User::hint(auth()->user());
        if ($transaction->user->id === $user->id &&
            $user->role == "employee" &&
            $transaction->status === "pending") {
            $transaction->delete();
            return redirect()->route('transactions.index');
        }else {
            return redirect()->back()->withErrors('Unauthorized action for this status.');
        }
    }

}
