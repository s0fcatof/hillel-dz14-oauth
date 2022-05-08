<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Card;
use App\Models\Column;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory(30)->create();

        $subscriptions = Subscription::factory(10)->create();
        $notifications = Notification::factory(10)->create();
        Notification::all()->each(function (Notification $notification) use ($subscriptions) {
            $notification->subscriptions()->attach(
                $subscriptions->random(rand(1, 3))->pluck('id')->toArray(), ['created_at' => now()]
            );
        });

//        $users = User::factory(10)->create();
//        $users->each(function (User $user) {
//            $boards = Board::factory(1)->create(['author_id' => $user->id]);
//            $boards->each(function (Board $board) use ($user) {
//                $columns = Column::factory(rand(1,5))->create(['board_id' => $board->id]);
//                $columns->each(function (Column $column) use ($user) {
//
//                    if (rand(0,1) == 0) {
//                        $executor = $user;
//                    } else {
//                        $executor = User::factory()->create();
//                    }
//
//                    $cards = Card::factory(rand(1,5))->create([
//                        'column_id' => $column->id,
//                        'author_id' => $executor->id,
//                        'executor_id' => $user->id
//                    ]);
//
//                    $cards->each(function (Card $card) use ($user) {
//
//                        if (rand(0,1) == 0) {
//                            $commentator = $user;
//                        } else {
//                            $commentator = User::factory()->create();
//                        }
//
//                        Comment::factory(rand(0,5))->create([
//                            'card_id' => $card->id,
//                            'user_id' => $commentator->id
//                            ]);
//                    });
//
//                });
//            });
//        });
    }
}
