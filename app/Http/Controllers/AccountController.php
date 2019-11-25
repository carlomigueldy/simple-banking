<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use App\AccountTransaction;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of all Account Holders.
     * 
     * @return Array
     */
    public function index()
    {
        $accounts = User::where('role_id', 1)->get();

        return response()->json([
            'accounts' => $accounts,
        ]);
    }
    
    /**
     * Display information of an Account Holder.
     * 
     * @return Object
     */
    public function show($id)
    {
        $accountHolder = User::findOrFail($id);
        
        if ($accountHolder->role_id == 1) {
            return response()->json([
                'account' => [
                    'name' => $accountHolder->name,
                    'email' => $accountHolder->email,
                    'balance' => $accountHolder->account->balance,
                ],
                'account_transactions' => $accountHolder->account_transactions,
            ]);
        }
    }

    /**
     * Creates a new Account Holder.
     * 
     * { role_id } 
     * [ 1 => Account Holder, 2 => Teller, 3 => Manager ]
     * 
     * @return Object
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 1,
            'password' => bcrypt($request->password),
        ]);

        $account = Account::create([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'account' => [
                'account_id' => $account->id,
                'name' => $user->name, 
                'email' => $user->email,
            ],
            'message' => 'A new Account Holder has been created.',
        ]);
    }

    /**
     * Updates the Account Holder information.
     * 
     * @return Object
     */
    public function update(Request $request, $id)
    {
        // Code
    }

    /**
     * Deletes an Account Holder.
     * 
     * @return Object
     */
    public function destroy($id)
    {
        $account = User::findOrFail($id);

        if ($account->role_id == 1) {
            $account->delete();

            return response()->json([
                'account' => [
                    'name' => $account->name,
                    'email' => $account->email, 
                ],
                'message' => 'An Account Holder has been deleted.'
            ]);
        }
    }
}