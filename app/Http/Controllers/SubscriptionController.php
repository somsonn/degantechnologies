<?php 
 
namespace App\Http\Controllers; 
use App\Models\Subscription; 
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator; 
 
class SubscriptionController extends Controller 
{ 
    public function store(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'email' => ['required', 'email', Rule::unique('subscriptions')], 
        ]); 
 
        if ($validator->fails()) { 
            return response()->json(['error' => $validator->errors()], 422); 
        } 
 
        try { 
            $subscriber = Subscription::create($request->all()); 
            return response()->json(['message' => 'You are subscribed successfully'], 201); 
        } catch (\Exception $e) { 
            return response()->json(['error' => 'Failed to subscribe. Email may already be taken.'], 500); 
        } 
     
    } 
}