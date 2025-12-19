# Laravel AI Chat Application

Bu layihə, istifadəçilərin suallarına süni intellekt vasitəsilə cavab aldığı sadə və effektiv bir çat tətbiqidir. Layihədə **OpenRouter API** vasitəsilə Google-un **Gemma** modeli inteqrasiya edilmişdir.

---

## 🚀 Layihənin necə işə salınması

Layihəni lokal mühitinizdə quraşdırmaq üçün aşağıdakı addımları izləyin:

1. **Repozitoriyanı kopyalayın:**

    ```bash
    git clone [repo-url]
    cd [folder-name]

     Asılılıqları yükləyin:
         composer install
         npm install && npm run dev
    ```

Mühit dəyişənlərini tənzimləyin: .env.example faylının adını .env olaraq dəyişdirin və verilənlər bazası məlumatlarını qeyd edin. Həmçinin OpenRouter açarınızı əlavə edin:

OPENROUTER_API_KEY=your_api_key_here

Verilənlər bazasını miqrasiya edin:
Bash

php artisan migrate

Tətbiqi işə salın:
php artisan serve

💡 Edilmiş fərziyyələr (Assumptions)

Layihənin hazırlanması zamanı aşağıdakı texniki qərarlar verilmişdir:

    Service Layer Pattern: Kodun təmiz, oxunaqlı və test edilə bilən olması üçün AI məntiqi Controller-dən ayrılaraq AiChatService daxilində izolyasiya edilmişdir.

    Error Handling: Production mühitinə uyğun olaraq, API sorğuları zamanı yarana biləcək xətalar (məsələn: 401 Unauthorized, limit aşımı) try-catch blokları vasitəsilə idarə olunur. Texniki xətalar loglanır, lakin istifadəçiyə anlaşıqlı mesajlar göstərilir.

    Request Validation: StoreAiMessageRequest istifadə edilərək, daxil edilən mesajın boş olmaması və təhlükəsizliyi təmin edilmişdir.

    Persistent Storage: İstifadəçi mesajları və AI-dan gələn cavablar verilənlər bazasında (messages cədvəli) saxlanılır ki, bu da çat tarixçəsinin qorunmasına imkan verir.

🤖 AI İnteqrasiyası Haqqında (Gemini/Gemma)

Bu layihədə AI mühərriki olaraq OpenRouter platforması üzərindən Google Gemma modeli seçilmişdir.

    Niyə Gemma? Google tərəfindən inkişaf etdirilən bu model, sürətli cavab vermə qabiliyyəti və effektiv "free tier" (pulsuz) seçimləri təklif etdiyi üçün üstünlük verilmişdir.

    İnteqrasiya Metodu: MoeMizrak/laravel-openrouter paketi vasitəsilə DTO (Data Transfer Objects) strukturundan istifadə edilərək daha stabil bir inteqrasiya qurulmuşdur.

    İşləmə Axışı:

        İstifadəçi interfeys vasitəsilə mesajı göndərir.

        Controller sorğunu validasiya edir və AiChatService-ə ötürür.

        Service mesajı paket strukturu ilə OpenRouter API-na göndərir.

        Gələn cavab bazaya yazılır və sinxron şəkildə istifadəçiyə ekranda göstərilir.

🛠 Texnologiya Steki

    Backend: Laravel 12

    Frontend: Blade & Tailwind CSS

    Database: SQLite

    AI Provider: OpenRouter (Model: google/gemma-3n-e4b-it:free)
