<?php

use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new App\User();
        $user1->username = 'ahmed-sa3d';
        $user1->password = Hash::make( '123456' );
        $user1->is_admin = true;
        $user1->is_active = true;

        $user1->save();

        $user2 = new App\User();
        $user2->username = 'user-active';
        $user2->password = Hash::make( '123456' );
        $user2->is_admin = false;
        $user2->is_active = true;

        $user2->save();

        $user3 = new App\User();
        $user3->username = 'user-notactive';
        $user3->password = Hash::make( '123456' );
        $user3->is_admin = true;
        $user3->is_active = true;

        $user3->save();

        // ------------------------------- Seed Categories --------------------------------------
        $cat1 = new App\Category();
        $cat1->title = 'Appliances';
        $cat1->description = 'This Is A Description text';
        $cat1->save();

        $cat2 = new App\Category();
        $cat2->title = 'Televisions';
        $cat2->description = 'This Is A Description text';
        $cat2->parent()->associate( $cat1 );
        $cat2->save();

        $cat3 = new App\Category();
        $cat3->title = 'Heaters';
        $cat3->description = 'This Is A Description text';
        $cat3->parent()->associate( $cat1 );
        $cat3->save();

        $cat4 = new App\Category();
        $cat4->title = 'LCD TV';
        $cat4->description = 'This Is A Description text';
        $cat4->parent()->associate( $cat2 );
        $cat4->save();

        

        $cat5 = new App\Category();
        $cat5->title = 'Electronics';
        $cat5->description = 'This Is A Description text';
        $cat5->save();

        $cat6 = new App\Category();
        $cat6->title = 'Smart Phones';
        $cat6->description = 'This Is A Description text';
        $cat6->parent()->associate( $cat5 );
        $cat6->save();

        $cat7 = new App\Category();
        $cat7->title = 'Computers';
        $cat7->description = 'This Is A Description text';
        $cat7->parent()->associate( $cat5 );
        $cat7->save();

        $cat8 = new App\Category();
        $cat8->title = 'Desktop';
        $cat8->description = 'This Is A Description text';
        $cat8->parent()->associate( $cat7 );
        $cat8->save();

        $cat9 = new App\Category();
        $cat9->title = 'Laptop';
        $cat9->description = 'This Is A Description text';
        $cat9->parent()->associate( $cat7 );
        $cat9->save();

        // ------------------------------- Seed Products --------------------------------------

        $pro1 = new App\Product();
        $pro1->name = 'Lg Tv f1234';
        $pro1->price = 2450;
        $pro1->instock_quantity = 16;
        $pro1->discount_percent = 10;
        $pro1->description = 'This Is A Description text';
        $pro1->save();
        $pro1->categories()->attach( [$cat4->id, $cat2->id] );

        $pro2 = new App\Product();
        $pro2->name = 'Toshiba Z12';
        $pro2->price = 3500;
        $pro2->instock_quantity = 8;
        // $pro2->discount_percent = 10;
        $pro2->description = 'This Is A Description text';
        $pro2->save();
        $pro2->categories()->attach( [$cat9->id] );


        $pro3 = new App\Product();
        $pro3->name = 'HP Micro Tower PC';
        $pro3->price = 4320;
        $pro3->instock_quantity = 59;
        $pro3->discount_percent = 22;
        $pro3->description = 'This Is A Description text';
        $pro3->save();
        $pro3->categories()->attach( [$cat8->id] );

        $pro4 = new App\Product();
        $pro4->name = 'Samsung Galaxy S3';
        $pro4->price = 3350;
        $pro4->instock_quantity = 12;
        // $pro4->discount_percent = 10;
        $pro4->description = 'This Is A Description text';
        $pro4->save();
        $pro4->categories()->attach( [$cat6->id] );

        $pro5 = new App\Product();
        $pro5->name = 'HTC Senseation XL';
        $pro5->price = 4200;
        $pro5->instock_quantity = 0;
        // $pro5->discount_percent = 10;
        $pro5->description = 'This Is A Description text';
        $pro5->save();
        $pro5->categories()->attach( [$cat6->id] );
    }
}
