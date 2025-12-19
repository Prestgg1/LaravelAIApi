<?php
namespace App\Http\Controllers;

use App\Exceptions\AiServiceException;
use App\Models\Message;
use App\Http\Requests\StoreAiMessageRequest;
use App\Services\AiChatService;
use Illuminate\Support\Facades\Log;
use MoeMizrak\LaravelOpenrouter\DTO\ChatData;
use MoeMizrak\LaravelOpenrouter\DTO\MessageData;
use MoeMizrak\LaravelOpenrouter\Facades\LaravelOpenRouter;
use MoeMizrak\LaravelOpenrouter\Types\RoleTyp;
use MoeMizrak\LaravelOpenrouter\Types\RoleType;

class AiChatController extends Controller
{
    

   public function __construct(private AiChatService $aiService)
   {
      
   }




   public function index()
   {
      $messages = Message::latest()->get();
      return view('welcome', compact('messages'));
   }

   public function store(StoreAiMessageRequest $request)
   {
       $validated = $request->validated();
   
       try {
         $this->aiService->getAiResponse($validated['user_content']);
         return back()->with('success', 'Cavab alındı.');
     } catch (AiServiceException $e) {
         return back()->withInput()->with('error', $e->getMessage());
     }

   }
}