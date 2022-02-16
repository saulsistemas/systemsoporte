<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact1 = new Contact();
        $contact1->name = 'WEB';
        $contact1->save();

        $contact1 = new Contact();
        $contact1->name = 'LLAMADA';
        $contact1->save();

        $contact1 = new Contact();
        $contact1->name = 'CORREO ELECTRONICO';
        $contact1->save();

        $contact1 = new Contact();
        $contact1->name = 'MENSAJE WHATSAPP/OTROS';
        $contact1->save();
        
    }
}
