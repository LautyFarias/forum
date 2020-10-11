<?php

class Main extends Controller{
    use SessionVerification;

    protected static $view = 'main.php';

    private $context = ['threads' => []];

    public function __construct()
    {
        $this->verificate_session();
    }

    public function get_context()
    {
        $thread = new Thread();
        $threads_data = $thread->get_objects();

        foreach ($threads_data as $row => $column) {
            $user = new User();
            $user->get(['id' => $column['user_id']]);

            $this->context['threads'][] = [
                "pid"        => $column['pid'],
                "title"      => $column['title'],
                "discussion" => $column['discussion'],
                "user"       => $user->username(),
                "likes"      => $column['likes'],
                "dislikes"   => $column['dislikes'],
                "date"       => $column['date']     
            ];
        }
        
        return $this->context;
    }
}