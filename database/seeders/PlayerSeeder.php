<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        DB::table('players')->insert([
            // id = 1
            ['club_id'=>1,'name'=>'Adam Foster','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Brian Keller','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Calvin Moore','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>1,'name'=>'Daniel Perez','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Eric Sanders','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Frank Howard','position'=>'DF','jersey_no'=>5,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Gavin Ross','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Henry Brooks','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Ian Mitchell','position'=>'DF','jersey_no'=>22,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>1,'name'=>'Jacob Turner','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Kyle Ramirez','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Liam Foster','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Mason Carter','position'=>'MF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Noah Griffin','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Owen Hayes','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>1,'name'=>'Patrick Allen','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Quentin Doyle','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Ryan Stevens','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Sean Grant','position'=>'FW','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>1,'name'=>'Travis Bennett','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 2
            ['club_id'=>2,'name'=>'Ulysses Harper','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Victor Malone','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Wyatt Rhodes','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>2,'name'=>'Xavier Collins','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Yuri Shaw','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Zachary Pierce','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Aiden Russell','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Brandon Ortiz','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Colton Reyes','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>2,'name'=>'Dylan Wheeler','position'=>'MF','jersey_no'=>5,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Ethan Flores','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Finn Adams','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Grayson Hunt','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Hudson Park','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Isaac Rutherford','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>2,'name'=>'Jackson Quinn','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Kenneth Miles','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Logan Scott','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Miles Donovan','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>2,'name'=>'Nolan Barrett','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 3
            ['club_id'=>3,'name'=>'Oliver Jacobs','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Preston Lane','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Quincy Vaughn','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>3,'name'=>'Riley Jennings','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Sawyer Knox','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Tanner Wells','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Ulrich Benton','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Victor Coleman','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Weston Adams','position'=>'DF','jersey_no'=>21,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>3,'name'=>'Xander Paul','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Yosef Kim','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Zion Harper','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Aaron Jennings','position'=>'MF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Brett James','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Carter Lowe','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>3,'name'=>'Derek Monroe','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Evan Phillips','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Felix Regan','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Gage Sutter','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>3,'name'=>'Hayden Tate','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 4
            ['club_id'=>4,'name'=>'Ian Vaughn','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'James Porter','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Kurt Blake','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>4,'name'=>'Landon Cruz','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Maddox Wolfe','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Nicolas Ford','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Omar Stevens','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Parker Silva','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Quinn Matthews','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>4,'name'=>'Reid Chapman','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Sam Elliott','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Trent Graham','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Umar Holloway','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Vance Irwin','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Warren James','position'=>'MF','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>4,'name'=>'Xavi Kendall','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Yann Lewis','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Zane Mitchell','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Alec Norman','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>4,'name'=>'Blake Osborne','position'=>'FW','jersey_no'=>21,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 5
            ['club_id'=>5,'name'=>'Cody Price','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Darren Holt','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Elliot Shaw','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>5,'name'=>'Finn Barker','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Gordon Reese','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Harvey Cross','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Ivan Delgado','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Jared Morales','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Keegan Holt','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>5,'name'=>'Luther Banks','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Marcus Doyle','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Nate Pearson','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Oscar Ray','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Phillip McCoy','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Quincy Neal','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>5,'name'=>'Ryder Owens','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Sawyer Payne','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Titus Reed','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Urijah Stone','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>5,'name'=>'Viktor Young','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 6
            ['club_id'=>6,'name'=>'Wade Griffin','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Xander Holt','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Yanni Cruz','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>6,'name'=>'Zach Irving','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Alan Porter','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Benny Ruiz','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Carter Silva','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Damon Tate','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Evan Underwood','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>6,'name'=>'Felix Vincent','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Gabe Walker','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Harrison Xu','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Ivan York','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Jasper Zane','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Kyle Arnold','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>6,'name'=>'Logan Bennett','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Mason Caldwell','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Nolan Diaz','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Owen Ellis','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>6,'name'=>'Peyton Fuller','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 7
            ['club_id'=>7,'name'=>'Quentin George','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Ramon Hunt','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Silas Iverson','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>7,'name'=>'Travis Jackson','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Uriel Knox','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Victor Lopez','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Wyatt Morris','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Xavier Neal','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Yosef Owens','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>7,'name'=>'Zion Phelps','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Aiden Quinn','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Brady Ross','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Chase Stewart','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Derek Turner','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Ethan Underhill','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>7,'name'=>'Finn Valdez','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Griffin Ward','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Hayden Xenos','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Ismael Young','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>7,'name'=>'Jaxon Zeller','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 8
            ['club_id'=>8,'name'=>'Kaleb Adams','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Lachlan Burns','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Merrick Clarke','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>8,'name'=>'Noel Davis','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Orion Ellis','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Paxton Floyd','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Quade Garland','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Riley Hampton','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Sterling Irvine','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>8,'name'=>'Tanner Jones','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Ulrich Kelley','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Vance Logan','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Wesley Morgan','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Xander Nichols','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Yuri Olsen','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>8,'name'=>'Zane Parker','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Alec Quinn','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Bryson Reed','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Caden Shaw','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>8,'name'=>'Dawson Turner','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 9
            ['club_id'=>9,'name'=>'Elliot Underwood','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Finley Voss','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Grayson White','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>9,'name'=>'Harvey Xander','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Isaac York','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Jace Zimmer','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Kylan Abbott','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Landon Brooks','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Milo Clement','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>9,'name'=>'Nolan Drake','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Owen Ellis','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Parker Frost','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Quinn Garner','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Rowan Hayes','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Silas Irving','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>9,'name'=>'Tucker Johnson','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Ulrich Knox','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Viktor Lane','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Warren Miles','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>9,'name'=>'Xavier Novak','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            // id = 10
            ['club_id'=>10,'name'=>'Yuri Olsen','position'=>'GK','jersey_no'=>1,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Zachary Price','position'=>'GK','jersey_no'=>12,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Aaron Quinn','position'=>'GK','jersey_no'=>30,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>10,'name'=>'Blake Rivera','position'=>'DF','jersey_no'=>2,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Caleb Smith','position'=>'DF','jersey_no'=>3,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Damon Thompson','position'=>'DF','jersey_no'=>4,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Ethan Underwood','position'=>'DF','jersey_no'=>13,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Felix Valdez','position'=>'DF','jersey_no'=>14,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Gavin Walker','position'=>'DF','jersey_no'=>15,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>10,'name'=>'Hayden Xu','position'=>'MF','jersey_no'=>6,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Isaiah Young','position'=>'MF','jersey_no'=>7,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Jaxon Zeller','position'=>'MF','jersey_no'=>8,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Keegan Adams','position'=>'MF','jersey_no'=>16,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Liam Brooks','position'=>'MF','jersey_no'=>17,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Milo Carter','position'=>'MF','jersey_no'=>18,'created_at'=>$timestamp,'updated_at'=>$timestamp],

            ['club_id'=>10,'name'=>'Noah Davis','position'=>'FW','jersey_no'=>9,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Odin Evans','position'=>'FW','jersey_no'=>10,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Parker Flynn','position'=>'FW','jersey_no'=>11,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Quincy Gray','position'=>'FW','jersey_no'=>19,'created_at'=>$timestamp,'updated_at'=>$timestamp],
            ['club_id'=>10,'name'=>'Ryder Hayes','position'=>'FW','jersey_no'=>20,'created_at'=>$timestamp,'updated_at'=>$timestamp],
        ]);
    }
}
