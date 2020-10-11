<?php

class ThreadForm extends Controller
{
    use SessionVerification;
    use Validation;

    private $validation;

    protected static $view = 'thread_form.php';

    public function __construct()
    {
        $this->verificate_session();

        $request = self::resolve_request(['POST']);

        $title      = $request['params']['title'];
        $discussion = $request['params']['discussion'];

        $this->validate_discussion($title);
        $this->validate_discussion($discussion);

        if ($this->data_is_valid()){
            $thread = new Thread($title, $discussion);
            $thread->create();
            $this->json_response(true, 200);
        } else {
            $this->json_response($this->validation, 400);
        }
    }
}