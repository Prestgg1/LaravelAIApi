<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreAiMessageRequest;
use Illuminate\Support\Facades\Log;
use MoeMizrak\LaravelOpenrouter\DTO\ChatData;
use MoeMizrak\LaravelOpenrouter\DTO\MessageData;
use MoeMizrak\LaravelOpenrouter\Facades\LaravelOpenRouter;
use MoeMizrak\LaravelOpenrouter\Types\RoleTyp;
use MoeMizrak\LaravelOpenrouter\Types\RoleType;

class AiController extends Controller
{
    





   public function index()
   {
      $messages = Message::latest()->get();
      return view('welcome', compact('messages'));
   }

   public function store(StoreAiMessageRequest $request)
   {
       $validated = $request->validated();
   
       try {
           $message = new Message();
           $message->user_message = $validated['user_content'];
   
           $chatData = new ChatData(
               messages: [new MessageData(content: $validated['user_content'], role: RoleType::USER)],
               model: 'mistralai/devstral-2512:free',
           );
   
           $chatResponse = LaravelOpenRouter::chatRequest($chatData);
   
           if (isset($chatResponse->choices[0]['message']['content'])) {
               $message->ai_response = $chatResponse->choices[0]['message']['content'];
               $message->save();
               return back()->with('success', 'Mesaj uğurla göndərildi!');
           } else {
               throw new \Exception('AI-dan cavab alınmadı.');
           }
   
       } catch (\Exception $e) {
           Log::error('OpenRouter Error: ' . $e->getMessage());
   
           return back()
               ->withInput() 
               ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
       }
   }
}