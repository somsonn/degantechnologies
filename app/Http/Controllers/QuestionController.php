<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Question;


class QuestionController extends Controller
{
    public function index()
    {
        try {
            $questions = Question::orderBy('id', 'desc')->get();

            if ($questions->isEmpty()) {
                return response()->json(['message' => 'No questions found'], 404);
            }

            return response()->json($questions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch questions'], 500);
        }
    }
    public function totalquestions()
    {
        try {
            $countquestions = Question::count();

            if (!$countquestions) {
                return response()->json(['message' => 'No questions found'], 404);
            }

            return response()->json($countquestions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch questions'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'email' => 'required',
            'phone_no' => 'required|',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'all filds are required'], 422);
        }

        
        try {

            $question = new Question;
            $question->question = $request->question;
            $question->email = $request->email;
            $question->phone_no = $request->phone_no;

            
            if($question->save()){

                return response()->json(['message' => 'Question created successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create question'], 500);
        }
    }
}
