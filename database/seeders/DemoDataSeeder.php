<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@ehb.be')->first();

        // Enkele gewone leden
        $members = collect(['Sara', 'Tom', 'Nora', 'Kobe'])->map(function (string $name) {
            return User::updateOrCreate(
                ['email' => strtolower($name).'@example.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('Password!321'),
                    'is_admin' => false,
                    'email_verified_at' => now(),
                ]
            );
        });

        foreach ($members as $member) {
            $member->profile()->updateOrCreate([], [
                'username' => $member->name,
                'bio' => 'Fan van coöperatieve bordspellen.',
            ]);
        }

        // Nieuwsberichten
        News::updateOrCreate(
            ['title' => 'Nieuwe aanwinst: Catan uitbreiding'],
            [
                'user_id' => $admin->id,
                'content' => 'We hebben de Catan uitbreiding "Zeevaarders" aangeschaft. Kom hem uitproberen op de volgende spelavond!',
                'published_at' => now()->subDays(3),
            ]
        );

        News::updateOrCreate(
            ['title' => 'Nieuwe openingsuren clublokaal'],
            [
                'user_id' => $admin->id,
                'content' => 'Vanaf september is het clublokaal ook op woensdagavond open, naast de gebruikelijke vrijdagavond.',
                'published_at' => now()->subDay(),
            ]
        );

        // FAQ
        $lidmaatschap = FaqCategory::updateOrCreate(['name' => 'Lidmaatschap']);
        FaqItem::updateOrCreate(
            ['faq_category_id' => $lidmaatschap->id, 'question' => 'Hoe word ik lid?'],
            ['answer' => 'Maak een account aan via de registratiepagina en kom langs op een spelavond.']
        );
        FaqItem::updateOrCreate(
            ['faq_category_id' => $lidmaatschap->id, 'question' => 'Wat kost het lidmaatschap?'],
            ['answer' => 'Lidmaatschap is gratis, we vragen enkel een kleine bijdrage van €2 per spelavond voor drank.']
        );

        $spellen = FaqCategory::updateOrCreate(['name' => 'Spellen']);
        FaqItem::updateOrCreate(
            ['faq_category_id' => $spellen->id, 'question' => 'Welke spellen hebben jullie?'],
            ['answer' => 'We hebben meer dan 100 bordspellen, van lichte partyspellen tot zware strategiespellen.']
        );

        // Evenementen (spelavonden)
        Event::updateOrCreate(
            ['title' => 'Spelavond: Catan & co'],
            [
                'description' => 'Vrije spelavond met focus op Catan en aanverwante spellen.',
                'event_date' => now()->addDays(5),
                'location' => 'Clublokaal, Speelstraat 1',
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Groot bordspeltoernooi'],
            [
                'description' => 'Jaarlijks toernooi met verschillende spellen en prijzen.',
                'event_date' => now()->addDays(20),
                'location' => 'Zaal De Kroon',
            ]
        );
    }
}
