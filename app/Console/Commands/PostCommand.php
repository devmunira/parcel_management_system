<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is schhadula post publish';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::where('status' , 'Pending')->where('publish_date' , '>' , now())->get();
        foreach($posts as $post){
            $post -> status = 'Published';
            $post -> update();
         }
    }
}
