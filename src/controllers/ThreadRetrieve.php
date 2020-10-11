<?php

class ThreadRetrieve extends Controller
{
    use SessionVerification;

    protected static $view = 'thread-retrieve.php';
    
    private $context;
    private $thread_pid;

    public function __construct()
    {
        $url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);
        $url_components = explode('/', $url);
        foreach ($url_components as $url_component) {
            preg_match(
                "/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/",
                $url_component, $matches
            );
        }
        $this->thread_pid = $matches[0];
    }

    public function get_context(){
        $thread = new Thread();
        $thread->get(['pid'=>$this->thread_pid]);

        $_SESSION['thread'] = $thread;

        $response = new Response();
        $responses_data = $response->filter(["thread_id" => $thread->id()]);

        foreach ($responses_data as $response) {
            $user = new User();
            $user->get(['id' => $response['user_id']]);
            $response['user'] = $user->username();
            $response['user_pid'] = $user->pid();
            unset($response['user_id']);
            $responses_data_modified[] = $response;
        }

        unset($responses_data);

        $this->context = [
            "thread" => [
                "pid"        => $thread->pid(),
                "title"      => $thread->title(),
                "discussion" => $thread->discussion(),
                "user"       => $thread->user()->username(),
                "user_pid"   => $thread->user()->pid(),
                "date"       => $thread->date(),
                "likes"      => $thread->likes(),
                "dislikes"   => $thread->dislikes()
            ],
            "responses" => $responses_data_modified
        ];
        
        return $this->context;
    }

    public function set_response()
    {
        $this->verificate_session();

        $request = $this->resolve_request(['POST']);
        $response_content = $request['params']['response'];

        $response = new Response($response_content);
        $response->create();

        $this->json_response(true);
    }
}
