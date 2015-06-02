<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class RecipeTableSeeder extends Seeder{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('recipes')->truncate();

        Recipe::create([
            'id'            => 1,
            'title'         => 'Hamburgers',
            'slug'          => 'hamburgers',
            'description'   => 'Great recipe to incorporate bacon.',
            'directions'          => 'Bacon ipsum dolor amet tail short loin filet mignon, picanha turducken spare ribs corned beef turkey ground round shoulder beef ribs. Picanha bacon pancetta frankfurter porchetta boudin pork chop landjaeger pig drumstick spare ribs beef ribs biltong tenderloin short loin. Pork loin leberkas turducken tail tongue kielbasa salami spare ribs beef ribs corned beef beef venison cupim brisket rump. Chuck frankfurter meatball, andouille tri-tip tail hamburger jowl bresaola beef salami ham hock sausage. Beef short ribs cow, flank andouille salami shank prosciutto meatball ham filet mignon sirloin. Filet mignon tail flank spare ribs fatback turducken turkey. Picanha bacon alcatra leberkas turkey shankle ball tip beef ribeye tail meatball boudin kevin pork chop flank.
Shankle prosciutto bresaola salami, rump shank doner chicken ham hock drumstick. Swine spare ribs short loin, leberkas pig landjaeger filet mignon. Shank swine tongue meatloaf pork loin short loin frankfurter pancetta boudin landjaeger capicola drumstick salami. Filet mignon capicola t-bone ham.
Pork belly bresaola tenderloin, boudin cow leberkas ball tip shoulder corned beef shank pig biltong. Biltong pork loin drumstick fatback. Frankfurter porchetta pork chop pork chicken shank, sausage short ribs pig. Boudin kevin bacon hamburger pork belly. Beef ribs shoulder turkey salami.
Pancetta short ribs chuck meatloaf prosciutto. Venison pork chop capicola jerky, leberkas chuck tail meatball spare ribs alcatra doner tri-tip. Short ribs tongue rump picanha bresaola biltong meatloaf kevin. Prosciutto ham hock bresaola alcatra, biltong beef tenderloin turducken filet mignon short loin.
Meatloaf sirloin filet mignon ground round. Pig sirloin pork meatball ground round ham hock jerky flank porchetta brisket drumstick pork chop andouille. Kielbasa venison t-bone cow ribeye filet mignon chuck pork chop shank pig jowl tail. Kevin shoulder porchetta tri-tip kielbasa beef ribs flank.',
            'user_id'       => 1,
            'is_approved'   => 1
        ]);

        Recipe::create([
            'id'            => 2,
            'title'         => 'Steak',
            'slug'          => 'steak',
            'description'   => 'Great recipe to incorporate bacon.',
            'directions'          => 'Shankle prosciutto bresaola salami, rump shank doner chicken ham hock drumstick. Swine spare ribs short loin, leberkas pig landjaeger filet mignon. Shank swine tongue meatloaf pork loin short loin frankfurter pancetta boudin landjaeger capicola drumstick salami. Filet mignon capicola t-bone ham.
Pork belly bresaola tenderloin, boudin cow leberkas ball tip shoulder corned beef shank pig biltong. Biltong pork loin drumstick fatback. Frankfurter porchetta pork chop pork chicken shank, sausage short ribs pig. Boudin kevin bacon hamburger pork belly. Beef ribs shoulder turkey salami.
Pancetta short ribs chuck meatloaf prosciutto. Venison pork chop capicola jerky, leberkas chuck tail meatball spare ribs alcatra doner tri-tip. Short ribs tongue rump picanha bresaola biltong meatloaf kevin. Prosciutto ham hock bresaola alcatra, biltong beef tenderloin turducken filet mignon short loin.
Meatloaf sirloin filet mignon ground round. Pig sirloin pork meatball ground round ham hock jerky flank porchetta brisket drumstick pork chop andouille. Kielbasa venison t-bone cow ribeye filet mignon chuck pork chop shank pig jowl tail. Kevin shoulder porchetta tri-tip kielbasa beef ribs flank.',
            'user_id'       => 1,
            'is_approved'   => 1
        ]);

        Recipe::create([
            'id'            => 3,
            'title'         => 'Bread',
            'slug'          => 'bread',
            'description'   => 'Great recipe to incorporate bacon.',
            'directions'          => 'Bresaola sint prosciutto meatball swine. Alcatra nostrud exercitation t-bone cillum. Veniam frankfurter adipisicing, pastrami mollit pork chop shankle officia tail qui consequat ham fatback. Ground round ullamco bacon elit. Biltong pariatur pastrami duis cupim consequat t-bone. Bacon duis strip steak, ground round nulla qui ball tip doner filet mignon lorem turducken commodo alcatra. Prosciutto enim velit tempor shoulder pork loin ea spare ribs doner sed salami minim cillum t-bone tongue.',
            'user_id'       => 2
        ]);

        Recipe::create([
            'id'            => 4,
            'title'         => 'Ice Cream',
            'slug'          => 'ice-cream',
            'description'   => 'Great recipe to incorporate bacon.',
            'directions'          => 'Bacon ipsum dolor amet tail short loin filet mignon, picanha turducken spare ribs corned beef turkey ground round shoulder beef ribs. Picanha bacon pancetta frankfurter porchetta boudin pork chop landjaeger pig drumstick spare ribs beef ribs biltong tenderloin short loin. Pork loin leberkas turducken tail tongue kielbasa salami spare ribs beef ribs corned beef beef venison cupim brisket rump. Chuck frankfurter meatball, andouille tri-tip tail hamburger jowl bresaola beef salami ham hock sausage. Beef short ribs cow, flank andouille salami shank prosciutto meatball ham filet mignon sirloin. Filet mignon tail flank spare ribs fatback turducken turkey. Picanha bacon alcatra leberkas turkey shankle ball tip beef ribeye tail meatball boudin kevin pork chop flank.
Shankle prosciutto bresaola salami, rump shank doner chicken ham hock drumstick. Swine spare ribs short loin, leberkas pig landjaeger filet mignon. Shank swine tongue meatloaf pork loin short loin frankfurter pancetta boudin landjaeger capicola drumstick salami. Filet mignon capicola t-bone ham.
Pork belly bresaola tenderloin, boudin cow leberkas ball tip shoulder corned beef shank pig biltong. Biltong pork loin drumstick fatback. Frankfurter porchetta pork chop pork chicken shank, sausage short ribs pig. Boudin kevin bacon hamburger pork belly. Beef ribs shoulder turkey salami.
Pancetta short ribs chuck meatloaf prosciutto. Venison pork chop capicola jerky, leberkas chuck tail meatball spare ribs alcatra doner tri-tip. Short ribs tongue rump picanha bresaola biltong meatloaf kevin. Prosciutto ham hock bresaola alcatra, biltong beef tenderloin turducken filet mignon short loin.
Meatloaf sirloin filet mignon ground round. Pig sirloin pork meatball ground round ham hock jerky flank porchetta brisket drumstick pork chop andouille. Kielbasa venison t-bone cow ribeye filet mignon chuck pork chop shank pig jowl tail. Kevin shoulder porchetta tri-tip kielbasa beef ribs flank.',
            'user_id'       => 2
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}