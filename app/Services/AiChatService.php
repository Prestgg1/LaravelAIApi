<?php 
namespace App\Services;

use App\Models\Message;
use App\Exceptions\AiServiceException;
use MoeMizrak\LaravelOpenrouter\DTO\ChatData;
use MoeMizrak\LaravelOpenrouter\DTO\MessageData;
use MoeMizrak\LaravelOpenrouter\Facades\LaravelOpenRouter;
use MoeMizrak\LaravelOpenrouter\Types\RoleType;
use Illuminate\Support\Facades\Log;

class AiChatService
{
    public function getAiResponse(string $userContent): Message
    {
        try {
            $chatData = new ChatData(
                messages: [new MessageData(content: $userContent, role: RoleType::USER)],
                model: 'google/gemma-3n-e4b-it:free',
            );

            $response = LaravelOpenRouter::chatRequest($chatData);
            $content = $response->choices[0]['message']['content'] ?? null;

            if (!$content) {
                throw new AiServiceException('AI provayderindən boş cavab gəldi.');
            }

            return Message::create([
                'user_message' => $userContent,
                'ai_response'  => $content
            ]);

        } catch (\Exception $e) {
            Log::error('AI_SERVICE_ERROR: ' . $e->getMessage(), [
                'input' => $userContent
            ]);
          
            throw new AiServiceException('Sistem hazırda cavab verə bilmir. Bir az sonra yenidən yoxlayın.');
        }
    }
}